<?php include('include/header.php'); ?>
<style type="text/css">
  .hgh{    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #cbc9c9;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Pdf List</h1>
          <p></p>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Pdf List</h3>
            <table id="dataTable" class="table table-bordered" style="text-align: center;">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Pdf Title</th>
                  <th>Pdf Date</th>
                  <th>Pdf File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php $i=0; foreach ($pdf as $key => $list) {  ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $list->news_pdf_title; ?></td>
                   <td><?php echo $list->news_pdf_date; ?></td>
                  <td><a class="btn btn-info btn-sm" target="_blank" href="<?php echo base_url('/public/front/pdf/'.$list->news_pdf_file); ?>">View</a></td>
                  <td><a href="<?php echo base_url(ADMIN_URL.'/news-pdf-single/'.$list->news_pdf_id); ?>"><i class="fa fa-edit"></i></a></td>
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