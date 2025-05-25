@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<style>
    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin: auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .permissions-group {
        display: flex;
        justify-content: space-between;
    }

    .permission-column {
        flex: 1;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
    }

    .btn-secondary {
        background-color: #f0f0f0;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
    }

    .btn-outline-primary {
        color: #6e707e;
        border-color: #eaebf3;
        -webkit-box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        border-radius: .25rem;
    }

    .btn-outline-primary:hover {
        color: #fff;
        background-color: #6e707e;
        border-color: #6e707e;
    }
</style>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;"> <a href="{{ route('permissions.index') }}" style="text-decoration: none; color: black;">Permission/</a>
        <span style="color:black !important; font-weight: 600; font-size: 22px;">New Role & Permission</span></h1>
    </div>
    @if(session('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('error') }}
    </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
$moduleOrder = [
    'Customer',
    'Project',
    'Document',
    'Invoice & Payment',
    'Expenses',
    'Employer',
    'Permission',
    'Project/Sales Report',
    'Expense Report',
    'General',
   
    
    // default ya baaki sab modules last me
];
$groupedPermissions = collect($permissions)->groupBy(function ($item) {
    $name = $item->display_name;

    if (str_contains($name, 'Expense Report')) {
        return 'Expense Report';
    }

    if (str_contains($name, 'Project Sales Report')) {
        return 'Project/Sales Report';
    }

    if (str_contains($name, 'Invoice')) {
        return 'Invoice & Payment';
    }

    if (str_contains($name, 'Expense')) {
        return 'Expenses';
    }

    if (str_contains($name, 'Employee')) {
        return 'Employer';
    }

    if (str_contains($name, 'Case')) {
        return 'Project';
    }

    $parts = explode(' ', $name);
    return isset($parts[1]) ? $parts[1] : $parts[0];
});

// Order by moduleOrder
$groupedPermissions = collect($groupedPermissions)->sortBy(function ($_, $key) use ($moduleOrder) {
    $index = array_search($key, $moduleOrder);
    return $index === false ? 999 : $index;
});
@endphp





<form action="{{ route('assign.permission') }}" method="POST">
    @csrf
    <div class="form-container">
        <div class="form-group">
            <label for="role_name">Name:<span class="text-danger">*</span></label>
            <input type="text" name="role_name" value="{{ old('role_name') }}" class="form-control" style="width: 67%;" placeholder="Role Name" required>
            @error('role_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
  

        <!--<div class="form-group">-->
        <!--    <label>Module Permissions:<span class="text-danger">*</span></label>-->
        <!--    <div class="row">-->
        <!--        @foreach($permissions as $key => $permission)-->
        <!--            <div class="col-md-3 mb-2">-->
        <!--                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">-->
        <!--                {{ $permission->display_name }}-->
        <!--            </div>-->
        <!--            @if(($key + 1) % 4 == 0)-->
        <!--    </div>-->
        <!--    <div class="row">-->
        <!--            @endif-->
        <!--        @endforeach-->
        <!--    </div>-->
        <!--    @error('permissions')-->
        <!--        <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->
        <div class="form-group">
    <label>Permissions:<span class="text-danger">*</span></label>

    @foreach($groupedPermissions as $group => $permissionGroup)
        <div class="row align-items-start mb-3">
            <!-- Left Label -->
            <div class="col-md-3 font-weight-bold">
                {{ ucfirst(str_replace('_', ' ', $group)) }}:
            </div>

            <!-- Right Permissions -->
            <div class="col-md-9">
                <div class="row">
                    @foreach($permissionGroup as $permission)
                        <div class="col-md-4 mb-2">
                            <label>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                {{ $permission->display_name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    @error('permissions')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


        <div>
            <button type="submit" class="btn btn-primary"
                style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">Save</button>
            <a href="{{route('permissions.index')}}" class="btn btn-outline-primary">Cancel</a>
        </div>
    </div>
</form>

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
    document.querySelector("form").addEventListener("submit", function(event) {
        let checkboxes = document.querySelectorAll('input[name="permissions[]"]:checked');
        if (checkboxes.length === 0) {
            alert("Please select at least one permission.");
            event.preventDefault(); // Form submit होने से रोक देगा
        }
    });
</script>

</div>
@include('layouts.footer')