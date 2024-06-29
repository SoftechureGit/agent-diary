<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Associate Registration</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">
    <link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">
    <style>
        label.error {
            color: #a94442;
            font-weight: normal;
            margin-top: 4px;
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
    
</head>
<div class="loader_progress"></div>








        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body1">

            <!--<div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>-->
            <!-- row -->

            <div class="container-fluid" style="margin-top: 50px;">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Invoice</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <h4 class="card-title">

                                          <!--<button class="btn btn-primary btn-sm" onclick="printInvoice('printableArea')"><i class="fa fa-print"></i> Print</button>

                                          &nbsp;&nbsp;

                                          <button class="btn btn-info btn-sm" onclick="downloadInvoice()"><i class="fa fa-download"></i> Download</button>

                                          &nbsp;&nbsp;-->

                                          <button class="btn btn-success btn-sm" onclick="sendInvoice()" style="color: #fff;"><i class="fa fa-send"></i> Send</button>

                                        </h4>
                                    </div>
                                </div>

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

                                <div class="basic-form" id="printableArea">

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




 <?php include('admin/include/footer.php');?>
<script src="<?php echo base_url('public/admin/') ?>plugins/common/common.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>js/custom.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/html2pdf/html2pdf.bundle.min.js"></script>

<script>
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}
function printInvoice(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

function downloadInvoice() {
// Choose the element that our invoice is rendered in.
const element = document.getElementById("printableArea");
// Choose the element and save the PDF for our user.

var opt = {
margin:       [10, 10, 10, 10],
filename:     "invoice-<?= $invoice_detail->payment_id ?>.pdf",
image:        { type: 'jpeg', quality: 0.98 },
html2canvas:  { scale: 2, useCORS: true },
jsPDF:        { unit: 'mm', format: 'letter', orientation: 'portrait' }
};

html2pdf()
.from(element).set(opt).outputPdf('datauri').save();

}
function sendInvoice() {
// Choose the element that our invoice is rendered in.
const element = document.getElementById("printableArea");
// Choose the element and save the PDF for our user.

var opt = {
margin:       [10, 10, 10, 10],
filename:     "invoice-<?= $invoice_detail->payment_id ?>.pdf",
image:        { type: 'jpeg', quality: 0.98 },
html2canvas:  { scale: 2, useCORS: true },
jsPDF:        { unit: 'mm', format: 'letter', orientation: 'portrait' }
};

html2pdf()
.from(element).set(opt).outputPdf('datauri').then(function(pdfout){

/*$.ajax({
type: "post",
url: "save.php",
data: {
data: pdfout,
},
success: function (response) {
alert(response);
},
error: function () {
alert("error");
}
});*/
$(".error-msg").html("");
$.ajax({
type: "POST",
url: "<?= base_url(ADMIN_URL.'/api/send_invoice') ?>",
data: {
id:<?= $invoice_detail->payment_id ?>,
data: pdfout,
},
beforeSend: function (data) {
  $(".loader_progress").show();
},
success: function (response) {
  setTimeout(function(){
    var obj;
      try {
        obj = JSON.parse(response);
        $(".loader_progress").hide();

        if (obj.status=='success') {
            $(".error-msg").html(alertMessage('success',obj.message));
        }
        else {
          alert(obj.message);
        }
      }
      catch(err) {
        alert('Some error occurred, please try again.');
        $(".loader_progress").hide();
      }
  },500);
},
error: function () {
    alert('Some error occurred, please try again.');
    $(".loader_progress").hide();
   
}

});

});
}

setTimeout(function(){
  sendInvoice();
},500);
</script>
 