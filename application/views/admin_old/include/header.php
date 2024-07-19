<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Softechure Admin Panel</title>
    <link href="<?php echo base_url('public') ?>/admin/logo.png" rel="shortcut icon" type="image/png">
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/') ?>main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">
       <a class="pull-left" href="<?php echo base_url(''); ?>">
          
       </a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
           
            <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">

      <ul class="app-menu">
        <li><a class="app-menu__item active" href="<?php echo base_url(ADMIN_URL) ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">News</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/news-list') ?>"><i class="icon fa fa-circle-o"></i>List News</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/news-single') ?>"><i class="icon fa fa-circle-o"></i>Add News</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">News Category</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/news-category-list') ?>"><i class="icon fa fa-circle-o"></i>List news category</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/news-category-single') ?>"><i class="icon fa fa-circle-o"></i>Add news category</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Courses</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/courses-list') ?>"><i class="icon fa fa-circle-o"></i>List Courses</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/add_courses') ?>"><i class="icon fa fa-circle-o"></i>Add Courses</a></li>
          </ul>
        </li>

        <!--<li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Event Category</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/event-list') ?>"><i class="icon fa fa-circle-o"></i>List Events</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/event-single') ?>"><i class="icon fa fa-circle-o"></i>Add Event</a></li>
          </ul>
        </li>

        <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Gallery</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/gallery-list') ?>"><i class="icon fa fa-circle-o"></i>List gallery</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/gallery-single') ?>"><i class="icon fa fa-circle-o"></i>Add gallery</a></li>
          </ul>
        </li>

        <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-video-camera"></i><span class="app-menu__label">Video</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/video-list') ?>"><i class="icon fa fa-circle-o"></i>List Video</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/video-single') ?>"><i class="icon fa fa-circle-o"></i>Add Video</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Gallery Category</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/gallery-category-list') ?>"><i class="icon fa fa-circle-o"></i>List gallery category</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/gallery-category-single') ?>"><i class="icon fa fa-circle-o"></i>Add gallery category</a></li>
          </ul>
        </li>

         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Slider</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/slider') ?>"><i class="icon fa fa-circle-o"></i>List Slides</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/addslider') ?>"><i class="icon fa fa-circle-o"></i>Add Slide</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Leaders</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/leader-list') ?>"><i class="icon fa fa-circle-o"></i>List Leaders</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/leader-single') ?>"><i class="icon fa fa-circle-o"></i>Add Leader</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Experts</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/experts') ?>"><i class="icon fa fa-circle-o"></i>List Expert</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/expert-single') ?>"><i class="icon fa fa-circle-o"></i>Add Expert</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Famous Personalities</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/famous-personalities') ?>"><i class="icon fa fa-circle-o"></i>List Personalities</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/famous-single') ?>"><i class="icon fa fa-circle-o"></i>Add Personalities</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Sponser</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/sponsers') ?>"><i class="icon fa fa-circle-o"></i>List Sponser</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/sponser-single') ?>"><i class="icon fa fa-circle-o"></i>Add Sponser</a></li>
          </ul>
        </li>
        
         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">News Pdf</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/news-pdf-list') ?>"><i class="icon fa fa-circle-o"></i>List Pdf</a></li>
            <li><a class="treeview-item" href="<?php echo base_url(ADMIN_URL.'/news-pdf-single') ?>"><i class="icon fa fa-circle-o"></i>Add Pdf</a></li>
          </ul>
        </li>

        <li><a class="app-menu__item" href="<?php echo base_url(ADMIN_URL.'/submit-news') ?>"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Submit News</span></a></li>

   

        <li><a class="app-menu__item" href="<?php echo base_url(ADMIN_URL.'/join-request') ?>"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Join Request</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(ADMIN_URL.'/matrimony') ?>"><i class="app-menu__icon fa fa-life-ring"></i><span class="app-menu__label">Matrimony</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(ADMIN_URL.'/employment-request') ?>"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Employment Request</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(ADMIN_URL.'/commenting-user') ?>"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Commenting Users </span></a></li>-->
        
             <li><a class="app-menu__item" href="<?php echo base_url(ADMIN_URL.'/user-list') ?>"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">User Query</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url('logout') ?>"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Logout</span></a></li>

      </ul>
    </aside>
