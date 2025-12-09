<!-- Add Vehicle Modal -->
<div class="modal fade" id="add-pay-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width:600px;">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Payment Conditons</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('Masterfile.addpayment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trip <span class="text-danger">*</span></label>
                            <select name="trip" class="form-control select2" required>
                                <option value="">Select Trip</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">KM Range <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <input name="km_min" class="form-control" required placeholder="Km">
                                <span class="mx-2">-</span>
                                <input name="km_max" class="form-control" required placeholder="Km">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Weight Range <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <input name="weight_min" class="form-control" required placeholder="MT">
                                <span class="mx-2">-</span>
                                <input name="weight_max" class="form-control" required placeholder="MT">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Driver amount <span class="text-danger">*</span></label>
                            <input name="driver_amount" class="form-control" required onblur="formatAmount(this)">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Helper amount <span class="text-danger">*</span></label>
                            <input name="helper_amount" class="form-control" required onblur="formatAmount(this)">
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-save">Save</button>

                        <button type="reset" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
