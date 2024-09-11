<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>


<!--**********************************
  Content body start
  ***********************************-->
<div class="content-body">

  <!-- Filter -->
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <!-- Trial Alert -->
       
        <?php if ($trial->is_trial): ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <div class="row align-items-center">
              <div class="col-md-9">
                <?= $trial->message; ?>
              </div>
              <div class="col-md-3" align="right">
                <a href="<?= base_url(AGENT_URL . 'pay') ?>" class="btn btn-dark btn-sm" title="Pay">Pay
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div class="error-msg">
          <!--<?php if (!$user_detail->mobile_verify) { ?>
            <div class="alert alert-danger alert-dismissible fade show" style="position: relative;">
                 Please verify your mobile number. <button type="button" class="btn btn-dark btn-sm" title="Verify Your Mobile Number" onclick="get_verify_mobile_otp()" style="position: absolute;right: 10px;top: 9px;">Verify
                </button> 
            </div>
            
            <?php } ?>-->
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
        <!-- End Alert -->
      </div>
    </div>

    <!-- Filter Card -->
    <div class="card">
      <div class="card-body">

        <div class="row align-items-end">
          <!-- Team Member -->
          <div class="col-md-6 mtm">
            <div class="form-group  m-0">
              <?php
              $selected_member_ids      =  $this->input->get('member');

              $selected_member_ids_arr  = [];

              $selected_member_ids_arr = explode(',', $selected_member_ids);
              ?>

              <label for="team_member">Team Member</label>
              <select class="form-control multi-team-members-select2" id="member" name="member" multiple>
                <option value="0" class="default-option" <?= in_array(0, $selected_member_ids_arr) ? "selected" : "" ?>>All</option>
                <?php foreach ($members as $member) { ?>
                  <option
                    value="<?= $member->id ?>"
                    <?= in_array($member->id, $selected_member_ids_arr) ? "selected" : "" ?>>
                    <?= $member->full_name ?> ( <?= $member->role_name ?> )
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <!-- End Team Member -->

          <!-- Property Type -->
          <div class="col-md-3 mtm d-none">
            <div class="form-group m-0">
              <label for="team_member">Property Type</label>
              <select class="form-control bdr10" id="project_id" name="project">
                <option value="all" selected>All</option>
                <?php foreach ($property_types as $property_type) { ?>
                  <option value="<?= $property_type->id ?>" <?= ($this->input->get('project') == $property_type->id) ? "selected" : "" ?>><?= $property_type->name ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <!-- End Property Type -->

          <div class="col-md-3 mtm">
            <button class="btn btn-primary btn-sm" onclick="filterDashboard()"><i class="fa fa-glass"></i> &nbsp;Filter</button>
          </div>

          <div class="col-md-3" style="text-align: right;">
            <h5><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; <?= date("d F, Y") ?></h5>
          </div>
        </div>
      </div>
    </div>
    <!-- End Filter -->
    <!-- Filter Card -->

    <div class="row">
      <!-- Cards Count -->
      <div class="col-md-6">
        <div class="row">
          <!-- New Leads / Today Leads Card Count -->
          <div class="col-lg-6 col-sm-6">
            <div class="card gradient-2">
              <div class="card-body">
                <h3 class="card-title text-white">New Leads</h3>
                <div class="d-inline-block">
                  <h2 class="text-white"><?= ($leads->today_count ?? 0 ) + ( $followups->total_initial_count ?? 0 ) ?></h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="icon-chart" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <!-- End New Leads / Today Leads Card Count -->

          <!-- Today's Followup Card Count -->
          <div class="col-lg-6 col-sm-6">
            <div class="card gradient-3">
              <div class="card-body">
                <h3 class="card-title text-white">Today's Followup</h3>
                <div class="d-inline-block">
                  <h2 class="text-white"><?= $followups->today_count ?? 0 ?></h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-bullseye" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <!-- End Today's Followup Card Count -->

          <!-- Total Leads Card Count -->
          <div class="col-lg-6 col-sm-6">
            <div class="card gradient-1">
              <div class="card-body">
                <h3 class="card-title text-white">Total Leads</h3>
                <div class="d-inline-block">
                  <h2 class="text-white"><?= $leads->total_count ?? 0 ?></h2>
                  <!--<p class="text-white mb-0">Jan - March 2019</p>-->
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <!-- End Total Leads Card Count -->

          <!-- Missed Followup Card Count -->
          <div class="col-lg-6 col-sm-6">
            <div class="card gradient-4">
              <div class="card-body">
                <h3 class="card-title text-white">Missed Followup</h3>
                <div class="d-inline-block">
                  <h2 class="text-white"><?= $followups->missed_count ?? 0 ?></h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <!-- End Missed Followup Card Count -->

        </div>
      </div>
      <!-- End Cards Count -->

      <!-- Table Count -->
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
                          <th>Stage</th>
                          <th class="text-center">Total</th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td>Initial</td>
                          <td class="text-center"><?= ($leads->today_count ?? 0 ) + ( $followups->total_initial_count ?? 0 ) ?></td>
                        </tr>
                        <tr class="text-primary">
                          <td>Followup</td>
                          <td class="text-center"><?= $followups->total_followup_count ?? 0 ?></td>
                        </tr>
                        <tr>
                          <td>Enquiry</td>
                          <td class="text-center"><?= $followups->total_enquiry_count ?? 0 ?></td>
                        </tr>
                        <tr>
                          <td>Site Visit</td>
                          <td class="text-center"><?= $followups->total_site_visit_count ?? 0 ?></td>
                        </tr>
                        <tr>
                          <td>Metting</td>
                          <td class="text-center"><?= $followups->total_metting_count ?? 0 ?></td>
                        </tr>
                        <tr class="text-danger">
                          <td>Dump</td>
                          <td class="text-center"><?= $followups->total_dump_count ?? 0 ?></td>
                        </tr>
                        <tr class="text-success">
                          <td>Success</td>
                          <td class="text-center"><?= $followups->total_success_count ?? 0 ?></td>
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
      <!-- End Table Count -->

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
<?php include('include/footer.php'); ?>
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
<!-- <script src="<?php echo base_url('public/admin/') ?>plugins/morris/morris.min.js"></script> -->
<!-- Pignose Calender -->
<script src="<?php echo base_url('public/admin/') ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/pg-calendar/js/pignose.calendar.min.js"></script>
<!-- ChartistJS -->
<script src="<?php echo base_url('public/admin/') ?>plugins/chartist/js/chartist.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
<!-- <script src="<?php echo base_url('public/admin/') ?>js/dashboard/dashboard-1.js"></script> -->

<script>
  /** */
  $(document).ready(function() {
    // Initialize Select2
    $('.multi-team-members-select2').select2({
      placeholder: 'Choose...',
      allowClear: true
    });


  });

  $('.multi-team-members-select2').on('select2:select', function(e) {
    var data = e.params.data;
    console.log(data.id)
    if(data.id == 0){
      $('.multi-team-members-select2 option').prop('selected', false)
      $('.default-option').prop('selected', true)
      $('.multi-team-members-select2').trigger('change')
    }else{
      $('.default-option').prop('selected', false)
      $('.multi-team-members-select2').trigger('change')
    }
  });
  /** */

  function filterDashboard() {
    var members = $("#member").val();
    redirect_url = "?member=" + members;
    window.location.href = redirect_url
  }
</script>