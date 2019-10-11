<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\MatterParty;
use App\Party;
use App\Task;

class PartyCOntroller extends Controller
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
        //
        $read_Party=new Party();
        $read_Party->name=$request->name;
        $read_Party->address=$request->address;
        $read_Party->phone_number=$request->phone;
        try {
            $read_Party->save();

            $save_matterparty = new MatterParty();
            $save_matterparty->matter_id = $request->matter_id;
            $save_matterparty->party_id = $read_Party->id;
            $save_matterparty->save();            
            echo "Saved";

            $save_log=new LoggingController();
            $save_log->userlog($read_Party->id,"Party","Creating a Party ".$_SERVER['REQUEST_URI']);
         } catch (\Exception $e) {
           //echo $e->getMessage(); 
        }
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
        $readTask=Task::find($id);
        $readTask->status=1;
        $readTask->save();
        return redirect()->back()->with(["status"=>"Task marked as complete"]);
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
