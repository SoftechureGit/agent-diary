<?php include('include/header.php');?>
<link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/sweetalert/css/sweetalert.css">
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    .dataTables_filter label .form-control {
    border: 1px solid #ced4da;
  }
</style>

<?php include('include/sidebar.php');?>

<div class="content-body">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">States</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <a href="javascript:void()" onclick="formModalState()"><button type="button" class="btn btn-info btn-sm" >Add New</button></a>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable-state">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th>State Name</th>
                                        <th class="nosort wd-50 text-center">Status</th>
                                        <th class="nosort wd-100 text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">Cities</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <a href="javascript:void()" onclick="formModalCity()"><button type="button" class="btn btn-info btn-sm" >Add New</button></a>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable-city">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th>City Name</th>
                                        <th>State Name</th>
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



<!--  state form model -->

  
<!-- modal form -->
<div class="modal fade" id="formModal" tabindex="-1" location="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" location="document">
        <div class="modal-content">

            <form id="form-modal-state" method="post">
                <input type="hidden" class="form-control" id="state_id" name="state_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-msg"></div>

                    <div class="form-group">
                        <label for="state_name" class="col-form-label"> State: </label>
                        <input type="text" class="form-control" id="state_name" name="state_name" required="">
                    </div>

        

                    <div class="form-group">
                        <label for="location_status" class="col-form-label">Status:</label>
                        <select class="form-control" id="state_status" name="state_status" required="">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success form-btn wd-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end -->

<!--  end state form model -->


<!-- modal city -->

  <!-- modal form -->
<div class="modal fade" id="formModalCity"  location="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" location="document">
        <div class="modal-content">

            <form id="form-modal-city" method="post">
                <input type="hidden" class="form-control" id="city_id" name="city_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabelCity">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-msg"></div>

                  

                    <div class="form-group">
                        <label for="city_state_id" class="col-form-label">State:</label>
                        <select class="form-control select-2-select-with-search" id="city_state_id" name="city_state_id" required="" onchange="getCity(this.value)">
                          <option value="">--Select State--</option>
                            <?php foreach ($state_list as $state) { ?>
                                <option value="<?= $state->state_id ?>"><?= $state->state_name ?></option>
                            <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="city_name" class="col-form-label">City:</label>
                        <input type="text" class="form-control" id="city_name" name="city_name" required="">
                    </div>


                    <div class="form-group">
                        <label for="city_status" class="col-form-label">Status:</label>
                        <select class="form-control" id="city_status" name="city_status" required="">
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

<!-- end modal city -->


<?php include('include/footer.php');?>  
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">


//  select 2 

$(document).ready(function () {
    $('.select-2-select-with-search').select2();
})


//  end select 2

 function deleteState(id) {
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

            delete_state(id)
          } 
        });
  }



