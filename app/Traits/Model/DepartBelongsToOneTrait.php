<?php

namespace App\Traits\Model;

trait DepartBelongsToOneTrait
{
    public function departs()
    {
        return $this->hasOne('App\Models\Depart','id','dep_id');
    }
}