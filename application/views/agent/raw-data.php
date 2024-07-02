<?php include ('include/header.php'); ?>
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css"
  rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css"
  rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.css"
  rel="stylesheet">
<link
  href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
  rel="stylesheet">
<style>
  @media only screen and (max-width : 576px) {
    .mg-10 {
      margin-top: 10px;
    }
  }

  .dataTables_wrapper {
    padding: 0px !important;
  }

  .wrapper-bottom {
    /*margin-top: 30px;margin-bottom: 50px;*/
  }

  .load-more {
    padding: 7px 0px;
    border: 1px solid #8898aa38;
    width: 110px;
    text-align: center;
    border-radius: 5px;
    background-color: #f3f3f9;
    color: #8898aa;
    cursor: pointer;
    display: none;
  }

  .bottom-loader {
    display: none;
  }

  .bottom-loader img {
    height: 80px;
  }

  .detail-loader {
    display: none;
  }

  .detail-loader img {
    height: 80px;
    margin-top: 80px;
  }

  .customer {
    padding: 7px 10px;
  }

  .customer:hover {
    background-color: #f2f2f8;
    cursor: pointer;
  }

  .search-btn {
    border-radius: 50%;
    height: 26px;
    width: 26px;
    border: 1px solid #ced4da;
    color: #ced4da;
    text-align: center;
    position: absolute;
    margin-top: -18px;
    display: none;
  }

  .search-btn i {
    line-height: 25px;
    font-size: 13px;
  }

  .search-btn:hover {
    color: #3333337a;
    background-color: #ced4da52;
    cursor: pointer;
  }

  .advance_search {
    display: none;
  }

  .dataTables_filter label .form-control  {
   border: 1px solid #ced4da;
  } 

</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
<?php include ('include/sidebar.php'); ?>

<div class="content-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card" style="margin-bottom: 0px;">
          <div class="card-body">

            <div class="row">

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title">Data</h4>
                  </div>
                  <div class="col-12">
                    <div class="error-msg-right">
                      <?php if ($this->session->flashdata('error_msg')) { ?>
                        <div class="alert alert-danger pd8">
                          <?php echo $this->session->flashdata('error_msg'); ?>
                        </div>
                      <?php } ?>
                      <?php if ($this->session->flashdata('success_msg')) { ?>
                        <div class="alert alert-success pd8">
                          <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                      <?php } ?>

                    </div>
                  </div>
                  <div class="col-12 my-3">
                    <form id="action-form-modal" method="post" action="<?= base_url(AGENT_URL . 'upload_lead') ?>"
                      enctype="multipart/form-data">
                      <div class="row align-items-center">
                        <div class="col-6 my-3">
                          <select name="data_type" class="form-control" id="data-type">
                            <option selected disabled> --Select Lead Data Type-- </option>
                            <option value="1">hello 1</option>
                            <option value="2">hello 2</option>
                            <option value="3">hello 3 </option>
                            <option value="4">hello 4</option>
                          </select>
                        </div>
                        <div class="col-6">
                          <p class="m-0"> <span> <button type="button" class="btn btn-dark btn-sm  form-btn"
                                onclick="downloadSampleLeads()" style="margin-bottom: 10px;">Download Sample</button>
                            </span> <span>Sample File</span> </p>

                        </div>
                        <div class="col-6">
                          <input type="file" class="form-control" id="file" name="file" accept=".csv" required="">
                        </div>
                        <div class="col-6">
                          <button type="submit" class="btn btn-dark btn-sm  form-btn"> Upload </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
  <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">All Data</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <button class="btn btn-primary btn-sm form-btn" onclick="transfer_lead()" >Assign</button>
                                <?php // if(isset($menu_item_array['unit_types']) && $menu_item_array['unit_types']['rr_create']) { ?>
                                <!--<a href="<?= base_url(ADMIN_URL.'unit_type-detail') ?>"><button type="button" class="btn btn-info btn-sm" >Add New</button></a><?php //  } ?>-->
                                <a class="btn btn-dark btn-sm  form-btn" href="<?= base_url(AGENT_URL.'lead-detail/') ?>"> Add New </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                        <table id="empTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all"></th>
                                    <th style="width: 30px;">S.No</th>
                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>Assign To</th>
                                    <th class="nosort wd-50 text-center">Status</th>
                                    <th>Reason</th>
                                    <th class="nosort wd-100 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- start transfer lead modal -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transfer Lead</h5>
                <button type="button" class="close" onclick="closeTransferModal()" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="transfer-error-msg"></div>
                <form id="transfer-form-modal" method="post">
                  <input type="hidden" name="selected_lead_ids" id="selected_lead_ids" value="">
                  <div class="row">

                        <div class="col-md-12" style="margin-top: 10px;">
                          <label>Transfer To:</label>
                            <select class="form-control" id="transfer_to" name="transfer_to" required>
                                  <option value="">Select User</option>
                                  <?php foreach ($user_list as $item) { if($record->user_id!=$item->user_id) {  ?>
                            <option value="<?= $item->user_id ?>"><?= (($item->parent_id==0)?(($item->is_individual)?ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name):$item->firm_name):ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name)) ?></option>
                        <?php } } ?>
                            </select>
                        </div>

                <div class="col-md-12 pt-4 pb-2" align="right">
                  <button type="button" class="btn btn-danger btn-lg mr-3" onclick="closeTransferModal()">Close</button>
                  <button type="submit" class="btn btn-dark btn-lg transfer-form-btn w-120">Transfer</button>
                </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end transfer lead modal -->


