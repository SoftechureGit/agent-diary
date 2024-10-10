<?php include('include/header.php');?>
<style>
   @media only screen and (max-width : 576px) {
   .mg-10 {
   margin-top: 10px;
   }
   }

   .loader_progress{
    display: none;
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url("<?= base_url('public/front/ajax-loader.gif') ?>") 
                  50% 50% no-repeat #fff3f38f;
    }
</style>
<?php include('include/sidebar.php');?>
<div class="content-body">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6 col-sm-6 col-xs-6">
                        <h4 class="card-title">Update Additional Cost</h4>
                     </div>
                  </div>
                  <div class="basic-form">

                    <div class="inventory-error-msg">
                      <?php if($this->session->flashdata('error_msg')) { ?>
                        <div class="alert alert-danger pd8">
                          <?php echo $this->session->flashdata('error_msg'); ?>
                        </div>
                      <?php } ?>
                      <?php if($this->session->flashdata('success_msg')) { ?>
                        <div class="alert alert-success pd8">
                          <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                      <?php } ?>
                    </div>

                     <form method="post" id="inventory-form" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-row">
                           <div class="form-group col-md-4">
                              <label>Type of Project:</label>
                              <select class="form-control" id="product_type_id" name="product_type_id" onchange="propertType()">
                                 <option value="">Select Project Type</option>
                                 <?php foreach ($product_type_list as $item) { ?>
                                 <option value="<?= $item->product_type_id ?>" ><?= $item->product_type_name ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <!--<div class="form-group col-md-4">
                              <label>Type of Property:</label>
                              <select class="form-control" id="unit_type_id" name="unit_type_id" onchange="propertType()">
                                 <option value="">Select Property Type</option>
                                 <?php foreach ($unit_type_list as $unit_type) { ?>
                                 <option value="<?= $unit_type->unit_type_id ?>" ><?= $unit_type->unit_type_name ?></option>
                                 <?php } ?>
                              </select>
                           </div>-->
                           <div class="form-group col-md-4">
                              <label>Select Project:</label>
                              <select class="form-control" id="product_id" name="product_id" onchange="selectProject()">
                                 <option value="">Select Project</option>
                              </select>
                           </div>
                           <div class="form-group col-md-12 update_basic_cost_fields">
                           </div>
                        </div>

                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>

<div class="loader_progress"></div>

<?php include('include/footer.php');?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

$("#inventory-form").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("inventory-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/api/additional_cost_update') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".inventory-error-msg").html('');
          $(".inventory-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {

          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".inventory-btn").html("Update").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {
                    $('html, body').animate({
                        scrollTop: $("html").offset().top
                    }, 1000);

                    //$(".inventory-error-msg").html(alertMessage('success',obj.message));

                    //getBasicCostData();

                    window.location.href='';
                }
                else {
                  $(".inventory-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".inventory-btn").html("Update").prop('disabled',false);
                $(".inventory-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },100);
        },
        error: function () {
            $(".inventory-btn").html("Save & Next").prop('disabled',false);
          $(".inventory-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

function getUnitTypes() {
 
    $("#unit_type_id").html("<option value=''>Select Property Type</option>");
    $("#product_id").html("<option value=''>Select Project</option>");

    $(".update_basic_cost_fields, .update_basic_cost_list").html("");

   var product_type_id = $("#product_type_id").val();
   $.ajax({
         type: "POST",
         url: "<?= base_url(AGENT_URL.'api/get_unit_types') ?>",
         data: {product_type_id:product_type_id},
         beforeSend: function (data) {
         },
         success: function (response) {
           var obj;
           try {
             obj = JSON.parse(response);
             if (obj.status=='success') {
               var unit_type_list = obj.unit_type_list;
               var row = "<option value=''>Select Property Type</option>";
               for (var i = 0; i<unit_type_list.length; i++) {
                 row += "<option value='"+unit_type_list[i].unit_type_id+"'>"+unit_type_list[i].unit_type_name+"</option>";
               }
               $("#unit_type_id").html(row);
             }
             else {
               $("#unit_type_id").html("<option value=''>Select Property Type</option>");
             }
           }
           catch(err) {
             alert('Some error occurred, please try again.');
           }
         },
         error: function () {
             alert('Some error occurred, please try again.');
            
         }

     });
}

function propertType() {
    $("#product_id").html("<option value=''>Select Project</option>");
   $(".update_basic_cost_fields, .update_basic_cost_list").html("");
   var product_type_id = $("#product_type_id").val();

   $.ajax({
         type: "POST",
         url: "<?= base_url(AGENT_URL.'api/get_project_list_by_product_type') ?>",
         data: {product_type_id:product_type_id},
         beforeSend: function (data) {
            $(".loader_progress").show();
         },
         success: function (response) {
            $(".loader_progress").hide();
           var obj;
           try {
             obj = JSON.parse(response);
             if (obj.status=='success') {
               var items = obj.items;
               var row = "<option value=''>Select Project</option>";
               for (var i = 0; i<items.length; i++) {
                 row += "<option value='"+items[i].id+"'>"+items[i].name+"</option>";
               }
               $("#product_id").html(row);
             }
             else {
               $("#product_id").html("<option value=''>Select Project</option>");
             }
           }
           catch(err) {
             alert('Some error occurred, please try again.');
           }
         },
         error: function () {
            $(".loader_progress").hide();
             alert('Some error occurred, please try again.');
            
         }

     });
}

function selectProject() {
   
   $(".update_basic_cost_fields, .update_basic_cost_list").html("");


   var product_id = $("#product_id").val();

    $.ajax({
         type: "POST",
         url: "<?= base_url(AGENT_URL.'api/get_update_additional_cost_fields') ?>",
         data: {product_id:product_id},
         beforeSend: function (data) {
            $(".loader_progress").show();
         },
         success: function (response) {
            $(".loader_progress").hide();
           $(".update_basic_cost_fields").html(response);
         },
         error: function () {
            $(".loader_progress").hide();
         }
    });

    /*$.ajax({
         type: "POST",
         url: "<?= base_url(AGENT_URL.'api/get_update_basic_cost_list') ?>",
         data: {product_id:product_id},
         beforeSend: function (data) {
         },
         success: function (response) {
           $(".update_basic_cost_list").html(response);
         },
         error: function () {
         }
    });*/
}

function getBasicCostData(f='') {
    var product_id = $("#product_id").val();
    var unit_code = $("#unit_code").val();
    var floor_id = $("#floor_id").val();
    var tower_id = $("#tower_id").val();
    var cost_type = $("#cost_type").val();

    if (f=='') { 
        //$("#input_size").val(""); 
    }
    $(".inventory-btn").prop('disabled',true);
   $(".new_rate").hide();
    $(".inventory_unit_list").html("");

   $.ajax({
         type: "POST",
         url: "<?= base_url(AGENT_URL.'api/get_additional_cost_data') ?>",
         data: {product_id:product_id,unit_code:unit_code,floor_id:floor_id,tower_id:tower_id,cost_type:cost_type},
         beforeSend: function (data) {
         },
         success: function (response) {
           var obj;
           try {
             obj = JSON.parse(response);
             if (obj.status=='success') {
               //$("#input_size").val(obj.size);
               //$("#current_rate").val(obj.current_rate);
               //$("#current_rate_unit").val(obj.current_rate_unit);
               $("#new_rate").val("");
               $("#new_rate_unit").val("");

               /*if(obj.current_rate==""){
                    $("#new_rate").prop('required',true);
                    $("#new_rate_unit").prop('required',true);
               }
               else {
                    $("#new_rate").prop('required',false);
                    $("#new_rate_unit").prop('required',false);
               }*/

              $(".inventory-btn").prop('disabled',false);
              $(".new_rate").show();

               var items = obj.items;
               var row_html = "";
               for (var i = 0; i<items.length; i++) {
                var row = items[i];
                 var slabel = "";
                 //if (row.selected=='1') { slabel = "checked"; }
                 row_html += "<tr>"+
                    "<td class='text-center'><input type='checkbox' class='chk_selection' name='in_unit["+row.inventory_id+"][chk]' value='1' "+slabel+" /> <input type='hidden' name='in_unit["+row.inventory_id+"][unit_id]' value='"+row.inventory_id+"' /></td>"+
                    "<td class='text-center'>"+(i+1)+"</td>"+
                    "<td class='text-center'>"+row.unit_ref_no+"</td>"+
                    "<td class='text-center'>"+row.current_rate+"</td>"+
                    "<td class='text-center'>"+row.floor+"</td>"+
                    "<td class='text-center'>"+row.size+"</td>"+
                    "<td class='text-center'>"+row.block+"</td>"+
                    "<td class='text-center'>"+row.unit_type+"</td>"+
                    "</tr>";
               }
               $(".inventory_unit_list").html(row_html);

               if(items.length == 0){

                console.log(items.length)
                $(".inventory_unit_list").html(`<tr><td colspan='10' class='text-center'>No data found</td></tr>`);
               }
             }
             else {
               
             }
           }
           catch(err) {
             alert('Some error occurred, please try again.');
           }
         },
         error: function () {
             alert('Some error occurred, please try again.');
            
         }

     });

    /*var product_id = $("#product_id").val();
    var unit_code = $("#unit_code").val();
    var floor_id = $("#floor_id").val();
    var tower_id = $("#tower_id").val();

    $("#input_size").val("");

    $.ajax({
         type: "POST",
         url: "<?= base_url(AGENT_URL.'api/get_basic_cost_data') ?>",
         data: {product_type_id:product_type_id,unit_code:unit_code,floor_id:floor_id,tower_id:tower_id},
         beforeSend: function (data) {
         },
         success: function (response) {
            alert(1);
           
         },
         error: function () {
             alert('Some error occurred, please try again.');
            
         }

     });*/
}

/*setTimeout(function() {
    $("#product_type_id").val("2");
    getUnitTypes();

    setTimeout(function() {
        $("#unit_type_id").val("1");
        propertType();

        setTimeout(function() {
            $("#product_id").val("1");
            selectProject();

            
        },200);

    },200);

},100);*/

/*setTimeout(function() {

                getBasicCostData();
            },5000);*/
</script>