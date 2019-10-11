<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('start_date');
            $table->integer('client_id')->unsigned();
            $table->string('name');
            $table->string('originating_lawyer')->nullable();
            $table->string('statutery_limitation')->nullable();
            $table->text('description')->nullable();
            $table->text('status')->nullable();
            $table->text('parties')->nullable();
            $table->string('matter_number')->unique()->nullable();
            $table->integer('company_id')->unsigned();   
            
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matters');
        
    }
}
