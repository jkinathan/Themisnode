<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\OpposingAdvocates;
use App\Communication;
use App\CourtBook;

class OpposingAdvocatesController extends Controller
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
        $save_OpposingParty=new OpposingAdvocates();
        $save_OpposingParty->name=$request->name;
        $save_OpposingParty->phone_number=$request->phone_number;
        $save_OpposingParty->address=$request->address;
        $save_OpposingParty->courtbook_id=$request->courtbook_id;
        try {
            $save_OpposingParty->save();
            $save_log=new LoggingController();
            $save_log->userlog($save_OpposingParty->id,"OpposingAdvocates","Creating an OpposingAdvocates ".$_SERVER['REQUEST_URI']);
            $courtbook = CourtBook::find($save_OpposingParty->id);
            $send_communication = new Communication();
            $sms="Dear ".$save_OpposingParty->name." You have been made an advocate on the case number: ".$courtbook->case_number." Titled ".$courtbook->alias_name;
            $send_communication->send_SMS($sms,$save_OpposingParty->phone_number); 
            $status="Created successfully";
         } catch (\Exception $e) {
            $status="Failed to save. All the fields are required.";
        }

        echo $status;
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
        $read_CourtBook=CourtBook::find($id);
        $title="Add Opposing advocates to case number: ".$read_CourtBook->case_number;
        return view('courtbook.opposing_advocates')->with(compact('read_CourtBook','title'));
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
