<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PracticeArea;

class PracticeAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $read_PracticeArea=PracticeArea::all();
        $title="Practice area";
        return view('practice_area.list')->with(compact('read_PracticeArea','title'));
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
        $this->validate($request,["name"=>"required"]);
        $save_PracticeArea=new PracticeArea();
        $save_PracticeArea->name=$request->name;
        try {
            $save_PracticeArea->save();

        } catch (\Exception $e) {
            
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //all maters on practice area
        $practice_area = PracticeArea::find($id);
        $matter_practice_area = \DB::table('matter_practice_area')->where('practiceareas_id',$practice_area->id)->get();
        return view("practice_area.matters")->with(['matter_practice_area'=>$matter_practice_area,'practice_area'=>$practice_area,'title'=>'Matters under '.$practice_area->name]);
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
