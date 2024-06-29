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
                                        <h4 class="card-title">Locations</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(ADMIN_URL.'location-detail') ?>"><button type="button" class="btn btn-info" >Add New</button></a><?php //  } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-top: 16px;padding: 0px;">
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-5">
                                                        <select class="form-control">
                                                          <option value="">------------Select State------------</option>
                                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                            <option value="Assam">Assam</option>
                                                            <option value="Bihar">Bihar</option>
                                                            <option value="Chandigarh">Chandigarh</option>
                                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                                            <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                                            <option value="Daman and Diu">Daman and Diu</option>
                                                            <option value="Delhi">Delhi</option>
                                                            <option value="Goa">Goa</option>
                                                            <option value="Gujarat">Gujarat</option>
                                                            <option value="Haryana">Haryana</option>
                                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                            <option value="Jharkhand">Jharkhand</option>
                                                            <option value="Karnataka">Karnataka</option>
                                                            <option value="Kerala">Kerala</option>
                                                            <option value="Lakshadweep">Lakshadweep</option>
                                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                            <option value="Maharashtra">Maharashtra</option>
                                                            <option value="Manipur">Manipur</option>
                                                            <option value="Meghalaya">Meghalaya</option>
                                                            <option value="Mizoram">Mizoram</option>
                                                            <option value="Nagaland">Nagaland</option>
                                                            <option value="Orissa">Orissa</option>
                                                            <option value="Pondicherry">Pondicherry</option>
                                                            <option value="Punjab">Punjab</option>
                                                            <option value="Rajasthan">Rajasthan</option>
                                                            <option value="Sikkim">Sikkim</option>
                                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                                            <option value="Tripura">Tripura</option>
                                                            <option value="Uttaranchal">Uttaranchal</option>
                                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                            <option value="West Bengal">West Bengal</option>
                                                    </select>
                                                    </div>

                                                    <div class="form-group col-md-5">
                                                        <select class="form-control">
                                                          <option value="">------------Select City------------</option>
                                                            <option value="Jaipur">Jaipur</option>
                                                            <option value="Rajasthan">Sikar</option>
                                                            <option value="Nagaur">Nagaur</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <button type="button" class="btn btn-info btn-block" style="height: 45px;">Filter</button>
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
                                                <th>Location</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th style="width: 50px;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Bajri Mandi</td>
                                                <td>Rqjasthan</td>
                                                <td>Jaipur</td>
                                                <td>
                                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>

                                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Pratap Nagar</td>
                                                <td>Rqjasthan</td>
                                                <td>Jaipur</td>
                                                <td>
                                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>

                                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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