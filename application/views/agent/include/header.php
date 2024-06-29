<?php 
$user_data = $this->Action_model->select_single('tbl_users',"user_hash='".$this->session->userdata('agent_hash')."'");
$menu_item_array = $this->Action_model->get_menu_items($user_data->user_id,$user_data->role_id); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Agent</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="<?php echo base_url('public/admin/') ?>plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/toast/css/jquery.toast.css">
    <!-- Custom Stylesheet -->
    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">

    <style>
        .header {
            height: 50px !important;
        }
        .nav-header {
            height: 106px !important;
        }
        .nk-sidebar  {
            top: 117px !important;
        }
        .s-hide {
            display: none;
        }
        .s-show {
            display: block;
        }
        .sb-show {
            display: inline-block;
        }
        .brand-logo {
            border-right: 1px solid #c5c5c529 !important;
            border-bottom: 1px solid #c5c5c529 !important;
            background: #fff;
        }
        @media only screen and (min-width: 768px) {
            .brand-logo {
            padding: 10px !important;
        }
        }
        .h50 {
            height: 106px !important;
        }
        .nav-header .brand-logo a {
    padding: 0px !important;
    padding-left: 0px !important;
}
        .header-right .icons .user-img img {
            height: 30px !important;
            width: 30px !important;
            vertical-align: text-top !important;
        }
        .header-right .icons > a i {
            vertical-align: middle !important;
        }

        .dropdown-profile,.dropdown-notfication {
            top: -30px !important;
        }

        @media only screen and (max-width: 768px) {
          .logo-abbr {
                height: 50px;
                padding-top: 15px;
                padding-left: 15px;            
            }
            .nk-sidebar {
                top: 50px !important;
                border-top: 1px solid #f2f2f8;
            }
            .nav-header {
                height: 50px !important;
            }
            .mtm {
                margin-top: 8px;
            }
            .username-desk {
                display: none !important;
            }
            .username-mob {
                display: block;
            }
        }

        @media only screen and (min-width: 768px) {
          .logo-abbr {
                height: 116px;
                padding-top: 39px;
            }
            .slimScrollDiv { 
            }
            .username-desk {
                display: block !important;
            }
            .username-mob {
                display: none;
            }
        }
        [data-nav-headerbg="color_1"] .nav-header {
            background-color: #f2f2f8 !important;
            box-shadow:none;
        }
        .btn-4 {
            margin-right: 4px;
        }
        .mr-10 {
            margin-right: 10px;
        }
        label.error {
            color: #a94442;
            font-weight: normal;
            margin-top: 4px;
          }

/*.content-body {
    min-height: 500px !important;
}*/
.dataTables_wrapper {
    padding: 0px !important;
}

.w-120 {
    width: 120px;
}
.w-90 {
    width: 90px;
}

.nk-nav-scroll::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 0px;
    background-color: transparent;
}

.nk-nav-scroll::-webkit-scrollbar
{
   width: 0px;
    background-color: transparent;
}

.nk-nav-scroll::-webkit-scrollbar-thumb
{
    border-radius: 0px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: transparent;
}
</style>

</head>

<body>


    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo" align="center">
                <a href="<?= base_url(AGENT_URL) ?>">
                    <b class="logo-abbr"><img src="<?php echo base_url('public/admin/') ?>images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="<?php echo base_url('public/front/images/logo.png') ?>" alt=""></span>
                    <span class="brand-title">
                        <img class="h50" src="<?php echo base_url('public/front/images/logo.png') ?>" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                  <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>

                </div>
                <div class="header-left">
                    
                    <div class="input-group icons">
                        
                       
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div>

                </div>


                <div class="header-right">
                    <ul class="clearfix">

                        <li class="icons dropdown username-desk"> Hi <?= $this->session->userdata('agent_name') ?></li>

                        <li class="icons dropdown"><a href="javascript:void(0)" >
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                             
                            </a>
                        
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                       <!-- <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>-->
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="<?php echo base_url('public/admin/images/');?>user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="username-mob"><span>Hi <?= $this->session->userdata('agent_name') ?></span></li>
                                        <?php if(isset($menu_item_array['setting_email_configration']) && $menu_item_array['setting_email_configration']['rr_view']) { ?>
                                        <li><a href="<?= base_url(AGENT_URL.'update-profile') ?>"><i class="icon-user"></i> <span>My Account</span></a></li>
                                        <?php } ?>
                                        <li><a href="<?= base_url(AGENT_URL.'change-password') ?>"><i class="icon-lock"></i> <span>Change Password</span></a></li>
                                        <li><a href="<?= base_url(AGENT_URL.'logout') ?>"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->