@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
.custom-table thead.thead-light th {
    /*background-color: #D84055 !important;*/
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%) !important; border: none;
    color: white !important;
    font-weight: bold;
}
/* Modal Customizations */
.custom-modal {
    border-radius: 8px;
    overflow: hidden;
}

.custom-modal-header {
    /*background-color: #D84055;*/
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
    color: #fff;
    font-weight: bold;
}

.custom-modal-header .close {
    color: #fff;
    opacity: 1;
    font-size: 24px;
}

.custom-input {
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    padding: 12px;
    font-size: 16px;
    background-color: #fdeeee;
    color: #333;
}

.custom-input::placeholder {
    color: #999;
}

.custom-btn {
    background-color: #D84055;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
}

.custom-btn:hover {
    background-color: #b83244;
}

   .tabs {
            display: flex;
            /*margin-top:1px;*/
            /*margin-left:1px;*/
            margin-bottom: 20px;
            margin:19px;
        
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
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        .custom-table th, .custom-table td {
            border: 1px solid #3136C1;
            padding: 12px;
            text-align: left;
        }

        .custom-table th {
            background-color: #D84055;
            color: white;
            font-weight: bold;
        }

        .custom-table td {
            color: #333;
        }

        .action-icons {
            display: flex;
            gap: 8px;
        }

        .action-icons a {
            text-decoration: none;
            font-size: 16px;
            padding: 5px 8px;
            border-radius: 4px;
            color: white;
        }

      

        .delete-btn {
            background-color: #dc3545;
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

    td{
        border-right-width: 0px;
    }
/* Hover Effect */
.custom-btn:hover {
    color: #fff;
    /*background-color: #D84055;*/
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;

}

/* Prevent default blue color on click */
  .custom-btn:focus,
  .custom-btn:active {
    outline: none;
    box-shadow: none;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
    color: #fff;
   
  }
.detail-prject{
    padding: 8px 16px !important;
}
/* Extra small devices (phones, less than 576px) */
@media (max-width: 575.98px) {
     .custom-btn {
        font-size: 9px !important;
        padding: 8px 16px !important;
    }
    .detail-prject{
         font-size: 9px !important;
         /*padding: 8px 16px !important;*/
                 height: 33px;

    }
    .tabs {
    display: flex;
    overflow-x: auto; /* Horizontal scroll enable karega */
    white-space: nowrap; /* Buttons ek line me rahenge */
    padding: 10px;
    max-width: 100%; /* Card ke andar fit hoga */
    scrollbar-width: thin; /* Firefox ke liye scrollbar thin karega */
}

/* Webkit browsers (Chrome, Edge, Safari) ke liye scrollbar styling */
.tabs::-webkit-scrollbar {
    height: 6px;
}

.tabs::-webkit-scrollbar-thumb {
    background-color: #D84055;
    border-radius: 10px;
}

.tabs button {
    flex-shrink: 0; /* Buttons scroll hone par collapse nahi honge */
    margin-right: 10px;
}
}

/* Small devices (phones, 576px and up) */
@media (min-width: 576px) and (max-width: 767.98px) {
    .custom-btn {
        font-size: 15px !important;
        padding: 10px 18px !important;
    }
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991.98px) {
    .custom-btn {
        font-size: 16px !important;
        padding: 12px 22px !important;
    }
     .tabs {
    display: flex;
    overflow-x: auto; /* Horizontal scroll enable karega */
    white-space: nowrap; /* Buttons ek line me rahenge */
    padding: 10px;
    max-width: 100%; /* Card ke andar fit hoga */
    scrollbar-width: thin; /* Firefox ke liye scrollbar thin karega */
}

/* Webkit browsers (Chrome, Edge, Safari) ke liye scrollbar styling */
.tabs::-webkit-scrollbar {
    height: 6px;
}

.tabs::-webkit-scrollbar-thumb {
    background-color: #D84055;
    border-radius: 10px;
}

.tabs button {
    flex-shrink: 0; /* Buttons scroll hone par collapse nahi honge */
    margin-right: 10px;
}
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) and (max-width: 1199.98px) {
    .custom-btn {
        font-size: 18px !important;
        padding: 14px 26px !important;
    }
     .tabs {
    display: flex;
    overflow-x: auto; /* Horizontal scroll enable karega */
    white-space: nowrap; /* Buttons ek line me rahenge */
    padding: 10px;
    max-width: 100%; /* Card ke andar fit hoga */
    scrollbar-width: thin; /* Firefox ke liye scrollbar thin karega */
}

/* Webkit browsers (Chrome, Edge, Safari) ke liye scrollbar styling */
.tabs::-webkit-scrollbar {
    height: 6px;
}

.tabs::-webkit-scrollbar-thumb {
    background-color: #D84055;
    border-radius: 10px;
}

.tabs button {
    flex-shrink: 0; /* Buttons scroll hone par collapse nahi honge */
    margin-right: 10px;
}
}



/* Extra large devices (large desktops, 1200px and up) */
@if(session('selected_case_type') == 'Testing')
        @media (min-width: 1200px) {
            .custom-btn {
                font-size: 12px !important;
                padding: 7px 30px !important;
            }
        }
    @elseif(session('selected_case_type') == 'Abatement/Miscellaneous')
        @media (min-width: 1200px) {
             .custom-btn {
      font-size: 11px !important;
      padding: 7px 22px !important;
    }
        }
    @endif

    </style>    
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
            <h1 class="h3 mb-0 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
                <a style="text-decoration: none; color: black;">Estimation</a>   
            </h1>
            <button class="btn btn-primary" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;" data-toggle="modal" data-target="#addEstimationModal">
                + Add Estimation
            </button>
        </div> 
        <!-- Row -->
        <div class="row scroller-hide">
            <!-- Datatables -->
            <div class="col-lg-12">
                
                  <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;"> 
                      @if(session('selected_case_type') == 'Testing')
                  <div class="tabs"> 
                       <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;padding: 7px 30px !important;" >Estimation</button>
                  
                </div>
                  @elseif(session('selected_case_type') == 'Abatement/Miscellaneous')
                  <div class="tabs"> 
                       <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;padding: 7px 30px !important;" >Estimation</button>
                  
                </div>
                @endif  
                 
                @include('admin.customer.create-estimation')
              @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('message') }}
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
                <div class="table-responsive p-3" style="overflow-x:auto;">
              
                  <table class="table align-items-center table-flush custom-table display nowrap" id="dataTable" style="width:100%">
                    <thead class="thead-light">
                      <tr>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Title</th>
                        <th>Assign Case</th>
                        <th>Remark</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                </div>
              </div>
            </div>
            <!-- DataTable with Hover -->
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
<!-- Modal Structure -->
<!-- Modal for Assigning Case -->
<!--<div class="modal fade" id="detailPopup" tabindex="-1" role="dialog" aria-labelledby="detailPopupLabel" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--        <form id="edit-supplier-form">-->
<!--              <div class="modal-header">-->
<!--                <h5 class="modal-title" id="detailPopupLabel">Assign Case</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                  <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--              </div>-->
<!--              <div class="modal-body">-->
                <!-- Case ID Dropdown -->
