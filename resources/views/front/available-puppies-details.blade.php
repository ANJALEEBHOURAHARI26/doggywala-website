@extends('front.layouts.app')

<style>
  .pet-card {
    position: relative;
    border: 1px solid #eee;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
  }

  .pet-card img {
    width: 100%;
    height: 230px;
    object-fit: cover;
  }

  .pet-icons {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .pet-icons a {
    width: 35px;
    height: 35px;
    background-color: #FA7070;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
  }

  .pet-icons a.whatsapp {
    background-color: #25D366;
  }

  .pet-card-body {
    padding: 15px;
  }

  .pet-card h5 {
    background-color: #FA7070;
    color: white;
    padding: 5px 10px;
    font-weight: bold;
  }

  .pet-card .details {
    font-size: 15px;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    padding-top: 10px;
  }
</style>

@section('main')

{{-- Banner --}}
<section class="section-01 d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('assets/images/available-puppies-banner.png') }}');">
  <div class="container text-center">
    <h1 class="display-4 fw-bold" style="color: #FA7070;">Puppies Available <span style="color:#1f2e4d;">For Sale In</span></h1>
    <h1 class="display-5 fw-bold" style="color:#1f2e4d;">{{ ucfirst($city) }}</h1>
  </div>
</section>

{{-- Puppies List --}}
<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <div class="row g-4 justify-content-center">
      @forelse($pets as $pet)
        <div class="col-md-6 col-lg-3">
          <div class="pet-card h-100">
            <div class="position-relative">
              <img src="{{ asset('uploads/photos/' . $pet->photo_path) }}" alt="{{ $pet->name }}">
              <h5 class="text-center">{{ $pet->name }}</h5>

              <div class="pet-icons">
                <a href="tel:{{ $pet->phone ?? '1234567890' }}"><i class="bi bi-telephone-fill"></i></a>
                <a href="https://wa.me/{{ $pet->whatsapp ?? '919999999999' }}" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
              </div>
            </div>
            <div class="pet-card-body">
              <div class="details">
                <p><strong>Price</strong> - ₹{{ number_format($pet->price) }}</p>
                <p><strong>Gender</strong> - {{ ucfirst($pet->gender) }}</p>
                <p><strong>Location</strong> - {{ $pet->location }}</p>
                <p><strong>Breed</strong> - {{ $pet->breed }}</p>
                <p><strong>Other Details</strong> - {{ $pet->other_details }}</p>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p class="text-muted">No puppies found in {{ ucfirst($city) }}.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- About Section --}}
@if($pets->isNotEmpty())
@php $firstPet = $pets->first(); @endphp

<section class="py-5" style="background-color: #fff8f5;">
  <div class="container">
    <div class="row">
      <!-- Left: About Puppy -->
      <div class="col-lg-6 mb-4">
        <h3 class="fw-bold text-danger">About {{ $firstPet->breed }} Puppy - <span class="text-dark">Price In {{ ucfirst($firstPet->location) }}</span></h3>
        <p class="text-muted small">
          Someone rightly said, “When the world around me is going crazy and I losing faith in humanity, I just have to take one look at my dog and know that good still exists.”
        </p>
        <p class="text-muted">
          This is the importance dogs have in our lives. Apart from being a man’s best friend, the amount of care and security one receives from them is unparallel. If you are willing to take one of these furry partners home with you, Doggywala is happy to help!
        </p>
        <p class="text-muted small">
          If you are in search of the cute {{ $firstPet->breed }} puppies for sale in {{ $firstPet->location }}, you have visited at perfect place!
        </p>
        <img src="{{ asset('uploads/photos/' . $firstPet->photo_path) }}" class="img-fluid rounded mt-3" alt="{{ $firstPet->name }}">
      </div>

      <!-- Right: Other Puppy Suggestions -->
      <div class="col-lg-6">
        <img src="{{ asset('uploads/photos/' . $firstPet->photo_path) }}" class="img-fluid rounded mb-3" alt="Other Puppies">
        {{-- You can add other suggestions here --}}
      </div>
    </div>
  </div>
</section>
@endif

@endsection
