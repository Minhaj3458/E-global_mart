<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Auth;

class AddressController extends Controller
{

    public function index(Request $request)
    {
        $myaddress=Address::where('user_id',@Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->get();
        
        return view('Front.address',compact('myaddress'));
    }

    public function saveaddress(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'street_address' => 'required',
            'landmark' => 'required',
            'pincode' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
        ]);

        $dataval=array('user_id'=>Auth::user()->id,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'street_address'=>$request->street_address,'landmark'=>$request->landmark,'pincode'=>$request->pincode,'mobile'=>$request->mobile,'email'=>$request->email);
        $data=Address::create($dataval);

        if ($data) {
            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    public function editaddress(Request $request)
    {
        $this->validate($request,[
            'address_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'street_address' => 'required',
            'pincode' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
        ]);

        $updatedata=array('first_name'=>$request->first_name,'last_name'=>$request->last_name,'street_address'=>$request->street_address,'landmark'=>$request->landmark,'pincode'=>$request->pincode,'mobile'=>$request->mobile,'email'=>$request->email);
        $data=Address::find($request->address_id)->update($updatedata);

        if ($data) {
            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }     
    }

    public function deleteaddress(Request $request)
    {

        $data=Address::where('id',$request->id)->delete();

        if($data)
        {
            return response()->json(['status'=>1,'message'=>'Success'],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }        
    }
}
