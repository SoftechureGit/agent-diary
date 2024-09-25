<?php include('include/header.php');?>
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
}
.loader_progress{
    display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("<?= base_url('public/front/ajax-loader.gif') ?>") 
              50% 50% no-repeat #fff3f38f;
}
.radio {
  cursor: pointer;
}
.property_title {
  font-size: 14px;
  color: #76838f;
}
</style>
<?php include('include/sidebar.php');?>


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <!--<div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>-->
            <!-- row -->

            <div class="container-fluid property-listing">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Property Listing <span class="property_title"></span></h4>
                                    </div>
                                </div>
                                <div class="basic-form">

                            		<div class="step-error-msg pt-1">
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
                                	<div class="step_1">
	                                    <form method="post" id="step-1-form" enctype="multipart/form-data" autocomplete="off">
	                                    	<input type="hidden" class="pid" name="id" value="<?= $id ?>">
	                                    	<input type="hidden" name="step" value="1">
	                                        <div class="form-row">

	                                            <div class="form-group col-md-6">
	                                                <label>Date of Post:</label>
	                                                <input type="text" class="form-control" id="post_date" name="post_date" value="<?php if($id) { echo $property_detail->post_date; } else { echo date("d-m-Y"); } ?>" <?php if($id) { echo "disabled"; } ?> readonly >
	                                            </div>

	                                            <div class="form-group col-md-6">
	                                                <?php if($id) { ?>
	                                                	<label>Serial Number:</label>
		                                                <input type="text" class="form-control" placeholder="" value="<?php if($id) { echo $property_detail->property_id; } ?>" disabled="">
		                                            <?php } ?>
	                                            </div>

	                                            <div class="form-group col-md-6">
	                                                <label>Listing For:</label>
	                                                <select class="form-control" id="listing_type" name="listing_type" onchange="changeListingType()">
                                                      <option value="">Select Listing Type</option>
                                                      <?php foreach ($listing_type_list as $listing_type) { ?>
                                                        <option value="<?= $listing_type->listing_type_id ?>" <?php if($id && $property_detail->listing_type==$listing_type->listing_type_id) { echo 'selected'; } ?> ><?= $listing_type->title ?></option>
                                                      <?php } ?>
                                                    </select>
	                                            </div>
	                                            <div class="form-group col-md-6">
	                                            </div>
	                                            <div class="form-group col-md-6">
	                                                <label>Type of Use:</label>
	                                                
                                                    <select class="form-control" id="product_type_id" name="product_type_id" onchange="getUnitTypes('2')" required >
                                                          <option value="">Select Type of Use</option>
                                                          <?php foreach ($product_type_list as $product_type) { ?>
                                                            <option value="<?= $product_type->product_type_id ?>" <?php if($id && $property_detail->product_type_id==$product_type->product_type_id) { echo 'selected'; } ?> ><?= $product_type->product_type_name ?></option>
                                                          <?php } ?>
                                                    </select>
	                                            </div>
	                                            <div class="form-group col-md-6">
	                                                <label>Type of Property:</label>
	                                                <select class="form-control" id="unit_type_id" name="unit_type_id" onchange="checkData()" required >
                                                          <option value="">Select Type of Property</option>
                                                          <?php foreach ($unit_type_list as $unit_type) { ?>
                                                            <option value="<?= $unit_type->unit_type_id ?>" <?php if($id && $property_detail->unit_type_id==$unit_type->unit_type_id) { echo 'selected'; } ?> ><?= $unit_type->unit_type_name ?></option>
                                                          <?php } ?>
                                                    </select>
	                                            </div>
	                                            
	                                            <div class="form-group col-md-4">
                                                    <label>State:</label>
                                                    <select class="form-control" id="state_id" name="state_id" onchange="getCity(this.value)">
                                                         <option value="">Select State</option>
                                                          <?php foreach ($state_list as $state) { ?>
                                                        <option value="<?= $state->state_id ?>" <?php if($id && $property_detail->state_id==$state->state_id) { echo 'selected'; } ?>><?= $state->state_name ?></option>
                                                          <?php } ?>
                                                     </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>City:</label>
                                                    <select class="form-control" id="city_id" name="city_id" onchange="getLocation(this.value)">
                                                         <option value="">Select City</option>
                                                          <?php foreach ($city_list as $city) { ?>
                                                        <option value="<?= $city->city_id ?>" <?php if($id && $property_detail->city_id==$city->city_id) { echo 'selected'; } ?>><?= $city->city_name ?></option>
                                                          <?php } ?>
                                                     </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Location:</label>

                                                    <select class="form-control" id="location_id" name="location_id">
                                                         <option value="">Select Location</option>
                                                          <?php foreach ($location_list as $location) { ?>
                                                        <option value="<?= $location->location_id ?>" <?php if($id && $property_detail->location_id==$location->location_id) { echo 'selected'; } ?>><?= $location->location_name ?></option>
                                                          <?php } ?>
                                                     </select>
                                                </div>


	                                            <div class="form-group col-md-3">
                                                    <label>Lat:</label>
                                                    <input type="text" class="form-control" id="latitude" name="latitude" value="<?php if($id) { echo $property_detail->latitude; } ?>">
                                                </div>
	                                            <div class="form-group col-md-3">
                                                    <label>Long:</label>
                                                    <input type="text" class="form-control" id="longitude" name="longitude" value="<?php if($id) { echo $property_detail->longitude; } ?>">
                                                </div>
	                                            <div class="form-group col-md-6">
                                                    <label>Address:</label>
                                                    <textarea class="form-control" id="address" name="address" rows="2"><?php if($id) { echo $property_detail->address; } ?></textarea>
                                                </div>
	                                            <div class="form-group col-md-12">
                                                    <label>Google Location:</label>
                                                    <!--<img src="<?php echo base_url('public/admin/images/');?>map-bg.png" style="width: 100%;height: auto;" alt="">-->
                                                    <div id="map" style="width: 100%;height: 300px;margin-top:10px;"></div>
                                                </div>

	                                            <div class="form-group col-md-12 pt-3">
	                                            	<div class="row">
	                                            		<div class="col-md-6">
	                                    					<a href="<?= base_url(AGENT_URL) ?>"><button type="button" class="btn btn-danger">Close</button></a>
	                                            		</div>
	                                            		<div class="col-md-6" align="right">
	                                    					<button type="submit" class="btn btn-dark step-1-btn w-120">Save & Next</button>
	                                            		</div>
	                                            	</div>
	                                            </div>

	                                        </div>
	                                    </form>
	                                </div>

	                                <div class="step_2 s-hide">
	                                    <form method="post" id="step-2-form" enctype="multipart/form-data" autocomplete="off">
	                                    	<input type="hidden" class="pid" name="id" value="<?= $id ?>">
	                                    	<input type="hidden" name="step" value="2">
	                                        <div class="form-row">

		                                    	
	                                            <div class="form-group col-md-6 project_society">
	                                                <label>Name of Project/ Society	:</label>
	                                                <input type="text" class="form-control" id="project_society" name="project_society" value="<?php if($id) { echo $property_detail->project_society; } ?>">
	                                            </div>

		                                        <div class="form-group col-md-6 land_zone">
	                                                <label>Land Zone:</label>
                                            		<select class="form-control" id="land_zone" name="land_zone">
                                                     	<option value="">Land Zone</option>
                                                     	<option value="1" <?php if($id && $property_detail->land_zone==1) { echo 'selected'; } ?>>Industrial</option>
                                                     	<option value="2" <?php if($id && $property_detail->land_zone==2) { echo 'selected'; } ?>>Commercial</option>
                                                      <option value="3" <?php if($id && $property_detail->land_zone==3) { echo 'selected'; } ?>>Residential</option>
                                                     </select>
                                                 </div>

	                                             <?php 
	                                             $array = array();
	                                             if($id && $property_detail->ideal_business_id) {
	                                             	$array = explode(",", $property_detail->ideal_business_id);
	                                             } ?>
                                             	<div class="form-group col-md-6 ideal_business_id">
	                                                <label>Ideal for Business:</label>
                                            		<select class="form-control" id="ideal_business_id" name="ideal_business_id[]" multiple="" style="width: 100%;">
                                                     	<option value="" disabled="">Select Business</option>
                                                     	<?php foreach ($ideal_business_list as $item) { ?>
                                                            <option value="<?= $item->ideal_business_id ?>" <?php if(in_array($item->ideal_business_id, $array)) { echo 'selected'; } ?> ><?= $item->ideal_business_name ?></option>
                                                          <?php } ?>
                                                     </select>
                                             	</div>

	                                            <div class="form-group col-md-6 ideal_business_id">
	                                            </div>

                                              <div class="form-group col-md-3 sociaty_name">
                                                  <label>Name of Sociaty:</label>
                                                  <input type="text" class="form-control" id="sociaty_name" name="sociaty_name" value="<?php if($id) { echo $property_detail->sociaty_name; } ?>">
                                              </div>

	                                            <div class="form-group col-md-3 input_bedroom">
	                                                <label>Bedroom	:</label>
	                                                <input type="text" class="form-control" id="bedroom" name="bedroom" value="<?php if($id) { echo $property_detail->bedroom; } ?>">
	                                            </div>

	                                            <div class="form-group col-md-3 input_balconies">
	                                                <label>Balconies	:</label>
	                                                <input type="text" class="form-control" id="balconies" name="balconies" value="<?php if($id) { echo $property_detail->balconies; } ?>">
	                                            </div>

	                                            <div class="form-group col-md-3 input_floor">
	                                                <label>Floor:</label>
	                                                <input type="text" class="form-control" id="floor" name="floor" value="<?php if($id) { echo $property_detail->floor; } ?>">
	                                            </div>

	                                            <div class="form-group col-md-3 input_total_floor">
	                                                <label>Total Floor:</label>
	                                                <input type="text" class="form-control" id="total_floor" name="total_floor" value="<?php if($id) { echo $property_detail->total_floor; } ?>">
	                                            </div>

	                                            <div class="form-group col-md-6 input_bathroom">
	                                                <label>Bathroom:</label>
	                                                <input type="text" class="form-control" id="bathroom" name="bathroom" value="<?php if($id) { echo $property_detail->bathroom; } ?>">
	                                            </div>

	                                            <div class="form-group col-md-12 furnised">
		                                            <div class="row">
		                                            	<div class="form-group col-md-6">
			                                                <label>Furnised Status:</label>
			                                                <select class="form-control"id="furnised_status_id" name="furnised_status_id" onchange="furnishingList()">
		                                                      <option value="">Select Furnised Status</option>
		                                                      <?php foreach ($furnised_status_list as $item) { ?>
		                                                        <option value="<?= $item->furnised_status_id ?>" <?php if($id && $property_detail->furnised_status_id==$item->furnised_status_id) { echo 'selected'; } ?> ><?= $item->title ?></option>
		                                                      <?php } ?>
		                                                    </select>
			                                            </div>

                                                  <div class="form-group col-md-6">
                                                  </div>

                                                  <div class="form-group col-md-6 furnishing_list">
                                                    <div style="border: 1px solid #ced4da;border-radius:3px;padding: 15px 20px 20px 20px;">
                                                        <h5>Furnished Details:</h5>
                                                        <hr>
                                                        <?php foreach ($furnishing_list as $item) { ?>
                                                        <div class="row" style="margin-top: 10px;">
                                                          <div class="col-md-6"><?= $item->furnishing_name ?></div>
                                                          <div class="col-md-6" align="right">
                                                            <?php if($item->input_type==1) { ?>
                                                              <input type="text" class="form-control" style="width: 80px;" name="furnishing[<?= $item->furnishing_id ?>]" value="<?php if($id && isset($furnishing_array[$item->furnishing_id])) { echo $furnishing_array[$item->furnishing_id]; } ?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                                            <?php } ?>
                                                            <?php if($item->input_type==2) { ?>
                                                              <label class="radio"><input type="radio" name="furnishing[<?= $item->furnishing_id ?>]" value="1" <?php if($id && isset($furnishing_array[$item->furnishing_id]) &&  $furnishing_array[$item->furnishing_id]==1) { echo "checked"; } ?> > Yes</label>
                                                              <label class="radio"><input type="radio" name="furnishing[<?= $item->furnishing_id ?>]" value="0" <?php if($id) { if(isset($furnishing_array[$item->furnishing_id]) &&  $furnishing_array[$item->furnishing_id]==0) { echo 'checked'; } } else { echo "checked"; } ?>> No</label>
                                                            <?php } ?>
                                                          </div>
                                                        </div>
                                                      <?php } ?>
                                                    </div>
                                                </div>

		                                            </div>
		                                        </div>


                                            	<div class="form-group col-md-6 modify_interiors">
                                        			<label>Willing to Modify interiors :</label>
                                            		<select class="form-control" id="modify_interiors" name="modify_interiors">
                                                         <option value="1" <?php if($id && $property_detail->modify_interiors==1) { echo 'selected'; } ?> >Yes</option>
                                                         <option value="0" <?php if($id) { if($property_detail->modify_interiors==0) { echo 'selected'; } } else { echo 'selected'; } ?>>No</option>
                                                  	</select>
                                            	</div>

                                            	<div class="form-group col-md-3 lock_period_year">
	                                                <label>Lock-in-Period (in Year):</label>
	                                                <input type="text" class="form-control" id="lock_period_year" name="lock_period_year" value="<?php if($id) { echo $property_detail->lock_period_year; } ?>">
	                                            </div>

                                            	<div class="form-group col-md-3 personal_washroom">
	                                                <label>Personal Washroom:</label>
	                                                <input type="text" class="form-control" id="personal_washroom" name="personal_washroom" value="<?php if($id) { echo $property_detail->personal_washroom; } ?>">
	                                            </div>

                                              <div class="form-group col-md-3 personal_washroom_checkbox">
                                                  <label style="margin-top: 23px;">
                                                  <input type="checkbox" id="personal_washroom_checkbox" name="personal_washroom_checkbox" value="1" <?php if($id && $property_detail->personal_washroom==1) { echo 'checked'; } ?> > &nbsp;Personal Washroom</label>
                                              </div>

	                                            <div class="form-group col-md-6 pantry_cafeteria">
                                        			<label>Pantry :</label>
                                            		<select class="form-control" id="pantry_cafeteria" name="pantry_cafeteria">
                                            			<option value="">Select Pantry/Cafeteria</option>
                                                         <option value="1" <?php if($id && $property_detail->pantry_cafeteria==1) { echo 'selected'; } ?> >Dry</option>
                                                         <option value="2" <?php if($id && $property_detail->pantry_cafeteria==2) { echo 'selected'; } ?> >Wet</option>
                                                         <option value="3" <?php if($id && $property_detail->pantry_cafeteria==3) { echo 'selected'; } ?> >Not Avaliable</option>
                                                  	</select>
                                            	</div>

	                                            <div class="form-group col-md-6 corner_plot">
	                                                <label>Is this Corner Plot:</label>
                                            		<select class="form-control" id="corner_plot" name="corner_plot">
                                                     	<option value="">Is this Corner Plot</option>
                                                     	<option value="1" <?php if($id && $property_detail->corner_plot==1) { echo 'selected'; } ?>>Yes</option>
                                                     	<option value="2" <?php if($id && $property_detail->corner_plot==0) { echo 'selected'; } ?>>No</option>
                                                     </select>
                                                 </div>

                                                 <div class="form-group col-md-6 park_facing">
                                                  <label>Park Facing:</label>
                                                <select class="form-control" id="park_facing" name="park_facing">
                                                      <option value="1" <?php if($id && $property_detail->park_facing==1) { echo 'selected'; } ?>>Yes</option>
                                                      <option value="2" <?php if($id) { if($property_detail->park_facing==0) { echo 'selected'; } } else { echo 'selected'; } ?>>No</option>
                                                     </select>
                                                 </div>

                                                 <div class="form-group col-md-6 approval_state">
                                                  <label>Approval State:</label>
                                                <select class="form-control" id="approval_state" name="approval_state">
                                                      <option value="">Select Approval State</option>
                                                      <option value="1" <?php if($id && $property_detail->approval_state==1) { echo 'selected'; } ?>>Socity Patta</option>
                                                      <option value="2" <?php if($id && $property_detail->approval_state==2) { echo 'selected'; } ?>>Government Approved</option>
                                                     </select>
                                                 </div>

	                                            <div class="form-group col-md-6 corner_shop">
	                                                <label>Corner Shop:</label>
                                            		<select class="form-control" id="corner_shop" name="corner_shop">
                                                     	<option value="1" <?php if($id && $property_detail->corner_shop==1) { echo 'selected'; } ?>>Yes</option>
                                                     	<option value="2" <?php if($id) { if($id && $property_detail->corner_shop==0) { echo 'selected'; } } else { echo 'selected'; } ?>>No</option>
                                                     </select>
                                                 </div>

	                                            <div class="form-group col-md-6 main_road_shop">
	                                                <label>Main Road Shop:</label>
                                            		<select class="form-control" id="main_road_shop" name="main_road_shop">
                                                     	<option value="1" <?php if($id && $property_detail->main_road_shop==1) { echo 'selected'; } ?>>Yes</option>
                                                     	<option value="2" <?php if($id) { if($id && $property_detail->main_road_shop==0) { echo 'selected'; } } else { echo 'selected'; } ?>>No</option>
                                                     </select>
                                                 </div>

	                                            <div class="form-group col-md-6 facing">
                                                <label>Facing:</label>
                                          		<select class="form-control" id="facing_id" name="facing_id">
                                                   	<option value="">Select Facing</option>
                                                   	<?php foreach ($facing_list as $item) { ?>
                                                          <option value="<?= $item->facing_id ?>" <?php if($id && $property_detail->facing_id==$item->facing_id) { echo 'selected'; } ?> ><?= $item->title ?></option>
                                                        <?php } ?>
                                                   </select>
                                               </div>

                                               <div class="form-group col-md-6 road_wirth">
                                                  <label>Road Wirth:</label>
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                      <input type="text" class="form-control" id="road_wirth" name="road_wirth" value="<?php if($id) { echo $property_detail->road_wirth; } ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                      <select class="form-control" id="road_wirth_unit" name="road_wirth_unit">
                                                               <option value="">Select Unit</option>
                                                              <?php foreach ($unit_list as $item) { ?>
                                                          <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->road_wirth_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
                                                            <?php } ?>
                                                            </select>
                                                    </div>
                                                  </div>
                                              </div>

	                                            <div class="col-md-12">
	                                                <h4 style="padding: 0px 0px 5px 0px;margin: 0px;">Area:</h4>
	                                            </div>

	                                             <div class="form-group col-md-6 covered_area">
	                                                <label>Covered Area:</label>
	                                                <div class="row">
	                                                	<div class="col-md-6">
	                                                		<input type="text" class="form-control" id="covered_area" name="covered_area" value="<?php if($id) { echo $property_detail->covered_area; } ?>">
	                                                	</div>
	                                                	<div class="col-md-6">
	                                                		<select class="form-control" id="covered_area_unit" name="covered_area_unit">
	                                                             <option value="">Select Unit</option>
	                                                            <?php foreach ($unit_list as $item) { ?>
			                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->covered_area_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
		                                                        <?php } ?>
                                                          	</select>
	                                                	</div>
	                                                </div>
	                                            </div>

                                             	<div class="form-group col-md-6 plot_area">
	                                                <label>Plot Area:</label>
	                                                <div class="row">
	                                                	<div class="col-md-6">
	                                                		<input type="text" class="form-control" id="plot_area" name="plot_area" value="<?php if($id) { echo $property_detail->plot_area; } ?>">
	                                                	</div>
	                                                	<div class="col-md-6">
	                                                		<select class="form-control" id="plot_area_unit" name="plot_area_unit">
	                                                             <option value="">Select Unit</option>
	                                                            <?php foreach ($unit_list as $item) { ?>
			                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->plot_area_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
		                                                        <?php } ?>
                                                          	</select>
	                                                	</div>
	                                                </div>
	                                            </div>

                                             	<div class="form-group col-md-6 plot_size">
	                                                <label>Plot Size:</label>
	                                                	<div class="row">
	                                                	<div class="col-md-4">
	                                                		<input type="text" class="form-control" placeholder="Length" id="plot_size_length" name="plot_size_length" value="<?php if($id) { echo $property_detail->plot_size_length; } ?>">
	                                                	</div>
	                                                	<div class="col-md-4">
	                                                		<input type="text" class="form-control" placeholder="Wirth" id="plot_size_wirth" name="plot_size_wirth" value="<?php if($id) { echo $property_detail->plot_size_wirth; } ?>">
	                                                	</div>
	                                                	<div class="col-md-4">
	                                                		<select class="form-control" id="plot_size_unit" name="plot_size_unit">
	                                                             <option value="">Select Unit</option>
	                                                            <?php foreach ($unit_list as $item) { ?>
			                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->plot_size_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
		                                                        <?php } ?>
                                                          	</select>
	                                                	</div>
	                                                </div>
	                                            </div>

                                             	<div class="form-group col-md-6 built_up_area">
	                                                <label>Built Up Area:</label>
	                                                <div class="row">
	                                                	<div class="col-md-6">
	                                                		<input type="text" class="form-control" id="built_up_area" name="built_up_area" value="<?php if($id) { echo $property_detail->built_up_area; } ?>">
	                                                	</div>
	                                                	<div class="col-md-6">
	                                                		<select class="form-control" id="built_up_area_unit" name="built_up_area_unit">
	                                                             <option value="">Select Unit</option>
	                                                            <?php foreach ($unit_list as $item) { ?>
			                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->built_up_area_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
		                                                        <?php } ?>
                                                          	</select>
	                                                	</div>
	                                                </div>
	                                            </div>

	                                            <div class="form-group col-md-6 super_area">
	                                                <label>Super Area:</label>
	                                                <div class="row">
	                                                	<div class="col-md-6">
	                                                		<input type="text" class="form-control" id="super_area" name="super_area" value="<?php if($id) { echo $property_detail->super_area; } ?>">
	                                                	</div>
	                                                	<div class="col-md-6">
	                                                		<select class="form-control" id="super_area_unit" name="super_area_unit">
	                                                             <option value="">Select Unit</option>
	                                                            <?php foreach ($unit_list as $item) { ?>
			                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->super_area_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
		                                                        <?php } ?>
                                                          	</select>
	                                                	</div>
	                                                </div>
	                                            </div>

                                             	<div class="form-group col-md-6 super_built_up_area">
	                                                <label>Super Builtup Area:</label>
	                                                <div class="row">
	                                                	<div class="col-md-6">
	                                                		<input type="text" class="form-control" id="super_built_up_area" name="super_built_up_area" value="<?php if($id) { echo $property_detail->super_built_up_area; } ?>">
	                                                	</div>
	                                                	<div class="col-md-6">
	                                                		<select class="form-control" id="super_built_up_area_unit" name="super_built_up_area_unit">
	                                                             <option value="">Select Unit</option>
	                                                            <?php foreach ($unit_list as $item) { ?>
			                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->super_built_up_area_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
		                                                        <?php } ?>
                                                          	</select>
	                                                	</div>
	                                                </div>
	                                            </div>

	                                            <div class="form-group col-md-6 shop_size">
	                                                <label>Shop Size:</label>
	                                                	<div class="row">
	                                                	<div class="col-md-4">
	                                                		<input type="text" class="form-control" placeholder="Length" id="shop_size_length" name="shop_size_length" value="<?php if($id) { echo $property_detail->shop_size_length; } ?>">
	                                                	</div>
	                                                	<div class="col-md-4">
	                                                		<input type="text" class="form-control" placeholder="Wirth" id="shop_size_wirth" name="shop_size_wirth" value="<?php if($id) { echo $property_detail->shop_size_wirth; } ?>">
	                                                	</div>
	                                                	<div class="col-md-4">
	                                                		<select class="form-control" id="shop_size_unit" name="shop_size_unit">
	                                                             <option value="">Select Unit</option>
	                                                            <?php foreach ($unit_list as $item) { ?>
			                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->shop_size_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
		                                                        <?php } ?>
                                                          	</select>
	                                                	</div>
	                                                </div>
	                                            </div>

	                                            <div class="form-group col-md-6 property_status">
	                                                <label>Property Status:</label>
                                            		<select class="form-control" id="property_status" name="property_status">
                                                     	<option value="">Property Status</option>
                                                     	<option value="1" <?php if($id && $property_detail->property_status==1) { echo 'selected'; } ?>>Under Construction</option>
                                                     	<option value="2" <?php if($id && $property_detail->property_status==2) { echo 'selected'; } ?>>Ready to Moov</option>
                                                     </select>
                                                 </div>

	                                            <div class="form-group col-md-12" align="right">
	                                    			<button type="button" class="btn btn-dark mr-10" onclick="step2Prev()">Previous</button>
	                                    			<button type="submit" class="btn btn-dark step-2-btn w-120">Save & Next</button>
	                                            </div>

	                                        </div>
	                                    </form>
	                                </div>

	                                <div class="step_3 s-hide">
	                                    <form method="post" id="step-3-form" enctype="multipart/form-data" autocomplete="off">
	                                    	<input type="hidden" class="pid" name="id" value="<?= $id ?>">
	                                    	<input type="hidden" name="step" value="3">
	                                        <div class="form-row">
	                                        	<div class="col-md-12">
	                                        		<h5>Transaction Type / Avaliability</h5>
	                                        	</div>

	                                            <div class="form-group col-md-4">
	                                                <label>Available From:</label>
	                                                <input type="text" class="form-control mydatepicker" placeholder="" id="avaliability_from" name="avaliability_from" value="<?php if($id) { echo $property_detail->avaliability_from; } else { echo date("d-m-Y"); } ?>" >
	                                            </div>

	                                            <div class="form-group col-md-4" style="padding-top: 29px;padding-left: 20px;">
	                                                <label>
	                                                <input type="checkbox" value="1" id="immediately" name="immediately" <?php if($id && $property_detail->immediately) { echo 'checked'; } ?> > &nbsp; Immediately</label>
	                                            </div>

	                                            <div class="form-group col-md-6 construction_age">
                                                  <h5 style="padding: 0px 0px 5px 0px;margin: 0px;">Construction Stage:</h5>
	                                                <label>Age of Construction:</label>
                                            		<select class="form-control" id="construction_age" name="construction_age">
                                                         <option value="">Select Age</option>
                                                         <?php foreach ($construction_age_list as $item) { ?>
                                                            <option value="<?= $item->construction_age_id ?>" <?php if($id && $property_detail->construction_age==$item->construction_age_id) { echo 'selected'; } ?> ><?= $item->construction_age_name ?></option>
                                                          <?php } ?>
                                                  	</select>
	                                            </div>

	                                            <div class="form-group col-md-6 construction_age">
	                                            </div>

	                                            <div class="form-group col-md-6 rent_detail s-hide">
	                                                <h5>For Rent (Rent Details):</h5>
	                                                	<div class="row">
		                                                	<div class="form-group col-md-12">
	                                                			<label>Monthly Rent:</label>
	                                                			<div class="row">
		                                                			<div class="col-md-6">
	                                                					<input type="text" class="form-control" placeholder="" id="monthly_rent" name="monthly_rent" value="<?php if($id) { echo $property_detail->monthly_rent; } ?>">
                                                					</div>
	                                                				<div class="col-md-6 c-showroom">
				                                                		<select class="form-control" id="monthly_rent_unit" name="monthly_rent_unit">
				                                                             <option value="">Select Unit</option>
				                                                            <?php foreach ($unit_list as $item) { ?>
						                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->monthly_rent_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
					                                                        <?php } ?>
			                                                          	</select>
				                                                	</div>
				                                                </div>
		                                                	</div>
		                                                	<div class="form-group col-md-12">
	                                                			<label>Security Deposit:</label>
	                                                			<input type="text" class="form-control" placeholder="" id="security_deposit" name="security_deposit" value="<?php if($id) { echo $property_detail->security_deposit; } ?>">
		                                                	</div>
		                                                	<div class="form-group col-md-12">
	                                                			<label>Maintenance:</label>
	                                                			<div class="row">
		                                                			<div class="col-md-12">
			                                                			<input type="text" class="form-control" placeholder="" id="maintenance" name="maintenance" value="<?php if($id) { echo $property_detail->maintenance; } ?>">
			                                                		</div>
	                                                				<!--<div class="col-md-6">
				                                                		<select class="form-control" id="maintenance_unit" name="maintenance_unit">
				                                                             <option value="">Select Unit</option>
				                                                            <?php foreach ($unit_list as $item) { ?>
						                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->maintenance_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
					                                                        <?php } ?>
			                                                          	</select>
				                                                	</div>-->
				                                                </div>
		                                                	</div>
		                                                	<div class="form-group col-md-12 c-showroom">
	                                                			<label>Electrticity will charges Extra:</label>
		                                                		<select class="form-control" id="electrticity_charge" name="electrticity_charge">
		                                                             <option value="1" <?php if($id && $property_detail->electrticity_charge==1) { echo 'selected'; } ?> >Yes</option>
		                                                             <option value="0" <?php if($id) { if($property_detail->electrticity_charge==0) { echo 'selected'; } } else { echo 'selected'; } ?>>No</option>
	                                                          	</select>
		                                                	</div>
		                                                	<div class="form-group col-md-12 c-showroom">
	                                                			<label>Water Bill will Charges Extra:</label>
		                                                		<select class="form-control" id="water_bill_charge" name="water_bill_charge">
		                                                             <option value="1" <?php if($id && $property_detail->water_bill_charge==1) { echo 'selected'; } ?> >Yes</option>
		                                                             <option value="0" <?php if($id) { if($property_detail->water_bill_charge==0) { echo 'selected'; } } else { echo 'selected'; } ?>>No</option>
	                                                          	</select>
		                                                	</div>

                                                      <div class="form-group col-md-12 rent_amenities">
                                                        <?php 
                                                        $amenities = array();
                                                        if($id && $property_detail->rent_amenities) {
                                                          $amenities = explode(",", $property_detail->rent_amenities);
                                                        } ?>
                                                        <label>Amenities:</label>
                                                        <select class="multipleSelect form-control" multiple="" name="rent_amenities[]" id="rent_amenities" style="width: 100%;">
                                                          <option value="">Select Amenities</option>
                                                          <?php foreach ($amenitie_list as $amenitie) { ?>
                                                                <option value="<?= $amenitie->amenitie_id ?>" <?= (in_array($amenitie->amenitie_id, $amenities))?'selected':''; ?> ><?= $amenitie->amenitie_name ?></option>
                                                             <?php } ?>
                                                       </select>
                                                      </div>
		                                                </div>
	                                            </div>

	                                            <div class="form-group col-md-6 sale_detail s-hide">
	                                                <h5>For Sale:</h5>
	                                                	<div class="row">
		                                                	<div class="form-group col-md-12">
	                                                			<label>Asking Price:</label>
	                                                			<div class="row">
		                                                			<div class="col-md-6">
			                                                			<input type="text" class="form-control" placeholder="" id="sale_price" name="sale_price" value="<?php if($id) { echo $property_detail->sale_price; } ?>">
			                                                		</div>
	                                                				<div class="col-md-6">
				                                                		<select class="form-control" id="sale_price_unit" name="sale_price_unit">
				                                                             <option value="">Select Unit</option>
				                                                            <?php foreach ($unit_list as $item) { ?>
						                                                    <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->sale_price_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
					                                                        <?php } ?>
			                                                          	</select>
				                                                	</div>
				                                                </div>
		                                                	</div>
		                                                	<div class="form-group col-md-12">
	                                                			<label>Other Charges:</label>
	                                                			<input type="text" class="form-control" placeholder="" id="sale_other_charge" name="sale_other_charge" value="<?php if($id) { echo $property_detail->sale_other_charge; } ?>">
		                                                	</div>

                                                      <div class="form-group col-md-12 sale_amenities">
                                                        <?php 
                                                        $amenities = array();
                                                        if($id && $property_detail->sale_amenities) {
                                                          $amenities = explode(",", $property_detail->sale_amenities);
                                                        } ?>
                                                        <label>Amenities:</label>
                                                        <select class="multipleSelect form-control" multiple="" name="sale_amenities[]" id="sale_amenities" style="width: 100%;">
                                                          <option value="">Select Amenities</option>
                                                          <?php foreach ($amenitie_list as $amenitie) { ?>
                                                                <option value="<?= $amenitie->amenitie_id ?>" <?= (in_array($amenitie->amenitie_id, $amenities))?'selected':''; ?> ><?= $amenitie->amenitie_name ?></option>
                                                             <?php } ?>
                                                       </select>
                                                      </div>

                                                  
		                                                </div>
	                                            </div>

                                              <div class="form-group col-md-6">
                                                <div class="rate">
                                                    <h5>Cost Detail</h5>
                                                    <label>Rate:</label>
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                        <input type="text" class="form-control" id="rate" name="rate" value="<?php if($id) { echo $property_detail->rate; } ?>">
                                                      </div>
                                                      <div class="col-md-6">
                                                        <select class="form-control" id="rate_unit" name="rate_unit">
                                                                 <option value="">Select Unit</option>
                                                                <?php foreach ($unit_list as $item) { ?>
                                                            <option value="<?= $item->unit_id ?>" <?php if($id && $property_detail->rate_unit==$item->unit_id) { echo 'selected'; } ?> ><?= $item->unit_name ?></option>
                                                              <?php } ?>
                                                              </select>
                                                      </div>

                                                      <div class="col-md-12 inclusive_all" style="padding-top: 15px;padding-left: 20px;">
                                                          <label>
                                                          <input type="checkbox" value="1" id="inclusive_all" name="inclusive_all" <?php if($id && $property_detail->inclusive_all) { echo 'checked'; } ?> > &nbsp; Inclusive all </label>
                                                      </div>

                                                      <div class="col-md-12 remark" style="padding-top: 15px;">
                                                          <label>Remarks:</label>
                                                          <textarea class="form-control" id="remark" name="remark" rows="2"><?php if($id) { echo $property_detail->remark; } ?></textarea>
                                                      </div>

                                                    </div>
                                                </div>

                                                <div class="row amenities" style="padding-top: 15px;padding-bottom: 15px;">
                                                  <div class="col-md-12">
                                                    <?php 
                                                    $amenities = array();
                                                    if($id && $property_detail->amenities) {
                                                      $amenities = explode(",", $property_detail->amenities);
                                                    } ?>
                                                    <label>Amenities:</label>
                                                    <select class="multipleSelect form-control" multiple="" name="amenitie[]" id="select_amenitie" style="width: 100%;">
                                                      <option value="">Select Amenities</option>
                                                      <?php foreach ($amenitie_list as $amenitie) { ?>
                                                            <option value="<?= $amenitie->amenitie_id ?>" <?= (in_array($amenitie->amenitie_id, $amenities))?'selected':''; ?> ><?= $amenitie->amenitie_name ?></option>
                                                         <?php } ?>
                                                   </select>
                                                  </div>
                                                </div>
                                              </div>

                                              

	                                            <div class="form-group col-md-12" align="right">
	                                    			<button type="button" class="btn btn-dark mr-10" onclick="step3Prev()">Previous</button>
	                                    			<button type="submit" class="btn btn-dark step-3-btn w-120">Save & Next</button>
	                                            </div>

	                                        </div>
	                                    </form>
	                                </div>

	                                <div class="step_4 s-hide">
	                                    <form method="post" id="step-4-form" enctype="multipart/form-data" autocomplete="off">
	                                    	<input type="hidden" class="pid" name="id" value="<?= $id ?>">
	                                    	<input type="hidden" name="step" value="4">
	                                        <div class="form-row">

	                                            <div class="form-group col-md-12">
	                                                <label>Name of Owner:</label>
	                                                <div class="row">
	                                                	<div class="col-md-4">
	                                                		<select class="form-control" id="owner_title" name="owner_title">
			                                                    <option selected="selected" value="">Select Title</option>
			                                                    <option value="Mr." <?php if($id && $property_detail->owner_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
			                                                    <option value="Ms." <?php if($id && $property_detail->owner_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
			                                                    <option value="Mrs." <?php if($id && $property_detail->owner_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
			                                                    <option value="M/s." <?php if($id && $property_detail->owner_title=='M/s.') { echo 'selected'; } ?>>M/s.</option>
                                                          
			                                                    <option value="Dr." <?php if($id && $property_detail->owner_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
			                                                    <option value="Prof." <?php if($id && $property_detail->owner_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
			                                                   
			                                                </select>
	                                                	</div>
	                                                	<div class="col-md-4">
	                                                		<input type="text" class="form-control" placeholder="First Name" id="owner_first_name" name="owner_first_name" value="<?php if($id) { echo $property_detail->owner_first_name; } ?>" required="">
	                                                	</div>
	                                                	<div class="col-md-4">
	                                                		<input type="text" class="form-control" placeholder="Last Name" id="owner_last_name" name="owner_last_name" value="<?php if($id) { echo $property_detail->owner_last_name; } ?>">
	                                                	</div>
	                                                </div>
	                                            </div>

	                                            <div class="form-group col-md-6">
	                                                <label>Mobile No:</label>
	                                                <input type="text" class="form-control" placeholder="" id="owner_mobile_no" name="owner_mobile_no" value="<?php if($id) { echo $property_detail->owner_mobile_no; } ?>" maxlength="10" required="" oninput="get_customer_by_mobile()" />
	                                            </div>

	                                            <div class="form-group col-md-6">
	                                                <label>Contact No:</label>
	                                                <input type="text" class="form-control" placeholder="" id="owner_contact_no" name="owner_contact_no" value="<?php if($id) { echo $property_detail->owner_contact_no; } ?>" maxlength="10">
	                                            </div>

	                                            <div class="form-group col-md-12">
	                                                <label>Email Id:</label>
	                                                <input type="email" class="form-control" placeholder="" id="owner_email" name="owner_email" value="<?php if($id) { echo $property_detail->owner_email; } ?>">
	                                            </div>

	                                            <div class="form-group col-md-6">
	                                                <label>Upload Photo:</label>
	                                                <input type="file" class="form-control input_photo s-hide" id="photo" name="photo" accept="image/jpg,image/jpeg,image/png">

                    								<div> 
                    									<button type='button' class='btn btn-primary btn-sm btn_photo' onclick="browseFile('photo')">Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> 
                    								</div>
                									<div class='span_photo mt-1'></div>

                    								<?php if($id && $property_detail->photo) { ?><a href="<?= base_url('uploads/images/property/photo/'.$property_detail->photo) ?>" class="text-info text-underline" target="_blank">View</a>
                    								<?php } ?>
	                                            </div>

	                                            <div class="form-group col-md-6">
	                                                <label>Upload Video:</label>
	                                                <input type="text" class="form-control" placeholder="Enter Youtube Link" id="youtube_video" name="youtube_video" value="<?php if($id) { echo $property_detail->youtube_video; } ?>">
	                                            </div>

	                                            <div class="form-group col-md-12" align="right">
	                                    			<button type="button" class="btn btn-dark mr-10" onclick="step4Prev()">Previous</button>
	                                    			<button type="submit" class="btn btn-dark step-1-btn w-120">Save & Post</button>
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
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

<div class="loader_progress"></div>

<?php include('include/footer.php');?>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<!-- map -->
<script>
  var map;
  function initMap() {
    var myLatLng = {};
    <?php if($id && $property_detail->latitude && $property_detail->longitude) { ?>
    myLatLng = {lat: <?= $property_detail->latitude ?>, lng: <?= $property_detail->longitude ?>};
    <?php } else { ?>
    myLatLng = {lat: 20.9214236, lng: 73.11321};
    <?php } ?>
    map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      zoom: <?php if($id){ echo 15; } else { echo 4; } ?>
    });

    <?php if($id && $property_detail->latitude && $property_detail->longitude) { ?>
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,            
      draggable: true,
      //title: 'Hello World!'
    });

    google.maps.event.addListener(marker, 'dragend', function (event) {
        $("#latitude").val(this.getPosition().lat());
        $("#longitude").val(this.getPosition().lng());
    });
  <?php } ?>
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKuWzkssV5VE2pjY-pt4oV7G9AEmgI8-k&callback=initMap"
async defer></script>

<script>
$("#latitude").change(function(){
  showMap();
});
$("#longitude").change(function(){
  showMap();
});
function showMap(){
  var latitude = $("#latitude").val();
  var longitude = $("#longitude").val();
  myLatLng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
  if(latitude!="" && longitude!=""){
    map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      zoom: 15
    });
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,      
      draggable: true,
    });

    google.maps.event.addListener(marker, 'dragend', function (event) {
        $("#latitude").val(this.getPosition().lat());
        $("#longitude").val(this.getPosition().lng());
    });
  }
}

