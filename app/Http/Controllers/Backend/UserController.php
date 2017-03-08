<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Facades\RoleRepository;
use App\Facades\UserRepository;
use App\Facades\DepartRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Form\UserCreateForm;
use App\Http\Requests\Form\UserUpdateForm;
use App\Http\Requests\Form\ProfileUpdateForm;
use Auth, URL;

/**
 * 用户管理控制器
 *
 * @package App\Http\Controllers\Backend
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $dep_id=DepartRepository::getAllDepartidByRoleToArray($user);

        $data = UserRepository::paginateWhere([['dep_id','in',$dep_id]], config('repository.page-limit'));
        $allDeparts=DepartRepository::getAllDepartByRole($user)->toArray();
        $depart=array_keymerge($allDeparts, 'id','name');
        return view("backend.user.index", compact('data', 'depart'));
    }

    public function search(Request $request)
    {

        $user=Auth::user();
        $dep_id=DepartRepository::getAllDepartidByRoleToArray($user);
        //dd($request->dep_id);
        if (!in_array($request->dep_id, $dep_id) && !$user['is_super_admin']) {
            $previousUrl = URL::previous();
            return view('backend.errors.403', compact('previousUrl'));
        } else {
            $where=$request->get('where');
            if($request->dep_id){
                $depIds=DepartRepository::getChindDepartId($request->dep_id);
                $where[0][2]=$depIds;
                $where[0][1]='in';
            }
            $data = UserRepository::paginateWhere($where, config('repository.page-limit'));
            $allDeparts=DepartRepository::getAllDepartByRole($user)->toArray();
            $depart=array_keymerge($allDeparts, 'id', 'name');
            return view('backend.user.search', compact('data', 'depart'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = RoleRepository::all();
        $departs=create_level_tree(DepartRepository::all()->toArray());
        return view("backend.user.create", compact('roles', 'departs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Form\UserCreateForm $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateForm $request)
    {
        /*if(in_array('1',$request->role_id)){
            $is_super_admin=1;
        }else{
            $is_super_admin=0;
        }*/
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
            'is_super_admin' => $is_super_admin,
            'dep_id'    => (int)$request['dep_id']
        ];
        try {
            $roles = RoleRepository::getByWhereIn('id', $request['role_id']);

            if (empty($roles->toArray())) {
                return $this->errorBackTo("用户角色不存在,请刷新页面并选择其他用户角色");
            }

            $user = UserRepository::create($data);
            if ($user) {
                foreach ($roles as $role) {
                    $user->attachRole($role);
                }
                return $this->successRoutTo('backend.user.index', '新增用户成功');
            }

        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = UserRepository::find($id);
        if(!$user){
            return $this->errorBackTo("不存在此用户！");
        }
        $roles = RoleRepository::all();
        $userRoles = $user->roles->toArray();
        $displayNames = array_map(function ($value) {
            return $value['display_name'];
        }, $userRoles);
        $departs=create_level_tree(DepartRepository::all()->toArray());

        return view('backend.user.edit', compact('user', 'roles', 'userRoles', 'displayNames', 'departs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Form\UserUpdateForm $request
     * @param  int                                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateForm $request, $id)
    {

        $user = UserRepository::find($id);
        if(!$user){
            return $this->errorBackTo("不存在此用户！");
        }
        if ($user->is_super_admin == 1) {
            return $this->errorBackTo("不允许编辑超级管理员资料");
        }
        /*if(in_array('1',$request['role_id'])){
            $is_super_admin=1;
        }else{
            $is_super_admin=0;
        }*/

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->dep_id = $request['dep_id'];

        if ($request['password']) {
            $user->password = bcrypt($request['password']);
        }

        try {
            $roles = RoleRepository::getByWhereIn('id', $request['role_id']);

            if (empty($roles->toArray())) {
                return $this->errorBackTo("用户角色不存在,请刷新页面并选择其他用户角色");
            }

            if ($user->save()) {
                $user->roles()->sync([]);
                foreach ($roles as $role) {
                    $user->attachRole($role);
                }

                return $this->successRoutTo('backend.user.index', "编辑用户成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (UserRepository::destroy($id)) {
                return $this->successBackTo('删除用户成功');
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }




    /**
     * 编辑个人信息
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile($id)
    {
        $user=Auth::user();
        $getid=UserRepository::find($id);

        //var_dump($getid['id']);
        if($user->id!=$getid['id']){
            return $this->errorBackTo('只允许编辑自己信息');
        }
        $user = UserRepository::getUserProfileById($id);
        $color = ['label-danger', 'label-success', 'label-info', 'label-warning', 'label-primary', 'label-black'];

        return view('backend.user.profile', compact('user', 'id', 'color'));
    }

    /**
     * 修改个人信息
     *
     * @param Request $request
     *
     * @return $this|mixed
     * @throws Exception
     */
    public function updateProfile(ProfileUpdateForm $request)
    {
        $user = UserRepository::find($request['id']);
        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($request['password']) {
            $user->password = bcrypt($request['password']);
        }

        try {
            if ($user->save()) {
                return $this->successBackTo( "更新用户信息成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }

    /**
     * 异步上传用户头像
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
/*    public function uploadAvatar(Request $request)
    {
        $file = $request->file('file');

        $uploadService = new UploadService($file, config('cowcat.uploads'));

        try {
            $result = $uploadService->upload();

            if($result['status'] == 0){
                return $this->responseJson($result);
            }

            if(File::create($result['data'])){
                return $this->responseJson($result);
            } else {
                throw new Exception("文件记录失败...");
            }
        }
        catch (\Exception $e) {
            return $this->responseJson($e->getMessage());
        }
    }*/
}
