<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help;
use Auth;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Front.help');
    }

    public function helpform(Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $dataval=array('user_id'=>@Auth::user()->id,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'mobile'=>$request->mobile,'subject'=>$request->subject,'message'=>$request->message);
        $data=Help::create($dataval);
        if ($data) {
            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }
}
