<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class ProfileUpdateForm extends Request
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
            'name'     => 'required',
            /*unique:table,column,except,idColumn*/
            'email'    => 'required |unique:users,email,'.$this->id,
            'password' => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => '用户名称不能为空',
            'email.required'     => '用户邮箱不能为空',
            'email.unique'       => '用户邮箱不能重复',
            'password.confirmed' => '确认密码不一致',
        ];
    }
}
