<!-- Edit user Button -->
<button type="button" class="btn btn-success btn-sm text-white w-100"
        data-bs-toggle="modal"
         data-bs-target="#edit-user-modal-{{ $user->id }}">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</button>

<!-- Edit User Modal -->
<div class="modal fade" id="edit-user-modal-{{ $user->id }}" tabindex="-1" 
     aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">
                    <i class="bi bi-pencil-square"></i> Edit User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('Masterfile.updateuser') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_name_{{ $user->id }}" class="form-label">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" 
                                   id="edit_name_{{ $user->id }}" 
                                   name="name" 
                                   value="{{ $user->name }}" 
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_email_{{ $user->id }}" class="form-label">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" 
                                   id="edit_email_{{ $user->id }}" 
                                   name="email" 
                                   value="{{ $user->email }}" 
                                   required>
                        </div>

                        <!-- User Type -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_user_type_{{ $user->id }}" class="form-label">
                                User Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" 
                                    id="edit_user_type_{{ $user->id }}" 
                                    name="user_type" 
                                    required>
                                <option value="">Select User Type</option>
                                @foreach($getuserlevels as $level)
                                    <option value="{{ $level->id }}" 
                                            {{ $user->user_type == $level->id ? 'selected' : '' }}>
                                        {{ $level->level_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- EPF Number -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_epf_{{ $user->id }}" class="form-label">
                                EPF Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" 
                                   id="edit_epf_{{ $user->id }}" 
                                   name="epf_number" 
                                   value="{{ $user->epf_number }}" 
                                   required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_phone_{{ $user->id }}" class="form-label">
                                Phone
                            </label>
                            <input type="text" class="form-control" 
                                   id="edit_phone_{{ $user->id }}" 
                                   name="phone" 
                                   value="{{ $user->phone }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_status_{{ $user->id }}" class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" 
                                    id="edit_status_{{ $user->id }}" 
                                    name="status" 
                                    required>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Password (Optional) -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_password_{{ $user->id }}" class="form-label">
                                New Password <small class="text-muted">(Leave blank to keep current)</small>
                            </label>
                            <input type="password" class="form-control" 
                                   id="edit_password_{{ $user->id }}" 
                                   name="password">
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_password_confirmation_{{ $user->id }}" class="form-label">
                                Confirm New Password
                            </label>
                            <input type="password" class="form-control" 
                                   id="edit_password_confirmation_{{ $user->id }}" 
                                   name="password_confirmation">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>