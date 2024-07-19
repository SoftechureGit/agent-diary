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
          <h1>Update Comment</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Update Comment</h3>
                    <div class="col-md-12">
                        <form method="post" action="<?php echo base_url(ADMIN_URL.'/event-comment-query/'.$id) ;?>">
                           <div class="row">
                            <div class="form-group col-md-6">
                            <label for="cat_name">Commenter Name</label>
                            <input type="hidden" name="news_id" placeholder="" value="<?php if($id){ echo $comment_single->event_id;}elseif($news_id){echo $news_id;} ?>" class="form-control">
                            <input type="text" name="commented_by" placeholder="Your Name" value="<?php if($id){ echo $comment_single->commented_by; } ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="cat_name">Commenter Email</label>
                            <input type="email" name="commenter_email" placeholder="Email" value="<?php if($id){ echo $comment_single->commenter_email;} ?>" class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                  <label class="control-label">Comment Description</label>
                  <textarea class="form-control textarea" name="comment_content" rows="6"><?php if($id){ echo $comment_single->comment_content;} ?></textarea>
                </div>
                             
                            <div class="form-group col-md-6">
                                <label for="Main Image">Commenter Url</label>
                                  <input type="text" name="commenter_url" value="<?php if($id){ echo $comment_single->commenter_url;} ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Main Image">Comment Parent</label>
                                  <input type="text" name="comment_parent" value="<?php if($id){ echo $comment_single->comment_parent;} ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Main Image">Comment Date</label>
                                  <input type="date" name="comment_date" value="<?php if($id){ echo $comment_single->comment_date;} ?>" class="form-control">
                            </div>
                              <div class="form-group col-md-6">
                                <label for="Main Image">Comment Approve</label><br>
                                <select name="comment_approved" class="form-control">
                                    <option <?php if($id){if($comment_single->comment_approved==0){echo "selected";}} ?> value="0">Un Approved</option>
                                    <option <?php if($id){if($comment_single->comment_approved==1){echo "selected";}} ?> value="1">Approved</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12" align="left">
                                 <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Comment</button>
                            </div>
                             </div>
                        </form>                    
                   
                </div>
          </div>
    </div>
    </main>
<?php include('include/footer.php'); ?>
<script type="text/javascript">$('#dataTable').DataTable();</script>
