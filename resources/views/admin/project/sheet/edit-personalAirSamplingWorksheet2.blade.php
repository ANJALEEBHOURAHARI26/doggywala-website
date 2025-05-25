<div class="modal fade" id="editPersonalAirSamplingWorksheet2" tabindex="-1" role="dialog" aria-labelledby="editPersonalAirSamplingWorksheet2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #D84055; color: #fff;">
                <h5 class="modal-title" id="editPersonalAirSamplingWorksheet2">Edit Personal Air Sampling Worksheet-2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPersonalAirSamplingWorksheet2Form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                    <input type="hidden" id="worksheet2_id" name="worksheet2_id"> 
            
                    <div class="form-group">
                        <label for="editTitle" style="margin-right: 73%;color: black;"><strong>Receipt Upload</strong></label>
                        <input type="file" class="form-control custom-input" id="receipt_image" name="receipt_image">
                        <div id="personalAirSamplingWorksheet2" class="mt-2">
                            @php
                                $filePath = asset('uploads/receiptimage/' . $personalAirSamplingWorksheet2->receipt_image);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp
                    
                            @if (!empty($data->receipt_image) && file_exists(public_path($personalAirSamplingWorksheet2->receipt_image)))
                                @if (in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                    <img src="{{ $filePath }}" alt="Report Upload" width="100" height="100">
                                    <br>
                                    <a href="{{ $filePath }}" download class="btn btn-info mt-2">Download Image</a> 
                                @elseif (in_array($fileExtension, ['pdf', 'doc', 'docx']))
                                    <a href="{{ $filePath }}" target="_blank" class="btn btn-info" style="display: inline-block;">Download Receipt</a>
                                @else
                                    <p>Unsupported file type</p>
                                @endif
                            @else
                                <p class="text-danger">File not found!</p>
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

