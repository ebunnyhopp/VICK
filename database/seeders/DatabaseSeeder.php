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
            'name'=>'Arif',
            'email'=>'arifaiman96@gmail.com',
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'role'=>3,
            'password'=>Hash::make('9876'),
            ],
            [
            'name'=>'Farhan',
            'email'=>'farhanfawwaz98@gmail.com',
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'role'=>2,
            'password'=>Hash::make('9876'),
            ],
            [
            'name'=>'Hilman',
            'email'=>'ameehilman00@gmail.com',
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'role'=>1,
            'password'=>Hash::make('1234'),
            ]
        ];
        DB::table('users')->insert($user);
    }
}
