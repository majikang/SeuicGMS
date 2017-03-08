<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class PermissionCreateForm extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pid'          => 'required',
            'name'         => 'required|unique:permissions',
            'display_name' => 'required',
            'description'  => 'required',
            'action'       => 'required|unique:permissions',
            'is_menu'      => 'required',
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
            'pid.required'          => '权限上级不能为空',
            'name.required'         => '权限标识不能为空',
            'name.unique'           => '权限标识已存在',
            'display_name.required' => '权限名称不能为空',
            'description.required'  => '权限描述不能为空',
            'action.required'       => '权限路由不能为空',
            'action.unique'         => '权限路由已存在',
            'is_menu.required'      => '是否设置为菜单不能为空',
        ];
    }
}
