        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll" style="overflow: scroll;">
                <ul class="metismenu" id="menu">

                    <!--  Raw Data -->
                    <?php if(isset($menu_item_array['raw_data']) && $menu_item_array['raw_data']['rr_view']) { ?>  
                    <li>
                        <a href="<?= base_url(AGENT_URL.'data/') ?>" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i> <span class="nav-text">Data</span>
                        </a>
                       
                    </li>
                    <?php } ?>
                    <!-- End Raw Data  -->


                    <?php if(isset($menu_item_array['leads']) && $menu_item_array['leads']['rr_view']) { ?>
                    <!-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Leads</span>
                        </a>
                        <ul aria-expanded="false">
                            <?php if(isset($menu_item_array['leads']) && $menu_item_array['leads']['rr_create']) { ?>
                            <li><a href="<?= base_url(AGENT_URL.'lead-detail/') ?>">Add New Lead</a></li>
                             <?php } ?>
                            <?php if(isset($menu_item_array['leads']) && $menu_item_array['leads']['rr_view']) { ?>
                            <li><a href="<?= base_url(AGENT_URL.'leads/') ?>">Lead List</a></li>
                            <?php } ?>

                        </ul>
                    
                    </li> -->
                    <?php } ?>

                    <li>
                        <a href="<?= base_url(AGENT_URL.'leads') ?>" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i> <span class="nav-text">Leads</span>
                        </a>
                       
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-graph menu-icon"></i><span class="nav-text">Inventory</span>
                        </a>
                        <ul aria-expanded="false">
                            <?php if(isset($menu_item_array['product_list']) && $menu_item_array['product_list']['rr_view']) { ?>
                            <li><a href="<?= base_url(AGENT_URL.'products/') ?>">Inventory</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['product_project']) && $menu_item_array['product_project']['rr_view']) { ?>
                            <li><a class="d-none" href="<?= base_url(AGENT_URL.'projects/') ?>">Project</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['product_property']) && $menu_item_array['product_property']['rr_create']) { ?>
                            <li><a class="d-none" href="<?= base_url(AGENT_URL.'property-detail/') ?>">Add Project</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['product_property']) && $menu_item_array['product_property']['rr_view']) { ?>
                            <li><a class="d-none" href="<?= base_url(AGENT_URL.'property/') ?>">Properties</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['product_manage_inventory']) && $menu_item_array['product_manage_inventory']['rr_view']) { ?>
                            <li><a href="<?= base_url(AGENT_URL.'manage-inventory/') ?>">Manage Inventory</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['product_update_inventory']) && $menu_item_array['product_update_inventory']['rr_view']) { ?>
                            <li><a class="d-none" href="<?= base_url(AGENT_URL.'update-inventory-status/') ?>">Update Inventory Status</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['product_update_ad_cost']) && $menu_item_array['product_update_ad_cost']['rr_view']) { ?>
                            <li><a class="d-none" href="<?= base_url(AGENT_URL.'update-additional-cost/') ?>">Update Aditional Charges</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['product_update_basic_cost']) && $menu_item_array['product_update_basic_cost']['rr_view']) { ?>
                            <li><a class="d-none" href="<?= base_url(AGENT_URL.'update-basic-cost/') ?>">Update Baisc Cost</a></li>
                            <?php } ?>

                        </ul>
                    
                    </li>
                  
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">Report</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?= base_url(AGENT_URL.'requirements/') ?>">Requirement</a></li>
                            <li><a href="#">Preformance Report</a></li>
                            <li><a href="<?= base_url(AGENT_URL.'site-visit-report/') ?>">Site Visit Report</a></li>
                            <li><a href="<?= base_url(AGENT_URL.'booking-report/') ?>">Booking Report</a></li>

                        </ul>
                    
                    </li>

                    <?php if(isset($menu_item_array['customer']) && $menu_item_array['customer']['rr_view']) { ?>
                    <li>
                        <a href="<?= base_url(AGENT_URL.'customers/') ?>" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Customers</span>
                        </a>
                       
                    </li>
                    <?php } ?>

                    <?php if(isset($menu_item_array['chat']) && $menu_item_array['chat']['rr_view']) { ?>
                    <li>
                        <a href="<?= base_url(AGENT_URL.'tickets/') ?>" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Chat</span>
                        </a>
                       
                    </li>
                    <?php } ?>
                    
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Setting</span>
                        </a>
                        <ul aria-expanded="false">
                            
                            <?php if(isset($menu_item_array['teams']) && $menu_item_array['teams']['rr_view']) { ?>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><span class="nav-text">Team</span>
                                </a>
                                <ul aria-expanded="false">
                                    <?php if($menu_item_array['teams']['rr_create']) { ?>
                                    <li><a href="<?= base_url(AGENT_URL.'teams?action=add') ?>">Add Team</a></li>
                                    <?php } ?>

                                    <?php if($menu_item_array['teams']['rr_view']) { ?>
                                    <li><a href="<?= base_url(AGENT_URL.'teams') ?>">Team List</a></li>
                                    <?php } ?>

                                    <!--<?php if($menu_item_array['roles']['rr_view']) { ?>
                                    <li><a href="<?= base_url(AGENT_URL.'roles') ?>">Roles</a></li>
                                    <?php } ?>-->
                                </ul>
                            </li>
                            <?php } ?>

                            <?php if(isset($menu_item_array['setting_sms_configration']) && $menu_item_array['setting_sms_configration']['rr_view']) { ?>

                                <li><a href="<?= base_url(AGENT_URL.'sms-configration') ?>">SMS Configration</a></li>
                                <li><a href="<?= base_url(AGENT_URL.'whatsapp-configration') ?>">Whatsapp Configration</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['setting_email_configration']) && $menu_item_array['setting_email_configration']['rr_view']) { ?>
                                <li><a href="<?= base_url(AGENT_URL.'email-configration') ?>">Email Configration</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['setting_online_portal_api']) && $menu_item_array['setting_online_portal_api']['rr_view']) { ?>
                            <li><a href="#">Online Portal Api</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['setting_auto_dialer_option']) && $menu_item_array['setting_auto_dialer_option']['rr_view']) { ?>
                            <li><a href="#">Auto Dialer Option</a></li>
                            <?php } ?>
                            <?php if(isset($menu_item_array['setting_my_account']) && $menu_item_array['setting_my_account']['rr_view']) { ?>
                            <li><a href="<?= base_url(AGENT_URL.'update-profile') ?>">My Account </a></li>
                            <li><a href="<?= base_url(AGENT_URL.'invoice') ?>">Invoice </a></li>
                            <?php } ?>

                            <li><a href="<?= base_url(AGENT_URL.'templates') ?>">Templates</a></li>

                            <!-- <?php if(isset($menu_item_array['project']) && $menu_item_array['project']['rr_view']) { ?>
                            <li><a href="#">Templet </a></li>
                            <?php } ?> -->

                        </ul>
                    </li>
                    
                  
                 
                    <li>
                        <a href="<?= base_url(AGENT_URL.'logout') ?>" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Logout</span>
                        </a>
                       
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->