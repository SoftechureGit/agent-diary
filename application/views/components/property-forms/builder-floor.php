<?php
if(is_object($property_details ?? null)):
    extract((array) $property_details ?? []);
elseif(is_array($property_details ?? null)):
    extract($property_details ?? []);
endif;
?>
<!-- Builder Floor Details -->
<section id="builder-floor-property-form" class="theme-form">
<input type="hidden" name="property_details[id]" value="<?= $lead_or_inventory_id ?? '' ?>" class="id">
<input type="hidden" name="property_details[product_id]" value="<?= $product_id ?? 0 ?>" class="product_id">

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="form-heading">Builder Floor Details</h3>
                            <hr>
                        </div>
                    </div>
                    <!-- End Form Name -->

                  <!-- Unit Code -->
                  <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Code  <span class="text-danger">*</span></label>
                            <select name="property_details[unit_code]" id="" class="form-control" data-selected_id="<?= $unit_code ?? 0 ?>" required>
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
                            <label for="">Plot No</label>
                            <input type="text" placeholder="Enter Plot No" name="property_details[plot_number]" value="<?= $plot_number ?? '' ?>" class="form-control" >
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
                        <label for="">Size Unit ( Plot ) </label>
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

                    <!-- Unit Size -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Size</label>
                            <input type="text" placeholder="Enter Unit Size" name="property_details[unit_size]" value="<?= $unit_size ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Size Unit </label>
                        <select class="form-control" id="" name="property_details[unit_size_unit]">
                                <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :
                                
                                $selected         = ( isset($size_unit) &&  $item->unit_id == ( $size_unit ?? '' ) ) ? 'selected' : '';
                                ?>
                             <option value="<?= $item->unit_id ?>"  <?=$selected?> ><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End Unit Size -->

                  <!-- Floor -->
                  <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Floor</label>
                            <!-- <input type="text" placeholder="Enter Floor" name="property_details[floor]" value="<?= $floor ?? '' ?>" class="form-control" > -->
                            <select name="property_details[floor_id]" id="" class="form-control">
                                <option value="" disabled selected>Choose...</option>
                                <?php
                                foreach (getFloors() ?? [] as $floor) :
                                    $selected         = (($floor_id ?? 0) == $floor->id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $floor->id ?>" <?= $selected ?>><?= $floor->name ?? '' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- End Floor -->

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
                                    foreach(getPropertyPlcs($product_id ?? 0) ?? [] as $plc): 
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
                            <select name="property_details[facing_id]" id="" class="form-control" >
                                <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach(facings() ?? [] as $facing_item): 
                                    $selected         = $facing_item->facing_id == ( $facing_id ?? 0 ) ? 'selected' : '';
                                ?>
                                    <option value="<?= $facing_item->facing_id ?>"  <?= $selected ?>><?= $facing_item->title ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <!-- End Facing -->

                    <!-- dimension F x B x S1 x S2 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dimension F x B x S1 x S2</label>
                            <input type="text" placeholder="Enter dimension F x B x S1 x S2" name="property_details[dimension]" value="<?= $dimension ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End dimension F x B x S1 x S2 -->

                    <!-- Terrace -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Terrace</label>
                            <select name="property_details[terrace_id]" id="" class="form-control" >
                                <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach(terraces() ?? [] as $terrace): 
                                    $selected         = $terrace->id == ( $terrace_id ?? 0 ) ? 'selected' : '';
                                ?>
                                    <option value="<?= $terrace->id ?>"  <?= $selected ?>><?= $terrace->name ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <!-- End Terrace -->

                    <!-- Basment -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Basment</label>
                            <select name="property_details[basment_id]" id="" class="form-control" >
                                <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach(basments() ?? [] as $basment): 
                                    $selected         = $basment->id == ( $basment_id ?? 0 ) ? 'selected' : '';
                                ?>
                                    <option value="<?= $basment->id ?>"  <?= $selected ?>><?= $basment->name ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <!-- End Basment -->

                      <!-- Parking -->
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Parking</label>
                            <input type="text" placeholder="Enter parking" name="property_details[parking_count]" class="form-control" value="<?= $parking_count ?? '' ?>">
                        </div>
                    </div>
                    <!-- End Parking -->

                     <!-- Remark -->
                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Remark</label>
                            <textarea type="text" placeholder="Enter remark" name="property_details[remark]" class="form-control"><?= $remark ?? '' ?></textarea>
                        </div>
                    </div>
                    <!-- End Remark -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Builder Floor Details -->