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
          <h1>News Pdf</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title"><?php if($id) { echo 'Update Pdf'; } else { echo 'Add Pdf'; } ?></h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
              <form  class="form" method="post" action="<?php echo base_url(ADMIN_URL.'/pdf_query'); ?><?php if($id!='') { echo '/'.$id; } ?>" enctype="multipart/form-data">

                
                 <div class="form-group">
                  <label class="control-label">Pdf Title</label>
                  <input type="text" required class="form-control" name="news_pdf_title" value="<?php if($id!='') { echo $pdf->news_pdf_title; } ?>">
                </div>
                <div class="form-group">
                  <div class="row">
                   <div class="form-group col-md-12">
                    <br>
                  <label class="control-label">New Pdf File</label>
                  <input type="file" class="form-control" name="news_pdf_file" value="">
                  <input type="hidden" name="news_pdf_file_old" value="<?php if($id){echo $pdf->news_pdf_file;} ?>">
                  <?php if($id && $pdf->news_pdf_file){
                    echo "<a class='btn btn-info btn-sm' href='".base_url('public/front/pdf/'.$pdf->news_pdf_file)."' target='_blank'>View File</a>";
                  } ?>
                </div>
                 
                  </div>
                </div>  
                 <div class="form-group">
                  <label class="control-label">Pdf Date</label>
                  <input type="date" required class="form-control" name="news_pdf_date" value="<?php if($id!='') { echo $pdf->news_pdf_date; } ?>">
                </div>
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?php if($id) { echo 'Update Pdf'; } else { echo 'Add Pdf'; } ?></button>
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