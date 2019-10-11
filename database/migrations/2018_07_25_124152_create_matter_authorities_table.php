<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatterAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matter_authorities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('courtbook_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('matter_authorities');
    }
}
