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
.a-hide {
    display: none;
}
.a-show {
    display: block;
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
                                        <h4 class="card-title">Customer: Ravi Sharma</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">

                                        <select id="change_type" class="form-control" style="width: 160px;" onchange="changeType()">
                                          <option value="1">Requirement</option>
                                          <option value="2">Reference</option>
                                          <option value="3">Unit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive" id="table_requirement">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;">S.No</th>
                                                <th>Date</th>
                                                <th>Purpose</th>
                                                <th>Product Type</th>
                                                <th>Unit Type</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Maching</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>21-10-2019</td>
                                                <td>For Sale</td>
                                                <td>Residential</td>
                                                <td>Flat/Vila</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">Open/Close</td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td>1</td>
                                                <td>21-10-2019</td>
                                                <td>For Rent</td>
                                                <td>Commercial</td>
                                                <td>Shop/Office</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td>1</td>
                                                <td>21-10-2019</td>
                                                <td>For Buy</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive a-hide" id="table_reference">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;">S.No</th>
                                                <th>Agent Name</th>
                                                <th class="text-center">DOR</th>
                                                <th>Purpose</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mukesh Kumar</td>
                                                <td></td>
                                                <td>For Sale/For Buy/For Rent</td>
                                                <td class="text-center">Open/Close</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="a-hide" id="table_unit">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="margin-top: 16px;padding: 0px;">
                                                <form>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-5">
                                                            <select class="form-control">
                                                              <option value="">Select Builder</option>
                                                              <option value="RK">RK</option>
                                                              <option value="Mukesh">Mukesh</option>
                                                              <option value="Kamal">Kamal</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-5">
                                                            <select class="form-control">
                                                              <option value="">Select Project</option>
                                                              <option value="Project 1">Project 1</option>
                                                              <option value="Project 2">Project 2</option>
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
                                                <th>Date</th>
                                                <th>Product Type</th>
                                                <th>Unit Type</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Agent Name</th>
                                                <th>Action</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>21-10-2019</td>
                                                <td>Residential</td>
                                                <td>Flat/Vila</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>For Sale</td>
                                                <td class="text-center">Open/Close</td>
                                            </tr>

                                            <tr>
                                                <td>1</td>
                                                <td>21-10-2019</td>
                                                <td>Commercial</td>
                                                <td>Shop/Office</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>For Rent</td>
                                                <td class="text-center"></td>
                                            </tr>

                                            <tr>
                                                <td>1</td>
                                                <td>21-10-2019</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
function changeType() {
    var change_type = $("#change_type").val();
    if (change_type=="1") {
        $("#table_requirement").show();
        $("#table_reference").hide();
        $("#table_unit").hide();
    }
    else if (change_type=="2") {
        $("#table_requirement").hide();
        $("#table_reference").show();
        $("#table_unit").hide();
    }
    else if (change_type=="3") {
        $("#table_requirement").hide();
        $("#table_reference").hide();
        $("#table_unit").show();
    }
}
</script>