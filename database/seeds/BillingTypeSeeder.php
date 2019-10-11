<?php

use Illuminate\Database\Seeder;
use App\BillingType;

class BillingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $saveBillingType=new BillingType();
        $saveBillingType->name="ONE TIME CLIENT";
        $saveBillingType->save();
    }
}
