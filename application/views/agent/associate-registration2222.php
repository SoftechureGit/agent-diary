    <?php include('include/header.php'); ?>

<?php include('include/sidebar.php');?>
       <div class="content-body">
<div class="col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Associate Registration</h4>
                                <div class="basic-form">
                                    <div class="form-row mb-4 mt-3">
                                    <form>
                                        <form>
                                        <div class="form-group mt-3 mb-0">
                                            <label class="radio-inline mb-0 mr-3">
                                                <input type="radio" name="optradio"> Verified</label>
                                            <label class="radio-inline mr-3 mb-0">
                                                <input type="radio" name="optradio"> Non - verified</label>
                                         
                                        </div>
                                    </form>
                                    </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label>Name of Firm</label>
                                                <select class="form-control">
                                                    <option selected>Type of Firm</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label>Firm Name</label>
                                                <input type="text" class="form-control" placeholder="Please Enter Your Firm Name">
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" placeholder="1234 Main St">
                                        </div>
                                        <div class="form-group">
                                            <label>Address 2</label>
                                            <input type="text" class="form-control" placeholder="Apartment, studio, or floor">
                                        </div>
                                        <div class="form-group">
                                            <label>Address 3</label>
                                            <input type="text" class="form-control" placeholder="Apartment, studio, or floor">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label>Country</label>
                                                  <select id="inputState" class="form-control">
                                                    <option selected="selected">Choose...</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>State</label>
                                                <select id="inputState" class="form-control">
                                                    <option selected="selected">Choose...</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>City</label>
                                                <select id="inputState" class="form-control">
                                                    <option selected="selected">Choose...</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label>Mobile No.</label>
                                            <input type="numeber" class="form-control" placeholder="Please Enter Your Mobile no.">
                                        </div>
                                          <div class="form-group col-md-4">
                                            <label>Contact No.</label>
                                            <input type="numeber" class="form-control" placeholder="Please Enter Your Contact no">
                                        </div>
                                          <div class="form-group col-md-4">
                                            <label>WhatsApp No.</label>
                                            <input type="numeber" class="form-control" placeholder="Please Enter Your WhatsApp No. ">
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label>Email Id</label>
                                            <input type="email" class="form-control" placeholder="Please Enter Your Email id ">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Rera Registred</label>
                                              <select id="inputState" class="form-control"  onchange="ddn(this.value);">
                                                    <option value="0">YES</option>
                                                    <option value="1" selected="selected">NO</option>
                                                   
                                                </select>
                                        </div>

<!-------------------------------- on change------------------------------->
                                    <div style="display: none;" id="frm" class="col-md-12 ">
                                        <hr>
                                        <div class="row">
                                        <div class="form-group col-md-2 ">
                                            <label>Owner Name</label>
                                              <select id="inputState" class="form-control">
                                                    <option selected="selected">Ms./Mrs./Miss</option>
                                                    <option value="0">Ms.</option>
                                                    <option value="1">Mrs.</option>
                                                    <option value="1">Miss.</option>
                                                   
                                                </select>
                                        </div>
                                        <div class="form-group col-md-5">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="Please Enter Your Firm Name">
                                            </div>
                                             <div class="form-group col-md-5">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="Please Enter Your Firm Name">
                                            </div>

                                         <div class="form-group col-md-3">
                                                <label>Rera No</label>
                                                <input type="text" class="form-control" placeholder="Please Enter Your Rera No">
                                            </div>
                                             <div class="form-group col-md-3">
                                                <label>DOR</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="form-group col-md-3">
                                                <label>Valid Till</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <label>Upload Image</label>
                                                <input type="file" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>PAN NO.</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>Upload Pan Card</label>
                                                <input type="file" class="form-control" >
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <label>Upload Photo</label>
                                                <input type="file" class="form-control" >
                                            </div>
                                              <div class="form-group col-md-3 ">
                                                <label>Upload Logo</label>
                                                <input type="file" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>Adhar No</label>
                                                <input type="numeber" class="form-control" >
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <label>Upload Adhar</label>
                                                <input type="file" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>GST No</label>
                                                <input type="numeber" class="form-control" >
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <label>Upload gst certificate</label>
                                                <input type="file" class="form-control" >
                                            </div>
                                     </div>
                                 </div>
<!-------------------------------- on change------------------------------->

                                        </div>
                                       
                                        <button type="submit" class="btn btn-dark">SAVE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

            <?php include('include/footer.php');?> 

            <script>
                
                function ddn(val){
                    if(val=='0'){
                    document.getElementById('frm').style.display="block";
                }else{
                     document.getElementById('frm').style.display="none";
                   
                }
                }

            </script>