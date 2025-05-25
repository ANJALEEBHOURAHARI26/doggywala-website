@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
<style>
    .text-muted {
        color: #ed4747 !important;
        font-size: 130%;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    .custom-table th, .custom-table td {
        border: 1px solid #D84055;
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
     .tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        margin-top:49px;
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
    .project-card{
        background-color:#FDF5F6 !important; 
        border:1px solid #D8405533;
        border-radius: 12px;
   
       
    }
    .project-card p {
        margin: 0;
        font-size: 14px;
    }
    .project-card .btn {
        background-color: #ff5252;
        color: #fff;
        border: none;
        border-radius: 4px;
    }
    .project-card .btn:hover {
        background-color: #e60000;
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
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Document/<span style=" color:black !important; font-weight: 600; font-size: 22px;">View Document</span></h1>
        </div>

        
          <!--Row-->
        <div class="row d-flex justify-content-center">
                <div class="col-lg-12 mb-4">
                    <form method="GET" action="" class="mb-3 px-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="case_id" class="form-control" placeholder="Search by Case ID/Job Number" value="{{ request()->get('case_id') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-danger" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">Search</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('document-list') }}" class="btn btn-secondary" style="margin-left: -74px;">Clear</a>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Simple Tables -->
                    <div class="card" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                        <div class="row p-4">
                           @if($projectDetails->isEmpty())
                                <div class="col-12 text-center">
                                    <p class="text-muted">No Projects Document found</p>
                                </div>
                            @else
                                @foreach($projectDetails as $project)
                                    <div class="col-lg-4 mb-4">
                                        <div class="project-card p-3">
                                            <h4><strong>{{ $project->case_type }}</strong></h4>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Case ID/Job Number</p>
                                                <p>{{ $project->case_id }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Case Name</p>
                                                <p>{{ $project->case_name }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Customer Name</p>
                                                <p>{{ $project->customer->name ?? 'N/A' }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Assigned Project Manager</p>
                                                <p>{{ $project->employee->full_name ?? 'N/A' }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Case Status</p>
                                                <p>{{ $project->case_status ?? 'N/A' }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Case Date</p>
                                                <p>{{ $project->case_start_date ? \Carbon\Carbon::parse($project->case_start_date)->format('M d Y') : 'N/A' }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Case Location</p>
                                                <p>{{ $project->case_location ?? 'N/A' }}</p>
                                            </div>
                                            <div class="text-center mt-3">
                                                @php
                                                    $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                                                @endphp
                                                
                                                <a href="{{ $userType == 'Admin' || in_array('list_document', $permissionsArray) ? route('document-detail', $project->id) : 'javascript:void(0);' }}"
                                                    onclick="{{ $userType == 'Admin' || in_array('list_document', $permissionsArray) ? '' : 'showDocumentViewPermissionError()' }}">
                                                    <button class="btn btn-danger" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">
                                                        View Details
                                                    </button>
                                                </a>
                                                
                                                {{-- Permission Error Message --}}
                                                <script>
                                                    function showDocumentViewPermissionError() {
                                                        alert('❌ You don\'t have permission to view this document!');
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="card-footer"></div>
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
@include('layouts.footer')