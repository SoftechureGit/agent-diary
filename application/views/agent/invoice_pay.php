<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pay Invoice</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">
    <link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">
    <style>
        label.error {
            color: #a94442;
            font-weight: normal;
            margin-top: 4px;
          }
    </style>
    
</head>

<body class="h-100">
    

<div class="login-form">
    <div class="container h-100">
        <div class="row justify-content-center h-100 mt-5">
            <div class="col-xl-10">
                <div class="form-input-content">

                	<div class="row">
                		<div class="col-md-2"></div>
                		<div class="col-md-8">
                			<div  style="background-color: #fff;padding: 20px 30px;margin-top: 0px;border-radius: 10px;">
                				<h2 class="text-center">Pay Invoice</h2>

                				<div style="margin-top: 30px;">
		                			<?php if($status=="invalid" || $status=="login") { ?>
		                				<div class="alert alert-danger"><?= $msg ?></div>
		                			<?php } ?>

		                			<?php if($status=="unpaid") { ?>

		                				<div class="row">

	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;border-bottom: 1px solid #ebebeb;">
	                                            	<div class="row">
		                                                <div class="col-md-6">Invoice ID:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= $pay_detail->invoice_id ?></div>
		                                            </div>
	                                            </div>
	                                        </div>

	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;border-bottom: 1px solid #ebebeb;">
	                                            	<div class="row">
		                                                <div class="col-md-6">Name:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= $pay_detail->name ?></div>
		                                            </div>
	                                            </div>
	                                        </div>
	                                        
	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;border-bottom: 1px solid #ebebeb;">
	                                            	<div class="row">
		                                                <div class="col-md-6">Date:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= $pay_detail->invoice_date ?></div>
		                                            </div>
	                                            </div>
	                                        </div>
	                                        
	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;border-bottom: 1px solid #ebebeb;">
	                                            	<div class="row">
		                                                <div class="col-md-6">Period:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= $pay_detail->current_plan_date.' To '.$pay_detail->next_due_date ?></div>
		                                            </div>
	                                            </div>
	                                        </div>


	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;border-bottom: 1px solid #ebebeb;">
	                                            	<div class="row">
		                                                <div class="col-md-6">No of User:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= $pay_detail->no_of_user ?></div>
		                                            </div>
	                                            </div>
	                                        </div>


	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;border-bottom: 1px solid #ebebeb;">
	                                            	<div class="row">
		                                                <div class="col-md-6">Per User:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= ($pay_detail->amount_per_user>0)?"Rs.".str_replace(".00", "", $pay_detail->amount_per_user):'' ?></div>
		                                            </div>
	                                            </div>
	                                        </div>


	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;border-bottom: 1px solid #ebebeb;">
	                                            	<div class="row">
		                                                <div class="col-md-6">Monthly Cost:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= ($pay_detail->monthly_cost>0)?"Rs.".str_replace(".00", "", $pay_detail->monthly_cost):'' ?></div>
		                                            </div>
	                                            </div>
	                                        </div>


	                                        <div class="col-md-12">
	                                            <div style="padding: 15px 0px;">
	                                            	<div class="row">
		                                                <div class="col-md-6">Total:</div>
		                                                <div class="col-md-6" style="font-weight: 600;color: #333;text-align: right;"><?= ($pay_detail->total_amount>0)?"Rs.".str_replace(".00", "", $pay_detail->total_amount):'' ?></div>
		                                            </div>
	                                            </div>
	                                        </div>

                                    	</div>


		                			<?php } ?>

		                		</div>

                			</div>

                			<?php if($status=="invalid") { ?>
                				<div style="text-align: center;margin-top: 40px;"><a class="btn btn-info" href="<?= base_url(AGENT_URL) ?>">Back</a></div>
            				<?php } ?>

            				<?php if($status=="login") { ?>
                				<div style="text-align: center;margin-top: 40px;"><a class="btn btn-info" href="<?= base_url(AGENT_URL.'login?redirect='.base_url('invoice-pay/'.$pay_detail->order_id)) ?>">Login to Continue</a></div>
            				<?php } ?>

            				<?php if($status=="unpaid") { ?>
                				<div style="text-align: center;margin-top:25px;"><a class="btn btn-success btn-lg" href="<?= base_url('invoice-pay-request/'.$pay_detail->order_id) ?>" style='color:#fff;'><?= ($pay_detail->total_amount>0)?"Rs.".str_replace(".00", "", $pay_detail->total_amount):'' ?> PAY</a></div>
            				<?php } ?>

                		</div>
                		<div class="col-md-2"></div>
                	</div>
                    <!--<div class="text-center" style="padding-bottom: 20px;padding-top: 10px;">
                        <?php if($pay_detail->payment_status==1) { ?>
                            <img src="<?= base_url('public/front/check.svg') ?>" style='height: 60px;width: 60px;'>
                            <h2 style="margin-top: 20px;">Thank You!</h2>
                        <?php } else { ?>
                            <img src="<?= base_url('public/front/close.svg') ?>" style='height: 60px;width: 60px;'>
                            <h2 style="margin-top: 20px;color: #f44336;">Payment Failed!</h2>
                        <?php } ?>
                        
                        
                        <div style="padding: 10px 20px 20px 20px;">
                            <h5>Your payment has been <?= ($pay_detail->payment_status=='1')?'received':'failed' ?>.</h5>

                            <div style="padding: 25px 10px 25px 10px;">
                                
                                <div style="background-color: #f9f9f9;text-align: ;border: 1px solid #ebebeb;">
                                    

                                    <div class="row">
                                        <div class="col-md-3 col-xs-6" style="border-right: 1px solid #ebebeb;">
                                            <div style="padding: 15px 15px;">
                                                <div>ORDER NUMBER:</div>
                                                <div style="font-weight: 600;color: #333;"><?= $pay_detail->payment_id ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6" style="border-right: 1px solid #ebebeb;">
                                            <div style="padding: 15px 15px;">
                                                <div>DATE:</div>
                                                <div style="font-weight: 600;color: #333;"><?= date("d M, Y",$pay_detail->create_at) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6" style="border-right: 1px solid #ebebeb;">
                                            <div style="padding: 15px 15px;">
                                                <div>TOTAL:</div>
                                                <div style="font-weight: 600;color: #333;">Rs. <?= $pay_detail->total_amount ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <div style="padding: 15px 15px;">
                                                <div>PAYMENT METHOD:</div>
                                                <div style="font-weight: 600;color: #333;"><?= $pay_detail->payment_getway ?></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <?php if($pay_detail->payment_status==1) { ?>
                            <a class="btn btn-success" href="<?= base_url(AGENT_URL) ?>" style='color:#fff;'>Continue &nbsp;<i class="fa fa-angle-right"></i></a>
                        <?php } else { ?>
                            <a class="btn btn-info" href="<?= base_url(AGENT_URL.'plans') ?>">Try Again &nbsp;<i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>-->


                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('public/admin/') ?>plugins/common/common.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>js/custom.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

</body>
</html>