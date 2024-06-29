    <?php include('include/header.php');?>

<?php include('include/sidebar.php');?>
       <div class="content-body">
    <div class="container-fluid">
         <div class="row mb-3 mt-1 dss">
            <div class="col-md-2">
               <h5 class="mt-3"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Rahul Tak</h5>
                      
            </div>

            <div class="col-md-3 offset-7 mt-1"style="text-align: right;" >

                         <select id="selectuptab" class="form-control bdr10" onchange="ddn()">
                            <option value="0" selected>Referance</option>
                            <option value="1" >Requirement</option>
                            <option value="2">Unit</option>
                        </select>
            </div>

            
         </div>
                <div class="row">
                    <div class="col-lg-12" id="tbl1">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>Referance</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                             
                                                <th>Agent Name</th>
                                                
                                                <th>DOR</th>
                                               
                                                <th>Purpos</th>
                                                
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                
                                                <td>Rahul
                                                </td>
                                                
                                                <td class="color-primary">98760</td>
                                                
                                                
                                                
                                                <td>Sale</span>
                                                </td>
                                                <td class="color-primary"> <i class="fa fa-circle" aria-hidden="true" style="color: green;"></i> &nbsp;Open                                              
                                                </td>
                                            </tr>
                                            
                                      
                                         

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
           <!---------------------------------------------------------------table2------------------------------>
         
       <div class="col-lg-12" id="tbl2" style="display: none;">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>Requirement</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                             
                                                <th>Date</th>
                                                
                                                <th>Purpos</th>
                                                
                                                <th>Product type</th>
                                                <th>Unit Type</th>
                                                <th>Location </th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Status</th>
                                                <th>Maching </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                
                                                <td>17 October 2019</td>
                                                <td>Sale</td>
                                                
                                                <td>Residencial</td>
                                                <td>Flat</td>
                                                <td>Nirman Nagar</td>
                                                <td>Jaipur</td>
                                                <td>rajasthan</td>

                                                
                                                <td class="color-primary"> <i class="fa fa-circle" aria-hidden="true" style="color: green;"></i> &nbsp;Open                                              
                                                </td>
                                                  <td>View</td>
                                            </tr>
                                            
                                      
                                         

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<!---------------------------------------------------------------table3------------------------------>

<div class="col-lg-12" id="tbl3" style="display: none;">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>Unit</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                             
                                                <th>Date</th>
                                                
                                                <th>TOP</th>
                                                
                                                <th>Unit Type</th>
                                                <th>Location </th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Agent Name</th>
                                                <th>Action</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                
                                                <td>17 October 2019</td>
                                                <td>Residencial</td>
                                                
                                                <td>Villa</td>
                                                
                                                <td>Nirman Nagar</td>
                                                <td>Jaipur</td>
                                                <td>rajasthan</td>
                                                <td>Rahul Tak</td>
                                                <td>For Sale</td>

                                                
                                                <td class="color-primary"> <i class="fa fa-circle" aria-hidden="true" style="color: green;"></i> &nbsp;Open                                              
                                                </td>
                                                  
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




            <?php include('include/footer.php');?> 




                     <script>
                
                function ddn(){
                    val=document.getElementById('selectuptab').value;
                if(val==0){
                    document.getElementById('tbl1').style.display="block";
                    document.getElementById('tbl2').style.display="none";
                    document.getElementById('tbl3').style.display="none";
                }
                else if(val==1){
                    document.getElementById('tbl1').style.display="none";
                    document.getElementById('tbl2').style.display="block";
                    document.getElementById('tbl3').style.display="none";
                }
                else{
                     document.getElementById('tbl1').style.display="none";
                    document.getElementById('tbl2').style.display="none";
                    document.getElementById('tbl3').style.display="block";
                   
                }
                }

            </script>