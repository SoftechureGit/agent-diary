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
                                        <h4 class="card-title">View List of Project</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 30px;">S.No</th>
                                                <th>DOR</th>
                                                <th>Name of Project</th>
                                                <th>Builder</th>
                                                <th>No of Units</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th class="text-center">Share</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"><button class="btn btn-info btn-sm btn-rounded btn-4" onclick="shareProjectInventory()"><i class="fa fa-share"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"><button class="btn btn-info btn-sm btn-rounded btn-4" onclick="shareProjectInventory()"><i class="fa fa-share"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"><button class="btn btn-info btn-sm btn-rounded btn-4" onclick="shareProjectInventory()"><i class="fa fa-share"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal fade" id="shareProjectInventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Share Project & Inventory</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                     <div class="table-responsive">
                                                        <table class="table table-bordered zero-configuration">

                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center" style="width: 100px;">Agent Id</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Share</button>
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

<script>
function shareProjectInventory() {
    //share If agent is project admin
   $("#shareProjectInventoryModal").modal('show');
}
</script>