<div class="modal fade" id="editProjectClearance" tabindex="-1" role="dialog" aria-labelledby="editProjectClearance" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #D84055; color: #fff;">
                <h5 class="modal-title" id="editProjectClearance">Edit Clearance Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProjectClearance" action="{{ route('update.project.clearance', $projectClearance->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <input type="hidden" id="clearance_id" name="clearance_id"> 
            
                    <div class="form-group">
                        <label for="editTitle" style="margin-right: 73%;color: black;"><strong>Receipt Upload</strong></label>
                        <input type="file" class="form-control custom-input" id="receipt_upload" name="receipt_upload">
                        <div id="projectClearance" class="mt-2">
                           @php
                                $filePath = asset('uploads/ProjectClearance/' . $projectClearance->receipt_upload);
                                $fileExtension = strtolower(pathinfo(public_path('uploads/ProjectClearance/' . $projectClearance->receipt_upload), PATHINFO_EXTENSION));
                            @endphp
                            
                            @if(in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                <br>
                                <a href="{{ $filePath }}" download class="btn btn-info mt-2">Download Image</a> 
                            @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx']))
                                <a href="{{ $filePath }}" download class="btn btn-info" style="display: inline-block;">Download Receipt</a>
                            @else
                                <p>Unsupported file type</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" style="margin-right:80%;color: black;">Description</label>
                        <input type="text" class="form-control custom-input" id="description" name="description">
                    </div>
                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background-color: #D84055; border-color: #D84055;margin-top: 14px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

