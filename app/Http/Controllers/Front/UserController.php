<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Cart;
use App\Models\Settings;
use Session;
use App\Helpers\Helper;
use Validator;
use Auth;
use Str;
use Storage;
use App\Traits\SmsTrait;

class UserController extends Controller
{
    
    use SmsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Front.signin');
    }

    public function login(Request $request)
    {
        $login=User::where('email',$request->email)->where('type','=','2')->first();
        
        if(!empty($login)) {
            if(Hash::check($request->get('password'),$login->password)) {
                if($login->is_verified == '1') {
                    if($login->is_available == '1') {
                        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                        $cart=Cart::where('user_id',Auth::user()->id)->count();

                        Storage::disk('local')->put("cart", $cart);

                        return Redirect::to('/');
                    } else {
                        return Redirect::back()->with('danger', trans('messages.blocked'));
                    }
                } else {

                    $otp = rand ( 100000 , 999999 );
                    $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: $otp  Please Verify.";
                    
                    try{
                    
                        $title = $emailTitle=trans('labels.email_verification');
                        $email=$request->email;
                        $data=['title'=>$title,'email'=>$email,'otp'=>$otp,"logo"=>Helper::webinfo()->image];

                        $phoneNumber = $login->mobile;
                        // Mail::send('Email.emailverification',$data,function($message)use($data){
                        //     $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                        //     $message->to($data['email']);
                        // } );
                        

                        $this->sendSMS($phoneNumber, $otpMsg);
                    
                        $update=User::where('email',$request->email)->update(['otp'=>$otp,'is_verified'=>'2']);

                        if (env('Environment') == 'sendbox') {
                            session ( [
                                'email' => $login->email,
                                'password' => $login->password,
                                'otp' => $otp,
                            ] );
                        } else {
                            session ( [
                                'email' => $login->email,
                            ] );
                        }

                    }catch(\Swift_TransportException $e){
                        $response = $e->getMessage() ;
                        return Redirect::back()->with('danger', trans('labels.fail'));
                    }
                    return Redirect::to('otp-verify')->with('success', trans('messages.otp_sent'));
                }
            } else {
                return Redirect::back()->with('danger', trans('messages.email_pass_invalid'));
            }
        } else {
            return Redirect::back()->with('danger', trans('messages.email_pass_invalid'));
        }        
    }

    public function signup(Request $request)
    {
        return view('Front.signup');
    }

    public function register(Request $request)
    {
        if (Session::get('facebook_id') OR Session::get('google_id')) {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'nullable|email|unique:users',
                'mobile' => 'required|unique:users',
                'accept' =>'accepted'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                if (Session::get('facebook_id') != "") {
                    $login_type ='facebook';
                    $facebook_id =Session::get('facebook_id');
                }
                if (Session::get('google_id') != "") {
                    $login_type ='google';
                    $google_id =Session::get('google_id');
                }
            }
        } else {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'nullable|email|unique:users',
                'mobile' => 'required|unique:users',
                'password' => 'required|confirmed',
                'accept' =>'accepted'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $login_type ='email';
            }
        }
        
        $phone_number = '+'.$request->country.''.$request->mobile;
        $phone_number = str_replace("+8800", "880", $phone_number);
        $phone_number = str_replace("+880", "880", $phone_number);
        
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
        $referral_code = substr(str_shuffle($str_result), 0, 10); 
        $otp = rand ( 100000 , 999999 );

        try{
            
            $helper = 1;
            // $helper = helper::emailverification($request->email,$otp);
            
            $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: ".$otp." Please Verify.";
            //$otpMsg = "TESTSMS";
            $this->sendSMS($phone_number,$otpMsg);
            
            if($helper == 1){

                $checkslug = User::where('slug',Str::slug($request->name, '-'))->first();
                if($checkslug != ""){
                    $last = User::select('id')->orderByDesc('id')->first();
                    $create = $request->name." ".($last->id+1);
                    $slug = Str::slug($create,'-');
                }else{
                    $slug = Str::slug($request->name, '-');
                }

                $user = new User;
                $user->name =$request->name;
                $user->slug = $slug;
                $user->email =$request->email;
                $user->password =Hash::make($request->password);
                $user->mobile =$phone_number;
                $user->profile_pic ='default.png';
                $user->login_type =$login_type;
                $user->facebook_id =@$facebook_id;
                $user->google_id =@$google_id;
                $user->otp=$otp;
                $user->type ='2';
                $user->is_verified ='2';
                $user->is_available ='1';
                $user->login_type ='email';
                $user->token = $request->token;
                $user->referral_code=$referral_code;
                if($request->has('referral_code') && $request->referral_code != ""){
                    $getdata=Settings::select('referral_amount')->first();
                    $checkreferral = User::select('id','email','name','referral_code','wallet','token')->where('referral_code',$request->referral_code)->where('is_available',1)->first();
                    if(!empty($checkreferral)){

                        try{
                           $email=$checkreferral->email;
                           $toname=$checkreferral->name;
                           $name=$request->name;
                           
                           $referralmessage='Your friend "'.$name.'" has used your referral code to register with E-Global Mart Ltd e-Com. User. You have earned '. Helper::CurrencyFormatter($getdata->referral_amount).' referral amount in your wallet.';

                           $data=['referralmessage'=>$referralmessage,'email'=>$email,'toname'=>$toname,'name'=>$name,"logo"=>Helper::webinfo()->image];
                        //   Mail::send('Email.referral',$data,function($message)use($data){
                        //       $message->from(env('MAIL_USERNAME'))->subject($data['referralmessage']);
                        //       $message->to($data['email']);
                        //   } );

                           $title = trans('labels.referral_earning');
                           $body = 'Your friend "'.$name.'" has used your referral code to register with E-Global Mart Ltd e-Com. User. You have earned '. Helper::CurrencyFormatter($getdata->referral_amount).' referral amount in your wallet.';
                           $dataaa = Helper::push_notification($title,$body,$checkreferral->token);

                            // for referral user
                            $updatewallet = User::where('id',$checkreferral->id)->update(['wallet'=>$checkreferral->wallet + $getdata->referral_amount]);
                            $from_Wallet = new Transaction;
                            $from_Wallet->user_id = $checkreferral->id;
                            $from_Wallet->order_id = null;
                            $from_Wallet->order_number = null;
                            $from_Wallet->wallet = $getdata->referral_amount;
                            $from_Wallet->payment_id = null;
                            $from_Wallet->order_type = '0';
                            $from_Wallet->transaction_type = '3';
                            $from_Wallet->type = 'referral';
                            $from_Wallet->username = $request->name;
                            $from_Wallet->save();

                            // for new-register user
                            $to_Wallet = new Transaction;
                            $to_Wallet->user_id = 0;
                            $to_Wallet->order_id = null;
                            $to_Wallet->order_number = null;
                            $to_Wallet->wallet = $getdata->referral_amount;
                            $to_Wallet->payment_id = null;
                            $to_Wallet->order_type = '0';
                            $to_Wallet->transaction_type = '3';
                            $to_Wallet->type = 'referral';
                            $to_Wallet->username = $checkreferral->name;
                            $to_Wallet->save();

                        }catch(\Swift_TransportException $e){
                           $response = $e->getMessage() ;
                           return response()->json(['status'=>0,'message'=>trans('messages.wrong_while_email')],200);
                        }
                    }else{
                        return redirect()->back()->with('danger', trans('messages.invalid_referral'));
                    }
                }
                if($user->save()){
                    if (env('Environment') == 'sendbox') {
                        session ( ['email' => $request->email,'otp' => $otp] );
                    } else {
                        session ( ['email' => $request->email] );
                    }
                    if($request->has('referral_code') && $request->referral_code != "" && !empty($checkreferral)){
                        $changewallet = User::where('id',$user->id)->update(['wallet'=>$getdata->referral_amount]);
                        $t = Transaction::find($to_Wallet->id);
                        $t->user_id = $user->id;
                        $t->save();
                    }
                    
                    // return Redirect::to('/signin')->with('success', "Registration Successful");
                   return Redirect::to('/otp-verify')->with('success', trans('messages.otp_sent'));
                    
                }else{
                    return redirect()->back()->with('danger', trans('messages.fail'));
                }
            }else{
                return redirect()->back()->with('danger', trans('messages.wrong_while_email'));
            }
        }catch(\Swift_TransportException $e){
            $response = $e->getMessage() ;
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    public function otp_verify() 
    {
        return view('Front.otp-verify');
    }
    
    
////Below Function For Cpanel SMS




////Upper for Function For Cpanel SMS

    public function resend_otp()
    {
        $checkuser=User::where('email',Session::get('email'))->first();

        if (!empty($checkuser)) {
            try{
                $otp = rand ( 100000 , 999999 );
                $update=User::where('email',Session::get('email'))->update(['otp'=>$otp,'is_verified'=>'2']);
                $title=trans('messages.verification_email');
                $email=Session::get('email');
                $data=['title'=>$title,'email'=>$email,'otp'=>$otp,"logo"=>Helper::webinfo()->image];
                
                // Mail::send('Email.emailverification',$data,function($message)use($data){
                //     $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                //     $message->to($data['email']);
                // } );
                
                
            $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: ".$otp." Please Verify.";
            
            $phoneNumber = $checkuser->mobile;
            $this->sendSMS($phoneNumber,$otpMsg);
            
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                return Redirect::back()->with('danger', trans('messages.fail'));
            }
            if (env('Environment') == 'sendbox') {
                session (['otp' => $otp,]);
            }
            return Redirect::to('/otp-verify')->with('success', trans('messages.otp_sent'));
        } else {
            return Redirect::back()->with('danger',trans('messages.invalid_email'));
        }  
    }

    public function otp_verification(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'otp' => 'required'
        ]);

        $checkuser=User::where('email',$request->email)->first();

        if (!empty($checkuser)) {
            if ($checkuser->otp == $request->otp) {

                $update=User::where('email',$request['email'])->update(['otp'=>NULL,'is_verified'=>'1']);

                if ($checkuser->type == 3) {
                    return Redirect::to('/admin');
                }                

                if ($checkuser->type == 2) {
                    $cart=Cart::where('user_id',$checkuser->id)->count();

                    Auth::login($checkuser);
                    
                    Storage::disk('local')->put("cart", $cart);

                    return Redirect::to('/');
                }
                
            } else {
                return Redirect::back()->with('danger', trans('messages.invalid_otp'));
            }  
        } else {
            return Redirect::back()->with('danger', trans('messages.invalid_email'));
        }   
    }

    public function forgot_password()
    {
        return view('Front.forgotpassword');
    }
    public function send_pass(Request $request)
    {
        $validator = Validator::make($request->all(),
            [ 'email' => 'required'],
            [ "email.required"=>trans('messages.email_required')]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $checkuser = User::where('email',$request->email)->where('type',2)->first();
            if(!empty($checkuser)){
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8 );
                $helper = Helper::forgotpassword($checkuser->email,$checkuser->name,$password);
                if($helper == 1){
                    $update = User::where('email', $request['email'])->update(['password'=>Hash::make($password)]);
                    return Redirect::to('/signin')->with('success', trans('messages.password_sent'));
                }else{
                    return Redirect::back()->with('danger', trans('messages.wrong_while_email'));
                }
            }else{
                return Redirect::back()->with('danger', trans('messages.invalid_user'));
            }
        }
    }

    public function logout() {
        Session::flush ();
        Auth::logout ();
        return Redirect::to('/');
    }
}
