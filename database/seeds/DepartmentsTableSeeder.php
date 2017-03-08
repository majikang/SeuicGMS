<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('departments')->delete();
        
        \DB::table('departments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '江苏东大集成',
                'description' => '江苏东大集成',
                'pid' => 0,
                'path' => '0,1',
                'sort' => 0,
                'state' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '金融与通信事业部',
                'description' => '金融与通信事业部',
                'pid' => 1,
                'path' => '0,1,2',
                'sort' => 0,
                'state' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '研发部',
                'description' => '研发部',
                'pid' => 2,
                'path' => '0,1,2,3',
                'sort' => 0,
                'state' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '市场部',
                'description' => '市场部',
                'pid' => 2,
                'path' => '0,1,2,4',
                'sort' => 0,
                'state' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '客服部',
                'description' => '客服部',
                'pid' => 2,
                'path' => '0,1,2,5',
                'sort' => 0,
                'state' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '产品管理部',
                'description' => '产品管理部',
                'pid' => 3,
                'path' => '0,1,2,3,6',
                'sort' => 0,
                'state' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '系统研发部',
                'description' => '系统研发部',
                'pid' => 3,
                'path' => '0,1,2,3,7',
                'sort' => 0,
                'state' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '产品研发部',
                'description' => '产品研发部',
                'pid' => 3,
                'path' => '0,1,2,3,8',
                'sort' => 0,
                'state' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => '前端组',
                'description' => '前端组',
                'pid' => 7,
                'path' => '0,1,2,3,7,9',
                'sort' => 0,
                'state' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => '硬件组',
                'description' => '硬件组',
                'pid' => 8,
                'path' => '0,1,2,3,8,10',
                'sort' => 0,
                'state' => 1,
            ),
        ));
        
        
    }
}
