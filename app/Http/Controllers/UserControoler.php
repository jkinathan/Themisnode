<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\Communication;

use App\User;

class UserControoler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("users.users")->with(["read_users"=>User::all()->where('company_id',\Auth::user()->company_id),'title'=>"List of users"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.change_password")->with(["title"=>"Set a new password"]);

    }
 
    public function store(Request $request)
    {
        $this->validate($request,["name"=>"required","email"=>"email|required|unique:users","phone_number"=>"required"]);
        $save_user = new User($request->all());
        $save_user->company_id = \Auth::user()->company_id;

         $characters = env("PASSWORD_STRING");
         $charactersLength = strlen($characters);
         $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        
        $pin=$request->phone_number; 
        $save_user->password=bcrypt($pin);      
        $save_user->remember_token=str_random(32);

        if ($save_user->save()) {

            $save_log=new LoggingController();
            $save_log->userlog($save_user->id,"User","Creating a user ".$_SERVER['REQUEST_URI']);

             try {
                $readrole_id=\DB::table('roles')->where('name','lawyers')->select('id')->first();
                \DB::table('role_user')->insert([['user_id' =>  $save_user->id, 'role_id' =>  $readrole_id->id],]);            
            } catch (\Exception $e) {}

            try {
                $send_communication = new Communication();
                $sms="Dear ".$save_user->name." your Themis password is ".$pin." and email is ".$save_user->email." visit http://cases.cehurd.org:8080 to login";
                $send_communication->send_Email($save_user->email,"Themis node initial password",$sms,env("EMAIL_ADDRESS"));
                $send_communication->send_SMS($sms,$save_user->phone_number);
            } catch (\Exception $e) {}

            $status="User created successfully.";
        }
        echo $sms;
        exit;
        return redirect('user')->with(["status"=>$status]);
    }

 
    public function show($id)
    {
        $user = User::find($id);
        $status = "";
        if ($user->status == 0) {
            $user->status = 1;
            $status = "User access has been granted";
        }
        elseif ($user->status == 1) {
            $user->status = 0;
            $status = "User access has been restricted";
        }
        $user->save();
        return back()->with(['status'=>$status]);
    }
 
    public function edit($id)
    {
        //
    }
 
    public function update(Request $request, $id)
    {
        //
    }
 
    public function destroy($id)
    {
        //
    }

    public function change_password(Request $request)
    {
        $this->validate($request,["password"=>"required|confirmed"]);
        $user=\Auth::user();
        $user->password=bcrypt($request->password);
        try {
            $user->save();
            $status = "New password has been set.";
        } catch (\Exception $e) {
            $status = $e->getMessage();
        }
        return back()->with(['status'=>$status]);
    }

    public function forgot_password(Request $request)
    {
        $this->validate($request,["email"=>"required"]);

        if (User::all()->where('email',$request->email)->count() == 1) {

            $save_user = User::all()->where('email',$request->email)->last();

            $characters = env("PASSWORD_STRING");
            $charactersLength = strlen($characters);
            $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
            $pin=$randomString;
                    
            try {
                $save_user->password=bcrypt($pin);
                $save_user->save();
                $send_communication = new Communication();
                $sms="Dear ".$save_user->name." your new Themis node password is ".$pin;
                $send_communication->send_Email($save_user->email,"Themis new password",$sms,env("EMAIL_ADDRESS"));
                $send_communication->send_SMS($sms,$save_user->phone_number);
            //echo $sms;
             } catch (\Exception $e) {}
                print_r ($pin);
            //return redirect('/login');

        }else{
            return back()->with(['status'=>'The Email you entered was not found in the system']);
        }

    }
}
