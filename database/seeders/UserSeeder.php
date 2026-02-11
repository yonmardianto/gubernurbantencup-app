<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            [
                'name' => 'Yon Mardianto',
                'email' => 'test.user@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'manager-team',
                'club' => 'Banten FC',
                'no_hp' => '081234567890',

            ],

        ];

        User::insert($users);
    }
}
