<style>
    .cke_notification_warning {
   display: none !important;
}
.select2-search__field {
    pointer-events: all !important;
}
.select2-container--default .select2-selection--single {
    cursor: pointer;
}

</style>
<!-- Head me CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Add this CSS for Select2 Bootstrap compatibility -->
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />




<div class="modal fade" id="addEstimationModal" tabindex="-1" role="dialog" aria-labelledby="addEstimationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content custom-modal" style="max-width: 90vw; padding: 20px;">
            <div class="modal-header custom-modal-header" style="margin-right: -3%;margin-left: -3%; margin-top: -21px;">
                <h5 class="modal-title" id="addEstimationModalLabel">Add Estimation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('create.estimation.second')}}" method="POST" id="estimationForm">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                        <label for="title">Customer<span class="text-danger">*</span></label>
<select class="form-control select2" id="customer" name="customer" required tabindex="1">

    <option value="">Select Customer</option>
    @foreach ($customerDetails as $l) 
        <option value="{{ $l->id }}">{{ $l->name }} ({{ $l->phone_number }})</option> 
    @endforeach
</select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="estimation_date">Date <span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input date-picker" id="estimation_date"
                            name="estimation_date" placeholder="MM DD YY" required readonly>
                    </div>

                    </div>

                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="title" name="title" placeholder="Title"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description<span class="text-danger">*</span></label>
                        <textarea class="form-control custom-input" id="description" name="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <input type="text" class="form-control custom-input" id="remark" name="remark" placeholder="Remark">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn custom-btn" id="submitBtn"
                            style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;">Create</button>
                    </div>
                </form>

               <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
                   <script>
                    CKEDITOR.replace('description', {
                        height: 600,
                        contentsCss: "{{asset('assets/css/custom.css')}}",
                        fullPage: true
                    });
                
                    CKEDITOR.instances['description'].on('instanceReady', function () {
                        CKEDITOR.instances['description'].setData(`
                        <style>
                        h2{
                            text-align: center !important;
                            margin-bottom: 0px;
                        }
                        small{
                        text-align: center;
                        /* align-items: center; */
                        display: block;
                        font-size: 16px;
                        }
                        
                        
                         

                        </style>
                             <div style="text-align:center;font-family: Arial, sans-serif; font-size: 16px;">
                                <img src="{{asset('assets/img/new-side-icon.png')}}" style="margin-left:30%;margin-bottom: 10px;">
                                <h2>ABATEMENT SOLUTIONS LLC</h2>
                                <small style="font-size: 14px;">155 Bellamy Road, Cheshire, CT 06410, Ph-203-672-1336</small>
                            </div> 
                             
                                <p class="left">ESTIMATE / PROPOSAL&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   Date: January 20, 2025</p> 
                             
                            <p><strong>Steve Pintarich</strong></p>
                            <p><strong>Ref:</strong> 64 Main Street, Southington, CT</p>
                            
                            <p style="margin-top: 10px;"><strong>Dear Steve,</strong></p>
                            <p>Thank you for the opportunity to offer you an estimate. Abatement Solutions LLC proposes to provide all labor and materials required for asbestos abatement as per local, state, and federal regulations.</p>
                            
                            <h4 style="margin-top: 20px; text-decoration: underline;">SCOPE OF WORK:</h4>
                            <p>Please refer to the table below:</p>
                            
                            <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: center; font-size: 14px;">
                                <tr style="background-color: #d84055; color: white; font-weight: bold;">
                                    <th>LOCATION</th>
                                    <th>DESCRIPTION</th>
                                    <th>QUANTITY</th>
                                </tr>
                                <tr>
                                    <td>Bar Room and Hallway</td>
                                    <td>Laminate Flooring and Floor Tile</td>
                                    <td><strong>~1,075 SF</strong></td>
                                </tr>
                            </table>
                            
                            <p><strong>*Quantity:</strong> All quantities are approximate and subject to change.</p>
                            <p><strong>†Location:</strong> All locations must be accessible without removing pre-existing features like radiators, wall panels, etc.</p>
                            
                            <h4 style="margin-top: 20px; text-decoration: underline;">NOTES:</h4>
                            <ul>
                                <li>All contents of the bar room and hallway must be removed before work begins.</li>
                                <li>Abatement Solutions will remove baseboards and trim work if needed.</li>
                            </ul>
                            
                            <h4 style="margin-top: 20px; text-decoration: underline;">PROJECT COSTS:</h4>
                            <p><strong>$8,875.00 (+ Sales Tax if Applicable)</strong> - Includes labor, materials, and disposal.</p>
                            <p><strong>3rd Party Testing: $550.00 (+ Sales Tax if Applicable)</strong> - Includes air testing and inspection.</p>
                            
                            <h4 style="margin-top: 20px; text-decoration: underline;">PAYMENT DUE:</h4>
                            <p>100% upon project completion.</p>
                            
                            <h4 style="margin-top: 20px; text-decoration: underline;">GENERAL CONDITIONS:</h4>
                            <ul>
                                <li>Work will be done using full containment with negative pressure.</li>
                                <li>All debris will be vacuumed using a HEPA-filtered system.</li>
                                <li>Surfaces will be wet-wiped and encapsulated with a lock-down agent.</li>
                                <li>Asbestos waste will be disposed of in an EPA-approved landfill.</li>
                                <li>3rd party air testing will be conducted after work completion.</li>
                            </ul>
                            
                            <h4 style="margin-top: 20px; text-decoration: underline;">CONTRACT TERMS AND CONDITIONS:</h4>
                            <ul>
                                <li>Abatement Solutions LLC is not responsible for delays caused by unforeseen circumstances.</li>
                                <li>Any changes must be approved with a signed change order.</li>
                                <li>If this proposal is not accepted within 10 days, it may be voided.</li>
                                <li>We are not responsible for minor damage to paint, walls, or ceilings.</li>
                                <li>The owner must provide water and electricity for the project.</li>
                            </ul>
                            
                            <p>Yours truly,</p>
                            <p><strong>Priti Trivedi, President</strong></p>
                            <p>Cell: (203) 675-7142</p>
                            
                            <p style="margin-top: 40px; font-size: 14px;"><strong>Authorized By:</strong> ___________________________ <span style="margin-left: 50px;"></span> <strong>Date:</strong> ___________________________</p>
                        `);
                    });
                </script>
            </div>
        </div>
    </div>
