<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stockiest;
class StockiestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Stockiest::orderBy('id', 'ASC')->paginate(10);;
        return view('Admin.stockiest.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $user = User::where('type',2)->get();
       return view('Admin.stockiest.create',compact('user'));
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
            'user_id' => 'required',
            'stock_name' => 'required',
            'address' => 'required',
        ]);
        $dataval = new Stockiest();
        $dataval->user_id = $request->user_id;
        $dataval->stock_name = $request->stock_name;
        $dataval->address = $request->address;
        $data = $dataval->save();
        if ($data) {
             return redirect('admin/stockiest/index')->with('success', 'Stock has been added');
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
       $user = User::where('type',2)->get();
       $stock = Stockiest::find($id);
       return view('Admin.stockiest.update',compact('user','stock'));
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
            'user_id' => 'required',
            'stock_name' => 'required',
            'address' => 'required',
        ]);
        $dataval = Stockiest::find($id);
        $dataval->user_id = $request->user_id;
        $dataval->stock_name = $request->stock_name;
        $dataval->address = $request->address;
        $data = $dataval->save();
        if ($data) {
             return redirect('admin/stockiest/index')->with('success', 'Stock has been updated');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
        }
    }



    public function search(Request $request)
    {
        $data=Stockiest::where('stock_name', 'LIKE', '%' . $request->search . '%')->orWhere('address', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.stockiest.index',compact('data'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $dataval = Stockiest::find($id);
        $data = $dataval->delete();
        if ($data) {
            return 1000;
            //  return redirect('admin/stockiest/index')->with('success', 'Stock has been deleted');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
        }
    }
}
