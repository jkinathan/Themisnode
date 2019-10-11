<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Communication;
use App\Company;
use App\User;

class CompanyController extends Controller
{
  
    public function index()
    {
        $companies = Company::all()->where('name','!=','Setup Campany');
        return view('testing.home')->with(['title'=>'Companies','companies'=>$companies]);
    }

   
    public function create()
    {
        //
    }
 
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','location_address'=>'required','phone_number'=>'required','email_address'=>'required','logo_url'=>'required','admin_name'=>'required','email'=>'required|unique:users','phone_number'=>'required']);

        $file_value = $request->file('logo_url');
        $save_company = new Company($request->all());
        $file_name=trim("themis_company_".time().".".$file_value->getClientOriginalExtension());
        $save_company->logo_url=$file_name;
        $file_value->move(public_path('documents'),$file_name);
        $save_company->save();

        // create main user
        $saveuser=new User();
        $saveuser->name = $request->admin_name;
        $saveuser->email = $request->email;

        $characters = env("PASSWORD_STRING");
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }        

        $saveuser->password=bcrypt($randomString);      
        $saveuser->phone_number=$request->phone_number;      
        $saveuser->remember_token=str_random(32);
        $saveuser->company_id = $save_company->id;
        try {
            $saveuser->save();

            $communication = new Communication();

            $sms = "Hello ".$saveuser->name." you have been created as main admin from ".$save_company->name." your login email is ".$saveuser->email." and password is ".$randomString." Vist http://cases.cehurd.org:8080 to login";

            $communication->send_Email($saveuser->email,"Themis Node Access password",$sms,env('EMAIL_ADDRESS'));

            $communication->send_SMS($sms,$saveuser->phone_number);

            try {
                $readrole_id=\DB::table('roles')->where('name','admin')->select('id')->first();
                \DB::table('role_user')->insert([['user_id' =>  $saveuser->id, 'role_id' =>  $readrole_id->id],]);            
            } catch (\Exception $e) {}

        } catch (\Exception $e) {}

        return back();
    }

 
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

 
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}
