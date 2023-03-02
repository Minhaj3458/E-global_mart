<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ratting;

class RattingController extends Controller
{
    public function addratting(Request $request)
    {
        $checkratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('vendor_id',$request->vendor_id)->where('user_id',$request->user_id)->get();
        if (count($checkratting) > 0) {
            return redirect()->back()->with('danger',trans('messages.ratting_exist'));
        } else {
            $ratting = new Ratting();
            $ratting->vendor_id = $request->vendor_id
            $ratting->product_id = $request->product_id
            $ratting->user_id = $request->user_id
            $ratting->ratting = $request->ratting
            $ratting->comment = $request->comment
            if($ratting->save()){
                return redirect()->back()->with('success', trans('messages.success'));
            }else{
                return redirect()->back()->with('danger', trans('messages.fail'));
            }
        }        
    }

    public function productreview(Request $request)
    {
        if($request->product_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.invalid_product')],400);
        }

        $avg_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->get();
        $five_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','5')->get();
        $four_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','4')->get();
        $three_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','3')->get();
        $two_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','2')->get();
        $one_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','1')->get();

        $all_review = Ratting::with(['users'])->select('rattings.user_id','rattings.ratting','rattings.comment',\DB::raw('DATE_FORMAT(rattings.created_at, "%d-%m-%Y") as date'))->where('product_id',$request->product_id)->paginate(10);

        $rattings = array(
            'avg_ratting' => number_format($avg_ratting->avg('ratting'),1),
            'total' => count($avg_ratting),
            'five_ratting' => count($five_ratting),
            'four_ratting' => count($four_ratting),
            'three_ratting' => count($three_ratting),
            'two_ratting' => count($two_ratting),
            'one_ratting' => count($one_ratting),
        );

        if(!empty($rattings)){
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'reviews'=>$rattings,'all_review'=>$all_review],200);
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }
}
