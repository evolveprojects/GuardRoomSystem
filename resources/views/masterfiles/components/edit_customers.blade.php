<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Edit Driver Button -->
<button type="button" class="btn btn-success btn-sm text-white w-100" data-bs-toggle="modal"
    data-bs-target="{{ '#edit-customers-modal-' . $lo_cus->id }}">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</button>

<!-- Edit customers Modal -->
<div class="modal fade" id="{{ 'edit-customers-modal-' . $lo_cus->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:550px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Customers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>



            <form action="{{ route('Masterfile.editcustomers') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                            <select name="customer_number" class="form-control select2" id="customers" required
                                onchange="updateCustomerName()">
                                <option value="">Select Customer</option>
                                @if (!empty($customers) && isset($customers['value']) && is_array($customers['value']))
                                    @foreach ($customers['value'] as $cus)
                                        @php
                                            $customerNumber = $cus['CustomerNumber'] ?? ($cus['No'] ?? '');
                                            $isSelected = isset($lo_cus) && $lo_cus->customers == $customerNumber;
                                        @endphp
                                        <option value="{{ $customerNumber }}"
                                            data-customer-name="{{ $cus['CustomerName'] ?? ($cus['Name'] ?? 'Unknown') }}"
                                            @if ($isSelected) selected @endif>
                                            {{ $cus['CustomerName'] ?? ($cus['Name'] ?? 'Unknown') }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No customers available</option>
                                @endif
                            </select>
                            <!-- Hidden input for customer name -->
                            <input type="hidden" name="customer_name" id="customer_name"
                                value="{{ $lo_cus->customers_name }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="A" {{ $lo_cus->type == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $lo_cus->type == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ $lo_cus->type == 'D' ? 'selected' : '' }}>C</option>
                            </select>
                        </div>
                    </div>

                    <!-- Rest of your form fields remain the same -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Distance</label>
                            <input type="text" name="distance" class="form-control" placeholder="Km" required
                                value="{{ $lo_cus->distance }}">
                        </div>

                        {{-- <div class="col-md-4 mb-3">
                            <label class="form-label">Amount</label>
                            <input type="text" name="amount" class="form-control " onblur="formatAmount(this)"
                                value="{{ $lo_cus->amount }}" required>
                        </div> --}}
                    </div>
                    <div class="form-group mb-2">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control-sm select2"
                            style="width: 100%; height: 30px;" required>
                            @if ($lo_cus->status == 1)
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                            @else
                                <option selected value="0">Inactive</option>
                                <option value="1">Active</option>
                            @endif
                        </select>
                    </div>
                </div>
                <input type="text" hidden name="id" value="{{ $lo_cus->id }}">
                <!-- Modal Footer -->
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

<!-- Initialize Select2 for Driver Modals -->
<script>
    $(document).ready(function() {
        $('[id^="edit-driver-modal-"]').on('shown.bs.modal', function() {
            $(this).find('.select2').select2({
                dropdownParent: $(this),
                width: '100%'
            });
        });

        $('[id^="edit-driver-modal-"]').on('hidden.bs.modal', function() {
            $(this).find('.select2').select2('destroy');
        });
    });
</script>
