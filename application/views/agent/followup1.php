<?php include('include/header.php');?>
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
    margin-top: 10px;
}
}
.dataTables_wrapper {
    padding: 0px !important;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-5">
                                    	<div class="row">
                                    		<div class="col-md-6">
                                        		<h4 class="card-title">Leads</h4>
                                    		</div>
                                    		<div class="col-md-6" align="right">
                                        		<select class="form-control" style="height: 30px !important;min-height: 30px;padding: 0px 10px;width: 130px;">
                                                  <option value="">SORT BY</option>
                                                  <option value="1">Name</option>
                                                  <option value="2">Date of Creation</option>
                                                </select>
                                    		</div>

                                    		<div class="col-md-12">
                                        		<p>Total Leads: <span>24</span></p>
                                    		</div>

                                    		<div class="col-md-12" style="height: 450px;overflow-y: auto;">
                                    			<style>
                                    				.lead {
                                    					padding: 7px 10px;
                                    				}
                                    				.lead:hover {
                                    					background-color: #f2f2f8;
                                    					cursor: pointer;
                                    				}
                                    			</style>
                                    			<?php for ($i=1; $i <=10 ; $i++) { ?>
                                    			<div class="lead" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 10px;margin-bottom: 10px;" onclick="showLead()">
	                                        		<div class="row">
	                                    				<div class="col-md-2" align="center">
	                                    					<img class="mr-3" src="<?= base_url('public/admin/images/avatar/11.png') ?>" style="margin-top: 18px;" width="55" height="55" alt="">
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

	                                    					<div class="row" style="margin-top: 2px;">
	                                    						<div class="col-md-6">
	                                    							<h6 class="card-text text-muted"><i class="fa fa-mobile"></i> <span style="font-size: 12px;">+91999999999</span></h6>
	                                    						</div>

	                                    						<div class="col-md-6" align="right">
	                                    							<h6 class="card-text text-muted"><span style="font-size: 12px;">Stage</span></h6>
	                                    						</div>
	                                    					</div>

	                                    					<div class="row" style="margin-top: 4px;margin-bottom: 5px;">
	                                    						<div class="col-md-6">
	                                    						</div>

	                                    						<div class="col-md-6" align="right">
	                                    							<h6 class="card-text text-muted"><span style="font-size: 12px;">Source</span></h6>
	                                    						</div>
	                                    					</div>
	                                    					<small class="text-muted"><i class="fa fa-clock-o"></i> 26-10-2019 07:50 PM &nbsp; <i class="fa fa-bookmark"></i> Pooja Saini</small>
	                                    				</div>
	                                    			</div>
                                    			</div>
                                    			<?php } ?>

                                    		</div>

                                    	</div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="lead_detail" style="display: none;height: 535px;overflow-y: auto;">
                                        	<div style="padding: 0px 15px 20px 15px;">
                                        		<div class="row" style="border-bottom: 1px solid #0000000f;padding-bottom: 13px;margin-bottom: 10px;">
                                    				<div class="col-md-2" align="center">
                                    					<img class="mr-3" src="<?= base_url('public/admin/images/avatar/11.png') ?>" style="margin-top: 18px;" width="60" height="60" alt="">
                                    				</div>
                                    				<div class="col-md-10">

                                    					<div class="row">
                                    						<div class="col-md-6">
                                    							<h6 class="card-text text-muted"><i class="fa fa-calendar"></i> 10-12-2019</h6>
                                    						</div>

                                    						<div class="col-md-6" align="right">
                                    							<h6 class="card-text text-muted">Agent Name</h6>
                                    						</div>
                                    					</div>

                                    					<div class="row" style="margin-top: 5px;">
                                    						<div class="col-md-6">
                                    							<h6 class="card-text text-muted"><i class="fa fa-user"></i> Mr. Rakesh Kumar</h6>
                                    						</div>

                                    						<div class="col-md-6" align="right">
                                    							<h6 class="card-text text-muted">26-10-2019</h6>
                                    						</div>
                                    					</div>

                                    					<div class="row" style="margin-top: 2px;">
                                    						<div class="col-md-6">
                                    							<h6 class="card-text text-muted" style="margin-bottom: 0px;padding-bottom: 0px;"><i class="fa fa-mobile"></i> <span style="font-size: 12px;">+91999999999</span></h6>
                                    							<h6 class="card-text text-muted" style="margin-top: 2px;padding-top: 0px;"><i class="fa fa-phone"></i> <span style="font-size: 12px;">+91999999999</span></h6>
                                    						</div>

                                    						<div class="col-md-6" align="right">
                                    							<h6 class="card-text text-muted"><span style="font-size: 12px;">Status</span></h6>
                                    							<h6 class="card-text text-muted"><span style="font-size: 12px;">Stage</span></h6>
                                    							<h6 class="card-text text-muted"><span style="font-size: 12px;">Source</span></h6>
                                    						</div>
                                    					</div>

                                    					<div>
                                    						<small class="text-muted"><i class="fa fa-clock-o"></i> 26-10-2019 07:50 PM &nbsp; <i class="fa fa-bookmark"></i> Pooja Saini</small>
                                    					</div>

                                    					<div style="margin-top: 10px;">
                                    						<button class="btn btn-dark btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-phone"></i></button>

	                                                        <button class="btn btn-warning btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-envelope" style="color: #fff;"></i></button>

                                    						<button class="btn btn-info btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-comment"></i></button>

	                                                        <button class="btn btn-success btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-whatsapp" style="color: #fff;"></i></button>
                                    					</div>

                                    				</div>
                                    			</div>

                                    			<div style="margin-top: 10px;">
					                                <ul class="nav nav-tabs mb-3">
					                                    <li class="nav-item"><a href="#navtabs-profile" class="nav-link active" data-toggle="tab" aria-expanded="false">Profile</a>
					                                    </li>
					                                    <li class="nav-item"><a href="#navtabs-requirement" class="nav-link" data-toggle="tab" aria-expanded="false">Requirement</a>
					                                    </li>
					                                    <li class="nav-item"><a href="#navtabs-followup" class="nav-link" data-toggle="tab" aria-expanded="true">Followup</a>
					                                    </li>
					                                    <li class="nav-item"><a href="#navtabs-history" class="nav-link" data-toggle="tab" aria-expanded="true">History</a>
					                                    </li>
					                                    <li class="nav-item"><a href="#navtabs-product" class="nav-link" data-toggle="tab" aria-expanded="true">Product</a>
					                                    </li>
					                                </ul>
					                                <div class="tab-content br-n pn">
					                                    <div id="navtabs-profile" class="tab-pane active">
					                                        <div class="row">
					                                            <div class="col-md-12">
					                                            	<label>Name:</label> <strong>Mr. Rakesh Kumar</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Contact No:</label> <strong>+91999999999</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Other No:</label> <strong>+91999999999</strong>
					                                            </div>
					                                            <div class="col-md-12">
					                                            	<label>Email Id:</label> <strong>abc@gmail.com</strong>
					                                            </div>
					                                            <div class="col-md-12">
					                                            	<label>Address:</label> <strong>Pratap Nagar Jaipur, Rajasthan, India</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>City:</label> <strong>Jaipur</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>State:</label> <strong>Rajasthan</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Sex:</label> <strong>Male</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Marital Status:</label> <strong>Married</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Occopuction:</label> <strong>Business</strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Designation:</label> <strong></strong>
					                                            </div>
					                                            <div class="col-md-12">
					                                            	<label>Name of Company:</label> <strong></strong>
					                                            </div>
					                                            <div class="col-md-12">
					                                            	<label>Annual Income:</label> <strong></strong>
					                                            </div>
					                                            <div class="col-md-12">
					                                            	<h4>KYC</h4>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>PAN No:</label> <strong></strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Adhar No:</label> <strong></strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Voter Id:</label> <strong></strong>
					                                            </div>
					                                            <div class="col-md-6">
					                                            	<label>Passport No:</label> <strong></strong>
					                                            </div>
			                                                    <div class="col-md-12" align="right">
			                                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#profileEditModal" style="color: white;"><i class="fa fa-edit"></i> Edit</button>
			                                                    </div>
					                                        </div>

					                                        <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                                                    <div class="modal-dialog modal-lg" role="document">
			                                                        <div class="modal-content">
			                                                            <div class="modal-header">
			                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
			                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                                                                </button>
			                                                            </div>
			                                                            <div class="modal-body">
			                                                                <form>
			                                                                	<div class="row">
				                                                                    <div class="col-md-12">
										                                            	<label>Name:</label>
										                                            	<input type="text" class="form-control" value="Rakesh">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Contact No:</label>
										                                            	<input type="text" class="form-control" value="+91878454545454">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Other No:</label>
										                                            	<input type="text" class="form-control" value="+91878454545454">
										                                            </div>
										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Email Id:</label>
										                                            	<input type="email" class="form-control" value="abc@gmail.com">
										                                            </div>
										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Address:</label>
										                                            	<textarea class="form-control" rows="2">Pratap Nagar Jaipur, Rajasthan, India</textarea>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>City:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select City</option>
			                                                                                  <option value="Jaipur">Jaipur</option>
			                                                                                  <option value="Sikar">Sikar</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>State:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select State</option>
			                                                                                  <option value="Rajasthan">Rajasthan</option>
			                                                                                  <option value="Gujrat">Gujrat</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Sex:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Sex</option>
			                                                                                  <option value="Male">Male</option>
			                                                                                  <option value="Female">Female</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Marital Status:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Marital Status</option>
			                                                                                  <option value="Married">Married</option>
			                                                                                  <option value="Unmarried">Unmarried</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Occopuction:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Occopuction</option>
			                                                                                  <option value="Service">Service</option>
			                                                                                  <option value="Business">Business</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Designation:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Designation</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Name of Company:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Annual Income:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                            <div class="col-md-6">
										                                            </div>
										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<h4>KYC</h4>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>PAN No:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Adhar No:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Voter Id:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Passport No:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                        </div>
			                                                                </form>
			                                                            </div>
			                                                            <div class="modal-footer">
			                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			                                                                <button type="button" class="btn btn-primary">Update</button>
			                                                            </div>
			                                                        </div>
			                                                    </div>
			                                                </div>

					                                    </div>

					                                    <div id="navtabs-requirement" class="tab-pane">


					                                        <div class="row" align="right" style="margin-bottom: 10px;">
			                                                    <div class="col-md-12">
			                                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#requirementModal" style="color: white;">Add Requirement</button>
			                                                    </div>
					                                        </div>

					                                        <?php for ($i=1; $i <=5 ; $i++) { ?>
					                                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;">
					                                        	<div class="row">
						                                            <div class="col-md-4">
						                                            	<label>Requirement Id:</label> <strong>1001</strong>
						                                            </div>
						                                            <div class="col-md-4">
						                                            	<label>DOR:</label> <strong>25-10-2019</strong>
						                                            </div>
						                                            <div class="col-md-4" align="right">
						                                            	<label>Status:</label> <strong><span class="label label-pill label-success" style="padding: 3px 10px;">Open</span></strong>
						                                            </div>
						                                            <div class="col-md-6">
						                                            	<label>Looking For:</label> <strong></strong>
						                                            </div>
						                                            <div class="col-md-12">
						                                            	<label>At:</label> <strong>Pratap Nagar. Jaipur, Rajasthan</strong>
						                                            </div>
						                                            <div class="col-md-12">
						                                            	<label>Budget:</label> <strong>100000-200000</strong>, <label>Size:</label> <strong>80-80</strong> Biga
						                                            </div>
						                                            <div class="col-md-8">
						                                            	<label>Remarks:</label> <strong></strong>
						                                            </div>
				                                                    <div class="col-md-4" align="right">
				                                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#requirementModal" style="color: white;"><i class="fa fa-edit"></i> Edit</button>
				                                                    </div>
						                                        </div>
					                                        </div>
					                                        <?php } ?>

					                                        <div class="modal fade" id="requirementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                                                    <div class="modal-dialog modal-lg" role="document">
			                                                        <div class="modal-content">
			                                                            <div class="modal-header">
			                                                                <h5 class="modal-title" id="exampleModalLabel">Add/Edit Requirement</h5>
			                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                                                                </button>
			                                                            </div>
			                                                            <div class="modal-body">
			                                                                <form>
			                                                                	<div class="row">
				                                                                    <div class="col-md-6">
										                                            	<label>Looking For :</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Looking For</option>
			                                                                                  <option value="For Sale">For Sale</option>
			                                                                                  <option value="For Buy">For Buy</option>
			                                                                                  <option value="For Rent">For Rent</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Type of Property:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Type of Property</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Unit Type:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Unit Type</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Accomodation :</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>State:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select State</option>
			                                                                                  <option value="Rajasthan">Rajasthan</option>
			                                                                                  <option value="Gujrat">Gujrat</option>
			                                                                            </select>
										                                            </div>

										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>City:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select City</option>
			                                                                                  <option value="Jaipur">Jaipur</option>
			                                                                                  <option value="Sikar">Sikar</option>
			                                                                            </select>
										                                            </div>

										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Location:</label>
			                                                                            <select class="form-control" multiple="" id="selectLocation" style="width: 100%;">
			                                                                                  <option value="">Select Location</option>
			                                                                                  <option value="Mansarovar">Mansarovar</option>
			                                                                                  <option value="Pratap Nagar">Pratap Nagar</option>
			                                                                            </select>
										                                            </div>

										                                            <div class="col-md-12" style="margin-top: 10px;">
								                                            			<label>Budget:</label>
										                                            	<div class="row">
										                                            		<div class="col-md-6">
										                                            			<input type="text" class="form-control" placeholder="Min" value="">
										                                            		</div>
										                                            		<div class="col-md-6">
										                                            			<input type="text" class="form-control" placeholder="Max" value="">
										                                            		</div>
										                                            	</div>
										                                            </div>

										                                            <div class="col-md-12" style="margin-top: 10px;">
								                                            			<label>Size:</label>
										                                            	<div class="row">
										                                            		<div class="col-md-4">
										                                            			<input type="text" class="form-control" placeholder="Min" value="">
										                                            		</div>
										                                            		<div class="col-md-4">
										                                            			<input type="text" class="form-control" placeholder="Max" value="">
										                                            		</div>
										                                            		<div class="col-md-4">
										                                            			<input type="text" class="form-control" placeholder="Unit" value="">
										                                            		</div>
										                                            	</div>
										                                            </div>

										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Remarks:</label>
										                                            	<textarea class="form-control" rows="2"></textarea>
										                                            </div>

										                                        </div>
			                                                                </form>
			                                                            </div>
			                                                            <div class="modal-footer">
			                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			                                                                <button type="button" class="btn btn-primary">Add/Save</button>
			                                                            </div>
			                                                        </div>
			                                                    </div>
			                                                </div>

					                                    </div>

					                                    <div id="navtabs-followup" class="tab-pane">

					                                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;">
					                                        	<div class="row">
						                                            <div class="col-md-3">
						                                            	<span class="label label-pill label-danger" style="padding: 3px 10px;">Pending</span>
						                                            </div>
						                                            <div class="col-md-9">
						                                            	<div class="row">
								                                            <div class="col-md-12">
								                                            	<label>Action @ 22-10-2019 & 10:25 PM By Rakesh</label>
								                                            </div>
								                                            <div class="col-md-12">
								                                            	<label>Remarks:</label> <strong></strong>
								                                            </div>
								                                            <div class="col-md-12">
								                                            	<label>Comment:</label> Comment @ 22-10-2019 & 10:25 PM By Rakesh
								                                            </div>
								                                            <div class="col-md-6">
								                                            	<select class="form-control" onchange="followupStatus(this.value)" style="width: 140px;height: 30px;min-height: 32px;">
	                                                                                  <option value="">Select Status</option>
	                                                                                  <option value="Pending">Pending</option>
	                                                                                  <option value="Complete">Complete</option>
	                                                                                  <option value="Cancel">Cancel</option>
	                                                                            </select>
								                                            </div>
			                                                                            
								                                        </div>
							                                        </div>
						                                        </div>
					                                        </div>

					                                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;">
					                                        	<div class="row">
						                                            <div class="col-md-3">
						                                            	<span class="label label-pill label-success" style="padding: 3px 10px;">Complete</span>
						                                            </div>
						                                            <div class="col-md-9">
						                                            	<div class="row">
								                                            <div class="col-md-12">
								                                            	<label>Action @ 22-10-2019 & 10:25 PM By Rakesh</label>
								                                            </div>
								                                            <div class="col-md-12">
								                                            	<label>Remarks:</label> <strong></strong>
								                                            </div>
								                                            <div class="col-md-12">
								                                            	<label>Comment:</label> Comment @ 22-10-2019 & 10:25 PM By Rakesh
								                                            </div>
								                                            <div class="col-md-6">
								                                            	<select class="form-control" onchange="followupStatus(this.value)" style="width: 140px;height: 30px;min-height: 32px;">
	                                                                                  <option value="">Select Status</option>
	                                                                                  <option value="Pending">Pending</option>
	                                                                                  <option value="Complete">Complete</option>
	                                                                                  <option value="Cancel">Cancel</option>
	                                                                            </select>
								                                            </div>
								                                        </div>
							                                        </div>
						                                        </div>
					                                        </div>

					                                        <div class="modal fade" id="followUpTabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                                                    <div class="modal-dialog modal-lg" role="document">
			                                                        <div class="modal-content">
			                                                            <div class="modal-header">
			                                                                <h5 class="modal-title" id="exampleModalLabel">Followup</h5>
			                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                                                                </button>
			                                                            </div>
			                                                            <div class="modal-body">
			                                                                <form>
			                                                                	<div class="row">
				                                                                    <div class="col-md-6">
										                                            	<label>Lead Stage:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Lead Stage</option>
			                                                                                  <option value="Lead Stage 1">Lead Stage 1</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Lead Status:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Comment:</label>
										                                            	<textarea class="form-control" rows="1"></textarea>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Next Action:</label>
			                                                                            <select class="form-control">
			                                                                                  <option value="">Select Next Action</option>
			                                                                            </select>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Next Followup:</label>
										                                            	<div class="row">
										                                            		<div class="col-md-6">
										                                            			<input type="text" class="form-control" placeholder="Date" value="">
										                                            		</div>
										                                            		<div class="col-md-6">
										                                            			<input type="text" class="form-control" placeholder="Time" value="">
										                                            		</div>
										                                            	</div>
										                                            </div>
										                                            <div class="col-md-6" style="margin-top: 10px;">
										                                            	<label>Project:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>

										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Task Description:</label>
										                                            	<textarea class="form-control" rows="2"></textarea>
										                                            </div>

										                                        </div>
			                                                                </form>
			                                                            </div>
			                                                            <div class="modal-footer">
			                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			                                                                <button type="button" class="btn btn-primary">Save</button>
			                                                            </div>
			                                                        </div>
			                                                    </div>
			                                                </div>

					                                    </div>

					                                    <div id="navtabs-history" class="tab-pane">
					                                        <div class="row align-items-center">
					                                            <div class="col-md-12">
					                                                <p class="text-center">From Add a lead to all Histroy like call, sms , email , whatsapp , followup , Site visit , Lead Transfer and other activeity date time and user wise</p>
					                                            </div>
					                                        </div>
					                                    </div>

					                                    <div id="navtabs-product" class="tab-pane">


					                                        <div class="row" style="margin-bottom: 10px;">
			                                                    <div class="col-md-12" align="right">
			                                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#productFeedbackModal" style="color: white;">Feedback</button>
			                                                    </div>
					                                        </div>
					                                        
					                                        <?php for ($i=1; $i <=5 ; $i++) { ?>
					                                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;">
					                                        	<div class="row">
						                                            <div class="col-md-1" align="center">
						                                            	<input type="radio" name="rd_product" value="1">
						                                            </div>
						                                            <div class="col-md-11">
						                                            	<div class="row">
								                                            <div class="col-md-12">
								                                            	<label>Size (unit), Accomodation, Type of Property, Unit Type, Task @ Project name, Location, City, State</label>
								                                            </div>
								                                            <div class="col-md-6">
								                                            	<label>Furniture, Budget-100000</label>
								                                            </div>
								                                            <div class="col-md-6">
								                                            	<label>Requirment id</label>
								                                            </div>
								                                            <div class="col-md-6">
								                                            	<label>Visit Status</label>
								                                            </div>
								                                            <div class="col-md-6">
								                                            	<label>Date & Time, By Team</label>
								                                            </div>
								                                            <div class="col-md-12">
								                                            	<label>Comment:</label> 
								                                            </div>
								                                        </div>
							                                        </div>
						                                        </div>
					                                        </div>
					                                    	<?php } ?>

					                                        <div class="modal fade" id="productFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                                                    <div class="modal-dialog" role="document">
			                                                        <div class="modal-content">
			                                                            <div class="modal-header">
			                                                                <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
			                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                                                                </button>
			                                                            </div>
			                                                            <div class="modal-body">
			                                                                <form>
			                                                                	<div class="row">
				                                                                    <div class="col-md-12">
										                                            	<label>Customer like this porperty:</label>
										                                            	<label><input type="radio" name="like_property" value="Yes"> Yes</label>
										                                            	<label><input type="radio" name="like_property" value="No"> No</label>
										                                            </div>
										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Date & Time of visit:</label>
										                                            	<div class="row">
										                                            		<div class="col-md-6">
										                                            			<input type="text" class="form-control" placeholder="Date" value="">
										                                            		</div>
										                                            		<div class="col-md-6">
										                                            			<input type="text" class="form-control" placeholder="Time" value="">
										                                            		</div>
										                                            	</div>
										                                            </div>

										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Comment:</label>
										                                            	<textarea class="form-control" rows="2"></textarea>
										                                            </div>

										                                            <div class="col-md-12" style="margin-top: 10px;">
										                                            	<label>Customer Offer:</label>
										                                            	<input type="text" class="form-control" value="">
										                                            </div>

										                                        </div>
			                                                                </form>
			                                                            </div>
			                                                            <div class="modal-footer">
			                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			                                                                <button type="button" class="btn btn-primary">Save</button>
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
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
 <?php include('include/footer.php');?>  
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>
$('#selectLocation').select2();

function showLead() {
	$(".lead_detail").show();
}

function followupStatus(id) {
	if (id=='Complete' || id=='Cancel') {
		$("#followUpTabModal").modal('show');
	}
}
</script>