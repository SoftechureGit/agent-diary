<script>

$('#successMessage').hide();
   
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?= base_url('public/front') ?>/assets/js/jquery.slimscroll.min.js" defer></script>
<script src="<?= base_url('public/front') ?>/assets/js/owl.carousel.min.js" defer></script>
<script src="<?= base_url('public/front') ?>/assets/js/bootstrap.bundle.min.js" defer></script>
<script type="text/javascript" src="<?= base_url('public/front') ?>/assets/js/smartphoto.js" defer></script>
<script src="<?= base_url('public/front') ?>/assets/js/jquery.easing.min.js" defer></script>
<script src="<?= base_url('public/front') ?>/assets/js/premium.min.js" defer></script>
<script src="<?= base_url('public/front') ?>/assets/js/jquery-ui.js" defer></script>
<script src="<?= base_url('public/front') ?>/developer/page_js/send_request.js" defer></script>
<script src="<?= base_url('public/front') ?>/assets/js/emi.js" defer></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('public/front') ?>/assets/css/smart-gallery.css"/>
<script src="https://code.highcharts.com/highcharts.js" defer></script>
<script>/*$(window).scroll(function() {        var scroll = $(window).scrollTop();    if (scroll >= 100) {        $("#sideNav").addClass("scrollcustom");    } else {        $("#sideNav").removeClass("scrollcustom");    }});*/</script>

<script>
        ASSET_URL = 'http://agentdairy.com/agentdiary/';
        BASE_URL='http://agentdairy.com/agentdiary';
    </script>
<!--<input id="pac-input" class="controls" type="text" placeholder="Search Box">-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
<script src="<?= base_url('public/front') ?>/developer/page_js/property_details.js" defer></script>
<style>
    .default_pointer
    {
      left:70% !important;
    }
    .default_tenure
    {
      left:62% !important;
    }
     .map_location {
        position: relative;
    }
    .suggc {
        position: absolute;
        background: #fff;
        z-index: 9;
        right: 27px;
        width: 333px;
        top: 41px;
        border-top: 0px;
    }
    .suggc ul{padding: 0px; margin: 0px; list-style-type: none;}
    .suggc ul li {
        font-size: 12px;
        padding: 10px 15px;
        border-bottom: 1px solid #dadada;
    }
    .suggc ul li:last-child{border-bottom: 0px;}
    .search_box_map {
        height: 35px !important;
        border: 1px solid #ccc;
        padding: 11px 15px;
        font-size: 12px !important;
    }
    .fav
    {
      cursor: pointer;
    }
    .eye-css
    {
      line-height: 28px;
    }
    .focus_tab
    {
      margin-top: -100px;
      display: inline-block;
      width: 100%;
    }
  
  
html,body{height:100%;margin:0}
#map{height:500px; width:100% !important;}

.payment-plans .note {
    max-width: 775px;
    margin: 0px auto;
    padding: 0px 20px;
}
.note p {
    padding: 0px 20px;
}

    </style>

<script type="text/javascript">
    /*    window.setTimeout(function() {
    $("#successMessage").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);

        */
    </script>



<script>
var acc = document.getElementsByClassName("accordionCustom");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panelCustom = this.nextElementSibling;
    if (panelCustom.style.maxHeight){
      panelCustom.style.maxHeight = null;
    } else {
      panelCustom.style.maxHeight = panelCustom.scrollHeight + "px";
    } 
  });
}
</script>


<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("BHK0");
var btns = header.getElementsByClassName("line");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("actives");
  current[0].className = current[0].className.replace(" actives", "");
  this.className += " actives";
  });
}


</script>

<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("BHK1");
var btns = header.getElementsByClassName("line");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("actives");
  current[0].className = current[0].className.replace(" actives", "");
  this.className += " actives";
  });
}
</script>


