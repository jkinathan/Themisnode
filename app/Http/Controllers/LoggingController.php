<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\Logging;
use App\Billing;

class LoggingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $title = "List of logs";
       return view('logs')->with(['logs'=>Logging::all()->where('company_id',\Auth::user()->company_id),'title'=>$title]);
      
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
        $this->validate($request,['from'=>'required','to'=>'required']);   
        $from_date = date_create(str_replace("/", "-", $request->from));
        $from = date_timestamp_get($from_date);

        $to_date = date_create(str_replace("/", "-", $request->to));
        $to = date_timestamp_get($to_date);

        $save_log=new LoggingController();
        $save_log->userlog("","Billing","Viewing Billing report ".$_SERVER['REQUEST_URI']);
        
        $title="Billings From: ".date("d M Y",$from)." To: ".date("d M Y",$to);

        return view("report.billing_list")->with(['billings'=>Billing::whereBetween('date_billed', [$from,$to])->where('company_id',\Auth::user()->company_id)->get(),'title'=>$title]); 
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

    public function userlog($object_code,$object_name,$object_decription)
    {
        $save_logs = new Logging();
        $save_logs->object_code=$object_code;
        $save_logs->object_name=$object_name;
        $save_logs->ip_address=$this->get_client_ip();
        $save_logs->user_code=\Auth::user()->id;
        $save_logs->user_email=\Auth::user()->email;
        $save_logs->user_name=\Auth::user()->name;
        $save_logs->object_decription = $object_decription;
        $save_logs->company_id = \Auth::user()->company_id;
        try {
            $save_logs->save();
        } catch (\Exception $e) {}
    }


    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
