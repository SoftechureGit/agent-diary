<?php include('include/header.php'); ?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
         <a style="float: right;" href="<?php echo base_url(ADMIN_URL.'/add-comment/'.$id); ?>" class="btn btn-primary">Add Comment</a>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Comment List</h3>
            <table id="dataTable" class="table table-bordered" style="text-align: center;">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>News Title</th>
                  <th>Commented By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php $i=0; foreach ($news_list as $key => $list) {  ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $list['news_title']; ?></td>
                  <td><?php echo $list['commented_by']; ?></td>
                  <td><a href="<?php echo base_url(ADMIN_URL.'/update-comment/'.$list['comment_id']); ?>"><i class="fa fa-edit"></i></a> </td>
                </tr>
              <?php $i++; } ?>
              </tbody>
            </table>
          </div>
    </div>
    </main>
<?php include('include/footer.php'); ?>
<script type="text/javascript">$('#dataTable').DataTable();</script>
