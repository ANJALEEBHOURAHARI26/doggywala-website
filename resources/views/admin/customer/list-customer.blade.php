@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
        <!-- DataTables CSS -->
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">-->
<!-- jQuery (Required) -->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!-- DataTables JS -->
<!--<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>-->

<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    
    .custom-table thead.thead-light th {
        /*background-color: #D84055 !important;*/
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%) !important;
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
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Customer/
                <!--<span style=" color:black !important; font-weight: 600; font-size: 22px;">Customer List</span></h1> -->
                <a href="{{ route('customer-list') }}" style=" color:black !important; font-weight: 600; font-size: 22px;">Customer List</a>
          </div>

          <!-- Row -->
          <div class="row" >
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('message') }}
                    </div>
                @endif     
                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive p-3">
            <table class="table table-striped custom-table nowrap" id="dataTable" style="width:100%">

                    <thead class="thead-light">
                      <tr>
                         <th>Created Date</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <!--@php $i = 1; @endphp-->
                        @foreach($customerDetails as $customer)
                           <tr>
                                <td>{{ optional($customer->created_at)->format('F d Y') ?? 'N/A' }}</td>
                                <td>{{ $customer->name ?? 'N/A' }}</td>
                                <td>{{ $customer->phone_number ?? 'N/A' }}</td>
                                <td>{{ $customer->email ?? 'N/A' }}</td>
                                <td>{{ $customer->status ?? 'N/A' }}</td>
                                
                                <td class="action-icons">
                                    @php
                                        $permissionsArray = is_array($permissions) ? $permissions : $permissions->toArray();
                                    @endphp
                                    
                                    {{-- Edit --}}
                                    <a href="{{ ($userType == 'Admin' || in_array('edit_customer', $permissionsArray)) ? url('customer-edit/'.$customer->id) : '#' }}" 
                                       onclick="{{ ($userType == 'Admin' || in_array('edit_customer', $permissionsArray)) ? '' : 'return showEditPermissionError()' }}"
                                       title="Edit">
                                        <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">
                                    </a>
                            
                                    {{-- View --}}
                                    <a href="{{ ($userType == 'Admin' || in_array('view_customer', $permissionsArray)) ? route('customer.view', $customer->id) : '#' }}" 
                                       title="View"
                                       onclick="{{ ($userType == 'Admin' || in_array('view_customer', $permissionsArray)) ? '' : 'showViewPermissionError(event)' }}">
                                        <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View">
                                    </a>
                            
                                    {{-- Delete --}}
                                    <a href="javascript:void(0);" 
                                       onclick='{{ ($userType == "Admin" || in_array("delete_customer", $permissionsArray)) ? "deleteCustomer($customer->id)" : "showDeletePermissionError()" }}' 
                                       title="Delete">
                                        <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                                    </a>
                            
                                    {{-- JS Error Alert Functions --}}
                                    <script>
                                        function showViewPermissionError(event) {
                                            event.preventDefault(); 
                                            alert('❌ You don\'t have permission to view this customer!');
                                        }
                            
                                        function showEditPermissionError() {
                                            alert('❌ You don\'t have permission to edit this customer!');
                                            return false;
                                        }
                            
                                        function showDeletePermissionError() {
                                            alert('❌ You don\'t have permission to delete this customer!');
                                            return false; 
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
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
$(document).ready(function () {
    $('#dataTable').DataTable({
        "ordering": true, 
        "order": [[0, 'desc']] 
    });
});

</script>

  <!-- Page level custom scripts -->
 
  <script>
    function deleteCustomer(id) {
        if (confirm('Are you sure you want to delete this customer?')) {
            $.ajax({
                url: `/customer-delete/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert(response.success);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    }
</script>
</body>

</html>