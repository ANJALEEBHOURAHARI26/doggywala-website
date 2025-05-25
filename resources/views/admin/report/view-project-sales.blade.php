@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    .custom-btn {
    color: #D84055;
    border: 2px solid #D84055;
    background-color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 87%;
    margin-top: -67px;
}
.custom-btn:focus, .custom-btn:active {
    outline: none;
    box-shadow: none;
    background-color: #D84055;
    color: #fff;
    border-color: #D84055;
}
.custom-btn:hover {
    color: #fff;
    background-color: #D84055;
    border-color: #D84055;
}
</style>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('project-sales') }}" style="text-decoration: none; color: black;">Project/Sales /</a><span style="color:black !important; font-weight: 600; font-size: 22px;">View Project/Sales</span>
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
             <a href="{{ route('project-sales.download',$project->id) }}" class="btn custom-btn mb-3">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;font-size: 20px; font-weight: bold;">
                    Project/Sales Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Date</h6>
                                <p class="mb-20">{{ \Carbon\Carbon::parse($project->case_start_date)->format('M d Y') ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Invoice No.</h6>
                                <p class="mb-20">INV000{{ $project->invoiveManage->id ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Case ID/Job Number</h6>
                                <p class="mb-20">{{ $project->case_id ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Customer Name</h6>
                                <p class="mb-20">{{ $project->customer->name ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Project Name</h6>
                                <p class="mb-20">{{ $project->case_name ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Total Amount</h6>
                                <p class="mb-20">{{ $project->invoiveManage->total ?? 'N/A'}}</p>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{route('project-sales')}}" class="btn btn-secondary">Back to Project/Sale List</a>
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
