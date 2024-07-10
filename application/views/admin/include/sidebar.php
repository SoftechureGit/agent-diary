        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll" style="/*background-color: red;overflow-y: scroll;height: 500px;*/">
                <ul class="metismenu" id="menu">

                    <?php // if(isset($menu_item_array['customer']) && $menu_item_array['customer']['rr_view']==1) { ?>
                    <li>
                        <a href="<?php echo base_url(ADMIN_URL.'customers');?>" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Customers</span>
                        </a>
                       
                    </li>
                    <?php //} ?>

                    <!--<li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Lead</span>
                        </a>
                        
                    </li>-->
                   
                    <?php // if(isset($menu_item_array['finances']) && $menu_item_array['finances']['rr_view']==1) { ?>
                    <li>
                        <a href="<?= base_url(ADMIN_URL.'agents') ?>" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Agent</span>
                        </a>
                       
                    </li>
                    <?php //} ?>

                    <?php // if(isset($menu_item_array['finances']) && $menu_item_array['finances']['rr_view']==1) { ?>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Builders</span>
                        </a>
                        <ul aria-expanded="false">
                            <?php //  if(isset($menu_item_array['finances']) && $menu_item_array['finances']['rr_create']==1) { ?>
                            <li><a href="<?= base_url(ADMIN_URL.'builder-detail') ?>">Add New Builder</a></li>
                            <?php //} ?>
                            <li><a href="<?= base_url(ADMIN_URL.'builders') ?>">Builder List</a></li>
                        </ul>
                    </li>
                    <?php //  } ?>

                    <?php // if(isset($menu_item_array['followup']) && $menu_item_array['followup']['rr_view']==1) { ?>


                    <li>
                        <a href="<?php echo base_url(ADMIN_URL.'leads');?>" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Leads</span>
                        </a>
                       
                    </li>
                    <li>
                        <a href="<?= base_url(ADMIN_URL.'followup') ?>" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i> <span class="nav-text">Followup</span>
                        </a>
                       
                    </li>
                    <?php //  } ?>

                    <!--<li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Followup</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?= base_url(ADMIN_URL.'prospects') ?>">Prospects</a></li>
                            <li><a href="<?= base_url(ADMIN_URL.'products') ?>">Customer Followup</a></li>
                            <li><a href="<?= base_url(ADMIN_URL.'builder-follow-up') ?>">Builder Followup</a></li>
                        </ul>
                    </li>-->

                    <?php // if(isset($menu_item_array['products']) && $menu_item_array['products']['rr_view']==1) { ?>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-graph menu-icon"></i><span class="nav-text">Manage Product</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?= base_url(ADMIN_URL.'product-detail') ?>">Add New Project</a></li>
                            <li><a href="<?= base_url(ADMIN_URL.'products?type=project') ?>">Project List</a></li>
                            <li><a href="<?= base_url(ADMIN_URL.'property-products') ?>">Product List</a></li>
                        </ul>
                    </li>
                    <?php //  } ?>
                    
                    <?php // if(isset($menu_item_array['report']) && $menu_item_array['report']['rr_view']==1) { ?>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">Report</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?= base_url(ADMIN_URL.'transactions') ?>">Transactions</a></li>
                        </ul>
                    
                    </li>
                    <?php //  } ?>

                    <?php // if(isset($menu_item_array['agent_chat']) && $menu_item_array['agent_chat']['rr_view']==1) { ?>
                    <li>
                        <a href="<?= base_url(ADMIN_URL.'tickets') ?>" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Agent Chat</span>
                        </a>
                    </li>
                    <?php //  } ?>
                    
                    <?php // if(isset($menu_item_array['setting'])) { ?>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Setting</span>
                        </a>
                        <ul aria-expanded="false">
                            <?php // if(isset($menu_item_array['package'])) { ?>
                            <li><a href="#">Package</a></li>
                            <?php //  } ?>

                            <?php // if(isset($menu_item_array['payment_api'])) { ?>
                            <li><a href="#">Payment API</a></li>
                            <?php //  } ?>

                            <!--<?php // if(isset($menu_item_array['teams'])) { ?>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><span class="nav-text">Team</span>
                                </a>
                                <ul aria-expanded="false">
                                    <?php // if($menu_item_array['teams']['rr_create']) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'teams?action=add') ?>">Add Team</a></li>
                                    <?php //  } ?>

                                    <?php // if($menu_item_array['teams']['rr_view']) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'teams') ?>">Team List</a></li>
                                    <?php //  } ?>

                                    <?php // if($menu_item_array['roles']['rr_view']) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'roles') ?>">Roles</a></li>
                                    <?php //  } ?>

                                    <?php // if($menu_item_array['modules']['rr_view']) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'modules') ?>">Modules</a></li>
                                    <?php //  } ?>
                                </ul>
                            </li>
                            <?php //  } ?>-->

                            <?php // if(isset($menu_item_array['sms_configration'])) { ?>
                            <li><a href="<?= base_url(ADMIN_URL.'sms-configration') ?>">SMS Configration</a></li>
                            <?php //} ?>
                            
                            <li><a href="<?= base_url(ADMIN_URL.'general-setting') ?>">General Setting</a></li>
                            
                            <?php // if(isset($menu_item_array['masters'])) { ?>
                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">Masters</span></a>
                                <ul aria-expanded="false">
                                    <?php // if(isset($menu_item_array['lead_types'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'lead-types') ?>">Lead Status</a></li>
                                    <?php //  } ?>

                                    <?php // if(isset($menu_item_array['lead_sources'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'lead-sources') ?>">Lead Source </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['lead_stages'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'lead-stages') ?>">Lead Stage </a></li>
                                    <?php //  } ?>

                                    <li><a href="<?= base_url(ADMIN_URL.'lead-actions') ?>">Lead Action</a></li>
                                    
                                    <?php // if(isset($menu_item_array['task_actions'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'task-actions') ?>">Task Action </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['units'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'units') ?>">Unit </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['departments'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'departments') ?>">Department </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['locations'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'state-and-city') ?>">State & City </a></li>
                                    <?php //  } ?>

                                    <?php // if(isset($menu_item_array['locations'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'locations') ?>">Location </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['occupations'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'occupations') ?>">Occupation </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['product_types'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'product-types') ?>">Product Type </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['unit_types'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'unit-types') ?>">Unit Type </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['price_components'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'price-components') ?>">Price Component </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['firm_types'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'firm-types') ?>">Firm Type </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['property_types'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'property-types') ?>">Property Type </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['builder_groups'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'builder-groups') ?>">Builder Group </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['accomodations'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'accomodations') ?>">Accomodations </a></li>
                                    <?php //  } ?>
                                    
                                    <?php //if(isset($menu_item_array['floors'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'floors') ?>">Floors </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['facings'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'facings') ?>">Facing </a></li>
                                    <?php //} ?>
                                    
                                    <?php //if(isset($menu_item_array['specifications'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'specifications') ?>">Specification </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['amenities'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'amenities') ?>">Amenities </a></li>
                                    <?php //  } ?>
                                    
                                    <?php // if(isset($menu_item_array['finances'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'finances') ?>">Finance Components</a></li>
                                    <?php //  } ?>

                                    <?php //if(isset($menu_item_array['authorities'])) { ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'authorities') ?>">Authorities</a></li>
                                    <?php //} ?>
                                    <li><a href="<?= base_url(ADMIN_URL.'budgets') ?>">Budgets</a></li>
                                    <li><a href="<?= base_url(ADMIN_URL.'designations') ?>">Designations</a></li>
                                    <li><a href="<?= base_url(ADMIN_URL.'construction_ages') ?>">Construction Age</a></li>
                                    <li><a href="<?= base_url(ADMIN_URL.'ideal_business') ?>">Ideal Business</a></li>
                                    <li><a href="<?= base_url(ADMIN_URL.'furnishings') ?>">Furnishings</a></li>
                                    <li><a href="<?= base_url(ADMIN_URL.'templates') ?>">Templates</a></li>
                                </ul>
                                </li>
                            <?php //  } ?>
                    </ul>
                    </li>
                    <?php //  } ?>
                    
                  
                 
                    <li style="padding-bottom: 80px;">
                        <a href="<?= base_url(ADMIN_URL.'logout') ?>" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Logout</span>
                        </a>
                       
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->