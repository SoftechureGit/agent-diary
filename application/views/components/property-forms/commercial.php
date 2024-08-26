<?php extract($data->property_details ?? []); ?>
<!-- Shop Details -->
<section id="shop-property-form" class="theme-form">
<input type="hidden" name="property_details[id]" value="<?= $lead_or_inventory_id ?? '' ?>" class="id">
<input type="hidden" name="property_details[product_id]" value="<?= $product_id ?? 0 ?>" class="product_id">

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <!-- Form Name -->
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="form-heading"><span class="commercial-property-type"></span> Details</h3>
                            <hr>
                        </div>
                    </div>
                    <!-- End Form Name -->

                  <!-- Unit Code -->
                  <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Code  <span class="text-danger">*</span></label>
                            <?php
                                if(( $unit_code_name ?? '' ) == ''):
                            ?>
                            <select name="property_details[unit_code]" id="" class="form-control" data-selected_id="<?= $unit_code ?? 0 ?>" required>
                                <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach($unit_code_with_accomodations ?? [] as $unit_code_with_accomodation): 
                                    $selected         = (($unit_code ?? 0 ) == $unit_code_with_accomodation->id ) ? 'selected' : '';
                                ?>
                                    <option value="<?= $unit_code_with_accomodation->id ?>"   <?= $selected ?> data-property-type-name="<?= $unit_code_with_accomodation->property_type_name ?? ''; ?>"><?= $unit_code_with_accomodation->unit_code_with_accomodation_name ?? $unit_code_with_accomodation->inventory_unit_code ?? '' ?></option>   
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                            
                                <input type="hidden" value="<?= $property_type_name ?? '' ?>" name="property_details[property_type_name]" id="property_type_name">
                                <!-- <label id="property_details[unit_code]-error" class="error" for="property_details[unit_code]"></label> -->

                                <!-- Unit Code Name -->
                             <input type="text" class="form-control <?= ( $unit_code_name ?? '' ) != '' ? '' : 'd-none' ?>" name="property_details[unit_code_name]" value="<?= $unit_code_name ?? '' ?>" placeholder="Enter unit code" id="unit_code_name">
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

                    <!-- Unit Number -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Number</label>
                            <!-- <input type="text" placeholder="Enter Unit Number" name="property_details[unit_number]" value="<?= $unit_number ?? '' ?>" class="form-control" data-saved-value="<?= $unit_number ?? '' ?>"> -->

                            <?php 
                            if (($form_request_for ?? '') == 'unit-inventory'): ?>
                                <select class="form-control" id="" name="property_details[unit_no]" data-saved-value="<?= $unit_no ?? '' ?>">
                                    <option value="">Choose...</option>
                                </select>
                            <?php else: ?>
                                <input type="text" placeholder="Enter Unit No" name="property_details[unit_no]" value="<?= $unit_no ?? '' ?>" class="form-control" data-saved-value="<?= $unit_no ?? '' ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- End Unit Number -->

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
                            <select name="property_details[block_or_tower_id]" id="" class="form-control" data-saved-value="<?= $block_or_tower_id ?? '' ?>">
                                <option value="" disabled selected>Choose...</option>
                                <?php
                                foreach (getBlocksOrTowers(0, $property_details->project_type_id, $property_details->property_type_id, $property_details->id) ?? [] as $block_or_tower) :
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
                            <select  class="form-control" name="property_details[unit_type]" data-saved-value="<?= $unit_type ?? '' ?>">
                                <option value="" selected disabled>Choose...</option>
                                <option value="locable" <?= ( ( $unit_type ?? '' ) == 'locable') ? 'selected' : '' ?>>Locable</option>
                                <option value="virtual" <?= ( ( $unit_type ?? '' ) == 'virtual') ? 'selected' : '' ?>>Virtual</option>
                            </select>
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
                            <select name="property_details[applicable_plc][]" id="" class="form-control" multiple  data-saved-value="[<?= implode(',',  $applicable_plc ?? []) ?>]">
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
                            <input type="text" placeholder="Enter parking" name="property_details[parking_count]" class="form-control" value="<?= $parking_count ?? '' ?>" data-saved-value="<?= $parking_count ?? '' ?>">
                        </div>
                    </div>
                    <!-- End Parking -->

                    <!-- Pentry -->
                    <div class="col-md-4 commercial-col pentry-col <?= ( $data->property_type_name ?? '' ) == 'Office' ? '' : 'd-none' ?>">
                        <div class="form-group">
                            <label for="">Pentry</label>
                            <select name="property_details[pentry]" class="form-control" data-saved-value="<?= $pentry ?? '' ?>">
                                <option value="" selected disabled>Choose...</option>
                                <option value="with_pentry" <?= ( $pentry ?? '' ) == 'with_pentry' ? 'selected' : '' ?>>With Pentry</option>
                                <option value="without_pentry" <?= ( $pentry ?? '' ) == 'without_pentry' ? 'selected' : '' ?>>Without Pentry</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Pentry -->

                    <!-- Washroom -->
                    <div class="col-md-4 commercial-col washroom-col <?= ( $data->property_type_name ?? '' ) == 'Office' ? '' : 'd-none' ?>">
                        <div class="form-group">
                            <label for="">Washroom</label>
                            <select name="property_details[washroom]" class="form-control" data-saved-value="<?= $washroom ?? '' ?>">
                                <option value="" selected disabled>Choose...</option>
                                <option value="with_washroom" <?= ( $washroom ?? '' ) == 'with_washroom' ? 'selected' : '' ?>>With Washroom</option>
                                <option value="without_washroom" <?= ( $washroom ?? '' ) == 'without_washroom' ? 'selected' : '' ?>>Without Washroom</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Washroom -->

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
<!-- End Shop Details -->
