<?php include('include/header.php'); ?>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/tinymce/jquery.tinymce.min"></script>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
         
          <a style="float: right;" href="<?php echo base_url(ADMIN_URL.'/slider'); ?>" class="btn btn-primary">List Slide</a>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title">Edit Slider</h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
               <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url(ADMIN_URL.'/edit_slider/'.$home_slider->slide_id); ?>">
                                           
                                            <div class="form-group">
                                                <label>Publish</label>
                                                <select name="publish" class="form-control">
                                                    <option value="1" <?php if($home_slider->slide_status==1){echo "selected";} ?>>Publish</option>
                                                    <option value="0" <?php if($home_slider->slide_status==0){echo "selected";} ?>>Unpublish</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Alt Name</label>
                                                <input class="form-control" name="alttage" value="<?php echo $home_slider->slide_title; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>File input</label>
                                                <?php  if($home_slider->slide_image!=''){?>
                    <img src="<?php echo base_url('public/front/slider/'.$home_slider->slide_image)?>" style="width:150px;height:100px;">
                    <?php } ?>
                                                <input type="hidden" name="old_filename" value="<?php echo $home_slider->slide_image; ?>">
                            <label for="imageUpload" class="btn btn-primary">Change</label>
<input type="file" id="imageUpload" accept="image/*" style="display: none"   name="filename">
<span id="uploadedfilename"></span>
<script>
document.getElementById('imageUpload').onchange = uploadOnChange;
function uploadOnChange() {
    var filename = this.value;
    var lastIndex = filename.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename = filename.substring(lastIndex + 1);
    }
    document.getElementById('uploadedfilename').innerHTML = filename;
}
</script>
                                            </div>
                                            <div class="btndiv">
                                            <button type="submit" class="btn btn-danger">UPDATE</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        </div>
    </div>
    </main>
<?php include('include/footer.php'); ?>