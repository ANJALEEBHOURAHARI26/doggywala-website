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

</style>
@section('main')
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
            <form action="{{ route('pets') }}" method="GET">
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


<!-- <section class="section-2 bg-2 py-5">
    <div class="container">
        <h2>Popular Pet Type</h2>
        <div class="row pt-5">
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_category">
                    <a href="pets.html?type=dog"><h4 class="pb-2">Dogs</h4></a>
                    <p class="mb-0"> <span>150</span> Available for adoption</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_category">
                    <a href="pets.html?type=cat"><h4 class="pb-2">Cats</h4></a>
                    <p class="mb-0"> <span>100</span> Available for adoption</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_category">
                    <a href="pets.html?type=rabbit"><h4 class="pb-2">Rabbits</h4></a>
                    <p class="mb-0"> <span>30</span> Available for adoption</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_category">
                    <a href="pets.html?type=hamster"><h4 class="pb-2">Hamsters</h4></a>
                    <p class="mb-0"> <span>20</span> Available for adoption</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_category">
                    <a href="pets.html?type=bird"><h4 class="pb-2">Birds</h4></a>
                    <p class="mb-0"> <span>15</span> Available for adoption</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_category">
                    <a href="pets.html?type=reptile"><h4 class="pb-2">Reptiles</h4></a>
                    <p class="mb-0"> <span>10</span> Available for adoption</p>
                </div>
            </div>
        </div>
    </div>
</section> -->
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



<section class="section-3 py-5">
    <div class="container">
        <h2>Featured Pets</h2>
        <div class="row pt-5">
            <div class="pet_listing_area">                    
                <div class="pet_lists">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Golden Retriever</h3>
                                    <p>Friendly and energetic. Looking for a loving home.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: New York</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-heart"></i></span>
                                            <span class="ps-1">Age: 2 years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Breed: Golden Retriever</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Bulldog</h3>
                                    <p>Calm and loving. Perfect companion for families.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: Texas</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-heart"></i></span>
                                            <span class="ps-1">Age: 3 years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Breed: Bulldog</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Beagle</h3>
                                    <p>Curious and friendly. Great for active families.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: Florida</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-heart"></i></span>
                                            <span class="ps-1">Age: 4 years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Breed: Beagle</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Rottweiler</h3>
                                    <p>Strong and loyal. Great guard dog and companion.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: Ohio</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-heart"></i></span>
                                            <span class="ps-1">Age: 6 years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Breed: Rottweiler</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-3 bg-2 py-5">
    <div class="container">
        <h2>Latest Pets</h2>
        <div class="row pt-5">
            <div class="pet_listing_area">                    
                <div class="pet_lists">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Bella</h3>
                                    <p>A friendly Golden Retriever looking for a loving home.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Type: Dog</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-birthday-cake"></i></span>
                                            <span class="ps-1">Age: 2 years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: Noida</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Max</h3>
                                    <p>Energetic Beagle in need of an active family.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Type: Dog</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-birthday-cake"></i></span>
                                            <span class="ps-1">Age: 1 year</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: Noida</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Charlie</h3>
                                    <p>Playful Labrador looking for a fun-loving home.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Type: Dog</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-birthday-cake"></i></span>
                                            <span class="ps-1">Age: 4 years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: Noida</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">Rocky</h3>
                                    <p>Charming Bulldog ready for a new adventure.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-paw"></i></span>
                                            <span class="ps-1">Type: Dog</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-birthday-cake"></i></span>
                                            <span class="ps-1">Age: 5 years</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">Location: Noida</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- resources/views/contact.blade.php -->

<!-- <section class="contact-section py-5" style="background-color: #f3f4f6;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-weight: 600;">Contact Us</h2>
        
        <div class="row text-center mb-5">
            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow rounded">
                    <i class="fas fa-map-marker-alt fa-2x mb-3 text-primary"></i>
                    <h5 class="fw-bold">Address</h5>
                    <p class="text-muted mb-0">123 Dog Street, Paw City, IN 45678</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow rounded">
                    <i class="fas fa-phone fa-2x mb-3 text-primary"></i>
                    <h5 class="fw-bold">Phone</h5>
                    <p class="text-muted mb-0">+91 9876543210</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow rounded">
                    <i class="fas fa-envelope fa-2x mb-3 text-primary"></i>
                    <h5 class="fw-bold">Email</h5>
                    <p class="text-muted mb-0">info@dogservice.com</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-4 bg-white shadow rounded">
                    <form method="POST" action="">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea name="message" rows="4" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="contact-info-section py-5" style="background-color: var(--bs-body-bg);">
    <div class="container">
        <h2 class="text-center mb-4" style="font-weight: 600;">Get in Touch</h2>
        <p class="text-center text-muted mb-5">We love to hear from fellow dog lovers! Reach out through any of the ways below.</p>
        
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow-sm rounded">
                    <i class="fab fa-whatsapp fa-2x mb-3 text-success"></i>
                    <h5 class="fw-bold">WhatsApp</h5>
                    <p class="text-muted mb-0">+91 9876543210</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow-sm rounded">
                    <i class="fab fa-instagram fa-2x mb-3 text-danger"></i>
                    <h5 class="fw-bold">Instagram</h5>
                    <p class="text-muted mb-0">@doggyworld</p>
                </div>
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


@endsection
