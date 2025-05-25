@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    .text-danger {
    color: #d51b11 !important;
    font-weight: bolder;
}

.cke_notification_warning {
   display: none !important;
}
</style>



<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" type="module"></script>
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<!-- Add this CSS for Select2 Bootstrap compatibility -->
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('project-estimation-second') }}" style="text-decoration: none; color: black;">Estizzmation</a> / <span style="color:black !important; font-weight: 600; font-size: 22px;">Edit Estimation</span>
             
        </h1>
    </div>

    <div class="row justify-content-center scroller-hide">
        <div class="col-md-12">
            <div class="modal-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('message') }}
                    </div>
                @endif  
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('update.estimation.second', ['estimationId'=> $estimation->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="customer">Customer <span class="text-danger">*</span></label>
                        <select class="form-control common-select select2" id="customer" name="customer" required>
                            <option disabled value="">Select Customer</option>
                            @foreach ($customerDetails as $l)
                                @if ($estimation->customer_id == $l->id)
                                    <option selected value="{{ $l->id }}">{{ $l->name }} ({{ $l->phone_number }})</option>
                                @else
                                    <option value="{{ $l->id }}">{{ $l->name }} ({{ $l->phone_number }})</option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="appointment_date">Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control date-picker" id="edit_estimation_date"
                            name="estimation_date" placeholder="MM DD YY"
                            value="{{ $estimation->estimation_date ? \Carbon\Carbon::parse($estimation->estimation_date)->format('Y-m-d') : '' }}" 
                            required >
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="edit_title1" value="{{ $estimation->title }}" name="title"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="edit_description">Description<span class="text-danger">*</span></label>
                        <textarea class="form-control custom-input" id="edit_description" name="description" required>
                            {{ $estimation->description }}
                        </textarea>

                    </div>

                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <input type="text" class="form-control custom-input" id="edit_remark" value="{{ $estimation->remark }}" name="remark">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn custom-btn"
                            style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;">Update</button>
                    </div>
                </form>

                <!-- CKEditor Script -->
                <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script> 
                
                <script>
                   CKEDITOR.replace('edit_description', {
                        height: 600,
                        contentsCss: "{{asset('assets/css/custom.css')}}",
                        fullPage: true
                    });
                    
                    CKEDITOR.instances['edit_description'].on('instanceReady', function () {
                        CKEDITOR.instances['edit_description'].setData(`{!! addslashes($estimation->description) !!}`);
                    });

                </script>
                
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
<script>
$(document).ready(function() {
    $('#customer').select2({
        placeholder: "Select a Customer",
        allowClear: true,
        theme: "bootstrap-5",
        width: '100%',
        //dropdownParent: $('#addEstimationModal')
    });
});
</script>
@include('layouts.footer')
