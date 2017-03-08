<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
    /**
     * [$guarded description]
     *
     * @var string
     */
    protected static $order = 'sort';

    /**
     * [$guarded description]
     *
     * @var array
     */
    protected static $index = [
        'id',
        'name',
        'describe',
        'path',
        'grade',
        'p_id',
        'hide',
    ];

    /**
     * [$guarded description]
     *
     * @var string
     */
    protected static $sort = 'desc';

    /**
     * [$guarded description]
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * [$guarded description]
     *
     * @var string
     */
    protected $table = "departments";
    public $timestamps = false;
}
