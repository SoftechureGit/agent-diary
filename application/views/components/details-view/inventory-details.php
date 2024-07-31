<?php
extract((array) $data ?? []);
extract((array) json_decode($property_details ?? ''));
$property_layout_url        =   $property_layout ? base_url("uploads/images/property/unit/$property_layout") : null;

?>
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered">
                <!-- Unit Code -->
                <?php if ($unit_code_name ?? 0) : ?>
                <tr>
                    <th>Unit Code</th>
                    <td><?= $unit_code_name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Unit Code -->

                <!-- Referance Number -->
                <?php if ($referance_number ?? 0) : ?>
                <tr>
                    <th>Referance Number</th>
                    <td><?= $referance_number ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Referance Number -->

                <!-- Unit No -->
                <?php if ($unit_no ?? 0) : ?>
                <tr>
                    <th>Unit No</th>
                    <td><?= $unit_no ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Unit No -->

                <!-- Floor -->
                <?php if ($floor_id ?? 0) : ?>
                <tr>
                    <th>Floor</th>
                    <td><?= getFloors($floor_id)->name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Floor -->

                <!-- Tower -->
                <?php if ($block_or_tower_id ?? 0) : ?>
                <tr>
                    <th>Tower</th>
                    <td><?= getBlocksOrTowers($block_or_tower_id)->name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Tower -->

                <!-- Unit Type -->
                <?php if ($unit_type ?? 0) : ?>
                <tr>
                    <th>Unit Type</th>
                    <td><?= $unit_type ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Unit Type -->

                <!-- SA -->
                <?php if ($sa ?? 0) : ?>
                <tr>
                    <th>SA</th>
                    <td><?= $sa ?? '' ?> <?= sizeUnits($sa_size_unit)->unit_name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End SA -->

                <!-- BA -->
                <?php if ($ba ?? 0) : ?>
                <tr>
                    <th>BA</th>
                    <td><?= $ba ?? '' ?> <?= sizeUnits($ba_size_unit)->unit_name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End BA -->


                <!-- CA -->
                <?php if ($ca ?? 0) : ?>
                <tr>
                    <th>CA</th>
                    <td><?= $ca ?? '' ?> <?= sizeUnits($ca_size_unit)->unit_name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End CA -->


                <!-- Applicable plc -->
                <?php if ($applicable_plc ?? 0) : ?>
                <tr>
                    <th>Applicable plc</th>
                    <td>
                        <ul style="margin: 0; padding-left: 1rem;">
                        <?php   
                            foreach(getPropertyApplicablePlcs($product_id ?? 0, $applicable_plc ?? null) as $applicable_plc_item):
                                 echo "<li style='list-style: auto;'>$applicable_plc_item->price_component_name</li>";
                            endforeach;    
                        ?>
                        </ul>
                    </td>
                </tr>
                <?php endif; ?>
                <!-- End applicable plc -->

                <!-- Facing -->
                <?php if ($facing ?? 0) : ?>
                <tr>
                    <th>Facing</th>
                    <td><?= str_after('|', $facing ?? '') ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Facing -->

                <!-- Parking -->
                <?php if (is_array($parking ?? [])) : ?>
                <tr>
                    <th>Parking</th>
                    <td><?= implode(', ', array_map('ucwords', $parking) ) ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Parking -->
           
            <?php if ($property_layout_url ?? 0) : ?>
                <tr>
                    <th>Layout</th>
                    <td>
                        <a href="<?= $property_layout_url ?? '#'; ?>" class="nav-link text-primary px-0" target="_blank">View</a>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>