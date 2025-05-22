<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use App\Models\SavedPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //This method will show our home page
    public function index() {
        return view('front.home');
    }

    public function search(Request $request)
    {
        $query = Pets::query();

        // Apply search filters if they are provided
        if ($request->has('name') && !empty($request->input('name'))) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('type') && !empty($request->input('type'))) {
            $query->where('type', 'like', '%' . $request->input('type') . '%');
        }

        if ($request->has('location') && !empty($request->input('location'))) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        // Get the filtered pets
        $pets = $query->get();

        // Return the view with pets data
        return view('front.account.index', compact('pets'));
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

    // Check if user already saved the pet
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
    return view('front.blog');
}

public function contactUs()
{
    return view('front.contact');
}


}
