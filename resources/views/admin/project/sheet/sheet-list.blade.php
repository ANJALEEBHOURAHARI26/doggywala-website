@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- Bootstrap CSS -->
<style>
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
    background-color: #D84055;
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

/*.custom-btn {*/
/*    background-color: #D84055;*/
/*    border: none;*/
/*    padding: 12px 30px;*/
/*    border-radius: 5px;*/
/*    color: #fff;*/
/*    font-size: 18px;*/
/*    font-weight: bold;*/
/*    cursor: pointer;*/
/*}*/
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
        /*.custom-btn {*/
        /*    color: #D84055; */
        /*    border: 2px solid #D84055;*/
        /*    background-color: white; */
        /*    padding: 10px 20px;*/
        /*    font-size: 13px;*/
        /*    cursor: pointer;*/
        /*    transition: all 0.3s ease;*/
        /*    margin-left: 11px;*/
        /*}*/
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
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);
    border-color: none;
}

/* Prevent default blue color on click */
.custom-btn:focus,
.custom-btn:active {
    outline: none;
    box-shadow: none;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);
    color: #fff;
    border-color: none;
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
                font-size: 13px !important;
                padding: 7px 30px !important;
            }
        }
    @elseif(session('selected_case_type') == 'Abatement')
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
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;">
                <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Projects</a> / 
                <a href="{{ route('sheetlist', ['projectId' => $projectDetails->id]) }}" style=" color:black !important; font-weight: 600; font-size: 22px;">Sheet List</a>
            </h1>  
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                    @if(session('selected_case_type') == 'Testing' || $projectDetails->case_type == 'Testing')
                  <div class="tabs">
                    <!--<div class="tab active" onclick="showCategory('testing')">Testing</div>-->
                    <!--<div class="tab" onclick="showCategory('abatement')">Abatement</div>-->
                    <a href="{{route('project-details',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Detail</button></a>
                    <a href="{{route('appointment-project',['projectId'=> $projectDetails->id])}}" ><button class="btn custom-btn">Appointment</button></a>
                    <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
                    <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>
                    <a href="{{route('final-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Final Report</button></a>
                       <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;    padding: 7px 30px !important;" >Sheet</button>
                    
                    
                </div>
                  @elseif(session('selected_case_type') == 'Abatement' || $projectDetails->case_type == 'Abatement/Miscellaneous')
                  <div class="tabs">
                    <!--<div class="tab active" onclick="showCategory('testing')">Testing</div>-->
                    <!--<div class="tab" onclick="showCategory('abatement')">Abatement</div>-->
                    <a href="{{route('project-details',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Detail</button></a>
                    <a href="{{route('appointment-project',['projectId'=> $projectDetails->id])}}" ><button class="btn custom-btn">Appointment</button></a>
                    <a href="{{route('project-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Reports Manage</button></a>
                    <a href="{{route('project-estimation',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Estimation</button></a>
                    <a href="{{route('final-report',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Final Report</button></a>
                    <!--<a href="{{route('project-invoice',['projectId'=> $projectDetails->id])}}"><button class="btn custom-btn">Invoice & Payment</button></a>-->
                    <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 13px; margin-left: 10px;    padding: 7px 30px !important;" >Sheet</button>
                </div>
                  @endif
               
                
                @include('admin.project.invoice_payment.create-payment')
              
                <div class="table-responsive p-3">
                    <a class="btn btn-primary" href="{{ route('project-details',$projectDetails->id) }}" 
                       style="text-decoration: none; font-size: 16px; ">
                        Back
                    </a>
                    </br>
                    
                  <table class="table align-items-center table-flush custom-table" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Date</th>
                        <th>Case ID/Job Number</th>
                        <th>Detail</th>
                        <!--<th>Status</th>-->
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($sheetDetails as $sheetDetails)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($sheetDetails->date)->format('F d Y') }}</td>
                            <td>{{$sheetDetails->case_id}}</td>
                            <td>{{$sheetDetails->details}}</td>
                            <!--<td>{{$sheetDetails->status}}</td>-->
                            <td class="action-icons">
                                <a href="{{ route('project-sheet', ['sheetId' => $sheetDetails->id, 'projectId' => $projectDetails->id]) }}" title="View">
                                    <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View Status">
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

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - design & developed by
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
  <!-- Page level plugins -->
  <script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>