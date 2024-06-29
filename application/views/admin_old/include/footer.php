 
 <script src="<?php echo base_url('public/admin/js/') ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url('public/admin/js/') ?>popper.min.js"></script>
    <script src="<?php echo base_url('public/admin/js/') ?>bootstrap.min.js"></script>
    <script src="<?php echo base_url('public/admin/js/') ?>main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url('public/admin/js/') ?>plugins/pace.min.js"></script>
    <script src="<?php echo base_url('public/admin/js/') ?>plugins/sweetalert.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/') ?>plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/') ?>plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
     <script type="text/javascript" src="<?php echo base_url('public/admin/js/') ?>plugins/select2.min.js"></script>
 <script type="text/javascript">
      $('#sl').click(function(){
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({ text : "Signing In"});
      });
      
      $('#el').click(function(){
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({ html : "Sign In"});
      });
      
      
      $('#demoSelect').select2();
    </script>
    <!-- Google analytics script-->
  <script type="text/javascript" src="<?php echo base_url('public/admin/js/') ?>plugins/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url('public/admin/js/') ?>plugins/bootstrap-datepicker.min.js"></script>
     <script type="text/javascript">
      $('#sl').click(function(){
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({ text : "Signing In"});
      });
      
      $('#el').click(function(){
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({ html : "Sign In"});
      });
      
      $('#demoDate').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
      });
      
      $('#demoSelect').select2();
    </script>
<!-- Essential javascripts for application to work-->
  </body>
</html>