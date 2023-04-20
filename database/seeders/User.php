<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "name"=>"Trương Minh Phụng",
            "email"=>"tmpdz7820@gmail.com",
            "password"=>bcrypt("123456"),
        ]);
    }
}
