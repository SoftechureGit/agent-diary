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
          <h1>News</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update News'; } else { echo 'Add News'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/news_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data">

                <div class="form-group">
                  <label class="control-label">News Title</label>
                  <input type="text" class="form-control" name="news_title" required value="<?php if($id!='') { echo $news_single->news_title; } ?>">
                </div>
                 <div class="form-group">
                  <label class="control-label">News Url</label>
                  <input type="text" class="form-control" name="news_url" required value="<?php if($id!='') { echo $news_single->news_url; } ?>">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                    <label class="control-label">News Category</label>
                      <select class="form-control" required name="news_category">
                        <option disabled  selected> Choose News Category</option>
                        <?php foreach ($news_cat as $key => $value) {?>
                          <option <?php if($id){if($news_single->category==$value->news_cat_id){echo "selected";}} ?>  value="<?php echo $value->news_cat_id; ?>"><?php echo $value->category_title; ?></option>
                        <?php } ?>
                      </select>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Popular News</label><br>
                      <input type="checkbox" <?php if($id){if($news_single->popular==1){echo "checked";}} ?> name="popular" value="1">
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">News Description</label>
                  <textarea class="form-control textarea" name="news_desc" rows="6"><?php if($id){echo $news_single->news_content;}?></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">News Image</label>
                  <input type="file" class="form-control" name="news_image" value="">
                  <input type="hidden" name="old_image" value="<?php if($id){echo $news_single->news_image;} ?>">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                    <label class="control-label">Meta title</label>
                      <textarea class="form-control" name="meta_title" rows="3"><?php if($id){echo $news_single->meta_title;} ?></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Meta Description</label><br>
                      <textarea class="form-control" name="meta_desc" rows="3"><?php if($id){echo $news_single->meta_description;} ?></textarea>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Meta Keywords</label>
                      <textarea class="form-control" name="keywords" rows="3"><?php if($id){echo $news_single->keywords;} ?></textarea>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                    <label class="control-label">Robots - index, follow</label>
                      <input type="text" class="form-control" name="robots" value="<?php if($id){echo $news_single->robots;} ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">News Tag</label><br>
                      <input type="text" class="form-control" name="news_tag" value="<?php if($id){echo $news_single->tag;} ?>">
                  </div>
                  </div>
                </div>
                 <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                    <label class="control-label">News Status</label>
                      <select class="form-control" required name="news_status">
                        <option disabled  selected> Choose News Status</option>
                       <option <?php if($id){if($news_single->news_status=='publish'){echo "selected";}} ?> value="publish">Publish</option>
                       <option<?php if($id){if($news_single->news_status=='draft'){echo "selected";}} ?> value="draft">Draft</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Comment Status</label><br>
                     <select class="form-control" required name="comment_status">
                        <option disabled  selected> Choose Comment Status</option>
                       <option <?php if($id){if($news_single->comment_status=='open'){echo "selected";}} ?> value="open">Open</option>
                       <option <?php if($id){if($news_single->comment_status=='closed'){echo "selected";}} ?> value="closed">Closed</option>
                      </select>
                  </div>
                  </div>
                </div>
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update News'; } else { echo 'Add News'; } ?></button>
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