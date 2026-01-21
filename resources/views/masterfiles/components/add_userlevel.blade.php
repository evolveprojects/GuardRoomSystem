<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<div class="modal fade" id="add-userlevel-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:500px;">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Userlevel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('Masterfile.adduserlevel') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <!-- LEVEL CODE -->
                    <div class="form-group mb-3">
                        <label>Level Code <span class="text-danger">*</span></label>
                        <input type="text"
                               name="level_code"
                               value="{{ old('level_code') }}"
                               class="form-control @error('level_code') is-invalid @enderror"
                               required>

                        @error('level_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- LEVEL NAME -->
                    <div class="form-group mb-3">
                        <label>Level Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="level_name"
                               value="{{ old('level_name') }}"
                               class="form-control @error('level_name') is-invalid @enderror"
                               required>

                        @error('level_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="form-group mb-3">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <!-- STATUS -->
                    <div class="form-group mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status"
                                class="form-control select2"
                                required>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-save">Save</button>
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- REOPEN MODAL IF VALIDATION FAILS --}}
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let modal = new bootstrap.Modal(
            document.getElementById('add-userlevel-modal')
        );
        modal.show();
    });
</script>
@endif

<script>
$(document).ready(function () {
    $('#add-userlevel-modal').on('shown.bs.modal', function () {
        $('.select2').select2({
            dropdownParent: $('#add-userlevel-modal'),
            width: '100%'
        });
    });

    $('#add-userlevel-modal').on('hidden.bs.modal', function () {
        $('.select2').select2('destroy');
    });
});
</script>