var furnised_status_list = <?= json_encode($furnised_status_list) ?>;
$('#ideal_business_id, #select_amenitie, #sale_amenities, #rent_amenities').select2();
$('.mydatepicker').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY', 
    minDate : new Date()
});

function browseFile(id) {
   $(".input_"+id).click();
   $(".span_"+id).text('');

    $(".input_"+id).change(function(e){
        var fileName = e.target.files[0].name;
        $(".span_"+id).text('Choose file: '+fileName);
    });
}

function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

function scrollTop() {
	$('html, body').animate({
    scrollTop: $(".property-listing").offset().top
}, 500);
}

 function step1Next() {
 	$(".step_1").hide();
 	$(".step_2").show();
 	scrollTop();

 }
  function step2Prev() {
 	$(".step_1").show();
 	$(".step_2").hide();
 	scrollTop();
 }
 function step2Next() {
 	$(".step_2").hide();
 	$(".step_3").show();
 	scrollTop();
 }
 function step3Prev() {
 	$(".step_2").show();
 	$(".step_3").hide();
 	scrollTop();
 }
 function step3Next() {
 	$(".step_3").hide();
 	$(".step_4").show();
 	scrollTop();
 }
 function step4Prev() {
 	$(".step_3").show();
 	$(".step_4").hide();
 	scrollTop();
 }
 function step4Save() {
 	alert('Property Added Successfully!!');
 }

