<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'User',
                'username' => 'syemsul',
                'email' => 'syem@gmail.com',
                'password' => bcrypt('syemsul'),
                'photo' => 'image.png',
                'roles_id' => 2
            ],
            [
                'name' => 'Admin',
                'username' => 'syem_12',
                'email' => 'syem12@gmail.com',
                'password' => bcrypt('asyam123'),
                'photo' => 'images.png',
                'roles_id' => 1
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
