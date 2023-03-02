<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController as MainHomeController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\InnerSubCategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LargeBannerController;
use App\Http\Controllers\Admin\LeftBannerController;
use App\Http\Controllers\Admin\BottomBannerController;
use App\Http\Controllers\Admin\PopupBannerController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\ReturnConditionsController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ReturnPolicyController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReturnOrderController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TermsConditionsController;
use App\Http\Controllers\Admin\SubscribeController;

use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\UserController as FrontUserController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\CartController as FrontCartController;
use App\Http\Controllers\Front\WishlistController as FrontWishlistController;
use App\Http\Controllers\Front\AddressController as FrontAddressController;
use App\Http\Controllers\Front\OrderController as FrontOrderController;
use App\Http\Controllers\Front\RattingController as FrontRattingController;
use App\Http\Controllers\Front\NotificationController as FrontNotificationController;
use App\Http\Controllers\Front\VendorController as FrontVendorController;
use App\Http\Controllers\Front\BrandController as FrontBrandController;
use App\Http\Controllers\Front\AboutController as FrontAboutController;
use App\Http\Controllers\Front\PrivacyPolicyController as FrontPrivacyPolicyController;
use App\Http\Controllers\Front\TermsConditionsController as FrontTermsConditionsController;
use App\Http\Controllers\Front\OfferController as FrontOfferController;
use App\Http\Controllers\Front\SubscribeController as FrontSubscribeController;
use App\Http\Controllers\Front\HelpController as FrontHelpController;
use App\Http\Controllers\Front\SocialController as FrontSocialController;
use App\Http\Controllers\Front\GoogleController as FrontGoogleController;
use App\Http\Controllers\Front\AccountController as FrontAccountController;
use App\Http\Controllers\Front\WalletController as FrontWalletController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('lang/home', [MainHomeController::class,'index']);
Route::get('lang/change', [MainHomeController::class,'change'])->name('changeLang');

