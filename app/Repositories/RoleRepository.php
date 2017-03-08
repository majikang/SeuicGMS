<?php

namespace App\Repositories;
use App\Facades\PermissionRepository;
use App\Facades\DepartRepository as Depart;
use App\Facades\DataruleRepository;


/**
 * Role Model Repository
 */
class RoleRepository extends CommonRepository
{
    /**
     * 根据角色获取权限
     *
     * @param $role
     *
     * @return array
     */
/*    public function getTypeGroupPermissionsByRoleModel($role)
    {
        $data = [];
        $permissions = PermissionRepository::all()->toArray();
        $rolePermission = $role->perms()->lists('id')->toArray();

        foreach ($permissions as $key => $permission) {
            $data[$key]['id'] = $permission['id'];
            $data[$key]['pId'] = $permission['type'];
            $data[$key]['name'] = $permission['display_name'] . '(' . $permission['name'] . ')';
            $data[$key]['open'] = true;
            in_array($permission['id'], $rolePermission) && $data[$key]['checked'] = true;
        }

        foreach (config('cowcat.permission-type') as $key => $item) {
            $arr = [];
            $arr['id'] = $key;
            $arr['pId'] = 0;
            $arr['name'] = $item;
            $arr['open'] = true;
            array_push($data, $arr);
        }

        $arr = [];
        $arr['id'] = 0;
        $arr['pId'] = "";
        $arr['name'] = "全部权限";
        $arr['open'] = true;
        array_push($data, $arr);

        return $data;
    }*/
    /**
     * @param $role
     * @return array
     */
    public function getPermissionsByRoleModel($role)
    {
        $data = [];
        $actions = PermissionRepository::getAllActivePermissions()->toArray();
        //dd($actions);
        $roleAction=$role->perms()->lists('id')->toArray();
        foreach ($actions as $key => $action) {
                $data[$key]['id'] = $action['id'];
                $data[$key]['pId'] = $action['pid'];
                $data[$key]['name'] = $action['display_name'];
                $data[$key]['open'] = true;
                if(in_array($action['id'], $roleAction)){
                    $data[$key]['checked'] = true;
                }

        }
        $arr = [];
        $arr['id'] = 0;
        $arr['name'] = "全部权限";
        $arr['open'] = true;
        array_push($data, $arr);

        return $data;
    }


    public function getRuleByDepartModel($id)
    {
        $data = [];
        $departs = Depart::getAllDepart();
        if($find=DataruleRepository::find($id)){
            $array = $find->toArray();
            $json_arr=json_decode($array['rules'], true);

            $rules=$json_arr['depart']['rule'];
        }

        foreach ($departs as $key => $depart) {
            $data[$key]['id'] = $depart['id'];
            $data[$key]['pId'] = $depart['pid'];
            $data[$key]['name'] = $depart['name'];
            $data[$key]['open'] = true;
            if(isset($rules) && in_array($depart['id'], $rules)){
                $data[$key]['checked'] = true;
            }
        }
        return $data;
    }

}
