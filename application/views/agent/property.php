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
                                <h4 class="card-title">Properties</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                
                                <a href="<?= base_url(AGENT_URL."property_detail") ?>"><button type="button" class="btn btn-dark btn-sm">Add New</button></a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th>Date of Post</th>
                                        <th>Listing For</th>
                                        <th>Type of Use</th>
                                        <th>Type of Property</th>
                                        <th class="nosort wd-100 text-center" style="width: 100px;">Action</th>
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
<div class="modal fade" id="formModal" tabindex="-1" property="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" property="document">
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
                        <label for="property_name" class="col-form-label">Lead Action:</label>
                        <input type="text" class="form-control" id="property_name" name="property_name" required="">
                    </div>
                    <div class="form-group">
                        <label for="property_status" class="col-form-label">Status:</label>
                        <select class="form-control" id="property_status" name="property_status" required="">
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
         'url':'<?= base_url(AGENT_URL.'api/property_list') ?>'
      },
      'columns': [
         { data: 'property_id' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         { data: 'post_date' },
         { data: 'listing_type_name' },
         { data: 'product_type_name' },
         { data: 'unit_type_name' },
            {
                data: null,
                className: "text-center",
                "render": function (data, type, row) {
                    return "<?php if(isset($menu_item_array['product_property']) && $menu_item_array['product_property']['rr_edit']) { ?><a href='<?= base_url(AGENT_URL.'property-detail/') ?>"+row.property_id+"'><button type='button' class='btn btn-success btn-sm' onclick='formModal("+row.property_id+",2)'><i class='fa fa-edit'></i></button></a><?php } ?>&nbsp;&nbsp;<?php if(isset($menu_item_array['product_property']) && $menu_item_array['product_property']['rr_delete']) { ?><button type='button' class='btn btn-danger btn-sm' onclick='confirDelete("+row.property_id+")'><i class='fa fa-trash'></i></button><?php } ?>";
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




function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
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

            delete_property(id)
          } 
        });
  }

  function delete_property(id) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(AGENT_URL.'api/delete_property'); ?>",
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