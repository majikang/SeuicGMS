<?php

namespace App\Traits\Model;

trait RolesBelongsToManyTrait
{
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}