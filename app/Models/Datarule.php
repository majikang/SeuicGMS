<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datarule extends Model
{
    /**
     * [$guarded description]
     *
     * @var array
     */
    protected $guarded = [];
    protected $primaryKey='role_id';
    public $timestamps = false;
    /**
     * [$guarded description]
     *
     * @var string
     */
    protected $table = "datarules";
}
