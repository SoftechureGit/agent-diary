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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title">Change Password</h4>
                                    </div>
                                </div>
                                <div class="basic-form">


                                    <div class="error-msg"></div>

                                    <form id="form-main" method="post">
                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label>Current Password:</label>
                                                <input type="password" class="form-control" placeholder="" id="current_password" name="current_password">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>New Password:</label>
                                                <input type="password" class="form-control" placeholder="" id="password" name="password">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Confirm Password:</label>
                                                <input type="password" class="form-control" placeholder="" id="confirm_password" name="confirm_password">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-dark btn-md btn-block form-btn mt-2">Update Password</button>
                                    </form>

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

 $("#form-main").validate({
    rules: {
        current_password: { required: true },
        password: { 
            required: true,
            minlength:  8,
            maxlength: 32
        },
        confirm_password: { 
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        current_password: { required: "Enter Your Current Password" },
        password: { 
            required: "Enter New Password"
        },
        confirm_password: "Please Confirm New Password"
    },
    submitHandler: function(form) {

      var myform = document.getElementById("form-main");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/update_password') ?>",
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
                $(".form-btn").html("Update Password");

                if (obj.status=='success') {
                  $("#form-main input").val('');
                  $(".error-msg").html(alertMessage('success',obj.message));
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("Update Password");
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
          $(".form-btn").html("Update Password");
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
</script>