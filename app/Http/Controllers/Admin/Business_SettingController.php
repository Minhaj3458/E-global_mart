<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business_Setting;

class Business_SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Business_Setting::orderBy('id', 'ASC')->paginate(10);
        return view('Admin.business_setting.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('Admin.business_setting.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'level' => 'required|unique:business__settings',
            'amount' => 'required',
        ]);
        $dataval = new Business_Setting();
        $dataval->level = $request->level;
        $dataval->amount = $request->amount;
        $data = $dataval->save();
        if ($data) {
             return redirect('admin/business_setting/index')->with('success', 'Lavel has been added');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Business_Setting::find($id);
        return view('Admin.business_setting.update_business_setting',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'level' => 'required',
            'amount' => 'required',
        ]);
        $dataval = Business_Setting::find($id);
        $dataval->level = $request->level;
        $dataval->amount = $request->amount;
        $data = $dataval->save();
        if ($data) {
             return redirect('admin/business_setting/index')->with('success', 'Lavel has been updated');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
        }
    }

    public function search(Request $request)
    {
        $data=Business_Setting::where('level', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.business_setting.index',compact('data'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
