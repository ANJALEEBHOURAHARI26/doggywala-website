<div class="modal fade" id="roleAssignModal" tabindex="-1" role="dialog" aria-labelledby="roleAssignModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); color: #fff;">
                <h5 class="modal-title" id="roleAssignModalLabel">Role Assign</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="roleAssignForm">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id">
                    
                    <div class="form-group">
                        <label for="role" style="margin-left:-90%;">Role</label>
                        <select class="form-control" id="role_id" name="role_id" style="background-color:#FDF5F6; border-color:#D8405533;">
                             <option disabled selected>Select One</option>
                            @forelse($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @empty
                                <option disabled>No roles available</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>