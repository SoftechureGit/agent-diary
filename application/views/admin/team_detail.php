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
                                        <h4 class="card-title">Add New Team</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(ADMIN_URL.'teams') ?>"><button type="button" class="btn btn-dark" >Back</button></a><?php //  } ?>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <form>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Date of Reg.:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>User Id:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Name:</label>
                                                <div class="row">
                                                	<div class="col-md-2">
                                                		<input type="text" class="form-control" placeholder="Mr.">
                                                	</div>
                                                	<div class="col-md-5">
                                                		<input type="text" class="form-control" placeholder="First Name">
                                                	</div>
                                                	<div class="col-md-5">
                                                		<input type="text" class="form-control" placeholder="Last Name">
                                                	</div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Email Id:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Password:</label>
                                                <input type="password" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Mobile No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Whatsapp No:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Assign Role:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Working Time:</label>
                                                <div class="row">
                                                	<div class="col-md-6">
                                                		<input type="text" class="form-control" placeholder="From">
                                                	</div>
                                                	<div class="col-md-6">
                                                		<input type="text" class="form-control" placeholder="To">
                                                	</div>
                                                </div>
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