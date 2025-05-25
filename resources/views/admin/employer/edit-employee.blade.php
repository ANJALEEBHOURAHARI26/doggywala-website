@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    button.btn.btn-sm.btn-primary.addEmployeeProfile {
        margin-left: 27px;
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
    <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;">
        @if($roleDetails == 'Worker')
        <a href="{{ route('list-employer') }}" style="text-decoration: none; color: black;">Employer/</a>
        @elseif($roleDetails == 'Supervisor')
        <a href="{{ route('supervisor-list') }}" style="text-decoration: none; color: black;">Employer/</a>
        @elseif($roleDetails == 'ProjectManager')
        <a href="{{ route('projectmanage-list') }}" style="text-decoration: none; color: black;">Employer/</a>
        @elseif($roleDetails == 'Staff')
        <a href="{{ route('staff-list') }}" style="text-decoration: none; color: black;">Employer/</a>
        @endif
        <span style=" color:black !important; font-weight: 600; font-size: 22px;">Edit Employer</span></h1>
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

          <form action="{{route('employer.update',$employer->id)}}" method="POST" enctype="multipart/form-data" id="editEmployeeForm">
            @csrf
            @method('PUT')
             <div class="d-flex align-items-center mb-4">
                    <!-- Profile Image -->
                    <div class="me-3">
                        <img id="profilePreview" 
                            src="{{ asset($employer->profile_image ?? 'default-avatar.png') }}" 
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
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeProfileImage();">
                            Remove Image
                        </button>
                    </div>
                </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="customerName">Full Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="customerName" name="full_name" value="{{$employer->full_name}}" placeholder="Customer Name" style="background-color:#FDF5F6; border-color:#D8405533;">
                @error('full_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <!--<div class="form-group col-md-4">-->
              <!--  <label for="employeeId">Employee ID</label>-->
              <!--  <input type="text" class="form-control" id="employeeId" name="employee_id" value="{{$employer->employee_id}}" placeholder="Emplyee Id" style="background-color:#FDF5F6; border-color:#D8405533;">-->
              <!--</div>-->
              <div class="form-group col-md-4">
                <label for="role_id">Role<span class="text-danger">*</span></label>
                <select id="role_id" name="role_id" class="form-control" style="background-color:#FDF5F6; border-color:#D8405533;">
                  <option selected disabled>Select Role...</option>
                  @foreach($roles as $role)
                  <option value="{{ $role->id }}"
                    @if(isset($employer) && $employer->role_id == $role->id) selected @endif>
                    {{ $role->name }}
                  </option>
                  @endforeach
                </select>
              </div>
                <div class="form-group col-md-4">
                <label for="contactNumber">Contact Number<span class="text-danger">*</span></label>
                <input type="number" class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"  id="contactNumber" name="contact_number" value="{{$employer->contact_number}}" placeholder="Contact Number" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
              
            </div>
            <div class="form-row">
             
              <div class="form-group col-md-4">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="{{$employer->email}}" placeholder="Email" style="background-color:#FDF5F6; border-color:#D8405533;">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="date_of_birth">Date of Birth</label>
                <input type="text" class="form-control datepicker" id="date_of_birth" name="date_of_birth" value="{{ \Carbon\Carbon::parse($employer->date_of_birth)->format('F d Y') }}" placeholder="Date of Birth" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
              <div class="form-group col-md-4">
                <label for="pay_rate">Hourly/Monthly Pay Rate</label>
                <input type="text" class="form-control" id="pay_rate" value="{{$employer->pay_rate}}" name="pay_rate" placeholder="Pay Rate" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="USA" placeholder="Country" style="background-color:#FDF5F6; border-color:#D8405533;" readonly>
              </div>
              <div class="form-group col-md-4">
                <label for="state">State</label>
                <select id="state" name="state" class="form-control select2" style="background-color:#FDF5F6; border-color:#D8405533;">
                  <option selected>Select State...</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="city">City(city/town)</label>
                <select id="city" name="city" class="form-control select2" style="background-color:#FDF5F6; border-color:#D8405533;">
                  <option selected>Select City...</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{$employer->address}}" placeholder="Address" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
              <!--<div class="form-group col-md-4">-->
              <!--  <label for="zipCode" style="display: flex; align-items: center; gap: 8px;">Zip Code <small class="form-text" style="color: #413535; margin: 0; font-weight: 700;">(Zip Code cannot be more than 5 digits.)</small></label>-->
              <!--  <input type="text" class="form-control" id="zipCode" name="zip_code" value="{{$employer->zipCode}}" placeholder="Zip Code" style="background-color:#FDF5F6; border-color:#D8405533;">-->
              <!--</div>-->
              <div class="form-group col-md-4">
                    <label for="zipCode">Zip Code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code"
                        value="{{ $employer->zip_code }}"
                        style="background-color:#FDF5F6; border-color:#D8405533;"
                        maxlength="5" minlength="5" oninput="validateZipCode(this)">
                    <span class="text-danger-error"></span>
                </div>
              <div class="form-group col-md-4">
                <label for="joiningDate">Joining Date</label>
                <input type="text" class="form-control datepicker" id="joining_date" name="joining_date" value="{{ \Carbon\Carbon::parse($employer->joining_date)->format('F d Y') }}" placeholder="Joining Date" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
            </div>
            
            <hr>
            <p>Document Detail</p>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="license_copy">License Copy</label>
                    <input type="file" class="form-control" id="license_copy" name="license_copy"
                        style="background-color:#FDF5F6; border-color:#D8405533;">
                    @if($employer->license_copy)
                        @php
                            $filePath = asset($employer->license_copy);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
                        <div class="mt-2 file-preview-box">
                            <span>{{ basename($employer->license_copy) }}</span>
                    
                            <a href="{{ $filePath }}" download class="btn btn-outline-primary btn-sm" title="Download File">
                                <i class="fas fa-download"></i>
                            </a>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteEmployerFile(event, this, 'license_copy')" data-employer-id="{{ $employer->id }}" title="Delete File">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @else
                    <p class="text-muted">No File Found</p>
                    @endif
                </div>
                
                 <div class="form-group col-md-4">
                <label for="refresher">Initial Certificate</label>
                <input type="file" class="form-control" id="initial_certificate" name="initial_certificate"
                    placeholder="Refresher" style="background-color:#FDF5F6; border-color:#D8405533;">
                
                @if($employer->initial_certificate)
                    <div class="mt-2 file-preview-box">
                        @php
                            $filePath = asset($employer->initial_certificate);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
            
                        <span>{{ basename($employer->initial_certificate) }}</span>
            
                        <!--@if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))-->
                        <!--    <img src="{{ $filePath }}" alt="Refresher" width="100" height="100">-->
                        <!--@endif-->
            
                        <a href="{{ $filePath }}" download class="btn btn-outline-primary btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
            
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="deleteEmployerFile(event, this, 'initial_certificate')"
                            data-employer-id="{{ $employer->id }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @else
                    <p class="text-muted">No File Found</p>
                @endif
            </div>

              <div class="form-group col-md-4">
                <label for="refresher">Refresher</label>
                <input type="file" class="form-control" id="refresher" name="refresher"
                    placeholder="Refresher" style="background-color:#FDF5F6; border-color:#D8405533;">
                
                @if($employer->refresher)
                    <div class="mt-2 file-preview-box">
                        @php
                            $filePath = asset($employer->refresher);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
            
                        <span>{{ basename($employer->refresher) }}</span>
            
                        <a href="{{ $filePath }}" download class="btn btn-outline-primary btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
            
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="deleteEmployerFile(event, this, 'refresher')"
                            data-employer-id="{{ $employer->id }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @else
                    <p class="text-muted">No File Found</p>
                @endif
            </div>


           
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="physical_medical">Physical/Medical</label>
                <input type="file" class="form-control" id="physicalMedical" name="physical_medical" placeholder="Physical Medical" style="background-color:#FDF5F6; border-color:#D8405533;">
                 @if($employer->physical_medical)
                    <div class="mt-2 file-preview-box">
                        @php
                            $filePath = asset($employer->physical_medical);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
            
                        <span>{{ basename($employer->physical_medical) }}</span>
            
                        <a href="{{ $filePath }}" download class="btn btn-outline-primary btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
            
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="deleteEmployerFile(event, this, 'physical_medical')"
                            data-employer-id="{{ $employer->id }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @else
                    <p class="text-muted">No File Found</p>
                @endif
              </div>

              <div class="form-group col-md-4">
                <label for="fit_test">Fit test</label>
                <input type="file" class="form-control" id="fit_test" name="fit_test" placeholder="Fit Test" style="background-color:#FDF5F6; border-color:#D8405533;">
                @if($employer->fit_test)
                    <div class="mt-2 file-preview-box">
                        @php
                            $filePath = asset($employer->fit_test);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
            
                        <span>{{ basename($employer->fit_test) }}</span>
            
                        <a href="{{ $filePath }}" download class="btn btn-outline-primary btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
            
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="deleteEmployerFile(event, this, 'fit_test')"
                            data-employer-id="{{ $employer->id }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @else
                    <p class="text-muted">No File Found</p>
                @endif
              </div>

              <div class="form-group col-md-4">
                <label for="osha_certificate">OSHA Certificate</label>
                <input type="file" class="form-control" id="osha_certificate" name="osha_certificate" placeholder="Osha Certificate" style="background-color:#FDF5F6; border-color:#D8405533;">
                @if($employer->osha_certificate)
                    <div class="mt-2 file-preview-box">
                        @php
                            $filePath = asset($employer->osha_certificate);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
            
                        <span>{{ basename($employer->osha_certificate) }}</span>
            
                        <a href="{{ $filePath }}" download class="btn btn-outline-primary btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
            
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="deleteEmployerFile(event, this, 'osha_certificate')"
                            data-employer-id="{{ $employer->id }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @else
                    <p class="text-muted">No File Found</p>
                @endif
              </div>

            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="miscellaneous">Miscellaneous</label>
                <input type="file" class="form-control" id="miscellaneous" name="miscellaneous" placeholder="Miscellaneous" style="background-color:#FDF5F6; border-color:#D8405533;">
                @if($employer->osha_certificate)
                    <div class="mt-2 file-preview-box">
                        @php
                            $filePath = asset($employer->miscellaneous);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
            
                        <span>{{ basename($employer->miscellaneous) }}</span>
            
                        <a href="{{ $filePath }}" download class="btn btn-outline-primary btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
            
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="deleteEmployerFile(event, this,'miscellaneous')"
                            data-employer-id="{{ $employer->id }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @else
                    <p class="text-muted">No File Found</p>
                @endif
              </div>
              <div class="form-group col-md-4">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{$employer->company_name}}" placeholder="Company Name" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
              <div class="form-group col-md-4">
                <label for="snn">SSN</label>
                <input type="text" class="form-control" id="snn" name="snn" value="{{$employer->snn}}" placeholder="SSN" style="background-color:#FDF5F6; border-color:#D8405533;" maxlength="4">
                <small id="snnError" class="form-text text-danger" style="display: none;">SSN cannot be more than 4 digits.</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="work_history">Work History</label>
                <input type="text" class="form-control" id="work_history" name="work_history" value="{{$employer->work_history}}" placeholder="Work History" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
              <div class="form-group col-md-4">
                <label for="experience">Experience</label>
                <input type="text" class="form-control" id="experience" name="experience" value="{{$employer->experience}}" placeholder="Experience" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
              <div class="form-group col-md-4">
                <label for="staff_specific_fields">Staff Specific Fields</label>
                <input type="text" class="form-control" id="staff_specific_fields" name="staff_specific_fields" value="{{$employer->staff_specific_fields}}" placeholder="Staff Specific Fields" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="department">Departments</label>
                <input type="text" class="form-control" id="department" name="department" value="{{$employer->department}}" placeholder="Departments" style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>

            </div>
            <button type="submit" class="btn btn-danger" style="background-color: #D84055;border-color: #D84055;">Update</button>
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

