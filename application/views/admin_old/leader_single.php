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
          <h1>Leader</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update Leader'; } else { echo 'Add Leader'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/leader_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data">

                
                <div class="form-group">
                  <label class="control-label">Leader Name</label>
                  <input type="text" required class="form-control" name="leader_name" value="<?php if($id!='') { echo $leader_single->leader_name; } ?>">
                </div>

                <div class="form-group">
                    <label class="control-label">Leader State</label>
                      <select required class="form-control" name="state_id">
                        <option disabled  selected> Choose Leader State</option>
                        <?php foreach ($states as $key => $value) {?>
                          <option <?php if($id){if($leader_single->state_id==$value->state_id){echo "selected";}} ?>  value="<?php echo $value->state_id; ?>"><?php echo $value->state_name; ?></option>
                        <?php } ?>
                      </select>
                </div>

                <div class="form-group">
                  <label class="control-label">Leader District</label>
                  <input type="text" required class="form-control" name="district_name" value="<?php if($id!='') { echo $leader_single->district_name; } ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Leader Contact No</label>
                  <input type="text" required class="form-control" name="contact_no" value="<?php if($id!='') { echo $leader_single->contact_no; } ?>">
                </div>

                <div class="form-group">
                  <div class="row">

                   <div class="form-group col-md-12">
                    <br>
                  <label class="control-label">Leader Image</label>
                  <input type="file" class="form-control" name="gal_image" value="">
                  <input type="hidden" name="old_image" value="<?php if($id){echo $leader_single->leader_image;} ?>">
                  <?php if($id && $leader_single->leader_image){
                    echo "<img src='".base_url('public/front/leader/'.$leader_single->leader_image)."' height='100' >";
                  } ?>
                </div>
                 
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label">About Leader</label>
                  <textarea class="textarea form-control" name="about_leader"><?php if($id!='') { echo $leader_single->about_leader; } ?></textarea>
                </div> 
                <div class="form-group">
                  <label class="control-label">Leader Post</label>
                  <input type="text" required class="form-control" name="leader_post" value="<?php if($id!='') { echo $leader_single->leader_post; } ?>">
                </div> 

                <div class="form-group">
                  <label class="control-label">Facebook Url</label>
                  <input type="text" required class="form-control" name="social_facebook" value="<?php if($id!='') { echo $leader_single->social_facebook; } ?>">
                </div> 

                <div class="form-group">
                  <label class="control-label">Twitter Url</label>
                  <input type="text" required class="form-control" name="social_twitter" value="<?php if($id!='') { echo $leader_single->social_twitter; } ?>">
                </div> 

                <div class="form-group">
                  <label class="control-label">Instagram Url</label>
                  <input type="text" required class="form-control" name="social_instagram" value="<?php if($id!='') { echo $leader_single->social_instagram; } ?>">
                </div> 

                <div class="form-group">
                  <label class="control-label">Featured Leader</label>
                  <select class="form-control" name="featured">
                      <option selected value="2">Select</option>
                      <option <?php if($id!='') { if($leader_single->featured==1){echo "selected"; }} ?> value="1">President</option>
                      <option <?php if($id!='') { if($leader_single->featured==1){echo "selected"; }} ?> value="1">State President</option>
                      <option <?php if($id!='') { if($leader_single->featured==0){echo "selected"; }} ?> value="0">Leader</option>
                  </select>
                  
                </div> 

                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update Leader'; } else { echo 'Add Leader'; } ?></button>
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