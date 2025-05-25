@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
/*    .select2-container {*/
/*    width: 100% !important;*/
/*}*/

.select2-selection {
    height: 41px !important;
    font-size: 16px !important;
    border: 2px solid #ccc !important;
    border-radius: 5px !important;
    padding: 4px !important;
    background-color: #FDF5F6 !important;
    border-color: #D8405533 !important;
}

 </style>  
<div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >General Setting</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('message') }}
                        </div>
                    @endif
                  <form id="generalSettingForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Company Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company_name" name="company_name" 
                                       value="{{ $generalSetting->company_name ?? '' }}" placeholder="Comapny Name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ $generalSetting->email ?? '' }}" placeholder="Email" oninput="validateEmail(this)">
                            <span id="emailError" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Phone Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" maxlength="10" minlength="10"  oninput="validatePhone(this)"  id="phone_number" name="phone_number" 
                                       value="{{ $generalSetting->phone_number ?? '' }}" placeholder="Phone Number">
                                       <span id="phoneError" class="text-danger"></span>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="USA" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label>State</label>
                                <select id="state" name="state" class="form-control">
                                    <option selected>Select State...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>City(city/twon)</label>
                                <select id="city" name="city" class="form-control">
                                    <option selected>Select City...</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address" name="address" 
                                       value="{{ $generalSetting->address ?? '' }}" placeholder="Address">
                            </div>
                            <!--<div class="form-group col-md-4">-->
                            <!--    <label>GST Number</label>-->
                            <!--    <input type="text" class="form-control" id="gst_number" name="gst_number" -->
                            <!--           value="{{ $generalSetting->gst_number ?? '' }}" placeholder="GST Number">-->
                            <!--</div>-->
                            <div class="form-group col-md-4">
                                <label>Time Zone</label>
                                <select id="time_zone" name="time_zone" class="form-control" required>
                                    <option value="UTC-5" {{ isset($generalSetting) && $generalSetting->time_zone == 'UTC-5' ? 'selected' : '' }}>Eastern Time (UTC-05:00)</option>
                                    <option value="UTC-6" {{ isset($generalSetting) && $generalSetting->time_zone == 'UTC-6' ? 'selected' : '' }}>Central Time (UTC-06:00)</option>
                                    <option value="UTC-7" {{ isset($generalSetting) && $generalSetting->time_zone == 'UTC-7' ? 'selected' : '' }}>Mountain Time (UTC-07:00)</option>
                                    <option value="UTC-8" {{ isset($generalSetting) && $generalSetting->time_zone == 'UTC-8' ? 'selected' : '' }}>Pacific Time (UTC-08:00)</option>
                                    <option value="UTC-9" {{ isset($generalSetting) && $generalSetting->time_zone == 'UTC-9' ? 'selected' : '' }}>Alaska Time (UTC-09:00)</option>
                                    <option value="UTC-10" {{ isset($generalSetting) && $generalSetting->time_zone == 'UTC-10' ? 'selected' : '' }}>Hawaii Time (UTC-10:00)</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo" 
                                       onchange="previewImage(event, 'logoPreview')" placeholder="Logo">
                                <img id="logoPreview" src="{{ asset($generalSetting->logo ?? 'img/new-side-icon.png') }}" width="80">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="favicon" 
                                       onchange="previewImage(event, 'faviconPreview')" placeholder="Favicon">
                                <img id="faviconPreview" src="{{ asset($generalSetting->favicon ?? 'img/new-side-icon.png') }}" width="40">
                            </div>
                          
                        </div>
                    
                      
                        <button type="submit" class="btn btn-danger" id="submitBtn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;" >Save</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

        

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

  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets/js/ruang-admin.min.js')}}"></script>
  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#state, #city').select2({
            dropdownParent: $('#state').parent(), 
            width: '100%'
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#state, #city').select2({
            placeholder: "Search...",
            allowClear: true
        });

        let selectedState = "{{ $generalSetting->state ?? '' }}"; 
        let selectedCity = "{{ $generalSetting->city ?? '' }}";   

        fetchStates(selectedState);

        $('#state').on('change', function() {
            let state = $(this).val();
            $('#city').html('<option selected disabled>Loading...</option>');
            if (state) {
                fetchCities(state, selectedCity);
            } else {
                $('#city').html('<option selected disabled>Select City...</option>');
            }
        });

        function fetchStates(selectedState) {
            $.ajax({
                url: '{{ url("/states") }}',
                method: 'GET',
                dataType: 'json',
                success: function(states) {
                    let options = '<option selected disabled>Select State...</option>';
                    states.forEach(state => {
                        let selected = state === selectedState ? 'selected' : ''; 
                        options += `<option value="${state}" ${selected}>${state}</option>`;
                    });
                    $('#state').html(options).trigger('change'); 

                    if (selectedState) {
                        fetchCities(selectedState, selectedCity);
                    }
                },
                error: function() {
                    alert('Error fetching states!');
                }
            });
        }

        function fetchCities(state, selectedCity) {
            $.ajax({
                url: `{{ url("/cities") }}/${state}`,
                method: 'GET',
                dataType: 'json',
                success: function(cities) {
                    let options = '<option selected disabled>Select City...</option>';
                    cities.forEach(city => {
                        let selected = city === selectedCity ? 'selected' : ''; 
                        options += `<option value="${city}" ${selected}>${city}</option>`;
                    });
                    $('#city').html(options).trigger('change'); 
                },
                error: function() {
                    alert('Error fetching cities!');
                }
            });
        }
    });
 
</script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    const timeZoneOffsets = {
      "Pacific/Midway": "UTC-11",
      "America/Anchorage": "UTC-9",
      "America/Los_Angeles": "UTC-8",
      "America/Denver": "UTC-7",
      "America/Chicago": "UTC-6",
      "America/New_York": "UTC-5",
      "Europe/London": "UTC+0",
      "Europe/Paris": "UTC+1",
      "Europe/Athens": "UTC+2",
      "Asia/Dubai": "UTC+4",
      "Asia/Kolkata": "UTC+5",
      "Asia/Bangkok": "UTC+7",
      "Asia/Tokyo": "UTC+9",
      "Australia/Sydney": "UTC+10"
    };

    const selectElement = document.getElementById('timeZone');
    if (timeZoneOffsets[userTimeZone]) {
      selectElement.value = timeZoneOffsets[userTimeZone];
    }
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
    $(document).ready(function () {
        $("#generalSettingForm").on("submit", function (e) {
            e.preventDefault();
            let submitBtn = $("#submitBtn");
            submitBtn.text('Processing...').prop('disabled', true);
    
            let formData = new FormData(this);
            $.ajax({
                url: "/general-settings/store",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000); 
                    } else {
                        toastr.error("Something went wrong!");
                    }
                    submitBtn.text('Save').prop('disabled', false);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = JSON.parse(xhr.responseText);
                        toastr.error(errors.message);
                    } else {
                        toastr.error("Something went wrong!");
                    }
                    console.log(xhr.responseText); 
                    submitBtn.text('Save').prop('disabled', false);
                }
            });
        });
    });


function previewImage(event, imgId) {
    let reader = new FileReader();
    reader.onload = function () {
        document.getElementById(imgId).src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

</script>
