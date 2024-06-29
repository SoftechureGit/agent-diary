<?php 
$where = "unit_status='1'";
$unit_list = $this->Action_model->detail_result('tbl_units',$where);

$where = "price_component_status='1' and price_group_id='4'";
$price_component_list = $this->Action_model->detail_result('tbl_price_components',$where,'price_component_id,price_component_name');
?>

<div class="row margin-add plc_<?= time() ?>" style="margin-bottom: 15px;">
  <input type="hidden" name="plc_detail[<?= time() ?>][product_plc_detail_id]" value=''>
  <div class="col-md-4 col-sm-4 col-xs-12">
     <label for="area">Select Component:</label>
     <select class="form-control" id="a_box" name="plc_detail[<?= time() ?>][price_comp_id]">
        <option value="">Select Component</option>
        <?php foreach ($price_component_list as $price_component) { ?>
          <option value="<?= $price_component->price_component_id ?>"><?= $price_component->price_component_name ?></option>
        <?php } ?>
     </select>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-8">
     <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
           <label for="area">Price:</label>
           <input type="text" name="plc_detail[<?= time() ?>][price]" class="form-control" id="area" value="">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 padding-left-none">
           <label><input class="checkgst" type="checkbox" id="chkgst_plc_<?= time() ?>" name="plc_detail[<?= time() ?>][gst_check]" value="1" > &nbsp;&nbsp;GST</label>
           <div class="dvGst2" style="">
              <input class="form-control inputgst_plc_<?= time() ?>" style="display: none;" type="text" name="plc_detail[<?= time() ?>][gst]" id="txtGstNumber" placeholder="Enter GST value">
           </div>
        </div>
     </div>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-4 padding-left-none">
     <label for="area">Unit:</label>
     <select class="form-control" id="a_box2" name="plc_detail[<?= time() ?>][unit]">
        <option value="">Select Unit</option>
        <?php foreach ($unit_list as $unit) { ?>
          <option value="<?= $unit->unit_id ?>"><?= $unit->unit_name ?></option>
        <?php } ?>
     </select>
  </div>
  <div class="col-md-1 col-sm-1 col-xs-12">
     <label class="blank" for="blank"> &nbsp; </label>
     <div class="add_field_button3"><i class="fa fa-plus-circle cp" style="font-size: 18px;" aria-hidden="true" onclick="addInputRowPLC('plc_<?= time() ?>')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;font-size: 18px;" aria-hidden="true" onclick="removeInputRowPLC('plc_<?= time() ?>')"></i></div>
  </div>
</div>

<script>
$('#chkgst_plc_<?= time() ?>').change(function () {
  if($("#chkgst_plc_<?= time() ?>").is(':checked')){
    $(".inputgst_plc_<?= time() ?>").show(); 
  } 
  else {
     $(".inputgst_plc_<?= time() ?>").hide(); 
  }
});
</script>