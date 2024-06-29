<?php include('include/header.php'); ?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Courses List</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Courses List</h3>
            <table id="dataTable" class="table table-bordered" style="text-align: center;">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Event Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php $i=0; foreach ($event_list as $key => $list) { $i++; ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $list->event_title; ?></td>
                  <td><a href="<?php echo base_url(ADMIN_URL.'/add_courses/'.$list->event_id); ?>"><i class="fa fa-edit"></i></a> | <a onclick="confirmDelete('<?php echo base_url(ADMIN_URL.'/portfolio_remove/'.$list->event_id); ?>')"><i class="fa fa-trash"></i></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
    </div>
    </main>
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
</script>