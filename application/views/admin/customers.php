<?php include('include/header.php');?>
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
  /*margin-top: 30px;margin-bottom: 50px;*/
}
.load-more {
  padding: 7px 0px;border:1px solid #8898aa38;width: 110px;text-align: center;border-radius: 5px;
  background-color: #f3f3f9;color: #8898aa;cursor: pointer;
  display:none;
}
.bottom-loader {
  display:none;
}
.bottom-loader img {
  height: 80px;
}
.detail-loader {
  display:none;
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
border-radius: 50%;height: 26px;width: 26px;border: 1px solid #ced4da;color: #ced4da;text-align: center;
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
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
<?php include('include/sidebar.php');?>

  <div class="content-body">

      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card" style="margin-bottom: 0px;">
                      <div class="card-body">

                          <div class="row">

                              <div class="col-md-5">
                                <div class="row">
                                  <div class="col-md-6">
                                      <h4 class="card-title">Customers</h4>
                                  </div>
                                  <div class="col-md-6" align="right">
                                      <select class="form-control" style="height: 30px !important;min-height: 30px;padding: 0px 10px;width: 145px;" id="filter_by" onchange="filterData()">
                                            <option value="">SORT BY</option>
                                            <option value="1">Name</option>
                                            <option value="2">Date of Creation</option>
                                            <option value="3">Active</option>
                                            <option value="4">Deactive</option>
                                          </select>
                                  </div>

                                  <div class="col-md-12">
                                      <p>Total Customers: <span class="total_records">0</span></p>
                                  </div>

                                  <div class="col-md-12">
                                    
                                    <div style="height: 67vh;overflow-y: auto;overflow-x: hidden;">
                                    <div class="lead-list"></div>
                                    

                                    <div class="error-msg-left"></div>
                                    <div class="wrapper-bottom" align="center">
                                      <div class="load-more" onclick="get_customer_list()">Load More</div>

                                      <div class="bottom-loader">
                                        <img src="<?= base_url('public/front/ajax-loader.gif'); ?>">
                                      </div>
                                    </div>
                                  </div>

                                  </div>

                                </div>
                              </div>

                              <div class="col-md-7">

                                  <div style="">
                                    <div class="search-btn"><i class="fa fa-search"></i></div>
                                    <div class="error-msg-right"></div>
                                    <div class="detail-loader text-center">
                                      <img src="<?= base_url('public/front/ajax-loader.gif'); ?>">
                                    </div>
                                    <div class="customer_detail">
                                    </div>

                                    <div class="pl-5 pr-5 search_box" style="height: 76vh;overflow-y: auto;overflow-x: hidden;">
                                      <h4 class="text-center">All Customers</h4>

                                      <form class="mt-4" method="post" onsubmit="return searchData()">
                                          <div class="form-group">
                                              <input type="text" class="form-control input-lg" id="search_text" placeholder="Search By Name/ Mobile No/ Email Id" style="height: 38px;border-radius: 6px;">
                                          </div>

                                          <div class="form-group advance_search" style="padding-bottom: 8px;">
                                            <div class="row">
                                                <!-- <div class="col-md-12">
                                                  <select class="form-control" id="search_agent_id" name="search_agent_id" onchange="getCitySearch(this.value)" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                     <option value="">Select Agent</option>
                                                      <?php foreach ($agent_list as $item) { ?>
                                                    <option value="<?= $item->user_id ?>"><?= ($item->is_individual=='1')?$item->user_title.''.$item->first_name.''.$item->last_name:$item->firm_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                                </div> -->
                                                <div class="col-md-6">
                                                  <input type="text" class="form-control input-lg search_datepicker" data-date-format="dd-mm-yyyy" id="search_date_from" name="search_date_from" placeholder="From" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                </div>
                                                <div class="col-md-6">
                                                  <input type="text" class="form-control input-lg search_datepicker" data-date-format="dd-mm-yyyy" id="search_date_to" name="search_date_to" placeholder="To" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                </div>

                                                <div class="col-md-6">
                                                  <select class="form-control" id="search_state_id" name="search_state_id" onchange="getCitySearch(this.value)" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                     <option value="">Select State</option>
                                                      <?php foreach ($state_list as $state) { ?>
                                                    <option value="<?= $state->state_id ?>"><?= $state->state_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                                </div>

                                                <div class="col-md-6">
                                                  <select class="form-control" id="search_city_id" name="search_city_id" style="height: 38px;border-radius: 6px;margin-top: 10px;" onchange="getLocationSearch(this.value)">
                                                     <option value="">Select City</option>
                                                 </select>
                                                </div>

                                                <div class="col-md-6">
                                                  <select class="form-control" id="search_location_id" name="search_location_id" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                     <option value="">Select Location</option>
                                                 </select>
                                                </div>

                                                <div class="col-md-6">
                                                  <select class="form-control" id="search_agent_id" name="search_agent_id" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                     <option value="">Select Agent</option>
                                                     <?php foreach ($filter_user_list as $item) { ?>
                                                      <option value="<?= $item->user_id ?>" ><?= ($item->parent_id==0)?(($item->is_individual)?(ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name)):$item->firm_name):$item->first_name.' '.$item->last_name.(($item->parent_id)?' (Team)':'') ?></option>
                                                        <?php } ?>
                                                 </select>
                                                </div>

                                                <div class="col-md-12">
                                                  <div style="margin-top: 8px;margin-bottom:-5px;font-weight: bold;">Budget:</div>
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-control" id="search_budget_min" name="search_budget_min" onchange="selectMaxBudgetSearch()" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                            <option value="">Select Min</option>
                                                              <?php foreach ($budget_list as $item) { ?>
                                                            <option value="<?= $item->budget_id ?>" ><?= $item->budget_name ?></option>
                                                              <?php } ?>
                                                       </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-control" id="search_budget_max" name="search_budget_max" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                           <option value="">Select Max</option>
                                                       </select>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="col-md-12">
                                                  <div style="margin-top: 8px;margin-bottom:-5px;font-weight: bold;">Size:</div>
                                                  <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-lg" id="search_size_min" name="search_size_min" placeholder="Min" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-lg" id="search_size_max" name="search_size_max" placeholder="Max" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-control" id="search_size_unit" name="search_size_unit" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                           <option value="">Select Unit</option>
                                                            <?php foreach ($unit_list as $item) { ?>
                                                          <option value="<?= $item->unit_id ?>"><?= $item->unit_name ?></option>
                                                            <?php } ?>
                                                       </select>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="col-md-4">
                                                  <select class="form-control" id="search_source_id" name="search_source_id" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                     <option value="">Select Source</option>
                                                      <?php foreach ($lead_source_list as $lead_source) { ?>
                                                    <option value="<?= $lead_source->lead_source_id ?>" ><?= $lead_source->lead_source_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                                </div>

                                                <div class="col-md-4">
                                                  <select class="form-control" id="search_stage_id" name="search_stage_id" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                     <option value="">Select Stage</option>
                                                      <?php foreach ($lead_stage_list as $lead_stage) { ?>
                                                    <option value="<?= $lead_stage->lead_stage_id ?>"><?= $lead_stage->lead_stage_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                                </div>

                                                <div class="col-md-4">
                                                  <select class="form-control" id="search_status" name="search_status" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                                                    <option value="">Select Status</option>
                                                    <?php foreach ($lead_type_list as $item) { ?>
                                                        <option value="<?= $item->lead_type_id ?>" ><?= $item->lead_type_name ?></option>
                                                    <?php } ?>
                                                </select>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="form-group text-right">
                                            <button type="submit" class="btn btn-dark mr-4 search_btn">Search</button>
                                            <button type="button" class="btn btn-dark adv_btn">Advance Search</button>
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
          </div>
      </div>

  </div>

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

<!-- modal form -->
<div class="modal fade" id="formModalCustomSMS" tabindex="-1" budget="dialog" aria-labelledby="formModalCustomSMSLabel" aria-hidden="true">
    <div class="modal-dialog" budget="document">
        <div class="modal-content">

            <form id="custom-sms-form-main" method="post">
                <input type="hidden" class="form-control" id="fid" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalCustomSMSLabel">Send SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="custom-sms-error-msg"></div>
                    <!--<div><p class="msg"></p></div>-->
                    <input type="hidden" class="form-control" id="send_type" name="send_type" value="lead">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" required="" readonly="">
                    <input type="hidden" class="form-control" id="type" name="type" required="" readonly="">

                    <div class="form-group">
                        <label for="mobile_otp" class="col-form-label">Send To:</label>
                        <input type="text" class="form-control" id="send_to" name="send_to" required="" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="template_id" class="col-form-label">Template:</label>
                        <select class="form-control bdr10" id="template_id" name="template_id" style="border-radius: 0px;" onchange="changeTemplate()" required="">
                        <option selected>Select Template</option>
                        </select>
                    </div>
                    <div class="form-group subject">
                        <label for="mobile_otp" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" >
                    </div>
                    <div class="form-group message">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message" required="" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success custom-sms-form-btn wd-100">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end --> 

<!-- start pre loading -->
<div id="preLoading" style="display:none;margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: #66666652; z-index: 30001; opacity: 1;">
<div style="position: absolute;top: 50%; left: 45%;">
<img src="<?= base_url('public/front/ajax-loader.gif') ?>" style="height: 80px;width: 80px;">
</div>
</div>
<!-- end pre loading -->

<?php include('include/footer.php');?>  
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
$('.mydatepicker').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY', 
    minDate : new Date()
});
$('.search_datepicker').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY', 
    //minDate : new Date()
});
$('#next_followup_time').bootstrapMaterialDatePicker({
    format: 'HH:mm a',
    time: true,
    date: false,
   shortTime: true,
   twelvehour: false
});
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}
$('#selectLocation').select2();

