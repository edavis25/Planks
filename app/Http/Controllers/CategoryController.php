<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Init query
        $categories = Category::query();

        // Look for any search params
        if ($request->has('search')) {
            $categories->where('name', 'like', "%{$request->input('search')}%");
        }

        $categories = $categories->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            $category = new Category($request->all());
            $category->save();
        }
        catch (\Exception $e) {
            $request->session()->flash('flash_message', 'Something went wrong creating your category.');
            $request->session()->flash('flash_status', 'danger');
            $request->session()->flash('flash_details', $e->errorInfo[2]);
            return back()->withInput();
        }

        $request->session()->flash('flash_message', $category->name . ' has been created.');
        $request->session()->flash('flash_status', 'success');

        return redirect()->action('CategoryController@index');
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
     * @param  \App\Category $category (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category $category (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // TODO: Add some validation
        $category->update($request->all());

        $request->session()->flash('flash_message', $category->name . ' has been updated.');
        $request->session()->flash('flash_status', 'success');

        return redirect()->action('CategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category $category (route-model binding)
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        $request->session()->flash('flash_message', $category->name . ' has been deleted.');
        $request->session()->flash('flash_status', 'success');

        return redirect()->action('CategoryController@index');
    }
}
