<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupons;
use Carbon\Carbon;
use Helper;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }

        $orderdata=Order::select('coupon_name','user_id')->where('user_id',$request->user_id)->count();

        $coupons=Coupons::select('quantity','times','end_date','coupon_name','type','percentage','amount','min_amount')
        ->where('status',1)
        ->where('coupon_name', $request->coupon_name)
        ->first();
        $now = Carbon::today()->toDateString();

        $cartdata=Cart::select('id','product_id','vendor_id','product_name','qty','price','attribute','variation','tax','shipping_cost',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('user_id', $request->user_id)
        ->orderBy('id', 'DESC')
        ->get();

        $final_sub_total = 0;
        $final_tax = 0;
        $final_shipping_cost = 0;
        $final_grand_total = 0;
        $vendor_id = 0;

        foreach ($cartdata as $value) {
            $discount_amount = 0;
            
            $cdata[] = array(
                'id' => $value['id'], 
                'product_id' => $value['product_id'],
                'product_name' => $value['product_name'], 
                'vendor_id' => $value['vendor_id'], 
                'qty' => $value['qty'],
                'price' => $value['price'],
                'attribute' => $value['attribute'],
                'variation' => $value['variation'],
                'tax' => $value['tax']*$value['qty'],
                'shipping_cost' => $value['shipping_cost'],
                'image_url' => $value['image_url'],
                'discount_amount' => @$discount_amount,
                'total' => $value['qty']*$value['price']+$value['tax']*$value['qty']+$value['shipping_cost'],
            );
 
            $vendor_id = $value['vendor_id'];
            $sub_total = $value['price']*$value['qty'];
            $final_sub_total += $sub_total;

            $tax = $value['qty']*$value['tax'];
            $final_tax += $tax;

            $shipping_cost = $value['shipping_cost'];
            $final_shipping_cost += $shipping_cost;

            $grand_total = $sub_total + $tax + $shipping_cost;
            $final_grand_total += $grand_total;
        }

        if ($request->coupon_name != "") {
            if (@$coupons->end_date >= $now) {
                if ($coupons->quantity == 1) {
                    if ($orderdata > $coupons->times) {
                        return response()->json(['status'=>0,'message'=>trans('messages.coupon_usage_limit_reached')],200);
                    } else {
                        if ($coupons->type == "1") {
                            if ($final_sub_total > $coupons->min_amount) {
                                $discount_amount = $coupons->amount;
                            } else {
                                return response()->json(['status'=>0,'message'=>trans('messages.subtotal_should_more_then'). Helper::CurrencyFormatter($coupons->min_amount)],200);
                            }
                        }
                        if ($coupons->type == "0") {
                            if ($final_sub_total > $coupons->min_amount) {
                                $discount_amount = $final_sub_total*$coupons->percentage/100;
                            } else {
                                return response()->json(['status'=>0,'message'=>trans('messages.subtotal_should_more_then'). Helper::CurrencyFormatter($coupons->min_amount)],200);
                            }
                        }
                    }
                } else {
                    if ($coupons->type == "1") {
                        if ($final_sub_total > $coupons->min_amount) {
                            $discount_amount = $coupons->amount;
                        } else {
                            return response()->json(['status'=>0,'message'=>trans('messages.subtotal_should_more_then'). Helper::CurrencyFormatter($coupons->min_amount)],200);
                        }
                    }

                    if ($coupons->type == "0") {
                        if ($final_sub_total > $coupons->min_amount) {
                            $discount_amount = $final_sub_total*$coupons->percentage/100;
                        } else {
                            return response()->json(['status'=>0,'message'=>trans('messages.subtotal_should_more_then'). Helper::CurrencyFormatter($coupons->min_amount)],200);
                        }
                    }
                }
            } else{
                return response()->json(['status'=>0,'message'=>trans('messages.invalid_coupon')],200);
            }
        }

        $data = array(
            'vendor_id' => $vendor_id,
            'subtotal' => $final_sub_total,
            'tax' => $final_tax,
            'shipping_cost' => $final_shipping_cost,
            'discount_amount' => @$discount_amount,
            'grand_total' => $final_grand_total-@$discount_amount,
        );

        if(!empty($cdata)){
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$data,'cartdata'=>$cdata,'coupon_name'=>@$coupons->coupon_name],200);
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }
}
