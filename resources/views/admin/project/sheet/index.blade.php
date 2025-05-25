@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
<style>
    .sheet-img{
        width: 60px;
        height: 60px;
        border: 1px solid #D8405533;
        border-radius: 4px;
    }
    @media (max-width: 575.98px) {
         .sheet-img{
        width: 60px;
        height: 60px;
        border: 1px solid #D8405533;
        border-radius: 4px;
        margin-top: 10px;
    }
    .box-container {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 15px !important;
    padding: 30px 0px !important;
}
.box {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background-color: #fff8f8 !important;
    color: #2e2e2e !important;
    font-size: 7px !important;
    font-weight: bold !important;
    padding: 15px !important;
    border: 1px solid #f0c1c1 !important;
    border-radius: 8px !important;
    text-align: center !important;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    cursor: pointer !important;
    transition: transform 0.2s, box-shadow 0.2s !important;
}
    }
   .box-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px;
      padding: 24px;
    }
    .box {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff8f8;
      color: #2e2e2e;
      font-size: 13px;
      font-weight: bold;
      padding: 15px;
      border: 1px solid #f0c1c1;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .box:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    
    /*******/
    .image-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
    }

    .image-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100px;
    }

    .image-card img {
        width: 80px;
        height: 58px;
        object-fit: cover;
        border-radius: 9px;
        border: 1px solid #ddd;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 8px;
    }
    
    .download-btn {
        padding: 4px 10px;
        font-size: 11px;
        background-color: #4e73df;
        color: white;
        border-radius: 15px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        border: none;
        display: inline-block;
    }

    .download-btn:hover {
        background-color: #2e59d9;
        color: white;
        text-decoration: none;
    }
</style>
        
 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >
                <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Projects</a> / 
               <a href="{{ route('sheetlist', ['projectId' => $projectId]) }}" style="color:black !important; font-weight: 600; font-size: 22px;">Sheets / </a>
            </h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customerName">Date</label>
                            <input type="text" class="form-control" id="customerName" value="{{ \Carbon\Carbon::parse($sheetDetails->date)->format('F d Y') }}" placeholder="Customer Name" style="background-color:#FDF5F6; border-color:#D8405533;" >
                        </div>
                    
                        <div class="form-group col-md-6">
                          <label for="detail">Detail</label>
                          <textarea class="form-control" id="detail"  placeholder="Enter details" style="background-color:#FDF5F6; border-color:#D8405533;">{!! $sheetDetails->details !!}</textarea>
                        </div>
                    </div>
                    
                 {{-- Before Section --}}
                    <h3>Before Images ({{ count($beforeImages) }})</h3>
                    <div class="image-grid mt-3">
                        @foreach($beforeImages as $img)
                            <div class="image-card">
                                <img src="{{ asset($img) }}" class="img-thumbnail" style="height:71px;">
                                <div class="button-group mt-2">
                                    <a href="{{ asset($img) }}" download class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm"
                                        onclick="deleteSheetImage(event, this, '{{ $img }}', 'before_image')"
                                        data-id="{{ $sheetDetails->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    {{-- After Section --}}
                    <h3 style="margin-top: 30px;">After Images ({{ count($afterImages) }})</h3>
                    <div class="image-grid mt-3">
                        @foreach($afterImages as $img)
                            <div class="image-card">
                                <img src="{{ asset($img) }}" class="img-thumbnail" style="height:71px;">
                                <div class="button-group mt-2">
                                    <a href="{{ asset($img) }}" download class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm"
                                        onclick="deleteSheetImage(event, this, '{{ $img }}', 'after_image')"
                                        data-id="{{ $sheetDetails->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    
                    <div class="box-container">
                        <a href="{{ route('daily-log',['sheetId' => $sheetDetails->id, 'projectId' => $projectId]) }}" 
                        style="text-decoration: none;outline: none;" ><div class="box">Daily Log</div></a>
                        <a href="{{ route('containment-sheet', ['projectId' => $projectId, 'sheetId' => $sheetDetails->id]) }}" style="text-decoration: none;outline: none;" >
                            <div class="box">Containment Sheet</div>
                        </a>
                        <a href="{{route('project-Asbestos', ['projectId' => $projectId, 'sheetId' => $sheetDetails->id])}}" style="text-decoration: none;outline: none;"><div class="box">Asbestos and Lead Paperwork</div></a>
                        <a href="{{route('project-signIn',['projectId' => $projectId, 'sheetId' => $sheetDetails->id])}}" style="text-decoration: none;outline: none;"><div class="box">Sign-In Sheet</div></a>
                        <a href="{{route('project-Personal-Air-Sampling-Worksheet',['projectId' => $projectId, 'sheetId' => $sheetDetails->id])}}" style="text-decoration: none;outline: none;"><div class="box">Personal Air Sampling Worksheet</div></a>
                        <a href="{{route('project-Personal-Air-Sampling-Worksheet-2',['projectId' => $projectId, 'sheetId' => $sheetDetails->id])}}" style="text-decoration: none;outline: none;"><div class="box">Personal Air Sampling Worksheet - 2</div></a>
                        <a href="{{route('employer.detail',['projectId' => $projectId, 'sheetId' => $sheetDetails->id])}}" style="text-decoration: none;outline: none;"><div class="box">Employer Detail</div></a>
                    </div>
                   
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function deleteSheetImage(event, button, imagePath, column) {
    event.preventDefault();

    const sheetId = button.getAttribute('data-id');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!sheetId || !imagePath || !column) {
        alert("Missing data.");
        return;
    }

    if (confirm("Are you sure you want to delete this image?")) {
        fetch(`/sheet/image-delete`, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                sheet_id: sheetId,
                image_path: imagePath,
                column: column
            })
        })
        .then(async res => {
            const contentType = res.headers.get("content-type");
            if (contentType && contentType.includes("application/json")) {
                const data = await res.json();
                if (data.success) {
                    location.reload();
                } else {
                    alert("Could not delete image.");
                    console.error("Server Error:", data);
                }
            } else {
                const html = await res.text();
                console.error("Received non-JSON response:", html);
            }
        })
        .catch(err => console.error("Request Failed:", err));
    }
}
</script>

