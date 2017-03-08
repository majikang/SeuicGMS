<?php

namespace App\Repositories;
use Cache;

/**
 * Permission Model Repository
 */
class PermissionRepository extends CommonRepository
{

    /**
     * 所有菜单缓存键
     */
    const ALL_MENUS_CACHE = 'all_menus_cache';
    /**
     * 所有权限缓存键
     */
    const ALL_PERMISSION_CACHE = 'all_permission_cache';
    /**
     *所有顶级显示菜单缓存键
     */
    const ALL_TOP_MENUS_CACHE = 'all_top_menus_cache';

    /**
     * 所有显示菜单缓存键
     */
    const ALL_ACTIVE_MENUS_CACHE = 'all_active_menus_cache';

    /**
     * 所有显示权限缓存键
     */
    const ALL_ACTIVE_PERMISSION_CACHE = 'all_active_permission_cache';


    public function countMenu()
    {
        return $this->model->where('is_menu', '=', 1)->count();
    }
    public function countAction()
    {
        return $this->model->where('is_menu', '=', 0)->count();
    }

    /**
     * 获取所有激活的权限
     *
     * @return array
     */
    public function getAllActivePermissions()
    {
        $permissions = Cache::get(self::ALL_ACTIVE_PERMISSION_CACHE);

        if (empty($permissions)) {
            $permissions = $this->model->where(['state'=>1])->get();
            Cache::forever(self::ALL_ACTIVE_PERMISSION_CACHE, $permissions);
            return $permissions;
        } else {
            return $permissions;
        }
    }

    /**
     * 获取所有权限
     *
     * @return array
     */
    public function getAllPermissions()
    {
        $permissions = Cache::get(self::ALL_PERMISSION_CACHE);
        //self::clearPermisssionCache();
        //dd(Cache::get(self::ALL_PERMISSION_CACHE));
        if (empty($permissions)) {
            $permissions = $this->model->all();
            Cache::forever(self::ALL_PERMISSION_CACHE, $permissions);
            return $permissions;
        } else {
            return $permissions;
        }
    }
    /**
     * 获取所有菜单
     *
     * @return array
     */
    public function getAllMenus()
    {
        $menus = Cache::get(self::ALL_MENUS_CACHE);

        if (empty($menus)) {
            $menus = $this->model->where(['is_menu'=>1])->get();
            Cache::forever(self::ALL_MENUS_CACHE, $menus);
            return $menus;
        } else {
            return $menus;
        }
    }

    /**
     * 获取所有激活菜单
     *
     * @return array
     */
    public function getAllActiveMenus()
    {
        $menus = Cache::get(self::ALL_ACTIVE_MENUS_CACHE);

        if (empty($menus)) {
            $menus = $this->model->where(['state'=>1,'is_menu'=>1])->orderBy('id', 'asc')->get();
            Cache::forever(self::ALL_ACTIVE_MENUS_CACHE, $menus);
            return $menus;
        } else {
            return $menus;
        }
    }
    /**
     * 获取所有显示菜单
     *
     * @return array
     */
    /*    public function getAllDisplayMenusByRole($role_id)
        {
            $menus = Cache::get(self::ALL_DISPLAY_MENUS_CACHE);

            if (empty($menus)) {
                $menus = $this->model->whereHide(0)->orderBy('sort', 'asc')->get()->toArray();
                Cache::forever(self::ALL_DISPLAY_MENUS_CACHE, $menus);

                return $menus;
            } else {
                return $menus;
            }
        }*/


    /**
     * 获取所有顶级显示菜单
     *
     * @return mixed
     */
    public function getAllTopMenus()
    {
        $menus = Cache::get(self::ALL_TOP_MENUS_CACHE);

        if (empty($menus)) {
            $menu[''] = '所有菜单';
            $menus = $this->model->whereIsMenu(1)->whereState(1)->wherePid(0)->lists('name', 'id')->toArray();
            $menus = $menu + $menus;
            Cache::forever(self::ALL_TOP_MENUS_CACHE, $menus);
            return $menus;
        } else {
            return $menus;
        }
    }

    /**
     * 根据菜单ID获取子菜单
     *
     * @param $id
     *
     * @return mixed
     */
    public function getChildMenusById($id)
    {
        return $this->model->where('pid', '=', $id)->get()->toArray();
    }

    /**
     * 清除所有的菜单缓存
     *
     * @return array
     */
    public function clearMenuCache()
    {
        Cache::forget(self::ALL_MENUS_CACHE);
        Cache::forget(self::ALL_TOP_MENUS_CACHE);
        Cache::forget(self::ALL_ACTIVE_MENUS_CACHE);
    }

    /**
     * 清除所有的菜单缓存
     *
     * @return array
     */
    public function clearPermissionCache()
    {
        Cache::forget(self::ALL_PERMISSION_CACHE);
        Cache::forget(self::ALL_ACTIVE_PERMISSION_CACHE);
    }
    /**
     * 根据权限模型获取菜单关联树
     *
     * @param $permission
     *
     * @return array
     */
/*    public function getAllMenusTreeByPermissionModel($permission)
    {
        $data = [];
        $menus = MenuFacades::getAllMenusLists();
        $permissions = $permission->menus()->lists('id')->toArray();

        foreach ($menus as $key => $menu) {
            $data[$key]['id'] = $menu['id'];
            $data[$key]['pId'] = $menu['parent_id'];
            $data[$key]['name'] = $menu['name'];
            $data[$key]['open'] = true;
            $data[$key]['value'] = 1;
            if (in_array($menu['id'], $permissions)) {
                $data[$key]['checked'] = true;
            }
        }

        return $data;
    }*/

    /**
     * 根据权限模型获取操作关联树
     *
     * @param $permission
     *
     * @return array
     */
/*    public function getAllActionsByPermissionModel($permission)
    {
        $data = [];
        $actions = ActionFacades::all()->toArray();
        $permissions = $permission->actions()->lists('id')->toArray();

        foreach ($actions as $key => $action) {
            $data[$key]['id'] = $action['id'];
            $data[$key]['pId'] = $action['group'];
            $data[$key]['name'] = $action['name'];
            $data[$key]['open'] = true;
            $data[$key]['value'] = 1;
            if (in_array($action['id'], $permissions)) {
                $data[$key]['checked'] = true;
            }
        }

        foreach (config('cowcat.action-group') as $key => $value) {
            $group['id'] = $key;
            $group['pId'] = 0;
            $group['name'] = $value;
            $group['open'] = true;
            $group['value'] = 1;
            array_push($data, $group);
        }

        return $data;
    }*/
}
