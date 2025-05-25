@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            @if($roleName == 'Worker')
            <a href="{{ route('list-employer') }}" style="text-decoration: none; color: black;">Employer/</a>
            @elseif($roleName == 'Supervisor')
            <a href="{{ route('supervisor-list') }}" style="text-decoration: none; color: black;">Employer/</a>
            @elseif($roleName == 'ProjectManager')
            <a href="{{ route('projectmanage-list') }}" style="text-decoration: none; color: black;">Employer/</a>
            @elseif($roleName == 'Staff')
            <a href="{{ route('staff-list') }}" style="text-decoration: none; color: black;">Employer/</a>
            @endif
            <span style="color:black !important; font-weight: 600; font-size: 22px;">View Employee</span>
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; font-size: 20px; font-weight: bold;">
                    Employee Details
                </div>
                <div class="card-body">
                <img id="profilePreview" 
                            src="{{ asset($employer->profile_image ?? 'default-avatar.png') }}" 
                            alt="Profile Image" class="rounded-circle mx-auto d-block" width="120" height="120"
                            style="border: 2px solid #D84055;margin-bottom: 26px;">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="detail-group">
                                <h6>Full Name</h6>
                                <p class="mb-20">{{$employer->full_name ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Employee ID</h6>
                                <p class="mb-20">{{$employer->employee_id ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Roles</h6>
                                <p class="mb-20">{{ $roleName ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Contact Number</h6>
                                <p class="mb-20">{{$employer->contact_number ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Email</h6>
                                <p class="mb-20">{{$employer->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Date of Birth</h6>
                                <p class="mb-20">{{ $employer->date_of_birth ? \Carbon\Carbon::parse($employer->date_of_birth)->format('M d Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Country</h6>
                                <p class="mb-20">{{$employer->country ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>State</h6>
                                <p class="mb-20">{{$employer->state ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>City</h6>
                                <p class="mb-20">{{$employer->city ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Address</h6>
                                <p class="mb-20">{{$employer->address ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Zip Code</h6>
                                <p class="mb-20">{{$employer->zip_code ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Joining Date</h6>
                                <p class="mb-20">{{ $employer->joining_date ? \Carbon\Carbon::parse($employer->joining_date)->format('M d Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Hourly/Monthly Pay Rate</h6>
                                <p class="mb-20">{{$employer->pay_rate ?? 'N/A'}}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <p>Document Detail</p>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>License Copy</h6>
                                <p class="mb-20">
                                    @if($employer->license_copy)
                                        <div class="mt-2">
                                            @php
                                                $filePath = asset($employer->license_copy);
                                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                            @endphp
                                            @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                            @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                                <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download License Copy</a>
                                            @else
                                                <p>Unsupported file type</p>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-muted">No File Found</p>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Initial Certificate</h6>
                                <p class="mb-20">
                                    <!--@if($employer->initial_certificate)-->
                                    <!--    <div class="mt-2">-->
                                    <!--        <img src="{{ asset($employer->initial_certificate) }}" alt="Initial Certificate" width="100" height="100">-->
                                    <!--    </div>-->
                                    <!--@else-->
                                    <!--    <p class="text-muted">No Image Found</p>-->
                                    <!--@endif-->
                                    @if($employer->initial_certificate)
                                        <div class="mt-2">
                                            @php
                                                $filePath = asset($employer->initial_certificate);
                                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                            @endphp
                                            @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                            @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                                <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download Initial Certificate</a>
                                            @else
                                                <p>Unsupported file type</p>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-muted">No File Found</p>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Refresher</h6>
                                <p class="mb-20">
                                    <!--@if($employer->refresher)-->
                                    <!--        <div class="mt-2">-->
                                    <!--            <img src="{{ asset($employer->refresher) }}" alt="Refresher" width="100" height="100">-->
                                    <!--        </div>-->
                                    <!--@else-->
                                    <!--        <p class="text-muted">No Image Found</p>-->
                                    <!--@endif-->
                                    
                                    @if($employer->refresher)
                                        <div class="mt-2">
                                            @php
                                                $filePath = asset($employer->refresher);
                                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                            @endphp
                                            @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                            @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                                <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download Refresher</a>
                                            @else
                                                <p>Unsupported file type</p>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-muted">No File Found</p>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Physical/Medical</h6>
                                <p class="mb-20">
                                @if($employer->physical_medical)
                                        <div class="mt-2">
                                            @php
                                                $filePath = asset($employer->physical_medical);
                                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                            @endphp
                                            @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                            @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                                <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download Physical Medical</a>
                                            @else
                                                <p>Unsupported file type</p>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-muted">No File Found</p>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Fit test</h6>
                                <p class="mb-20">
                                @if($employer->fit_test)
                                    <div class="mt-2">
                                        @php
                                            $filePath = asset($employer->fit_test);
                                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                            <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                        @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                            <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download Fit Test</a>
                                        @else
                                            <p>Unsupported file type</p>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-muted">No File Found</p>
                                @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>OSHA Certificate</h6>
                                <p class="mb-20">
                                @if($employer->osha_certificate)
                                    <div class="mt-2">
                                        @php
                                            $filePath = asset($employer->osha_certificate);
                                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                            <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                        @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                            <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download Osha Certificate</a>
                                        @else
                                            <p>Unsupported file type</p>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-muted">No File Found</p>
                                @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Miscellaneous</h6>
                                <p class="mb-20">
                                    <!--@if($employer->miscellaneous)-->
                                    <!--    <div class="mt-2">-->
                                    <!--        <img src="{{ asset($employer->miscellaneous) }}" alt="Osha Certificate" width="300" height="150">-->
                                    <!--    </div>-->
                                    <!--@else-->
                                    <!--    <p class="text-muted">No Image Found</p>-->
                                    <!--@endif-->
                                    @if($employer->miscellaneous)
                                    <div class="mt-2">
                                        @php
                                            $filePath = asset($employer->miscellaneous);
                                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                            <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                        @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                            <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download Miscellaneous</a>
                                        @else
                                            <p>Unsupported file type</p>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-muted">No File Found</p>
                                @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Company Name</h6>
                                <p class="mb-20">{{ $employer->company_name ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>SNN</h6>
                                <p class="mb-20">{{ $employer->ssn ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Work History</h6>
                                <p class="mb-20">{{ $employer->work_history ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Experience</h6>
                                <p class="mb-20">{{ $employer->experience ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Staff Specific Fields</h6>
                                <p class="mb-20">{{ $employer->staff_specific_fields ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Departments</h6>
                                <p class="mb-20">{{ $employer->department ?? 'N/A'}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    @if($roleName == 'Worker')
                    <a href="{{ route('list-employer') }}" class="btn btn-secondary">Back to Worker Employee List</a>
                    @elseif($roleName == 'Supervisor')
                    <a href="{{ route('supervisor-list') }}" class="btn btn-secondary">Back to Supervisor Employee List</a>
                    @elseif($roleName == 'ProjectManager')
                    <a href="{{ route('projectmanage-list') }}" class="btn btn-secondary">Back to Project Manager Employee List</a>
                    @elseif($roleName == 'Staff')
                    <a href="{{ route('staff-list') }}" class="btn btn-secondary">Back to Staff Employee List</a>
                    @endif
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
@include('layouts.footer')
