<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterFollowup extends Model
{
    //
    public function user($value='')
    {
    	# code...
    	return $this->belongsTo('App\User');
    }

    public function matter($value='')
    {
    	# code...
    	return $this->belongsTo('App\Matter');
    }

     public function document($value='')
        {
            # code...ret
            return $this->hasMany('App\Document');

        }
}
