<div class="modal fade" id="editExpenseModal" tabindex="-1" role="dialog" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: #fff;">
                <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="expenseEditForm">
                    @csrf
                    @method('PUT') 
                    <input type="hidden" name="expense_id" id="expense_id">
                    
                    <div class="form-group">
                        <label for="expense_name">Expense Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="expense_name" name="expense_name" placeholder="Expense Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="case_id">Case ID/Job Number<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="edit_case_id" name="case_id" required>
                            <option value="">Select Case ID</option>
                            @foreach($projectCaseIds as $caseId)
                                <option value="{{ $caseId }}">{{ $caseId }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="category" name="category" placeholder="Category" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount">Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control custom-input" id="amount" name="amount" placeholder="Amount" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="date">Date<span class="text-danger">*</span></label>
                        <input type="text" class="form-control datepicker" id="editdate" name="date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="note_remarks">Note/Remarks</label>
                        <input type="textarea" class="form-control custom-input" id="note_remarks" name="note_remarks" placeholder="Note">
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#editExpenseModal').on('shown.bs.modal', function () {
        setTimeout(function () {
            $('#edit_case_id').select2({
                placeholder: "Select Case ID",
                allowClear: true,
                dropdownParent: $('#editExpenseModal') 
            });
        }, 100);
    });
});
$(document).ready(function() {
        $('#editdate').datepicker({
            dateFormat: 'MM dd yy', 
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2100"
        });
    });
</script>