<footer class="container-fluid" id="footer" style="display: none;">
    <div class="row footerLinks standPadding pt_20">
        <div class="col-sm-12 col-lg-6">
            <div class="row">
                <div class="col-sm-12">
                    <p class="m-b-0"><span class="c_white font-type-4">agentdiary.com is India's No 1</span> Property
                        portal and has been adjudged as the most preferred property site in India, by independent
                        surveys. The portal provides a platform for property buyers and sellers to locate properties of
                        interest and source information on the real estate space in a transparent and unambiguous
                        manner.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 padding-none-mob">
                        <span class="footer_heading">agentdiary Essentials</span>
                            <ul>
                                <li><a href="http://agentdiary/after-sale-assistance" title="">After Sale Assistance</a></li>
                                <li><a href="#" title="">agentdiary on Mobile</a></li>
                                <li><a href="#">Unsubscribe</a></li>
                                <li><a target="_blank" href="#">All Projects</a></li>
                                <li><a target="_blank" href="#">Real Estate Insights</a></li>
                               
                            </ul>
                        </div>
                        <div class="col-sm-6 padding-none-mob">
            <div class="row">
                <div class="col-sm-12 padding-none-mob"><span class="footer_heading">Social Media</span></div>
            </div>
            <div class="row">
                <div class="col-sm-8 padding-none-mob">
                    <ul class="social_div_footer">
                        <li><a target="_blank" href="#"><i class="fa icon-facebook5"></i></a></li>
                        <li><a target="_blank" href="#"><i class="fa icon-google"></i></a></li>
                        <li><a target="_blank" href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a target="_blank" href="#"><i class="fa fa-youtube-play"></i></a></li>
                    </ul>
                </div>
            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="row">
                <div class="col-sm-4"><span class="footer_heading">Real Estate in Jaipur</span>
                    <ul>
                        <li><a href="#">Property in Vaishali nagar</a></li>
                        <li><a href="#">Property in Jhotwara</a></li>
                        <li><a href="#">Property in Khatipura</a></li>
                        <li><a href="#">Property in Hassanpura</a></li>
                        <li><a href="#">Property in Gopalpura</a></li>
                        <li><a href="#">Property in Sastri nagar</a></li>
                    </ul>
                </div>
                <div class="col-sm-4"><span class="footer_heading">New Projects in India</span>
                    <ul>
                        <li><a href="#">New Projects in Jaipur</a></li>
                        <li><a href="#">New Projects in Bangalore</a></li>
                        <li><a href="#">New Projects in Mumbai</a></li>
                        <li><a href="#">New Projects in Chennai</a></li>
                        <li><a href="#">New Projects in Hyderabad</a></li>
                        <li><a href="#">New Projects in Noida</a></li>
                        <li><a href="#">New Projects in Gurgaon</a></li>
                    </ul>
                </div>
                <div class="col-sm-4"><span class="footer_heading">Company</span>
                    <ul>
                        <li><a href="#" title="Testimonials" target="_blank">Testimonials</a></li>
                        <li><a href="http://agentdairy.com/agentdiary/contact-us" title="Contact us" rel="nofollow">Contact us</a></li>
                        <li><a href="http://agentdairy.com/agentdiary/term-condition" title="Terms &amp; Conditions" rel="nofollow">Terms &amp; Conditions</a></li>
                        <li><a href="http://agentdairy.com/agentdiary/privacy-policy" target="_blank" title="Privacy Policy" rel="nofollow">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row disclamer standPadding">
        <div class="col-sm-12">
            <p class="fo_10px" id="disclaimer"><span class="disclamer_txt_color font-type-4">Disclaimer:</span>
                AgentDiary is only an intermediary offering its platform to facilitate the
                transactions between Seller and Customer/Buyer/User and is not and cannot be a party to or control in
                any manner any transactions between the Seller and the Customer/Buyer/User. All the offers and discounts
                on this Website have been extended by various Builder(s)/Developer(s) who have advertised their
                products. AgentDiary is only communicating the offers and not selling or rendering any of those
                products or services. It neither warrants nor is it making any representations with respect to offer(s)
                made on the site. AgentDiary shall neither be responsible nor liable to mediate
                or resolve any disputes or disagreements between the Customer/Buyer/User and the Seller and both Seller
                and Customer/Buyer/User shall settle all such disputes without involving AgentDiary in any manner.</p>
        </div>
    </div>
    <div class="row copyright standPadding">
        <div class="col-sm-12 fo_10px font-type-2" id="trademark">All trademarks, logos and names are properties of
            their respective owners. All Rights Reserved. © Copyright 2018 AgentDiary.
        </div>
    </div>
