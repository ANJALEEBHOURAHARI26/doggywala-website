@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
<style>
    .table-design th{
            color: white;
            background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
        }
        .table-row-design td{
            background-color:white;
            border-color:#3136C1;
        }
        td {
    color: #524c4c;
}
</style>
        
 <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >
                <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Projects</a>/ 
                @if(isset($projectId))
                    <a href="{{ route('sheetlist', ['projectId' => $projectId]) }}" 
                       style="color:black !important; font-weight: 600; font-size: 22px;">Sheets / </a>
                @else
                    <p class="text-danger">Project ID Not Found</p>
                @endif
                <span style=" color:black !important; font-weight: 600; font-size: 22px;">Personal Air Sampling Worksheet - 2</span></h1>
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
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                     
                    <form action="{{ url('create-projectPersonalAirSamplingWorksheet-2', ['projectId' => $projectId, 'sheetId' => $sheetId]) }}" method="POST" enctype="multipart/form-data">
                       @csrf 
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="receipt_image">Upload Receipt</label>
                            <input type="file" class="form-control" id="receipt_image" name="receipt_image" style="background-color:#FDF5F6; border-color:#D8405533;" required>
                          </div>
                        
                          <div class="form-group col-md-6">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" style="background-color:#FDF5F6; border-color:#D8405533;" required>
                          </div>
                       
                          
                        </div>
                        <button type="submit" class="btn btn-danger" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;" >Create</button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-4 text-center">
                            <thead class="table-danger table-design">
                              <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                                
                              </tr>
                            </thead>
                            <tbody class="table-row-design" >
                            @if($personalAirSamplingWorksheet2 && count($personalAirSamplingWorksheet2) > 0)
                                @foreach($personalAirSamplingWorksheet2 as $personalAirSamplingWorksheet2)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($personalAirSamplingWorksheet2->created_at)->format('F d Y') }}</td>
                                        <td>{{$personalAirSamplingWorksheet2->description}}</td>
                                        <td class="action-icons">
                                            <a class="edit-btn" data-toggle="modal" data-target="#editPersonalAirSamplingWorksheet2"
                                               data-id="{{ $personalAirSamplingWorksheet2->id }}"
                                               data-receipt-image="{{ asset($personalAirSamplingWorksheet2->receipt_image)}}" 
                                               data-description="{{ $personalAirSamplingWorksheet2->description }}"
                                               data-url="{{ route('update.personalAirSamplingWorksheet2',$personalAirSamplingWorksheet2->id) }}" title="Edit">
                                               <img src="{{asset('assets/img/Edit-Icon.png')}}" alt="Edit">
                                            </a>

                                            @include('admin.project.sheet.edit-personalAirSamplingWorksheet2')
                                            <a href="{{route('view.personalAirSamplingWorksheet2',$personalAirSamplingWorksheet2->id)}}" title="View"><img src="{{asset('assets/img/View-Icon.png')}}">️</a>
                                            <a onclick="deletePersonalAirSamplingWorksheet2({{ $personalAirSamplingWorksheet2->id }})" title="Delete"><img src="{{asset('assets/img/Delete-Icon.png')}}">️</a>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No records found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
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
      $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        var receiptImage = $(this).data('receipt-image'); 
        var description = $(this).data('description');
        var url = $(this).data('url');
    
        console.log("Parsed Receipt Images:", receiptImage);
    
        $('#editPersonalAirSamplingWorksheet2Form').attr('action', url);
        $('#editPersonalAirSamplingWorksheet2 #worksheet2_id').val(id);
        $('#editPersonalAirSamplingWorksheet2 #description').val(description);
    
        
       if (receiptImage) {
            var fileExtension = receiptImage.split('.').pop().toLowerCase();
            if (['jpeg', 'png', 'jpg', 'gif', 'svg'].includes(fileExtension)) {
                $("#personalAirSamplingWorksheet2").html('<img src="' + receiptImage + '" alt="Report" width="100" height="100">');
            } else if (['pdf', 'doc', 'docx'].includes(fileExtension)) {
                $("#personalAirSamplingWorksheet2").html('<a href="' + receiptImage + '" target="_blank" class="btn btn-info">Download Report</a>');
            } else {
                $("#personalAirSamplingWorksheet2").html('<p>Unsupported file type</p>');
            }
        } else {
            $("#personalAirSamplingWorksheet2").html('<p class="text-muted">No File Found</p>');
        }
        
         setTimeout(() => {
                editToggleDateFields(); 
            }, 300);
    });
    </script>
    <script>
        function deletePersonalAirSamplingWorksheet2(worksheetId) {
            if (confirm('Are you sure you want to delete this Personal Air Sampling Worksheet-2?')) {
                $.ajax({
                    url: `/delete-projectPersonalAirSamplingWorksheet/${worksheetId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert(response.message); 
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        }
    </script>
</body>

</html>