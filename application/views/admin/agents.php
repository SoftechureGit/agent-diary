<?php include('include/header.php');?>
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css">
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
    margin-top: 10px;
}
}
.dataTables_wrapper {
    padding: 0px !important;
}
.table {
  font-size: 14px;
}
.btn-rounded .fa {
  font-size: 12px;
}
.thead-dark th {
    color: #495057 !important;
    background-color: #e9ecef !important;
    border-color: #dee2e6 !important;
    font-weight: 700 !important;
}
.btn_adv_search {
  cursor: pointer;
  font-weight: bold;
  text-decoration: underline;
}
.adv_search {
  display: none;
}
</style>
<?php include('include/sidebar.php');?>








        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <!--<div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>-->
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Agents</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-top: 16px;padding: 0px;">

<form method="post" onsubmit="return filterRecords()" autocomplete="offf">
    <div class="form-row">

<div class="form-group col-md-4 adv_search">
<select class="form-control" id="state_id" name="state_id" onchange="getCity(this.value)">
        <option value="">Select State</option>
          <?php foreach ($state_list as $state) { ?>
        <option value="<?= $state->state_id ?>" <?= ($this->input->get('state')==$state->state_id)?"selected":"" ?>><?= $state->state_name ?></option>
          <?php } ?>
    </select>
          
</div>

<div class="form-group col-md-4 adv_search">

             <select class="form-control" id="city_id" name="city_id">
                <option value="" selected>Select City</option>
                <?php foreach ($city_list as $city) { ?>
                <option value="<?= $city->city_id ?>" <?= ($this->input->get('city')==$city->city_id)?"selected":"" ?>><?= $city->city_name ?></option>
                  <?php } ?>
            </select>
</div>

<div class="form-group col-md-4 adv_search">

             <select class="form-control" id="plan_active" name="plan_active">
                <option value="">Select Status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
            </select>
</div>

<div class="form-group col-md-8">
    <input type="text" class="form-control" placeholder="Search by Name/Email/Mobile No" id="search_by" name="search_by">
</div>

        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-info btn-block" style="height: 37px;">Search</button>
        </div>

    </div>
</form>

<div align="right">
  <span type="button" class="text-dark btn_adv_search">Show Advance Search</span>
</div>
                                      </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="empTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">DOR</th>
                                                <th class="text-center">Code</th>
                                                <th>Company</th>
                                                <th>City</th>
                                                <th class="text-center">Mobile</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
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
                    <input type="hidden" class="form-control" id="send_type" name="send_type" value="agent">
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
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">

    var table=$('#empTable').DataTable({
      fixedHeader: {
          header: true,
          footer: true
      },
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
         'url':'<?= base_url(ADMIN_URL.'api/agent_list') ?>',
       'data': function(data){
          var search_by = $('#search_by').val();
          data.search_by = search_by;
          data.state_id = $('#state_id').val();
          data.city_id = $('#city_id').val();
          data.plan_active = $('#plan_active').val();
       }
      },
      //"columnDefs": [
      //{ "width": "1020px", "targets": 1}
      //],
      'columns': [
         { 
           className: "text-center",data: 'user_id' },
         { 
           className: "text-center","render": function (data, type, row) {
             return (row.date_register!="")?"<div style='width:75px;'>"+row.date_register+"</div>":"";
            } 
         },
         { 
           className: "text-center","render": function (data, type, row) {
             return "<a href='<?= base_url(ADMIN_URL.'agent_login/') ?>"+row.unique_code+"' target='_blank' class='text-primary'>"+row.unique_code+"</a>";
            } 
         },
         { "render": function (data, type, row) {
             return row.agent_name;
            } 
         },
         { "render": function (data, type, row) {
             return row.city_name;
            } 
         },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.mobile_verify == '1') {
                    return '<span class="fa fa-check-circle-o text-success" title="Mobile Verified"></span>';
                }
                else {
                    return '<span class="fa fa-times-circle-o text-danger" title="Mobile Un Verified"></span>';
                }
            }
         },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.email_verify == '1') {
                    return '<span class="fa fa-check-circle-o text-success" title="Email Verified"></span>';
                }
                else {
                    return '<span class="fa fa-times-circle-o text-danger" title="Email Un Verified"></span>';
                }
            }
         },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.plan_active === '1') {
                    return '<span class="fa fa-circle-o text-success"></span>';
                }
                else {
                    return '<span class="fa fa-circle-o text-danger"></span>';
                }
            }
         },
         { 
           className: "text-center",
           "render": function (data, type, row) {
             return "<div style='width: 160px;'> <a href='<?= base_url(ADMIN_URL.'agents/') ?>"+row.user_id+"'><button class='btn btn-dark btn-sm btn-rounded btn-4'><i class='fa fa-eye'></i></button></a><a href='javascript:void(0)' onclick='get_sms_form(&quot;1&quot;,&quot;"+row.user_id+"&quot;,&quot;"+row.mobile+"&quot;)'><button class='btn btn-info btn-sm btn-rounded' style='margin-right: 2px;'><i class='fa fa-comment'></i></button></a><?php //  } ?> <a href='javascript:void(0)' onclick='get_sms_form(&quot;3&quot;,&quot;"+row.user_id+"&quot;,&quot;"+row.mobile+"&quot;)'><button class='btn btn-success btn-sm btn-rounded' style='margin-right: 2px;'><i class='fa fa-whatsapp' style='color: #fff;'></i></button></a><?php //  } ?> <a href='javascript:void(0)' onclick='get_sms_form(&quot;2&quot;,&quot;"+row.user_id+"&quot;,&quot;"+row.email+"&quot;)'><button class='btn btn-warning btn-sm btn-rounded' style='margin-right: 2px;'><i class='fa fa-envelope' style='color: #fff;'></i></button></a> </div>";
            } 
         }
        ],
        'aoColumnDefs': [
            {
                'bSortable': false,
                'aTargets': ['nosort']
            }
        ]
    });

    

    function filterRecords() {
      table.ajax.reload();
      return false;
    }


// custom sms

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

var show = 0;
$(".btn_adv_search").click(function() {
  if(show==0) {
    show = 1;
    $(".adv_search").show(500);
    $(".btn_adv_search").html("Hide Advance Search");
  }
  else {
    show = 0;
    $(".adv_search").hide();
    $(".btn_adv_search").html("Show Advance Search");
  }
});
    </script>

