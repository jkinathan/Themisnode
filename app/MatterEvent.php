<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterEvent extends Model
{
    protected $fillable=["title","description",];

    public function eventuser($value='')
    {
    	return $this->hasMany('App\EventUser','matterevent_id');
    }
}
