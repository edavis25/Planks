<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     *
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
     * @param  \App\User                 $user
     *
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
            FlashMessage::success($user->name . ' has been updated.');

            return redirect()->route('admin.users.index');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong updating the user.', $e->getMessage());

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            FlashMessage::success($user->name . ' has been deleted.');
            return redirect()->route('admin.users.index');
        }
        catch (\Excecption $e) {
            FlashMessage::danger('Something went wrong deleting your user.', $e->getMessage());
            return back();
        }
    }
}
