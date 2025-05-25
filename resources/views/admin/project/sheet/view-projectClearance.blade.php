@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            Clearance Report/ <span style="color:black !important; font-weight: 600; font-size: 22px;">View Clearance Report</span>
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background-color: #D84055; font-size: 20px; font-weight: bold;">
                   Clearance Report
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Receipt Image</h6>
                                <p class="mb-20">
                                    @if($projectClearance->receipt_upload)
                                        <div class="mt-2">
                                            @php
                                                $filePath = asset($projectClearance->receipt_upload);
                                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                            @endphp
                                            
                                            @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                                <br>
                                                <a href="{{ $filePath }}" download class="btn btn-info mt-2">Download Image</a> 
                                            @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])) 
                                                <a href="{{ $filePath }}" target="_blank" class="btn btn-info">Download Receipt</a>
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
                                <h6>Type</h6>
                                <p class="mb-20">{{$projectClearance->description ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('project.clearance', ['projectId' => $projectClearance->project_id, 'sheetId' => $projectClearance->sheet_id]) }}" class="btn btn-secondary">
                        Clearance Report
                    </a>
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

@include('layouts.footer')
