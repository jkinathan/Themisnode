<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourtbookFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courtbook_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('courtbook_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('place_of_hearing')->nullable();
            $table->string('presiding_judge_name')->nullable();
            $table->string('court_clerk_name')->nullable();
            $table->string('court_clerk_phonenumber')->nullable();
            $table->string('case_stage')->nullable();
            $table->string('hearing_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('next_hearing_date')->nullable();
            $table->string('next_hearing_place')->nullable();

            $table->foreign('courtbook_id')->references('id')->on('court_books')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('courtbook_followups');
    }
}
