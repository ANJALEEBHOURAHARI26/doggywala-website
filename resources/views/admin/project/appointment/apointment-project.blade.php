@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
        <!-- Bootstrap CSS -->
<style>
.card .table td, .card .table th {
    padding-right: -0.5rem;
    padding-left: 0.5rem;
    height: 41px;
}
/**/
.custom-table thead.thead-light th {
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
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;background-color: #D84055;
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
            /*display: flex;*/
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

.custom-btn:hover {
    color: #fff;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
    border: none;
}

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
@media (max-width: 575.98px) {
      .custom-btn {
        font-size: 9px !important;
        padding: 8px 16px !important;
    }
    .detail-prject{
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
                <a href="{{ route('project-details', ['projectId' => $projectDetails->id]) }}" style=" color:black !important; font-weight: 600; font-size: 22px;">View Details</a> /
                <a href="{{ route('appointment-project', ['projectId' => $projectDetails->id]) }}" style=" color:black !important; font-weight: 600; font-size: 22px;">Appointment</a>
            </h1>            

          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                    @if(session('selected_case_type') == 'Testing' || $projectDetails->case_type == 'Testing')
                  <div class="tabs">
                    <a href="{{route('project-details',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Detail</button></a>
                    <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;padding: 7px 30px !important;    padding: 7px 30px !important;" >Appointment</button>
                    <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
                    <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>
                    <a href="{{route('final-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Final Report</button></a>
                    <!--<a href="{{route('project-invoice',['projectId'=> $projectDetails->id])}}" ><button class="btn custom-btn">Invoice & Payment</button></a>-->
                    
                </div>
                  @elseif(session('selected_case_type') == 'Abatement/Miscellaneous' || $projectDetails->case_type == 'Abatement/Miscellaneous')
                  <div class="tabs">
                    <a href="{{route('project-details',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Detail</button></a>
                    <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;padding: 7px 30px !important;    padding: 7px 30px !important;" >Appointment</button>
                    <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
                    <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>
                    <a href="{{route('final-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Final Report</button></a>
                    <!--<a href="{{route('project-invoice',['projectId'=> $projectDetails->id])}}" ><button class="btn custom-btn">Invoice & Payment</button></a>-->
                    <a href="{{route('sheetlist',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Sheet</button></a>
                </div>
                @endif
                <div style="text-align: right;">
                    <button class="btn btn-primary" style="margin-right: 40px; background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; border-color: #D84055;" data-toggle="modal" data-target="#addAppointmentModal">+Add Appointment</button>
                </div>
                <br>
                @include('admin.project.appointment.add-appointment')
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('message') }}
                    </div>
                @endif  
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush custom-table" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Date & Time</th>
                        <th>Customer Name</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($appointmentDetails as $appointment)
                            <tr>
                                <td>{{ date('F d Y h:i A', strtotime($appointment->appointment_date)) }}</td>
                                <td>{{ $appointment->customer->name ?? 'N/A' }}</td>
                                <td>{{ $appointment->title }}</td>
                                <td>{{ $appointment->status === 'In_progress' ? 'In Progress' : $appointment->status }}</td>
                                <td class="action-icons">
                                    <!--<a href="#" class="edit-btn" -->
                                    <!--   data-toggle="modal" -->
                                    <!--   data-target="#editModal"-->
                                    <!--   data-id="{{ $appointment->id }}"-->
                                    <!--   data-title="{{ $appointment->title }}"-->
                                    <!--   data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d Y, h:i A') }}"-->
                                    <!--   data-note="{{ $appointment->notes }}"-->
                                    <!--   data-url="{{ route('update.appointment', ['appointmentId' => $appointment->id]) }}" title="Edit"> -->
                                    <!--   <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">-->
                                    <!--</a>-->
                    
                                    @include('admin.project.appointment.edit-appointment')
                    
                                    <a href="#" class="status-update-btn" data-toggle="modal" data-target="#statusModal"
                                       data-id="{{ $appointment->id }}"
                                       data-status="{{ $appointment->status }}"
                                       data-note="{{ $appointment->notes }}"
                                       data-url="{{ route('update.appointment.status', $appointment->id) }}" title="Status Update"> 
                                       <img src="{{ asset('assets/img/right-icon.png') }}" alt="View Status">
                                    </a>
                                    @include('admin.project.appointment.status-appointment')
                                    <!--<a href="#" class="delete-btn" data-id="{{ $appointment->id }}">-->
                                    <!--    <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">-->
                                    <!--</a>-->
                                    
                                     <a  onclick="deleteAppointment({{ $appointment->id }})" title="Delete">
                                    <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                                </a>
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
 
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/js/ruang-admin.min.js')}}"></script>
<!-- Page level plugins -->
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Page level custom scripts -->
  
   
  <script>
    $(document).ready(function () {
    //   $('#dataTable').DataTable();
      $('#dataTableHover').DataTable();
      $('#dataTable').DataTable({
    "order": [[0, "desc"]]
});

    });
  </script>
        <script>
            flatpickr("#edit_appointment_date", {
                enableTime: true,
                dateFormat: "F d Y, h:i K",
                minDate: "today",
                time_24hr: false
            });

            
           $(document).on('click', '.edit-btn', function () {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var date = $(this).data('date'); 
                var note = $(this).data('note');
                var url = $(this).data('url');
            
                $('#editModal #appointment_id').val(id);
                $('#editModal #title').val(title);
                $('#editModal #edit_appointment_date').val(date);
                $('#editModal #note').val(note);
                $('#editAppointmentForm').attr('action', url);
            });
        </script>
        <script>
             $(document).on('click', '.status-update-btn', function () {
                var id = $(this).data('id');
                var status = $(this).data('status');
                var note = $(this).data('note');
                var url = $(this).data('url');
        
                $('#statusModal #appointment_id').val(id);
                $('#statusModal #status').val(status);
                $('#statusModal #note').val(note);
                $('#statusAppointmentForm').attr('action', url);
            });
        </script>
        
        <script>
            function deleteAppointment(appointmentId) {
                if (confirm('Are you sure you want to delete this appointment?')) {
                    $.ajax({
                        url: `/delete-appointment/${appointmentId}`,
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
        