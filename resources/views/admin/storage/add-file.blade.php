<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="addFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="addFileModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storage.upload-file') }}" method="POST" id="storageForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">File Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="filename" name="filename" placeholder="Please Enter File Name" required>
                        <input type="hidden" name="folder_id" value="{{ $folder->id }}" >
                    </div>
                    <div class="form-group">
                        <label for="file">File <span class="text-danger">* </span><span class="" style="font-size: 12px;"> All File Type Allowed Pdf, PNG, JPG, Video, Excel etc</span></label>
                        <input type="file" class="form-control custom-input" id="upload" name="upload" placeholder="File" required>
                        <input type="hidden" name="folder" value="{{ $folder->name }}" >
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" id="submitBtn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;" class="btn custom-btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




