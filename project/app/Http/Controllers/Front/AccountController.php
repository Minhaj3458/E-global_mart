<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AccountController extends Controller
{
    public function index()
    {
        return view('Front.account');
    }

    public function editprofile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);

        $data = new User;
        $data->exists = true;
        $data->id = Auth::user()->id;

        if(isset($request->profile_pic)){

            if($request->hasFile('profile_pic')){
                File::delete('storage/app/public/images/profile/' . $request->old_img);

                $profile_pic = $request->file('profile_pic');
                $profile_pic = 'profile_pic-' . uniqid() . '.' . $request->profile_pic->getClientOriginalExtension();
                $request->profile_pic->move('storage/app/public/images/profile', $profile_pic);
                $data->profile_pic=$profile_pic;
            }            
        }

        $data->name =$request->name;
        $data->save();

        if ($data) {
             return redirect()->back()->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    public function changepassword(Request $request)
    {
        $this->validate($request,[
            'oldpassword'=>'required|min:6',
            'newpassword'=>'required|min:6',
            'confirmpassword'=>'required_with:newpassword|same:newpassword|min:6',
        ]);
        $check_user=User::where('id',Auth::user()->id)->get()->first();
        if(Hash::check($request['oldpassword'],$check_user->password))
        {
            $data['password']=Hash::make($request['newpassword']);
            $update=User::where('id',Auth::user()->id)->update($data);
            return redirect()->back()->with('success',trans('messages.successfull'));
        }else{
            return redirect()->back()->with('danger',trans('messages.old_pass_invalid'));
        }
    }
}
