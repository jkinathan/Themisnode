<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\MatterFollowup;
use App\PracticeArea;
use App\Communication;
use App\MatterUser;
use App\Document;
use App\Matter;
use App\Client;

class MatterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $save_log=new LoggingController();
        $save_log->userlog("","MatterUser","Viewing all my matters".$_SERVER['REQUEST_URI']);

        $title="Matters";
        $matters=array();
        // read the matters where I belong
        $checkMatterUser=MatterUser::all()->where('user_id',\Auth::user()->id);
        foreach ($checkMatterUser as $matter_check_value) {
            # code...
            $matters[]=Matter::find($matter_check_value->matter_id);

        }
        // $matters=Matter::all();
        $read_PracticeArea=PracticeArea::all();
        $read_clients=Client::select('id','name','client_number')->where('company_id',\Auth::user()->company_id)->get();
        return view('matter.list')->with(compact('matters','title','read_PracticeArea','read_clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $read_clients=Client::select('id','name','client_number')->where('company_id',\Auth::user()->company_id)->get();
        $read_PracticeArea=PracticeArea::all();
        return view('matter.create')->with(compact('read_clients','read_PracticeArea'));
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
        $save_Matter=new Matter();
        $to_date = date_create(str_replace("/", "-", $request->start_date));
        $date_of_registration= date_timestamp_get($to_date);
        $save_Matter->start_date=$date_of_registration;
        $save_Matter->client_id=$request->client_id;
        $save_Matter->name=$request->name;
        $save_Matter->originating_lawyer=$request->originating_lawyer;
        $save_Matter->statutery_limitation=$request->statutery_limitation;
        $save_Matter->description=$request->description;
        $save_Matter->status="Start";      
        $save_Matter->matter_number=$request->matter_number;
        $save_Matter->company_id = \Auth::user()->company_id;
        try {
            $save_Matter->save();

            $save_log=new LoggingController();
            $save_log->userlog($save_Matter->id,"Matter","Creating a matter".$_SERVER['REQUEST_URI']);

            $status="Matter created successfully";

            if (!empty($request->documents)) {
            # save file      
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    // $file_name=trim("themis_file_".time()."_".$file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time().".".$file_value->getClientOriginalExtension());
                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->matter_id= $save_Matter->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }
            }


            if (!empty($request->practice_area)) {
                foreach ($request->practice_area as $practicearea) {
                    try {
                     \DB::table('matter_practice_area')->insert([['matter_id'=>$save_Matter->id, 'practiceareas_id'=>$practicearea,'created_at'=>date("Y-m-d h:m:s"),'updated_at'=>date("Y-m-d h:m:s")]]);   
                    } catch (\Exception $e) {
                        //echo $e->getMessage();
                         
                    }                              

                }
            }

            if (!empty($request->users)) {                
                foreach ($request->users as $user_value) {
                    $save_MatterUser=new MatterUser();
                    $save_MatterUser->matter_id=$save_Matter->id;
                    $save_MatterUser->user_id=$user_value;
                    if (MatterUser::all()->where('user_id',$user_value)->where('matter_id',$save_Matter->id)->count()==0) {
                        try {
                            $save_MatterUser->save();
                        } catch (\Exception $e) {
                            
                        }

                        try {
                            $send_communication = new Communication();
                            $sms="Dear ".$save_MatterUser->user->name." You have been made an advocate on the matter ".$save_Matter->name.". You should login to view its details.";
                            $send_communication->send_SMS($sms,$save_MatterUser->user->phone_number);
                        
                        } catch (\Exception $e) {}
                    }
                   
                    
                }
            }
        } catch (\Exception $e) {
            //$status=$e->getMessage();
        }


        try {
            $send_communication = new Communication();
            $sms="Dear ".$save_Matter->client->name." Your Matter  ".$save_Matter->name." has been fully registred. Thank you";
            $send_communication->send_Email($save_Matter->client->email,$save_Matter->name,$sms,env("EMAIL_ADDRESS"));
            $send_communication->send_SMS($sms,$save_Matter->client->phone_number); 
            
        } catch (\Exception $e) {}

        return redirect('matter/#profile1')->with(compact('status'));
        //redirect('/posts')->with
    }

