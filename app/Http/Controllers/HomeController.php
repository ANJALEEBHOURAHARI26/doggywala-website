<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use App\Models\SavedPet;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPets = Pets::whereIn('id', [1, 3, 5, 7])->get();
        $latestPets = Pets::latest()->take(4)->get(); // top 4 latest pets

        return view('front.home', compact('featuredPets', 'latestPets'));
    }

    // public function search(Request $request)
    // {
    //     $query = Pets::query();

    //     // Apply search filters if they are provided
    //     if ($request->has('name') && !empty($request->input('name'))) {
    //         $query->where('name', 'like', '%' . $request->input('name') . '%');
    //     }

    //     if ($request->has('type') && !empty($request->input('type'))) {
    //         $query->where('type', 'like', '%' . $request->input('type') . '%');
    //     }

    //     if ($request->has('location') && !empty($request->input('location'))) {
    //         $query->where('location', 'like', '%' . $request->input('location') . '%');
    //     }

    //     // Get the filtered pets
    //     $pets = $query->get();

    //     // Return the view with pets data
    //     return view('front.account.index', compact('pets'));
    // }

    public function savePet(Request $request)
    {
        $id = $request->id;

        $pet = Pets::find($id);
        if ($pet == null) {
            return response()->json([
                'status' => false,
                'message' => 'Pet not found.'
            ]);
        }

        $count = SavedPet::where([
            'user_id' => Auth::user()->id,
            'pet_id' => $id
        ])->count();

        if ($count > 0) {
            return response()->json([
                'status' => false,
                'message' => 'You already saved this pet.'
            ]);
        }

        $savedPet = new SavedPet;
        $savedPet->pet_id = $id;
        $savedPet->user_id = Auth::user()->id;
        $savedPet->save();

        return response()->json([
            'status' => true,
            'message' => 'You have successfully saved the pet.'
        ]);
    }

    public function blogs()
    {
        $blogDetails = Blog::with('user')->get();
        // dd($blogDetails);
        return view('front.blog',compact('blogDetails'));
    }

    public function blogsDetails($id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        $relatedBlogs = Blog::get();
        return view('front.blog-details', compact('blog', 'relatedBlogs'));
    }


    public function contactUs()
    {
        return view('front.contact');
    }

    public function send(Request $request)
    {
        // Validate form input
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        Mail::send('front.email.contact', [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'content' => $request->message,
        ], function ($message) {
            $message->to('anjalibhorhari008@gmail.com') 
                    ->subject('New Contact Message from Doggywala');
        });

        return back()->with('success', 'Your message has been sent!');
    }
   
    public function availablePuppies($city)
    {
        // Fetch pets based on city (assuming you have a 'city' column in your 'pets' table)
        $petsDetails = Pets::where('location', $city)->get();

        return view('front.available-puppies', compact('petsDetails', 'city'));
    }

    public function searchPuppies(Request $request)
    {
        $city = $request->input('location');
        $name = $request->input('name');
        $type = $request->input('type');

        $petsExists = Pets::where('location', $city)->exists();

        if ($petsExists) {
            return redirect()->route('available-puppies.city', ['city' => $city])
             ->with([
                 'name' => $name,
                 'type' => $type
             ]);
        } else {
            return back()->with('error', 'No pets found in this location.');

        }
    }

    public function show($city)
    {
        $pets = Pets::where('location', 'LIKE', '%' . $city . '%')->get();
        return view('front.pet-details', compact('pets','city'));
    }

    public function available_puppies_details($breed, $city)
    {
        $pets = Pets::where('breed', $breed)
                    ->where('location', $city)
                    ->get();

        return view('front.available-puppies-details', compact('pets', 'city', 'breed'));
    }



}
