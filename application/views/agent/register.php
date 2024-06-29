
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">

    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    


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


/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}
span.help-block {
  color: #a94442;
  font-weight: normal;
  margin-top: 5px;
  text-align: left !important;
  display: block;
  padding: 0px 15px !important;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}


</style>
<body>


    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 mt-5">
                <div class="col-xl-6">
                    <div class="form-input-content">

                        <div class="text-center" style="padding-bottom: 10px;">
                            <img src="<?php echo base_url('public/front/images/');?>logo.png" style="height: 100px;margin-bottom: 5px;">
                        </div>
                        
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 pb-10 ">
                              <!--  <img src="<?php echo base_url('public/admin/images/');?>logo1.png">-->
                               
<style type="text/css">
    #personal_information,
    #company_information{
      display:none;
    }
  </style>



        <div class="error-msg"></div>

<form class="mb-1 login-input" id="mobile-form" method="post" autocomplete="off">
  <h3 class="pt-1 mb-4 text-center">REGISTER</h3>
  <div class="form-group">
  <input type="text" class="form-control" placeholder="Enter Mobile Number" name="first_mobile" id="first_mobile" maxlength="10">
  </div>
  <button class="btn btn-dark submit w-100 mobile-btn">NEXT</button>
</form>

<form class="mb-1 login-input" id="verify-form" method="post" autocomplete="off" style="display: none;">
  <h3 class="pt-1 mb-4 text-center">REGISTER</h3>
  <div class="form-group">
    <p class="pl-5 pr-5 text-center txt_mobile"></p>
  </div>
  <div class="form-group">
  <input type="hidden" class="form-control" placeholder="Enter Mobile Number" name="verify_mobile" id="verify_mobile" maxlength="10">
  <input type="text" class="form-control" placeholder="Enter OTP" name="first_mobile_otp" id="first_mobile_otp" maxlength="6">
  </div>
  <button class="btn btn-dark submit w-100 verify-btn">VERIFY</button>

  <div class="text-center mt-4"><a href="javascript:void(0)" onclick="editMobile()" style="text-decoration: underline;color: gray;">Edit Mobile</a></div>
</form>

<form id="regForm" class="mt-3 mb-1 login-input" style="display: none;" action="<?= base_url('agent_register_process') ?>" onsubmit="return registerComplete();" autocomplete="off" method="POST">

        <fieldset id="account_information" class="">
          <h3 class="pt-1 mb-4 text-center">REGISTER</h3>


          <div class="form-group">

              <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Group">
          </div>
          <div class="form-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email ID">
          </div>
          <div class="form-group">
              <input type="text" class="form-control" id="user_id" name="user_id" placeholder="User ID">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>

          <button class="btn btn-dark submit w-100 next form-btn-1" href="javascript:void()" type="button">Next</button>
        </fieldset>

        <fieldset id="company_information" class="">
          <a class="text-center " href="javascript:void()"> <h3 class="pt-3 mb-3"><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp;Detail</h3></a>
          <div class="form-group">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="FIRST NAME">
          </div>
          <div class="form-group">
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="LAST NAME">
          </div>
          <div class="form-group">
          <div class="form-group">
              <select class="form-control" id="state" name="state" onchange="getCity(this.value)">
                 <option value="">Selet State</option>
                  <?php foreach ($state_list as $state) { ?>
                <option value="<?= $state->state_id ?>"><?= $state->state_name ?></option>
                  <?php } ?>
             </select>
          </div>
             <select class="form-control" id="city" name="city">
                 <option value="">Selet City</option>
             </select>
          </div>
          <div class="form-group">
              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="MOBILE" maxlength="10" style="background-color: #ada7a72e;">
              <input type="hidden" class="form-control" id="otp" name="otp" placeholder="OTP" maxlength="6">
          </div>
          <div class="form-group">
              <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="WHATSAPP" maxlength="10">
          </div>
          <button class="btn btn-dark submit w-100 next" href="javascript:void()" type="button">Next</button>
        </fieldset>

        <fieldset id="personal_information" class="">
          <a class="text-center " href="javascript:void()"> <h3 class="pt-3 mb-3"><i class="fa fa-money" aria-hidden="true"></i> &nbsp;Plan</h3></a>
          <div class="form-group">
                                      <div class="">
                        <div class="card" style="box-shadow: unset;">
                            <div class="">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th style="padding-left: 28px;"><label class="form-check-label"><input type="checkbox" name="plan" class="form-check-input chb" value="1"> &nbsp;BASIC</label></th>
                                                <th style="padding-left: 28px;"><label class="form-check-label"><input type="checkbox" name="plan" class="form-check-input chb" value="2"> &nbsp;PRO</label></th>
                                                <td>Select</td>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                                <td style="vertical-align:middle !important;padding-bottom: 0px;">NO OF USER -1</td>
                                                <td style="vertical-align:middle !important;padding-bottom: 0px;"><span class="badge badge-primary px-2">REQUIRED NO OF USER</span>
                                                </td>
                                                <td style="vertical-align:middle !important;padding-bottom: 0px;padding-top: 10px;"><div>
                                            <div class="form-check mb-3">
                                                <input type="text" class="form-control" id="no_of_user" name="no_of_user" value="1" style="border-radius: 0px !important;width: 60px;" readonly="" onkeypress='validate(event)'>
                                            </div>
                                          
                                           
                                        </div></td>
                                             
                                            </tr>
                                         
                                         
                                        </tbody>
                                    </table>
                                    <span id="error_plan"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                                    </div>

                                    <div class="form-group">
                                            <div class="form-check mb-3">
                                                <label class="form-check-label"><input type="checkbox" class="form-check-input" id="accept" name="accept" value="1"/> &nbsp; Accept all Terms of Services and privacy Policy</label>
                                            </div>
                                            <div id="error_accept"></div>
                                    </div>

          <button class="btn btn-dark submit w-100 form-btn-2" type="submit">Submit</button>
        </fieldset>

      </form>




                        </div>
                        
                    </div><br>
                    <p id="dis" class=" login-form__footer tac">I already have an account, take me to the <a style="color: #2b2a28 !important;font-weight: bold;" href="<?= base_url('agent/login') ?>" class="text-primary">Login</a></p>
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
    </div>

