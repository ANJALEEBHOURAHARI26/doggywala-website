@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')

                <form enctype="multipart/form-data" action="{{ route('account.update',$pet->id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Pet</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="mb-2">Name<span class="req">*</span></label>
                                        <input value="{{ old('name',$pet->name) }}" type="text" name="name" id="name" class="@error('name') is-invalid  @enderror form-control" placeholder="Pet Name" required>
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="type" class="mb-2">Type<span class="req">*</span></label>
                                        <input value="{{ old('type',$pet->type) }}" type="text" name="type" id="type" class="@error('type') is-invalid  @enderror form-control" placeholder="Pet Type" required>
                                        @error('type')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="breed" class="mb-2">Breed</label>
                                        <input value="{{ old('breed',$pet->breed) }}" type="text" name="breed" id="breed" class="form-control" placeholder="Breed">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="age" class="mb-2">Age<span class="req">*</span></label>
                                        <input value="{{ old('age',$pet->age) }}" type="number" name="age" id="age" class="@error('age') is-invalid  @enderror form-control" min="0" placeholder="Age" required>
                                        @error('age')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-6 mb-4">
                                        <label for="gender" class="mb-2">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">-- Select Gender --</option>
                                            <option value="Male" {{ $pet->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $pet->gender == 'Female' ? 'selected' : '' }}>Female</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="Price" class="mb-2">Price<span class="req">*</span></label>
                                        <input type="number" name="price" id="price" value="{{ old('price',$pet->price) }}" class="@error('price') is-invalid  @enderror form-control" min="0" placeholder="Price" required>
                                        @error('price')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <input value="{{ old('location',$pet->location) }}" type="text" name="location" id="location" class="@error('location') is-invalid  @enderror form-control" placeholder="Location" required>
                                        @error('location')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="photo" class="mb-2">Photo</label>
                                        <input  type="file" name="photo" id="photo" class="@error('photo') is-invalid  @enderror form-control" accept="image/*">
                                        @if ($pet->photo_path)
                                                        <img class="50 my-3" src="{{ asset('uploads/photos/' . $pet->photo_path) }}" alt="{{ $pet->name }}">
                                                    @else
                                                        <img class="50 my-2" src="{{ asset('uploads/photos/default.jpg') }}" alt="Default Image"> <!-- Default image if none -->
                                                    @endif
                                    </div>
                                </div>

                                 <div class="mb-4">
                                    <label for="description" class="mb-2">Other Details<span class="req">*</span></label>
                                    <textarea name="other_details" id="other_details" class="@error('other_details') is-invalid  @enderror form-control" rows="5" placeholder="Other Details" required>{{ old('other_details',$pet->other_details) }}</textarea>
                                    @error('other_details')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                    
                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea name="description" id="description" class="@error('description') is-invalid  @enderror form-control" rows="5" placeholder="Description" required>{{ old('description',$pet->description) }} </textarea>
                                    @error('description')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                    
                                <div class="mb-4">
                                    <label for="contact_info" class="mb-2">Contact Info<span class="req">*</span></label>
                                    <input value="{{ old('contact_info',$pet->contact_info) }}" type="text" name="contact_info" id="contact_info" class="@error('contact_info') is-invalid  @enderror form-control" placeholder="Contact Info" required>
                                    @error('contact_info')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection