<div class="row">

   <div class="form-group col-md-4">
      <label>Unit Code:</label>

      <select class="form-control" id="unit_code" name="unit_code" onchange="getBasicCostData()" required >
         <option value="">Select Unit Code</option>
         <?php foreach ($unit_code_list as $item) { ?>
            <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
          <?php } ?>
      </select>

   </div>

   <div class="form-group col-md-4">
      <label>Select Tower:</label>
      <select class="form-control" id="tower_id" name="tower_id" onchange="getBasicCostData('1')">
         <option value="">Select Tower</option>
         <?php foreach ($block_list as $item) { ?>
            <option value="<?= $item['block_id'] ?>"><?= $item['block_name'] ?></option>
          <?php } ?>
      </select>
   </div>
   <div class="form-group col-md-4">
      <label>Select Floor:</label>
      <select class="form-control" id="floor_id" name="floor_id" onchange="getBasicCostData('1')">
         <option value="">Select Floor</option>
         <?php foreach ($floor_list as $floor) { ?>
            <option value="<?= $floor->floor_id ?>" ><?= $floor->floor_name ?></option>
          <?php } ?>
      </select>
   </div>
   <div class="form-group col-md-6">
      <label>Size:</label>
      <input type="text" class="form-control" id="input_size" placeholder="" disabled />
   </div>
   <div class="form-group col-md-6">
   </div>
   <!--<div class="form-group col-md-6">
      <label>Current Rate:</label>
      <div class="row">
         <div class="col-md-6">
            <input type="text" class="form-control" placeholder="" id="current_rate" name="current_rate" disabled >
         </div>
         <div class="col-md-6">
            <select class="form-control" id="current_rate_unit" name="current_rate_unit" disabled>
               <option value="">Select Unit</option>

              <?php foreach ($unit_list as $item) { ?>
                <option value="<?= $item->unit_id ?>" ><?= $item->unit_name ?></option>
              <?php } ?>
            </select>
         </div>
      </div>
   </div>-->
   <div class="form-group col-md-6">
      <label>New Rate:</label>
      <div class="row">
         <div class="col-md-6">
            <input type="text" class="form-control" placeholder="" id="new_rate" name="new_rate" required="">
         </div>
         <div class="col-md-6">
            <select class="form-control" id="new_rate_unit" name="new_rate_unit" required="">
               <option value="">Select Unit</option>

              <?php foreach ($unit_list as $item) { ?>
                <option value="<?= $item->unit_id ?>" ><?= $item->unit_name ?></option>
              <?php } ?>
            </select>
         </div>
      </div>
   </div>
</div>

<div class="update_basic_cost_list" style="margin-top: 15px;">
    <h3>List of Unit</h3>
    <div class="table-responsive" style="margin-top: 20px;">
       <table class="table table-bordered">
          <thead>
             <tr>
                <th class="text-center" style="width: 60px;">Selection <input type="checkbox" id="checkAll" name="checkAll" value="1" style="margin-top: 8px;cursor: pointer;"></th>
                <th class="text-center">S. No</th>
                <th class="text-center">Unit Ref. No</th>
                <th class="text-center">Current Rate</th>
                <th class="text-center">Floor</th>
                <th class="text-center">Size</th>
                <th class="text-center">Block</th>
                <th class="text-center">Unit Type</th>
             </tr>
          </thead>
          <tbody class="inventory_unit_list">
          </tbody>
       </table>
    </div>
    <div align="right" style="margin-top: 15px;">
       <button type="submit" class="btn btn-dark btn-lg inventory-btn" disabled >Update</button>
    </div>
</div>

<script>
$("#checkAll").change(function(){
    var status = $(this).is(":checked") ? true : false;
    $(".chk_selection").prop("checked",status);
});
</script>