<div class="modal fade {{ session('edit_success') ? '' : ($errors->any() ? 'show' : '') }}" 
     id="editModal" tabindex="-1" role="dialog" 
     aria-labelledby="editModalLabel" aria-hidden="true"
     style="{{ session('edit_success') ? '' : ($errors->any() ? 'display:block;' : '') }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: #fff;">
                <h5 class="modal-title" id="editModalLabel">Edit Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="editAppointmentForm" action="" method="POST">
                    @csrf
                    @method('PUT') 
                    <input type="hidden" id="appointment_id" name="appointment_id">

                    <div class="form-group">
                        <label for="editTitle">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{old('title')}}" required style="background-color:#FDF5F6; border-color:#D8405533;">
                    </div>
                    <div class="form-group">
                        <label for="editDate">Date & Time<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_appointment_date" name="appointment_date" placeholder="MM DD YY 00:00 PM/AM" style="background-color:#FDF5F6; border-color:#D8405533;">
                    </div>
                    <div class="form-group">
                        <label for="editNote">Note</label>
                        <textarea class="form-control" id="note" name="note" placeholder="Note" value="{{old('note')}}"  style="background-color:#FDF5F6; border-color:#D8405533;"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="editSubmitBtn" class="btn btn-primary" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; border-color: #D84055;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>