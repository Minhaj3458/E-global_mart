<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Products;
use DB;

class BrandController extends Controller
{
    public function index()
    {
        $brands=Brand::select('id','brand_name',\DB::raw("CONCAT('".url('/storage/app/public/images/brand/')."/', icon) AS image_url"))
        ->where('status','1')
        ->orderBy('id', 'DESC')
        ->paginate(30);

        return view('Front.all-brand',compact('brands'));
    }

    public function brandsproducts(Request $request)
    {
        $user_id  = $request->user_id;

        $products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.brand','products.discounted_price','products.slug','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
                    $query->on('wishlists.product_id','=','products.id')
                    ->where('wishlists.user_id', '=', $user_id);
                })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->orderBy('products.id', 'DESC')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.brand',$request->id)
        ->paginate(30);

        return view('Front.brands',compact('products'));
    }
}