function getCity(state_id) {
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
              $("#city_id").html(row);
            }
            else {
              $("#city_id").html("<option value=''>Select City</option>");
            }
            $("#location").html("<option value=''>Select Location</option>");
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

function getLocation(city_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url('get_locations') ?>",
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
              $("#location_id").html(row);
            }
            else {
              $("#location_id").html("<option value=''>Select Location</option>");
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

function checkData() {
	var product_type_id = $("#product_type_id").val();
	var unit_type_id = $("#unit_type_id").val(); 
	var furnised_status_id = $("#furnised_status_id").val(); 
  var listing_type = $("#listing_type").val();

	var html = "<option value=''>Select Furnised Status</option>";
    for (var j = 0; j < furnised_status_list.length; j++) {
    	var str = "";
    	if (furnised_status_list[j].furnised_status_id==furnised_status_id) {
    		str = "selected";
    	}

    	if (product_type_id=='3' && furnised_status_list[j].furnised_status_id=='3') {
	        
	    }
	    else {
	    	html += "<option value='"+furnised_status_list[j].furnised_status_id+"' "+str+">"+furnised_status_list[j].title+"</option>";
	    }
    }

    $("#furnised_status_id").html(html);

    if (product_type_id=='3') {
    	$(".furnised").hide();
    }
    else if ((product_type_id=='2' && unit_type_id=='3') || (product_type_id=='1' && unit_type_id=='6')) {
      $(".furnised").hide();
    }
    else {
    	$(".furnised").show();
    }

	$(".project_society, .input_bedroom, .input_balconies, .input_floor, .input_total_floor, .input_bathroom, .c-showroom, .land_zone, .covered_area, .plot_area, .plot_size, .built_up_area, .super_built_up_area, .property_status, .corner_plot, .facing, .modify_interiors, .lock_period_year, .personal_washroom, .pantry_cafeteria, .ideal_business_id, .super_area, .shop_size, .corner_shop, .main_road_shop, .road_wirth, .park_facing, .approval_state, .rate, .inclusive_all, .remark, .sociaty_name, .amenities, .personal_washroom_checkbox, .sale_amenities, .rent_amenities").hide();

  $(".rent_detail, .sale_detail").hide();

  changeListingType();

  $(".construction_age").show();

	if((product_type_id=='2' && (unit_type_id=='2' || unit_type_id=='8')) || (product_type_id=='1' && unit_type_id=='16')) {
		// for Residencial >  Villa/Independent House and Agricultural > Farm House
		$(".input_bedroom, .input_balconies, .input_floor, .input_total_floor, .input_bathroom, .covered_area, .plot_area, .plot_size, .sociaty_name, .rate, .inclusive_all, .remark, .amenities").show();

    $(".rent_detail").hide();
    $(".sale_detail").hide();
	}
	else if(product_type_id=='2' && unit_type_id=='7') {
		// for Residencial >  Builder Floor
		$(".input_bedroom, .input_balconies, .input_floor, .input_total_floor, .input_bathroom, .covered_area, .plot_area, .plot_size, .sale_amenities, .rent_amenities").show();
	}
	else if(product_type_id=='2' && (unit_type_id=='1' || unit_type_id=='9' || unit_type_id=='10')) {
		// for Residencial >  Multistore, pent house/ studio
		$(".input_bedroom, .input_balconies, .input_floor, .input_total_floor, .input_bathroom, .covered_area,.built_up_area, .super_built_up_area,.project_society").show();
	}
  else if((product_type_id=='2' && unit_type_id=='3') || (product_type_id=='1' && unit_type_id=='6')) {
    // for Residencial > Plot and agricultural >  land
    $(".plot_area, .plot_size, .facing, .road_wirth, .corner_plot, .park_facing, .approval_state, .inclusive_all, .remark, .rate").show();
    $(".construction_age").hide();

    $(".rent_detail").hide();
    $(".sale_detail").hide();
  }

	else if(product_type_id=='3' && (unit_type_id=='11' || unit_type_id=='14')) {
		// for Commercial >  Land
		$(".land_zone, .plot_area, .plot_size, .corner_plot, .facing").show();
    $(".construction_age").hide();
	}
	else if(product_type_id=='3' && unit_type_id=='5') {
		// for Commercial >  Office
		$(".input_floor, .input_total_floor, .input_bathroom, .land_zone, .covered_area, .built_up_area, .super_area, .modify_interiors, .lock_period_year, .pantry_cafeteria, .ideal_business_id, .personal_washroom_checkbox").show();
	}
	else if(product_type_id=='3' && unit_type_id=='4') {
		// for Commercial >  Shop
		$(".input_floor, .input_total_floor, .land_zone, .covered_area, .built_up_area, .super_area, .shop_size, .corner_shop, .main_road_shop, .lock_period_year, .pantry_cafeteria, .personal_washroom_checkbox").show();
	}
	else if(product_type_id=='3' && unit_type_id=='12') {
		// for Commercial >  Showroom
		$(".input_floor, .input_total_floor, .c-showroom, .land_zone, .covered_area, .built_up_area, .super_area, .shop_size, .corner_shop, .main_road_shop, .lock_period_year, .pantry_cafeteria, .personal_washroom_checkbox").show();
	}
  
  setTimeout(function() {
    propertyTitle();
  },200);
}

getUnitTypes(1);

function getUnitTypes(type) {
	if (type==1) {
		checkData();
    propertyTitle();
	}
	else {
		checkData();
		var product_type_id = $("#product_type_id").val();
	    $.ajax({
	          type: "POST",
	          url: "<?= base_url(AGENT_URL.'api/get_unit_types') ?>",
	          data: {product_type_id:product_type_id},
	          beforeSend: function (data) {
	          },
	          success: function (response) {
	            var obj;
	            try {
	              obj = JSON.parse(response);
	              if (obj.status=='success') {
	                var unit_type_list = obj.unit_type_list;
	                var row = "<option value=''>Select Type of Property</option>";
	                for (var i = 0; i<unit_type_list.length; i++) {
	                  row += "<option value='"+unit_type_list[i].unit_type_id+"'>"+unit_type_list[i].unit_type_name+"</option>";
	                }
	                $("#unit_type_id").html(row);
	              }
	              else {
	                $("#unit_type_id").html("<option value=''>Select Type of Property</option>");
	              }
                propertyTitle();
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
}

function changeListingType() {
	var listing_type = $("#listing_type").val();
	if(listing_type=='1') {
		$(".rent_detail").show();
		$(".sale_detail").hide();
	}
	else if(listing_type=='2') {
		$(".rent_detail").hide();
    $(".sale_detail").show();

		/*var product_type_id = $("#product_type_id").val();
		var unit_type_id = $("#unit_type_id").val(); 
		// for Commercial and  Showroom
		if(product_type_id=='3' && unit_type_id=='12') {
			$(".sale_detail").show();
		}
		else {
			$(".sale_detail").hide();
		}*/
	}
	else {
		$(".rent_detail").hide();
		$(".sale_detail").hide();
	}

  propertyTitle();
}

function propertyTitle() {
  var product_type_id = $("#product_type_id").val();
  var unit_type_id = $("#unit_type_id").val(); 
  var listing_type = $("#listing_type").val();

  var property_title = "";
  if (listing_type!="") {
    property_title += $("#listing_type option:selected").text();
  }
  if (product_type_id!="") {
    if (property_title!="") { property_title += " > "; }
    property_title += $("#product_type_id option:selected").text();
  }
  if (unit_type_id!="") {
    if (property_title!="") { property_title += " > "; }
    property_title += $("#unit_type_id option:selected").text();
  }

  if (property_title!="") {
    property_title = "("+property_title+")";
  }
  
  $(".property_title").html(property_title);
}
$("#step-1-form").validate({
    rules: {
        listing_type: {
            required:true
        }
    },
    messages: {
        listing_type: 'Please select listing type'
    },
    submitHandler: function(form) {
      var myform = document.getElementById("step-1-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/api/property_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".step-error-msg").html('');
          $(".step-1-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {

          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".step-1-btn").html("Save & Next").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {
                    $('.pid').val(obj.property_id);
                	//$(".step-error-msg").html(alertMessage('success',obj.message));
                    step1Next();
                    //changeListingType();
                    checkData();
                }
                else {
                  $(".step-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".step-1-btn").html("Save & Next").prop('disabled',false);
                $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
            $(".step-1-btn").html("Save & Next").prop('disabled',false);
          $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

$("#step-2-form").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("step-2-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/api/property_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".step-error-msg").html('');
          $(".step-2-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {

          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".step-2-btn").html("Save & Next").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {
                	//$(".step-error-msg").html(alertMessage('success',obj.message));
                    step2Next();
                }
                else {
                  $(".step-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".step-2-btn").html("Save & Next").prop('disabled',false);
                $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
            $(".step-2-btn").html("Save & Next").prop('disabled',false);
          $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

$("#step-3-form").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("step-3-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/api/property_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".step-error-msg").html('');
          $(".step-3-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {

          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".step-3-btn").html("Save & Next").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {
                	//$(".step-error-msg").html(alertMessage('success',obj.message));
                    step3Next();
                }
                else {
                  $(".step-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".step-3-btn").html("Save & Next").prop('disabled',false);
                $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
            $(".step-3-btn").html("Save & Next").prop('disabled',false);
          $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

$("#step-4-form").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("step-4-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/api/property_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".step-error-msg").html('');
          $(".step-4-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {

          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".step-4-btn").html("Save & Post").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {
                	//$(".step-error-msg").html(alertMessage('success',obj.message));
                    window.location.href='<?= base_url(AGENT_URL.'property') ?>';
                }
                else {
                  $(".step-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".step-4-btn").html("Save & Post").prop('disabled',false);
                $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
            $(".step-4-btn").html("Save & Post").prop('disabled',false);
          $(".step-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

function furnishingList(){
  var furnised_status_id = $("#furnised_status_id").val();
  if (furnised_status_id==1) {
    $(".furnishing_list").show(600);
  }
  else {
    $(".furnishing_list").hide(600);
  }
}
furnishingList();

function get_customer_by_mobile() {
  var mobile = $("#owner_mobile_no").val();
  if(mobile.length==10){
    $.ajax({
    type: "POST",
    url: "<?= base_url(AGENT_URL.'api/get_customer_by_mobile') ?>",
    data: {mobile:mobile},
    beforeSend: function (data) {
    },
    success: function (response) {
      var obj;
      try {
        obj = JSON.parse(response);
        console.log(response);
        if (obj.status=='success') {
          var customer_detail = obj.customer_detail;

          $("#owner_title").val(customer_detail.lead_title);
          $("#owner_first_name").val(customer_detail.lead_first_name);
          $("#owner_last_name").val(customer_detail.lead_last_name);
          $("#lead_mobile_no_2").val(customer_detail.owner_contact_no);
        }
      }
      catch(err) {
        //alert('Some error occurred, please try again.');
      }
    },
    error: function () {
        //alert('Some error occurred, please try again.');
       
    }

  });
  }
}
 </script>
