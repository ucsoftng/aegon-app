<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('secret'),
        ]);
    }
}
