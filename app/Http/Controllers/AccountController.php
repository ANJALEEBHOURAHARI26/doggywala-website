<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use App\Models\SavedPet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function registration() {
        return view('front.account.registration');
    }

    public function processRegistration(request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required|min:5',
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','You have registered successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function login() 
    {
        return view('front.account.login');
    }

    public function authenticate(Request $request) {

        $validator = validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error','Either Email/Password is incorrect');
            }
        } else {
            return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }

    public function profile() {

        $id = Auth::user()->id;

        $user = User::where('id',$id)->first();

        return view('front.account.profile',[
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request) {

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);

        if($validator->passes()) {

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            session()->flash('success','Profile updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }
    
    public function updateProfilePic(Request $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'image' => 'required|image'
        ]);

        if($validator->passes()) {

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time(). '.'.$ext;
            $image->move(public_path('/profile_pic/'), $imageName);

            // Delete Old Profile Pic
            File::delete(public_path('/profile_pic/'.Auth::user()->image));

            User::where('id',$id)->update(['image' => $imageName]);

            session()->flash('success','Profile picture updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
    public function createPet() {
        return view('front.account.pet.create');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'age' => 'required|integer|min:0',
            'price' => 'required|max:255',
            'gender' => 'required|max:255',
            'other_details' => 'required',
            'location' => 'required|max:50',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Updated to validate 'photo'
    ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->route('account.createPet')->withInput()->withErrors($validator);
        }

        // here we will insert product in db
        $pets = new Pets();
        $pets->name = $request->name;
        $pets->type = $request->type;
        $pets->breed = $request->breed;
        $pets->age = $request->age;
        $pet->price = $request->price;
        $pet->gender = $request->gender;
        $pet->other_details = $request->other_details;
        $pets->location = $request->location;
        
        $pets->description = $request->description;
        $pets->contact_info = $request->contact_info;
        $pets->save();

        if ($request->photo != "") {
            // here we will store image
            $photo = $request->photo;
            $ext = $photo->getClientOriginalExtension();
            $photoName = time().'.'.$ext; // Unique image name

            // Save image to pets directory
            $photo->move(public_path('uploads/photos'),$photoName);

            // Save image name in database
            $pets->photo_path = $photoName;
            $pets->save();
        }

        return redirect()->route('account.savePet')->with('success','Pet added successfully');
    }
    
    public function savePet(){
        $pets = Pets::orderBy('created_at','DESC')->paginate(5);
        return view('front.account.pet.my-pets',[
            'pets' => $pets
        ]);
    }

    // This method will show edit pet page
    public function edit($id)
    {
        $pet = Pets::findOrFail($id);
        return view('front.account.pet.edit',[
            'pet' => $pet
        ]);
    }
    
    // This method will show update pet page
    public function update($id, Request $request) {
        $pet = Pets::findOrFail($id);

        $rules = [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'age' => 'required|integer|min:0',
            'price' => 'required|max:255',
            'gender' => 'required|max:255',
            'other_details' => 'required',
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
        $pet->price = $request->price;
        $pet->gender = $request->gender;
        $pet->other_details = $request->other_details;
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

        return redirect()->route('account.savePet')->with('success','Pet updated successfully');
    }
    
    // This method will delete a product
    public function destroy($id) 
    {
        $pet = Pets::findOrFail($id);

           // delete image
        File::delete(public_path('uploads/photos/'.$pet->photo_path));

           // delete product from database
        $pet->delete();

        return redirect()->route('account.savePet')->with('success','Pet deleted successfully.');
    }

    public function savedPets()
    {
        // Get the saved pets for the logged-in user
        $savedPets = SavedPet::where('user_id', Auth::id())
                            ->with('pet') // Assuming you have a relationship in the SavedPet model
                            ->get();

        return view('front.account.pet.saved-pets', compact('savedPets'));
    }

    public function removeSavedPet($id)
    {
        $savedPet = SavedPet::where('user_id', Auth::id())->where('pet_id', $id)->first();

        if ($savedPet) {
            $savedPet->delete();
            session()->flash('success', 'Pet removed from saved list.');
        } else {
            session()->flash('error', 'Pet not found in your saved list.');
        }

        return redirect()->route('account.savedPets');
    }

    public function sendFeedback(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Prepare data for the email
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'messageContent' => $request->message,
        ];

        // Send email to admin
        Mail::send('front.feedback', $data, function ($message) use ($data) {
            $message->to('muneebyaqub7@gmail.com') // Replace with the admin email address
                    ->subject('New Feedback from ' . $data['name']);
            $message->from($data['email']);
        });

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function createBlog() {
        return view('front.account.pet.blogs');
    }

    public function saveBlog(Request $request)
    {
        // Validate inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/blogs', $imageName, 'public');
        }

        // Save blog
        $blog = new Blog();
        $blog->user_id = Auth::id(); // admin user ID
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $imagePath;
        $blog->save();

        return redirect()->back()->with('success', 'Blog post created successfully!');
    }
}




    