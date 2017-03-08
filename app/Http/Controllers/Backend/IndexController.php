<?php

namespace App\Http\Controllers\Backend;
use App\Facades\UserRepository;

use App\Facades\PermissionRepository;
use App\Facades\RoleRepository;
use App\Facades\DepartRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserRepository::count();
        $depart = DepartRepository::count();
        $roles = RoleRepository::count();
        $actions = PermissionRepository::countAction();
        /*$permissions = PermissionRepository::count();*/
        //dd($actions);

        /*return view('backend.index.index', compact('menus', 'roles', 'actions', 'permissions'));*/
        return view('backend.index.index', compact('users','depart', 'roles', 'actions'));
    }
}
