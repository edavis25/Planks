<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DishSeeder::class);
        $this->call(BeerSeeder::class);
        $this->call(UserSeeder::class);
    }
}
