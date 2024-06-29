<!DOCTYPE html>
<html lang="en-US">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="csrf-token" content="Eh3qXyaTUPdXrwzf7mgtez7JwlPjTb5FyHOA40tD" />
	 <meta name="title" content="">
	 <meta name="keywords" content="">
     <title><?= SITE_TITLE ?></title>
     <link rel='stylesheet' href='<?= base_url('public/front') ?>/css/bootstrap.min.css' type='text/css' media='all' />
     <link rel='stylesheet' href='<?= base_url('public/front') ?>/css/style.css' type='text/css' media='all' />
     <link rel='stylesheet' href='<?= base_url('public/front') ?>/css/custom.css' type='text/css' media='all' />
     <link rel='stylesheet' href='<?= base_url('public/front') ?>/css/iconmoon.css' type='text/css' media='all' />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	 <!-- Owl Stylesheets -->
     <link rel="stylesheet" href="<?= base_url('public/front') ?>/css/owl.carousel.min.css">
     <link rel="stylesheet" href="<?= base_url('public/front') ?>/css/owl.theme.default.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>   
	 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	 <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	 <script src="<?= base_url('public/front') ?>/js/highlight.js"></script>
	 <script src="<?= base_url('public/front') ?>/js/owl.carousel.js"></script>
     <script src="<?= base_url('public/front') ?>/js/fastselect.standalone.js"></script>
     <!-- bricks-slider -->
     <link rel="stylesheet" href="<?= base_url('public/front') ?>/css/slider.css">
     <link rel="stylesheet" href="<?= base_url('public/front') ?>/css/homeCityGroup.css">
     <link rel="stylesheet" href="<?= base_url('public/front') ?>/css/swiper.css">
     <link rel="shortcut icon" href="<?= base_url('public/front') ?>/images/logo.png" type="image/x-icon">

     <style>
      .msg-sucess {
        display: none;
      }
        .logo {
          padding-top: 5px;
        }
       @media only screen and (min-width: 768px){
        .header-contact-holder {
          padding-top: 32px;
        }
       }
       @media only screen and (max-width: 768px){
        .logo {
          padding-top: 15px;
        }
        nav#sideNav {
          display: none;
        }
        .contact-info {
          margin-top: 10px;
        }
        .emailid {
          margin-top: 10px;
        }
       }

     </style>
     
     
	<script>
		ASSET_URL = 'http://agentdairy.com/';
		BASE_URL='http://agentdairy.com/';
	</script>
	
</head><body id="main" class="home page-template-default page page-id-71 wp-rem wp-rem-icon-hidden">
<header>

<div class="main-header" style="border-bottom:1px solid #e7eced;">
    <div class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-5">
			<div class="logo"> <a href="<?= base_url() ?>"> <img src="<?= base_url('public/front') ?>/images/logo.png" alt="<?= SITE_TITLE ?>"> </a> </div>
			  </div>
          <div class="col-lg-9 col-md-9 col-sm-6 col-xs-7">
            <div class="contact-holder header-contact-holder"><span class="emailid"><small>Email</small> <span><?= $agent_detail->email ?></span></span> <span class="contact-info"> <small>Call for Enquiry</small> <span> +91 <?= $agent_detail->mobile ?></span></span>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>




<link href="<?= base_url('public/front') ?>/assets/css/style.min.css" rel="stylesheet">
<link href="<?= base_url('public/front') ?>/assets/css/material-kit.css" rel="stylesheet">