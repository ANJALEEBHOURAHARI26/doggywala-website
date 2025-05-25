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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; font-size: 20px; font-weight: bold;">
                   
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                          
                            <div class="table-responsive p-3">
                                
                            <div style="width: 850px; margin: auto;">
                                        <h3>Preview: {{ \Illuminate\Support\Str::before($fileName, '_') }}</h3>
                                    
                                        @php
                                            use Illuminate\Support\Str;
                                        @endphp
                                    
                                        @if (Str::startsWith($mimeType, 'image/'))
                                            <img src="{{ $fileUrl }}" alt="Image" style="width: 100%; height: auto;" />
                                        
                                        @elseif ($mimeType === 'application/pdf')
                                            <iframe src="{{ $fileUrl }}" width="100%" height="600px"></iframe>
                                        
                                        @elseif (
                                            $mimeType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
                                            $mimeType === 'application/vnd.ms-excel'
                                        )
                                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($fileUrl) }}" width="100%" height="600px"></iframe>
                                        
                                        @elseif ($mimeType === 'text/csv')
                                            @php
                                                $csvContent = file_get_contents(public_path(parse_url($fileUrl, PHP_URL_PATH)));
                                                $lines = explode(PHP_EOL, $csvContent);
                                                $rows = array_map('str_getcsv', $lines);
                                            @endphp
                                    
                                            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
                                                @foreach ($rows as $row)
                                                    @if (!empty(array_filter($row)))
                                                        <tr>
                                                            @foreach ($row as $cell)
                                                                <td>{{ $cell }}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        
                                        @elseif (Str::startsWith($mimeType, 'video/'))
                                            <video width="100%" height="auto" controls>
                                                <source src="{{ $fileUrl }}" type="{{ $mimeType }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        
                                        @else
                                            <p>Preview not supported for this file type. <a href="{{ $fileUrl }}" target="_blank">Download File</a></p>
                                        @endif
                                    </div>

                        
                            </div> 
                        </div>
                    </div>
                </div> 

                <div class="card-footer text-right">
                    <a href="{{ route('storage.view', $folderId) }}" class="btn btn-secondary">Back</a>
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
        columnDefs: [
            { targets: 0, searchable: true }, 
            { targets: '_all', searchable: true }
        ]
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

<script>
 
 
</script>

</script>

@include('layouts.footer')
