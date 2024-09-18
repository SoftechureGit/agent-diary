
        <div class="row">

          <?php 
            if(!count(lead_units($lead_id ?? 0 , $user_detail))):
              ?>
            <div class="col-md-12">
              <div class='text-center'>No data available</div>
            </div>
              <?php 
            endif;
          ?>

          <?php
           foreach (lead_units($lead_id ?? 0 , $user_detail ) as $key => $lead_unit) : ?>
            <!-- Unit Card -->
            <div class="col-md-12">
              <div class="card unit-card">
                <div class="card-body">
                  <div class="row">
                    <!-- S. No. -->
                    <div class="col-md-3">
                      <label for="">S. No.</label>
                    </div>
                    <div class="col-md-9">
                      <span class="label-value">
                        : &nbsp;&nbsp; <?= ++$key ?>
                      </span>
                    </div>
                    <!-- End S. No. -->

                    <!-- Project Type -->
                    <div class="col-md-3">
                      <label for="">Project Type</label>
                    </div>
                    <div class="col-md-9">
                      <span class="label-value">
                        : &nbsp;&nbsp; <?= $lead_unit->project_type_name ?>
                      </span>
                    </div>
                    <!-- End Project Type -->

                    <!-- Property Type -->
                    <div class="col-md-3">
                      <label for="">Property Type</label>
                    </div>
                    <div class="col-md-9">
                      <span class="label-value">
                        : &nbsp;&nbsp; <?= $lead_unit->property_type_name ?>
                      </span>
                    </div>
                    <!-- End Property Type -->

                    <!-- Location -->
                    <div class="col-md-3">
                      <label for="">Location</label>
                    </div>
                    <div class="col-md-9">
                      <span class="label-value">
                        : &nbsp;&nbsp; <?= ($lead_unit->location_name ?? 'N/A').', '.($lead_unit->city_name ?? 'N/A').', '.($lead_unit->state_name ?? 'N/A'); ?>
                      </span>
                    </div>
                    <!-- End Location -->

                    <!-- Unit No -->
                    <?php if ($lead_unit->property_details->unit_number ?? 0) : ?>
                      <div class="col-md-3">
                        <label for=""> Unit No</label>
                      </div>
                      <div class="col-md-9">
                        <span class="label-value">
                          : &nbsp;&nbsp; <?= $lead_unit->property_details->unit_number; ?>
                        </span>
                      </div>
                    <?php endif; ?>
                    <!-- End Unit No -->

                    <!-- Size -->
                    <?php if ($lead_unit->property_details->plot_size ?? 0) : ?>
                      <div class="col-md-3">
                        <label for="">Size</label>
                      </div>
                      <div class="col-md-9">
                        <span class="label-value">
                          : &nbsp;&nbsp; <?= $lead_unit->property_details->plot_size; ?>
                        </span>
                      </div>
                    <?php endif; ?>
                    <!-- End Size -->

                    <!-- Booking Date -->
                    <?php if ($lead_unit->booking_date ?? 0) : ?>
                      <div class="col-md-3">
                        <label for="">Booking Date</label>
                      </div>
                      <div class="col-md-9">
                        <span class="label-value">
                          : &nbsp;&nbsp; <?= $lead_unit->booking_date; ?>
                        </span>
                      </div>
                    <?php endif; ?>
                    <!-- End Booking Date -->

                    <!-- Unit Ref No -->
                    <?php if ($lead_unit->property_details->referance_number ?? 0) : ?>
                      <div class="col-md-3">
                        <label for="">Unit Ref No</label>
                      </div>
                      <div class="col-md-9">
                        <span class="label-value">
                          : &nbsp;&nbsp; <?= $lead_unit->property_details->referance_number ?? ''; ?>
                        </span>
                      </div>
                    <?php endif; ?>
                    <!-- End Unit Ref No -->

                    <!-- Status -->
                     <?php if($lead_unit->status ?? 0): ?>
                      <div class="col-md-3">
                        <label for="">Status</label>
                      </div>
                      <div class="col-md-9">
                        <span class="label-value">
                          <?php
                            $status     = '';
                            if($lead_unit->buyer_status == 1 && $lead_unit->buyer_id == $lead_id):
                              $status     = "<span class='btn btn-sm btn-success badge text-white'>Grant</span>";
                            endif;
                            
                            if($lead_unit->status == 1 && $lead_unit->lead_id == $lead_id):
                              $status     =  "<span class='btn btn-sm btn-warning badge text-white'>Sold</span>";
                            endif;
                          ?>
                          : &nbsp;&nbsp; <?= $status ?>
                        </span>
                      </div>
                      <?php endif; ?>
                    <!-- End Status -->

                      <div class="col align-self-end">
                        <div class="d-flex text-end" style="justify-content: right;">
                        <?php if(!$lead_unit->buyer_id): ?>
                          <i class="fa fa-edit px-2  text-success add-edit-new-unit-btn" data-id="<?= $lead_unit->id; ?>" data-lead_id="<?= $lead_unit->lead_id ?>"></i>
                          <?php endif; ?>
                          <i class="fa fa-eye px-2 text-primary view-unit-details" data-id="<?= $lead_unit->id; ?>"></i>
                        </div>
                      </div>
                    <!-- End Project -->

                  </div>
                </div>
              </div>
            </div>
            <!-- End Unit Card -->
          <?php endforeach; ?>

        </section>