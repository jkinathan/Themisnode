<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\MatterWitness;
use App\Matter;

class MatterWitnessController extends Controller
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
        $save_MatterWitness=new MatterWitness();
        $save_MatterWitness->courtbook_id=$request->courtbook_id;
        $save_MatterWitness->name=$request->name;
        $save_MatterWitness->phone_number=$request->phone_number;
        $save_MatterWitness->address=$request->address;
        try {
             $save_MatterWitness->save();
             $status="Saved";

            $save_log=new LoggingController();
            $save_log->userlog($save_MatterWitness->id,"MatterWitness","Creating a MatterWitness".$_SERVER['REQUEST_URI']);

        } catch (\Exception $e) {
             $status="Failed to add a new Witness, There is a missing field".$e->getMessage();
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
         $read_Matter=Matter::find($id);
         $title="Add Witness to ".$read_Matter->name." (".$read_Matter->matter_number.")";
         return view('matter.witness')->with(compact('read_Matter','title'));
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