</footer>
<div class="modalsign mymodal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
     <div id="regSuccessMessage"></div>
            <div class="form">
                <h2>Login</h2>
                <button type="button" class="close" onclick="closemodal();">&times;</button>
                <form name='login-form' id="login-form">
                    <div class="flex-c sec_1564">
                        <div class="login-with">
                        <label class="container-radio">User
                        <input type="radio" name="signv" id="sign" value="user" checked> 
                        <span class="checkmark"></span>
                        </label>
                        </div>
                        <div class="login-with">
                        <label class="container-radio">Builder
                        <input type="radio" name="signv" id="sign" value="builder"> 
                        <span class="checkmark"></span>
                        </label>
                        </div>
                        <div class="login-with">
                        <label class="container-radio">Channel Partner
                        <input type="radio" name="signv" id="sign" value="channel partner"> 
                        <span class="checkmark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id">Email Address</label>
                        <input type="text" class="form-control" name="login_email" id="login_email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="login_password" id="login_password">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                    Remember me</label>
                            </div>
                        </div>
                        <div class="col-sm-6"><p class="text-right forget-pass"><a href="#">Forgot password?</a></p></div>
                    </div>
                    <button type="button" id="login_user" class="btn btn-default">Login</button>
                    <p class="mt20 text-center">Or Login With</p>
                    <div class="flex-c p-b-112">
                        <a href="#" class="login100-social-item">
                            <i class="fa icon-facebook5"></i>
                        </a>

                        <a href="#" class="login100-social-item">
                           <i class="fa fa-google-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                    <p class="mt20 text-center">Not a member? <a id="signup" href="javascript:void(0)">Register now</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modalreg mymodal" id="myModal2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="form register">
                <h4>Register</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <ul class="nav nav-tabs">
                    <li><a class="active" data-toggle="tab" href="#user">User</a></li>
                    <li><a data-toggle="tab" href="#builder">Builder</a></li>
                    <li><a data-toggle="tab" href="#channel">Channel Partner</a></li>
                </ul>
                <div class="tab-content">
                    <div id="user" class="tab-pane fade in active">
                        <form action="" id="register-form" class="register-form" name="register-form">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name*">
                                <span class="fnameMsg error"></span>
              </div>
                            </div>
                             <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name*">
                                <span class="lnameMsg error" ></span>
              </div>
                            </div>
                             <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email Id*">
                                 <span class="emailMsg error" ></span>
              </div>
                            </div>
                             <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile No.*">
                                 <span class="mobileMsg error"></span>
              </div>
                            </div>
                             <div class="col-md-6">
                            <div class="form-group">
                               <input type="password" class="form-control" id="password" name="password" placeholder="Password.*">
                                <span class="passwordMsg error"></span>                           
               </div>
                           </div>
                            <div class="col-md-6">
              <div class="form-group">
                               <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password.*">
                                 <span class="confMsg error"></span>
              </div>
                            </div>
                            <div class="col-md-12">
                            <button type="button" id="register_user" class="btn btn-default">Submit</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div id="builder" class="tab-pane fade">
                        <form id="builder-form" class="builder-form" name="builder-form">
                             <div class="form-group">
                                <input type="text" class="form-control builder_company_name" id="builder_company_name" name="builder_company_name" placeholder="Farm Name*">
                                <span class="builderCompanyNameMsg error"></span>
              </div>
              <div class="form-group">
                                <input type="email" class="form-control builder_user_email" name="builder_user_email" id="builder_user_email" placeholder="Email Id*">
                                <span class="builderEmailMsg error"></span>
              </div>
                            <div class="form-group">
                                <input type="number" class="form-control builder_mobile" id="builder_mobile" name="builder_mobile" placeholder="Mobile No.*">
                <span class="builderMobileMsg error"></span>
                            </div>
                           
                            <button type="button" id="builder_user" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                    <div id="channel" class="tab-pane fade">
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" placeholder="First Name*">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" placeholder="Last Name*">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="Email Id*">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Mobile No.*">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="company" placeholder="Company Name*">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
      <p class="mt10 text-center"> Already Register ? <a id="login" href="javascript:void(0)">Login Now</a></p>
        </div>
              
    </div>
