<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<button type="button" class="btn btn-success btn-sm text-white w-100" data-bs-toggle="modal"
    data-bs-target="{{ '#edit-modal-' . $permissions->id }}">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</button>

{{-- <div class="modal fade" id="add-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
<div class="modal fade " id="{{ 'edit-modal-' . $permissions->id }}" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
            </div>
            <form action="{{ route('permissions.updatepermission') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="permissionName" class="form-label">permission Name<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="permissionName" name="permission_name" value="{{ $permissions->permission_name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="permissionStatus" class="form-label">permission Type<span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="permissionStatus" name="permission_type" required>
                                <option value="">Select Permission Type</option>
                                @foreach ($permission_type as $type)
                                    <option value="{{ $type->id}}" {{ $permissions->permission_type == $type->id ? 'selected' : '' }}>{{ $type->type_name }}</option>
                                @endforeach
                        </div>
                        <input type="text" hidden name="id" value="{{ $permissions->id }}" />
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle me-1"></i> Edit
                    </button>
                    <button type="reset" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- jQuery -->
{{-- <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        // Initialize Select2 when the modal is shown
        $('#add-modal').on('shown.bs.modal', function() {
            $('#zone_id').select2({
                dropdownParent: $('#add-modal .modal-content'),
                width: '100%'
            });
        });

        // Destroy Select2 when modal is hidden to prevent duplicate initialization
        $('#add-modal').on('hidden.bs.modal', function() {
            $('#zone_id').select2('destroy');
        });
    });
</script>
