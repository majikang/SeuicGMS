<?php

use Illuminate\Database\Seeder;

class DatarulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('datarules')->delete();
        
        \DB::table('datarules')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'rules' => '{"depart":{"column":"id","where":"in","rule":[1,2,3,6,7,9,8,10,4,5]}}',
            ),
            1 => 
            array (
                'role_id' => 2,
                'rules' => '{"depart":{"column":"id","where":"in","rule":[1,2,3,6,7,9,8,10,4,5]}}',
            ),
        ));
        
        
    }
}