//    delete state 

  function delete_state(id) {

$.ajax({
type: "POST",
url: "<?php echo base_url(ADMIN_URL.'api/delete_state'); ?>",
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

//  end delete state


// get state list


function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

var table = $('#empTable-state').DataTable({
    'processing': true,
    'serverSide': true,
    language: {
      searchPlaceholder: "State Name"
    },
    'ajax': {
      'url': '<?= base_url(ADMIN_URL . "api/get_state") ?>',
      'type': 'POST',
      'data': function (d) {
        // d.status = $('#statusFilter').val();
        // d.reason = $('#reasonFilter').val();
        // d.file_name = $('#file_name').val();
        // d.account_id = $('#teamFilter').val();
        // d.search.value = $('#searchBox').val(); // Search value
      }

    },
    'columns': [
      {
        'render':function(data,type,row,meta)
        {
           return meta.row + 1;
        }
      },

      // { data: 'data_id' },
      { data: 'state_name' },
    //   { data: 'mobile' },
    //   { data: 'assigned_user_full_name' },
      {
        className: "text-center",
        'render': function (data, type, row) {
            if (row.state_status === '1') {
                    return "<span class='label label-pill label-success'>Active</span>";
                }
                else {
                    return "<span class='label label-pill label-danger'>Deactive</span>";
                }
        },
        'orderable': false,
        'searchable': false,
      },

      {
        data: null,
        className: "text-center",
        'orderable': false,
        'searchable': false,
        'render': function (data, type, row) {
          return `<button type='button' class='btn btn-success btn-sm' onclick='formModalState(${row.state_id})'><i class='fa fa-edit'></i></button> <button type='button' class='btn btn-danger btn-sm' onclick='deleteState(${row.state_id})'><i class='fa fa-trash'></i></button> `;
        }
      }
    ],
    'order': [[1, 'asc']]
  });


var table_city = $('#empTable-city').DataTable({
    'processing': true,
    'serverSide': true,
    language: {
      searchPlaceholder: "City / State "
    },
    'ajax': {
      'url': '<?= base_url(ADMIN_URL . "api/get_city_list") ?>',
      'type': 'POST',
      'data': function (d) {
        // d.status = $('#statusFilter').val();
        // d.reason = $('#reasonFilter').val();
        // d.file_name = $('#file_name').val();
        // d.account_id = $('#teamFilter').val();
        // d.search.value = $('#searchBox').val(); // Search value
      }

    },
    'columns': [
    //   {
    //     className: "text-center",
    //     'orderable': false,
    //     'searchable': false,
    //     'data': null,
    //     'render': function (data, type, row) {
    //       return '<input type="checkbox" class="lead_id_select" value="' + data.data_id + '">'
    //     }
    //   },

      {
        'render':function(data,type,row,meta)
        {
           return meta.row + 1;
        }
      },

      // { data: 'data_id' },
      { data: 'city_name' },
      { data: 'state_name' },
    //   { data: 'mobile' },
    //   { data: 'assigned_user_full_name' },
      {
        className: "text-center",
        'render': function (data, type, row) {
            if (row.state_status === '1') {
                    return "<span class='label label-pill label-success'>Active</span>";
                }
                else {
                    return "<span class='label label-pill label-danger'>Deactive</span>";
                }
        },
        'orderable': false,
        'searchable': false,
      },


    //   {
    //     className: "text-center",
    //     'render': function (data, type, row) {
    //       return row.followup_comment ?? '-';

    //     },
    //     'orderable': false,
    //     'searchable': false,
    //   },


      {
        data: null,
        className: "text-center",
        'orderable': false,
        'searchable': false,
        'render': function (data, type, row) {
          return `<button type='button' class='btn btn-success btn-sm' onclick='formModalCity(${row.city_id})'><i class='fa fa-edit'></i></button> <button type='button' class='btn btn-danger btn-sm' onclick='get_lead_form(${row.city_id})'><i class='fa fa-trash'></i></button> `;
        }
      }
    ],
    'order': [[1, 'asc']]
  });


// end get state list


//  edit and add form 

  function formModalState(id=''){

    if(id){

        $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_single_state') ?>",
        data: {id:id},
        beforeSend: function (data) {
        },
        success: function (response) {
            var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                    $("#formModal").modal('show');$("#state_id").val('');
                    $("#formModal input").val('');
                    $("#formModal select").val('');
                    $("#formModal textarea").val('');

                    var record = obj.record;

                    $("#state_id").val(record.state_id);


                    $("#state_name").val(record.state_name);

                    $("#state_status").val(record.state_status);
                    $(".error-msg").html('');

                    $("#formModalLabel").text('Edit State');
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
    else{
        $("#formModal").modal('show');$("#fid").val('');
        $("#formModal input").val('');
        $("#formModal select").val('');
        $("#formModal textarea").val('');
        $(".error-msg").html('');
    
        $("#formModalLabel").text('Add New State');
        $(".form-btn").text('Submit');
    }


  }

//  end edit and add form 

//  edit and add form  city

  function formModalCity(id=''){

    if(id){

        $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_single_city') ?>",
        data: {id:id},
        beforeSend: function (data) {
        },
        success: function (response) {
            var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                    $("#formModalCity").modal('show');$("#state_id").val('');
                    $("#formModalCity input").val('');
                    $("#formModalCity select").val('');
                    $("#formModalCity textarea").val('');

                    var record = obj.record;

                    $("#city_state_id").val(obj.state.state_id);
                    $("#city_id").val(record.city_id);


                    $("#city_name").val(record.city_name);

                    $("#city_status").val(record.city_status);
                    $(".error-msg").html('');

                    $("#formModalLabelCity").text('Edit City');
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
    else{
        $("#formModalCity").modal('show');$("#fid").val('');
        $("#formModalCity input").val('');
        $("#formModalCity select").val('');
        $("#formModalCity textarea").val('');
        $(".error-msg").html('');
    
        $("#formModalLabel").text('Add New State');
        $(".form-btn").text('Submit');
    }


  }

//  end edit and add form  city



//  save state


$("#form-modal-state").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal-state");
      var fd = new FormData(myform );
      var fid = $("#state_id").val();
      var btn_label = "Add New";
      if (fid!="") {
        btn_label = "Update";
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/state_process') ?>",
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

                    setTimeout(function(){
                        $("#formModal").modal('hide');
                    },1000);

                  $(".error-msg").html(alertMessage('success',obj.message));
                  table.draw();
                }
                else if (obj.status=='updated') {
                   setTimeout(function(){
                        $("#formModal").modal('hide');
                    },1000);
                  $(".error-msg").html(alertMessage('success',obj.message));
                  table.draw();
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

//  end save state


//  save state


$("#form-modal-city").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal-city");
      var fd = new FormData(myform );
      var fid = $("#city_id").val();
      var btn_label = "Add New";
      if (fid!="") {
        btn_label = "Update";
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/city_process') ?>",
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

                    setTimeout(function(){
                        $("#formModalCity").modal('hide');
                    },1000);

                  $(".error-msg").html(alertMessage('success',obj.message));
                  table_city.draw();
                }
                else if (obj.status=='updated') {
                   setTimeout(function(){
                        $("#formModalCity").modal('hide');
                    },1000);
                  $(".error-msg").html(alertMessage('success',obj.message));
                  table_city.draw();
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

//  end save state


 
 </script>