<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Innersubcategory;
use App\Models\Products;
use App\Models\Ratting;
use App\Models\User;
use App\Models\Settings;
use Auth;
use DB;
use URL;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $user_id  = @Auth::user()->id;
        $product=Products::with(['productimage','variations','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.cat_id','products.discounted_price','products.description','products.product_qty','products.is_variation','products.vendor_id','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),'categories.category_name','subcategories.subcategory_name','innersubcategories.innersubcategory_name')
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('categories','products.cat_id','=','categories.id')
        ->join('subcategories','products.subcat_id','=','subcategories.id')
        ->join('innersubcategories','products.innersubcat_id','=','innersubcategories.id')
        ->join('users','products.vendor_id','=','users.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.id',$request->product_id)
        ->first();

        return response()->json(['ResponseCode' => 1, 'ResponseText' => trans('messages.successfull'), 'ResponseData' => $product], 200);
    }

    public function featured(Request $request)
    {

        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.is_featured','1')
        ->where('products.status','1')
        ->paginate(30);

        return view('Front.featured-products',compact('products'));
    }

    public function hot(Request $request)
    {

        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.is_hot','1')
        ->where('products.status','1')
        ->paginate(30);

        return view('Front.hot-products',compact('products'));
    }

    public function new(Request $request)
    {

        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->orderBy('products.id', 'DESC')
        ->paginate(30);

        return view('Front.new-products',compact('products'));
    }

    public function search(Request $request)
    {
        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.product_name','LIKE','%' . $request->item . '%')
        ->orWhere('products.tags','LIKE','%' . $request->item . '%')
        ->orderBy('products.id', 'DESC')
        ->paginate(30);

        return view('Front.search',compact('products'));
    }

    public function filter(Request $request) {
        
        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.status','1');

        if($request->has('brand') && $request->brand != ""){ 
            $products->where('products.brand',$request->brand);
        }
        if ($request->type == "featured" OR $request->value == "featured") {
            $products->where('products.is_featured','1');
        }
        if ($request->type == "hot" OR $request->value == "hot") {
            $products->where('products.is_hot','1');
        }
        if ($request->type == "search") {
            $products->where('products.product_name','LIKE','%' . $request->item . '%');
            $products->orWhere('products.tags','LIKE','%' . $request->item . '%');
        }
        if ($request->value == "new") {
            $products->orderBy('products.id', 'DESC');
        }
        if ($request->value == "price-high-to-low") {
            $products->orderBy('products.product_price', 'DESC');
        }
        if ($request->value == "price-low-to-high") {
            $products->orderBy('products.product_price', 'ASC');
        }
        if($request->value == "ratting-high-to-low"){
            $products = $products->orderByDesc('ratings_average');
        }
        if($request->value == "ratting-low-to-high"){
            $products = $products->orderBy('ratings_average');
        }
        $products=$products->paginate(30);

        if ($request->ajax()) {
            $view = view('Front.filterproduct',compact('products'))->render();
            return response()->json(['ResponseData'=>$view,'getitem'=>$products]);
        }
        return view('Front.filterproduct', compact('products'));
    }

    public function categories()
    {
        return view('Front.categories');
    }

    public function categoriesproducts(Request $request)
    {
        $categories=Category::select('id','category_name','slug',\DB::raw("CONCAT('".url('/storage/app/public/images/category/')."/', icon) AS image"))
        ->where('slug',$request->slug)
        ->get();

        $subcategory=Subcategory::select('id','cat_id','slug','subcategory_name')
        ->get();

        $innersubcategory=array();

        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->join('categories','products.cat_id','=','categories.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('categories.slug',$request->slug)
        ->orderBy('products.id','DESC')
        ->paginate(12);

        $type = "category";
        $slug = $request->slug;

        $breadcrumbs=Category::select('category_name')
        ->where('slug',$slug)
        ->first();

        return view('Front.products',compact('categories','subcategory','innersubcategory','products','type','slug','breadcrumbs'));
    }

    public function subcategoryproducts(Request $request)
    {
        $categories=Category::select('categories.id','categories.category_name','categories.slug')
        ->join('subcategories','categories.id','=','subcategories.cat_id')
        ->where('subcategories.slug',$request->slug)
        ->get();

        $subcategory=Subcategory::select('id','cat_id','slug','subcategory_name')
        ->where('slug',$request->slug)
        ->get();

        $innersubcategory=Innersubcategory::select('innersubcategories.id','innersubcategories.subcat_id','innersubcategories.innersubcategory_name','innersubcategories.slug')
        ->join('subcategories','innersubcategories.subcat_id','=','subcategories.id')
        ->where('subcategories.slug',$request->slug)
        ->get();

        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->join('categories','products.cat_id','=','categories.id')
        ->join('subcategories','products.subcat_id','=','subcategories.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('categories.slug',$request->category)
        ->where('subcategories.slug',$request->slug)
        ->orderBy('products.id','DESC')
        ->paginate(12);

        $type = "subcategory";
        $categoryslug = $request->category;
        $slug = $request->slug;

        $breadcrumbs=Category::select('categories.category_name','subcategories.subcategory_name')
        ->join('subcategories','categories.id','=','subcategories.cat_id')
        ->where('subcategories.slug',$slug)
        ->first();

        return view('Front.products',compact('categories','subcategory','innersubcategory','products','type','categoryslug','slug','breadcrumbs'));
    }

    public function innersubcategoryproducts(Request $request)
    {
        $categories=Category::select('categories.id','categories.category_name','categories.slug')
        ->join('innersubcategories','categories.id','=','innersubcategories.cat_id')
        ->where('innersubcategories.slug',$request->slug)
        ->get();

        $subcategory=Subcategory::select('subcategories.id','subcategories.cat_id','subcategories.slug','subcategories.subcategory_name')
        ->join('innersubcategories','subcategories.id','=','innersubcategories.subcat_id')
        ->where('innersubcategories.slug',$request->slug)
        ->get();

        $innersubcategory=Innersubcategory::select('id','subcat_id','innersubcategory_name','slug')
        ->where('slug',$request->slug)
        ->get();

        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->join('categories','products.cat_id','=','categories.id')
        ->join('subcategories','products.subcat_id','=','subcategories.id')
        ->join('innersubcategories','products.innersubcat_id','=','innersubcategories.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('categories.slug',$request->category)
        ->where('subcategories.slug',$request->subcategory)
        ->where('innersubcategories.slug',$request->slug)
        ->orderBy('products.id', 'DESC')
        ->paginate(12);

        $type = "innersubcategory";
        $slug = $request->slug;
        $categoryslug = $request->category;
        $subcategoryslug = $request->subcategory;

        $breadcrumbs=Category::select('categories.category_name','subcategories.subcategory_name','innersubcategories.innersubcategory_name')
        ->join('innersubcategories','categories.id','=','innersubcategories.cat_id')
        ->join('subcategories','innersubcategories.subcat_id','=','subcategories.id')
        ->where('innersubcategories.slug',$request->slug)
        ->first();

        return view('Front.products',compact('categories','subcategory','innersubcategory','products','type','slug','categoryslug','subcategoryslug','breadcrumbs'));
    }

    public function productfilter(Request $request) {

        $user_id  = @Auth::user()->id;
        $products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id');
        $products=$products->where('users.is_available','1');
        $products=$products->where('products.status','1');
    
        if ($request->type == "category") {
            $products=$products->join('categories','products.cat_id','=','categories.id');
            $products=$products->where('categories.slug',$request->slug);
        }

        if ($request->type == "subcategory") {
            $products=$products->join('categories','products.cat_id','=','categories.id');
            $products=$products->join('subcategories','products.subcat_id','=','subcategories.id');
            $products=$products->join('innersubcategories','products.innersubcat_id','=','innersubcategories.id');
            $products=$products->where('categories.slug',$request->categoryslug);
            $products=$products->where('subcategories.slug',$request->slug);            
        }

        if ($request->type == "innersubcategory") {
            $products=$products->join('categories','products.cat_id','=','categories.id');
            $products=$products->join('subcategories','products.subcat_id','=','subcategories.id');
            $products=$products->join('innersubcategories','products.innersubcat_id','=','innersubcategories.id');
            $products=$products->where('categories.slug',$request->categoryslug);
            $products=$products->where('subcategories.slug',$request->subcategoryslug);
            $products=$products->where('innersubcategories.slug',$request->slug);
        }

        if ($request->value == "new") {
            $products=$products->orderBy('products.id', 'DESC');
        }
        if ($request->value == "price-high-to-low") {
            $products=$products->orderBy('products.product_price', 'DESC');
        }
        if ($request->value == "price-low-to-high") {
            $products=$products->orderBy('products.product_price', 'ASC');
        }
        if($request->value == "ratting-high-to-low"){
            $products = $products->orderByDesc('ratings_average');
        }
        if($request->value == "ratting-low-to-high"){
            $products = $products->orderBy('ratings_average');
        }
        $products=$products->paginate(12);

        if ($request->ajax()) {
            $view = view('Front.categoryfilterproduct',compact('products'))->render();
            return response()->json(['ResponseData'=>$view,'getitem'=>$products]);
        }

        return view('Front.categoryfilterproduct', compact('products'));
    }

    public function productdetails(Request $request)
    {

        $user_id  = @Auth::user()->id;
        $product=Products::with(['productimages','variations','rattings','reviews'])
        ->select('products.id','products.product_name','products.slug','products.product_price','products.cat_id','products.discounted_price','products.description','products.product_qty','products.tax','products.tax_type','products.is_return','products.est_shipping_days','products.is_variation','products.attribute','products.vendor_id','products.shipping_cost','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),'categories.category_name','subcategories.subcategory_name','innersubcategories.innersubcategory_name','attributes.attribute')
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->leftjoin('attributes','products.attribute','=','attributes.id')
        ->join('categories','products.cat_id','=','categories.id')
        ->join('subcategories','products.subcat_id','=','subcategories.id')
        ->join('innersubcategories','products.innersubcat_id','=','innersubcategories.id')
        ->join('users','products.vendor_id','=','users.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.slug',$request->slug)
        ->first();

        $related_products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.is_hot','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('products.status','1')
        ->where('products.cat_id', $product->cat_id)
        ->where('products.slug','!=',$request->slug)
        ->orderBy('products.id', 'DESC')
        ->get()->take(12);

        $all_review = Ratting::with(['users'])->select('rattings.user_id','rattings.ratting','rattings.comment',\DB::raw('DATE_FORMAT(rattings.created_at, "%d %M %Y") as date'))->where('product_id',$product->id)->get()->take(10);

        $vendors=User::with(['rattings'])->select('users.id','users.name','users.return_policies',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', users.profile_pic) AS image_url"))
        ->where('users.type','3')
        ->where('users.is_available','1')
        ->where('users.id',$product->vendor_id)
        ->first();

        $currency=Settings::select('currency','currency_position')->first();

        return view('Front.product-details',compact('product','related_products','all_review','vendors','currency'));
    }

    public function searchitem(Request $request)
    {
        if ($request->keyword != "") {

            $product=Products::select('product_name','slug')
            ->where('products.status','1')
            ->where('products.product_name','LIKE','%' . $request->keyword . '%')
            ->orWhere('products.tags','LIKE','%' . $request->keyword . '%')
            ->orderBy('id', 'DESC')
            ->get();

            $output = '';
                         
            if (count($product)>0) {
                
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1; height: 262px; overflow-y: scroll; overflow-x: hidden;">';
                
                foreach ($product as $row){
                    $output .= '<li class="list-group-item"><a href="'.URL::to('products/product-details/'.$row->slug.'').'" style="font-weight: bolder;">'.$row->product_name.'</a></li>';
                }
                
                $output .= '</ul>';
            } else {
               
                $output .= '<li class="list-group-item" style="font-weight: bolder; width: 100%;">'.'No results'.'</li>';
            }
            return $output;
        }
        
    }
}
