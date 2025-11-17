<div class="modal fade" id="add-center-modal" tabindex="-1" aria-labelledby="addCenterLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCenterLabel">Add New Center</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
     
       
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="centerID" class="form-label">Center ID<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="centerID" name="id" required>
                    </div>
                    <div class="mb-3">
                        <label for="centerName" class="form-label">Center Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="centerName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="centerStatus" class="form-label">Status<span class="text-danger">*</span></label>
                        <select class="form-select" id="centerStatus" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Center</button>
                </div>
   
        </div>
    </div>
</div>
