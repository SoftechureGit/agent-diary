<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Thank You</title>
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

<body class="h-100" style="background-color: #fff;">
    

<div class="login-form">
    <div class="container h-100">
        <div class="row justify-content-center h-100 mt-5">
            <div class="col-xl-10">
                <div class="form-input-content">

                    <div class="text-center" style="padding-bottom: 20px;padding-top: 10px;">
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
                                                <div style="font-weight: 600;color: #000;"><?= $pay_detail->invoice_id ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6" style="border-right: 1px solid #ebebeb;">
                                            <div style="padding: 15px 15px;">
                                                <div>DATE:</div>
                                                <div style="font-weight: 600;color: #000;"><?= date("d M, Y",strtotime($pay_detail->invoice_date)) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6" style="border-right: 1px solid #ebebeb;">
                                            <div style="padding: 15px 15px;">
                                                <div>TOTAL:</div>
                                                <div style="font-weight: 600;color: #000;">Rs. <?= $pay_detail->total_amount ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <div style="padding: 15px 15px;">
                                                <div>PAYMENT METHOD:</div>
                                                <div style="font-weight: 600;color: #000;"><?= $pay_detail->payment_getway ?></div>
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
                    </div>


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