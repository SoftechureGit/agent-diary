<?php extract($property_details?? []); ?>
<!-- Builder Floor Details -->
<section id="builder-floor-property-form" class="theme-form">
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-center">
                            <h3 class="form-heading">Builder Floor Details</h3>
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

                    <!-- Plot No -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Plot No</label>
                            <input type="text" placeholder="Enter Plot No" name="property_details[plot_no]" value="<?= $plot_no ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Plot No -->

                    <!-- Plot Size (Sqyd) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Plot Size (Sqyd)</label>
                            <input type="text" placeholder="Enter Plot Size (Sqyd)" name="property_details[plot_size]" value="<?= $plot_size ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Plot Size (Sqyd) -->

                    <!-- Unit Size (Sq.ft) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Unit Size (Sq.ft)</label>
                            <input type="text" placeholder="Enter Unit Size (Sq.ft)" name="property_details[unit_size]" value="<?= $unit_size ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Unit Size (Sq.ft) -->

                    <!-- Floor -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Floor</label>
                            <input type="text" placeholder="Enter Floor" name="property_details[floor]" value="<?= $floor ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Floor -->

                    <!-- Block -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Block</label>
                            <input type="text" placeholder="Enter Block" name="property_details[block]" value="<?= $block ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Block -->

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

                    <!-- Dimantion F x B x S1 x S2 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Dimantion F x B x S1 x S2</label>
                            <input type="text" placeholder="Enter Dimantion F x B x S1 x S2" name="property_details[dimantion]" value=<?= $dimantion ?? '' ?>"" class="form-control">
                        </div>
                    </div>
                    <!-- End Dimantion F x B x S1 x S2 -->

                    <!-- Tarrace -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tarrace</label>
                            <input type="text" placeholder="Enter Tarrace" name="property_details[tarrace]" value="<?= $tarrace ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Tarrace -->

                    <!-- Basment -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Basment</label>
                            <input type="text" placeholder="Enter Basment" name="property_details[basment]" value="<?= $basment ?? '' ?>" class="form-control">
                        </div>
                    </div>
                    <!-- End Basment -->

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
<!-- End Builder Floor Details -->