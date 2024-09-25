<?php include('include/header.php');?>
<link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/sweetalert/css/sweetalert.css">
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php include('include/sidebar.php');?>

<div class="content-body">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">Teams</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <?php if(isset($menu_item_array['teams']) && $menu_item_array['teams']['rr_create']) { ?>
                                <!--<a href="<?= base_url(AGENT_URL.'team-detail') ?>"><button type="button" class="btn btn-info btn-sm" >Add New</button></a>-->
                                <a href="javascript:void()" onclick="formModal(0,1)"><button type="button" class="btn btn-info btn-sm" >Add New</button></a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>DOR</th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Role</th>
                                        <th class="nosort wd-50 text-center">Status</th>
                                        <th class="nosort wd-100 text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- modal form -->
<div class="modal fade" id="formModal" tabindex="-1" team="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" team="document">
        <div class="modal-content">

            <form id="form-modal" method="post">
                <input type="hidden" class="form-control" id="fid" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-msg"></div>

                    <div class="form-row">

                      <div class="form-group col-md-6">
                          <label>Date of Reg.:</label>
                          <input type="text" class="form-control" required="" readonly="" id="date_register" name="date_register" placeholder="">
                      </div>

                      <div class="form-group col-md-6">
                          <label>User Id:</label>
                          <input type="text" class="form-control" required="" id="user_user_id" name="user_user_id" placeholder="">
                      </div>

                      <div class="form-group col-md-12">
                          <label>Name:</label>
                          <div class="row">
                            <div class="col-md-4">
                              <select class="form-control" id="user_title" name="user_title" required="">
                                  <option value="">Select Title</option>
                                  <option value="Mr.">Mr.</option>
                                  <option value="Ms.">Ms.</option>
                                  <option value="Mrs.">Mrs.</option>
                                  <option value="M/s.">M/s.</option>
                                  <option value="Dr.">Dr.</option>
                                  <option value="Prof.">Prof.</option>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <input type="text" class="form-control" required="" id="user_first_name" name="user_first_name" placeholder="First Name">
                            </div>
                            <div class="col-md-4">
                              <input type="text" class="form-control" required="" id="user_last_name" name="user_last_name" placeholder="Last Name">
                            </div>
                          </div>
                      </div>

                      <div class="form-group col-md-6">
                          <label>Email Id:</label>
                          <input type="email" class="form-control" required="" id="user_email" name="user_email" placeholder="">
                      </div>

                      <div class="form-group col-md-6">
                          <label>Password:</label>
                          <input type="password" class="form-control" id="user_password" name="user_password" placeholder="">
                      </div>

                      <div class="form-group col-md-6">
                          <label>Mobile No:</label>
                          <input type="text" class="form-control" id="user_mobile" name="user_mobile" placeholder="" maxlength="10">
                      </div>

                      <div class="form-group col-md-6">
                          <label>Whatsapp No:</label>
                          <input type="text" class="form-control" id="user_whatsapp_no" name="user_whatsapp_no" placeholder="" maxlength="10">
                      </div>

                      <div class="form-group col-md-6">
                          <label>Assign Role:</label>
                          <select class="form-control" id="user_role_id" name="user_role_id" required="" onchange="getReportToUsers()">
                              <option value="">--Select Assign Role--</option>
                              <?php foreach ($role_list as $role) { ?>
                              <option value="<?= $role->role_id ?>"><?= $role->role_name ?></option>
                              <?php } ?>
                          </select>
                      </div>

                      <div class="form-group col-md-6">
                          <label>Report To:</label>
                          <select class="form-control" id="report_to" name="report_to" required="">
                              <option value="">Select User</option>
                          </select>
                      </div>

                      <div class="form-group col-md-6">
                          <label>Status:</label>
                          <select class="form-control" id="user_status" name="user_status" required="">
                              <option value="">Select Status</option>
                              <option value="1">Active</option>
                              <option value="0">Deactive</option>
                          </select>
                      </div>

                      <div class="form-group col-md-12" style="display: none;">
                          <label>Working Time:</label>
                          <div class="row">
                            <div class="col-md-6">
                              <input type="text" class="form-control" required="" id="work_time_from" name="work_time_from" placeholder="From">
                              <span style="display: flex;">(Example: 09:00 AM)</span>
                            </div>
                            <div class="col-md-6">
                              <input type="text" class="form-control" required="" id="work_time_to" name="work_time_to" placeholder="To">
                              <span style="display: flex;">(Example: 06:00 PM)</span>
                            </div>
                          </div>
                      </div>

                  </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success form-btn wd-100">Add New</button>
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
<script src="<?php echo base_url('public/admin/') ?>plugins/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">

    var table=$('#empTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
         'url':'<?= base_url(AGENT_URL.'api/team_list') ?>'
      },
      'columns': [
         { data: 'user_id' },
         { data: 'username' },
         { data: 'date_register' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         { 
           "render": function (data, type, row) {
             return row.user_title+" "+row.first_name+" "+row.last_name;
            }
         },
         { data: 'mobile' },
         { data: 'role_name' },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.user_status === '1') {
                    return "<span class='label label-pill label-success'>Active</span>";
                }
                else {
                    return "<span class='label label-pill label-danger'>Deactive</span>";
                }
            }
         },
            {
                data: null,
                className: "text-center",
                "render": function (data, type, row) {
                  if (row.user_id !== '1') {
                    return "<?php if(isset($menu_item_array['teams']) && $menu_item_array['teams']['rr_edit']) { ?><!--<a href='<?= base_url(AGENT_URL.'team-detail/') ?>"+row.user_id+"'><button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button></a>--><button type='button' class='btn btn-success btn-sm' onclick='formModal("+row.user_id+",2)'><i class='fa fa-edit'></i></button><?php } ?> <?php if(isset($menu_item_array['teams']) && $menu_item_array['teams']['rr_delete']) { ?>&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick='confirDelete("+row.user_id+")'><i class='fa fa-trash'></i></button><?php } ?>";
                  }
                  else {
                    return "";
                  }
                }
                //defaultContent: "<a href=''><button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button></a> &nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>"
            }
        ],
        'aoColumnDefs': [
            {
                'bSortable': false,
                'aTargets': ['nosort']
            }
        ]
    });


 function formModal(id,type) {
    $("#formModal .error").text('');
    $("#report_to").html("<option value=''>Select User</option>");
    if (type==1) {

        $("#formModal").modal('show');$("#fid").val('');
        $("#formModal input").val('');
        $("#formModal select").val('');
        $("#formModal textarea").val('');
        $(".error-msg").html('');

        $("#formModalLabel").text('Add New Team');
        $(".form-btn").text('Add New');

        var date_register = "<?= date('d-m-Y') ?>";
        $("#date_register").val(date_register);
        $('#user_password').prop('required',true);
        $('#user_user_id').prop('readonly',false);
        $('#user_email').prop('readonly',false);
    }
    else {
        get_team(id);
    }
 }

