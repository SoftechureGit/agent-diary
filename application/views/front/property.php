<?php include 'include/header.php' ?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top nav-down" id="sideNav"> <!--<a class="navbar-brand js-scroll-trigger mx-auto img-left" href="#page-top"> <span class="mb-logo"></span> <span class="d-lg-block img-left"> <img class="img-fluid project-logo" src="<?= base_url('uploads/images/project/logo/'.$product_detail->project_logo) ?>" alt="image" width="14" height="56"> </span> </a>-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
  <div class="collapse navbar-collapse my-auto" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#properties">Properties Available</a></li>
      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#overview">Overview</a></li>
      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#amenities">Amenities</a></li>
      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#specifications">Specifications</a></li>
      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a></li>
      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#mapview">Map View</a></li>
      <li class="nav-item"><a class="nav-link js-scroll-trigger pb-0" href="#aboutus">About the Builder</a></li>
    </ul>
  </div>
</nav>


<div class="container-fluid p-0">
<section class="content-section-header hero-background d-flex d-column fcw top">
<div class="z1 blurbox">
<div class="snapshot">
<div>
<h1 class="mb-0"><?= $product_detail->project_name ?></h1>
<div class="subheading">
<span>By <span class="fbold mr-0"> <?= $product_detail->builder_group_name ?> </span></span>
<span>@ <?= $product_detail->location_name ?> , <?= $product_detail->city_name ?> </span>
<br>
  <span class="br"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="6.804px" height="10.02px" viewBox="0 0 6.804 10.02" enable-background="new 0 0 6.804 10.02" xml:space="preserve">
<path fill="#ffffff" d="M4.53,0.946h1.644l0.63-0.947H0.63l-0.63,0.947h1.07c1.087,0,2.088,0.084,2.489,0.992H0.629l-0.63,0.945
h3.678c0,0.003,0,0.006,0,0.008c0,0.68-0.565,1.724-2.431,1.724H0.342l0.001,0.883l3.617,4.522H5.57L1.826,5.342
c1.542-0.083,2.987-0.945,3.194-2.458h1.151l0.631-0.946H5.006C4.934,1.572,4.777,1.22,4.53,0.946z"/>
</svg>


<span class="fbold"><?= $onwards ?></span> onwards</span>
  
<span>&bull; Area: <span class="fbold">_____-_____</span></span>

<span class="d-block">&bull; Possession : <span class="fbold">14 Jun 2021</span> </span>
</div>
<!--<div class="highlights">
<span class="project-highlights text-color">Highlights</span>
<ul>
<li>Power backup for common areas</li>
<li>Opp. Taurus Down Town Mall </li>
</ul>
</div>-->

    
    

