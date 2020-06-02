<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => Str::random(6),
            'type' => Str::random(5),
            'mobile' => Str::random(11),
            'email' => Str::random(5).'@gmail.com',
            'password' => Hash::make('password'),
            'image' => Str::random(10),
            'status' => '1',
        ]);
    }
}
