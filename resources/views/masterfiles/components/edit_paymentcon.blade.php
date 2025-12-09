<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Edit Security Button -->
<button type="button" class="btn btn-success btn-sm text-white w-100" data-bs-toggle="modal"
    data-bs-target="{{ '#edit-payment-modal-' . $pay->id }}">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</button>

<!-- Edit payment Modal -->
<div class="modal fade" id="{{ 'edit-payment-modal-' . $pay->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:550px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Payment Condition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('Masterfile.editpayment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="A" {{ $pay->type == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $pay->type == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ $pay->type == 'C' ? 'selected' : '' }}>C</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trip <span class="text-danger">*</span></label>
                            <select name="trip" class="form-control select2" required>
                                <option value="">Select Trip</option>
                                <option value="1" {{ $pay->trip == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $pay->trip == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $pay->trip == '3' ? 'selected' : '' }}>3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">KM Range <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <input name="km_min" class="form-control" required placeholder="Km"
                                    value="{{ $pay->km_min }}">
                                <span class="mx-2">-</span>
                                <input name="km_max" class="form-control" required placeholder="Km"
                                    value="{{ $pay->km_max }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Weight Range <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <input name="weight_min" class="form-control" required placeholder="MT"
                                    value="{{ $pay->weight_min }}">
                                <span class="mx-2">-</span>
                                <input name="weight_max" class="form-control" required placeholder="MT"
                                    value="{{ $pay->weight_max }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Driver amount <span class="text-danger">*</span></label>
                            <input name="driver_amount" class="form-control" required onblur="formatAmount(this)"
                                value="{{ $pay->driver_amount }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Helper amount <span class="text-danger">*</span></label>
                            <input name="helper_amount" class="form-control" required onblur="formatAmount(this)"
                                value="{{ $pay->helper_amount }}">
                        </div>
                    </div>
                    <input type="text" hidden name="id" value="{{ $pay->id }}">
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-check-circle me-1"></i> Save
                        </button>
                        <button type="reset" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                    </div>

                </div>
            </form>


        </div>
    </div>
</div>

<!-- Initialize Select2 for security Modals -->
<script>
    $(document).ready(function() {
        $('[id^="edit-security-modal-"]').on('shown.bs.modal', function() {
            $(this).find('.select2').select2({
                dropdownParent: $(this),
                width: '100%'
            });
        });

        $('[id^="edit-security-modal-"]').on('hidden.bs.modal', function() {
            $(this).find('.select2').select2('destroy');
        });
    });
</script>
