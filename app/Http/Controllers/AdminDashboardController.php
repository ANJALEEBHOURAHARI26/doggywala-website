<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Employee;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $projectsCount = Project::count();
        $projectsPendingCount = Project::where('case_status', 'Pending')->count();
        $projectsInProgressCount = Project::where('case_status', 'In Progress')->count();
        $projectsCmpltCount = Project::where('case_status', 'Complete')->count();
        $projectManager = Employee::where('role_id',3)->count();
        $totalSupervisor = Employee::where('role_id',2)->count();
        $totalStaff = Employee::where('role_id',1)->count();
        $totalCustomer = Customer::count();
        $totalWorkers = Employee::where('role_id',4)->count();
        // dd($projectsActiveCount);
        return view('admin.admin-homepage',
        compact(
        'projectsCount',
        'projectsPendingCount',
        'projectsInProgressCount',
        'projectsCmpltCount',
        'projectManager',
        'totalSupervisor',
        'totalStaff',
        'totalCustomer',
        'totalWorkers'
        ));
    }
    
  


    
}
