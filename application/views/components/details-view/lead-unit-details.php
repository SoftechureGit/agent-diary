<?php
extract((array) $record->property_details ?? []);
?>

<!-- Lead Unit Details -->
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered">
        <caption>Basic Details</caption>
        <tr>
          <th>Looking For</th>
          <td><?= str_replace('_', ' ', ucwords($record->looking_for ?? '')) ?></td>
        </tr>

        <tr>
          <th>Project Name</th>
          <td><?= $record->project_name ?? $record->lead_unit_project_name ?? 'N/A' ?></td>
        </tr>

        <tr>
          <th>Project Type</th>
          <td><?= ucfirst($record->project_type_name ?? '') ?></td>
        </tr>

        <tr>
          <th>Property Type</th>
          <td><?= ucfirst($record->property_type_name ?? '') ?></td>
        </tr>

        <tr>
          <th>Booking Date</th>
          <td><?= $record->booking_date ?? '' ?></td>
        </tr>

        <?php if ($record->costing_price ?? 0): ?>
          <tr>
            <th>Costing Price</th>
            <td>₹ <?= $record->costing_price ?? '' ?></td>
          </tr>
        <?php endif; ?>

        <tr>
          <th>State</th>
          <td><?= $record->state_name ?? '' ?></td>
        </tr>

        <tr>
          <th>City</th>
          <td><?= $record->city_name ?? '' ?></td>
        </tr>

        <tr>
          <th>Location</th>
          <td><?= $record->location_name ?? '' ?></td>
        </tr>

      </table>
    </div>
  </div>

  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered">
        <caption>Property Details</caption>

        <!-- All Json Property Details -->
        <?php
        if (!count((array) $record->property_details ?? [])):
          echo "<tr><td>No property details available</td></tr>";
        endif;

        foreach ($record->property_details ?? [] as $property_detail_key => $property_detail_value):

          if ($property_detail_value != ''):
        ?>
            <tr class="d-none">
              <th><?= str_replace('_', ' ', ucwords($property_detail_key ?? '')) ?></th>
              <td><?= str_after('|', $property_detail_value ?? '') ?></td>
            </tr>
        <?php
          endif;
        endforeach;
        ?>
        <!-- End All Json Property Details -->

        <!-- Property Details -->
          <!-- Unit Code -->
          <?php if ($unit_code ?? $unit_code_name ?? 0) : ?>
                <tr>
                    <th>Unit Code</th>
                    <td><?= ($unit_code ?? 0) ? unit_codes((object) [ 'id' => $unit_code ])->name ?? '' : $unit_code_name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Unit Code -->

                <!-- Property Type Name -->
                <?php if ($property_type_name ?? 0) : ?>
                <tr>
                    <th>Property Type Name</th>
                    <td><?= $property_type_name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Property Type Name -->

                <!-- Referance Number -->
                <?php if ($referance_number ?? 0) : ?>
                <tr>
                    <th>Referance Number</th>
                    <td><?= $referance_number ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Referance Number -->

                <!-- Plot Number -->
                <?php if ($plot_number ?? 0) : ?>
                <tr>
                    <th>Plot Number</th>
                    <td><?= $plot_number ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Plot Number -->

                <!-- Unit Number -->
                <?php if ($unit_number ?? 0) : ?>
                <tr>
                    <th>Unit Number</th>
                    <td><?= $unit_number ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Unit Number -->

                <!-- Tower -->
                <?php if ($tower ?? 0) : ?>
                <tr>
                    <th>Tower</th>
                    <td><?= $tower ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Tower -->

                <!-- Plot Size -->
                <?php if ($plot_size ?? 0) : ?>
                <tr>
                    <th>Plot Size</th>
                    <td>
                        <?= $plot_size ?? '' ?>
                        <?php if ($size_unit ?? 0) : echo (sizeUnits($size_unit)->unit_name ?? ''); endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <!-- End Plot Size -->

                <!-- Area Size -->
                <?php if ($area ?? 0) : ?>
                <tr>
                    <th>Area</th>
                    <td>
                        <?= $area ?? '' ?>
                        <?php if ($size_unit ?? 0) : echo (sizeUnits($size_unit)->unit_name ?? ''); endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <!-- End Area Size -->

                <!-- Unit Size -->
                <?php if ($unit_size ?? 0) : ?>
                <tr>
                    <th>Unit Size</th>
                    <td>
                        <?= $unit_size ?? '' ?>
                        <?php if ($unit_size_unit ?? 0) : echo (sizeUnits($unit_size_unit)->unit_name ?? ''); endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <!-- End Unit Size -->

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

                <!-- Block -->
                <?php if ($block ?? 0) : ?>
                <tr>
                    <th>Block</th>
                    <td><?= $block ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Block -->

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
                            foreach(getPropertyPlcs($product_id ?? 0, $applicable_plc ?? null) as $applicable_plc_item):
                                 echo "<li style='list-style: auto;'>$applicable_plc_item->price_component_name</li>";
                            endforeach;    
                        ?>
                        </ul>
                    </td>
                </tr>
                <?php endif; ?>
                <!-- End applicable plc -->

                <!-- Facing -->
                <?php if ($facing_id ?? 0) : ?>
                <tr>
                    <th>Facing</th>
                    <td><?= facings($facing_id)->title; ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Facing -->

                <!-- Dimension -->
                <?php if ($dimension ?? 0) : ?>
                <tr>
                    <th>Dimension</th>
                    <td><?= $dimension ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Dimension -->

                <!-- Terrace -->
                <?php if ($terrace_id ?? 0) : ?>
                <tr>
                    <th>Terrace</th>
                    <td><?= terraces($terrace_id)->name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Terrace -->

                <!-- Basment -->
                <?php if ($basment_id ?? 0) : ?>
                <tr>
                    <th>Basment</th>
                    <td><?= basments($basment_id)->name ?? '' ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Basment -->

                <!-- Pentry -->
                <?php if ($pentry ?? 0) : ?>
                <tr>
                    <th>Pentry</th>
                    <td><?= ucwords(str_replace('_',' ', $pentry))  ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Pentry -->

                <!-- Washroom -->
                <?php if ($washroom ?? 0) : ?>
                <tr>
                    <th>Washroom</th>
                    <td><?= ucwords(str_replace('_',' ', $washroom)) ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Washroom -->

                <!-- Parking -->
                <?php if (is_array($parking ?? 0)) : ?>
                <tr>
                    <th>Parking</th>
                    <td><?= implode(', ', array_map('ucwords', $parking ?? []) ) ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Parking -->
           
                 <!-- Remark -->
                 <?php if ($parking_count ?? 0) : ?>
                <tr>
                    <th>Parking</th>
                    <td><?= $parking_count ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Remark -->

                 <!-- Remark -->
                 <?php if ($remark ?? 0) : ?>
                <tr>
                    <th>Remark</th>
                    <td><?= $remark ?></td>
                </tr>
                <?php endif; ?>
                <!-- End Remark -->

            <?php if ($property_layout_url ?? 0) : ?>
                <tr>
                    <th>Layout</th>
                    <td>
                        <a href="<?= $property_layout_url ?? '#'; ?>" class="nav-link text-primary px-0" target="_blank">View</a>
                    </td>
                </tr>
            <?php endif; ?>
        <!-- End Property Details -->

        <?php if ($record->property_layout_url ?? 0): ?>
          <tr>
            <th>Layout</th>
            <td>
              <a href="<?= $record->property_layout_url ?? '#'; ?>" class="nav-link text-primary" target="_blank">View</a>
            </td>
          </tr>
        <?php endif; ?>
      </table>
    </div>
  </div>

  <!-- Property Documents -->
  <?php if (count($property_documents ?? [])): ?>
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered">
          <caption>Property Documents</caption>
          <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th class="text-center">Action</th>
          </tr>
          <?php
          foreach ($property_documents ?? [] as $property_document_key => $property_document):
          ?>
            <tr>
              <td class="text-center">
                <?= ++$property_document_key ?>
              </td>
              <td>
                <?= $property_document->title ?? '' ?>
              </td>
              <td class="text-center">
                <a href="<?= $property_document->document_full_url ?? '' ?>" class="text-primary" target="_blank">
                  View
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  <?php endif; ?>
  <!-- End Property Documents -->

  <!-- Gallery Images -->
  <?php if (count($gallery_images ?? [])): ?>
    <div class="col-md-12">
      <hr>
      <section class="photo-gallery">
        <h4 class="heading">Photo Gallery</h4>
        <div class="row">
          <?php foreach ($gallery_images ?? [] as $gallery_image): ?>
            <div class="col-md-2 my-2">
              <a href="<?= $gallery_image->full_url ?? '#' ?>" target="_blank">
                <img src="<?= $gallery_image->full_url ?? '' ?>" alt="" class="w-100 gallery-image" height="150px">
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    </div>
  <?php endif; ?>
  <!-- End Gallery Images -->
</div>
<!-- End Lead Unit Details -->