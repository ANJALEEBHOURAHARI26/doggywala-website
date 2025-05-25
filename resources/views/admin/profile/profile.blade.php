@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
        
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;">
      Profile
    </h1>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        </div>
        <div class="card-body">
            <form action="{{url('update-profile')}}" method="POST" enctype="multipart/form-data" id="profileForm">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Full Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$users->name ?? ''}}" placeholder="Full Name" required>
                    </div>
                    <!--<div class="form-group col-md-6">-->
                    <!--    <label for="email">Email<span class="text-danger">*</span></label>-->
                    <!--    <input type="email" class="form-control" id="email" name="email" value="{{$users->email ?? ''}}" placeholder="Email">-->
                    <!--</div>-->
                    <div class="form-group col-md-6">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{$users->email ?? ''}}" placeholder="Email" oninput="validateEmail(this)" required>
                    <span id="emailError" class="text-danger"></span>
                    </div>
                </div>
            
                <div class="form-row">
                    <!--<div class="form-group col-md-6">-->
                    <!--    <label for="phoneNumber">Phone Number<span class="text-danger">*</span></label>-->
                    <!--    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$users->phone_number ?? ''}}" placeholder="Phone Number">-->
                    <!--</div>-->
                    <div class="form-group col-md-6">
                        <label>Phone Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" maxlength="10" minlength="10"  oninput="validatePhone(this)"  id="phone_number" name="phone_number" 
                               value="{{ $users->phone_number ?? '' }}" placeholder="Phone Number" required>
                               <span id="phoneError" class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$users->address ?? ''}}" placeholder="Address">
                    </div>
                </div>
            
                <div class="form-group col-md-12">
                    <label for="profileUpload">Profile</label>
                    <input type="file" class="form-control" id="profileUpload" name="profile_image">
            
                    <div class="mt-3">
                        @if(isset($users->profile_image) && !empty($users->profile_image))
                            <img id="profilePreview" src="{{ asset($users->profile_image) }}" alt="Profile Image" class="img-fluid rounded-circle" style="max-width: 150px;">
                        @else
                            <p class="text-danger fw-bold">Profile Image Not Found</p>
                        @endif
                    </div>
                </div>
            
                <button type="submit" id="submitBtn" style="background-color: #D84055;border-color: #D84055;" class="btn btn-danger">Update</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Design & developed by
              <b><a href="https://www.sunshineitsolution.com/" target="_blank">Sunshine it Solution</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
              <form action="{{ url('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
            </div>
          </div>
        </div>
    </div>
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets/js/ruang-admin.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    document.getElementById('profileUpload').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.getElementById('profilePreview');
          img.src = e.target.result;
          img.style.display = 'block';
        }
        reader.readAsDataURL(file);
      }
    });

    document.getElementById("profileForm").addEventListener("submit", function() {
        var submitBtn = document.getElementById("submitBtn");
        submitBtn.innerHTML = 'Processing...';
        submitBtn.disabled = true;
    });
    
    window.validateEmail = function(input) {
            const email = input.value.trim();
            const error = document.getElementById("emailError");

            const regex = /^[a-zA-Z0-9._%+-]+@(?=.*[a-zA-Z])[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (regex.test(email)) {
                error.textContent = "";
            } else {
                error.textContent = "Please enter a valid email address with a proper domain name (e.g., user@mail.com)";
            }
        };

     window.validatePhone = function (input) {
            let phone = input.value.replace(/\D/g, '');
            input.value = phone.slice(0, 10);
            const error = document.getElementById("phoneError");
            error.textContent = phone.length < 10 ? "Phone number must be exactly 10 digits." : "";
        };
</script>
<script>
    $(document).ready(function() {
        $('#profileForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this); 

            $.ajax({
                url: "{{ url('update-profile') }}", 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#submitBtn').text('Updating...').prop('disabled', true); 
                },
                success: function(response) {
                    alert(response.message); 
                    location.reload(); 
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "Error: ";
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + "\n";
                    });
                    alert(errorMessage);
                },
                complete: function() {
                    $('#submitBtn').text('Update').prop('disabled', false); 
                }
            });
        });
    });
</script>



</body>

</html>