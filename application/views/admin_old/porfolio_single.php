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
          <h1>Event</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update Courses'; } else { echo 'Add Courses'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/portfolio_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data">

                <div class="form-group">
                  <label class="control-label">Courses Title</label>
                  <input type="text" class="form-control" name="event_title" value="<?php if($id!='') { echo $portfolio_single->event_title; } ?>">
                </div>
                 <div class="form-group">
                  <label class="control-label">Courses Url</label>
                  <input type="text" class="form-control" name="event_url" value="<?php if($id!='') { echo $portfolio_single->event_url; } ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Courses Description</label>
                  <textarea class="form-control textarea" name="event_description" rows="6"><?php if($id){echo $portfolio_single->event_description;}?></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Upload Image For Courses :</label>
                  <input type="file" class="form-control" name="image" value="">
                  <input type="hidden" name="old_image" value="<?php if($id){echo $portfolio_single->event_image;} ?>">
                </div>
                <div class="form-group">
                  <div class="row">
                    
                  <div class="col-md-6">
                    <label class="control-label">Courses Time</label>
                     <input type="time" class="form-control" name="event_time" value="<?php if($id){echo $portfolio_single->event_time;} ?>">
                  </div>
                
                 
                  </div>
                </div>
                
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update'; } else { echo 'Add'; } ?> Event</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        </div>
    </div>
    </main>
    <script>
function myFunction() {
    var x = document.getElementById("pass").value;
    var y = document.getElementById("cpass").value;
    if(x = y){
      document.getElementById('pass').style.border="2px solid red";
      document.getElementById('cpass').style.border="2px solid red";
      return false;
    }else{
      document.getElementById('pass').style.border="2px green red";
      document.getElementById('cpass').style.border="2px green red";
      return true;
    }
}
</script>
<?php include('include/footer.php'); ?>