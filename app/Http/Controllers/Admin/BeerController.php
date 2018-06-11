<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMessage;
use App\Http\Requests\BeerRequest;
use Illuminate\Http\Request;
use App\Beer;
use App\Category;
use App\Http\Controllers\Controller;

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

        $beers = $beers->paginate(10);
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
     * @param  \App\Http\Requests\BeerRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BeerRequest $request)
    {
        try {
            $beer = new Beer($request->all());
            $beer->save();

            FlashMessage::success($beer->name . ' has been created.');

            return redirect()->route('admin.beers.index');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong creating your beer.', $e->getMessage());
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
     * @param  \App\Http\Requests\BeerRequest  $request
     * @param  \App\Beer                       $beer (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function update(BeerRequest $request, Beer $beer)
    {
        try {
            $beer->update($request->all());
            FlashMessage::success($beer->name . ' has been updated.');

            return redirect()->route('admin.beers.index');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong creating your beer.', $e->getMessage());

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
            FlashMessage::success($beer->name . ' has been deleted.');

            return redirect()->route('admin.beers.index');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong deleting your beer.', $e->getMessage());

            return back();
        }
    }
}
