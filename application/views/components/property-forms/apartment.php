<?php extract($data->property_details ?? []); ?>
<!-- Apartment Details -->
<section id="apartment-property-form" class="theme-form">
    <input type="hidden" name="property_details[id]" value="<?= $lead_or_inventory_id ?? '' ?>" class="id">
    <input type="hidden" name="property_details[product_id]" value="<?= $product_id ?? 0 ?>" class="product_id">

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
                            <label for="">Unit Code  <span class="text-danger">*</span></label>
                            <!--  -->
                            <?php
                                if(( $unit_code_name ?? '' ) == ''):
                            ?>
                            <!--  -->
                            <select name="property_details[unit_code]" id="property-unit-code" class="form-control" data-selected_id="<?= $unit_code ?? 0 ?>" required>
                                <option value="" disabled selected>Choose...</option>
                                <?php
                                foreach ($unit_code_with_accomodations ?? [] as $unit_code_with_accomodation) :
                                     $selected         = (($unit_code ?? 0) == $unit_code_with_accomodation->id) ? 'selected' : '';
                                ?>
                                    <option 
                                        value                       =   "<?= $unit_code_with_accomodation->id ?>" 
                                        data-accomodation-id        =   "<?= $unit_code_with_accomodation->accomodation_id ?? 0 ;?>"
                                        data-accomodation-name      =   "<?= $unit_code_with_accomodation->accomodation_name ?? '' ;?>"
                                        <?= $selected ?> 
                                        >
                                    <?= $unit_code_with_accomodation->unit_code_with_accomodation_name ?? $unit_code_with_accomodation->inventory_unit_code ?? '' ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--  -->
                            <?php endif; ?>
                            <!--  -->
                            <input type="hidden" name="property_details[accomodation_id]" value="<?= $accomodation_id ?? 0 ;?>">
                            <!-- <label id="property_details[unit_code]-error" class="error" for="property_details[unit_code]"></label> -->

                            <!-- Unit Code Name -->
                            <input type="text" class="form-control<?= ( $unit_code_name ?? '' ) != '' ? '' : 'd-none' ?>" name="property_details[unit_code_name]" value="<?= $unit_code_name ?? '' ?>" placeholder="Enter unit code" id="unit_code_name">
                            <!-- End Unit Code Name -->
                        </div>
                    </div>
                    <!-- End Unit Code -->

                    <!-- Referance No -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Referance Number</label>
                            <input type="text" placeholder="Enter Referance Number" name="property_details[referance_number]" value="<?= $referance_number ?? '' ?>" class="form-control" data-saved-value="<?= $referance_number ?? '' ?>">
                        </div>
                    </div>
                    <!-- End Referance No -->

                    <!-- Unit No -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit No</label>
                            <input type="text" placeholder="Enter Unit No" name="property_details[unit_no]" value="<?= $unit_no ?? '' ?>" class="form-control" data-saved-value="<?= $unit_no ?? '' ?>">
                        </div>
                    </div>
                    <!-- End Unit No -->

                    <!-- Floor -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Floor</label>
                            <select name="property_details[floor_id]" id="" class="form-control" data-saved-value="<?= $floor_id ?? 0 ?>">
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

                    <!-- Block Or Floor -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tower</label>
                            <select name="property_details[block_or_tower_id]" id="" class="form-control" data-saved-value="<?= $block_or_tower_id ?? 0 ?? '' ?>">
                                <option value="" disabled selected>Choose...</option>
                                <?php
                                foreach (getBlocksOrTowers() ?? [] as $block_or_tower) :
                                    $selected         = (($block_or_tower_id ?? 0) == $block_or_tower->id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $block_or_tower->id ?>" <?= $selected ?>><?= $block_or_tower->name ?? '' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- End Block Or Floor -->

                    <!-- Unit Type -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Type</label>
                            <input type="text" placeholder="Enter Unit Type" name="property_details[unit_type]" value="<?= $unit_type ?? '' ?>" class="form-control" data-saved-value="<?= $unit_type ?? '' ?>">
                        </div>
                    </div>
                    <!-- End Unit Type -->

                    <!-- SA -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">SA Size</label>
                            <input type="text" placeholder="Enter SA Size" name="property_details[sa]" value="<?= $sa ?? '' ?>" class="form-control" data-saved-value="<?= $sa ?? '' ?>">
                        </div>
                    </div>
                    <!-- End SA -->

                    <!-- SA Size  -->
                    <div class="col-md-2">
                        <label for="">SA Unit </label>
                        <select class="form-control" id="" name="property_details[sa_size_unit]" data-saved-value="<?= $sa_size_unit ?? '' ?>">
                            <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :

                                $selected         = ($item->unit_id == ($sa_size_unit ?? '')) ? 'selected' : '';
                            ?>
                                <option value="<?= $item->unit_id ?>" <?= $selected ?>><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End SA Size -->

                    <!-- BA -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">BA Size</label>
                            <input type="text" placeholder="Enter BA Size" name="property_details[ba]" value="<?= $ba ?? '' ?>" class="form-control" data-saved-value="<?= $ba ?? '' ?>">
                        </div>
                    </div>
                    <!-- End BA -->

                    <!-- BA Size  -->
                    <div class="col-md-2">
                        <label for="">BA Unit </label>
                        <select class="form-control" id="" name="property_details[ba_size_unit]" data-saved-value="<?= $ba_size_unit ?? '' ?>">
                            <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :

                                $selected         = ($item->unit_id == ($ba_size_unit ?? '')) ? 'selected' : '';
                            ?>
                                <option value="<?= $item->unit_id ?>" <?= $selected ?>><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End BA Size -->


                    <!-- CA -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">CA Size</label>
                            <input type="text" placeholder="Enter CA Size" name="property_details[ca]" value="<?= $ca ?? '' ?>" class="form-control" data-saved-value="<?= $ca ?? '' ?>">
                        </div>
                    </div>
                    <!-- End CA -->

                    <!-- CA Size  -->
                    <div class="col-md-2">
                        <label for="">CA Unit </label>
                        <select class="form-control" id="" name="property_details[ca_size_unit]" data-saved-value="<?= $ca_size_unit ?? '' ?>">
                            <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :

                                $selected         = ($item->unit_id == ($ca_size_unit ?? '')) ? 'selected' : '';
                            ?>
                                <option value="<?= $item->unit_id ?>" <?= $selected ?>><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End CA Size -->

                    <!-- Applicable PLC -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Applicable PLC</label>
                            <select name="property_details[applicable_plc][]" id="" class="form-control" multiple data-saved-value="[<?= implode(',',  $applicable_plc ?? []) ?>]">
                                <?php
                                foreach (getPropertyPlcs($product_id ?? 0) ?? [] as $plc) :
                                    $selected         = in_array($plc->price_component_id, $applicable_plc ?? []) ? 'selected' : '';
                                ?>
                                    <option value=<?= $plc->price_component_id ?> <?= $selected ?>><?= $plc->price_component_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- End Applicable PLC -->

                    <!-- Facing -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Facing</label>
                            <select name="property_details[facing_id]" id="" class="form-control" data-saved-value="<?= $facing_id ?? '' ?>">
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

                    <!-- Parking -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Parking</label>
                            <select name="property_details[parking][]" id="" class="form-select" multiple data-saved-value="[<?= implode(',',  $parking ?? []) ?>]">

                                <?php 
                                foreach(parkings($product_id ?? 0) as $parking_item): ?>
                                    <option value="<?= $parking_item->value ?>" <?= in_array($parking_item->value, $parking ?? []) ? 'selected' : '' ?>><?= $parking_item->label ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <!-- End Parking -->

                    <!-- Remark -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Remark</label>
                            <textarea type="text" placeholder="Enter remark" name="property_details[remark]" class="form-control" data-saved-value="<?= $remark ?? '' ?>"><?= $remark ?? '' ?></textarea>
                        </div>
                    </div>
                    <!-- End Remark -->

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Apartment Details -->