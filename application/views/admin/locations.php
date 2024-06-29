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
                                <h4 class="card-title">Locations</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <?php // if(isset($menu_item_array['locations']) && $menu_item_array['locations']['rr_create']) { ?>
                                <!--<a href="<?= base_url(ADMIN_URL.'location-detail') ?>"><button type="button" class="btn btn-info btn-sm" >Add New</button></a><?php //  } ?>-->
                                <a href="javascript:void()" onclick="formModal(0,1)"><button type="button" class="btn btn-info btn-sm" >Add New</button></a><?php //  } ?> <?php //  } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="margin-top: 16px;padding: 0px;">
                                    <form method="post" onsubmit="return filterRecords()">
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <select class="form-control" id="search_state_id" name="search_state_id" onchange="getCitySearch(this.value)">
                                                  <option value="">------------Select State------------</option>
                                                      <?php foreach ($state_list as $state) { ?>
                                                    <option value="<?= $state->state_id ?>"><?= $state->state_name ?></option>
                                                  <?php } ?>
                                            </select>
                                            </div>

                                            <div class="form-group col-md-5">
                                                <select class="form-control" id="search_city_id" name="search_city_id">
                                                  <option value="">------------Select City------------</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <button type="submit" class="btn btn-info btn-block" style="height: 36px;">Filter</button>
                                            </div>

                                        </div>
                                    </form>
                              </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th>Location</th>
                                        <th class="text-center">State</th>
                                        <th class="text-center">City</th>
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
<div class="modal fade" id="formModal" tabindex="-1" location="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" location="document">
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
                        <label for="location_name" class="col-form-label">Location:</label>
                        <input type="text" class="form-control" id="location_name" name="location_name" required="">
                    </div>

                    <div class="form-group">
                        <label for="location_name" class="col-form-label">State:</label>
                        <select class="form-control" id="state_id" name="state_id" required="" onchange="getCity(this.value)">
                          <option value="">--Select State--</option>
                            <?php foreach ($state_list as $state) { ?>
                          <option value="<?= $state->state_id ?>"><?= $state->state_name ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="location_name" class="col-form-label">City:</label>
                        <select class="form-control" id="city_id" name="city_id" required="">
                          <option value="">--Selec City--</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="location_status" class="col-form-label">Status:</label>
                        <select class="form-control" id="location_status" name="location_status" required="">
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
         'url':'<?= base_url(ADMIN_URL.'api/location_list') ?>',
       'data': function(data){
          var search_state_id = $('#search_state_id').val();
          var search_city_id = $('#search_city_id').val();
          data.search_state_id = search_state_id;
          data.search_city_id = search_city_id;
       }
      },
      'columns': [
         { data: 'location_id' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         { data: 'location_name' },
         { className: "text-center",data: 'state_name' },
         { className: "text-center",data: 'city_name' },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.location_status === '1') {
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
                    return "<?php // if(isset($menu_item_array['locations']) && $menu_item_array['locations']['rr_edit']) { ?><!--<a href='<?= base_url(ADMIN_URL.'location-detail/') ?>"+row.location_id+"'><button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button></a><?php //  } ?>--><button type='button' class='btn btn-success btn-sm' onclick='formModal("+row.location_id+",2)'><i class='fa fa-edit'></i></button><?php // } ?> <?php // if(isset($menu_item_array['locations']) && $menu_item_array['locations']['rr_delete']) { ?>&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick='confirDelete("+row.location_id+")'><i class='fa fa-trash'></i></button><?php // } ?>";
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

    function filterRecords() {
      table.ajax.reload();
      return false;
    }


 function formModal(id,type) {

    if (type==1) {

        $("#formModal").modal('show');$("#fid").val('');
        $("#formModal input").val('');
        $("#formModal select").val('');
        $("#formModal textarea").val('');
        $(".error-msg").html('');

        $("#formModalLabel").text('Add New Location');
        $(".form-btn").text('Add New');
    }
    else {
        get_location(id);
    }
 }

function get_location(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_location') ?>",
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
                    $("#fid").val(record.location_id);
                    $("#location_name").val(record.location_name);
                    $("#state_id").val(record.state_id);

                    var city_list = obj.city_list;
                    var row = "<option value=''>--Select City--</option>";
                    for (var i = 0; i<city_list.length; i++) {
                      row += "<option value='"+city_list[i].city_id+"'>"+city_list[i].city_name+"</option>";
                    }
                    $("#city_id").html(row);
                    $("#city_id").val(record.city_id);

                    $("#location_status").val(record.location_status);
                    $(".error-msg").html('');

                    $("#formModalLabel").text('Edit Location');
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
        url: "<?= base_url(ADMIN_URL.'api/location_process') ?>",
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

            delete_location(id)
          } 
        });
  }

  function delete_location(id) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/delete_location'); ?>",
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

  function getCity(state_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_city') ?>",
        data: {state_id:state_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var city_list = obj.city_list;
              var row = "<option value=''>--Select City--</option>";
              for (var i = 0; i<city_list.length; i++) {
                row += "<option value='"+city_list[i].city_id+"'>"+city_list[i].city_name+"</option>";
              }
              $("#city_id").html(row);
            }
            else {
              $("#city_id").html("<option value=''>--Select City--</option>");
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
function getCitySearch(state_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_city') ?>",
        data: {state_id:state_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var city_list = obj.city_list;
              var row = "<option value=''>------------Select City------------</option>";
              for (var i = 0; i<city_list.length; i++) {
                row += "<option value='"+city_list[i].city_id+"'>"+city_list[i].city_name+"</option>";
              }
              $("#search_city_id").html(row);
            }
            else {
              $("#search_city_id").html("<option value=''>------------Select City------------</option>");
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