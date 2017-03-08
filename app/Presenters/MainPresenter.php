<?php

namespace App\Presenters;

use App\Facades\UserRepository;
use Cache, Route, Auth;

/**
 * Menu View Presenters
 */
class MainPresenter extends CommonPresenter
{
    /**
     * 渲染左侧栏菜单视图
     *
     * @param  array $route
     * @param  array $menus
     *
     * @return mixed
     */
    public function renderSidebar(array $menus, $route)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->to('/auth/logout');
        }
        //获取用户权限中状态激活的菜单列表
        $menulist = UserRepository::getActiveMenusByUserModel($user);
        if (! $menulist) {
            return "";
        }
        //dd($action);

        //不是超级用户，不在权限里面的路由，将其删去
        if ($user['is_super_admin'] == 0) {
            foreach ($menus as $key => $menu) {
                if (! in_array($menu['action'], $menulist)) {
                    unset($menus[$key]);
                }
            }
        }
        //根据state获得启用的菜单
        $nothidemenu=self::NotHide($menus);
        //生成二维数组节点树
        $trees = create_node_tree($nothidemenu);

        //dd($trees);
        //获得当前所在目录的路径，数组

        $arrays = self::buildBreadcrumbsArray($menus, $route);
        $arrays=self::NotHide($arrays);
        //返回激活状态的route
        $active = array_map(
            function ($value){
                return $value['action'];
            }, $arrays);
        /* 生成左侧栏 HTML */
        //dd($active);
        //dd($active);
        $sidebar = '<ul class="sidebar-menu">';
        $sidebar .= self::makeSidebar($trees, $active);
        $sidebar .= '</ul>';
        return $sidebar;
    }


    /**
     * 获取当前菜单的逐级目录
     *
     * @param array  $menus
     * @param string $route
     * @param int    $parent_id
     *
     * @return array
     */
    protected static function buildBreadcrumbsArray(array $menus, $action = '', $pid = 0)
    {
        //dd($action);
        $breadcrumbs = [];
        foreach ($menus as $key => $value) {
            if ($action) {
                if ($value['action'] == $action) {
                    $breadcrumbs[] = $value;
                    //echo $value['name'];

                    $breadcrumbs = array_merge($breadcrumbs,
                        self::buildBreadcrumbsArray($menus, '', $value['pid']));
                }

            } else {
                if ($value['id'] == $pid) {
                    $breadcrumbs[] = $value;
                    //echo $value['name'];
                    $breadcrumbs = array_merge($breadcrumbs,
                        self::buildBreadcrumbsArray($menus, '', $value['pid']));
                }

            }
        }

        return $breadcrumbs;
    }

    /**
     * 将菜单中的隐藏菜单过滤掉
     *
     * @param $arrs
     * @return array
     */
    protected static function NotHide($arrs)
    {
        $array=[];
        foreach($arrs as $arr){
            if($arr['state']==0){
                continue;
            }
            $array[]=$arr;
        }
        return $array;
    }

/*    protected static function getParentidByRoute($menu,$route)
    {
        foreach ($menus as $key => $value) {
            $arr1 = explode(".", $route);
            $arr2 = array_pop($arr1);
            //$array = implode(".", $arr2);
            dd($arr1);

        }
    }*/

    /**
     * 生成左侧菜单html
     *
     * @param array $menus
     * @param array $active
     *
     * @return string
     */
    protected static function makeSidebar(array $menus, $active)
    {
        $sidebar = "";
        foreach ($menus as $menu) {
            if ($menu['state'] == 1 and $menu['is_menu'] == 1) {
                if ($menu['child']) {
                    if (in_array($menu['action'], $active)) {
                        $sidebar .= '<li class="treeview active">';
                    } else {
                        $sidebar .= '<li class="treeview">';
                    }
                    $sidebar .= '<a href="javascript:void(0);">
                                    <i class="' . $menu['icon'] . '"></i>
                                    <span>' . trans($menu['display_name']) . '</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                            <ul class="treeview-menu">' .
                        self::makeSidebar($menu['child'], $active) . '
                            </ul>
                        </li>';
                } else {
                    if (in_array($menu['action'], $active)) {
                        $sidebar .= '<li class="active">';
                    } else {
                        $sidebar .= '<li>';
                    }

                    if (Route::has($menu['action'])) {
                        $sidebar .= '<a href="' . route($menu['action']) . '">';
                    } else {
                        $sidebar .= '<a href="javascript:void(0);">';
                    }
                    $sidebar .= '<i class="' . $menu['icon'] . '"></i>
                                <span> ' . trans($menu['display_name']) . '</span>
                            </a>
                        </li>';
                }
            }
        }

        return $sidebar;
    }

    /**
     * 渲染面包屑导航条视图
     *
     * @param  array  $menus
     * @param  string $route
     *
     * @return mixed
     */
    public function renderBreadcrumbs(array $menus, $action)
    {

            $array = self::buildBreadcrumbsArray($menus, $action);
            //生成右侧逐级目录
            $breadcrumbs = self::makeBreadcrumbs($array);
            return $breadcrumbs;
    }

    /**
     * 生成面包屑 右侧
     *
     * @param array $array
     *
     * @return string
     */
    protected static function makeBreadcrumbs(array $array)
    {
        //dd($array);
        $array = two_dimensional_array_sort($array, 'sort', SORT_ASC);

        $breadcrumbs = '<ol class="breadcrumb">';
        foreach ($array as $key => $value) {
            if (count($array) == $key + 1) {
                $breadcrumbs .= '<li class="active">';
            } else {
                $breadcrumbs .= '<li>';
            }

            if ($value['action']) {
                if (Route::has($value['action'])) {
                    $breadcrumbs .= '<a href="' . route($value['action']) . '">';
                } else {
                    $breadcrumbs .= '<a href="#">';
                }
            } else {
                $breadcrumbs .= '<a href="#">';
            }

            if ($value['icon']) {
                $breadcrumbs .= '<i class="fa ' . trans($value['icon']) . '"></i> ';
            }
            $breadcrumbs .= trans($value['display_name']);
            $breadcrumbs .= '</a>';
            $breadcrumbs .= '</li>';
        }
        $breadcrumbs .= '</ol>';
        //dd($breadcrumbs);
        return $breadcrumbs;
    }
}
