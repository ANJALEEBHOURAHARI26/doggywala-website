<style>
    .custom-input {
        font-size: 16px; 
        color: black; 
        padding: 9px
    }
</style>

<div class="modal fade" id="addReportModal" tabindex="-1" role="dialog" aria-labelledby="addReportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="addReportModalLabel">Add Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('create.report',['projectId' => $projectDetails->id])}}" method="POST" enctype="multipart/form-data" id="reportForm">
                    @csrf
                    <div class="form-group">
                        <label for="type">Type<span class="text-danger">*</span></label>
                        <select class="form-control custom-input" id="type" name="type" required onchange="toggleDateFields()">
                            <option value="" disabled selected hidden>Select Type</option>
                            <option value="Inspection Report">Inspection Report</option>
                            <option value="Lab Testing Result">Lab Testing Result</option>
                            <option value="Asbestos Identification Laboratory">Asbestos Identification Laboratory</option>
                            <option value="MiscellaneousReport">Miscellaneous Report</option>
                            <option value="State/Federal Approval">State/Federal Approval</option>
                            <option value="clearance report">Clearance Report</option>
                            <option value="disposal certificate">Disposal Certificate</option>
                            <option value="Other Report">Other Report</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="title" name="title" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="report_date">Date<span class="text-danger">*</span></label>
                        <input type="text" class="form-control date-picker" placeholder="MM DD YY" id="report_date" name="report_date" required readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <input type="text" class="form-control custom-input" id="remark" name="remark" placeholder="Remark">
                    </div>
                    <div class="form-group">
                        <label for="report_upload">Report Upload (Multiple Select)<span class="text-danger">*</span></label>
                        <input type="file" class="form-control custom-input" id="report_upload" name="report_upload[]" multiple required>
                    </div>
                   
                    <div id="date-fields" style="display: none;">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" class="form-control date-picker" id="start_date" placeholder="MM DD YY" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="text" class="form-control date-picker" id="end_date" placeholder="MM DD YY" name="end_date">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control custom-input" id="status" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                     <div class="text-center">
                        <button type="submit" id="submitBtn" class="btn custom-btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDateFields() {
        const typeField = document.getElementById("type");
        const dateFields = document.getElementById("date-fields");
        
        if (typeField.value === "State/Federal Approval") {
            dateFields.style.display = "block";
        } else {
            dateFields.style.display = "none";
        }
    }
</script>
<script>
    document.getElementById("reportForm").addEventListener("submit", function() {
        var submitBtn = document.getElementById("submitBtn");
        submitBtn.innerHTML = 'Processing...';
        submitBtn.disabled = true;
    });
</script>
