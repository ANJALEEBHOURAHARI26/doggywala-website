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

                <form enctype="multipart/form-data" action="{{route('account.saveBlog')}}" method="post">
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Create Blog Listing</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" name="title" id="title" class="@error('title') is-invalid  @enderror form-control" placeholder="Title" required>
                                        @error('title')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                      <div class="col-md-6 mb-4">
                                        <label for="image" class="mb-2">Image</label>
                                        <input type="file" name="image" id="image" class="@error('image') is-invalid  @enderror form-control" accept="image/*">
                                        @error('photo')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                   
                                </div>
                    
                        
                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea name="description" id="description" class="@error('description') is-invalid  @enderror form-control" rows="5" placeholder="Description" required></textarea>
                                    @error('description')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                    
                              
                            </form>
                        </div>
                    
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary ">Save Blog</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection