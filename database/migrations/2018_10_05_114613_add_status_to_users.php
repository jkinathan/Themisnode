<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToUsers extends Migration
{

    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('status',2)->default(1);            
        });
    }
    
    public function down()
    {
        Schema::table('users', function($table) {
         $table->dropColumn('status');
        });
    }
}