// New 
public function rsave(Request $request)
    {
        //
        $save_Matter=new Matter();
        $to_date = date_create(str_replace("/", "-", $request->start_date));
        $date_of_registration= date_timestamp_get($to_date);
        $save_Matter->start_date=$date_of_registration;
        $save_Matter->client_id=$request->client_id;
        $save_Matter->name=$request->name;
        $save_Matter->originating_lawyer=$request->originating_lawyer;
        $save_Matter->statutery_limitation=$request->statutery_limitation;
        $save_Matter->description=$request->description;
        $save_Matter->status="Start";      
        $save_Matter->matter_number=$request->matter_number;
        $save_Matter->company_id = \Auth::user()->company_id;
        try {
            $save_Matter->save();

            $save_log=new LoggingController();
            $save_log->userlog($save_Matter->id,"Matter","Creating a matter".$_SERVER['REQUEST_URI']);

            $status="Matter created successfully, add new Matter";

            if (!empty($request->documents)) {
            # save file      
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    // $file_name=trim("themis_file_".time()."_".$file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time().".".$file_value->getClientOriginalExtension());
                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->matter_id= $save_Matter->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }
            }


            if (!empty($request->practice_area)) {
                foreach ($request->practice_area as $practicearea) {
                    try {
                     \DB::table('matter_practice_area')->insert([['matter_id'=>$save_Matter->id, 'practiceareas_id'=>$practicearea,'created_at'=>date("Y-m-d h:m:s"),'updated_at'=>date("Y-m-d h:m:s")]]);   
                    } catch (\Exception $e) {
                        //echo $e->getMessage();
                         
                    }                              

                }
            }

            if (!empty($request->users)) {                
                foreach ($request->users as $user_value) {
                    $save_MatterUser=new MatterUser();
                    $save_MatterUser->matter_id=$save_Matter->id;
                    $save_MatterUser->user_id=$user_value;
                    if (MatterUser::all()->where('user_id',$user_value)->where('matter_id',$save_Matter->id)->count()==0) {
                        try {
                            $save_MatterUser->save();
                        } catch (\Exception $e) {
                            
                        }

                        try {
                            $send_communication = new Communication();
                            $sms="Dear ".$save_MatterUser->user->name." You have been made an advocate on the matter ".$save_Matter->name.". You should login to view its details.";
                            $send_communication->send_SMS($sms,$save_MatterUser->user->phone_number);
                        
                        } catch (\Exception $e) {}
                    }
                   
                    
                }
            }
        } catch (\Exception $e) {
            //$status=$e->getMessage();
        }


        try {
            $send_communication = new Communication();
            $sms="Dear ".$save_Matter->client->name." Your Matter  ".$save_Matter->name." has been fully registred. Thank you";
            $send_communication->send_Email($save_Matter->client->email,$save_Matter->name,$sms,env("EMAIL_ADDRESS"));
            $send_communication->send_SMS($sms,$save_Matter->client->phone_number); 
            
        } catch (\Exception $e) {}

        return redirect()->route('matter.index')->with(compact('status'));

    }


// endNew
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show MatterFollowup for this matter
        $read_Matter=Matter::find($id);
        
        $read_MatterFollowup=MatterFollowup::where('matter_id',$id)->get();       
        return view('matter.follow_ups')->with(compact('read_MatterFollowup','read_Matter'));
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
        $read_Matter=Matter::find($id);
        $title="Edit ".$read_Matter->name;
        $read_clients=Client::select('id','name','client_number')->get();
        $read_PracticeArea=PracticeArea::all();
        return view('matter.edit_matter')->with(compact('read_Matter','title','read_clients','read_PracticeArea'));
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
        $save_Matter=Matter::find($id);

        $save_log=new LoggingController();
        $save_log->userlog($save_Matter->id,"Matter","Editing a matter".$_SERVER['REQUEST_URI']);


        if (!empty($request->start_date)) {
            # code...
            $to_date = date_create(str_replace("/", "-", $request->start_date));
            $date_of_registration=date_timestamp_get($to_date);
            $save_Matter->start_date=$date_of_registration;
        }
      
        if (!empty($request->client_id)) {
           $save_Matter->client_id=$request->client_id;
        }
        
        $save_Matter->name=$request->name;
        $save_Matter->originating_lawyer=$request->originating_lawyer;
        $save_Matter->statutery_limitation=$request->statutery_limitation;
        $save_Matter->description=$request->description;        
        $save_Matter->parties=$request->parties;
        $save_Matter->matter_number=$request->matter_number;
        if (!empty($request->documents)) {
            # save file
        }


        try {
            $save_Matter->save();

            $status="Matter Updated successfully";

            if (!empty($request->practice_area)) {
                // erase the old ones
                \DB::table('matter_practice_area')->where('matter_id',$save_Matter->id)->delete();
                foreach ($request->practice_area as $practicearea) {
                    try {                      
                     \DB::table('matter_practice_area')->insert([['matter_id'=>$save_Matter->id, 'practiceareas_id'=>$practicearea,'created_at'=>date("Y-m-d h:m:s"),'updated_at'=>date("Y-m-d h:m:s")]]);   
                    } catch (\Exception $e) {
                        
                    }                       

                }
            }


             if (!empty($request->documents)) {
            # save file      
                foreach ($request->documents as $file_value) {
                    $save_Document=new Document();
                    $save_Document->file_title=trim($file_value->getClientOriginalName());
                    // $file_name=trim("themis_file_".time()."_".$file_value->getClientOriginalName());
                    $file_name=trim("themis_file_".time().".".$file_value->getClientOriginalExtension());

                    $save_Document->file_url=$file_name;
                    $save_Document->file_description="None";
                    $save_Document->matter_id= $save_Matter->id;
                    $save_Document->user_id=\Auth::user()->id;                
                    $file_value->move(public_path('documents'),$file_name);
                    $save_Document->save();
                }
            }


              if (!empty($request->users)) {                
                foreach ($request->users as $user_value) {
                    $save_MatterUser=new MatterUser();
                    $save_MatterUser->matter_id=$save_Matter->id;
                    $save_MatterUser->user_id=$user_value;
                    if (MatterUser::all()->where('user_id',$user_value)->where('matter_id',$save_Matter->id)->count()==1) {
                            MatterUser::all()->where('user_id',$user_value)->where('matter_id',$save_Matter->id)->dalete();
                            $save_MatterUser->save();
                        
                    }

                    elseif (MatterUser::all()->where('user_id',$user_value)->where('matter_id',$save_Matter->id)->count()==0) {
                        # code...
                        $save_MatterUser->save();
                    }

                    else{}
                   
                    
                }
            }
        } catch (\Exception $e) {
            //$status=$e->getMessage();
        }


      

        return redirect()->route('matter.index')->with(compact('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $save_log=new LoggingController();
        $save_log->userlog($id,"Matter","Deleting a matter".$_SERVER['REQUEST_URI']);
        try {
            Matter::destroy($id);
        } catch (\Exception $e) {
            
        }

        return redirect()->back();
    }
}
