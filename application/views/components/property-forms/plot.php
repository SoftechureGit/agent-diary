<?php extract($property_details?? []); ?>
<!-- Plot Details -->
<section id="plot-property-form" class="theme-form">
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
                            <label for="">Unit Code</label>
                            <input type="text" placeholder="Enter Unit Code" name="property_details[unit_code]" value="<?= $unit_code ?? $code ?? '' ?>" class="form-control" >
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

                    <!-- Plot Size (Sqyd) -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Plot Size </label>
                            <input type="text" placeholder="Enter Plot Size (Sqyd)" name="property_details[plot_size]" value="<?= $plot_size ?? '' ?>" class="form-control" >
                        </div>
                    </div>

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
                    <!-- End Plot Size (Sqyd) -->

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

                    <!-- Dimantion F x B x S1 x S2 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dimantion F x B x S1 x S2</label>
                            <input type="text" placeholder="Enter Dimantion F x B x S1 x S2" name="property_details[dimantion]" value="<?= $dimantion ?? $dimension ?? '' ?>" class="form-control" >
                        </div>
                    </div>
                    <!-- End Dimantion F x B x S1 x S2 -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Plot Details -->


