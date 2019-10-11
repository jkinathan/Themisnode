<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\PracticeArea;
use App\CourtBook;
use App\Company;
use App\Matter;
use App\Client;
use App\User;
use App\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (\Auth::user()->hasRole('main_admin')) {
            return redirect('/company');
        }

        if (\Auth::user()->status == 0) {
            \Auth::logout();
            \Session::flush();
            return redirect('/');
        }


        $save_log=new LoggingController();
        $save_log->userlog("","Home",$_SERVER['REQUEST_URI']);

        $title="";
        $matter_array = $practicearea = array();
        $read_Task=array();
        $matters=Matter::paginate(4);

        $matter_stages = ["start","process","ruling","postponed","abandoned","done"];
        foreach ($matter_stages as $key => $value) {
            $matter_array[ucwords($value)] = (int)Matter::where('status',$value)->where('company_id',\Auth::user()->company_id)->count();
        }

        // $matter_array["Start"] = (int)Matter::where('status','start')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Under process"] = (int)Matter::where('status','process')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Done"] = (int)Matter::where('status','done')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Ruling"] = (int)Matter::where('status','ruling')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["postponed"] = (int)Matter::where('status','Postponed')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Abandoned"] = (int)Matter::where('status','abandoned')->where('company_id',\Auth::user()->company_id)->count();


        $read_practicearea = PracticeArea::all();
        foreach ($read_practicearea as $practice_area) {
           $practicearea[$practice_area->name] = (int)\DB::table('matter_practice_area')->where('practiceareas_id',$practice_area->id)->count();
        }


        $matters=Matter::where('company_id',\Auth::user()->company_id)->paginate(4);
        $matters=Matter::where('company_id',\Auth::user()->company_id)->paginate(4);
        $matters_count=Matter::all()->where('company_id',\Auth::user()->company_id)->count();
        $matters_count_complete=Matter::all()->where('status','done')->where('company_id',\Auth::user()->company_id)->count();
        $read_clients_count=Client::all()->where('company_id',\Auth::user()->company_id)->count();
        $count_CourtBook=CourtBook::all()->where('company_id',\Auth::user()->company_id)->count();

        $read_CourtBook=CourtBook::all()->where('company_id',\Auth::user()->company_id);

        $case_stages=array("Start","Arrest","Bail","Arraignment","Pre-Trial Hearing","Pre-Trial Motions","Trial","Sentencing","Appeal","Closed");
        $stages=array();

        foreach ($case_stages as $value) {
            $stages[$value] = CourtBook::all()->where('stage',$value)->where('company_id',\Auth::user()->company_id)->count(); 
        }



        $count_users=User::all()->where('company_id',\Auth::user()->company_id)->count();
        $read_clients=Client::where('company_id',\Auth::user()->company_id)->paginate(5);

        // $my_tasks=\DB::table('task_user')->where('user_id',\Auth::user()->id)->get();
        // foreach ($my_tasks as $task_value) {
        //     # code...
        //     if (Task::find($task_value->task_id)->status==0) {
        //         $read_Task[]=Task::find($task_value->task_id);
        //     }
        // }
       
        return view('home')->with(compact('title','matters','read_clients_count','matters_count','count_CourtBook','count_users','read_clients','matters_count_complete','matter_array','practicearea','stages'));
    }

    public function index2()
    {

        if (\Auth::user()->hasRole('main_admin')) {
            return redirect('/company');
        }

        if (\Auth::user()->status == 0) {
            \Auth::logout();
            \Session::flush();
            return redirect('/');
        }


        $save_log=new LoggingController();
        $save_log->userlog("","Home",$_SERVER['REQUEST_URI']);

        $title="";
        $matter_array = $practicearea = array();
        $read_Task=array();
        $matters=Matter::paginate(4);

        $matter_stages = ["start","process","ruling","postponed","abandoned","done"];
        foreach ($matter_stages as $key => $value) {
            $matter_array[ucwords($value)] = (int)Matter::where('status',$value)->where('company_id',\Auth::user()->company_id)->count();
        }

        // $matter_array["Start"] = (int)Matter::where('status','start')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Under process"] = (int)Matter::where('status','process')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Done"] = (int)Matter::where('status','done')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Ruling"] = (int)Matter::where('status','ruling')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["postponed"] = (int)Matter::where('status','Postponed')->where('company_id',\Auth::user()->company_id)->count();
        // $matter_array["Abandoned"] = (int)Matter::where('status','abandoned')->where('company_id',\Auth::user()->company_id)->count();

        
        $read_practicearea = PracticeArea::all();
        foreach ($read_practicearea as $practice_area) {
           $practicearea[$practice_area->name] = (int)\DB::table('matter_practice_area')->where('practiceareas_id',$practice_area->id)->count();
        }


        $matterrs=Matter::where('company_id',\Auth::user()->company_id)->paginate(4);
        $matterrs=Matter::where('company_id',\Auth::user()->company_id)->paginate(4);
        $matters_count=Matter::all()->where('company_id',\Auth::user()->company_id)->count();
        $matters_count_complete=Matter::all()->where('status','done')->where('company_id',\Auth::user()->company_id)->count();
        $read_clients_count=Client::all()->where('company_id',\Auth::user()->company_id)->count();
        $count_CourtBook=CourtBook::all()->where('company_id',\Auth::user()->company_id)->count();

        $read_CourtBook=CourtBook::all()->where('company_id',\Auth::user()->company_id);

        $case_stages=array("Start","Arrest","Bail","Arraignment","Pre-Trial Hearing","Pre-Trial Motions","Trial","Sentencing","Appeal","Closed");
        $stages=array();

        foreach ($case_stages as $value) {
            $stages[$value] = CourtBook::all()->where('stage',$value)->where('company_id',\Auth::user()->company_id)->count(); 
        }



        $count_users=User::all()->where('company_id',\Auth::user()->company_id)->count();
        $read_clients=Client::where('company_id',\Auth::user()->company_id)->paginate(5);

        // $my_tasks=\DB::table('task_user')->where('user_id',\Auth::user()->id)->get();
        // foreach ($my_tasks as $task_value) {
        //     # code...
        //     if (Task::find($task_value->task_id)->status==0) {
        //         $read_Task[]=Task::find($task_value->task_id);
        //     }
        // }
       
        return view('home2')->with(compact('title','matterrs','read_clients_count','matters_count','count_CourtBook','count_users','read_clients','matters_count_complete','matter_array','practicearea','stages'));
    }
}
