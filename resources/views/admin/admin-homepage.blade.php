@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    .ease-card{
        border-radius: 16px; 
        width: 228px; 
        height: 110px;
    }
   .circle-wrap {
  width: 80px;
  height: 80px;
  background: white;
  border-radius: 50%;
  position: relative;
  margin: auto;
}

.circle .mask,
.circle .fill {
  width: 80px;
  height: 80px;
  position: absolute;
  border-radius: 50%;
}

.mask {
  clip: rect(0px, 80px, 80px, 40px);
}

.fill {
  background-color: white;
  clip: rect(0px, 40px, 80px, 0px);
  transform: rotate(0deg);
  transition: transform 1s ease-in-out;
}

.inside-circle {
    width: 53px;
    height: 53px;
    border-radius: 50%;
    background: linear-gradient(110.99deg, #3136C1 14.11%, #D84055 87.02%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 13.5px;
    left: 13.5px;
    color: white;
    font-weight: bold;
    font-size: 16px;
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
    <div class="container-fluid" id="container-wrapper" style="overflow-y: auto; scrollbar-width: none; -ms-overflow-style: none;">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1  class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Dashboard</h1>
        </div>

            <div class="row mb-3">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100" style="background: linear-gradient(110.99deg, #3136C1 14.11%, #D84055 87.02%);">
                        <div class="card-body text-center">
                          <a href="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? route('project-list', ['case_status' => 'All']) : '#' }}"
                             onclick="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? '' : 'showProjectPermissionError()' }}"
                             style="text-decoration: none;">
                            <div class="circle-wrap mx-auto mb-2">
                              <div class="circle">
                                <div class="mask full">
                                  <div class="fill fill-total"></div>
                                </div>
                                <div class="mask half">
                                  <div class="fill fill-total" style="background: #329ffe;"></div>
                                </div>
                                <div class="inside-circle" style="background: linear-gradient(110.99deg, #3136C1 14.11%, #D84055 87.02%);">
                                  {{ $projectsCount }}
                                </div>
                              </div>
                            </div>
                            <p style="color:white;">Total Project’s</p>
                          </a>
                        </div>
                    </div>
                </div>
            
            <script>
                function showProjectPermissionError() {
                    alert('❌ You don\'t have permission to view projects!');
                }
            </script>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" style="background: linear-gradient(110.99deg, #FFA201 14.11%, #C74E56 87.02%);">
                <div class="card-body text-center">
                  <a href="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? route('project-list', ['case_status' => 'Pending']) : '#' }}"
                     onclick="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? '' : 'showPendingCasePermissionError()' }}"
                     style="text-decoration: none;">
                    <div class="circle-wrap mx-auto mb-2">
                      <div class="circle">
                        <div class="mask full">
                          <div class="fill fill-pending"></div>
                        </div>
                        <div class="mask half">
                          <div class="fill fill-pending" style="background: linear-gradient(135deg, #0000FF, #3A0CA3);"></div>
                        </div>
                        <div class="inside-circle" style="background: linear-gradient(110.99deg, #FFA201 14.11%, #C74E56 87.02%);">
                          {{ $projectsPendingCount }}
                        </div>
                      </div>
                    </div>
                    <p style="color:white;">Pending Project's</p>
                  </a>
                </div>
              </div>
            </div>
            
            <script>
              function showPendingCasePermissionError() {
                alert('❌ You don\'t have permission to view Pending Projects!');
              }
            </script>

           
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" style="background: linear-gradient(110.99deg, #005AC6 14.11%, #160B83 87.02%);">
                <div class="card-body text-center">
                  <a href="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? route('project-list', ['case_status' => 'In Progress']) : '#' }}"
                     onclick="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? '' : 'showInProgressPermissionError()' }}"
                     style="text-decoration: none;">
                    <div class="circle-wrap mx-auto mb-2">
                      <div class="circle">
                        <div class="mask full">
                          <div class="fill fill-inprogress"></div>
                        </div>
                        <div class="mask half">
                          <div class="fill fill-inprogress" style="background: #fdd201;"></div>
                        </div>
                        <div class="inside-circle" style="background: linear-gradient(110.99deg, #005AC6 14.11%, #160B83 87.02%);">
                          {{ $projectsInProgressCount }}
                        </div>
                      </div>
                    </div>
                    <p style="color:white;">In Progress Project's</p>
                  </a>
                </div>
              </div>
            </div>
            
            <script>
              function showInProgressPermissionError() {
                alert('❌ You don\'t have permission to view In Progress Projects!');
              }
            </script>

            <!-- New User Card Example -->
          
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" style="background: linear-gradient(110.99deg, #EB4886 14.11%, #932F7F 87.02%);">
                <div class="card-body text-center">
                  <a href="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? route('project-list', ['case_status' => 'Complete']) : '#' }}"
                     onclick="{{ $userType == 'Admin' || in_array('manage_case', $permissions) ? '' : 'showCompletePermissionError()' }}"
                     style="text-decoration: none;">
                    <div class="circle-wrap mx-auto mb-2">
                      <div class="circle">
                        <div class="mask full">
                          <div class="fill fill-complete"></div>
                        </div>
                        <div class="mask half">
                          <div class="fill fill-complete" style="background: #4CBB17;"></div>
                        </div>
                        <div class="inside-circle" style="background: linear-gradient(110.99deg, #EB4886 14.11%, #932F7F 87.02%);">
                          {{ $projectsCmpltCount }}
                        </div>
                      </div>
                    </div>
                    <p style="color:white;">Complete Project's</p>
                  </a>
                </div>
              </div>
            </div>
            
            <script>
              function showCompletePermissionError() {
                alert('❌ You don\'t have permission to view Complete Projects!');
              }
            </script>

            <!-- Pending Requests Card Example -->
            
       

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
        
        
        
        <div class="row mb-3">
            
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" style="background: linear-gradient(110.99deg, #3813C2 14.11%, #682874 87.02%);">
                <div class="card-body">
                  <div class="row justify-content-center align-items-center">
                    <a href="{{ $userType == 'Admin' || in_array('list_employee', $permissions) ? route('projectmanage-list') : '#' }}"
                       onclick="{{ $userType == 'Admin' || in_array('list_employee', $permissions) ? '' : 'showListEmployeePermissionError()' }}"
                       style="text-decoration: none;">
                      <div class="col text-center">
                        <img src="{{ asset('assets/img/Vector.png') }}" alt="Project Icon" style="width: 40px; height: 40px;">
                        <p class="mb-1 font-weight-bold" style="color: white;font-size: 24px;">{{ $projectManager }}</p>
                        <p class="mt-1" style="color: white;">Total Project Manager</p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <script>
              function showListEmployeePermissionError() {
                alert('❌ You don\'t have permission to view the Project Manager list!');
              }
            </script>


           {{-- Supervisor --}}
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" style="background: linear-gradient(110.99deg, #552EE5 14.11%, #D41EC2 87.02%);">
                <div class="card-body">
                  <div class="row justify-content-center align-items-center">
                    <a href="{{ $userType == 'Admin' || in_array('list_employee', $permissions) ? route('supervisor-list') : '#' }}"
                       onclick="{{ $userType == 'Admin' || in_array('list_employee', $permissions) ? '' : 'showPermissionErrorSupervisor()' }}"
                       style="text-decoration: none;">
                      <div class="col text-center">
                        <img src="{{ asset('assets/img/Vector.png') }}" alt="Project Icon" style="width: 40px; height: 40px;">
                        <p class="mb-1 font-weight-bold" style="color: white;font-size: 24px;">{{ $totalSupervisor }}</p>
                        <p class="mt-1" style="color: white;">Total Supervisor</p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            {{-- Staff --}}
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" style="background: linear-gradient(110.99deg, #337AB7 14.11%, #4232AE 87.02%);">
                <div class="card-body">
                  <div class="row justify-content-center align-items-center">
                    <a href="{{ $userType == 'Admin' || in_array('list_employee', $permissions) ? route('staff-list') : '#' }}"
                       onclick="{{ $userType == 'Admin' || in_array('list_employee', $permissions) ? '' : 'showPermissionErrorStaff()' }}"
                       style="text-decoration: none;">
                      <div class="col text-center">
                        <img src="{{ asset('assets/img/Vector.png') }}" alt="Project Icon" style="width: 40px; height: 40px;">
                        <p class="mb-1 font-weight-bold" style="color: white;font-size: 24px;">{{ $totalStaff }}</p>
                        <p class="mt-1" style="color: white;">Total Staff</p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            {{-- Customer --}}
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100" style="background: linear-gradient(110.99deg, #B71111 14.11%, #5547B9 87.02%);">
                <div class="card-body">
                  <div class="row justify-content-center align-items-center">
                    <a href="{{ $userType == 'Admin' || in_array('list_customer', $permissions) ? route('customer-list') : '#' }}"
                       onclick="{{ $userType == 'Admin' || in_array('list_customer', $permissions) ? '' : 'showPermissionErrorCustomer()' }}"
                       style="text-decoration: none;">
                      <div class="col text-center">
                        <img src="{{ asset('assets/img/Vector.png') }}" alt="Project Icon" style="width: 40px; height: 40px;">
                        <p class="mb-1 font-weight-bold" style="color: white;font-size: 24px;">{{ $totalCustomer }}</p>
                        <p class="mt-1" style="color: white;">Total Customer's</p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            {{-- Custom Alert Scripts --}}
            <script>
              function showPermissionErrorSupervisor() {
                alert("❌ You don't have permission to view the Supervisor list.");
              }
            
              function showPermissionErrorStaff() {
                alert("❌ You don't have permission to view the Staff list.");
              }
            
              function showPermissionErrorCustomer() {
                alert("❌ You don't have permission to view the Customer list.");
              }
            </script>

       

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
        <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Ease Access</h1> 

     <div class="row mb-3" style="margin-top: 25px;">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ease-card" style="background: linear-gradient(to right, #EB4886, #932F7F);">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                            <div class="col text-center">
                                <a href="{{ $userType == 'Admin' || in_array('add_case', $permissions) ? route('add-project') : '#' }}" 
                                   onclick="{{ $userType == 'Admin' || in_array('add_case', $permissions) ? '' : 'showAbatementPermissionError()' }}" 
                                   style="color: white; text-decoration: none;">
                                    <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                    <p class="mb-1 font-weight-bold" style="color: white;"> Add Abatement/Miscellaneous</p>
                                </a>
                                
                                <script>
                                    function showAbatementPermissionError() {
                                        alert('❌ You don\'t have permission to add a Abatement!');
                                    }
                                </script>       


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ease-card" style="background: linear-gradient(to right, #337AB7, #4232AE);  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);" >
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col text-center">
                            <a href="{{$userType == 'Admin' || in_array('add_case', $permissions) ? route('add-project') : '#'}}" 
                            onclick="{{ $userType == 'Admin' || in_array('add_case', $permissions) ? '' : 'showTestingPermissionError()' }}"
                            style="color: white; text-decoration: none;">
                                <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                <p class="mb-1 font-weight-bold" style="color: white;" >
                                 Add Testing
                                </p>
                            </a>
                            <script>
                                    function showTestingPermissionError() {
                                        alert('❌ You don\'t have permission to add a Testing!');
                                    }
                            </script>  
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
           <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ease-card" style="background: linear-gradient(to right, #B71111, #5547B9);" >
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col text-center">
                            <a href="{{$userType == 'Admin' || in_array('add_employee', $permissions) ?route('add-employer') : '#'}}" 
                            onclick="{{ $userType == 'Admin' || in_array('add_employee', $permissions) ? '' : 'showStaffPermissionError()' }}"
                            style="color: white; text-decoration: none;">
                                <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                <p class="mb-1 font-weight-bold" style="color: white;" >
                                    Add Staff
                                </p>
                            </a>
                             <script>
                                    function showStaffPermissionError() {
                                        alert('❌ You don\'t have permission to add a Staff!');
                                    }
                            </script>  
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ease-card" style="background: linear-gradient(to right, #FFA201, #C74E56);" >
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col text-center">
                            <a href="{{$userType == 'Admin' || in_array('add_employee', $permissions) ?route('add-employer') : '#'}}" 
                            onclick="{{ $userType == 'Admin' || in_array('add_employee', $permissions) ? '' : 'showSupervisorPermissionError()' }}"
                            style="color: white; text-decoration: none;">
                                <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                <p class="mb-1 font-weight-bold" style="color: white;" >Add Supervisor</p>
                            </a>
                            <script>
                                    function showSupervisorPermissionError() {
                                        alert('❌ You don\'t have permission to add a Supervisor!');
                                    }
                            </script> 
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

        </div>
        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ease-card" style="background: linear-gradient(to right, #3813C2, #682874);" >
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col text-center">
                            <a href="{{$userType == 'Admin' || in_array('add_employee', $permissions) ?route('add-employer') : '#'}}" 
                            onclick="{{ $userType == 'Admin' || in_array('add_employee', $permissions) ? '' : 'showWorkerPermissionError()' }}"
                            style="color: white; text-decoration: none;">
                                <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                <p class="mb-1 font-weight-bold" style="color: white;" >Add Worker</p>
                            </a>
                            <script>
                                    function showWorkerPermissionError() {
                                        alert('❌ You don\'t have permission to add a Worker!');
                                    }
                            </script> 
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ease-card" style="background: linear-gradient(to right, #552EE5, #D41EC2);" >
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col text-center">
                            <a href="{{$userType == 'Admin' || in_array('add_employee', $permissions) ?route('add-employer') : '#'}}" 
                            onclick="{{ $userType == 'Admin' || in_array('add_employee', $permissions) ? '' : 'showProjectManagerPermissionError()' }}"
                            style="color: white; text-decoration: none;">
                                <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                <p class="mb-1 font-weight-bold" style="color: white;" >Add Pro. Manager</p>
                            </a>
                            <script>
                                    function showProjectManagerPermissionError() {
                                        alert('❌ You don\'t have permission to add a Project Manager!');
                                    }
                            </script> 
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ease-card" style="background: linear-gradient(to right, #005AC6, #160B83);" >
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col text-center">
                            <a href="{{ $userType == 'Admin' || in_array('add_expense', $permissions) ? route('expense-list') : '#' }}" 
                            onclick="{{ $userType == 'Admin' || in_array('add_expense', $permissions) ? '' : 'showExpensePermissionError()' }}"
                            style="color: white; text-decoration: none;">
                                <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                <p class="mb-1 font-weight-bold" style="color: white;" >Add Expense</p>
                            </a>
                            <script>
                                    function showExpensePermissionError() {
                                        alert('❌ You don\'t have permission to add a Expense!');
                                    }
                            </script> 
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ease-card" style="background: linear-gradient(to right, #3136C1, #D84055);" >
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col text-center">
                            <a href="{{ $userType == 'Admin' || in_array('add_customer', $permissions) ? route('add-customer') : '#' }}" 
                            onclick="{{ $userType == 'Admin' || in_array('add_customer', $permissions) ? '' : 'showCustomerPermissionError()' }}"
                            style="color: white; text-decoration: none;">
                                <i class="fas fa-fw fa-plus fa-2x" style="color:white;"></i>
                                <p class="mb-1 font-weight-bold" style="color: white;" >Add Customer</p>
                            </a>
                            <script>
                                    function showCustomerPermissionError() {
                                        alert('❌ You don\'t have permission to add a Customer!');
                                    }
                            </script> 
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

        </div>
<!--<ol class="breadcrumb">-->
        <!---Container Fluid-->
      </div>
        <!---Container Fluid-->
      </div>
<script>
  const total = {{ $projectsCount }}; // 25
  const pending = {{ $projectsPendingCount }}; // 11
  const inProgress = {{ $projectsInProgressCount }}; // 11
  const complete = {{ $projectsCmpltCount }}; // 3

  function applyRotation(className, count) {
    const percent = (count / total) * 100;
    const rotation = (percent / 100) * 360;

    document.querySelectorAll(`.${className}`).forEach((el, index) => {
      // If rotation > 180deg, split across two masks
      if (rotation <= 180) {
        el.style.transform = `rotate(${rotation}deg)`;
      } else {
        if (index % 2 === 0) {
          // full mask
          el.style.transform = 'rotate(180deg)';
        } else {
          // half mask
          el.style.transform = `rotate(${rotation - 180}deg)`;
        }
      }
    });
  }

  // Full circle for total projects
  applyRotation("fill-total", total);

  // Visual progress
  applyRotation("fill-pending", pending);
  applyRotation("fill-inprogress", inProgress);
  applyRotation("fill-complete", complete);
</script>




      <!-- Footer -->
      @include('layouts.footer')