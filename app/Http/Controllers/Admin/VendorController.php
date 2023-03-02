<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Order;
use App\Models\Bank;
use App\Models\Payout;
use App\Models\Banner;
use Auth;
use Str;
use Carbon\Carbon;
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
        $data = User::where('type','3')->orderBy('id', 'DESC')->paginate(10);

        $checkslug = User::get();
        foreach ($checkslug as $value) {
            $slug = Str::slug($value['name'], '-');
            $dataupdate['slug']=$slug;
            User::where('id',$value['id'])->update($dataupdate);
        }

        return view('Admin.vendors.index',compact('data'));
    }
    
    
    public function my_ref_vendor()
    {
        $data = User::where('type','3')->orderBy('id', 'DESC')->paginate(10);

        $checkslug = User::get();
        foreach ($checkslug as $value) {
            $slug = Str::slug($value['name'], '-');
            $dataupdate['slug']=$slug;
            User::where('id',$value['id'])->update($dataupdate);
        }

        return view('Admin.vendors.ref_vendor',compact('data'));
    }

    public function add()
    {
        return view('Admin.vendors.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'country' => 'bail|required',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ]);
                
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

        $vendor = new User();
        $vendor->name = $request->first_name.' '.$request->last_name;
        $vendor->slug = $slug;
        $vendor->mobile = '+'.$request->country.' '.$request->mobile;
        $vendor->email = $request->email;
        $vendor->profile_pic = 'default.png';
        $vendor->password = Hash::make($request->password);
        $vendor->login_type = 'email';
        $vendor->referral_code = $referral_code;
        $vendor->type = 3;
        $vendor->is_verified = 1;
        $vendor->is_available = 1;
        if ($vendor->save()) {
            return Redirect::to('admin/vendors')->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    public function changeStatus(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'status' => 'required',
        ]);

        $data['is_available']=$request->status;
        User::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }

    public function search(Request $request)
    {
        $data=User::where('name', 'LIKE', '%' . $request->search . '%')->where('type','3')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.vendors.index',compact('data'));
    }

    public function vendorprofile(Request $request)
    {
        $data = User::where('type','3')->where('id',Auth::user()->id)->first();
        $bankdata = Bank::where('vendor_id',Auth::user()->id)->first();
        $getbanners = Banner::where('vendor_id',Auth::user()->id)->get();

        return view('Admin.vendors.profile',compact('data','bankdata','getbanners'));
    }

    public function vendordetails(Request $request)
    {
        $data = User::with(['rattings'])->where('type','3')->where('id',$request->id)->first();
        $bankdata = Bank::where('vendor_id',$request->id)->first();
        
        $ttlorders = Order::where('vendor_id',$request->id)->count();
        $ttlcancelorders = Order::where('vendor_id',$request->id)->whereIn('status', ['5', '6'])->count();
        $ttlreturnorders = Order::where('vendor_id',$request->id)->whereIn('status', ['7', '8', '9', '10'])->count();
        $ttlpendingorders = Order::where('vendor_id',$request->id)->where('status', '1')->count();
        $ttlearning = Order::where('vendor_id',$request->id)->where('status','4')->sum('order_total');
        $ttlpending = User::select('wallet')->where('id',$request->id)->first();

        $orders = Order::select(
                    DB::raw("MONTHNAME(created_at) as month_name"),
                    DB::raw("SUM(order_total) as amount"))
                ->where('vendor_id',$request->id)
                ->orderBy('created_at')
                ->groupBy(DB::raw("MONTHNAME(created_at)"))
                ->where("created_at",">", Carbon::now()->subMonths(6))
                ->get();

        $payoutdetails=Payout::select('request_id','vendor_id','amount','commission_pr','commission','paid_amount','status','payment_method','paid_at','created_at')->where('vendor_id',$request->id)->where('status','0')->get();

        return view('Admin.vendors.vendor-details',compact('data','bankdata','orders','ttlorders','ttlcancelorders','ttlreturnorders','ttlpendingorders','ttlearning','ttlpending','payoutdetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'store_address' => 'required',
            'bank_name' => 'required',
            'account_type' => 'required',
            'account_number' => 'required',
            'routing_number' => 'required',
            'profile_pic' => 'mimes:jpeg,png,jpg',
        ]);

        $update = User::find(Auth::user()->id);
        if($request->hasFile('profile_pic')){
            $profile_pic = $request->file('profile_pic');
            $profile_pic = 'profile-' . uniqid() . '.' . $request->profile_pic->getClientOriginalExtension();
            $request->profile_pic->move('storage/app/public/images/profile', $profile_pic);
            $update->profile_pic = $profile_pic;
        }
        if($request->hasFile('store_banner')){
            $store_banner = 'storebanner-' . uniqid() . '.' . $request->store_banner->getClientOriginalExtension();
            $request->store_banner->move('storage/app/public/images/banner', $store_banner);

            $dataval=array('vendor_id'=>Auth::user()->id,'image'=>$store_banner,'positions'=>"store");
            Banner::create($dataval);
        }
        $getbank = Bank::where('vendor_id',Auth::user()->id)->count();
        if ($getbank > 0) {
            $updatebankdata=array('bank_name'=>$request->bank_name,'account_type'=>$request->account_type,'account_number'=>$request->account_number,'routing_number'=>$request->routing_number);
            Bank::where('vendor_id',Auth::user()->id)->update($updatebankdata);
        } else {
            $bankval=array('vendor_id'=>Auth::user()->id,'bank_name'=>$request->bank_name,'account_type'=>$request->account_type,'account_number'=>$request->account_number,'routing_number'=>$request->routing_number);
            Bank::create($bankval);
        }
        $update->name = $request->name;
        $update->email = $request->email;
        $update->mobile = $request->mobile;
        $update->store_address = $request->store_address;
        $update->facebook = $request->facebook;
        $update->instagram = $request->instagram;
        $update->twitter = $request->twitter;
        $update->google = $request->google;
        $update->youtube = $request->youtube;
        if ($update->save()) {
             return redirect('admin/vendors/vendor-profile')->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);
        $data=Banner::where('id',$request->id)->delete();
        if($data) {
            return 1000;
        } else {
            return 2000;
        }
    }
}
