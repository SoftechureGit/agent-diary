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
                                        <h4 class="card-title">Add New Builder</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(AGENT_URL.'builders') ?>"><button type="button" class="btn btn-dark btn-sm" ><i class="fa fa-arrow-left"></i> Back</button></a>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <form>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Group:</label>
                                                <select class="form-control">
                                                  <option value="">Select Group</option>
                                                  <option value="Raman">Raman</option>
                                                  <option value="Mukesh">Mukesh</option>
                                                  <option value="Rohit">Rohit</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Company Name:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Email Id:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Contact No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Type of Firm:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Address-1:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Address-2:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Address-3:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Country:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>State:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>City:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Name of Director:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Contact No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Email Id:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Name of Representative:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Contact No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Email Id:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>About Builder:</label>
                                                <textarea class="form-control" placeholder="" rows="3"></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Logo:</label>
                                                <input type="file" class="form-control">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Upload:</label>
                                                <input type="file" class="form-control">
                                            </div>

                                            <div class="col-md-12">
                                            	<h5>KYC:</h5>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>CIN No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>TAN No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>PAN No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>GST No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                        </div>

                                    	<button type="submit" class="btn btn-dark btn-lg">Save</button>
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