@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            Estimation / <span style="color:black !important; font-weight: 600; font-size: 22px;">View Estimation</span>
        </h1>
    </div>

    <div class="row justify-content-center scroller-hide">
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; font-size: 20px; font-weight: bold;">
                    Estimation Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Date</h6>
                                <p class="mb-20">{{$estimationDetails->estimation_date->format('F d Y') ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Title</h6>
                                <p class="mb-20">{{$estimationDetails->title ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Remark</h6>
                                <p class="mb-20">{{$estimationDetails->remark ?? 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="detail-group">
                            <h6>Description</h6>
                            <p class="mb-20"></p>
                        
                            <div id="pdfContent" style="border: 8px solid black; max-height: 400px; overflow-y: auto; padding: 10px; background: #f9f9f9;">
                                {!! $estimationDetails->description !!}
                            </div>
                        
                            <h5 class="text-center mt-2">Estimation Report</h5>
                        
                            {{-- New Button to call backend PDF --}}
                            <a href="{{ route('estimation.download', $estimationDetails->id) }}" class="btn btn-success d-block mx-auto mt-2">
                                Download as PDF
                            </a>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{route('project-estimation',$estimationDetails->project_id)}}" class="btn btn-secondary">Back to Estimation List</a>
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
