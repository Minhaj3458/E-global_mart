<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::orderBy('id', 'ASC')->paginate(10);
        return view('Admin.supplier.index',compact('data'));
    }

    public function search(Request $request)
    {
        $data=Supplier::where('store_name', 'LIKE', '%' . $request->search . '%')->orwhere('owner_name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.supplier.index',compact('data'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Admin.supplier.create');
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
            'name' => 'required',
            'owner_name' => 'required',
            'store_name' => 'required',
            'email' => 'required',
            'number' => 'required',
        ]);
        $dataval = new Supplier();
        $dataval->name = $request->name;
        $dataval->owner_name = $request->owner_name;
        $dataval->store_name = $request->store_name;
        $dataval->email = $request->email;
        $dataval->number = $request->number;
        $dataval->website = $request->website;
        $data = $dataval->save();
        if ($data) {
             return redirect('admin/supplier/index')->with('success', 'Supplier has been added');
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
        $data = Supplier::find($id);
        return view('Admin.supplier.update',compact('data'));
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
            'name' => 'required',
            'owner_name' => 'required',
            'store_name' => 'required',
            'email' => 'required',
            'number' => 'required',
        ]);
        $dataval = Supplier::find($id);
        $dataval->name = $request->name;
        $dataval->owner_name = $request->owner_name;
        $dataval->store_name = $request->store_name;
        $dataval->email = $request->email;
        $dataval->number = $request->number;
        $dataval->website = $request->website;
        $data = $dataval->save();
        if ($data) {
             return redirect('admin/supplier/index')->with('success', 'Supplier has been updated');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
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
        $data=Supplier::where('id',$request->id)->delete();
        if($data) {
            return 1000;
        } else {
            return 2000;
        }
    }
}
