<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\CourtbookFollowup;
use App\CourtBook;
use App\Document;
use App\Matter;

class CourtBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $read_CourtBook=CourtBook::all()->where('company_id',\Auth::user()->company_id);
        $matters=Matter::all()->where('company_id',\Auth::user()->company_id);
        $title="Court book";
        return view('courtbook.list')->with(compact('read_CourtBook','title','matters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $matters=Matter::all()->where('company_id',\Auth::user()->company_id);
         return view('courtbook.craete')->with(compact('matters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $status = "";
        $this->validate($request,["care_openning_date"=>"required","case_number"=>"required|unique:court_books","case_type_id"]);
        $save_CourtBook=new CourtBook();
        $to_date = date_create(str_replace("/", "-", $request->care_openning_date));
        $date_of_registration= date_timestamp_get($to_date);
        $save_CourtBook->care_openning_date=$date_of_registration;
        $save_CourtBook->case_number=$request->case_number;
        $save_CourtBook->alias_name=$request->alias_name;
        $save_CourtBook->alias_description=$request->alias_description;
        $save_CourtBook->matter_id=$request->matter_id;
        $save_CourtBook->stage = "Start";
        $save_CourtBook->case_type_id = $request->case_type_id;
        $save_CourtBook->user_id=\Auth::user()->id;
        $save_CourtBook->company_id = \Auth::user()->company_id;

        try {
            $save_CourtBook->save();
            $status = "Created successfully";
             if (!empty($request->documents)) {                 
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time().".".$file_value->getClientOriginalExtension());
                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->courtbook_id=$save_CourtBook->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }
            }

            $save_log=new LoggingController();
            $save_log->userlog($save_CourtBook->id,"CourtBook","Saving a court case ".$_SERVER['REQUEST_URI']);

        } catch (\Exception $e) {
             
        }

        return redirect()->route('court_book.index')->with(['status'=>$status]);

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
        $read_CourtBook=CourtBook::find($id);
        $title="Case Name: ".$read_CourtBook->alias_name." | Case Number: ".$read_CourtBook->case_number;
        $readCourtbookFollowup=CourtbookFollowup::where('courtbook_id',$id)->get();

        $save_log=new LoggingController();
        $save_log->userlog($id,"CourtBook","Showing a court case ".$_SERVER['REQUEST_URI']);


        return view("courtbook.courtcase_details")->with(compact('read_CourtBook','title','readCourtbookFollowup'));
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
         $save_CourtBook=CourtBook::find($id);
         $matters=Matter::all();
         $title="Edit ".$save_CourtBook->case_number;
         return view('courtbook.update_courtcase')->with(compact('save_CourtBook','matters','title'));
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
         $save_CourtBook=CourtBook::find($id);
         if (!empty($request->care_openning_date)) {
            $to_date = date_create(str_replace("/", "-", $request->care_openning_date));
            $date_of_registration= date_timestamp_get($to_date);
            $save_CourtBook->care_openning_date=$date_of_registration;
         }


        
        $save_CourtBook->case_number=$request->case_number;
        $save_CourtBook->alias_name=$request->alias_name;
        if (!empty($request->alias_description)) {
            $save_CourtBook->alias_description=$request->alias_description;
        }
       
        $save_CourtBook->matter_id=$request->matter_id;
        $save_CourtBook->user_id=\Auth::user()->id;

        try {
            $save_CourtBook->save();
             if (!empty($request->documents)) {                 
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time()."_".$file_value->getClientOriginalName());
                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->courtbook_id=$save_CourtBook->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }
            }

            $status="Court updated";

            $save_log=new LoggingController();
            $save_log->userlog($id,"CourtBook","Updating a court case ".$_SERVER['REQUEST_URI']);
        } catch (\Exception $e) {

        }

        return redirect()->route('court_book.index')->with(compact('status'));
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
