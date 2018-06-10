<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\RegistrationCode;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    /**
     * Show the admin dashboard page
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin');
    }

    /**
     * Show the page for generating registration code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create_registration_code()
    {
        return view('admin.registration_code');
    }

    /**
     * Create a new registration code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate_registration_code(Request $request)
    {
        $user = $request->user();
        if ($user && $user->is_super_user) {
            $registration_code = RegistrationCode::create([
                'code'               => str_random(15),
                'used'               => false,
                'created_by_user_id' => $user->id,
            ]);

            $code = $registration_code->code;

            return view('admin.display_code', compact('code'));
        }
        else {
            \App\Helpers\FlashMessage::danger('Something went wrong generating your code.', 'Only Super Users are allowed to generate registration codes.');
            return back();
        }
    }

}
