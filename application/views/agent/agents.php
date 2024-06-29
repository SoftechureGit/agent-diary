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
                                        <h4 class="card-title">Agents</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-top: 16px;padding: 0px;">
                                            <form>
                                                <div class="form-row">

                                                    <div class="form-group col-md-5">
                                                        <input type="text" class="form-control" placeholder="Search by Name/Email/mobile No">
                                                    </div>

                                                    <div class="form-group col-md-1">
                                                        <button type="button" class="btn btn-info btn-block" style="height: 45px;">Search</button>
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
                                                <th>DOR</th>
                                                <th>Code</th>
                                                <th>Rera No</th>
                                                <th>Company Name</th>
                                                <th>Contact Person</th>
                                                <th>City</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th class="text-center">Mobile</th>
                                                <th class="text-center">Email</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">Y</td>
                                                <td class="text-center">Y</td>
                                                <td class="text-center"><span class="fa fa-circle-o text-success"></span></td>
                                                <td class="text-center">
                                                        <div style="width: 140px;">
                                                            <a href="<?= base_url('agents/1/') ?>"><button class="btn btn-dark btn-sm btn-rounded btn-4"><i class="fa fa-eye"></i></button></a>

                                                            <button class="btn btn-success btn-sm btn-rounded btn-4"><i class="fa fa-whatsapp"></i></button>

                                                            <button class="btn btn-warning btn-sm btn-rounded"><i class="fa fa-envelope"></i></button>
                                                        </div>
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