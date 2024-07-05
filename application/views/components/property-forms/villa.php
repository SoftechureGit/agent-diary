<?php extract($property_details?? []); ?>
<!-- Villa Details -->
<section id="villa-property-form" class="theme-form">
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="form-heading">Villa Details</h3>
                            <hr>
                        </div>
                    </div>
                    <!-- End Form Name -->

                    <!-- Unit Code -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Code  <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Unit Code" name="property_details[unit_code]" value="<?= $unit_code ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Unit Code -->

                    <!-- Referance Number -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Referance Number <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Referance Number" name="property_details[referance_number]" value="<?= $referance_number ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Referance Number -->

                    <!-- Plot Number -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Plot Number <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Plot Number" name="property_details[plot_number]" value="<?= $plot_number ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Plot Number -->

                    <!-- Plot Size (Sqyd) -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Plot Size (Sqyd) <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Plot Size (Sqyd)" name="unit_detials[plot_size]" value="<?= $plot_size ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Plot Size (Sqyd) -->

                    <!-- Unit Size (Sq.ft) -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Size (Sq.ft) <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Unit Size (Sq.ft)" name="property_details[unit_size]" value="<?= $unit_size ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Unit Size (Sq.ft) -->

                    <!-- Number of Floor -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Number of Floor <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Floor" name="property_details[number_of_floor]" value="<?= $number_of_floor ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Number of Floor -->

                    <!-- Block -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Block <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Block" name="property_details[block]" value="<?= $block ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Block -->

                 
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
                                    $selected         = $facing_item->facing_id == (($facing ?? 0 ) ? str_before('|', $facing ) : '') ? 'selected' : '';
                                ?>
                                    <option <?=  ( $facing ?? 0 ) ? str_before('|', $facing ) : '' ?> value="<?= "$facing_item->facing_id | $facing_item->title" ?>"  <?= $selected ?>><?= $facing_item->title ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <!-- End Facing -->

                    <!-- Dimantion F x B x S1 x S2 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dimantion F x B x S1 x S2 <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Dimantion F x B x S1 x S2" name="property_details[dimantion]" value="<?= $dimantion ?? '' ?>" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Dimantion F x B x S1 x S2 -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Villa Details -->