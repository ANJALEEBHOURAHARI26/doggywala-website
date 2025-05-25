@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
        <!-- DataTables CSS -->
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">-->
<!-- jQuery (Required) -->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!-- DataTables JS -->
<!--<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>-->

<style>
.action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
}
.action-buttons img {
    height: 20px;
}
.action-buttons i {
    font-size: 18px;
}

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    
    .custom-table thead.thead-light th {
        /*background-color: #D84055 !important;*/
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%) !important;
        color: white !important;
        font-weight: bold;
    }

    .custom-table th, .custom-table td {
        border: 1px solid #3136C1;
        padding: 12px;
        text-align: left;
    }

        .custom-table th {
            background-color: #D84055;
            color: white;
            font-weight: bold;
        }

        .custom-table td {
            color: #1C1D3E;
        }

        .action-icons {
            display: flex;
            gap: 8px;
        }

        .action-icons a {
            text-decoration: none;
            font-size: 16px;
            padding: 5px 8px;
            border-radius: 4px;
            color: white;
        }

      

        .delete-btn {
            background-color: #dc3545;
        }
        .custom-modal-header {
    /* background-color: #D84055; */
    background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);
    border: none;
    color: #fff;
    font-weight: bold;
}
.text-danger-error{
    color:#fc544b !important;
    font-size: 0.9rem;
}
        /* Force column width to 0px */

    </style>   
@php
    if(auth()->check()) {
        $user = auth()->user();
        $staffId = $user->staff_id;
        $userType = $user->user_type;

        $role = DB::table('model_has_roles')
                ->where('model_id', $staffId)
                ->join('role_permission', 'model_has_roles.role_id', '=', 'role_permission.id')
                ->select('role_permission.name as role_name', 'model_has_roles.role_id')
                ->first();

        $permissions = [];
        if ($role) {
            $permissions = DB::table('role_has_permissions')
            ->where('role_id', $role->role_id)
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->pluck('permissions.name')->toArray();
        }
    }
