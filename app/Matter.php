<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    //
    public function client($value='')
    {
    	# code...
    	return $this->belongsTo('App\Client');
    }

    public function matterfollowup($value='')
    {
    	# code...
    	return $this->hasMany('App\MatterFollowup');
    }

    public function task($value='')
    {
        # code...
        return $this->hasMany('App\Task');
    }

    public function expense($value='')
    {
        # code...
        return $this->hasMany('App\Expense');
    }
   

    public function practicearea($value='')
    {
        # code...
        return $this->belongsToMany('App\PracticeArea','matter_practice_area','matter_id','practiceareas_id');
    }

    public function users($value='')
    {
        # code...
        return $this->belongsToMany('App\User','matter_users');

    }

    public function document($value='')
    {
        # code...ret
        return $this->hasMany('App\Document');

    }

    public function communication($value='')
    {
        return $this->hasMany('App\Communication');
    }

    public function courtbook($value='')
    {
        return $this->hasMany('App\CourtBook');
    }

    public function matterparty()
    {
        return $this->hasMany('App\MatterParty');
    }
    public function opposingadvocates($value='')
    {
        return $this->hasMany('App\OpposingAdvocates','courtbook_id');
    }
    public function timesheet()
    {
        return $this->hasMany(Timesheet::class, 'matternumber');
    }
}
