<?php

namespace App\Repositories;
use Cache,Auth;

/**
 * User Model Repository
 */
class UserRepository extends CommonRepository
{
    /**
     *  菜单缓存标识
     */
    const USER_MENU_CACHE = "user_menu_cache";

    /**
     *  激活菜单缓存标识
     */
    const USER_ACTIVE_MENU_CACHE = "user_active_menu_cache";

    /**
     * 权限缓存标识
     */
    const USER_PERMISSIONS_CACHE = "user_permissions_cache";

    /**
     * 根据用户模型获取用户的菜单权限,状态为显示
     *
     * @param $user
     *
     * @return array|mixed
     */
    public function getActiveMenusByUserModel($user)
    {
        //$routes = Cache::get(self::USER_ACTIVE_MENU_CACHE . $user->id);

        if (empty($routes)) {
            //获取登陆用户的角色
            $roles = $user->roles;
            $permissions = [];

            foreach ($roles as $key => $role) {
                $permissions[] = $role->perms;
            }

            //dd($permissions);
            $menus = [];
            foreach ($permissions as $permission) {
                foreach ($permission as $item) {
                    $menus[] = $item->toArray();
                }
            }


            foreach ($menus as $menu) {
                if ($menu['state'] == 0 and $menu['is_menu'] == 1) {
                    continue;
                }
                $routes[] = $menu['action'];
            }
            if ($routes) {
                $routes = array_unique($routes);
            }
            //Cache::forever(self::USER_ACTIVE_MENU_CACHE . $user->id, $routes);
        }
        return $routes;
    }
/*    public function checkRuleByUserModel($user, $value)
    {

    }*/



    /**
     *删除缓存
     */
    public function clearCache()
    {
 /*       $user=Auth::user();
        Cache::forget(self::USER_ACTIVE_MENU_CACHE . $user->id);
        Cache::forget(self::USER_PERMISSIONS_CACHE . $user->id);
        Cache::forget(self::USER_MENU_CACHE . $user->id);*/
    }


    /**
     *通过id获取用户信息
     */
    public function getUserProfileById($id)
    {
        return $this->model->find($id);
    }
}