Route::group(['namespace'=>"Front"], function() {

	Route::get('/', [FrontHomeController::class,'index']);

	//Users
	Route::get('signin', [FrontUserController::class,'index']);
	Route::get('signup', [FrontUserController::class,'signup']);
	Route::post('login', [FrontUserController::class,'login']);
	Route::post('register', [FrontUserController::class,'register']);
	Route::get('forgot-password', [FrontUserController::class,'forgot_password']);
	Route::post('send-pass', [FrontUserController::class,'send_pass']);
	Route::get('otp-verify', [FrontUserController::class,'otp_verify']);
	Route::get('resend-otp', [FrontUserController::class,'resend_otp']);
	Route::post('otp-verification', [FrontUserController::class,'otp_verification']);
	Route::get ('logout', [FrontUserController::class,'logout']);

	//Products
	Route::post('product/show', [FrontProductController::class,'show']);
	Route::post('product/filter', [FrontProductController::class,'filter']);
	Route::get('featured-products', [FrontProductController::class,'featured']);
	Route::get('hot-products', [FrontProductController::class,'hot']);
	Route::get('new-products', [FrontProductController::class,'new']);
	Route::get('categories', [FrontProductController::class,'categories']);
	Route::get('products/product-details/{slug}', [FrontProductController::class,'productdetails']);
	Route::get('categories/products/{slug}', [FrontProductController::class,'categoriesproducts']);
	Route::get('subcategories/products/{category}/{slug}', [FrontProductController::class,'subcategoryproducts']);
	Route::get('innersubcategories/products/{category}/{subcategory}/{slug}', [FrontProductController::class,'innersubcategoryproducts']);
	Route::post('product/productfilter', [FrontProductController::class,'productfilter']);
	Route::post('product/searchitem', [FrontProductController::class,'searchitem']);
	Route::get('search', [FrontProductController::class,'search']);

	//Cart
	Route::post('product/addtocart', [FrontCartController::class,'addtocart']);
	Route::get('cart', [FrontCartController::class,'getcart']);
	Route::get('checkout', [FrontCartController::class,'checkout']);
	Route::post('cart/qtyupdate', [FrontCartController::class,'qtyupdate']);
	Route::post('cart/delete', [FrontCartController::class,'delete']);
	Route::post('cart/applypromocode', [FrontCartController::class,'applypromocode']);
	Route::post('cart/removepromocode', [FrontCartController::class,'removepromocode']);

	//Wishlist
	Route::get('wishlist', [FrontWishlistController::class,'index']);
	Route::post('product/addtowishlist', [FrontWishlistController::class,'addtowishlist']);
	Route::post('product/removefromwishlist', [FrontWishlistController::class,'removefromwishlist']);
	

	//Address
	Route::get('my-address', [FrontAddressController::class,'index']);
	Route::post('saveaddress',[FrontAddressController::class,'saveaddress']);
	Route::post('editaddress',[FrontAddressController::class,'editaddress']);
	Route::post('deleteaddress',[FrontAddressController::class,'deleteaddress']);

	//Order
	Route::post('order',[FrontOrderController::class,'order']);
	Route::get('success',[FrontOrderController::class,'success']);
	Route::get('order-history',[FrontOrderController::class,'orderhistory']);
	Route::get('order-details/{id}',[FrontOrderController::class,'orderdetails']);
	Route::post('cancelorder',[FrontOrderController::class,'cancelorder']);
	Route::get('track-order/{id}',[FrontOrderController::class,'trackorder']);
	Route::post('wallet',[FrontOrderController::class,'wallet']);
	Route::post('returnrequest',[FrontOrderController::class,'returnrequest']);

	//Rattings
	Route::post('addratting',[FrontRattingController::class,'addratting']);
	Route::post('productreview',[FrontRattingController::class,'productreview']);

	//Rattings
	Route::get('notifications',[FrontNotificationController::class,'notifications']);

	// Vendor
	Route::get('all-vendors', [FrontVendorController::class,'vendors']);
	Route::get('/vendor-signup', [FrontVendorController::class,'index'])->name('vendor-signup');
	Route::post('/store', [FrontVendorController::class,'store'])->name('vendor.store');
	Route::get('vendor-details/{id}', [FrontVendorController::class,'vendordetails'])->name('vendor.vendordetails');

	//Brand
	Route::get('all-brand', [FrontBrandController::class,'index']);
	Route::get('brands/{id}', [FrontBrandController::class,'brandsproducts']);

	//About
	Route::get('about-us', [FrontAboutController::class,'index']);

	//privacy-policy
	Route::get('privacy-policy', [FrontPrivacyPolicyController::class,'index']);

	//terms-conditions
	Route::get('terms-conditions', [FrontTermsConditionsController::class,'index']);

	//Offers
	Route::get('offers', [FrontOfferController::class,'index']);

	//Subscribe
	Route::post('subscribe', [FrontSubscribeController::class,'index']);

	//Help
	Route::get('help', [FrontHelpController::class,'index']);
	Route::post('helpform', [FrontHelpController::class,'helpform']);

	Route::get('auth/facebook', [FrontSocialController::class,'redirectToFacebook']);
	Route::get('auth/facebook/callback', [FrontSocialController::class,'handleFacebookCallback']);

	Route::get('auth/google', [FrontGoogleController::class,'redirectToGoogle']);
	Route::get('auth/google/callback', [FrontGoogleController::class,'handleGoogleCallback']);

	//Account
	Route::get('account', [FrontAccountController::class,'index']);
	Route::post('editprofile', [FrontAccountController::class,'editprofile']);
	Route::post('changepassword', [FrontAccountController::class,'changepassword']);

	//Wallet
	Route::get('my-wallet', [FrontWalletController::class,'index']);
	// Route::post('changepassword', [FrontWalletController::class,'changepassword']);
	Route::post('recharge', [FrontWalletController::class,'recharge']);

});


