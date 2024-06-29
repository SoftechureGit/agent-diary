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
    $("#form1").validate({
        rules: {

            Email: {
                required: true,
                validEmail: true,
                maxlength:100
            },
        },
        messages: {
            Email: {
                maxlength: "Email cannot be longer than 100 characters"
            },
        },
        submitHandler: function (form) {
        }
    });

});

function call_detail(id)
{  $("#booking_detail").hide();
   $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                url: BASE_URL+'/booking/get-booking-data',
                type: 'post',
                data:{id:id},
                cache : false,
                success: function (data) {
                   $("#booking_detail").show();
                   $("#booking_detail").html(data);
                },
                   
                error: function (error) {
                  console.log(error);
                }
              });
}

$("#s_app").click(function(){ 
 
var myform = document.getElementById("f_form");
var f_data = new FormData(myform);
           $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                url: BASE_URL+'/booking/save-applicant',
                type: 'post',
                data:f_data,
                dataType: 'json',
                cache : false,
                contentType: false, 
                processData: false,
                success: function (data) {
                  $("#book_id_1").val(data.booking_id);
                  $("#app_id_1").val(data.app_id);
                  alert("applicant saved");
                },
                   
                error: function (error) {
                  console.log(error);
                }
              });
          
         
    });

$("#applicant_first").click(function(){ 
 
var myform = document.getElementById("applicant_form_1");
var f_data = new FormData(myform);
					 $.ajax({
						headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								 },
								url: BASE_URL+'/booking/save-applicant',
								type: 'post',
								data:f_data,
                dataType: 'json',
								cache : false,
                contentType: false, 
                processData: false,
								success: function (data) {
							    $("#book_id_1").val(data.booking_id);
                   $("#app_id_1").val(data.app_id);
								alert("applicant saved");
								},
								   
								error: function (error) {
									console.log(error);
								}
							});
          
				 
    });
    
$("#applicant_second").click(function(){ 
 
var myform = document.getElementById("applicant_form_2");
var f_data = new FormData(myform);
					 $.ajax({
						headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								 },
								url: BASE_URL+'/booking/save-applicant',
								type: 'post',
								data:f_data,
                dataType: 'json',
								cache : false,
                contentType: false, 
                processData: false,
								success: function (data) {
							    $("#book_id_2").val(data.booking_id);
                  $("#app_id_2").val(data.app_id);
								alert("applicant saved");
								},
								   
								error: function (error) {
									console.log(error);
								}
							});
          
				 
    }); 


    
$("#final_submit").click(function(){ 
 
var myform = document.getElementById("payment_form");
var f_data = new FormData(myform);
					 jQuery.ajax({
						headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								 },
								url: BASE_URL+'/booking/save-final-booking',
								type: 'post',
								data:f_data,
								cache : false,
                contentType: false, 
                processData: false,
                success: function (data) {
							   		alert("Booking Done");
                    location.replace(BASE_URL+"/my-booking");
								},
								   
								error: function (error) {
									console.log(error);
								}
							});
          
				 
    });      
    
function set_status(id)
{   
   if(id == 0 || id == 2)
   {
     $('#co_1').show();
     $('#s_app').hide();
   }
   if(id == 1)
   {
      $('#co_1').hide();
      $('#s_app').show();
   }
    $("#is_self").val(id);
    $("#is_self_2").val(id);
    
}
    
$('#link_wishlist').click(function () {
  
             var prop_id=$('#prop_id').val();
             var user_email=$('#Email').val();
             var Mobile=$('#Mobile').val();
             var from=$('#from').val();
             var bcc=$('#bcc').val();
             var subject=$('#subject').val();
             jQuery.ajax({
				headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: BASE_URL + '/send-user-request',
                type: 'POST',
                //dataType: 'json',
                cache : false,
                data: {prop_id:prop_id,Email:user_email,subject:subject,bcc:bcc,from:from},
                success: function (data) {
                    
                   if(data)
                      { 
                        $('#successMessage').css('display', 'block'); 
                        $('#successMessage').html(data);
                        $("#successMessage").fadeTo(10000, 0);
                        //alert("Added to wishlist");
                      }
                   
                },
                error: function (error) {
                    console.log(error);
                }
            });
         
        
    });



