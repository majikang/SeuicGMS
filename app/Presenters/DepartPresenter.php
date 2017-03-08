<?php

namespace App\Presenters;

class DepartPresenter extends CommonPresenter
{

    /**
     * 格式化显示隐藏状态
     *
     * @param int $status
     *
     * @return string
     */
    public function showDisplayFormat($status)
    {
        if ($status) {
            return "显示";
        } else {
            return "隐藏";
        }
    }

    /**
     * 获得新增的按钮
     *
     * @return array
     */
    public function getHandle()
    {
        return [
            [
                'icon'  => 'plus',
                'class' => 'success',
                'title' => '新增',
                'route' => 'backend.depart.create',
            ],
        ];
    }
}