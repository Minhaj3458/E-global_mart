<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Banner;
use App\Models\User;
use Helper;
use DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Front.vendor-signup');
    }


    public function vendor_ref_sign_up($ref_name)
    {
        $ref=$ref_name;
        
        
        return view('Front.vendor-signup-ref',['ref' => $ref]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile',
            'password' => 'required|min:6',
            'confirmpassword'=>'required_with:password|same:password|min:6',
            'terms' =>'accepted'
        ]);
        
        $otp = rand ( 100000 , 999999 );
        
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
        $referral_code = substr(str_shuffle($str_result), 0, 10);

        $phone_number = '+'.$request->country.''.$request->mobile;
        $phone_number = str_replace("+8800", "880", $phone_number);
        $phone_number = str_replace("+880", "880", $phone_number);

        $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: ".$otp." Please Verify.";
        $this->sendSMS($phone_number,$otpMsg);
        $helper = helper::emailverification($request->email,$otp);
        if($helper == 1){
            

            
            $vendor = new User();
            $vendor->name = $request->first_name.' '.$request->last_name;
            $vendor->mobile = '+'.$request->country.''.$request->mobile;
            $vendor->email = $request->email;
            $vendor->profile_pic = 'default.png';
            $vendor->password = Hash::make($request->password);
            $vendor->login_type = 'email';
            $vendor->referral_code = $referral_code;
            $vendor->type = 3;
            $vendor->otp = $otp;
            $vendor->is_available = 2;
          
            
            if ($vendor->save()) {
                if (env('Environment') == 'sendbox') {
                    session ( ['email' => $request->email,'otp' => $otp,] );
                } else {
                    session ( ['email' => $request->email,] );
                }
                return Redirect::to('/otp-verify')->with('success', trans('messages.otp_sent'));
            } else {
                return redirect()->back()->with('danger', trans('messages.fail'));
            }
        }
        else{
            return redirect()->back()->with('danger', trans('messages.wrong_while_email'));
        }
    }
    
    
    public function store_ref(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'ref_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile',
            'password' => 'required|min:6',
            'confirmpassword'=>'required_with:password|same:password|min:6',
            'terms' =>'accepted'
        ]);
        
        $otp = rand ( 100000 , 999999 );
        
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
        $referral_code = substr(str_shuffle($str_result), 0, 10);

        $phone_number = '+'.$request->country.''.$request->mobile;
        $phone_number = str_replace("+8800", "880", $phone_number);
        $phone_number = str_replace("+880", "880", $phone_number);

        $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: ".$otp." Please Verify.";
        $this->sendSMS($phone_number,$otpMsg);
        $helper = helper::emailverification($request->email,$otp);
        if($helper == 1){
            

            
            $vendor = new User();
            $vendor->name = $request->first_name.' '.$request->last_name;
            $vendor->mobile = '+'.$request->country.''.$request->mobile;
            $vendor->email = $request->email;
            $vendor->profile_pic = 'default.png';
            $vendor->password = Hash::make($request->password);
            $vendor->login_type = 'email';
            $vendor->referral_code = $referral_code;
            $vendor->type = 3;
            $vendor->otp = $otp;
            $vendor->is_available = 2;
            $vendor->refferal_vendor = $request->ref_name;
            if ($vendor->save()) {
                if (env('Environment') == 'sendbox') {
                    session ( ['email' => $request->email,'otp' => $otp,] );
                } else {
                    session ( ['email' => $request->email,] );
                }
                return Redirect::to('/otp-verify')->with('success', trans('messages.otp_sent'));
            } else {
                return redirect()->back()->with('danger', trans('messages.fail'));
            }
        }
        else{
            return redirect()->back()->with('danger', trans('messages.wrong_while_email'));
        }
    }    
    

    public function vendordetails(Request $request)
    {
        $user_id  = @Auth::user()->id;

        $products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.is_hot','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('products.status','1')
        ->where('products.vendor_id',$request->id)
        ->orderBy('products.id', 'DESC')
        ->paginate(12);

        $vendors=User::with(['rattings'])->select('users.id','users.name','users.store_address','users.email','users.mobile','profile_pic')
        ->where('users.type','3')
        ->where('users.is_available','1')
        ->where('users.id',$request->id)
        ->first();

        $getbanners = Banner::select('id',\DB::raw("CONCAT('".url('/storage/app/public/images/banner/')."/', image) AS image"))->where('vendor_id',$request->id)->where('positions','store')->get();

        return view('Front.vendor-details',compact('products','vendors','getbanners'));
    }

    public function vendors()
    {
        $vendors=User::select('id','name','profile_pic')
        ->where('type','3')
        ->where('is_available','1')
        ->paginate(30);

        return view('Front.all-vendors',compact('vendors'));
    }
    

    public function sendSMS($phone_number, $message){

        $sms_phone= str_replace("+880", "880", $phone_number);
       
        $message=urlencode($message);
         $url="http://apismpp.ajuratech.com/sendtext?apikey=32a563c854d1308a&secretkey=5c8e9121&callerID=eglobalmartld&toUser=$sms_phone&messageContent=$message";
        
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);     
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);

        // grab URL and pass it to the browser
        $response = curl_exec($ch);
        $err = curl_error($ch);

        // close cURL resource, and free up system resources
        if ($err) {
            echo "cURL Error #:" . $err;
        }

        curl_close($ch);
    }    
    
}
