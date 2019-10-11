<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\CourtbookFollowup;
use App\CourtBook;
use App\Document;
use App\Task;
use App\User;

class CourtbookFollowupController extends Controller
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
        $read_CourtbookFollowup=new CourtbookFollowup();
        $read_CourtbookFollowup->place_of_hearing=$request->place_of_hearing;
        $read_CourtbookFollowup->presiding_judge_name=$request->presiding_judge_name;
        $read_CourtbookFollowup->court_clerk_name=$request->court_clerk_name;
        $read_CourtbookFollowup->court_clerk_phonenumber=$request->court_clerk_phonenumber;
        $read_CourtbookFollowup->case_stage=$request->case_stage;
        $read_CourtbookFollowup->hearing_date=$request->hearing_date;
        $read_CourtbookFollowup->courtbook_id=$request->courtbook_id;
        $read_CourtbookFollowup->notes=$request->notes;
        $read_CourtbookFollowup->next_hearing_date=$request->next_hearing_date;
        $read_CourtbookFollowup->next_hearing_place=$request->next_hearing_place;
        $read_CourtbookFollowup->user_id=\Auth::user()->id;
        try {
            $read_CourtbookFollowup->save();

            $save_CourtBook = CourtBook::find($read_CourtbookFollowup->courtbook_id);
            $save_CourtBook->stage = $request->case_stage;
            try {
                $save_CourtBook->save();

                //take calender and event logs
                $save_Task=new Task();
                $save_Task->name="Court follow up on ".$read_CourtbookFollowup->courtbook->alias_name;
                $save_Task->description="";
                $save_Task->start_time=$read_CourtbookFollowup->next_hearing_date."/6:00";
                $save_Task->end_time=$request->end_date."/".$request->end_time;
                $save_Task->matter_id=$read_CourtbookFollowup->courtbook->matter->id;
                $remider_time = "EmailSMS_12_Hours";
                $save_Task->remider_time=$remider_time;
                $save_Task->status=0;
                $save_Task->user_id=\Auth::user()->id;
                try {
                    $save_Task->save();       
                    foreach (User::all() as $read_users) {
                       \DB::table('task_user')->insert([['task_id'=>$save_Task->id, 'user_id'=>$read_users->id,'created_at'=>date("Y-m-d h:m:s"),'updated_at'=>date("Y-m-d h:m:s")],]);
                        }       
                    $status="Task created successfully";
                } catch (\Exception $e) {
                   
                }
            } catch (\Exception $e) {}

            $save_log=new LoggingController();
            $save_log->userlog($read_CourtbookFollowup->id,"CourtbookFollowup","Recording a CourtbookFollowup ".$_SERVER['REQUEST_URI']);

            if (!empty($request->documents)) {
            # save file      
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time().".".$file_value->getClientOriginalExtension());
                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->courtbook_followup_id=$read_CourtbookFollowup->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }
            }
        } catch (\Exception $e) {}
        return redirect()->back()->with(["status"=>"Created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $read_courtbookFollowup=CourtbookFollowup::find($id);
        $title="Case Name: ".$read_courtbookFollowup->courtbook->alias_name." | Case Number: ".$read_courtbookFollowup->courtbook->case_number;

        return view('courtbook.follow_details')->with(compact('read_courtbookFollowup','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $read_CourtBook=CourtBook::find($id);
        return view('courtbook.court_followup')->with(compact('read_CourtBook'));
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
