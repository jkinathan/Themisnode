<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourtBook extends Model
{
    //
    public function matter($value='')
    {
    	# code...
    	return $this->belongsTo('App\Matter');
    }

     public function user($value='')
    {
    	# code...
    	return $this->belongsTo('App\User');
    }

    public function courtbookfollowup($value='')
    {
    	# code...
    	return $this->hasMany('App\CourtbookFollowup','courtbook_id');
    }

    public function opposingparty($value='')
    {
        # code...
        return $this->hasMany('App\OpposingParty','courtbook_id');
    }

    public function opposingadvocates($value='')
    {
        # code...
        return $this->hasMany('App\OpposingAdvocates','courtbook_id');
    }

    public function matterauthority($value='')
    {
        return $this->hasMany('App\MatterAuthority','courtbook_id');
    }

    public function partneringfirm($value='')
    {
        return $this->hasMany('App\PartneringFirm','courtbook_id');
    }

    public function matterwitness($value='')
    {
        return $this->hasMany('App\MatterWitness','courtbook_id');
    }

    public function document($value='')
    {
        return $this->hasMany('App\Document','courtbook_id');
    }

    public function casetype($value='')
    {
        return $this->belongsTo('App\CaseType','case_type_id');
    }
}
