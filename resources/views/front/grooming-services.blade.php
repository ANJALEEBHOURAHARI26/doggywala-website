@extends('front.layouts.app')

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
    <h2 class="text-center fw-bold" style="color:#1f2e4d;">Book Bath & Blow Dry</h2>
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
    <h2 class="text-center fw-bold" style="color:#1f2e4d;">Book Haircut & Styling</h2>
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
    <h2 class="text-center fw-bold" style="color:#1f2e4d;">Book Hygiene & Care</h2>
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

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Our Grooming Services</h2>
    <div class="row g-4">
      @php
        $services = [
          ['title' => 'Dog Bath & Blow Dry', 'img' => 'DogBath&BlowDry.jpg', 'desc' => 'Gentle bath with premium products followed by a soothing blow dry.'],
          ['title' => 'Haircut & Styling', 'img' => 'HairCut&styling.jpg', 'desc' => 'Stylish trims tailored to your dog’s breed and personality.'],
          ['title' => 'Nail Clipping', 'img' => 'NailsCuting.jpg', 'desc' => 'Safe and gentle nail clipping to keep your pet’s paws healthy.'],
          ['title' => 'Ears & Hygiene', 'img' => 'earcleaning.jpg', 'desc' => 'Deep ear cleaning and hygiene maintenance for total wellness.']
        ];
      @endphp
      @foreach ($services as $service)
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <div class="card-body">
            <img src="{{ asset('assets/images/' . $service['img']) }}" alt="{{ $service['title'] }}" class="img-fluid rounded mb-3">
            <h5 class="card-title">{{ $service['title'] }}</h5>
            <p class="card-text">{{ $service['desc'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
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
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
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
            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
          </div>

          <button type="submit" class="btn btn-success w-100">Book Now</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
