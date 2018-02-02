<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Category;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Init query
        $dishes = Dish::query();

        // Look for any search params
        if ($request->has('search')) {
            $dishes->where('name', 'like', "%{$request->input('search')}%");
        }

        $dishes = $dishes->paginate(5);
        return view('dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get array of categories to populate select box:
        // pluck the collection to create array that matches input expected by select
        // box. Each <option> value = the array's values (category_id) and the array's
        // keys are shown to user as the text inside the dropdown select box
        $categories = Category::all()->pluck('name', 'id')->toArray();

        return view('dishes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish $dish (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish $dish (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        // Get array of categories to populate select box:
        // pluck the collection to create array that matches input expected by select
        // box. Each <option> value = the array's values (category_id) and the array's
        // keys are shown to user as the text inside the dropdown select box
        $categories = Category::all()->pluck('name', 'id')->toArray();

        return view('dishes.edit', compact('dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish $dish (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        // TODO: Add some validation
        $dish->update($request->all());

        $request->session()->flash('flash_message', $dish->name . ' has been updated.');
        $request->session()->flash('flash_status', 'success');

        return redirect()->action('DishController@show', [$dish]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
