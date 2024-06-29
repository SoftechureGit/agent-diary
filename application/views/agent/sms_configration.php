<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
    margin-top: 10px;
}
}
</style>

<?php include('include/sidebar.php');?>

        <!-- content body start -->
        <div class="content-body">

            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                      

                      <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title">SMS Configration</h4>
                                    </div>
                                </div>
                                <div class="basic-form">

                                        <div>
                                            
                                            <?php if($user_detail->no_of_sms<=500) { ?>

                                            <div class="alert alert-danger alert-dismissible fade show" style="padding-right: 15px;">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <?= $user_detail->no_of_sms ?> SMS Credits
                                                    </div>
                                                    <div class="col-md-3" align="right">
                                                  <a href="javascript:void(0)" class="btn btn-dark btn-sm" style="width: 80px;" title="Buy" onclick="alert('<?= $user_detail->no_of_sms ?> SMS Credits, please contact Admin')">Buy
                                                </a> </div>
                                                </div>
                                            </div>

                                            <?php } ?>

                                        </div>
                                        <div class="form-row">



                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>SMS Credits:</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= ($user_detail->no_of_sms)?$user_detail->no_of_sms:'0' ?>" disabled="">
                                            </div>


                                        </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- content body end -->



 <?php include('include/footer.php');?>
