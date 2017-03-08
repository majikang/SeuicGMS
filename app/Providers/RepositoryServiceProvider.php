<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\DepartRepository;
use App\Repositories\DataruleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 合并自定义配置文件
        $configuration = realpath(__DIR__ . '/../../config/repository.php');
        $this->mergeConfigFrom($configuration, 'repository');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUserRepository();
        $this->registerRoleRepository();
        $this->registerPermissionRepository();
        $this->registerDepartRepository();
        $this->registerDataruleRepository();
    }


    public function registerUserRepository()
    {
        $this->app->singleton('userrepository', function ($app) {
            $model = config('repository.models.user');
            $user = new $model();
            $validator = $app['validator'];

            return new UserRepository($user, $validator);
        });
    }

    public function registerRoleRepository()
    {
        $this->app->singleton('rolerepository', function ($app) {
            $model = config('repository.models.role');
            $role = new $model();
            $validator = $app['validator'];

            return new RoleRepository($role, $validator);
        });
    }

    public function registerPermissionRepository()
    {
        $this->app->singleton('permissionrepository', function ($app) {
            $model = config('repository.models.permission');
            $permission = new $model();
            $validator = $app['validator'];

            return new PermissionRepository($permission, $validator);
        });
    }
    public function registerDepartRepository()
    {
        $this->app->singleton('departrepository', function ($app) {
            $model = config('repository.models.depart');
            $dapart = new $model();
            $validator = $app['validator'];

            return new DepartRepository($dapart, $validator);
        });
    }
    public function registerDataruleRepository()
    {
        $this->app->singleton('datarulerepository', function ($app) {
            $model = config('repository.models.datarule');
            $datarule = new $model();
            $validator = $app['validator'];
            return new DataruleRepository($datarule, $validator);
        });
    }
}
