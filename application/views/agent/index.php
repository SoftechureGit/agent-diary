<?php include('include/header.php');?>
<?php include('include/sidebar.php');?>
<!--**********************************
  Content body start
  ***********************************-->
<div class="content-body">
  <div style="padding: 0px 26px 21px 26px;background-color: #fff;">
    <div class="row">
      <div class="col-md-3 mtm">
        <select class="form-control bdr10" id="member" name="member">
          <option value="" selected>Select Team Member</option>
                      <?php foreach ($member_list as $row) { ?>
                    <option value="<?= $row->user_id ?>" <?= ($this->input->get('member')==$row->user_id)?"selected":"" ?>><?= $this->Action_model->get_name($row->user_id) ?></option>
                      <?php } ?>

        </select>
      </div>
      <div class="col-md-3 mtm">
        <select class="form-control bdr10" id="project_id" name="project">
          <option value="" selected>Select Project</option>
          <?php foreach ($project_list as $row) { ?>
            <option value="<?= $row->product_id ?>" <?= ($this->input->get('project')==$row->product_id)?"selected":"" ?>><?= $row->project_name ?></option>
              <?php } ?>
        </select>
      </div>
      <div class="col-md-3 mtm">
          <button class="btn btn-primary btn-md" style="border-radius: 10px;height: calc(2.0625rem + 2px); padding: 0.375rem 15px;border:none;" onclick="filterDashboard()"><i class="fa fa-glass"></i> &nbsp;Filter</button>
      </div>
      <div class="col-md-3 mt-3" style="text-align: right;">
        <h5><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; <?= date("d F, Y") ?></h5>
      </div>
    </div>
  </div>
  <div class="container-fluid mt-2" style="display: ;">
    <div class="row">
      <div class="col-md-12">
        <?php if($is_trial && $trial_expired) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <div class="row">
            <div class="col-md-9">
              Your trial has ended.
            </div>
            <div class="col-md-3" align="right">
              <a href="<?= base_url(AGENT_URL.'pay') ?>" class="btn btn-dark btn-sm" title="Pay">Pay
              </a> 
            </div>
          </div>
        </div>
        <?php } else if($is_trial && $expire_today) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <div class="row">
            <div class="col-md-9">
              Your trial expires today 11:59:00 PM
            </div>
            <div class="col-md-3" align="right"> 
              <a href="<?= base_url(AGENT_URL.'pay') ?>" class="btn btn-dark btn-sm" title="Pay">Pay
              </a>
            </div>
          </div>
        </div>
        <?php } else if($is_trial && !$trial_expired) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <div class="row">
            <div class="col-md-9">
              Your trial expires in <?= $trial_remaining_days ?> days
            </div>
            <div class="col-md-3" align="right">
              <a href="<?= base_url(AGENT_URL.'pay') ?>" class="btn btn-dark btn-sm" title="Pay">Pay
              </a> 
            </div>
          </div>
        </div>
        <?php } else if(!$is_trial && $expire_today) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <div class="row">
            <div class="col-md-9">
              Your plan expires today 11:59:00 PM
            </div>
            <div class="col-md-3" align="right"> 
              <a href="<?= base_url(AGENT_URL.'pay') ?>" class="btn btn-dark btn-sm" title="Pay">Pay
              </a>
            </div>
          </div>
        </div>
        <?php } else if(!$is_trial && $trial_remaining_days && $trial_remaining_days<=10) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <div class="row">
            <div class="col-md-9">
              Your plan expires in <?= $trial_remaining_days ?> days
            </div>
            <div class="col-md-3" align="right">
              <a href="<?= base_url(AGENT_URL.'pay') ?>" class="btn btn-dark btn-sm" title="Pay">Pay
              </a> 
            </div>
          </div>
        </div>
        <?php } else if(!$is_trial && $trial_remaining_days==0) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <div class="row">
            <div class="col-md-9">
              Your plan has expired. Please update your payment details to reactive it.
            </div>
            <div class="col-md-3" align="right">
              <a href="<?= base_url(AGENT_URL.'pay') ?>" class="btn btn-dark btn-sm" title="Pay">Pay
              </a> 
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="error-msg">
          <!--<?php if(!$user_detail->mobile_verify) { ?>
            <div class="alert alert-danger alert-dismissible fade show" style="position: relative;">
                 Please verify your mobile number. <button type="button" class="btn btn-dark btn-sm" title="Verify Your Mobile Number" onclick="get_verify_mobile_otp()" style="position: absolute;right: 10px;top: 9px;">Verify
                </button> 
            </div>
            
            <?php } ?>-->
          <?php if($this->session->flashdata('error_msg')) { ?>
          <div class="alert alert-danger pd8">
            <?php echo $this->session->flashdata('error_msg'); ?>
          </div>
          <?php } ?>
          <?php if($this->session->flashdata('success_msg')) { ?>
          <div class="alert alert-success pd8">
            <?php echo $this->session->flashdata('success_msg'); ?>
          </div>
          <?php } ?>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <div class="card gradient-1">
                  <div class="card-body">
                    <h3 class="card-title text-white">Todays Followup</h3>
                    <div class="d-inline-block">
                      <h2 class="text-white"><?= $today_followup ?></h2>
                      <!--<p class="text-white mb-0">Jan - March 2019</p>-->
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-6">
                <div class="card gradient-2">
                  <div class="card-body">
                    <h3 class="card-title text-white">Missed Followup</h3>
                    <div class="d-inline-block">
                      <h2 class="text-white"><?= $missed_followup ?></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                <div class="card gradient-3">
                  <div class="card-body">
                    <h3 class="card-title text-white">Up Coming Followup</h3>
                    <div class="d-inline-block">
                      <h2 class="text-white"><?= $upcoming_followup ?></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12 col-md-12">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body" style="padding-top: 22px;padding-bottom: 22px;">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th></th>
                              <th class="text-center">For Rent</th>
                              <th class="text-center">For Sale</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Total Projects</td>
                              <td class="text-center">-
                              </td>
                              <td class="text-center"> <?= $total_project ?></td>
                            </tr>
                            <tr>
                              <td>Total Property </td>
                              <td class="text-center"><?= $total_property_rent ?>
                              </td>
                              <td class="text-center"> <?= $total_property_sale ?></td>
                            </tr>
                            <tr>
                              <td>Total Leads</td>
                              <td class="text-center"><?= $total_lead_rent ?>
                              </td>
                              <td class="text-center"> <?= $total_lead_sale ?></td>
                            </tr>
                            <tr>
                              <td>Active Leads</td>
                              <td class="text-center"><?= $total_lead_active_rent ?>
                              </td>
                              <td class="text-center"> <?= $total_lead_active_sale ?></td>
                            </tr>
                            <tr>
                              <td>Dead Leads </td>
                              <td class="text-center"><?= $total_lead_dead_rent ?>
                              </td>
                              <td class="text-center"> <?= $total_lead_dead_sale ?></td>
                            </tr>
                            <tr>
                              <td>Convert Leads </td>
                              <td class="text-center"><?= $total_lead_conversion_rent ?>
                              </td>
                              <td class="text-center"> <?= $total_lead_conversion_sale ?></td>
                            </tr>
                          </tbody>
                        </table>
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
    <div class="row" style="display: none;">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sales Record</h4>
            <div id="morris-bar-chart-1"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Site Visit Report</h4>
            <div id="morris-bar-chart-2"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!--<h4 class="card-title">Teams</h4>
              <hr>-->
            <div class="table-responsive">
              <table class="table table-bordered verticle-middle">
                <thead>
                  <tr>
                    <th>Team </th>
                    <th class="text-center">Total Lead</th>
                    <th class="text-center">Conversion</th>
                    <th class="text-center">Site Visit </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($user_list as $row) { ?>
                  <tr>
                    <td><?= $this->Action_model->get_name($row->user_id) ?></td>
                    <td class="text-center"><?= $row->total_lead ?></td>
                    <td class="text-center"><?= $row->percentage_conversion ?>%</td>
                    <td class="text-center"><?= $row->percentage_site_visit ?>%</td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- #/ container -->
</div>
</div>
<!--**********************************
  Content body end
  ***********************************-->
<!-- modal form -->
<div class="modal fade" id="formModal" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" budget="document">
    <div class="modal-content">
      <form id="md-form-main" method="post">
        <input type="hidden" class="form-control" id="fid" name="id" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Verify Mobile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="md-error-msg"></div>
          <div>
            <p class="msg"></p>
          </div>
          <div class="form-group">
            <label for="mobile_otp" class="col-form-label">OTP:</label>
            <input type="text" class="form-control" id="mobile_otp" name="mobile_otp" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success md-form-btn wd-100">Verify</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- modal end -->       
<?php include('include/footer.php');?>  
<!-- Chartjs -->
<script src="<?php echo base_url('public/admin/') ?>plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script src="<?php echo base_url('public/admin/') ?>plugins/circle-progress/circle-progress.min.js"></script>
<!-- Datamap -->
<script src="<?php echo base_url('public/admin/') ?>plugins/d3v3/index.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/topojson/topojson.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/datamaps/datamaps.world.min.js"></script>
<!-- Morrisjs -->
<script src="<?php echo base_url('public/admin/') ?>plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/morris/morris.min.js"></script>
<!-- Pignose Calender -->
<script src="<?php echo base_url('public/admin/') ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/pg-calendar/js/pignose.calendar.min.js"></script>
<!-- ChartistJS -->
<script src="<?php echo base_url('public/admin/') ?>plugins/chartist/js/chartist.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>js/dashboard/dashboard-1.js"></script>

<script>
function filterDashboard() {
  var member = $("#member").val();
  var project = $("#project_id").val();
  window.location.href="?member="+member+"&project="+project;
}
</script>