<script src="<?php echo base_url('public/admin/') ?>plugins/common/common.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">

$(".chb").change(function() {
    $(".chb").prop('checked', false);
    $(this).prop('checked', true);
});

$('input[type=checkbox][name=plan]').change(function() {
  if (this.value==2) {
    var v = $("#no_of_user").val();
    $("#no_of_user").prop("readonly",false).val('').focus().val(v);
    //$(".input_user").css("visibility","visible");
  }
  else {
    $("#no_of_user").val("1").prop("readonly",true);
    //$(".input_user").css("visibility","hidden");
  }
});

$('input[type=checkbox][name=plan_2]').change(function() {
  //$(".input_user").show();
});

    $(document).ready(function(){

      jQuery.validator.addMethod("valid_email", function(value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'');

      // Custom method to validate username
      $.validator.addMethod("usernameRegex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]*$/i.test(value);
      }, "User ID must contain only letters, numbers");

      $(".next").click(function(){
        var form = $("#regForm");
        form.validate({
          errorElement: 'span',
          errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if (element.attr("name") == "accept") {
                    error.appendTo("#error_accept");
                }
                else if (element.attr("name") == "plan") {
                    error.appendTo("#error_plan");
                }
                 else {
                    error.insertAfter(element);
                }
            },
          highlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').addClass("has-error");
          },
          unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass("has-error");
          },
          rules: {
            group_name:{
              required: true,
            },
            email: {
              required: true,
              valid_email: true,
            },
            user_id: {
              required: true,
              usernameRegex: true,
              minlength: 6,
              maxlength: 32,
            },
            password : {
              required: true,
              minlength: 8,
              maxlength: 32,
            },
            first_name : {
              required: true,
              maxlength: 32,
            },
            last_name : {
              required: true,
              maxlength: 32,
            },
            city : {
              required: true,
            },
            state : {
              required: true,
            },
            mobile : {
              required: true,
              digits: true,
              minlength: 10,
              maxlength: 10
            },
            whatsapp_no : {
              required: true,
              digits: true,
              minlength: 10,
              maxlength: 10
            },
            accept : {
              required: true,
            },
            plan : {
              required: true,
            }
            
          },
          messages: {
            group_name: {
              required: "Group is required",
            },
            email: {
              required: "Email Id is required",
              valid_email: "Enter valid email address.",
            },
            user_id: {
              required: "User Id is required",
            },
            password: {
              required: "Password is required",
            },
            first_name: {
              required: "First Name is required",
            },
            last_name: {
              required: "Last Name is required",
            },
            city: {
              required: "City is required",
            },
            state: {
              required: "State is required",
            },
            mobile: {
              required: "Mobile No is required",
            },
            whatsapp_no: {
              required: "Whatsapp No is required",
            },
            accept: {
              required: "Please Accept Terms of Services",
            },
            plan: {
              required: "Please Select Plan",
            }
          }
        });
        if (form.valid() === true){
          if ($('#account_information').is(":visible")){
            current_fs = $('#account_information');
            next_fs = $('#company_information');

            checkEmail(next_fs,current_fs);
          }else if($('#company_information').is(":visible")){
            current_fs = $('#company_information');
            next_fs = $('#personal_information');

            next_fs.show();
            current_fs.hide();
          }
          else if($('#personal_information').is(":visible")){
            alert('Complete');
          }
          
        }
      });

      $('#previous').click(function(){
        if($('#company_information').is(":visible")){
          current_fs = $('#company_information');
          next_fs = $('#account_information');
        }else if ($('#personal_information').is(":visible")){
          current_fs = $('#personal_information');
          next_fs = $('#company_information');
        }
        next_fs.show();
        current_fs.hide();
      });
      
    });

