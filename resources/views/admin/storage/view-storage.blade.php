@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
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

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('storage.index') }}" style="text-decoration: none; color: black;">File Storage/</a><span style="color:black !important; font-weight: 600; font-size: 22px;">{{ $folder->name }}</span>
        </h1>
        
        <button class="btn btn-primary" style="margin-right: 40px; background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;" 
                    data-toggle="modal" 
                    data-target="{{ $userType == 'Admin' || in_array('add_storage', $permissionsArray) ? '#addFileModal' : '' }}" 
                    onclick="{{ $userType == 'Admin' || in_array('add_storage', $permissionsArray) ? '' : 'showAddStoragePermissionError()' }}">
                    +Upload File
                </button>
                
                @include('admin.storage.add-file')
                
                <script>
                    function showAddFolderPermissionError() {
                        alert('❌ You don\'t have permission to add an e ');
                    }
                </script>
    </div>
    
  

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; font-size: 20px; font-weight: bold;">
                    {{ $folder->name }}
                </div>
                <div class="card-body">
                    <div class="row">
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
                                        <th style="border: 1px solid white;">#</th>
                                        <th style="border: 1px solid white;">File</th>
                                        <th style="border: 1px solid white;">Size</th>
                                        <th style="border: 1px solid white;">Created At</th>
                                        <th style="border: 1px solid white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($files && $files->isNotEmpty())
                                        @foreach($files as $file)
                                        
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                             {{ \Illuminate\Support\Str::before($file['name'], '_') }}

                                            </td>
                                            <td>{{$file['size']}}</td>
                                           <td>{{ \Carbon\Carbon::parse($file['created_at'])->format('M d, Y H:i:s') }}</td>

                                            @php
                                                $permissionsArray = is_array($permissions) ? $permissions : $permissions->pluck('name')->toArray();
                                            @endphp
                                            
                                            <td class="action-icons">
                                                {{-- View Storage --}}
                                                <a download href="{{ $userType == 'Admin' || in_array('view_storage', $permissionsArray) ? $file['url'] : 'javascript:void(0);' }}" 
                                                    title="Download" 
                                                    onclick="{{ $userType == 'Admin' || in_array('view_expense', $permissionsArray) ? '' : 'showViewStoragePermissionError()' }}">
                                                    <svg style="width: 19px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                                                </a>
                                            
                                                {{-- Delete Storage --}}
                                                
                                                <a onclick="deleteFile('{{ $folder->name }}', '{{ $file['name'] }}')" title="Delete">
                                                    <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete">
                                                </a>
                                                
                                                <a href="{{ $userType == 'Admin' || in_array('view_storage', $permissionsArray) 
                                                            ? route('view.storage.file', ['folderId' => $folder->id, 'user' => $folder->user_id, 'folder' => $folder->name, 'file' => $file['name']]) 
                                                            : 'javascript:void(0);' }}" 
                                                   title="View" 
                                                   onclick="{{ $userType == 'Admin' || in_array('view_expense', $permissionsArray) 
                                                               ? '' 
                                                               : 'showViewStoragePermissionError()' }}">
                                                    <img src="{{ asset('assets/img/View-Icon.png') }}" alt="View Status">
                                                </a>

                                            </td>
                                            
                                            {{-- Permission Error Messages --}}
                                            <script>
                                                function showEditStoragePermissionError() {
                                                    alert('❌ You don\'t have permission to edit this expense!');
                                                }
                                                function showViewStoragePermissionError() {
                                                    alert('❌ You don\'t have permission to view this expense!');
                                                }
                                                function showDeleteStoragePermissionError() {
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
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('storage.index') }}" class="btn btn-secondary">Back</a>
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
</div>

</div>

<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $('#dataTable').DataTable({
        "ordering": true,
        "order": [[0, 'desc']],
        "columnDefs": [
            { targets: 0, searchable: true },
            { targets: '_all', searchable: true }
        ]
    });

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

<script>
 

 function deleteFile(folder, filename) { 
        if (confirm('Are you sure you want to delete this file?')) {
            $.ajax({
                url: `/delete-file-folder/${folder}/${filename}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert(response.message); 
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    }
</script>

</script>

@include('layouts.footer')
