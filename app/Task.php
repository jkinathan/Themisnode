<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    public function matter($value='')
    {
    	# code...
    	return $this->belongsTo('App\Matter');
    }

    public function users($value='')
    {
    	# code...
    	return $this->belongsToMany('App\User');
    }

    public function document($value='')
    {
        # code...ret
        return $this->hasMany('App\Document');

    }
}
