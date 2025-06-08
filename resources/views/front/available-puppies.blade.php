@extends('front.layouts.app')
@section('main')
<!-- <style>
  .pethund_pet_belt::before {
  content: "\e900"; /* Example Unicode */
  font-family: 'pethund-icons';
}

</style> -->
<section class="section-01 d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('assets/images/available-puppies-banner.png') }}');">
    <div class="container text-center">
        <h1 class="display-4 fw-bold" style="color: #FA7070;">Puppies Available <span style="color:#1f2e4d;">For Sale In</span></h1>
        <h1 class="display-5 fw-bold" style="color:#1f2e4d;">{{ ucfirst($city) }}</h1>
    </div>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <div class="row g-4 justify-content-center">

      @forelse($petsDetails as $pet)
        <div class="col-md-6 col-lg-6">
          <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
            <div class="d-flex align-items-center">
              <img src="{{ asset('uploads/photos/' . $pet->photo_path) }}" class="puppy-img me-3" style="width: 140px;" alt="{{ $pet->name }} Puppy">
              <div>
                <h5 class="fw-bold text-danger">{{ $pet->breed }}</h5>
                <p class="mb-2">
                  {{ \Illuminate\Support\Str::limit($pet->description, 100, '...') }}
                </p>
                <a href="{{ route('available-puppies-details', ['breed' => $pet->breed, 'city' => $pet->location]) }}" class="read-more-btn">
                  Read More <i class="bi bi-arrow-right ms-1"></i>
                </a>

              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
            <p>No puppies available in {{ ucfirst($city) }} at the moment.</p>
        </div>
      @endforelse

    </div>
  </div>
</section>


<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow rounded p-4">
          <div class="text-center mb-4">
            <h3 class="fw-bold" style="font-size: 1.75rem;">
              <small class="d-block text-muted">Make An Enquiry <i class="pethund_repeat_grid"></i></small>
              Do you want to buy Puppy from <span class="text-success">Doggywala?</span>
            </h3>
          </div>
          @if(session('success'))
              <div class="alert alert-success text-center">
                  {{ session('success') }}
              </div>
          @endif
          <form action="{{route('enquiry.store')}}" method="post" id="enquiry_form">
            @csrf
            <input type="hidden" name="functionname" value="https://doggywala.com/dog-breeders-pune">

            <div class="row g-3">
              <div class="col-md-6">
                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required maxlength="30">
              </div>

              <div class="col-md-6">
                <select class="form-select" id="cityname" name="cityname" required>
                  <option value="" disabled selected>Select City</option>
                  <option>Mumbai</option>
                  <option>Pune</option>
                  <option>Bangalore</option>
                  <option>Hyderabad</option>
                  <option>Chennai</option>
                  <option>Kolkata</option>
                  <option>Ahmedabad</option>
                  <option>Surat</option>
                  <option>Visakhapatnam</option>
                  <option>All Over India</option>
                </select>
              </div>

              <div class="col-md-6">
                <select class="form-select" id="breedname" name="breedname" required>
                  <option value="" disabled selected>Select Breed</option>
                  <option>Beagle</option>
                  <option>Boxer</option>
                  <option>Cocker Spaniel</option>
                  <option>Doberman</option>
                  <option>English Bulldog</option>
                  <option>German Shepherd</option>
                  <option>Golden Retriever</option>
                  <option>Great Dane</option>
                  <option>Labrador Retriever</option>
                  <option>Lhasa Apso</option>
                  <option>Maltese</option>
                  <option>Pitbull</option>
                  <option>Pomeranian</option>
                  <option>Poodle</option>
                  <option>Pug</option>
                  <option>Rottweiler</option>
                  <option>Shih Tzu</option>
                  <option>Siberian Husky</option>
                  <option>Toy Pomeranian</option>
                </select>
              </div>

              <div class="col-md-6">
                <select class="form-select" id="price_range" name="price_range" required>
                  <option value="" disabled selected>Select Price Range</option>
                  <option value="1,000 - 10,000">1,000 - 10,000</option>
                  <option value="10,000 - 20,000">10,000 - 20,000</option>
                  <option value="20,000 - 30,000">20,000 - 30,000</option>
                  <option value="30,000 - 40,000">30,000 - 40,000</option>
                  <option value="40,000 - 50,000">40,000 - 50,000</option>
                  <option value="50,000 - 60,000">50,000 - 60,000</option>
                  <option value="60,000 - 70,000">60,000 - 70,000</option>
                  <option value="70,000 - 80,000">70,000 - 80,000</option>
                  <option value="80,000 - 90,000">80,000 - 90,000</option>
                  <option value="90,000 - 1,00,000">90,000 - 1,00,000</option>
                </select>
              </div>

              <div class="col-md-6">
                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required maxlength="30">
              </div>

              <div class="col-md-6">
                <input type="text" name="phone" maxlength="10" id="phone" class="form-control" placeholder="Mobile Number" pattern="[7-9]{1}[0-9]{9}" required>
              </div>

              <div class="col-md-12">
                <textarea name="message" id="message" class="form-control" rows="4" maxlength="100" placeholder="Message" required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success mt-3 px-5">
                  <span id="btnText">Send Enquiry</span>
                  <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                </button>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>


<!-- <section class="py-5 bg-white">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded">
          <div class="card-body">
            <p><i class="pethund_pet_belt"></i></p>
            <hr style="width: 40px; margin: auto;">
            <h4 class="fw-bold text-danger mt-3">13,923+</h4>
            <p class="mb-0 fw-semibold">Adopted Pets</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded">
          <div class="card-body">
              <p><i class="pethund_pet_professional"></i></p>
              <hr style="width: 40px; margin: auto;">
              <h4 class="fw-bold text-danger mt-3">20+</h4>
            <p class="mb-0 fw-semibold">Professionals</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded">
          <div class="card-body">
            <p><i class="pethund_pet_awards"></i></p>
            <hr style="width: 40px; margin: auto;">
            <h4 class="fw-bold text-danger mt-3">26+</h4>
            <p class="mb-0 fw-semibold">Pet Awards</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded">
          <div class="card-body">
            <p><i class="pethund_pet_salon"></i></p>
            <hr style="width: 40px; margin: auto;">
            <h4 class="fw-bold text-danger mt-3">45,621+</h4>
            <p class="mb-0 fw-semibold">Pets Grooming</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section> -->

<script>
  document.getElementById('enquiry_form').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    btn.disabled = true;

    btnText.style.display = 'none';
    btnSpinner.classList.remove('d-none');
  });

  @if(session('success'))
    toastr.success("{{ session('success') }}");
  @endif
</script>

@endsection
