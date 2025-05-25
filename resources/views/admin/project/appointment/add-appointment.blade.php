<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="modal fade {{ session('success') ? '' : ($errors->any() ? 'show' : '') }}" 
     id="addAppointmentModal" tabindex="-1" role="dialog" 
     aria-labelledby="addAppointmentModalLabel" aria-hidden="true"
     style="{{ session('success') ? '' : ($errors->any() ? 'display:block;' : '') }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">Add Appointment</h5>
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

                <form action="{{ route('create.appointment', ['projectId'=> $projectDetails->id]) }}" method="post" id="appointmentForm">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ $projectDetails->id }}">

                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="title" name="title" value="{{ old('title') }}" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_date">Date & Time<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="appointment_date" name="appointment_date" placeholder="MM DD YY 00:00 PM/AM" value="{{ old('appointment_date') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <input type="text" class="form-control custom-input" id="note" name="note" value="{{ old('note') }}" placeholder="Note">
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submitBtn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;" class="btn custom-btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery & jQuery UI (already included probably) -->
<!-- jQuery & jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/cupertino/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- Timepicker Addon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>

<style>
    #appointment_date {
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background-color: #fff;
        cursor: pointer;
    }

    .ui-datepicker {
        font-size: 14px;
        background: linear-gradient(252deg, rgb(82 87 203) 0%, rgb(167 53 69) 100%);
    }
</style>

<script>
 
    // $("#appointment_date").datetimepicker({
    //     dateFormat: "MM dd yy",        // No extra space after year
    //     timeFormat: ", h:mm TT",       // Comma immediately after date (no space)
    //     controlType: 'select',         // Dropdowns for hours/minutes
    //     oneLine: true,                 // Date + time in one row
    //     changeMonth: true,
    //     changeYear: true,
    //     yearRange: "1900:2100",
    //     minDate: new Date(),
    //     showButtonPanel: true
    // });

    $("#appointment_date").datetimepicker({
        dateFormat: "MM dd yy",
        timeFormat: ", h:mm TT",
        controlType: 'select',
        oneLine: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2100",
        minDate: 0, // Sirf today ka date se minimum
        showButtonPanel: true
    });



    $("#appointmentForm").on("submit", function() {
        $("#submitBtn").text('Processing...').prop("disabled", true);
    });

    $('#addAppointmentModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });

    // Agar errors hain to modal open ho
    @if($errors->any())
        $(document).ready(function() {
            $("#addAppointmentModal").modal("show");
        });
    @endif
</script>
