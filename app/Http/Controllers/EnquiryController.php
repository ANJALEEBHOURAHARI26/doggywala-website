<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required|max:30',
            'cityname' => 'required',
            'breedname' => 'required',
            'price_range' => 'required',
            'email' => 'nullable|email|max:30',
            'phone' => 'nullable|regex:/[7-9]{1}[0-9]{9}/',
            'message' => 'nullable|max:100',
        ]);

        Enquiry::create($request->all());

        return redirect()->back()->with('success', 'Your enquiry has been submitted successfully!');
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
