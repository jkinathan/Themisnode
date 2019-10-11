<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    //

    public function eventuser($value='')
    {
    	return $this->belongsTo('App\EventUser');

    }

    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }
}
