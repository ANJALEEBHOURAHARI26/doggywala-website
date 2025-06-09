@extends('front.layouts.app')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->

<style>
/* Global Reset */
* {
  box-sizing: border-box;
}

.section-02 {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 400px;
  padding: 60px 15px 40px;
  display: flex;
  align-items: center;
  position: relative;
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
    color: #007bff; /* Bootstrap primary */
    font-weight: 500;
  }

  .read-more-btn:hover {
    text-decoration: underline;
    color: #0056b3;
  }

</style>

@section('main')
<section class="section-02" style="background-image: url('{{ asset('assets/images/pet-sitters-dog-boarding-dog-walkers-nearby.jpg') }}');">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-white">
        <h1 class="display-4 fw-bold mt-5">Welcome to Premium Pet Grooming</h1>
        <p class="lead">Get the best grooming services for your adorable pets. Book an appointment today!</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5" style="color:#1f2e4d;">Our Grooming Services</h2>

    @foreach($services as $index => $service)
    <div class="row align-items-center mb-5 {{ $index % 2 == 1 ? 'flex-md-row-reverse' : '' }}">
      
      {{-- Image --}}
      <div class="col-md-6 mb-4 mb-md-0">
        <img 
          src="{{ asset('uploads/services/' . $service->image) }}" 
          alt="{{ $service->name }}" 
          class="img-fluid rounded shadow w-100"
          style="max-height: 350px; object-fit: cover;"
        >
      </div>

      {{-- Content --}}
      <div class="col-md-6">
        <h3 class="fw-bold mb-3" style="color:#1f2e4d;">{{ $service->name }}</h3>

        {{-- Description limited to 10 lines visually --}}
        <div style="
          max-height: 11.5em; 
          overflow: hidden; 
          text-overflow: ellipsis; 
          display: -webkit-box; 
          -webkit-line-clamp: 10; 
          -webkit-box-orient: vertical;
        ">
          {!! nl2br(e($service->description)) !!}
        </div>

        {{-- View Details Button --}}
       <a href="{{ route('grooming.service.details', $service->slug) }}" class="btn btn-outline-primary mt-3">
          View Details
      </a>

      </div>

    </div>
    @endforeach

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
                            <a href="{{ route('grooming.service.details', $service->slug) }}" class="read-more-btn">Read More</a>
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





<section class="py-5" style="background-color: #f3f6fa;">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color: #1f2e4d;">Book a Grooming Appointment</h2>
    <div class="row justify-content-center">
      <div class="col-md-8">

        @if(session('success'))
          <div class="alert alert-success mt-3">
              {{ session('success') }}
          </div>
        @endif

        <form id="bookingForm" action="{{ route('booking.submit') }}" method="POST" onsubmit="handleSubmit(this)">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]{10}" maxlength="10" minlength="10" title="Please enter a 10-digit phone number">
          </div>

          <div class="mb-3">
            <label for="service" class="form-label">Select Service <span class="text-danger">*</span></label>
            <select class="form-select" id="service" name="service" required>
              <option value="" disabled selected>-- Select Service--</option>
              @foreach($servicesList as $servicesLists)
              <option value="{{$servicesLists->id}}">{{$servicesLists->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="appointment_date" class="form-label">Select Date <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="appointment_date" name="appointment_date" required>
          </div>

          <div class="mb-3">
            <label for="appointment_time" class="form-label">Select Time <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="appointment_time" name="appointment_time" required>
          </div>


          <div class="mb-3">
            <label for="message" class="form-label">Message (Optional)</label>
            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
          </div>

          <button type="submit" class="btn btn-success w-100" id="submitBtn">
            <span id="btnText">Book Now</span>
            <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
          </button>
        </form>

      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
  @elseif(session('error'))
    toastr.error("{{ session('error') }}");
  @endif

</script>
@endsection
