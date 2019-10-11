<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    public function matter($value='')
    {
    	# code...
    	return $this->belongsTo('App\Matter');
    }

    public function user($value='')
    {
    	# code...
    	return $this->belongsTo('App\User');
    }
}
