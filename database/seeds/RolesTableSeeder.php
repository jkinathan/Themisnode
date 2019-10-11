<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $saverole=new Role();
        $saverole->name="main_admin";
        $saverole->display_name="Main Administrator";
        $saverole->description="Can create other orgnisations";
        try {
        	 $saverole->save();
        } catch (\Exception $e) {
        	 echo $e->getMessage();
        }

        $saverole=new Role();
        $saverole->name="lawyers";
        $saverole->display_name="Lawyers";
        $saverole->description="";
        try {
        	 $saverole->save();
        } catch (\Exception $e) {
        	 echo $e->getMessage();
        }

        $saverole=new Role();
        $saverole->name="admin";
        $saverole->display_name="Admin";
        $saverole->description="";
        $saverole->save();
    }
}
