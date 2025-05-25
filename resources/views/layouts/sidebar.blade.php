<style>
.nav-item > .nav-link {
    color: white !important;
    transition: background 0.3s ease;
}

.nav-item > .nav-link:hover,
.nav-item.active > .nav-link {
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%) !important;
    /*background: #D84055;*/
    color: white !important;
    border-radius: 5px;
}

.collapse-item.active {
    background-color: white !important;
    color: black !important;
    font-weight: bold;
    border-radius: 5px;
}
</style>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <div class="sidebar-brand-wrapper">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}" style="background-color: white;">
        @php
            $settings = DB::table('general_setting')->first();
        @endphp
        <div class="sidebar-brand-icon">
            <img src="{{ asset($settings->logo ?? 'img/new-side-icon.png') }}" style="width:221px; max-height: 63px;">
        </div>
    </a>
    </div>

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

        // Wrap the function to prevent duplicate declaration error
        if (! function_exists('isActiveRoute')) {
            function isActiveRoute($routeNames) {
                foreach ((array)$routeNames as $route) {
                    if (Request::routeIs($route)) {
                        return 'active';
                    }
                }
                return '';
            }
        }
    @endphp
<div class="sidebar-menu-items">
    <li class="nav-item {{ isActiveRoute('admin.dashboard') }}" style="margin-top: 20px;" >
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
   
    <!-- Customer Module -->
    @php
        $customerActive = isActiveRoute(['add-customer', 'customer-list','customer.edit','customer.view']);
    @endphp
    @if($userType == 'Admin' || in_array('add_customer', $permissions) || in_array('list_customer', $permissions))
        <li class="nav-item {{ $customerActive }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
                aria-expanded="true" aria-controls="collapseCustomer">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Customer</span>
            </a>
            <div id="collapseCustomer" class="collapse {{ $customerActive ? 'show' : '' }}" aria-labelledby="headingCustomer" data-parent="#accordionSidebar">
                <div class="bg-black py-2 collapse-inner rounded">
                    @if($userType == 'Admin' || in_array('add_customer', $permissions))
                        <a class="collapse-item {{ isActiveRoute('add-customer') }}" href="{{ route('add-customer') }}">Add Customer</a>
                    @endif
                    @if($userType == 'Admin' || in_array('list_customer', $permissions))
                        <a class="collapse-item {{ isActiveRoute(['customer-list', 'customer.edit','customer.view']) }}" href="{{ route('customer-list') }}">Customer List</a>
                    @endif

                </div>
            </div>
        </li>
    @endif
   
    <!-- Project Module -->
    @php
        $projectActive = isActiveRoute([
            'add-project', 'project-list', 'project-details','appointment-project',
            'project-report','view.report','project-estimation','view-estimation',
            'final-report','view.finalReport','project-invoice','view.invoice.payment',
            'sheetlist','project-sheet','daily-log','containment-sheet','project-Asbestos',
            'project-signIn','project-Personal-Air-Sampling-Worksheet','project-Personal-Air-Sampling-Worksheet-2',
            'employer.detail'
        ]);
    @endphp
    @if($userType == 'Admin' || in_array('manage_case', $permissions))
        <li class="nav-item {{ $projectActive }}">
            <a class="nav-link" href="{{ route('project-list') }}">
                <i class="fas fa-fw fa-project-diagram"></i>
                <span>Project</span>
            </a>
        </li>
    @endif
    
    <!-- Document Module -->
    @php
        $documentActive = isActiveRoute([
            'document-list', 'document-detail'
        ]);
    @endphp
    @if($userType == 'Admin' || in_array('manage_document', $permissions))
        <li class="nav-item {{ $documentActive }}">
            <a class="nav-link" href="{{ route('document-list') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Document</span>
            </a>
        </li>
    @endif
    
    <!-- Invoice & Payment Module -->
    @php
        $invoicePaymentActive = isActiveRoute([
            'get-invoices-detail', 'invoices-create'
        ]);
         
    @endphp
    <li class="nav-item {{ $invoicePaymentActive }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInvoices"
                aria-expanded="true" aria-controls="collapseInvoices">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Invoice Manage</span>
            </a>
            <div id="collapseInvoices" class="collapse {{ $customerActive ? 'show' : '' }}" aria-labelledby="headingCustomer" data-parent="#accordionSidebar">
                <div class="bg-black py-2 collapse-inner rounded">

                        <a class="collapse-item {{ isActiveRoute('invoices-create') }}" href="{{ route('invoices-create') }}">Add Invoice</a>

                        <a class="collapse-item {{ isActiveRoute('get-invoices-detail') }}" href="{{ route('get-invoices-detail') }}">Invoice List</a>
                  

                </div>
            </div>
        </li>
    
     <!-- Invoice & Payment Module -->
    @php
        $EstimationActive = isActiveRoute([
            'project-estimation-second', 'view-estimation-second', 'edit-estimation-second'
        ]);
        
    @endphp
    @if($userType == 'Admin' || in_array('view_invoice_payment', $permissions))
        <li class="nav-item {{ $EstimationActive }}">
            <a class="nav-link" href="{{ route('project-estimation-second') }}">
                <i class="fas fa-fw fa-file-invoice-dollar"></i>
                <span>Estimation</span>
            </a>
        </li>
    @endif
    
    @if($userType == 'Admin')
        <li class="nav-item @if(Request::segment(1) == 'storage') active {{request()->segment(0)}} @endif">
            <a class="nav-link" href="{{ route('storage.index') }}">
                <i class="fas fa-fw fa-database"></i>
                <span>File Storage</span>
            </a>
        </li>
    @endif
    
    <!-- Expenses Module -->
    @php
        $expenseActive = isActiveRoute([
            'expense-list', 'view.expense'
        ]);
    @endphp
    @if($userType == 'Admin' || in_array('list_document', $permissions))
        <li class="nav-item {{ $expenseActive}}">
            <a class="nav-link" href="{{ route('expense-list') }}">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Expenses</span>
            </a>
        </li>
    @endif
    
    <!-- Employer Module -->
    @php
        $employerActive = isActiveRoute([
                'add-employer', 'list-employer', 'supervisor-list', 'staff-list', 'projectmanage-list',
                'edit-employer','employer.view'
            ]);
    @endphp
    
    @if($userType == 'Admin' || in_array('add_employee', $permissions) || in_array('list_employee', $permissions))
        <li class="nav-item {{ $employerActive }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployer"
                aria-expanded="true" aria-controls="collapseEmployer">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Employer</span>
            </a>
            <div id="collapseEmployer" class="collapse {{ $employerActive ? 'show' : '' }}" aria-labelledby="headingEmployer" data-parent="#accordionSidebar">
                <div class="bg-black py-2 collapse-inner rounded">
                    @if($userType == 'Admin' || in_array('add_employee', $permissions))
                        <a class="collapse-item {{ isActiveRoute('add-employer') }}" href="{{ route('add-employer') }}">Add Employer</a>
                    @endif
                    @if($userType == 'Admin' || in_array('list_employee', $permissions))
                        <a class="collapse-item {{ isActiveRoute(['list-employer', 'supervisor-list', 'staff-list', 'projectmanage-list','edit-employer',
                        'employer.view']) }}" 
                           href="{{ route('list-employer') }}">Employer List</a>
                    @endif
                </div>
            </div>
        </li>
    @endif
    <!-- Permission Module -->
    @php
        $permissionActive = isActiveRoute([
            'permissions.index', 'add.permissions', 'edit.permission'
        ]);
    @endphp
    
    @if($userType == 'Admin' || in_array('manage_permission', $permissions))
        <li class="nav-item {{ $permissionActive }}">
            <a class="nav-link" href="{{ route('permissions.index') }}">
                <i class="fas fa-fw fa-lock"></i>
                <span>Role Permission</span>
            </a>
        </li>
    @endif
    
    <!-- Reports Module -->
    @php
        $reportActive = isActiveRoute(['project-sales', 'expenses-report', 'view-project-sales','view-expenses-report']);
    @endphp
    
    @if($userType == 'Admin' || in_array('manage_project_sale_report', $permissions) || in_array('manage_expense_report', $permissions))
        <li class="nav-item {{ $reportActive }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
                aria-expanded="true" aria-controls="collapseReports">
                <i class="fas fa-fw fa-table"></i>
                <span>Reports</span>
            </a>
            <div id="collapseReports" class="collapse {{ $reportActive ? 'show' : '' }}" aria-labelledby="headingReports" data-parent="#accordionSidebar">
                <div class="bg-black py-2 collapse-inner rounded">
                    @if($userType == 'Admin' || in_array('manage_project_sale_report', $permissions))
                       <a class="collapse-item {{ isActiveRoute(['project-sales', 'view-project-sales']) }}" 
                          href="{{ route('project-sales') }}">Project/Sales Report</a>
                    @endif
                    @if($userType == 'Admin' || in_array('manage_expense_report', $permissions))
                       <a class="collapse-item {{ isActiveRoute(['expenses-report','view-expenses-report']) }}" 
                          href="{{ route('expenses-report') }}">Expenses Report</a>
                    @endif
                </div>
            </div>
        </li>
    @endif


    <!-- General Setting -->
    @if($userType == 'Admin' || in_array('manage_general_setting', $permissions))
        <li class="nav-item {{ isActiveRoute('general-setting') }}">
            <a class="nav-link" href="{{ route('general-setting') }}">
                <i class="fas fa-fw fa-cogs"></i>
                <span>General Setting</span>
            </a>
        </li>
    @endif
    </div>
</ul>

