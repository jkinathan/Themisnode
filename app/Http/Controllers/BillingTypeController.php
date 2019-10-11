<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillingType;
use App\Http\Controllers\LoggingController;

class BillingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title="Billing types";
        $raed_BillingType=BillingType::all();
        return view('billing_type.create')->with(compact('title','raed_BillingType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,["name"=>"required"]);
        $save_BillingType=new BillingType();
        $save_BillingType->name=$request->name;
        $save_BillingType->save();

        $save_log=new LoggingController();
        $save_log->userlog($save_BillingType->id,"BillingType","Saving a billing type ".$_SERVER['REQUEST_URI']);

        return redirect()->back();
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
        //
        $read_BillingType=BillingType::find($id);
        $title="";
        return view('billing_type.edit')->with(compact('read_BillingType','title'));
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
        //

        $save_BillingType=BillingType::find($id);
        $save_BillingType->name=$request->name;
        $save_BillingType->save();

        $save_log=new LoggingController();
        $save_log->userlog($save_BillingType->id,"BillingType","Editing a billing type ".$_SERVER['REQUEST_URI']);

        return redirect()->route('billing_type.create');
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
