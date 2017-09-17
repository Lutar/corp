<?php

namespace Corp;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function articles()
    {
        return $this->hasMany('\Corp\Article');
    }

    public function comments()
    {
        return $this->hasMany('Corp\Comment');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
