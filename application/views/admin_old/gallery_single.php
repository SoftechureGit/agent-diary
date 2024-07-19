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
          <h1>Gallery</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update Gallery'; } else { echo 'Add Gallery'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/gallery_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data">

                
                 <div class="form-group">
                  <label class="control-label">Gallery Image Alt</label>
                  <input type="text" required class="form-control" name="image_alt_text" value="<?php if($id!='') { echo $gallery_single->image_alt_text; } ?>">
                </div>                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                    <label class="control-label">Gallery Category</label>
                      <select class="form-control" required name="gal_cat_id">
                        <option disabled  selected> Choose Gallery Category</option>
                        <?php foreach ($gal_cat as $key => $value) {?>
                          <option <?php if($id){if($gallery_single->gal_cat_id==$value->gal_cat_id){echo "selected";}} ?>  value="<?php echo $value->gal_cat_id; ?>"><?php echo $value->category_title; ?></option>
                        <?php } ?>
                      </select>
                  </div>
                   <div class="form-group col-md-12">
                    <br>
                  <label class="control-label">Gallery Image</label>
                  <input type="file" class="form-control" name="gal_image" value="">
                  <input type="hidden" name="old_image" value="<?php if($id){echo $gallery_single->image;} ?>">
                  <?php if($id){if($gallery_single->image){
                  ?>
                    <img src="<?php echo base_url('public/front/gallery/'.$gallery_single->image) ?>" style="height:70px" >
                  <?php
                  }} ?>
                </div>
                 
                  </div>
                </div>

                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update Gallery'; } else { echo 'Add Gallery'; } ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        </div>
    </div>
    </main>
<?php include('include/footer.php'); ?>