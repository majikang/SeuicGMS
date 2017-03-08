<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('DatarulesTableSeeder');
        $this->call('DepartmentsTableSeeder');
        $this->call('FilesTableSeeder');
        $this->call('RoleUserTableSeeder');
        $this->call('PermissionRoleTableSeeder');
        
    }
}