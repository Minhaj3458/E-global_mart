<?php

namespace App\Http\Controllers\Front;

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
use App\Models\ReturnConditions;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Storage;
use Auth;
use Helper;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $order_number = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);

        $data=Cart::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();

        $getuserdata=User::select('token','email','name','wallet')
        ->where('id',Auth::user()->id)
        ->first();

        $gettimezone=Settings::select('timezone')->first();

        date_default_timezone_set($gettimezone->timezone);

        try {
            //payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5 , Paystack : 6

            if ($request->payment_type == 3 OR $request->payment_type == 5 OR $request->payment_type == 6) {
                $payment_id = $request->payment_id;
            }

            if ($request->payment_type == 4) {
                $getstripe=Payment::select('environment','test_secret_key','live_secret_key')->where('payment_name','Stripe')->first();

                if ($getstripe->environment == "1") {
                    $skey = $getstripe->test_secret_key;
                } else {
                    $skey = $getstripe->live_secret_key;
                }

                Stripe::setApiKey($skey);

                $customer = Customer::create(array(
                    'email' => $request->email,
                    'source' => $request->stripeToken,
                    'name' => $request->full_name,
                ));

                $charge = Charge::create(array(
                    'customer' => $customer->id,
                    'amount' => $request->grand_total*100,
                    'currency' => 'usd',
                    'description' => 'eCommerce',
                ));

                $payment_id = $charge['id'];
            }

            foreach ($data as $key => $value) {
                $OrderPro = new Order;
                $OrderPro->user_id = Auth::user()->id;
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

                $OrderPro->discount_amount = $request->discount_amount;
                $OrderPro->save();
            }
            $order_id = \DB::getPdo()->lastInsertId();

            if ($request->payment_type == 2) {

                $order_info=Order::select(\DB::raw('(case when discount_amount is null then SUM(order_total) else SUM(order_total)-discount_amount end) as grand_total'))
                ->where('order_number',$order_number)
                ->groupBy('order_number')
                ->first();

                $wallet = $getuserdata->wallet - $order_info->grand_total;

                $UpdateWalletDetails = User::where('id', Auth::user()->id)->update(['wallet' => $wallet]);

                $Wallet = new Transaction;
                $Wallet->user_id = Auth::user()->id;
                $Wallet->order_id = $order_id;
                $Wallet->order_number = $order_number;
                $Wallet->wallet = $order_info->grand_total;
                $Wallet->payment_id = NULL;
                $Wallet->transaction_type = '2';
                $Wallet->save();
            }

            $cart=Cart::where('user_id', Auth::user()->id)->delete();

            $count=Cart::where('user_id',Auth::user()->id)->count();
            Storage::disk('local')->put("cart", $count);
            Storage::disk('local')->delete("promo");

            $notification=array('user_id'=>Auth::user()->id,'order_id'=>$order_id,'order_number'=>$order_number,'order_status'=>"1",'message'=>"Order ".$order_number." has been placed",'is_read'=>"1",'type'=>"order");
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
                $UpdateWalletDetails = User::where('id', $request->vendor_id)->update(['wallet' => $vendorwallet]);
            }
            return response()->json(['status'=>1,'message'=>'Order has been placed'],200);
        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }

    public function orderhistory(Request $request)
    {
        $user_id  = @Auth::user()->id;

        $orderdata=Order::select('id','order_number','payment_type','status',\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('(case when discount_amount is null then SUM(price*qty)+SUM(tax)+SUM(shipping_cost) else SUM(price*qty)+SUM(tax)+SUM(shipping_cost)-SUM(discount_amount) end) as grand_total'))
        ->where('user_id',$user_id)
        ->groupBy('order_number')
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('Front.order-history',compact('orderdata'));
    }

    public function orderdetails(Request $request)
    {
        $user_id  = @Auth::user()->id;
        $orderdata=Order::select('id','product_id','product_name','slug','qty','discount_amount','price','attribute','status','variation','tax','shipping_cost',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('order_number',$request->id)
        ->where('user_id',$user_id)
        ->orderBy('id', 'DESC')
        ->get();

        $order_info=Order::select('order_number','order_notes','payment_type','full_name','email','mobile','landmark','street_address','pincode','coupon_name','order_total','discount_amount','status',\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('SUM(price*qty) AS subtotal'),\DB::raw('SUM(tax) AS tax'),\DB::raw('SUM(shipping_cost) AS shipping_cost'))
        ->where('order_number',$request->id)
        ->where('user_id',$user_id)
        ->groupBy('order_number')
        ->first();

        if (@$order_info->discount_amount == "") {
            $grand_total = @$order_info->subtotal+@$order_info->tax+@$order_info->shipping_cost;
        } else {
            $grand_total = @$order_info->subtotal+@$order_info->tax+@$order_info->shipping_cost-@$order_info->discount_amount;
        }

        $order_infos = array(
            'order_number' => @$order_info->order_number, 
            'order_notes' => @$order_info->order_notes, 
            'payment_type' => @$order_info->payment_type, 
            'full_name' => @$order_info->full_name, 
            'email' => @$order_info->email, 
            'mobile' => @$order_info->mobile, 
            'landmark' => @$order_info->landmark, 
            'street_address' => @$order_info->street_address, 
            'pincode' => @$order_info->pincode, 
            'coupon_name' => @$order_info->coupon_name, 
            'discount_amount' => @$order_info->discount_amount, 
            'status' => @$order_info->status, 
            'date' => @$order_info->date, 
            'subtotal' => @$order_info->subtotal, 
            'tax' => @$order_info->tax, 
            'shipping_cost' => number_format(@$order_info->shipping_cost,2), 
            'grand_total' => $grand_total
        );

        $returnconditions=ReturnConditions::select('return_conditions')->get();

        return view('Front.order-details',compact('order_infos','orderdata','returnconditions'));
    }

    public function cancelorder(Request $request)
    {
        
        $status=Order::select('orders.order_total','orders.payment_id','orders.user_id','orders.vendor_id','orders.payment_type','orders.user_id','orders.order_number')
        ->join('users','orders.user_id','=','users.id')
        ->where('orders.id',$request->id)
        ->first();

        if ($status->payment_type != "1") {
            $walletdata=User::select('wallet')->where('id',$status->user_id)->first();

            if ($walletdata->wallet > 0) {
                $amount = $walletdata->wallet;
            } else {
                $amount = 0;
            }
            
            $wallet = $amount + $status->order_total;

            $UpdateWalletDetails = User::where('id', $status->user_id)
            ->update(['wallet' => $wallet]);

            $Wallet = new Transaction;
            $Wallet->user_id = $status->user_id;
            $Wallet->order_id = $request->id;
            $Wallet->order_number = $status->order_number;
            $Wallet->wallet = $status->order_total;
            $Wallet->payment_id = $status->payment_id;
            $Wallet->transaction_type = '1';
            $Wallet->type = 'cancel-order';
            $Wallet->save();
        }

        $gettimezone=Settings::select('timezone')->first();

        date_default_timezone_set($gettimezone->timezone);

        $data=array('status'=>6,'cancelled_at'=>date('Y-m-d h:i:s'));
        $order=Order::where('user_id',Auth::user()->id)->where('id',$request->id)->update($data);

        if(!empty($order))
        {
            $notification=array('user_id'=>Auth::user()->id,'order_id'=>$request->id,'order_number'=>$status->order_number,'order_status'=>"6",'message'=>"Order ".$status->order_number." has been cancelled by you",'is_read'=>"1",'type'=>"order");
            $store=Notification::create($notification);

            $getvendordata = Helper::UpdateVendorWallet($request->id,$status->vendor_id);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }

    public function returnrequest(Request $request)
    {
        $info=Order::select('product_name','order_number')
        ->where('id',$request->id)
        ->first();

        $gettimezone=Settings::select('timezone')->first();

        date_default_timezone_set($gettimezone->timezone);

        $return_number = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);

        $data=array('return_reason'=>$request->return_reason,'comment'=>$request->comment,'status'=>$request->status,'return_number'=>$return_number,'returned_at'=>date('Y-m-d h:i:s'));
        $order=Order::where('user_id',Auth::user()->id)->where('id',$request->id)->update($data);

        if(!empty($order))
        {
            $notification=array('user_id'=>Auth::user()->id,'order_id'=>$request->id,'order_number'=>$info->order_number,'order_status'=>$request->status,'message'=>"Return request for ".$info->product_name." has been raised",'is_read'=>"1",'type'=>"order");
            $store=Notification::create($notification);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }

    public function trackorder(Request $request)
    {
        $user_id  = @Auth::user()->id;
        
        $order_info=Order::select('id','product_id','order_number','vendor_id','product_name','vendor_comment','slug','price','qty','status','created_at','confirmed_at','shipped_at','delivered_at','attribute',\DB::raw('(case when variation is null then "" else variation end) as variation'),\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('id',$request->id)
        ->where('user_id',$user_id)
        ->first();
        
        $checkratting = Ratting::select('ratting')
        ->where('product_id',@$order_info->product_id)
        ->where('vendor_id',@$order_info->vendor_id)
        ->where('user_id',$user_id)
        ->count();

        if ($checkratting > 0) {
            $ratting = 1;
        } else {
            $ratting = 0;
        }

        return view('Front.track-order',compact('order_info','ratting'));
    }

    public function wallet(Request $request)
    {
        if(Auth::user()->id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to save address"],400);
        }

        $walletamount=User::select('wallet')->where('id',Auth::user()->id)->first();

        $transaction_data=Transaction::select('order_number','transaction_type','wallet',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'),'username')->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);

        if(!empty($transaction_data))
        {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'walletamount'=>$walletamount->wallet,'data'=>$transaction_data],200);
        }   
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public static function success(Request $request)
    {

        $order_info=Order::select('id','order_number')
        ->where('user_id',Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->groupBy('order_number')
        ->first();

        return view('Front.success',compact('order_info'));
    }
}