//Admin Route
Route::group(['prefix'=>'admin','namespace'=>"Admin"], function() {

	Route::get('/', function () {
	    return view('Admin.auth.login');
	})->name('admin_login_form');

	Route::get('/verification', function () {
	    return view('Admin.auth.verification');
	});

	Route::get('/otp-verify', function () {
	    return view('Admin.auth.otp-verify');
	});
	Route::post('systemverification', [AuthController::class,'systemverification'])->name('admin.systemverification');
	Route::post('otp_verification', [AuthController::class,'otp_verification'])->name('admin.otp_verification');

	Route::get('login', [AuthController::class,'login'])->name('admin.login');
	Route::post('login', [AuthController::class,'doLogin'])->name('admin.dologin');

	Route::group(['middleware' => 'AdminAuth'], function () {

    	Route::get('/go-back', [AuthController::class,'go_back']);    

		// Home
		Route::get('/dashboard', [HomeController::class,'index'])->name('admin.home');
		Route::post('/withdrawal', [HomeController::class,'withdrawal'])->name('admin.withdrawal');
		Route::post('/changepassword', [HomeController::class,'changepassword'])->name('admin.changepassword');

		// Category
		Route::group(['prefix' => 'category'], function () {
			Route::get('/', [CategoryController::class,'index'])->name('admin.category');
			Route::get('/add', [CategoryController::class,'add'])->name('admin.category.add');
			Route::get('/show/{id}', [CategoryController::class,'show'])->name('admin.category.show');
			Route::get('/list', [CategoryController::class,'list'])->name('admin.category.list');
			Route::get('/search', [CategoryController::class,'search'])->name('admin.category.search');
			Route::post('/store', [CategoryController::class,'store'])->name('admin.category.store');
			Route::post('/update', [CategoryController::class,'update'])->name('admin.category.update');
			Route::post('/delete', [CategoryController::class,'destroy'])->name('admin.category.delete');
			Route::post('/change/status', [CategoryController::class,'changeStatus'])->name('admin.category.changeStatus');
		});

		// Subcategory
		Route::group(['prefix' => 'subcategory'], function () {
			Route::get('/', [SubCategoryController::class,'index'])->name('admin.subcategory');
			Route::get('/add', [SubCategoryController::class,'add'])->name('admin.subcategory.add');
			Route::get('/show/{id}', [SubCategoryController::class,'show'])->name('admin.subcategory.show');
			Route::get('/list', [SubCategoryController::class,'list'])->name('admin.subcategory.list');
			Route::get('/search', [SubCategoryController::class,'search'])->name('admin.subcategory.search');
			Route::post('/store', [SubCategoryController::class,'store'])->name('admin.subcategory.store');
			Route::post('/update', [SubCategoryController::class,'update'])->name('admin.subcategory.update');
			Route::post('/delete', [SubCategoryController::class,'destroy'])->name('admin.subcategory.delete');
			Route::post('/change/status', [SubCategoryController::class,'changeStatus'])->name('admin.subcategory.changeStatus');
		});

		// InnerSubcategory
		Route::group(['prefix' => 'innersubcategory'], function () {
			Route::get('/', [InnerSubCategoryController::class,'index'])->name('admin.innersubcategory');
			Route::get('/add', [InnerSubCategoryController::class,'add'])->name('admin.innersubcategory.add');
			Route::get('/show/{id}', [InnerSubCategoryController::class,'show'])->name('admin.innersubcategory.show');
			Route::get('/list', [InnerSubCategoryController::class,'list'])->name('admin.innersubcategory.list');
			Route::get('/search', [InnerSubCategoryController::class,'search'])->name('admin.innersubcategory.search');
			Route::post('/store', [InnerSubCategoryController::class,'store'])->name('admin.innersubcategory.store');
			Route::post('/update', [InnerSubCategoryController::class,'update'])->name('admin.innersubcategory.update');
			Route::post('/delete', [InnerSubCategoryController::class,'destroy'])->name('admin.innersubcategory.delete');
			Route::post('/change/status', [InnerSubCategoryController::class,'changeStatus'])->name('admin.innersubcategory.changeStatus');
			Route::post('/change/subcat', [InnerSubCategoryController::class,'subcat'])->name('admin.innersubcategory.subcat');
		});

		// Color
		Route::group(['prefix' => 'color'], function () {
			Route::get('/', [ColorController::class,'index'])->name('admin.color');
			Route::get('/add', [ColorController::class,'add'])->name('admin.color.add');
			Route::get('/show/{id}', [ColorController::class,'show'])->name('admin.color.show');
			Route::get('/list', [ColorController::class,'list'])->name('admin.color.list');
			Route::post('/store', [ColorController::class,'store'])->name('admin.color.store');
			Route::post('/update', [ColorController::class,'update'])->name('admin.color.update');
			Route::post('/delete', [ColorController::class,'destroy'])->name('admin.color.delete');
			Route::post('/change/status', [ColorController::class,'changeStatus'])->name('admin.color.changeStatus');
		});

		// Attribute
		Route::group(['prefix' => 'attribute'], function () {
			Route::get('/', [AttributeController::class,'index'])->name('admin.attribute');
			Route::get('/add', [AttributeController::class,'add'])->name('admin.attribute.add');
			Route::get('/show/{id}', [AttributeController::class,'show'])->name('admin.attribute.show');
			Route::get('/list', [AttributeController::class,'list'])->name('admin.attribute.list');
			Route::get('/search', [AttributeController::class,'search'])->name('admin.attribute.search');
			Route::post('/store', [AttributeController::class,'store'])->name('admin.attribute.store');
			Route::post('/update', [AttributeController::class,'update'])->name('admin.attribute.update');
			Route::post('/delete', [AttributeController::class,'destroy'])->name('admin.attribute.delete');
			Route::post('/change/status', [AttributeController::class,'changeStatus'])->name('admin.attribute.changeStatus');
		});

		// Brand
		Route::group(['prefix' => 'brand'], function () {
			Route::get('/', [BrandController::class,'index'])->name('admin.brand');
			Route::get('/add', [BrandController::class,'add'])->name('admin.brand.add');
			Route::get('/show/{id}', [BrandController::class,'show'])->name('admin.brand.show');
			Route::get('/list', [BrandController::class,'list'])->name('admin.brand.list');
			Route::get('/search', [BrandController::class,'search'])->name('admin.brand.search');
			Route::post('/store', [BrandController::class,'store'])->name('admin.brand.store');
			Route::post('/update', [BrandController::class,'update'])->name('admin.brand.update');
			Route::post('/delete', [BrandController::class,'destroy'])->name('admin.brand.delete');
			Route::post('/change/status', [BrandController::class,'changeStatus'])->name('admin.brand.changeStatus');
		});

		// Products
		Route::group(['prefix' => 'products'], function () {
			Route::get('/', [ProductController::class,'index'])->name('admin.products');
			Route::get('/add', [ProductController::class,'add'])->name('admin.products.add');
			Route::get('/show/{id}', [ProductController::class,'show'])->name('admin.products.show');
			Route::get('/list', [ProductController::class,'list'])->name('admin.products.list');
			Route::get('/search', [ProductController::class,'search'])->name('admin.products.search');
			Route::post('/store', [ProductController::class,'store'])->name('admin.products.store');
			Route::post('/update', [ProductController::class,'update'])->name('admin.products.update');
			Route::post('/delete', [ProductController::class,'destroy'])->name('admin.products.delete');
			Route::post('/change/status', [ProductController::class,'changeStatus'])->name('admin.products.changeStatus');
			Route::post('/change/subcat', [ProductController::class,'subcat'])->name('admin.products.subcat');
			Route::post('/change/innersubcat', [ProductController::class,'innersubcat'])->name('admin.products.innersubcat');
			Route::post('/showimage', [ProductController::class,'showimage'])->name('admin.products.showimage');
			Route::post('/updateimage', [ProductController::class,'updateimage'])->name('admin.products.updateimage');
			Route::post('/destroyimage', [ProductController::class,'destroyimage'])->name('admin.products.destroyimage');
			Route::post('/storeimages', [ProductController::class,'storeimages'])->name('admin.products.storeimages');
		});

		// Variation
		Route::group(['prefix' => 'variation'], function () {
			Route::post('/delete', 'VariationController@destroy')->name('admin.variation.delete');
		});

		// Slider
		Route::group(['prefix' => 'slider'], function () {
			Route::get('/', [SliderController::class,'index'])->name('admin.slider');
			Route::get('/add', [SliderController::class,'add'])->name('admin.slider.add');
			Route::get('/show/{id}', [SliderController::class,'show'])->name('admin.slider.show');
			Route::get('/list', [SliderController::class,'list'])->name('admin.slider.list');
			Route::post('/store', [SliderController::class,'store'])->name('admin.slider.store');
			Route::post('/update', [SliderController::class,'update'])->name('admin.slider.update');
			Route::post('/delete', [SliderController::class,'destroy'])->name('admin.slider.delete');
			Route::post('/change/status', [SliderController::class,'changeStatus'])->name('admin.slider.changeStatus');
		});

		// Banner
		Route::group(['prefix' => 'banner'], function () {
			Route::get('/', [BannerController::class,'index'])->name('admin.banner');
			Route::get('/add', [BannerController::class,'add'])->name('admin.banner.add');
			Route::get('/show/{id}', [BannerController::class,'show'])->name('admin.banner.show');
			Route::get('/list', [BannerController::class,'list'])->name('admin.banner.list');
			Route::post('/store', [BannerController::class,'store'])->name('admin.banner.store');
			Route::post('/update', [BannerController::class,'update'])->name('admin.banner.update');
			Route::post('/delete', [BannerController::class,'destroy'])->name('admin.banner.delete');
			Route::post('/change/status', [BannerController::class,'changeStatus'])->name('admin.banner.changeStatus');
		});

		// LargeBanner
		Route::group(['prefix' => 'largebanner'], function () {
			Route::get('/', [LargeBannerController::class,'index'])->name('admin.largebanner');
			Route::get('/add', [LargeBannerController::class,'add'])->name('admin.largebanner.add');
			Route::get('/show/{id}', [LargeBannerController::class,'show'])->name('admin.largebanner.show');
			Route::get('/list', [LargeBannerController::class,'list'])->name('admin.largebanner.list');
			Route::post('/store', [LargeBannerController::class,'store'])->name('admin.largebanner.store');
			Route::post('/update', [LargeBannerController::class,'update'])->name('admin.largebanner.update');
			Route::post('/delete', [LargeBannerController::class,'destroy'])->name('admin.largebanner.delete');
			Route::post('/change/status', [LargeBannerController::class,'changeStatus'])->name('admin.largebanner.changeStatus');
		});

		// LeftBanner
		Route::group(['prefix' => 'leftbanner'], function () {
			Route::get('/', [LeftBannerController::class,'index'])->name('admin.leftbanner');
			Route::get('/add', [LeftBannerController::class,'add'])->name('admin.leftbanner.add');
			Route::get('/show/{id}', [LeftBannerController::class,'show'])->name('admin.leftbanner.show');
			Route::get('/list', [LeftBannerController::class,'list'])->name('admin.leftbanner.list');
			Route::post('/store', [LeftBannerController::class,'store'])->name('admin.leftbanner.store');
			Route::post('/update', [LeftBannerController::class,'update'])->name('admin.leftbanner.update');
			Route::post('/delete', [LeftBannerController::class,'destroy'])->name('admin.leftbanner.delete');
			Route::post('/change/status', [LeftBannerController::class,'changeStatus'])->name('admin.leftbanner.changeStatus');
		});

		// BottomBanner
		Route::group(['prefix' => 'bottombanner'], function () {
			Route::get('/', [BottomBannerController::class,'index'])->name('admin.bottombanner');
			Route::get('/add', [BottomBannerController::class,'add'])->name('admin.bottombanner.add');
			Route::get('/show/{id}', [BottomBannerController::class,'show'])->name('admin.bottombanner.show');
			Route::get('/list', [BottomBannerController::class,'list'])->name('admin.bottombanner.list');
			Route::post('/store', [BottomBannerController::class,'store'])->name('admin.bottombanner.store');
			Route::post('/update', [BottomBannerController::class,'update'])->name('admin.bottombanner.update');
			Route::post('/delete', [BottomBannerController::class,'destroy'])->name('admin.bottombanner.delete');
			Route::post('/change/status', [BottomBannerController::class,'changeStatus'])->name('admin.bottombanner.changeStatus');
		});

		// PopupBanner
		Route::group(['prefix' => 'popupbanner'], function () {
			Route::get('/', [PopupBannerController::class,'index'])->name('admin.popupbanner');
			Route::get('/add', [PopupBannerController::class,'add'])->name('admin.popupbanner.add');
			Route::get('/show/{id}', [PopupBannerController::class,'show'])->name('admin.popupbanner.show');
			Route::get('/list', [PopupBannerController::class,'list'])->name('admin.popupbanner.list');
			Route::post('/store', [PopupBannerController::class,'store'])->name('admin.popupbanner.store');
			Route::post('/update', [PopupBannerController::class,'update'])->name('admin.popupbanner.update');
			Route::post('/delete', [PopupBannerController::class,'destroy'])->name('admin.popupbanner.delete');
			Route::post('/change/status', [PopupBannerController::class,'changeStatus'])->name('admin.popupbanner.changeStatus');
		});

		// Coupons
		Route::group(['prefix' => 'coupons'], function () {
			Route::get('/coupons', [CouponsController::class,'index'])->name('admin.coupons');
			Route::get('/add', [CouponsController::class,'add'])->name('admin.coupons.add');
			Route::get('/show/{id}', [CouponsController::class,'show'])->name('admin.coupons.show');
			Route::get('/list', [CouponsController::class,'list'])->name('admin.coupons.list');
			Route::get('/search', [CouponsController::class,'search'])->name('admin.coupons.search');
			Route::post('/store', [CouponsController::class,'store'])->name('admin.coupons.store');
			Route::post('/update', [CouponsController::class,'update'])->name('admin.coupons.update');
			Route::post('/delete', [CouponsController::class,'destroy'])->name('admin.coupons.delete');
			Route::post('/change/status', [CouponsController::class,'changeStatus'])->name('admin.coupons.changeStatus');
		});

		// Return conditions
		Route::group(['prefix' => 'returnconditions'], function () {
			Route::get('/', [ReturnConditionsController::class,'index'])->name('admin.returnconditions');
			Route::get('/add', [ReturnConditionsController::class,'add'])->name('admin.returnconditions.add');
			Route::get('/show/{id}', [ReturnConditionsController::class,'show'])->name('admin.returnconditions.show');
			Route::get('/list', [ReturnConditionsController::class,'list'])->name('admin.returnconditions.list');
			Route::post('/store', [ReturnConditionsController::class,'store'])->name('admin.returnconditions.store');
			Route::post('/update', [ReturnConditionsController::class,'update'])->name('admin.returnconditions.update');
			Route::post('/delete', [ReturnConditionsController::class,'destroy'])->name('admin.returnconditions.delete');
		});

		// Vendors
		Route::group(['prefix' => 'vendors'], function () {
			Route::get('/', [VendorController::class,'index'])->name('admin.vendors');
			Route::get('/add', [VendorController::class,'add'])->name('admin.vendors.add');
			Route::post('/store', [VendorController::class,'store'])->name('admin.vendors.store');
			Route::get('/vendor-profile', [VendorController::class,'vendorprofile'])->name('admin.vendor-profile');
			Route::post('/update', [VendorController::class,'update'])->name('admin.vendors.update');
			Route::get('/search', [VendorController::class,'search'])->name('admin.vendors.search');
			Route::post('/change/status', [VendorController::class,'changeStatus'])->name('admin.vendors.changeStatus');
			Route::get('/vendor-details/{id}', [VendorController::class,'vendordetails'])->name('admin.vendors.vendordetails');
			Route::post('/delete', [VendorController::class,'destroy'])->name('admin.vendors.delete');
			Route::get('/login/{slug}', [AuthController::class,'vendor_login']);
		});

		// Users
		Route::group(['prefix' => 'users'], function () {
			Route::get('/users', [UserController::class,'index'])->name('admin.users');
			Route::get('/user-profile', [UserController::class,'vendorprofile'])->name('admin.user-profile');
			Route::post('/update', [UserController::class,'update'])->name('admin.users.update');
			Route::get('/search', [UserController::class,'search'])->name('admin.users.search');
			Route::post('/change/status', [UserController::class,'changeStatus'])->name('admin.users.changeStatus');
			Route::get('/user-details/{id}', [UserController::class,'vendordetails'])->name('admin.users.vendordetails');
			Route::post('/delete', [UserController::class,'destroy'])->name('admin.users.delete');
		});

		// Payments
		Route::group(['prefix' => 'payments'], function () {
			Route::get('/', [PaymentController::class,'index'])->name('admin.payments');
			Route::post('/change/status', [PaymentController::class,'changeStatus'])->name('admin.payments.changeStatus');
			Route::get('/manage-payment/{id}', [PaymentController::class,'managepayment'])->name('admin.payments.managepayment');
			Route::post('/update', [PaymentController::class,'update'])->name('admin.payments.update');
		});

		// Settings
		Route::group(['prefix' => 'settings'], function () {
			Route::get('/', [SettingsController::class,'index'])->name('admin.settings');
			Route::post('/update', [SettingsController::class,'update'])->name('admin.settings.update');
		});

		// Return policy
		Route::group(['prefix' => 'return-policy'], function () {
			Route::get('/', [ReturnPolicyController::class,'index'])->name('admin.return-policy');
			Route::post('/update', [ReturnPolicyController::class,'update'])->name('admin.return-policy.update');
		});

		// Payout
		Route::group(['prefix' => 'payout'], function () {
			Route::get('/', [PayoutController::class,'index'])->name('admin.payout');
			Route::post('/update', [PayoutController::class,'update'])->name('admin.payout.update');
		});

		// Help
		Route::group(['prefix' => 'help'], function () {
			Route::get('/', [HelpController::class,'index'])->name('admin.help');
			Route::get('/search', [HelpController::class,'search'])->name('admin.help.search');
		});

		// Orders
		Route::group(['prefix' => 'orders'], function () {
			Route::get('/', [OrderController::class,'index'])->name('admin.orders');
			Route::get('/order-details/{id}', [OrderController::class,'orderdetails'])->name('admin.payments.orderdetails');
			Route::post('/update', [OrderController::class,'update'])->name('admin.orders.update');
			Route::post('/delete', [OrderController::class,'delete'])->name('admin.orders.delete');
			Route::get('/search', [OrderController::class,'search'])->name('admin.orders.search');
			Route::post('/change/status', [OrderController::class,'changeStatus'])->name('admin.orders.changeStatus');
		});

		// Return Orders
		Route::group(['prefix' => 'returnorders'], function () {
			Route::get('/', [ReturnOrderController::class,'index'])->name('admin.returnorders');
			Route::get('/order-details/{id}', [ReturnOrderController::class,'orderdetails'])->name('admin.returnorders.orderdetails');
			Route::get('/search', [ReturnOrderController::class,'search'])->name('admin.returnorders.search');
			Route::post('/change/status', [ReturnOrderController::class,'changeStatus'])->name('admin.returnorders.changeStatus');
		});

		// About
		Route::group(['prefix' => 'about'], function () {
			Route::get('/', [AboutController::class,'index'])->name('admin.about');
			Route::post('/update', [AboutController::class,'update'])->name('admin.about.update');
		});

		// privacy-policy
		Route::group(['prefix' => 'privacy-policy'], function () {
			Route::get('/', [PrivacyPolicyController::class,'index'])->name('admin.privacy-policy');
			Route::post('/update', [PrivacyPolicyController::class,'update'])->name('admin.privacy-policy.update');
		});

		// terms-conditions
		Route::group(['prefix' => 'terms-conditions'], function () {
			Route::get('/terms-conditions', [TermsConditionsController::class,'index'])->name('admin.terms-conditions');
			Route::post('/update', [TermsConditionsController::class,'update'])->name('admin.terms-conditions.update');
		});

		// Subscribe
		Route::group(['prefix' => 'subscribe'], function () {
			Route::get('/', [SubscribeController::class,'index'])->name('admin.subscribe');
			Route::get('/search', [SubscribeController::class,'search'])->name('admin.subscribe.search');
		});

		Route::get('logout', [AuthController::class,'logout'])->name('admin.logout');
	});
});