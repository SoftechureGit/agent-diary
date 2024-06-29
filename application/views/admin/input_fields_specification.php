<?php 
$where = "specification_status='1'";
$specification_list = $this->Action_model->detail_result('tbl_specifications',$where);
?>
<div class="row margin-add specification_<?= time() ?>" style="margin-bottom: 15px;">
  <input type="hidden" name="spec[<?= time() ?>][product_specification_id]" value=''>
  <div class="col-md-4">
     <select class="form-control" id="a_box" name="spec[<?= time() ?>][specification_id]">
        <option value="">Select Specification</option>
        <?php foreach ($specification_list as $specification) { ?>
          <option value="<?= $specification->specification_id ?>"><?= $specification->specification_name ?></option>
        <?php } ?>
     </select>
  </div>
  <div class="col-md-7">
  	<textarea class="form-control custom-textarea_<?= time() ?> ckeditor" name="spec[<?= time() ?>][description]" id="comment_0"></textarea>
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