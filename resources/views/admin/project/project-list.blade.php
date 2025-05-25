@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
.caseTypeHeading{
   font-size: 20px;
    color: rgba(255, 255, 255, 0.9);
    font-weight: bold;
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);
    text-align: center;
    height: 30px;
    padding: 3px;
}
/*.active {*/
    /*background-color: #007bff; */
/*    border-color: #007bff;*/
/*    color: white;*/
/*}*/

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    .custom-table th,
    .custom-table td {
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
        margin-top: 49px;
    }

    .tab {
        padding: 10px 20px;
        margin: 0 10px;
        border: 2px solid #D84055;
        border-radius: 5px;
        cursor: pointer;

        color: #e45757;
        font-weight: bold;
        transition: background-color 0.3s, color 0.3s;
    }

    .tab.active {
        background-color: #D84055;
        color: white;
    }

    .project-card {
        background-color: #FDF5F6 !important;
        border: 1px solid #D8405533;


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

    .btn {
        padding: 10px 20px;
        margin: 5px;
        border: 2px solid #3136C1;
        cursor: pointer;
        font-weight: bold;
       
    }
    .color-chnge{
         color:#3136C1;
    }
    .color-chnge:hover{
        color: #D84055;
    }

    .btn.active {
        /*background-color: #D84055;*/
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);
        border: none;
        color: white;
    }

    .case-container {
        border: 1px solid #ddd;
        padding: 15px;
        margin: 10px;
        border-radius: 5px;
    }

    .btn-view {
        background-color: red;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

   .project-card {
    border: 1px solid #D84055;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(216, 64, 85, 0.1);
    background: #fff;
    padding: 10px; 
    font-size: 12px; 
    width: 100%; 
}

.case-info {
    margin-bottom: 5px;
}

.case-info label {
    font-size: 15px; 
    font-weight: bold;
    color: #D84055;
}

.form-control.projectDetails {
   background: #fff;
    border: 1px solid #ccc;
    padding: 8px;
    font-size: 14px;
    border-radius: 3px;
    height: 32px;
    line-height: 20px;
    color: black;
}



.text-center {
    margin-top: 5px; 
}

@media (max-width: 768px) {
    .col-lg-4 {
        width: 50%; 
    }
}

@media (max-width: 480px) {
    .col-lg-4 {
        width: 100%; 
    }
}

/**/
.projectDetails {
    width: 100%;
    min-height: 40px;
    padding: 8px;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    background-color: white;
}

.case-info label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.case-info {
    display: block;
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
    $permissionsArray = is_array($permissions) ? $permissions : $permissions->toArray();
@endphp
 
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;">Project
        </h1>
        <a href="{{ $userType == 'Admin' || in_array('add_case', $permissions) ? route('add-project') : '#' }}">
            <button class="btn btn-primary"
                style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;"
                onclick="{{ $userType == 'Admin' || in_array('add_case', $permissions) ? '' : 'showAddCasePermissionError(event)' }}">
                + Add Case
            </button>
        </a>

        
        <script>
            function showAddCasePermissionError(event) {
                event.preventDefault(); 
                alert('❌ You don\'t have permission to add a Case!');
            }
        </script>

    </div>
    <!--Row-->
    <div class="row d-flex justify-content-center">
        <div class="col-lg-12 mb-4">
            <div class="d-flex justify-content-end mb-3" style="margin-right: 40%; margin-top: -61px;">
                <p class="fw-bold" style="margin-right: 5px;">Search</p>
                <input type="text" id="searchInput" class="form-control form-control-sm w-27" placeholder="Search..." onkeyup="filterCards()" style="max-width: 253px;">
            </div>

            <!-- Status Filter Buttons with Counts -->
           <div class="d-flex justify-content-center gap-3 mb-3">
                <!-- All Button -->
                <form action="{{ route('project-list') }}" method="GET" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm {{ (request('case_status') == 'All' || request('case_status') == null) ? 'active' : '' }}">
                        <i class="fas fa-list"></i> All
                        <span class="badge badge-light">{{ $totalCount }}</span>
                    </button>
                </form>
            
                <!-- Pending Button -->
                <form action="{{ route('project-list') }}" method="GET" class="d-inline">
                    @csrf
                    <input type="hidden" name="case_status" value="Pending">
                    <button type="submit" class="btn btn-outline-primary btn-sm {{ request('case_status') == 'Pending' ? 'active' : '' }}">
                        <i class="fas fa-hourglass-half"></i> Pending 
                        <span class="badge badge-light">{{ $pendingCount }}</span>
                    </button>
                </form>
            
                <!-- In Progress Button -->
                <form action="{{ route('project-list') }}" method="GET" class="d-inline">
                    @csrf
                    <input type="hidden" name="case_status" value="In Progress">
                    <button type="submit" class="btn btn-outline-warning btn-sm {{ request('case_status') == 'In Progress' ? 'active' : '' }}">
                        <i class="fas fa-spinner"></i> In Progress 
                        <span class="badge badge-light">{{ $inProgressCount }}</span>
                    </button>
                </form>
            
                <!-- Complete Button -->
                <form action="{{ route('project-list') }}" method="GET" class="d-inline">
                    @csrf
                    <input type="hidden" name="case_status" value="Complete">
                    <button type="submit" class="btn btn-outline-success btn-sm {{ request('case_status') == 'Complete' ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i> Complete 
                        <span class="badge badge-light">{{ $completeCount }}</span>
                    </button>
                </form>
            </div>

            <!-- Simple Tables -->
            <div class="card" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div style="display: flex; justify-content: center; gap: 10px;padding:17px;">
                    <form action="{{ route('clear-case-type') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ !$caseType ? 'active' : '' }}">All Case Types</button>
                    </form>
                
                    <form action="{{ route('set-case-type') }}" method="POST">
                        @csrf
                        <input type="hidden" name="case_type" value="Testing">
                        <button type="submit" class="btn {{ $caseType == 'Testing' ? 'active' : '' }}" id="btnTesting">Testing</button>
                    </form>
                
                    <form action="{{ route('set-case-type') }}" method="POST">
                        @csrf
                        <input type="hidden" name="case_type" value="Abatement/Miscellaneous">
                        <button type="submit" class="btn {{ $caseType == 'Abatement/Miscellaneous' ? 'active' : '' }}" id="btnAbatement">Abatement/Miscellaneous</button>
                    </form>
                </div>

                <div class="row d-flex justify-content-center" style="margin: 2px;">
                   @if($projects->isEmpty())
                        <div class="col-12 text-center mt-4">
                            <h4 class="text-muted">
                                @if($selectedStatus !== 'All')
                                    No {{ $selectedStatus }} projects found for {{ $caseType }}.
                                @else
                                    No projects found for {{ $caseType }}.
                                @endif
                            </h4>
                        </div>
                    @else
                        @foreach ($projects as $project)
                            <div class="col-lg-4 mb-4">
                                <div class="project-card p-3">
                                    <h3 class="caseTypeHeading">{{ $project->case_type ?? 'N/A'}}</h3>
                                    <div class="case-info">
                                        <label class="fw-bold">Case ID/Job Number</label>
                                        <div class="form-control projectDetails">{{ $project->case_id ?? 'N/A'}}</div>
                                    </div>
                                    <!--<div class="case-info">-->
                                    <!--    <label class="fw-bold">Case Name</label>-->
                                    <!--    <div class="form-control projectDetails">{{ $project->case_name ?? 'N/A' }}</div>-->
                                    <!--</div>-->
                                    <div class="case-info">
                                        <label class="fw-bold">Customer Name</label>
                                        <div class="form-control projectDetails">{{ $project->customer->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="case-info">
                                        <label class="fw-bold">
                                            @if($project->case_type == 'Abatement/Miscellaneous')
                                                Assigned Supervisor
                                            @else
                                                Assigned Project Manager
                                            @endif
                                        </label>

                                        <div class="form-control projectDetails">
                                            {{ $project->employee->full_name ?? 'N/A' }}
                                        </div>
                                    </div>
                    
                                    <div class="case-info">
                                        <label class="fw-bold">Case Status</label>
                                        <div class="form-control projectDetails">{{ $project->case_status ?? 'N/A' }}</div>
                                    </div>
                                    <div class="case-info">
                                        <label class="fw-bold">Case Date</label>
                                        <div class="form-control projectDetails">
                                            {{ $project->case_start_date ? \Carbon\Carbon::parse($project->case_start_date)->format('M d Y') : 'N/A' }}
                                        </div>
                                    </div>
                    
                                    <div class="case-info">
                                        <label class="fw-bold">Case Location</label>
                                        <div class="form-control projectDetails">{{ $project->case_location ?? 'N/A' }}</div>
                                    </div>
                    
                                    @if($project->last_report)
                                        <div class="case-info">
                                            <label class="fw-bold">State/Federal Start Date</label>
                                            <div class="form-control projectDetails">{{ \Carbon\Carbon::parse($project->last_report->start_date)->format('M d Y') ?? 'N/A' }}</div>
                                        </div>
                                        <div class="case-info">
                                            <label class="fw-bold">State/Federal End Date</label>
                                            <div class="form-control projectDetails">{{ \Carbon\Carbon::parse($project->last_report->end_date)->format('M d Y') ?? 'N/A' }}</div>
                                        </div>
                                    @endif
                    
                                    <div class="text-center mt-3">
                                        <a href="{{ $userType == 'Admin' || in_array('view_case', $permissionsArray) ? route('project-details', ['projectId' => $project->id]) : '#' }}">
                                            <button class="btn btn-danger"
                                                style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;"
                                                onclick="{{ $userType == 'Admin' || in_array('view_case', $permissionsArray) ? '' : 'showViewProjectPermissionError(event)' }}">
                                                View Details
                                            </button>
                                        </a>
                                    </div>
                    
                                    <script>
                                        function showViewProjectPermissionError(event) {
                                            event.preventDefault(); 
                                            alert('❌ You don\'t have permission to view project details!');
                                        }
                                    </script>
                    
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
<!---Container Fluid-->
</div>
<script>
    function filterCards() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let cards = document.getElementsByClassName('project-card');

        for (let i = 0; i < cards.length; i++) {
            let cardText = cards[i].innerText.toLowerCase();
            if (cardText.includes(input)) {
                cards[i].parentElement.style.display = '';
            } else {
                cards[i].parentElement.style.display = 'none';
            }
        }
    }
</script>
<script>
    $(document).ready(function () {
        $('#btnTesting').click(function () {
            updateCaseType('Testing');
        });

        $('#btnAbatement').click(function () {
            updateCaseType('Abatement/Miscellaneous');
        });

        function updateCaseType(caseType) {
            $.ajax({
                url: '{{ route("update.case.type") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    case_type: caseType
                },
                success: function (response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        }
    });
</script>
@include('layouts.footer')
<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        @if(session('message'))
            toastr.success("{{ session('message') }}");
        @endif

        @if($errors->has('error'))
            toastr.error("{{ $errors->first('error') }}");
        @endif
    });
</script>

