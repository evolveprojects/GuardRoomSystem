<!-- Edit Vehicle Button -->
<button type="button" class="btn btn-success btn-sm text-white w-100"
        data-bs-toggle="modal"
        data-bs-target="{{ '#edit-vehicle-modal-' . $vehicle->id }}">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</button>

<!-- Edit Vehicle Modal -->
<div class="modal fade" id="{{ 'edit-vehicle-modal-' . $vehicle->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('Masterfile.updatevehicle') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $vehicle->id }}">

                <div class="modal-body">

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Vehicle No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="vehicle_no"
                                   value="{{ $vehicle->vehicle_no }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control select2" required>
                                <option value="">Select Type</option>
                                <option value="Car" {{ $vehicle->type=='Car' ? 'selected' : '' }}>Car</option>
                                <option value="Van" {{ $vehicle->type=='Van' ? 'selected' : '' }}>Van</option>
                                <option value="Bus" {{ $vehicle->type=='Bus' ? 'selected' : '' }}>Bus</option>
                                <option value="Lorry" {{ $vehicle->type=='Lorry' ? 'selected' : '' }}>Lorry</option>
                                <option value="Bike" {{ $vehicle->type=='Bike' ? 'selected' : '' }}>Bike</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <input type="text" class="form-control" name="brand"
                                   value="{{ $vehicle->brand }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Model</label>
                            <input type="text" class="form-control" name="model"
                                   value="{{ $vehicle->model }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" name="color"
                                   value="{{ $vehicle->color }}">
                        </div>
                         <div class="col-md-4 mb-3">
                            <label class="form-label">Max weight</label>
                            <input type="text" name="max_weight" class="form-control" placeholder="MT" value="{{ $vehicle->max_weight}}">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Fuel Type <span class="text-danger">*</span></label>
                            <select name="fuel_type" class="form-control select2" required>
                                <option value="Petrol" {{ $vehicle->fuel_type=='Petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="Diesel" {{ $vehicle->fuel_type=='Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Hybrid" {{ $vehicle->fuel_type=='Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="Electric" {{ $vehicle->fuel_type=='Electric' ? 'selected' : '' }}>Electric</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control select2" required>
                                <option value="Active" {{ $vehicle->status=='Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $vehicle->status=='Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Maintenance" {{ $vehicle->status=='Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>
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

<!-- jQuery & Select2 -->
<script>
$(document).ready(function() {
    // Initialize Select2 for each modal when shown
    $('[id^="edit-vehicle-modal-"]').on('shown.bs.modal', function() {
        $(this).find('.select2').select2({
            dropdownParent: $(this),
            width: '100%'
        });
    });

    // Destroy Select2 when modal is hidden
    $('[id^="edit-vehicle-modal-"]').on('hidden.bs.modal', function() {
        $(this).find('.select2').select2('destroy');
    });
});
</script>
