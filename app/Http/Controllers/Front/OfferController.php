<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons;
use Carbon\Carbon;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::today()->toDateString();

        $coupons=Coupons::select('coupon_name','type','percentage','amount',\DB::raw('DATE_FORMAT(start_date, "%d-%m-%Y") as start_date'),\DB::raw('DATE_FORMAT(end_date, "%d-%m-%Y") as end_date'))
        ->where('status',1)
        ->where('start_date', '<=', $now)
        ->where('end_date', '>=', $now)
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('Front.offers',compact('coupons'));
    }
}
