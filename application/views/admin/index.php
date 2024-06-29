<?php include('include/header.php');?>
<style>

.loader_progress{
    display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("<?= base_url('public/front/ajax-loader.gif') ?>") 
              50% 50% no-repeat #fff3f38f;
}
</style>
<div class="loader_progress"></div>
<?php include('include/sidebar.php');?>








        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div style="padding: 0px 26px 21px 26px;background-color: #fff;">
                <div class="row">
                    <div class="col-md-3 mtm">
                            <select class="form-control bdr10" id="state_id" name="state_id" onchange="getCity(this.value)">
                                    <option value="">Select State</option>
                                      <?php foreach ($state_list as $state) { ?>
                                    <option value="<?= $state->state_id ?>" <?= ($this->input->get('state')==$state->state_id)?"selected":"" ?>><?= $state->state_name ?></option>
                                      <?php } ?>
                                </select>
                              
                    </div>

                    <div class="col-md-3 mtm">

                                 <select class="form-control bdr10" id="city_id" name="city_id">
                                    <option value="" selected>Select City</option>
                                    <?php foreach ($city_list as $city) { ?>
                                    <option value="<?= $city->city_id ?>" <?= ($this->input->get('city')==$city->city_id)?"selected":"" ?>><?= $city->city_name ?></option>
                                      <?php } ?>
                                </select>
                    </div>
                    <div class="col-md-3 mtm">
                        <button class="btn btn-primary btn-md" style="border-radius: 10px;height: calc(2.0625rem + 2px); padding: 0.375rem 15px;border:none;" onclick="filterDashboard()"><i class="fa fa-glass"></i> &nbsp;Filter</button>
                    </div>

                     <div class="col-md-3 mt-3" style="text-align: right;">

                                 <h5><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; <?= date("d F, Y") ?></h5>
                    </div>
                </div>
            </div>

         <div class="container-fluid mt-2">

         <!--<div class="row mb-3 mt-1 dss">
            <div class="col-md-3">
                    <select class="form-control bdr10">
                            <option selected>SELECT STATE</option>
                            <option>Rajasthan</option>
                        </select>
                      
            </div>

            <div class="col-md-3 mt-1">

                         <select class="form-control bdr10">
                            <option selected>SELECT CITY</option>
                            <option>Jaipur</option>
                        </select>
            </div>

             <div class="col-md-6 mt-3" style="text-align: right;">

                         <h5><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; 16 October 2019</h5>
            </div>
         </div>-->
            
        <div class="row">
            <div class="col-md-12">
                <div class="row">


            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total Agent</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?= $total_agents ?></h2>
                                    <!--<p class="text-white mb-0">Jan - March 2019</p>-->
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Activate</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?= $total_activate ?></h2>
                               
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-6 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Login</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?= $total_login ?></h2>
                                    
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-sign-in" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-lg-12 col-sm-12">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Deactivate</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?= $total_deactivate ?></h2>
                                   
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-power-off" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                    <div class="col-md-12 col-md-12">
                         <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Data</th>
                                                <th class="text-center">For Rent</th>
                                                <th class="text-center">For Sale</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="text-center">1</th>
                                                <td>Total Project</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center"><?= $total_project ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th class="text-center">2</th>
                                                <td>Total Property </td>
                                                <td class="text-center"><?= $total_property_rent ?></td>
                                                <td class="text-center"><?= $total_property_sale ?></td>
                                               
                                            </tr>
                                            <tr>
                                                <th class="text-center">3</th>
                                                <td>Total Lead</td>
                                                <td class="text-center"><?= $total_lead_rent ?></td>
                                                <td class="text-center"><?= $total_lead_sale ?></td>
                                                
                                            <!--</tr>
                                                 <tr>
                                                <th class="text-center">4</th>
                                                <td>-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                
                                            </tr>
                                            <tr>
                                                <th class="text-center">5</th>
                                                <td>- </td>
                                                <td class="text-center">- </td>
                                                <td class="text-center">-</td>
                                               
                                            </tr>-->
                                        

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                            </div>



                        </div>


                            
                        </div>
                </div>

                


             </div>

            </div>


