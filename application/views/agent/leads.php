<?php include('include/header.php'); ?>


<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

<style>
  .lead-list .customer.active,
  .lead-list .customer:hover {
    background: #fff;
    border: 1px solid #ffa96980 !important;
  }

  .lead-list {
    margin: 2rem 0;
  }

  .lead-list .customer {
    border: 1px solid transparent;
    box-shadow: 2px 2px 10px #80808040;
    border-radius: 8px;
    margin: 1rem;
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
</style>


<!--  -->
<style>
  #lead-unit-form .form-heading {
    font-family: Roboto;
    font-size: 18px;
    color: #272523d6;
  }

  .theme-form .form-control {
    border-radius: 5px;
    font-family: Roboto;
    font-size: 14px;
  }

  .theme-form label {
    font-family: Roboto;
    font-size: 15px;
    color: #272523d6;
    font-weight: 500;
    margin-bottom: 4px;
  }

  .lead-unit-form-view {
    margin: 0 1rem;
  }

  body {
    overflow-y: hidden !important;
  }

  .customer {
    margin: 5px;
  }
</style>
<!--  -->


<?php include('include/sidebar.php'); ?>

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
                    <h4 class="card-title">Leads ( <span class="total_records">0</span> )</h4>
                  </div>
                  <div class="col-md-6" align="right">
                    <select class="form-control" style="height: 30px !important;min-height: 30px;padding: 0px 5px;width: 155px;" id="filter_by" onchange="filterData()">
                      <option value="due_followup" selected>Due Followup </option>
                      <option value="new_leads">New Leads</option>
                    </select>
                  </div>


                  <div class="col-md-12">

                    <div style="height: 67vh;overflow-y: auto;overflow-x: hidden;">
                      <div class="lead-list"></div>

                      <div class="error-msg-left"></div>
                      <div class="wrapper-bottom" align="center">
                        <div class="load-more" onclick="get_followup_list()">Load More</div>

                        <div class="bottom-loader">
                          <img src="<?= base_url('public/front/ajax-loader.gif'); ?>">
                        </div>
                      </div>

                    </div>

                  </div>

                </div>
              </div>

              <div class="col-md-7">
                <div>

                  <div class="search-btn"><i class="fa fa-search"></i></div>

                  <div class="error-msg-right"></div>
                  <div class="detail-loader text-center">
                    <img src="<?= base_url('public/front/ajax-loader.gif'); ?>">
                  </div>
                  <div class="customer_detail">

                  </div>

                  <div class="pt-4 pl-5 pr-5 search_box" style="height: 76vh;overflow-y: auto;overflow-x: hidden;">
                    <h4 class="text-center mb-4">Dashboard</h4>

                    <form class="mt-4" method="post" onsubmit="return searchData()">
                      <div class="form-group">
                        <input type="text" class="form-control input-lg" id="search_text" placeholder="Search By Name/ Mobile No/ Email Id" style="height: 45px;border-radius: 6px;">
                      </div>

                      <div class="form-group advance_search" style="padding-bottom: 8px;">
                        <div class="row">
                        <!-- Lead Date Filter -->
                         <div class="col-md-12">
                          <div class="text-left">
                            <h4>
                              Leads
                            </h4>
                          </div>
                         </div>
                         <div class="col-md-6">
                          <div class="form-group">
                            <label for="">From</label>
                            <input type="date" id="lead_from" name="lead_from" class="form-control">
                         </div>
                         </div>
                         <div class="col-md-6">
                          <div class="form-group">
                            <label for="">To</label>
                            <input type="date" id="lead_to" name="lead_to" class="form-control">
                         </div>
                         </div>
                         <!-- End Lead Date Filter -->
                         
                         <!-- Followup Date Filter -->
                         <div class="col-md-12">
                          <div class="text-left">
                          <h4>  
                          Followup
                          </h4>
                        </div>
                         </div>
                         <div class="col-md-6">
                          <div class="form-group">
                            <label for="">From</label>
                            <input type="date" id="followup_from" name="followup_from" class="form-control">
                         </div>
                         </div>
                         <div class="col-md-6">
                          <div class="form-group">

                            <label for="">From</label>
                            <input type="date" id="followup_to" name="followup_to" class="form-control">
                          </div>
                         </div>
                        <!-- End Followup Date Filter -->

                          <div class="col-md-6">
                            <div class="form-group">
                            <select class="form-control" id="search_state_id" name="search_state_id" onchange="getCitySearch(this.value)" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                              <option value="">Select State</option>
                              <?php foreach ($state_list as $state) { ?>
                                <option value="<?= $state->state_id ?>"><?= $state->state_name ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                            <select class="form-control" id="search_city_id" name="search_city_id" style="height: 38px;border-radius: 6px;margin-top: 10px;" onchange="getLocationSearch(this.value)">
                              <option value="">Select City</option>
                            </select>
                          </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                            <select class="form-control" id="search_location_id" name="search_location_id" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                              <option value="">Select Location</option>
                            </select>
                          </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                            <select class="form-control" id="search_agent_id" name="search_agent_id" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                              <option value="">Select Agent</option>
                              <?php foreach ($filter_user_list as $item) { ?>
                                <option value="<?= $item->user_id ?>"><?= ($item->parent_id == 0) ? (($item->is_individual) ? (ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name)) : $item->firm_name) : $item->first_name . ' ' . $item->last_name . (($item->parent_id) ? ' (Team)' : '') ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          </div>


                          <div class="col-md-4">
                            <select class="form-control" id="search_source_id" name="search_source_id" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                              <option value="">Select Source</option>
                              <?php foreach ($lead_source_list as $lead_source) { ?>
                                <option value="<?= $lead_source->lead_source_id ?>"><?= $lead_source->lead_source_name ?></option>
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
                            
                          <?php if(user()->role_id == 1 || user()->role_id == 5 || true): ?>
                          <div class="col-md-4">
                            <select class="form-control" id="search_status" name="search_status" style="height: 38px;border-radius: 6px;margin-top: 10px;">
                              <option value="">Select Status</option>
                              <?php foreach ($lead_type_list as $item) { ?>
                                <option value="<?= $item->lead_type_id ?>"><?= $item->lead_type_name ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-group text-right">
                      <a class="btn btn-dark text-white" href="<?= base_url(AGENT_URL . 'lead-detail/') ?>"> Add New </a>
                        <button type="submit" class="btn btn-dark search_btn">Search</button>&nbsp;&nbsp;

                        <?php if (isset($menu_item_array['followup_advance_search']) && $menu_item_array['followup_advance_search']['rr_view']) { ?>
                          <button type="button" class="btn btn-dark adv_btn">Advance Search</button>&nbsp;&nbsp;
                          
                          <?php if(user()->role_id == 1 || user()->role_id == 2): ?>
                          <button type="button" class="btn btn-info" onclick="downloadLeads()">Download</button>
                          <?php endif; ?>
                        <?php } ?>
                        
                      </div>
                    </form>

                    <div class="search-overall pt-4">
                      <div class="row">
                        <div class="col-lg-3 col-sm-6">
                          <div class="card gradient-2">
                            <div class="card-body" style="padding: 13px 10px 4px 10px !important;">
                              <h3 class="card-title text-white" style="font-size: 14px;margin-bottom: 5px;">New Leads</h3>
                              <div class="d-inline-block">
                                <h2 class="text-white" style="font-size: 24px;"><?= $total_new_leads ?></h2>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                          <div class="card gradient-1">
                            <div class="card-body" style="padding: 13px 10px 4px 10px !important;">
                              <h3 class="card-title text-white" style="font-size: 14px;margin-bottom: 5px;">Total Followup</h3>
                              <div class="d-inline-block">
                                <h2 class="text-white" style="font-size: 24px;"><?= $total_followup ?></h2>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <div class="card gradient-2">
                            <div class="card-body" style="padding: 13px 10px 4px 10px !important;">
                              <h3 class="card-title text-white" style="font-size: 14px;margin-bottom: 5px;">Today Followup</h3>
                              <div class="d-inline-block">
                                <h2 class="text-white" style="font-size: 24px;"><?= $today_followup ?></h2>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <div class="card gradient-3">
                            <div class="card-body" style="padding: 13px 10px 4px 10px !important;">
                              <h3 class="card-title text-white" style="font-size: 14px;margin-bottom: 5px;">Missed Followup</h3>
                              <div class="d-inline-block">
                                <h2 class="text-white" style="font-size: 24px;"><?= $missed_followup ?></h2>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="followup-chart pt-2">
                      <h4 class="card-title text-center pb-2">Meeting</h4>

                      <div id="followup-pie-chart" class="flot-chart" style="height: 180px;"></div>
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

</div>

<!-- start requirement modal -->
<div class="modal fade" id="requirementModal"  role="dialog" aria-hidden="true">
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
<div class="modal fade" id="followUpTabModal" role="dialog" aria-hidden="true">
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
            <div class="col-md-6 booking_hide" style="margin-top: 10px;">
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
            <div class="col-md-6 booking_hide" style="margin-top: 10px;">
              <label>Next Action:</label>
              <select class="form-control" id="next_action" name="next_action" onchange="nextAction()">
                <option value="">Select Next Action</option>
                <?php foreach ($lead_action_list as $item) { ?>
                  <option value="<?= $item->lead_action_id ?>"><?= $item->lead_action_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6 booking_hide" style="margin-top: 10px;">
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
              <select class="form-control" id="fp_project_id" name="fp_project_id[]" multiple="" style="width: 100%;">
                <?php foreach ($product_list as $item) { ?>
                  <option value="<?= $item->product_id ?>"><?= $item->project_name ?></option>
                <?php } ?>
              </select>
              <label id="fp_project_id-error" class="error" for="fp_project_id" style=""></label>
            </div>

            <div class="col-md-6" style="margin-top: 10px;">
              <label>Assign To:</label>
              <select class="form-control" id="fp_assign_to" name="fp_assign_to">
                <option value="">Select User</option>
                <?php foreach ($user_list as $item) { ?>
                  <option value="<?= $item->user_id ?>"><?= (($item->parent_id == 0) ? (($item->is_individual) ? ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name) : $item->firm_name) : ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name)) ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-12 booking_hide" style="margin-top: 10px;">
              <label>Task Description:</label>
              <textarea class="form-control" rows="2" id="task_desc" name="task_desc"></textarea>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <div class="booking_form"></div>
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
<div class="modal fade" id="leadFormModal" role="dialog" aria-hidden="true">
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
          <input type="hidden" name="f_id" id="f_id">
          <textarea name="feedback_ids" id="feedback_ids" style="display: none;"></textarea>
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
                  <input type="text" class="form-control material_date" name="visit_date" id="visit_date" placeholder="Date" value="" />
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control material_time" name="visit_time" id="visit_time" placeholder="Time" value="" />
                </div>
              </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Comment:</label>
              <textarea class="form-control" name="comment" id="visit_comment" rows="2" required></textarea>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Customer Offer:</label>
              <input type="text" class="form-control" name="customer_offer" id="customer_offer" value="">
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

<!-- start booking modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Booking Application Request</h5>
        <button type="button" class="close" onclick="closeBookingModal()" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bookingBody">

      </div>
    </div>
  </div>
</div>
<!-- end booking modal -->

<!-- modal form -->
<div class="modal fade" id="formModal" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" budget="document">
    <div class="modal-content">

      <form id="md-form-main" method="post">
        <input type="hidden" class="form-control" id="fid" name="id" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Share</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="md-error-msg"></div>
          <!--<div><p class="msg"></p></div>-->
          <input type="hidden" class="form-control" id="share_lead_id" name="share_lead_id" required="" readonly="">
          <input type="hidden" class="form-control" id="share_project_id" name="share_project_id" required="" readonly="">
          <input type="hidden" class="form-control" id="share_project_link" name="share_project_link" required="" readonly="">
          <input type="hidden" class="form-control" id="share_project_name" name="share_project_name" required="" readonly="">

          <div class="form-group">
            <label for="send_type" class="col-form-label">Share By:</label>
            <select class="form-control" id="send_type" name="send_type" required="">
              <option value="">-- Select --</option>
              <option value="1">SMS</option>
              <option value="2">Email</option>
              <option value="3">Whatsapp</option>
            </select>
          </div>

          <!--<div class="form-group">
                        <label for="mobile_otp" class="col-form-label">Send To:</label>
                        <input type="text" class="form-control" id="send_to" name="send_to" required="" readonly="">
                    </div>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success md-form-btn wd-100">Share</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- modal end -->

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
            <input type="text" class="form-control" id="subject" name="subject">
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

<div class="loader_progress"></div>

<?php include('include/footer.php'); ?>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<!--  flot-chart js -->
<script src="<?php echo base_url('public/admin/') ?>plugins/flot/js/jquery.flot.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/flot/js/jquery.flot.pie.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/flot/js/jquery.flot.resize.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/flot/js/jquery.flot.spline.js"></script>
<!--<script src="<?php echo base_url('public/admin/') ?>plugins/flot/js/jquery.flot.init.js"></script>-->
<script>
  var all_unit_type_list = <?= json_encode($all_unit_type_list) ?>;

  $(function() {
    'use strict';

    var piedata = [
      <?php foreach ($pie_chart_values as $item) { ?> {
          label: "<?= $item['label'] ?>",
          data: [
            [1, <?= $item['value'] ?>]
          ],
          color: '<?= $item['color'] ?>'
        },
      <?php } ?>
    ];

    $.plot('#followup-pie-chart', piedata, {
      series: {
        pie: {
          show: true,
          radius: 1,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }
        }
      },
      grid: {
        hoverable: true,
        clickable: true
      },
      legend: {
        show: true
      }
    });

    function labelFormatter(label, series) {
      return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }

  });
</script>

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
  $('#fp_project_id').select2();

  function nextAction() {
    var next_action = $("#next_action").val();
    if (next_action == 2) {
      $("#fp_project_id").prop('required', true);
    } else {
      $("#fp_project_id").prop('required', false);
    }
    $("#fp_project_id").val('').trigger('change');
  }

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
  get_followup_list();

  function get_followup_list() {
    var filter_by = $("#filter_by").val();
    var search_text = $("#search_text").val();

    /** Lead Filter */
    var lead_from                 =   $("#lead_from").val();
    var lead_to                   =   $("#lead_to").val();
    /** End Lead Filter */
    
    /** Follow Up Filter */
    var followup_from             =   $("#followup_from").val();
    var followup_to               =   $("#followup_to").val();
    /** End Follow Up Filter */

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
      url: "<?php echo base_url(AGENT_URL . 'api/get_followup_list'); ?>",
      data: {
        page                    : page,
        filter_by               : filter_by,
        search_text             : search_text,
        
        lead_from               : lead_from,
        lead_to                 : lead_to,

        followup_from           : followup_from,
        followup_to             : followup_to,

        search_state_id         : search_state_id,
        search_city_id          : search_city_id,
        search_source_id        : search_source_id,
        search_stage_id         : search_stage_id,
        search_status           : search_status,
        search_location_id      : search_location_id,
        search_agent_id         : search_agent_id
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

                var next_followup_date = "";
                if (record.next_followup_date != null && record.next_followup_date != '') {
                  next_followup_date = record.next_followup_date;
                }

                is_followup = record.is_followup == 1 ? 'text-warning' : 'text-muted';
                is_email = record.lead_email == '' ? 'd-none' : '';

                // html += "<div class='customer' onclick='showCustomer(" + record.lead_id + ",0)'>" +
                //   "    <div class='row'>" +
                //   "    <div class='col-md-2' style='' align='center'>" +
                //   "      <img class='mr-3' src='<?= base_url('public/front/user.png') ?>' style='margin-top: 5px;border-radius:50%;' width='45' height='45' alt=''>" +
                //   "    </div>" +
                //   "    <div class='col-md-10' style=''>" +
                //   "      <div class='row'>" +
                //   "        <div class='col-md-8'>" +
                //   "          <div class='card-text "+is_followup+"'><i class='fa fa-user'></i> " + record.lead_title + " " + record.lead_first_name + " " + record.lead_last_name + "</div>" +
                //   "<div class='card-text text-muted'><i class='fa fa-phone'></i> <span style='font-size: 12px;'>+91" + record.lead_mobile_no + "</span></div>" +
                //   "<div class='card-text text-muted'><div style='display: inline-block;width:20px;vertical-align:top;'><i class='fa fa-envelope' style='font-size: 12px;'></i></div><div style='width:calc(100% - 30px);display: inline-block;padding:2px;'><div style='font-size: 12px;display: table-cell;line-height: 16px;word-break: break-word;'>" + record.lead_email + "</div></div></div>" +
                //   "        </div>" +
                //   "        <div class='col-md-4' align='right' style='font-size: 11px;line-height: 15px !important;'>" + "<div class='text-muted l_next_followup_" + record.lead_id + "'>" + next_followup_date + "</div><div class='text-muted pt-1'>" + record.lead_stage_name + "</div><div class='text-muted'>" + record.lead_source_name + "</div>" +
                //   "        </div>" +
                //   "      </div>" +
                //   "    </div>" +
                //   "  </div>" +
                //   "</div>";

             
                delete_lead_btn         =  <?php if(user()->role_id == 1 || user()->role_id == 5): ?> `<div class="delete-lead" data-id="${record.lead_id}"><i class="fa fa-times"></i></div>`<?php else: ?> '' <?php endif;?>;
                 
                html += `<div class='customer position-relative'>
                    ${delete_lead_btn}
                     <div class='row data-add-${record.lead_id}'  onclick='showCustomer(${record.lead_id},0)'>

                     <div class='col-md-2' style='' align='center'>
                       <img class='mr-3' src='${record.full_profile_url}' style='border-radius:50%;' width='45' height='45' alt=''>
                     </div>
                     
                     <div class='col-md-10'>
                       <div class='row'>
                         <div class='col-md-6'>
                           <div class='card-text ${is_followup}'>
                           <i class='fa fa-user pr-2 d-none'></i> 
                           ${record.lead_title} ${record.lead_first_name} ${record.lead_last_name} </div>
                         </div>

                          <div class='col-md-6'>
                          <div class='card-text text-right text-muted'>
                              ${record.stage_name}
                            </div>
                          </div>

                          <div class='col-md-7'>
                            <div class='card-text text-muted'>
                              ${record.lead_or_next_followp_date_and_time}
                            </div>
                          </div>

                          <div class='col-md-5'>
                           <div class='card-text text-right text-muted'>
                              ${record.lead_source_name}
                           </div>
                        </div>
                       </div>
                     </div>
                   </div>
                 </div>`;
              }

              $(".lead-list").append(html);

              if (obj.total_records == 0) {
                $(".lead-list").html("<div class='text-center text-muted pt-2'>--- No Followup ---</div>");
                $(".load-more").hide();
              } else if (obj.next_page != 0) {
                page = obj.next_page;
                $(".load-more").show();
              } else {
                $(".load-more").hide();
                $(".lead-list").append("<div class='text-center text-muted pt-2'>--- No More Followup ---</div>");
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
        $(".search_btn").attr("disabled", false);
        $(".load-more").hide();
        $(".bottom-loader").hide();
        $(".error-msg-left").html(alertMessage('error', 'Some error occurred, please try again.'));
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
    get_followup_list();
  }

  function searchData() {
    filterData();
    return false;
  }

  $(document).on('click', '.lead-list .customer', function() {
    $('.lead-list .customer').removeClass('active')
    $(this).addClass('active')
  })

  function showCustomer(id, def) {

    $(".search-btn").show();
    $(".customer_detail").hide();
    $(".search_box").hide();
    setTimeout(function() {
      get_followup(id, def);
    }, 100)
  }

  function get_followup(id, def) {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/get_followup'); ?>",
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

    var is_show = 0;
    for (var j = 0; j < all_unit_type_list.length; j++) {
      if (all_unit_type_list[j].unit_type_id == unit_type_id && all_unit_type_list[j].requirement_accomodation == "1") {
        is_show = 1;
      }
    }
    if (is_show == 1) {
      $(".accomodation").css("visibility", "visible");
    } else {
      $(".accomodation").css("visibility", "hidden");
      $("#accomodation_id").val('');
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

      unitType();
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
                  "        <div class='col-md-12'>" +
                  "            <label>Budget:</label> <strong>" + requirement_list[i].budget_min + "-" + requirement_list[i].budget_max + "</strong>," +
                  "            <label>Size:</label> <strong>" + requirement_list[i].size_min + "-" + requirement_list[i].size_max + " " + requirement_list[i].size_unit + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-12'>" +
                  "            <label>Remarks:</label> <strong>" + requirement_list[i].remark + "</strong>" +
                  "        </div>" +
                  "        <div class='col-md-8'>" +
                  "            <label>Added By:</label> <strong>" + requirement_list[i].added_by + "</strong>" +
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
    var feedback_ids = $('.chk_btn:checked').map(function() {
      return this.value;
    }).get().join(',');
    if (type == 1) {
      if (feedback_ids == "") {
        alert("Please select at least one property");
      } else {


        $("#feedbackFormModal").modal('show');
        $("#feedbackFormModal input[type='text']").val('');
        $("input[name=like_property][value=0]").prop('checked', true);
        $("#feedbackFormModal textarea").val('');

        $("#flid").val(lid);
        $("#f_id").val("");
        $("#feedback_ids").val(feedback_ids);
        $(".feedback-error-msg").html('');

        $("#feedbackFormModal .modal-title").text('Feedback');

        $(".feedback-form-btn").text('Submit');

      }
    } else {

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/get_feedback_single') ?>",
        data: {
          feedback_id: id
        },
        beforeSend: function(data) {},
        success: function(response) {
          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              if (obj.status == 'success') {
                var feedback_data = obj.feedback_data;

                $("#feedbackFormModal").modal('show');
                $("#feedbackFormModal input[type='text']").val('');
                $("#feedbackFormModal textarea").val('');

                $("#flid").val(lid);
                $("#f_id").val(id);
                $("#feedback_ids").val("");
                $(".feedback-error-msg").html('');

                if (feedback_data.like_property == '1') {
                  $("input[name=like_property][value=1]").prop('checked', true);
                } else if (feedback_data.like_property == '0') {
                  $("input[name=like_property][value=0]").prop('checked', true);
                }

                $("#visit_date").val(feedback_data.visit_date);
                $("#visit_time").val(feedback_data.visit_time);
                $("#visit_comment").val(feedback_data.comment);
                $("#customer_offer").val(feedback_data.customer_offer);

                $("#feedbackFormModal .modal-title").text('Feedback');

                $(".feedback-form-btn").text('Update');

              } else {

                alert('Some error occurred, please try again.');
              }
            } catch (err) {
              alert('Some error occurred, please try again.');

            }
          }, 500);
        },
        error: function() {
          alert('Some error occurred, please try again.');
        }

      });
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

      if ($("#f_id").val() == "") {
        btn_label = "Submit";
      } else {
        btn_label = "Update";
      }
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
              $(".feedback-form-btn").html(btn_label);
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
              $(".feedback-form-btn").html(btn_label);
              $(".feedback-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
            }
          }, 500);
        },
        error: function() {
          $(".feedback-form-btn").html(btn_label);
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

                var chk = "";
                var edit = "";
                if (feedback_list[i].feedback_id == "") {
                  chk = "<input type='checkbox' class='chk_btn'  value='" + feedback_list[i].requirement_id + "#" + feedback_list[i].property_id + "#" + feedback_list[i].type + "'>";
                } else {
                  edit = "<button type='button' class='btn btn-success btn-sm btn-rounded' onclick='feedbackFormModal(" + feedback_list[i].feedback_id + ",0," + lead_id + ")' style='color: white;' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button>";
                }

                edit += " &nbsp;&nbsp;<a href='" + feedback_list[i].project_url + "' target='_blank' class='btn btn-info btn-sm btn-rounded' style='color:white;' data-toggle='tooltip' data-placement='top' title='View Project'><i class='fa fa-eye'></i></a>&nbsp;&nbsp;<button type='button' class='btn btn-dark btn-sm btn-rounded' style='color:white;outline:none;' data-toggle='tooltip' data-placement='top' title='Share Project' onclick='share_project(\"" + feedback_list[i].project_url + "\",\"" + feedback_list[i].lead_mobile + "\",\"" + feedback_list[i].lead_email + "\",\"" + feedback_list[i].lead_id + "\",\"" + feedback_list[i].pid + "\",\"" + feedback_list[i].project_name + "\")'><i class='fa fa-share'></i></button>";

                var visit_status = "";
                if (feedback_list[i].visit_status == "Yes") {
                  visit_status = "<i class='fa fa-thumbs-o-up text-info' style='font-size:22px;font-weight:bold;'></i>";
                } else if (feedback_list[i].visit_status == "No") {
                  visit_status = "<i class='fa fa-thumbs-o-down text-danger' style='font-size:22px;font-weight:bold;'></i>";
                }

                html += "<div style='border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;'> <div class='row'> <div class='col-md-1' align='center'>" + chk + " </div> <div class='col-md-11'> <div class='row'> <div class='col-md-12'> <label>" + feedback_list[i].size + ((feedback_list[i].accomodation_name) ? ", " + feedback_list[i].accomodation_name : '') + ", " + feedback_list[i].product_type_name + ", " + feedback_list[i].unit_type_name + " @ " + ((feedback_list[i].project_name != '') ? feedback_list[i].project_name + ', ' : '') + feedback_list[i].location_name + ", " + feedback_list[i].city_name + ", " + feedback_list[i].state_name + "</label> </div> <div class='col-md-6'> <label>" + feedback_list[i].budget + "</label> </div> <div class='col-md-6'> <label>Requirment Id: " + feedback_list[i].requirement_id + "</label> </div> <div class='col-md-6'> <label>Like Property: <strong>" + visit_status + "</strong></label> </div> <div class='col-md-6'> <label>" + feedback_list[i].date_user + "</label> </div> <div class='col-md-12'> <label>Comment: </label><strong>" + feedback_list[i].comment + "</strong> </div> </div> </div> </div> <div style='text-align:right;'>" + edit + "</div></div>";
              }



              if (feedback_list.length == 0) {
                $(".feedback_list").html("<p class='text-center pt-3'>--- No Records ---</p>");
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

  function scrollTopScreen() {
    $('html, body').animate({
      scrollTop: $("body").parent().offset().top
    }, 1000);
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

      var base_url_of_followup = 'followup_save';

      if($('#followup_id').val() == 0){
        var base_url_of_followup = 'add_to_followup';
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/') ?>"+base_url_of_followup,
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
                $('.lead-list').html('');
                get_followup_list();

                // if($('#followup_id').val() == 0){
                    $('.customer_detail').hide();
                    $('.search_box').show();
                // }
                // else{
                //   get_followup();
                // }
                
                $("#followUpTabModal input").val('');
                $("#followUpTabModal select").val('');
                $("#followUpTabModal textarea").val('');

                $("#followUpTabModal").modal('hide');
                $(".followup-error-msg").html(alertMessage('success', obj.message));
                $(".next_followup_" + lid).html(obj.next_followup);
                $(".l_next_followup_" + lid).html(obj.next_followup_date);
                getFollowupList(lid);

              } else {
                scrollTopScreen();
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
    $(".booking_form").html("");
    $(".booking_hide").show();

    var lead_stage_id = $("#lead_stage_id").val();
    if (lead_stage_id == '7') {
      $("#lead_status_id").val('2');
      $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #task_desc").attr("disabled", true);
      $("#next_action, #fp_assign_to").attr("required", false);
    } else if (lead_stage_id == '6') {
      $("#lead_status_id").val('3');
      $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #task_desc").attr("disabled", true);
      $(".booking_hide").hide();
      $("#next_action, #fp_assign_to").attr("required", false);

      get_booking_form($("#followup_lead_id").val());
    } else {
      $("#next_action, #next_followup_date, #next_followup_time, #fp_assign_to").attr("required", true);
      $("#lead_status_id, #next_action, #next_followup_date, #next_followup_time, #task_desc").attr("disabled", false);
    }
  }

  function openFolloupModal(status, id, lid) {

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/get_followup_stage_status'); ?>",
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
              nextAction();
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
            
            primary_mobile_number_with_dial_code();
            secondary_mobile_number_with_dial_code();
            $('.get_locations').trigger('change')
            convertToSelect2()

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

  var advance_search = 0;
  $(".adv_btn").click(function() {
    if (advance_search == 0) {
      advance_search = 1;
      $(".advance_search").show();
      $(".adv_btn").html('Hide Advance Search')
    } else {
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
            $("#search_city_id").html(row);
          } else {
            $("#search_city_id").html("<option value=''>Select City</option>");
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

  function getLocationSearch(city_id) {
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
            var row = "<option value=''>Select Location</option>";
            for (var i = 0; i < location_list.length; i++) {
              row += "<option value='" + location_list[i].location_id + "'>" + location_list[i].location_name + "</option>";
            }
            $("#search_location_id").html(row);
          } else {
            $("#search_location_id").html("<option value=''>Select Location</option>");
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

  var budget_list = <?= json_encode($budget_list) ?>;

  function selectMaxBudgetSearch() {
    var search_budget_min = parseInt($('#search_budget_min').val());

    var html = "<option value=''>Select Max</option>";
    for (var i = 0; i < budget_list.length; i++) {
      if (parseInt(budget_list[i].budget_id) >= search_budget_min) {
        html += "<option value='" + budget_list[i].budget_id + "'>" + budget_list[i].budget_name + "</option>";
      }
    }
    $('#search_budget_max').html(html);
  }

  // booking modal
  /*function openBookingModal(lead_id) {

    $.ajax({
          type: "POST",
          url: "<?= base_url(AGENT_URL . 'api/get_booking_form') ?>",
          data: {lead_id:lead_id},
          beforeSend: function (data) {
            $(".loader_progress").show();
          },
          success: function (response) {
            $(".loader_progress").hide();
            $(".bookingBody").html(response);
            $("#bookingModal").modal('show');
          },
          error: function () {
              $(".loader_progress").hide();
              alert('Some error occurred, please try again.');
          }
      });

  }*/
  //function closeBookingModal() {
  //  $("#bookingModal").modal('hide');
  //}
  //openBookingModal('1');

  function get_booking_form(lead_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_booking_form') ?>",
      data: {
        lead_id: lead_id
      },
      beforeSend: function(data) {
        $(".booking_form").html("<center><img src='<?= base_url('public/front/ajax-loader.gif'); ?>' style='height:80px;margin-top:15px;margin-bottom:50px;'></center>");
      },
      success: function(response) {
        //setTimeout(function() {
        $(".booking_form").html(response);
        //},500);
      },
      error: function() {
        $(".booking_form").html("<div class='alert alert-danger'>Some error occurred, please try again.</div>");
      }
    });
  }

  function getCityBooking(state_id) {
    $("#bk_city_id").html("<option value=''>Select City</option>");
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
            $("#bk_city_id").html(row);
          } else {
            $("#bk_city_id").html("<option value=''>Select City</option>");
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

  function getProductDataBooking(product_id) {
    $("#bk_tower").html("<option value=''>Select Tower</option>");
    $("#bk_size").html("<option value=''>Select Size</option>");
    $("#bk_unit_no").html("<option value=''>Select Unit No</option>");
    $("#bk_unit_ref_no").val("");
    $("#bk_accommodation").val("");
    $("#bk_accommodation_value").val("");
    $("#bk_product_unit_detail_id").val("");
    $("#bk_inventory_id").val("");
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_booking_product_data') ?>",
      data: {
        product_id: product_id
      },
      beforeSend: function(data) {},
      success: function(response) {
        var obj;
        try {
          obj = JSON.parse(response);
          if (obj.status == 'success') {
            var block_list = obj.block_list;
            var row = "<option value=''>Select Tower</option>";
            for (var i = 0; i < block_list.length; i++) {
              row += "<option value='" + block_list[i].block_id + "'>" + block_list[i].block_name + "</option>";
            }
            $("#bk_tower").html(row);

            var size_list = obj.size_list;
            var row = "<option value=''>Select Size</option>";
            for (var i = 0; i < size_list.length; i++) {
              row += "<option value='" + size_list[i].size_id + "'>" + size_list[i].size_name + "</option>";
            }
            $("#bk_size").html(row);
          } else {
            $("#bk_tower").html("<option value=''>Select Tower</option>");
            $("#bk_size").html("<option value=''>Select Size</option>");
            $("#bk_unit_no").html("<option value=''>Select Unit No</option>");
            $("#bk_unit_ref_no").val("");
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

  function get_booking_unit_no() {
    var product_unit_detail_id = $("#bk_size").val();
    $("#bk_unit_no").html("<option value=''>Select Unit No</option>");
    $("#bk_unit_ref_no").val("");
    $("#bk_accommodation").val("");
    $("#bk_accommodation_value").val("");
    $("#bk_product_unit_detail_id").val("");
    $("#bk_inventory_id").val("");
    var tower = $("#bk_tower").val();
    var floor = $("#bk_floor").val();

    if (product_unit_detail_id != "") {
      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/get_booking_unit_no') ?>",
        data: {
          product_unit_detail_id: product_unit_detail_id.split("##")[1],
          tower: tower,
          floor: floor
        },
        beforeSend: function(data) {},
        success: function(response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status == 'success') {

              var unit_no_list = obj.unit_no_list;
              var row = "<option value=''>Select Unit No</option>";
              for (var i = 0; i < unit_no_list.length; i++) {
                row += "<option value='" + unit_no_list[i].unit_ref_no + "'>" + unit_no_list[i].unit_no + "</option>";
              }
              $("#bk_unit_no").html(row);


              $("#bk_accommodation").val(product_unit_detail_id.split("##")[2]);
              $("#bk_accommodation_value").val(product_unit_detail_id.split("##")[3]);
              $("#bk_product_unit_detail_id").val(product_unit_detail_id.split("##")[1]);
            } else {
              $("#bk_unit_no").html("<option value=''>Select Unit No</option>");
              $("#bk_unit_ref_no").val("");
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
  }

  function getUnitRefNo(v) {
    if (v == "") {
      $("#bk_unit_ref_no").val("");
      $("#bk_inventory_id").val("");
    } else {
      $("#bk_unit_ref_no").val(v.split("##")[1]);
      $("#bk_inventory_id").val(v.split("##")[2]);
    }
  }

  function share_project(project, lead_mobile, lead_email, lead_id, project_id, project_name) {
    //alert(project+lead_mobile+lead_email+lead_id+project_id+project_name);

    $("#formModal").modal({
      backdrop: 'static',
      keyboard: false
    });

    $("#send_type").val("");
    $("#share_project_id").val(project_id);
    $("#share_project_link").val(project);
    $("#share_project_name").val(project_name);
    $("#share_lead_id").val(lead_id);
  }

  $("#md-form-main").validate({
    rules: {

    },
    messages: {

    },
    submitHandler: function(form) {

      var myform = document.getElementById("md-form-main");
      var fd = new FormData(myform);

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/share_project_link') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function(data) {
          $(".md-error-msg").html('');
          $(".md-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function(response) {
          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              $(".md-form-btn").html("Share");

              if (obj.status == 'success') {
                $("#formModal").modal('hide');
                $.toast({
                  heading: 'Success',
                  text: obj.message,
                  icon: 'success',
                  position: 'top-center',
                });
              } else {
                $(".md-error-msg").html(alertMessage('error', obj.message));
              }
            } catch (err) {
              $(".md-form-btn").html("Share");
              $(".md-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
            }
          }, 500);
        },
        error: function() {
          $(".md-form-btn").html("Share");
          $(".md-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));

        }

      });

    }
  });

  // custom sms

  var template_list = [];

  function get_sms_form(type, user_id, send_to) {

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(AGENT_URL . 'api/get_sms_form'); ?>",
      data: {
        type: type
      },
      beforeSend: function(data) {
        $(".loader_progress").show();
      },
      success: function(response) {
        setTimeout(function() {


          $(".loader_progress").hide();
          var obj;
          try {
            obj = JSON.parse(response);

            if (obj.status == 'success') {
              $(".custom-sms-error-msg").html("");
              $("#formModalCustomSMS").modal({
                backdrop: 'static',
                keyboard: false
              });
              var title = "";
              if (type == "1") {
                title = "Send SMS";
              } else if (type == "2") {
                title = "Send Email";
              } else if (type == "3") {
                title = "Send Whatsapp Message";
              }
              $("#formModalCustomSMS .modal-title").html(title);
              $("#send_to").val(send_to);
              $("#user_id").val(user_id);
              $("#type").val(type);

              template_list = obj.template_list;
              var row = "<option value=''>Select Template</option>";
              for (var i = 0; i < template_list.length; i++) {
                row += "<option value='" + template_list[i].template_id + "'>" + template_list[i].template_name + "</option>";
              }
              row += "<option value='0'>Custom Message</option>";
              $("#template_id").html(row);
              //$(".msg").html(obj.message);

              changeTemplate();
            } else {
              alert(obj.message);
            }
          } catch (err) {
            alert('Some Error Occured.');
          }

        }, 100);
      },
      error: function() {
        $(".loader_progress").hide();
        alert('Some Error Occured.');
      }

    });
  }

  function changeTemplate() {
    var template_id = $("#template_id").val();
    var type = $("#type").val();

    $("#subject").prop("required", false);
    //alert(template_id);
    if (template_id != "") {
      if (type == '1') {
        $(".subject").hide();
        $(".message").show();
      } else if (type == '2') {
        $(".subject").show();
        $(".message").show();
        $("#subject").prop("required", true);
      } else if (type == '3') {
        $(".subject").hide();
        $(".message").show();
      } else {
        $(".subject").hide();
        $(".message").hide();
      }

      var f_message = "";
      var f_subject = "";
      for (i = 0; i < template_list.length; i++) {
        var row = template_list[i];
        if (row.template_id == template_id) {
          f_message = row.template_message;
          f_subject = row.template_subject;
        }
      }
      $("#message").val(f_message);
      $("#subject").val(f_subject);
    } else {
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
      var fd = new FormData(myform);

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/send_sms_whatsapp_email') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function(data) {
          $(".custom-sms-error-msg").html('');
          $(".custom-sms-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function(response) {
          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              $(".custom-sms-form-btn").html("Send");

              if (obj.status == 'success') {
                $("#formModalCustomSMS").modal('hide');
                $.toast({
                  heading: 'Success',
                  text: obj.message,
                  icon: 'success',
                  position: 'top-center',
                });
              } else {
                $(".custom-sms-error-msg").html(alertMessage('error', obj.message));
              }
            } catch (err) {
              $(".custom-sms-form-btn").html("Send");
              $(".custom-sms-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
            }
          }, 500);
        },
        error: function() {
          $(".custom-sms-form-btn").html("Send");
          $(".custom-sms-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));

        }

      });

    }
  });

  function downloadLeads() {
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

    var par = {
      filter_by: filter_by,
      search_text: search_text,
      search_date_from: search_date_from,
      search_date_to: search_date_to,
      search_state_id: search_state_id,
      search_city_id: search_city_id,
      search_source_id: search_source_id,
      search_stage_id: search_stage_id,
      search_status: search_status,
      search_location_id: search_location_id,
      search_budget_min: search_budget_min,
      search_budget_max: search_budget_max,
      search_size_min: search_size_min,
      search_size_max: search_size_max,
      search_size_unit: search_size_unit,
      search_agent_id: search_agent_id
    };
    var str = jQuery.param(par);

    window.location.href = "<?= base_url(AGENT_URL . 'download_followup?') ?>" + str;
  }

  function add_to_followup_new(id) {
    $(".error-msg-right").html('');
    openFolloupModal(1, 0, id);
    nextAction();
  }
</script>