<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
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
            'avatar' => 'dist/images/resources/avatar.png',
            'fname'=>'admin',
            'lname'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin'),
        ]);
    }
}
