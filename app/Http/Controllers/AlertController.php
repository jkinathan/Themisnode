<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\Expense;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view("report.billing_range")->with(['title'=>'Generating Billing report']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("report.selection_range")->with(['title'=>'Generating expense report']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,['from'=>'required','to'=>'required']);   
         
        $from_date = date_create(str_replace("/", "-", $request->from));
        $from = date_timestamp_get($from_date);

        $to_date = date_create(str_replace("/", "-", $request->to));
        $to = date_timestamp_get($to_date);


        $save_log=new LoggingController();
        $save_log->userlog("","Expense","Viewing expense report ".$_SERVER['REQUEST_URI']);



        $title="Expenses From: ".date("d M Y",$from)." To: ".date("d M Y",$to);

        return view("report.expense_list")->with(['expense'=>Expense::whereBetween('date_spent', [$from,$to])->where('company_id',\Auth::user()->company_id)->get(),'title'=>$title]); 


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
