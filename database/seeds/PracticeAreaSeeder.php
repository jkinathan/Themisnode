<?php

use Illuminate\Database\Seeder;
use App\PracticeArea;

class PracticeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $read_PracticeArea=new PracticeArea();
         $read_PracticeArea->name="Human Trafficking";
         try {
         	$read_PracticeArea->save();
         } catch (\Exception $e) {
         	
         }
    }
}
