<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dish;
use App\Category;

class DishController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
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
        try {
            $dish = new Dish($request->all());
            $dish->save();

            FlashMessage::success($dish->name . ' has been created.');

            return redirect()->route('admin.dishes.index');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong creating your dish.', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish $dish (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Dish $dish)
    {
        //return view('dishes.show', compact('dish'));
        abort(404);
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
        // (more detailed description of logic in "create" function above)
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

        FlashMessage::success($dish->name . ' has been updated.');

        return redirect()->route('admin.dishes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish $dish (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Dish $dish)
    {
        try {
            $dish->delete();
            FlashMessage::success($dish->name . ' has been deleted.');

            return redirect()->route('admin.dishes.index');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong creating your dish.', $e->getMessage());
            return back()->withInput();
        }
    }
}
