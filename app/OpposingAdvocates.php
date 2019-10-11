<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpposingAdvocates extends Model
{
    public function courtbook($value='')
    {
    	return $this->belongsTo('App\CourtBook');
    }
}
