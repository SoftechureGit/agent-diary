  <hr>
  <h4 class="text-center" style="margin-top: 8px;margin-bottom: 10px;">Booking Application Request</h4>
  <hr>
  <div class="row">

    <!-- Buyer Name -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Buyer Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="booking_buyer_name" name="booking_buyer_name" value="<?= $buyer_name ?? '' ?>" placeholder="Enter buyer name" readonly required/>
      </div>
    </div>
    <!-- End Buyer Name -->

    <!-- Buyer S/W/D -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Buyer S/W/D <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="booking_buyer_sdw" name="booking_buyer_sdw" value="<?= $booking_buyer_sdw ?? '' ?>" placeholder="Name of S/D/W" required="" />
      </div>
    </div>
    <!-- End Buyer S/W/D -->

    <!-- Seller Name -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Seller Name <span class="text-danger">*</span></label>
        <select name="booking_seller_name" class="form-control" required>
          <option value="">Choose...</option>
        </select>
      </div>
    </div>
    <!-- End Seller Name -->

    <!-- Seller S/W/D -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Seller S/W/D <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="booking_seller_sdw" name="booking_seller_sdw" value="<?= $booking_seller_sdw ?? '' ?>" placeholder="Name of S/D/W" required="" />
      </div>
    </div>
    <!-- End Seller S/W/D -->

    <!-- State -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">State <span class="text-danger">*</span></label>
        <select name="booking_state_id" id="" class="form-control get_cities select2" data-selected_id="<?= $record->state_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
          <?php
          foreach (states() as $state) :
            $selected         = ($record->state_id ?? 0) == $state->id ? 'selected' : '';
            echo "<option value='$state->id' $selected>$state->name</option>";
          endforeach;
          ?>
        </select>
      </div>
    </div>
    <!-- End State -->

    <!-- City -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">City <span class="text-danger">*</span></label>
        <select name="booking_city_id" id="" class="form-control set_cities get_locations" data-selected_id="<?= $record->city_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End City -->

    <!-- Location -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Location <span class="text-danger">*</span></label>
        <select name="booking_location_id" id="" class="form-control set_locations" data-selected_id="<?= $record->location_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End Location -->


    <!-- List of Project -->
    <div class="col-md-4 project_list_wrapper">
      <div class="form-group">
        <label for="">List of Project <span class="text-danger">*</span></label>
        <select name="booking_project_id" id="" class="form-control" data-selected_id="<?= $record->project_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End List of Project -->


    <div class="col-md-4">
      <label>Unit No <span class="text-danger">*</span></label>
      <select class="form-control" id="booking_unit_no" name="booking_unit_no" onchange="getUnitRefNo(this.value)" required="">
        <option value="">Select Unit No</option>
      </select>
    </div>

    <!-- Booking Deal Amount -->
    <div class="col-md-12 mt-2">
      <details <?= isset($record) ? 'open' : '' ?>>
        <summary>Deal Amount</summary>
        <div class="booking-deal-amount-container p-4">
        <?php $this->view('components/other/add-more/booking-deal-amount', [ 'records' => $record->booking_deal_amount ?? [] ]) ?>

        <div class="text-right">
          <button type="button" class="btn btn-warning btn-sm text-white add-more-btn" onclick="add_more(this, 'booking-deal-amount' ,'.booking-deal-amount-container')">Add More</button>
        </div>
        </div>
        
      </details>
     </div>
    <!-- End Booking Deal Amount -->

    <!-- Payment Terms -->
    <div class="col-md-12 mt-4">
      <details <?= isset($record) ? 'open' : '' ?>>
        <summary>Payment Terms</summary>
        <div class="payment-terms-container p-4">
        <?php $this->view('components/other/add-more/booking-payment-terms', [ 'records' => $record->payment_terms ?? [] ]) ?>

        <div class="text-right">
          <button type="button" class="btn btn-warning btn-sm text-white add-more-btn" onclick="add_more(this, 'payment-terms' ,'.payment-terms-container')">Add More</button>
        </div>
        </div>
        
      </details>
     </div>
    <!-- End Payment Terms -->

  </div>