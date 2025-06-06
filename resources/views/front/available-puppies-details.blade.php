@extends('front.layouts.app')

<style>
  .section-01 {
    background-size: cover;
    background-position: center;
    padding: 80px 0;
    color: #fff;
  }

  .pet-wrapper {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    padding: 20px;
    overflow: hidden;
  }

  .pet-img {
    width: 100%;
    height: auto;
    max-height: 420px;
    object-fit: cover;
    border-radius: 10px;
  }

  .pet-details h3 {
    font-weight: 700;
    color: #FA7070;
    font-size: 24px;
    margin-bottom: 15px;
  }

  .pet-details p {
    font-size: 15px;
    margin-bottom: 5px;
    color: #333;
  }

  .description-box {
    margin-top: 20px;
    background: #fefefe;
    padding: 16px 20px;
    font-size: 15px;
    border-left: 4px solid #ff9e9e; 
    border-radius: 6px;
    word-wrap: break-word;
  }

  .btn-outline-primary, .btn-success {
    font-weight: 600;
    font-size: 14px;
    padding: 6px 16px;
    border-radius: 30px;
    margin-top: 8px;
  }

  .btn i {
    margin-right: 6px;
  }

  @media (max-width: 767px) {
    .pet-details {
      margin-top: 20px;
    }
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

{{-- Pets Section --}}
<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    @forelse($pets as $pet)
      <div class="pet-wrapper">
        <div class="row g-5 align-items-stretch flex-wrap">
          <div class="col-md-7 col-12">
            <img src="{{ asset('uploads/photos/' . $pet->photo_path) }}" alt="{{ $pet->name }}" class="pet-img mb-3">

            <!-- Info in Separate Lines -->
            <div class="px-2 text-dark">
              <p><strong>Breed:</strong> {{ $pet->breed }}</p>
              <p><strong>Price:</strong> ₹{{ number_format($pet->price) }}</p>
              <p><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</p>
              <p><strong>Location:</strong> {{ $pet->location }}</p>
            </div>
          </div>



  <!-- Right Details -->
  <div class="col-md-5 col-12 pet-details">
    <h3>{{ $pet->name }}</h3>
    <p><strong>Lifespan:</strong> {{ $pet->lifespan }}</p>
    <p><strong>Weight:</strong> {{ $pet->weight }}</p>
    <p><strong>Height:</strong> {{ $pet->height }}</p>
    <p><strong>Coat:</strong> {{ $pet->coat }}</p>
    <p><strong>Colors:</strong> {{ $pet->color }}</p>
    <p><strong>Temperament:</strong> {{ $pet->temperament }}</p>
    <p><strong>Energy Level:</strong> {{ $pet->energy_level }}</p>
    <p><strong>Grooming:</strong> {{ $pet->grooming }}</p>

    <div class="mt-2">
      <a href="tel:{{ $pet->phone ?? '1234567890' }}" class="btn btn-outline-primary me-2">
        <i class="bi bi-telephone-fill"></i> Call
      </a>
      <a href="https://wa.me/{{ $pet->whatsapp ?? '919999999999' }}" target="_blank" class="btn btn-success">
        <i class="bi bi-whatsapp"></i> WhatsApp
      </a>
    </div>
  </div>
</div>

<!-- Description Below -->
<div class="description-box mt-4">
  {!! nl2br(e($pet->description)) !!}
</div>


        
      </div>
    @empty
      <div class="text-center">
        <p class="text-muted">No puppies found in {{ ucfirst($city) }}.</p>
      </div>
    @endforelse
  </div>
</section>

@endsection