</div>


<div class="empty-product">
<div class="empty-img">
<img src="<?= base_url('public/front') ?>/images/empty-state-cart.png">

<h2>Project are Empty</h2>
</div>
</div>





<script src="<?= base_url('public/front') ?>/js/owl.carousel.min.js"></script>
<script src="<?= base_url('public/front') ?>/js/jquery.validate.min.js"></script>
<script src="<?= base_url('public/front') ?>/developer/page_js/contact_us.js"></script>
<script src="<?= base_url('public/front') ?>/developer/page_js/my_reference.js"></script>
<script src="<?= base_url('public/front') ?>/developer/page_js/user_signup.js"></script>
<script src="<?= base_url('public/front') ?>/developer/page_js/builder_signup.js"></script>
<script src="<?= base_url('public/front') ?>/developer/page_js/user_login.js"></script>
<script src="<?= base_url('public/front') ?>/js/custom-file-input.js"></script>
<div class="modal fade" id="mysearchModal" tabindex="-1" role="dialog" aria-labelledby="mysearchModalLabel"
     style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mysearchModalLabel">What is Keyword search?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <p>Keyword search allows you to find properties that include specific words e.g. garage.You can also
                    search for exact phrases by using quotation marks e.g. "double garage", or to exclude a term you can
                    prefix it with a minus sign e.g. -studio. </p>
            </div>
        </div>
    </div>
</div>

   
<script>
function closemodal()
{
    $("#myModal").modal('hide');
    //location.replace(BASE_URL);
}
//$("#myModal").modal('show');
 $("#signup").click(function()
 {
   $("#myModal").modal('hide');
   $("#myModal2").modal('show');
 });
 $("#login").click(function()
 {
   $("#myModal").modal('show');
   $("#myModal2").modal('hide');
 });
 
    window.onscroll = function () {
        myFunction()
    };
    var header = document.getElementById("sticky-header");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            sticky - header.classList.add("sticky-active");
        } else {
            sticky - header.classList.remove("sticky-active");
        }
    }
</script>
<script>
    $(document).ready(function () {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            ltr: true,
            margin: 5,
            nav: true,
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                1000: {
                    items: 3
                },
                2000: {
                    items: 3
                }
            }
        })
    })
</script>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>


<script>
    var x, i, j, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 0; j < selElmnt.length; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function (e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function (e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }

    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect); </script>

<script>
    function openNavmob() {
        document.getElementById("myNav_mobile").style.height = "100%";
    var element = document.getElementsByTagName("BODY")[0];
        element.classList.add("nav-lock-scroll");
    }

    function closeNavmob() {
        document.getElementById("myNav_mobile").style.height = "0%";
    var element = document.getElementsByTagName("BODY")[0];
        element.classList.remove("nav-lock-scroll");
    }
</script>


<script>
    function myFunction_red() {
        location.href = "index.php";
        document.getElementById("closebutton").style.display = "none";
    }
</script>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>
<script>

    $('textarea.limittext').keypress(function (e) {
        var tval = $('textarea.limittext').val(),
            tlength = tval.length,
            set = 150,
            remain = parseInt(set - tlength);
        $('span.limit').text(remain);
        if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
            $('textarea.limittext').val((tval).substring(0, tlength - 1))
        }
    })

</script>

<script>
            jQuery(document).ready(function($) {
              $('.loop').owlCarousel({
                center: true,
                items: 2,
                loop: true,
                margin: 10,
                responsive: {
                  600: {
                    items: 2
                  }
                }
              });
            });
</script>
          
  
<script>
// Favorite Button - Heart
$('.favme').click(function() {
  $(this).toggleClass('active');
});
</script>        


</body>
</html></body>
</html>