function followupStatus(id) {
  if (id=='Complete' || id=='Cancel') {
    $("#followUpTabModal").modal('show');
  }
}

var page = 1;
get_customer_list();

function get_customer_list() {
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
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/get_customer_list'); ?>",
    data: {page:page,filter_by:filter_by,search_text:search_text,search_date_from:search_date_from,search_date_to:search_date_to,search_state_id:search_state_id,search_city_id:search_city_id,search_source_id:search_source_id,search_stage_id:search_stage_id,search_status:search_status,search_location_id:search_location_id,search_budget_min:search_budget_min,search_budget_max:search_budget_max,search_size_min:search_size_min,search_size_max:search_size_max,search_size_unit:search_size_unit,search_agent_id:search_agent_id},
    beforeSend: function() {
      $(".error-msg-left").html('');
      $(".load-more").hide();
      $(".bottom-loader").show();
    },
    success: function (response) {
      setTimeout(function() {
        var obj;
        try {
          obj = JSON.parse(response);
          if (obj.status=='success') {
            $(".load-more").show();
            $(".bottom-loader").hide();
            $(".total_records").text(obj.total_records);
            var records = obj.records;

            var html = "";
            for (var i = 0; i < records.length; i++) {
              var record = records[i];

var lead_mobile_no = "";
var lead_email = "";
if(record.lead_mobile_no) {
  lead_mobile_no = "<div class='col-md-12'><h6 class='card-text text-muted ft-sm pt-1'><i class='fa fa-phone'></i> <span>+91"+record.lead_mobile_no+"</span></h6></div>";
}
if(record.lead_email) {
  lead_email = "<div class='col-md-12'><h6 class='card-text text-muted ft-sm pt-1'><i class='fa fa-envelope'></i> <span>"+record.lead_email+"</span></h6></div>";
}
html += "<div class='customer' style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 10px;margin-bottom: 10px;' onclick='showCustomer("+record.lead_id+")'>"+
"    <div class='row'>"+
"    <div class='col-md-2' align='center'>"+
"      <img class='mr-3' src='<?= base_url('public/front/user.png') ?>' style='margin-top: 5px;border-radius:50%;' width='45' height='45' alt=''>"+
"    </div>"+
"    <div class='col-md-10'>"+
"      <div class='row'>"+
"        <div class='col-md-8'>"+
"          <h6 class='card-text text-muted ft-14'><i class='fa fa-user'></i> "+record.lead_title+" "+record.lead_first_name+" "+record.lead_last_name+"</h6>"+
"        </div>"+
"        <div class='col-md-4' align='right'>"+
"          <h6 class='card-text text-muted ft-sm'>"+record.lead_date+"</h6>"+
"        </div>"+
"      </div>"+
"      <div class='row' style='margin-top: 5px;'>"+lead_mobile_no+lead_email+
"      </div>"+
"    </div>"+
"  </div>"+
"</div>";
            }

            $(".lead-list").append(html);

            if(obj.total_records==0) {
              $(".lead-list").html("<div class='text-center text-muted pt-2'>--- No Customers ---</div>");
              $(".load-more").hide();
            }
            else if(obj.next_page!=0) {
              page = obj.next_page;
              $(".load-more").show();
            }
            else {
              $(".load-more").hide();
              $(".lead-list").append("<div class='text-center text-muted pt-2'>--- No More Customers ---</div>");
            }
          }
          else {
             $(".load-more").hide();
             $(".bottom-loader").hide();
            $(".error-msg-left").html(alertMessage('error',obj.message));
          }
        }
        catch(err) {
           $(".load-more").hide();
           $(".bottom-loader").hide();
           $(".error-msg-left").html(alertMessage('error','Some error occurred, please try again.'));
        }
      },500);
    },
    error: function () {
     $(".load-more").hide();
     $(".bottom-loader").hide();
     $(".error-msg-left").html(alertMessage('error','Some error occurred, please try again.'));
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
  $(".search_box").show();
  page = 1;
  $(".lead-list").html("");
  $(".total_records").text('0');
  $(".customer_detail").html("");
  get_customer_list();
}


function searchData() {
  filterData();
  return false;
}
function showCustomer(id) {
  $(".search-btn").show();
  $(".search_box").hide();
  $(".customer_detail").hide();
  setTimeout(function() {
    get_customer(id);
  },100)
}

function get_customer(id) {
   $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/get_customer'); ?>",
    data: {id:id},
    beforeSend: function() {
      $(".error-msg-right").html('');
      $(".detail-loader").show();
    },
    success: function (response) {
      setTimeout(function() {
        $(".customer_detail").show();
        $(".detail-loader").hide();
        
        if (response!="error") {
          $(".customer_detail").html(response);
        }
        else {
            $(".customer_detail").html("");
            $(".error-msg-right").html(alertMessage('error','Some error occurred, please try again.'));
        }
        
      },100);
    },
    error: function () {
     $(".detail-loader").hide();
     $(".error-msg-right").html(alertMessage('error','Some error occurred, please try again.'));
    }

  });
}

