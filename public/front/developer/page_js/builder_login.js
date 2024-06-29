/**
 * Created by sonukumar.singh on 1/19/2017.
 */
$(function() {

    // only alphanumeric characters allowed

    //Please enter valid email
    jQuery.validator.addMethod("validEmail", function(value, element)
    {
        if(value == '')
            return true;
        var temp1;
        temp1 = true;
        var ind = value.indexOf('@');
        var str2=value.substr(ind+1);
        var str3=str2.substr(0,str2.indexOf('.'));
        if(str3.lastIndexOf('-')==(str3.length-1)||(str3.indexOf('-')!=str3.lastIndexOf('-')))
            return false;
        var str1=value.substr(0,ind);
        if((str1.lastIndexOf('_')==(str1.length-1))||(str1.lastIndexOf('.')==(str1.length-1))||(str1.lastIndexOf('-')==(str1.length-1)))
            return false;
        str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]+)$/;
        temp1 = str.test(value);
        return temp1;
    }, "Please enter valid email.");

    // validate signup form on keyup and submit
    $("#login-form").validate({
        rules: {

            login_email: {
                required: true,
                validEmail: true,
                maxlength:100
            },
            login_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
        },
        messages: {
            login_password: {
                minlength: "Password must be at least 6 characters long",
                maxlength: "Password cannot be longer than 20 characters"
            },

            login_email: {
                maxlength: "Password cannot be longer than 100 characters"
            }
        },
        submitHandler: function (form) {
        }
    });

});
$(document).ready(function () {
    $('#login-form').validate();
    $('#login_user').click(function () {
        if ($("#login-form").valid()) {
            jQuery('.loader').show();
            var password=jQuery("#login_password").val();
            var email=jQuery("#login_email").val();
            jQuery.ajax({
				headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: BASE_URL + '/user-login',
                type: 'POST',
                dataType: 'json',
                data: {email:email,password:password},
                success: function (data) {
                    if(data.error)
                    {
                        var successContent = "<div class='alert alert-danger'>Invalid Email or Password.</div>";
                        $('#regSuccessMessage').html(successContent);
                    }
                    if(data.success)
                    {
                        if(data.response==2)
                        {   if(data.user_kyc==0)
                            {
                               window.location="builder/edit-profile";
                            }
                            else 
                            {
                                window.location="builder/dashboard";
                            }
                        }
                        else if(data.response==3)
                        {
                        window.location.reload();
                        }
                    }
                    jQuery('.loader').hide();
                },
                error: function (error) {
                    console.log("Something wrong in username and password");
                }
            });
        }
    });

});

$(".login_form").keydown(function(event){
    if (event.which == 13) {
        $("#login_user").trigger('click');
    }
});


function showLogin()
{
    var clogin = $("#content-login");
    var cregister = $("#content-register");
    var newheight = clogin.height();
    $(clogin).css("display", "block");

    $(clogin).stop().animate({
        "left": "0px"
    }, 800, function() { /* callback */ });
    $(cregister).stop().animate({
        "left": "880px"
    }, 800, function() { $(cregister).css("display", "none"); });

    $("#page").stop().animate({
        "height": newheight+"px"
    }, 550, function(){ /* callback */ });
}
function changeType(value)
{
    if($("."+value).attr('type')=="text") {
        $("." + value).attr('type', 'password');
    }
    else
    {
        $("."+value).attr('type', 'text');
    }
}/**
 * Created by sonukumar.singh on 1/20/2017.
 */

 function ChangeTypeLogin()
 {
    if($("#login_password").attr('type')=="text") {

    $("#login_password").attr("type",'password');
    }
    else
    {
     $("#login_password").attr("type",'text');
    }
 }
