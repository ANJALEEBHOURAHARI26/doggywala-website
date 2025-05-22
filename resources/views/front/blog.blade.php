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
.section-0 {
    min-height: 803px;
    background-size: cover;
    background-position: center;
    position: relative;
}

</style>
@section('main')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/banner7.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1><span class="hfe-breadcrumbs-text" style="color:#A8DF8E;">Home</span> <span style="color:white;">/ Blog</span></h1>
                <!-- <p>Thousands of pets looking for loving homes.</p>
                <div class="banner-btn mt-5">
                    <a href="" class="btn btn-primary mb-4 mb-sm-0">Adopt Now</a>
                </div> -->
                <!-- <ul class="hfe-breadcrumbs hfe-breadcrumbs-show-home">
                    <li class="hfe-breadcrumbs-item hfe-breadcrumbs-first">
                        <span class="hfe-breadcrumbs-home-icon"></span>
                        <a href="https://www.doggyji.com">
                            <span class="hfe-breadcrumbs-text">Home</span>
                        </a>
                    </li>
                    <li class="hfe-breadcrumbs-separator">
                        <span class="hfe-breadcrumbs-separator-text">/</span>
                    </li>
                    <li class="hfe-breadcrumbs-item hfe-breadcrumbs-last">
                        <span class="hfe-breadcrumbs-text" aria-current="page">Blog</span>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Latest Dog Blogs</h2>

    <div class="row g-4">

      <!-- Blog Card 1 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <img src="{{ asset('assets/images/1725094690_dog-nutrition-doggywala.jpg') }}" class="card-img-top rounded-top-4" alt="Dog Blog 1">
          <div class="card-body">
            <h5 class="fw-bold">The Ultimate Guide To Puppy Nutrition For All Breeds</h5>
            <p class="text-muted small">Feeding your pet right is the most important aspect of nurturing it. The kind of food your pooch eats determines its fitness and health...</p>
            <span class="badge bg-danger mb-2">Dog Food</span>
            <div class="d-flex align-items-center gap-2 text-muted small">
              <i class="bi bi-person-circle text-primary"></i> Shivling Giri
              <span class="ms-auto"><i class="bi bi-calendar-date text-primary"></i> 31 August 2024</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Blog Card 2 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <img src="{{ asset('assets/images/1722601151_family-friendly-dogs.jpg') }}" class="card-img-top rounded-top-4" alt="Dog Blog 2">
          <div class="card-body">
            <h5 class="fw-bold">Puppies Training Tips For New Pet Parents</h5>
            <p class="text-muted small">Puppy training is an important aspect of caring for your furry friend. Don’t take training for granted and give it your all...</p>
            <span class="badge bg-danger mb-2">Dog Blogs</span>
            <div class="d-flex align-items-center gap-2 text-muted small">
              <i class="bi bi-person-circle text-primary"></i> Shivling Giri
              <span class="ms-auto"><i class="bi bi-calendar-date text-primary"></i> 21 August 2024</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Blog Card 3 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <img src="{{ asset('assets/images/1723627653_choose-puppy1.jpg') }}" class="card-img-top rounded-top-4" alt="Dog Blog 3">
          <div class="card-body">
            <h5 class="fw-bold">How To Choose The Right Breed Puppy For Your Lifestyle?</h5>
            <p class="text-muted small">Choosing a puppy is an important decision in a dog lover’s life. Every dog breed has different personalities, needs, and lifestyles...</p>
            <span class="badge bg-danger mb-2">Dog Blogs</span>
            <div class="d-flex align-items-center gap-2 text-muted small">
              <i class="bi bi-person-circle text-primary"></i> Shivling Giri
              <span class="ms-auto"><i class="bi bi-calendar-date text-primary"></i> 14 August 2024</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


@endsection
