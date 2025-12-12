<!-- Add Vehicle Modal -->
<div class="modal fade" id="add-vehicle-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width:600px;">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('Masterfile.addvehicle') }}" method="post">
                {{ csrf_field() }}

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vehicle No <span class="text-danger">*</span></label>
                            <input type="text" name="vehicle_no" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="">Select</option>
                                <option>Car</option>
                                <option>Van</option>
                                <option>Bus</option>
                                <option>Lorry</option>
                                <option>Bike</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Model</label>
                            <input type="text" name="model" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Color</label>
                            <input type="text" name="color" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Max weight</label>
                            <input type="text" name="max_weight" class="form-control" placeholder="MT">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fuel Type <span class="text-danger">*</span></label>
                            <select name="fuel_type" class="form-control" required>
                                <option>Petrol</option>
                                <option>Diesel</option>
                                <option>Hybrid</option>
                                <option>Electric</option>
                            </select>
                        </div>



                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Maintenance</option>
                            </select>
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
