<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Auth;
use Hash;
use Session;
use DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {  
       
        if(Auth::user()){
            return redirect()->route('admin.home');
        }
        return view('Admin.auth.login');
    }

    public function doLogin(Request $request)
    {
        // try{
        //     if( ini_get('allow_url_fopen') ) {
        //         $payload = file_get_contents('https://gravityinfotech.net/api/keyverify.php?url='.str_replace('login', '', url()->current()).'&type=login');
        //         $obj = json_decode($payload);

        //         if ($obj->status == '1') {
                    $this->validate($request,[
                        'email' => 'required|email',
                        'password' => 'required|min:6',
                    ]);

                    $auth=Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                    if ($auth) {
                        // dd(Auth::user()->roles);
                        // if(isset(Auth::user()->roles->pluck('name')[0])){
                        //     if(Auth::user()->roles->pluck('name')[0]=="super-admin" OR Auth::user()->roles->pluck('name')[0]=="admin"){
                                return redirect(route('admin.home'));
                            // }
                        // }
                        
                    }
                    return redirect()->back()->with('error', 'Oops! Invalid Login Details');
                // } elseif ($obj->status == '3') {
                //     return Redirect::to('/admin')->with('danger', $obj->message);
                // } else {
                //     return Redirect::to('/admin/verification')->with('danger', $obj->message);
                // }
        //     }
        // }catch(Exception $exception){
        //     return back()->withError($exception->getMessage())->withInput();    
        // }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('admin_login_form'));
    }

    public function profile(Request $request)
    {
        
    }

    public function changePassword(Request $request)
    {
    
    }

    public function systemverification(Request $request)
    {
        if( ini_get('allow_url_fopen') ) {
            $username = str_replace(' ','',$request->envato_username);

            $payload = file_get_contents('https://gravityinfotech.net/api/getdata.php?envato_username='.$username.'&email='.$request->email.'&purchase_key='.$request->purchase_key.'&domain='.$request->domain.'&purchase_type=Envato&version=1');

            $obj = json_decode($payload);

            if ($obj->status == '1') {
                return Redirect::to('/admin')->with('success', 'You have successfully verified your License. Please try to Login now. If any query Contact us infotechgravity@gmail.com');
            } else {
                return Redirect::back()->with('danger', $obj->message);
            }
        } else {
            return Redirect::back()->with('danger', "allow_url_fopen is disabled. file_get_contents would not work. ASK TO YOUR SERVER SUPPORT TO ENABLE THIS 'allow_url_fopen' AND TRY AGAIN");
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
                return Redirect::back()->with('danger', "Invalid OTP");
            }  
        } else {
            return Redirect::back()->with('danger', "Invalid email");
        }   
    }
    public function vendor_login(Request $request,$slug)
    {
        $vendor = User::where('slug',$slug)->first();
        Auth::loginUsingId($vendor->id, TRUE);
        Session::put('back_admin',1);
        return redirect(route('admin.home'));
    }
    public function go_back()
    {
        Auth::loginUsingId(1, TRUE);
        session()->flush();
        return redirect(route('admin.home'));
    }
}
