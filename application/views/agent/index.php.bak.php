<?php include('include/header.php');?>

<?php include('include/sidebar.php');?>








        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div style="padding: 0px 26px 21px 26px;background-color: #fff;">
                <div class="row">
                    <div class="col-md-3 mtm">
                            <select class="form-control bdr10">
                                    <option selected>TEAM MEMBER</option>
                                </select>
                              
                    </div>

                    <div class="col-md-3 mtm">

                                 <select class="form-control bdr10">
                                    <option selected>PROJECT</option>
                                </select>
                    </div>

                     <div class="col-md-6 mt-3" style="text-align: right;">

                                 <h5><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; 16 October 2019</h5>
                    </div>
                </div>
            </div>

         <div class="container-fluid mt-2" style="display: ;">

         
            
        <div class="row">
            <div class="col-md-12">
                <div class="row">


            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Todays Followup</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">4565</h2>
                                    <!--<p class="text-white mb-0">Jan - March 2019</p>-->
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Missed Followup</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">541</h2>
                               
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Up Coming Followup</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">4565</h2>
                                    
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                    <div class="col-md-12 col-md-12">
                         <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body" style="padding-top: 22px;padding-bottom: 22px;">
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">For Rent</th>
                                                <th class="text-center">For Sale</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total Projects</td>
                                                <td class="text-center">22
                                                </td>
                                                <td class="text-center"> 22</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Total Property </td>
                                                <td class="text-center">25
                                                </td>
                                                <td class="text-center"> 30</td>
                                               
                                            </tr>
                                            <tr>
                                                <td>Total Leads</td>
                                                <td class="text-center">25
                                                </td>
                                                <td class="text-center"> 25</td>
                                                
                                            </tr>
                                                 <tr>
                                                <td>Active Leads</td>
                                                <td class="text-center">22
                                                </td>
                                                <td class="text-center"> 22</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Dead Leads </td>
                                                <td class="text-center">25
                                                </td>
                                                <td class="text-center"> 30</td>
                                               
                                            </tr>
                                            <tr>
                                                <td>Convert Leads </td>
                                                <td class="text-center">25
                                                </td>
                                                <td class="text-center"> 30</td>
                                               
                                            </tr>
                                        

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                            </div>



                        </div>


                            
                        </div>
                </div>

                


             </div>

            </div>


<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sales Record</h4>
                <canvas id="singelBarChart" width="500" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                
                                <h4 class="card-title">Site Visit Report</h4>
                                <canvas id="polarChart" width="500" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">

<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!--<h4 class="card-title">Teams</h4>
                                <hr>-->
                                <div class="table-responsive"> 
                                    <table class="table table-bordered verticle-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">Team </th>
                                                <th scope="col">Total Lead</th>
                                                <th scope="col">Converson</th>
                                                <th scope="col">Site Visit </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Member-A</td>
                                                <td>100</td>
                                                <td>10 (10%)</td>
                                                <td>40 (40%)</td>
                                            </tr>
                                            <tr>
                                                <td>Member-B</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Member-C</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Member-D</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Member-E</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Member-E</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                          
                                         
                                         
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

 </div>
      


            <!-- #/ container -->


        </div>
    </div>
        <!--**********************************
            Content body end
        ***********************************-->
 <?php include('include/footer.php');?>  
 <script src="<?php echo base_url('public/admin/') ?>plugins/chart.js/Chart.bundle.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>js/plugins-init/chartjs-init.js"></script>