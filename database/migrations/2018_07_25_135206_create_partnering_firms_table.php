<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartneringFirmsTable extends Migration
{
 
    public function up()
    {
        Schema::create('partnering_firms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('courtbook_id')->unsigned();
            $table->string('name');           
            $table->string('contact_name');
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('address')->nullable();
            $table->foreign('courtbook_id')->references('id')->on('court_books')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partnering_firms');
    }
}