function getRequirementList(lead_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_customer_requirement_list') ?>",
        data: {lead_id:lead_id},
        beforeSend: function (data) {
            $(".requirement_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
        },
        success: function (response) {
          setTimeout(function(){
              var obj;
              try {
                obj = JSON.parse(response);
                if (obj.status=='success') {
                  var requirement_list = obj.requirement_list;
                  var html = "";
                  for (var i = 0; i<requirement_list.length; i++) {
                    var requirement_status = "";
                    if (requirement_list[i].requirement_status=='1') {
                        requirement_status = "<span class='label label-pill label-success' style='padding: 3px 10px;'>Open</span>";
                    }
                    else if (requirement_list[i].requirement_status=='0') {
                        requirement_status = "<span class='label label-pill label-danger' style='padding: 3px 10px;'>Close</span>";
                    }

                    var price = requirement_list[i].budget_min;
                    if(requirement_list[i].budget_min!=""){
                      price += "-";
                    }
                    price += requirement_list[i].budget_max;

                    var size = requirement_list[i].size_min;
                    if(requirement_list[i].size_min!=""){
                      size += "-";
                    }
                    size += requirement_list[i].size_max;
                    if(size!="") {
                      size += " "+requirement_list[i].size_unit;
                    }

                    html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'>"+
"    <div class='row align-items-center'>"+
"        <div class='col-md-4 py-2'>"+
"            <label>Requirement Id:</label> <strong>"+requirement_list[i].requirement_id+"</strong>"+
"        </div>"+
"        <div class='col-md-4 py-2'>"+
"            <label>Date:</label> <strong>"+requirement_list[i].dor+"</strong>"+
"        </div>"+
"        <div class='col-md-4 py-2' align='right'>"+
"            <label>Status:</label> <strong>"+requirement_status+"</strong>"+
"        </div>"+
"        <div class='col-md-12 py-2'>"+
"            <label class='pr-2'>Looking For:</label> <strong>"+requirement_list[i].look_for+"</strong>"+
"        </div>"+
"        <div class='col-md-12 py-2'>"+
"            <label class='pr-2'><i class='fa fa-map-marker fa-lg'  aria-hidden='true'></i></label> <strong>"+requirement_list[i].location+"</strong>"+
"        </div>"+
"        <div class='col-md-6 py-2'>"+
"            <label class='pr-2'>Budget:</label> <strong>"+price+"</strong>"+
"        </div>"+
"        <div class='col-md-6 py-2'>"+
"            <label class='pr-2'>Size:</label> <strong>"+size+"</strong>"+
"        </div>"+
"        <div class='col-md-8 py-2'>"+
"            <label class='pr-2'>Remarks :</label> <strong>"+requirement_list[i].remark+"</strong>"+
"        </div>"+
"        <div class='col-md-8 py-2'>"+
"            <label class='pr-2'>Agent :</label> <strong>"+requirement_list[i].agent_name+", "+requirement_list[i].dor+"</strong>"+
"        </div>"+
"        <div class='col-md-4 py-2' align='right'>"+
"            <!--<button type='button' class='btn btn-success btn-sm' onclick='reqFormModal("+requirement_list[i].requirement_id+",2,"+requirement_list[i].lead_id+")' style='color: white;'><i class='fa fa-edit'></i> Edit</button>-->"+
"        </div>"+
"    </div>"+
"</div>";
                  }

                  if (requirement_list.length==0) {
                    $(".requirement_list").html("<p class='text-center pt-3'>--- No Requirements ---</p>");
                  }
                  else {
                     $(".requirement_list").html(html);
                  }
                }
                else {
                  $(".requirement_list").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".requirement_list").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
           $(".requirement_list").html(alertMessage('error','Some error occurred, please try again.'));
        }

    });
}

function getReferenceList(lead_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_customer_reference_list') ?>",
        data: {lead_id:lead_id},
        beforeSend: function (data) {
            $(".reference_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
        },
        success: function (response) {
          setTimeout(function(){
              var obj;
              try {
                obj = JSON.parse(response);
                if (obj.status=='success') {
                  var reference_list = obj.reference_list;
                  var html = "";
                  for (var i = 0; i<reference_list.length; i++) {
                    var status = "";
                    if (reference_list[i].status=='1') {
                        status = "<span class='label label-pill label-info' style='padding: 3px 10px;'>Active</span>";
                    }
                    else if (reference_list[i].status=='2') {
                        status = "<span class='label label-pill label-danger' style='padding: 3px 10px;'>Dump</span>";
                    }
                    else if (reference_list[i].status=='3') {
                        status = "<span class='label label-pill label-success' style='padding: 3px 10px;'>Success</span>";
                    }

                    html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'>"+
"    <div class='row'>"+
"        <div class='col-md-8'>"+
"            <label>Agent Name:</label> <strong>"+reference_list[i].agent_name+"</strong>"+
"        </div>"+
"        <div class='col-md-4' align='right'>"+
"            <label></label> <strong>"+status+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>City:</label> <strong>"+reference_list[i].city_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>State:</label> <strong>"+reference_list[i].state_name+"</strong>"+
"        </div>"+
"        <div class='col-md-4'>"+
"            <label>DOR:</label> <strong>"+reference_list[i].lead_date+"</strong>"+
"        </div>"+
"        <div class='col-md-4'>"+
"            <label>Stage:</label> <strong>"+reference_list[i].lead_stage_name+"</strong>"+
"        </div>"+
"        <div class='col-md-4'>"+
"            <label>Source:</label> <strong>"+reference_list[i].lead_source_name+"</strong>"+
"        </div>"+
"        <div class='col-md-12'>"+
"            <label>Last Followup:</label> <strong>"+reference_list[i].last_followup+"</strong>"+
"        </div>"+
"        <div class='col-md-12'>"+
"            <label>Comment:</label> <strong>"+reference_list[i].last_followup_comment+"</strong>"+
"        </div>"+
"        <div class='col-md-12'>"+
"            <label>Next Followup:</label> <strong>"+reference_list[i].next_followup+"</strong>"+
"        </div>"+
"        <div class='col-md-12'>"+
"            <label>Remark:</label> <strong>"+reference_list[i].next_followup_remark+"</strong>"+
"        </div>"+
"    </div>"+
"</div>";
                  }

                  if (reference_list.length==0) {
                    $(".reference_list").html("<p class='text-center pt-3'>--- No References ---</p>");
                  }
                  else {
                     $(".reference_list").html(html);
                  }
                }
                else {
                  $(".reference_list").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".reference_list").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
           $(".reference_list").html(alertMessage('error','Some error occurred, please try again.'));
        }

    });
}

function getUnitList(lead_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_customer_unit_list') ?>",
        data: {lead_id:lead_id},
        beforeSend: function (data) {
            $(".unit_list").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
        },
        success: function (response) {
          setTimeout(function(){
              var obj;
              try {
                obj = JSON.parse(response);
                if (obj.status=='success') {
                  var unit_list = obj.unit_list;
                  var html = "";
                  for (var i = 0; i<unit_list.length; i++) {
                  var status = "";
                  if (unit_list[i].status=='1') {
                    status = "<span class='label label-pill label-success' style='padding: 3px 10px;'>Open</span>";
                  }
                  else if (unit_list[i].status=='0') {
                    status = "<span class='label label-pill label-danger' style='padding: 3px 10px;'>Close</span>";
                  }

                  html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'>"+
"    <div class='row'>"+
"        <div class='col-md-6'>"+
"            <label>Customer Name:</label> <strong>"+unit_list[i].customer_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>DOB:</label> <strong>"+unit_list[i].dob+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>S/D/W Of:</label> <strong>"+unit_list[i].sdw_title+" "+unit_list[i].sdw+"</strong>"+
"        </div>"+
"        <div class='col-md-12'>"+
"            <label>Address:</label> <strong>"+unit_list[i].address+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>City:</label> <strong>"+unit_list[i].city_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>State:</label> <strong>"+unit_list[i].state_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Product Type:</label> <strong>"+unit_list[i].product_type_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Unit Type:</label> <strong>"+unit_list[i].unit_type_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Project:</label> <strong>"+unit_list[i].project_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Tower:</label> <strong>"+unit_list[i].tower_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Floor:</label> <strong>"+unit_list[i].floor_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Size:</label> <strong>"+unit_list[i].size+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Unit No:</label> <strong>"+unit_list[i].unit_no+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Accommodation:</label> <strong>"+unit_list[i].accomodation_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Unit Ref No:</label> <strong>"+unit_list[i].unit_ref_no+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Deal Amount:</label> <strong>"+unit_list[i].deal_amount+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Booking Amount:</label> <strong>"+unit_list[i].booking_amount+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Payment Mode:</label> <strong>"+unit_list[i].payment_mode+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Cheque No/Ref No:</label> <strong>"+unit_list[i].cheque_no+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Drawn On:</label> <strong>"+unit_list[i].drawn_on+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Date:</label> <strong>"+unit_list[i].booking_date+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Remarks:</label> <strong>"+unit_list[i].remark+"</strong>"+
"        </div>"+
/*"        <div class='col-md-4' align='right'>"+
"            <label></label> <strong>"+status+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Unit Type:</label> <strong>"+unit_list[i].unit_type_name+"</strong>"+
"        </div>"+
"        <div class='col-md-12'>"+
"            <label>Location:</label> <strong>"+unit_list[i].location_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>City:</label> <strong>"+unit_list[i].city_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>State:</label> <strong>"+unit_list[i].state_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Agent Name:</label> <strong>"+unit_list[i].agent_name+"</strong>"+
"        </div>"+
"        <div class='col-md-6'>"+
"            <label>Action:</label> <strong>"+unit_list[i].listing_type+"</strong>"+
"        </div>"+*/
"    </div>"+
"</div>";
                }

                  if (unit_list.length==0) {
                    $(".unit_list").html("<p class='text-center pt-3'>--- No Units ---</p>");
                  }
                  else {
                     $(".unit_list").html(html);
                  }
                }
                else {
                  $(".unit_list").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".unit_list").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
           $(".unit_list").html(alertMessage('error','Some error occurred, please try again.'));
        }

    });
}

function add_to_followup(id) {

  $(".error-msg-right").html('');
  openFolloupModal(1,0,id);
}

$("#followup-form-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("followup-form-modal");
      var fd = new FormData(myform );
      var fid = $("#followup_id").val();
      var lid = $("#followup_lead_id").val();
      var btn_label = "Save";

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/add_to_followup') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".followup-error-msg").html('');
          $(".followup-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".followup-form-btn").html(btn_label);
                if (obj.status=='success') {

                  $("#followUpTabModal").modal('hide');
                  $(".error-msg-right").html(alertMessage('success',obj.message));
                   $(".btn-add-followup").css("visibility","hidden");
                   setTimeout(function(){
                    window.location.href="<?= base_url(ADMIN_URL.'followup') ?>";
                  },1000);

                }
                else {
                  $(".followup-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".followup-form-btn").html(btn_label);
                $(".followup-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".followup-form-btn").html(btn_label);
          $(".followup-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

function changeLeadStage() {
  var lead_stage_id = $("#lead_stage_id").val();
  if (lead_stage_id=='7') {
    $("#lead_status_id").val('2');
    $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #project_id, #task_desc").attr("disabled",true);
    $("#next_action").attr("required",false);
  }
  else if (lead_stage_id=='6') {
    $("#lead_status_id").val('3');
    $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #project_id, #task_desc").attr("disabled",true);
    $("#next_action").attr("required",false);
  }
  else {
    $("#next_action, #next_followup_date, #next_followup_time").attr("required",true);
    $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #project_id, #task_desc").attr("disabled",false);
  }
}

function openFolloupModal(status,id,lid) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/get_followup_stage_status'); ?>",
    data: {id:lid},
    beforeSend: function (data) {
      $("#preLoading").show();
    },
    success: function (response) {
      setTimeout(function(){
        $("#preLoading").hide();
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
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
            }
            else {
              alert(obj.message);
            }
          }
          catch(err) {
            closeFollowupModal();
            alert('Some error occurred, please try again.');
          }
      },100);
    },
    error: function () {

        $("#preLoading").hide();
        closeFollowupModal();
      alert('Some error occurred, please try again.');
    }

  });
}

function closeFollowupModal() {
  $("#followUpTabModal").modal('hide');
}

function get_lead_form(id) {
   $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/get_lead_form'); ?>",
    data: {id:id},
    beforeSend: function() {
      //$(".error-msg-right").html('');
      //$(".detail-loader").show();
      $("#preLoading").show();
    },
    success: function (response) {

      setTimeout(function() {
        $("#preLoading").hide();
        //$(".customer_detail").show();
        //$(".detail-loader").hide();
        
        if (response!="error") {

          $("#leadFormModal").modal({
              backdrop: 'static',
              keyboard: false
          });
          $(".lead_form").html(response);
        }
        else {
            //$(".customer_detail").html("");
            //$(".error-msg-right").html(alertMessage('error','Some error occurred, please try again.'));
        }
        
      },500);
    },
    error: function () {
      $("#preLoading").hide();
     //$(".detail-loader").hide();
     //$(".error-msg-right").html(alertMessage('error','Some error occurred, please try again.'));
    }

  });
}

function hideLeadEditModal(id){
  showCustomer(id)
  $("#leadFormModal").modal('hide');
}

var advance_search = 0;
$(".adv_btn").click(function(){
  if (advance_search==0) {
    advance_search = 1;
    $(".advance_search").show();
    $(".adv_btn").html('Hide Advance Search')
  }
  else {
    advance_search = 0;
    $(".advance_search").hide();
    $(".advance_search input").val('');
    $(".advance_search select").val('');
    $(".adv_btn").html('Advance Search')
  }
})

function getCitySearch(state_id) {
  $("#search_city_id").html("<option value=''>Select City</option>");
  $("#search_location_id").html("<option value=''>Select Location</option>");
  $.ajax({
        type: "POST",
        url: "<?= base_url('get_city') ?>",
        data: {state_id:state_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var city_list = obj.city_list;
              var row = "<option value=''>Select City</option>";
              for (var i = 0; i<city_list.length; i++) {
                row += "<option value='"+city_list[i].city_id+"'>"+city_list[i].city_name+"</option>";
              }
              $("#search_city_id").html(row);
            }
            else {
              $("#search_city_id").html("<option value=''>Select City</option>");
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

function getLocationSearch(city_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/get_locations') ?>",
        data: {city_id:city_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          console.log(response);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var location_list = obj.location_list;
              var row = "<option value=''>Select Location</option>";
              for (var i = 0; i<location_list.length; i++) {
                row += "<option value='"+location_list[i].location_id+"'>"+location_list[i].location_name+"</option>";
              }
              $("#search_location_id").html(row);
            }
            else {
              $("#search_location_id").html("<option value=''>Select Location</option>");
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

var budget_list = <?= json_encode($budget_list) ?>;
function selectMaxBudgetSearch(){
  var search_budget_min = parseInt($('#search_budget_min').val());

  var html = "<option value=''>Select Max</option>";
  for (var i = 0; i < budget_list.length; i++) {
    if (parseInt(budget_list[i].budget_id)>=search_budget_min) {
      html +="<option value='"+budget_list[i].budget_id+"'>"+budget_list[i].budget_name+"</option>";
    }
  }
  $('#search_budget_max').html(html);
}


// custom sms

var template_list = [];
function get_sms_form(type,user_id,send_to) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(ADMIN_URL.'api/get_sms_form'); ?>",
    data: {type:type},
    beforeSend: function (data) {
      $(".loader_progress").show();
    },
    success: function (response) {
      setTimeout(function() {
       

        $(".loader_progress").hide();
        var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                   $("#formModalCustomSMS").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                   var title = "";
                   if (type=="1") {
                    title = "Send SMS";
                   }
                   else if (type=="2") {
                    title = "Send Email";
                   }
                   else if (type=="3") {
                    title = "Send Whatsapp Message";
                   }
                   $("#formModalCustomSMS .modal-title").html(title);
                   $("#send_to").val(send_to);
                   $("#user_id").val(user_id);
                   $("#type").val(type);

                   template_list = obj.template_list;
              var row = "<option value=''>Select Template</option>";
              for (var i = 0; i<template_list.length; i++) {
                row += "<option value='"+template_list[i].template_id+"'>"+template_list[i].template_name+"</option>";
              }
              row += "<option value='0'>Custom Message</option>";
              $("#template_id").html(row);
                   //$(".msg").html(obj.message);

                   changeTemplate();
                }
                else {
                  alert(obj.message);
                }
              }
              catch(err) {
                alert('Some Error Occured.');
              }

      },100);
    },
    error: function () {
      $(".loader_progress").hide();
      alert('Some Error Occured.');
    }

  });
  }

  function changeTemplate() {
      var template_id = $("#template_id").val();
      var type = $("#type").val();

      $("#subject").prop("required",false);
      //alert(template_id);
      if (template_id!="") {
          if (type=='1') {
            $(".subject").hide();
            $(".message").show();
          }
          else if (type=='2') {
            $(".subject").show();
            $(".message").show();
            $("#subject").prop("required",true);
          }
          else if (type=='3') {
            $(".subject").hide();
            $(".message").show();
          }
          else {
            $(".subject").hide();
            $(".message").hide();
          }

          var f_message = "";
          var f_subject = "";
          for (i = 0; i < template_list.length; i++) {
            var row = template_list[i];
            if (row.template_id==template_id) {
                f_message = row.template_message;
                f_subject = row.template_subject;
            }
          }
          $("#message").val(f_message);
          $("#subject").val(f_subject);
      }else {
        $(".subject").hide();
            $(".message").hide();
      }
  }

  $("#custom-sms-form-main").validate({
    rules: {
        
    },
    messages: {
        
    },
    submitHandler: function(form) {

      var myform = document.getElementById("custom-sms-form-main");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/send_sms_whatsapp_email') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".custom-sms-error-msg").html('');
          $(".custom-sms-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".custom-sms-form-btn").html("Send");

                if (obj.status=='success') {
                    $("#formModalCustomSMS").modal('hide');
                    $.toast({
                        heading: 'Success',
                        text: obj.message,
                        icon: 'success',
                        position: 'top-center',
                    });
                }
                else {
                  $(".custom-sms-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".custom-sms-form-btn").html("Send");
                $(".custom-sms-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
          $(".custom-sms-form-btn").html("Send");
          $(".custom-sms-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
</script>