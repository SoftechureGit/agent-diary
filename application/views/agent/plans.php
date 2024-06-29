<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Plans</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">
    <link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">
    <style>
        label.error {
            color: #a94442;
            font-weight: normal;
            margin-top: 4px;
          }
    </style>
    
</head>

<body class="h-100">
    

<div class="login-form-bg">
    <div class="container h-100">
        <div class="row justify-content-center h-100 mt-5">
            <div class="col-xl-10">
                <div class="form-input-content">

                    <div class="text-center" style="padding-bottom: 30px;">
                        <h1>Plans</h1>
                    </div>


                    
                    <div class="container-fluid">
                <div class="row equal1">
                    <div class="col-md-12">

                <?php if($is_trial && $trial_expired) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="row">
                        <div class="col-md-9">
                            Your trial has ended.
                        </div>
                        <div class="col-md-3" align="right"> </div>
                    </div>
                </div>
                <?php } else if($is_trial && $expire_today) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="row">
                        <div class="col-md-9">
                            Your trial expires today 11:59:00 PM
                        </div>
                        <div class="col-md-3" align="right"> </div>
                    </div>
                </div>
                <?php } else if($is_trial && !$trial_expired) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="row">
                        <div class="col-md-9">
                            Your trial expires in <?= $trial_remaining_days ?> days
                        </div>
                        <div class="col-md-3" align="right"> </div>
                    </div>
                </div>
                <?php } else if(!$is_trial && $expire_today && $first_payment) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="row">
                        <div class="col-md-9">
                            Your plan expires today 11:59:00 PM
                        </div>
                        <div class="col-md-3" align="right"> </div>
                    </div>
                </div>
                <?php } else if(!$is_trial && $first_payment && $trial_remaining_days && $trial_remaining_days<=10) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="row">
                        <div class="col-md-9">
                            Your plan expires in <?= $trial_remaining_days ?> days
                        </div>
                        <div class="col-md-3" align="right"> </div>
                    </div>
                </div>
                <?php } else if(!$is_trial && $first_payment && $trial_remaining_days==0) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="row">
                        <div class="col-md-9">
                            Your plan has expired. Please update your payment details to reactive it.
                        </div>
                        <div class="col-md-3" align="right"></div>
                    </div>
                </div>
                <?php } ?>

                    </div>
                    <?php foreach ($plans as $row) { ?>
                    <div class="col-md-6">
                        <div class="card" style="min-height: 300px;">
                            <div class="card-body" align="center">
                                <h2 class="text-center"><?= $row->plan_name ?></h2>
                                <?php if(!$row->trial_days) { ?>
                                    <h5 class="text-center text-dark">Rs. <?= $row->per_user_amount ?> / Per User</h5>
                                <?php } else { ?>
                                    <h5 class="text-center text-dark">No of User: 1</h5>
                                    <h5 class="text-center text-dark">Trial Days: 7</h5>
                                <?php } ?>
                                <?php if(!$row->trial_days) { ?>

                                    <form method="post" action="<?= base_url(AGENT_URL.'pay') ?>" id="accociate-form" enctype="multipart/form-data">
                                        <div class="mt-4">
                                            <input type="text" class="form-control" placeholder="Enter no of user" id="no_of_user" name="no_of_user" value="<?= $user_detail->no_of_user ?>" required="" maxlength="3" style="width: 50%;">
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn mb-1 btn-primary">BUY <span class="btn-icon-right"><i class="fa fa-shopping-cart"></i></span>
                                            </button>
                                        </div>
                                    </form>
                                <?php } else { ?>
                                    <!--<button type="button" class="btn mb-1 btn-danger"><?= ($trial_expired)?"Expired":"Expires in ".$trial_remaining_days." days" ?>
                                    </button>-->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('public/admin/') ?>plugins/common/common.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>js/custom.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

 $("#accociate-form").validate({
    rules: {
        no_of_user:{
            required:true,
            digits: true,
            min: 1,
            max: 100
        }
    },
    messages: {
        no_of_user: {
            "required":"Enter No of User",
            "digits":"Enter No of User"
        }
    },
    submitHandler: function(form) {

        form.submit();

      /*var myform = document.getElementById("accociate-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/associate_save') ?>",
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
                $(".form-btn").html("Save").prop('disabled',false);

                if (obj.status=='success') {
                  //$(".error-msg").html(alertMessage('success',obj.message));

                  //window.location.href='<?= base_url(AGENT_URL.'login?as=1') ?>';
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("Save").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".form-btn").html("Save").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });*/

    }
});
</script>

</body>
</html>