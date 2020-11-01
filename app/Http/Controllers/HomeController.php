<?php

namespace App\Http\Controllers;

use App\Category;
use App\PDFMenu;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home_v2', [
            'food_categories' => Category::food()->with('dishes')->get(),
            'beer_categories' => Category::beer()->with('beers')->get(),
            'food_pdf'        => PDFMenu::where('type', 'food')->first(),
            'beer_pdf'        => PDFMenu::where('type', 'beer')->first(),
            'party_pdf'       => PDFMenu::where('type', 'party')->first()
        ]);
    }
}
