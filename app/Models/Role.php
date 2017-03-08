<?php
//namespace App\Models;
namespace App\Models;
/*use Illuminate\Database\Eloquent\Model;*/
use Zizaco\Entrust\EntrustRole;
use App\Traits\Model\DataruleBelongsToOneTrait;
/*use App\Traits\Model\MenuBelongsToManyTrait;
use App\Traits\Model\ActionBelongsToManyTrait;*/
//class Role extends Model
class Role extends EntrustRole
{
    //use MenuBelongsToManyTrait, ActionBelongsToManyTrait;
    use DataruleBelongsToOneTrait;
    /**EntrustRole
     * 限制读取字段
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 设置模型表名
     *
     * @var string
     */
    protected $table = "roles";
}