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
                                        <h4 class="card-title">Add New Unit Type</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(ADMIN_URL.'unit-types') ?>"><button type="button" class="btn btn-dark" >Back</button></a><?php //  } ?>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <form>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Unit Type:</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Under Group:</label>
                                                <select class="form-control">
                                                  <option value="">Select Product Type</option>
                                                  <option value="Residential">Residential</option>
                                                  <option value="commercial">Commercial</option>
                                                  <option value="agriculture">Agriculture</option>
                                                </select>
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