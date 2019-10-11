<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\MatterFollowup;
use App\Communication;
use App\CourtBook;
use App\SentTask;
use App\Expense;
use App\Matter;
use App\MatterUser;
use App\Client;
use App\Task;
use App\User;

class ExtraTaskController extends Controller
{
    public function matter_details($matter_id)
    {
        $matter = Matter::all();//->where('user_id',\Auth::user()->id)->get();
        $matters = array();
        $matters = MatterUser::select('matter_id')->where('user_id',\Auth::user()->id)->get();
        $mattersname = Matter::select('name')->where('company_id',\Auth::user()->company_id)->get();
        foreach($matters as $usermatter){
            $matters[] = Matter::find($usermatter->matter->id);
        } 
    	$save_Matter=Matter::find($matter_id);
    	$read_MatterFollowup=MatterFollowup::where('matter_id',$matter_id)->get();
    	$title="Matter Name: ".$save_Matter->name." | Matter Number: ".$save_Matter->matter_number;
    	$read_Task=Task::where('matter_id',$matter_id)->orderBy('status','ASC')->get();
    	$read_expenses=Expense::where('matter_id',$matter_id)->get();
        $readCommunication=Communication::all()->where('matter_id',$matter_id);

        $save_log=new LoggingController();
        $save_log->userlog($matter_id,"Matter","Viewing matter details ".$_SERVER['REQUEST_URI']);
    	return view("matter.matter_details")->with(compact('mattersname','matter','matters','save_Matter','title','read_MatterFollowup','read_Task','read_expenses','readCommunication'));
    
    }


    public function task_remiders()
    {

       $read_task = Task::all()->where('status',0);
       foreach ($read_task as $task_value) {

        // echo $task_value->remider_time;

            if (!empty($task_value->remider_time)) {

                $remider_time = explode("_", $task_value->remider_time);

                $start_time = str_replace("/", " ",$task_value->start_time).":00";

                $then_date = date_create($start_time);
                $datethen = date_timestamp_get($then_date); //seconds

                $now_date = date_create();
                $date_now = date_timestamp_get($now_date); //seconds

                // echo "<br>Then: ".$start_time." Now: ".date('Y-m-d h:i:s',$date_now);

                $seconds_diffrenece = $datethen - $date_now;

                $init_seconds = $seconds_diffrenece;
                $hours = floor($init_seconds / 3600);
                $minutes = floor($init_seconds / 60) % 60;           
                $days = ($hours / 24);

                // echo $minutes."Minutes =>".$remider_time[1];
              
                if ($remider_time[2] == "Minutes") {
                    if ($remider_time[1] == $minutes || ($minutes < $remider_time[1] && $minutes>0) ) {
                        $this->run_notification($task_value->id);             
                    }           
                }

                if ($remider_time[2] == "Hours") {
                    if ($remider_time[1] == $hours || ($hours < $remider_time[1] && $hours>0) ) {
                        $this->run_notification($task_value->id);             
                    }           
                }

                if ($remider_time[2] == "Days") {
                    if ($remider_time[1] == $days || ($days < $remider_time[1] && $days>0) ) {
                        $this->run_notification($task_value->id);             
                    }           
                }
            }       
        }
    }

    public function run_notification($task_id)
    {
        $task = Task::find($task_id);    
        $communication = new Communication();
        $raed_users = \DB::table('task_user')->where('task_id',$task_id)->get();
        $sms = $task->description." Starting at ".$task->start_time;
        foreach ($raed_users as $task_user_value) {

           $user = User::find($task_user_value->user_id);
           if (SentTask::all()->where('user_id',$user->id)->where('task_id',$task_id)->count() == 0) {

               $save_senttask = new SentTask();
               $save_senttask->user_id = $user->id;
               $save_senttask->task_id = $task_id;
               $save_senttask->save();

               $communication->send_Email($user->email,$task->name,$sms,User::find($task->user_id)->email);
               $communication->send_SMS($sms,$user->phone_number);              
           }

        }
    }

