<?php include 'include/header.php' ?>

<style>
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

    .btn {
      outline: none;
      border: none;
      box-shadow: none;
    }
</style>

<div class="loader_progress"></div>

<div id="preloader" style="display: none;">
  <div id="loader"></div>
</div>

<div class="container">
  <div class="inventory-selection">
     <div class="inventory-page">
      <div class="row">
         <div class="col-md-12">
          <div class="col-md-2 pull-left">
             <div class="logo-project"> <img src="<?= base_url('uploads/images/project/logo/'.$product_detail->project_logo) ?>" alt="Project logo"> </div>
           </div>
        </div>
         <div class="col-md-12">
          <h4 class="text-center title">
             <label>Name Of Project</label> : <?= $product_detail->project_name ?></h4>
        </div>
         <div class="col-md-12">

           <form method="post" id="inventory-form" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" id="product_id" name="product_id" value="<?= $product_detail->product_id ?>">
          <div class="inventory-box">
          <div class="inventory-error-msg">
          </div>
                          <div class="col-md-6"> <b>Tower</b> </div>
             <div class="col-md-6">
              <select class="form-control" id="tower_id" name="tower_id">
                 <option value=""> Select Tower </option>
         <?php foreach ($block_list as $item) { ?>
            <option value="<?= $item['block_id'] ?>"><?= $item['block_name'] ?></option>
          <?php } ?>
                                </select>
            </div>

               <div class="col-md-6"> <b>Accomodation </b> </div>
             <div class="col-md-6">
              <select class="form-control" id="accomodation_id" name="accomodation_id">
                 <option value=""> Select Accomodation </option>
         <?php foreach ($accomodation_list as $accomodation) { ?>
            <option value="<?= $accomodation->accomodation_id ?>" ><?= $accomodation->accomodation_name ?></option>
          <?php } ?>
               </select>
            </div>
                        <div class="col-md-6"> <b>SA</b> </div>
             <div class="col-md-6">
              <select class="form-control" id="unit_code" name="unit_code">
                 <option value=""> Select SA </option><?php foreach ($unit_code_list as $item) { ?>
                  <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                <?php } ?>
                                </select>
            </div>

                <div class="col-md-6"> <b>Floor</b> </div>
             <div class="col-md-6">
              <select class="form-control" id="floor_id" name="floor_id">
                 <option value=""> Select Floor </option>
         <?php foreach ($floor_list as $floor) { ?>
            <option value="<?= $floor->floor_id ?>" ><?= $floor->floor_name ?></option>
          <?php } ?>
                                </select>
            </div>
                          <input type="hidden" id="prop_id" value="371">
             <input type="hidden" id="prop_type" value="Flat">
             <div class="col-md-12">
<label class="checkbox-inline"><input type="checkbox" name="check" id="check_inventory_status" name="check_inventory_status" value="1">Show Vacent Only</label>
</div>
             <div class="col-md-12">
              <button type="submit" class="btn btn-info pull-right" id="search">Search</button>
            </div>
            
            <div class="col-md-12">
            <div class="hint-panel">
            <div class="col-md-4">
            <p><span class="white"></span><span>Available</span></p></div>
            <div class="col-md-4">
            <p><span class="red"></span><span>Book</span></p> </div>
            <div class="col-md-4">
            <p><span class="lemon"></span><span>Hold</span></p> </div>
            </div>
             </div>
            
            
            
           </div>

         </form>

        </div>
       </div>
    </div>
     <div class="inventory-table">
      <div class="row">
         <div class="col-md-12">
          <div class="table-responsive" style="margin:45px 0;" id="table_div"><table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>S.no</th>
                          <th>Unit No.</th>
                          <th>Unit Ref.</th>
                          <th>Unit Size</th>
                                                    <th>Accomodation</th>
                                                    <th>Floor</th>
                          <th>Tower</th>
                                                    <th>Status</th>
                          <th>View Layout </th>
                          <th>Get Quotation</th>
                          <th>Action </th>
                        </tr>
                      </thead>
                      <tbody class="input_fields_inventory inventory_unit_list"></tbody>
                    </table>
                    
                    
                    
       <div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        
        <div class="modal-content">
            <div class="modal-body">
                <img class="img-fluid" src="" alt="">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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

