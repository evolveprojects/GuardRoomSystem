<!-- Add Customer Modal -->
<!-- Add Customer Modal -->
<div class="modal fade" id="add-customer-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('Masterfile.addcustomers') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                            <select name="customer_number" class="form-control select2" id="customers" required onchange="updateCustomerName()">
                                <option value="">Select Customer</option>
                                @if (!empty($customers) && isset($customers['value']) && is_array($customers['value']))
                                    @foreach ($customers['value'] as $cus)
                                        <option value="{{ $cus['CustomerNumber'] ?? ($cus['No'] ?? '') }}"
                                            data-customer-name="{{ $cus['CustomerName'] ?? ($cus['Name'] ?? 'Unknown') }}">
                                            {{ $cus['CustomerName'] ?? ($cus['Name'] ?? 'Unknown') }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No customers available</option>
                                @endif
                            </select>
                            <!-- Hidden input for customer name -->
                            <input type="hidden" name="customer_name" id="customer_name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                    </div>

                    <!-- Rest of your form fields remain the same -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Distance</label>
                            <input type="text" name="distance" class="form-control" placeholder="Km" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Amount</label>
                            <input type="text" name="amount" class="form-control " onblur="formatAmount(this)"
                                required>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save
                    </button>
                    <button type="reset" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 when modal is shown
        $('#add-customer-modal').on('shown.bs.modal', function() {
            $('#customers').select2({
                dropdownParent: $('#add-customer-modal'),
                placeholder: "Select Customer",
                allowClear: true,
                width: '100%'
            });
        });

        // When customer is selected, update the hidden input with customer name


        // Destroy Select2 when modal is hidden to avoid conflicts
        $('#add-customer-modal').on('hidden.bs.modal', function() {
            if ($('#customers').hasClass('select2-hidden-accessible')) {
                $('#customers').select2('destroy');
            }
            // Reset form
            $(this).find('form')[0].reset();
            // Clear the hidden input
            $('#customer_name').val('');
        });

        // Also reset on form reset button click
        $('#add-customer-modal form').on('reset', function() {
            $('#customer_name').val('');
        });
    });
</script>
<script>

    function updateCustomerName() {
        var selected = $('#customers option:selected');
        var customerName = selected.data('customer-name');
        $('#customer_name').val(customerName);
    }
</script>
