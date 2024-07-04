<?php extract($property_details?? []); ?>
<!-- Office Details -->
<section id="office-property-form" class="theme-form">
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="form-heading">Office Details</h3>
                            <hr>
                        </div>
                    </div>
                    <!-- End Form Name -->

                    <!-- Unit Code -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Code <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Unit Code" name="property_details[unit_code]" value="<?= $unit_code ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Unit Code -->

                    <!-- Referance No -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Referance Number <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Referance Number" name="property_details[referance_number]" value="<?= $referance_number ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Referance No -->

                    <!-- Unit Number -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Number <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Unit Number" name="property_details[unit_number]" value="<?= $unit_number ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Unit Number -->

                    <!-- Floor -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Floor <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Floor" name="property_details[floor]" value="<?= $floor ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Floor -->

                    <!-- Tower -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tower <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Tower" name="property_details[tower]" value="<?= $tower ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Tower -->

                    <!-- Unit Type -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Type <span class="text-danger">*</span></label>
                            <select name="unit_type" class="form-control" name="property_details[unit_type]" required>
                                <option value="" selected disabled>Choose...</option>
                                <option value="locable" <?= ($tower ?? '' == 'locable') ? 'selected' : '' ?>>Locable</option>
                                <option value="virtual" <?= ($tower ?? '' == 'virtual') ? 'selected' : '' ?>>Virtual</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Unit Type -->

                    <!-- Area (Sqft) -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Area (Sqft) <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Area (Sqft)" name="property_details[area]" value="<?= $area ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Area (Sqft) -->

                    <!-- Applicable PLC -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Applicable PLC <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Applicable PLC" name="property_details[applicable_plc]" value="<?= $applicable_plc ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Applicable PLC -->

                     <!-- Facing -->
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Facing <span class="text-danger">*</span></label>
                            <select name="property_details[facing]" id="" class="form-control" required>
                            <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach(facings() ?? [] as $facing_item): 
                                    $selected         = $facing_item->facing_id == (( $facing ?? 0 ) ? str_before('|', $facing ) : '') ? 'selected' : '';
                                ?>
                                    <option <?=  ( $facing ?? 0 ) ? str_before('|', $facing ) : '' ?> value="<?= "$facing_item->facing_id | $facing_item->title" ?>"  <?= $selected ?>><?= $facing_item->title ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <!-- End Facing -->

                    <!-- Parking -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Parking <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Parking" name="property_details[parking]" value="<?= $parking ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Parking -->

                    <!-- Pentry -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Pentry <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Pentry" name="property_details[pentry]" value="<?= $pentry ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Pentry -->

                    <!-- Washroom -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Washroom <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Washroom" name="property_details[washroom]" value="<?= $washroom ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Washroom -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Office Details -->