@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- Bootstrap CSS -->
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

/* Hover Effect */
.custom-btn:hover {
    color: #fff;
    /*background-color: #D84055;*/
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
    /*border-color: #D84055;*/
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
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >
                 <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Projects</a> /
                 <a href="{{ route('project-details', ['projectId' => $projectDetails->id]) }}" style=" color:black !important; font-weight: 600; font-size: 22px;">View Details / </a>
                 <a href="{{ route('final-report', ['projectId' => $projectDetails->id]) }}" style=" color:black !important; font-weight: 600; font-size: 22px;">Final Report</a></h1>            
          </div>

          <!-- Row -->
          <div class="row ">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                    @if(session('selected_case_type') == 'Testing' || $projectDetails->case_type == 'Testing')
                  <div class="tabs">
                  
                    <a href="{{route('project-details',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Detail</button></a>
                       <a href="{{route('appointment-project',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Appointment</button></a>
                    <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
                        <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>                       
                       <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;padding: 7px 30px !important;" >Final Report</button>
                    <!--<a href="{{route('project-invoice',['projectId'=> $projectDetails->id])}}" ><button class="btn custom-btn">Invoice & Payment</button></a>-->
                    
                </div>
                  @elseif(session('selected_case_type') == 'Abatement/Miscellaneous' || $projectDetails->case_type == 'Abatement/Miscellaneous')
                  <div class="tabs">
                    <a href="{{route('project-details',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Detail</button></a>
                       <a href="{{route('appointment-project',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Appointment</button></a>
                    <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
                        <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>                       
                       <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;padding: 7px 30px !important;" >Final Report</button>
                    <!--<a href="{{route('project-invoice',['projectId'=> $projectDetails->id])}}" ><button class="btn custom-btn">Invoice & Payment</button></a>-->
                    <a href="{{route('sheetlist',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Sheet</button></a>
                </div>
                @endif
                <div style="text-align: right;">
                    <button class="btn btn-primary" style="margin-right: 40px; background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;" data-toggle="modal" data-target="#addFinalReportModal">+Add Final Report</button>
                </div>
                
                @include('admin.project.finalreport.create-finalreport')
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

                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush custom-table" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($finalReportDetails as $finalReport)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($finalReport->date)->format('F d Y') }}</td>
                                    <td>{{ $finalReport->title }}</td>
                                    <td>{{ $finalReport->remark }}</td>
                                    <td class="action-icons">
                                        <a href="#" class="edit-btn"
                                           data-toggle="modal"
                                           data-target="#editFinalReportModal"
                                           data-id="{{ $finalReport->id }}"
                                           data-date="{{ \Carbon\Carbon::parse($finalReport->date)->format('F d Y') }}"
                                           data-title="{{ $finalReport->title }}"
                                           data-description="{{ htmlentities($finalReport->description) }}" 
                                           data-remark="{{ $finalReport->remark }}"
                                           data-report_one="{{ json_encode($finalReport->report_one) }}"
                                           data-url="{{ route('update.final.report', $finalReport->id) }}" title="Edit"> 
                                           <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">
                                        </a>

                                        @include('admin.project.finalreport.edit-finalreport')
                                        <a href="{{route('view.finalReport',$finalReport->id)}}" data-target="#statusModal" title="View">
                                            <img src="{{asset('assets/img/View-Icon.png')}}" alt="View Status">
                                        </a>
                                        <a onclick="deleteFinalReport({{ $finalReport->id }})" title="Delete"><img src="{{asset('assets/img/Delete-Icon.png')}}">️</a>
                                    </td>
                                </tr>
                            @endforeach
                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- DataTable with Hover -->
         
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI (For Datepicker) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    // $('#dataTable').DataTable();
    $('#dataTableHover').DataTable(); 
    $('#dataTable').DataTable({
    "order": [[0, "desc"]]
});
  });
</script>
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

    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var date = $(this).data('date');
        var remark = $(this).data('remark');
        var url = $(this).data('url');
        var description = $("<textarea/>").html($(this).data('description')).text();
        // console.log(description);
        var reportOne = $(this).data('report_one');

        $('#editFinalReportModal #report_id').val(id);
        $('#editFinalReportModal #title').val(title);
        $('#editFinalReportModal #edit_date').val(date);
        $('#editFinalReportModal #remark').val(remark);
        $('#editFinalReportForm').attr('action', url);

        if (CKEDITOR.instances['editDescription']) {
                CKEDITOR.instances['editDescription'].setData(description);
            } else {
                $('#editFinalReportModal #editDescription').val(description);
            }

        var reportOneContainer = $('#report_one_preview');
        var baseUrl = "https://abatementsolutionsllc.sunshinedemo.xyz/public/";
        reportOneContainer.html('');

        if (reportOne) {
            try {
                var files = JSON.parse(reportOne);
                if (!Array.isArray(files)) {
                    files = JSON.parse(files);
                }

                files.forEach((file) => {
                    var fileUrl = baseUrl + file;
                    var fileExtension = file.split('.').pop().toLowerCase();
                    var filePreview = '';

                    if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                        filePreview = `<img src="${fileUrl}" class="img-thumbnail mx-2" style="width: 100px; height: 100px;">`;
                    } else if (fileExtension === 'pdf') {
                        filePreview = `<embed src="${fileUrl}" type="application/pdf" width="100" height="100">`;
                    } else {
                        filePreview = `<i class="fa fa-file mx-2" style="font-size: 40px;"></i>`;
                    }

                    var inputField = `
                        <div class="file-group d-flex align-items-center mb-2" data-file="${file}">
                            <input type="file" class="form-control replace-file" name="report_one[]" data-existing="${file}">
                            ${filePreview}
                            <a href="${fileUrl}" download class="btn btn-primary btn-sm mx-2">Download</a>
                            <button type="button" class="btn btn-danger btn-sm remove-file" data-file="${file}">X</button>
                            <input type="hidden" name="existing_files[]" value="${file}">
                        </div>
                    `;
                    reportOneContainer.append(inputField);
                });

            } catch (error) {
                console.error("Invalid JSON format:", error);
            }
        }

        setTimeout(() => {
            editToggleDateFields();
        }, 300);
    });

    function editToggleDateFields() {
        $('#edit_date').prop('disabled', false);
    }

    $(document).on('click', '#addmoreimg_edit', function () {
        var newField = `
            <div class="file-group d-flex align-items-center mb-2">
                <input type="file" class="form-control" name="report_one[]">
                <button type="button" class="btn btn-danger btn-sm remove-file">X</button>
            </div>
        `;
        $('#file_upload_wrapper').append(newField);
    });

    $(document).on('click', '.remove-file', function () {
        var file = $(this).data('file');
        if (file) {
            var hiddenInput = `<input type="hidden" name="deleted_files[]" value="${file}">`;
            $('#editFinalReportForm').append(hiddenInput);
        }
        $(this).closest('.file-group').remove();
    });

    $(document).on('change', '.replace-file', function () {
        var existingFile = $(this).data('existing');
        if (existingFile) {
            var hiddenInput = `<input type="hidden" name="deleted_files[]" value="${existingFile}">`;
            $('#editFinalReportForm').append(hiddenInput);
        }
    });

    $('#updateReportButton').on('click', function () {
        $(this).prop('disabled', true).html('Updating...');
        $('#editFinalReportForm').submit();
    });

});

</script>

<script>
    function deleteFinalReport(reportId) {
        if (confirm('Are you sure you want to delete this final report?')) {
            $.ajax({
                url: `/delete-final-report/${reportId}`,
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
