<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMessage;
use App\Mail\ContactFormSubmissionToAdmin;
use App\Http\Requests\ContactSubmissionRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactSubmissionRequest $request)
    {
        try {
            $emails = explode(',', env('ADMIN_EMAILS'));
            foreach($emails as $email) {
                Mail::to($email)->send(new ContactFormSubmissionToAdmin($request->name, $request->phone, $request->date, $request->description));
            }

            FlashMessage::success('Your message has been submitted! We will contact you about your event in the next 48-72 hours.');
            return redirect()->route('home', '#contact-form');
        }
        catch (\Exception $e) {
            FlashMessage::danger('Oops! Something went wrong sending your message. Please call us at <strong>614-443-4570</strong>');
            return redirect()->back();
        }
    }
}
