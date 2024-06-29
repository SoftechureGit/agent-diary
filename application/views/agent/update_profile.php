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

                <?php if($user_detail->no_of_sms<=500) { ?>

                <div class="alert alert-danger alert-dismissible fade show" style="padding-right: 15px;">
                    <div class="row">
                        <div class="col-md-9">
                            <?= $user_detail->no_of_sms ?> SMS Credits
                        </div>
                        <div class="col-md-3" align="right">
                      <a href="javascript:void(0)" class="btn btn-dark btn-sm" style="width: 80px;" title="Buy" onclick="alert('0 SMS Credits, please contact Admin')">Buy
                    </a> </div>
                    </div>
                </div>

                <?php } ?>
                
                <div class="row">
                    <div class="col-md-5">
                      

                      <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title">My Plan</h4>
                                    </div>
                                </div>
                                <div class="basic-form">

                                        <div class="form-row">

                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>Plan:</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= ($user_detail->plan_id==2)?'PRO':'Basic' ?>" disabled="">
                                            </div>

                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>No of User:</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= ($user_detail->no_of_user)?$user_detail->no_of_user:'' ?>" disabled="">
                                            </div>

                                            <?php if($user_detail->plan_id==2) { ?>
                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>Per User: (Rs)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= ($user_detail->per_user_amount)?$user_detail->per_user_amount:'' ?>" disabled="">
                                            </div>

                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>Mothly Cost: (Rs)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= ($user_detail->monthly_cost)?$user_detail->monthly_cost:'' ?>" disabled="">
                                            </div>

                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>Total Amount: (Rs)</label>
                                                <?php $amount = ($user_detail->no_of_user * $user_detail->per_user_amount) + $user_detail->monthly_cost; ?>
                                                <input type="text" class="form-control" placeholder="" value="<?= $amount ?>" disabled="">
                                            </div>
                                          <?php } ?>



                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>SMS Credits:</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= ($user_detail->no_of_sms)?$user_detail->no_of_sms:'0' ?>" disabled="">
                                            </div>


                                        </div>

                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title">Update Profile</h4>
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

                                            <div class="form-group col-md-6">
                                                <label>First Name:</label>
                                                <input type="text" class="form-control" placeholder="" id="first_name" name="first_name" value="<?= $user_detail->first_name ?>" required="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Last Name:</label>
                                                <input type="text" class="form-control" placeholder="" id="last_name" name="last_name" value="<?= $user_detail->last_name ?>" required="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Username:</label>
                                                <input type="text" class="form-control" placeholder="" id="username" name="username" value="<?= $user_detail->username ?>" disabled="">
                                            </div>

                                            <div class="form-group col-md-11 col-xs-11">
                                                <label>Email:</label>
                                                <input type="email" class="form-control" placeholder="" id="email" name="email" value="<?= $user_detail->email ?>" disabled="">
                                            </div>

                                            <div class="form-group col-md-1 col-xs-1">
                                                <label>&nbsp;</label>
                                                <?php if($user_detail->email_verify) { ?>
                                                    <div style="font-size: 20px;text-align: center;margin-top: 2px;">
                                                    <span style="cursor: pointer;" class="fa fa-check-circle-o text-success" title="Email Verified"></span>
                                                    </div>
                                                <?php } ?>
                                                
                                            </div>

                                            <div class="form-group col-md-11 col-xs-11">
                                                <label>Mobile:</label>
                                                <input type="text" class="form-control" placeholder="" id="mobile" name="mobile" value="<?= $user_detail->mobile ?>" disabled="">
                                            </div>

                                            <div class="form-group col-md-1 col-xs-1">
                                                <label>&nbsp;</label>
                                                <?php if($user_detail->mobile_verify) { ?>
                                                    <div style="font-size: 20px;text-align: center;margin-top: 2px;">
                                                    <span style="cursor: pointer;" class="fa fa-check-circle-o text-success" title="Mobile Verified"></span>
                                                    </div>
                                                <?php } else { ?>
                                                    <div style="margin-top: 7px;">
                                                        <a class="text-info"  title="Verify Your Mobile Number" href="javascript:void()" onclick="get_verify_mobile_otp()">Verify</a>
                                                    </div>
                                                <?php } ?>
                                                
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

<!-- modal form -->
<div class="modal fade" id="formModal" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" budget="document">
        <div class="modal-content">

            <form id="md-form-main" method="post">
                <input type="hidden" class="form-control" id="fid" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Verify Mobile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="md-error-msg"></div>
                    <div><p class="msg"></p></div>
                    <div class="form-group">
                        <label for="mobile_otp" class="col-form-label">OTP:</label>
                        <input type="text" class="form-control" id="mobile_otp" name="mobile_otp" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success md-form-btn wd-100">Verify</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end -->

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
        url: "<?= base_url(AGENT_URL.'api/update_profile') ?>",
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

 function get_verify_mobile_otp() {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(AGENT_URL.'api/get_verify_mobile_otp'); ?>",
    data: {id:1},
    success: function (response) {
      setTimeout(function() {
       

        var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                   $("#formModal").modal('show');
                   $(".msg").html(obj.message);
                }
                else {
                  alert(obj.message);
                }
              }
              catch(err) {
                alert('Some Error Occured.');
              }

      },100);
    },
    error: function () {
      alert('Some Error Occured.');
    }

  });
  }

  $("#md-form-main").validate({
    rules: {
        mobile_otp: {
            required: true
        }
    },
    messages: {
        mobile_otp: {
            required: "Please Enter OTP"
        }
    },
    submitHandler: function(form) {

      var myform = document.getElementById("md-form-main");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/verify_mobile') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".md-error-msg").html('');
          $(".md-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".md-form-btn").html("Verify");

                if (obj.status=='success') {
                    window.location.href='';
                  //$(".error-msg").html(alertMessage('success',obj.message));
                }
                else {
                  $(".md-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".md-form-btn").html("Verify");
                $(".md-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
          $(".md-form-btn").html("Verify");
          $(".md-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
</script>