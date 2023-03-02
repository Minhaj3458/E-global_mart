<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function saveaddress(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        if($request->first_name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.first_name_required')],400);
        }
        if($request->last_name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.lastname_required')],400);
        }
        if($request->street_address == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.address_required')],400);
        }
        if($request->pincode == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.pincode_required')],400);
        }
        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        $dataval=array('user_id'=>$request->user_id,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'street_address'=>$request->street_address,'landmark'=>$request->landmark,'pincode'=>$request->pincode,'mobile'=>$request->mobile,'email'=>$request->email);
        $data=Address::create($dataval);
        if($data){
            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }
    public function getaddress(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],400);
        }
        $addressdata=Address::where('user_id',$request->user_id)->get();
        if(!empty($addressdata)){
            return response()->json(['status'=>1,'message'=>trans('messages.successfull'),'data'=>$addressdata],200);
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }        
    }

    public function editaddress(Request $request)
    {
        if($request->address_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.address_id_required')],400);
        }
        if($request->first_name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.first_name_required')],400);
        }
        if($request->last_name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.lastname_required')],400);
        }
        if($request->street_address == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.address_required')],400);
        }
        if($request->pincode == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.pincode_required')],400);
        }
        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.mobile_required')],400);
        }
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        $updatedata=array('first_name'=>$request->first_name,'last_name'=>$request->last_name,'street_address'=>$request->street_address,'landmark'=>$request->landmark,'pincode'=>$request->pincode,'mobile'=>$request->mobile,'email'=>$request->email);
        $data=Address::find($request->address_id)->update($updatedata);
        if($data){
            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }        
    }
    public function deleteaddress(Request $request)
    {
        if($request->address_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.address_id_required')],400);
        }
        $data=Address::where('id',$request->address_id)->delete();
        if($data){
            return response()->json(['status'=>1,'message'=>trans('messages.successfull')],200);
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }    
    }
}
