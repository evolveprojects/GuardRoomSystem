<div class="modal fade" id="add-permission-modal" tabindex="-1" aria-labelledby="addpermissionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addpermissionLabel">Add New Permission Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ route('permissions.addpermission_type') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="permission_type" class="form-label">Type Name<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="typeName" name="type_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="Status" class="form-label">Status<span class="text-danger">*</span></label>
                        <select class="form-select" id="Status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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
