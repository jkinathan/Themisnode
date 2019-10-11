<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PartneringFirm;

class PartneringFirmController extends Controller
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
       $save_PartneringFirm = new PartneringFirm();
       $save_PartneringFirm->name = $request->name;
       $save_PartneringFirm->courtbook_id = $request->courtbook_id;
       $save_PartneringFirm->contact_name = $request->contact_name;
       $save_PartneringFirm->contact_phone = $request->contact_phone;
       $save_PartneringFirm->contact_email = $request->contact_email;
       $save_PartneringFirm->address = $request->address;
       try {
           $save_PartneringFirm->save();
           echo "Saved";
       } catch (\Exception $e) {echo "Failed to save. All the fields are required";}
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
