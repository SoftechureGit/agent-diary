<?php include('include/header.php');?>
<link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/sweetalert/css/sweetalert.css">
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
    margin-top: 10px;
}
}
.dataTables_wrapper {
    padding: 0px !important;
}
</style>
<?php include('include/sidebar.php');?>

        <div class="content-body">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">View List of Project</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="empTable" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;">S.No</th>
                                                <th style="width: 80px;">DOR</th>
                                                <th>Name of Project</th>
                                                <th>Builder</th>
                                                <th>No of Units</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th class="text-center">Share</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div class="modal fade" id="shareProjectInventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Share Project & Inventory</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="action-form-modal" method="post">
                                                        <input type="hidden" class="form-control" id="project_id" name="project_id" value="">
                                                            <div class="action-error-msg"></div>
                                                            <div class="row">
                                                                
                                                                <div class="col-md-6 form-group">
                                                                    <label for="budget_name" class="col-form-label">Account Id:</label>
                                                                    <input type="text" class="form-control" id="account_id" name="account_id" required="" placeholder="Enter Account Id" />
                                                                </div>
                                                                
                                                                <div class="col-md-6 form-group">
                                                                    <label for="budget_name" class="col-form-label" style="display: flex;">&nbsp;</label>
                                                                    <button type="submit" class="btn btn-success action-form-btn wd-100" style="width: 100px;">Add</button>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                    </form>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="shareTable" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Account Id</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>

                                                     <!--<div class="table-responsive">
                                                        <table class="table table-bordered zero-configuration">

                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center" style="width: 100px;">Agent Id</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>-->
                                            </div>
                                            <!--<div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Share</button>
                                            </div>-->
                                        </div>
                                    </div>
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
 <?php include('include/footer.php');?>  
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script>
    var project_id = 0;

function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

var table=$('#empTable').DataTable({
'processing': true,
'serverSide': true,
'serverMethod': 'post',
'ajax': {
 'url':'<?= base_url(AGENT_URL.'api/project_list') ?>'
},
'columns': [
 { data: 'product_id' },
 { data: 'date_register' },
 { data: 'project_name' },
 { data: 'firm_name' },
 { data: null,
    "render": function (data, type, row) {
        return ""; 
    } 
 },
 { data: 'location_name' },
 { data: 'city_name' },
    {
        data: null,
        className: "text-center",
        "render": function (data, type, row) {
            return (row.share_account_id===null)?"<button class='btn btn-info btn-sm btn-rounded btn-4' onclick='shareProjectInventory("+row.product_id+")'><i class='fa fa-share'></i></button>":((row.is_individual==1)?"By "+(row.a_user_title+''+row.a_first_name+''+row.a_last_name):"By "+row.a_firm_name);
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

var shareTable=$('#shareTable').DataTable({
'processing': true,
'serverSide': true,
'serverMethod': 'post',
'ajax': {
 'url':'<?= base_url(AGENT_URL.'api/share_project_user_list') ?>?',
       'data': function(data){
          data.project_id = project_id;
       }
},
'columns': [
 { data: null,
    "render": function (data, type, row) {
        return (row.is_individual==1)?(row.user_title+''+row.first_name+''+row.last_name):row.firm_name; 
    } 
 },
 { data: 'email' },
    {
        data: null,
        className: "text-center",
        "render": function (data, type, row) {
            return "<button type='button' class='btn btn-danger btn-sm btn-rounded btn-4' onclick='confirDelete("+row.project_share_id+")'>Remove</button>";
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


$("#action-form-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("action-form-modal");
      var fd = new FormData(myform );
      var btn_label = "Add";

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/share_project') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".action-error-msg").html('');
          $(".action-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".action-form-btn").html(btn_label);

                if (obj.status=='success') {
                    $("#account_id").val('');
                    shareTable.ajax.reload();
                  $(".action-error-msg").html(alertMessage('success',obj.message));
                }
                else {
                  $(".action-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".action-form-btn").html(btn_label);
                $(".action-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".action-form-btn").html(btn_label);
          $(".action-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
function shareProjectInventory(id) {
   $("#shareProjectInventoryModal").modal('show');
   $("#project_id").val(id);
   $("#account_id").val('');
   project_id = id;
   
                    shareTable.ajax.reload();

}
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

            delete_budget(id)
          } 
        });
  }

  function delete_budget(id) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(AGENT_URL.'api/delete_share_project'); ?>",
    data: {id:id},
    success: function (data) {
      setTimeout(function() {
        swal.close();
        shareTable.ajax.reload();
      },500);
    },
    error: function () {
      alert('Some Error Occured.');
    }

  });
  }
</script>