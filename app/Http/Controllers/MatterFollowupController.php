<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\MatterFollowup;
use App\Document;
use App\Matter;

class MatterFollowupController extends Controller
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
        $this->validate($request,["status"=>"required","title"=>"required","description"=>"required"]);
        $save_MatterFollowup=new MatterFollowup();
        $save_MatterFollowup->title=$request->title;
        $to_date = date_create(str_replace("/", "-", $request->date_created));
        $date_of_registration= date_timestamp_get($to_date);
        $save_MatterFollowup->date_created=$date_of_registration;
        $save_MatterFollowup->description=$request->description;
        $save_MatterFollowup->user_id=\Auth::user()->id;
        $save_MatterFollowup->matter_id=$request->matter_id;
        $save_MatterFollowup->status=$request->status;
       
        try {
            $save_MatterFollowup->save();

            $save_log=new LoggingController();
            $save_log->userlog($save_MatterFollowup->id,"MatterFollowup","Creating a MatterFollowup".$_SERVER['REQUEST_URI']);
            // update the main Matter
            $update_matter_status=Matter::find($save_MatterFollowup->matter_id);
            $update_matter_status->status=$save_MatterFollowup->status;
            try {
                $update_matter_status->save();
            } catch (\Exception $e) {
                
            }

             if (!empty($request->documents)) {
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    // $file_name=trim("themis_file_".time()."_".$file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time().".".$file_value->getClientOriginalExtension());

                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->matter_followup_id=$save_MatterFollowup->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }
            }

            $status="Record made successfully.";

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
        //add a new follow up record
        $save_Matter=Matter::find($id);
        
        return view('matter.record_follow_up')->with(compact('save_Matter'));
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
        $read_MatterFollowup=MatterFollowup::find($id);
        $save_Matter=$read_MatterFollowup->matter;
        $title="Matter Name: ".$save_Matter->name." | Matter Number: ".$save_Matter->matter_number;
        return view('matter.recorded_details')->with(compact('read_MatterFollowup','save_Matter','title'));
        // return $read_MatterFollowup;
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
