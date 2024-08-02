<?php
if(is_object($property_details ?? null)):
    extract((array) $property_details ?? []);
elseif(is_array($property_details ?? null)):
    extract($property_details ?? []);
endif;
?>
<!-- Plot Details -->
<section id="plot-property-form" class="theme-form">
<input type="hidden" name="property_details[id]" value="<?= $lead_or_inventory_id ?? '' ?>" class="id">
<input type="hidden" name="property_details[product_id]" value="<?= $product_id ?? 0 ?>" class="product_id">

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="form-heading">Plot Details</h3>
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

                    <!-- Plot No -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Plot Number</label>
                            <input type="text" placeholder="Enter Plot Number" name="property_details[plot_number]" value="<?= $plot_number ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Plot No -->

                    <!-- Plot Size  -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Plot Size </label>
                            <input type="text" placeholder="Enter Plot Size " name="property_details[plot_size]" value="<?= $plot_size ?? '' ?>" class="form-control" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="">Size Unit </label>
                        <select class="form-control" id="" name="property_details[size_unit]">
                                <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :
                                
                                $selected         = ( isset($size_unit) &&  $item->unit_id == ( $size_unit ?? '' ) ) ? 'selected' : '';
                                ?>
                             <option value="<?= $item->unit_id ?>"  <?=$selected?> ><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End Plot Size -->

                    <!-- Block -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Block</label>
                            <input type="text" placeholder="Enter Block" name="property_details[block]" value="<?= $block ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Block -->

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

                    <!-- dimension F x B x S1 x S2 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">dimension F x B x S1 x S2</label>
                            <input type="text" placeholder="Enter dimension F x B x S1 x S2" name="property_details[dimension]" value="<?= $dimension ?? $dimension ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End dimension F x B x S1 x S2 -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Plot Details -->


