<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    //

    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }

    public function matter($value='')
    {
    	return $this->belongsTo('App\Matter');
    }
}
