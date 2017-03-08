<?php

namespace App\Traits\Model;

trait RoleBelongsToOneTrait
{
    public function datarule()
    {
        return $this->hasOne('App\Models\Datarule','role_id');
    }
}