</div>

 <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">-->
 <!--<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>-->
<script>
    // document.getElementById("estimationForm").addEventListener("submit", function() {
    //     var submitBtn = document.getElementById("submitBtn");
    //     submitBtn.innerHTML = 'Processing...';
    //     submitBtn.disabled = true;
    // });
    
    
//   $(document).ready(function () { 
        
//          $('#customer').select2({
//             width: '100%'
//         }); 

//         function fetchCustomerList() {
//             $.ajax({
//                 url: '/customers',
//                 method: 'GET',
//                 dataType: 'json',
//                 success: function (customerlist) {
                    
//                     if (!Array.isArray(customerlist)) {
//                         console.error("States response is not an array", caselist);
//                         return;
//                     }
//                     let options = '<option selected disabled>Select Customer...</option>';
//                     customerlist.forEach(customerlist => {
//                         options += `<option value="${customerlist.id}">${customerlist.name} (${customerlist.phone_number})</option>`;
//                     });
//                     $('#customer').html(options);
//                 },
//                 error: function () {
//                     alert('Error fetching states!');
//                 }
//             });
//         } 
//         fetchCustomerList(); 
//     });
</script> 


<script>
$(document).ready(function() {
    $('#customer').select2({
      placeholder: "Select a Customer",
      allowClear: true,
      theme: "bootstrap-5", // or "bootstrap4" if you're using that
      width: '100%',
      dropdownParent: $('#addEstimationModal')
    });
});
</script>

 