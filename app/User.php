<?php

namespace Corp;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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


    public function articles()
    {
        return $this->hasMany('\Corp\Article');
    }

    public function comments()
    {
        return $this->hasMany('Corp\Comment');
    }

    public function roles()
    {
        return $this->belongsToMany('Corp\Role', 'user_role');
    }

    public function canDo($permission, $require = false)
    {
        if (is_array($permission)) {

            foreach ($permission as $permName) {
                $permName = $this->canDo($permName);
                if ($permName && !$require) {
                    return true;
                } elseif (!$permName && $require) {
                    return false;
                }
            }

            return $require;

        } else {

            foreach ($this->roles as $role) {
                foreach ($role->permissions as $perm) {
                    if (str_is($permission, $perm->name)) {
                        return true;
                    }
                }
            }

            return false;

        }
    }

    public function hasRole($name, $require = false)
    {
        if (is_array($name)) {

            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);
                if ($hasRole && !$require) {
                    return true;
                } elseif (!$hasRole && $require) {
                    return false;
                }
            }

            return $require;

        } else {

            foreach ($this->roles as $role) {
                if (str_is($name, $role->name)) {
                    return true;
                }
            }

            return false;

        }
    }
}
