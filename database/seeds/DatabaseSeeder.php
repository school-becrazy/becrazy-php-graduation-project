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
        $seeders = [
            UsersTableSeeder::class,
            BlogOptionsTableSeeder::class
        ];
        $this->call($seeders);
    }
}