<!--<a href="#" id="link_wishlist" class="btn1">Add To Wishlist<svg class="arrow" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="9.685px" viewBox="0 0 21 9.685" enable-background="new 0 0 21 9.685" xml:space="preserve">
<polygon id="Shape1" fill="#009de5" style="text-color" stroke="#009de5" stroke-width="0.5" points="20.469,4.846 15.797,0.349 15.596,0.543 
19.912,4.711 0.469,4.711 0.469,4.986 19.912,4.986 15.596,9.154 15.797,9.349 "/>
</svg>
</a>--></div></div>
<div id="scroll"><a class="js-scroll-trigger" href="#properties"><svg width="14px" height="45px" viewBox="0 0 17 40" version="1.1"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.701200181"><g id="6" transform="translate(-631.000000, -739.000000)" fill-rule="nonzero" fill="#FFFFFF"><g id="Group" transform="translate(631.000000, 739.000000)"><path d="M1.41666667,8.5767155 L1.41666667,8.5767155 L1.41666667,21.4232845 C1.41666667,25.3727396 4.58733213,28.5714286 8.5,28.5714286 C12.4124705,28.5714286 15.5833333,25.3716791 15.5833333,21.4232845 L15.5833333,8.5767155 C15.5833333,4.62726036 12.4126679,1.42857143 8.5,1.42857143 C4.58752955,1.42857143 1.41666667,4.62832086 1.41666667,8.5767155 L1.41666667,8.5767155 Z M0,8.5767155 C0,3.83992636 3.80454744,0 8.5,0 C13.1944204,0 17,3.83762536 17,8.5767155 L17,21.4232845 C17,26.1600736 13.1954526,30 8.5,30 C3.80557963,30 0,26.1623746 0,21.4232845 L0,8.5767155 L0,8.5767155 Z" id="Shape2"></path><path d="M7.79166667,5 L7.79166667,7.85714286 C7.79166667,8.25163193 8.10879834,8.57142857 8.5,8.57142857 C8.89120166,8.57142857 9.20833333,8.25163193 9.20833333,7.85714286 L9.20833333,5 C9.20833333,4.60551093 8.89120166,4.28571429 8.5,4.28571429 C8.10879834,4.28571429 7.79166667,4.60551093 7.79166667,5 L7.79166667,5 Z" id="Shape2"></path><path id="arrow-path" d="M8.5,37.8521385 L12.395718,33.9236834 C12.6723394,33.6447374 13.1208313,33.6447374 13.3974527,33.9236834 C13.674074,34.2026293 13.674074,34.65489 13.3974527,34.9338359 L9.00086732,39.3673674 C8.86255659,39.5068403 8.6812783,39.5765768 8.5,39.5765768 C8.3187217,39.5765768 8.13744341,39.5068403 7.99913268,39.3673674 L3.56885179,34.8998573 C3.29223041,34.6209114 3.29223041,34.1686506 3.56885179,33.8897047 C3.84547317,33.6107588 4.29396505,33.6107588 4.57058643,33.8897047 L8.5,37.8521385 Z"></path></g></g></g></svg> <span class="shine">Scroll down to see more</span></a></div>
</div>
<div class="hero-img blurbox">
<div data-ride="carousel" class="carousel carousel-fade" id="carousel-example-captions">
<div role="listbox" class="carousel-inner">
<div class="carousel-item active">
<div class="slide-1"><img alt="" src="<?= base_url('uploads/images/project/banner/'.$product_detail->banner_image) ?>"></div>
</div>
</div>
</div>
</div>
</section>


<section class="content-section d-flex flex-column" id="properties">
<div><a class="card-title">Properties <span>You Can Buy</span></a></div>
<div class="card-section no-mobile-padding">
<div class="tab-value">
<ul class="nav nav-tabs unittab">
<?php $i=0; foreach ($product_accomodations as $product_accomodation_row) { ?>
<li class="item"><a data-toggle="tab" href="#BHK<?= $product_accomodation_row->accomodation_id ?>"  class="<?= ($i==0)?'active':'' ?>"  ><?= $product_accomodation_row->accomodation_name ?></a></li>
<?php $i++; } ?>
<!--<li class="item"><a data-toggle="tab" href="#2bhk">3 BHK</a></li>-->
</ul>
</div>
<div class="tab-content">

