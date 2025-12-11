<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- {{-- <button type="button" class="btn btn-primary btn-sm text-white actions-buttons" data-bs-toggle="modal"
    data-bs-target="#add-modal">
    <i class="ri-add-circle-line align-bottom"></i> Add New
</button> --}} -->

<!-- {{-- <div class="modal fade" id="add-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}} -->
<div class="modal fade" id="add-otherpayments-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
            </div>
            <form action="{{ route('Masterfile.addotherpayments') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="payment_type">Payment Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="payment_type" name="payment_type" required>
                        <p class="text-danger"></p>
                    </div>

                    <div class="form-group">
                        <label for="driver_amount">Drivers Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="driver_amount" name="driver_amount" min="0" required>
                        <p class="text-danger"></p>
                    </div>

                    <div class="form-group">
                        <label for="helper_amount">Helpers Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="helper_amount" name="helper_amount" min="0" required>
                        <p class="text-danger"></p>
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
<!-- {{-- <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script> --}} -->
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