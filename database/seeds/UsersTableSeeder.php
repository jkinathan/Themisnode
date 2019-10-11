<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed default super user
        $last_company = Company::all()->last();
        $saveuser=new User();
        $saveuser->name="Admin";
        $saveuser->email="themis@admin.com";
        $saveuser->password=bcrypt("password@");      
        $saveuser->phone_number="+256787444081";      
        $saveuser->remember_token=str_random(32);
        $saveuser->company_id = $last_company->id;
        try {
        	$saveuser->save();
	        try {
	            $readrole_id=\DB::table('roles')->where('name','main_admin')->select('id')->first();
	            \DB::table('role_user')->insert([['user_id' =>  $saveuser->id, 'role_id' =>  $readrole_id->id],]);            
	        } catch (\Exception $e) {
	            echo $e->getMessage();
	        }        	
        } catch (\Exception $e) {
        	echo $e->getMessage();
        }
    }
}
