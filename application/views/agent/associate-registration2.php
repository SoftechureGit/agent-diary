
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">

    
</head>

<body class="h-100">
    


    



    <div class="h-100 mt-5">
        <div class="container h-100">

              <div class="card">
                            <div class="card-body">
                                <h4 class="card-title tac">Associate Registration</h4>
                                <div class="basic-form" style="display: block;">
                                    <div class="form-row mb-4 mt-3">
                                    <form >
                                        
                                        <div class="form-group mt-3 mb-0" id="" >
                                            <label class="radio-inline mb-0 mr-3">
                                            <input type="radio" name="optradio" value="1" checked> Verified</label>
                                            <label class="radio-inline mr-3 mb-0">
                                                <input type="radio" name="optradio" value="2"> Non - verified</label>
                                         
                                        </div>
                                    
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
                                </div>
<!-------------------------------- on change------------------------------->
                                 </div>



<!--===============================================================FORM2===============================================-->
             <div class="basic-form" style="display: none;" id="frm9">
                                    <div class="form-row mb-4 mt-3">
                                    <form >
                                        
                                        <div class="form-group mt-3 mb-0">
                                            <label class="radio-inline mb-0 mr-3">
                                                <input type="radio" name="optradio"> Verified</label>
                                            <label class="radio-inline mr-3 mb-0">
                                                <input type="radio" name="optradio"> Non - verified</label>
                                         
                                        </div>
                                    
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
                                </div>
<!-------------------------------- on change------------------------------->
                                 </div>
<!--===============================================================END FORM2============-->                                 
                                       
                                        <button type="submit" class="btn btn-dark">CLOSE</button>
                                        <button type="submit" class="btn btn-dark">SAVE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
 
    </div>
</div>
    

    
 

         <script>

            
                
                function ddn(val){
                    if(val=='0'){
                    document.getElementById('frm').style.display="block";
                }else{
                     document.getElementById('frm').style.display="none";
                   
                }
                }

            </script>



