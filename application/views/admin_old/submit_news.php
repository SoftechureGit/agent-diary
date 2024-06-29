<?php include('include/header.php'); ?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Submit News</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"></h3>
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered" style="text-align: center;">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Place</th>
                    <th>Description</th>
                    <th>Attach File</th>
                    <th>Created</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $i=0; foreach ($users as $key => $list) {  ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $list->name; ?></td>
                    <td><?php echo $list->mobile; ?></td>
                    <td><?php echo $list->place; ?></td>
                    <td><?php echo $list->description; ?></td>
                    <td><?php if($list->attach_file) { ?><a class="btn btn-info btn-sm" target="_blank" href="<?php echo base_url('/public/front/attachements/'.$list->attach_file); ?>">View</a><?php } ?></td>
                    <td><?php echo $list->created; ?></td>
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