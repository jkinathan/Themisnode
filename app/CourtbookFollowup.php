<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourtbookFollowup extends Model
{
    //
    public function courtbook($value='')
    {
      	return $this->belongsTo('App\CourtBook');
    }

    
    public function document($value='')
    {
        return $this->hasMany('App\Document');
    }

    public function user($value='')
    {
        return $this->belongsTo('App\User');
    }
}
