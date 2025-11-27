<!-- resources/views/permission/components/edit_permission_type.blade.php -->
<!-- Edit Permission Type Modal -->
<div class="modal fade" id="editPermissionTypeModal{{ $permissions->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">

      <div class="modal-header">
    <h5 class="modal-title"><i class="exampleModalLabel"></i> Edit Permission Type</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>


      <!-- Use POST because your route is POST; include the id in a hidden input -->
      <form action="{{ route('permissions.updatepermission_type') }}" method="POST" novalidate>
        @csrf

        <input type="hidden" name="id" value="{{ $permissionType->id }}">

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-bold">Permission Type</label>
            <input type="text" name="type_name" class="form-control" value="{{ old('type_name', $permissionType->type_name) }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Status</label>
            <select name="status" class="form-control" required>
              <option value="1" {{ $permissionType->status == 1 ? 'selected' : '' }}>Active</option>
<option value="0" {{ $permissionType->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
              <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-1"></i> Edit</button>
              <button type="reset" class="btn btn-secondary ms-2" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Cancel</button>

        </div>

      </form>

    </div>
  </div>
</div>
