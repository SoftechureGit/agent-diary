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
                                <h4 class="card-title">Leads</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <a href="<?= base_url(AGENT_URL.'lead-detail') ?>"><button type="button" class="btn btn-info btn-sm" >Add New</button></a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th>Name</th>
                                        <th class="nosort wd-50 text-center" style="width: 100px;">Status</th>
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
         'url':'<?= base_url(AGENT_URL.'api/lead_list') ?>'
      },
      'columns': [
         { data: 'lead_id' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         {  "render": function (data, type, row) { return row.lead_title+' '+row.lead_first_name+' '+row.lead_last_name; } },
         { 
           className: "text-center",
           "render": function (data, type, row) {
 
                if (row.lead_status === '1') {
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
                    return "<?php //if(isset($menu_item_array['leads']) && $menu_item_array['leads']['rr_edit']) { ?><a href='<?= base_url(AGENT_URL.'lead-detail/') ?>"+row.lead_id+"'><button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button></a><?php //} ?> <?php //if(isset($menu_item_array['leads']) && $menu_item_array['leads']['rr_delete']) { ?>&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick='confirDelete("+row.lead_id+")'><i class='fa fa-trash'></i></button><?php //} ?>";
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

            delete_lead(id)
          } 
        });
  }

  function delete_lead(id) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(AGENT_URL.'api/delete_lead'); ?>",
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