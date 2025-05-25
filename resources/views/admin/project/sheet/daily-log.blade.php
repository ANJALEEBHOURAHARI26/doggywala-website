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
      padding: 30px 102px; /* Add horizontal padding for gap on left and right */
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
                <a href="{{ route('project-sheet',['projectId' => $projectId,'sheetId'=>$sheetId]) }}" style=" color:black !important; font-weight: 600; font-size: 22px;">Project sheet</a>/ 
               <span style=" color:black !important; font-weight: 600; font-size: 22px;">Daily Log</span></h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
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
                    Download Daily Log
                </button>
            </div>

            
            <div id="pdf-content">
                <div class="card-body">
                    <div class="header">
                        <img src="{{asset('assets/img/applogo.png')}}" alt="Abatement Solutions Logo">
                        <h2 style="padding-top: 15px;">Abatement Solutions LLC</h2>
                        <h3>Daily Log</h3>
                    </div>
                    <table class="table-container">
                        <tr>
                            <th>Date:</th>
                            <td style="color: #4e4a4a;">
                                {{ optional($dailyLogDetails)->date ? \Carbon\Carbon::parse($dailyLogDetails->date)->format('F d Y') : '--' }}
                            </td>
                        </tr>
            
                        <tr>
                            <th>Supervisor Name:</th>
                            <td style="color: #4e4a4a;">{{ optional($dailyLogDetails)->supervisor_name ?? '--' }}</td>
                        </tr>
                        <tr>
                            <th>Job Location:</th>
                            <td style="color: #4e4a4a;">{{optional($dailyLogDetails)->job_location ?? '--'}}</td>
                        </tr>
                        <tr>
                            <th>Job Number:</th>
                            <td style="color: #4e4a4a;">{{optional($dailyLogDetails)->job_number ?? '--'}}</td>
                        </tr>
                    </table>

        
                    <div style="padding-top: 16px; display: flex; justify-content: space-around; align-items: center; font-size: 22px; font-weight: 600;">
                        <h3 style="margin: 0; font-size:22px; font-weight:600;">Today's Activity:</h3> <span style="margin: 0; font-size:22px; font-weight:600;">Decon:<span/>
                    </div>
                    
                @if((!empty($dailyLogActivities) && count($dailyLogActivities) > 0) || (!empty($dailyLogDecons) && count($dailyLogDecons) > 0))
    <table class="table-container" style="margin-top: 12px !important;">
        @php
            $maxChunks = max(ceil(count($dailyLogActivities) / 2), ceil(count($dailyLogDecons) / 2));
            $activityChunks = array_chunk($dailyLogActivities, 2);
            $deconChunks = array_chunk($dailyLogDecons, 2);
        @endphp

        @for($i = 0; $i < $maxChunks; $i++)
            <tr>
                {{-- Daily Log Activities --}}
                @if(isset($activityChunks[$i]))
                    @foreach($activityChunks[$i] as $activity)
                        <td>{{ $activity }}</td>
                        <td class="checkbox" style="text-align: center;">
                            <img src="{{ asset('assets/img/Group 205636.png') }}" style="display: block; margin: auto;">
                        </td>
                    @endforeach
                    @if(count($activityChunks[$i]) < 2)
                        <td></td><td></td>
                    @endif
                @else
                    <td></td><td></td><td></td><td></td>
                @endif

                {{-- Daily Log Decons --}}
                @if(isset($deconChunks[$i]))
                    @foreach($deconChunks[$i] as $decon)
                        <td>{{ $decon }}</td>
                        <td class="checkbox" style="text-align: center;">
                            <img src="{{ asset('assets/img/Group 205636.png') }}" style="display: block; margin: auto;">
                        </td>
                    @endforeach
                    @if(count($deconChunks[$i]) < 2)
                        <td></td><td></td>
                    @endif
                @else
                    <td></td><td></td><td></td><td></td>
                @endif
            </tr>
        @endfor
    </table>
@else
    <p style="text-align: center; font-size: 18px; font-weight: 500; color: grey;">No Activities or Decons Found</p>
@endif

                    
                   
                    <!--<div style="display: flex; justify-content: space-between; align-items: center; padding: 19px 20px; font-size: 22px; font-weight: 600;">-->
                    <!--    <h3 style="margin: 0; font-size:22px; font-weight:600;">Decon:</h3>-->
                    <!--</div>-->
                    
                    <!--@if(!empty($dailyLogDecons) && count($dailyLogDecons) > 0)-->
                    <!--    <table class="table-container">-->
                    <!--        @foreach(array_chunk($dailyLogDecons, 2) as $chunk)-->
                    <!--            <tr>-->
                    <!--                @foreach($chunk as $decon)-->
                    <!--                    <td>{{ $decon }}</td>-->
                    <!--                    <td class="checkbox" style="text-align: center;">-->
                    <!--                        <img src="{{ asset('assets/img/Group 205636.png') }}" style="display: block; margin: auto;">-->
                    <!--                    </td>-->
                    <!--                @endforeach-->
                    
                    <!--                @if(count($chunk) % 2 != 0)-->
                    <!--                    <td></td>-->
                    <!--                    <td></td>-->
                    <!--                @endif-->
                    <!--            </tr>-->
                    <!--        @endforeach-->
                    <!--    </table>-->
                    <!--@else-->
                    <!--    <p style="text-align: center; font-size: 18px; font-weight: 500; color: grey;">No Decon Found</p>-->
                    <!--@endif-->
            
                    
                    <div style="padding: 12px 20px; font-size: 22px; font-weight: 600;">
                        <h3 style="margin: 0; font-size:22px; font-weight:600;">Notes:</h3>
                    </div>
                    
                    @if(!empty($dailyLogNotes) && count($dailyLogNotes) > 0)
                        <table class="table-container" style="margin-top: 1px !important;">
                            <tr>
                                <th style="width: 3% !important;">Time</th>
                                <th>All supervisors: must check the safety gear and take proper precautions during work</th>
                                
                            </tr>
                            @foreach($dailyLogNotes as $note)
                                <tr>
                                    <td style="color: #4e4a4a;">
                                        {{ \Carbon\Carbon::parse($note->time_notes)->format('h:i A') ?? '--:--' }}
                                    </td>
                                    <td style="color: #4e4a4a;">{{ $note->notes }}</td> 
                                </tr>
                            @endforeach
                        </table><br>
                        <div style="padding: 12px 20px; font-size: 22px; font-weight: 600;text-align: center;">
                             <h3 style="margin: 0; font-size:22px; font-weight:600;">Digital Signature</h3> 
                        <img style="margin-top: 14px;width: 196px;height: 86px;" src="{{ asset($dailyLogDetails->signature)}}" alt="Signature" width="100" height="50">
                    </div>
                    @else
                        <p style="text-align: center; font-size: 18px; font-weight: 500; color: grey;">No Notes Found</p>
                    @endif
                    <div style="text-align: center; margin-top: 40px; font-size: 16px;">
                      <a href="https://www.abatementsolutionsllc.com" target="_blank" style="color: #fc544b; text-decoration: underline;">https://www.abatementsolutionsllc.com</a>
                    </div>
                    
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const pdfContent = document.getElementById('pdf-content');

    html2canvas(pdfContent, { scale: 2, useCORS: true }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');

        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        let position = 0;

        pdf.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
        pdf.save('Daily_Log_Report.pdf');
    });
});

</script>


</body>

</html>