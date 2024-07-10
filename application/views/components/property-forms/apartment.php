<?php extract($property_details?? []); ?>
<!-- Apartment Details -->
<section id="apartment-property-form" class="theme-form">
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="form-heading">Apartment Details</h3>
                            <hr>
                        </div>
                    </div>
                    <!-- End Form Name -->
                     
                    <!-- Unit Code -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Code</label>
                            <input type="text" placeholder="Enter Unit Code" name="property_details[unit_code]" value="<?= $unit_code ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Unit Code -->

                    <!-- Referance No -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Referance Number</label>
                            <input type="text" placeholder="Enter Referance Number" name="property_details[referance_number]" value="<?= $referance_number ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Referance No -->

                    <!-- Unit No -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit No</label>
                            <input type="text" placeholder="Enter Unit No" name="property_details[unit_no]" value="<?= $unit_no ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Unit No -->

                    <!-- Floor -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Floor</label>
                            <input type="text" placeholder="Enter Floor" name="property_details[floor]" value="<?= $floor ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Floor -->

                    <!-- Tower -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tower</label>
                            <input type="text" placeholder="Enter Tower" name="property_details[tower]" value="<?= $tower ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Tower -->

                    <!-- Unit Type -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Type</label>
                            <input type="text" placeholder="Enter Unit Type" name="property_details[unit_type]" value="<?= $unit_type ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Unit Type -->

                    <!-- SA -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">SA</label>
                            <input type="text" placeholder="Enter SA" name="property_details[sa]" value="<?= $sa ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End SA -->

                    <!-- BA -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">BA</label>
                            <input type="text" placeholder="Enter BA" name="property_details[ba]" value="<?= $ba ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End SA -->

                    <!-- CA -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">CA</label>
                            <input type="text" placeholder="Enter CA" name="property_details[ca]" value="<?= $ca ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End CA -->

                    <!-- Applicable PLC -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Applicable PLC</label>
                            <input type="text" placeholder="Enter Applicable PLC" name="property_details[applicable_plc]" value="<?= $applicable_plc ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Applicable PLC -->

                     <!-- Facing -->
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Facing</label>
                            <select name="property_details[facing]" id="" class="form-control" >
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
                            <label for="">Parking</label>
                            <input type="text" placeholder="Enter Parking" name="property_details[parking]" value="<?= $parking ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Parking -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Apartment Details -->