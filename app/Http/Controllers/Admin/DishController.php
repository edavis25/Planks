<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMessage;
use App\Http\Requests\DishRequest;
use App\MenuImage;
use App\Services\ImageUploadService;
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

        $dishes->filterByCategory($request->get('category') ?? null);

        $dishes     = $dishes->paginate(25);
        $categories = [null => 'All'] + Category::all()->pluck('name', 'id')->toArray();

        return view('dishes.index', compact('dishes', 'categories'));
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
     * @param  \App\Http\Requests\DishRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
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
     * @param  \App\Http\Requests\DishRequest  $request
     * @param  \App\Dish                       $dish (route-model binding)
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DishRequest $request, Dish $dish)
    {
        if ($request->hasFile('file')) {
            $storage_path = config('menu_images.storage.food.full_path');
            $uuid = str_random(12);

            $file = $request->file('file');
            $image_service = new ImageUploadService($file, "$storage_path/$uuid");
            if (! $image_service->validImage()) {
                FlashMessage::danger('Invalid file. Accepts: jpg, jpeg, & png files under 5MB in size');
                return redirect()->back();
            }

            /** Force delete any existing images to trigger observer for removal from storage */
            $dish->image()->delete();

            $image = $image_service->processImage();

            MenuImage::firstOrCreate([
                'imageable_id'   => $dish->id,
                'imageable_type' => get_class($dish),
                'filename'       => $file->getClientOriginalName(),
                'filepath'       => $storage_path,
                'filetype'       => $file->getClientMimeType(),
                'size'           => $file->getClientSize(),
                'disk'           => config('filesystems.default'),
                'uuid'           => $uuid
            ]);
        }

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
