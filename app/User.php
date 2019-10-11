<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','users','address','phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function matterfollowup($value='')
    {
        # code...
        return $this->hasMany('App\MatterFollowup');
    }

    public function task($value='')
    {
        # code...
        return $this->belongsToMany('App\Task');
    }

    public function expense($value='')
    {
        # code...
        return $this->hasMany('App\Expense');
    }

    public function matter($value='')
    {
        # code...
        return $this->belongsToMany('App\Matter','matter_users');
    }

    public function matters($value='')
    {
        # code...
        return $this->hasManyThrough('App\Matter','matter_users');
    }

    public function company($value='')
    {
        return $this->belongsTo('App\Company');
    }
}
