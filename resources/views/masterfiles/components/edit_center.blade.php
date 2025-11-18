<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Edit Center Button -->
<button type="button" class="btn btn-success btn-sm text-white w-100" 
        data-bs-toggle="modal"
        data-bs-target="{{ '#edit-center-modal-' . $center->id }}">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</button>

<!-- Edit Center Modal -->
<div class="modal fade" id="{{ 'edit-center-modal-' . $center->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Center</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('Masterfile.updatecenter') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $center->id }}">

                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="centerID">Center ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="center_id" 
                               value="{{ $center->center_id }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="centerName">Center Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="center_name" 
                               value="{{ $center->center_name }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="centerStatus">Status <span class="text-danger">*</span></label>
                        <select name="status" id="centerStatus" class="form-control-sm select2" 
                                style="width: 100%; height: 30px;" required>
                            @if($center->status == 1)
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                            @else
                                <option selected value="0">Inactive</option>
                                <option value="1">Active</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
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

<!-- jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for each modal when shown
    $('[id^="edit-center-modal-"]').on('shown.bs.modal', function() {
        $(this).find('.select2').select2({
            dropdownParent: $(this),
            width: '100%'
        });
    });

    // Destroy Select2 when modal is hidden
    $('[id^="edit-center-modal-"]').on('hidden.bs.modal', function() {
        $(this).find('.select2').select2('destroy');
    });
});
</script>
