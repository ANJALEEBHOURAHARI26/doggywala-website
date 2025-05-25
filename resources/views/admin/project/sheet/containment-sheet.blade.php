@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
<style>
    th {
        color: black;
    }
    td {
        color: #4e4a4a;
    }
    .sheet-img{
        width: 60px;
        height: 60px;
        border: 1px solid #D8405533;
        border-radius: 4px;
    }
   .box-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      padding: 30px 102px; 
    }
    .box {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff8f8;
      color: #2e2e2e;
      font-size: 16px;
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
    .header {
            text-align: center;
        }
        .header img {
            width: 381px;
            margin-top: 27px;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 22px;
        }
        .table-container {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table-container th, .table-container td {
            border: 1px solid #f3bcbc;
            padding: 10px;
            text-align: left;
        }
        .table-container th {
            font-weight: bold;
          width:30%;
        }
        .checkbox {
            text-align: center;
            color: red;
            font-size: 20px;
        }
        .time-section {
            margin-top: 20px;
            border: 2px solid #f3bcbc;
            padding: 10px;
            background: #fde3e3;
        }
        .time-section p {
            margin: 5px 0;
            font-size: 14px;
        }
        .table-design th{
            color: white;
            background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);
            border:none;
        }
        .table-row-design td{
            background-color:white;
            border-color:#3136C1;
        }
        .table-uper th{
            border-color: #D84055;
            width: 30%;
        }
        .table-uper td{
            border-color: #D84055;
        }
      
</style>
        
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('project-list') }}" style="text-decoration: none; color: black;">Projects</a>/ 
            @if(isset($projectId))
                <a href="{{ route('sheetlist', ['projectId' => $projectId]) }}" 
                   style="color:black !important; font-weight: 600; font-size: 22px;">Sheets / </a>
            @else
                <p class="text-danger">Project ID Not Found</p>
            @endif
            
            <span style="color:black !important; font-weight: 600; font-size: 22px;">Containment Sheet</span>
        </h1>
    </div>

    <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
        
        <div class="card-footer d-flex justify-content-between align-items-center">
            @if(isset($sheetId))
            <a class="btn btn-primary" href="{{ route('project-sheet', ['projectId' => $projectId, 'sheetId' => $sheetId]) }}" 
                >
                Back
            </a>
            @else
                <p class="text-danger">Sheet ID Not Found</p>
            @endif
            
            <button id="download-pdf" class="btn btn-primary">
                Download Containment Sheet
            </button>
            
        </div>
        <div id="pdf-content">
            <div class="card-body">
                <div class="header text-center">
                    <img src="{{ asset('assets/img/applogo.png') }}" alt="Abatement Solutions Logo">
                    <h3 style="font-size: 22px; font-weight: 600;padding-top: 18px;">Containment Sheet</h3>
                </div>
    
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
    
                
                <table class="table table-bordered mt-3 table-uper">
                    <tbody>
                        <tr>
                            <th>Date:</th>
                            <td>@if(isset($containmentDetails))
                            {{ \Carbon\Carbon::parse($containmentDetails->date)->format('F d Y') }}
                            @else
                             <p class="text-danger">Date Not Found</p>
                            @endif
                            </td>
                            
                        </tr>
                        <tr>
                            <th>Supervisor Name:</th>
                            <td>@if(isset($containmentDetails))
                                {{ $containmentDetails->supervisor_name ?? 'N/A' }}
                                @else
                                     <p class="text-danger">Supervisor Name Not Found</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Job Location:</th>
                            <td>@if(isset($containmentDetails))
                                {{ $containmentDetails->job_location ?? 'N/A' }}
                                @else
                                    <p class="text-danger">Job Location Not Found</p>
                                @endif
                                </td>
                        </tr>
                        <tr>
                            <th>Job Number:</th>
                            <td>@if(isset($containmentDetails))
                                {{ $containmentDetails->job_number ?? 'N/A' }}
                                @else
                                    <p class="text-danger">Job Number Not Found</p>
                                @endif
                               </td>
                        </tr>
                    </tbody>
                </table>
    
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-4 text-center">
                        <thead class="table-danger table-design">
                            <tr>
                                <th>Name (Last 4 SSN)</th>
                                <th>Rep. Company</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                            </tr>
                        </thead>
                        <tbody class="table-row-design">
                            @if(isset($containmentEntry) && $containmentEntry->count() > 0)
                                @foreach ($containmentEntry as $entry)
                                    <tr>
                                        <td>{{ $entry->ssn_last }}</td> 
                                        <td>{{ $entry->representing_company }}</td>
                                        <td>{{ \Carbon\Carbon::parse($entry->time_in)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($entry->time_out)->format('h:i A') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No containment entries found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                    
                </div>
                <div style="text-align: center; margin-top: 40px; font-size: 16px;">
                      <a href="https://www.abatementsolutionsllc.com" target="_blank" style="color: #fc544b; text-decoration: underline;">https://www.abatementsolutionsllc.com</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> 

<!-- Include html2canvas library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
 document.getElementById('download-pdf').addEventListener('click', function () {
 
    const button = this;
    button.disabled = true;
    button.innerText = 'Downloading...';

    const sheetId = '{{ $containmentDetails->id ?? '' }}';

    if (!sheetId) {
        alert('Containment sheet ID is missing. Please try again.');
        button.disabled = false;
        button.innerText = 'Download Containment Sheet';
        return;
    }

  fetch("{{ route('download.containment.sheet', '') }}/" + sheetId, {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
    }
})
.then(response => response.json())
.then(responseData => {
 
    
    if (responseData.status === 'success') {
        const pdfContent = document.createElement('header');
        pdfContent.innerHTML = responseData.data; // Add the HTML content

        // Append the content to the DOM temporarily for rendering
        document.body.appendChild(pdfContent);
         
        // Convert HTML to canvas
        html2canvas(pdfContent).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf; // Ensure jsPDF is available here
            const pdf = new jsPDF();
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const imgProps = pdf.getImageProperties(imgData);
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('Containment_Sheet.pdf');

            // Clean up the DOM after conversion
            document.body.removeChild(pdfContent);
        });

        // Re-enable the button after download
        button.disabled = false;
        button.innerText = 'Download Containment Sheet';
    } else {
        alert(responseData.message || 'Failed to generate PDF.');
        button.disabled = false;
        button.innerText = 'Download Containment Sheet';
    }
})
.catch(error => {
    console.error('Download failed:', error);
    button.disabled = false;
    button.innerText = 'Download Containment Sheet';
    alert('Download failed. Please try again.');
});

});


</script>
</body>

</html>