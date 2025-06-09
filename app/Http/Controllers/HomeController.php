<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use App\Models\SavedPet;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $featuredPets = Pets::whereIn('id', [1, 3, 5, 7])->get();
        $latestPets = Pets::latest()->take(4)->get();
        $reviews = Review::latest()->get();
        $services = Service::latest()->take(3)->get();

        return view('front.home', compact('featuredPets', 'latestPets','reviews','services'));
    }

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

    public function groomingServices()
    {
        $services = Service::latest()->take(3)->get();
        $servicesList = Service::latest()->get();
        return view('front.grooming-services',compact('services','servicesList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
        ]);

        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }

   public function submitBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|digits:10',
            'service' => 'required|string',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'message' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $time24 = date("H:i:s", strtotime($request->appointment_time));

                $data = $request->all();
                $data['appointment_time'] = $time24;

                $booking = Booking::create($data);

                Mail::send('front.email.booking-confirmation', ['booking' => $booking], function ($message) {
                    $message->to('anjalibhorhari008@gmail.com')
                            ->subject('New Grooming Appointment Booking');
                });
            });

            return back()->with('success', 'Your booking has been submitted!');
        } catch (\Exception $e) {
            Log::error('Booking failed (email/db): ' . $e->getMessage());
            return back()->with('error', 'Booking failed. Please try again later.');
        }
    }

   public function groomingServiceDetails($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $servicesList = Service::latest()->get();
        return view('front.grooming-service-details', compact('service','servicesList'));
    }
}
