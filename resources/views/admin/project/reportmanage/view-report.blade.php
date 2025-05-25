@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    h6 {
    /* color: black; */
    font-weight: bold;
    font-size: larger;
}
p {
    margin-top: 0;
    margin-bottom: 1rem;
    color: #505366;
}
</style>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            Report / <span style="color:black !important; font-weight: 600; font-size: 22px;">View Report</span>
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; font-size: 20px; font-weight: bold;">
                    Report Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Title</h6>
                                <p class="mb-20">{{$reportDetails->title ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Type</h6>
                                <p class="mb-20">{{$reportDetails->type ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Report Date</h6>
                                <p class="mb-20">{{ $reportDetails->report_date ? \Carbon\Carbon::parse($reportDetails->report_date)->format('M d Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Remark</h6>
                                <p class="mb-20">{{$reportDetails->remark ?? 'N/A' }}</p>
                            </div>
                        </div>
                      
                        @if($reportDetails->start_date)
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Start Date</h6>
                                <p class="mb-20">
                                    {{ $reportDetails->start_date ? \Carbon\Carbon::parse($reportDetails->start_date)->format('M d Y') : 'N/A' }}
                                </p>
                            </div> 
                        </div>
                        @endif
                        @if($reportDetails->end_date)
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>End Date</h6>
                                <p class="mb-20">{{ $reportDetails->start_date ? \Carbon\Carbon::parse($reportDetails->end_date)->format('M d Y') : 'N/A' }}</p>
                            </div> 
                        </div>
                         @endif
                        @if($reportDetails->status)
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Status</h6>
                                <p class="mb-20">{{$reportDetails->status ?? 'N/A'}}</p>
                            </div>
                        </div>
                         @endif
                        
                    <div class="col-md-12">
                        <div class="detail-group">
                            <h6>Report Image/Doc/Pdf</h6>
                           <div class="row">
                                @php
                                    $files = [];
                            
                                    if (!empty($reportDetails->report_upload)) {
                                        $decoded = is_array($reportDetails->report_upload)
                                            ? $reportDetails->report_upload
                                            : json_decode($reportDetails->report_upload, true);
                            
                                        $files = is_array($decoded) ? $decoded : [];
                                    }
                                @endphp
                            
                                @if(count($files) > 0)
                                    @foreach($files as $file)
                                        @php
                                            $filePath = asset($file);
                                            $extension = strtolower(pathinfo(public_path($file), PATHINFO_EXTENSION));
                                        @endphp
                            
                                        <div class="col-md-2 mb-2">
                                            <div class="card shadow-sm border rounded p-2 text-center h-100">
                                                @if(in_array($extension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                    <img src="{{ $filePath }}" alt="Image" class="img-fluid mb-2" style="max-height: 150px; object-fit: contain;">
                            
                                                @elseif($extension == 'pdf')
                                                    <div class="pdf-container">
                                                        <embed src="{{ $filePath }}" type="application/pdf" width="100%" height="150px" />
                                                    </div>
                            
                                                @elseif(in_array($extension, ['doc', 'docx']))
                                                    <img src="{{ asset('images/word-icon.png') }}" alt="Word" class="img-fluid mb-2" style="max-height: 150px;">

                                                @else
                                                    <p class="text-muted">Unknown file</p>
                                                @endif
                            
                                               <a href="{{ $filePath }}" download="{{ ($reportDetails->title ?? 'report') . '.' . $extension }}" class="btn btn-sm btn-primary mt-2">Download</a>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <p class="text-muted">No File Found</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                     </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{route('project-report',$reportDetails->project_id)}}" class="btn btn-secondary">Back to Report List</a>
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
