@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- Bootstrap CSS -->
<style>

.container-fluid {
    height: calc(100vh - 60px);
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding-top: 85px;
}
    .card .table td, .card .table th {
        padding-right: 1.5rem;
        padding-left: 0.5rem;
        height: 37px;
    }
    .select2-container--open .select2-search__field {
        width: 100% !important;
        height: auto !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .select2-search__field {
        pointer-events: auto !important;
        opacity: 1 !important;
        visibility: visible !important;
        background-color: #fff !important;
        color: #000 !important;
    }
    .select2-dropdown {
        z-index: 99999 !important;
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
        background-color: #FDF5F6 !important;
        border-color: #D8405533 !important;
    }

    .custom-table thead.thead-light th {
        /*background-color: #D84055 !important;*/
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%) !important; border: none;
        color: white !important;
        font-weight: bold;
    }
    
    .custom-modal {
        border-radius: 8px;
        overflow: hidden;
    }

    .custom-modal-header {
        /*background-color: #D84055;*/
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
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
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Expenses / <span style=" color:black !important; font-weight: 600; font-size: 22px;">Expense List</span></h1>            <!--<ol class="breadcrumb">-->
            <!--  <li class="breadcrumb-item"><a href="./">Home</a></li>-->
            <!--  <li class="breadcrumb-item">Tables</li>-->
            <!--  <li class="breadcrumb-item active" aria-current="page">DataTables</li>-->
            <!--</ol>-->
            <div>
                @php
                    $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                @endphp
                
                <button class="btn btn-primary" style="margin-right: 40px; background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;" 
                    data-toggle="modal" 
                    data-target="{{ $userType == 'Admin' || in_array('add_expense', $permissionsArray) ? '#addexpenseModal' : '' }}" 
                    onclick="{{ $userType == 'Admin' || in_array('add_expense', $permissionsArray) ? '' : 'showAddExpensePermissionError()' }}">
                    +Add Expense
                </button>
                
                @include('admin.expenses.add-expense')
                
                <script>
                    function showAddExpensePermissionError() {
                        alert('❌ You don\'t have permission to add an expense!');
                    }
                </script>
            </div>
          </div>
        <form method="GET" action="{{ route('expense-list') }}" id="caseIdFilter">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="case_id">Case ID/Job Number</label>
                    <input type="text" name="case_id" class="form-control" value="{{ request('case_id') }}" placeholder="Case ID/Job Number">
                </div>
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 68px;">Filter</button>
                    <a href="{{ route('expense-list') }}" class="btn btn-danger ml-2" style="margin-top: 10px;width: 68px;">Clear</a>
                </div>
            </div>
        </form>
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
              
                <div class="table-responsive p-3">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            {{ session('message') }}
                        </div>
                    @endif  
                    
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                        	<button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                  <table class="table align-items-center table-flush custom-table" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="border: 1px solid white;" >Date</th>
                            <th style="border: 1px solid white;" >Case ID/Job Number</th>
                            <th style="border: 1px solid white;">Expense Name</th>
                            <th style="border: 1px solid white;">Category</th>
                            <th style="border: 1px solid white;">Expense Amount</th>
                            <th style="border: 1px solid white;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($expenseDetails && $expenseDetails->isNotEmpty())
                            @foreach($expenseDetails as $expenseDetails)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($expenseDetails->date)->format('F d Y') }}</td>
                                <td>{{$expenseDetails->case_id ?? 'N/A'}}</td>
                                <td>{{$expenseDetails->expense_name}}</td>
                                <td>{{$expenseDetails->category}}</td>
                                <td>{{$expenseDetails->amount}}</td>
                                @php
                                    $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                                @endphp
                                
                                <td class="action-icons">
                                    {{-- Edit Expense --}}
                                    <a href="javascript:void(0);" 
                                        class="edit-btn" 
                                        data-toggle="{{ $userType == 'Admin' || in_array('edit_expense', $permissionsArray) ? 'modal' : '' }}" 
                                        data-target="{{ $userType == 'Admin' || in_array('edit_expense', $permissionsArray) ? '#editExpenseModal' : '' }}"
                                        data-id="{{ $expenseDetails->id }}"
                                        data-case_id="{{ $expenseDetails->case_id }}"
                                        data-expense_name="{{ $expenseDetails->expense_name }}"
                                        data-category="{{ $expenseDetails->category }}"
                                        data-date="{{ $expenseDetails->date }}"
                                        data-amount="{{ $expenseDetails->amount }}"
                                        data-note_remarks="{{ $expenseDetails->note_remarks }}"
                                        data-url="{{ route('update.expense', $expenseDetails->id) }}" 
                                        onclick="{{ $userType == 'Admin' || in_array('edit_expense', $permissionsArray) ? '' : 'showEditExpensePermissionError()' }}"
                                        title="Edit">
                                        <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit">
                                    </a>
                                    @include('admin.expenses.edit-expense')
                                
                                    {{-- View Expense --}}
                                    <a href="{{ $userType == 'Admin' || in_array('view_expense', $permissionsArray) ? route('view.expense', $expenseDetails->id) : 'javascript:void(0);' }}" 
                                        title="View" 
                                        onclick="{{ $userType == 'Admin' || in_array('view_expense', $permissionsArray) ? '' : 'showViewExpensePermissionError()' }}">
                                        <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View Status">
                                    </a>
                                
                                    {{-- Delete Expense --}}
                                    <a href="javascript:void(0);" 
                                        onclick="{{ $userType == 'Admin' || in_array('delete_expense', $permissionsArray) ? "deleteExpense($expenseDetails->id)" : "showDeleteExpensePermissionError()" }}" 
                                        title="Delete">
                                        <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                                    </a>
                                </td>
                                
                                {{-- Permission Error Messages --}}
                                <script>
                                    function showEditExpensePermissionError() {
                                        alert('❌ You don\'t have permission to edit this expense!');
                                    }
                                    function showViewExpensePermissionError() {
                                        alert('❌ You don\'t have permission to view this expense!');
                                    }
                                    function showDeleteExpensePermissionError() {
                                        alert('❌ You don\'t have permission to delete this expense!');
                                    }
                                </script>
                            </tr>
                            @endforeach
                        @endif
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


