<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:30',
            'cityname' => 'required',
            'breedname' => 'required',
            'price_range' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'message' => 'required|max:100',
            'functionname' => 'nullable',
        ]);

        $enquiry = Enquiry::create($data);

        Mail::send('front.email.enquiry-email', ['data' => $data], function ($message) use ($data) {
            $message->to('anjalibhorhari008@gmail.com')
                    ->subject('New Puppy Enquiry from ' . $data['name']);
        });

        return back()->with('success', 'Your enquiry has been sent successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }
}
