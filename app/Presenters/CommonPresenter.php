<?php

namespace App\Presenters;

/**
 * Menu View Presenters
 */
abstract class CommonPresenter
{
    /**
     * 格式化时间
     *
     * @param  int $unixTime
     *
     * @return string
     */
    public function showDateFormat($unixTime)
    {
        return date('Y-m-d H:i', $unixTime);
    }

    /**
     * 格式化版权归属
     *
     * @return string
     */
    public function showCopyright()
    {
        return ' <div style="text-align: center;"><strong>Copyright © ' . date('Y') . ' <a href="#" target="_blank">Build with Laravel by Seuic </a></strong></div> ';
    }
}
