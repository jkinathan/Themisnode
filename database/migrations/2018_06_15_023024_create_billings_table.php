<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('billing_type',['hourly','flat']);
            $table->integer('matter_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('date_billed');
            $table->double('amount',10,2);
            $table->string('number_of_hours',10)->nullable();       
            $table->text('particulars');
            $table->enum('status',['0','1']);//billed or not billed respectively
            $table->integer('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('matter_id')->references('id')->on('matters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
