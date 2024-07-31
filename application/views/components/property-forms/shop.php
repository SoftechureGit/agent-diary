<?php
extract($property_details?? []);
?>
<!-- Shop Details -->
<section id="shop-property-form" class="theme-form">
<input type="hidden" name="property_details[id]" value="<?= $id ?? 0 ?>" class="id">
<input type="hidden" name="property_details[product_id]" value="<?= $product_id ?? 0 ?>" class="product_id">

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="form-heading">Shop Details</h3>
                            <hr>
                        </div>
                    </div>
                    <!-- End Form Name -->

                  <!-- Unit Code -->
                  <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Code ( with Accomodations ) <span class="text-danger">*</span></label>
                            <select name="property_details[unit_code]" id="" class="form-control" required>
                                <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach($unit_code_with_accomodations ?? [] as $unit_code_with_accomodation): 
                                    $selected         = (($unit_code ?? 0 ) == $unit_code_with_accomodation->id ) ? 'selected' : '';
                                ?>
                                    <option value="<?= $unit_code_with_accomodation->id ?>"   <?= $selected ?>><?= $unit_code_with_accomodation->unit_code_with_accomodation_name ?? $unit_code_with_accomodation->inventory_unit_code ?? '' ?></option>   
                                    <?php endforeach; ?>
                                </select>
                                <!-- <label id="property_details[unit_code]-error" class="error" for="property_details[unit_code]"></label> -->
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

                    <!-- Unit Number -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Number</label>
                            <input type="text" placeholder="Enter Unit Number" name="property_details[unit_number]" value="<?= $unit_number ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Unit Number -->

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
                            <select  class="form-control" name="property_details[unit_type]" >
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
                            <label for="">Area</label>
                            <input type="text" placeholder="Enter Area (Sqft)" name="property_details[area]" value="<?= $area ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Area (Sqft) -->

                    
                    <div class="col-md-4">
                        <label for="">Size Unit </label>
                        <select class="form-control" id="" name="property_details[size_unit]">
                                <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :
                                
                                $selected         = ( isset($size_unit) &&  $item->unit_id == size_unit ) ? 'selected' : '';
                                ?>
                             <option value="<?= $item->unit_id ?>"  <?=$selected?> ><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Applicable PLC -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Applicable PLC</label>
                            <select name="property_details[applicable_plc][]" id="" class="form-control" multiple>
                                <?php 
                                    foreach(getPropertyApplicablePlcs($product_id ?? 0) ?? [] as $plc): 
                                    $selected         = in_array($plc->price_component_id, $applicable_plc ?? []) ? 'selected' : '';
                                ?>
                                    <option value=<?= $plc->price_component_id ?>  <?= $selected ?>><?= $plc->price_component_name ?></option>   
                                    <?php endforeach; ?>
                                </select>
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
                            <select name="property_details[parking][]" id="" class="form-select" multiple>
                                <?php if ($parking_open ?? 0) : ?>
                                    <option value="open" <?= in_array('open', $parking ?? []) ? 'selected' : '' ?>>Open</option>
                                <?php endif; ?>
                                <?php if ($parking_stilt ?? 0) : ?>
                                    <option value="stilt" <?= in_array('stilt', $parking ?? []) == 'stilt' ? 'selected' : '' ?>>Stilt</option>
                                <?php endif; ?>
                                <?php if ($parking_basment ?? 0) : ?>
                                    <option value="basement" <?= in_array('basement', $parking ?? []) == 'basement' ? 'selected' : '' ?>>Basement</option>
                                <?php endif; ?>

                            </select>
                        </div>
                    </div>
                    <!-- End Parking -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Details -->
