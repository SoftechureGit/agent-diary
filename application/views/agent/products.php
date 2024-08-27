<?php include('include/header.php'); ?>
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
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
    margin-top: 30px;
    margin-bottom: 50px;
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

  .loader_progress {
    display: none;
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("<?= base_url('public/front/ajax-loader.gif') ?>") 50% 50% no-repeat #fff3f38f;
  }

  .inventory-list-container .add-edit-inventory,
  .inventory-list-container .delete-inventory-record {
    display: none;
  }
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
<div class="loader_progress"></div>
<?php include('include/sidebar.php'); ?>

<div class="content-body">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

            <div class="row">

              <div class="col-md-5">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title">Inventory ( <span class="total_records">0</span> )</h4>
                  </div>
                  <div class="col-md-6" align="right">
                    <!-- <select class="form-control" style="height: 30px !important;min-height: 30px;padding: 0px 10px;width: 145px;" id="filter_by" onchange="filterData()">
                      <option value="">SORT BY</option>
                    </select> -->

                    <input type="search" class="form-control" placeholder="Serach" onchange="filterData()" id="serach">
                  </div>
                  <div class="col-md-12" style="height: 450px;overflow-y: auto;">

                    <div class="lead-list"></div>
                    <?php for ($i = 1; $i <= 0; $i++) { ?>
                      <div class="customer" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 10px;margin-bottom: 10px;" onclick="showCustomer()">
                        <div class="row">
                          <div class="col-md-2" align="center">
                            <img class="mr-3" src="<?= base_url('public/admin/images/avatar/11.png') ?>" style="margin-top: 5px;" width="55" height="55" alt="">
                          </div>
                          <div class="col-md-10">

                            <div class="row">
                              <div class="col-md-6">
                                <h6 class="card-text text-muted"><i class="fa fa-user"></i> Mr. Rakesh Kumar</h6>
                              </div>

                              <div class="col-md-6" align="right">
                                <h6 class="card-text text-muted">26-10-2019</h6>
                              </div>
                            </div>

                            <div class="row" style="margin-top: 5px;">
                              <div class="col-md-12">
                                <h6 class="card-text text-muted"><i class="fa fa-mobile"></i> <span style="font-size: 12px;">+91999999999</span></h6>
                              </div>
                              <div class="col-md-12">
                                <h6 class="card-text text-muted"><i class="fa fa-envelope"></i> <span style="font-size: 12px;">info@gmail.com</span></h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

                    <div class="error-msg-left"></div>
                    <div class="wrapper-bottom" align="center">
                      <div class="load-more" onclick="get_product_list()">Load More</div>

                      <div class="bottom-loader">
                        <img src="<?= base_url('public/front/ajax-loader.gif'); ?>">
                      </div>
                    </div>

                  </div>

                </div>
              </div>

              <div class="col-md-7">
                <div class="error-msg-right"></div>
                <div class="detail-loader text-center">
                  <img src="<?= base_url('public/front/ajax-loader.gif'); ?>">
                </div>
                <div class="customer_detail" style="display: none;height: 535px;overflow-y: auto;">
                </div>

              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
</div>

</div>

<!-- start requirement modal -->
<div class="modal fade" id="requirementModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Requirement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="req-error-msg"></div>
        <form id="req-form-modal" method="post" autocomplete="off">
          <input type="hidden" name="id" id="fid" value="">
          <input type="hidden" name="lead_id" id="lid" value="">
          <div class="row">
            <div class="col-md-6">
              <label>Looking For :</label>
              <select class="form-control" name="look_for" id="look_for" required="">
                <option value="">Select Looking For</option>
                <?php foreach ($lead_option_list as $item) { ?>
                  <option value="<?= $item->lead_option_id ?>" required=""><?= $item->lead_option_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Type of Property:</label>

              <select class="form-control" id="product_type_id" name="product_type_id" onchange="getUnitTypes()">
                <option value="">Select Type of Property</option>
                <?php foreach ($project_type_list as $project_type) { ?>
                  <option value="<?= $project_type->product_type_id ?>"><?= $project_type->product_type_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Unit Type:</label>
              <select class="form-control" id="unit_type_id" name="unit_type_id" onchange="unitType()">
                <option value="">Select Unit Type</option>
              </select>

            </div>
            <div class="col-md-6 accomodation" style="margin-top: 10px;visibility: hidden;">
              <label>Accomodation:</label>
              <select class="form-control" id="accomodation_id" name="accomodation_id">
                <option value="">Select Accomodation</option>
                <?php foreach ($accomodation_list as $item) { ?>
                  <option value="<?= $item->accomodation_id ?>"><?= $item->accomodation_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>State:</label>
              <select class="form-control" id="state_id" name="state_id" onchange="getCity(this.value)">
                <option value="">Select State</option>
                <?php foreach ($state_list as $state) { ?>
                  <option value="<?= $state->state_id ?>"><?= $state->state_name ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-6" style="margin-top: 10px;">
              <label>City:</label>
              <select class="form-control" id="city_id" name="city_id" onchange="getLocation(this.value)">
                <option value="">Select City</option>
              </select>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Location:</label>
              <select class="form-control" id="location" name="location[]" multiple="" style="width: 100%;">
                <option value="" disabled="">Select Location</option>
              </select>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Budget:</label>
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" id="budget_min" name="budget_min" onchange="selectMaxBudget()">
                    <option value="">Select Min</option>
                    <?php foreach ($budget_list as $item) { ?>
                      <option value="<?= $item->budget_id ?>"><?= $item->budget_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="form-control" id="budget_max" name="budget_max">
                    <option value="">Select Max</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Size:</label>
              <div class="row">
                <div class="col-md-4">
                  <input type="text" class="form-control" name="size_min" id="size_min" placeholder="Min" value="">
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="size_max" id="size_max" placeholder="Max" value="">
                </div>
                <div class="col-md-4">
                  <select class="form-control" id="size_unit" name="size_unit">
                    <option value="">Select Unit</option>
                    <?php foreach ($unit_list as $item) { ?>
                      <option value="<?= $item->unit_id ?>"><?= $item->unit_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Remarks:</label>
              <textarea class="form-control" name="remark" id="remark" rows="2"></textarea>
            </div>


            <div class="col-md-6" style="margin-top: 10px;">
              <label>Status:</label>
              <select class="form-control" id="requirement_status" name="requirement_status">
                <option value="1">Open</option>
                <option value="0">Close</option>
              </select>
            </div>

            <div class="col-md-12 pt-4 pb-2" align="center">
              <button type="button" class="btn btn-danger btn-lg mr-3" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark btn-lg req-form-btn w-120">Add</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end requirement modal -->

<!-- start followup status modal -->
<div class="modal fade" id="followUpTabModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Followup</h5>
        <button type="button" class="close" onclick="closeFollowupModal()" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="followup-error-msg"></div>
        <form id="followup-form-modal" method="post">
          <input type="hidden" name="followup_id" id="followup_id" value="">
          <input type="hidden" name="followup_lead_id" id="followup_lead_id" value="">
          <input type="hidden" name="followup_status" id="followup_status" value="">
          <div class="row">
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Lead Stage:</label>
              <select class="form-control" id="lead_stage_id" name="lead_stage_id" onchange="changeLeadStage()">
                <option value="0" disabled="">Select Stage</option>
                <?php foreach ($lead_stage_list as $item) { ?>
                  <option value="<?= $item->lead_stage_id ?>"><?= $item->lead_stage_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Lead Status:</label>
              <select class="form-control" id="lead_status_id" name="lead_status_id">
                <?php foreach ($lead_type_list as $item) { ?>
                  <option value="<?= $item->lead_type_id ?>"><?= $item->lead_type_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Comment:</label>
              <textarea class="form-control" rows="2" id="comment" name="comment"></textarea>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Next Action:</label>
              <select class="form-control" id="next_action" name="next_action">
                <option value="">Select Next Action</option>
                <?php foreach ($lead_action_list as $item) { ?>
                  <option value="<?= $item->lead_action_id ?>"><?= $item->lead_action_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Next Followup:</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' id="next_followup_date" name="next_followup_date" placeholder="Date" value="">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="next_followup_time" name="next_followup_time" placeholder="Time" value="">
                </div>
              </div>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
              <label>Project:</label>
              <input type="text" class="form-control" id="project_id" name="project_id" value="">
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Task Description:</label>
              <textarea class="form-control" rows="2" id="task_desc" name="task_desc"></textarea>
            </div>

            <div class="col-md-12 pt-4 pb-2" align="center">
              <button type="button" class="btn btn-danger btn-lg mr-3" onclick="closeFollowupModal()">Close</button>
              <button type="submit" class="btn btn-dark btn-lg followup-form-btn w-120">Save</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end followup status modal -->

<!-- start lead form modal -->
<div class="modal fade" id="leadFormModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="lead_form"></div>
      </div>
    </div>
  </div>
</div>
<!-- end lead form modal -->

<!-- start feedback form modal -->
<div class="modal fade" id="feedbackFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="feedback-form-modal" method="post" autocomplete="off">
          <div class="feedback-error-msg"></div>

          <input type="hidden" name="lead_id" id="flid">
          <div class="row">
            <div class="col-md-12">
              <label>Customer like this porperty:</label>
              <label>
                <input type="radio" class="feed_prop_like" name="like_property" value="1"> Yes</label>
              <label>
                <input type="radio" class="feed_prop_like" name="like_property" value="0"> No</label>
            </div>
            <div class="col-md-12" style="margin-top: 10px;">
              <label>Date & Time of visit:</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control material_date" name="visit_date" placeholder="Date" value="" />
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control material_time" name="visit_time" placeholder="Time" value="" />
                </div>
              </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Comment:</label>
              <textarea class="form-control" name="comment" rows="2" required></textarea>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Customer Offer:</label>
              <input type="text" class="form-control" name="customer_offer" value="">
            </div>

            <div class="col-md-12 pt-4 pb-2" align="center">
              <button type="button" class="btn btn-danger btn-lg mr-3" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark btn-lg feedback-form-btn w-120">Submit</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end feedback form modal -->

<!-- start pre loading -->
<div id="preLoading" style="display:none;margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: #66666652; z-index: 30001; opacity: 1;">
  <div style="position: absolute;top: 50%; left: 45%;">
    <img src="<?= base_url('public/front/ajax-loader.gif') ?>" style="height: 80px;width: 80px;">
  </div>
</div>
<!-- end pre loading -->

<!-- modal form -->
<div class="modal fade" id="modalQuatation" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" budget="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      </div>
    </div>
  </div>
</div>
<!-- modal end -->

<?php include('include/footer.php'); ?>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>


<style>
  .clockpicker-popover {
    z-index: 9999 !important;
  }
</style>
<script>
  //$('.mydatepicker').datepicker();
  $('.mydatepicker').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY',
    minDate: new Date()
  });
  $('#next_followup_time').bootstrapMaterialDatePicker({
    format: 'HH:mm a',
    time: true,
    date: false,
    shortTime: true,
    twelvehour: false
  });
  /*$('#next_followup_time').clockpicker({
      placement: 'bottom',
      align: 'left',
      autoclose: true,
      'default': 'now'
  });*/

  $('.material_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY',
    minDate: new Date()
  });
  $('.material_time').bootstrapMaterialDatePicker({
    format: 'HH:mm a',
    time: true,
    date: false,
    shortTime: true,
    twelvehour: false
  });
  $('#location').select2();

  function alertMessage(type, message) {
    if (type == 'error') {
      type = 'danger';
    }

    return "<div class='alert alert-" + type + " alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> " + message + " </div>";
  }
  $('#selectLocation').select2();

  function followupStatus(status, id, lid) {

    openFolloupModal(status, id, lid);
    /*if (status=='2') {
      openFolloupModal(id,lid);
      //followup_status_update(id,lid);
    }
    else if (status=='3') {
      //followup_status_update(id,lid);
    }*/
  }

  var page = 1;
  get_product_list();

  function get_product_list() {
    var filter_by = $("#filter_by").val();
    var search_text = $("#search_text").val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/get_product_list'); ?>",
      data: {
        page: page,
        filter_by: filter_by,
        search_text: search_text
      },
      beforeSend: function() {
        $(".error-msg-left").html('');
        $(".load-more").hide();
        $(".bottom-loader").show();
        $(".search_btn").attr("disabled", true);
      },
      success: function(response) {
        setTimeout(function() {
          $(".search_btn").attr("disabled", false);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              $(".load-more").show();
              $(".bottom-loader").hide();
              $(".total_records").text(obj.total_records);
              var records = obj.records;

              var html = "";
              for (var i = 0; i < records.length; i++) {
                var record = records[i];

                var action = "Action";
                if (record.accomodation_name != "") {
                  action += ((action != '') ? ', ' : '') + record.accomodation_name;
                }
                if (record.product_type_name != "") {
                  action += ((action != '') ? ', ' : '') + record.product_type_name;
                }
                if (record.unit_type_name != "") {
                  action += ((action != '') ? ', ' : '') + record.unit_type_name;
                }

                var location = "<i class='fa fa-map-marker'></i> ";
                if (record.location_name != "") {
                  location += record.location_name;
                }
                if (record.city_name != "") {
                  location += ((location != '') ? ', ' : '') + record.city_name;
                }
                if (record.state_name != "") {
                  location += ((location != '') ? ', ' : '') + record.state_name;
                }

                html += "<div class='customer' style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);' onclick='showCustomer(" + record.product_unit_detail_id + ",0)'>" +
                  "    <div style='padding-top: 8px;margin-bottom: 8px;'>" +
                  "    <div class='row'>" +
                  "    <div class='col-md-12'>" +
                  "          <small class='text-muted'><i>" + record.project_name + "</i></small>" +
                  "   </div>" +
                  "    <div class='col-md-12'>" +
                  "          <div class='card-text text-muted'><strong>" + action + "</strong></div>" +
                  "    </div>" +
                  "    <div class='col-md-12'>" +
                  "          <div class='card-text text-muted'>" + location + "</div>" +
                  "   </div>" +
                  "    <div class='col-md-6'>" +
                  "          <div class='card-text text-muted'>" + record.bottom_label + "</div>" +
                  "   </div>" +
                  "    <div class='col-md-6 text-right'>" +
                  "          <div class='card-text text-muted'>" + record.created_at + "</div>" +
                  "   </div>" +
                  "   </div>" +
                  "   </div>" +
                  "</div>";
              }

              $(".lead-list").append(html);

              if (obj.total_records == 0) {
                $(".lead-list").html("<div class='text-center text-muted pt-2'>--- No Products ---</div>");
                $(".load-more").hide();
              } else if (obj.next_page != 0) {
                page = obj.next_page;
                $(".load-more").show();
              } else {
                $(".load-more").hide();
                $(".lead-list").append("<div class='text-center text-muted pt-2'>--- No More Products ---</div>");
              }
            } else {
              $(".load-more").hide();
              $(".bottom-loader").hide();
              $(".error-msg-left").html(alertMessage('error', obj.message));
            }
          } catch (err) {

            $(".search_btn").attr("disabled", false);
            $(".load-more").hide();
            $(".bottom-loader").hide();
            $(".error-msg-left").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".load-more").hide();
        $(".bottom-loader").hide();
        $(".error-msg-left").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function getAmenitiesList(id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_product_amenities_list') ?>",
      data: {
        id: id
      },
      beforeSend: function(data) {
        $(".tab_amenities").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var items = obj.items;

              var html = "<div class='row'>";
              for (var i = 0; i < items.length; i++) {
                var row = items[i];

                html += "<div class='col-md-2' align='center'><img style='height: 52px;width: 52px;' class='img-responsive' src='" + row.image + "' alt=''><p class='text-center' style='margin-top:8px;font-size:12px;line-height: 14px;'>" + row.name + "</p></div>";
              }
              html += "</div>";

              if (items.length == 0) {
                $(".tab_amenities").html("<p class='text-center pt-3'>--- No Amenities ---</p>");
              } else {
                $(".tab_amenities").html(html);
              }
            } else {
              $(".tab_amenities").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".tab_amenities").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".tab_amenities").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function getSpecificationList(id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_product_specification_list') ?>",
      data: {
        id: id
      },
      beforeSend: function(data) {
        $(".tab_specification").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var items = obj.items;

              var html = "";
              for (var i = 0; i < items.length; i++) {
                var row = items[i];

                html += "<div class='card'> <div class='card-header'> <h5 class='mb-0 collapsed' data-toggle='collapse' data-target='#collapseThree" + i + "' aria-expanded='false' aria-controls='collapseThree" + i + "'><i class='fa' aria-hidden='true'></i> " + row.name + "</h5> </div> <div id='collapseThree" + i + "' class='collapse" + ((i == 0) ? 'show' : '') + "' data-parent='#accordion-two'> <div class='card-body'>" + row.description + "</div> </div> </div>";
              }

              if (items.length == 0) {
                $(".tab_specification").html("<p class='text-center pt-3'>--- No Specifications ---</p>");
              } else {
                $(".tab_specification").html(html);
              }
            } else {
              $(".tab_specification").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".tab_specification").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".tab_specification").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function getInventoryList(id, product_unit_detail_id) {
    get_project_inventory();
  }

  function getInventoryListOld(id, product_unit_detail_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_product_inventory_list') ?>",
      data: {
        id: id,
        product_unit_detail_id: product_unit_detail_id
      },
      beforeSend: function(data) {
        $(".tab_inventory").html("<tr><td colspan='7'><div class='text-center'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div></td></tr>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var items = obj.items;

              var html = "";
              for (var i = 0; i < items.length; i++) {
                var row = items[i];

                html += "<tr>" +
                  "<td class='text-center'>" + (i + 1) + "</td>" +
                  "<td class='text-center'>" + row.unit_no + "</td>" +
                  "<td class='text-center'>" + row.accomodation_name + "</td>" +
                  "<td class='text-center'>" + row.floor_name + "</td>" +
                  "<td class='text-center'>" + row.tower_name + "</td>" +
                  "<td class='text-center' onclick='getQuatation(" + row.inventory_id + ")'><button class='btn btn-warning btn-sm' style='color:#fff;'><i class='fa fa-eye'></i></button></td>" +
                  "<td class='text-center'><button class='btn btn-info'></button></td>" +
                  "</tr>";
              }

              if (items.length == 0) {
                $(".tab_inventory").html("<tr><td colspan='7'><p class='text-center pt-3'>--- No Records ---</p>" + "</td></tr>");
              } else {
                $(".tab_inventory").html(html);
              }
            } else {
              $(".tab_inventory").html("<tr><td colspan='7'>" + alertMessage('error', obj.message) + "</td></tr>");
            }
          } catch (err) {
            $(".tab_inventory").html("<tr><td colspan='7'>" + alertMessage('error', 'Some error occurred, please try again.') + "</td></tr>");
          }
        }, 500);
      },
      error: function() {
        $(".tab_inventory").html("<tr><td colspan='7'>" + alertMessage('error', 'Some error occurred, please try again.') + "</td></tr>");
      }

    });
  }

  $(".search-btn").click(function() {
    $(".customer_detail").html("");
    $(".search_box").show();
    $(".search-btn").hide();
  });

  function filterData() {
    $(".search-btn").hide();
    page = 1;
    $(".lead-list").html("");
    $(".total_records").text('0');
    $(".customer_detail").html("");
    $(".search_box").show();
    get_product_list();
  }

  function searchData() {
    filterData();
    return false;
  }

  function showCustomer(id, def) {
    $(".search-btn").show();
    $(".customer_detail").hide();
    $(".search_box").hide();
    setTimeout(function() {
      get_product_unit_single(id, def);
    }, 100)
  }

  function get_product_unit_single(id, def) {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/get_product_unit_single'); ?>",
      data: {
        id: id,
        def: def
      },
      beforeSend: function() {
        $(".error-msg-right").html('');
        $(".detail-loader").show();
      },
      success: function(response) {
        setTimeout(function() {
          $(".customer_detail").show();
          $(".detail-loader").hide();

          if (response != "error") {
            $(".customer_detail").html(response);
          } else {
            $(".customer_detail").html("");
            $(".error-msg-right").html(alertMessage('error', 'Some error occurred, please try again.'));
          }

        }, 100);
      },
      error: function() {
        $(".detail-loader").hide();
        $(".error-msg-right").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function getUnitList(lead_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_customer_unit_list') ?>",
      data: {
        lead_id: lead_id
      },
      beforeSend: function(data) {
        $(".unit_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var unit_list = obj.unit_list;
              var html = "";
              for (var i = 0; i < unit_list.length; i++) {
                var status = "";
                if (unit_list[i].status == '1') {
                  status = "<span class='label label-pill label-success' style='padding: 3px 10px;'>Open</span>";
                } else if (unit_list[i].status == '0') {
                  status = "<span class='label label-pill label-danger' style='padding: 3px 10px;'>Close</span>";
                }

                html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'>" +
                  "    <div class='row'>" +
                  "        <div class='col-md-8'>" +
                  "            <label>Date:</label> <strong>" + unit_list[i].post_date + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-4' align='right'>" +
                  "            <label></label> <strong>" + status + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>Product Type:</label> <strong>" + unit_list[i].product_type_name + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>Unit Type:</label> <strong>" + unit_list[i].unit_type_name + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-12'>" +
                  "            <label>Location:</label> <strong>" + unit_list[i].location_name + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>City:</label> <strong>" + unit_list[i].city_name + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>State:</label> <strong>" + unit_list[i].state_name + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>Agent Name:</label> <strong>" + unit_list[i].agent_name + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>Action:</label> <strong>" + unit_list[i].listing_type + "</strong>" +
                  "        </div>" +
                  "    </div>" +
                  "</div>";
              }

              if (unit_list.length == 0) {
                $(".unit_list").html("<p class='text-center pt-3'>--- No Units ---</p>");
              } else {
                $(".unit_list").html(html);
              }
            } else {
              $(".unit_list").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".unit_list").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".unit_list").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function add_to_followup(id) {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/add_to_followup'); ?>",
      data: {
        id: id
      },
      beforeSend: function() {
        $(".error-msg-right").html('');
        $(".btn-add-followup").html("<i class='fa fa-circle-o-notch fa-spin'></i>").attr("disabled", true);
      },
      success: function(response) {
        setTimeout(function() {
          $(".btn-add-followup").html("<i class='fa fa-pencil'></i> Add to Followup").attr("disabled", false);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {

              $(".error-msg-right").html(alertMessage('success', obj.message));
              $(".btn-add-followup").css("visibility", "hidden");
              setTimeout(function() {
                window.location.href = "<?= base_url(AGENT_URL . 'followup') ?>";
              }, 1000);
            } else {
              $(".error-msg-right").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".error-msg-right").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".btn-add-followup").html("<i class='fa fa-pencil'></i> Add to Followup").attr("disabled", false);
        $(".error-msg-right").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function getCity(state_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url('get_city') ?>",
      data: {
        state_id: state_id
      },
      beforeSend: function(data) {},
      success: function(response) {
        var obj;
        try {
          obj = JSON.parse(response);
          if (obj.status == 'success') {
            var city_list = obj.city_list;
            var row = "<option value=''>Select City</option>";
            for (var i = 0; i < city_list.length; i++) {
              row += "<option value='" + city_list[i].city_id + "'>" + city_list[i].city_name + "</option>";
            }
            $("#city_id").html(row);
          } else {
            $("#city_id").html("<option value=''>Select City</option>");
          }
          $("#location").html("<option value='' disabled>Select Location</option>");
        } catch (err) {
          alert('Some error occurred, please try again.');
        }
      },
      error: function() {
        alert('Some error occurred, please try again.');

      }

    });
  }

  function getLocation(city_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_locations') ?>",
      data: {
        city_id: city_id
      },
      beforeSend: function(data) {},
      success: function(response) {
        console.log(response);
        var obj;
        try {
          obj = JSON.parse(response);
          if (obj.status == 'success') {
            var location_list = obj.location_list;
            var row = "<option value='' disabled>Select Location</option>";
            for (var i = 0; i < location_list.length; i++) {
              row += "<option value='" + location_list[i].location_id + "'>" + location_list[i].location_name + "</option>";
            }
            $("#location").html(row).trigger("change");
          } else {
            $("#location").html("<option value='' disabled>Select Location</option>");
          }
        } catch (err) {
          alert('Some error occurred, please try again.');
        }
      },
      error: function() {
        alert('Some error occurred, please try again.');

      }

    });
  }

  function getUnitTypes() {
    unitType();
    var product_type_id = $('#product_type_id').val();
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_unit_types') ?>",
      data: {
        product_type_id: product_type_id
      },
      beforeSend: function(data) {},
      success: function(response) {
        console.log(response);
        var obj;
        try {
          obj = JSON.parse(response);
          if (obj.status == 'success') {
            var unit_type_list = obj.unit_type_list;
            var row = "<option value=''>Select Unit Type</option>";
            for (var i = 0; i < unit_type_list.length; i++) {
              row += "<option value='" + unit_type_list[i].unit_type_id + "'>" + unit_type_list[i].unit_type_name + "</option>";
            }
            $("#unit_type_id").html(row);
          } else {
            $("#unit_type_id").html("<option value=''>Select Unit Type</option>");
          }
        } catch (err) {
          alert('Some error occurred, please try again.');
        }
      },
      error: function() {
        alert('Some error occurred, please try again.');

      }

    });
  }

  function unitType() {
    var product_type_id = $('#product_type_id').val();
    var unit_type_id = $('#unit_type_id').val();

    if (product_type_id == '2' && unit_type_id == '1') {
      $(".accomodation").css("visibility", "visible");
    } else {
      $(".accomodation").css("visibility", "hidden");
    }
  }

  var budget_list = <?= json_encode($budget_list) ?>;

  function selectMaxBudget() {
    var budget_min = parseInt($('#budget_min').val());

    var html = "<option value=''>Select Max</option>";
    for (var i = 0; i < budget_list.length; i++) {
      if (parseInt(budget_list[i].budget_id) >= budget_min) {
        html += "<option value='" + budget_list[i].budget_id + "'>" + budget_list[i].budget_name + "</option>";
      }
    }
    $('#budget_max').html(html);
  }

  function reqFormModal(id, type, lid) {

    if (type == 1) {

      $("#requirementModal").modal('show');
      $("#fid").val('');
      $("#requirementModal input").val('');
      $("#requirementModal select").val('');
      $("#requirementModal textarea").val('');

      $("#lid").val(lid);
      $("#requirement_status").val('1');
      $(".req-error-msg").html('');

      $("#requirementModal .modal-title").text('Add New Requirement');

      $(".req-form-btn").text('Add New');
    } else {
      get_requirement(id);
    }
  }

  $("#req-form-modal").validate({
    rules: {},
    messages: {},
    submitHandler: function(form) {
      var myform = document.getElementById("req-form-modal");
      var fd = new FormData(myform);
      var fid = $("#fid").val();
      var lid = $("#lid").val();
      var btn_label = "Add New";
      if (fid != "") {
        btn_label = "Update";
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/add_requirement') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function(data) {
          $(".req-error-msg").html('');
          $(".req-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function(response) {
          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              $(".req-form-btn").html(btn_label);
              if (obj.status == 'added') {

                $("#requirementModal input").val('');
                $("#requirementModal select").val('');
                $("#requirementModal textarea").val('');
                $("#requirementModal").modal('hide');

                $("#requirementModal .modal-title").html(alertMessage('success', obj.message));
                getRequirementList(lid);
              } else if (obj.status == 'updated') {
                $("#requirementModal").modal('hide');
                $(".req-error-msg").html(alertMessage('success', obj.message));
                getRequirementList(lid);
              } else {
                $(".req-error-msg").html(alertMessage('error', obj.message));
              }
            } catch (err) {
              $(".req-form-btn").html(btn_label);
              $(".req-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
            }
          }, 500);
        },
        error: function() {
          $(".req-form-btn").html(btn_label);
          $(".req-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));

        }

      });

    }
  });

  function get_requirement(id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_requirement') ?>",
      data: {
        id: id
      },
      beforeSend: function(data) {},
      success: function(response) {
        var obj;
        try {
          obj = JSON.parse(response);

          if (obj.status == 'success') {
            $("#requirementModal").modal('show');
            $("#fid").val('');
            $("#lid").val('');
            $("#requirementModal input").val('');
            $("#requirementModal select").val('');
            $("#requirementModal textarea").val('');

            var record = obj.record;
            $("#fid").val(record.requirement_id);
            $("#lid").val(record.lead_id);
            $("#look_for").val(record.look_for);
            $("#remark").val(record.remark);
            $("#requirement_status").val(record.requirement_status);
            $("#size_min").val(record.size_min);
            $("#size_max").val(record.size_max);
            $("#size_unit").val(record.size_unit);
            $("#budget_min").val(record.budget_min);
            $("#accomodation_id").val(record.accomodation_id);

            selectMaxBudget();
            $("#budget_max").val(record.budget_max);
            $("#product_type_id").val(record.product_type_id);
            $("#product_type_id").val(record.product_type_id);


            $("#state_id").val(record.state_id);

            var city_list = obj.city_list;
            var row = "<option value=''>Select City</option>";
            for (var i = 0; i < city_list.length; i++) {
              row += "<option value='" + city_list[i].city_id + "'>" + city_list[i].city_name + "</option>";
            }
            $("#city_id").html(row);

            $("#city_id").val(record.city_id);

            var unit_type_list = obj.unit_type_list;
            var row = "<option value=''>Select City</option>";
            for (var i = 0; i < unit_type_list.length; i++) {
              row += "<option value='" + unit_type_list[i].unit_type_id + "'>" + unit_type_list[i].unit_type_name + "</option>";
            }
            $("#unit_type_id").html(row);

            $("#unit_type_id").val(record.unit_type_id);

            unitType();

            var location = record.location;

            var location_array = [];
            if (location != null && location != '') {
              location_array = location.split(',');
            }

            var location_list = obj.location_list;
            var row = "<option value='' disabled>Select Location</option>";
            for (var i = 0; i < location_list.length; i++) {
              var selected = "";
              if (location_array.indexOf(location_list[i].location_id) !== -1) {
                selected = "selected";
              }
              row += "<option value='" + location_list[i].location_id + "' " + selected + ">" + location_list[i].location_name + "</option>";
            }
            $("#location").html(row).trigger("change");

            $(".req-error-msg").html('');

            $("#requirementModal .modal-title").text('Edit Requirement');
            $(".req-form-btn").text('Update');
          } else {
            alert(obj.message);
          }
        } catch (err) {
          alert('Some error occurred, please try again.');
        }
      },
      error: function() {
        alert('Some error occurred, please try again.');

      }

    });
  }

  function getRequirementList(lead_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_requirement_list') ?>",
      data: {
        lead_id: lead_id
      },
      beforeSend: function(data) {
        $(".requirement_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var requirement_list = obj.requirement_list;
              var html = "";
              for (var i = 0; i < requirement_list.length; i++) {
                var requirement_status = "";
                if (requirement_list[i].requirement_status == '1') {
                  requirement_status = "<span class='label label-pill label-success' style='padding: 3px 10px;'>Open</span>";
                } else if (requirement_list[i].requirement_status == '0') {
                  requirement_status = "<span class='label label-pill label-danger' style='padding: 3px 10px;'>Close</span>";
                }

                var price = requirement_list[i].budget_min;
                if (requirement_list[i].budget_min != "") {
                  price += "-";
                }
                price += requirement_list[i].budget_max;

                var size = requirement_list[i].size_min;
                if (requirement_list[i].size_min != "") {
                  size += "-";
                }
                size += requirement_list[i].size_max;
                if (size != "") {
                  size += " " + requirement_list[i].size_unit;
                }

                html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'>" +
                  "    <div class='row'>" +
                  "        <div class='col-md-4'>" +
                  "            <label>Requirement Id:</label> <strong>" + requirement_list[i].requirement_id + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-4'>" +
                  "            <label>DOR:</label> <strong>" + requirement_list[i].dor + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-4' align='right'>" +
                  "            <label>Status:</label> <strong>" + requirement_status + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-12'>" +
                  "            <label>Looking For:</label> <strong>" + requirement_list[i].look_for + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-12'>" +
                  "            <label>At:</label> <strong>" + requirement_list[i].location + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>Budget:</label> <strong>" + price + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-6'>" +
                  "            <label>Size:</label> <strong>" + size + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-8'>" +
                  "            <label>Remarks:</label> <strong>" + requirement_list[i].remark + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-4' align='right'>" +
                  "            <button type='button' class='btn btn-success btn-sm' onclick='reqFormModal(" + requirement_list[i].requirement_id + ",2," + requirement_list[i].lead_id + ")' style='color: white;'><i class='fa fa-edit'></i> Edit</button>" +
                  "        </div>" +
                  "    </div>" +
                  "</div>";
              }

              if (requirement_list.length == 0) {
                $(".requirement_list").html("<p class='text-center pt-3'>--- No Requirements ---</p>");
              } else {
                $(".requirement_list").html(html);
              }
            } else {
              $(".requirement_list").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".requirement_list").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".requirement_list").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function feedbackFormModal(id, type, lid) {

    if (type == 1) {

      $("#feedbackFormModal").modal('show');
      $("#feedbackFormModal input[type='text']").val('');
      $("input[name=like_property][value=0]").prop('checked', true);
      $("#feedbackFormModal textarea").val('');

      $("#flid").val(lid);
      $(".feedback-error-msg").html('');

      $("#feedbackFormModal .modal-title").text('Feedback');

      $(".feedback-form-btn").text('Submit');
    }
  }

  $("#feedback-form-modal").validate({
    rules: {},
    messages: {},
    submitHandler: function(form) {
      var myform = document.getElementById("feedback-form-modal");
      var fd = new FormData(myform);
      var lid = $("#flid").val();
      var btn_label = "Add New";


      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/add_feedback') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function(data) {
          $(".feedback-error-msg").html('');
          $(".feedback-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function(response) {
          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              $(".feedback-form-btn").html("Submit");
              if (obj.status == 'added') {

                $("#feedbackFormModal").modal('show');
                $("#feedbackFormModal input[type='text']").val('');
                $("#feedbackFormModal textarea").val('');
                $("#feedbackFormModal").modal('hide');

                $(".feedback-error-msg").html(alertMessage('success', obj.message));
                getFeedbackList(lid);
              } else {
                $(".feedback-error-msg").html(alertMessage('error', obj.message));
              }
            } catch (err) {
              $(".feedback-form-btn").html("Submit");
              $(".feedback-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
            }
          }, 500);
        },
        error: function() {
          $(".feedback-form-btn").html("Submit");
          $(".feedback-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));

        }

      });

    }
  });

  function getFeedbackList(lead_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_feedback_list') ?>",
      data: {
        lead_id: lead_id
      },
      beforeSend: function(data) {
        $(".feedback_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var feedback_list = obj.feedback_list;
              var html = "";
              for (var i = 0; i < feedback_list.length; i++) {

                html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'> <div class='row'> <div class='col-md-1' align='center'> <input type='radio' name='rd_product' value='1'> </div> <div class='col-md-11'> <div class='row'> <div class='col-md-12'> <label>Size (unit), Accomodation, Type of Property, Unit Type, Task @ Project name, Location, City, State</label> </div> <div class='col-md-6'> <label>Furniture, Budget-100000</label> </div> <div class='col-md-6'> <label>Requirment id</label> </div> <div class='col-md-6'> <label>Visit Status</label> </div> <div class='col-md-6'> <label>" + feedback_list[i].date_user + "</label> </div> <div class='col-md-12'> <label>Comment: </label><strong>" + feedback_list[i].comment + "</strong> </div> </div> </div> </div> </div>";
              }

              if (feedback_list.length == 0) {
                $(".feedback_list").html("<p class='text-center pt-3'>--- No Feedbacks ---</p>");
              } else {
                $(".feedback_list").html(html);
              }
            } else {
              $(".feedback_list").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".feedback_list").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".feedback_list").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function getFollowupList(lead_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/load_followup_list') ?>",
      data: {
        lead_id: lead_id
      },
      beforeSend: function(data) {
        $(".followup_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var followup_list = obj.followup_list;
              var html = "";
              for (var i = 0; i < followup_list.length; i++) {
                var followup_status = "";
                if (followup_list[i].followup_status == '1') {
                  followup_status = "<span class='label label-pill label-warning' style='padding: 3px 10px;color:#fff;'>Pending</span>";
                } else if (followup_list[i].followup_status == '2') {
                  followup_status = "<span class='label label-pill label-success' style='padding: 3px 10px;color:#fff;'>Complete</span>";
                } else if (followup_list[i].followup_status == '3') {
                  followup_status = "<span class='label label-pill label-danger' style='padding: 3px 10px;color:#fff;'>Cancel</span>";
                }

                var status_select = "";

                if (followup_list[i].followup_status == '1') {
                  status_select = "<div class='col-md-6 pt-2'><select class='form-control f_status' onchange='followupStatus(this.value," + followup_list[i].followup_id + "," + followup_list[i].lead_id + ")' style='width: 140px;height: 30px;min-height: 32px;'><option value='1'>Pending</option><option value='2'>Complete</option><option value='3'>Cancel</option></select></div>";
                }

                var lead_action_name = "";
                var lead_action_name_sep = "";
                if (followup_list[i].lead_action_name != null) {
                  lead_action_name = followup_list[i].lead_action_name;
                  lead_action_name_sep = " @ ";
                }

                var comment = "";
                if (followup_list[i].comment != "") {
                  comment = "<div class='col-md-12'><label>Comment:</label> " + followup_list[i].comment + " @ " + followup_list[i].created + " By " + followup_list[i].cu_name + "</div>";
                }

                html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'>" +
                  "    <div class='row'>" +
                  "        <div class='col-md-3'>" + followup_status +
                  "        </div>" +
                  "        <div class='col-md-9'>" +
                  "            <div class='row'>" +
                  "                <div class='col-md-12'>" +
                  "                    <label><strong>" + lead_action_name + "</strong> " + lead_action_name_sep + followup_list[i].next_action + " By " + followup_list[i].au_name + "</label>" +
                  "                </div>" +
                  "                <div class='col-md-12'>" +
                  "                    <label>Remarks:</label> <strong>" + followup_list[i].task_desc + "</strong>" +
                  "                </div>" + comment + status_select +
                  "            </div>" +
                  "        </div>" +
                  "    </div>" +
                  "</div>";
              }

              if (followup_list.length == 0) {
                $(".followup_list").html("<p class='text-center pt-3'>--- No Records ---</p>");
              } else {
                $(".followup_list").html(html);
              }
            } else {
              $(".followup_list").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".followup_list").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".followup_list").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function getLeadHistoryList(lead_id) {

    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_lead_history_list') ?>",
      data: {
        lead_id: lead_id
      },
      beforeSend: function(data) {
        $(".lead_history").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var lead_history_list = obj.lead_history_list;
              var html = "";
              for (var i = 0; i < lead_history_list.length; i++) {

                html += "<div class='media border-bottom-1 pt-3 pb-3'> <!--<img width='35' src='' class='mr-3 rounded-circle'>--> <div class='media-body'> <h5>" + lead_history_list[i].title + "</h5> <p class='mb-0'>" + lead_history_list[i].description + "</p> </div><span class='text-muted' align='right'>" + lead_history_list[i].created_at + "</span> </div>";
              }

              if (lead_history_list.length == 0) {
                $(".lead_history").html("<p class='text-center pt-3'>--- No Records ---</p>");
              } else {
                $(".lead_history").html(html);
              }
            } else {
              $(".lead_history").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".lead_history").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".lead_history").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  function followup_status_update(id, lid) {

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/followup_status_update'); ?>",
      data: {
        id: id
      },
      beforeSend: function(data) {
        $("#preLoading").show();
      },
      success: function(response) {
        setTimeout(function() {
          $("#preLoading").hide();
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              getFollowupList(lid);
            } else {
              alert(obj.message);
            }
          } catch (err) {
            alert('Some error occurred, please try again.');
          }
        }, 500);
      },
      error: function() {

        $("#preLoading").hide();
        alert('Some error occurred, please try again.');
      }

    });
  }

  $("#followup-form-modal").validate({
    rules: {},
    messages: {},
    submitHandler: function(form) {
      var myform = document.getElementById("followup-form-modal");
      var fd = new FormData(myform);
      var fid = $("#followup_id").val();
      var lid = $("#followup_lead_id").val();
      var btn_label = "Save";

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/followup_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function(data) {
          $(".followup-error-msg").html('');
          $(".followup-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function(response) {
          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              $(".followup-form-btn").html(btn_label);
              if (obj.status == 'success') {
                $("#followUpTabModal input").val('');
                $("#followUpTabModal select").val('');
                $("#followUpTabModal textarea").val('');
                $("#followUpTabModal").modal('hide');

                $("#followUpTabModal").modal('hide');
                $(".followup-error-msg").html(alertMessage('success', obj.message));
                $(".next_followup_" + lid).html(obj.next_followup);
                $(".l_next_followup_" + lid).html(obj.next_followup_date);
                getFollowupList(lid);

              } else {
                $(".followup-error-msg").html(alertMessage('error', obj.message));
              }
            } catch (err) {
              $(".followup-form-btn").html(btn_label);
              $(".followup-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
            }
          }, 500);
        },
        error: function() {
          $(".followup-form-btn").html(btn_label);
          $(".followup-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));

        }

      });

    }
  });

  function changeLeadStage() {
    var lead_stage_id = $("#lead_stage_id").val();
    if (lead_stage_id == '7') {
      $("#lead_status_id").val('2');
      $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #project_id, #task_desc").attr("disabled", true);
      $("#next_action").attr("required", false);
    } else if (lead_stage_id == '6') {
      $("#lead_status_id").val('3');
      $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #project_id, #task_desc").attr("disabled", true);
      $("#next_action").attr("required", false);
    } else {
      $("#next_action, #next_followup_date, #next_followup_time").attr("required", true);
      $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #project_id, #task_desc").attr("disabled", false);
    }
  }

  function openFolloupModal(status, id, lid) {

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/get_customer_stage_status'); ?>",
      data: {
        id: lid
      },
      beforeSend: function(data) {
        $("#preLoading").show();
      },
      success: function(response) {
        setTimeout(function() {
          $("#preLoading").hide();
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              $("#followUpTabModal").modal({
                backdrop: 'static',
                keyboard: false
              });
              $("#followUpTabModal input").val('');
              $("#followUpTabModal select").val('');
              $("#followUpTabModal textarea").val('');

              $("#followup_id").val(id);
              $("#followup_lead_id").val(lid);
              $("#followup_status").val(status);
              $(".followup-error-msg").html('');

              var record = obj.record;
              $("#lead_status_id").val(record.lead_status);
              $("#lead_stage_id").val(record.lead_stage_id);

              changeLeadStage();
            } else {
              alert(obj.message);
            }
          } catch (err) {
            closeFollowupModal();
            alert('Some error occurred, please try again.');
          }
        }, 100);
      },
      error: function() {

        $("#preLoading").hide();
        closeFollowupModal();
        alert('Some error occurred, please try again.');
      }

    });
  }

  function closeFollowupModal() {
    $("#followUpTabModal").modal('hide');
    $(".f_status").val('1');
  }

  function get_lead_form(id) {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/get_lead_form'); ?>",
      data: {
        id: id
      },
      beforeSend: function() {
        //$(".error-msg-right").html('');
        //$(".detail-loader").show();
        $("#preLoading").show();
      },
      success: function(response) {

        setTimeout(function() {
          $("#preLoading").hide();
          //$(".customer_detail").show();
          //$(".detail-loader").hide();

          if (response != "error") {

            $("#leadFormModal").modal({
              backdrop: 'static',
              keyboard: false
            });
            $(".lead_form").html(response);
          } else {
            //$(".customer_detail").html("");
            //$(".error-msg-right").html(alertMessage('error','Some error occurred, please try again.'));
          }

        }, 500);
      },
      error: function() {
        $("#preLoading").hide();
        //$(".detail-loader").hide();
        //$(".error-msg-right").html(alertMessage('error','Some error occurred, please try again.'));
      }

    });
  }

  function hideLeadEditModal(id) {
    showCustomer(id, 1)
    $("#leadFormModal").modal('hide');
  }

  function getQuatation(id) {

    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_product_inventory_quatation') ?>",
      data: {
        inventory_id: id
      },
      beforeSend: function(data) {
        $(".loader_progress").show();
      },
      success: function(response) {
        $(".loader_progress").hide();
        $("#modalQuatation .modal-body").html(response);
        $("#modalQuatation").modal('show');
      },
      error: function() {
        $(".loader_progress").hide();
      }

    });
  }

  function getSiteVisitListOld(product_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_product_site_visit_list') ?>",
      data: {
        product_id: product_id
      },
      beforeSend: function(data) {
        $(".site_visit_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(response) {
        setTimeout(function() {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {
              var records = obj.records;
              var html = "";
              for (var i = 0; i < records.length; i++) {
                var interested = "";
                if (records[i].interested == '1') {
                  interested = "<span class='label label-pill label-success' style='padding: 3px 10px;'>Interested</span>";
                } else if (records[i].interested == '2') {
                  interested = "<span class='label label-pill label-danger' style='padding: 3px 10px;'>Not Interested</span>";
                }

                html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'>" + "    <div class='row'>" +
                  "        <div class='col-md-9'>" +
                  "            <label><strong>" + records[i].lead_name + "</strong>, " + records[i].visit_date + " & " + records[i].visit_time + ", " + records[i].assign_to + "</label> " +
                  "        </div>" +
                  "        <div class='col-md-3' align='right'>" +
                  "            <label></label> <strong>" + interested + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-12'>" +
                  "            <label>Comment: <strong>" + records[i].comment + "</strong></label> " +
                  "        </div>" +
                  "    </div>" +
                  "</div>";
              }

              if (records.length == 0) {
                $(".site_visit_list").html("<p class='text-center pt-3'>--- No Records ---</p>");
              } else {
                $(".site_visit_list").html(html);
              }
            } else {
              $(".site_visit_list").html(alertMessage('error', obj.message));
            }
          } catch (err) {
            $(".site_visit_list").html(alertMessage('error', 'Some error occurred, please try again.'));
          }
        }, 500);
      },
      error: function() {
        $(".site_visit_list").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }

  /** Site Visit Filter */
  $(document).on('click', '.site-visit-filter-apply-btn', function() {
    site_visit_list_via_ajax();
  })
  /** End Site Visit Filter */

  function getSiteVisitList(product_id) {
    site_visit_list_via_ajax(product_id)
  }

  /** Site Visit List Via Ajax */
  function site_visit_list_via_ajax(product_id = 0) {

    if(!product_id){
      product_id                    = $('#product_id').val()
    }

    var site_visit_filter_followup_by  = $('#site_visit_filter_followup_by').val()
    var site_visit_filter_lead_status  = $('#site_visit_filter_lead_status').val()
    var site_visit_filter_lead_stage   = $('#site_visit_filter_lead_stage').val()
    var site_visit_filter_date        = $('#site_visit_filter_date').val()

    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_product_site_visit_list') ?>",
      data: {
        product_id: product_id,
        site_visit_filter_followup_by: site_visit_filter_followup_by,
        site_visit_filter_lead_status: site_visit_filter_lead_status,
        site_visit_filter_lead_stage: site_visit_filter_lead_stage,
        site_visit_filter_date: site_visit_filter_date,
      },
      dataType: 'json',
      beforeSend: function(data) {
        $(".site_visit_table_view").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
      },
      success: function(res) {
        if (res.status) {
          $('.site_visit_table_view').html(res.view)
          $('#siteVisitFilterModal').modal('hide')
        }
      },
      error: function() {
        $(".site_visit_table_view").html(alertMessage('error', 'Some error occurred, please try again.'));
      }

    });
  }
  /** End Site Visit List Via Ajax */
</script>