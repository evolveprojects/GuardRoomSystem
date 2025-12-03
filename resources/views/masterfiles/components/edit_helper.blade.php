<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Edit Helper Button -->
<button type="button" class="btn btn-success btn-sm text-white w-100" 
        data-bs-toggle="modal"
        data-bs-target="{{ '#edit-helper-modal-' . $helper->id }}">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</button>

<!-- Edit Helper Modal -->
<div class="modal fade" id="{{ 'edit-helper-modal-' . $helper->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:550px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Helper</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('Masterfile.updateHelper') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="id" value="{{ $helper->id }}">

                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" 
                               value="{{ $helper->name }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label>EPF Number <span class="text-danger">*</span></label>
                        <select name="epf_number" class="form-control select2" required>
                            <option value="">Select EPF Number</option>
                            <option value="EPF001" {{ $helper->epf_number == 'EPF001' ? 'selected' : '' }}>EPF001</option>
                            <option value="EPF002" {{ $helper->epf_number == 'EPF002' ? 'selected' : '' }}>EPF002</option>
                            <option value="EPF003" {{ $helper->epf_number == 'EPF003' ? 'selected' : '' }}>EPF003</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ $helper->email }}" autocomplete="off">
                    </div>

                    <div class="form-group mb-2">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" 
                               value="{{ $helper->phone }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="helperStatus">Status <span class="text-danger">*</span></label>
                        <select name="status" id="helperStatus" class="form-control-sm select2" 
                                style="width: 100%; height: 30px;" required>
                            @if($helper->status == 1)
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                            @else
                                <option selected value="0">Inactive</option>
                                <option value="1">Active</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($helper->image)
                            <img src="{{ asset('uploads/helpers/' . $helper->image) }}" 
                                 alt="Helper Image" class="img-fluid mt-2" style="max-height: 80px;">
                        @endif
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

<!-- Initialize Select2 for Helper Modals -->
<script>
$(document).ready(function() {
    $('[id^="edit-helper-modal-"]').on('shown.bs.modal', function() {
        $(this).find('.select2').select2({
            dropdownParent: $(this),
            width: '100%'
        });
    });

    $('[id^="edit-helper-modal-"]').on('hidden.bs.modal', function() {
        $(this).find('.select2').select2('destroy');
    });
});
</script>
