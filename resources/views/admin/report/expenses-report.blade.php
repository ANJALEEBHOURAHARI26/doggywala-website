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
    /* Force column width to 0px */


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
<!-- Topbar -->
<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;">Reports / <span style=" color:black !important; font-weight: 600; font-size: 22px;">Expenses Report</span></h1>
          </div>
            
            <!-- Filter Form Start -->
            <form method="GET" action="{{ route('expenses-report') }}" id="dateFilter">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="from_date">Case ID/Job Number</label>
                        <input type="text" name="case_id" class="form-control" value="{{ request('case_id') }}" placeholder="Case Id">
                    </div>
                    <div class="col-md-4">
                        <label for="from_date">From Date</label>
                        <input type="text" name="from_date" class="form-control date-picker" value="{{ request('from_date') }}" placeholder="MM DD YYYY">
                    </div>
                    <div class="col-md-4">
                        <label for="to_date">To Date</label>
                        <input type="text" name="to_date" class="form-control date-picker" value="{{ request('to_date') }}" placeholder="MM DD YYYY">
                    </div>
                    <div class="col-md-4">
                        <br>
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 68px;">Filter</button>
                        <a href="{{ route('expenses-report') }}" class="btn btn-danger ml-2" style="margin-top: 10px;width: 68px;">Clear</a>
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
                    <a href="{{ route('expenses.report') }}" class="btn custom-btn mb-3">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                    <thead class="thead-light">
                      <tr>
                        <th>Date</th>
                        <th>Case ID/Job Number</th>
                        <th>Expense Name</th>
                        <th>Category</th>
                        <th>Created by</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                            @foreach($expenseDetails as $expenseDetails)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($expenseDetails->date)->format('F d Y') }}</td>
                                    <td>{{ $expenseDetails->case_id }}</td>
                                    <td>{{ $expenseDetails->expense_name }}</td>
                                    <td>{{ $expenseDetails->category}}</td>
                                    <td>{{ $expenseDetails->users->name}}</td>
                                    <td>{{ $expenseDetails->amount }}</td>
                                    @php
                                        $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                                    @endphp
                                    
                                    <td class="action-icons">
                                        <a href="{{ $userType == 'Admin' || in_array('view_expense_report', $permissionsArray) ? route('view-expenses-report', $expenseDetails->id) : 'javascript:void(0);' }}"
                                            onclick="{{ $userType == 'Admin' || in_array('view_expense_report', $permissionsArray) ? '' : 'showExpenseReportError()' }}" title="View">
                                            <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View Expense Report">
                                        </a>
                                    </td>
                                    
                                    {{-- Permission Error Message --}}
                                    <script>
                                        function showExpenseReportError() {
                                            alert('❌ You don\'t have permission to view the expense report!');
                                        }
                                    </script>

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

<script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $(".date-picker").datepicker({
            dateFormat: "MM dd yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2100"
        });

        $("#dateFilter").on("submit", function () {
            $(".date-picker").each(function () {
                let input = $(this);
                let parts = input.val().split("-");
                if (parts.length === 3) {
                    input.val(parts[2] + "-" + parts[0] + "-" + parts[1]);
                }
            });
        });

        $('#dataTable').DataTable({
            "scrollX": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('[data-toggle="popover"]').popover();
    });
</script>