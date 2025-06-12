@extends('front.layouts.app')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->

<style>
/* Global Reset */
* {
  box-sizing: border-box;
}

.section-020 {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 400px;
  padding: 60px 15px 40px;
  display: flex;
  align-items: center;
  position: relative;
}

section.section-020 {
    height: 89%;
}
h1.slide__text-heading {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.lead {
  font-size: 1.125rem;
  font-weight: 400;
  margin-bottom: 1rem;
}

.card:hover {
  transform: translateY(-5px);
  transition: all 0.3s ease-in-out;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

h2.display-5,
section h2 {
  font-size: 2.2rem;
  margin-bottom: 2rem;
}

p {
  font-size: 1rem;
  letter-spacing: 0.03em;
}

@media screen and (max-width: 768px) {
  h1.display-4 {
    font-size: 2rem;
  }
  h2.display-5,
  section h2 {
    font-size: 1.75rem;
  }
}

/* Position carousel controls outside the carousel container */
#servicesCarousel {
  position: relative;
  padding: 0 40px; /* add some padding to left and right for buttons */
}

#servicesCarousel .carousel-control-prev,
#servicesCarousel .carousel-control-next {
  width: 40px; /* smaller width for buttons */
  top: 50%;
  transform: translateY(-50%);
  opacity: 1;
}

#servicesCarousel .carousel-control-prev {
  left: 0;  /* move to extreme left outside cards */
}

#servicesCarousel .carousel-control-next {
  right: 0; /* move to extreme right outside cards */
}

/* Optional: make icons bigger or change color */
#servicesCarousel .carousel-control-prev-icon,
#servicesCarousel .carousel-control-next-icon {
  background-size: 50px 50px;
  filter: invert(20%) sepia(100%) saturate(500%) hue-rotate(150deg); /* example color tweak */
}

.read-more-btn {
  color: #007bff; 
  font-weight: 500;
}

.read-more-btn:hover {
  text-decoration: underline;
  color: #0056b3;
}

</style>

@section('main')
<section class="section-020" style="background-image: url('{{ asset('uploads/services/' . $service->image) }}');">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-white">
        <h1 class="display-4 fw-bold mt-5">{{ $service->title }}</h1>
        <p class="lead">Experience top-notch grooming with our {{ $service->name }} service starting at ₹{{ $service->price }}!</p>
      </div>
    </div>
  </div>
</section>

<!-- Service Detail Section -->
<section class="py-5 bg-light">
  <div class="container">

    {{-- Centered Service Name --}}
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2 class="fw-bold" style="color:#1f2e4d;">{{ $service->name }}</h2>
      </div>
    </div>

     @php
      $plainDescription = trim(strip_tags($service->description));
      $words = preg_split('/\s+/', $plainDescription);
      $firstWords = implode(' ', array_slice($words, 0, 100)); // First 100 words
      $remainingWords = implode(' ', array_slice($words, 100)); // From 101 to end
    @endphp


    <div class="row align-items-start">
      {{-- Left: Image --}}
      <div class="col-md-6">
        <img 
          src="{{ asset('uploads/services/' . $service->image) }}" 
          alt="{{ $service->name }}" 
          class="img-fluid rounded shadow"
          style="max-height: 400px; object-fit: cover; width: 100%;"
        >
      </div>

      <div class="col-md-6">
        <h4 class="text-success mb-2">Price: ₹{{ $service->price }}</h4>
        <h5 class="mb-3">{{ $service->title }}</h5>

        <p>{{ $firstWords }}</p>
      </div>
    </div>

    @if(!empty($remainingWords))
      <div class="row mt-4">
        <div class="col-12">
          <p>{{ $remainingWords }}</p>

          <a href="#bookingFormSection" class="btn btn-primary mt-3">
            Book This Service
          </a>
        </div>
      </div>
    @else
      <div class="row mt-4">
        <div class="col-12 text-center">
          <a href="#bookingFormSection" class="btn btn-primary mt-3">
            Book This Service
          </a>
        </div>
      </div>
    @endif

  </div>
</section>


<section class="py-5" style="background-color: #f9fff9;">
  <div class="container position-relative">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Our Grooming Services</h2>

    <div id="servicesCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        @foreach ($servicesList->chunk(4)->map(fn($chunk) => $chunk->pad(4, null)) as $chunkIndex => $serviceChunk)
          <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
            <div class="row g-4">
              @foreach ($serviceChunk as $service)
                <div class="col-md-3">
                  @if ($service)
                    <div class="card h-100 shadow-sm text-center border-0">
                      <a href="{{ route('grooming.service.details', $service->slug) }}" style="text-decoration:none; color: inherit;">
                        <div class="card-body">
                          <img src="{{ asset('uploads/services/' . $service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded mb-3">
                          <h5 class="card-title">{{ $service->name }}</h5>
                          <p class="card-text">
                            {{ \Illuminate\Support\Str::limit($service->description, 100) }}
                            <a href="{{ route('grooming.service.details', $service->slug) }}" class="text-primary text-decoration-none">Read More</a>
                          </p>
                        </div>
                      </a>
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        @endforeach

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>






<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  function handleSubmit(form) {
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    btnText.classList.add('d-none');
    btnLoader.classList.remove('d-none');
    document.getElementById('submitBtn').disabled = true;
  }


  @if(session('success'))
    toastr.success("{{ session('success') }}");
  @endif

</script>

<script>
  // Date picker
  flatpickr("#appointment_date", {
    dateFormat: "Y-m-d",
    minDate: "today"
  });

  flatpickr("#appointment_time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "h:i K",   
    time_24hr: false,      
  });

</script>
@endsection
