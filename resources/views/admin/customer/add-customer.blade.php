@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
 <style>
    .select2-container {
    width: 100% !important;
}

.select2-selection {
    height: 41px !important;
    font-size: 16px !important;
    border: 2px solid #ccc !important;
    border-radius: 5px !important;
    padding: 4px !important;
    background-color: #FDF5F6 !important;
    border-color: #D8405533 !important;
}
.text-danger-error{
    color:#fc544b !important;
    font-size: 0.9rem;
}

 </style>       
 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Customer/<span style=" color:black !important; font-weight: 600; font-size: 22px;">Add Customer</span></h1>
          </div>

          <div class="row" >
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('store-customer') }}" method="POST" id="customerForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="customerName">Customer Name(Full Name)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customerName" name="name" placeholder="Customer Name"
                                    value="{{ old('name') }}" style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span class="text-danger-error"></span>
                            </div>
                    
                            <div class="form-group col-md-4">
                                <label for="emailAddress">Email Address<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="emailAddress" name="email" placeholder="Email Address"
                                    value="{{ old('email') }}" style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span id="emailError" class="text-danger"></span>
                                <span class="text-danger-error"></span>
                            </div>
                    
                            <div class="form-group col-md-4">
                                <label for="phoneNumber">Phone Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phoneNumber" name="phone" placeholder="Phone Number"
                                    value="{{ old('phone') }}"  maxlength="10" minlength="10"  oninput="validatePhone(this)"  style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span id="phoneError" class="text-danger"></span>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="businessType">Business Type<span class="text-danger">*</span></label>
                                <select id="businessType" class="form-control" name="business_type" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option value="" disabled selected>Select State...</option>
                                    <option value="Individual" {{ old('business_type') == 'Individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="Business Owner" {{ old('business_type') == 'Business Owner' ? 'selected' : '' }}>Business Owner</option>
                                    <option value="Corporate client" {{ old('business_type') == 'Corporate client' ? 'selected' : '' }}>Corporate client</option>
                                    <option value="Government" {{ old('business_type') == 'Government' ? 'selected' : '' }}>Government</option>
                                    <option value="VIP Customer" {{ old('business_type') == 'VIP Customer' ? 'selected' : '' }}>VIP Customer</option>
                                </select>
                                <span class="text-danger-error"></span>
                                <!--@error('business_type')-->
                                <!--    <div class="text-danger">{{ $message }}</div>-->
                                <!--@enderror-->
                            </div>
                    
                            <div class="form-group col-md-4">
                                <label for="country">Country<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="country" name="country" value="USA" readonly
                                    style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span class="text-danger-error"></span>
                            </div>
                    
                            <div class="form-group col-md-4">
                                <label for="state">State<span class="text-danger">*</span></label>
                                <select id="state" class="custom-dropdown" name="state" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option value="" disabled selected>Select State...</option>
                                </select>
                                <span class="text-danger-error"></span>
                                <!--@error('state')-->
                                <!--    <div class="text-danger">{{ $message }}</div>-->
                                <!--@enderror-->
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="city">City(city/town)<span class="text-danger">*</span></label>
                                <select id="city" name="city" class="custom-dropdown" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option value="" disabled selected>Select City...</option>
                                   
                                </select>
                                <span class="text-danger-error"></span>
                                <!--@error('city')-->
                                <!--    <div class="text-danger">{{ $message }}</div>-->
                                <!--@enderror-->
                            </div>
                    
                            <div class="form-group col-md-4">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                                    value="{{ old('address') }}" style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span class="text-danger-error"></span>
                                <!--@error('address')-->
                                <!--    <div class="text-danger">{{ $message }}</div>-->
                                <!--@enderror-->
                            </div>
                    
                        <!-- <div class="form-group col-md-4">-->
                        <!--    <label for="zipCode">Zip Code<span class="text-danger">*</span></label>-->
                        <!--    <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code"-->
                        <!--        value="{{ old('zip_code') }}" style="background-color:#FDF5F6; border-color:#D8405533;"-->
                        <!--        maxlength="5" oninput="limitZipLength(this)">-->
                        <!--    <span class="text-danger-error"></span>-->
                        <!--</div>-->
                        
                        <div class="form-group col-md-4">
                            <label for="zipCode">Zip Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code"
                                value="{{ old('zip_code') }}"
                                style="background-color:#FDF5F6; border-color:#D8405533;"
                                maxlength="5" minlength="5" oninput="validateZipCode(this)">
                            <span class="text-danger-error"></span>
                        </div>

                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select id="status" class="form-control" name="status" required
                                    style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger-error"></span>
                                <!--@error('status')-->
                                <!--    <div class="text-danger">{{ $message }}</div>-->
                                <!--@enderror-->
                            </div>
                        </div>
                    
                        <div class="text-center">
                            <button type="submit" id="submitBtn" class="btn btn-danger"
                                style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none !important;width: 100px;">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

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

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<!-- CSS for Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

<!-- Required Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {

        $('#state').select2({
            width: '100%'
        });

        $('#city').select2({
            width: '100%'
        });

        $('#city').on('select2:opening', function (e) {
            const stateSelected = $('#state').val();
            if (!stateSelected) {
                alert('Please select state first');
                e.preventDefault(); 
            }
        });

        function fetchStates() {
            $.ajax({
                url: '/states',
                method: 'GET',
                dataType: 'json',
                success: function (states) {
                    if (!Array.isArray(states)) {
                        console.error("States response is not an array", states);
                        return;
                    }
                    let options = '<option selected disabled>Select State...</option>';
                    states.forEach(state => {
                        options += `<option value="${state}">${state}</option>`;
                    });
                    $('#state').html(options);
                },
                error: function () {
                    alert('Error fetching states!');
                }
            });
        }

        function fetchCities(state) {
            $.ajax({
                url: `/cities/${state}`,
                method: 'GET',
                dataType: 'json',
                success: function (cities) {
                    if (!Array.isArray(cities)) {
                        console.error("Cities response is not an array", cities);
                        return;
                    }
                    let options = '<option selected disabled>Select City...</option>';
                    cities.forEach(city => {
                        options += `<option value="${city}">${city}</option>`;
                    });
                    $('#city').html(options);
                },
                error: function () {
                    alert('Error fetching cities!');
                }
            });
        }

        fetchStates();

        $('#state').on('change', function () {
            let selectedState = $(this).val();
            $('#city').html('<option selected disabled>Loading...</option>');
            if (selectedState) {
                fetchCities(selectedState);
            } else {
                $('#city').html('<option selected disabled>Select City...</option>');
            }
        });

        // window.validateEmail = function (input) {
        //     const email = input.value;
        //     const error = document.getElementById("emailError");
        //     const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        //     error.textContent = regex.test(email) ? "" : "Please enter a valid email address (e.g., User@mail.com)";
        // };

        window.validatePhone = function (input) {
            let phone = input.value.replace(/\D/g, '');
            input.value = phone.slice(0, 10);
            const error = document.getElementById("phoneError");
            error.textContent = phone.length < 10 ? "" : "";
        };
        
        const allowedDomains = [
            'gmail.com', 'mail.com', 'yahoo.com', 'outlook.com', 'hotmail.com',
            'aol.com', 'icloud.com', 'zoho.com', 'protonmail.com', 'gmx.com'
        ];
        // $.validator.addMethod("allowedEmailDomain", function(value, element) {
        //     const domain = value.split('@')[1];
        //     return this.optional(element) || allowedDomains.includes(domain);
        // }, "Please enter an email address with allowed domain (gmail, yahoo, outlook, etc.)");
        
        $.validator.addMethod("allowedEmailDomain", function(value, element) {
            const domain = value.split('@')[1];
            
            return this.optional(element) || (domain && !/^\d+$/.test(domain.split('.')[0]));
        }, "Please enter a valid domain (not numeric)");


        $('#customerForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true,
                    allowedEmailDomain: true
                },
                phone: {
                    required: true,
                    digits: true,
                    rangelength: [10, 10]
                },
                business_type: {
                    required: true,
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                address: {
                    required: true,
                    minlength: 5
                },
                zip_code: {
                    required: true,
                    rangelength: [5, 5],
                    digits: true
                },
                status: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Please enter the customer name",
                    minlength: "Customer name must be at least 3 characters long"
                },
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email format (e.g. user@mail.com)",
                    allowedEmailDomain: "Only valid domains are allowed (e.g. gmail, yahoo, outlook, etc.)"
                },
                phone: {
                    required: "Please enter the phone number",
                    digits: "Phone number must contain only digits",
                    rangelength: "Phone number must be exactly 10 digits"
                },
                business_type: {
                    required: "Please select the business type"
                },
                state: {
                    required: "Please select the state"
                },
                city: {
                    required: "Please select the city"
                },
                address: {
                    required: "Please enter the address",
                    minlength: "Address must be at least 5 characters long"
                },
                zip_code: {
                    required: "Please enter the zip code",
                    digits: "Zip code must contain only digits",
                    rangelength: "Zip code must be exactly 5 digits"
                },
                status: {
                    required: "Please select the status"
                },
            },
            errorElement: 'span',
            errorClass: 'text-danger-error',
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                $('#submitBtn').html('Processing...').attr('disabled', true);
                form.submit();
            }
        });
    });
</script>
<script>
    // function validateZipCode(input) {
    //     input.value = input.value.replace(/[^0-9]/g, '');

    //     if (input.value.length > 5) {
    //         input.value = input.value.slice(0, 5);
    //     }
    // }
</script>
