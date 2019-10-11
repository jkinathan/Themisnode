<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','location_address','phone_number','email_address','website_url'];

    public function single_user()
    {
    	return $this->hasOne('App\User');
    }

    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