<!-- start pre loading -->
<div id="preLoading"
  style="display:none;margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: #66666652; z-index: 30001; opacity: 1;">
  <div style="position: absolute;top: 50%; left: 45%;">
    <img src="<?= base_url('public/front/ajax-loader.gif') ?>" style="height: 80px;width: 80px;">
  </div>
</div>
<!-- end pre loading -->

<?php include ('include/footer.php'); ?>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script
  src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<style>
  .clockpicker-popover {
    z-index: 9999 !important;
  }
</style>
<script>
  function downloadSampleLeads() {

    var filter_by = $("#filter_by").val();
    var search_text = $("#search_text").val();
    var search_date_from = $("#search_date_from").val();
    var search_date_to = $("#search_date_to").val();
    var search_state_id = $("#search_state_id").val();
    var search_city_id = $("#search_city_id").val();
    var search_source_id = $("#search_source_id").val();
    var search_stage_id = $("#search_stage_id").val();
    var search_status = $("#search_status").val();
    var search_location_id = $("#search_location_id").val();
    var search_budget_min = $("#search_budget_min").val();
    var search_budget_max = $("#search_budget_max").val();
    var search_size_min = $("#search_size_min").val();
    var search_size_max = $("#search_size_max").val();
    var search_size_unit = $("#search_size_unit").val();
    var search_agent_id = $("#search_agent_id").val();

    var par = { filter_by: filter_by, search_text: search_text, search_date_from: search_date_from, search_date_to: search_date_to, search_state_id: search_state_id, search_city_id: search_city_id, search_source_id: search_source_id, search_stage_id: search_stage_id, search_status: search_status, search_location_id: search_location_id, search_budget_min: search_budget_min, search_budget_max: search_budget_max, search_size_min: search_size_min, search_size_max: search_size_max, search_size_unit: search_size_unit, search_agent_id: search_agent_id };
    var str = jQuery.param(par);

    window.location.href = "<?= base_url(AGENT_URL . 'download_sample_leads?') ?>" + str;
  }

  $('#action-form-modal').validate({ // initialize the plugin
    rules: {
      file: {
        required: true
      }
    },
    messages: {
      file: {
        required: "Please upload a file."
      }
    },
    submitHandler: function (form) {
      if (document.getElementById("file").value.toLowerCase().lastIndexOf(".csv") == -1) {
        alert("Please upload a file with .csv extension.");
        return false;
      }
      else {
        $(".upload-csv").html("Uploading...");
        $('#action-form-modal').submit();
        return false;
      }
    }
  });
</script>


