<div class="modal fade" id="add-permission-modal" tabindex="-1" aria-labelledby="addpermissionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addpermissionLabel">Add New Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{route('permissions.addpermission')}}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="permissionName" class="form-label">permission Name<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="permissionName" name="permission_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="permissionStatus" class="form-label">permission Type<span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="permissionStatus" name="permission_type" required>
                            <option value="">Select Permission Type</option>
                            @foreach ($permission_type as $type)
                                <option value="{{ $type->id}}">{{ $type->type_name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle me-1"></i> Save
                    </button>
                    <button type="reset" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
