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
                                        <h4 class="card-title">Invoice</h4>
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

                                        <div class="form-row">

                                             <div class="col-md-12">
                                                <label>Invoice ID: </label> <span style="color: #333;">#<?= $invoice_detail->payment_id ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Invoice Date: </label> <span style="color: #333;"><?= $invoice_detail->invoice_date ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Receipt Date: </label> <span style="color: #333;"><?= $invoice_detail->receipt_date ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Type: </label> <span style="color: #333;"><?php if($invoice_detail->invoice_type==1) { echo "Performa Invoice"; } else if($invoice_detail->invoice_type==2) { echo "TAX Invoice"; } ?></span>
                                            </div>



                                             <div class="col-md-6">
                                                <label>Name: </label> <span style="color: #333;"><?= $invoice_detail->name ?></span>
                                            </div>



                                             <div class="col-md-6">
                                                <label>State: </label> <span style="color: #333;"><?= $invoice_detail->state ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>City: </label> <span style="color: #333;"><?= $invoice_detail->city ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Plan: </label> <span style="color: #333;">PRO</span>
                                            </div>


                                             <div class="col-md-6">
                                                <label>Bill Period: </label> <span style="color: #333;"><?= $invoice_detail->current_plan_date.' To '.$invoice_detail->next_due_date ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>No of User: </label> <span style="color: #333;"><?= $invoice_detail->no_of_user ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Per User: </label> <span style="color: #333;"><?= ($invoice_detail->amount_per_user>0)?'Rs.'.str_replace(".00", "", $invoice_detail->amount_per_user):'' ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Monthly Cost: </label> <span style="color: #333;"><?= ($invoice_detail->monthly_cost>0)?'Rs.'.str_replace(".00", "", $invoice_detail->monthly_cost):'' ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Total Amount: </label> <span style="color: #333;"><?= ($invoice_detail->total_amount>0)?'Rs.'.str_replace(".00", "", $invoice_detail->total_amount):'' ?></span>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Status: </label> 
                    <?php if($invoice_detail->payment_status==1)  { ?>
                    <span class="text-success" style="font-weight: bold;font-size: 18px;">Paid</span>
                    <?php } ?>
                    <?php if($invoice_detail->payment_status==0)  { ?>
                    <span class="text-warning" style="font-weight: bold;font-size: 18px;">Unpaid</span>
                    <?php } ?>
                    <?php if($invoice_detail->payment_status==3)  { ?>
                    <span class="text-danger" style="font-weight: bold;font-size: 18px;">Cancelled</span>
                    <?php if($invoice_detail->cancel_reason)  { ?>
                    <div style="font-weight: normal;font-size: 12px;margin-top: 10px;"><strong>Remark:</strong> <?= $invoice_detail->cancel_reason ?></div>
                    <?php } ?>
                    <?php } ?>
                                            </div>

                                            <?php if($invoice_detail->cancel_reason && $invoice_detail->payment_status==3) { ?>
                                            <div class="col-md-6">
                                                <label>Cancel Reason: </label> <span style="color: #333;"><?= $invoice_detail->cancel_reason ?></span>
                                            </div>
                                        	<?php } ?>
                                        	<?php if($invoice_detail->cancel_time && $invoice_detail->payment_status==3) { ?>
                                            <div class="col-md-6">
                                                <label>Cancel Time: </label> <span style="color: #333;"><?= date("d-m-Y",$invoice_detail->cancel_time) ?></span>
                                            </div>
                                        	<?php } ?>

                                            <div class="col-md-6">
                                                <label>Paid By: </label> <span style="color: #333;"><?= $invoice_detail->paid_type_name ?></span>
                                            </div>

                                        	<?php if($invoice_detail->paid_type==3) { ?>
                                            <div class="col-md-6">
                                                <label>Cheque No: </label> <span style="color: #333;"><?= $invoice_detail->cheque_no ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Cheque Date: </label> <span style="color: #333;"><?= $invoice_detail->cheque_date ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Bank Name: </label> <span style="color: #333;"><?= $invoice_detail->bank_name ?></span>
                                            </div>
                                        	<?php } ?>

                                        	<?php if($invoice_detail->paid_type==1 || $invoice_detail->paid_type==4 || $invoice_detail->paid_type==5) { ?>
                                            <div class="col-md-6">
                                                <label>Transaction ID: </label> <span style="color: #333;"><?= $invoice_detail->txn_id ?></span>
                                            </div>
                                        	<?php } ?>

                                        	
                                            <div class="col-md-6">
                                                <label>Receipt Remark: </label> <span style="color: #333;"><?= $invoice_detail->receipt_remark ?></span>
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
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
 