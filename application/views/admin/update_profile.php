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
                                        <h4 class="card-title">Update Profile</h4>
                                    </div>
                                </div>
                                <div class="basic-form">


                                    <div class="error-msg"></div>

                                    <form id="form-main" method="post">
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>First Name:</label>
                                                <input type="text" class="form-control" placeholder="" id="first_name" name="first_name" value="<?= $user_detail->first_name ?>" required="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Last Name:</label>
                                                <input type="text" class="form-control" placeholder="" id="last_name" name="last_name" value="<?= $user_detail->last_name ?>" required="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Username:</label>
                                                <input type="text" class="form-control" placeholder="" id="username" name="username" value="<?= $user_detail->username ?>" disabled="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Email:</label>
                                                <input type="email" class="form-control" placeholder="" id="email" name="email" value="<?= $user_detail->email ?>" disabled="">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-dark btn-md btn-block form-btn mt-2">Update</button>
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
 
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, ""); 

 $("#form-main").validate({
    rules: {
        first_name: {
            required: true,
            lettersonly: true
        },
        last_name: {
            required: true,
            lettersonly: true
        }
    },
    messages: {
        first_name: {
            required: "Please Enter First Name",
            lettersonly:"Please Enter Letters and Spaces Only"
        },
        last_name: {
            required: "Please Enter Last Name",
            lettersonly:"Please Enter Letters and Spaces Only"
        }
    },
    submitHandler: function(form) {

      var myform = document.getElementById("form-main");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/update_profile') ?>",
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