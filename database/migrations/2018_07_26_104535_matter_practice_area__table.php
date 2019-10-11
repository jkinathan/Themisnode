<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatterPracticeAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matter_practice_area', function (Blueprint $table) {
            
            $table->timestamps();
            $table->integer('matter_id')->unsigned();
            $table->integer('practiceareas_id')->unsigned();   

            $table->foreign('matter_id')->references('id')->on('matters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('practiceareas_id')->references('id')->on('practice_areas')->onUpdate('cascade')->onDelete('cascade');   

            $table->primary(['matter_id', 'practiceareas_id']);   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('matter_practice_area');
    }
}
