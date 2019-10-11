<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('file_title')->nullable();
            $table->string('file_url')->nullable();
            $table->string('file_description')->nullable();

            $table->integer('matter_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('matter_followup_id')->unsigned()->nullable();
            $table->integer('courtbook_id')->unsigned()->nullable();
            $table->integer('courtbook_followup_id')->unsigned()->nullable();
            $table->integer('communication_id')->unsigned()->nullable();

            $table->foreign('courtbook_id')->references('id')->on('court_books')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('communication_id')->references('id')->on('communications')->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('matter_id')->references('id')->on('matters')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('matter_followup_id')->references('id')->on('matter_followups')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('courtbook_followup_id')->references('id')->on('courtbook_followups')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('documents');
    }
}