<!--                <div class="form-group col-md-12">-->
<!--                  <label for="customer">Select Case</label>-->
<!--                  <select class="form-control" id="case_id" name="case_id">-->
<!--                    <option selected disabled value="">Select Case</option>-->
<!--                    @foreach ($projectDetails as $l)-->
<!--                      <option value="{{ $l->id }}">{{ $l->case_id }}</option>-->
<!--                    @endforeach-->
<!--                  </select>-->
<!--                </div> -->
                
<!--                <input type="hidden" id="estimation_id" name="estimation_id">-->
        
                <!-- Submit Button -->
<!--                <button type="button" id="submitCase" class="btn btn-primary">Assign Case</button>-->
<!--              </div>-->
<!--            </div>-->
<!--        </form>-->
<!--  </div>-->
<!--</div> -->

<div id="detailPopup" class="modal fade class="modal fade show"" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-supplier-form" method="POST"> 
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="addAppointmentModalLabel">Assign Case</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                    <div class="form-group col-md-12"> 
                  <label for="customer">Select Case</label><span class="text-danger"> *</span>
                  <select class="form-control commom-select" id="case_id" name="case_id" data-live-search="true" required>
                    <option selected disabled value="">Select Case</option>
                     
                  </select>
                </div> 
                 
                <input type="hidden" id="estimation_id" name="estimation_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;">Assign Case</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

     @include('layouts.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI (For Datepicker) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Select CSS -->
 <!--<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>-->
 <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
 
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
 
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>-->
<!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->
 
<script src="{{asset('assets/bootstrap-selectpicker/bootstrap-select.min.js')}}"></script>
<link href="{{asset('assets/bootstrap-selectpicker/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<!-- Correct CSS link with rel --> 
 
 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


 
<script>
$(document).ready(function () {
    $(".date-picker").datepicker({
        dateFormat: "MM dd yy",
        changeMonth: true,
        changeYear: true,
    });
});
</script>
<script>
  $(document).ready(function () {
    $(".edit-btn").click(function () {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var description = $(this).data('description');
        var remark = $(this).data('remark');
        var estimation_date = $(this).data('estimation-date');
        $("#edit_estimation_id").val(id);
        $("#edit_title").val(title);
        $("#edit_remark").val(remark);
        $("#edit_estimation_date").val(estimation_date); 

        if (CKEDITOR.instances['edit_description']) {
            CKEDITOR.instances['edit_description'].setData(description);
        }
    });
});

</script>
<script>
    function deleteEstimation(estimationId) {
        if (confirm('Are you sure you want to delete this estimation?')) {
            $.ajax({
                url: `/delete-estimation-second/${estimationId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert(response.message); 
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    }
</script>

<script>
$(document).ready(function () {
    $('#dataTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "{{ route('ajax.estimations.second') }}",
         scrollX: true,  
         order: [[7, 'desc']],  
        columns: [
            { data: 'date' },
            { data: 'customer' },
            { data: 'email' },
            { data: 'contact' },
            { data: 'title' },
            { data: 'assign' },
            { data: 'remark' },
            {
                data: 'id',
                render: function (data, type, row) {
                    return `
                        <a href="/view-estimation-second/${data}" title="View">
                            <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View">
                        </a>
                        
                        <a href="/edit-estimation-second/${data}" title="Edit">
                            <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">
                        </a>
                        
                        <a onclick="deleteEstimation(${data})" title="Delete">
                            <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                        </a>  
                       <button style="padding-left: .45rem !important;padding-right: .45rem !important;" class="btn btn-info btn-sm py-0 px-1" onclick="assignSupplier(${data})">
                          Assign
                        </button>
                    `;
                },
                orderable: false,
                searchable: false
            }
        ]
    });
});

	function assignSupplier(id) { 
	    
        $('#estimation_id').val(id);
        $('#detailPopup').modal('show');
        // $('.common-select').selectpicker();
    }
    $(function () {
     
    $('.common-select').selectpicker();
  });
    
    $('#edit-supplier-form').submit(function(e) {
        e.preventDefault();
    
        let id = $('#estimation_id').val();
        let caseId = $('#case_id').val(); 
        $.ajax({
            url: '/assign/' + id,
            method: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                 case_id: caseId
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#detailPopup').modal('hide');
                    alert(response.message);
                    $('#dataTable').DataTable().ajax.reload();
                } else {
                    alert('Error', response.message, 'error');
                }
            }
        });
    });
    
    
      $('#estimationForm').validate({
            rules: {
                customer: {
                    required: true, 
                },  
                estimation_date: {
                    required: true
                },
                title: {
                    required: true
                },
                description: {
                    required: true,
                    minlength: 5
                }, 
            },
            messages: {
                customer: {
                    required: "Please Select Customer Name", 
                },
                estimation_date: {
                    required: "Please Select Date", 
                },
                title: {
                    required: "Please Enter Title", 
                },
                description: {
                    required: "Please Enter Description"
                }, 
                city: {
                    required: "Please Select The City"
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
            
        });
        
   
    $(document).ready(function () {

        $('#case_id').select2({
            width: '100%'
        }); 
         
        //  $('#customer, #case_id').select2({ width: '100%' });


        function fetchCaseList() {
            $.ajax({
                url: '/caselist',
                method: 'GET',
                dataType: 'json',
                success: function (caselist) {
                    
                    if (!Array.isArray(caselist)) {
                        console.error("States response is not an array", caselist);
                        return;
                    }
                    let options = '<option selected disabled>Select case...</option>';
                    caselist.forEach(caselist => {
                        options += `<option value="${caselist.id}">${caselist.case_id}</option>`;
                    });
                    $('#case_id').html(options);
                },
                error: function () {
                    alert('Error fetching states!');
                }
            });
        } 
        fetchCaseList();  
        
     
    });
</script> 

      