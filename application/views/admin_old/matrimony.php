<?php include('include/header.php'); ?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Matrimony List</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Matrimony List</h3>
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered" style="text-align: center;">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Marital Status</th>
                    <th>Profile</th>
                    <th>Religion</th>
                    <th>Subcaste</th>
                    <th>Mother Tongue</th>
                    <th>Country</th>
                    <th>Created</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $i=0; foreach ($users as $key => $list) {  ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $list->name; ?></td>
                    <td><?php echo $list->mobile_no; ?></td>
                    <td><?php echo $list->email; ?></td>
                    <td><?php echo $list->gender; ?></td>
                    <td><?php echo $list->dob; ?></td>
                    <td><?php echo $list->marital_status; ?></td>
                    <td><?php echo $list->profile; ?></td>
                    <td><?php echo $list->religion; ?></td>
                    <td><?php echo $list->subcaste; ?></td>
                    <td><?php echo $list->mother_tongue; ?></td>
                    <td><?php echo $list->country; ?></td>
                    <td><?php echo $list->created_at; ?></td>
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