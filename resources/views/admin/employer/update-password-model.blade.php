<!-- Update Password Modal -->
<div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);color: #fff;">
                <h5 class="modal-title" id="updatePasswordModalLabel">Update Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updatePasswordForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="new_password" style="margin-left:-75%;">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" style="margin-left:-68%;">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" id="updatePasswordSubmit" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%);  border: none;">Update Password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.updatepassword-btn').click(function () {
            var userId = $(this).data('id'); 
            $('#user_id').val(userId);
            $('#updatePasswordForm').attr('action', '{{ route("employee.updatePassword", "") }}/' + userId);
        });

        $('#updatePasswordSubmit').click(function (e) {
            e.preventDefault();
            
            var newPassword = $('#new_password').val().trim();
            var confirmPassword = $('#confirm_password').val().trim();
            var isValid = true;

            $('.error-message').remove();

            if (newPassword === '') {
                $('#new_password').after('<span class="error-message text-danger">New Password is required.</span>');
                isValid = false;
            }

            if (confirmPassword === '') {
                $('#confirm_password').after('<span class="error-message text-danger">Confirm Password is required.</span>');
                isValid = false;
            } 

            if (newPassword !== '' && confirmPassword !== '' && newPassword !== confirmPassword) {
                $('#confirm_password').after('<span class="error-message text-danger">Passwords do not match.</span>');
                isValid = false;
            }

            if (isValid) {
                $('#updatePasswordForm').submit();
            }
        });
    });
</script>

