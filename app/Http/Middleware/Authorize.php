<?php

namespace App\Http\Middleware;

use App\Facades\UserRepository;
use App\Facades\DataruleRepository;
use Auth, Route, URL;
use Closure;

class Authorize
{

    /**
     * 路由周转
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        /* 判断当前用户是否登录或缓存是否过期 */
        $user = Auth::user();
        if (!$user) {
            return redirect()->to('/auth/logout');
        }


        /* 判断当前用户是否为超级管理员 */
        if ($user['is_super_admin']) {
            return $next($request);
        }
        /* 获取当前路由、控制器方法和上一页 */
        $route = Route::current()->getName();
        /*dd($route);*/
        /* 获取当前控制器方法*/
        /*$ActionName = Route::current()->getActionName();
       */
        /* 获取上一页链接 */
        $previousUrl = URL::previous();
        //获取当前所在模块和参数
        $parameter=Route::current()->parameters();

        if (!$request->ajax()) {
            if(!$user->can($route)){
                return view('backend.errors.403', compact('previousUrl'));
            }
            if (!empty($parameter)) {
                $key=array_keys($parameter)[0];
                $value=array_values($parameter)[0];
                //TODO 路由周转验证权限
                $access=DataruleRepository::checkRuleByRoute($user, $key, $value);

                //如果没有数据权限，则返回403界面
                if (!$access) {
                    return view('backend.errors.403', compact('previousUrl'));
                }
            }
           /* $actions=UserRepository::getUserAllActionByUserModel($user);
            if (!$actions) {
                return view('backend.errors.403', compact('previousUrl'));
            }
            if (! in_array($route, $actions)) {
                return view('backend.errors.403', compact('previousUrl'));
            }*/
        } else {
            if(!$user->can($route)){
                return view('backend.errors.403', compact('previousUrl'));
            }
            if (!empty($parameter)) {
                $key=array_keys($parameter)[0];

                $value=array_values($parameter)[0];
                //TODO 路由周转验证权限
                $access=DataruleRepository::checkRuleByRoute($user, $key, $value);
                //如果没有数据权限，则返回错误信息
                if (!$access) {
                    return response()->json(['status' => 0, 'message' => '没有权限执行此操作']);
                }
            }
           /* $actions = UserRepository::getUserAllActionByUserModel($user);

            if (! $actions) {
                return response()->json(['status' => 0, 'message' => '没有权限执行此操作']);
            }

            if (! in_array($route, $actions)) {

                return response()->json(['status' => 0, 'message' => '没有权限执行此操作']);
            }*/
        }
        return $next($request);
    }
}
