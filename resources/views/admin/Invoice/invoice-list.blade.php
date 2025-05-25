@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- Bootstrap CSS -->
<style>
/* Modal Customizations */
    .custom-modal {
        border-radius: 8px;
        overflow: hidden;
    }

    .custom-table thead.thead-light th {
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%) !important; border: none;
        color: white !important;
        font-weight: bold;
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

    .custom-btn {
        background-color: #D84055;
        border: none;
        padding: 12px 30px;
        border-radius: 5px;
        color: #fff;
        font-size: 18px;
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
        color: #D84055; 
        border: 2px solid #D84055;
        background-color: white; 
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 11px;
    }

    .custom-btn:hover {
        color: #fff;
        background-color: #D84055;
        border-color: #D84055;
    }

    .custom-btn:focus,
    .custom-btn:active {
        outline: none;
        box-shadow: none;
        background-color: #D84055;
        color: #fff;
        border-color: #D84055;
    }
    .detail-prject{
        padding: 8px 16px !important;
    }
    
    @media (max-width: 575.98px) {
        .custom-btn {
            font-size: 9px !important;
            padding: 0px 15px !important;
        }
        .detail-prject{
             font-size: 9px !important;
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
    }
    
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .custom-btn {
            font-size: 18px !important;
            padding: 14px 26px !important;
        }
    }
    
    @media (min-width: 1200px) {
        .custom-btn {
            font-size: 20px !important;
            padding: 7px 30px !important;
        }
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
   <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Invoice & Payments</h1>            <!--  <li class="breadcrumb-item"><a href="./">Home</a></li>-->
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
            
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush custom-table" id="dataTable">
                      <a href="{{ route('invoice-payments.pdf') }}" class="btn custom-btn mb-3">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    <thead class="thead-light">
                      <tr>
                            <th style="border: 1px solid white;" >Date</th>
                            <th style="border: 1px solid white;">Invoice No.</th>
                            <th style="border: 1px solid white;">Case ID/Job Number</th>
                            <th style="border: 1px solid white;">Customer Name</th>
                            <th style="border: 1px solid white;">Project Name</th>
                            <th style="border: 1px solid white;">Amount</th>
                            <th style="border: 1px solid white;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoicePayment as $invoicePayment)
                         <tr>
                            <td>{{ \Carbon\Carbon::parse($invoicePayment->date)->format('F d Y') }}</td>
                            <td>invoice-00{{$invoicePayment->id}}</td>
                            <td>{{$invoicePayment->projects->case_id}}</td>
                            <td>{{$invoicePayment->projects->employee->full_name ?? null}}</td>
                            <td>{{$invoicePayment->projects->case_name}}</td>
                            <td>{{$invoicePayment->final_amount}}</td>
                          
                            <td class="action-icons">
                                @php
                                    $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                                @endphp
                                
                                <a href="{{ $userType == 'Admin' || in_array('view_invoice_payment', $permissionsArray) ? route('invoice-View', $invoicePayment->id) : 'javascript:void(0);' }}"
                                    onclick="{{ $userType == 'Admin' || in_array('view_invoice_payment', $permissionsArray) ? '' : 'showInvoiceViewPermissionError()' }}" title="View">
                                    <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View Status">
                                </a>
                                
                                <script>
                                    function showInvoiceViewPermissionError() {
                                        alert('❌ You don\'t have permission to view this invoice payment!');
                                    }
                                </script>

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
      $('#dataTable').DataTable();  
      $('#dataTableHover').DataTable(); 
    });
  </script>

</body>

</html>