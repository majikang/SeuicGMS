<?php

namespace App\Traits\Model;

trait DataruleBelongsToOneTrait
{
    public function datarule()
    {
        return $this->hasOne('App\Models\Datarule','role_id');
    }
}