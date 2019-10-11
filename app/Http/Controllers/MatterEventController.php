<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\MatterEvent;
use App\Communication;
use App\EventUser;
use App\User;

class MatterEventController extends Controller
{
    public function index()
    { 
        $title="";
        return view('calender.calender')->with(compact('title'));
    }
    public function create(){
        $title="List of events";
        return view('calender.events')->with(['events'=>MatterEvent::all(),'title'=>$title]);
    }    
    public function store(Request $request)
    {
        $class_name = array('bg-purple','bg-danger','bg-primary','bg-info','bg-success','bg-warning');
        $key = array_rand($class_name);
        $save_matterevent = new MatterEvent($request->all());
        $save_matterevent->user_id = \Auth::user()->id;
        $save_matterevent->className = $class_name[$key];
        // Tue Jul 10 2018 10:57:06 GMT+0300 (E. Africa Standard Time)
        $start_date = date_create(str_replace("/", "-", $request->start));
        $date_start = date_timestamp_get($start_date);
        $start_date_formart = date("D M d Y",$date_start);

        $end_date = date_create(str_replace("/", "-", $request->end));
        $date_end = date_timestamp_get($end_date);
        $end_date_formart = date("D M d Y",$date_end);

        $save_matterevent->start=$start_date_formart." ".$request->start_time.":02 GMT+0300 (E. Africa Standard Time)";
        $save_matterevent->end=$end_date_formart." ".$request->end_time.":02 GMT+0300 (E. Africa Standard Time)";
        $save_matterevent->save();

        $save_eventUser = new EventUser();
        $save_eventUser->user_id = $save_matterevent->user_id;
        $save_eventUser->matterevent_id = $save_matterevent->id;
        try {
            $save_eventUser->save();

            $save_log=new LoggingController();
            $save_log->userlog($save_eventUser->id,"EventUser","Creating an event".$_SERVER['REQUEST_URI']);

        } catch (\Exception $e) {}
    }

    public function show($id)
    {
        // calender events display
        return EventUser::select('title','description','start','end','className')->where('event_users.user_id',\Auth::user()->id)->join('matter_events','event_users.matterevent_id','matter_events.id')->get();
    }

    public function edit($id){
        $event = MatterEvent::find($id);
        return view('calender.add_users')->with(['event'=>$event,'title'=>$event->title,'users'=>User::all()->where('user_id','!=',\Auth::user()->id)]);
    }
    public function update(Request $request, $id){}

    public function destroy($id){
        try {
            $save_log=new LoggingController();
            $save_log->userlog($id,"EventUser","Deleting an event".$_SERVER['REQUEST_URI']);
            MatterEvent::destroy($id);
        } catch (\Exception $e) {}

        return back();
    }
}