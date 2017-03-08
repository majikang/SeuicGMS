<?php
/**
 * Created by PhpStorm.
 * User: mjk
 * Time: 2016/08/10 15:46
 */
namespace App\Http\Controllers\Backend;

use App\Facades\DepartRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Form\DepartCreateForm;
use App\Http\Requests\Form\DepartUpdateForm;
use Illuminate\Http\Request;
/**
 * 部门管理控制器
 *
 * @package App\Http\Controllers\Backend
 */
class DepartController extends Controller
{
    /**
     * 显示部门信息
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allDeparts=DepartRepository::all()->toArray();
        $depart=array_keymerge($allDeparts, 'id', 'name');
        $data = DepartRepository::paginate(config('repository.page-limit'));
        return view("backend.depart.index", compact('data','depart'));
    }

    /**
     * 创建部门页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tree = create_level_tree(DepartRepository::getAllDepart());
        return view("backend.depart.create", compact('tree'));
    }

    /**
     * 保存部门信息
     *
     * @param DepartCreateForm $request
     *
     * @return $this|mixed
     */
    public function store(DepartCreateForm $request)
    {
        if($request->pid==0){
            $request['path']=0;
        }else{
            $request['path']=DepartRepository::find($request->pid)->path;
        }
        try {
            if ($model=DepartRepository::create($request->all())) {
                $model->path=$model->path.','.$model->id;
                $model->save();
                return $this->successRoutTo('backend.depart.index', "新增部门成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $tree = create_level_tree(DepartRepository::getAllDepart());
        $depart = DepartRepository::find($id);

        return view('backend.depart.edit', compact('depart', 'tree'));
    }


    public function update(DepartUpdateForm $request, $id)
    {
        if ($request->pid==0) {
            $request['path']='0,'.$id;
        } else {
            $request['path']=DepartRepository::find($request->pid)->path.','.$id;
        }
        $data = [
            'name'           => $request['name'],
            'description'    => $request['description'],
            'pid'            => $request['pid'],
            'sort'           => $request['sort'],
            'state'          => $request['state'],
            'path'           => $request['path'],
        ];
        try {
            $model = DepartRepository::updateByWhere(['id'=>$id],$data);
            if ($model==0) {
                return $this->successRoutTo('backend.depart.index', "编辑部门成功,信息没有变化");
            }

            if ($model==1) {
                return $this->successRoutTo('backend.depart.index', "编辑部门成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            if (DepartRepository::destroy($id)) {
                return $this->successBackTo('删除部门成功');
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }

}