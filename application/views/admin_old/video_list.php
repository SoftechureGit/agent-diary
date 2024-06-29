<?php include('include/header.php');
function get_youtube_id_from_url($url)
{
    if (stristr($url,'youtu.be/'))
        {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
    else 
        {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
}
?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
    .btn-label {
      padding:2px 10px;border-radius:20px;
    }
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Video List</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Video List</h3>

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

            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered" style="text-align: center;">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Video</th>
                    <th>Video Thumbnail</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $i=0; foreach ($video_list as $key => $list) {  ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $list->video_title; ?></td>
                    <td><?php if($list->video_type==1)  { echo "<span class='btn btn-info btn-sm btn-label'>Video</span>"; } else if($list->video_type==2)  { echo "<span class='btn btn-danger btn-label'>Youtube</span>"; } ?></td>
                    <td>
                      <?php if($list->video_type==1)  { ?>
                        <button class="btn btn-warning btn-label" onclick="playVideo('<?php echo $list->video_type; ?>','<?php if($list->video_type==1) { echo $list->video; } else if($list->video_type==2) { echo get_youtube_id_from_url($list->youtube_url); } ?>')"><i class="fa fa-play-circle"></i>Play</button>
                      <?php } else if($list->video_type==2)  { ?>
                        <button class="btn btn-warning btn-label" onclick="playVideo('<?php echo $list->video_type; ?>','<?php if($list->video_type==1) { echo $list->video; } else if($list->video_type==2) { echo get_youtube_id_from_url($list->youtube_url); } ?>')"><i class="fa fa-play-circle"></i>Play</button>
                      <?php } ?>                  </td>
                    <td>
                      <?php if($list->video_thumbnail){ ?>
                      <img style="width: 60px;height: 60px;" src="<?php echo base_url('public/front/video-thumbnail/'.$list->video_thumbnail) ?>">
                        <?php } ?>
                      </td>
                    <td><?php if($list->video_status==1)  { echo "<span class='btn btn-success btn-label'>Active</span>"; } else { echo "<span class='btn btn-danger btn-label'>Deactive</span>"; } ?></td>
                    <td><?php echo $list->created; ?></td>
                    <td><a href="<?php echo base_url(ADMIN_URL.'/video-single/'.$list->video_id); ?>"><i class="fa fa-edit"></i></a></td>
                  </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
    </div>
    </main>

<!-- Modal -->
<div id="modalVideo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">

        <video id="play-vd" width="100%" height="315" controls>
          <source src="" type="video/mp4">
          <source src="" type="video/ogg">
        Your browser does not support the video tag.
        </video>

        <iframe id="play-yt" width="100%" height="315"
        src="">
        </iframe>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php include('include/footer.php'); ?>
<script type="text/javascript">$('#dataTable').DataTable();</script>
<script>
  function confirmDelete(url) {
    swal({
          title: "Are you sure?",
          //text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          closeOnConfirm: false,
          closeOnCancel: true
        }, function(isConfirm) {
          if (isConfirm) {
            window.location.href=url;
          } 
        });
  }

  function playVideo(type,url) {
    $("#modalVideo").modal('show');

    if (type==1) {
      var u = "<?php echo base_url('public/front/video/'); ?>"+url;
      $("#play-yt").hide();
      $("#play-vd").show();
      $("#play-vd").attr("src", u)
    }
    else if (type==2) {
      var u = "https://www.youtube.com/embed/"+url;
      $("#play-vd").hide();
      $("#play-yt").attr('src',u); 
      $("#play-yt").show();
    }
    else {
      $("#play-vd").hide();
      $("#play-yt").hide();
    }
  }
</script>