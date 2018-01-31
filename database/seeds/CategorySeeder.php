<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Appetizers'
            ],
            [
                'name' => 'Salads and Soups'
            ],
            [
                'name' => 'Burgers'
            ],
            [
                'name' => 'Sandwiches'
            ],
            [
                'name' => 'Subs'
            ],
            [
                'name' => 'Entrees'
            ],
            [
                'name' => 'Sides'
            ],
            [
                'name' => 'Pizza'
            ],
            [
                'name' => 'Draft Beer'
            ],
            [
                'name' => 'Bottled Beer'
            ]
        ]);
    }
}
