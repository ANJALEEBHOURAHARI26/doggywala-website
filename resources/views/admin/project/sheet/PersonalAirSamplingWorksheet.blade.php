@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
<style>
    th {
        color: black;
        padding-right: 0rem !important;
        /*width: 31%;*/
        padding-left: 0.8rem !important;
    }
    td {
        color: #504c4c;
        /*width: 31%;*/
        padding-right: 0rem !important;
        padding-left: 0.8rem !important;
    }
    input.form-control {
        color: #1c1a1a;
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
            background-color: #D84055;
            border-color: white;
        }
        .table-row-design td{
            background-color:white;
            border-color:#D84055;
        }
        .table-uper th{
            border-color: #D84055;
            width: 30%;
        }
        .table-uper td{
            border-color: #D84055;
        }
        //---------------------
        .table-rows table {
      width: 100%;
      border-collapse: collapse;
     
      text-align: left;
    }
    .table-rows th, td {
      border: 1px solid #ddd;
      padding: 8px;
      background-color: white;
    }
    .table-rows th {
      background-color: white;
      color: Black;
     
    }
    .nested-table {
      border: none;
      background-color: white;
      width: 100%;
    }
    .nested-table th, .nested-table td {
      border: none;
      padding: 4px;
    }
    .table-bordered td, .table-bordered th {
    border: 1px solid white;
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
                <span style=" color:black !important; font-weight: 600; font-size: 22px;">Personal Air Sampling Works</span>
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
                    Download Personal Air Sampling Works
                </button>
            </div>
            <div id="pdf-content">
                <div class="card-body">
                  <div class="header text-center">
                    <img src="{{asset('assets/img/applogo.png')}}" alt="Abatement Solutions Logo">
                    <h3 style="font-size: 22px; font-weight: 600; margin-top: 10px;padding-top: 15px;" >Personal Air Sampling Worksheet</h3>
                  </div>
                  
                  <table class="table table-bordered mt-3 table-uper">
                    <tbody>
                        <tr><th style="border-color: #D84055;">Date:</th>
                            <td style="border-color: #D84055;">
                                @if(isset($personalAirSamplingWorksheet))
                                    {{ \Carbon\Carbon::parse($personalAirSamplingWorksheet->date)->format('F d Y') }}
                                @else<p class="text-danger">Date Not Found</p>@endif    
                            </td>
                        </tr>
                        <tr><th style="border-color: #D84055;">Job Name:</th>
                            <td style="border-color: #D84055;">
                                @if(isset($personalAirSamplingWorksheet))
                                    {{ $personalAirSamplingWorksheet->supervisor_name }}
                                @else<p class="text-danger">Supervisor Name Not Found</p>@endif   
                            </td>
                        </tr>
                        <tr><th style="border-color: #D84055;">Job Location:</th>
                           <td style="border-color: #D84055;">
                                @if(isset($personalAirSamplingWorksheet))
                                    {{ $personalAirSamplingWorksheet->job_location }}
                                @else<p class="text-danger">Job Location Not Found</p>@endif   
                           </td>
                        </tr>
                        <tr><th style="border-color: #D84055;">Job Number:</th>
                            <td style="border-color: #D84055;">
                                @if(isset($personalAirSamplingWorksheet))
                                    {{ $personalAirSamplingWorksheet->job_number }}
                                @else<p class="text-danger">Job Number Not Found</p>@endif  
                            </td></tr>
                    </tbody>
                </table>
              
                <h3 style="margin: 0;font-size:22px;font-weight:600;text-align: center; padding: 20px 20px; font-size: 22px; font-weight: 600;">NIOSH Method 7400</h3>
        
                  <div class="table-responsive">
                    <div class="table-rows"></div>
                    <table class="table table-striped table-bordered" style="background-color: white;">
                        <thead>
                          <tr>
                            <th style="width: 30%;background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border-color: 3136C1;color:white;">Sample Number</th>
                            <th style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;color:white;">Time</th>
                            <th style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;color:white;">Flow (L/Min)</th>
                            <th style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;color:white;">Vol (L)</th>
                            <th style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;color:white;">Rate (Fids)</th>
                            <th style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;color:white;">F/MM<sup>2</sup></th>
                            <th style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;color:white;">F/CC</th>
                            <th style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;color:white;">F/CC (LOD)</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                            @if(isset($worksheetEntries) && count($worksheetEntries) > 0)
                                @foreach($worksheetEntries as $entry)
                                    <tr style="background-color: white;" >
                                        <td rowspan="2" style="border-color:#D84055;padding-right: 0px !important;padding-left: 0px !important;">
                                          <table class="nested-table">
                                            <tbody>
                                              <tr><th style="background-color: white;">Sample Number:</th><td>{{$entry->sample_number}}</td></tr>
                                              <tr><th style="background-color: white;">Name:</th><td>{{$entry->name}}</td></tr>
                                              <tr><th style="background-color: white;">Date:</th><td>{{ \Carbon\Carbon::parse($entry->date)->format('F d Y') }}</td></tr>
                                              <tr><th style="background-color: white;">SSN:</th><td>{{$entry->last_4snn}}</td></tr>
                                              <tr><th style="background-color: white;">Respirator Type:</th><td>{{$entry->respirator_type}}</td></tr>
                                              <tr><th style="background-color: white;">Task:</th><td>{{$entry->task}}</td></tr>
                                              <tr><th style="background-color: white;">Location:</th><td>{{$entry->location}}</td></tr>
                                            </tbody>
                                          </table>
                                        </td>
                                        <td style="border-right-color:#D84055;">Start:<br>{{ \Carbon\Carbon::parse($entry->time_start)->format('h:i A') }}</td>
                                        <td style="border-right-color:#D84055;">Start:<br>{{ $entry->flow_start }}</td>
                                        <td style="border-right-color:#D84055;">{{$entry->volume}}</td>
                                        <td style="border-right-color:#D84055;">{{$entry->rate}}</td>
                                        <td style="border-right-color:#D84055;">{{$entry->fmm}}</td>
                                        <td style="border-right-color:#D84055;">{{$entry->fcc}}</td>
                                        <td style="border-right-color:#D84055;">{{$entry->fcc_lod}}</td>
                                    </tr>
                                    <tr>
                                        <td style="border-right-color:#D84055;border-bottom-color: #D84055;"><b>End:<br></b>{{ \Carbon\Carbon::parse($entry->time_end)->format('h:i A') }}</td>
                                        <td style="border-right-color:#D84055;border-bottom-color: #D84055;">End:<br>{{$entry->flow_end }}</td>
                                        <td style="border-right-color:#D84055;border-bottom-color: #D84055;"></td>
                                        <td style="border-right-color:#D84055;border-bottom-color: #D84055;"></td>
                                        <td style="border-right-color:#D84055;border-bottom-color: #D84055;"></td>
                                        <td style="border-right-color:#D84055;border-bottom-color: #D84055;"></td>
                                         <td style="border-right-color:#D84055;border-bottom-color: #D84055;"></td>
                                    </tr>
                                @endforeach
                            @else
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-danger text-center">Personal Air Sampling Works Not Found</td>
                                    </tr>
                                </tbody>
                            @endif
                        </tbody>
                     </table>
          
                    @if(isset($personalAirSamplingWorksheet))
                        @php
                            $sampled_by = $personalAirSamplingWorksheet->sampled_by;
                            $date_sampled = \Carbon\Carbon::parse($personalAirSamplingWorksheet->date_sampled)->format('F d Y');
                        @endphp
                    @else
                        @php
                            $sampled_by = '';
                            $date_sampled = '';
                        @endphp
                    @endif
        
                    <div style="display: flex; align-items: center; padding: 33px 20px; font-size: 22px; font-weight: 600;">
                      <h3 style="margin: 0;font-size:18px;font-weight:600;">Sampled By: {{ $sampled_by }}</h3>
                      
                      <!--<input type="text" class="form-control" value="{{ $sampled_by }}">-->
                    
                      <h3 style="margin:0;font-size:18px;font-weight:600;margin-left:317px;">Date Sampled: {{ $date_sampled }}</h3>
                      <!--<input type="text" class="form-control" value="{{ $date_sampled }}">-->
                      
                    </div>
                    
                     <div style="text-align: center; margin-top: 40px; font-size: 16px;">
                      <a href="https://www.abatementsolutionsllc.com" target="_blank" style="color: #fc544b; text-decoration: underline;">https://www.abatementsolutionsllc.com</a>
                    </div>
                    
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

<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const pdfContent = document.getElementById('pdf-content');

        html2canvas(pdfContent, {
            scale: 2,  
            useCORS: true, 
            allowTaint: false,
            scrollY: -window.scrollY
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');

            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = 210;
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            let heightLeft = pdfHeight;
            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
            heightLeft -= 297;

            while (heightLeft > 0) {
                position = heightLeft - pdfHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
                heightLeft -= 297;
            }

            pdf.save('Personal_AirSampling_WorksSheet_Report.pdf');
        });
    });
</script>


</body>

</html>