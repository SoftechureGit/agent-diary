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
         
          <a href="<?php echo base_url(ADMIN_URL.'/addslider'); ?>" class="btn btn-primary">Add Slide</a>
         
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="tile">
            <h3 class="tile-title">Slider List</h3>

            <?php if($this->session->flashdata('success_msg')) { ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>

            <div class="tile-body">
                 <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Alt Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($home_slider as $row)
                                        {
                                        
                                        ?>
                                            <tr>
                                                <td><img src="<?php echo base_url('public/front/slider/'.$row->slide_image)?>" style="width:200px;height:100px;"></td>
                                                <td><?php echo $row->slide_title; ?></td>
                                                <td><?php echo anchor(ADMIN_URL."/editslider/".$row->slide_id,'<i class="fa fa-edit" aria-hidden="true"></i>',array('style'=>"font-size: 21px;",'title'=>"Edit"));?>
                         &nbsp;&nbsp;&nbsp;&nbsp;<?php //echo anchor("mtadmin/action/slide_delete_entry/".$row->slide_id,'<i class="fa fa-trash" aria-hidden="true"></i> ',array('onclick' => "return confirm('Do you want delete this record')",'style'=>"font-size: 21px;",'title'=>"Delete"));?></td>
                                            </tr>
<?php }  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        </div>
    </div>
    </main>
<?php include('include/footer.php'); ?>