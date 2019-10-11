<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statute extends Model
{
    //
    public function client($value=''){
        return $this->belongsTo('App/Client');
    }
}
