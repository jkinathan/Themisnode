<?php

use Illuminate\Database\Seeder;
use App\CaseType;
class CaseTypeTableSeeder extends Seeder
{
    public function run()
    {
        $save_casetype = new CaseType();
        $save_casetype->name = "Violations";
        $save_casetype->save();

        $save_casetype = new CaseType();
        $save_casetype->name = "Misdemeanors";
        $save_casetype->save();

        $save_casetype = new CaseType();
        $save_casetype->name = "Felonies";
        $save_casetype->save();
    }
}
