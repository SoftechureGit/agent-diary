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
          <h1>Famous Personalities</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update'; } else { echo 'Add'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/famous_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data">

                
                 <div class="form-group">
                  <label class="control-label">famous Name</label>
                  <input type="text" required class="form-control" name="expert_name" value="<?php if($id!='') { echo $famous_single->famous_name; } ?>">
                </div>
                <div class="form-group">
                  <div class="row">
                   <div class="form-group col-md-12">
                    <br>
                  <label class="control-label">famous Image</label>
                  <input type="file" class="form-control" name="gal_image" value="">
                  <input type="hidden" name="old_image" value="<?php if($id){echo $famous_single->famous_image;} ?>">
                  <?php if($id && $famous_single->famous_image){
                    echo "<img src='".base_url('public/front/famous/'.$famous_single->famous_image)."' height='100' >";
                  } ?>
                </div>
                 
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label">About famous</label>
                  <textarea class="form-control" name="expert_description"><?php if($id!='') { echo $famous_single->famous_description; } ?></textarea>
                </div> 
                <div class="form-group">
                  <label class="control-label">famous In</label>
                  <input type="text" required class="form-control" name="expert_in" value="<?php if($id!='') { echo $famous_single->famous_in; } ?>">
                </div> 
                 <div class="form-group">
                  <label class="control-label">Facebook Url</label>
                  <input type="text" required class="form-control" name="facebook_url" value="<?php if($id!='') { echo $famous_single->facebook_url; } ?>">
                </div> 

                <div class="form-group">
                  <label class="control-label">Twitter Url</label>
                  <input type="text" required class="form-control" name="twitter_url" value="<?php if($id!='') { echo $famous_single->twitter_url; } ?>">
                </div> 

                <div class="form-group">
                  <label class="control-label">Instagram Url</label>
                  <input type="text" required class="form-control" name="instagram_url" value="<?php if($id!='') { echo $famous_single->instagram_url; } ?>">
                </div>
                <div class="form-group">
                    <label class="control-label">State</label><br>
                    <select class="form-control" name="state_id">
                      <option selected disabled>Choose State</option>
                      <?php foreach ($states as $key => $state) { ?>
                      <option value="<?php echo $state->state_id; ?>" <?php if($id){if($famous_single->state_id==$state->state_id){echo "selected";}} ?>><?php echo $state->state_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update'; } else { echo 'Add'; } ?></button>
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