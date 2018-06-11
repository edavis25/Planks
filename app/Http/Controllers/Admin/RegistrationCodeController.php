<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMessage;
use App\RegistrationCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RegistrationCodeController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.registration_code');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        try {
            $registration_code = RegistrationCode::create([
                'code'               => str_random(15),
                'used'               => false,
                'created_by_user_id' => $user->id
            ]);

            $code     = $registration_code->code;
            $exp_date = Carbon::now()->addDays(1)->format('m-d-Y @ g:i A');

            return view('admin.display_code', compact('code', 'exp_date'));
        }
        catch (\Exception $e) {
            FlashMessage::danger('Something went wrong generating your code.', $e->getMessage());

            return back();
        }
    }

}