function get_team(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/get_team') ?>",
        data: {id:id},
        beforeSend: function (data) {
        },
        success: function (response) {
            var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                    $("#formModal").modal('show');$("#fid").val('');
                    $("#formModal input").val('');
                    $("#formModal select").val('');
                    $("#formModal textarea").val('');
                    $('#user_password').prop('required',false);
                    $('#user_user_id').prop('readonly',true);
                    $('#user_email').prop('readonly',true);

                    var record = obj.record;
                    $("#fid").val(record.user_id);
                    $("#date_register").val(record.date_register);
                    $("#user_user_id").val(record.username);
                    $("#user_title").val(record.user_title);
                    $("#user_first_name").val(record.first_name);
                    $("#user_last_name").val(record.last_name);
                    $("#user_email").val(record.email);
                    $("#user_mobile").val(record.mobile);
                    $("#user_whatsapp_no").val(record.whatsapp_no);
                    $("#user_role_id").val(record.role_id);
                    $("#work_time_from").val(record.work_time_from);
                    $("#work_time_to").val(record.work_time_to);
                    $("#user_status").val(record.user_status);
                    $(".error-msg").html('');

                    $("#formModalLabel").text('Edit Team');
                    $(".form-btn").text('Update');

                    var user_list = obj.user_list;
                    var row = "<option value=''>Select User</option>";
                    for (var i = 0; i<user_list.length; i++) {
                      row += "<option value='"+user_list[i].id+"'>"+user_list[i].name+"</option>";
                    }
                    $("#report_to").html(row);
                    $("#report_to").val(record.report_to);
                }
                else {
                  alert(obj.message);
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


function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

 $("#form-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal");
      var fd = new FormData(myform );
      var fid = $("#fid").val();
      var btn_label = "Add New";
      if (fid!="") {
        btn_label = "Update";
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/team_process') ?>",
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
                $(".form-btn").html(btn_label);

                if (obj.status=='added') {
                  $("#formModal").modal('hide');
                  $(".error-msg").html(alertMessage('success',obj.message));
                  table.ajax.reload();
                }
                else if (obj.status=='updated') {
                  $("#formModal").modal('hide');
                  $(".error-msg").html(alertMessage('success',obj.message));
                  table.ajax.reload();
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html(btn_label);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".form-btn").html(btn_label);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

 function confirDelete(id) {
    swal({
          title: "Are you sure?",
          showCancelButton: true,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true,     
        }, function(isConfirm) {
          if (isConfirm) {
            
            $(".sa-button-container button").prop('disabled', true);
            $(".sa-button-container button").css('color', '#ffffff');
            $(".confirm").text("Wating...");

            delete_team(id)
          } 
        });
  }

  function delete_team(id) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(AGENT_URL.'api/delete_team'); ?>",
    data: {id:id},
    success: function (data) {
      setTimeout(function() {
        swal.close();
        table.ajax.reload();
      },500);
    },
    error: function () {
      alert('Some Error Occured.');
    }

  });
  }

<?php if($this->input->get('action') && $this->input->get('action')=='add') { ?>
  formModal(0,1);
<?php } ?>

 function getReportToUsers() {
  var user_role_id = $("#user_role_id").val();
  $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/get_report_users') ?>",
        data: {user_role_id:user_role_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var user_list = obj.user_list;
              var row = "<option value=''>Select User</option>";
              for (var i = 0; i<user_list.length; i++) {
                row += "<option value='"+user_list[i].id+"'>"+user_list[i].name+"</option>";
              }
              $("#report_to").html(row);
            }
            else {
              $("#report_to").html("<option value=''>Select User</option>");
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
 </script>