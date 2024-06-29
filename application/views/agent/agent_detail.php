<?php include('include/header.php');?>
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
                                        <h4 class="card-title">View Profile</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(AGENT_URL.'agents') ?>"><button type="button" class="btn btn-dark" >Back</button></a>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <form>
                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <img class="mr-3" src="<?= base_url('public/admin/images/avatar/11.png') ?>" width="80" height="80" alt="">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Date of Registration: </label> <span style="color: #333;"><?= $agent_detail->date_register ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Code: </label> <span style="color: #333;"><?= $agent_detail->unqiue_code ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Agent Name: </label> <span style="color: #333;"><?= ucwords($agent_detail->first_name.''.$agent_detail->$agent_detail->agent_last_name) ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Email Id: </label> <span style="color: #333;"><?= $agent_detail->email ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Contact Number: </label> <span style="color: #333;"><?= $agent_detail->unqiue_code ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Contact Person: </label> <span style="color: #333;">RJ</span>
                                            </div>dff

                                            <div class="col-md-6">
                                                <label>Whatsapp No: </label> <span style="color: #333;"><?= $agent_detail->whatsapp_no ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address - 1: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address - 2: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address - 3: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>City: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>State: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Working Location: </label> <span style="color: #333;"></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Working For: </label> <span style="color: #333;"><!-- <Name of Builder who share his Project with Agent> --></span>
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
                                                        <label>PAN No: </label> <span style="color: #333;"></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>TAN No: </label> <span style="color: #333;"></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>GST No: </label> <span style="color: #333;"></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>CIN No: </label> <span style="color: #333;"></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Adhar No: </label> <span style="color: #333;"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 box-plan" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12" align="right">
                                                        <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>No of User: </label> <span style="color: #333;"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Monthly Cost: </label> <span style="color: #333;"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Bill On: </label> <span style="color: #333;"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Per User: </label> <span style="color: #333;"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Monthly: </label> <span style="color: #333;"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 box-invoice" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12" align="right">
                                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#createInvoiceModal">Create Invoice</button>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="table-responsive scrollbar" style="padding-bottom: 50px;">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                  <tr>
                                                                        <th>&nbsp;</th>
                                                                        <th>Date</th>
                                                                        <th>Type</th>
                                                                        <th>Ref. No</th>
                                                                        <th>Bill Period</th>
                                                                        <th>No of User</th>
                                                                        <th class="text-center">Status</th>
                                                                        <th class="text-center">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <tr>
                                                                        <td class="text-center">1</td>
                                                                        <td></td>
                                                                        <td>Performa Invoice</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td class="text-center"><span class="label label-pill label-success">Paid</span></td>
                                                                        <td class="text-center">
                                                                            <div class="btn-group" role="group">
                                                                                <button type="button" class="btn mb-1 btn-dark dropdown-toggle  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item" href="javascript:void()" data-toggle="modal" data-target="#createReceiptModal">Paid</a> 
                                                                                    <a class="dropdown-item" href="javascript:void()">Unpaid</a>
                                                                                    <a class="dropdown-item" href="javascript:void()" data-toggle="modal" data-target="#invoiceReasonModal">Cancel</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="text-center">1</td>
                                                                        <td></td>
                                                                        <td>Tax Invoice</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td class="text-center"><span class="label label-pill label-success">Paid</span></td>
                                                                        <td class="text-center">
                                                                            <div class="btn-group" role="group">
                                                                                <button type="button" class="btn mb-1 btn-dark dropdown-toggle  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item" href="javascript:void()" data-toggle="modal" data-target="#createReceiptModal">Paid</a> 
                                                                                    <a class="dropdown-item" href="javascript:void()">Unpaid</a>
                                                                                    <a class="dropdown-item" href="javascript:void()" data-toggle="modal" data-target="#invoiceReasonModal">Cancel</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
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

                                                <div class="modal fade" id="createReceiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Create Receipt</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label>Receipt No: </label> <span style="color: #333;">10001</span>
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Date: </label> <span style="color: #333;">26-10-2019</span>
                                                                        </div>
                                                                        <div class="col-md-12" style="margin-top: 10px;">
                                                                            <label>Agent: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>State: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>City: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Against Ref. No: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Date: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>No Of User: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Period: </label>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control" placeholder="From">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control" placeholder="To">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Paid By: </label>
                                                                            <select class="form-control">
                                                                                  <option value="">Select Method</option>
                                                                                  <option value="Cash">Cash</option>
                                                                                  <option value="Cheque">Cheque</option>
                                                                                  <option value="UPI">UPI</option>
                                                                                  <option value="Trf">Trf</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Rs: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-3" style="margin-top: 10px;">
                                                                            <label>CQ No: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-3" style="margin-top: 10px;">
                                                                            <label>Date: </label>
                                                                            <input type="date" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Bank: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-12" style="margin-top: 10px;">
                                                                            <label>Remarks: </label>
                                                                            <textarea class="form-control" rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Create Invoice</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label>Invoice Type: </label>
                                                                            <select class="form-control">
                                                                                  <option value="">Select Invoice Type</option>
                                                                                  <option value="Performa Invoice">Performa Invoice</option>
                                                                                  <option value="Tax Invoice">Tax Invoice</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Ref. No: </label>
                                                                            <input type="text" class="form-control" placeholder="" value="1" readonly="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Date: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Agent: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>State: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>City: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>No Of User: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Period: </label>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control" placeholder="From">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control" placeholder="To">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Cost: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-top: 10px;">
                                                                            <label>Mode of Billing: </label>
                                                                            <input type="text" class="form-control" placeholder="">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Generate</button>
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
 <?php include('include/footer.php');?>
 <script>
$('input[type=radio][name=radioType]').change(function() {

    if (this.value == 'KYC') {
       $(".box-kyc").show();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").hide();
    }
    else if (this.value == 'Plan') {
       $(".box-kyc").hide();
       $(".box-plan").show();
       $(".box-invoice").hide();
       $(".box-summary").hide();
    }
    else if (this.value == 'InvoiceReceipt') {
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").show();
       $(".box-summary").hide();
    }
    else if (this.value == 'Summary') {
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").show();
    }
});
 </script>