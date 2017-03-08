<?php

namespace App\Presenters;
use App\Facades\DepartRepository;
class UserPresenter extends CommonPresenter
{
    public function getHandle()
    {
        return [
            [
                'icon'  => 'plus',
                'class' => 'success',
                'title' => '新增',
                'route' => 'backend.user.create',
            ],
        ];
    }

    /**
     * 获取搜索表单
     *
     * @return array
     */
    public function getSearchParams()
    {
        return [
            'route'  => 'backend.user.search',
            'inputs' => [
                [
                    'type'    => 'select',
                    'name'    => 'dep_id',
                    'options' => DepartRepository::getAllDepartToArray(),
                ],
                [
                    'type'        => 'text',
                    'name'        => 'name',
                    'placeholder' => '用户名称',
                ],

            ],
        ];
    }
}