    public function change_case_stage(Request $request)
    {
        $this->validate($request,['case'=>'required','case_stage'=>'required']);
        foreach ($request->case as $case_value) {
            $save_CourtBook = CourtBook::find($case_value);
            $save_CourtBook->stage = $request->case_stage;
            try {
                $status = "Status updated";

                $save_log=new LoggingController();
                $save_log->userlog($save_CourtBook->id,"CourtBook","Changes the stage from  ".CourtBook::find($case_value)->stage." to ".$request->case_stage." ".$_SERVER['REQUEST_URI']);

                $save_CourtBook->save();
                } catch (\Exception $e) {
                //$status = $e->getMessage();
            }
        }
        return back()->with(['status'=>$status]);
    }



    public function change_matter_stage(Request $request)
    {
        $this->validate($request,['matter'=>'required','stage'=>'required']);
        foreach ($request->matter as $matter_value) {
            $save_matter = Matter::find($matter_value);
            $save_matter->status = $request->stage;
            try {
                $status = "Status updated";
                $save_log=new LoggingController();
                $save_log->userlog($save_matter->id,"Matter","Changes the stage from  ".Matter::find($matter_value)->status." to ".$request->stage." ".$_SERVER['REQUEST_URI']);

                $save_matter->save();
            } catch (\Exception $e) {
                //$status = $e->getMessage();
            }
        }
        return back()->with(['status'=>$status]);
    }

    public function casees_report()
    {
      $title = "Generating report on Cases";
      return view('report.case_reportrange')->with(['title'=>$title]);
    }

    public function caseesreport(Request $request)
    {
        $this->validate($request,['from'=>'required','to'=>'required']);   
         
        $from_date = date_create(str_replace("/", "-", $request->from));
        $from = date_timestamp_get($from_date);

        $to_date = date_create(str_replace("/", "-", $request->to));
        $to = date_timestamp_get($to_date);


        $save_log=new LoggingController();
        $save_log->userlog("","CourtBook","Viewing CourtBook report ".$_SERVER['REQUEST_URI']);



        $title="Cases From: ".date("d M Y",$from)." To: ".date("d M Y",$to);

        return view("report.cases_list")->with(['read_CourtBook'=>CourtBook::whereBetween('care_openning_date', [$from,$to])->where('company_id',\Auth::user()->company_id)->get(),'title'=>$title]); 
    }

    public function matter_report()
    {
        $title = "Generating report on Matters";
        return view('report.matter_reportrange')->with(['title'=>$title]);
    }

    public function client_report($value='')
    {
      $title = "Generating report on Clients";
      return view('report.clients_daterange')->with(['title'=>$title]);  
    }

    public function client_list($value='')
    {
      $title = "List of all our clients";
      return view("report.client_list")->with(['read_clients'=>Client::all()->where('company_id',\Auth::user()->company_id),'title'=>$title]);  
    }

    public function clientreport(Request $request)
    {
        $this->validate($request,['from'=>'required','to'=>'required']);   
        $from_date = date_create(str_replace("/", "-", $request->from));
        $from = date_timestamp_get($from_date);

        $to_date = date_create(str_replace("/", "-", $request->to));
        $to = date_timestamp_get($to_date);

        $save_log=new LoggingController();
        $save_log->userlog("","Client","Viewing Client report ".$_SERVER['REQUEST_URI']);
        $title="Clients registred From: ".date("d M Y",$from)." To: ".date("d M Y",$to);
        return view("report.client_list")->with(['read_clients'=>Client::whereBetween('date_registered', [$from,$to])->where('company_id',\Auth::user()->company_id)->get(),'title'=>$title]); 
    }

    public function matterreport(Request $request)
    {

        $this->validate($request,['from'=>'required','to'=>'required']);   
         
        $from_date = date_create(str_replace("/", "-", $request->from));
        $from = date_timestamp_get($from_date);

        $to_date = date_create(str_replace("/", "-", $request->to));
        $to = date_timestamp_get($to_date);

        $save_log=new LoggingController();
        $save_log->userlog("","Matter","Viewing Matter report ".$_SERVER['REQUEST_URI']);
        $title="Cases From: ".date("d M Y",$from)." To: ".date("d M Y",$to);
        return view("report.matter_list")->with(['matters'=>Matter::whereBetween('start_date', [$from,$to])->where('company_id',\Auth::user()->company_id)->get(),'title'=>$title]); 
      
    }
   

    
}
