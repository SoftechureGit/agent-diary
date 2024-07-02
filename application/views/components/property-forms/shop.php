<?php
extract($property_details?? []);
?>
<!-- Shop Details -->
<section id="shop-property-form" class="theme-form">
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-center">
                            <h3 class="form-heading">Shop Details</h3>
                            <hr>
                        </div>
                    </div>
                    <!-- End Form Name -->

                    <!-- Unit Code -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Unit Code</label>
                            <input type="text" placeholder="Enter Unit Code" name="property_details[unit_code]" value="<?= $unit_code ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Unit Code -->

                    <!-- Referance No -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Referance Number</label>
                            <input type="text" placeholder="Enter Referance Number" name="property_details[referance_number]" value="<?= $referance_number ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Referance No -->

                    <!-- Unit Number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Unit Number</label>
                            <input type="text" placeholder="Enter Unit Number" name="property_details[unit_number]" value="<?= $unit_number ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Unit Number -->

                    <!-- Floor -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Floor</label>
                            <input type="text" placeholder="Enter Floor" name="property_details[floor]" value="<?= $floor ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Floor -->

                    <!-- Tower -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tower</label>
                            <input type="text" placeholder="Enter Tower" name="property_details[tower]" value="<?= $tower ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Tower -->

                    <!-- Unit Type -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Unit Type</label>
                            <select  class="form-control" name="property_details[tower]">
                                <option value="" selected disabled>Choose...</option>
                                <option value="locable" <?= ($tower ?? '' == 'locable') ? 'selected' : '' ?>>Locable</option>
                                <option value="virtual" <?= ($tower ?? '' == 'virtual') ? 'selected' : '' ?>>Virtual</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Unit Type -->

                    <!-- Area (Sqft) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Area (Sqft)</label>
                            <input type="text" placeholder="Enter Area (Sqft)" name="property_details[area]" value="<?= $area ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Area (Sqft) -->

                    <!-- Applicable PLC -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Applicable PLC</label>
                            <input type="text" placeholder="Enter Applicable PLC" name="property_details[applicable_plc]" value="<?= $applicable_plc ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Applicable PLC -->

                    <!-- Facing -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Facing</label>
                            <input type="text" placeholder="Enter Facing" name="property_details[facing]" value="<?= $facing ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Facing -->

                    <!-- Parking -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Parking</label>
                            <input type="text" placeholder="Enter Parking" name="property_details[parking]" value="<?= $parking ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Parking -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Details -->
