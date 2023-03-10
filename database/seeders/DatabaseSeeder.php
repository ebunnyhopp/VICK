<?php

namespace Database\Seeders;
use Hash;
use DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            [
            'name'=>'fahmi',
            'email'=>'pagasa7502@tingn.com',
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'role'=>1,
            'password'=>Hash::make('1234'),
            ],
            [
            'name'=>'jason',
            'email'=>'pkoyapa8143@breazeim.com',
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'role'=>3,
            'password'=>Hash::make('9876'),
            ]
            
        ];
        DB::table('users')->insert($user);
    }
}
