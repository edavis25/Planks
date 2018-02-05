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
        \App\Category::create([
            'name' => 'Appetizers',
        ]);
        \App\Category::create([
            'name' => 'Salads and Soups'
        ]);
        \App\Category::create([
            'name' => 'Burgers',
            'details' => 'All burgers are 7 ounces and served with lettuce, tomato, and onion on a brioche bun with your choice of one side.',
        ]);
        \App\Category::create([
            'name' => 'Sandwiches',
            'details' => 'All Sandwiches are served with your choice of one side.',
        ]);
        \App\Category::create([
            'name' => 'Subs',
            'details' => 'All subs are served with your choice of one side.',
        ]);
        \App\Category::create([
            'name' => 'Entrees',
            'details' => 'All Entrees are served with your choice of two sides.',
        ]);
        \App\Category::create([
            'name' => 'Sides'
        ]);
        \App\Category::create([
            'name' => 'Pizza'
        ]);
        \App\Category::create([
            'name' => 'Draft Beer'
        ]);
        \App\Category::create([
            'name' => 'Bottled Beer'
        ]);
        
        /* This seeding method throws errors on details insert for some reason...
        DB::table('categories')->insert([
            [
                'name' => 'Appetizers',
            ],
            [
                'name' => 'Salads and Soups'
            ],
            [
                'name' => 'Burgers',
                //'details' => 'All burgers are 7 ounces and served with lettuce, tomato, and onion on a brioche bun with your choice of one side.',
            ],
            [
                'name' => 'Sandwiches',
                //'details' => 'All Sandwiches are served with your choice of one side.',
            ],
            [
                'name' => 'Subs',
                //'details' => 'All subs are served with your choice of one side.',
            ],
            [
                'name' => 'Entrees',
                //'details' => 'All Entrees are served with your choice of two sides.',
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
        */
    }
}
