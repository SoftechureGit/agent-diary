
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">

    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    


<style>
* {
  box-sizing: border-box;
}








/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<body>


    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 mt-5">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-2 ">
                              <!--  <img src="<?php echo base_url('public/admin/images/');?>logo1.png">-->
                               

<form id="regForm" class="mt-3 mb-1 login-input" action="/action_page.php">

  <!-- One "tab" for each step in the form: -->
  <div class="tab"> <a class="text-center " href=""> <h3 class="pt-3 mb-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Register</h3></a>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="GROUP NAME">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email ID">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="User ID">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
  </div>
  <div class="tab"><a class="text-center " href=""> <h3 class="pt-3 mb-3"><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp;Detail</h3></a>
     <div class="form-group">
                                        <input type="text" class="form-control" placeholder="FIRST NAME">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="LAST NAME">
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control">
                                           <option>Selet City</option>
                                           <option>Jaipur</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control">
                                           <option>Selet State</option>
                                           <option>Rajasthan</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="MOBILE">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="WHATSAPP">
                                    </div>
                                    
  </div>
  <div class="tab"><a class="text-center " href=""> <h3 class="pt-3 mb-3"><i class="fa fa-money" aria-hidden="true"></i> &nbsp;Plan</h3></a>
                                    <div class="form-group">
                                      <div class="">
                        <div class="card" style="box-shadow: unset;">
                            <div class="">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th>BASIC</th>
                                                <th>PRO</th>
                                                <td>Select</td>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                                <td>NO OF USER -1</td>
                                                <td><span class="badge badge-primary px-2">REQUIRED NO OF USER</span>
                                                </td>
                                                <td><div class="form-group">
                                            <div class="form-check mb-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value=""></label>
                                            </div>
                                          
                                           
                                        </div></td>
                                             
                                            </tr>
                                         
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="form-group">
                                            <div class="form-check mb-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value=""> &nbsp;Accept all Terms of Services and privacy Policy</label>
                                            </div>
                                          
                                           
                                        </div>  
                                    </div>
                                    
  </div>

  <div style="overflow:auto;">
    <div style="/*float:right;*/">
     <!-- <button class="btn login-form__btn submit w-100" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>-->
      <button class="btn login-form__btn submit w-100" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px; display: none;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>




                        </div>
                        
                    </div><br>
                    <p id="dis" class=" login-form__footer tac">I already have an account, take me to the <a href="page-register.html" class="text-primary">Login</a></p>
                    <hr>
                    <div class="row">
  <div class="col-md-4 col-4">
                            <p class="tac">Terms and policy</p>
                        </div>
                        <div class="col-md-4 col-4">
                            <p class="tac">Privacy policy</p>
                        </div>
                        <div class="col-md-4 col-4">
                            <p class="tac">Disclaimer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  document.getElementById('dis').style.display="none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
    

    
 





