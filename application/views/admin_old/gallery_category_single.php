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
          <h1>Gallery Category</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update Gallery Category'; } else { echo 'Add Gallery Category'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/gallery_cat_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data">

                <div class="form-group">
                  <label class="control-label">Gallery Category Title</label>
                  <input type="text" class="form-control" name="gal_cat_title" value="<?php if($id!='') { echo $gallery_cat_single->category_title; } ?>">
                </div>                <div class="form-group">
                
                <div class="form-group">
                  <label class="control-label">Gallery Category Url</label>
                  <input type="text" class="form-control" name="gal_cat_url" value="<?php if($id!='') { echo $gallery_cat_single->gallery_category_url; } ?>">
                </div>  
                </div>

                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update Gallery Category'; } else { echo 'Add Gallery Category'; } ?></button>
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