<?php

namespace App\Listeners\Subscribe;
use App\Facades\PermissionRepository;
use App\Facades\UserRepository;
use App\Facades\DepartRepository;


/**
 * 缓存事件订阅器
 *
 * @package App\Listeners\Subscribe
 */
class CacheEventSubscribe
{
    /**
     * 为订阅者注册监听器
     *
     * @param  Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Cache\ClearUserPermissionCacheEvent',
            'App\Listeners\Subscribe\CacheEventSubscribe@clearUserPermissionCache'
        );

        $events->listen(
            'App\Events\Cache\ClearMenuCacheEvent',
            'App\Listeners\Subscribe\CacheEventSubscribe@clearMenuCache'
        );
        $events->listen(
            'App\Events\Cache\ClearPermissionCacheEvent',
            'App\Listeners\Subscribe\CacheEventSubscribe@clearPermissionCache'
        );
        $events->listen(
            'App\Events\Cache\ClearDepartCacheEvent',
            'App\Listeners\Subscribe\CacheEventSubscribe@clearDepartCache'
        );
    }

    /**
     * 清除用户权限缓存
     */
    public function clearUserPermissionCache()
    {
        UserRepository::clearCache();
    }

    /**
     * 清除菜单缓存
     */
    public function clearMenuCache()
    {
        PermissionRepository::clearMenuCache();
    }

    /**
     * 清除权限缓存
     */
    public function clearPermissionCache()
    {
        PermissionRepository::clearPermissionCache();
    }
    public function clearDepartCache()
    {
        DepartRepository::clearDepartCache();
    }

}
