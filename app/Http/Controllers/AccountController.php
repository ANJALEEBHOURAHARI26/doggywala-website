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
use App\Models\Enquiry;
use App\Models\Booking;
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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['errors' => ['old_password' => ['Old password is incorrect.']]], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
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
        return view('front.account.pet.create-pet');
    }

   public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'age' => 'required|integer|min:0',
            'price' => 'required|max:255',
            'gender' => 'required|max:255',
            'other_details' => 'required',
            'location' => 'required|max:50',
            'description' => 'required',
            'lifespan' => 'nullable|max:255',
            'weight' => 'nullable|max:255',
            'height' => 'nullable|max:255',
            'coat' => 'nullable|max:255',
            'color' => 'nullable|max:255',
            'temperament' => 'nullable|string',
            'energy_level' => 'nullable|max:255',
            'grooming' => 'nullable|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('account.createPet')->withInput()->withErrors($validator);
        }

        $pets = new Pets();
        $pets->name = $request->name;
        $pets->type = $request->type;
        $pets->breed = $request->breed;
        $pets->age = $request->age;
        $pets->price = $request->price;
        $pets->gender = $request->gender;
        $pets->other_details = $request->other_details;
        $pets->location = $request->location;
        $pets->description = $request->description;
        $pets->contact_info = $request->contact_info;

        // New columns
        $pets->lifespan = $request->lifespan;
        $pets->weight = $request->weight;
        $pets->height = $request->height;
        $pets->coat = $request->coat;
        $pets->color = $request->color;
        $pets->temperament = $request->temperament;
        $pets->energy_level = $request->energy_level;
        $pets->grooming = $request->grooming;

        $pets->save();

        if ($request->photo != "") {
            $photo = $request->photo;
            $ext = $photo->getClientOriginalExtension();
            $photoName = time() . '.' . $ext;

            $photo->move(public_path('uploads/photos'), $photoName);

            $pets->photo_path = $photoName;
            $pets->save();
        }

        return redirect()->route('account.savePet')->with('success', 'Pet added successfully');
    }

    
    public function savePet(){
        $pets = Pets::orderBy('created_at','DESC')->paginate(5);
        return view('front.account.pet.my-pets',[
            'pets' => $pets
        ]);
    }

    public function blogList()
    {
        $blogList = Blog::get();
        // dd($blogList);
        return view('front.account.pet.blog-list',[
            'blogList' => $blogList
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
    public function update($id, Request $request)
    {
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
            'lifespan' => 'nullable|max:255',
            'weight' => 'nullable|max:255',
            'height' => 'nullable|max:255',
            'coat' => 'nullable|max:255',
            'color' => 'nullable|max:255',
            'temperament' => 'nullable|string',
            'energy_level' => 'nullable|max:255',
            'grooming' => 'nullable|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('account.createPet', $pet->id)->withInput()->withErrors($validator);
        }

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

        // New columns
        $pet->lifespan = $request->lifespan;
        $pet->weight = $request->weight;
        $pet->height = $request->height;
        $pet->coat = $request->coat;
        $pet->color = $request->color;
        $pet->temperament = $request->temperament;
        $pet->energy_level = $request->energy_level;
        $pet->grooming = $request->grooming;

        $pet->save();

        if ($request->photo != "") {
            File::delete(public_path('uploads/photos/' . $pet->photo_path));

            $photo = $request->photo;
            $ext = $photo->getClientOriginalExtension();
            $photoName = time() . '.' . $ext;

            $photo->move(public_path('uploads/photos'), $photoName);

            $pet->photo_path = $photoName;
            $pet->save();
        }

        return redirect()->route('account.savePet')->with('success', 'Pet updated successfully');
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

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'messageContent' => $request->message,
        ];

        Mail::send('front.feedback', $data, function ($message) use ($data) {
            $message->to('muneebyaqub7@gmail.com') 
                    ->subject('New Feedback from ' . $data['name']);
            $message->from($data['email']);
        });

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function createBlog() {
        return view('front.account.pet.blogs');
    }

    public function saveBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('uploads/blogs');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
        }

        $blog = new Blog();
        $blog->user_id = Auth::id(); 
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $imageName; // only file name stored
        $blog->save();

        return redirect()->route('account.blogList')->with('success','Blog post created successfully!');
    }

    
    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        return view('front.account.pet.edit-blog',[
            'blog' => $blog
        ]);
    }

    
    public function updateBlog($id, Request $request)
    {
        $blog = Blog::findOrFail($id);

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('account.editBlog', $blog->id)
                             ->withInput()
                             ->withErrors($validator);
        }

        $blog->title = $request->title;
        $blog->description = $request->description;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
                File::delete(public_path('uploads/blogs/' . $blog->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('uploads/blogs');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $blog->image = $imageName; // only file name stored
        }

        $blog->save();

        return redirect()->route('account.blogList')->with('success', 'Blog updated successfully');
    }


    public function destroyBlog($id) 
    {
        $blog = Blog::findOrFail($id);

        File::delete(public_path('uploads/blogs/'.$blog->image));
        $blog->delete();

        return redirect()->route('account.blogList')->with('success','Blog deleted successfully.');
    }

    public function enquiryList(Request $request)
    {
       $enquiries = Enquiry::latest()->get();
       $query = Enquiry::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
        }

        $enquiries = $query->latest()->get();

       return view('front.account.enquiry-detail', compact('enquiries'));
    }

    public function bookingList(Request $request)
    {
        $search = $request->input('search');

        $bookings = Booking::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('service', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

        return view('front.account.booking-list', compact('bookings'));
    }


}




    