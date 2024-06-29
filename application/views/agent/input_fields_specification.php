<div class="row margin-add specification_<?= time() ?>" style="margin-bottom: 15px;">
  <div class="col-md-4">
     <select class="form-control" id="a_box" name="spec[0][title]">
        <option value="WATER SUPPLY">WATER SUPPLY</option>
        <option value="DOORS">DOORS</option>
        <option value="ELECTRICAL">ELECTRICAL</option>
        <option value="WINDOWS/BALCONY">WINDOWS/BALCONY</option>
        <option value="KITCHEN">KITCHEN</option>
        <option value="Flooring ">Flooring </option>
        <option value="SANITARY &amp; CP FITTINGS">SANITARY &amp; CP FITTINGS</option>
        <option value="Club Highlights">Club Highlights</option>
        <option value="Finishing &amp; Paint Work">Finishing &amp; Paint Work</option>
        <option value="Salient Features">Salient Features</option>
        <option value="Structure">Structure</option>
        <option value="Common Amenities">Common Amenities</option>
        <option value="Washrooms">Washrooms</option>
        <option value="Plumbing &amp; Sanitary Fittings">Plumbing &amp; Sanitary Fittings</option>
        <option value="Staircase">Staircase</option>
        <option value="Bathroom">Bathroom</option>
        <option value="Paints">Paints</option>
        <option value="Location Advantages">Location Advantages</option>
     </select>
  </div>
  <div class="col-md-7">
  	<textarea class="form-control custom-textarea_<?= time() ?> ckeditor" name="spec[0][description]" id="comment_0"></textarea>
  </div>
  <div class="col-md-1">
     <div class="add_field_button3"><i class="fa fa-plus-circle cp" style="font-size: 18px;" aria-hidden="true" onclick="addInputRowSpecification('specification_<?= time() ?>')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;font-size: 18px;" aria-hidden="true" onclick="removeInputRowSpecification('specification_<?= time() ?>')"></i></div>
  </div>
</div>

 <script src="<?php echo base_url('public/admin/') ?>plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
 CKEDITOR.replace( 'custom-textarea_<?= time() ?>' );
 CKEDITOR.add
</script>
     
<script>

$('#chkgst_specification_<?= time() ?>').change(function () {
  if($("#chkgst_specification_<?= time() ?>").is(':checked')){
    $(".inputgst_specification_<?= time() ?>").show(); 
  } 
  else {
     $(".inputgst_specification_<?= time() ?>").hide(); 
  }
});
</script>