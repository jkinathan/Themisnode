<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticeArea extends Model
{
    public function matter()
    {
    	return $this->belongsToMany('App\Matter','matter_practice_area','matter_id','practiceareas_id');
    }
}
