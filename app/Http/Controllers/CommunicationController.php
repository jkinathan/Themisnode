<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Communication;
use App\Document;
use App\Matter;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $readCommunication=Communication::all()->where('user_id',\Auth::user()->id);
        $matters=Matter::all();
        $title="Conversations with Clients";
        return view('communication.list')->with(compact('readCommunication','title','matters'));
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
        //
        $this->validate($request,["message_body"=>"required","message_title"=>"required","name_of_person"=>"required","date_of_message"=>"required","matter_id"=>"required"]);

        $save_Communication=new Communication();
        $save_Communication->message_body=$request->message_body;
        $save_Communication->message_title=$request->message_title;
        $save_Communication->name_of_person=$request->name_of_person;
        $save_Communication->date_of_message=$request->date_of_message;
        $save_Communication->matter_id=$request->matter_id;
        $save_Communication->media_used=$request->media_used;
        $save_Communication->user_id=\Auth::user()->id;
        try {
            $save_Communication->save();
            $status="Your communication has been saved for future use. Thank you";
            if (!empty($request->documents)) {
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time().".".$file_value->getClientOriginalExtension());
                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->communication_id=$save_Communication->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }                
            }
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
}
