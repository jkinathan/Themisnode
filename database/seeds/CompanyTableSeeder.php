<?php

use Illuminate\Database\Seeder;
use App\Company;
class CompanyTableSeeder extends Seeder
{
    public function run()
    {
        $save_main_company = new Company();
        $save_main_company->name = "Setup Campany";
        $save_main_company->location_address = "Hive Colab Kampala";
        $save_main_company->phone_number = "+256787444081";
        $save_main_company->email_address = "thembocharles123@gmail.com";
        $save_main_company->website_url = "themisnode.com";
        $save_main_company->logo_url = "logo.png";
        $save_main_company->save();
    }
}
