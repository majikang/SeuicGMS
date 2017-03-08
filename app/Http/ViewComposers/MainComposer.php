<?php

namespace App\Http\ViewComposers;

use App\Facades\PermissionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class MainComposer
{
    /**
     * 将数据绑定到视图
     *
     * @param  View $view
     *
     * @return mixed
     */
    public function compose(View $view)
    {
        $currentRoute = Route::currentRouteName();
        $AllMenus = PermissionRepository::getAllMenus()->toArray();
        $AllActiveMenus = PermissionRepository::getAllActiveMenus()->toArray();
        $title = $this->getPageDescriptionArrayByMenus($AllMenus);
        //dd($AllMenus);
        $view->with(compact('AllMenus', 'currentRoute', 'title','AllActiveMenus'));
    }

    private function getPageDescriptionArrayByMenus($AllMenus)
    {
        $arr = [];
        foreach ($AllMenus as $menu) {
            $arr[$menu['action']]['display_name'] = $menu['display_name'];
            $arr[$menu['action']]['description'] = $menu['description'];
        }
        return $arr;
    }
}
