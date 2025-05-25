<style>
    .cke_notification_warning {
   display: none !important;
}
</style>
<div class="modal fade" id="addFinalReportModal" tabindex="-1" role="dialog" aria-labelledby="addFinalReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="addFinalReportModalLabel">Add Final Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{route('create.final.report',['projectId' => $projectDetails->id])}}" method="POST" enctype="multipart/form-data" id="finalReportForm">
                @csrf
                <div class="form-group">
                    <label for="appointment_date">Date<span class="text-danger">*</span></label>
                    <input type="text" class="form-control date-picker" id="date" name="date" placeholder="MM DD YY" required readonly>
                </div>
            
                <div class="form-group">
                    <label for="title">Title<span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="title" name="title" placeholder="Title" required>
                </div>
            
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control custom-input" id="description" name="description"></textarea>
                </div> 
            
                <div class="form-group" style="text-align: end;padding-top: 12px;">
                    <a id="addmoreimg" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a> 
                </div> 
            
                <div class="form-group" id="reportiv2">
                    <label for="report_one">Report<span class="text-danger">*</span></label>
                    <input type="file" class="form-control custom-input" name="report_one[]"  multiple required>
                </div> 
            
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <input type="text" class="form-control custom-input" id="remark" name="remark" placeholder="Remark">
                </div>
            
                <div class="text-center">
                    <button type="submit" id="submitBtn" class="btn custom-btn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;">Create</button>
                </div>
            </form>


            <!-- Initialize CKEditor -->
        <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
        <script>
            var caseType = @json(session('selected_case_type')); 
            if(caseType === null){
             var caseType = @json($projectDetails->case_type);
            }
           
           
            if (caseType === "Testing") {
                CKEDITOR.replace('description', {
                height: 600,
                contentsCss: @json(asset('assets/css/custom.css')),
                fullPage: true
            });

                
                CKEDITOR.instances['description'].on('instanceReady', function () {
                    
                        CKEDITOR.instances['description'].setData(`
                        <style>
                                h2 {
                                    text-align: center !important;
                                    margin-bottom: 0px;
                                }
                                h1 {
                                    text-align: center;
                                    font-size: 21px;
                                    margin-top: 41px;
                                    color: #28a2d9;
                                }
                                h5 {
                                    color: #1fb4f7;
                                    text-align: center;
                                }
                                small {
                                    text-align: center !important;
                                    display: block;
                                    font-size: 16px;
                                }
                                #small-address {
                                    text-align: center !important;
                                    display: block;
                                    font-size: 16px;
                                }
                                code {
                                    margin-left: 41%;
                                    margin-bottom: 108%;
                                    font-size: 143%;
                                    margin-top: 46%;
                                }
                                pre {
                                    text-align: center;
                                    font-size: 143%;
                                    color: orange;
                                    margin-top: 6%;
                                    font-weight: bold;
                                }
                                blockquote {
                                    text-align: center;
                                    font-size: 123%;
                                    margin-top: 8%;
                                }
                                details {
                                    text-align: center;
                                    font-size: 143%;
                                    color: orange;
                                    margin-top: 6%;
                                    font-weight: bold;
                                }
                                hr {
                                    height: 2px;
                                    color: black;
                                    background: black;
                                    margin-top: -12px;
                                }
                                </style>
                            <div style="text-align: center; font-family: Arial, sans-serif;">
                                <img src="{{asset('assets/img/new-side-icon.png')}}" style="margin-left:30%;margin-bottom: 10px;" crossorigin="anonymous">
                                <h2 style="color: #d84055; font-weight: bold; margin-bottom: 2px;text-align: center;">ABATEMENT SOLUTIONS LLC</h2> 
                                 <blockquote style="font-size: 20px;margin-top: 35px;">
                                155 Bellamy Road, Cheshire, CT 06410
                            </blockquote>
                                <hr>
                            </div>
                            <h2 style="text-align: center !important; text-transform: uppercase; font-weight: bold; margin: 10px 0;">
                                Limited and Directed Asbestos Inspection Report
                            </h2>
                            <h1 style="text-align: center; font-size: 16px; font-weight: bold; color: #007bff; margin-top: 10px;">
                                For Property Located at
                            </h1>
                            <h1 style="text-align: center; font-size: 16px; font-weight: bold; color: #007bff;">
                                46 Franklin Street, Ansonia, CT
                            </h1><br><br><br>
                            <blockquote style="font-size: 20px;margin-top: 35px;">
                                Jan 21, 2025
                            </blockquote>
                            <div style="display: flex; justify-content: center; gap: 50px; margin-top: 10px;">
                                <pre style="color: #d87c2f; font-size: 14px; font-weight: bold;">Project # 3960</pre>
                                <pre style="color: #d87c2f; font-size: 14px; font-weight: bold;">Claim# 1463543-250726</pre>
                            </div>
                            
                            <blockquote style="font-size: 20px;margin-top: 35px;">
                                Abatement Solutions LLC, 155 Bellamy Road, Cheshire, CT 06410
                            </blockquote>
                            <hr style="border: 1px solid black; margin: 20px 0;">
                            <h3 style="font-weight: bold; margin-top: 20px;">Table of Contents</h3>
                            <ol style="font-size: 14px; margin-left: 20px;">
                                <li>Introduction</li>
                                <li>Asbestos Containing Material Inspection</li>
                                <li>Summary of Result (Samples result Table I and Lab Analysis Table II)</li>
                                <li>Conclusion</li>
                                <li>Limitations</li>
                            </ol>
                            <h3 style="font-weight: bold; margin-top: 20px;">Appendices</h3>
                            <ul style="font-size: 14px; margin-left: 20px;">
                                <li>Appendix 1: Asbestos Sample Analysis, Laboratory Reports and Chains of Custody</li>
                                <li>Appendix 2: Inspector Credentials and Lab Credentials</li>
                            </ul>
                            <p style="text-align: center; font-size: 12px; margin-top: 50px;">
                                Phone: 203-672-1336 Email: info@abatementsolutionsllc.com
                            </p>
                            <hr style="border: 1px solid black; margin: 20px 0;">
                            <h3 style="font-weight: bold; margin-top: 20px;">1. Introduction</h3>
                            <p style="font-size: 14px; text-align: justify;">
                                On Jan 16, 2025, Abatement Solutions LLC’s Som N. Trivedi (License Number 000853) 
                                performed a limited and directed asbestos survey for a property located at 46 Franklin street, 
                                Ansonia, CT 06401. The purpose of this survey was to determine the presence of asbestos in 
                                suspect building materials so that all issues related with asbestos containing materials could be 
                                addressed prior to renovation/demolition of the referenced facility.
                            </p>
                            <h3 style="font-weight: bold; margin-top: 20px;">2. Asbestos Containing Material Inspection</h3>
                            <p style="font-size: 14px; text-align: justify;">
                                During the inspection, suspect ACM was separated into three United States Environmental 
                                Protection Agency (USEPA) categories. These categories are thermal system insulation (TSI), 
                                surfacing ACM, and miscellaneous ACM.
                            </p>
                            <h3 style="font-weight: bold; margin-top: 20px;">3. Summary of Results</h3>
                            <p style="font-size: 14px; text-align: justify;">
                                Utilizing the USEPA protocol and criteria, materials determined to be ACM are listed in Table 1 
                                “Asbestos Containing Materials” including their location and estimated quantities.
                            </p>
                            <h3 style="font-weight: bold; margin-top: 20px;">4. Conclusion:</h3>
                            <p style="font-size: 14px; text-align: justify;">
                                All asbestos containing materials as identified above must be removed from the structure prior to 
                                demolition/renovation.
                            </p>
                            <h3 style="font-weight: bold; margin-top: 20px;">5. Limitations:</h3>
                            <p style="font-size: 14px; text-align: justify;">
                               This inspection did not include the identification of other potential environmental or engineering
                                hazards.
                            </p>
                            <p style="text-align: center; font-size: 12px; margin-top: 50px;">
                                Phone: 203-672-1336 Email: info@abatementsolutionsllc.com
                            </p>
                        `);
                    });
                }else if(caseType === "Abatement/Miscellaneous")
                {
                    CKEDITOR.replace('description', {
                        height: 200,
                        contentsCss: "{{asset('assets/css/custom.css')}}",
                        fullPage: true
                    });
                }
                else {
                    CKEDITOR.replace('description', {
                        height: 200,
                        contentsCss: "{{asset('assets/css/custom.css')}}",
                        fullPage: true
                    });
                }
                
                </script>
            </div>
        </div>
    </div>
 </div>
<script>
    $(document).ready(function () {
        let fileIndex = 3; 

        $("#finalReportForm").on("submit", function () {
            $("#submitBtn").html("Processing...").prop("disabled", true);
        });

        $(document).on("click", "#addmoreimg", function () {
            let newIndex = fileIndex++;
            let newFileInput = `
                <div class="form-group position-relative" id="reportadddiv${newIndex}">
                    <label for="note">Report</label> 
                    <input type="file" class="form-control custom-input" name="report_one[]" accept=".png,.jpg,.jpeg,.gif,.pdf,.doc,.docx" style="width: 95%; padding: 6px !important;" multiple>
                    <a data-id="${newIndex}" class="btn btn-danger btn-sm removemorediv" style="position:absolute; right:0px; top:39px;">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            `;


            $("#reportiv2").after(newFileInput);
        });

        $(document).on("click", ".removemorediv", function () {
            let removeId = $(this).data("id");
            $("#reportadddiv" + removeId).remove();
        });
    });
</script>