function call_inventory(id,type)
{        
         jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-inventory',
              type: 'POST',
              dataType: 'json',
              data: {id:id,prop_type:type},
              success: function (data) {
                if(data.success)
                  { 
                    window.open(BASE_URL+'/inventory', '_blank');
                  }

                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_span(sub_data)
{
  var selectedparking = $("#park").children("option:selected").val();
  var o_cost=parseInt($('#open').text());
  var s_cost=parseInt($('#stilt').text());
  var c_cost=parseInt($('#cover').text());
  var total=$("#total_cost").val();
  var park_gst=$("#park_gst").val();
  var val=0;
  var netcost=0;
  var gst=$("#total_gst").val();
  var sub_data=sub_data;
  
                var realvalues = [];
                $('#park :selected').each(function(i, selected) {
                     realvalues[i] = $(selected).val();
                });

                 jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-parking-cost',
              type: 'POST',
              dataType: 'json',
              data: {sub_data:sub_data,arr:realvalues,o_cost:o_cost,s_cost:s_cost,c_cost:c_cost,total:total,park_gst:park_gst},
              success: function (data) {
                  if(data.final_cost)
                  {  
                     $("#f_cost").text(data.final_cost);
                  }
                  else
                  {  
                     $("#f_cost").html(data.final_cost);
                  }
                  if(data.left_amount)
                  {  
                     $("#pa_amount").val(data.left_amount);
                     $("#left_amount").text(data.left_amount);
                     
                  }
                  else
                  { 
                    $("#pa_amount").val(data.left_amount);
                    $("#left_amount").html("waiveOff");
                  }
                  if(data.discount)
                  {
                    $("#discount").text(data.discount);
                  }
                  else
                  {
                    $("#discount").html(data.discount);
                  }
                  if(data.total)
                  {
                    $("#tot").text(parseFloat(data.total).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                  }
                  else
                  {
                    $("#tot").text(parseFloat(data.total).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                  }  
                  if(data.p_gst)
                  { 
                    gst= parseFloat(gst) + parseFloat(data.p_gst);
                    $("#gst").text(parseFloat(gst).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                    $("#tot_gst").val(gst);
                  }
                  else
                  {
                    $("#gst").html(parseFloat(gst).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                    $("#tot_gst").val(gst);
                  }

                 
                  netcost=parseFloat(gst) + parseFloat(data.total);
                  $("#netcost").text(parseFloat(netcost).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                  $("#ncost").val(parseFloat(netcost));
                 

                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_new_span()
{
   var o_cost=parseInt($('#open').text());
   var s_cost=parseInt($('#stilt').text());
   var c_cost=parseInt($('#cover').text());
   var total=$("#total_cost").val();
   var park_gst=$("#park_gst").val();
   var gst=$("#total_gst").val();
   var realvalues = [];
                $('#park :selected').each(function(i, selected) {
                     realvalues[i] = $(selected).val();
                });
    jQuery.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: BASE_URL + '/get-parking-old-cost',
              type: 'POST',
              dataType: 'json',
              data: {arr:realvalues,o_cost:o_cost,s_cost:s_cost,c_cost:c_cost,total:total,park_gst:park_gst},
              success: function (data) {  
                 if(data.final_cost)
                  {  
                     $("#f_cost").text(data.final_cost);
                  }
                  else
                  {  
                     $("#f_cost").html(data.final_cost);
                  }
                  if(data.left_amount)
                  {  
                     $("#pa_amount").val(data.left_amount);
                     $("#left_amount").text(data.left_amount);
                     
                  }
                  else
                  { 
                    $("#pa_amount").val(data.left_amount);
                    $("#left_amount").html("waiveOff");
                  }
                  if(data.discount)
                  {
                    $("#discount").text(data.discount);
                  }
                  else
                  {
                    $("#discount").html(data.discount);
                  }
                  if(data.total)
                  {
                    $("#tot").text(parseFloat(data.total).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                  }
                  else
                  {
                    $("#tot").text(parseFloat(data.total).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                  }  
                  if(data.p_gst)
                  { 
                    gst= parseFloat(gst) + parseFloat(data.p_gst);
                    $("#gst").text(parseFloat(gst).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                    $("#tot_gst").val(gst);
                  }
                  else
                  {
                    $("#gst").html(parseFloat(gst).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                    $("#tot_gst").val(gst);
                  }

                 
                  netcost=parseFloat(gst) + parseFloat(data.total);
                  $("#netcost").text(parseFloat(netcost).toLocaleString('en-IN', {
                      maximumFractionDigits: 2,
                      style: 'currency',
                      currency: 'INR'
                    }));
                  $("#ncost").val(parseFloat(netcost));
                 
              },
                error: function (error) {
                     console.log(error);
                 }
             });          
}


$('#search').click(function () {
  $('#preloader').show();
  var id=$("#prop_id").val();
  var prop_type=$("#prop_type").val();
  var floor=$("#floor").val();
  var tower=$("#tower").val();
  var sa=$("#sa").val();
  var plotsize=$("#plotsize").val();
  var facing=$("#facing").val();
  var accom=$("#accom").val();
  var check;
  if($("#check").prop("checked") == true) { check=1; } else { check=0; }
      jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-inventory-detail-web',
              type: 'POST',
              //dataType: 'json',
              data: {id:id,prop_type:prop_type,tower:tower,floor:floor,plotsize:plotsize,sa:sa,accom:accom,facing:facing,check:check},
              success: function (data) {

                $('#preloader').hide();
                   $("#table_div").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
      
 });


function get_div_1(inv_id,prop_id)
{  
   
   var field_id=inv_id;
   var prop_id=prop_id;
   jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-hold_unit-quotation-div',
              type: 'POST',
              data: {prop_id:prop_id,field_id:field_id},
              success: function (data) {
                     
                    $("#mo_div").html(data);
                    $("#myModalget").show();
               },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_div(id)
{  
   $("#myModalget").show();
   $("#field_id").val(id);
}


function get_option(inv_id,id,field_val)
{  $("#quotation").hide();
   $("#booking_form").hide();
   if(inv_id != "" && field_val == "Hold")
   {  
      var result = confirm("Are you sure you want to hold this unit ?");
      if(result == true)
      {
        jQuery.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: BASE_URL + '/change-inventory-status',
          type: 'POST',
          //dataType: 'json',
          data: {id:inv_id},
          success: function (data) {
            alert(data);
            $('#status_'+id).prop('disabled','disabled');
          },
          error: function (error) {
            console.log(error);
          }
        });
      }
    
    }
    else if(inv_id != "" && field_val == "Book")
    { var result = confirm("Are you sure you want to book this unit ?");
      if(result == true)
      { 
          window.open(BASE_URL +'/get-booking-form/'+inv_id,'_blank');
          /*$('#preloader').show();
          jQuery.ajax({
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
                  url: BASE_URL + '/get-booking-form',
                  type: 'POST',
                  //dataType: 'json',
                  data: {id:inv_id},
                  success: function (data) {

                       $('#preloader').hide();
                       $("#quotation").hide();
                       $("#booking_form").show();
                       $("#booking_form").html(data);
                     },
                    error: function (error) {
                         console.log(error);
                     }
                 }); */
      }
   }
   else
   {
     alert("invalid selection");
   }
}

function get_quotation()
{ 
  
   var prop_id=$("#property_id").val();
   var field_id=$("#field_id").val();
   var parking=$("#parking").val();
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-inventory-quotation',
              type: 'POST',
              dataType: 'json',
              data: {id:prop_id,field_id:field_id,parking:parking},
              success: function (data) {
                   /*$('#preloader').hide();
                   $("#quotation").show();
                   $("#myModalget").hide();
                   $("#quotation").html(data);*/
                   if(data.success)
                  { $('#myModalget').hide();
                    window.open(BASE_URL+'/get-quotation-form/', '_blank');
                  }

                 },
                error: function (error) {
                     console.log(error);
                 }
             });
                 
}

function get_offer(id)
{  
   var prop_id=$("#prop_id").val();
   var plan_name=id;
   var inv_id=$("#inv_id").val();
   $("#payment_plan").val(plan_name);
   jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-booking-offer',
              type: 'POST',
              //dataType: 'json',
              data: {prop_id:prop_id,plan_name:plan_name,inv_id:inv_id},
              success: function (data) {
                  $("#offer_cal").html(data); 
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_state(id)
{
  jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-state',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#state").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_city(id)
{
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-city',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#city").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_state_1(id)
{
  jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-state',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#state_1").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_city_1(id)
{
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-city',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#city_1").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_state_2(id)
{
  jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-state',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#state_2").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_city_2(id)
{
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-city',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#city_2").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_state_3(id)
{
  jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-state',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#state_3").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_city_3(id)
{
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-city',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#city_3").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_state_4(id)
{
  jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-state',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#state_4").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_city_4(id)
{
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-city',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#city_4").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_state_5(id)
{
  jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-state',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#state_5").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}

function get_city_5(id)
{
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-city',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#city_5").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

/*function get_accom(val)
{  
   jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-accomodation',
              type: 'POST',
              //dataType: 'json',
              data: {id:val},
              success: function (data) {
                 if(data != "")
                 {
                  $("#accom").html(data);
                 } else
                 {
                   $("#accom").html('<option>No data found.</option>');
                 }
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}*/

function get_area(val,type)
{  
   jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-area',
              type: 'POST',
              //dataType: 'json',
              data: {id:val,type:type},
              success: function (data) {
                 if(type == "Flat")
                 {
                   if(data != "")
                   { 
                     $("#sa").html(data);
                   } else
                   {
                     $("#sa").html('<option>No data found.</option>');
                   }
                  }
                 },
                error: function (error) {
                     console.log(error);
                 }
             });
}










