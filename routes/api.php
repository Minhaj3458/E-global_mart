<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\RattingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\CouponsController;
use App\Http\Controllers\Api\ReturnConditionsController;
use App\Http\Controllers\Api\CMSController;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace'=>'Api'],function (){

	//Usermanagement
	Route::post('login',[UserController::class,'login']);
	Route::post('register',[UserController::class,'register']);
	
	Route::post('mobileverify',[UserController::class,'mobileverify']);
	Route::post('emailverify',[UserController::class,'emailverify']);
	Route::post('editprofile',[UserController::class,'editprofile']);
	
	Route::post('resendmobileotpverification',[UserController::class,'resendmobileotpverification']);
	Route::post('resendemailverification',[UserController::class,'resendemailverification']);
	Route::post('getprofile',[UserController::class,'getprofile']);
	Route::post('changenotificationstatus',[UserController::class,'changenotificationstatus']);
	Route::post('changepassword',[UserController::class,'changepassword']);
	Route::post('forgotPassword',[UserController::class,'forgotPassword']);
	Route::get('restaurantslocation',[UserController::class,'restaurantslocation']);
	Route::post('contact',[UserController::class,'contact']);
	Route::get('vendors',[UserController::class,'vendors']);
	Route::post('vendorsregister',[UserController::class,'vendorsregister']);

	//Homefeeds
	Route::post('homefeeds',[HomeController::class,'homefeeds']);

	//Product
	Route::post('products',[ProductsController::class,'products']);
	Route::post('viewalllisting',[ProductsController::class,'viewalllisting']);
	Route::post('productdetails',[ProductsController::class,'productdetails']);
	Route::post('vendorproducts',[ProductsController::class,'vendorproducts']);
	Route::post('searchproducts',[ProductsController::class,'searchproducts']);
	Route::post('filter',[ProductsController::class,'filter']);

	//Wishlist
	Route::post('addtowishlist',[WishlistController::class,'addtowishlist']);
	Route::post('removefromwishlist',[WishlistController::class,'removefromwishlist']);
	Route::post('getwishlist',[WishlistController::class,'getwishlist']);

	//Rattings
	Route::post('addratting',[RattingController::class,'addratting']);
	Route::post('productreview',[RattingController::class,'productreview']);

	//Categorymanagement
	Route::get('category',[CategoryController::class,'category']);
	Route::post('subcategory',[CategoryController::class,'subcategory']);

	//Bannermanagement
	Route::get('banner',[BannerController::class,'banner']);

	//Brands
	Route::get('brands',[BrandController::class,'brands']);
	Route::post('brandsproducts',[BrandController::class,'brandsproducts']);

	//Address
	Route::post('saveaddress',[AddressController::class,'saveaddress']);
	Route::post('getaddress',[AddressController::class,'getaddress']);
	Route::post('editaddress',[AddressController::class,'editaddress']);
	Route::post('deleteaddress',[AddressController::class,'deleteaddress']);

	//Cart
	Route::post('addtocart',[CartController::class,'addtocart']);
	Route::post('getcart',[CartController::class,'getcart']);
	Route::post('deleteproduct',[CartController::class,'deleteproduct']);
	Route::post('qtyupdate',[CartController::class,'qtyupdate']);

	//Checkout
	Route::post('checkout',[CheckoutController::class,'checkout']);

	//Payment list
	Route::post('paymentlist',[PaymentController::class,'paymentlist']);

	//Order
	Route::post('order',[OrderController::class,'order']);
	Route::post('orderhistory',[OrderController::class,'orderhistory']);
	Route::post('orderdetails',[OrderController::class,'orderdetails']);
	Route::post('cancelorder',[OrderController::class,'cancelorder']);
	Route::post('trackorder',[OrderController::class,'trackorder']);
	Route::post('trackingorder',[OrderController::class,'trackingorder']);
	Route::post('wallet',[OrderController::class,'wallet']);
	Route::post('recharge',[OrderController::class,'recharge']);

	//Notification
	Route::post('notification',[NotificationController::class,'notification']);
	Route::post('notificationread',[NotificationController::class,'notificationread']);

	//Coupons
	Route::get('coupons',[CouponsController::class,'coupons']);

	//Return conditions
	Route::post('returnconditions',[ReturnConditionsController::class,'returnconditions']);
	Route::post('returnrequest',[ReturnConditionsController::class,'returnrequest']);

	//PrivacyPolicy
	Route::get('cmspages',[CMSController::class,'index']);

	//Help
	Route::post('help',[UserController::class,'help']);
});