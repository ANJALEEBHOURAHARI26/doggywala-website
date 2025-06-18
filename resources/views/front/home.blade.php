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
h3.border-0.fs-5.pb-2.mb-0 {
    margin-top: 13px;
}

.icon-overlay {
  position: absolute;
  top: 10px;
  right: 10px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  z-index: 5;
}

.icon-btn {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background-color: #FA7070;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  font-size: 14px;
  transition: 0.3s;
}

.icon-btn.whatsapp {
  background-color: #25D366;
}

.icon-btn:hover {
  transform: scale(1.1);
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

/**/
 #multiReviewCarousel {
    position: relative;
    padding: 0 60px; /* space on both sides for arrows */
  }

  #multiReviewCarousel .carousel-control-prev {
    width: 50px;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
  }

  #multiReviewCarousel .carousel-control-next {
    width: 50px;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
  }

  #multiReviewCarousel .carousel-control-prev-icon,
  #multiReviewCarousel .carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    background-size: 40px 40px;
  }

</style>
@section('main')
@if(session('error'))
  <div class="alert alert-warning mt-3">
    {{ session('error') }}
  </div>
@endif

<!-- <section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/banner7.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Find Your Perfect Pet</h1>
                <p>Thousands of pets looking for loving homes.</p>
                <div class="banner-btn mt-5">
                    <a href="" class="btn btn-primary mb-4 mb-sm-0">Adopt Now</a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="doggy-slider">
  <div id="doggyCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="banner-slide d-flex align-items-center justify-content-center text-center" style="background-image: url('{{ asset('assets/images/pexels-chevanon-1108099.jpg') }}');">
          <div class="container">
            <h1 class="text-white">Find Your Perfect Pet</h1>
            <p class="text-white">Thousands of pets looking for loving homes.</p>
            <!-- <a href="#" class="btn btn-primary mt-3">Adopt Now</a> -->
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="banner-slide d-flex align-items-center justify-content-center text-center" style="background-image: url('{{ asset('assets/images/pexels-hnoody93-58997.jpg') }}');">
          <div class="container">
            <h1 class="text-white">Cute Puppies for Sale</h1>
            <p class="text-white">Browse our newest litters today!</p>
            <!-- <a href="#" class="btn btn-primary mt-3">View Puppies</a> -->
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="banner-slide d-flex align-items-center justify-content-center text-center" style="background-image: url('{{ asset('assets/images/pexels-helenalopes-2253275.jpg') }}')">
          <div class="container">
            <h1 class="text-white">Professional Grooming Services</h1>
            <p class="text-white">Book a spa day for your pet!</p>
            <!-- <a href="#" class="btn btn-primary mt-3">Book Now</a> -->
          </div>
        </div>
      </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#doggyCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#doggyCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</section>


<section class="section-1 py-5"> 
    <div class="container">
        <div class="card border-0 shadow p-5">
            <form action="{{ route('available-puppies.search') }}" method="GET">
                @csrf
                <div class="row">
                    <!-- Search by pet name -->
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Pet Name">
                    </div>
                    
                    <!-- Search by type -->
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" name="type" id="type" placeholder="Type (e.g., Dog)">
                    </div>

                    <!-- Search by location -->
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                    </div>
                    
                    <!-- Search button -->
                    <div class="col-md-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



<section class="py-5 bg-light text-center">
  <div class="container">
    <h2 class="mb-5 fw-bold">Why we’re the leading puppy adoption service</h2>
    <div class="d-flex justify-content-between flex-wrap gap-4">
      <div class="flex-fill text-center" style="max-width: 180px;">
        <img src="https://www.puppyspot.com/preact/./img/your-perfect-puppy.svg" alt="Your Perfect Puppy" class="mb-3" style="width:100px; height: 100px;">
        <h4 class="fw-semibold">Your Perfect Puppy</h4>
        <p class="small text-muted">Breeds in every size, color, and temperament</p>
      </div>

      <div class="flex-fill text-center" style="max-width: 180px;">
        <img src="https://www.puppyspot.com/preact/./img/certified-breeders.svg" alt="Certified Breeders" class="mb-3" style="width:100px; height: 100px;">
        <h4 class="fw-semibold">Certified Breeders</h4>
        <p class="small text-muted">Licensed, vetted and committed to our puppies</p>
      </div>

      <div class="flex-fill text-center" style="max-width: 180px;">
        <img src="https://www.puppyspot.com/preact/img/health-commitment.svg" alt="10-Year Health Commitment" class="mb-3" style="width: 100px; height: 100px;">
        <h4 class="fw-semibold">10-Year Health Commitment</h4
        <p class="small text-muted">Certified documents, vaccinations, and checkups</p>
      </div>

      <div class="flex-fill text-center" style="max-width: 180px;">
        <img src="https://www.puppyspot.com/preact/img/handle-care-delivery.svg" alt="Handle with Care Delivery" class="mb-3" style="width: 100px; height: 100px;">
        <h4 class="fw-semibold">Handle with Care Delivery</h4>
        <p class="small text-muted">Three white glove delivery options</p>
      </div>

      <div class="flex-fill text-center" style="max-width: 180px;">
        <img src="https://www.puppyspot.com/preact/img/caring-experts.svg" alt="Caring Experts" class="mb-3" style="width:100px; height: 100px;">
        <h4 class="fw-semibold">Caring Experts</h4>
        <p class="small text-muted">Helping you every step to find your perfect puppy</p>
      </div>
    </div>
  </div>
