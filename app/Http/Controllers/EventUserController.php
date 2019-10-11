<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\EventUser;
use App\MatterEvent;
use App\Communication;
use App\User;
use App\Client;

class EventUserController extends Controller
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
        foreach ($request->user as $user_value) {
            $save_EventUser = new EventUser();
            $save_EventUser->user_id=$user_value;
            $save_EventUser->matterevent_id=$request->matterevent_id;
            try {
                $save_EventUser->save();
            } catch (\Exception $e) {
                
            }

            $sms_engine = new Communication();
            $user=User::find($user_value);
            $save_matterevent=MatterEvent::find($request->matterevent_id);
            $sms=$save_matterevent->description." <br><br> From: ".$save_matterevent->start."<br> To: ".$save_matterevent->end;     
        
                try {
                   $sms_engine->send_Email($user->email,$save_matterevent->title,$sms,\Auth::user()->email);
                   $sms_engine->send_SMS($save_matterevent->title."\nFrom: ".$save_matterevent->start."\nTo: ".$save_matterevent->end,$user->phone_number);
                } catch (\Exception $e) {
                    //echo $e->getMessage();
                    //exit();
                }               
           
        }

        return redirect()->route('matter_event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $read_Client = Client::find($id);
        $title = "Report Details for ".$read_Client->name;

        $save_log=new LoggingController();
        $save_log->userlog($id,"Client","Showing comprehessive client content ".$_SERVER['REQUEST_URI']);

        return view('client.report')->with(compact('read_Client','title'));
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
