<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Settings;
use App\Models\Help;
use App\Models\Transaction;
use App\Helpers\Helper;
use Auth;
use Str;
use Validator;
use App\Traits\SmsTrait;

class UserController extends Controller
{
    use SmsTrait;
    
    public function register(Request $request )
    {
        $checkemail=User::where('email',$request->email)->first();
        $checkmobile=User::where('mobile',$request->mobile)->first();

        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
        $referral_code = substr(str_shuffle($str_result), 0, 10); 
        $otp = rand ( 100000 , 999999 );
        

        if ($request->register_type == "email") {
            if($request->email == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
            }
            if($request->name == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.name_required')],400);
            }
            if($request->mobile == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
            }
            if($request->token == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.firebace_token')],400);
            }

            if(!empty($checkemail))
            {
                return response()->json(['status'=>0,'message'=>trans('messages.email_exist')],400);
            }

            if(!empty($checkmobile))
            {
                return response()->json(['status'=>0,'message'=>trans('messages.mobile_exist')],400);
            }

            if ($request->login_type == "google" OR $request->login_type == "facebook") {
                $password = "";
            } else {
                $password = Hash::make($request->get('password'));
            }

            $getdata=Settings::select('referral_amount')->first();
            $checkreferral=User::select('id','name','referral_code','wallet','email','token')->where('referral_code',$request['referral_code'])->first();

            // if (@$checkreferral->referral_code == $request['referral_code']) {

                // $helper = Helper::emailverification($request->email,$otp);
                $helper = 1; // Email Send off.
                
                
                $phone_number = $request->mobile;
                //$phone_number = '+88'.$request->mobile;
               // $phone_number = str_replace("+8800", "880", $phone_number);
               // $phone_number = str_replace("+880", "880", $phone_number);
                $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: $otp  Please Verify.";
                $this->sendSMS($phone_number, $otpMsg);
                
                if($helper == 1){
                    $checkslug = User::where('slug',Str::slug($request->name, '-'))->first();
                    if($checkslug != ""){
                        $last = User::select('id')->orderByDesc('id')->first();
                        $create = $request->name." ".($last->id+1);
                        $slug = Str::slug($create,'-');
                    }else{
                        $slug = Str::slug($request->name, '-');
                    }

                    $userdata=array('name'=>$request->name,'mobile'=>$phone_number,'email'=>$request->email,'profile_pic'=>'default.png','password'=>Hash::make($request->password),'token'=>$request->token,'login_type'=>$request->login_type,'google_id'=>$request->google_id,'facebook_id'=>$request->facebook_id,'referral_code'=>$referral_code,'type'=>'2','slug'=>$slug,'otp'=>$otp,'is_verified'=>2,'login_type'=>'email');
                    $roledata=User::create($userdata);

                    $wallet = @$checkreferral->wallet + @$getdata->referral_amount;

                    if ($request['referral_code'] != "") {
                       $wallet = $checkreferral->wallet + $getdata->referral_amount;

                       if ($wallet) {
                           $UpdateWalletDetails = User::where('id', $checkreferral->id)->update(['wallet' => $wallet]);

                           $from_Wallet = new Transaction;
                           $from_Wallet->user_id = $checkreferral->id;
                           $from_Wallet->order_id = null;
                           $from_Wallet->order_number = null;
                           $from_Wallet->wallet = $getdata->referral_amount;
                           $from_Wallet->payment_id = null;
                           $from_Wallet->order_type = '0';
                           $from_Wallet->type = 'referral';
                           $from_Wallet->transaction_type = '3';
                           $from_Wallet->username = $roledata->name;
                           $from_Wallet->save();

                           //Notification
                           try{
                               $email=$checkreferral->email;
                               $toname=$checkreferral->name;
                               $name=$roledata->name;
                               
                               $referralmessage='Your friend "'.$name.'" has used your referral code to register with E-Global Mart Ltd. User. You have earned '. Helper::CurrencyFormatter($getdata->referral_amount).' referral amount in your wallet.';
                               $data=['referralmessage'=>$referralmessage,'email'=>$email,'toname'=>$toname,'name'=>$name,"logo"=>Helper::webinfo()->image];

                               Mail::send('Email.referral',$data,function($message)use($data){
                                   $message->from(env('MAIL_USERNAME'))->subject($data['referralmessage']);
                                   $message->to($data['email']);
                               } );

                               $title = trans('labels.referral_earning');
                               $body = 'Your friend "'.$name.'" has used your referral code to register with E-Global Mart Ltd. User. You have earned '. Helper::CurrencyFormatter($getdata->referral_amount).' referral amount in your wallet.';
                               Helper::push_notification($title,$body,$checkreferral->token);

                           }catch(\Swift_TransportException $e){
                               $response = $e->getMessage() ;
                               return response()->json(['status'=>0,'message'=>trans('messages.email_error')],200);
                           }
                       }
                       if ($getdata->referral_amount) {
                           $UpdateWallet = User::where('id', $roledata->id)->update(['wallet' => $getdata->referral_amount]);
                           $to_Wallet = new Transaction;
                           $to_Wallet->user_id = $roledata->id;
                           $to_Wallet->order_id = null;
                           $to_Wallet->order_number = null;
                           $to_Wallet->wallet = $getdata->referral_amount;
                           $to_Wallet->payment_id = null;
                           $to_Wallet->order_type = '0';
                           $to_Wallet->type = 'referral';
                           $to_Wallet->transaction_type = '3';
                           $to_Wallet->username = $checkreferral->name;
                           $to_Wallet->save();
                       }
                    }
                    if($roledata){
                        $arrayName = array(
                            'id' => $roledata->id,
                            'name' => $roledata->name,
                            'mobile' => $roledata->mobile,
                            'email' => $roledata->email,
                            'referral_code' => $roledata->referral_code,
                            'profile_pic' => Helper::image_path($roledata->profile_pic),
                        );
                        return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$arrayName],200);
                    }else{
                        return response()->json(['status'=>0,'message'=>trans('messages.fail')],400);
                    }
                }else{
                    return response()->json(['status'=>0,'message'=>trans('messages.wrong_while_email')],400);
                }
            // } else {
            //     return response()->json(['status'=>0,'message'=>trans('messages.referral_code_invalid')],200);
            // }
        }
        if ($request->login_type == "google") {
            if($request->email == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
            }
            if($request->name == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.name_required')],400);
            }
            if($request->token == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.firebace_token')],400);
            }
            if($request->google_id == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.google_id')],400);
            }

            $usergoogle=User::where('google_id',$request->google_id)->first();
            if ($usergoogle != "" OR @$usergoogle->email == $request->email AND $request->email != "") {
                if ($usergoogle->mobile == "") {
                    $arrayName = array(
                        'id' => $usergoogle->id
                    );
                    return response()->json(['status'=>2,'message'=>trans('messages.mobile_required'),'data'=>$arrayName],200);
                } else {
                    if($usergoogle->is_verified == '1') 
                    {
                        if($usergoogle->is_available == '1') 
                        {
                            $arrayName = array(
                                'id' => $usergoogle->id,
                                'name' => $usergoogle->name,
                                'mobile' => $usergoogle->mobile,
                                'email' => $usergoogle->email,
                                'referral_code' => $usergoogle->referral_code,
                                'profile_pic' => Helper::image_path($usergoogle->profile_pic),
                            );

                            $update=User::where('email',$usergoogle['email'])->update(['token'=>$request->token]);
                            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$arrayName],200);
                        } else {
                            return response()->json(['status'=>0,'message'=>trans('messages.blocked')],200);
                        }
                    } else {
                        $helper = Helper::emailverification($usergoogle->email,$otp);
                        if($helper == 1){
                            $otp_data['otp'] = $otp;
                            $update=User::where('email',$usergoogle->email)->update($otp_data);

                            return response()->json(['status'=>3,'message'=>trans('messages.verify_email'),'otp'=>$otp],422);
                        }else{
                            return response()->json(['status'=>0,'message'=>trans('messages.wrong_while_email')],400);
                        }
                    }
                }
            } else {
                
                if(!empty($checkemail))
                {
                    return response()->json(['status'=>0,'message'=>trans('messages.email_exist')],400);
                }

                return response()->json(['status'=>2,'message'=>trans('messages.successfull')],200);

            }
        } elseif ($request->login_type == "facebook") {
            if($request->email == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
            }
            if($request->name == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.name_required')],400);
            }
            if($request->token == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.firebace_token')],400);
            }
            if($request->facebook_id == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.facebook_id')],400);
            }

            $userfacebook=User::where('users.facebook_id',$request->facebook_id)->first();

            if ($userfacebook != "" OR @$userfacebook->email == $request->email AND $request->email != "") {
                if ($userfacebook->mobile == "") {
                    $arrayName = array(
                        'id' => $userfacebook->id
                    );
                    return response()->json(['status'=>2,'message'=>trans('messages.mobile_required'),'data'=>$arrayName],200);
                } else {
                    if($userfacebook->is_verified == '1') 
                    {
                        if($userfacebook->is_available == '1') 
                        {
                            $arrayName = array(
                                'id' => $userfacebook->id,
                                'name' => $userfacebook->name,
                                'mobile' => $userfacebook->mobile,
                                'email' => $userfacebook->email,
                                'referral_code' => $userfacebook->referral_code,
                                'profile_pic' => Helper::image_path($userfacebook->profile_pic),
                            );
                            $update=User::where('email',$userfacebook['email'])->update(['token'=>$request->token]);
                            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$arrayName],200);
                        } else {
                            return response()->json(['status'=>0,'message'=>trans('messages.blocked')],200);
                        }
                        
                    } else {

                        $helper = Helper::emailverification($userfacebook->email,$otp);
                        if($helper == 1){
                            $otp_data['otp'] = $otp;
                            $update=User::where('email',$userfacebook->email)->update($otp_data);

                            return response()->json(['status'=>3,'message'=>trans('messages.verify_email'),'otp'=>$otp],422);
                        }else{
                            return response()->json(['status'=>0,'message'=>trans('messages.wrong_while_email')],400);
                        }
                    }
                }
            } else {
                if(!empty($checkemail)){
                    return response()->json(['status'=>0,'message'=>trans('messages.email_exist')],400);
                }
                return response()->json(['status'=>2,'message'=>trans('messages.successfull')],200);
            }
        }
    }

    public function login(Request $request )
    {
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        if($request->password == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.password_required')],400);
        }
        
        $login=User::where('email',$request['email'])->where('type','=','2')->first();

        if(!empty($login))
        {
            if($login->is_verified == '1') 
            {
                if($login->is_available == '1') 
                {
                    if(Hash::check($request->get('password'),$login->password))
                    {
                        $arrayName = array(
                            'id' => $login->id,
                            'name' => $login->name,
                            'mobile' => $login->mobile,
                            'email' => $login->email,
                            'referral_code' => $login->referral_code,
                            'notification_status' => $login->notification_status,
                            'profile_pic' => Helper::image_path($login->profile_pic),
                        );

                        $data_token['token'] = $request['token'];
                        $update=User::where('email',$request['email'])->update($data_token);
                        return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$arrayName],200);
                    }else{
                        return response()->json(['status'=>0,'message'=>trans('messages.invalid')],422);
                    }
                }
                else
                {
                    return response()->json(['status'=>0,'message'=>trans('messages.blocked')],422);
                }
            } else {
                $otp = rand ( 100000 , 999999 );
                // $helper = Helper::emailverification($request->email,$otp);
                $helper = 1; // Email Send off.
                if($helper == 1){
                    $otp_data['otp'] = $otp;
                    $update=User::where('email',$request->email)->update($otp_data);
                    
                    $phoneNumber = $login->mobile;
                    $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: $otp  Please Verify.";

                    $this->sendSMS($phoneNumber, $otpMsg);
                        
                    return response()->json(['status'=>2,'message'=>trans('messages.verify_email'),'otp'=>$otp],422);
                }else{
                    return response()->json(['status'=>0,'message'=>trans('messages.wrong_while_email')],400);
                }
            }
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.invalid')],422);
        }
    }
    
     public function mobileverify(Request $request )
    {
         /* 
           if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
           }
        */
        if($request->mobile == ""){
            //return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }
        /*
        if($request->token == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.firebase_token')],400);
        }
        */
        if($request->otp == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.otp_required')],200);
        }
        //$checkuser=User::where('email',$request->email)->first();
        $checkuser=User::where('mobile',$request->mobile)->first();
        //$checkmobile=User::where('mobile',$request['mobile'])->first();

        if (!empty($checkuser)) {
            if ($checkuser->otp == $request->otp) {
                $update=User::where('mobile',$request['mobile'])->update(['otp'=>null,'is_verified'=>'1','token'=>$request->token]);

                $arrayName = array(
                    'id' => $checkuser->id,
                    'name' => $checkuser->name,
                    'mobile' => $checkuser->mobile,
                    'email' => $checkuser->email,
                    'referral_code' => $checkuser->referral_code,
                    'profile_pic' => Helper::image_path($checkuser->profile_pic),
                );
                return response()->json(['status'=>1,'message'=>trans('messages.verification_success'),'data'=>$arrayName],200);

            } else {
                return response()->json(["status"=>0,"message"=>trans('messages.invalid_otp')],200);
            } 
        } else {
            return response()->json(["status"=>0,"message"=>trans('messages.invalid')],400);
        }  
    }

    public function emailverify(Request $request )
    {
         /* 
           if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
           }
        */
        if($request->mobile == ""){
            //return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }
        /*
        if($request->token == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.firebase_token')],400);
        }
        */
        if($request->otp == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.otp_required')],200);
        }
        //$checkuser=User::where('email',$request->email)->first();
        $checkuser=User::where('mobile',$request->mobile)->first();
        //$checkmobile=User::where('mobile',$request['mobile'])->first();

        if (!empty($checkuser)) {
            if ($checkuser->otp == $request->otp) {
                $update=User::where('mobile',$request['mobile'])->update(['otp'=>null,'is_verified'=>'1','token'=>$request->token]);

                $arrayName = array(
                    'id' => $checkuser->id,
                    'name' => $checkuser->name,
                    'mobile' => $checkuser->mobile,
                    'email' => $checkuser->email,
                    'referral_code' => $checkuser->referral_code,
                    'profile_pic' => Helper::image_path($checkuser->profile_pic),
                );
                return response()->json(['status'=>1,'message'=>trans('messages.verification_success'),'data'=>$arrayName],200);

            } else {
                return response()->json(["status"=>0,"message"=>trans('messages.invalid_otp')],200);
            } 
        } else {
            return response()->json(["status"=>0,"message"=>trans('messages.invalid')],400);
        }  
    }

    public function resendemailverification(Request $request )
    {
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        $checkuser=User::where('email',$request->email)->first();
        if (!empty($checkuser)) {
            $otp = rand ( 100000 , 999999 );
            $helper = Helper::emailverification($request->email,$otp);
            if($helper == 1){
                $update=User::where('email',$request['email'])->update(['otp'=>$otp,'is_verified'=>'2']);
                return response()->json(["status"=>1,"message"=>trans('messages.otp_sent'),'otp'=>$otp],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.wrong_while_email')],400);
            }
        } else {
            return response()->json(["status"=>0,"message"=>trans('messages.invalid_user')],400);
        }  
    }
    
       public function resendmobileotpverification(Request $request )
    {
        /*
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        */
        if($request->mobile == ""){
            //return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }
        //$checkuser=User::where('email',$request->email)->first();
        $checkuser=User::where('mobile',$request->mobile)->first();
        if (!empty($checkuser)) {
            $otp = rand ( 100000 , 999999 );
            //$helper = Helper::emailverification($request->email,$otp);
            $helper = 1; // Email Send off.
                
                
                $phone_number = $request->mobile;
                //$phone_number = '+88'.$request->mobile;
               // $phone_number = str_replace("+8800", "880", $phone_number);
               // $phone_number = str_replace("+880", "880", $phone_number);
                $otpMsg = "Thanks for E-Global Mart Ltd Registration. Your OTP: $otp  Please Verify.";
                $this->sendSMS($phone_number, $otpMsg);
            if($helper == 1){
                //$update=User::where('email',$request['email'])->update(['otp'=>$otp,'is_verified'=>'2']);
                $update=User::where('mobile',$request['mobile'])->update(['otp'=>$otp,'is_verified'=>'2']);
                return response()->json(["status"=>1,"message"=>trans('messages.mobile_otp_sent'),'otp'=>$otp],200);
            }else{
                //return response()->json(['status'=>0,'message'=>trans('messages.wrong_while_email')],400);
                return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
            }
        } else {
            return response()->json(["status"=>0,"message"=>trans('messages.invalid_user')],400);
        }  
    }

    public function AddMobile(Request $request)
    {
        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        $checkmobile=User::where('mobile',$request['mobile'])->first();
        if(!empty($checkmobile)){
            return response()->json(['status'=>0,'message'=>trans('messages.mobile_exist')],400);
        }
        try {
            $update=User::where('id',$request['user_id'])->update($data);
            return response()->json(["status"=>1,"message"=>trans('messages.update')],200);
        } catch (\Exception $e){
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],400);
        }
    }

    public function getprofile(Request $request )
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        $users = User::find($request->user_id);
        if(!empty($users)){
            if ($users->mobile == "") {
                $mobile = "";
            } else {
                $mobile = $users->mobile;
            }
            $arrayName = array(
                'id' => $users->id,
                'name' => $users->name,
                'mobile' => $mobile,
                'email' => $users->email,
                'referral_code' => $users->referral_code,
                'notification_status' => $users->notification_status,
                'profile_pic' => Helper::image_path($users->profile_pic)
            );

            if(!empty($arrayName))
            {
                $contactinfo=Settings::select('address','contact','email','facebook','twitter','instagram','linkedin')
                ->first();
                return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$arrayName,'contactinfo'=>$contactinfo],200);
            } else {
                return response()->json(['status'=>0,'message'=>trans('messages.no_data')],400);
            }
        }else{
            return response()->json(["status"=>0,"message"=>trans('messages.invalid_user')],400);
        }
    }

    public function changenotificationstatus(Request $request )
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user')],200);
        }
        $checkuser = User::find($request->user_id);
        if(!empty($checkuser))
        {
            if($request->notification_status == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.notification_status_required')],200);
            }
            $checkuser->notification_status = $request->notification_status;
            $checkuser->save();
            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);    
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.invalid_user')],200);
        }
    }

    public function editprofile(Request $request )
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        if($request->name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.name_required')],400);
        }
        $checkuser = User::find($request->user_id);
        if(!empty($checkuser)){

            if($request->hasFile('image')){
                $image = $request->file('image');
                $image = 'profile-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move('storage/app/public/images/profile', $image);
                $checkuser->profile_pic=$image;
            }
            $checkuser->name =$request->name;

            if($checkuser->save()){
                $arrayName = array(
                    'id' => $checkuser->id,
                    'name' => $checkuser->name,
                    'mobile' => $checkuser->mobile,
                    'email' => $checkuser->email,
                    'profile_pic' => Helper::image_path($checkuser->profile_pic),
                );
                return response()->json(['status'=>1,'message'=>trans('messages.update'),'data'=>$arrayName],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.fail')],400);
            }
        }else{
            return response()->json(["status"=>0,"message"=>trans('messages.invalid_user')],400);
        }
    }

    public function changepassword(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user')],400);
        }
        if($request->old_password == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.old_password')],400);
        }
        if($request->new_password == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.new_password')],400);
        }
        $checkuser=User::find($request->user_id);
        if(!empty($checkuser)){
            if(Hash::check($request->old_password,$checkuser->password))
            {
                $checkuser->password = Hash::make($request->new_password);
                $checkuser->save();
                return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.old_pass_invalid')],400);
            }
        }else{
            return response()->json(["status"=>0,"message"=>trans('messages.invalid_user')],400);
        }
    }

    public function forgotPassword(Request $request)
    {
        /*
        
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        
        */
        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }

        //$checklogin=User::where('email',$request['email'])->first();
        $checklogin=User::where('mobile',$request['mobile'])->first();
        
        if(empty($checklogin))
        {
            return response()->json(['status'=>0,'message'=>trans('messages.invalid')],400);
        } elseif ($checklogin->google_id != "" OR $checklogin->facebook_id != "") {
            return response()->json(['status'=>0,'message'=>trans('messages.social_login')],200);
        } else {
            try{
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8 );
                $newpassword['password'] = Hash::make($password);
                $update = User::where('mobile', $request['mobile'])->update($newpassword);

                /*
                
                $title=trans('labels.password_reset');
                $data=['title'=>$title,'email'=>$checklogin->email,'name'=>$checklogin->name,'password'=>$password,"logo"=>Helper::webinfo()->image];

                Mail::send('Email.email',$data,function($message)use($data){
                    $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                    $message->to($data['email']);
                } );
                
                */
                $phone_number = $request->mobile;
                //$phone_number = '+88'.$request->mobile;
               // $phone_number = str_replace("+8800", "880", $phone_number);
               // $phone_number = str_replace("+880", "880", $phone_number);
                $otpMsg = "Thanks being with E-Global Mart Ltd. Your password is $password";
                $this->sendSMS($phone_number, $otpMsg);
                
                return response()->json(['status'=>1,'message'=>trans('messages.password_sent_mobile')],200);
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                return response()->json(['status'=>0,'message'=>trans('messages.invalid_mobile')],200);
            }
        }

    }

    public function help(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user')],400);
        }
        if($request->first_name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.first_name_required')],400);
        }
        if($request->last_name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.lastname_required')],400);
        }
        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.mobile')],400);
        }
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email')],400);
        }
        if($request->subject == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.subject_required')],400);
        }
        if($request->message == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.message_required')],400);
        }

        $help = new Help;
        $help->user_id = $request->user_id;
        $help->first_name = $request->first_name;
        $help->last_name = $request->last_name;
        $help->mobile = $request->mobile;
        $help->email = $request->email;
        $help->subject = $request->subject;
        $help->message = $request->message;
        $help->save();

        if ($help) {
          return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        } else {
          return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }

    public function vendors()
    {
        $vendors=User::with('rattings')->select('id','name',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', profile_pic) AS image_url"))
        ->where('type','3')
        ->where('is_available','1')
        ->orderBy('id', 'DESC')
        ->paginate(10);

        if ($vendors) {
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'vendors'=>$vendors],200);
        } else {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }

    public function vendorsregister(Request $request)
    {
        if($request->name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.name_required')],400);
        }
        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        $checkemail = User::where('email',$request->email)->first();
        if(!empty($checkemail)){
            return response()->json(['status'=>0,'message'=>trans('messages.email_exist')],400);
        }
        $checkmobile = User::where('mobile',$request->mobile)->first();
        if(!empty($checkmobile)){
            return response()->json(['status'=>0,'message'=>trans('messages.mobile_exist')],400);
        }
        if($request->password == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.password_required')],400);
        }
        if($request->token == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.firebace_token')],400);
        }
        
        $otp = rand ( 100000 , 999999 );
        
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
        $referral_code = substr(str_shuffle($str_result), 0, 10); 

        $checkslug = User::where('slug',Str::slug($request->first_name.' '.$request->last_name, '-'))->first();
        if($checkslug != ""){
            $last = User::select('id')->orderByDesc('id')->first();
            $create = $request->first_name.' '.$request->last_name." ".($last->id+1);
            $slug = Str::slug($create,'-');
        }else{
            $slug = Str::slug($request->first_name.' '.$request->last_name, '-');
        }

        $userdata=array('name'=>$request->name,'mobile'=>$request->mobile,'email'=>$request->email,'profile_pic'=>'default.png','password'=>Hash::make($request->password),'referral_code'=>$referral_code,'slug'=>$slug,'otp'=>$otp,'type'=>'3','is_verified'=>2,'is_available'=>'2','login_type'=>'email');
        $roledata=User::create($userdata);

        if ($roledata) {

            //$helper = Helper::emailverification($request->email,$otp);
            $helper=1; // Email Send off.
            if($helper == 1){
                
               // $phone_number = $request->mobile;
               // $otpMsg = "Thanks for E-Global Mart Ltd Registration. Please contact with us.";
               // $this->sendSMS($phone_number, $otpMsg);
                
                /*
                if (env('Environment') == 'sendbox') {
                    session ( [
                        'email' => $request->email,
                        'otp' => $otp,
                    ] );
                } else {
                    session ( [
                        'email' => $request->email,
                    ] );
                }
                
                */
                
                return response()->json(['status'=>1,'message'=>trans('messages.approval_wait')],200);
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.invalid')],400);
            }
        } else {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],400);
        }
    }
}
