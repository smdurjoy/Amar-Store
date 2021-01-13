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
            'name' => 'admin',
            'type' => Str::random(5),
            'mobile' => Str::random(11),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin96'),
            'image' => Str::random(10),
            'status' => '1',
        ]);
    }
}
