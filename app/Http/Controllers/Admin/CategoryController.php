<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        $categories = $categories->paginate(10);
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
            FlashMessage::danger('Something went wrong creating your category.', $e->getMessage());

            return back()->withInput();
        }

        FlashMessage::success($category->name . ' has been created.');

        return redirect()->route('admin.categories.index');
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

        FlashMessage::success($category->name . ' has been updated.');

        return redirect()->route('admin.categories.index');
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
        try {
            $category->delete();
            FlashMessage::success($category->name . ' has been deleted.');

            return redirect()->route('admin.categories.index');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong deleting your category.', $e->getMessage());

            return back();
        }
    }
}
