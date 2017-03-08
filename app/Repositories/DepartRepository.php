<?php
/**
 * Created by PhpStorm.
 * User: mjk
 * Time: 2016/08/10 16:23
 */
namespace App\Repositories;
use App\Facades\DataruleRepository;
use Auth;
use Cache;

/**
 * Depart Model Repository
 */
class DepartRepository extends CommonRepository
{
    /**
     * 所有部门缓存键
     */
    const ALL_DEPART_CACHE = 'all_depart_cache';

    /**
     *所有顶级显示部门缓存键
     */
    const ALL_TOP_DEPART_CACHE = 'all_top_depart_cache';

    /**
     *所有激活显示部门缓存键
     */
    const ACTIVE_DEPART_CACHE = 'active_depart_cache';




    /**
     * 获取所有部门
     *
     * @return array
     */
    public function getAllDepartLists()
    {
        $depart = Cache::get(self::ALL_DEPART_CACHE);

        if (empty($depart)) {
            $depart = $this->model->all();
            Cache::forever(self::ALL_DEPART_CACHE, $depart);
            return $depart;
        } else {
            return $depart;
        }
    }

    /**
     * 获取所有显示部门按id排序
     *
     * @return array
     */
    public function getAllDepart()
    {
        $depart = Cache::get(self::ACTIVE_DEPART_CACHE);
        if (empty($depart)) {
            $depart = $this->model->where('state','=',1)->orderBy('sort', 'asc')->get()->toArray();
            Cache::forever(self::ACTIVE_DEPART_CACHE, $depart);
            return $depart;
        } else {
            return $depart;
        }
    }

    public function getAllDepartToArray(){

        $allDeparts=create_level_tree_depart(self::getAllDepart());
        $DepartTrees=[];
        $DepartTrees['']='所有部门';

        foreach($allDeparts as $allDepart){
            $DepartTrees[$allDepart['id']]=$allDepart['html'].$allDepart['name'];
        }
        //dd($DepartTrees);
        return $DepartTrees;
    }


    public function getAllDepartidByRoleToArray($user){
        $role=$user->roles;
        foreach ($role as $item) {
            $dataruleModel=DataruleRepository::find($item->id);
            $rules[]=$dataruleModel->rules;
            //dd($rules);
        }
        $ruleids=[];
        foreach ($rules as $rule) {
            $arr_rule=json_decode($rule, true);
            $temp=$arr_rule['depart']['rule'];
            $ruleids=array_merge($ruleids, $temp);
        }
        $ruleids=array_unique($ruleids);
        return $ruleids;
    }

    public function getAllDepartByRole($user){
        $role=$user->roles;
        foreach ($role as $item) {
            $dataruleModel=DataruleRepository::find($item->id);
            $rules[]=$dataruleModel->rules;
            //dd($rules);
        }
        $ruleids=[];
        foreach ($rules as $rule) {
            $arr_rule=json_decode($rule, true);
            $temp=$arr_rule['depart']['rule'];
            $ruleids=array_merge($ruleids, $temp);
        }
        $ruleids=array_unique($ruleids);
        $DepartByRule=DepartRepository::getByWhereIn('id',$ruleids);
        return $DepartByRule;
    }




    /**
     * 通过id获取到获取所有部门菜单
     *
     * @return array
     */
    public function getChindDepartId($id)
    {
        $departs = Cache::get(self::ACTIVE_DEPART_CACHE);
        if (empty($departs)) {
            $departs = $this->model->where('state','=',1)->orderBy('sort', 'asc')->get()->toArray();
            Cache::forever(self::ACTIVE_DEPART_CACHE, $departs);
        }
        $p=DepartRepository::find($id);
        if(!$p){
            return false;
        }
        $array[]=$p->ToArray();
        $array=array_merge($array,create_child_depart($departs,$id));
        $depIds=[];
        foreach($array as $item){
            $depIds[]=$item['id'];
        }
        return array_unique($depIds);
    }




    public function clearDepartCache()
    {
        Cache::forget(self::ALL_DEPART_CACHE);
        Cache::forget(self::ALL_TOP_DEPART_CACHE);
        Cache::forget(self::ACTIVE_DEPART_CACHE);
    }
}