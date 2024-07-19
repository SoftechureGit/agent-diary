<!DOCTYPE html>
<html lang="en">

<head>
  <title>Karnisena</title>
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('public/front/');?>login/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('public/front/');?>login/style.css" rel="stylesheet">
  
</head>

<body style="background:url('<?php echo base_url('public/front/login/loginback.jpg') ?>');background-repeat: no-repeat;background-size: 130%;">
  <div id="login-page">
    <div class="container">



<?php
$success_msg= $this->session->flashdata('success_msg');
$error_msg= $this->session->flashdata('error_msg');
if($success_msg){
?>
<div class="alert alert-success">
<?php echo $success_msg; ?>
 </div>
<?php
}
if($error_msg){
?>
<div class="alert alert-danger text-center">
 <?php echo $error_msg; ?>
</div>
<?php
}
?> 
      <form class="form-login" method="post" action="<?php echo base_url('login_check');?>">
        <h2 class="form-login-heading">Log in</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" placeholder="Username" autofocus name="username">
          <br>
          <input type="password" class="form-control" placeholder="Password" name="password">
          <label class="checkbox">
            &nbsp;
            <span class="pull-right">
            &nbsp;
            </span>
            </label>
          <button class="btn btn-theme btn-block" type="submit"> LOG IN</button>
         
      </form>



    </div>
  </div>
  <script src="<?php echo base_url('public/front/');?>login/jquery.min.js"></script>
  <script src="<?php echo base_url('public/front/');?>login/bootstrap.min.js"></script>
</body>

</html>
