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
                                <h4 class="card-title">Templates</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <?php // if(isset($menu_item_array['templates']) && $menu_item_array['templates']['rr_create']) { ?>
                                <!--<a href="<?= base_url(ADMIN_URL.'template-detail') ?>"><button type="button" class="btn btn-info btn-sm" >Add New</button></a><?php //  } ?>-->
                                <a href="javascript:void()" onclick="formModal(0,1)"><button type="button" class="btn btn-info btn-sm" >Add New</button></a><?php //  } ?> <?php //  } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th>Template Name</th>                                        <th>Template Message</th>
                                        <th class="text-center">Template Type</th>

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
<div class="modal fade" id="formModal" tabindex="-1" template="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" template="document">
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
                    <div class="form-group">
                        <label for="template_name" class="col-form-label">Template Name:</label>
                        <input type="text" class="form-control" id="template_name" name="template_name" required="">
                    </div>
                    <div class="form-group">
                        <label for="template_type" class="col-form-label">Template Type:</label>
                        <select class="form-control" id="template_type" name="template_type" required="" onchange="changeTemplateType()">
                            <option value="">Select Template Type</option>
                            <option value="1">SMS</option>
                            <option value="2">Email</option>
                            <option value="3">Whatsapp</option>
                        </select>
                    </div>
                    <div class="form-group subject">
                        <label for="mobile_otp" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="template_subject" name="template_subject" >
                    </div>
                    <div class="form-group message">
                        <label for="template_message" class="col-form-label">Template Message:</label>
                        <textarea class="form-control" id="template_message" name="template_message" rows="3" required="" placeholder="Hello [name]"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="template_status" class="col-form-label">Status:</label>
                        <select class="form-control" id="template_status" name="template_status" required="">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Short Code:</label>
                      <div class="form-control" disabled="" style="    background-color: #e9ecef;padding: 10px 20px;height: auto;">
                        For User Deactivation<br>
                        [name], [email], [mobile], [expire_date]<br>
                        <hr>
                        For Project Share<br>
                        [name], [email], [mobile], [project_name], [project_link]
                        <hr>
                        For Customer, Lead, Followup<br>
                        [customer_name], [customer_email], [customer_mobile]
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
         'url':'<?= base_url(ADMIN_URL.'api/template_list') ?>'
      },
      'columns': [
         { data: 'template_id' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         { data: 'template_name' },
         { data: 'template_message' },
         { className: "text-center",
           "render": function (data, type, row) {
 
                if (row.template_type === '1') {
                    return "<span class='label label-pill label-info'>SMS</span>";
                }
                else if (row.template_type === '2') {
                    return "<span class='label label-pill label-warning'>Email</span>";
                }
                else if (row.template_type === '3') {
                    return "<span class='label label-pill label-success'>Whatsapp</span>";
                }
                else {
                    return "";
                }
            } 
          },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.template_status === '1') {
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
                  var delete_btn = "";
                  if (row.disable_delete=="0") {
                    delete_btn = "&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick='confirDelete("+row.template_id+")'><i class='fa fa-trash'></i></button>";
                  }
                    return "<?php // if(isset($menu_item_array['templates']) && $menu_item_array['templates']['rr_edit']) { ?><!--<a href='<?= base_url(ADMIN_URL.'template-detail/') ?>"+row.template_id+"'><button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button></a><?php //  } ?>--><button type='button' class='btn btn-success btn-sm' onclick='formModal("+row.template_id+",2)'><i class='fa fa-edit'></i></button><?php // } ?> <?php // if(isset($menu_item_array['templates']) && $menu_item_array['templates']['rr_delete']) { ?><?php // } ?>"+delete_btn;
                }
                //defaultContent: "<a href=''><button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button></a><?php //  } ?> &nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>"
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

    if (type==1) {

        $("#formModal").modal('show');$("#fid").val('');
        $("#formModal input").val('');
        $("#formModal select").val('');
        $("#formModal textarea").val('');
        $(".error-msg").html('');

        $("#formModalLabel").text('Add New Template');
        $(".form-btn").text('Add New');
        $("#template_name,#template_type").prop('readonly',false);

        changeTemplateType();
    }
    else {
        get_template(id);
    }
 }

function get_template(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_template') ?>",
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

                    var record = obj.record;
                    $("#fid").val(record.template_id);
                    $("#template_name").val(record.template_name);
                    $("#template_message").val(record.template_message);
                    $("#template_type").val(record.template_type);
                    $("#template_status").val(record.template_status);
                    $(".error-msg").html('');

                    $("#formModalLabel").text('Edit Template');
                    $(".form-btn").text('Update');

                    if (record.disable_delete==1) {

                      $("#template_name,#template_type").prop('readonly',true);
                    }
                    else {
                      $("#template_name,#template_type").prop('readonly',false);
                    }

                    changeTemplateType();
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
        url: "<?= base_url(ADMIN_URL.'api/template_process') ?>",
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

            delete_template(id)
          } 
        });
  }

  function delete_template(id) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/delete_template'); ?>",
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

  function changeTemplateType() {
      var template_type = $("#template_type").val();
      var type = $("#type").val();

      $("#template_subject").prop("required",false);
      if (template_type=='1') {
            $(".subject").hide();
            $(".message").show();
          }
          else if (template_type=='2') {
            $(".subject").show();
            $(".message").show();
            $("#template_subject").prop("required",true);
          }
          else if (template_type=='3') {
            $(".subject").hide();
            $(".message").show();
          }
          else {
            $(".subject").hide();
            $(".message").hide();
          }
  }
 </script>