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
            background-color: white;
            border-color:#D84055;
            width: 30%;
            width: 23%;
            color: #1C1D3E;
            text-align: center;
        }
        .table-design td{
            background-color: white;
            border-color:#D84055;
            color: #1C1D3E;
        }
        .label-design label{
            padding: 18px 17px;
        }
        input[type=checkbox]{
            width: 20px;
            height: 20px;
            border: 2px solid #3136C1;
        }
        input[type="checkbox"]:checked {
            accent-color: #3136C1;
        }
        .box-design {
    width: 181px; /* Adjust as needed */
    margin: auto;
    display: block;
    text-align: center;
    height: 56px;
    border-color: #D8405533;
    background-color: #FDF5F6;
    color:#1C1D3E;
    font-size: 18px;
    font-weight: 500;
    margin-top: 18px;
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
                <span style=" color:black !important; font-weight: 600; font-size: 22px;">Asbestos and Lead Paperwork</span></h1>
           
         
          </div>
<div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
     <div class="card-footer d-flex justify-content-between align-items-center">
            @if(isset($sheetId))
            <!--<a href="{{ route('project-list') }}" -->
            <!--   style="text-decoration: none; font-size: 16px; color: #007bff;">-->
            <!--    -> Project Sheet-->
            <!--</a>-->
            <a class="btn btn-primary" href="{{ route('project-sheet',['projectId' => $projectId,'sheetId'=>$sheetId]) }}">Back</a>
            @else
                <p class="text-danger">Sheet ID Not Found</p>
            @endif
            
            <button id="download-pdf" class="btn btn-primary">
                Download Asbestos and Lead Paperwork
            </button>
        </div>
        <div id="pdf-content">
            <div class="card-body">
                <div class="header text-center">
                    <img src="{{asset('assets/img/applogo.png')}}" alt="Abatement Solutions Logo">
                    <h3 style="padding-top: 18px;">Asbestos and Lead Paperwork</h3>
                </div>
            
            
                <table class="table table-bordered mt-3 table-design">
                    <tbody>
                        <tr><th>Date:</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{ \Carbon\Carbon::parse($asbestosDetails->date)->format('F d Y') }}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                        <tr><th>Supervisor Name:</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{ $asbestosDetails->supervisor_name }}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                        <tr><th>Job Location:</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{ $asbestosDetails->job_location }}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                        <tr><th>Job Number:</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{ $asbestosDetails->job_number }}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                    </tbody>
               </table>
            
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-4 table-design" style="display: flex !important;justify-content: center !important;">
                        <tbody>
                            <tr><th style="width: 50% !important;">Containment Sheet</th><td style="color: #4e4a4a;width: 100% !important;">@if(isset($asbestosDetails)){{$asbestosDetails->containment_sheet}}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                            <tr><th>Daily Log</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{$asbestosDetails->daily_log}}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                            <tr><th>Personal Air Pumps</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{$asbestosDetails->personal_air_pumps}}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                            <tr><th>Job Sign-in Sheet</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{$asbestosDetails->sign_in_sheet}}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                            <tr><th>Waste Log</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{$asbestosDetails->waste_log}}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                            <tr><th>Supervisor's Paperwork</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{$asbestosDetails->supervisors_paperwork}}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                            <tr><th>Worker's Paperwork</th><td style="color: #4e4a4a;">@if(isset($asbestosDetails)){{$asbestosDetails->workers_paperwork}}@else<p class="text-danger">Date Not Found</p>@endif</td></tr>
                        </tbody>
                    </table>
                </div>
            
                <div class="text-center mt-4 label-design">
                    <h4 style="font-weight: 600; font-size: 20px;margin-top: 50px;">Final Clearance</h4>
                    @if(isset($asbestosDetails))
                        <label>Yes</label>
                        <input type="checkbox" {{ $asbestosDetails->final_clearance == 1 ? 'checked' : '' }} style="margin-right: 15px;">
                        
                        <label>No</label>
                        <input type="checkbox" {{ $asbestosDetails->final_clearance == 0 ? 'checked' : '' }}>
                    @else
                        <p class="text-danger">Final Clearance Data Not Available</p>
                    @endif
                </div>
            
                <div class="text-center mt-4">
                    <h4 style="font-weight: 600; font-size: 20px;">How Many?</h4>
                    @if(isset($asbestosDetails))
                    <!--<input type="text" class="form-control text-center box-design" value="@if(isset($asbestosDetails)){{$asbestosDetails->how_many}} @endif">-->
                    @if(isset($asbestosDetails)){{$asbestosDetails->how_many}} @endif
                    @else
                        <p class="text-danger">How Many Data Not Available</p>
                    @endif
                </div>
           
                <div class="text-center mt-4 label-design">
                    <h4 style="font-weight: 600; font-size: 20px;">Hygienist?</h4>
                        @if(isset($asbestosDetails))
                        <label>Yes</label>
                        <input type="checkbox"  {{ $asbestosDetails->hygienist == 1 ? 'checked' : '' }} style="margin-right: 15px;">
                        <label>No </label>
                        <input type="checkbox" {{ $asbestosDetails->hygienist == 0 ? 'checked' : '' }}>
                        @else
                            <p class="text-danger">Hygienist Data Not Available</p>
                        @endif
                </div>
    
                <!--<div style="margin-top: 170px;"></div>-->
                
                <div class="text-center mt-4 label-design" style="margin-top: 0rem !important;">
                    <h4 style="font-weight: 600; font-size: 20px;">
                        Project Manager Approval / Date
                    </h4>
                    
                    <!--<textarea style="width: 32%; height: 100px;">{{ $asbestosDetails->project_manager_approval ?? 'N/A' }}</textarea>-->
                    <span>{{ $asbestosDetails->project_manager_approval ?? 'N/A' }} /</span>
                     
                    <span>
                        {{ $asbestosDetails ? \Carbon\Carbon::parse($asbestosDetails->start_date)->format('F d Y') : 'N/A' }}
                    </span>

                
                    <br>
                    <!--@if(isset($asbestosDetails))-->
                    <!--<input type="text" class="form-control text-center" value="{{ \Carbon\Carbon::parse($asbestosDetails->start_date)->format('F d Y') }}" style=" display: inline-block; height: 56px; width: 181px;   border-color: #D8405533;-->
                    <!--    background-color: #FDF5F6;-->
                    <!--    color:#1C1D3E;-->
                    <!--    font-size: 18px;-->
                    <!--    font-weight: 500; margin-left: 4px;margin-top: 18px;">-->
                    <!--@else-->
                    <!--    <p class="text-danger">Project Manager Approval/Date Data Not Available</p>-->
                    <!--@endif-->
                </div>


        
                <div style="text-align: center; margin-top: 40px; font-size: 16px;">
                    <a href="https://www.abatementsolutionsllc.com" target="_blank" style="color: #fc544b; text-decoration: underline;">https://www.abatementsolutionsllc.com</a>
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

<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const pdfContent = document.getElementById('pdf-content');

        html2canvas(pdfContent, {
            scale: 2,
            useCORS: true,
            scrollY: -window.scrollY // fix rendering issues if page is scrolled
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');

            const pdfWidth = 210;
            const pageHeight = 297;
            const imgWidth = pdfWidth;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            let heightLeft = imgHeight;
            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft > 0) {
                position -= pageHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            pdf.save('Asbestos_LeadPaperwork_Report.pdf');
        });
    });
</script>


</body>

</html>