<script>
    $(document).ready(function() {
        $('#date_of_birth').datepicker({
            dateFormat: 'MM dd yy', 
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2035"
        });

        $('#joining_date').datepicker({
            dateFormat: 'MM dd yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2035"
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        let snnInput = document.getElementById('snn');
        let snnError = document.getElementById('snnError');

        function validateSnn() {
            if (snnInput.value.length > 4) {
                snnError.style.display = 'block'; 
            } else {
                snnError.style.display = 'none';
            }
        }

        snnInput.addEventListener('input', validateSnn);
        validateSnn();
    });
</script>

<script>
   $(document).ready(function() {
        $('#state, #city').select2({
            placeholder: "Search...",
            allowClear: true
        });

        let selectedState = "{{ $employer->state ?? '' }}"; 
        let selectedCity = "{{ $employer->city ?? '' }}";   

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
  
  function previewProfileImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profilePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    
    function removeProfileImage() {
        document.getElementById('profilePreview').src = "{{ asset('default-avatar.png') }}";
        document.getElementById('profileImage').value = "";
    }
    
    
     $.validator.addMethod("allowedEmailDomain", function(value, element) {
        if (this.optional(element)) return true;
    
        const domain = value.split('@')[1];
        if (!domain) return false;
    
        const domainPart = domain.split('.')[0];
        return isNaN(domainPart);
    }, "Email domain cannot be fully numeric (e.g. 454.com is not allowed)");
    $("#editEmployeeForm").validate({
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
    
    
    
</script>
<script>
function deleteEmployerFile(event, button, fieldName) {
    event.preventDefault();

    const employerId = button.getAttribute('data-employer-id');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!employerId || !fieldName) {
        alert("Missing data.");
        return;
    }

    if (confirm("Are you sure you want to delete this file?")) {
        fetch(`/employer/file-delete/${employerId}/${fieldName}`, {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert("File could not be deleted.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
}

</script>
<script>
    function validateZipCode(input) {
        input.value = input.value.replace(/[^0-9]/g, '');

        if (input.value.length > 5) {
            input.value = input.value.slice(0, 5);
        }
    }
</script>