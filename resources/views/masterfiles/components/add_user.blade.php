<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width:550px;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
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

                    <!-- Row with User Type and EPF Number -->
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label>User Type <span class="text-danger">*</span></label>
                            <select name="usertype" class="form-control select2" required>
                                <option value="">Select</option>
                                <option value="Admin">Admin</option>
                                <option value="Guard">Guard</option>
                                <option value="Manager">Manager</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>EPF Number <span class="text-danger">*</span></label>
                            <select name="epf_number" class="form-control select2" required>
                                <option value="">Select EPF Number</option>
                                <option value="EPF001">EPF001</option>
                                <option value="EPF002">EPF002</option>
                                <option value="EPF003">EPF003</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-save">Save</button>
                   
                     <button type="reset" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Select2 Script -->
<script>
    $(document).ready(function () {
        $('#add-user-modal').on('shown.bs.modal', function () {
            $('.select2').select2({
                dropdownParent: $('#add-user-modal .modal-content'),
                width: '100%'
            });
        });

        $('#add-user-modal').on('hidden.bs.modal', function () {
            $('.select2').select2('destroy');
        });
    });
</script>
