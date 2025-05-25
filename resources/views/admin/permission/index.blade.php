@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- jQuery (Required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    .custom-table th,
    .custom-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .custom-table th {
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
        color: white;
    }

    .badge {
        background-color: #e7f3ff;
        color: #007bff;
        padding: 5px 10px;
        border-radius: 12px;
        margin: 2px;
        display: inline-block;
    }

    .btn-new-role {
        background-color: #D84055;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
  
  /**/
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
        align-items: center;
        justify-content: center;
         text-decoration: none;
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
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">Manage Permissions</h1>
        <a href="{{$userType == 'Admin' || in_array('add_permission', $permissions) ? route('add.permissions') : '#'}}"
        onclick="{{ $userType == 'Admin' || in_array('add_permission', $permissions) ? '' : 'showAddPermissionError()' }}"><button class="btn btn-primary"
                style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">+Add Permission</button></a>
        <script>
            function showAddPermissionError() {
                alert('❌ You don\'t have permission to add a Permission!');
            }
        </script>  
    </div>
    
    <!--  <div class="d-sm-flex align-items-center justify-content-between mb-4">-->
    <!--    <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;"> <a href="{{ route('customer-list') }}" style="text-decoration: none; color: black;">Customer/</a><span style="color:black !important; font-weight: 600; font-size: 22px;">View Customer</span></h1>-->
    <!--</div>-->


   
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('error') }}
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
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($rolesWithPermissions && $rolesWithPermissions->isNotEmpty())
                                @foreach($rolesWithPermissions as $roleId => $permissions)
                                    <tr>
                                        <td>{{ $permissions->first()->role_name }}</td>
                                        <td>
                                            @foreach($permissions as $permission)
                                                <span class="badge">{{ $permission->permission_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="{{ $userType == 'Admin' || in_array('edit_permission', $permissionsArray) ? route('edit.permission', $roleId) : '#' }}" 
                                                   onclick="{{ $userType == 'Admin' || in_array('edit_permission', $permissionsArray) ? '' : 'showEditPermissionError()' }}"
                                                   title="Edit">
                                                    <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">
                                                </a>
                                        
                                                <a href="javascript:void(0);" 
                                                   onclick="{{ $userType == 'Admin' || in_array('delete_permission', $permissionsArray) ? "deleteRolePermission($roleId)" : "showDeletePermissionError()" }}" 
                                                   title="Delete">
                                                    <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                                                </a>
                                            </div>
                                        
                                            <script>
                                                function showEditPermissionError() {
                                                    alert('❌ You don\'t have permission to edit a Permission!');
                                                }
                                                function showDeletePermissionError() {
                                                    alert('❌ You don\'t have permission to delete!');
                                                }
                                            </script>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No Role & Permission found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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
 <script>
   function deleteRolePermission(roleId) {
    console.log("Role ID: ", roleId); 

    if (confirm('Are you sure you want to delete this Role Permission?')) {
        $.ajax({
            url: `/delete-permission/${roleId}`,  
            type: 'POST',  
            data: {
                _method: 'DELETE', 
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.success);
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error occurred while deleting role permission');
            }
        });
    }
}

</script>
</div>
@include('layouts.footer')