<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Brian Joe',
                'email' => 'user@gmail.com',
                'password'=> bcrypt('123456789'),
                'role'=> 'student'
            ],


            [
                'name' => 'Adam Instructor',
                'email' => 'instructor@gmail.com',
                'password'=> bcrypt('123456789'),
                'role'=> 'instructor'
            ],
        ];

        User::insert($users);
    }
}