</section>


<section class="py-5 bg-white" id="dog-grooming">
    <div class="container text-center">
        <h2 class="mb-4">Dog Grooming Services</h2>
        <p class="mb-5 text-muted">Give your furry friend the love they deserve with our premium dog grooming packages!</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="fa fa-shower fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Dog Bath &amp; Blow Dry</h5>
                    <p class="card-text">Warm water bath, gentle shampoo, blow dry, and brushing — your pup will love it!</p>
                    <a href="{{ route('grooming.services') }}" class="btn btn-outline-success mt-3">Book Bath</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="fa fa-cut fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">Haircut &amp; Styling</h5>
                    <p class="card-text">Breed-specific cuts or custom trims. Our groomers make your dog look stylish and neat.</p>
                    <a href="{{ route('grooming.services') }}" class="btn btn-outline-success mt-3">Book Styling</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="fa fa-paw fa-3x text-danger"></i>
                    </div>
                    <h5 class="card-title">Nails, Ears &amp; Hygiene</h5>
                    <p class="card-text">Nail clipping, ear cleaning, and hygiene trim for comfort, health, and safety.</p>
                    <a href="{{ route('grooming.services') }}" class="btn btn-outline-danger mt-3">Book Hygiene</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-light">
  <div class="container">
    <h3 class="text-center mb-4">Share Your Experience</h3>
    <form action="{{ route('review.store') }}" method="POST" id="reviewForm" class="col-md-8 mx-auto">
      @csrf
      <div class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
      </div>
      <div class="mb-3">
        <select name="rating" class="form-select" required>
          <option value="">Select Rating</option>
          <option value="5">★★★★★ - Excellent</option>
          <option value="4">★★★★☆ - Very Good</option>
          <option value="3">★★★☆☆ - Good</option>
          <option value="2">★★☆☆☆ - Fair</option>
          <option value="1">★☆☆☆☆ - Poor</option>
        </select>
      </div>
      <div class="mb-3">
        <textarea name="message" class="form-control" rows="4" placeholder="Write your review" required></textarea>
      </div>
      <div class="text-center">
      <button type="submit" class="btn btn-primary" id="submitBtn">Submit Review</button>
      <div id="loader" style="display:none; margin-top:10px;">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
      </div>
    </div>

    </form>
  </div>
</section>

<section class="section-3 py-5 bg-white">
    <div class="container">
        <h2>Featured Pets</h2>
        <div class="row pt-5">
            <div class="pet_listing_area">                    
                <div class="pet_lists">
                    <div class="row">
                        @php
                            use Illuminate\Support\Str;
                        @endphp
                        @foreach($featuredPets as $pet)
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    @if ($pet->photo_path)
                                        <img 
                                            src="{{ asset('uploads/photos/' . $pet->photo_path) }}" 
                                            alt="{{ $pet->name }}" 
                                            width="50" 
                                            height="50" 
                                            style="object-fit: cover; border-radius: 6px;">
                                    @else
                                        <img 
                                            src="{{ asset('uploads/photos/default.jpg') }}" 
                                            alt="Default Image" 
                                            width="50" 
                                            height="50" 
                                            style="object-fit: cover; border-radius: 6px;">
                                    @endif

                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $pet->name }}</h3>
                                  

                                    <p>{{ Str::limit($pet->description, 50, '...') }}</p>
                                    
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: {{ $pet->location }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-heart"></i></span>
                                            <span class="ps-1">Age: {{ $pet->age }} years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Breed: {{ $pet->breed }}</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{route('pet.details',$pet->location)}}" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- @foreach($featuredPets as $pet)
