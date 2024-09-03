  <hr>
  <h4 class="text-center" style="margin-top: 8px;margin-bottom: 10px;">Booking Application Request</h4>
  <div class="row">
  <div class="col-md-6">
    <label>Customer Name:</label>
    <?php
    $customer_name = "";
    if ($lead_data->lead_title) {
      $customer_name = $lead_data->lead_title;
    }
    if ($lead_data->lead_first_name) {
      $customer_name .= ($customer_name)?" ".$lead_data->lead_first_name:$lead_data->lead_first_name;
    }
    if ($lead_data->lead_last_name) {
      $customer_name .= ($customer_name)?" ".$lead_data->lead_last_name:$lead_data->lead_last_name;
    }
    ?>
    <input type="text" class="form-control" id="bk_customer_name" name="bk_customer_name" value="<?= $customer_name ?>" required="" />
  </div>
  <div class="col-md-6">
    <label>DOB:</label>
    <input type="text" class="form-control" id="bk_dob" name="bk_dob" value="<?= $lead_data->lead_dob ?>" />
  </div>

  <div class="col-md-6" style="margin-top: 10px;">
    <label>S/D/W Of:</label>
    <div class="row">
      <div class="col-md-5">
        <select class="form-control valid" id="bk_sdw_title" name="bk_sdw_title" aria-invalid="false">
            <option selected="selected" value="">Select Title</option>
            <option value="Mr.">Mr.</option>
            <option value="Ms.">Ms.</option>
            <option value="Mrs.">Mrs.</option>
            <option value="Dr.">Dr.</option>
            <option value="Prof.">Prof.</option>
           
        </select>
      </div>
      <div class="col-md-7">
          <input type="text" class="form-control" id="bk_sdw" name="bk_sdw" value="" placeholder="Name of S/D/W" />
      </div>
    </div>
  </div>

  <div class="col-md-6"></div>
  <div class="col-md-6" style="margin-top: 10px;">
    <label>State:</label>
    <select class="form-control" id="bk_state_id" name="bk_state_id" onchange="getCityBooking(this.value)">
       <option value="">Select State</option>
        <?php foreach ($state_list as $state) { ?>
      <option value="<?= $state->state_id ?>" <?= ($state->state_id==$lead_data->lead_state_id)?'selected':'' ?>><?= $state->state_name ?></option>
        <?php } ?>
   </select>
  </div>

  <div class="col-md-6" style="margin-top: 10px;">
    <label>City:</label>
    <select class="form-control" id="bk_city_id" name="bk_city_id">
       <option value="">Select City</option>
        <?php foreach ($city_list as $city) { ?>
      <option value="<?= $city->city_id ?>" <?= ($city->city_id==$lead_data->lead_city_id)?'selected':'' ?>><?= $city->city_name ?></option>
        <?php } ?>
   </select>
  </div>

  <div class="col-md-12" style="margin-top: 10px;">
    <label>Address:</label>
    <textarea class="form-control" rows="2" id="bk_address" name="bk_address"><?= $lead_data->lead_address ?></textarea>
  </div>
  
  <div class="col-md-12" style="margin-top: 10px;">
    <label>Project Name:</label>
    <select class="form-control" id="bk_project_id" name="bk_project_id" onchange="getProductDataBooking(this.value)" required="">
       <option value="">Select Project</option>
        <?php foreach ($project_list as $item) { ?>
      <option value="<?= $item->product_id ?>"><?= $item->project_name ?></option>
        <?php } ?>
   </select>
  </div>
  
  <div class="col-md-4" style="margin-top: 10px;">
    <label>Size:</label>
    <select class="form-control" id="bk_size" name="bk_size" onchange="get_booking_unit_no()" required="">
       <option value="">Select Size</option>
   </select>
  </div>
  
  <div class="col-md-4" style="margin-top: 10px;">
    <label>Tower:</label>
    <select class="form-control" id="bk_tower" name="bk_tower" onchange="get_booking_unit_no()">
       <option value="">Select Tower</option>
   </select>
  </div>
  
  <div class="col-md-4" style="margin-top: 10px;">
    <label>Floor:</label>
    <select class="form-control" id="bk_floor" name="bk_floor" onchange="get_booking_unit_no()">
       <option value="">Select Floor</option>
        <?php foreach ($floor_list as $item) { ?>
      <option value="<?= $item->floor_id ?>"><?= $item->floor_name ?></option>
        <?php } ?>
   </select>
  </div>

  <div class="col-md-4" style="margin-top: 10px;">
    <label>Unit No:</label>
    <select class="form-control" id="bk_unit_no" name="bk_unit_no" onchange="getUnitRefNo(this.value)" required="">
       <option value="">Select Unit No</option>
   </select>
  </div>
  
  <div class="col-md-4" style="margin-top: 10px;">
    <label>Accommodation:</label>
    <input type="text" class="form-control" id="bk_accommodation_value" name="bk_accommodation_value" value="" readonly="" />
    <input type="hidden" class="form-control" id="bk_accommodation" name="bk_accommodation" value="" readonly="" />
    <input type="hidden" class="form-control" id="bk_product_unit_detail_id" name="bk_product_unit_detail_id" value="" readonly="" />
    <input type="hidden" class="form-control" id="bk_inventory_id" name="bk_inventory_id" value="" readonly="" />
   </select>
  </div>

  <div class="col-md-4" style="margin-top: 10px;">
    <label>Unit Ref No:</label>
    <input type="text" class="form-control" id="bk_unit_ref_no" name="bk_unit_ref_no" value="" readonly="" />
  </div>
  
  <div class="col-md-6" style="margin-top: 10px;">
    <label>Deal Amount:</label>
    <input type="text" class="form-control" id="bk_deal_amount" name="bk_deal_amount" value="" />
  </div>
  
  <div class="col-md-6" style="margin-top: 10px;">
    <label>Booking Amount :</label>
    <input type="text" class="form-control" id="bk_booking_amount" name="bk_booking_amount" value="" />
  </div>
  
  <div class="col-md-6" style="margin-top: 10px;">
    <label>Payment Mode:</label>
    <select class="form-control" id="bk_payment_mode" name="bk_payment_mode">
      <option value="">Select Payment Mode</option>
      <option value="cheque">By Cheque</option>
      <option value="cash">By Cash</option>
      <option value="online_transfer">Online Transfer</option>
    </select>
  </div>
  
  <div class="col-md-6" style="margin-top: 10px;">
    <label>Cheque No/Ref No:</label>
    <input type="text" class="form-control" id="bk_cheque_no" name="bk_cheque_no" value="" />
  </div>
  
  <div class="col-md-6" style="margin-top: 10px;">
    <label>Drawn On:</label>
    <input type="text" class="form-control" id="bk_drawn_on" name="bk_drawn_on" value="" />
  </div>
  
  <div class="col-md-6" style="margin-top: 10px;">
    <label>Date:</label>
    <input type="text" class="form-control" id="bk_booking_date" name="bk_booking_date" value="" />
  </div>

  <div class="col-md-12" style="margin-top: 10px;">
    <label>Remarks:</label>
    <textarea class="form-control" rows="2" id="bk_remark" name="bk_remark"></textarea>
  </div>

    </div>

    <script>
      
$('#bk_dob').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY'
});

$('#bk_booking_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY'
});
    </script>