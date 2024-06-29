<div style="padding: 0px 15px 0px 15px;">
  <div class="row" style="border-bottom: 1px solid #0000000f;padding-bottom: 13px;margin-bottom: 10px;">
    <div class="col-md-2" align="center">
      <img class="mr-3" src="<?= base_url('public/front/user.png') ?>" style="margin-top: 18px;border-radius:50%;" width="50" height="50" alt="">
    </div>
    <div class="col-md-10">
      <!--<div class="row">
        <div class="col-md-12">
          <h6 class="card-text text-muted"><i class="fa fa-calendar"></i> <?= $record->lead_date ?></h6>
        </div>
        </div>-->
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-6">
          <h6 class="card-text text-muted ft-14" style="font-size: 16px;"><i class="fa fa-user"></i> <?= ucwords($record->lead_title.' '.$record->lead_first_name.' '.$record->lead_last_name) ?></h6>
        </div>
        <div class="col-md-6" align="right">
          <h6 class="card-text text-muted ft-sm"><i class="fa fa-calendar"></i> <?= $record->lead_date." & ".$record->lead_time ?></h6>
        </div>
      </div>
      <div class="row" style="margin-top: 2px;">
        <div class="col-md-6">
          <h6 class="card-text text-muted" style="margin-top: 4px;margin-bottom: 0px;padding-bottom: 0px;"><i class="fa fa-mobile"></i> <span >+91<?= $record->lead_mobile_no ?></span></h6>
          <h6 class="card-text text-muted ft-sm" style="margin-top: 4px;padding-top: 0px;"><i class="fa fa-phone"></i> <span>+91<?= $record->lead_mobile_no_2 ?></span></h6>
        </div>
        <div class="col-md-6 pt-2" align="right">
          <div class="card-text text-muted ft-sm"><span><?php if($record->lead_type_id==1) { echo "<span style='padding:2px 10px;background:#4d7cff;color:white;border-radius:10px;'>".$record->lead_type_name."</span>"; } else if($record->lead_type_id==2) { echo "<span style='padding:2px 10px;background:#e76166;color:white;border-radius:10px;'>".$record->lead_type_name."</span>"; } else if($record->lead_type_id==3) { echo "<span style='padding:2px 10px;background:#6fd96f;color:white;border-radius:10px;'>".$record->lead_type_name."</span>"; }  else { echo $record->lead_type_name; } ?></span></div>
          <div class="card-text text-muted pt-1 ft-sm"><span><?= $record->lead_stage_name ?></span></div>
          <div class="card-text text-muted ft-sm"><span><?= $record->lead_source_name ?></span></div>
        </div>
      </div>
      <div style="margin-top: 10px;">
        <a href="tel:<?= $record->lead_mobile_no ?>"><button class="btn btn-dark btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-phone"></i></button></a><?php //  } ?><?php //  } ?>
        <a href="javascript:void(0)" onclick="get_sms_form('1','<?= $record->lead_id ?>','<?= $record->lead_mobile_no ?>')"><button class="btn btn-info btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-comment"></i></button></a><?php //  } ?>
        <a href="javascript:void(0)" onclick="get_sms_form('3','<?= $record->lead_id ?>','<?= $record->lead_mobile_no ?>')"><button class="btn btn-success btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-whatsapp" style="color: #fff;"></i></button></a><?php //  } ?>
        <a href="javascript:void(0)" onclick="get_sms_form('2','<?= $record->lead_id ?>','<?= $record->lead_email ?>')"><button class="btn btn-warning btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-envelope" style="color: #fff;"></i></button></a>
      </div>
    </div>
  </div>
  <div style="margin-top: 10px;">
    <ul class="nav nav-tabs mb-3">

    <li class="nav-item"><a href="#navtabs-profile" class="nav-link active" data-toggle="tab" aria-expanded="false">Profile</a>
    </li>

		<li class="nav-item active" onclick="getRequirementList(<?= $record->lead_id ?>);"><a href="#navtabs-requirement" class="nav-link" data-toggle="tab" aria-expanded="false">Requirement</a>
		<li class="nav-item" onclick="getReferenceList(<?= $record->lead_id ?>);"><a href="#navtabs-reference" class="nav-link" data-toggle="tab" aria-expanded="false">Reference</a>
		<li class="nav-item" onclick="getUnitList(<?= $record->lead_id ?>);"><a href="#navtabs-unit" class="nav-link" data-toggle="tab" aria-expanded="false">Unit</a>
    </li>
    </ul>
    <div class="tab-content br-n pn" style="height: 45vh;overflow-y: auto;overflow-x: hidden;padding-right: 6px;">
    	
      <div id="navtabs-profile" class="tab-pane active">
        <div class="row">
            <div class="col-md-12">
              <label>Name:</label> <strong><?= ucwords($record->lead_title.' '.$record->lead_first_name.' '.$record->lead_last_name) ?></strong>
            </div>
            <div class="col-md-6">
              <label>Contact No:</label> <strong>+91<?= $record->lead_mobile_no ?></strong>
            </div>
            <div class="col-md-6">
              <label>Other No:</label> <strong>+91<?= $record->lead_mobile_no_2 ?></strong>
            </div>
            <div class="col-md-12">
              <label>Email Id:</label> <strong><?= $record->lead_email ?></strong>
            </div>
            <div class="col-md-12">
              <label>Address:</label> <strong><?= $record->lead_address ?></strong>
            </div>
            <div class="col-md-6">
              <label>City:</label> <strong><?= $record->city_name ?></strong>
            </div>
            <div class="col-md-6">
              <label>State:</label> <strong><?= $record->state_name ?></strong>
            </div>
            <div class="col-md-6">
              <label>Sex:</label> <strong><?= $record->lead_gender ?></strong>
            </div>
            <div class="col-md-6">
              <label>Marital Status:</label> <strong><?= $record->lead_marital_status ?></strong>
            </div>
            <div class="col-md-6">
              <label>Occupation:</label> <strong><?= $record->occupation_name ?></strong>
            </div>
            <div class="col-md-6">
              <label>Designation:</label> <strong><?= $record->designation_name ?></strong>
            </div>
            <div class="col-md-12">
              <label>Name of Company:</label> <strong><?= $record->lead_company ?></strong>
            </div>
            <div class="col-md-12">
              <label>Annual Income:</label> <strong><?= $record->lead_annual_income ?></strong>
            </div>
            <div class="col-md-12">
              <h4>KYC</h4>
            </div>
            <div class="col-md-6">
              <label>PAN No:</label> <strong><?= $record->lead_pan_no ?></strong>
            </div>
            <div class="col-md-6">
              <label>Adhar No:</label> <strong><?= $record->lead_adhar_no ?></strong>
            </div>
            <div class="col-md-6">
              <label>Voter Id:</label> <strong><?= $record->lead_voter_id ?></strong>
            </div>
            <div class="col-md-6">
              <label>Passport No:</label> <strong><?= $record->lead_passport_no ?></strong>
            </div>
            <div class="col-md-6">
              <label>Added By:</label> <strong><?= ($record->added_by)?$this->Action_model->get_name($record->added_by):'' ?></strong>
            </div>
                <div class="col-md-12" align="right">
                    <!--<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#profileEditModal" style="color: white;"><i class="fa fa-edit"></i> Edit</button>-->
                    <!-- <a href="<?= base_url(AGENT_URL.'lead-detail/'.$record->lead_id) ?>">-->
                      <!--<button type="button" class="btn btn-dark btn-sm" style="color: white;" onclick="get_lead_form(<?= $record->lead_id ?>)"><i class="fa fa-edit"></i> Edit</button>-->
                    <!--</a>-->
                </div>
        </div>

    </div>

    	<div id="navtabs-requirement" class="tab-pane">
	        <div class="requirement_list"></div>
	    </div>
    	
    	<div id="navtabs-reference" class="tab-pane">
	        <div class="reference_list"></div>
	    </div>
    	
    	<div id="navtabs-unit" class="tab-pane">
	        <div class="unit_list"></div>
	    </div>

    </div>
  </div>
</div>

<script>
getRequirementList(<?= $record->lead_id ?>);
</script>