<div class="col-md-4">
    <div class="card border-0 p-3 shadow mb-4">
        <div class="card-body">
            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $pet->name }}</h3>
            <p>{{ $pet->description }}</p>
            <div class="bg-light p-3 border">
                <p class="mb-0"><strong><i class="fa fa-map-marker"></i></strong> <span class="ps-1">Location: {{ $pet->location }}</span></p>
                <p class="mb-0"><strong><i class="fa fa-heart"></i></strong> <span class="ps-1">Age: {{ $pet->age }} years</span></p>
                <p class="mb-0"><strong><i class="fa fa-paw"></i></strong> <span class="ps-1">Breed: {{ $pet->breed }}</span></p>
            </div>
            <div class="d-grid mt-3">
                <a href="" class="btn btn-primary btn-lg">Details</a>
            </div>
        </div>
    </div>
</div>
@endforeach
 -->


<section class="section-3 bg-2 py-5 bg-light">
    <div class="container">
        <h2>Latest Pets</h2>
        <div class="row pt-5">
            <div class="pet_listing_area">                    
                <div class="pet_lists">
                    <div class="row">
                        @foreach($latestPets as $pet)
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                 <div class="position-relative">
                                        @if ($pet->photo_path)
                                            <img 
                                                src="{{ asset('uploads/photos/' . $pet->photo_path) }}" 
                                                alt="{{ $pet->name }}" 
                                                class="img-fluid rounded" 
                                                style="width: 100%; height: 220px; object-fit: cover;">
                                        @else
                                            <img 
                                                src="{{ asset('uploads/photos/default.jpg') }}" 
                                                alt="Default Image" 
                                                class="img-fluid rounded" 
                                                style="width: 100%; height: 220px; object-fit: cover;">
                                        @endif

                                        {{-- Icon Overlay --}}
                                        <div class="icon-overlay">
                                            <a href="tel:{{ $pet->phone ?? '1234567890' }}" class="icon-btn call"><i class="fa fa-phone"></i></a>
                                            <a href="https://wa.me/{{ $pet->whatsapp ?? '919999999999' }}" target="_blank" class="icon-btn whatsapp"><i class="bi bi-whatsapp"></i></a>
                                        </div>
                                    </div>

                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $pet->name }}</h3>
                                   <p>{{ Str::limit($pet->description, 50, '...') }}</p>
                                    
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Type: {{ $pet->type }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-birthday-cake"></i></span>
                                            <span class="ps-1">Age: {{ $pet->age }} years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: {{ $pet->location }}</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{route('pet.details',$pet->location)}}" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="contact-info-section py-5 bg-white" style="background-color: var(--bs-body-bg);">
    <div class="container">
        <h2 class="text-center mb-4" style="font-weight: 600;">Get in Touch</h2>
        <p class="text-center text-muted mb-5">We love to hear from fellow dog lovers! Reach out through any of the ways below.</p>
        
        <div class="row text-center">
           <div class="col-md-4 mb-4">
              <a href="https://wa.me/919876543210" target="_blank" class="text-decoration-none">
                <div class="p-4 bg-white shadow-sm rounded text-center">
                  <i class="fab fa-whatsapp fa-2x mb-3 text-success"></i>
                  <h5 class="fw-bold text-dark">WhatsApp</h5>
                  <p class="text-muted mb-0">+91 9876543210</p>
                </div>
              </a>
            </div>

            <div class="col-md-4 mb-4">
              <a href="https://www.instagram.com/doggyworld" target="_blank" class="text-decoration-none">
                <div class="p-4 bg-white shadow-sm rounded text-center">
                  <i class="fab fa-instagram fa-2x mb-3 text-danger"></i>
                  <h5 class="fw-bold text-dark">Instagram</h5>
                  <p class="text-muted mb-0">@doggyworld</p>
                </div>
              </a>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow-sm rounded">
                    <i class="fas fa-clock fa-2x mb-3 text-warning"></i>
                    <h5 class="fw-bold">Office Hours</h5>
                    <p class="text-muted mb-0">Mon - Fri: 10am - 6pm</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5" style="color:#1f2e4d;">What Our Customers Say</h2>

    <div id="multiReviewCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach ($reviews->chunk(3) as $chunkIndex => $reviewChunk)
          <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
            <div class="row g-4">
              @foreach ($reviewChunk as $review)
                <div class="col-md-4">
                  <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                      <p class="text-muted">"{{ $review->message }}"</p>
                      <h6 class="fw-bold mb-2">{{ $review->name }}</h6>
                      <div class="mb-3" style="color: #f39c12;">
                        {!! str_repeat('★', $review->rating) !!}
                        {!! str_repeat('☆', 5 - $review->rating) !!}
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>

      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#multiReviewCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#multiReviewCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

<script>
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

<script>
  document.getElementById('reviewForm').addEventListener('submit', function() {
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('loader').style.display = 'inline-block';
  });
</script>

@endsection
