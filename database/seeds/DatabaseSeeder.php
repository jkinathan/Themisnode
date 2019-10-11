<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanyTableSeeder::class);
    	$this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);        
        $this->call(BillingTypeSeeder::class);        
        $this->call(PracticeAreaSeeder::class);
        $this->call(CaseTypeTableSeeder::class);
    }
}
