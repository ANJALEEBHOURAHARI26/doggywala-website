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

      <!-- Puppy Card: Beagle -->
      <div class="col-md-6 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
          <div class="d-flex align-items-center">
            <img src="{{ asset('assets/images/beagle.jpg') }}" class="puppy-img me-3" style="width: 140px;" alt="Beagle Puppy">
            <div>
              <h5 class="fw-bold text-danger">Beagle</h5>
              <p class="mb-2">If you are looking for a friendly and playful puppy that gels well with your family, you can look for the Beagle puppies for sale in Pune.</p>
              <a href="#" class="read-more-btn">
                  Read More <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>
          </div>
        </div>
      </div>

      <!-- Puppy Card: Doberman -->
      <div class="col-md-6 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
          <div class="d-flex align-items-center">
            <img src="{{ asset('assets/images/doberman.jpg') }}" class="puppy-img me-3" style="width: 140px;" alt="Doberman Puppy">
            <div>
              <h5 class="fw-bold text-danger">Doberman</h5>
              <p class="mb-2">We have the most adorable Doberman puppies for sale in Pune. You can take them home if you are willing to pet a dog that is equal parts playful, sweet and protective.</p>
              <a href="#" class="read-more-btn">
                  Read More <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>



@endsection
