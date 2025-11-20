


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<button type="button" class="btn btn-primary btn-sm text-white actions-buttons" data-bs-toggle="modal"
    data-bs-target="#add-modal">
    <i class="ri-add-circle-line align-bottom"></i> Add New
</button>

{{-- <div class="modal fade" id="add-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    <div class="modal fade " id="add-modal" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Userlevel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
            </div>
            <form action="{{route('Masterfile.adduserlevel')}}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Level Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="level_code" value="" required
                               >
                            <p class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Level Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="level_name" required>
                            <p class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Description <span class="text-danger">*</span></label>
                           <textarea class="form-control" id="description" name="description" rows="3"></textarea>

                        </div>

                        <div class="form-group">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control-sm select2"
                                style="width: 100%; height: 30px;" required>
                                <option value="1">Active</option>

                                <option value="0">Inactive</option>

                            </select>
                        </div>

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
