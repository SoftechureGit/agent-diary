/**
 * Created by sonukumar.singh on 1/19/2017.
 */
$(function() {

    // only alphanumeric characters allowed
    jQuery.validator.addMethod('alphanumeric', function (value, element) {
        if(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/.test(value))
        {
            return true;
        }
    }, 'Only Alphanumeric characters are allowed.');

    //mobile no validation
    jQuery.validator.addMethod('validMobile', function (value, element) {
        if(/^[0-9]+$/i.test(value))
        {
            return true;
        }
    }, 'Please enter valid mobile no.');
    //Only Alpahabets, space, period or apostrophe allowed
    jQuery.validator.addMethod('validname', function (value, element) {
        if(/^[a-zA-Z.']+$/i.test(value))
        {
            return true;
        }
    }, 'Only characters allowed.');

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
    $("#register-form").validate({
        rules: {
            fname: {
                required: true,
                validname: true,
                maxlength:20
            },
            lname: {
                required: true,
                validname: true,
                maxlength:20
            },
            mobile: {
                required: true,
                validMobile:true,
                maxlength:10
            },
            user_email: {
                required: true,
                validEmail: true,
                maxlength:100
            },
            password: {
                required: true,
               // alphanumeric: true,
                minlength: 6,
                maxlength: 20
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            fname: {
                maxlength: "first name cannot be longer than 20 characters"
            },
            lname: {
                maxlength: "last name cannot be longer than 20 characters"
            },
            mobile: {
                maxlength: "Mobile cannot be longer than 10 characters"
            },
            password: {
                minlength: "Password must be at least 6 characters long",
                maxlength: "Password cannot be longer than 20 characters"
            },
            password_confirmation: {
                equalTo: "Please enter the confirm password as password"
            },
            user_email: {
                maxlength: "Password cannot be longer than 100 characters"
            }

        },
        submitHandler: function (form) {
        }
    });

});
$(document).ready(function () {
    $('#register-form').validate();
    $('#register_user').click(function () {
        if ($("#register-form").valid()) {
            $(".loader").fadeIn("slow");
            var fname=jQuery("#fname").val();
            var lname=jQuery("#lname").val();
            var mobile=jQuery("#mobile").val();
            var password=jQuery("#password").val();
            var email=jQuery("#user_email").val();
            var password_confirmation=jQuery("#password_confirmation").val();
            jQuery.ajax({
				headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: BASE_URL + '/user-register',
                type: 'POST',
                dataType: 'json',
                data: {fname:fname,lname:lname,email:email,mobile:mobile,password:password,password_confirmation:password_confirmation},
                success: function (data) {
                   if(data.success)
                   {
                      // $(".fname").val('');
                       // $(".lname").val('');
                       // $(".user_email").val('');
                       // $(".mobile").val('');
                       // $(".password").val('');
                       // $(".password_confirmation").val('');
                       // jQuery('.loader').hide();
					    $("#myModal2").modal("hide");
                        $("#myModal").modal("show");
                     
                       var successContent = "<div class='alert alert-success' id='success-alert'>You have registered successfully.</div>";
                       $('#regSuccessMessage').html(successContent);
					   $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                           $("#success-alert").slideUp(500);
                       });
                       
                   }
                   if(data.fail)
                   {
                       var json=jQuery.parseJSON(JSON.stringify(data.errors));
                       $(".fnameMsg").html(json.fname);
                       $(".lnameMsg").html(json.lname);
                       $(".emailMsg").html(json.email);
                       $(".mobileMsg").html(json.mobile);
                       $(".passwordMsg").html(json.password);
                       $(".confMsg").html(json.password_confirmation);
                       jQuery('.loader').hide();
                   }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    });

});

function showLogin()
{
    $("#myModal").modal("show");
    $("#myModal2").modal("hide");
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
}