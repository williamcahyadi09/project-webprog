<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'role_id' => '2',
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('user1')
            ],
            [
                'role_id' => '1',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin')
            ],
            [
                'role_id' => '2',
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('user2')
            ]
        ]);
    }
}
