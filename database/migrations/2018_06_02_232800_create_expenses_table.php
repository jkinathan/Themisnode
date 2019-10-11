<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();            
            $table->text('description')->nullable();
            $table->double('amount',10,2);
            $table->string('date_spent',20);           
            $table->string('supplier_description')->nullable();
            $table->string('invoice_number',20)->nullable();
            $table->integer('matter_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('file_name')->nullable();

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
        Schema::dropIfExists('expenses');
    }
}
