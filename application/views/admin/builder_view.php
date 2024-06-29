<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
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
                                        <h4 class="card-title">Builder Details</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(ADMIN_URL.'builders') ?>"><button type="button" class="btn btn-dark btn-sm" ><i class="fa fa-arrow-left"></i> Back</button></a><?php //  } ?>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <div class="error-msg" style="margin-top: 10px;">
                                        <?php if($this->session->flashdata('error_msg')) { ?>
                                          <div class="alert alert-danger pd8">
                                            <?php echo $this->session->flashdata('error_msg'); ?>
                                          </div>
                                        <?php } ?>
                                        <?php if($this->session->flashdata('success_msg')) { ?>
                                          <div class="alert alert-success pd8">
                                            <?php echo $this->session->flashdata('success_msg'); ?>
                                          </div>
                                        <?php } ?>
                                    </div>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <b>Group:</b>
                                                <span><?= $builder_detail->builder_group_name ?></span>
                                            </div>

                                            <div class="form-group col-md-6">
                                            	<b>Company Name: </b><span><?php if($id) { echo $builder_detail->firm_name; }  ?></span>
                                                
                                            </div>

                                            <div class="form-group col-md-6">
                                                <b>Email Id: </b><span><?php if($id) { echo $builder_detail->builder_email; }  ?></span>
                                                
                                            </div>

                                            <div class="form-group col-md-6">
                                                <b>Contact No: </b><span><?php if($id) { echo $builder_detail->builder_mobile; }  ?></span>
                                                
                                            </div>

                                            <div class="form-group col-md-6">
                                                <b>Type of Firm:</b>
                                                <span><?= $builder_detail->firm_type_name ?></span>
                                            </div>

                                            <div class="form-group col-md-6">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <b>Address:</b>
                                                <br>
                                                <span><?php if($id) { echo $builder_detail->address_1; }  ?></span><br>
                                                <span><?php if($id) { echo $builder_detail->address_2; }  ?></span>
                                                <br>
                                                <span><?php if($id) { echo $builder_detail->address_3; }  ?></span>
                                            </div>

                                            <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <b>Country</b>
                                                  
                                                <span><?= $builder_detail->country_name ?></span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <b>State</b>
                                                
                                                <span><?= $builder_detail->state_name ?></span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <b>City</b>
                                                
                                                <span><?= $builder_detail->city_name ?></span>
                                            </div>

                                            
                                            <div class="form-group col-md-4">
                                                <b>Name of Director:</b>
                                                <span><?= $builder_detail->director_title ?> <?php if($id) { echo $builder_detail->director_name; }  ?></span>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <b>Director Contact No:</b>
                                                <span><?php if($id) { echo $builder_detail->director_contact_no; }  ?></span>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <b>Director Email Id:</b>
                                                <span><?php if($id) { echo $builder_detail->director_email; }  ?></span>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <b>Name of Representative:</b>
                                                <span><?= $builder_detail->representative_title ?> <?php if($id) { echo $builder_detail->representative_name; }  ?></span>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <b>Representative Contact No:</b>
                                                <span><?php if($id) { echo $builder_detail->representative_contact_no; }  ?></span>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <b>Representative Email Id:</b>
                                                <span><?php if($id) { echo $builder_detail->representative_email; }  ?></span>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <b>About Builder:</b>
                                                <span><?php if($id) { echo $builder_detail->about_builder; }  ?></span>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <b>Upload Logo:</b><br>
                                                
                                                <?php if($id && $builder_detail->builder_logo) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/logo/'.$builder_detail->builder_logo) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/logo/'.$builder_detail->builder_logo) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>

                                            <div class="col-md-12" style="margin-top: 10px;">
                                            	<h4>KYC:</h4>
                                            </div>

                                            
                                            <div class="form-group col-md-3 ">
                                                <b>CIN NO.</b>
                                                <span><?php if($id) { echo $builder_detail->cin_no; }  ?></span>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <b>Upload CIN Copy</b>
                                                <br>
                                                <?php if($id && $builder_detail->cin_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->cin_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->cin_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <b>TAN NO.</b>
                                                <span><?php if($id) { echo $builder_detail->tan_no; }  ?></span>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <b>Upload TAN Copy</b>
                                                <br>
                                                <?php if($id && $builder_detail->tan_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->tan_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->tan_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <b>PAN NO.</b>
                                                <span><?php if($id) { echo $builder_detail->pan_no; }  ?></span>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <b>Upload Pan Copy</b>
                                                <br>
                                                <?php if($id && $builder_detail->pan_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->pan_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->pan_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <b>GST No</b>
                                                <span><?php if($id) { echo $builder_detail->gst_no; }  ?></span>
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <b>Upload GST Copy</b>
                                                <br>
                                                <?php if($id && $builder_detail->gst_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->gst_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->gst_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>