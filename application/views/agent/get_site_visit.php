<div style="padding: 15px 15px 20px 15px;">
  <div class="row" style="border-bottom: 1px solid #0000000f;padding-bottom: 13px;margin-bottom: 10px;">
    <div class="col-md-12">
      <!--<div class="row">
        <div class="col-md-12">
          <h6 class="card-text text-muted"><i class="fa fa-calendar"></i> <?= $record->lead_date ?></h6>
        </div>
        </div>-->
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">Customer: <strong><?= ucwords($record->lead_title.' '.$record->lead_first_name.' '.$record->lead_last_name) ?></strong></h6>
        </div>
        <div class="col-md-12" style="margin-top: 8px;">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">Project: <strong><?= $record->project_name ?></strong></h6>
        </div>

        <?php if($record->is_share=="1") { ?>

        <div class="col-md-12" style="margin-top: 8px;">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">By: <strong><?= $record->b_firm_name ?></strong></h6>
        </div>

        <div class="col-md-12" style="margin-top: 8px;">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">Mobile No: <strong><?= $record->lead_mobile_no ?></strong></h6>
        </div>

        <?php } ?>
        <div class="col-md-12" style="margin-top: 8px;">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">Status: <strong><?php $site_visit_status = "";
          if ($record->site_visit_status=='1') {
          	$site_visit_status = "<span class='text-warning' style='color: #fff; padding: 5px 10px; margin-top: 6px;font-size:15px;font-weight:bold;'>Pending</span>";
          }
          else if ($record->site_visit_status=='2') {
          	$site_visit_status = "<span class='text-success' style='color: #fff; padding: 5px 10px; margin-top: 6px;font-size:15px;font-weight:bold;'>Success</span>";
          }
          else if ($record->site_visit_status=='3') {
          	$site_visit_status = "<span class='text-danger' style='color: #fff; padding: 5px 10px; margin-top: 6px;font-size:15px;font-weight:bold;'>Postpone</span>";
          } 
          echo $site_visit_status; ?></strong></h6>
        </div>
        <div class="col-md-12" style="margin-top: 8px;">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">Date & Time of Visit: <strong><?= $record->visit_date.' '.$record->visit_time ?></strong></h6>
        </div>



        <div class="col-md-12" style="margin-top: 8px;">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">Assign To: <strong><?= ucwords($record->user_title.' '.$record->first_name.' '.$record->last_name) ?></strong></h6>
        </div>

        <?php if($record->is_share=="1") { ?>

        <div class="col-md-12" style="margin-top: 8px;">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;">Attend By: <strong><?= $record->attend_by ?></strong></h6>
        </div>


        <div class="col-md-12" style="margin-top: 15px;">
          <?php if ($record->site_visit_status=='1') { ?>
          <button class="btn btn-success btn-sm" style="margin-right: 15px;color:#fff;" onclick="updateBookingStatusConfirm(<?= $record->site_visit_id ?>,2,'Success','<?= $record->visit_date ?>','<?= $record->visit_time ?>')">Success</button>
          <button class="btn btn-danger btn-sm" style="margin-right: 15px;color:#fff;" onclick="updateBookingStatusConfirm(<?= $record->site_visit_id ?>,3,'Postpone','<?= $record->visit_date ?>','<?= $record->visit_time ?>')">Postpone</button>
          <?php } else { ?>
          	<?php $label = ""; $interested = ""; if ($record->site_visit_status=='2') { if ($record->interested=='1') { $label = "Comment"; $interested = "<span class='badge badge-pill badge-success' style='color: #fff; padding: 5px 10px; margin-top: 6px;font-size:11px;'>Interested</span>"; } else if ($record->interested=='2') { $label = "Reason"; $interested = "<span class='badge badge-pill badge-danger' style='color: #fff; padding: 5px 10px; margin-top: 6px;font-size:11px;'>Not Interested</span>"; } else { $label = "Comment"; } } else if ($record->site_visit_status=='3') { $label = "Reason"; } ?>
          	<?php if ($interested) { ?>
          	<div style="margin-bottom: 15px;"><?= $interested ?></div>
          	<?php } ?>
          	<h6 class="card-text text-muted ft-14" style="font-size: 16px;"><?= $label ?>: <strong><?= $record->comment ?></strong></h6>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>