<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Agent Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">
    <style>
        .form-control {
            padding: 0px 16px !important;
            border-radius: 50px !important;
            border: 1px solid #7a88a133 !important;
            height: 41px !important;
        }
        .btn-dark {
            padding: 0px 16px !important;
            border-radius: 50px !important;
            height: 41px !important;
        }
        label.error {
            color: #a94442 !important;
            font-weight: normal;
            margin-top: 4px;
            padding: 0px 15px;
          }
    </style>
    
</head>

<body class="h-100">
    


    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 mt-5">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="text-center" style="padding-bottom: 10px;">
                            <img src="<?php echo base_url('public/front/images/');?>logo.png" style="height: 100px;margin-bottom: 5px;">
                        </div>
                        <div class="card login-form mb-0">
                            <div class="card-body pt-2 ">
                                
                                <div class="text-center">
                                    <h3 style="margin-bottom: 15px;padding-top: 10px;">LOGIN</h3>
                                </div>

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
        
                                <form class="mb-1 login-input" id="login-form" method="post" autocomplete="off">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Account ID" name="account_id" id="account_id">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="User ID" name="username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <button class="btn btn-dark submit w-100 form-btn">LOGIN</button>
                                </form>
                                <div class="row" style="padding: 8px 17px 0px 17px;">
                                    <div class="col-md-6 col-6">  <p class=" login-form__footer"><a href="<?= base_url('agent/forgot-userid') ?>" class="text-primary" style="color: #76838f !important;"> Forgot User ID ?  </a> </p>
                                 </div>
                                 <div class="col-md-6 col-6 tar">
                                    <p class=" login-form__footer"><a href="<?= base_url('agent/forgot-password') ?>" class="text-primary" style="color: #76838f !important;"> Forgot Password ?  </a> </p>
                                </div>
                               
                            </div>

                        </div>
                        
                    </div><br>
                    <p class=" login-form__footer tac">Dont have account? <a style="color: #2b2a28 !important;font-weight: bold;" href="<?= base_url('agent/register') ?>" class="text-primary">Sign Up Now</a></p>
                    <hr>
                    <div class="row">
  <div class="col-md-4 col-4">
                            <p class="tac">Terms and policy</p>
                        </div>
                        <div class="col-md-4 col-4">
                            <p class="tac">Privacy policy</p>
                        </div>
                        <div class="col-md-4 col-4">
                            <p class="tac">Disclaimer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo base_url('public/admin/') ?>plugins/common/common.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>js/custom.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script>
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

 $("#login-form").validate({
    rules: {
        username: {
            required: true
        },
        password: {
            required: true
        }
    },
    messages: {
        username: {
            required: "Please enter username"
        },
        password: {
            required: "Please enter password"
        }
    },
    submitHandler: function(form) {
      var myform = document.getElementById("login-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/agent_login_process') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn").html("LOGIN").prop('disabled',false);

                if (obj.status=='success') {
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href="<?= ($this->input->get('redirect'))?$this->input->get('redirect'):base_url(AGENT_URL) ?>";
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("LOGIN").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".form-btn").html("Login").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
</script>
    

    
 





