<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matter;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $read_Task=Task::where('user_id',\Auth::user()->id)->get();
        return view('task.matter_tasks')->with(compact('read_Task','read_Matter'));
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
     
        $this->validate($request,["name"=>"required","description"=>"required","start_time"=>"required"]);
        $save_Task=new Task();
        $save_Task->name=$request->name;
        $save_Task->description=$request->description;
        $save_Task->start_time=$request->start_date."/".$request->start_time;
        $save_Task->end_time=$request->end_date."/".$request->end_time;
        $save_Task->matter_id=$request->matter_id;
        $remider_time = $request->mode."_".$request->remider_number."_".$request->period;
        $save_Task->remider_time=$remider_time;
        $save_Task->status=0;
        $save_Task->user_id=\Auth::user()->id;
        try {
            $save_Task->save();
            if (!empty($request->users)) {
                # code...
                foreach ($request->users as $user) {
                    try {
                       \DB::table('task_user')->insert([['task_id'=>$save_Task->id, 'user_id'=>$user,'created_at'=>date("Y-m-d h:m:s"),'updated_at'=>date("Y-m-d h:m:s")],]);  
                    } catch (\Exception $e) {
                        
                    }
                      
                }
            }

            $status="Task created successfully";
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
        // $read_Matter=Matter::find($id);
        // $read_Task=Task::where('matter_id',$id)->get();
        $title = "";
        $tasks=Task::find($id);
        return view('task.matter_tasks')->with(compact('tasks','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $read_Matter=Matter::find($id);
        return view('task.create')->with(compact('read_Matter'));
    }

    
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
