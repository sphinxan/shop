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
        $this->call([
            BrandTableSeeder::class,
            CategoryTableSeeder::class,
            ProductTableSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
        ]);
    }
}
