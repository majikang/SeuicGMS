<?php

namespace App\Traits\Model;

trait PermissionBelongsToManyTrait
{
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}