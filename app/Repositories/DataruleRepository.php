<?php

namespace App\Repositories;

use App\Facades\UserRepository;
use App\Facades\DepartRepository as Depart;

/**
 * Datarule Model Repository
 */
class DataruleRepository extends CommonRepository
{
    public function checkRuleByRoute($user, $key, $value)
    {

        switch($key){
            case 'user':
                $rules=Depart::getAllDepartidByRoleToArray($user);
                $dep=UserRepository::getByWhere([['id','=',$value],['is_super_admin','!=','1']]);
                break;
            default:
                $def=true;
        }
        if(isset($def)){
            return true;
        }
        if(sizeof($dep) != 0){
            foreach ($dep as $item) {
                $dep_id=$item['dep_id'];
                break;
            }
            //TODO 多个模块进行权限控制的时候
            if (in_array($dep_id, $rules)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
