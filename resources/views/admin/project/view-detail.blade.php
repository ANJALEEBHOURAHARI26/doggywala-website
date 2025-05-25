@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
button.btn.btn-sm.btn-outline-danger {
    margin-left: 10px;
}
.text-muted {
    color: #6e707e !important;
}
.error.text-danger {
    color: #5a5c69;
    font-size: 1rem;
    position: relative;
    line-height: 1;
    width: 12.5rem;
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

  .tabs {
    display: flex;
    /*margin-top:1px;*/
    /*margin-left:1px;*/
    margin-bottom: 20px;
    margin: 19px;

  }

  .tab {
    padding: 10px 20px;
    margin: 0 10px;
    border: 2px solid #e45757;
    border-radius: 5px;
    cursor: pointer;

    color: #e45757;
    font-weight: bold;
    transition: background-color 0.3s, color 0.3s;
  }

  .tab.active {
    background-color: #e45757;
    color: white;
  }

  .project-hover:hover {
    color: #fff;
    background-color: #D84055;
    border-color: #D84055;
  }

  .custom-btn {
    color: #3136C1;
    border: 2px solid #3136C1;
    background-color: white;
    padding: 10px 20px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 11px;
  }

  .custom-btn:hover {
    color: #fff;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);
    border: none;
  }

  .custom-btn:focus,
  .custom-btn:active {
    outline: none;
    box-shadow: none;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
    color: #fff;
   
  }

  .detail-prject {
    padding: 8px 16px !important;
  }

  @media (max-width: 575.98px) {
    .custom-btn {
      font-size: 9px !important;
      padding: 8px 16px !important;
    }

    .detail-prject {
      font-size: 9px !important;
      height: 33px;

    }

    .tabs {
      display: flex;
      overflow-x: auto;
      white-space: nowrap;
      padding: 10px;
      max-width: 100%;
      scrollbar-width: thin;
    }

    .tabs::-webkit-scrollbar {
      height: 6px;
    }

    .tabs::-webkit-scrollbar-thumb {
      background-color: #D84055;
      border-radius: 10px;
    }

    .tabs button {
      flex-shrink: 0;
      margin-right: 10px;
    }

  }

  @media (min-width: 576px) and (max-width: 767.98px) {
    .custom-btn {
      font-size: 15px !important;
      padding: 10px 18px !important;
    }
  }

  @media (min-width: 768px) and (max-width: 991.98px) {
    .custom-btn {
      font-size: 16px !important;
      padding: 12px 22px !important;
    }

    .tabs {
      display: flex;
      overflow-x: auto;
      white-space: nowrap;
      padding: 10px;
      max-width: 100%;
      scrollbar-width: thin;
    }

    .tabs::-webkit-scrollbar {
      height: 6px;
    }

    .tabs::-webkit-scrollbar-thumb {
      background-color: #D84055;
      border-radius: 10px;
    }

    .tabs button {
      flex-shrink: 0;
      margin-right: 10px;
    }

  }

  @media (min-width: 992px) and (max-width: 1199.98px) {
    .custom-btn {
      font-size: 18px !important;
      padding: 14px 26px !important;
    }

    .tabs {
      display: flex;
      overflow-x: auto;
      white-space: nowrap;
      padding: 10px;
      max-width: 100%;
      scrollbar-width: thin;
    }

    .tabs::-webkit-scrollbar {
      height: 6px;
    }

    .tabs::-webkit-scrollbar-thumb {
      background-color: #D84055;
      border-radius: 10px;
    }

    .tabs button {
      flex-shrink: 0;
      margin-right: 10px;
    }

  }

  @if(session('selected_case_type')=='Testing') @media (min-width: 1200px) {
    .custom-btn {
      font-size: 12px !important;
      padding: 7px 30px !important;
    }
  }

  @elseif(session('selected_case_type')=='Abatement/Miscellaneous') @media (min-width: 1200px) {
    .custom-btn {
      font-size: 11px !important;
      padding: 7px 22px !important;
    }
  }

  @endif
</style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Projects</a>/
            <a href="{{ route('project-details', ['projectId' => $projectDetails->id]) }}" style="text-decoration: none; color: black; font-size: 22px;">View Details</a>
        </h1>
    </div>


  <div class="row">
    <div class="col-lg-12">
      <!-- Add Customer Form -->
      <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
        @if(session('selected_case_type') == 'Testing' || $projectDetails->case_type == 'Testing')
        <div class="tabs">
          <button class="btn btn-primary detail-prject"
            style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px;padding: 7px 30px !important;">Detail</button>
          <a href="{{route('appointment-project',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Appointment</button></a>
          <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
          <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>
          <a href="{{route('final-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Final Report</button></a>
          <a href="{{route('project-invoice',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Invoice & Payment</button></a>

        </div>
        @elseif(session('selected_case_type') == 'Abatement/Miscellaneous' || $projectDetails->case_type == 'Abatement/Miscellaneous')
        <div class="tabs">
          <button class="btn btn-primary detail-prject"
            style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px;    padding: 7px 30px !important;">Detail</button>
          <a href="{{route('appointment-project',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Appointment</button></a>
          <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
          <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>
          <a href="{{route('final-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Final Report</button></a>
          <!--<a href="{{route('project-invoice',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Invoice & Payment</button></a>-->
          <a href="{{route('sheetlist',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Sheet</button></a>
        </div>
        @endif

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                	<button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                </div>
            @endif
          <form action="{{route('update.project.details',['id'=> $projectDetails->id])}}" method="POST"
            enctype="multipart/form-data" id="updateForm">
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="caseName">Case Name</label>
                <input type="text" class="form-control" id="caseName" name="case_name"
                  value="{{$projectDetails->case_name}}" placeholder="Case Name"
                  style="background-color:#FDF5F6; border-color:#D8405533;">
                  <!--<span id="caseLocation-error" class="error text-danger"></span>-->
              </div>
              <div class="form-group col-md-4">
                <label for="client">Customer<small>(Select from Customer List)<span class="text-danger">*</span></small></label>
                <select id="client" name="client_id" class="form-control select2"
                  style="background-color:#FDF5F6; border-color:#D8405533;">
                  <option selected disabled>Select Customer Name...</option>
                  @foreach($customerList as $customer)
                  <option value="{{ $customer->id }}" {{ $customer->id == $projectDetails->client_id ? 'selected' : ''
                    }}>
                    {{ $customer->name }}
                  </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="caseType">Case Type<span class="text-danger">*</span></label>
                <select id="caseType" name="case_type" class="form-control"
                  style="background-color:#FDF5F6; border-color:#D8405533;">
                    <option selected disabled>Select Case Type...</option>
                  @if($projectDetails->case_type)
                  <option value="{{ $projectDetails->case_type }}" selected>
                    {{ $projectDetails->case_type }}
                  </option>
                  @else
                  <option selected>No Case Type</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="startDate">Case Start Date</label>
                    <input type="text" class="form-control datepicker" id="startDate" name="case_start_date"
                        value="{{ $projectDetails->case_start_date ? \Carbon\Carbon::parse($projectDetails->case_start_date)->format('F d Y') : '' }}"
                        style="background-color:#FDF5F6; border-color:#D8405533;" placeholder="MM-DD-YYYY" readonly> 
                </div>
                
                <div class="form-group col-md-4">
                    <label for="completionDate">Estimated Completion Date</label>
                    <input type="text" class="form-control estimated-completion-date" id="completionDate" name="estimated_completion_date"
                        value="{{ $projectDetails->estimated_completion_date ? \Carbon\Carbon::parse($projectDetails->estimated_completion_date)->format('F d Y') : '' }}"
                        style="background-color:#FDF5F6; border-color:#D8405533;" placeholder="MM-DD-YYYY" readonly>
                </div>

              <div class="form-group col-md-4">
                <label for="caseLocation">Case Location<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="caseLocation" name="case_location"
                  value="{{$projectDetails->case_location}}" placeholder="Case Location"
                  style="background-color:#FDF5F6; border-color:#D8405533;">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="caseStatus">Case Status<span class="text-danger">*</span></label>
                <select id="caseStatus" name="case_status" class="form-control"
                  style="background-color:#FDF5F6; border-color:#D8405533;">
                  <option selected disabled value="">Select Case Status...</option>
                  <option value="Pending" {{ $projectDetails->case_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                  <option value="In Progress" {{ $projectDetails->case_status == 'In Progress' ? 'selected' : '' }}>In
                    Progress</option>
                  <option value="Complete" {{ $projectDetails->case_status == 'Complete' ? 'selected' : ''
                    }}>Completed</option>
                </select>
              </div>

                <div class="form-group col-md-4">
                    <label for="employee">Supervisor / Project Manager<span class="text-danger">*</span></label>
                    <select id="employee" name="employee_id" class="form-control select2"
                        style="background-color:#FDF5F6; border-color:#D8405533;">
                        <option selected disabled>Select Employee...</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" 
                                {{ $projectDetails->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="description">Case Description</label>
                    <textarea class="form-control" id="description" name="case_description" rows="2"
                      placeholder="Case Description"
                      style="background-color:#FDF5F6; border-color:#D8405533;">{!! $projectDetails->case_description !!}</textarea>
                </div>
                
   {{-- Attachment --}}
<div class="form-group col-md-4">
    <label for="caseLocation">Attachment
        <span class="text-muted">(Upload multiple files – multiple selection allowed)</span>
    </label>
    <input type="file" class="form-control" name="attachment[]" multiple style="background-color:#FDF5F6; border-color:#D8405533;">
    
    @php
        $attachments = json_decode($projectDetails->attachment, true) ?? [];
    @endphp

    @if(count($attachments))
        <ul class="list-group mt-2">
            @foreach($attachments as $file)
                @php
                    $filePath = asset($file);
                    $fileName = basename($file); // full name with extension
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span style="overflow:hidden; text-overflow:ellipsis; white-space:normal; word-wrap:break-word; max-width:250px;">
                        {{ $fileName }}
                    </span>
                    <div class="d-flex align-items-center">
                        <a href="{{ $filePath }}" download class="btn btn-sm btn-outline-primary me-2" title="Download {{ $fileName }}">
                            <i class="fas fa-download"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteFile('{{ $file }}', '{{ $projectDetails->id }}', 'attachment')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted mt-2">No File Found</p>
    @endif
</div>

{{-- Additional Document --}}
<div class="form-group col-md-4">
    <label for="caseLocation">Additional Document
        <span class="text-muted">(Upload multiple files – multiple selection allowed)</span>
    </label>
    <input type="file" class="form-control" name="additional_document[]" multiple style="background-color:#FDF5F6; border-color:#D8405533;">
    
    @php
        $additionalDocs = json_decode($projectDetails->additional_document, true) ?? [];
    @endphp

    @if(count($additionalDocs))
        <ul class="list-group mt-2">
            @foreach($additionalDocs as $file)
                @php
                    $filePath = asset($file);
                    $fileName = basename($file); // full name with extension
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span style="overflow:hidden; text-overflow:ellipsis; white-space:normal; word-wrap:break-word; max-width:250px;">
                        {{ $fileName }}
                    </span>
                    <div class="d-flex align-items-center">
                        <a href="{{ $filePath }}" download class="btn btn-sm btn-outline-primary me-2" title="Download {{ $fileName }}">
                            <i class="fas fa-download"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteFile('{{ $file }}', '{{ $projectDetails->id }}', 'additional_document')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted mt-2">No File Found</p>
    @endif
</div>


            </div>
            <div class="text-center mt-3">
              <button type="submit" class="btn btn-danger" id="updateBtn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">Update</button>
            </div>
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

@include('layouts.footer')
<!-- jQuery, jQuery UI & Select2 CSS/JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        // $('#startDate').datepicker({
        //     dateFormat: 'MM dd yy',
        //     changeMonth: true,
        //     changeYear: true
        // });
        var startDate = document.getElementById("completionDate").value;
        console.log(startDate);
        $("#startDate").datepicker({
            dateFormat: "MM dd yy",  
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2100",
            minDate: 0
        });
         
        // $(".estimated-completion-date").datepicker({
        //     dateFormat: startDate,  
        //     changeMonth: true,
        //     changeYear: true,
        //     yearRange: "1900:2100",
        //     minDate: 0
        // });
    
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
    //   var startDate = document.getElementById("startDate").value;
    //   console.log(startDate); // result April 26 2025 date 
        
        // $(".estimated-completion-date").datepicker({
        //     dateFormat: 'MM dd yy',
        //     changeMonth: true,
        //     changeYear: true,
        //     yearRange: "1900:2100",
        //     minDate: 0  
        // });
        
    //     if (startDate) {
    //     $("#startDate").datepicker("setDate", new Date(startDate));
    // }

    //     $('#completionDate').datepicker({
    //         dateFormat: 'MM dd yy',
    //         changeMonth: true,
    //         changeYear: true
    //     });

        $('.select2').select2({
            placeholder: "Choose a Customer",
            allowClear: true
        });

        $("#updateForm").validate({
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
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                const updateBtn = document.getElementById("updateBtn");
                if (updateBtn) {
                    updateBtn.disabled = true;
                    updateBtn.innerText = 'Processing...';
                }
                form.submit();
            }
        });
    });

    function deleteFile(file, projectId, column) {
        if (confirm("Are you sure to delete this file?")) {
            fetch("{{ route('attachment.delete') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    file: file,
                    project_id: projectId,
                    column: column
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Failed to delete file.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Something went wrong.");
            });
        }
    }
</script>


