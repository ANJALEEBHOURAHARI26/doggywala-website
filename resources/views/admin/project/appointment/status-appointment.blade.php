<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: #fff;">
                <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="statusAppointmentForm">
                    @csrf
                    @method('PUT') 
                    <input type="hidden" id="appointment_id" name="appointment_id">
                    <div class="form-group">
                        <label for="status">Select Status</label>
                        <select class="form-control" id="status" name="status" style="background-color:#FDF5F6; border-color:#D8405533;">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                            <!--<option value="Cancelled">Cancelled</option>-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <input type="textarea" class="form-control custom-input" id="note" name="note" placeholder="Note">                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>