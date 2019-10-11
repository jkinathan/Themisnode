<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //

    public function matter($value='')
    {
    	# code...
    	return $this->belongsTo('App\Matter');
    }
}
