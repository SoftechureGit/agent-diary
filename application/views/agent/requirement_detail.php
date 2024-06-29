<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Add New Requirement</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(AGENT_URL.'requirements') ?>"><button type="button" class="btn btn-dark" >Back</button></a>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <form>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>For:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Type of Property:</label>
                                                <select class="form-control">
                                                  <option value="">Select Type of Property</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Unit Type:</label>
                                                <select class="form-control">
                                                  <option value="">Select Unit Type</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Project Status:</label>
                                                <select class="form-control">
                                                  <option value="">Select Project Status</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Accomodation: <span class="text-danger">(if select Flat then a select accomodation)</span></label>
                                                <select class="form-control">
                                                  <option value="">Select Accomodation</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>State:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>City:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Location:<!--<span class="text-danger">(Multi Selection)</span>--></label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Price Range:</label>
                                                <div class="row">
                                                	<div class="col-md-6">
                                                		<input type="text" class="form-control" placeholder="Min">
                                                	</div>
                                                	<div class="col-md-6">
                                                		<input type="text" class="form-control" placeholder="Max">
                                                	</div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Size:</label>
                                                <div class="row">
                                                	<div class="col-md-4">
                                                		<input type="text" class="form-control" placeholder="Min">
                                                	</div>
                                                	<div class="col-md-4">
                                                		<input type="text" class="form-control" placeholder="Max">
                                                	</div>
                                                	<div class="col-md-4">
		                                                <select class="form-control">
		                                                  <option value="">Select Unit</option>
		                                                </select>
                                                	</div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Remarks:</label>
                                                <textarea class="form-control" placeholder="" rows="4"></textarea>
                                            </div>

	                                        <div class="form-group col-md-12" align="right">
		                                    	<button type="submit" class="btn btn-dark" style="margin-top: 10px;">Save</button>
		                                    </div>

                                        </div>
                                    </form>

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