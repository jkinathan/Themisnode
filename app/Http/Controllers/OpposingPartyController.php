<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\OpposingParty;
use App\CourtBook;

class OpposingPartyController extends Controller
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
        $save_OpposingParty=new OpposingParty();
        $save_OpposingParty->name=$request->name;
        $save_OpposingParty->phone_number=$request->phone_number;
        $save_OpposingParty->address=$request->address;
        $save_OpposingParty->courtbook_id=$request->courtbook_id;
        try {
            $save_OpposingParty->save();
            $status="Created successfully";

            $save_log=new LoggingController();
            $save_log->userlog($save_OpposingParty->id,"OpposingParty","Creating an OpposingParty ".$_SERVER['REQUEST_URI']);

        } catch (\Exception $e) {
            $status="Failed to save, All the fields are required";
        }

        echo $status;

        // return redirect()->back()->with(compact('status'));
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
        $title="Add Opposing party to ".$read_CourtBook->case_number;
        return view('courtbook.opposing_party')->with(compact('read_CourtBook','title'));
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
