@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
<style>
    .table-design th{
            color: white;
            background-color: #D84055;
            border-color: white;
        }
        .table-row-design td{
            background-color:white;
            border-color:#D84055;
        }
        .card-employer {
                padding: 15px;
                border-radius: 10px;
                border: 1px solid white;
                box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5);
                margin-bottom: 20px;
        }
        .card-content-employer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .input-group {
            display: flex;
            flex-direction: column;
            width: 45%;
        }
        .input-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .input-group input {
            padding: 8px;
            border: 1px solid #f5c6c6;
            border-radius: 5px;
            background: #ffebeb;
            width: 100%;
        }
        .upload-section {
            text-align: center;
        }
        .upload-section span {
            font-weight: bold;
        }
        .upload-section img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            margin-top: 5px;
        }
</style>
        
 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >
                 <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Projects</a> / 
               <a href="{{ route('sheetlist', ['projectId' => $projectId]) }}" style="color:black !important; font-weight: 600; font-size: 22px;">Sheets / </a> 
                <span style=" color:black !important; font-weight: 600; font-size: 22px;">Employer Detail</span></h1>

          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
            @if(isset($sheetId))
            <a class="btn btn-primary" href="{{ route('project-sheet', ['projectId' => $projectId, 'sheetId' => $sheetId]) }}" 
               style="margin-left: 2%;
    width: 10%;">
                Back
            </a>
            @else
                <p class="text-danger">Sheet ID Not Found</p>
            @endif
            @if(isset($employerDetails) && $employerDetails)
                <div class="card-body">
                    <div class="card-employer">
                        <div class="card-content-employer">
                            <form style="width: 100%;">
                                <div class="form-row">
                                    @foreach([$employerDetails, ...$entries] as $entry)
                                        <div class="form-group col-md-6">
                                            <label>Employer Name</label>
                                            <input type="text" class="form-control" 
                                                value="{{ $entry->employee_name ?? '' }}" 
                                                placeholder="Employer Name"
                                                style="background-color:#FDF5F6; border-color:#D8405533; height: 50px;">
                                        </div>
            
                                        <div class="form-group col-md-6">
                                            <label>Note</label>
                                            <input type="text" class="form-control"  
                                                value="{{ $entry->notes ?? '' }}" 
                                                placeholder="Note"
                                                style="background-color:#FDF5F6; border-color:#D8405533; height: 50px;">
                                        </div>
            
                                        @php
                                            $files = [];
                                            if (!empty($entry->uploads)) {
                                                $files = json_decode($entry->uploads, true);
                                                if (!is_array($files)) {
                                                    $files = [$files];
                                                }
                                            }
                                        @endphp
            
                                        @if (!empty($files))
                                            <div class="form-group col-md-12 d-flex flex-wrap">
                                                @foreach ($files as $file)
                                                    @php
                                                        $filePath = asset($file);
                                                        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                    @endphp
                                                    <div class="m-2 text-center">
                                                        <label>Upload</label><br>
                                                        @if (in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                            <img src="{{ $filePath }}" 
                                                                style="width: 80px; height: 60px; border: 1px solid #D8405533; border-radius: 5px;">
                                                        @endif
                                                        <a href="{{ $filePath }}" download class="btn btn-info btn-sm mt-1">Download File</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
            <p style="margin-left: 20px;margin-top: 30px;">Employee details not Found</p>
            @endif


              </div>
            </div>
          </div>
          <!--Row-->

        

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
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
     <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - design & developed by
              <b><a href="https://www.sunshineitsolution.com/" target="_blank">Sunshine it Solution</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets/js/ruang-admin.min.js')}}"></script>

</body>

</html>