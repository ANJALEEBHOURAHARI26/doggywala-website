@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
/*    .select2-container {*/
/*    width: 100% !important;*/
/*}*/
.text-danger-error{
    color:#fc544b !important;
    font-size: 0.9rem;
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
.text-danger-error-edit{
    color:#fc544b !important;
}
 </style>   
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;">
        <a href="{{ route('customer-list') }}" style="text-decoration: none; color: black;">Customer/</a>
        <span style=" color:black !important; font-weight: 600; font-size: 22px;">Edit Customer</span></h1>

  </div>

  <div class="row"  style="max-height: 600px; overflow-y: auto; scrollbar-width: none; -ms-overflow-style: none;">
    <div class="col-lg-12">
      <!-- Add Customer Form -->
      <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

        </div>
        <div class="card-body">
          @if(session('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('success') }}
          </div>
          @endif
           @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

          <form action="{{ route('customer.update', $customer->id) }}" method="POST" id="editCustomerForm">
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="customerName">Customer Name(Full Name)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="customerName" value="{{ $customer->name }}" placeholder="Customer Name" style="background-color:#FDF5F6; border-color:#D8405533;">
              <span class="text-danger-error-edit"></span>
              </div>

              <div class="form-group col-md-4">
                <label for="emailAddress">Email Address<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="emailAddress" value="{{$customer->email}}" oninput="validateEditEmail(this)" name="email" placeholder="Email Address" style="background-color:#FDF5F6; border-color:#D8405533;">
                <span id="editEmailError" class="text-danger"></span>
                <span class="text-danger-error-edit"></span>
              </div>
              <div class="form-group col-md-4">
                <label for="phoneNumber">Phone Number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" maxlength="10" oninput="validateEditPhone(this)"  id="phoneNumber" value="{{$customer->phone_number}}" placeholder="Phone Number" style="background-color:#FDF5F6; border-color:#D8405533;">
                <span id="editPhoneError" class="text-danger"></span>
                <span class="text-danger-error-edit"></span>
              </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="businessType">Business Type<span class="text-danger">*</span></label>
                    <select id="businessType" class="form-control" name="business_type" style="background-color:#FDF5F6; border-color:#D8405533;">
                        <option value="" disabled {{ !$customer->business_type ? 'selected' : '' }}>Select State...</option>
                        <option value="Individual" {{ $customer->business_type == 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Business Owner" {{ $customer->business_type == 'Business Owner' ? 'selected' : '' }}>Business Owner</option>
                        <option value="Corporate client" {{ $customer->business_type == 'Corporate client' ? 'selected' : '' }}>Corporate client</option>
                        <option value="Government" {{ $customer->business_type == 'Government' ? 'selected' : '' }}>Government</option>
                        <option value="VIP Customer" {{ $customer->business_type == 'VIP Customer' ? 'selected' : '' }}>VIP Customer</option>
                    </select>
                    <span class="text-danger-error-edit"></span>
                </div>
          
              <div class="form-group col-md-4">
                <label for="country">Country<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="country" name="country"
                  value="{{ $defaultCountry }}" readonly>
                  <span class="text-danger-error-edit"></span>
              </div>

              <div class="form-group col-md-4">
                <label for="state">State<span class="text-danger">*</span></label>
                <select id="state" name="state" class="form-control select2">
                  <option selected disabled>Select State...</option>
                </select>
                <span class="text-danger-error-edit"></span>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="city">City(city/town)<span class="text-danger">*</span></label>
                <select id="city" name="city" class="form-control select2">
                  <option selected disabled>Select City...</option>
                </select>
                <span class="text-danger-error-edit"></span>
              </div>

              <div class="form-group col-md-4">
                <label for="address">Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                  value="{{ $customer->address }}" required>
                  <span class="text-danger-error-edit"></span>
              </div>

                <!--<div class="form-group col-md-4">-->
                <!--    <label for="zipCode">Zip Code<span class="text-danger">*</span></label>-->
                <!--    <input type="number" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code"-->
                <!--      value="{{ $customer->zip_code }}" required>-->
                <!--      <span class="text-danger-error-edit"></span>-->
                <!--</div>-->
                <div class="form-group col-md-4">
                    <label for="zipCode">Zip Code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code"
                        value="{{ $customer->zip_code }}" style="background-color:#FDF5F6; border-color:#D8405533;"
                        maxlength="5" minlength="5" oninput="validateZipCode(this)">
                    <span class="text-danger-error"></span>
                </div>
            </div> 
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="status">Status<span class="text-danger">*</span></label>
                    <select id="status" class="form-control" name="status" required
                        style="background-color:#FDF5F6; border-color:#D8405533;">
                        <option value="Active" 
                            {{ (old('status', $customer->status ?? '') == 'Active') ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="Inactive" 
                            {{ (old('status', $customer->status ?? '') == 'Inactive') ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                    <span class="text-danger-error-edit"></span>
                    <!--@error('status')-->
                    <!--    <div class="text-danger">{{ $message }}</div>-->
                    <!--@enderror-->
                </div>
            </div>
            <button type="submit" class="btn btn-danger" style="background-color: #D84055;border-color: #D84055;">Update</button>
          </form>
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
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>copyright &copy; <script>
          document.write(new Date().getFullYear());
        </script> - Design & developed by
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


<!-- Required JS + CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        let selectedState = "{{ $customer->state ?? '' }}"; 
        let selectedCity = "{{ $customer->city ?? '' }}";   

        $('#state').select2({ width: '100%' });
        $('#city').select2({ width: '100%' });

        $('#city').on('select2:opening', function (e) {
            if (!$('#state').val()) {
                alert('Please select state first');
                e.preventDefault();
            }
        });

        fetchStates(selectedState);

        $('#state').on('change', function () {
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
                success: function (states) {
                    let options = '<option selected disabled>Select State...</option>';
                    states.forEach(state => {
                        let selected = (state === selectedState) ? 'selected' : '';
                        options += `<option value="${state}" ${selected}>${state}</option>`;
                    });
                    $('#state').html(options).trigger('change');

                    if (selectedState) {
                        fetchCities(selectedState, selectedCity);
                    }
                },
                error: function () {
                    alert('Error fetching states!');
                }
            });
        }

        function fetchCities(state, selectedCity) {
            $.ajax({
                url: `{{ url("/cities") }}/${state}`,
                method: 'GET',
                dataType: 'json',
                success: function (cities) {
                    let options = '<option selected disabled>Select City...</option>';
                    cities.forEach(city => {
                        let selected = (city === selectedCity) ? 'selected' : '';
                        options += `<option value="${city}" ${selected}>${city}</option>`;
                    });
                    $('#city').html(options).trigger('change');
                },
                error: function () {
                    alert('Error fetching cities!');
                }
            });
        }

        window.validateEditEmail = function (input) {
            const email = input.value;
            const error = document.getElementById("editEmailError");
            const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            error.textContent = regex.test(email) ? "" : "";
        };

        // window.validateEditPhone = function (input) {
        //     let phone = input.value.replace(/\D/g, '');
        //     input.value = phone.slice(0, 10);
        //     const error = document.getElementById("editPhoneError");
        //     error.textContent = phone.length < 10 ? "Phone number must be exactly 10 digits." : "";
        // };
        
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


        $('#editCustomerForm').validate({
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
    function validateZipCode(input) {
        input.value = input.value.replace(/[^0-9]/g, '');

        if (input.value.length > 5) {
            input.value = input.value.slice(0, 5);
        }
    }
</script>

</body>

</html>