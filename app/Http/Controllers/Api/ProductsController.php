<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\User;
use App\Models\Banner;
use DB;

class ProductsController extends Controller
{
    public function viewalllisting(Request $request)
    {
        $user_id  = $request->user_id;

        if ($request->type == "featured_products") {
            $featured_products=Products::with(['productimage','variation','rattings'])
            ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
            ->leftJoin('wishlists', function($query) use($user_id) {
                $query->on('wishlists.product_id','=','products.id')
                ->where('wishlists.user_id', '=', $user_id);
            })
            ->join('users','products.vendor_id','=','users.id')
            ->where('users.is_available','1')
            ->where('products.is_featured','1')
            ->where('products.status','1')
            ->orderBy('products.id', 'DESC')
            ->paginate(10);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$featured_products],200);
        }

        if ($request->type == "hot_products") {
            $hot_products=Products::with(['productimage','variation','rattings'])
            ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
            ->leftJoin('wishlists', function($query) use($user_id) {
                $query->on('wishlists.product_id','=','products.id')
                ->where('wishlists.user_id', '=', $user_id);
            })
            ->join('users','products.vendor_id','=','users.id')
            ->where('products.is_hot','1')
            ->where('products.status','1')
            ->orderBy('products.id', 'DESC')
            ->paginate(10);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$hot_products],200);
        }

        if ($request->type == "new_products") {
            $new_products=Products::with(['productimage','variation','rattings'])
            ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
            ->leftJoin('wishlists', function($query) use($user_id) {
                $query->on('wishlists.product_id','=','products.id')
                ->where('wishlists.user_id', '=', $user_id);
            })
            ->join('users','products.vendor_id','=','users.id')
            ->where('users.is_available','1')
            ->where('products.status','1')
            ->orderBy('products.id', 'ASC')
            ->paginate(10);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$new_products],200);
        }

        if ($request->type == "vendors") {
            $vendors=User::select('id','name',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', profile_pic) AS image_url"))
            ->where('type','3')
            ->where('is_available','1')
            ->orderBy('id', 'DESC')
            ->paginate(10);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$vendors],200);
        }

        if ($request->type == "brands") {
            $brands=Brand::select('id','brand_name',\DB::raw("CONCAT('".url('/storage/app/public/images/brand/')."/', icon) AS image_url"))
            ->where('status','1')
            ->orderBy('id', 'DESC')
            ->paginate(10);

            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$brands],200);
        }

    }

    public function productdetails(Request $request)
    {
        if($request->product_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.product_required')],400);
        }

        $user_id  = $request->user_id;

        $product=Products::with(['productimages','variations','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.cat_id','products.discounted_price','products.description','products.product_qty','products.is_variation','products.vendor_id','products.sku','products.free_shipping','products.shipping_cost','products.tax_type','products.tax','products.est_shipping_days','products.is_return','products.return_days',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),'categories.category_name','subcategories.subcategory_name','innersubcategories.innersubcategory_name','attributes.attribute')
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('categories','products.cat_id','=','categories.id')
        ->join('subcategories','products.subcat_id','=','subcategories.id')
        ->leftjoin('attributes','products.attribute','=','attributes.id')
        ->join('innersubcategories','products.innersubcat_id','=','innersubcategories.id')
        ->join('users','products.vendor_id','=','users.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.id',$request->product_id)
        ->first();

        if(!empty($product))
        {
            $vendors=User::with('rattings')->select('users.id','users.name',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', users.profile_pic) AS image_url"))
            ->where('users.type','3')
            ->where('users.is_available','1')
            ->where('users.id',$product->vendor_id)
            ->first();
            
            $related_products=Products::with(['productimage','variation','rattings'])
            ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
            ->leftJoin('wishlists', function($query) use($user_id) {
                $query->on('wishlists.product_id','=','products.id')
                ->where('wishlists.user_id', '=', $user_id);
            })
            ->join('users','products.vendor_id','=','users.id')
            ->where('products.status','1')
            ->where('products.cat_id', $product->cat_id)
            ->where('products.id','!=',$request->product_id)
            ->orderBy('products.id', 'DESC')
            ->get()->take(10);

            $returnpolicy=User::select('return_policies')->where('id',$product->vendor_id)->first();
            if(!empty($returnpolicy->return_policies)){
                $returnpolicy = $returnpolicy;
            }else{
                $returnpolicy->return_policies = "";
            }
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$product,'vendors'=>$vendors,'related_products'=>$related_products,'returnpolicy'=>$returnpolicy],200);
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function vendorproducts(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_required')],400);
        }

        $user_id  = $request->user_id;

        $products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
                    $query->on('wishlists.product_id','=','products.id')
                    ->where('wishlists.user_id', '=', $user_id);
                })
        ->join('users','products.vendor_id','=','users.id')
        ->orderBy('products.id', 'DESC')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.vendor_id',$request->vendor_id)
        ->paginate(10);

        $vendordetails=User::with(['rattings'])->select('mobile','email','store_address','id')
        ->where('type','3')
        ->where('is_available','1')
        ->where('id',$request->vendor_id)
        ->first();

        $getbanners = Banner::select('id',\DB::raw("CONCAT('".url('/storage/app/public/images/banner/')."/', image) AS image_url"))->where('vendor_id',$request->vendor_id)->where('positions','store')->get();

        if(count($products) > 0)
        {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$products,'vendordetails'=>$vendordetails,'banners'=>$getbanners],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function products(Request $request)
    {
        if($request->innersubcategory_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.category_required')],400);
        }

        $user_id  = $request->user_id;

        $products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
                    $query->on('wishlists.product_id','=','products.id')
                    ->where('wishlists.user_id', '=', $user_id);
                })
        ->join('users','products.vendor_id','=','users.id')
        ->orderBy('products.id', 'DESC')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.innersubcat_id',$request->innersubcategory_id)
        ->paginate(10);

        if(count($products) > 0)
        {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$products],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function searchproducts(Request $request)
    {
        $user_id  = $request->user_id;

        $products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.tags','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->orderBy('products.id', 'DESC')
        ->get();
        
        if(!$products->isEmpty())
        {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$products],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function filter(Request $request) {

        if($request->type == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.filter_type_required')],400);
        }

        $user_id  = $request->user_id;
        $products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.status','1');

        if($request->has('product')){
            if($request->product == "featured_products"){
                $products = $products->where('products.is_featured','=',1);
            }
            if($request->product == "hot_products"){
                $products = $products->where('products.is_hot','=',1);
            }
        }
        if($request->has('type')){
            if ($request->type == "new") {
                $products = $products->orderByDesc('products.id');
            }
            if ($request->type == "price-high-to-low"){
                $products = $products->orderByDesc('products.product_price');
            }
            if ($request->type == "price-low-to-high"){
                $products = $products->orderBy('products.product_price');
            }
            if($request->type == "ratting-high-to-low"){
                $products = $products->orderByDesc('ratings_average');
            }
            if($request->type == "ratting-low-to-high"){
                $products = $products->orderBy('ratings_average');
            }
        }
        
        $products=$products->paginate(12);
        
        if(!$products->isEmpty())
        {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$products],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }
}
