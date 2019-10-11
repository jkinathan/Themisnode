<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('client_type',['individual','company']);
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('phone_number_2');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('client_number')->unique();
            $table->string('tin_number');
            $table->string('reffered_by')->nullable();
            $table->string('referred_by_phone')->nullable();
            $table->string('referred_by_name')->nullable();
            $table->string('date_registered');
            $table->integer('billingtype_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('billingtype_id')->references('id')->on('billing_types')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
}