<!-- all data fetch  -->
<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#empTable').DataTable({
            'processing': true,
            'serverSide': true,
            language: {
                searchPlaceholder: "Name or Mobile"
            },
            'ajax': {
                'url': '<?= base_url(AGENT_URL . "api/get_data") ?>',
                'type': 'POST'
            },
            'columns': [
                {
                    className: "text-center",
                    'orderable': false,
                    'searchable': false,
                    'data': null,
                    'defaultContent': '<input type="checkbox" class="lead_id_select">'
                },
                { data: 'lead_id' },
                { data: 'lead_name' },
                { data: 'lead_mobile_no' },
                { data: 'user_name' },
                {
                    className: "text-center",
                    'render': function (data, type, row) {
                        if (row.status === '1') {
                            return "<span class='badge badge-success'>Active</span>";
                        } else {
                            return "<span class='badge badge-danger'>Deactive</span>";
                        }
                    }
                },
                {
                    className: "text-center",
                    'render': function (data, type, row) {
                        return "hello";
                    }
                },
                {
                    data: null,
                    className: "text-center",
                    'orderable': false,
                    'searchable': false,
                    'render': function (data, type, row) {
                        return `<button type='button' class='btn btn-success btn-sm' onclick='formModal(${row.lead_id}, 2)'><i class='fa fa-edit'></i></button>
                                <button type='button' class='btn btn-danger btn-sm' onclick='confirmDelete(${row.lead_id})'><i class='fa fa-trash'></i></button>`;
                    }
                }
            ],
            'order': [[1, 'asc']]
        });

        // Handle "select all" checkbox click
        $('#select_all').on('click', function () {
            var rows = table.rows({ 'search': 'applied' }).nodes();
            var checked = this.checked;
            $('input[type="checkbox"]', rows).prop('checked', checked);
            updateSelectedLeadIds();
        });

        // Handle individual checkbox click
        $('#empTable tbody').on('change', 'input[type="checkbox"].lead_id_select', function () {
            if (!this.checked) {
                $('#select_all').prop('checked', false);
            } else {
                var allChecked = true;
                $('#empTable tbody input[type="checkbox"].lead_id_select').each(function () {
                    if (!this.checked) {
                        allChecked = false;
                    }
                });
                $('#select_all').prop('checked', allChecked);
            }
            updateSelectedLeadIds();
        });

        // Function to update the selected lead IDs
        function updateSelectedLeadIds() {
            var selectedLeads = [];
            $('#empTable tbody input[type="checkbox"].lead_id_select:checked').each(function () {
                var row = $(this).closest('tr');
                var leadId = table.row(row).data().lead_id;
                selectedLeads.push(leadId);
            });
            $('#selected_lead_ids').val(selectedLeads.join(','));
        }

   

     

        function formModal(id, type) {
            // Your form modal logic here
        }

        function confirmDelete(id) {
            // Your delete confirmation logic here
        }

        $("#transfer-form-modal").validate({
            rules: {
            },
            messages: {
            },
            submitHandler: function (form) {
                var myform = document.getElementById("transfer-form-modal");
                var fd = new FormData(myform);

                $.ajax({
                    type: "POST",
                    url: "<?= base_url(AGENT_URL.'api/transfer_lead') ?>",
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function (data) {
                        $(".transfer-error-msg").html('');
                        $(".transfer-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
                    },
                    success: function (response) {
                        setTimeout(function () {
                            var obj;
                            try {
                                obj = JSON.parse(response);
                                $(".transfer-form-btn").html("Transfer");
                                if (obj.status == 'success') {
                                    location.reload();
                                    $("#transferModal").modal('hide');
                                    $(".error-msg-right").html(alertMessage('success', obj.message));
                                    $(".btn-add-followup").css("visibility", "hidden");
                                    $(".transfer_btn").css("visibility", "hidden");
                                    setTimeout(function () {
                                        window.location.href = "";
                                    }, 1000);
                                }
                                else {
                                    $(".transfer-error-msg").html(alertMessage('error', obj.message));
                                }
                            }
                            catch (err) {
                                $(".transfer-form-btn").html("Transfer");
                                $(".transfer-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
                            }
                        }, 500);
                    },
                    error: function () {
                        $(".transfer-form-btn").html("Transfer");
                        $(".transfer-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
                    }

                });

            }
        });

    });

    function transfer_lead() {

           var lead_ids = $('#selected_lead_ids').val();

           if(lead_ids==''){
            alert('No Lead Selected ');
            return 0 ;
           }

            $("#transferModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#transfer_to").val('');
            $(".transfer-error-msg").html('');
            $(".error-msg-right").html('');
        }


        function closeTransferModal() {
            $("#transferModal").modal('hide');
        }

</script>

<!-- end  all data fetch  -->