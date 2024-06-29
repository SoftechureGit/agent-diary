<div class="row margin-add additional_<?= time() ?>" style="margin-bottom: 15px;">
  <div class="col-md-4 col-sm-4 col-xs-12">
     <label for="area">Select Component:</label>
     <select class="form-control" id="a_box" name="add_set[0][c_name]">
        <option value="Select Component">Select Component</option>
        <option value="External Development Charges">External Development Charges</option>
        <option value="EEC">EEC</option>
        <option value="One Time Maitenance Cost">One Time Maitenance Cost</option>
        <option value="EEC &amp; FFEC">EEC &amp; FFEC</option>
        <option value="Gas Line Installation Cost">Gas Line Installation Cost</option>
        <option value="Power Back (1 Kv)">Power Back (1 Kv)</option>
        <option value="Ht Line Charges">Ht Line Charges</option>
        <option value="FFEC">FFEC</option>
        <option value="Operational Change">Operational Change</option>
        <option value="Club Membership Charge">Club Membership Charge</option>
        <option value="Interest Free Maintenance Security  ">Interest Free Maintenance Security  </option>
     </select>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-8">
     <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
           <label for="area">Price:</label>
           <input type="text" name="add_set[0][price]" class="form-control" id="area" value="price">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 padding-left-none">
           <label><input class="checkgst" type="checkbox" value="" id="chkgst_additional_<?= time() ?>"> &nbsp;&nbsp;GST</label>
           <div class="dvGst2" style="">
              <input class="form-control inputgst_additional_<?= time() ?>" style="display: none;" type="text" name="add_set[0][gst]" id="txtGstNumber" placeholder="Enter GST value">
           </div>
        </div>
     </div>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-4 padding-left-none">
     <label for="area">Unit:</label>
     <select class="form-control" id="a_box2" name="add_set[0][unit]">
        <option value="Select Unit">Select Unit</option>
        <option value="Sq.Yd">Sq.Yd</option>
        <option value="Sq.Ft">Sq.Ft</option>
        <option value="Bigha">Bigha</option>
        <option value="Sq.Mtr">Sq.Mtr</option>
        <option value="Fix">Fix</option>
        <option value="% of BSP">% of BSP</option>
        <option value="Acres">Acres</option>
     </select>
  </div>
  <div class="col-md-1 col-sm-1 col-xs-12">
     <label class="blank" for="blank"> &nbsp; </label>
     <div class="add_field_button3"><i class="fa fa-plus-circle cp" style="font-size: 18px;" aria-hidden="true" onclick="addInputRowAdditional('additional_<?= time() ?>')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;font-size: 18px;" aria-hidden="true" onclick="removeInputRowAdditional('additional_<?= time() ?>')"></i></div>
  </div>
</div>

<script>
$('#chkgst_additional_<?= time() ?>').change(function () {
  if($("#chkgst_additional_<?= time() ?>").is(':checked')){
    $(".inputgst_additional_<?= time() ?>").show(); 
  } 
  else {
     $(".inputgst_additional_<?= time() ?>").hide(); 
  }
});
</script>