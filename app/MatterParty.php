<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterParty extends Model
{
    public function party($value='')
    {
    	return $this->belongsTo('App\Party');
    }
}
