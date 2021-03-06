<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@lab.it',
            'password' => bcrypt('admin@lab.it'),
            'name' => 'Admin',
            'lastname' => null,
            'editor' => '1',
            'administrator' => '1',
            'active' => '1',
        ]);

        DB::table('lab_business')->insert([
            'businessname' => 'Admin',
            'id_user' => 1,
        ]);

    }
}
