<div class="modal fade" id="editReportModal" tabindex="-1" role="dialog" aria-labelledby="editprojectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: #fff;">
                <h5 class="modal-title" id="editprojectModalLabel">Edit Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editReportModalForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="type">Type<span class="text-danger">*</span></label>
                        <select class="form-control custom-input" id="type_edit" name="type" required onchange="editToggleDateFields()">
                            <option value="" disabled hidden>Select Type</option>
                            <option value="Inspection Report">Inspection Report</option>
                            <option value="Lab Testing Result">Lab testing Result</option>
                            <option value="Asbestos Identification Laboratory">Asbestos Identification Laboratory</option>
                            <option value="Miscellaneous Report">Miscellaneous Report</option>
                            <option value="State/Federal Approval" {{ $reportDetails->type == 'State/Federal Approval' ? 'selected' : '' }}>State/Federal Approval</option>
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
                        <input type="text" class="form-control date-picker" placeholder="MM DD YY" id="edit_report_date" name="report_date" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Remark</label>
                        <input type="text" class="form-control custom-input" id="remark" name="remark" placeholder="Remark">
                    </div>
                    
                    <div class="form-group">
                      <label for="report_upload">Attachment</label>
                      <input type="file" class="form-control" name="report_upload[]" multiple>
                    </div>
                    
               @php
    $uploads = json_decode($reportDetails->report_upload, true) ?? [];
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
@endphp

@if(count($uploads))
    <div class="mt-3">
        @foreach($uploads as $file)
            @php
                $filePath = asset($file);
                $fileName = basename($file);
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            @endphp

            <div class="uploaded-file d-flex align-items-center justify-content-between border px-3 py-2 mb-2 rounded" style="background-color: #f9f9f9;">
                <div class="me-3 d-flex align-items-center" style="max-width: 60%;">
                    {{-- Show image or icon --}}
                    @if(in_array($extension, $imageExtensions))
                        <img src="{{ $filePath }}" alt="{{ $fileName }}" width="40" height="40" class="me-2 rounded" style="object-fit: cover;">
                    @else
                        <i class="fa fa-file me-2" style="font-size: 24px;"></i>
                    @endif
                    <span>{{ $fileName }}</span>  <!-- This will display the original file name -->
                </div>

                <div class="d-flex align-items-center">
                    <a href="{{ $filePath }}" download class="btn btn-sm btn-outline-primary me-2" title="Download">
                        <i class="fa fa-download"></i>
                    </a>

                    <button type="button"
                            class="btn btn-sm btn-outline-danger"
                            title="Delete"
                            data-file="{{ $file }}"
                            data-report="{{ $reportDetails->id }}"
                            onclick="if(confirm('Delete file?')) deleteFile(this);">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-muted">No Files Uploaded</p>
@endif




                    <div id="date-fields-edit" style="display: none;">
                        <div class="form-group">
                            <label for="start-date">Start Date</label>
                            <input type="text" class="form-control date-picker" placeholder="MM DD YY" id="edit-start-date" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end-date">End Date</label>
                            <input type="text" class="form-control date-picker" placeholder="MM DD YY" id="edit-end-date" name="end_date">
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
                        <button type="submit" class="btn custom-btn" id="updateBtn">Update</button>
                    </div>
                    
                    
                </form>
                <script>
                    function editToggleDateFields() {
                        const typeField = document.getElementById("type_edit");
                        const dateFields = document.getElementById("date-fields-edit");
                        
                        if (typeField.value === "State/Federal Approval") {
                            dateFields.style.display = "block";
                        } else {
                            dateFields.style.display = "none";
                        }
                    }
                </script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const form = document.getElementById('editReportModalForm');
                        const button = document.getElementById('updateBtn');
                
                        form.addEventListener('submit', function () {
                            button.disabled = true;
                            button.innerHTML = `
                                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                Processing...
                            `;
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>

