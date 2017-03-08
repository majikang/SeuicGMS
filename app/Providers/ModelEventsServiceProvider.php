<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Depart;
use Illuminate\Support\ServiceProvider;
use App\Events\Cache\ClearMenuCacheEvent;
use App\Events\Cache\ClearPermissionCacheEvent;
use App\Events\Cache\ClearDepartCacheEvent;

class ModelEventsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->listenPermissionModelEvents();

        $this->listenDepartModelEvents();
    }

    /**
     * 监听权限模型事件
     */
    public function listenPermissionModelEvents()
    {
        Permission::created(function () {
            event(new ClearMenuCacheEvent());
            event(new ClearPermissionCacheEvent());

        });
        Permission::saved(function () {
            event(new ClearMenuCacheEvent());
            event(new ClearPermissionCacheEvent());

        });
        Permission::updated(function () {
            event(new ClearMenuCacheEvent());
            event(new ClearPermissionCacheEvent());


        });

        Permission::deleted(function () {
            event(new ClearMenuCacheEvent());
            event(new ClearPermissionCacheEvent());

        });
    }

    /**
     * 监听权限模型事件
     */
    public function listenDepartModelEvents()
    {
        Depart::created(function () {
            event(new ClearDepartCacheEvent());

        });
        Depart::saved(function () {
            event(new ClearDepartCacheEvent());

        });
        Depart::updated(function () {
            event(new ClearDepartCacheEvent());


        });

        Depart::deleted(function () {
            event(new ClearDepartCacheEvent());

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
