<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class DepartUpdateForm extends Request
{
    /**
     * 验证是否有权限来请求
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 创建部门的表单规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required',
            'pid'         => 'required',
            'sort'        => 'required',
            'state'        => 'required',
            'description' => 'required',
        ];
    }

    /**
     * Get the validation message that apply to the request
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => '部门名称不能为空',
            'pid.required'         => '上级部门不能为空',
            'sort.required'        => '排序不能为空',
            'state.required'        => '部门状态不能为空',
            'description.required' => '部门描述不能为空'
        ];
    }
}