function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

function registerComplete() {
  if($("#accept").is(":checked")){
      var myform = document.getElementById("regForm");
      var fd = new FormData(myform);

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/agent_register_process') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn-2").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
        },
        success: function (response) {
          setTimeout(function(){
            //alert(response);
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn-2").html("Submit").prop('disabled',false);

                if (obj.status=='success') {
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href="<?= base_url(AGENT_URL.'login') ?>";
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn-2").html("Submit").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },1000);
        },
        error: function () {
            $(".form-btn-2").html("Submit").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });
  }
  return false;
}
function checkEmail(next_fs,current_fs) {
  var email = $("#email").val();
  var user_id = $("#user_id").val();
  $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/agent_check_email') ?>",
        data: {email:email,user_id:user_id},
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn-1").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn-1").html("Next").prop('disabled',false);

                if (obj.status=='success') {
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  next_fs.show();
                  current_fs.hide();
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn-1").html("Next").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },1000);
        },
        error: function () {
            $(".form-btn-1").html("Next").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });
}

function getCity(state_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url('get_city') ?>",
        data: {state_id:state_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var city_list = obj.city_list;
              var row = "<option value=''>Select City</option>";
              for (var i = 0; i<city_list.length; i++) {
                row += "<option value='"+city_list[i].city_id+"'>"+city_list[i].city_name+"</option>";
              }
              $("#city").html(row);
            }
            else {
              $("#city").html("<option value=''>Select City</option>");
            }
          }
          catch(err) {
            alert('Some error occurred, please try again.');
          }
        },
        error: function () {
            alert('Some error occurred, please try again.');
           
        }

    });
}

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

$("#mobile-form").validate({
    rules: {
        first_mobile: {
            required: true,
            digits:true,
            maxlength:10,
            minlength:10
        }
    },
    messages: {
        first_mobile: "Please enter a 10-digit mobile number"
    },
    submitHandler: function(form) {
      var myform = document.getElementById("mobile-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/agent_get_mobile_otp') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".mobile-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".mobile-btn").html("NEXT").prop('disabled',false);

                if (obj.status=='success') {
                  $(".error-msg").html("");
                  $(".txt_mobile").html(obj.message);
                  $("#verify_mobile").val($("#first_mobile").val());
                  $("#first_mobile_otp").val("");
                  $("#mobile-form").hide();
                  $("#verify-form").show();
                  //window.location.href="<?= base_url(AGENT_URL) ?>";
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".mobile-btn").html("NEXT").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".mobile-btn").html("NEXT").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

function editMobile() {
  $("#mobile-form").show();
  $("#verify-form").hide();
}

$("#verify-form").validate({
    rules: {
        first_mobile_otp: {
            required: true,
            digits:true,
            maxlength:4,
            minlength:4
        }
    },
    messages: {
        first_mobile_otp: "Please enter a 4-digit OTP"
    },
    submitHandler: function(form) {
      var myform = document.getElementById("verify-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/agent_verify_mobile') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".verify-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".verify-btn").html("NEXT").prop('disabled',false);

                if (obj.status=='success') {
                  $(".error-msg").html("");
                  $(".txt_verify_mobile").html(obj.message);
                  $("#mobile").val($("#verify_mobile").val()).prop("readonly",true);
                  $("#otp").val($("#first_mobile_otp").val());
                  $("#verify-form").hide();
                  $("#regForm").show();
                  //window.location.href="<?= base_url(AGENT_URL) ?>";
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".verify-btn").html("NEXT").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".verify-btn").html("NEXT").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
</script>
    

    
 





