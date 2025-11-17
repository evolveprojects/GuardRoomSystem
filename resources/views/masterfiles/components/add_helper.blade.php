<div class="modal fade" id="add-helper-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width:550px;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add New Helper</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form -->
            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="form-group mb-2">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                        <div class="form-group mb-2">
                            <label>EPF Number <span class="text-danger">*</span></label>
                            <select name="epf_number" class="form-control select2" required>
                                <option value="">Select EPF Number</option>
                                <option value="EPF001">EPF001</option>
                                <option value="EPF002">EPF002</option>
                                <option value="EPF003">EPF003</option>
                            </select>
                        </div>

                    <div class="form-group mb-2">
                        <label>Email</label>
                         <input type="email" name="email" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group mb-2">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Select2 Script -->
<script>
    $(document).ready(function () {
        $('#add-helper-modal').on('shown.bs.modal', function () {
            $('.select2').select2({
                dropdownParent: $('#add-helper-modal .modal-content'),
                width: '100%'
            });
        });

        $('#add-helper-modal').on('hidden.bs.modal', function () {
            $('.select2').select2('destroy');
        });
    });
</script>