<?php $i=0; foreach ($product_accomodations as $product_accomodation_row) { ?>
<div id="BHK<?= $product_accomodation_row->accomodation_id ?>"  class="tab-pane fade <?= ($i==0)?'in active show':'' ?>"  >
<div class="sub-tab-container">
<ul class="nav nav-tabs owl-carousel  owl-unitdetail">
<?php $j=0; foreach ($product_accomodation_row->product_unit_details as $product_unit_row) { ?>
<li class="item"><a data-toggle="tab"  class="<?= ($j==0)?'active':'' ?>"  href="#BHK<?= $product_accomodation_row->accomodation_id ?>_detail_<?= $product_unit_row->product_unit_detail_id ?>"><?php if($product_unit_row->property_type==2) { echo $product_unit_row->plot_size.' '.$product_unit_row->plot_size_unit_name; } else { echo $product_unit_row->sa.' '.$product_unit_row->m_unit_name; }   
  ?>
</a></li>
<?php $j++; } ?>
</ul>
</div>
<div class="tab-content">

<?php $j=0; foreach ($product_accomodation_row->product_unit_details as $product_unit_row) { ?>
<div id="BHK<?= $product_accomodation_row->accomodation_id ?>_detail_<?= $product_unit_row->product_unit_detail_id ?>"  class="tab-pane fade <?= ($j==0)?'in active show':'' ?>" >
<div class="container">
<div class="tabpaneContainer row ">
<div class="col-lg-4 col-md-4 col-12 nopadding">
<div class="thumbnail imghvr-zoom-in">
<a href="<?= base_url('uploads/images/property/unit/'.$product_unit_row->image) ?>" class="js-img-viwer-floorplan" data-caption="3 BHK , 77.77 Sq.Yd" data-id="raion"><img src="<?= base_url('uploads/images/property/unit/'.$product_unit_row->image) ?>" alt="image" width="100%"><i class="sp1 zoom"></i></a></div>
</div>
<div class="col-lg-8 col-md-8 col-12 nopadding">
<div class="unit-detail-container">
<div class="row"><ul class="property-type-detaiil"><li><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="8.804px" height="12.02px" viewBox="0 0 6.804 10.02" enable-background="new 0 0 6.804 10.02" xml:space="preserve"> <path fill="#010101" d="M4.53,0.946h1.644l0.63-0.947H0.63l-0.63,0.947h1.07c1.087,0,2.088,0.084,2.489,0.992H0.629l-0.63,0.945  h3.678c0,0.003,0,0.006,0,0.008c0,0.68-0.565,1.724-2.431,1.724H0.342l0.001,0.883l3.617,4.522H5.57L1.826,5.342  c1.542-0.083,2.987-0.945,3.194-2.458h1.151l0.631-0.946H5.006C4.934,1.572,4.777,1.22,4.53,0.946z"/> </svg>
 <?= $product_unit_row->budget ?><span>Onwards</span></li>
<li><?= $product_unit_row->unit_type_name ?><span><?php if($product_unit_row->property_type==2) { echo $product_unit_row->plot_size.' '.$product_unit_row->plot_size_unit_name; } else { echo $product_unit_row->sa.' '.$product_unit_row->m_unit_name; }  
  ?></span></li>
</ul>
</div>
<div class="FloorDetail">
<ul class="col-12 col-sm-12 nopadding nopadding-mobile">
<li><span>Plot Size <b><?= $product_unit_row->plot_size.' '.$product_unit_row->plot_size_unit_name ?></b></span></li>
<li><span>Construction Area <b><?= $product_unit_row->construction_area.' '.$product_unit_row->con_unit_name ?></b></span></li>
<li><span>No Of Floor <b><?= $product_unit_row->no_of_floor ?></b></span></li>
<li><span> Facing <b><?= $product_unit_row->facing_title ?></b></span></li>
<li><span>Bedrooms <b><?= $product_unit_row->no_of_bedroom ?></b></span></li>
<li><span>Bathrooms <b><?= $product_unit_row->no_of_bathroom ?></b></span></li>
</ul>
</div>

<div>

<a href="<?= base_url('inventory/'.$this->uri->segment(2).'/'.$this->uri->segment(3)) ?>" class="cta-btn border-color text-color">Inventory</a>
<a data-toggle="modal" data-target="#mobileModal_1" href="#mobileModal_1" class="cta-btn border-color text-color" onclick="fireGaForMicrosite('CTA2')">Payment Plan</a>
</div></div></div></div></div>
</div>
<?php $j++; } ?>


</div>
</div>

<?php $i++; } ?>

</div>
</div>
</section>
 



<section class="content-section d-flex flex-column" id="overview">
<div>
<a class="card-title"> <span><?= $product_detail->project_name ?></span> Overview</a>
<div class="card-section  padding30">
<div class="container nopadding">
<div class="row">
<div class="col nopadding img-overview">
<img class="img-fluid img-round" src="<?= base_url('uploads/images/project/logo/'.$product_detail->project_logo) ?>" alt="<?= $product_detail->project_name ?>" width="350" height="225"></div>
<div class="col-lg-7 col-md-7 col-12 nopadding nopadding-mobile mml-10">
<p class="overview overview-text">
</p>
</div>
</div>
<div class="roundborder overview-detail mt-30">
<ul class="over-detail">
<!--<li> Total No. of Floors <span class="s-bold"> G+14 Floors</span></li>
<li> Project Area <span class="s-bold">  Acres</span></li>-->
<li> Authority Approval <span class="s-bold"> <?= $product_detail->authority_name ?> </span></li>
<li> CC Certificate* <span class="s-bold"> <?= ($product_detail->cc_certificate)?"Yes":"No" ?></span></li>
<li> OC Certificate* <span class="s-bold"> <?= ($product_detail->oc_certificate)?"Yes":"No" ?> </span></li>
</ul>
</div>
<div class="row">
<div class="col gray-color text-right nopadding mt-2">
<span><strong>*OC </strong> - Occupancy Certificate</span> <span> <strong>*CC </strong> - Commencement Certificate</span>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="content-section d-flex flex-column" id="amenities">
<div>
<a class="card-title"> <span>Exclusive </span> Amenities</a>
<div class="card-section">
<div class="amenities-box">
<div class="white-gradient"></div>
<div class="owl-amenities-custom">
<div class="row">

