<!-- resources/views/account/saved_pets.blade.php -->

@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        
        <!-- Breadcrumbs -->
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9">
                @include('front.message')
                
                <!-- Card Container -->
                <div class="card border-0 shadow mb-4 p-4">
                    <div class="card-body">
                        
                        <!-- Heading -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="fs-4 mb-0">My Saved Pets</h3>
                        </div>

                        <!-- Saved Pets List -->
                        <section class="section-1 py-5">
                            <div class="container">
                                @if($savedPets->isEmpty())
                                    <p>You haven't saved any pets yet.</p>
                                @else
                                    <div class="row">
                                        @foreach($savedPets as $savedPet)
                                            @php
                                                $pet = $savedPet->pet;
                                            @endphp
                                            <div class="col-md-4">
                                                <div class="card mb-4">
                                                    <img src="{{ asset('uploads/photos/' . $pet->photo_path) }}" class="card-img-top" alt="{{ $pet->name }}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $pet->name }}</h5>
                                                        <p class="card-text">
                                                            Type: {{ $pet->type }}<br>
                                                            Location: {{ $pet->location }}<br>
                                                            Age: {{ $pet->age }} years
                                                        </p>
                                                        <a href="#" class="btn btn-primary">View Details</a>
                                                        <a href="{{ route('removeSavedPet', $pet->id) }}" class="btn btn-danger">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
