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
                                        <h4 class="card-title">View Profile</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(ADMIN_URL.'agents') ?>"><button type="button" class="btn btn-dark" >Back</button></a><?php //  } ?>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <form>
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
                                            <div class="form-group col-md-12">
                                                <?php if($agent_detail->image && $agent_detail->is_individual=='1') { ?>
                                                <img class="mr-3" src="<?= base_url('uploads/images/user/photo/'.$agent_detail->image) ?>" width="80" height="80" alt="" style="border-radius:50%;border: 1px solid #76838f;">
                                                <?php } ?>
                                                <?php if($agent_detail->logo && $agent_detail->is_individual=='0') { ?>
                                                <img class="mr-3" src="<?= base_url('uploads/images/user/logo/'.$agent_detail->logo) ?>" width="80" height="80" alt="" style="border-radius:50%;border: 1px solid #76838f;">
                                                <?php } ?>
                                            </div>

                                             <div class="col-md-6">
                                                <label>Date of Registration: </label> <span style="color: #333;"><?= $agent_detail->date_register ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Code: </label> <span style="color: #333;"><?= $agent_detail->unique_code ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Agent Name: </label> <span style="color: #333;"><?= ucwords($agent_detail->first_name.''.$agent_detail->last_name) ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Email Id: </label> <span style="color: #333;"><?= $agent_detail->email ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Contact Number: </label> <span style="color: #333;"><?= $agent_detail->contact_no ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Contact Person: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Whatsapp No: </label> <span style="color: #333;"><?= $agent_detail->whatsapp_no ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address - 1: </label> <span style="color: #333;"><?= $agent_detail->address_1 ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address - 2: </label> <span style="color: #333;"><?= $agent_detail->address_2 ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address - 3: </label> <span style="color: #333;"><?= $agent_detail->address_3 ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>State: </label> <span style="color: #333;"><?= $agent_detail->state_name ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>City: </label> <span style="color: #333;"><?= $agent_detail->city_name ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Working Location: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Working For: </label> <span style="color: #333;"><!-- <Name of Builder who share his Project with Agent> --></span>
                                            </div>

                                            <div class="col-md-12" style="margin-top: 15px;">
                                                <h4>SMS: </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>SMS: </label> <span style="color: #333;font-weight: bold;"><?= $agent_detail->no_of_sms ?></span>
                                                    </div>
                                                    <!--<div class="col-md-12">
                                                        <label>Used SMS: </label> <span style="color: #333;font-weight: bold;">100</span>
                                                    </div>-->
                                                    <div class="col-md-12" style="margin-top: 10px;">
                                                        <a class="btn btn-dark btn-sm" style="color: #fff;" href="javascript:void(0)" onclick="addSMS()">Add SMS</a>

                                                        <a class="btn btn-info btn-sm" style="color: #fff; margin-left: 10px;" href="<?= base_url(ADMIN_URL.'sms-credit-history/'.$agent_detail->user_id) ?>">Credit History</a>

                                                        <a class="btn btn-info btn-sm" style="color: #fff; margin-left: 10px;" href="<?= base_url(ADMIN_URL.'sms-used-history/'.$agent_detail->user_id) ?>">Used History</a>

                                                    </div>
                                                </div>
                                                <hr>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row radio-toolbar">
                                                    <div class="col-md-3">
                                                        <input type="radio" id="radioKYC" name="radioType" value="KYC" checked>
                                                        <label for="radioKYC">KYC</label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="radio" id="radioPlan" name="radioType" value="Plan">
                                                        <label for="radioPlan">Plan</label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="radio" id="radioInvoiceReceipt" name="radioType" value="InvoiceReceipt">
                                                        <label for="radioInvoiceReceipt">Invoice & Receipt</label>
                                                    </div> 
                                                    
                                                    <div class="col-md-3">
                                                        <input type="radio" id="radioSummary" name="radioType" value="Summary">
                                                        <label for="radioSummary">Summary</label>
                                                    </div> 
                                                </div>
                                            </div>

                                            <div class="col-md-12 box-kyc">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>PAN No: </label> <span style="color: #333;"><?= $agent_detail->pan_no ?></span>

                                                        <div>
                                                            <?php if($agent_detail && $agent_detail->pan_image) { ?>
                                                                <a href="<?= base_url('uploads/images/user/document/'.$agent_detail->pan_image) ?>" target="_blank"><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:2px;margin-bottom: 5px;">View File</span></a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <?php if($agent_detail->is_individual==0) { ?>
                                                    <div class="col-md-6">
                                                        <label>TAN No: </label> <span style="color: #333;"><?= $agent_detail->tan_no ?></span>

                                                        <div>
                                                            <?php if($agent_detail && $agent_detail->tan_image) { ?>
                                                                <a href="<?= base_url('uploads/images/user/document/'.$agent_detail->tan_image) ?>" target="_blank"><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:2px;margin-bottom: 5px;">View File</span></a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <div class="col-md-6">
                                                        <label>GST No: </label> <span style="color: #333;"><?= $agent_detail->gst_no ?></span>

                                                        <div>
                                                            <?php if($agent_detail && $agent_detail->gst_image) { ?>
                                                                <a href="<?= base_url('uploads/images/user/document/'.$agent_detail->gst_image) ?>" target="_blank"><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:2px;margin-bottom: 5px;">View File</span></a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <?php if($agent_detail->is_individual==0) { ?>
                                                    <div class="col-md-6">
                                                        <label>CIN No: </label> <span style="color: #333;"><?= $agent_detail->cin_no ?></span>

                                                        <div>
                                                            <?php if($agent_detail && $agent_detail->cin_image) { ?>
                                                                <a href="<?= base_url('uploads/images/user/document/'.$agent_detail->cin_image) ?>" target="_blank"><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:2px;margin-bottom: 5px;">View File</span></a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <div class="col-md-6">
                                                        <label>Adhar No: </label> <span style="color: #333;"><?= $agent_detail->adhar_no ?></span>

                                                        <div>
                                                            <?php if($agent_detail && $agent_detail->adhar_image) { ?>
                                                                <a href="<?= base_url('uploads/images/user/document/'.$agent_detail->adhar_image) ?>" target="_blank"><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:2px;margin-bottom: 5px;">View File</span></a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 box-plan" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12" align="right">
                                                        <button type="button" class="btn btn-info btn-sm" onclick="get_agent_plan(<?= $agent_detail->user_id ?>)"><i class="fa fa-edit"></i> Edit</button>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Plan: </label> <span style="color: #333;font-weight: bold;"><?= ($bill_on_detail || $agent_detail->plan_id==2)?"PRO":'Basic' ?></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Expire Date: </label> <span style="color: #333;font-weight: bold;"><?= ($agent_detail && $agent_detail->next_due_date)?date("d F, Y",strtotime($agent_detail->next_due_date)):'' ?></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Monthly Cost: </label> <span style="color: #333;font-weight: bold;"><?= ($agent_detail->monthly_cost)?'Rs.'.$agent_detail->monthly_cost:'' ?></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>No of User: </label> <span style="color: #333;font-weight: bold;"><?= $agent_detail->no_of_user ?></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Per User: </label> <span style="color: #333;font-weight: bold;"><?= ($agent_detail->per_user_amount)?'Rs.'.$agent_detail->per_user_amount:'' ?></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php $monthly = $agent_detail->per_user_amount * $agent_detail->no_of_user;
                                                        $total = $agent_detail->monthly_cost + ($agent_detail->per_user_amount * $agent_detail->no_of_user); ?>
                                                        <label>Monthly: </label> <span style="color: #333;font-weight: bold;"><?= ($monthly)?'Rs.'.$monthly:'' ?></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Total: </label> <span style="color: #333;font-weight: bold;"><?= ($total)?'Rs.'.$total:'' ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 box-invoice" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12" align="right">
                                                        <button type="button" class="btn btn-dark btn-sm" onclick="get_create_invoice(<?= $agent_detail->user_id ?>)">Create Invoice</button>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="table-responsive" style="">
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
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($payments as $row) { ?>
          <tr>
                <td class="text-center"><?= $i+1 ?></td>
                <td class="text-center"><?= $row->invoice_date ?></td>
                <td><?php if($row->payment_status==1) { echo "Invoice"; } else { echo "Performa Invoice"; } ?></td>
                <td class="text-center">
                <?php if($row->payment_status==1)  { ?>
                    <a href="<?= base_url(ADMIN_URL.'receipt/'.$row->payment_id) ?>" style="font-size: 16px;font-weight: bold;text-decoration: underline;color: #4d7cff;"><?= $row->invoice_id ?></a>
                 <?php } else { ?>
                    <a href="<?= base_url(ADMIN_URL.'invoice/'.$row->payment_id) ?>" style="font-size: 16px;font-weight: bold;text-decoration: underline;color: #4d7cff;"><?= $row->invoice_id ?></a>
                <?php } ?>

                </td>
                <td class="text-center"><?= $row->current_plan_date.' To '.$row->next_due_date ?></td>
                <td class="text-center"><?= $row->no_of_user ?></td>
                <td class="text-center"><?= ($row->amount_per_user>0)?'Rs.'.str_replace(".00", "", $row->amount_per_user):'' ?></td>
                <td class="text-center"><?= ($row->monthly_cost>0)?'Rs.'.str_replace(".00", "", $row->monthly_cost):'' ?></td>
                <td class="text-center"><?= ($row->total_amount>0)?'Rs.'.str_replace(".00", "", $row->total_amount):'' ?></td>
                <!--<td class="text-center">
                    <?php if($row->payment_status==1)  { ?>
                    <a href="<?= base_url(ADMIN_URL.'receipt/'.$row->payment_id) ?>" style="font-size: 16px;font-weight: bold;text-decoration: underline;color: #6fd96f;"><?= $row->invoice_id ?></a>
                     <?php } ?>   
                </td>-->
                <td class="text-center">
                    <?php if($row->payment_status==1)  { ?>
                    <span class="label label-pill label-success">Paid</span>
                    <?php } ?>
                    <?php if($row->payment_status==0)  { ?>
                    <span class="label label-pill label-warning">Unpaid</span>
                    <?php } ?>
                    <?php if($row->payment_status==3)  { ?>
                    <span class="label label-pill label-danger">Cancelled</span>
                    <?php if($row->cancel_reason)  { ?>
                    <div style="font-weight: normal;font-size: 12px;margin-top: 10px;"><strong>Remark:</strong> <?= $row->cancel_reason ?></div>
                    <?php } ?>
                    <?php } ?>
                </td>
                <td class="text-center">
                    <?php if($row->entry_type==2 && $row->payment_status==0) { ?>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn mb-1 btn-dark dropdown-toggle  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <!--<a class="dropdown-item" href="<?= base_url(ADMIN_URL.'invoice-detail/'.$row->payment_id) ?>">View Details</a> -->
                                
                                <a class="dropdown-item" href="javascript:void()" onclick="get_create_receipt(<?= $row->payment_id ?>)">Paid</a> 
                                <a class="dropdown-item" href="javascript:void()" onclick="get_cancel_invoice(<?= $row->payment_id ?>)">Cancel</a>
                                
                            </div>
                        </div>
                        <?php } ?>
                </td>
            </tr>
        <?php $i++; } ?>

    </tbody>
</table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="invoiceReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Invoice Cancel</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="col-form-label">Reason:</label>
                                                                        <textarea class="form-control" id="message-text" rows="5"></textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                            </div>

                                            <div class="col-md-12 box-summary" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive scrollbar" style="padding-bottom: 50px;">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Total No of Lead</td>
                                                                        <td style="width: 150px;"></td>
                                                                        <td></td>
                                                                        <td class="text-center">For Sale</td>
                                                                        <td class="text-center">For Buy</td>
                                                                        <td class="text-center">For Rent</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Total Followup</td>
                                                                        <td style="width: 150px;"></td>
                                                                        <td>Total Achivment </td>
                                                                        <td class="text-center"></td>
                                                                        <td class="text-center"></td>
                                                                        <td class="text-center"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Site Visit as on</td>
                                                                        <td style="width: 150px;"></td>
                                                                        <td>Total Commission</td>
                                                                        <td class="text-center"></td>
                                                                        <td class="text-center"></td>
                                                                        <td class="text-center"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

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


<!-- modal form -->
<div class="modal fade" id="formModal" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" budget="document">
        <div class="modal-content">

            <form id="form-modal" method="post">
                <input type="hidden" class="form-control" id="fid" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Edit Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="agent-plan-error-msg"></div>
                    <div class="form-group">
                        <label for="next_due_date" class="col-form-label">Expire Date:</label>
                        <input type="text" class="form-control" id="next_due_date" name="next_due_date" required="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">No of User:</label>
                        <input type="text" class="form-control" id="no_of_user" name="no_of_user" required="">
                    </div>
                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Per User:</label>
                        <input type="text" class="form-control" id="per_user_amount" name="per_user_amount" required="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Monthly Cost:</label>
                        <input type="text" class="form-control" id="monthly_cost" name="monthly_cost" required="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success form-btn wd-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end -->

<div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="invoice-modal" method="post">
                <input type="hidden" class="form-control" id="invoice-modal-id" name="id" value="">

                    <div class="invoice-modal-error-msg"></div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Invoice Type: </label>
                            <select class="form-control" required="" id="invoice_type" name="invoice_type">
                                  <option value="1">Performa Invoice</option>
                                  <!--<option value="2">Tax Invoice</option>-->
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Ref. No: </label>
                            <input type="text" class="form-control" id="invoice_id" name="invoice_id" placeholder="" value="" readonly="">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Date: </label>
                            <input type="text" class="form-control" id="invoice_date" name="invoice_date" placeholder="">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Agent: </label>
                            <input type="text" class="form-control" id="agent_name" name="agent_name" placeholder="">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>State: </label>
                            <input type="text" class="form-control" id="state_name_label" name="state_name_label" placeholder="" disabled="">
                            <input type="hidden" class="form-control" id="state_name" name="state_name" placeholder="">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>City: </label>
                            <input type="text" class="form-control" id="city_name_label" name="city_name_label" placeholder="" disabled="">
                            <input type="hidden" class="form-control" id="city_name" name="city_name" placeholder="">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>No Of User: </label>
                            <input type="text" class="form-control" id="inv_no_of_user" name="inv_no_of_user" placeholder="">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Period: </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="inv_current_plan_date" name="inv_current_plan_date" placeholder="From" required="">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="inv_next_due_date" name="inv_next_due_date" placeholder="To" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Per User: </label>
                            <input type="text" class="form-control" id="inv_per_user_amount" name="inv_per_user_amount" placeholder="">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Monthly Cost: </label>
                            <input type="text" class="form-control" id="inv_monthly_cost" name="inv_monthly_cost" placeholder="">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary invoice-modal-btn">Generate</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invoice Cancel
</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="invoice-cancel-modal" method="post">
                <input type="hidden" class="form-control" id="invoice-cancel-modal-id" name="id" value="">

                    <div class="invoice-cancel-modal-error-msg"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Reason: </label>
                            <textarea class="form-control" id="cancel_reason" name="cancel_reason" placeholder="" rows="3"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary invoice-cancel-modal-btn">Generate</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createReceiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="receipt-modal" method="post">
                <input type="hidden" class="form-control" id="receipt-modal-id" name="id" value="">

                    <div class="receipt-modal-error-msg"></div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Receipt No: </label> <span style="color: #333;" id="receipt_id"></span>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Date: </label> <span style="color: #333;" id="receipt_date"></span>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <label>Agent: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_agent_name">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>State: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_state_name">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>City: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_city_name">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Against Ref. No: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_invoice_id">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Date: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_invoice_date">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>No Of User: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_nof_user">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Per User: (Rs)</label>
                            <input type="text" class="form-control" placeholder="" id="receipt_per_user_amount">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Mothly Cost: (Rs)</label>
                            <input type="text" class="form-control" placeholder="" id="receipt_monthly_cost">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Period: </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="From" id="receipt_current_plan_date">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="To" id="receipt_next_due_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Paid By: </label>
                            <select class="form-control" id="receipt_paid_type" name="receipt_paid_type" onchange="paidType()" required="">
                                  <option value="">Select Method</option>
                                  <option value="2">Cash</option>
                                  <option value="3">Cheque</option>
                                  <option value="4">UPI</option>
                                  <option value="5">TRF</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Total Amount: (Rs)</label>
                            <input type="text" class="form-control" placeholder="" id="receipt_total_amount">
                        </div>
                        <div class="col-md-3 cheque" style="margin-top: 10px;">
                            <label>CQ No: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_cheque_no" name="receipt_cheque_no">
                        </div>
                        <div class="col-md-3 cheque" style="margin-top: 10px;">
                            <label>Date: </label>
                            <input type="text" class="form-control" placeholder="" id="receipt_cheque_date" name="receipt_cheque_date">
                        </div>
                        <div class="col-md-6 cheque" style="margin-top: 10px;">
                            <label>Bank: </label>
                            <input type="text" class="form-control" placeholder="" placeholder="" id="receipt_bank_name" name="receipt_bank_name">
                        </div>
                        <div class="col-md-6 receipt_txn_id" style="margin-top: 10px;">
                            <label>Transaction ID: </label>
                            <input type="text" class="form-control" placeholder="" placeholder="" id="receipt_txn_id" name="receipt_txn_id">
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <label>Remarks: </label>
                            <textarea class="form-control" rows="3" id="receipt_remark" name="receipt_remark" required=""></textarea>
                        </div>

                        
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary receipt-modal-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSMSModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add SMS
</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="add-sms-modal" method="post">
                <input type="hidden" class="form-control" id="add-sms-modal-id" name="id" value="">

                    <div class="add-sms-modal-error-msg"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>No of SMS: </label>
                            <input type="text" class="form-control" id="no_of_sms" name="no_of_sms" placeholder="" />
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <label>Amount: </label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary add-sms-modal-btn">Add SMS</button>
            </div>
            </form>
        </div>
    </div>
</div>

 <?php include('include/footer.php');?>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
 <script>


//alert(new Date());


<?php if($this->input->get('tab')=='KYC') { ?>
    $("input[name=radioType][value='KYC']").prop("checked",true);
       $(".box-kyc").show();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").hide();
<?php } ?>
<?php if($this->input->get('tab')=='Plan') { ?>
    $("input[name=radioType][value='Plan']").prop("checked",true);
       $(".box-kyc").hide();
       $(".box-plan").show();
       $(".box-invoice").hide();
       $(".box-summary").hide();
<?php } ?>
<?php if($this->input->get('tab')=='InvoiceReceipt') { ?>
    $("input[name=radioType][value='InvoiceReceipt']").prop("checked",true);
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").show();
       $(".box-summary").hide();
<?php } ?>
<?php if($this->input->get('tab')=='Summary') { ?>
    $("input[name=radioType][value='Summary']").prop("checked",true);
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").show();
<?php } ?>
$('input[type=radio][name=radioType]').change(function() {

    if (this.value == 'KYC') {
       $(".box-kyc").show();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").hide();
       window.history.pushState('data', 'Agents', "<?= base_url(ADMIN_URL.'agents/'.$agent_detail->user_id.'/?tab=KYC') ?>");
    }
    else if (this.value == 'Plan') {
       $(".box-kyc").hide();
       $(".box-plan").show();
       $(".box-invoice").hide();
       $(".box-summary").hide();
       window.history.pushState('data', 'Agents', "<?= base_url(ADMIN_URL.'agents/'.$agent_detail->user_id.'/?tab=Plan') ?>");
    }
    else if (this.value == 'InvoiceReceipt') {
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").show();
       $(".box-summary").hide();
       window.history.pushState('data', 'Agents', "<?= base_url(ADMIN_URL.'agents/'.$agent_detail->user_id.'/?tab=InvoiceReceipt') ?>");
    }
    else if (this.value == 'Summary') {
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").show();
       window.history.pushState('data', 'Agents', "<?= base_url(ADMIN_URL.'agents/'.$agent_detail->user_id.'/?tab=Summary') ?>");
    }
});


function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

function get_agent_plan(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_agent_plan') ?>",
        data: {id:id},
        beforeSend: function (data) {
            $(".loader_progress").show();
        },
        success: function (response) {
            $(".loader_progress").hide();
            var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                    $('#formModal').modal({backdrop: 'static', keyboard: false})

                    $("#fid").val('');
                    $("#formModal input").val('');
                    $("#formModal select").val('');
                    $("#formModal textarea").val('');

                    var record = obj.record;
                    $("#fid").val(record.user_id);
                    $("#no_of_user").val(record.no_of_user);
                    $("#monthly_cost").val(record.monthly_cost);
                    $("#per_user_amount").val(record.per_user_amount);
                    $("#next_due_date").val(record.next_due_date);
                    $(".agent-plan-error-msg").html('');

                    $('#next_due_date').bootstrapMaterialDatePicker({
                        weekStart: 0,
                        time: false,
                        format: 'DD-MM-YYYY', 
                        minDate : record.next_due_date
                    });

                    $("#formModalLabel").text('Edit Plan');
                    $(".form-btn").text('Submit');
                }
                else {
                  alert(obj.message);
                }
              }
              catch(err) {
                alert('Some error occurred, please try again.');
              }
        },
        error: function () {
            $(".loader_progress").hide();
           alert('Some error occurred, please try again.');
           
        }

    });
}

 $("#form-modal").validate({
    rules: {
        no_of_user: {
            required: true,
            digits: true,
            min: 1
        },
        per_user_amount: {
            required: true,
            digits: true,
        },
        monthly_cost: {
            required: true,
            digits: true,
        }
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal");
      var fd = new FormData(myform );
      var fid = $("#fid").val();
      var btn_label = "Submit";

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/agent_plan_process') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".agent-plan-error-msg").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn").html(btn_label);

                if (obj.status=='success') {
                  $("#formModal").modal('hide');
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href='?tab=Plan';
                }
                else {
                  $(".agent-plan-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html(btn_label);
                $(".agent-plan-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".form-btn").html(btn_label);
          $(".agent-plan-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

 $("#tableList").DataTable();


function get_create_invoice(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_create_invoice') ?>",
        data: {id:id},
        beforeSend: function (data) {
            $(".loader_progress").show();
        },
        success: function (response) {
            $(".loader_progress").hide();
            var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                    $('#createInvoiceModal').modal({backdrop: 'static', keyboard: false})

                    $("#invoice-modal-id").val('');
                    $("#createInvoiceModal input").val('');
                    $("#createInvoiceModal select").val('');
                    $("#createInvoiceModal textarea").val('');

                    var record = obj.record;
                    $("#invoice-modal-id").val(record.user_id);

                    $("#invoice_type").val("1");
                    $("#inv_no_of_user").val(record.no_of_user);
                    $("#inv_per_user_amount").val(record.per_user_amount);
                    $("#inv_monthly_cost").val(record.monthly_cost);
                    $("#agent_name").val(record.agent_name).prop("readonly",true);
                    $("#state_name").val(record.state_id).prop("readonly",true);
                    $("#city_name").val(record.city_id).prop("readonly",true);
                    $("#state_name_label").val(record.state_name);
                    $("#city_name_label").val(record.city_name);
                    $("#invoice_date").val(record.invoice_date).prop("readonly",true);
                    $("#invoice_id").val(record.invoice_id).prop("readonly",true);
                    $("#inv_current_plan_date").val(record.current_plan_date).prop("readonly",false);
                    $("#inv_next_due_date").val(record.next_due_date).prop("readonly",false);

                    $('#inv_current_plan_date').bootstrapMaterialDatePicker({
                        weekStart: 0,
                        time: false,
                        format: 'DD-MM-YYYY', 
                        minDate : record.current_plan_date
                    });

                    $('#inv_next_due_date').bootstrapMaterialDatePicker({
                        weekStart: 0,
                        time: false,
                        format: 'DD-MM-YYYY', 
                        minDate : record.next_due_date
                    });

                    /*$("#no_of_user").val(record.no_of_user);
                    $("#monthly_cost").val(record.monthly_cost);
                    $("#per_user_amount").val(record.per_user_amount);
                    $("#next_due_date").val(record.next_due_date);
                    $(".agent-plan-error-msg").html('');*/

                    $("#createInvoiceModal .modal-title").text('Create Invoice');
                    $(".form-invoice-btn").text('Generate');
                }
                else {
                  alert(obj.message);
                }
              }
              catch(err) {
                alert('Some error occurred, please try again.');
              }
        },
        error: function () {
            $(".loader_progress").hide();
           alert('Some error occurred, please try again.');
           
        }

    });
}


 $("#invoice-modal").validate({
    rules: {
        inv_no_of_user: {
            required: true,
            digits: true,
            min: 1
        },
        inv_per_user_amount: {
            required: true,
            digits: true,
        },
        inv_monthly_cost: {
            required: true,
            digits: true,
        }
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("invoice-modal");
      var fd = new FormData(myform );
      var btn_label = "Generate";

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/invoice_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".invoice-modal-error-msg").html('');
          $(".invoice-modal-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".invoice-modal-btn").html(btn_label);

                if (obj.status=='success') {
                  $("#createInvoiceModal").modal('hide');
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href='?tab=InvoiceReceipt';
                }
                else {
                  $(".invoice-modal-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".invoice-modal-btn").html(btn_label);
                $(".invoice-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".invoice-modal-btn").html(btn_label);
          $(".invoice-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

 function get_cancel_invoice(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_cancel_invoice') ?>",
        data: {id:id},
        beforeSend: function (data) {
            $(".loader_progress").show();
        },
        success: function (response) {
            $(".loader_progress").hide();
            var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                    $('#cancelInvoiceModal').modal({backdrop: 'static', keyboard: false})

                    $("#invoice-cancel-modal-id").val('');
                    $("#cancelInvoiceModal input").val('');
                    $("#cancelInvoiceModal select").val('');
                    $("#cancelInvoiceModal textarea").val('');

                    var record = obj.record;
                    $("#invoice-cancel-modal-id").val(record.payment_id);

                    $("#cancelInvoiceModal .modal-title").text('Cancel Invoice');
                    $(".form-invoice-cancel-btn").text('Generate');
                }
                else {
                  alert(obj.message);
                }
              }
              catch(err) {
                alert('Some error occurred, please try again.');
              }
        },
        error: function () {
            $(".loader_progress").hide();
           alert('Some error occurred, please try again.');
           
        }

    });
}


 $("#invoice-cancel-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("invoice-cancel-modal");
      var fd = new FormData(myform );
      var btn_label = "Submit";

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/invoice_cancel') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".invoice-cancel-modal-error-msg").html('');
          $(".invoice-cancel-modal-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".invoice-cancel-modal-btn").html(btn_label);

                if (obj.status=='success') {
                  $("#cancelInvoiceModal").modal('hide');
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href='?tab=InvoiceReceipt';
                }
                else {
                  $(".invoice-cancel-modal-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".invoice-cancel-modal-btn").html(btn_label);
                $(".invoice-cancel-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".invoice-cancel-modal-btn").html(btn_label);
          $(".invoice-cancel-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});


 function get_create_receipt(id) {
     $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_create_receipt') ?>",
        data: {id:id},
        beforeSend: function (data) {
            $(".loader_progress").show();
        },
        success: function (response) {
            $(".loader_progress").hide();
            var obj;
              try {
                obj = JSON.parse(response);

                if (obj.status=='success') {
                    $('#createReceiptModal').modal({backdrop: 'static', keyboard: false});

                    $("#receipt-modal-id").val('');
                    $("#createReceiptModal input").val('');
                    $("#createReceiptModal select").val('');
                    $("#createReceiptModal textarea").val('');

                    var record = obj.record;
                    $("#receipt-modal-id").val(record.payment_id);

                    $("#receipt_nof_user").val(record.no_of_user).prop("readonly",true);
                    $("#receipt_per_user_amount").val(record.amount_per_user).prop("readonly",true);
                    $("#receipt_monthly_cost").val(record.monthly_cost).prop("readonly",true);
                    $("#receipt_total_amount").val(record.total_amount).prop("readonly",true);
                    $("#receipt_agent_name").val(record.name).prop("readonly",true);
                    $("#receipt_state_name").val(record.state_name).prop("readonly",true);
                    $("#receipt_city_name").val(record.city_name).prop("readonly",true);
                    $("#receipt_invoice_date").val(record.invoice_date).prop("readonly",true);
                    $("#receipt_invoice_id").val(record.payment_id).prop("readonly",true);
                    $("#receipt_current_plan_date").val(record.current_plan_date).prop("readonly",true);
                    $("#receipt_next_due_date").val(record.next_due_date).prop("readonly",true);
                    $("#receipt_id").html("<b>"+record.payment_id+"</b>");
                    $("#receipt_date").html("<b>"+record.receipt_date+"</b>");

                    /*$("#invoice_type").val("1");
                    $("#inv_no_of_user").val(record.no_of_user);
                    $("#inv_per_user_amount").val(record.per_user_amount);
                    $("#inv_monthly_cost").val(record.monthly_cost);
                    $("#agent_name").val(record.agent_name).prop("readonly",true);
                    $("#state_name").val(record.state_name).prop("readonly",true);
                    $("#city_name").val(record.city_name).prop("readonly",true);
                    $("#invoice_date").val(record.invoice_date).prop("readonly",true);
                    $("#invoice_id").val(record.invoice_id).prop("readonly",true);
                    $("#inv_current_plan_date").val(record.current_plan_date).prop("readonly",false);
                    $("#inv_next_due_date").val(record.next_due_date).prop("readonly",false);*/

                    /*$("#no_of_user").val(record.no_of_user);
                    $("#monthly_cost").val(record.monthly_cost);
                    $("#per_user_amount").val(record.per_user_amount);
                    $("#next_due_date").val(record.next_due_date);
                    $(".agent-plan-error-msg").html('');*/

                    $("#createReceiptModal .modal-title").text('Create Receipt');
                    $(".form-receipt-btn").text('Submit');

                    paidType();
                }
                else {
                  alert(obj.message);
                }
              }
              catch(err) {
                alert('Some error occurred, please try again.');
              }
        },
        error: function () {
            $(".loader_progress").hide();
           alert('Some error occurred, please try again.');
           
        }

    });
}


 $("#receipt-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("receipt-modal");
      var fd = new FormData(myform );
      var btn_label = "Submit";

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/receipt_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".receipt-modal-error-msg").html('');
          $(".receipt-modal-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".receipt-modal-btn").html(btn_label);

                if (obj.status=='success') {
                  $("#createReceiptModal").modal('hide');
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href='?tab=InvoiceReceipt';
                }
                else {
                  $(".receipt-modal-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".receipt-modal-btn").html(btn_label);
                $(".receipt-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".receipt-modal-btn").html(btn_label);
          $(".receipt-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

 function paidType() {
     var receipt_paid_type = $("#receipt_paid_type").val();
     if (receipt_paid_type=="3") {
        $(".cheque").show();
        $("#receipt_cheque_no,#receipt_cheque_date,#receipt_bank_name").prop("required",true);
        $(".receipt_txn_id").hide();
        $("#receipt_txn_id").prop("required",false);
     }
     else if (receipt_paid_type=="4" || receipt_paid_type=="5") {
        $(".cheque").hide();
        $("#receipt_cheque_no,#receipt_cheque_date,#receipt_bank_name").prop("required",false).val("");
        $("#receipt_txn_id").prop("required",true);
        $(".receipt_txn_id").show();
     }
     else {
        $(".cheque").hide();
        $("#receipt_cheque_no,#receipt_cheque_date,#receipt_bank_name").prop("required",false).val("");
        $(".receipt_txn_id").hide();
        $("#receipt_txn_id").prop("required",false);
     }
 }


 function addSMS() {
    $('#addSMSModal').modal({backdrop: 'static', keyboard: false})

    $("#add-sms-modal-id").val('');
    $("#addSMSModal input").val('');
    $("#addSMSModal select").val('');
    $("#addSMSModal textarea").val('');

    $("#add-sms-modal-id").val(<?= $agent_detail->user_id ?>);

    $("#addSMSModal .modal-title").text('Add SMS');
    $(".form-add-sms-btn").text('Add SMS');
 }

 $("#add-sms-modal").validate({
    rules: {
        "no_of_sms":{
            "required":true,
            "digits":true,
            "min":1
        },
        "amount":{
            "required":false,
            "digits":true
        }
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("add-sms-modal");
      var fd = new FormData(myform );
      var btn_label = "Submit";

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/add_sms_agent') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".add-sms-modal-error-msg").html('');
          $(".add-sms-modal-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".add-sms-modal-btn").html(btn_label);

                if (obj.status=='success') {
                  $("#cancelInvoiceModal").modal('hide');
                  //$(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href='?tab=InvoiceReceipt';
                }
                else {
                  $(".add-sms-modal-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".add-sms-modal-btn").html(btn_label);
                $(".add-sms-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".add-sms-modal-btn").html(btn_label);
          $(".add-sms-modal-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
 </script>