@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
<style>
  button.btn.btn-sm.btn-primary.addEmployeeProfile {
    margin-left: 27px;
}
      
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

.text-danger-error {
    color: #fc544b !important;
    font-size: 0.9rem;
}



 </style>  
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Employer/<span style=" color:black !important; font-weight: 600; font-size: 22px;">Add Employer</span></h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{url('store-employer')}}" method="POST" enctype="multipart/form-data" id="employerForm">
                          @csrf
                           <div class="d-flex align-items-center mb-4">
                                <!-- Profile Image -->
                                <div class="me-3">
                                    <img id="profilePreview" src="{{ asset('default-avatar.png') }}" 
                                        alt="Profile Image" class="rounded-circle" width="120" height="120"
                                        style="border: 2px solid #D84055;">
                                </div>
                                <!-- Buttons -->
                                <div>
                                    <input type="file" id="profileImage" name="profile_image" class="d-none" accept="image/*" 
                                        onchange="previewProfileImage(event)">
                                    <button type="button" class="btn btn-sm btn-primary addEmployeeProfile" onclick="document.getElementById('profileImage').click();">
                                        Upload Image
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger removeEmployeeProfile" onclick="removeProfileImage();">
                                        Remove Image
                                    </button>
                                </div>
                            </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="customerName">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customerName" name="full_name" value="{{ old('full_name') }}" placeholder="Employer Name" style="background-color:#FDF5F6; border-color:#D8405533;" >
                                <span class="text-danger-error"></span>
                                <!--@error('full_name')-->
                                <!--    <div class="text-danger">{{ $message }}</div>-->
                                <!--@enderror-->
                            </div>
                        
                          <!--<div class="form-group col-md-4">-->
                          <!--  <label for="employeeId">Employer ID<span class="text-danger">*</span></label>-->
                          <!--  <input type="text" class="form-control" id="employeeId" name="employee_id" value="{{ old('employee_id') }}" placeholder="Employer Id" style="background-color:#FDF5F6; border-color:#D8405533;">-->
                          <!--   @error('employee_id')-->
                          <!--      <div class="text-danger">{{ $message }}</div>-->
                          <!--  @enderror-->
                          <!--</div>-->
                         
                        <div class="form-group col-md-4">
                            <label for="role_id">Role<span class="text-danger">*</span></label>
                            <select id="role_id" name="role_id" value="{{ old('role_id') }}" class="form-control" style="background-color:#FDF5F6; border-color:#D8405533;">
                                <option selected disabled>Select Role...</option>
                                @foreach($roles as $role)
                                   <option value="{{$role->id}}" data-role-name="{{$role->name}}">{{$role->name}}</option> 
                                @endforeach
                            </select>
                             @error('role_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                           <div class="form-group col-md-4">
                            <label for="contactNumber">Contact Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="10" minlength="10"  oninput="validatePhone(this)"  id="contactNumber" name="contact_number" value="{{ old('contact_number') }}" placeholder="Contact Number" style="background-color:#FDF5F6; border-color:#D8405533;">
                            <span id="phoneError" class="text-danger"></span>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-4"> 
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"  placeholder="Email" style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span id="emailError" class="text-danger"></span>
                            </div>

                          <div class="form-group col-md-4">
                            <label for="date_of_birth">Date of Birth</label>
                           <input type="text" class="form-control date-picker" id="date_of_birth" name="date_of_birth" placeholder="MM-DD-YYYY" style="background-color:#FDF5F6; border-color:#D8405533;" readonly>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="pay_rate">Hourly/Monthly Pay Rate</label>
                            <input type="number" class="form-control" id="pay_rate" name="pay_rate" placeholder="Pay Rate" style="background-color:#FDF5F6; border-color:#D8405533;">
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="USA" placeholder="Country" style="background-color:#FDF5F6; border-color:#D8405533;" readonly>
                             </div>
                             <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <select id="state" name="state" class="form-control" style="background-color:#FDF5F6; border-color:#D8405533;">
                              <option selected>Select State...</option>
                            </select>
                          </div>
                            <div class="form-group col-md-4">
                            <label for="city">City(city/town)</label>
                            <select id="city" name="city" class="form-control" style="background-color:#FDF5F6; border-color:#D8405533;">
                              <option selected>Select City...</option>
                            </select>
                          </div>
                            <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" style="background-color:#FDF5F6; border-color:#D8405533;"> 
                            </div>
                            
                            <!--<div class="form-group col-md-4">-->
                            <!--    <label for="zipCode" style="display: flex; align-items: center; gap: 8px;">-->
                            <!--        Zip Code-->
                            <!--        <small class="form-text" style="color: #413535; margin: 0; font-weight: 700;">(Zip Code cannot be more than 5 digits.)</small>-->
                            <!--    </label>-->
                            <!--    <input type="number" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code" -->
                            <!--        style="background-color:#FDF5F6; border-color:#D8405533;" -->
                            <!--        oninput="limitZipLength(this)">-->
                            <!--</div>-->
                            <div class="form-group col-md-4">
                                <label for="zipCode">Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code"
                                    value="{{ old('zip_code') }}"
                                    style="background-color:#FDF5F6; border-color:#D8405533;"
                                    maxlength="5" minlength="5" oninput="validateZipCode(this)">
                                <span class="text-danger-error"></span>
                            </div>
                           <div class="form-group col-md-4">
                            <label for="joiningDate">Joining Date</label>
                            <input type="text" class="form-control date-picker" id="joining_date" name="joining_date" placeholder="MM-DD-YYYY" style="background-color:#FDF5F6; border-color:#D8405533;" readonly>
                          </div>
                        </div>
                       
                        <hr>
                        <p>Document Detail</p>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="license_copy">License Copy</label>
                                <input type="file" class="form-control" id="license_copy" name="license_copy" placeholder="License Copy" style="background-color:#FDF5F6; border-color:#D8405533;">
                            </div>
                        
                            <div class="form-group col-md-4">
                                <label for="initial_certificate">Initial Certificate</label>
                                <input type="file" class="form-control" id="initialCertificate" name="initial_certificate" placeholder="Initial Certificate" style="background-color:#FDF5F6; border-color:#D8405533;">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="refresher">Refresher</label>
                                <input type="file" class="form-control" id="refresher" name="refresher" placeholder="Refresher" style="background-color:#FDF5F6; border-color:#D8405533;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="physical_medical">Physical/Medical</label>
                                <input type="file" class="form-control" id="physicalMedical" name="physical_medical" placeholder="Physical Medical" style="background-color:#FDF5F6; border-color:#D8405533;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fit_test">Fit test</label>
                                <input type="file" class="form-control" id="fit_test" name="fit_test" placeholder="Fit Test" style="background-color:#FDF5F6; border-color:#D8405533;">
                            </div>
                         
                            <div class="form-group col-md-4">
                            <label for="osha_certificate">OSHA Certificate</label>
                            <input type="file" class="form-control" id="osha_certificate" name="osha_certificate" placeholder="Osha Certificate" style="background-color:#FDF5F6; border-color:#D8405533;">
                           
                          </div>
                        
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="miscellaneous">Miscellaneous</label>
                            <input type="file" class="form-control" id="miscellaneous" name="miscellaneous" placeholder="Miscellaneous" style="background-color:#FDF5F6; border-color:#D8405533;">
                            
                          </div>
                          <div class="form-group col-md-4">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" style="background-color:#FDF5F6; border-color:#D8405533;">
                          </div>
                        <div class="form-group col-md-4">
                             <label for="ssn" style="display: flex; align-items: center; gap: 8px;">SSN <small class="form-text" style="color: #413535; margin: 0; font-weight: 700;">(SSN cannot be more than 4 digits.)</small></label>
                            <input type="number" class="form-control" id="snn" name="snn" placeholder="SSN" style="background-color:#FDF5F6; border-color:#D8405533;" oninput="limitSSNLength(this)">
                            <small id="snnError" class="form-text text-danger" style="display: none;">SSN cannot be more than 4 digits.</small>
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="work_history">Work History</label>
                            <input type="text" class="form-control" id="work_history" name="work_history" placeholder="Work History" style="background-color:#FDF5F6; border-color:#D8405533;">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="experience">Experience</label>
                            <input type="text" class="form-control" id="experience" name="experience" placeholder="Experience" style="background-color:#FDF5F6; border-color:#D8405533;">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="staff_specific_fields">Staff Specific Fields</label>
                            <input type="text" class="form-control" id="staff_specific_fields" name="staff_specific_fields" placeholder="Staff Specific Fields" style="background-color:#FDF5F6; border-color:#D8405533;">
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="department">Departments</label>
                            <input type="text" class="form-control" id="department" name="department" placeholder="Departments" style="background-color:#FDF5F6; border-color:#D8405533;">
                        </div>
                        <div class="form-group col-md-4" id="password-field">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" class="form-control" style="background-color:#FDF5F6; border-color:#D8405533;">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" style="background-color:#FDF5F6; border-color:#D8405533;">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        </div>
                        <button type="submit" class="btn btn-danger" id="submitBtn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">
                            <span id="buttonText">Create</span>
                            <span id="buttonLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    
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

 <!-- Required Libraries -->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/js/ruang-admin.min.js')}}"></script>

<!-- jQuery and Plugins -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI (Datepicker) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<!-- Form Validation Script -->
<script>
$(document).ready(function () {
    // Initialize Select2
    $('#state, #city').select2({
        dropdownParent: $('#state').parent(),
        width: '100%'
    });

    // Fetch States and Cities (AJAX)
    fetchStates();

    $('#state').on('change', function () {
        let state = $(this).val();
        $('#city').html('<option selected disabled>Loading...</option>');
        if (state) {
            fetchCities(state);
        } else {
            $('#city').html('<option selected disabled>Select City...</option>');
        }
    });

    function fetchStates() {
        $.ajax({
            url: '/states',
            method: 'GET',
            dataType: 'json',
            success: function (states) {
                if (!Array.isArray(states)) return;
                let options = '<option selected disabled>Select State...</option>';
                states.forEach(state => options += `<option value="${state}">${state}</option>`);
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
                if (!Array.isArray(cities)) return;
                let options = '<option selected disabled>Select City...</option>';
                cities.forEach(city => options += `<option value="${city}">${city}</option>`);
                $('#city').html(options);
            },
            error: function () {
                alert('Error fetching cities!');
            }
        });
    }

    // jQuery UI Datepicker
    $(".date-picker").datepicker({
        dateFormat: "MM dd yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2035"
    });

    $("#employerForm").on("submit", function () {
        $(".date-picker").each(function () {
            let input = $(this);
            let parts = input.val().split("-");
            if (parts.length === 3) {
                input.val(parts[2] + "-" + parts[0] + "-" + parts[1]);
            }
        });
    });

    // Profile Image Preview
    window.previewProfileImage = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            $('#profilePreview').attr('src', reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    window.removeProfileImage = function () {
        $('#profilePreview').attr('src', "{{ asset('default-avatar.png') }}");
        $('#profileImage').val("");
    };

    // Role-dependent password visibility
    $("#role_id").on("change", function () {
        let selectedOption = $("#role_id option:selected").text().toLowerCase();
        if (selectedOption === "worker") {
            $("#password-field").hide();
            $("#password_confirmation").parent().hide();
        } else {
            $("#password-field").show();
            $("#password_confirmation").parent().show();
        }
    });

    // Disable submit button and show loader on submit
    // $("form").on("submit", function () {
    //     $("#submitBtn").prop("disabled", true);
    //     $("#buttonText").text("Processing...");
    //     $("#buttonLoader").removeClass("d-none");
    // });
    
    window.validatePhone = function (input) {
            let phone = input.value.replace(/\D/g, '');
            input.value = phone.slice(0, 10);
            const error = document.getElementById("contactNumber");
            error.textContent = phone.length < 10 ? "" : "";
        };
    

        
    $.validator.addMethod("allowedEmailDomain", function(value, element) {
        if (this.optional(element)) return true;
    
        const domain = value.split('@')[1];
        // Agar domain undefined ya empty ho, to invalid
        if (!domain) return false;
    
        // Check: domain should not be purely numeric before any dot
        const domainPart = domain.split('.')[0];
        return isNaN(domainPart);
    }, "Email domain cannot be fully numeric (e.g. 454.com is not allowed)");
    $("#employerForm").validate({
        rules: {
            full_name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                allowedEmailDomain: true
            },
            role_id: {
                required: true
            },
            snn: {
                digits: true,
                maxlength: 4
            },
            contact_number: { required: true, digits: true, minlength: 10, maxlength: 10 },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            full_name:{
                    required: "Please enter the Employer name",
                    minlength: "Employer name must be at least 3 characters long"
                },
            email:  {
                    required: "Please enter an email address",
                    email: "Please enter a valid email format (e.g. user@mail.com)",
                    allowedEmailDomain: "Only valid domains are allowed (e.g. gmail, yahoo, outlook, etc.)"
                },
            role_id: "Select a role",
            snn: {
                digits: "SNN must be numeric",
                maxlength: "Max 4 digits"
            },
            contact_number: {
                required: "Enter contact number",
                digits: "Only numbers allowed",
                minlength: "Please enter a valid 10-digit mobile number",
                maxlength: "Please enter a valid 10-digit mobile number"
            },
            password: {
                required: "Password is required",
                minlength: "Minimum 6 characters"
            },
            password_confirmation: {
                required: "Please confirm password",
                equalTo: "Passwords do not match"
            }
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