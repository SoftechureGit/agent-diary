<div class="row margin-add property_image_<?= time() ?>" style="margin-bottom: 15px;">
  <div class="col-md-11 col-sm-11 col-xs-10">
   <!--<label for="title">Upload image:</label>-->
   <input type="hidden" name="project_image_id[<?= time() ?>]" class="form-control" value="<?= time() ?>">
   <input type="file" name="project_image_<?= time() ?>" class="form-control input_<?= time() ?>" style="display: none;" accept="image/jpg,image/jpeg,image/png">
   <div> <button type='button' class='btn btn-primary btn_<?= time() ?>' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick="browseFile('<?= time() ?>')">Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> </div><div class='span_<?= time() ?>' style='margin-top: 3px;'></div>
  </div>
  <div class="col-md-1 col-sm-1 col-xs-2">
    <label for="title">&nbsp;</label>
     <div class="add_field_button3"><i class="fa fa-plus-circle cp" style="font-size: 18px;" aria-hidden="true" onclick="addInputRowProperty_image('property_image_<?= time() ?>')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;font-size: 18px;" aria-hidden="true" onclick="removeInputRowProperty_image('property_image_<?= time() ?>')"></i></div>
  </div>
</div>
  