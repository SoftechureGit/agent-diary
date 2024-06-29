<?php include('include/header.php');?>
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
    margin-top: 10px;
}
}
.dataTables_wrapper {
    padding: 0px !important;
}
</style>
<?php include('include/sidebar.php');?>








        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <!--<div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>-->
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Project List</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" style="margin-right: 8px;"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                        <a href="<?= base_url(ADMIN_URL."property-products") ?>" style="margin-right: 8px;"><button type="button" class="btn btn-dark">View List of Product</button></a><?php //  } ?>
                                        <a href="<?= base_url(ADMIN_URL."product_detail") ?>"><button type="button" class="btn btn-dark">Add Project</button></a><?php //  } ?>
                                    </div>
                                </div>

<div class="row">
    <div class="col-md-12">
        <div id="demo" class="collapse" style="margin-top: 16px;border: 1px solid #f2f2f8;padding: 10px 15px 0px;display: block;">
            <form method="post" onsubmit="return filterRecords()" autocomplete="offf">
                <div class="form-row">


<div class="form-group col-md-12">
    <h5 style="margin-top: 8px;margin-bottom: 15px;">Filter</h5>
    <!-- <label>Search By:</label> -->
    <input type="text" class="form-control" id="search_by" name="search_by" placeholder="Search by name" style="height: 44px;font-size: 15px;">
</div>

<div class="form-group col-md-4">
    <!-- <label>Group:</label> -->
    <select class="form-control" id="builder_group_id" name="builder_group_id" onchange="getBuilders(this.value)">
      <option value="">Select Group</option>
      <?php foreach ($builder_group_list as $builder_group) { ?>
        <option value="<?= $builder_group->builder_group_id ?>" ><?= $builder_group->builder_group_name ?></option>
      <?php } ?>
    </select>
</div>

<div class="form-group col-md-4">
    <!-- <label>Builder:</label> -->
    <select class="form-control" id="builder_id" name="builder_id">
      <option value="">Select Builder</option>
      <?php foreach ($builder_list as $builder) { ?>
        <option value="<?= $builder->builder_id ?>" ><?= $builder->firm_name ?></option>
      <?php } ?>
    </select>
</div>

<div class="form-group col-md-4">
    <!-- <label>Agent:</label> -->
    <select class="form-control" id="agent_id" name="agent_id">
      <option value="">Select Agent</option>
      <?php foreach ($agent_list as $agent) { ?>
        <option value="<?= $agent->user_id ?>" ><?= ($agent->is_individual)?(ucwords($agent->first_name.' '.$agent->last_name)):$agent->firm_name ?></option>
      <?php } ?>
    </select>
</div>

<div class="form-group col-md-4">
    <!-- <label>Type of Project:</label> -->
    <select class="form-control" id="project_type" name="project_type" onchange="getUnitTypes()">
          <option value="">Select Project Type</option>
          <?php foreach ($project_type_list as $project_type) { ?>
            <option value="<?= $project_type->product_type_id ?>" ><?= $project_type->product_type_name ?></option>
          <?php } ?>
    </select>
</div>

<div class="form-group col-md-4 PropertyHide">
    <!-- <label>Unit Type:</label> -->
    
<select class="form-control" id="property_type" name="property_type" onchange="propertType('2')">
          <option value="">Select Unit Type</option>
          <?php foreach ($unit_type_list as $unit_type) { ?>
            <option value="<?= $unit_type->unit_type_id ?>" ><?= $unit_type->unit_type_name ?></option>
          <?php } ?>
    </select>
</div>

<div class="form-group col-md-4">
    <!-- <label>Project Status:</label> -->
    <select class="form-control" id="project_status" name="project_status">
      <option value="">Select Status</option>
      <?php foreach ($project_status_list as $project_status) { ?>
        <option value="<?= $project_status->project_status_id ?>" ><?= $project_status->project_status_name ?></option>
      <?php } ?>

    </select>
</div>

<div class="form-group col-md-4 adv_search">
    <!-- <label>State:</label> -->
    <select class="form-control" id="state_id" name="state_id" onchange="getCity(this.value)">
        <option value="">Select State</option>
          <?php foreach ($state_list as $state) { ?>
        <option value="<?= $state->state_id ?>" <?= ($this->input->get('state')==$state->state_id)?"selected":"" ?>><?= $state->state_name ?></option>
          <?php } ?>
    </select>
          
