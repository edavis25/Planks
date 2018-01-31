<?php

use Illuminate\Database\Seeder;
use App\Category;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dishes')->insert([
            [
                'name' => 'Chicken Tenders',
                'description' => 'Breaded chicken tenders served with your choice of sauce. Honey mustard, BBQ, or hot sauce.',
                'price' => '$7.00',
                'category_id' => Category::where('name', '=', 'Appetizers')->pluck('id')->first(),
            ],
            [
                'name' => 'Mini Tacos',
                'description' => 'Our tacos are small but big on taste! Served with nacho cheese.',
                'price' => '$7.00',
                'category_id' => Category::where('name', '=', 'Appetizers')->pluck('id')->first(),
            ],
            [
                'name' => 'Italian Salad',
                'description' => 'Fresh lettuce topped with pepperoni, provolone cheese, black olives, banana peppers, and tomatoes.',
                'price' => 'sm...$6.75 lg...$10.00',
                'category_id' => Category::where('name', '=', 'Salads and Soups')->pluck('id')->first(),
            ],
            [
                'name' => 'Willy Burger',
                'description' => 'Fresh ground beef grilled to order.',
                'price' => '$9.25   Add cheese for $0.50',
                'category_id' => Category::where('name', '=', 'Burgers')->pluck('id')->first(),
            ],
            [
                'name' => 'Reuben',
                'description' => 'Grilled corned beef, Swiss cheese, sauerkraut, and thousand island dressing on toasted rye bread.',
                'price' => '$10.00',
                'category_id' => Category::where('name', '=', 'Sandwiches')->pluck('id')->first(),
            ],
            [
                'name' => 'Bratwurst',
                'description' => 'A single German bratwurst OR Jalapeno bratwurst simmered in beer, grilled, and served on a bun.',
                'price' => '$6.75   Topped w/ kraut…$7.00',
                'category_id' => Category::where('name', '=', 'Sandwiches')->pluck('id')->first(),
            ],
            [
                'name' => 'Open-Faced Pot Roast',
                'description' => 'House made Pot Roast served open-faced and covered with gravy. Try it with mashed potatoes.',
                'price' => '$9.50',
                'category_id' => Category::where('name', '=', 'Entrees')->pluck('id')->first(),
            ]
        ]);
    }
}
