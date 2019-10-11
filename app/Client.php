<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function matter($value='')
    {
    	# code...
    	return $this->hasMany('App\Matter');
    }

    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }
    public function statute($value='')
    {
    	return $this->hasOne('App\Statute');
    }
}
