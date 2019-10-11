<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\MatterUser;
use App\Matter;
use App\Timesheet;
use App\Client;
use App\User;

class TimesheetController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Matteruser $matterss){
        $timesheet = Timesheet::all();
        //$matterss = array();
        
        $matterss = MatterUser::select('matter_id')->where('user_id',\Auth::user()->id)->get();
          foreach($matterss as $usermatter){

                 $matterss[] = Matter::find($usermatter->matter->id);
         } 
         //dd($matterss);
         
        $read_clients=Client::select('id','name','client_number')->where('company_id',\Auth::user()->company_id)->get();
        
        $title = "TIMESHEET";
        return view('matter.time_sheet')->with(compact('timesheetAct','read_clients','title','matterss','timesheet'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id){
        $read_Matter=Matter::find($id);
        $save_log=new LoggingController();
        $save_log->userlog("","MatterUser","Viewing all my matters".$_SERVER['REQUEST_URI']);

        $title = "TIMESHEET";
        //$read_Matter=Matter::findorFail($request->id);
        $matters=array();
        $checkMatterUser=MatterUser::all()->where('user_id',\Auth::user()->id);
        foreach ($checkMatterUser as $matter_check_value) {
            # code...
            $matters[]=Matter::find($matter_check_value->matter_id);

        }
        return view('matter.time_sheet')->with(compact('title','matters','read_Matter'));
    }

    public function store(Request $request){

        $save_Time=new Timesheet();
        $save_Time->mattername=$request->mattername;
        $save_Time->date=$request->date;
        $save_Time->activity=$request->activity;
        $save_Time->timeinhours=$request->timeinhours;
        $save_Time->company_id = \Auth::user()->company_id;
        /*$attributes = request()->validate([
            'mattername'=> 'required',
    
            'date'=>'required',
            'timeinhours'=>'required',
            'company_id' => \Auth::user()->company_id,
        ]);*/
 try{
    $save_Time->save();
    //Timesheet::create($attributes);
    $save_log=new LoggingController();
    $save_log->userlog($save_Time->id,"Timesheet","Creating Timesheet".$_SERVER['REQUEST_URI']);

    $status="TimeSheet created successfully";
}
catch (\Exception $e) {
    $status=$e->getMessage();
}
        
      
        return back()->with(compact('status'));

    }
    public function matterreporters(Request $request)
    {

        $this->validate($request,['from'=>'required','to'=>'required']);   
         
        $from_date = date_create(str_replace("/", "-", $request->from));
        $from = date_timestamp_get($from_date);

        $to_date = date_create(str_replace("/", "-", $request->to));
        $to = date_timestamp_get($to_date);

        $save_log=new LoggingController();
        $save_log->userlog("","Matter","Viewing Matter report ".$_SERVER['REQUEST_URI']);
        $title="Timesheet From: ".date("d M Y",$from)." To: ".date("d M Y",$to);
        return view("matter.time_sheet"); 
      
    }
    public function show(Request $request){
        $this->validate($request,['mattername'=>'required','from'=>'required','to'=>'required']);   
        
        //$timesheet = Timesheet::select('id')->where('id',\Auth::user()->id)->get();
        $timesheet = Timesheet::all();
        $timesheetAct = Timesheet::select('activity')->where('id',\Auth::user()->id)->get();
        
        $matter = Matter::all();
        $read_clients=Client::select('id','name','client_number')->where('company_id',\Auth::user()->company_id)->get();
        
        $mattersname = $request->mattername;
        

        $from = ($request->from);
        //$from_date = date_timestamp_get($from_date);

        $to = ($request->to);
        //$to_date = date_timestamp_get($to_date);
     
        $read_mattertime = Timesheet::select('mattername','activity','date','timeinhours')->whereBetween('date', [$from,$to])->where('company_id',\Auth::user()->company_id)->where('mattername','=',$mattersname)->get();
        //$the_dates = Timesheet::select("timesheets.*")->whereBetween('date', [$from,$to])->where('company_id',\Auth::user()->company_id)->where('mattername','=',$mattersname)->get();
        $save_log=new LoggingController();
        $save_log->userlog("","Timesheet","Viewing Timesheet report ".$_SERVER['REQUEST_URI']);
        

        $title="Timesheet From: ".date($from)." To: ".date($to);
        return view("matter.time_sheet")->with(['timesheetAct'=>$timesheetAct,'mattersname'=>$mattersname,'read_clients'=>$read_clients,'read_mattertime'=>$read_mattertime,'timesheet'=>Timesheet::whereBetween('date', [$from,$to])->where('company_id',\Auth::user()->company_id)->get(),'title'=>$title, 'matter' => $matter]); 
    }
}
