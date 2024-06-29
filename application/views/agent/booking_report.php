<?php include('include/header.php');?>
<link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/sweetalert/css/sweetalert.css">
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<?php include('include/sidebar.php');?>

<div class="content-body">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">Booking Report</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <?php if(isset($menu_item_array['locations']) && $menu_item_array['locations']['rr_create']) { ?>
                                <!--<a href="<?= base_url(ADMIN_URL.'location-detail') ?>"><button type="button" class="btn btn-info btn-sm" >Add New</button></a>-->
                                <a href="javascript:void()" onclick="formModal(0,1)"><button type="button" class="btn btn-info btn-sm" >Add New</button></a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="margin-top: 16px;padding: 0px;">
                                    <form method="post" onsubmit="return filterRecords()" autocomplete="off">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="search_text" name="search_text" placeholder="Client Name, Unit Ref. No..." autocomplete="off">
                                            </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <select class="form-control" id="search_agent_id" name="search_agent_id">
                                                  <option value="">Select Agent</option>
                                                      <?php foreach ($agent_list as $agent) { ?>
                                                    <option value="<?= $agent->user_id ?>"><?= ($agent->is_individual)?ucwords($agent->first_name.' '.$agent->last_name):$agent->firm_name ?></option>
                                                  <?php } ?>
                                            </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <select class="form-control" id="search_builder_id" name="search_builder_id">
                                                  <option value="">Select Builder</option>
                                                      <?php foreach ($builder_list as $builder) { ?>
                                                    <option value="<?= $builder->builder_id ?>"><?= $builder->firm_name ?></option>
                                                  <?php } ?>
                                            </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <select class="form-control" id="search_product_id" name="search_product_id">
                                                  <option value="">Select Project</option>
                                                      <?php foreach ($product_list as $product) { ?>
                                                    <option value="<?= $product->product_id ?>"><?= $product->project_name ?></option>
                                                  <?php } ?>
                                            </select>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <select class="form-control" id="search_booking_status" name="search_booking_status">
                                                  <option value="">Select Status</option>
                                                  <option value="1">Accept</option>
                                                  <option value="2">Reject</option>
                                                  <option value="3">Cancel</option>
                                            </select>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <input type="text" class="form-control from_date" id="search_from" name="search_from" placeholder="From" autocomplete="off">
                                            </select>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <input type="text" class="form-control from_date" id="search_to" name="search_to" placeholder="To" autocomplete="off">
                                            </select>
                                            </div>

                                            <!--<div class="form-group col-md-5">
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
                                            </div>-->

                                            <div class="form-group col-md-3">
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
                                        <th class="text-center">Date</th>
                                        <th>Client Name</th>
                                        <th class="text-center">Unit Ref. No</th>
                                        <th>Project</th>
                                        <th>Builder</th>
                                        <th>Agent Name</th>
                                        <th class="nosort wd-50 text-center">Status</th>
                                        <th class="nosort text-center" style="width: 130px;">Action</th>
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
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
$('.from_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY', 
    //minDate : new Date()
});
    var table=$('#empTable').DataTable({
      bFilter: false,
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
         'url':'<?= base_url(AGENT_URL.'api/booking_report_list') ?>',
       'data': function(data){
          data.search_text = $('#search_text').val();
          data.search_agent_id = $('#search_agent_id').val();
          data.search_builder_id = $('#search_builder_id').val();
          data.search_product_id = $('#search_product_id').val();
          data.search_booking_status = $('#search_booking_status').val();
          data.search_from = $('#search_from').val();
          data.search_to = $('#search_to').val();
       }
      },
      'columns': [
         { data: 'booking_id' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         { data: 'booking_date' },
         { className: "text-center",data: 'customer_name' },
         { data: 'unit_ref_no' },
         { data: 'project_name' },
         { data: 'b_firm_name' },
         { data: 'agent_name' },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.booking_status === '1') {
                    return "<span class='label label-pill label-success'>Accept</span>";
                }
                else if (row.booking_status === '2') {
                    return "<span class='label label-pill label-info'>Reject</span>";
                }
                else if (row.booking_status === '3') {
                    return "<span class='label label-pill label-danger'>Cancel</span>";
                }
                else {
                    return "";//"<span class='label label-pill label-success'>Active</span>";
                }
            }
         },
            {
                data: null,
                className: "text-center",
                "render": function (data, type, row) {
                    return "<button type='button' class='btn btn-info btn-sm'>Mail</button> &nbsp;&nbsp; <a href='<?= base_url(AGENT_URL.'booking-detail') ?>/"+row.booking_id+"' class='btn btn-dark btn-sm'>View</a>";
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