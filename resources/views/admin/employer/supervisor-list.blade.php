@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
   <style>
   
   .card .table td, .card .table th {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
     padding-bottom: 1%;
    text-align: center;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 25px 68px;
}

table.dataTable {
   width: 110%;
    margin: -69px auto;
    clear: both;
    border-collapse: separate;
    border-spacing: 0;
}
dl, ol, ul {
    margin-top: -31px;
    margin-bottom: 1rem;
}
    .custom-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
                .custom-table thead.thead-light th {
    /*background-color: #D84055 !important;*/
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
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 11px;
}

/* Hover Effect */
.custom-btn:hover {
    color: #fff;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
}

/* Prevent default blue color on click */
.custom-btn:focus,
.custom-btn:active {
    outline: none;
    box-shadow: none;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
    color: #fff;
    /*border-color: #D84055;*/
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
@media (min-width: 576px) {
    .col-sm-12 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 11 0 123%;
        max-width: 128%;
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
@media (min-width: 1200px) {
    .custom-btn {
        font-size: 16px !important;
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
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Employer/<span style=" color:black !important; font-weight: 600; font-size: 22px;">Supervisor List</span></h1>
        </div>
          <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="tabs">
                    <a href="{{route('list-employer')}}"><button class="btn custom-btn">Worker</button></a>
                     <button class="btn btn-primary detail-prject" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;margin-left: 10px;padding: 7px 30px !important;">Supervisor</button>
                    <a href="{{route('staff-list')}}"><button class="btn custom-btn">Staff</button></a>
                    <a href="{{route('projectmanage-list')}}"><button class="btn custom-btn">Project Manager</button></a>
                </div>
              
                <div class="table-responsive p-3">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                  <table class="table align-items-center table-flush custom-table" id="dataTable">
                    <thead class="thead-light">
                       <tr>
                            <th>Joining Date</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>SSN</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($employeeDetail as $employeeDetail)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($employeeDetail->joining_date)->format('F d Y') }}</td>
                                <td>{{ $employeeDetail->full_name }}</td>
                                <td>{{ $employeeDetail->contact_number }}</td>
                                <td>{{ $employeeDetail->snn }}</td>
                                <td>{{ $employeeDetail->email}}</td>
                                <td>Active</td>
                                <td class="action-icons">
                                    @php
                                        $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                                    @endphp

                                    @if($userType == 'Admin' || in_array('edit_employee', $permissionsArray))
                                        <a href="{{ url('edit-employer/'.$employeeDetail->id) }}" class="edit-btn" title="Edit">
                                            <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">
                                        </a>
                                    @else
                                        <a href="#" onclick="showEditEmployeePermissionError()" title="Edit">
                                            <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">
                                        </a>
                                    @endif
                                    
                                    
                                    @if($userType == 'Admin' || in_array('update_password', $permissionsArray))
                                    <a href="#" data-toggle="modal" data-target="#updatePasswordModal" class="updatepassword-btn" data-id="{{ $employeeDetail->id }}" title="Password Update">
                                        <img src="{{ asset('assets/img/Update-password.png') }}" alt="Update Password">
                                    </a>
                                    @include('admin.employer.update-password-model')
                                    @else
                                        <a href="#" onclick="showPasswordUpdatePermissionError()" title="Update Password">
                                            <img src="{{ asset('assets/img/Update-password.png') }}" alt="Update Password">
                                        </a>
                                    @endif
                                    
                                    
                                    @if($userType == 'Admin' || in_array('view_employee', $permissionsArray))
                                        <a href="{{ route('employer.view', $employeeDetail->id) }}" title="View">
                                            <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View">
                                        </a>
                                    @else
                                        <a href="#" onclick="showViewEmployeePermissionError()" title="View">
                                            <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View">
                                        </a>
                                    @endif
                                
                                    @if($userType == 'Admin' || in_array('delete_employee', $permissionsArray))
                                        <a href="javascript:void(0);" onclick="deleteEmployer({{ $employeeDetail->id }})" title="Delete">
                                            <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                                        </a>
                                    @else
                                        <a href="#" onclick="showDeleteEmployeePermissionError()" title="Delete">
                                            <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                                        </a>
                                    @endif
                                
                                </td>
                                
                                <script>
                                    function showEditEmployeePermissionError() {
                                        alert('❌ You don\'t have permission to edit this employee!');
                                    }
                                
                                    function showViewEmployeePermissionError() {
                                        alert('❌ You don\'t have permission to view this employee!');
                                    }
                                
                                    function showDeleteEmployeePermissionError() {
                                        alert('❌ You don\'t have permission to delete this employee!');
                                    }
                                    
                                    function showPasswordUpdatePermissionError() {
                                        alert('❌ You don\'t have permission to update the password for this employee!');
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
    $('#dataTable').DataTable();
    $('#dataTableHover').DataTable(); 
  });
</script>
    <script>
        function deleteEmployer(id) {
            if (confirm('Are you sure you want to delete this employer?')) {
                $.ajax({
                    url: `/employer-delete/${id}`,
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