<?php include('include/header.php');?>
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
}

.radio-toolbar {
  margin: 10px;
}

.radio-toolbar input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 7px 14px;
    width: 100%;
    font-family: sans-serif, Arial;
    font-size: 12px;
    border: 1px solid #444;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
}

.radio-toolbar label:hover {
  background-color: #dfd;
}

.radio-toolbar input[type="radio"]:focus + label {
    border: 1px dashed #444;
}

.radio-toolbar input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: #4c4;
}
.loader_progress{
    display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("<?= base_url('public/front/ajax-loader.gif') ?>") 
              50% 50% no-repeat #fff3f38f;
}
</style>
<div class="loader_progress"></div>
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
                                        <h4 class="card-title">Transations</h4>
                                    </div>
                                </div>
                                <div class="basic-form">

                                        <div class="error-msg">
                                         <?php if($this->session->flashdata('error_msg')) { ?>
                                          <div class="alert alert-danger pd8" style="margin-top: 10px;">
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <?php echo $this->session->flashdata('error_msg'); ?>
                                          </div>
                                        <?php } ?>
                                        <?php if($this->session->flashdata('success_msg')) { ?>
                                          <div class="alert alert-success pd8" style="margin-top: 10px;">
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <?php echo $this->session->flashdata('success_msg'); ?>
                                          </div>
                                        <?php } ?>           
                                        </div>

                                        <div class="table-responsive" style="margin-top: 20px;">
<table class="table table-bordered" id="tableList" style="width: 100%;">
    <thead>
      <tr>
            <th>SN</th>
            <th class="text-center">Date</th>
            <th>Type</th>
            <th class="text-center">Ref. No</th>
            <th class="text-center">Bill Period</th>
            <th class="text-center">No of User</th>
            <th class="text-center">Per User Cost</th>
            <th class="text-center">Monthly Cost</th>
            <th class="text-center">Total</th>
            <th class="text-center">Status</th>
            <!--<th class="text-center">Action</th>-->
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($payments as $row) { ?>
          <tr>
                <td class="text-center"><?= $i+1 ?></td>
                <td class="text-center"><?= $row->invoice_date ?></td>
                <td><?php if($row->payment_status==1) { echo "Invoice"; } else { echo "Performa Invoice"; } ?></td>
                <td class="text-center"><?php if($row->payment_status==1)  { ?>
                    <a href="<?= base_url(ADMIN_URL.'receipt/'.$row->payment_id) ?>" style="font-size: 16px;font-weight: bold;text-decoration: underline;color: #4d7cff;"><?= $row->invoice_id ?></a>
                 <?php } else { ?>
                    <a href="<?= base_url(ADMIN_URL.'invoice/'.$row->payment_id) ?>" style="font-size: 16px;font-weight: bold;text-decoration: underline;color: #4d7cff;"><?= $row->invoice_id ?></a>
                <?php } ?></td>
                <td class="text-center"><?= $row->current_plan_date.' To '.$row->next_due_date ?></td>
                <td class="text-center"><?= $row->no_of_user ?></td>
                <td class="text-center"><?= ($row->amount_per_user>0)?'Rs.'.str_replace(".00", "", $row->amount_per_user):'' ?></td>
                <td class="text-center"><?= ($row->monthly_cost>0)?'Rs.'.str_replace(".00", "", $row->monthly_cost):'' ?></td>
                <td class="text-center"><?= ($row->total_amount>0)?'Rs.'.str_replace(".00", "", $row->total_amount):'' ?></td>
                <td class="text-center">
                    <?php if($row->payment_status==1)  { ?>
                    <span class="label label-pill label-success">Success</span>
                    <?php } ?>
                    <?php if($row->payment_status==0)  { ?>
                    <span class="label label-pill label-warning">Pending</span>
                    <?php } ?>
                    <?php if($row->payment_status==3)  { ?>
                    <span class="label label-pill label-danger">Cancelled</span>
                    <?php if($row->cancel_reason)  { ?>
                    <div style="font-weight: normal;font-size: 12px;margin-top: 10px;"><strong>Remark:</strong> <?= $row->cancel_reason ?></div>
                    <?php } ?>
                    <?php } ?>
                </td>
                <!--<td class="text-center">
                    
                        <a class="btn btn-dark btn-sm" href="<?= base_url(ADMIN_URL.'transactions/'.$row->payment_id) ?>"><i class="fa fa-eye"></i></a>
                </td>-->
            </tr>
        <?php $i++; } ?>

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
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
     $("#tableList").DataTable();
</script>
 