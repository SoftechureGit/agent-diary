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
                                        <h4 class="card-title">Customer List</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" style="margin-right: 8px;"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="demo" class="collapse" style="margin-top: 16px;border: 1px solid #f2f2f8;padding: 10px 15px 0px;">
                                            <form>
                                                <div class="form-row">

                                                    <div class="form-group col-md-4">
                                                        <label>Name:</label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Mobile No:</label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Email Id:</label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-12" align="right">
                                                        <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo" style="margin-right: 8px;">Cancel</button>

                                                        <button type="button" class="btn btn-info">Apply</button>
                                                    </div>

                                                </div>
                                            </form>
                                      </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;">S.No</th>
                                                <th>Name</th>
                                                <th>Mobile No</th>
                                                <th>Email Id</th>
                                                <th style="width: 50px;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Ravi Sharma</td>
                                                <td>9999999999</td>
                                                <td>abc@gmail.com</td>
                                                <td>
                                                    <a href="<?= base_url(ADMIN_URL.'customer/1/') ?>">
                                                        <button type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</button>
                                                    </a>
                                                </td>
                                            </tr>
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
        <!--**********************************
            Content body end
        ***********************************-->
 <?php include('include/footer.php');?>  
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>