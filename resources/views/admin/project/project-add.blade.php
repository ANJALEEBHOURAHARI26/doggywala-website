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
</style>  
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Project/</a>
            <span style="color:black !important; font-weight: 600; font-size: 22px;">Add Case</span>
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-body">
                    <form action="{{route('store-Project')}}" method="POST" id="projectCreateForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="caseName">Case Name</label>
                                <input type="text" class="form-control" id="caseName" name="case_name" value="{{ old('case_name') }}" placeholder="Case Name" style="background-color:#FDF5F6; border-color:#D8405533;">
                                 
                            </div>

                            <div class="form-group col-md-4">
                                <label for="case_id">Case ID/Job Number</label>
                                <input type="text" class="form-control" id="case_id" name="case_id" value="{{ old('case_id') }}"  placeholder="Case Id" readonly style="background-color:#FDF5F6; border-color:#D8405533;">
                                @error('case_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="client" style="margin-left:-10px;">
                                    Customer Name <small>(Select from Customer List)</small>
                                    <span class="text-danger">*</span>
                                    <a href="{{ route('add-customer') }}" class="text-primary ml-2" title="Add New Customer">
                                        <i class="fa fa-plus-circle fa-lg"></i>
                                    </a>
                                </label>
                            
                                <select id="client" name="customer_name" class="form-control select2" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option value="" selected hidden></option>
                                    @foreach($customerDetail as $customer) 
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->name }}-({{ $customer->phone_number }})
                                        </option>
                                    @endforeach
                                </select>
                            
                                @error('customer_name') 
                                    <div class="text-danger">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="startDate">Case Start Date</label>
                                <input type="text" class="form-control date-picker" value="{{ old('case_start_date') }}" id="startDate" name="case_start_date" placeholder="MM-DD-YYYY" readonly>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="completionDate">Estimated Completion Date</label>
                                <input type="text" class="form-control estimated-completion-date" id="completionDate" value="{{ old('estimated_completion_date') }}" name="estimated_completion_date" placeholder="MM-DD-YYYY" readonly>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="caseLocation">Case Location<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="caseLocation" name="case_location" value="{{ old('case_location') }}" placeholder="Case Location" style="background-color:#FDF5F6; border-color:#D8405533;">
                                @error('case_location') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="caseStatus">Case Status<span class="text-danger">*</span></label>
                                <select id="caseStatus" name="case_status" class="form-control" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option selected disabled value="">select Case Status...</option>
                                    <option value="Pending" {{ old('case_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ old('case_status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Complete" {{ old('case_status') == 'Complete' ? 'selected' : '' }}>Complete</option>
                                </select>
                                @error('case_status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                              
                            <div class="form-group col-md-4">
                                <label for="caseType">Case Type<span class="text-danger">*</span></label>
                                <select id="caseType" name="case_type" class="form-control" style="background-color:#FDF5F6; border-color:#D8405533;">
                                  <option selected disabled>Select Case Type...</option>
                                  <option value="Testing" {{ old('case_type') == 'Testing' ? 'selected' : '' }}>Testing</option>
                                  <option value="Abatement/Miscellaneous" {{ old('case_type') == 'Abatement/Miscellaneous' ? 'selected' : '' }}>Abatement/Miscellaneous</option>
                                </select>
                                @error('case_type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="supervisor">Supervisor/Project Manager
                                <span class="text-danger">*</span>
                                    <a href="{{ route('add-employer') }}" class="text-primary ml-2" title="Add New Supervisor/Project Manager">
                                        <i class="fa fa-plus-circle fa-lg"></i>
                                    </a>
                                </label>
                        
                                <select id="supervisor" name="employer_name" class="form-control select2" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option selected disabled>Select Employee...</option>
                                </select>
                                @error('employer_name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Case Description</label>
                            <textarea class="form-control" id="description"  value="{{ old('case_description') }}" name="case_description" rows="2" placeholder="Case Description" style="background-color:#FDF5F6; border-color:#D8405533;"></textarea>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" id="submitBtn" class="btn btn-danger" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
 </div>
    @include('layouts.footer')

   <!-- jQuery aur jQuery UI (Datepicker ke liye) -->
<!-- Required Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
$(document).ready(function () {
    $('.select2').select2({
        placeholder: "Choose a Customer",
        allowClear: true
    });

       $("#startDate").datepicker({
        dateFormat: "MM dd yy",  
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2100",
        minDate: 0
    });

     
    $(".estimated-completion-date").datepicker({
        dateFormat: "MM dd yy",  
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2100"
    });

    // On change of start date
    $("#startDate").on("change", function () {
        let startDateValue = $(this).val();
        console.log("Start Date (raw):", startDateValue);

        let parsedDate = new Date(startDateValue);

        if (parsedDate.toString() !== "Invalid Date") {
            $(".estimated-completion-date").datepicker("destroy");
            $(".estimated-completion-date").datepicker({
                dateFormat: "MM dd yy",  
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2100",
                minDate: parsedDate
            });

            
            $(".estimated-completion-date").datepicker("setDate", parsedDate);
        } else {
            console.error("Invalid date format:", startDateValue);
        }
    });

    fetch("/generate-case-id")
        .then(response => response.json())
        .then(data => {
            let caseIdField = document.getElementById("case_id");
            if (caseIdField) {
                caseIdField.value = data.case_id;
            }
        })
        .catch(error => console.error("Error generating Case ID:", error));

    $('#caseType').change(function () {
        let caseType = $(this).val();
        let supervisorSelect = $('#supervisor');

        supervisorSelect.html('<option selected disabled>Select Employee...</option>');

        $.ajax({
            url: "{{ url('/get-customers') }}",
            type: "GET",
            data: { case_type: caseType },
            dataType: "json",
            success: function (data) {
                if (data.length > 0) {
                    $.each(data, function (index, customer) {
                        supervisorSelect.append(`<option value="${customer.id}">${customer.full_name}</option>`);
                    });
                } else {
                    supervisorSelect.append('<option disabled>No employee found</option>');
                }
            },
            error: function () {
                alert("Error fetching employee!");
            }
        });
    });

    $("#projectCreateForm").validate({
        rules: { 
            customer_name: {
                required: true
            },
            case_location: {
                required: true
            },
            case_status: {
                required: true
            },
            case_type: {
                required: true
            },
            employer_name: {
                required: true
            }
        },
        messages: { 
            customer_name: {
                required: "Please select a customer"
            },
            case_location: {
                required: "Please enter case location"
            },
            case_status: {
                required: "Please select case status"
            },
            case_type: {
                required: "Please select case type"
            },
            employer_name: {
                required: "Please select supervisor"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("select2-hidden-accessible")) {
                error.insertAfter(element.next('span.select2'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $(".date-picker").each(function () {
                let input = $(this);
                let parts = input.val().split("-");
                if (parts.length === 3) {
                    input.val(parts[2] + "-" + parts[0] + "-" + parts[1]);
                }
            });

            var submitBtn = document.getElementById("submitBtn");
            if (submitBtn) {
                submitBtn.innerHTML = 'Processing...';
                submitBtn.disabled = true;
            }

            form.submit(); 
        }
    });

    $('#client, #caseStatus, #caseType, #supervisor').on('change', function () {
        $(this).valid();
    });
});
</script>
