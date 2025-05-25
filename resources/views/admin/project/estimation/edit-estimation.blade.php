<style>
    .text-danger {
    color: #d51b11 !important;
    font-weight: bolder;
}

.cke_notification_warning {
   display: none !important;
}
</style>
<div class="modal fade" id="editEstimationModal" tabindex="-1" role="dialog" aria-labelledby="editEstimationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content custom-modal" style="max-width: 90vw; padding: 20px;">
            <div class="modal-header custom-modal-header" style="margin-right: -3%;margin-left: -3%; margin-top: -21px;">
                <h5 class="modal-title" id="editEstimationModalLabel">Edit Estimation</h5>
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

                <form action="{{route('update.estimation', ['estimationId'=> $estimation->id])}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="appointment_date">Date<span class="text-danger">*</span></label>
                        <input type="text" class="form-control date-picker" id="edit_estimation_date"
                            name="estimation_date" placeholder="MM DD YY"
                            value="{{ $estimation->estimation_date ? \Carbon\Carbon::parse($estimation->estimation_date)->format('Y-m-d') : '' }}" 
                            required readonly>
                    </div>

                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="edit_title" name="title"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="edit_description">Description<span class="text-danger">*</span></label>
                        <textarea class="form-control custom-input" id="edit_description" name="description" required>
                            {{ $estimation->description }}
                        </textarea>

                    </div>

                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <input type="text" class="form-control custom-input" id="edit_remark" name="remark">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn custom-btn"
                            style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;">Update</button>
                    </div>
                </form>

                <!-- CKEditor Script -->
                <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
                <script>
                   CKEDITOR.replace('edit_description', {
                        height: 600,
                        contentsCss: "{{asset('assets/css/custom.css')}}",
                        fullPage: true
                    });
                    
                    CKEDITOR.instances['edit_description'].on('instanceReady', function () {
                        CKEDITOR.instances['edit_description'].setData(`{!! addslashes($estimation->description) !!}`);
                    });

                </script>
            </div>
        </div>
    </div>
</div>
