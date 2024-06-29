<?php include('include/header.php'); ?>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/tinymce/jquery.tinymce.min"></script>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
    .ks-show {
      display: block;
    }
    .ks-hide {
      display: none;
    }
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Video</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update Video'; } else { echo 'Add Video'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>
            <?php if($this->session->flashdata('error_msg')) { ?>
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('error_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/video_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data" autocomplete="off">

                
              <div class="form-group">
                <label class="control-label">Video Title</label>
                <input type="text" required class="form-control" name="video_title" value="<?php if($id!='') { echo $video_single->video_title; } ?>">
              </div>

              <div class="form-group">
                <label class="control-label">Video Type</label>
                <select class="form-control" id="video_type" name="video_type" onchange="videoType()" required>
                  <option value="">Select Video Type</option>
                  <option value="1" <?php if($id && $video_single->video_type==1) { echo 'selected'; } ?> >Video</option>
                  <option value="2" <?php if($id && $video_single->video_type==2) { echo 'selected'; } ?> >Youtube</option>
                </select>
              </div>

                <div class="form-group ks-hide input-video">
                  <label class="control-label">Video</label>
                  <input type="file" class="form-control" name="video">
                  <input type="hidden" name="old_video" value="<?php if($id){echo $video_single->video;} ?>">
                  <?php if($id){if($video_single->video){ ?>
                  <div>
                    <video width="320" height="240" controls>
                      <source src="<?php echo base_url('public/front/video/'.$video_single->video) ?>" type="video/mp4">
                      <source src="<?php echo base_url('public/front/video/'.$video_single->video) ?>" type="video/ogg">
                    Your browser does not support the video tag.
                    </video>
                    </div>
                  <?php }} ?>
                </div>

                <div class="form-group ks-hide input-video">
                  <label class="control-label">Video Thumbnail</label>
                  <input type="file" class="form-control" name="video_thumbnail">
                  <input type="hidden" name="old_video_thumbnail" value="<?php if($id){echo $video_single->video_thumbnail;} ?>">
                  <?php if($id){if($video_single->video_thumbnail){ ?>
                  <div>
                    <img style="width: 120px;height: 100px;margin-top: 10px;" src="<?php echo base_url('public/front/video-thumbnail/'.$video_single->video_thumbnail) ?>">
                    </div>
                  <?php }} ?>
                </div>

                <div class="form-group ks-hide input-youtube">
                  <label class="control-label">Youtube</label>
                  <input type="text" class="form-control" name="youtube_url" placeholder="Enter Youtube URL" value="<?php if($id!='') { echo $video_single->youtube_url; } ?>">
                  <?php 

                  function get_youtube_id_from_url($url)
                  {
                      if (stristr($url,'youtu.be/'))
                          {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
                      else 
                          {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
                  }

                  if($id){if($video_single->youtube_url){ ?>
                  <div style="padding-top:10px;">
                  <iframe width="420" height="315"
                  src="https://www.youtube.com/embed/<?= get_youtube_id_from_url($video_single->youtube_url) ?>">
                  </iframe>
                  </div>
                  <?php }} ?>
                </div>

                <div class="form-group">
                  <label class="control-label">Status</label>
                  <select class="form-control" id="video_status" name="video_status" onchange="videoType()" required >
                    <option value="1" <?php if($id && $video_single->video_status==1) { echo 'selected'; } ?> >Active</option>
                    <option value="0" <?php if($id && $video_single->video_status==0) { echo 'selected'; } ?> >Deactive</option>
                  </select>
                </div>

                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update Video'; } else { echo 'Add Video'; } ?></button>
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

<script>
videoType();
function videoType() {
 var video_type = $("#video_type").val();
 if (video_type==1) {
  $(".input-video").show();
  $(".input-youtube").hide();
 }
 else if (video_type==2) {
  $(".input-video").hide();
  $(".input-youtube").show();
 }
 else {
  $(".input-video").hide();
  $(".input-youtube").hide();
 }
}
</script>