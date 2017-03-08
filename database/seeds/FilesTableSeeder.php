<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('files')->delete();
        
        \DB::table('files')->insert(array (
            0 => 
            array (
                'id' => 2,
                'original_name' => 'Disc.jpg',
                'save_name' => '6aed929bbc271f0b9eeb06be99961430720da0f5.jpg',
                'save_path' => '2016-09-01/c66da32b88774fe90d2938adfbfc18e35da5b730/6aed929bbc271f0b9eeb06be99961430720da0f5.jpg',
                'extension' => 'jpg',
                'mime' => 'image/jpeg',
                'size' => 2917850,
                'md5' => '446ea68f03390cab96ca0039fa6c28c9',
                'sha1' => '01a547f12bad686df4ed751cec46e911ba15149e',
                'location' => 1,
                'created_at' => '2016-09-01 08:44:32',
                'updated_at' => '2016-09-01 08:44:32',
                'url' => '/uploads/2016-09-01/c66da32b88774fe90d2938adfbfc18e35da5b730/6aed929bbc271f0b9eeb06be99961430720da0f5.jpg',
            ),
        ));
        
        
    }
}
