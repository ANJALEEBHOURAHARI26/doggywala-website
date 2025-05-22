@extends('front.layouts.app')
<style>
    .doggy-slider .banner-slide {
    height: 125vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 0 15px;
}

.doggy-slider h1 {
    font-size: 3rem;
    font-weight: 700;
}

.doggy-slider p {
    font-size: 1.25rem;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    width: 3rem;
    height: 3rem;
}
.h-90 {
    height: 90% !important;
}
textarea.form-control {
    height: 269px;
}
</style>
@section('main')
<section class="section-10 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/page-title.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1><span class="hfe-breadcrumbs-text" style="color:#A8DF8E;">Home</span> <span style="color:white;">/ Contact Us</span></h1>
                
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Contact Us</h2>
    <div class="row">
      <!-- Left: Contact Form -->
      <div class="col-md-7">
        <form>
          <div class="row mb-3">
            <div class="col">
              <input type="text" class="form-control" placeholder="Your Name:">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Telephone:">
            </div>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" placeholder="Email:">
          </div>
          <div class="mb-3">
            <textarea class="form-control" rows="5" placeholder="Message:"></textarea>
          </div>
          <button type="submit" class="btn text-white px-4 py-2" style="background-color: #eac94f; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); font-weight: bold;">
            SEND MESSAGE
          </button>
        </form>
      </div>

      <!-- Right: Info Box -->
      <div class="col-md-5 mt-5 mt-md-0">
        <div class="p-4 h-90 d-flex flex-column justify-content-between" style="background-color: #49dcd4; border-radius: 12px; color: white;">
          <div>
            <h4 class="fw-bold mb-3">Information</h4>
            <p>I engage in thoughtful conversations, seeking meaningful conclusions. I am free from common errors and open to understanding.</p>
            <p><i class="fas fa-envelope me-2"></i> email@yoursite.com</p>
            <p><i class="fas fa-phone me-2"></i> (+123) 456-789</p>
            <p><i class="fas fa-map-marker-alt me-2"></i> Pet Street 123 – New York</p>
          </div>
          <div class="text-center mt-3">
            <img src="{{ asset('assets/images/contact-bg-min (1).png') }}" alt="Dog 1" style="height: 132px; margin-right: -222px;width: 229px;margin-top: -9px;"">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection
