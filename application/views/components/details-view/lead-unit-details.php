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
                  <th>Property Name ( Unit Code )</th>
                  <td><?= $record->property_name ?? 'N/A' ?></td>
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

                <?php if($record->costing_price): ?>
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
                <?php 
                    if(!count((array) $record->property_details ?? [])):
                       echo "<tr><td>No property details available</td></tr>";
                    endif;

                    foreach($record->property_details ?? [] as $property_detail_key => $property_detail_value):
                ?>
                <tr>
                  <th><?= str_replace('_', ' ', ucwords($property_detail_key ?? '')) ?></th>
                  <td><?= str_after('|', $property_detail_value ?? '' ) ?></td>
                </tr>
                <?php endforeach; ?>

               <?php if($record->property_layout_url ?? 0): ?>
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
          <?php if(count($property_documents ?? [])): ?>
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
                    foreach($property_documents ?? [] as $property_document_key => $property_document):
                ?>
                <tr>
                  <td  class="text-center">
                      <?= ++$property_document_key ?>
                    </td>
                  <td>
                      <?= $property_document->title ?? '' ?>
                    </td>
                  <td  class="text-center">
                    <a href="<?= $property_document->document_full_url ?? ''?>" class="text-primary" target="_blank">
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
          <?php if(count($gallery_images ?? [])): ?>
            <div class="col-md-12">
              <hr>
              <section class="photo-gallery">
                <h4 class="heading">Photo Gallery</h4>
                <div class="row">
                  <?php foreach($gallery_images ?? [] as $gallery_image): ?>
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