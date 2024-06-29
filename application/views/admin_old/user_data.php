n<?php include('include/header.php'); ?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>User List</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">User List</h3>
            <table id="dataTable" class="table table-bordered" style="text-align: center;">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>User Message</th>
                  <th>Contact Date</th>
                </tr>
              </thead>
              <tbody>
                 <?php $i=0; foreach ($users as $key => $list) {  ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $list->contact_name; ?></td>
                  <td><?php echo $list->contact_email; ?></td>
                  <td><?php echo $list->contact_message; ?></td>
                  <td><?php echo $list->contact_date ?></td>
                </tr>
              <?php $i++; } ?>
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