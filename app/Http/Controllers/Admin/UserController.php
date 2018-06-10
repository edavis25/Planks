<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Init query
        $users = User::query();

        // Look for any search params
        if ($request->has('search')) {
            $users->where('name', 'like', "%{$request->input('search')}%");
        }

        $users = $users->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Creating users handled by registration
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creating users handled by registration
        abort(404);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->input('is_admin') ? true : false;
        $user->is_super_user = $request->input('is_super_user') ? true : false;

        try {
            $user->save();
            \App\Helpers\FlashMessage::success($user->name . ' has been updated.');
            return redirect()->action('UserController@index');
        }
        catch (\Exception $e) {
            \App\Helpers\FlashMessage::danger('Something went wrong updating the user.', $e->errorInfo[2]);
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            \App\Helpers\FlashMessage::success($user->name . ' has been deleted.');
            return redirect()->action('UserController@index');
        }
        catch (\Excecption $e) {
            \App\Helpers\FlashMessage::danger('Something went wrong deleting your user.', $e->errorInfo[2]);
            return back();
        }
    }
}
