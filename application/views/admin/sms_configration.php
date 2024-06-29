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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">

                      <?php 
                      $no_of_sms = 0;

                      // Account details
                      $apiKey = urlencode(TEXTLOCAL_KEY);
                   
                      // Message details
                      $numbers = array(8005756759);
                      $sender = urlencode('TXTLCL');
                      $message = urlencode('Hello');
                   
                      $numbers = implode(',', $numbers);
                   
                      // Prepare data for POST request
                      $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message, "test" => '1');
                   
                      // Send the POST request with cURL
                      $ch = curl_init('https://api.textlocal.in/send/');
                      curl_setopt($ch, CURLOPT_POST, true);
                      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($ch);
                      curl_close($ch);
                   
                      // Process your response here
                      $responseArray = json_decode($response, true);

                      if ($responseArray && isset($responseArray['balance']) && $responseArray['balance']) {
                          $no_of_sms = $responseArray['balance'];
                      }

                            ?>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title">SMS Configration</h4>
                                    </div>
                                </div>
                                <div class="basic-form">


                                    <div class="error-msg">
                                    	
                                    	<?php if($no_of_sms<=1000) { ?>

			                            <div class="alert alert-danger alert-dismissible fade show" style="padding-right: 15px;">
			                                <div class="row">
			                                    <div class="col-md-9">
			                                        <?= $no_of_sms ?> SMS Credits
			                                    </div>
			                                    <div class="col-md-3" align="right">
			                                  <a href="https://control.textlocal.in/order/" class="btn btn-dark btn-sm" style="width: 80px;" title="Buy">Buy
			                                </a> </div>
			                                </div>
			                            </div>

			                        <?php } ?>

                                    </div>

                                    <form id="form-main" method="post">
                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label>SMS Credits:</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $no_of_sms ?>" disabled="">
                                            </div> 

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content body end -->

 <?php include('include/footer.php');?>
 <!-- include jquery validation -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}
 
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, ""); 

 
</script>