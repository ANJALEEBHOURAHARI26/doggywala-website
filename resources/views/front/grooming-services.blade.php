@extends('front.layouts.app')
<style>
/* Banner Styling */
.section-02 {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    padding: 0 15px;
    display: flex;
    align-items: center;
    position: relative;
}

/* Headings */
h1.slide__text-heading {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.lead {
    font-size: 1.25rem;
    font-weight: 300;
}

/* Service Cards */
.card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease-in-out;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
.mt-3.lead {
    margin-top: -1rem !important;
}

section.py-5 {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h2.display-5 {
  font-size: 3rem;
  margin: 49px;
}

p {
  font-size: 1.1rem;
  letter-spacing: 0.05em;
}
section h2 {
  margin-bottom: 4rem;
}
section .row {
  margin-top: 2rem;
}

</style>

@section('main')
<section class="section-02 d-flex align-items-center" 
         style="background-image: url('{{ asset('assets/images/pet-sitters-dog-boarding-dog-walkers-nearby.jpg') }}'); 
                background-size: cover; background-position: center; height: 433px;;width: 1359px; margin-top: 78px;">

    <div class="container">
        <div class="row">
            <div class="col-lg-8 text-white">
                <h1 class="display-4 fw-bold mt-5">Welcome to Premium Pet Grooming</h1>
                <p class="lead mt-3">Get the best grooming services for your adorable pets. Book an appointment today!</p>
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color:#1f2e4d;">Book Bath & Blow Dry</h2>
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="{{ asset('assets/images/DogBath&BlowDry.jpg') }}" alt="Bath" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <p class="lead">Give your furry friend a refreshing bath using high-quality, skin-friendly products. Our expert groomers ensure your pet enjoys the process with comfort, followed by a gentle blow dry.</p>
        <ul>
          <li>Deep cleansing bath</li>
          <li>Conditioning treatment</li>
          <li>Gentle towel & blow dry</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color:#1f2e4d;">Book Haircut & Styling</h2>
    <div class="row align-items-center flex-md-row-reverse">
      <div class="col-md-6">
        <img src="{{ asset('assets/images/HairCut&styling.jpg') }}" alt="Styling" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <p class="lead">Personalized grooming and styling that fits your dog's breed and personality. Our professionals offer fashionable cuts with care and precision.</p>
        <ul>
          <li>Custom trims and cuts</li>
          <li>Breed-specific styling</li>
          <li>Fragrance finish</li>
        </ul>
      </div>
    </div>
  </div>
</section>


<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color:#1f2e4d;">Book Hygiene & Care</h2>
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="{{ asset('assets/images/earcleaning.jpg') }}" alt="Hygiene" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <p class="lead">Ensure your pet's overall hygiene with our complete care package. From ear cleaning to nail clipping, we cover it all with safety and love.</p>
        <ul>
          <li>Ear & eye cleaning</li>
          <li>Nail clipping</li>
          <li>Sanitary trimming</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ✨ Our Services Section -->
<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Our Grooming Services</h2>

    <div class="row g-4">

      <!-- Service 1 -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <div class="card-body">
            <img src="{{ asset('assets/images/DogBath&BlowDry.jpg') }}" alt="Dog Bath" class="mb-3" style="width: 234px;">
            <h5 class="card-title">Dog Bath & Blow Dry</h5>
            <p class="card-text">Gentle bath with premium products followed by a soothing blow dry.</p>
          </div>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <div class="card-body">
            <img src="{{ asset('assets/images/HairCut&styling.jpg') }}" alt="Haircut" class="mb-3" style="width: 234px;">
            <h5 class="card-title">Haircut & Styling</h5>
            <p class="card-text">Stylish trims tailored to your dog’s breed and personality.</p>
          </div>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <div class="card-body">
            <img src="{{ asset('assets/images/NailsCuting.jpg') }}" alt="Nail Clipping" class="mb-3" style="width: 234px;">
            <h5 class="card-title">Nail Clipping</h5>
            <p class="card-text">Safe and gentle nail clipping to keep your pet’s paws healthy.</p>
          </div>
        </div>
      </div>

      <!-- Service 4 -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <div class="card-body">
            <img src="{{ asset('assets/images/earcleaning.jpg') }}" alt="Ear Cleaning" class="mb-3" style="width: 234px;">
            <h5 class="card-title">Ears & Hygiene</h5>
            <p class="card-text">Deep ear cleaning and hygiene maintenance for total wellness.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="py-5" style="background-color: #e9f7ef;">
  <div class="container">
     <h2 class="text-center fw-bold mb-5" style="color:#1f2e4d; letter-spacing: 1px; margin-bottom: 4rem;">OUR STATS</h2>
    <div class="row text-center g-4" style="margin-top: 2rem;">
      
      <div class="col-6 col-md-3">
        <h2 class="display-5 fw-bold text-success mb-2">2000</h2>
        <p class="text-muted fw-semibold" style="letter-spacing: 0.05em;">Happy Customers</p>
      </div>
      
      <div class="col-6 col-md-3">
        <h2 class="display-5 fw-bold text-success mb-2">2000</h2>
        <p class="text-muted fw-semibold" style="letter-spacing: 0.05em;">Projects</p>
      </div>
      
      <div class="col-6 col-md-3">
        <h2 class="display-5 fw-bold text-success mb-2">3000</h2>
        <p class="text-muted fw-semibold" style="letter-spacing: 0.05em;">Puppies-Kitten Adoption</p>
      </div>
      
      <div class="col-6 col-md-3">
        <h2 class="display-5 fw-bold text-success mb-2">65</h2>
        <p class="text-muted fw-semibold" style="letter-spacing: 0.05em;">Event Host</p>
      </div>
      
    </div>
  </div>
</section>



<section class="py-5" style="background-color: #f3f6fa;">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color: #1f2e4d;">Book a Grooming Appointment</h2>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="#" method="POST">
          @csrf
          
          <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
          </div>

          <div class="mb-3">
            <label for="service" class="form-label">Select Service</label>
            <select class="form-select" id="service" name="service" required>
              <option value="">-- Select --</option>
              <option value="Dog Bath & Blow Dry">Dog Bath & Blow Dry</option>
              <option value="Haircut & Styling">Haircut & Styling</option>
              <option value="Ears & Hygiene">Ears & Hygiene</option>
              <option value="Nail Clipping">Nail Clipping</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="appointment_date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
          </div>

          <div class="mb-3">
            <label for="appointment_time" class="form-label">Select Time</label>
            <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Message (Optional)</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your message here..."></textarea>
          </div>

          <button type="submit" class="btn btn-success w-100">Book Now</button>
        </form>
      </div>
    </div>
  </div>
</section>


@endsection



