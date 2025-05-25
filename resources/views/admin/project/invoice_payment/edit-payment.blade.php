<div class="modal fade" id="editpaymentModal" tabindex="-1" role="dialog" aria-labelledby="editpaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="editpaymentModalLabel">Edit Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="paymentInvoiceForm">
                    @csrf
                    @method('PUT') 
                    <input type="hidden" id="payment_id" name="payment_id" value="">

                    <div class="form-group">
                        <label for="payment_type">Payment Type<span class="text-danger">*</span></label>
                        <select class="form-control custom-input" id="payment_type" name="payment_type" required>
                            <option value="Full Payment">Full Payment</option>
                            <option value="Partial Payment">Partial Payment</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project_final_amount">Project Final Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control custom-input" id="project_final_amount" name="project_final_amount" readonly>
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount(%)</label>
                        <input type="number" class="form-control custom-input" id="discount" name="discount" placeholder="Enter discount amount" oninput="calculateDueAmount()" readonly>
                    </div>
                    <div class="form-group">
                        <label for="net_amount">Net Amount</label>
                        <input type="number" class="form-control custom-input" id="net_amount" name="net_amount" placeholder="Net Amount" readonly>
                    </div>


                    <div class="form-group">
                        <label for="paid_amount">Total Paid Amount</label>
                        <input type="number" class="form-control custom-input" id="paid_amount" name="paid_amount" readonly>
                    </div>

                    <div class="form-group">
                        <label for="pay_amount">New Pay Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control custom-input" id="pay_amount" name="pay_amount" required placeholder="Enter new payment" oninput="calculateDueAmount()">
                    </div>

                    <div class="form-group">
                        <label for="due_amount">Remaining Due Amount</label>
                        <input type="text" class="form-control custom-input" id="due_amount" name="due_amount" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="type">Payment Mode<span class="text-danger">*</span></label>
                        <select class="form-control custom-input" id="payment_mode" name="payment_mode" required>
                            <option value="" disabled selected disable>Select Mode</option>
                            <option value="Cash">Cash</option>
                            <option value="Online">Online</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Credit Card">Credit Card</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control custom-input" id="description" name="description" placeholder="Enter description">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn custom-btn" id="updateBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
