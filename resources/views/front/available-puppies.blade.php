@extends('front.layouts.app')
<style>
  
</style>
@section('main')
<section class="section-01 d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('assets/images/available-puppies-banner.png') }}');">
    <div class="container text-center">
        <h1 class="display-4 fw-bold" style="color: #FA7070;">Puppies Available <span style="color:#1f2e4d;">For Sale In</span></h1>
        <h1 class="display-5 fw-bold" style="color:#1f2e4d;">{{ ucfirst($city) }}</h1>
    </div>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <div class="row g-4 justify-content-center">

      @forelse($petsDetails as $pet)
        <div class="col-md-6 col-lg-6">
          <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
            <div class="d-flex align-items-center">
              <img src="{{ asset('uploads/photos/' . $pet->photo_path) }}" class="puppy-img me-3" style="width: 140px;" alt="{{ $pet->name }} Puppy">
              <div>
                <h5 class="fw-bold text-danger">{{ $pet->breed }}</h5>
                <p class="mb-2">{{ $pet->description }}</p>
                <a href="{{ route('available-puppies-details', ['breed' => $pet->breed, 'city' => $pet->location]) }}" class="read-more-btn">
                    Read More <i class="bi bi-arrow-right ms-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
            <p>No puppies available in {{ ucfirst($city) }} at the moment.</p>
        </div>
      @endforelse

    </div>
  </div>
</section>




@endsection
