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
<section class="section-01 d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('assets/images/available-puppies-banner.png') }}');">
  <div class="container text-center">
    <h1 class="display-4 fw-bold" style="color: #FA7070;">Puppies Available <span style="color:#1f2e4d;">For Sale In</span></h1>
    <h1 class="display-5 fw-bold" style="color:#1f2e4d;">{{ ucfirst($city) }}</h1>
  </div>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-3">
        <div class="pet-card h-100">
          <div class="position-relative">
            <img src="{{ asset('uploads/photos/' . $pets->photo_path) }}" alt="{{ $pets->name }}">
            <h5 class="text-center">{{ $pets->name }}</h5>

            <div class="pet-icons">
              <a href="tel:{{ $pets->phone ?? '1234567890' }}"><i class="bi bi-telephone-fill"></i></a>
              <a href="https://wa.me/{{ $pets->whatsapp ?? '919999999999' }}" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
            </div>
          </div>
          <div class="pet-card-body">
            <div class="details">
              <p><strong>Price</strong> - ₹{{ number_format($pets->price) }}</p>
              <p><strong>Gender</strong> - {{ ucfirst($pets->gender) }}</p>
              <p><strong>Location</strong> - {{ $pets->location }}</p>
              <p><strong>Breed</strong> - {{ $pets->breed }}</p>
              <p><strong>Other Details</strong> - {{ $pets->other_details }}</p>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </div>
</section>
@endsection
