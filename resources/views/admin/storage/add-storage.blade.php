<div class="modal fade" id="addStorageModal" tabindex="-1" role="dialog" aria-labelledby="addStorageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="addStorageModalLabel">Add Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storage.create') }}" method="POST" id="storageForm">
                    @csrf
                    <div class="form-group">
                        <label for="folder_name">Folder Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="folder_name" name="folder_name" placeholder="Folder Name" required>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" id="submitBtn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;" class="btn custom-btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