<?php include 'include/footer.php' ?>

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


      var product_id = $("#product_id").val();
    var unit_code = $("#unit_code").val();
    var floor_id = $("#floor_id").val();
    var tower_id = $("#tower_id").val();
    var accomodation_id = $("#accomodation_id").val();
    var inventory_status = ($("#check_inventory_status").prop("checked") == true)?1:0;
    $(".inventory_unit_list").html("");

   $.ajax({
         type: "POST",
         url: "<?= base_url('get_update_inventory_status_data') ?>",
         data: {product_id:product_id,unit_code:unit_code,floor_id:floor_id,tower_id:tower_id,accomodation_id:accomodation_id,inventory_status:inventory_status},
         beforeSend: function (data) {
            $("#preloader").show();
         },
         success: function (response) {
            $("#preloader").hide();
           var obj;
           try {
             obj = JSON.parse(response);
             if (obj.status=='success') {

               var items = obj.items;
               var row_html = "";
               for (var i = 0; i<items.length; i++) {
                var row = items[i];
                 var slabel = "";
                 var is = row.inventory_status;
                 var ds = "";
                 if (is!="4") { ds = "<input type='checkbox' class='chk_selection' name='in_unit["+row.inventory_id+"][chk]' value='1' "+slabel+" />"; }
                 
                 var inventory_status_name = "";
                 var inventory_bg = "available";
                 var action_disabled = "";
                 if (is=="1") {
                    inventory_status_name = "<span class=''>"+row.inventory_status_name+"</span>";
                    inventory_bg = "available";
                 }
                 else if (is=="2") {
                    inventory_status_name = "<span class=''>"+row.inventory_status_name+"</span>";
                 }
                 else if (is=="3") {
                    inventory_status_name = "<span class=''>"+row.inventory_status_name+"</span>";
                    inventory_bg = "hold";
                 }
                 else if (is=="4") {
                    inventory_status_name = "<span class=''>"+row.inventory_status_name+"</span>";
                    inventory_bg = "booked";
                    action_disabled = "disabled";
                 }
                 row_html += "<tr class='"+inventory_bg+"'>"+
"<td class='text-center'>"+(i+1)+"</td>"+
"<td>"+row.unit_no+"</td>"+
"<td>"+row.unit_ref_no+"</td>"+
"<td>"+row.size+"</td>"+
"<td>"+row.unit_type+"</td>"+
"<td>"+row.floor+"</td>"+
"<td>"+row.block+"</td>"+
"<td class='text-center'>"+inventory_status_name+"</td>"+
"<td>"+
"</td>"+
"<td><button class='btn btn-default getqute-btn' onclick='get_div();'>Get qut.</button></td>"+
"<td><select class='form-control' id='status_1' onchange='get_option();' "+action_disabled+">"+
"<option value=''>Select Option</option>"+
"<option value='Hold'>Hold</option>"+
"<option value='Book'>Book</option>"+
"</select></td>"+
"</tr>";
               }
               $(".inventory_unit_list").html(row_html);

               if (obj.items==0) {
               var row_html = "<tr>"+
                    "<td colspan='11' class='text-center' style='font-size:16px;padding:18px;'>No Records</td>"+
                    "</tr>";
               $(".inventory_unit_list").html(row_html);
               }
             }
             else {
               var row_html = "<tr>"+
                    "<td colspan='11' class='text-center' style='font-size:16px;padding:18px;'>No Records</td>"+
                    "</tr>";
               $(".inventory_unit_list").html(row_html);
             }
           }
           catch(err) {
             alert('Some error occurred, please try again.');
           }
         },
         error: function () {
            $("#preloader").hide();
             alert('Some error occurred, please try again.');
            
         }

     });


   }
});
</script>