@endphp
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Invoice/
                <!--<span style=" color:black !important; font-weight: 600; font-size: 22px;">Customer List</span></h1> -->
                <a href="" style=" color:black !important; font-weight: 600; font-size: 22px;">Invoice List</a>
          </div>

          <!-- Row -->
          <div class="row" >
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('message') }}
                    </div>
                @endif     
                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive p-3">
            <table class="table table-striped custom-table nowrap" id="dataTable" style="width:100%">

                    <thead class="thead-light">
                      <tr>
                          <th>Created Date</th>
                         <th>Invoice Date</th>
                         <th>Invoice Number</th>
                         <th>Case ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Payment Status</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <!--@php $i = 1; @endphp-->
                        @foreach($customerDetails as $customer)
                           <tr>
                                 <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('M d Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($customer->date)->format('M d Y') }}</td>

                                @php 
                                $customername = \DB::table('projects')->where('id', $customer->case_id)->first();
                                $customerdetail = \DB::table('customers')->where('id', $customer->customer_id)->first();
                                $multi_due_total = \DB::table('invoice_multi_pay')
                                ->where('invoice_id', $customer->id)
                                ->sum('amount_due');
                            
                            $multi_paid_total = \DB::table('invoice_multi_pay')
                                ->where('invoice_id', $customer->id)
                                ->sum('amount_paid');  
                               $dueamt = round($customer->total - $multi_paid_total, 2);

                                @endphp
                                <td>
                                    <a href="{{ route('get-invoices-view', $customer->id) }}" title="View Invoice Details">
                                        {{ $customer->invoice_number ?? 'N/A' }}
                                     </a>
                                 </td> 
                                <td>
                                    <a href="{{ route('project-details', $customername->id ?? 'N/A') }}" title="View Invoice Details">
                                        {{ $customername->case_id ?? 'N/A' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('customer.view', $customer->customer_id ?? 'N/A') }}" title="View Customer Details">
                                        {{ $customer->customer_name ?? 'N/A' }}
                                    </a>
                                 </td>

                                <td>{{ $customerdetail->email ?? 'N/A' }}</td>
                                <td>{{ $customerdetail->phone_number ?? 'N/A' }}</td>
                                <td>  
                                    @if($multi_paid_total < $customer->total && $multi_paid_total != 0)
                                        <span class="btn btn-warning btn-sm">Pending</span>
                                    @elseif($customer->total == $multi_paid_total)
                                        <span class="btn btn-success btn-sm">Paid</span>
                                    @else
                                        <span class="btn btn-danger btn-sm">Unpaid</span>
                                    @endif
                                </td>
                                <td>{{ $customer->total ?? 'N/A' }}</td>
                                <td>{{ $multi_paid_total ?? 'N/A' }}</td>
                               <td>
                                {{ $multi_paid_total ? number_format($customer->total - $multi_paid_total, 2) : 'N/A' }}
                            </td>

                                  <input type="hidden" value="{{ $customer->amount_due }}" id="due_amount" name="due_amount">
    	                           <input type="hidden" value="{{ $customer->total }}" id="total_amount" name="total_amount">
                                <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    {{-- View Button --}}
                                    <a href="{{ route('get-invoices-view', $customer->id) }}" class="btn btn-sm btn-primary" title="View" style="font-size: 0.65rem !important;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                            
                                    {{-- Payment Button --}}
                                   @if($multi_paid_total < $customer->total)
                                        <a onclick="addPayment({{ $customer->id }}, {{ $dueamt }}, {{ $multi_paid_total }})" title="Add Payment"
                                           style="cursor: pointer;font-size: 27px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fa fa-credit-card"></i>
                                        </a>
                                    @endif
                            
                                    {{-- Delete Button --}}
                                    <button onclick="deleteInvoice({{ $customer->id }})"
                                            style="border: none; background: transparent; padding: 0;">
                                        <img src="{{ asset('assets/img/Delete-Icon.png') }}" alt="Delete" title="Delete" style="height: 27px;">
                                    </button>
                            
                                    {{-- View Summary --}}
                                    <a href="{{ route('view.invoice.multi.payment', $customer->id) }}" title="View Summary">
                                        <img src="{{ asset('assets/img/ViewSummary.png') }}" alt="View Summary" style="height: 27px;">
                                    </a>
                                </div>
                            </td>

                                
                                      
                            </tr>
                            @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- DataTable with Hover -->
         
          </div>
          <!--Row-->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - design & developed by
              <b><a href="https://www.sunshineitsolution.com/" target="_blank">Sunshine it Solution</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
  <div id="detailPopup" class="modal fade class="modal fade show"" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add-update-payment-form" method="POST"> 
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="addAppointmentModalLabel">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> 
                <div class="form-group col-md-12"> 
                      <label for="customer">Payment Mode</label><span class="text-danger"> *</span>
                        <select class="form-control" name="payment_mode"  id="payment_mode" style="background-color:#FDF5F6; border-color:#D8405533;" required>
                                <option value="" disabled selected>Select Type...</option>
                                <!--<option value="Cash">Cash</option>-->
                                <option value="Online">Online</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Credit card">Credit card</option> 
                            </select>
                    </div>
                    
                        <div class="form-group col-md-12"> 
                          <label for="customer">Due Amount</label><br>
                            <input type="text" readonly id="pay_due_amount" name="pay_due_amount" style="background-color:#FDF5F6; border-color:#D8405533;width: 100%;padding: 8px;">
                            </div> 
                     <div class="form-group col-md-12"> 
                      <label for="customer">Pay Amount</label><span class="text-danger"> *</span><br>
                        <input type="text" id="pay_total_amount" name="pay_total_amount" style="background-color:#FDF5F6; border-color:#D8405533;width: 100%;padding: 8px;" required>
                    </div> 
                    <div class="form-group col-md-12"> 
                      <label for="customer">Remaining Amount</label><br>
                        <input type="text" readonly id="remaining_total_amount" name="remaining_total_amount" style="background-color:#FDF5F6; border-color:#D8405533;width: 100%;padding: 8px;">
                    </div> 
                    <div class="form-group col-md-12"> 
                          <label>Description</label><br>
                            <input type="text" id="discription" name="discription" style="background-color:#FDF5F6; border-color:#D8405533;width: 100%;padding: 8px;">
                            </div> 
                 <input type="hidden" readonly id="total_amt" name="total_amt">
                <input type="hidden" id="invoice_id" name="invoice_id">
                    </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; color: white;">Add Payment</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                 </div> 
            </form>
        </div>
    </div>
</div>

 <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/js/ruang-admin.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> 
<script>
    function addPayment(id, amount_due, amount_paid) {
    	let total_amount = $('#total_amount').val();
    	let due_amount = $('#due_amount').val();
     
        $('#pay_due_amount').val(amount_due);
        $('#total_amt').val(amount_paid);
        $('#invoice_id').val(id);
        $('#detailPopup').modal('show');
    }
   
    document.addEventListener('DOMContentLoaded', function () {
        const payAmountInput = document.getElementById('pay_total_amount');
        const dueAmountInput = document.getElementById('pay_due_amount');
        const remainingInput = document.getElementById('remaining_total_amount');
    
        payAmountInput.addEventListener('input', function () {
            const dueAmount = parseFloat(dueAmountInput.value) || 0;
            const payAmount = parseFloat(payAmountInput.value) || 0;
    
            if (payAmount > dueAmount) {
                alert("Pay amount cannot be greater than due amount.");
                payAmountInput.value = '';
                remainingInput.value = '';
            } else {
                const remaining = dueAmount - payAmount;
                remainingInput.value = remaining;
            }
        });
    }); 
    
    
    $('#add-update-payment-form').submit(function(e) {
        e.preventDefault();
        // var  selectedValue = '';
        let id = $('#invoice_id').val();
        let pay_due_amount = $('#pay_total_amount').val(); 
        let total_amt = $('#total_amt').val(); 
        let remaining_total_amount = $('#remaining_total_amount').val();
        let discription = $('#discription').val();
        var payment_mode = document.getElementById('payment_mode');
        if (payment_mode) {
            var selectedValue = payment_mode.value; 
        } 
       
        $.ajax({
            url: '/updatepayment/' + id,
            method: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                 pay_due_amount: pay_due_amount,
                 total_amt: total_amt,
                 remaining_total_amount: remaining_total_amount,
                 payment_mode: selectedValue,
                 discription: discription
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#detailPopup').modal('hide');
                    alert(response.message);
                    // $('#dataTable').DataTable().ajax.reload();
                    location.reload();
                } else {
                    alert('Error', response.message, 'error');
                }
            }
        });
    });
     

$(document).ready(function () {
    $('#dataTable').DataTable({
        "ordering": true, 
         scrollX: true,  
         order: [[0, 'desc']]
    });
});

</script>

  <!-- Page level custom scripts -->
 
  <script>
    function deleteCustomer(id) {
        if (confirm('Are you sure you want to delete this customer?')) {
            $.ajax({
                url: `/customer-delete/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert(response.success);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    }
    
    
    function deleteInvoice(invoiceId) {
        if (confirm('Are you sure you want to delete this Invoice?')) {
            
            $.ajax({
                url: `/delete-invoices/${invoiceId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    alert(response.message);
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    }
</script>
</body>

</html>