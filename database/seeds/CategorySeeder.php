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
            'type' => 'food'
        ]);
        \App\Category::create([
            'name' => 'Salads and Soups',
            'type' => 'food'
        ]);
        \App\Category::create([
            'name'    => 'Burgers',
            'details' => 'All burgers are 7 ounces and served with lettuce, tomato, and onion on a brioche bun with your choice of one side.',
            'type'    => 'food'
        ]);
        \App\Category::create([
            'name'    => 'Sandwiches',
            'details' => 'All Sandwiches are served with your choice of one side.',
            'type'    => 'food'
        ]);
        \App\Category::create([
            'name'    => 'Subs',
            'details' => 'All subs are served with your choice of one side.',
            'type'    => 'food'
        ]);
        \App\Category::create([
            'name'    => 'Entrees',
            'details' => 'All Entrees are served with your choice of two sides.',
            'type'    => 'food'
        ]);
        \App\Category::create([
            'name' => 'Sides',
            'type' => 'food'
        ]);
        \App\Category::create([
            'name' => 'Pizza',
            'type' => 'food'
        ]);
        \App\Category::create([
            'name' => 'Draft Beer',
            'type' => 'drink'
        ]);
        \App\Category::create([
            'name' => 'Bottled Beer',
            'type' => 'drink'
        ]);
    }
}
