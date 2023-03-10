<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Ratting;
use App\Models\Payment;
use App\Models\User;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\Settings;
use Stripe;
use Helper;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        $order_number = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);
        $data=Cart::where('user_id',$request->user_id)->orderBy('id', 'DESC')->get();
        if (count($data) == 0) {
            return response()->json(['status'=>0,'message'=>trans('messages.cart_is_empty')],200);
        }
        $getuserdata=User::select('token','email','name','wallet')->where('id',$request->user_id)->first();
        $gettimezone=Settings::select('timezone')->first();
        date_default_timezone_set($gettimezone->timezone);
        try {
            //payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5
            if ($request->payment_type == 3 OR $request->payment_type == 5) {
                if($request->payment_id == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.payment_id_required')],200);
                }
                $payment_id = $request->payment_id;
            }

            if ($request->payment_type == 4) {
                $getstripe=Payment::select('environment','test_secret_key','live_secret_key')->where('payment_name','Stripe')->first();

                if ($getstripe->environment == "1") {
                    $skey = $getstripe->test_secret_key;
                } else {
                    $skey = $getstripe->live_secret_key;
                }
                if($request->card_number == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_number')],200);
                }
                if($request->card_exp_month == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_exp_month')],200);
                }
                if($request->card_exp_year == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_exp_year')],200);
                }
                if($request->card_cvc == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_cvc')],200);
                }
                try {
                    $stripe = new \Stripe\StripeClient($skey);
                    $stripe_data = $stripe->tokens->create([
                        'card' => [
                            'number' => $request->card_number,
                            'exp_month' => $request->card_exp_month,
                            'exp_year' => $request->card_exp_year,
                            'cvc' => $request->card_cvc,
                        ],
                    ]);
                    $token = $stripe_data->id;
                    Stripe\Stripe::setApiKey($skey);
                    $payment = Stripe\Charge::create ([
                        "amount" => $request->grand_total * 100,
                        "currency" => "USD",
                        "source" => $token,
                        "description" => "eCommerce",
                    ]);
                    $payment_id = $payment->id;
                } catch (Exception $e) {
                    return response()->json(['status'=>0,'message'=>trans('messages.unable_to_complete_payment')],200);
                }
            }
            foreach ($data as $key => $value) {
                $OrderPro = new Order;
                $OrderPro->user_id = $request->user_id;
                $OrderPro->vendor_id = $value['vendor_id'];
                $OrderPro->product_id = $value['product_id'];
                $OrderPro->order_number = $order_number;
                $OrderPro->payment_id = @$payment_id;
                $OrderPro->product_name = $value['product_name'];
                $OrderPro->slug = $value['slug'];
                $OrderPro->image = $value['image'];
                $OrderPro->qty = $value['qty'];
                $OrderPro->price = $value['price'];
                $OrderPro->attribute = $value['attribute'];
                $OrderPro->variation = $value['variation'];
                $OrderPro->tax = $value['tax']*$value['qty'];
                $OrderPro->coupon_name = $request->coupon_name;
                $OrderPro->shipping_cost = $value['shipping_cost'];
                $OrderPro->order_total = $request->grand_total;
                $OrderPro->order_notes = $request->order_notes;
                $OrderPro->payment_type = $request->payment_type;
                $OrderPro->full_name = $request->full_name;
                $OrderPro->email = $request->email;
                $OrderPro->mobile = $request->mobile;
                $OrderPro->landmark = $request->landmark;
                $OrderPro->street_address = $request->street_address;
                $OrderPro->pincode = $request->pincode;

                $OrderPro->discount_amount = @$request->discount_amount;
                $OrderPro->save();
            }
            $order_id = \DB::getPdo()->lastInsertId();

            if ($request->payment_type == 2) {

                $order_info=Order::select('order_total as grand_total')->where('order_number',$order_number)->groupBy('order_number')->first();
                $wallet = $getuserdata->wallet - $order_info->grand_total;
                $UpdateWalletDetails = User::where('id', $request->user_id)->update(['wallet' => $wallet]);

                $Wallet = new Transaction;
                $Wallet->user_id = $request->user_id;
                $Wallet->order_id = $order_id;
                $Wallet->order_number = $order_number;
                $Wallet->wallet = $order_info->grand_total;
                $Wallet->payment_id = NULL;
                $Wallet->type = 'place-order';
                $Wallet->transaction_type = '2';
                $Wallet->save();
            }

            $cart=Cart::where('user_id', $request->user_id)->delete();

            $notification=array('user_id'=>$request->user_id,'order_id'=>$order_id,'order_number'=>$order_number,'order_status'=>"1",'message'=>"Order ".$order_number." has been placed",'is_read'=>"1",'type'=>"order");
            $store=Notification::create($notification);

            if ($request->payment_type != 1) {
                $getvendordata=User::select('wallet')
                ->where('id',$request->vendor_id)
                ->first();
                if ($getvendordata->wallet >= 0) {
                    $vendorwallet = $getvendordata->wallet + $request->grand_total;
                } elseif ($getvendordata->wallet <= 0) {
                    $vendorwallet = $getvendordata->wallet + $request->grand_total;
                } else {
                    $vendorwallet = 0;
                }

                $UpdateWalletDetails = User::where('id', $request->vendor_id)
                ->update(['wallet' => $vendorwallet]);
            }

            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);

        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }
    public function orderhistory(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }

        try {
            $orderdata=Order::select('id','order_number','payment_type','status','order_total as grand_total','discount_amount',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'))
            ->where('user_id',$request->user_id)
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->paginate(10);

            if(!empty($orderdata))
            {
                return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$orderdata],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
            }
        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }
    public function orderdetails(Request $request)
    {
        if($request->order_number == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.order_number_required')],400);
        }

        try {

            $orderdata=Order::select('orders.id','orders.product_id','orders.product_name','orders.qty','orders.discount_amount','orders.price','products.return_days','orders.status','orders.attribute','orders.variation','orders.tax','orders.shipping_cost',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', orders.image) AS image_url"))
            ->join('products','orders.product_id','=','products.id')
            ->where('orders.order_number',$request->order_number)
            ->orderBy('orders.id', 'DESC')
            ->get();


            foreach ($orderdata as $value) {
                $order_data[] = array(
                    'id' => $value['id'], 
                    'product_id' => $value['product_id'],
                    'product_name' => $value['product_name'], 
                    'qty' => $value['qty'],
                    'price' => $value['price'],
                    'status' => $value['status'],
                    'attribute' => $value['attribute'],
                    'variation' => $value['variation'],
                    'tax' => $value['tax'],
                    'shipping_cost' => number_format($value['shipping_cost'],2),
                    'image_url' => $value['image_url'],
                    'discount_amount' => $value['discount_amount'],
                    'return_days' => $value['return_days'],
                    'total' => $value['qty']*$value['price']+$value['tax']*$value['qty']+$value['shipping_cost']
                );
            }
            $order_info=Order::select('order_number','order_notes','payment_type','full_name','email','mobile','landmark','street_address','pincode','coupon_name','order_total','discount_amount','status',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'),\DB::raw('SUM(price*qty) AS subtotal'),\DB::raw('SUM(tax) AS tax'),\DB::raw('SUM(shipping_cost) AS shipping_cost'))
            ->where('order_number',$request->order_number)
            ->groupBy('order_number',)
            ->first();

            if ($order_info->discount_amount == "") {
                $grand_total = $order_info->subtotal+$order_info->tax+$order_info->shipping_cost;
            } else {
                $grand_total = $order_info->subtotal+$order_info->tax+$order_info->shipping_cost-$order_info->discount_amount;
            }

            $order_infos = array(
                'order_number' => $order_info->order_number, 
                'order_notes' => $order_info->order_notes, 
                'payment_type' => $order_info->payment_type, 
                'full_name' => $order_info->full_name, 
                'email' => $order_info->email, 
                'mobile' => $order_info->mobile, 
                'landmark' => $order_info->landmark, 
                'street_address' => $order_info->street_address, 
                'pincode' => $order_info->pincode, 
                'coupon_name' => $order_info->coupon_name, 
                'discount_amount' => @$order_info->discount_amount, 
                'status' => $order_info->status, 
                'date' => $order_info->date, 
                'subtotal' => $order_info->subtotal, 
                'tax' => $order_info->tax, 
                'shipping_cost' => number_format($order_info->shipping_cost,2), 
                'grand_total' => $grand_total
            );

            if(!empty($order_info)){
                return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'order_info'=>$order_infos,'order_data'=>$order_data],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
            }
        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }

    public function cancelorder(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        if($request->order_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.orderid_required')],400);
        }
        if($request->status == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.order_status_required')],400);
        }

        $status=Order::select('orders.id','orders.vendor_id','orders.order_total','orders.product_name','orders.payment_id','orders.user_id','orders.payment_type','orders.user_id','orders.order_number')
        ->join('users','orders.user_id','=','users.id')
        ->where('orders.id',$request->order_id)
        ->first();

        if ($status->payment_type != "1") {
            $walletdata=User::select('wallet')->where('id',$status->user_id)->first();

            if ($walletdata->wallet > 0) {
                $walletamount = $walletdata->wallet;
            } else {
                $walletamount = 0;
            }
            $wallet = $walletamount + $status->order_total;

            $UpdateWalletDetails = User::where('id', $status->user_id)
            ->update(['wallet' => $wallet]);

            $Wallet = new Transaction;
            $Wallet->user_id = $status->user_id;
            $Wallet->order_id = $request->order_id;
            $Wallet->order_number = $status->order_number;
            $Wallet->wallet = $status->order_total;
            $Wallet->payment_id = $status->payment_id;
            $Wallet->type = "cancel-order";
            $Wallet->transaction_type = '1';
            $Wallet->save();


            $getvendordata=User::select('wallet')
            ->where('id',$status->vendor_id)
            ->first();

            if ($getvendordata->wallet >= 0) {
                $vendorwallet = $getvendordata->wallet - $status->order_total;
            } elseif ($getvendordata->wallet <= 0) {
                $vendorwallet = $getvendordata->wallet - $status->order_total;
            } else {
                $vendorwallet = 0;
            }

            $vendorwallet = User::where('id', $status->vendor_id)
            ->update(['wallet' => $vendorwallet]);
        }

        $gettimezone=Settings::select('timezone')->first();

        date_default_timezone_set($gettimezone->timezone);

        $data=array('status'=>$request->status,'cancelled_at'=>date('Y-m-d h:i:s'));
        $order=Order::where('user_id',$request->user_id)->where('id',$request->order_id)->update($data);

        if(!empty($order))
        {
            $notification=array('user_id'=>$request->user_id,'order_id'=>$request->order_id,'order_number'=>$status->order_number,'order_status'=>"6",'message'=>"".$status->product_name." has been cancelled by you",'is_read'=>"1",'type'=>"order");
            $store=Notification::create($notification);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }
    
    
     public function trackingorder(Request $request)
    {
        if($request->order_number == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.orderid_required')],400);
        }
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        try {
            $order_info=Order::select('id','product_id','order_number','return_number','vendor_comment','vendor_id','product_name','price','qty','status',
                            \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as created_att'),
                            \DB::raw('DATE_FORMAT(confirmed_at, "%Y-%m-%d %H:%i:%s") as confirmed_att'),
                            \DB::raw('DATE_FORMAT(shipped_at, "%Y-%m-%d %H:%i:%s") as shipped_att'),
                            \DB::raw('DATE_FORMAT(delivered_at, "%Y-%m-%d %H:%i:%s") as delivered_att'),
                            \DB::raw('(case when variation is null then "" else variation end) as variation'),
                            \DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url")
                        )
                    ->where('order_number',$request->order_number)
                    ->where('user_id',$request->user_id)
                    ->first();
            $checkratting = Ratting::select('ratting')
            ->where('product_id',$order_info->product_id)
            ->where('vendor_id',$order_info->vendor_id)
            ->where('user_id',$request->user_id)
            ->count();

            if ($checkratting > 0) {
                $ratting = 1;
            } else {
                $ratting = 0;
            }

            if(!empty($order_info)){
                return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'order_info'=>$order_info,'ratting'=>$ratting],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
            }
        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }
    

    public function trackorder(Request $request)
    {
        if($request->order_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.orderid_required')],400);
        }
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        try {
            $order_info=Order::select('id','product_id','order_number','return_number','vendor_comment','vendor_id','product_name','price','qty','status',
                            \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as created_att'),
                            \DB::raw('DATE_FORMAT(confirmed_at, "%Y-%m-%d %H:%i:%s") as confirmed_att'),
                            \DB::raw('DATE_FORMAT(shipped_at, "%Y-%m-%d %H:%i:%s") as shipped_att'),
                            \DB::raw('DATE_FORMAT(delivered_at, "%Y-%m-%d %H:%i:%s") as delivered_att'),
                            \DB::raw('(case when variation is null then "" else variation end) as variation'),
                            \DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url")
                        )
                    ->where('id',$request->order_id)
                    ->where('user_id',$request->user_id)
                    ->first();
            $checkratting = Ratting::select('ratting')
            ->where('product_id',$order_info->product_id)
            ->where('vendor_id',$order_info->vendor_id)
            ->where('user_id',$request->user_id)
            ->count();

            if ($checkratting > 0) {
                $ratting = 1;
            } else {
                $ratting = 0;
            }

            if(!empty($order_info)){
                return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'order_info'=>$order_info,'ratting'=>$ratting],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
            }
        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }

    public function wallet(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }

        $walletamount=User::select('wallet')->where('id',$request->user_id)->first();

        $transaction_data=Transaction::select('order_number','transaction_type','wallet',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'),'username','type')->where('user_id',$request->user_id)->orderBy('id', 'DESC')->paginate(10);

        if(!empty($transaction_data))
        {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'walletamount'=>$walletamount->wallet,'data'=>$transaction_data],200);
        }   
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function recharge(Request $request)
    {
        $getuserdata=User::select('token','email','name','wallet')->where('id',$request->user_id)->first();
        if(empty($getuserdata)){
            return response()->json(["status"=>0,"message"=>trans('messages.invalid_user')],200);
        }
        if($request->recharge_amount == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.amount_required')],200);
        }
        if($request->payment_type == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.payment_type_required')],200);
        }
        $gettimezone=Settings::select('timezone')->first();
        date_default_timezone_set($gettimezone->timezone);
        try {
            //RazorPay : 3, Stripe : 4, Flutterwave : 5 , Paystack : 6
            if ($request->payment_type != 3 && $request->payment_type != 4 && $request->payment_type != 5 && $request->payment_type != 6) {
                    return response()->json(["status"=>0,"message"=>trans('messages.invalid_request')],200);
            }
            if ($request->payment_type == 3 OR $request->payment_type == 5 OR $request->payment_type == 6) {
                if($request->payment_id == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.payment_id_required')],200);
                }
                $payment_id = $request->payment_id;
            }
            if ($request->payment_type == 4) {
                $getstripe=Payment::select('environment','test_secret_key','live_secret_key')->where('payment_name','Stripe')->first();
                if ($getstripe->environment == "1") {
                    $skey = $getstripe->test_secret_key;
                } else {
                    $skey = $getstripe->live_secret_key;
                }
                if($request->card_number == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_number')],200);
                }
                if($request->card_exp_month == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_exp_month')],200);
                }
                if($request->card_exp_year == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_exp_year')],200);
                }
                if($request->card_cvc == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.card_cvc')],200);
                }
                try {
                    $stripe = new \Stripe\StripeClient($skey);
                    $data = $stripe->tokens->create([
                        'card' => [
                            'number' => $request->card_number,
                            'exp_month' => $request->card_exp_month,
                            'exp_year' => $request->card_exp_year,
                            'cvc' => $request->card_cvc,
                        ],
                    ]);
                    $token = $data->id;
                    Stripe\Stripe::setApiKey($skey);
                    $payment = Stripe\Charge::create ([
                        "amount" => $request->recharge_amount * 100,
                        "currency" => "USD",
                        "source" => $token,
                        "description" => "eCommerce",
                    ]);
                    $payment_id = $payment->id;
                } catch (Exception $e) {
                    return response()->json(['status'=>0,'message'=>trans('messages.unable_to_complete_payment')],200);
                }
            }

            $wallet = new Transaction;
            $wallet->user_id = $request->user_id;
            $wallet->order_id = null;
            $wallet->order_number = null;
            $wallet->wallet = $request->recharge_amount;
            $wallet->payment_id = $payment_id;
            $wallet->transaction_type = '4';
            $wallet->username = $getuserdata->name;
            $wallet->type = $request->payment_type;
            $wallet->save();

            $updatewallet = $getuserdata->wallet + $request->recharge_amount;

            $UpdateWalletDetails = User::where('id', $request->user_id)
            ->update(['wallet' => $updatewallet]);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);

        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }
}
