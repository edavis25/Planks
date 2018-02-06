<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beer;
use App\Category;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Init query
        $beers = Beer::query();

        // Look for any search params
        if ($request->has('search')) {
            $beers->where('name', 'like', "%{$request->input('search')}%");
        }

        $beers = $beers->paginate(5);
        return view('beers.index', compact('beers'));
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

        return view('beers.create', compact('categories'));
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
            $beer = new Beer($request->all());
            $beer->save();

            \App\Helpers\FlashMessage::success($beer->name . ' has been created.');

            return redirect()->action('BeerController@index');
        }
        catch (\Exception $e) {
            \App\Helpers\FlashMessage::danger('Something went wrong creating your category.', $e->errorInfo[2]);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beer $beer (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function edit(Beer $beer)
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();
        return view('beers.edit', compact('beer', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beer $beer (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beer $beer)
    {
        // TODO: Add some validation
        try {
            $beer->update($request->all());
            \App\Helpers\FlashMessage::success($beer->name . ' has been updated.');

            return redirect()->action('BeerController@index', [$beer]);
        }
        catch (\Exception $e) {
            \App\Helpers\FlashMessage::danger('Something went wrong creating your beer.', $e->errorInfo[2]);

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beer $beer (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beer $beer)
    {
        try {
            $beer->delete();
            \App\Helpers\FlashMessage::success($beer->name . ' has been deleted.');
            return redirect()->action('BeerController@index');
        }
        catch (\Exception $e) {
            \App\Helpers\FlashMessage::danger('Something went wrong deleting your beer.', $e->errorInfo[2]);

            return back();
        }
    }
}
