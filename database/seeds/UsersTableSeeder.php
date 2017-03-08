<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Admin',
                'email' => 'admin@qq.com',
                'password' => '$2y$10$.DjKQiKxfvN.g2raBEIJqu7VAGa9rTKzBqQPb6eoFf9jIOX3OrOhO',
                'is_super_admin' => 1,
                'dep_id' => 2,
                'remember_token' => 'wcrTdOnMk7zYmumHzE5rBqN7VhQ8ExudiXnoCn4asShiMm6kfaLkLH67LUlX',
                'lastlogintime' => '2016-09-08 08:58:38',
                'lastloginip' => '192.168.200.1',
                'created_at' => '2016-05-19 09:52:51',
                'updated_at' => '2016-09-06 10:53:55',
            ),
            1 => 
            array (
                'id' => 5,
                'name' => 'mjk',
                'email' => 'mjk@qq.com',
                'password' => '$2y$10$hzSNJz2lZ.mAAXgHfr/Q5.Uoiz9wTjZLhjEx6j7Lf0GMDL4Lfl/de',
                'is_super_admin' => 0,
                'dep_id' => 2,
                'remember_token' => '',
                'lastlogintime' => '2016-09-02 12:45:43',
                'lastloginip' => '192.168.200.1',
                'created_at' => '2016-08-08 13:18:32',
                'updated_at' => '2016-08-31 15:46:24',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'test1',
                'email' => 'test1@qq.com',
                'password' => '$2y$10$luyNHacVc0q6PB9D68qdyOI4BOTCVdHaiaZroJQChECR9HTAlHmUq',
                'is_super_admin' => 0,
                'dep_id' => 6,
                'remember_token' => NULL,
                'lastlogintime' => NULL,
                'lastloginip' => NULL,
                'created_at' => '2016-09-08 09:01:10',
                'updated_at' => '2016-09-08 09:01:10',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => '1',
                'email' => '10307440@qq.com',
                'password' => '$2y$10$JZHpx/mVwVYzO9xVoTTMkOmPx./QsNom6sZSwuJNErX6PWGwD2B0C',
                'is_super_admin' => 0,
                'dep_id' => 7,
                'remember_token' => NULL,
                'lastlogintime' => NULL,
                'lastloginip' => NULL,
                'created_at' => '2016-09-08 09:09:30',
                'updated_at' => '2016-09-08 09:09:30',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => '1',
                'email' => '1@qq.com',
                'password' => '$2y$10$8oL0gVFh.Q2ACIIZbCiV8eOCAJwUl00qgpjElAJjO0qftJZhwiKny',
                'is_super_admin' => 0,
                'dep_id' => 8,
                'remember_token' => NULL,
                'lastlogintime' => NULL,
                'lastloginip' => NULL,
                'created_at' => '2016-09-08 09:13:37',
                'updated_at' => '2016-09-08 09:13:37',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'winner',
                'email' => '2@qq.com',
                'password' => '$2y$10$fZK8r4Je6kb.4KUuKAWPRONk/lSjAg3MrwgTNAR0MHNWK2sc1CLV.',
                'is_super_admin' => 0,
                'dep_id' => 3,
                'remember_token' => NULL,
                'lastlogintime' => NULL,
                'lastloginip' => NULL,
                'created_at' => '2016-09-08 09:23:39',
                'updated_at' => '2016-09-08 09:23:39',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => '11',
                'email' => '111@qq.com',
                'password' => '$2y$10$VAzCz7G0bjvb3AgoZNvLU.44eoKeMAC8uRsAOXJJjnrkpQr202tVm',
                'is_super_admin' => 0,
                'dep_id' => 4,
                'remember_token' => NULL,
                'lastlogintime' => NULL,
                'lastloginip' => NULL,
                'created_at' => '2016-09-08 09:35:53',
                'updated_at' => '2016-09-08 09:54:48',
            ),
        ));
        
        
    }
}
