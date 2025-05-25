<style>
    .text-danger {
    color: #d51b11 !important;
    font-weight: bolder;
}
</style>
<div class="modal fade" id="editFinalReportModal" tabindex="-1" role="dialog" aria-labelledby="editFinalReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="editFinalReportModalLabel">Edit Final Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="editFinalReportForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    <input type="hidden" id="report_id" name="report_id" value="">

                    <div class="form-group">
                        <label for="edit_date">Date<span class="text-danger">*</span></label>
                        <input type="text" class="form-control date-picker" id="edit_date" name="date" placeholder="MM DD YY" required>
                    </div>

                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload Reports</label>
                        <div id="file_upload_wrapper">
                            <div class="d-flex align-items-center mb-2">
                                <button type="button" class="btn btn-success ml-2" id="addmoreimg_edit" data-id="1">+</button>
                            </div>
                        </div>
                        <div id="report_one_preview" class="form-group"></div>
                    </div>

                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <input type="text" class="form-control" id="remark" name="remark">
                    </div>

                    <button type="submit" class="btn btn-primary" id="updateReportButton" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; ">Update Report</button>
                </form>

                <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('editDescription', {
                        height: 300,
                        contentsCss: "{{ asset('assets/css/custom.css') }}",
                        fullPage: true
                    });
                </script>
            </div>
        </div>
    </div>
</div>
