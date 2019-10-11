<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LoggingController;
use App\BillingType;
use App\Communication;
use App\Client;
use App\MatterEvent;
use App\User;
// use Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $read_clients=Client::all()->where('company_id',\Auth::user()->company_id);
        return view('client.list')->with(compact('read_clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $read_BillingType=BillingType::all();
        $read_clients=Client::all()->where('company_id',\Auth::user()->company_id);
        $title="Client";
        return view('client.create')->with(compact('read_BillingType','title','read_clients'));
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
        $ids = Client::pluck('client_number')->toArray();    
        do {
                $id = date("y-").rand(001, 999);
        } while (in_array($id, $ids));
                
        //echo $id;
        //
         $this->validate($request,["name"=>"required","tin_number"=>"required","phone_number_2"=>"required","client_type"=>"required","address"=>"required","phone_number"=>"required","date_registered"=>"required"]);
        $save_Client=new Client();
        $save_Client->name=$request->name;
        $save_Client->client_type=$request->client_type;
        $save_Client->address=$request->address;
        $save_Client->phone_number=$request->phone_number;
        $save_Client->phone_number_2=$request->phone_number_2;
        $save_Client->contact_person=$request->contact_person;
        $save_Client->email=$request->email;
        $save_Client->client_number=$id;
        $save_Client->tin_number=$request->tin_number;
        $save_Client->reffered_by=$request->reffered_by;
        $save_Client->referred_by_phone=$request->referred_by_phone;
        $save_Client->referred_by_name=$request->referred_by_name;
        $save_Client->company_id = \Auth::user()->company_id;
        
        
        //$save_Client->client_no = str_pad(1, 6, "18-", STR_PAD_LEFT);
        //str_pad($ids[0]->Auto_increment, 5, '0', STR_PAD_LEFT);
        //$generateOrder_nr = '#' . str_pad(1, 8, "0", STR_PAD_LEFT);
        
        $to_date = date_create(str_replace("/", "-", $request->date_registered));
        $date_of_registration= date_timestamp_get($to_date);

        $save_Client->date_registered=$date_of_registration;
        // $save_Client->billingtype_id=$request->billingtype_id;
        $save_Client->user_id=\Auth::user()->id;
        try {
            $save_Client->save();
            $status="Client created successfully.";
            
            $save_log=new LoggingController();
            $save_log->userlog($save_Client->id,"Client","Creating a client ".$_SERVER['REQUEST_URI']);
            
        } catch (\Exception $e) {
            //$status=$e->getMessage();
        }

        try {
            $send_communication = new Communication();

            $sms="Dear ".$save_Client->name." your Matter is being initiated.";
 
            $send_communication->send_SMS($sms,$save_Client->phone_number); 
            
        } catch (\Exception $e) {}
       
        return redirect()->route('matter.index')->with(compact('status'));
        //return redirect()->route('client.create')->with(compact('status'));
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
        $read_Client=Client::find($id);
        $title="Details for ".$read_Client->name;
         return view('client.single_user')->with(compact('read_Client','title'));
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
        $read_Client=Client::find($id);
        $read_BillingType=BillingType::all();
        $title="Edit data for ".$read_Client->name;
        return view('client.update')->with(compact('read_Client','read_BillingType','title'));
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

        $read_Client=Client::find($id);

        if (!empty($request->name)) {
            # code...
            $read_Client->name=$request->name;
        }
        
        if (!empty($request->client_type)) {
            # code...
            $read_Client->client_type=$request->client_type;
        }

        if (!empty($request->address)) {
            # code...
            $read_Client->address=$request->address;
        }

        if (!empty($request->phone_number)) {
            # code...
             $read_Client->phone_number=$request->phone_number;
        }
        if (!empty($request->phone_number_2)) {
            # code...
             $read_Client->phone_number_2=$request->phone_number_2;
        }

        if (!empty($request->$request->reffered_by)) {
            # code...
            $read_Client->reffered_by=$request->reffered_by;
        } 

        if (!empty($request->contact_person)) {
                $read_Client->contact_person=$request->contact_person;
            }

        if (!empty($request->referred_by_phone)) {
          $read_Client->referred_by_phone=$request->referred_by_phone;
         } 

         if (!empty($request->referred_by_name)) {
             $read_Client->referred_by_name=$request->referred_by_name;
         }
        
        if (!empty($request->email)) {
             $read_Client->email=$request->email;
           }
        if (!empty($request->client_number)) {
            $read_Client->client_number=$request->client_number;
           }   
        
        if (!empty($request->date_registered)) {
            # code...
            $to_date = date_create(str_replace("/", "-", $request->date_registered));
            $date_of_registration= date_timestamp_get($to_date);
            $read_Client->date_registered=$date_of_registration;
        }
        
        if (!empty($request->billingtype_id)) {
            $read_Client->billingtype_id=$request->billingtype_id;
        }
        
        $read_Client->user_id=\Auth::user()->id;
        try {
            $read_Client->save();
            $status="Client Updated successfully.";

            $save_log=new LoggingController();
            $save_log->userlog($read_Client->id,"Client","Updating a client ".$_SERVER['REQUEST_URI']);

        } catch (\Exception $e) {
            //$status=$e->getMessage();
        }

        return redirect()->route('client.create')->with(compact('status'));
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
        try {          
            Client::destroy($id);
            $save_log=new LoggingController();
            $save_log->userlog($id,"Client","Deleting a client");
        } catch (\Exception $e) {
           return redirect()->route('client.index')->with(compact('status')); 
        }
    }
}
