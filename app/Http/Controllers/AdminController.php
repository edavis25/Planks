<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationCode;

class AdminController extends Controller
{
    //

    public function create_registration_code(Request $request) {
        $user = $request->user();
        if (!$user) {
            abort(403);
        }

        $registration_code = RegistrationCode::create([
            'code'               => str_random(15),
            'used'               => false,
            'created_by_user_id' => $user->id,
        ]);

        $code = $registration_code->code;

        return view('test', compact('code'));
    }
}
