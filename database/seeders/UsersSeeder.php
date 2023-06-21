<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert user default untuk admin
        DB::table('users')->insert([
            'name'              =>'Admin',
            'email'             =>'admin@mail.com',
            'role'              =>'admin',
            'email_verified_at' =>now(),
            'password'          =>bcrypt('password'),
            'remember_token'    =>Str::random(10),
        ]);
    }
}
