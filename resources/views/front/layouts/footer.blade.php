<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<footer class="footer py-5" style="background-color: #A8DF8E;">
  <div class="container">
    <div class="row text-dark">

      <!-- Doggywala About -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold">Doggywala</h5>
        <p>We connect pet lovers with responsible breeders. Trusted, reliable & safe.</p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="{{url('/')}}" class="text-dark text-decoration-none">Home</a></li>
          <li><a href="http://127.0.0.1:8000/available-puppies/delhi" class="text-dark text-decoration-none">Available Puppies</a></li>
          <li><a href="{{url('blogs')}}" class="text-dark text-decoration-none">Blog</a></li>
          <li><a href="{{url('contact-us')}}" class="text-dark text-decoration-none">Contact Us</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold">Contact Us</h5>
        <p>Email: support@doggywala.com</p>
        <p>Phone: +91 98765 43210</p>
        <p>Indore, India</p>

        <div class="mt-3">
          <a href="https://www.facebook.com/doggywala" target="_blank" class="me-3 fs-4 text-dark">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/doggywala" target="_blank" class="me-3 fs-4 text-dark">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://twitter.com/doggywala" target="_blank" class="me-3 fs-4 text-dark">
            <i class="fab fa-twitter"></i>
          </a>

        </div>
      </div>

    </div>

    <hr class="text-dark" />
    <div class="text-center text-dark">
      &copy; {{ date('Y') }} Doggywala. All rights reserved.
    </div>
  </div>
</footer>
