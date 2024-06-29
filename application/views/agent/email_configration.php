<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
    margin-top: 10px;
}
}
</style>

<?php include('include/sidebar.php');?>

        <!-- content body start -->
        <div class="content-body">

            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title">EMAIL Configration</h4>
                                    </div>
                                </div>
                                <div class="basic-form">


                                    <div class="error-msg">
                                              <?php if($this->session->flashdata('error_msg')) { ?>
                                                <div class="alert alert-danger pd8">
                                                  <?php echo $this->session->flashdata('error_msg'); ?>
                                                </div>
                                              <?php } ?>
                                              <?php if($this->session->flashdata('success_msg')) { ?>
                                                <div class="alert alert-success pd8">
                                                  <?php echo $this->session->flashdata('success_msg'); ?>
                                                </div>
                                              <?php } ?>

                                    </div>

                                    <form id="form-main" method="post">
                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label>Email:</label>
                                                <input type="text" class="form-control" placeholder="" id="mail_username" name="mail_username" value="<?= $user_detail->mail_username ?>">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Password:</label>
                                                <input type="text" class="form-control" placeholder="" id="mail_password" name="mail_password" value="<?= $user_detail->mail_password ?>">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-dark btn-md btn-block form-btn mt-2">Update</button>
                                    </form>
                                    
                                    <div>
                                        <p><h4>Enable Less secure app access</h4></p>
                                        <p><b>Step 1 : </b> Sign in to Google Account</p>
                                        <p><b>Step 2 : </b> Click the below link <a style='color:#2e28f6;' href='https://myaccount.google.com/lesssecureapps' target="_blank">https://myaccount.google.com/lesssecureapps</a> </p>
                                        <p><b>Step 3 :</b> Next to "Access for less secure apps," select Turn on</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content body end -->



 <?php include('include/footer.php');?>
 <!-- include jquery validation -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}
 
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, ""); 

 $("#form-main").validate({
    rules: {
    },
    messages: {
        
    },
    submitHandler: function(form) {

      var myform = document.getElementById("form-main");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/update_email_configration') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn").html("Update");

                if (obj.status=='success') {
                  $(".error-msg").html(alertMessage('success',obj.message));
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("Update");
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
          $(".form-btn").html("Update");
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

</script>