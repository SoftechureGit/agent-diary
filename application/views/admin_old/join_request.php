<?php include('include/header.php'); ?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Join Request List</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Join Request List</h3>
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered" style="text-align: center;">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Village</th>
                    <th>Thasil</th>
                    <th>Constituency</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $i=0; foreach ($users as $key => $list) {  ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $list->user_name; ?></td>
                    <td><?php echo $list->user_guardian; ?></td>
                    <td><?php echo $list->user_dob; ?></td>
                    <td><?php echo $list->user_gender; ?></td>
                    <td><?php echo $list->user_mobile; ?></td>
                    <td><?php echo $list->user_email; ?></td>
                    <td><?php echo $list->user_state; ?></td>
                    <td><?php echo $list->user_city; ?></td>
                    <td><?php echo $list->user_village; ?></td>
                    <td><?php echo $list->user_thasil; ?></td>
                    <td><?php echo $list->user_constituency; ?></td>
                    <td><?php echo $list->user_address; ?></td>
                  </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
            </div>
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