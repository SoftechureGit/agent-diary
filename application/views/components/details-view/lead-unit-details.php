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
        </div>
<!-- End Lead Unit Details -->