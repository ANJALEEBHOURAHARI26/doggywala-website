@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<style>
    img#appLogoImage {
    width: 58%;
    height: 55%;
    margin-top: 4%;
}
</style>      
 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >App Setting</h1>
           
         
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{route('app.setting.store')}}" method="post" enctype="multipart/form-data" id="appSettingForm">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="customerName">App Name</label>
                            <input type="text" class="form-control" id="app_name" name="app_name" value="{{$appGeneralSetting->app_name ?? null}}"  placeholder="App Name" style="background-color:#FDF5F6; border-color:#D8405533;" >
                          </div>
                        
                          <div class="form-group col-md-6">
                            <label for="emailAddress">Logo</label>
                            <input type="file" class="form-control" id="app_logo" name="app_logo" style="background-color:#FDF5F6; border-color:#D8405533;"
                                       onchange="previewImage(event, 'appLogoImage')" placeholder="App Logo">
                                <img id="appLogoImage" src="{{ asset($appGeneralSetting->app_logo ?? 'img/new-side-icon.png') }}" width="40">
                          
                          </div>
                        </div>
                        <button type="submit" id="submitBtn" class="btn btn-danger" style="background-color: #D84055;border-color: #D84055;" >Create</button>
                    </form>
                </div>
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
                  <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
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
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Design & developed by
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">Sunshine it Solution</a></b>
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
<script>
    document.getElementById("appSettingForm").addEventListener("submit", function() {
        var submitBtn = document.getElementById("submitBtn");
        submitBtn.innerHTML = 'Processing...';
        submitBtn.disabled = true;
    });
    
    function previewImage(event, imgId) {
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById(imgId).src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>

</html>