<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LoggingController;
use App\Billing;

class BillingController extends Controller
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
        $this->validate($request,["date_billed"=>"required","amount"=>"required","particulars"=>"required"]);
        $save_Billing=new Billing();
        $save_Billing->billing_type=$request->billing_type;
        $save_Billing->matter_id=$request->matter_id;
        $save_Billing->user_id=\Auth::user()->id;     
        $to_date = date_create(str_replace("/", "-", $request->date_billed));
        $save_Billing->date_billed=date_timestamp_get($to_date);
        $save_Billing->amount=str_replace(",","", $request->amount);
        $save_Billing->number_of_hours=$request->number_of_hours;
        $save_Billing->particulars=$request->particulars;
        $save_Billing->status='0';//not invoiced
        $save_Billing->company_id = \Auth::user()->company_id;
        try {
           $save_Billing->save();
           $status="Bill Saved successfully"; 

           $save_log=new LoggingController();
           $save_log->userlog($save_Billing->id,"Billing","Saving a billing ".$_SERVER['REQUEST_URI']);


        } catch (\Exception $e) {
        
        }

        return redirect()->back()->with(compact('status'));
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
        $update_Billing=Billing::find($id);
       
        $update_Billing->status="1";
        try {
            $update_Billing->save();
            $status="This bill has been set to Invoiced.";
        } catch (\Exception $e) {
            
        }

        return redirect()->back()->with(compact('status'));
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
