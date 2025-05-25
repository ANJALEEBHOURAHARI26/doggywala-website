<div class="modal fade" id="addexpenseModal" tabindex="-1" role="dialog" aria-labelledby="addexpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="addexpenseModalLabel">Add Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('create.expense')}}" method="POST" id="expenseForm">
                    @csrf
                    <div class="form-group">
                        <label for="expense_name">Expense Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" id="expense_name" name="expense_name" placeholder="Expense Name" required>
                    </div>
                    <div class="form-group">
                        <label for="project_case_id">Case ID/Job Number<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="project_case_id" name="case_id" required>
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
                        <input type="text" class="form-control custom-input date-picker" id="date" name="date" placeholder="MM-DD-YYYY" required>
                    </div>
                    <div class="form-group">
                        <label for="note_remarks">Note/Remarks</label>
                        <input type="textarea" class="form-control custom-input" id="note_remarks" name="note_remarks" placeholder="Note">
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submitBtn" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;" class="btn custom-btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




