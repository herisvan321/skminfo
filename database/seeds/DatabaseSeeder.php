<?php

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
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            "name" => "admin",
            "email" => "admin@stkip.com",
            "password" => Hash::make("12345678"),
            "level" => 1
        ]);
    }
}
