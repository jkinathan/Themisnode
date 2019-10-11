<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = [
        'mattername', 'matternumber', 'date', 'activity', 'timeinhours','from','to'
    ];
    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }
    public function matter($value='')
    {
    	return $this->belongsTo('App\Matter');
    }
}
