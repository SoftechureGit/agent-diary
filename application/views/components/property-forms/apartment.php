<?php 
extract($property_details ?? []); 
?>
<!-- Apartment Details -->
<section id="apartment-property-form" class="theme-form">
        <input type="hidden" name="property_details[id]" value="<?= $id ?? 0 ?>" class="id">
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
                     
                    <!-- Unit Code -->
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Code <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Unit Code" name="property_details[unit_code]" value="<?= $unit_code ?? '' ?>" class="form-control" required>
                        </div>
                    </div> -->
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
                            <!-- <input type="text" placeholder="Enter Floor" name="property_details[floor]" value="<?= $floor ?? '' ?>" class="form-control" > -->
                            <select name="property_details[floor_id]" id="" class="form-control">
                                <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach(getFloors() ?? [] as $floor): 
                                    $selected         = (($floor_id ?? 0 ) == $floor->id ) ? 'selected' : '';
                                ?>
                                    <option value="<?= $floor->id ?>"   <?= $selected ?>><?= $floor->name ?? '' ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <!-- End Floor -->

                    <!-- Block Or Floor -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tower</label>
                            <!-- <input type="text" placeholder="Enter Tower" name="property_details[tower]" value="<?= $tower ?? '' ?>" class="form-control" > -->
                            <select name="property_details[block_or_tower_id]" id="" class="form-control">
                                <option value="" disabled selected>Choose...</option>
                                <?php 
                                    foreach(getBlocksOrTowers() ?? [] as $block_or_tower): 
                                    $selected         = (($block_or_tower_id ?? 0 ) == $block_or_tower->id ) ? 'selected' : '';
                                ?>
                                    <option value="<?= $block_or_tower->id ?>"   <?= $selected ?>><?= $block_or_tower->name ?? '' ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <!-- End Block Or Floor -->

                    <!-- Unit Type -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Unit Type</label>
                            <input type="text" placeholder="Enter Unit Type" name="property_details[unit_type]" value="<?= $unit_type ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Unit Type -->

                    <!-- SA -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">SA</label>
                            <input type="text" placeholder="Enter SA" name="property_details[sa]" value="<?= $sa ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End SA -->
                    
                    <!-- SA Size  -->
                    <div class="col-md-2">
                        <label for="">SA Size  </label>
                        <select class="form-control" id="" name="property_details[sa_size_unit]">
                                <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :
                                
                                $selected         = ( $item->unit_id == ( $sa_size_unit ?? '' ) ) ? 'selected' : '';
                                ?>
                             <option value="<?= $item->unit_id ?>"  <?=$selected?> ><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End SA Size -->

                    <!-- BA -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">BA</label>
                            <input type="text" placeholder="Enter BA" name="property_details[ba]" value="<?= $ba ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End BA -->

                      <!-- BA Size  -->
                      <div class="col-md-2">
                        <label for="">BA Size  </label>
                        <select class="form-control" id="" name="property_details[ba_size_unit]">
                                <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :
                                
                                $selected         = ( $item->unit_id == ( $ba_size_unit ?? '' ) ) ? 'selected' : '';
                                ?>
                             <option value="<?= $item->unit_id ?>"  <?=$selected?> ><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End BA Size -->


                    <!-- CA -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">CA</label>
                            <input type="text" placeholder="Enter CA" name="property_details[ca]" value="<?= $ca ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End CA -->

                    <!-- CA Size  -->
                    <div class="col-md-2">
                        <label for="">CA Size  </label>
                        <select class="form-control" id="" name="property_details[ca_size_unit]">
                                <option value="">Select Unit</option>
                            <?php foreach (sizeUnits() ?? []  as $item) :
                                
                                $selected         = ( $item->unit_id == ( $ca_size_unit ?? '' ) ) ? 'selected' : '';
                                ?>
                             <option value="<?= $item->unit_id ?>"  <?=$selected?> ><?= $item->unit_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End CA Size -->

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
                                <option value="open" <?= in_array('open', $parking ?? [] ) ? 'selected' : '' ?>>Open</option>
                                <option value="stilt" <?= in_array('stilt', $parking ?? [] ) == 'stilt' ? 'selected' : '' ?>>Stilt</option>
                                <option value="basement" <?= in_array('basement', $parking ?? [] ) == 'basement' ? 'selected' : '' ?>>Basement</option>

                            </select>
                        </div>
                    </div>
                    <!-- End Parking -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Apartment Details -->