<div class="row">

<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title">Data</h4>
                                    </div>
                                    <div class="col-md-6" align="right">
                                        <select class="form-control" id="year" name="year" onchange="changeYear()" style="width: 150px;">
                                            <?php $years = range(2020, 2050);
                                            foreach ($years as $year) { ?>
                                            <option value="<?= $year ?>" <?= ($this->input->get('year')==$year)?"selected":"" ?>><?= $year ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive"> 
                                    <table class="table table-bordered table-striped verticle-middle">
                                        <thead>
                                            <tr>
                                                <th>Month </th>
                                                <th class="text-center">Billing</th>
                                                <th class="text-center">Recovery</th>
                                                <th class="text-center">Outstanding</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!$data_month_list) { ?>
                                                <tr>
                                                <td colspan="4" class="text-center">No Records</td>
                                            </tr>
                                            <?php } ?>
                                            <?php foreach ($data_month_list as $row) { ?>
                                            <tr>
                                                <td><?= $row['month_name'] ?></td>
                                                <td class="text-center"><?= CURRENCY_SYMBOL.number_format((float)$row['billing'], 0, '.', '') ?></td>
                                                <td class="text-center"><?= CURRENCY_SYMBOL.number_format((float)$row['recovery'], 0, '.', '') ?>
                                                </td>
                                                <td class="text-center"><?= CURRENCY_SYMBOL.number_format((float)$row['outstanding'], 0, '.', '') ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                 
                                <h4 class="card-title">Upcoming Deactivation</h4>
                                <hr>
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name of Agent</th>
                                                    <th>City</th>
                                                    <th>DOD</th>
                                                    <th>Plan</th>
                                                    <th class="text-center" style="width: 130px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i=1;
                                                foreach ($user_list as $row) { ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $this->Action_model->get_name($row->user_id) ?></td>
                                                    <td><?= $row->city_name ?></td>
                                                   <td><?= $row->next_due_date ?></td>
                                                   
                                                   
                                                    <td><i class="fa fa-circle<?= ($row->plan_id==2)?'':'-o' ?> text-<?= ($row->plan_id==2)?'success':'warning' ?>  mr-2"></i> <?= ($row->plan_id==2)?'PRO':'Basic' ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-info btn-sm btn-rounded btn-4" onclick="get_sms_form('1','<?= $row->user_id ?>','<?= $row->mobile ?>')"><i class="fa fa-comment"></i></a>

                                                        <a href="javascript:void(0)"  class="btn btn-success btn-sm btn-rounded btn-4" onclick="get_sms_form('3','<?= $row->user_id ?>','<?= $row->mobile ?>')"><i class="fa fa-whatsapp"></i></a>

                                                        <a href="javascript:void(0)"  class="btn btn-warning btn-sm btn-rounded" onclick="get_sms_form('2','<?= $row->user_id ?>','<?= $row->email ?>')"><i class="fa fa-envelope"></i></a>
                                                        
                                                    </td>
                                                </tr>
                                                <?php $i++; } ?>
                                             
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>

 </div>
      


            <!-- #/ container -->


        </div>
    </div>
        <!--**********************************
            Content body end
        ***********************************-->

<!-- modal form -->
<div class="modal fade" id="formModalCustomSMS" tabindex="-1" budget="dialog" aria-labelledby="formModalCustomSMSLabel" aria-hidden="true">
    <div class="modal-dialog" budget="document">
        <div class="modal-content">

            <form id="custom-sms-form-main" method="post">
                <input type="hidden" class="form-control" id="fid" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalCustomSMSLabel">Send SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="custom-sms-error-msg"></div>
                    <!--<div><p class="msg"></p></div>-->
                    <input type="hidden" class="form-control" id="send_type" name="send_type" value="">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" required="" readonly="">
                    <input type="hidden" class="form-control" id="type" name="type" required="" readonly="">

                    <div class="form-group">
                        <label for="mobile_otp" class="col-form-label">Send To:</label>
                        <input type="text" class="form-control" id="send_to" name="send_to" required="" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="template_id" class="col-form-label">Template:</label>
                        <select class="form-control bdr10" id="template_id" name="template_id" style="border-radius: 0px;" onchange="changeTemplate()" required="">
                        <option selected>Select Template</option>
                        </select>
                    </div>
                    <div class="form-group subject">
                        <label for="mobile_otp" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" >
                    </div>
                    <div class="form-group message">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message" required="" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success custom-sms-form-btn wd-100">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end --> 

 <?php include('include/footer.php');?>  

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

 <script>

    function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
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
              $("#city_id").html(row);
            }
            else {
              $("#city_id").html("<option value=''>Select City</option>");
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
var template_list = [];
function get_sms_form(type,user_id,send_to) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/get_sms_form'); ?>",
    data: {type:type},
    beforeSend: function (data) {
      $(".loader_progress").show();
    },
    success: function (response) {
      setTimeout(function() {
       

        $(".loader_progress").hide();
        var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                   $("#formModalCustomSMS").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                   var title = "";
                   if (type=="1") {
                    title = "Send SMS";
                   }
                   else if (type=="2") {
                    title = "Send Email";
                   }
                   else if (type=="3") {
                    title = "Send Whatsapp Message";
                   }
                   $("#formModalCustomSMS .modal-title").html(title);
                   $("#send_to").val(send_to);
                   $("#user_id").val(user_id);
                   $("#type").val(type);

                   template_list = obj.template_list;
              var row = "<option value=''>Select Template</option>";
              for (var i = 0; i<template_list.length; i++) {
                row += "<option value='"+template_list[i].template_id+"'>"+template_list[i].template_name+"</option>";
              }
              row += "<option value='0'>Custom Message</option>";
              $("#template_id").html(row);
                   //$(".msg").html(obj.message);

                   changeTemplate();
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
      $(".loader_progress").hide();
      alert('Some Error Occured.');
    }

  });
  }

  function changeTemplate() {
      var template_id = $("#template_id").val();
      var type = $("#type").val();

      $("#subject").prop("required",false);
      //alert(template_id);
      if (template_id!="") {
          if (type=='1') {
            $(".subject").hide();
            $(".message").show();
          }
          else if (type=='2') {
            $(".subject").show();
            $(".message").show();
            $("#subject").prop("required",true);
          }
          else if (type=='3') {
            $(".subject").hide();
            $(".message").show();
          }
          else {
            $(".subject").hide();
            $(".message").hide();
          }

          var f_message = "";
          var f_subject = "";
          for (i = 0; i < template_list.length; i++) {
            var row = template_list[i];
            if (row.template_id==template_id) {
                f_message = row.template_message;
                f_subject = row.template_subject;
            }
          }
          $("#message").val(f_message);
          $("#subject").val(f_subject);
      }else {
        $(".subject").hide();
            $(".message").hide();
      }
  }

  $("#custom-sms-form-main").validate({
    rules: {
        
    },
    messages: {
        
    },
    submitHandler: function(form) {

      var myform = document.getElementById("custom-sms-form-main");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/send_sms_whatsapp_email') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".custom-sms-error-msg").html('');
          $(".custom-sms-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".custom-sms-form-btn").html("Send");

                if (obj.status=='success') {
                    $("#formModalCustomSMS").modal('hide');
                    $.toast({
                        heading: 'Success',
                        text: obj.message,
                        icon: 'success',
                        position: 'top-center',
                    });
                }
                else {
                  $(".custom-sms-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".custom-sms-form-btn").html("Send");
                $(".custom-sms-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
          $(".custom-sms-form-btn").html("Send");
          $(".custom-sms-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

function filterDashboard() {
    changeYear();
}

function changeYear() {
  var year = $("#year").val();
  var state = $("#state_id").val();
  var city = $("#city_id").val();
  window.location.href="?state="+state+"&city="+city+"&year="+year;
}

 </script>