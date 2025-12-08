<!-- Add Vehicle Modal -->
<div class="modal fade" id="add-pay-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width:1400px;">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Payment Conditons</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('Masterfile.addvehicle') }}" method="post">
                {{ csrf_field() }}

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Payment Condition For Drivers <span
                                    class="text-danger">*</span></label>
                            <table border="1" cellspacing="0" cellpadding="5"
                                style="width:100%; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th>Col 1</th>
                                        <th>Col 2</th>
                                        <th>Col 3</th>
                                        <th>Col 4</th>
                                        <th>Col 5</th>
                                        <th>Col 6</th>
                                        <th>Col 7</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr>
                                        <td><input type="text" name="row1_col1" class="form-control" /></td>
                                        <td><input type="text" name="row1_col2" class="form-control" /></td>
                                        <td><input type="text" name="row1_col3" class="form-control" /></td>
                                        <td><input type="text" name="row1_col4" class="form-control" /></td>
                                        <td><input type="text" name="row1_col5" class="form-control" /></td>
                                        <td><input type="text" name="row1_col6" class="form-control" /></td>
                                        <td><input type="text" name="row1_col7" class="form-control" /></td>
                                    </tr>

                                    <!-- Row 2 -->
                                    <tr>
                                        <td><input type="text" name="row2_col1" class="form-control" /></td>
                                        <td><input type="text" name="row2_col2" class="form-control" /></td>
                                        <td><input type="text" name="row2_col3" class="form-control" /></td>
                                        <td><input type="text" name="row2_col4" class="form-control" /></td>
                                        <td><input type="text" name="row2_col5" class="form-control" /></td>
                                        <td><input type="text" name="row2_col6" class="form-control" /></td>
                                        <td><input type="text" name="row2_col7" class="form-control" /></td>
                                    </tr>

                                    <!-- Row 3 -->
                                    <tr>
                                        <td><input type="text" name="row3_col1" class="form-control" /></td>
                                        <td><input type="text" name="row3_col2" class="form-control" /></td>
                                        <td><input type="text" name="row3_col3" class="form-control" /></td>
                                        <td><input type="text" name="row3_col4" class="form-control" /></td>
                                        <td><input type="text" name="row3_col5" class="form-control" /></td>
                                        <td><input type="text" name="row3_col6" class="form-control" /></td>
                                        <td><input type="text" name="row3_col7" class="form-control" /></td>
                                    </tr>

                                    <!-- Row 4 -->
                                    <tr>
                                        <td><input type="text" name="row4_col1" class="form-control" /></td>
                                        <td><input type="text" name="row4_col2" class="form-control" /></td>
                                        <td><input type="text" name="row4_col3" class="form-control" /></td>
                                        <td><input type="text" name="row4_col4" class="form-control" /></td>
                                        <td><input type="text" name="row4_col5" class="form-control" /></td>
                                        <td><input type="text" name="row4_col6" class="form-control" /></td>
                                        <td><input type="text" name="row4_col7" class="form-control" /></td>
                                    </tr>

                                    <!-- Row 5 -->
                                    <tr>
                                        <td><input type="text" name="row5_col1" class="form-control" /></td>
                                        <td><input type="text" name="row5_col2" class="form-control" /></td>
                                        <td><input type="text" name="row5_col3" class="form-control" /></td>
                                        <td><input type="text" name="row5_col4" class="form-control" /></td>
                                        <td><input type="text" name="row5_col5" class="form-control" /></td>
                                        <td><input type="text" name="row5_col6" class="form-control" /></td>
                                        <td><input type="text" name="row5_col7" class="form-control" /></td>
                                    </tr>
                                </tbody>
                            </table>

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
