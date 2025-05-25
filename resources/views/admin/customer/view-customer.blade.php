@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;"> <a href="{{ route('customer-list') }}" style="text-decoration: none; color: black;">Customer/</a><span style="color:black !important; font-weight: 600; font-size: 22px;">View Customer</span></h1>
    </div>

    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; font-size: 20px; font-weight: bold;">
                    Customer Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Customer ID</h6>
                                <p class="mb-20">#{{ $customer->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Customer Name</h6>
                                <p class="mb-20">{{ $customer->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Email Address</h6>
                                <p class="mb-20">{{ $customer->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Phone Number</h6>
                                <p class="mb-20">{{ $customer->phone_number }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Email</h6>
                                <p class="mb-20">{{$customer->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Business Type</h6>
                                <p class="mb-20">{{ $customer->business_type }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Country</h6>
                                <p class="mb-20">{{ $customer->country }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>State</h6>
                                <p class="mb-20">{{$customer->state ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>City</h6>
                                <p class="mb-20">{{$customer->city ?? 'N/A'}}</p>
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Zip Code</h6>
                                <p class="mb-20">{{$customer->zip_code ?? 'N/A'}}</p>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('customer-list') }}" class="btn btn-secondary">Back to Customer List</a>
                </div>
            </div>
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
