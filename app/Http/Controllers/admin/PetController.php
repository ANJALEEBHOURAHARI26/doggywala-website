<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    public function index() {
        $pets = Pets::orderBy('created_at','DESC')->paginate(5);
        return view('admin.pets.list',[
            'pets' => $pets
        ]);
    }

    public function edit($id){
        $pet = Pets::findOrFail($id);
        return view('admin.pets.edit',[
            'pet' => $pet
        ]);
    }

    public function updatePet($id, Request $request) {
        $pet = Pets::findOrFail($id);

        $rules = [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'age' => 'required|integer|min:0',
            'location' => 'required|max:50',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Updated to validate 'photo'
    ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->route('account.createPet',$pet->id)->withInput()->withErrors($validator);
        }

        // here we will update pet 
        
        $pet->name = $request->name;
        $pet->type = $request->type;
        $pet->breed = $request->breed;
        $pet->age = $request->age;
        $pet->location = $request->location;
        
        $pet->description = $request->description;
        $pet->contact_info = $request->contact_info;
        $pet->save();

        if ($request->photo != "") {

            // delete old image
            File::delete(public_path('uploads/photos/'.$pet->photo_path));

            // here we will store image
            $photo = $request->photo;
            $ext = $photo->getClientOriginalExtension();
            $photoName = time().'.'.$ext; // Unique image name

            // Save image to pets directory
            $photo->move(public_path('uploads/photos'),$photoName);

            // Save image name in database
            $pet->photo_path = $photoName;
            $pet->save();
        }

        return redirect()->route('admin.pets')->with('success','Pet updated successfully');
    }

}
