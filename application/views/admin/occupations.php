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
                                <h4 class="card-title">Occupations</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <?php // if(isset($menu_item_array['occupations']) && $menu_item_array['occupations']['rr_create']) { ?>
                                <!--<a href="<?= base_url(ADMIN_URL.'occupation-detail') ?>"><button type="button" class="btn btn-info btn-sm" >Add New</button></a><?php //  } ?>-->
                                <a href="javascript:void()" onclick="formModal(0,1)"><button type="button" class="btn btn-info btn-sm" >Add New</button></a><?php //  } ?> <?php //  } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th>Occupation Name</th>
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
<div class="modal fade" id="formModal" tabindex="-1" occupation="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" occupation="document">
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
                        <label for="occupation_name" class="col-form-label">Occupation Name:</label>
                        <input type="text" class="form-control" id="occupation_name" name="occupation_name" required="">
                    </div>
                    <div class="form-group">
                        <label for="occupation_status" class="col-form-label">Status:</label>
                        <select class="form-control" id="occupation_status" name="occupation_status" required="">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
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
         'url':'<?= base_url(ADMIN_URL.'api/occupation_list') ?>'
      },
      'columns': [
         { data: 'occupation_id' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         { data: 'occupation_name' },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.occupation_status === '1') {
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
                    return "<?php // if(isset($menu_item_array['occupations']) && $menu_item_array['occupations']['rr_edit']) { ?><!--<a href='<?= base_url(ADMIN_URL.'occupation-detail/') ?>"+row.occupation_id+"'><button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button></a><?php //  } ?>--><button type='button' class='btn btn-success btn-sm' onclick='formModal("+row.occupation_id+",2)'><i class='fa fa-edit'></i></button><?php // } ?> <?php // if(isset($menu_item_array['occupations']) && $menu_item_array['occupations']['rr_delete']) { ?>&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick='confirDelete("+row.occupation_id+")'><i class='fa fa-trash'></i></button><?php // } ?>";
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

        $("#formModalLabel").text('Add New Occupation');
        $(".form-btn").text('Add New');
    }
    else {
        get_occupation(id);
    }
 }

function get_occupation(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_occupation') ?>",
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
                    $("#fid").val(record.occupation_id);
                    $("#occupation_name").val(record.occupation_name);
                    $("#occupation_status").val(record.occupation_status);
                    $(".error-msg").html('');

                    $("#formModalLabel").text('Edit Occupation');
                    $(".form-btn").text('Update');
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
        url: "<?= base_url(ADMIN_URL.'api/occupation_process') ?>",
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

            delete_occupation(id)
          } 
        });
  }

  function delete_occupation(id) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/delete_occupation'); ?>",
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
 </script>