<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>

<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script>
    $('#dataTable').DataTable({
        columnDefs: [
            { targets: 0, searchable: true }, 
            { targets: '_all', searchable: true }
        ]
    });
    

    $(document).ready(function() {
        $('#project_case_id').select2({
            width: '100%',
            placeholder: "Select Case ID",
            allowClear: true,
            dropdownParent: $('#project_case_id').parent()
        });
    });
</script>


<script>
    $(document).ready(function () {
       
        // if ($.fn.DataTable) {
        //     $('#dataTable').DataTable();
        //     $('#dataTableHover').DataTable();
        // } else {
        //     console.error("DataTable is not available. Check script loading order.");
        // }

        $(".date-picker").datepicker({
            dateFormat: "MM dd yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2100"
        });

        $("#expenseForm").on("submit", function () {
            $(".date-picker").each(function () {
                let input = $(this);
                let parts = input.val().split("-");
                if (parts.length === 3) {
                    input.val(parts[2] + "-" + parts[0] + "-" + parts[1]);
                }
            });
        });

        $(document).on('click', '.edit-btn', function () {
            let id = $(this).data('id');
            let caseId = $(this).data('case_id'); 
            let expenseName = $(this).data('expense_name');
            let date = $(this).data('date');
            let category = $(this).data('category');
            let amount = $(this).data('amount');
            let noteRemarks = $(this).data('note_remarks');
            let url = $(this).data('url');
        
            let formattedDate = new Date(date).toLocaleDateString('en-US', {
                month: 'long', 
                day: '2-digit',  
                year: 'numeric'  
            });
        
            $('#editExpenseModal #expense_id').val(id);
            $('#editExpenseModal #edit_case_id').val(caseId);
            $('#editExpenseModal #expense_name').val(expenseName);
            $('#editExpenseModal #category').val(category);
            $('#editExpenseModal #editdate').val(formattedDate);  
            $('#editExpenseModal #amount').val(amount);
            $('#editExpenseModal #note_remarks').val(noteRemarks);
            $('#expenseEditForm').attr('action', url);
        });

    });

    function deleteExpense(expenseId) {
        if (confirm('Are you sure you want to delete this Expense?')) {
            $.ajax({
                url: `/delete-expense/${expenseId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    alert(response.message);
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    }
</script>


