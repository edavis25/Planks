<?php

use Illuminate\Database\Seeder;
use App\Category;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('beers')->insert([
            [
                'name' => 'Bud Light',
                'description' => 'Light Pilsner',
                'price' => '$3.25',
                'category_id' => Category::where('name', '=', 'Bottled Beer')->pluck('id')->first(),
            ],
            [
                'name' => 'Miller Lite',
                'description' => 'Light Pilsner',
                'price' => '$3.25',
                'category_id' => Category::where('name', '=', 'Bottled Beer')->pluck('id')->first(),
            ],
            [
                'name' => 'Newcastle',
                'description' => 'Brown Ale',
                'price' => '$5.00',
                'category_id' => Category::where('name', '=', 'Bottled Beer')->pluck('id')->first(),
            ],
            [
                'name' => 'Blue Moon',
                'description' => 'Belgian Wheat',
                'price' => '$5.00',
                'category_id' => Category::where('name', '=', 'Draft Beer')->pluck('id')->first(),
            ],
            [
                'name' => 'Guinness',
                'description' => 'Irish Stout',
                'price' => '$5.00',
                'category_id' => Category::where('name', '=', 'Draft Beer')->pluck('id')->first(),
            ],
            [
                'name' => 'Sam Adams Seasonal',
                'description' => 'Ask server for the current seasonal selection',
                'price' => '$5.00',
                'category_id' => Category::where('name', '=', 'Draft Beer')->pluck('id')->first(),
            ]
        ]);
    }
}
