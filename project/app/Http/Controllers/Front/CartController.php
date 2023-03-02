<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupons;
use App\Models\Address;
use App\Models\Payment;
use Carbon\Carbon;
use Storage;
use Helper;
use Auth;

class CartController extends Controller
{
    public function addtocart(Request $request)
    {
        $data=Cart::where('user_id',$request->user_id)->get();
        
        if(count($data) == 0) {
            $dataval=array('user_id'=>$request->user_id,'product_id'=>$request->product_id,'vendor_id'=>$request->vendor_id,'product_name'=>$request->product_name,'image'=>$request->image,'qty'=>$request->qty,'price'=>$request->price,'variation'=>$request->variation,'attribute'=>$request->attribute,'tax'=>$request->tax,'shipping_cost'=>$request->shipping_cost,'slug'=>$request->slug);
            $cartdata=Cart::create($dataval);

            $count=Cart::where('user_id',Auth::user()->id)->count();
            Storage::disk('local')->put("cart", $count);

            if($cartdata)
            {
                return response()->json(['status'=>1,'message'=>$request->product_name .' has been added to your cart'],200);
            }
            else
            {
                return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
            }
        } else {

            $checkcart=Cart::where('user_id',$request->user_id)->first();

            if (@$checkcart->vendor_id != $request->vendor_id && @$checkcart->user_id == $request->user_id) {
                return response()->json(["status"=>0,"message"=>trans('messages.clear_cart_note')],200);
            } else {
                $dataval=array('user_id'=>$request->user_id,'product_id'=>$request->product_id,'vendor_id'=>$request->vendor_id,'product_name'=>$request->product_name,'image'=>$request->image,'qty'=>$request->qty,'price'=>$request->price,'variation'=>$request->variation,'attribute'=>$request->attribute,'tax'=>$request->tax,'shipping_cost'=>$request->shipping_cost,'slug'=>$request->slug);
                $cartdata=Cart::create($dataval);

                $count=Cart::where('user_id',Auth::user()->id)->count();
                Storage::disk('local')->put("cart", $count);
                if($cartdata)
                {
                    return response()->json(['status'=>1,'message'=>$request->product_name .' has been added to your cart'],200);
                }
                else
                {
                    return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
                }
            }
        }
    }

    public static function getcart(Request $request)
    {
        $user_id  = @Auth::user()->id;

        $cart=Cart::select('id','product_id','product_name','slug','qty','price','attribute','variation','tax','shipping_cost',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('user_id', $user_id)
        ->orderBy('id', 'DESC')
        ->get();

        return view('Front.cart',compact('cart'));
    }

    public function qtyupdate(Request $request)
    {
        if($request->cart_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.cart_id_required')],200);
        }
        if($request->qty == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.qty_required')],200);
        }

        $cartdata=Cart::where('id', $request->cart_id)->get()->first();

        if ($request->type == "decreaseValue") {
            $qty = $cartdata->qty-1;
        } else {
            $qty = $cartdata->qty+1;
        }

        $update=Cart::where('id',$request['cart_id'])->update(['qty'=>$qty]);
        $remove=Storage::disk('local')->delete("promo");
        return response()->json(['status'=>1,'message'=>trans('messages.update')],200);
    }

    public function delete(Request $request)
    {
        if($request->id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.cart_id_required')],200);
        }

        $cart=Cart::where('id', $request->id)->delete();

        $count=Cart::where('user_id',Auth::user()->id)->count();
        Storage::disk('local')->put("cart", $count);

        if($cart)
        {
            return response()->json(['status'=>1,'message'=>trans('messages.success'),'cartcnt'=>$count],200);
        }
        else
        {
            return response()->json(['status'=>0],200);
        }
    }

    public function applypromocode(Request $request)
    {
        $orderdata=Order::select('coupon_name','user_id')->where('user_id',Auth::user()->id)->count();

        $coupons=Coupons::select('quantity','times','end_date','coupon_name','type','percentage','amount','min_amount')
        ->where('status',1)
        ->where('coupon_name', $request->coupon_name)
        ->first();

        $now = Carbon::today()->toDateString();

        if ($request->coupon_name != "") {
            if (@$coupons->end_date >= $now) {
                if ($coupons->quantity == 1) {
                    if ($orderdata > $coupons->times) {
                        return response()->json(['status'=>0,'message'=>trans('messages.coupon_usage_limit_reached')],200);
                    } else {
                        if($request->final_sub_total > $coupons->min_amount){
                            Storage::disk('local')->put("promo", $coupons);
                            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
                        }else{
                            return response()->json(['status'=>0,'message'=>trans('messages.subtotal_should_more_then').' '.Helper::CurrencyFormatter($coupons->min_amount)],200);
                        }
                    }
                } else {
                    if($request->final_sub_total > $coupons->min_amount){
                        Storage::disk('local')->put("promo", $coupons);
                        return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
                    }else{
                        return response()->json(['status'=>0,'message'=>trans('messages.subtotal_should_more_then').' '.Helper::CurrencyFormatter($coupons->min_amount)],200);
                    }
                }
            } else{
                return response()->json(['status'=>0,'message'=>trans('messages.invalid_coupon')],200);
            }
        }
    }

    public function removepromocode()
    {
        $remove=Storage::disk('local')->delete("promo");

        if($remove) {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        } else {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }

    public static function checkout(Request $request)
    {

        $user_id  = @Auth::user()->id;

        $cart=Cart::select('id','product_id','vendor_id','product_name','qty','price','attribute','variation','tax','shipping_cost',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('user_id', $user_id)
        ->orderBy('id', 'DESC')
        ->get();

        $addressdata=Address::where('user_id',$user_id)->get();

        $paymentlist=Payment::where('status','1')->get();

        return view('Front.checkout',compact('cart','addressdata','paymentlist'));
    }
}
