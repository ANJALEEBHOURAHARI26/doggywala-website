@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
        <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- jQuery (Required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<style>
.custom-btn {
    color: #D84055;
    border: 2px solid #D84055;
    background-color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 11px;
}
.custom-btn:focus, .custom-btn:active {
    outline: none;
    box-shadow: none;
    background-color: #D84055;
    color: #fff;
    border-color: #D84055;
}
.custom-btn:hover {
    color: #fff;
    background-color: #D84055;
    border-color: #D84055;
}
/**/
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    .custom-table thead.thead-light th {
       background: linear-gradient(90deg, #3136C1 0%, #D84055 100%) !important; border: none;
        color: white !important;
        font-weight: bold;
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
        color: #1C1D3E;
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
     .select2-container {
    width: 100% !important;
}
.select2-selection {
    height: 41px !important;
    font-size: 16px !important;
    border: 2px solid #ccc !important;
    border-radius: 5px !important;
    padding: 4px !important;
    background-color: #fff !important;
    border-color: #D8405533 !important;
}

</style>  
@php
    if(auth()->check()) {
        $user = auth()->user();
        $staffId = $user->staff_id;
        $userType = $user->user_type;

        $role = DB::table('model_has_roles')
                ->where('model_id', $staffId)
                ->join('role_permission', 'model_has_roles.role_id', '=', 'role_permission.id')
                ->select('role_permission.name as role_name', 'model_has_roles.role_id')
                ->first();

        $permissions = [];
        if ($role) {
            $permissions = DB::table('role_has_permissions')
            ->where('role_id', $role->role_id)
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->pluck('permissions.name')->toArray();
        }
    }
@endphp
        <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Reports/<span style=" color:black !important; font-weight: 600; font-size: 22px;">Project/</span><span style=" color:black !important; font-weight: 600; font-size: 22px;">Sales Report</span></h1>
          </div>
        
        <!-- Filter Form Start -->
        <form method="GET" action="{{ route('project-sales') }}" id="projectDateFilter">
            <div class="row mb-4">
                <div class="col-md-4">
                <label for="customer_name">Customer Name</label>
                <select name="customer_name" id="customer_name" class="form-control">
                    
                </select>
            </div>

                <div class="col-md-4">
                    <label for="from_date">From Date</label>
                    <input type="text" name="from_date" class="form-control date-picker" value="{{ request('from_date') }}" placeholder="MM DD YYYY">
                </div>
                <div class="col-md-4">
                    <label for="to_date">To Date</label>
                    <input type="text" name="to_date" class="form-control date-picker" value="{{ request('to_date')}}" placeholder="MM DD YYYY">
                </div>
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 68px;">Filter</button>
                    <a href="{{ route('project-sales') }}" class="btn btn-danger ml-2" style="margin-top: 10px;width: 68px;">Clear</a>
                </div>
            </div>
        </form>

        <!-- Filter Form End -->
          <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                    <div class="table-responsive p-3">
                        <table class="table table-striped custom-table nowrap" id="dataTable" style="width:100%">
                            <a href="{{ route('project-sales.report') }}" class="btn custom-btn mb-3">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <thead class="thead-light">
                              <tr>
                                <th>Date</th>
                                <th>Invoice No.</th>
                                <th>Case ID/Job Number</th>
                                <th>Customer Name</th>
                                <th>Project Name</th>
                                <th>Amount ($)</th>
                                <th>Discount ($)</th>
                                <th>Total ($)</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                    @foreach($projects as $project)
                                    @php $multi_paid_total = \DB::table('invoice_multi_pay')
                                ->where('invoice_id', $project->id)
                                ->sum('amount_paid');   @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($project->case_start_date)->format('F d Y') }}</td>
                                            <td>{{ $project->invoiveManage ? 'INV000' . $project->invoiveManage->id : 'N/A' }}</td>
                                            <td>{{ $project->case_id ?? 'N/A'}}</td>
                                            <td>{{ optional($project->customer)->name ?? 'N/A'}}</td>
                                            <td>{{ $project->case_name ?? 'N/A'}}</td>
                                            <td>{{ optional($project->invoiveManage)->sub_total ?? 'N/A'}}</td>
                                            <td>{{ optional($project->invoiveManage)->sub_total * optional($project->invoiveManage)->discount / 100 ?? 'N/A'}}</td>
                                           
                                            <td>{{ optional($project->invoiveManage)->total ?? 'N/A'}}</td>
                                            
                                            @php
                                                $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                                            @endphp
                                
                                            <td class="action-icons">
                                                <a href="{{ $userType == 'Admin' || in_array('view_project_sales_report', $permissionsArray) ? route('view-project-sales', $project->id) : 'javascript:void(0);' }}"
                                                    onclick="{{ $userType == 'Admin' || in_array('view_project_sales_report', $permissionsArray) ? '' : 'showProjectSalesReportError()' }}" title="View">
                                                    <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View Sales Report">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
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
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- jQuery (Only One Time Load) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI (Agar Required Ho) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

<!-- Bootstrap & Other Vendor JS -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- DataTables Plugin -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".date-picker").datepicker({
            dateFormat: "MM dd yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2100"
        });

        $('#dataTable').DataTable({
            "scrollX": true,
            "autoWidth": false,
            "responsive": true,
           order: [[0, 'desc']]
        });

        $('[data-toggle="popover"]').popover();
    });
    
    
        $(document).ready(function () {

        $('#customer_name').select2({
            width: '100%'
        }); 
         
     


        function fetchCustList() {
            $.ajax({
                url: '/customerlistname',
                method: 'GET',
                dataType: 'json',
                success: function (custlist) {
                    
                    if (!Array.isArray(custlist)) {
                        console.error("States response is not an array", custlist);
                        return;
                    }
                    let options = '<option selected disabled>Select Customer...</option>';
                    custlist.forEach(custlist => {
                        options += `<option value="${custlist.name}">${custlist.name}</option>`;
                    });
                    $('#customer_name').html(options);
                },
                error: function () {
                    alert('Error fetching customer!');
                }
            });
        } 
        fetchCustList();  
        
     
    });
</script>

