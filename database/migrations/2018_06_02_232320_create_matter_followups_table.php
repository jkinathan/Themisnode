<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatterFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matter_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');            
            $table->string('status',10);            
            $table->string('date_created');            
            $table->text('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('matter_id')->unsigned();
            $table->foreign('matter_id')->references('id')->on('matters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matter_followups');
    }
}