</div>

<div class="form-group col-md-4 adv_search">

    <!-- <label>City:</label>     -->   
     <select class="form-control" id="city_id" name="city_id" onchange="getLocation(this.value)">
        <option value="" selected>Select City</option>
        <?php foreach ($city_list as $city) { ?>
        <option value="<?= $city->city_id ?>" <?= ($this->input->get('city')==$city->city_id)?"selected":"" ?>><?= $city->city_name ?></option>
          <?php } ?>
    </select>
</div>

<div class="form-group col-md-4">
    <!-- <label>Location:</label> -->

    <select class="form-control"id="location" name="location">
         <option value="">Select Location</option>
          <?php foreach ($location_list as $location) { ?>
        <option value="<?= $location->location_id ?>" <?php if($product_detail->location==$location->location_id) { echo 'selected'; } ?>><?= $location->location_name ?></option>
          <?php } ?>
     </select>
</div>

                    <div class="form-group col-md-12" align="right">
                        <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo" style="margin-right: 8px;">Cancel</button>

                        <button type="submit" class="btn btn-info">Apply</button>
                    </div>

                </div>
            </form>
      </div>
    </div>
</div>

                                <div>
                                <?php if($this->session->flashdata('success_msg')) { ?>
                                    <div class="alert alert-success pd8" style="margin-top: 15px;">
                                      <?php echo $this->session->flashdata('success_msg'); ?>
                                    </div>
                                <?php } else if($this->session->flashdata('error_msg')) { ?>
                                    <div class="alert alert-danger pd8" style="margin-top: 15px;">
                                      <?php echo $this->session->flashdata('error_msg'); ?>
                                    </div>
                                <?php } ?>
                                </div>

                                <?php if(0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>DOR</th>
                                                <th>Type of Property</th>
                                                <th>Unit Type</th>
                                                <th>Property Status</th>
                                                <th>No of Unit</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Task</th>
                                                <th class="text-center">Status</th>
                                                <!--<th class="text-center" style="width: 50px;">Action</th>-->
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Sr.</td>
                                                <td>21-10-2019</td>
                                                <td>Residencial</td>
                                                <td>Flat</td>
                                                <td>Ready to Move</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>For Sale</td>
                                                <td class="text-center"><span class="label label-pill label-success">Open</span></td>
                                                <!--<td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn mb-1 btn-dark dropdown-toggle  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Open</a> 
                                                            <a class="dropdown-item" href="#">Close</a>
                                                        </div>
                                                    </div>
                                                </td>-->
                                            </tr>

                                            <tr>
                                                <td>Sr.</td>
                                                <td>21-10-2019</td>
                                                <td>Residencial</td>
                                                <td>Flat</td>
                                                <td>Under Construction</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>For Rent</td>
                                                <td class="text-center"><span class="label label-pill label-danger">Close</span></td>
                                                <!--<td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn mb-1 btn-dark dropdown-toggle  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Open</a> 
                                                            <a class="dropdown-item" href="#">Close</a>
                                                        </div>
                                                    </div>
                                                </td>-->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="empTable">
                                        <thead>
                                            <tr>
                                                <th class="nosort" style="width: 30px;">S.No</th>
                                                <th>DOR</th>
                                                <th>Type of Project</th>
                                                <th>Unit Type</th>
                                                <th>Name of Project</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th class="nosort">No of Unit</th>
                                                <th>Name of Builder</th>
                                                <th class="nosort">Agent Name</th>
                                                <th class="nosort" style="width: 80px;">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
 <?php include('include/footer.php');?>  
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script type="text/javascript">

    var table=$('#empTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
         'url':'<?= base_url(ADMIN_URL.'api/product_list') ?>',
           'data': function(data){
              data.search_by = $('#search_by').val();
              data.builder_group_id = $('#builder_group_id').val();
              data.builder_id = $('#builder_id').val();
              data.agent_id = $('#agent_id').val();
              data.project_type = $('#project_type').val();
              data.property_type = $('#property_type').val();
              data.project_status = $('#project_status').val();
              data.state_id = $('#state_id').val();
              data.city_id = $('#city_id').val();
              data.location = $('#location').val();
           }
      },
      'columns': [
         { data: 'product_id' },
         //{ render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
         { data: 'date_register' },
         { data: 'product_type_name' },
         { data: 'unit_type_name' },
         { data: 'project_name' },
         { data: 'location_name' },
         { data: 'city_name' },
         {  "render": function (data, type, row) { return ""; } },
         {  "render": function (data, type, row) { return row.firm_name; } },
         {  "render": function (data, type, row) { return ""; } },

         {  "render": function (data, type, row) { return "<a href='<?= base_url(ADMIN_URL.'product-view/') ?>"+row.product_id+"' target='_blank' class='btn btn-dark btn-sm btn-rounded' style='color:white;margin-top:5px;'><i class='fa fa-eye'></i></a> &nbsp;&nbsp;<a href='<?= base_url(ADMIN_URL.'agent_product') ?>?agent_id="+row.agent_id+"&product_id="+row.product_id+"' target='_blank' class='btn btn-success btn-sm btn-rounded' style='color:white;'><i class='fa fa-edit'></i></a>"; } },
        ],
        'aoColumnDefs': [
            {
                'bSortable': false,
                'aTargets': ['nosort']
            }
        ]
    });

    function filterRecords() {
      table.ajax.reload();
      return false;
    }

    function getCity(state_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url('get_city') ?>",
        data: {state_id:state_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var city_list = obj.city_list;
              var row = "<option value=''>Select City</option>";
              for (var i = 0; i<city_list.length; i++) {
                row += "<option value='"+city_list[i].city_id+"'>"+city_list[i].city_name+"</option>";
              }
              $("#city_id").html(row);
            }
            else {
              $("#city_id").html("<option value=''>Select City</option>");
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

function getLocation(city_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_locations') ?>",
        data: {city_id:city_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          console.log(response);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var location_list = obj.location_list;
              var row = "<option value=''>Select Location</option>";
              for (var i = 0; i<location_list.length; i++) {
                row += "<option value='"+location_list[i].location_id+"'>"+location_list[i].location_name+"</option>";
              }
              $("#location").html(row);
            }
            else {
              $("#location").html("<option value=''>Select Location</option>");
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

function getBuilders(builder_group_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_builders') ?>",
        data: {builder_group_id:builder_group_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          console.log(response);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var builder_list = obj.builder_list;
              var row = "<option value=''>Select Builder</option>";
              for (var i = 0; i<builder_list.length; i++) {
                row += "<option value='"+builder_list[i].builder_id+"'>"+builder_list[i].firm_name+"</option>";
              }
              $("#builder_id").html(row);
            }
            else {
              $("#builder_id").html("<option value=''>Select Builder</option>");
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

if ($("#project_type").val()==3) {
    $(".PropertyHide").hide();
  }
  else {

    $(".PropertyHide").show();
  }

function getUnitTypes() {
  
  if ($("#project_type").val()==3) {
    $(".PropertyHide").hide();
  }
  else {

    $(".PropertyHide").show();
  }


  if ($("#project_type").val()=='3') {
    //propertType('1');
    //getUnitDetails();
    propertType('2');
  }
  else {
    $("#property_type").html("<option value=''>Select Property Type</option>");

    /*$(".comm_detail").html("");
    $(".comm_block_detail").html("");
    if ($("#project_type").val()=='3' && $("#property_type").val()!='') {
      $(".comm_detail_main").show();
    }
    else {
      $(".comm_detail_main").hide();
    }*/
    var product_type_id = $("#project_type").val();
    $.ajax({
          type: "POST",
          url: "<?= base_url(ADMIN_URL.'api/get_unit_types') ?>",
          data: {product_type_id:product_type_id},
          beforeSend: function (data) {
          },
          success: function (response) {
            //console.log(response);
            var obj;
            try {
              obj = JSON.parse(response);
              if (obj.status=='success') {
                var unit_type_list = obj.unit_type_list;
                var row = "<option value=''>Select Property Type</option>";
                for (var i = 0; i<unit_type_list.length; i++) {
                  row += "<option value='"+unit_type_list[i].unit_type_id+"'>"+unit_type_list[i].unit_type_name+"</option>";
                }
                $("#property_type").html(row);
              }
              else {
                $("#property_type").html("<option value=''>Select Property Type</option>");
              }
              propertType('1');
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
}

function propertType(tt) {

}
</script>