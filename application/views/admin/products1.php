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
                                        <h4 class="card-title">Product List</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" style="margin-right: 8px;"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                        <a href="<?= base_url(ADMIN_URL."projects") ?>" style="margin-right: 8px;"><button type="button" class="btn btn-dark">View List of Project</button></a><?php //  } ?>
                                        <a href="<?= base_url(ADMIN_URL."product_detail") ?>"><button type="button" class="btn btn-dark">Add Product</button></a><?php //  } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="demo" class="collapse" style="margin-top: 16px;border: 1px solid #f2f2f8;padding: 10px 15px 0px;">
                                            <form>
                                                <div class="form-row">

                                                    <div class="form-group col-md-3">
                                                        <label>State:</label>
                                                        <select class="form-control">
                                                          <option value="">Select State</option>
                                                          <option value="Rajasthan">Rajasthan</option>
                                                          <option value="Gujrat">Gujrat</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>City:</label>
                                                        <select class="form-control">
                                                          <option value="">Select City</option>
                                                          <option value="Jaipur">Jaipur</option>
                                                          <option value="Nagaur">Nagaur</option>
                                                          <option value="Sikar">Sikar</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Location:</label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Project Status:</label>
                                                        <select class="form-control">
                                                          <option value="">Select Status</option>
                                                          <option value="Upcomming">Upcomming Project</option>
                                                          <option value="Ongoing">Ongoing Project</option>
                                                          <option value="Past">Past Project</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Size:</label>

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <input type="text" class="form-control" placeholder="Minimum">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6 mg-10">
                                                                <input type="text" class="form-control" placeholder="Maximum">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Budget:</label>

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <input type="text" class="form-control" placeholder="Minimum">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6 mg-10">
                                                                <input type="text" class="form-control" placeholder="Maximum">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Type of Property:</label>
                                                        <select class="form-control">
                                                          <option value="">Select property type</option>
                                                          <option value="Flat">Flat</option>
                                                          <option value="villa">Villa</option>
                                                          <option value="plot">Plot</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Unit Type:</label>
                                                        <select class="form-control">
                                                              <option value="">Select Unit</option>
                                                              <option value="Sq.Yd">Sq.Yd</option>
                                                              <option value="Sq.Ft">Sq.Ft</option>
                                                              <option value="Bigha">Bigha</option>
                                                              <option value="Sq.Mtr">Sq.Mtr</option>
                                                              <option value="Fix">Fix</option>
                                                              <option value="% of BSP">% of BSP</option>
                                                              <option value="Acres">Acres</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Task:</label>
                                                        <select class="form-control">
                                                          <option value="">Select property type</option>
                                                          <option value="For Sale">For Sale</option>
                                                          <option value="For Rent">For Rent</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Task Status:</label>
                                                        <select class="form-control">
                                                          <option value="">Select status</option>
                                                          <option value="Open">Open</option>
                                                          <option value="Close">Close</option>
                                                        </select>
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
                                                <th>Sr.</th>
                                                <th>DOR</th>
                                                <th>Type of Property</th>
                                                <th>Unit Type</th>
                                                <th>Property Status</th>
                                                <th>No of Unit</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Task</th>
                                                <th class="text-center">Status</th>
                                                <!--<th class="text-center" style="width: 50px;">Action</th>-->
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Sr.</td>
                                                <td>21-10-2019</td>
                                                <td>Residencial</td>
                                                <td>Flat</td>
                                                <td>Ready to Move</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>For Sale</td>
                                                <td class="text-center"><span class="label label-pill label-success">Open</span></td>
                                                <!--<td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn mb-1 btn-dark dropdown-toggle  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Open</a> 
                                                            <a class="dropdown-item" href="#">Close</a>
                                                        </div>
                                                    </div>
                                                </td>-->
                                            </tr>

                                            <tr>
                                                <td>Sr.</td>
                                                <td>21-10-2019</td>
                                                <td>Residencial</td>
                                                <td>Flat</td>
                                                <td>Under Construction</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>For Rent</td>
                                                <td class="text-center"><span class="label label-pill label-danger">Close</span></td>
                                                <!--<td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn mb-1 btn-dark dropdown-toggle  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Open</a> 
                                                            <a class="dropdown-item" href="#">Close</a>
                                                        </div>
                                                    </div>
                                                </td>-->
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