<style>
    .custom-input {
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    padding: 8px;
    font-size: 16px;
    background-color: #fdeeee;
    color: #333;
}
</style>
<div class="modal fade" id="addpaymentModal" tabindex="-1" role="dialog" aria-labelledby="addpaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="addpaymentModalLabel">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('message') }}
                    </div>
                @endif  
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('create.payment.invoice',['projectId'=> $projectDetails->id])}}" method="POST" id="invoicePaymentForm">
                    @csrf
                    <div class="form-group">
                        <label for="type">Payment Type<span class="text-danger">*</span></label>
                        <select class="form-control custom-input" id="payment_type" name="payment_type" required>
                            <option value="" disabled selected disable>Select Type</option>
                            <option value="Full Payment">Full Payment</option>
                            <option value="Partial Payment">Partial Payment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="project_final_amount">Project Final Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control custom-input" id="project_final_amount" name="project_final_amount" placeholder="Project Final Amount" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="discount">Discount(%)</label>
                        <input type="number" class="form-control custom-input" id="discount" name="discount" placeholder="Enter Discount Amount">
                    </div>
                    
                    <div class="form-group">
                        <label for="net_amount">Net Amount</label>
                        <input type="number" class="form-control custom-input" id="net_amount" name="net_amount" placeholder="Net Amount" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="pay_amount">Pay Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control custom-input" id="pay_amount" name="pay_amount" placeholder="Pay amount" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="due_amount">Due Amount</label>
                        <input type="number" class="form-control custom-input" id="due_amount" name="due_amount" placeholder="Due amount" readonly>
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
                        <input type="textarea" class="form-control custom-input" id="description" name="description" placeholder="description">
                    </div>
                    <div class="text-center">
                        <button type="submit" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;" id="submitBtn" class="btn custom-btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
//  $(document).ready(function () {
//     function calculateAmounts() {
//         let finalAmount = parseFloat($("#project_final_amount").val()) || 0;
//         let discountPercentage = parseFloat($("#discount").val()) || 0;
//         let payAmount = parseFloat($("#pay_amount").val()) || 0;
//         let paymentType = $("#payment_type").val();

//         let discountAmount = (finalAmount * discountPercentage) / 100;
//         let netAmount = finalAmount - discountAmount;

//         $("#net_amount").val(netAmount.toFixed(2));
//         $("#discount_amount").val(discountAmount.toFixed(2)); 

//         let dueAmount = netAmount - payAmount;
//         $("#due_amount").val(dueAmount >= 0 ? dueAmount.toFixed(2) : 0);
//     }

//     $("#project_final_amount, #discount, #pay_amount, #payment_type").on("input change", function () {
//         calculateAmounts();
//     });

//     $('#addpaymentModal').on('show.bs.modal', function () {
//         $("#payment_type, #project_final_amount, #discount, #net_amount, #pay_amount, #due_amount, #discount_amount").val("");
//     });

//     document.getElementById("invoicePaymentForm").addEventListener("submit", function () {
//         var submitBtn = document.getElementById("submitBtn");
//         submitBtn.innerHTML = 'Processing...';
//         submitBtn.disabled = true;
//     });
// });

// </script>

<script>
    $(document).ready(function () {
    function calculateAmounts() {
        let finalAmount = parseFloat($("#project_final_amount").val()) || 0;
        let discountPercentage = parseFloat($("#discount").val()) || 0;
        let payAmount = parseFloat($("#pay_amount").val()) || 0;

        let discountAmount = (finalAmount * discountPercentage) / 100;
        let netAmount = finalAmount - discountAmount;

        $("#net_amount").val(netAmount.toFixed(2));
        $("#discount_amount").val(discountAmount.toFixed(2)); 

        let dueAmount = netAmount - payAmount;
        $("#due_amount").val(dueAmount >= 0 ? dueAmount.toFixed(2) : 0);

        if (payAmount > netAmount) {
            alert("Pay amount cannot be more than Net amount.");
            $("#pay_amount").val("");
            $("#due_amount").val(netAmount.toFixed(2));
        }
    }

    $("#project_final_amount, #discount, #pay_amount, #payment_type").on("input change", function () {
        calculateAmounts();
    });

    $('#addpaymentModal').on('show.bs.modal', function () {
        $("#payment_type, #project_final_amount, #discount, #net_amount, #pay_amount, #due_amount, #discount_amount").val("");
    });

    $("#invoicePaymentForm").on("submit", function (e) {
        let netAmount = parseFloat($("#net_amount").val()) || 0;
        let payAmount = parseFloat($("#pay_amount").val()) || 0;

        if (payAmount > netAmount) {
            alert("Pay amount should not exceed the Net amount.");
            e.preventDefault();
            return false;
        }

        var submitBtn = document.getElementById("submitBtn");
        submitBtn.innerHTML = 'Processing...';
        submitBtn.disabled = true;
    });
});

</script>