<?php foreach ($product_amenities as $row) { ?>
<div class="col-md-3 col-sm-3 col-xs-4">
<div class="item">
<div class="row">
<ul class="amenities-list">


<li>
<span class="icon"><img src="<?= base_url('uploads/images/amenitie/'.$row->amenitie_image) ?>" alt="<?= $row->amenitie_name ?>" class="img-fluid"></span> <span class="am-txt"><?= $row->amenitie_name ?></span></li>


</ul>
</div>
</div>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</section>
<section class="content-section d-flex flex-column" id="specifications">
<div>
<a class="card-title"> <span>Project </span> Specifications</a>
<div class="card-section">
<div class="specification-box">
<div class="white-gradient"></div>
<div class="owl-carousel owl-specifications">

 <?php foreach ($product_specifications as $row) { ?> 
<div class="item">
<div class="row">
<div class="col nopadding"><span class="specification-title"><?= $row->specification_name ?></span></div>
</div>
<div class="row">
<div class="padding30 roundborder">
<ul class="specification-ul">
<li><p><?= $row->description ?></p>
</li>
</ul>
</div>
</div>
</div>
<?php } ?>



</div>
</div>
</div>
</div>
</section>
<section class="content-section flex-column" id="gallery">
<div><a class="card-title"> <span>Take a </span> Closer Look</a>
<div class="card-section">
<div class="gallery-box  padding30 nopadding-mobile">
<div id="galley">
<ul class="owl-carousel owl-gallery">

<?php foreach ($product_images as $product_image) { ?>
<li class="item">
<span class="thumb2">
<a href="<?= base_url('uploads/images/project/image/'.$product_image->product_image) ?>" class="js-img-viwer" data-caption="Project Name" data-id="raion"><img src="<?= base_url('uploads/images/project/image/'.$product_image->product_image) ?>" alt="Project Name"> </a>
</span>
</li>
<?php } ?>


</ul>
</div>
</div>
<div class="row">
</div>
</div>
</div>
</section>
<section class="content-section  flex-column" id="emicalculator" style="display: none;">
<div>
<a class="card-title"> <span class="bank-title-mobile">Bank Approvals</span><span class="bank-title-web"> EMI <span>Calculator </span></span> </a>
<div class="card-section padding30">
<div class="row"><div class="col-12 data_section emiSec hidden-xs" id="calculator"><div class="row"><div class=" sc-section nopadding"><div class="emisliderCon"><div class="flw"><ul><li class="loanAmount"><div class="flw"><h4>Home Loan Amount:<span><div class="input-group"><span class="input-group-addon rs_ic fa fa-inr" style="line-height:35px"></span><input type="text" id="amount"/></div></span></h4></div><div class="flw"><p class="textINword amountText"></p></div><div class="flw slideText"><div id="principleAmt"></div><span>0</span><span class="m1">25L</span><span class="m2">50L</span><span class="m3">75L</span><span class="m4">100L</span><span class="m5">125L</span><span class="m6">150L</span><span class="m7">175L</span><span class="m8">200L</span></div></li><li class="interestRate"><div class="flw"><h4>Rate of Interest:<span><div class="input-group"><input type="text" id="interest" readonly><span class="input-group-addon">%</span> </div></span></h4></div><div class="flw slideText"><div id="rateOfInter"></div><span>5</span><span class="m1">7.5</span><span class="m2">10</span><span class="m3">12.5</span><span class="m4 ">15</span> <span class="m5 ">17.5</span> <span class="m6 ">20</span> <span class="m7 ">23.5</span><span class="m8 last">30</span> </div></li><li class="durationLoan"><div class="flw"><h4>Loan Tenure:<span><div class="input-group"><input type="text" id="loanYr" readonly><span class="input-group-addon">Yr</span> </div></span></h4></div><div class="flw slideText"><div id="noYears"></div><span>0</span><span class="m1">10</span><span class="m2">15</span><span class="m3">20</span><span class="m4 last">25</span> <span class="m5 last">30</span> <span class="m6 last">35</span> <span class="m7 last">40</span> <span class="m8 last">45</span> </div></li></ul></div></div></div><div class="col-lg-4 col-md-4 col-sm-4 col-12 emiLeft sc-section nopadding"><div class="emi-result-box roundborder "><div class="flw fr"><h4><div>Monthly EMI</div><span class="emiValue"></span></h4></div><div class="flw fr"><h4><div>Total Interest Payable</div><span class="interestValue"></span></h4></div><div class="flw fr"><h4><div>Total Amount Payable<div class="principal">(Principal + Interest)</div></div></h4><h4><span class="TotalValue text-color"></span></h4></div></div></div></div></div></div>
<div class="col-12 nopadding">
<span class="bank-title">Bank Approvals</span>
<div class="owl-carousel owl-bank">


<!--<div class="item"><img src="<?= base_url('public/front') ?>/assets/images/hdfc.jpg" alt="HDFC Bank"></div>-->
</div>
</div>
<div class="row">
<!--<div class="col nopadding">
<a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="cta-btn-bank border-color text-color" target="_blank" onclick="fireGaForMicrosite('CTA3')">Apply for Home Loan</a>
</div>-->
</div>
</div>
</div>
</section>
<section class="content-section  flex-column" id="mapview">
<div>
<a class="card-title">Map <span>View </span> </a>
<div class="card-section">
<div class="tab-value">
<ul class="nav nav-tabs unittab">
<li><a data-toggle="tab" href="#locationadvantage" class="active">Know Your Neighbourhood</a></li>
<li id="map4" class="hidden-xs"><a data-toggle="tab" href="#googlemap">Google Map</a></li>
</ul>
</div>
<div class="tab-content" id="view-map-gallery">
<div id="locationadvantage" class="tab-pane fade in active show">
<div class="row padding30">
<div class="col-lg-12 nopadding hidden-xs">
<div class="roundborder location-ad-img">

    <div id="neighbourhood" class="section_id">
              <!-- SECTION 5 -->
              <div class="details_shadow_box">
                <div class="shadow_box_inner_contant">
                  <div class="full_list">
                    <div id="exTab1" class="">
                      <div class="pull-right heading_left">
                        <ul  class="nav nav-pills inner_nav_pills">
                          <li class="active"><a  href="#3a" data-toggle="tab" id='nearby'>nearby</a></li>
                        </ul>
                      </div>
                      <div class="tab-content clearfix">
                        <div class="tab-pane active" id="3a">
                          <!-- TAB LAST -->
                          <div class="card inner_tabing1">
                            <div id="commute_category">find distance and directions from here</div>
                            <div class='map_category'>
                              <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#school6" aria-controls="school6" role="tab" data-toggle="tab" id='school_map'>Schools (<code id="total_school"></code>) </a></li>
                                <li role="presentation"><a href="#restaurant6" id="restaurant_map" aria-controls="restaurant6" role="tab" data-toggle="tab">Restaurants (<code id="total_restaurant"></code>)</a></li>
                                <li role="presentation"><a href="#hospital6" aria-controls="hospital6" role="tab" data-toggle="tab" id="hospital_map">Hospitals (<code id="total_hospital"></code>) </a></li>
                                <li role="presentation"><a href="#atm6" id='atm_map' aria-controls="atm6" role="tab" data-toggle="tab">Atms (<code id="total_atm"></code>) </a></li>
                                <li role="presentation"><a class="last_chils" href="#shopping6" aria-controls="shopping6" role="tab" data-toggle="tab" id="shopping_mall_map">Shopping Malls (<code id="total_shopping_mall"></code>)</a></li>
                                <input type="hidden" id="map_search_type">
                              </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="school6">
                                <div class="map_location">
                                  <div id="prashant_testing" class="suggc">
                                    <input style="display: none !important;" id="pac-input" class="controls search_box_map" type="text" placeholder="Search Box">
                                    <ul id="near_location" style="display: none !important;">
                                    </ul>
                                  </div>
                                  <div id="map"></div>
                                </div>
                              </div>
                            </div>
                            <!-- Tab panes end -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      <input type="hidden" id="latValue">
<input type="hidden" id="longValue">

</div>
</div>
</div>
</div>

<div id="googlemap" class="tab-pane fade">
<div class="row padding30">
<div id="map1" style="width: 100%; height: 300px;"></div>
</div>
</div>
</section>

<section class="content-section  flex-column" id="aboutus">
<div>
<a class="card-title"> <span>Know About </span> Builder</a>
<div class="card-section padding30">
<div class="container nopadding">
<div class="row nopadding">
<div class="col nopadding roundborder builder-logo">
<img class="my-auto img-fluid" src="<?= base_url('uploads/images/builder/logo/'.$product_detail->builder_logo) ?>" alt="" width="200" height="200">
</div>
<div class="col-lg-9 col-md-9 col-12 nopadding pl-4">
<p class="aboutus-text">
<?= nl2br($product_detail->about_builder) ?>
</p>
</div>
</div>
<div class="row nopadding mt-4">
<div class="col-lg-6 col-md-6 col-sm-6 col-12 nopadding">
<span class="developer-title">Site Address</span>
<div class="address-box roundborder mr-4">
<?php $address = $product_detail->b_address_1;
if ($product_detail->b_address_2) {
  $address .= (($address)?", ":"").$product_detail->b_address_2;
}
if ($product_detail->b_address_3) {
  $address .= (($address)?", ":"").$product_detail->b_address_3;
}
$address .= (($address)?", ":"").$product_detail->b_city_name;
$address .= (($address)?", ":"").$product_detail->b_state_name;
echo $address;
 ?>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<footer class="padding30">
<div class="footer-content">
<div class="row footer-dash">
<div class="col-12 col-lg-9 col-md-9 col-sm-12 nopadding">
<div class="footer-nav my-auto">
<a class="js-scroll-trigger" href="#aboutus">About</a>
<a class="js-scroll-trigger" href="#properties">Properties Available</a>
<a class="js-scroll-trigger" href="#overview">Overview</a>
<a class="js-scroll-trigger" href="#specifications">Specifications</a>
<a class="js-scroll-trigger" href="#amenities">Amenities</a>
<a class="js-scroll-trigger" href="#gallery">Gallery</a>
<a class="js-scroll-trigger" href="#mapview">Map View</a>
</div>
</div>
</div>
<div class="row developer-footer">
<div class="col-8 nopadding">
<img src="<?= base_url('public/front') ?>/assets/images/logo.png" alt="<?= SITE_TITLE ?>">
</div>
<div class="col-4 nopadding"></div>
</div>
<div class="row">
<div class="col nopadding copyright">

</div>
</div>
</div>
<div class="footer-bg"><img src="<?= base_url('public/front') ?>/assets/images/project-bg.jpg" alt="Vfive Homes" width="960" height="200"></div>
</footer>
<div class="mobile-contact">
<div class="row">
<div class="col-6 nopadding">
<span class="builder-name">Contact Builder</span>
<span class="builder-contact">+91-99xxxxxx15</span></div>
<div class="col-6 nopadding"><a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="mobile-fix-cta" onclick="fireGaForMicrosite('CTA4')">Get Phone Number</a></div>
</div>
</div>

<div id="successMessage" class="msg-sucess"></div>


<div class="modal fade" id="mobileModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<button type="button" class="close close-mobile-modal" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true"><img src="<?= base_url('public/front') ?>/assets/images/close.svg" height="18" width="18"></span>
</button>
<div class="modal-body nopadding contact_form">
<h1>Want to know more ?</h1>
<div class="formLeftCon">


</div>
<input type="hidden" id="lat" value="<?= ($product_detail->lattitude)?$product_detail->lattitude:0 ?>"/>
<input type="hidden" id="long" value="<?= ($product_detail->longitude)?$product_detail->longitude:0 ?>"/>
<input type="hidden" id="location" value="<?= $product_detail->location_name ?>"/>
</div>
</div>
</div>
</div>

<div class="modal fade payment-plans" id="mobileModal_1" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<button type="button" class="close close-mobile-modal" data-dismiss="modal" aria-label="Close" style="margin-right: 10px;">
<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
</button>
<div class="modal-body nopadding contact_form">
<h1> Payment Plans </h1>
<div>
  <ul class="payment-plan-ul">
      <li class="new-plan">
    <h4 class="panel-title accordionCustom"> Plan Name:- Construction Link Payment Plan </h4>
    <div class="panelCustom">
    <div class="table-responsive">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th>S. No</th>
        <th>Particular</th>
        <th>Rs.</th>
        <th>% of BSP</th>
        <th>% of ADC</th>
        <th>% of PCL</th>
        <th>% of Parking</th>
        <th>Stage</th>
      </tr>
    </thead>
    <tbody>
	      <tr>
        <td>1</td>
        <td>At the Time of Registration</td>
        <td>111000</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
                <td>complete</td>
      </tr>
             <tr>
        <td>2</td>
        <td>With in 30 Days of Booking</td>
        <td>0</td>
        <td>25</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
                <td>complete</td>
      </tr>
             <tr>
        <td>3</td>
        <td>On Start of Foundation</td>
        <td>0</td>
        <td>15</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
                <td>complete</td>
      </tr>
             <tr>
        <td>4</td>
        <td>On Completion of Ground Floor Roof Casting</td>
        <td>0</td>
        <td>15</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
                <td>complete</td>
      </tr>
             <tr>
        <td>5</td>
        <td>On Completion of First Floor Roof Casting</td>
        <td>0</td>
        <td>15</td>
        <td>50</td>
        <td>0</td>
        <td>0</td>
                <td>complete</td>
      </tr>
             <tr>
        <td>6</td>
        <td>On Completion of Flooring</td>
        <td>0</td>
        <td>10</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
                <td>complete</td>
      </tr>
             <tr>
        <td>7</td>
        <td>On Completion of Plaster</td>
        <td>0</td>
        <td>15</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
                <td>complete</td>
      </tr>
             <tr>
        <td>8</td>
        <td>On Final Notice of Possession</td>
        <td>0</td>
        <td>5</td>
        <td>50</td>
        <td>100</td>
        <td>100</td>
                <td>complete</td>
      </tr>
           </tbody>
  </table>
  </div>
  </div>
    
    
    </li>
      </ul>
</div>

<div class="note">

<h5>Note:</h5>
<p>1. Agreement will be excuted after 10% of Proprty cost</p>
<p>2. Stamp Duty, Registration Charges, Govt Taxes or any Other regulatory Charges will be charged separately as applicable</p>


</div>
</div>
</div>
</div>
</div>
</div>

<?php include 'include/footer.php' ?>


<script>
        var latitude =<?= ($product_detail->lattitude)?$product_detail->lattitude:0 ?>;
        var longitude =<?= ($product_detail->longitude)?$product_detail->longitude:0 ?>;
        var infoWindowContent = "<?= $product_detail->location_name ?>";
        var custom_pointer_of_property="<?= base_url('uploads/images/project/logo/'.$product_detail->project_logo) ?>";
    </script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_JAVASCRIPT_MAP_API ?>&libraries=places&&callback=initialize" async defer>
        
    </script>

    <script type="text/javascript">

function initialize() {
   var lat=$('#lat').val();
   var long=$('#long').val();
   var location=$('#location').val();
   var latlng = new google.maps.LatLng(lat,long);
    var map = new google.maps.Map(document.getElementById('map1'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: false,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var infowindow = new google.maps.InfoWindow();   
    google.maps.event.addListener(marker, 'click', function() {
      var iwContent = '<div id="iw_container">' +
      '<div class="iw_title"><b>Location</b> :'+ location +'</div></div>';
      // including content to the infowindow
      infowindow.setContent(iwContent);
      // opening the infowindow in the current map and at the current marker location
      infowindow.open(map, marker);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>