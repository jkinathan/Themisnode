<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourtBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('court_books', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();            
            $table->string('care_openning_date');
            $table->string('case_number');
            $table->string('alias_name')->nullable();//the tittle of the case
            $table->text('alias_description')->nullable();//the description of the case
            $table->integer('matter_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('case_type_id')->unsigned();
            $table->string('stage')->nullable();
            $table->integer('company_id')->unsigned(); 

            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('matter_id')->references('id')->on('matters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('case_type_id')->references('id')->on('case_types')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('court_books');
    }
}
