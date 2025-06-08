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

                <form enctype="multipart/form-data" action="{{ route('account.storePet') }}" method="post">
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Create Pet Listing</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" name="name" id="name" class="@error('name') is-invalid  @enderror form-control" placeholder="Pet Name" required>
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="type" class="mb-2">Type<span class="req">*</span></label>
                                        <input type="text" name="type" id="type" class="@error('type') is-invalid  @enderror form-control" placeholder="Pet Type" required>
                                        @error('type')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="breed" class="mb-2">Breed<span class="req">*</span></label>
                                        <input type="text" name="breed" id="breed" class="@error('breed') is-invalid  @enderror form-control" placeholder="Breed" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="age" class="mb-2">Age<span class="req">*</span></label>
                                        <input type="number" name="age" id="age" class="@error('age') is-invalid  @enderror form-control" min="0" placeholder="Age" required>
                                        @error('age')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 mb-4">
                                    <label for="lifespan" class="mb-2">Lifespan</label>
                                    <input type="text" name="lifespan" id="lifespan" class="form-control" placeholder="e.g. 10-13 years">
                                  </div>
                                  <div class="col-md-6 mb-4">
                                    <label for="weight" class="mb-2">Weight</label>
                                    <input type="text" name="weight" id="weight" class="form-control" placeholder="e.g. M: 32-45 kg, F: 30-40 kg">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 mb-4">
                                    <label for="height" class="mb-2">Height</label>
                                    <input type="text" name="height" id="height" class="form-control" placeholder="e.g. M: 69cm, F: 65cm">
                                  </div>
                                  <div class="col-md-6 mb-4">
                                    <label for="coat" class="mb-2">Coat Type</label>
                                    <input type="text" name="coat" id="coat" class="form-control" placeholder="e.g. Short, shiny, sleek">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 mb-4">
                                    <label for="color" class="mb-2">Color</label>
                                    <input type="text" name="color" id="color" class="form-control" placeholder="e.g. Black, brown, blue, fawn">
                                  </div>
                                  <div class="col-md-6 mb-4">
                                    <label for="temperament" class="mb-2">Temperament</label>
                                    <input type="text" name="temperament" id="temperament" class="form-control" placeholder="e.g. Loyal, alert, intelligent">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 mb-4">
                                    <label for="energy_level" class="mb-2">Energy Level</label>
                                    <input type="text" name="energy_level" id="energy_level" class="form-control" placeholder="e.g. High">
                                  </div>
                                  <div class="col-md-6 mb-4">
                                    <label for="grooming" class="mb-2">Grooming</label>
                                    <input type="text" name="grooming" id="grooming" class="form-control" placeholder="e.g. Low maintenance">
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-6 mb-4">
                                        <label for="gender" class="mb-2">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="" disabled selected>-- Select Gender --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="price" class="mb-2">Price<span class="req">*</span></label>
                                        <input type="number" name="price" id="price" class="@error('price') is-invalid  @enderror form-control" min="0" placeholder="Price" required>
                                        @error('price')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" name="location" id="location" class="@error('location') is-invalid  @enderror form-control" placeholder="Location" required>
                                        @error('location')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="photo" class="mb-2">Photo</label>
                                        <input type="file" name="photo" id="photo" class="@error('photo') is-invalid  @enderror form-control" accept="image/*">
                                        @error('photo')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="description" class="mb-2">Other Details<span class="req">*</span></label>
                                    <textarea name="other_details" id="other_details" class="@error('other_details') is-invalid  @enderror form-control" rows="5" placeholder="Other Details" required></textarea>
                                    @error('other_details')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea name="description" id="description" class="@error('description') is-invalid  @enderror form-control" rows="5" placeholder="Description" required></textarea>
                                    @error('description')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                    
                                <div class="mb-4">
                                    <label for="contact_info" class="mb-2">Contact Info<span class="req">*</span></label>
                                    <input type="text" name="contact_info" id="contact_info" class="@error('contact_info') is-invalid  @enderror form-control" placeholder="Contact Info" required>
                                    @error('contact_info')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary ">Save Pet</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection