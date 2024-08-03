<?php include('include/header.php'); ?>
<style>
  /*  */
  .modal-xl {
    max-width: 1140px;
  }

  .set_property_form .theme-form .card {
    margin: 0 !important;
    box-shadow: unset !important;
  }

  .set_property_form .theme-form .card-body {
    padding: 0;
  }

  .inventory-list-container table .fa {
    cursor: pointer;
  }

  #view-inventory-details-Modal .inventory-details-container table tr,
  #view-inventory-details-Modal .inventory-details-container table th,
  #view-inventory-details-Modal .inventory-details-container table td {
    border-color: #00000075 !important;
    color: #000000;
  }

  /*  */


  @media only screen and (max-width : 576px) {
    .mg-10 {
      margin-top: 10px;
    }
  }

  .loader_progress {
    display: none;
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("<?= base_url('public/front/ajax-loader.gif') ?>") 50% 50% no-repeat #fff3f38f;
  }

  .project_inventory {
    width: 100%;
    min-height: 350px;
  }

  .cp {
    cursor: pointer;
  }
</style>
<?php include('include/sidebar.php'); ?>

<div class="content-body">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <h4 class="card-title">Manage Inventory</h4>
              </div>
            </div>
            <div class="basic-form">

              <div class="inventory-error-msg">

                <div>
                  <?php if ($this->session->flashdata('error_msg')) { ?>
                    <div class="alert alert-danger pd8">
                      <?php echo $this->session->flashdata('error_msg'); ?>
                    </div>
                  <?php } ?>
                  <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class="alert alert-success pd8">
                      <?php echo $this->session->flashdata('success_msg'); ?>
                    </div>
                  <?php } ?>

                </div>
              </div>
    
              <form method="post" id="inventory-form" enctype="multipart/form-data" autocomplete="off">
                <div class="form-row">

                  <div class="form-group col-md-6">
                    <label>Builder:</label>
                    <select class="form-control" id="builder_id" name="builder_id" onchange="getProjects()">
                      <option value="">Select Builder</option>
                      <?php foreach ($builder_list as $builder) { ?>
                        <option value="<?= $builder->builder_id ?>"><?= $builder->firm_name ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Select Project:</label>
                    <select class="form-control" id="product_id" name="product_id" onchange="get_project_inventory()" disabled>
                      <option value="">Select Project</option>
                    </select>
                  </div>

                  <!-- <div class="project_inventory"></div> -->


                </div>
              </form>

              <div class="col-md-12 mb-4 px-0">

                <!-- Add Inventory -->
                <div class="add-inventory-container d-none">
                  <div class="text-right">

                    <button type="button" class="btn btn-success text-white" onclick="downloadSample()">
                        Download Sample File
                    </button>
                    <button type="button" class="btn btn-dark uplaod-excel-file-invetory">
                        Upload Excel File
                    </button>
                    <button type="button" class="btn btn-primary add-edit-inventory">
                        Add Inventory
                    </button>

                  </div>
                </div>
                <!-- End Add Inventory -->
                </div>

              <!-- Add Inventory -->
              <div class="add-inventory-container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="inventory-list-container">

                    </div>
                  </div>
            
                </div>
              </div>
              <!-- End Add Inventory -->
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

<div class="loader_progress"></div>

<!--**********************************
                    Form
                ***********************************-->
<!-- Modal -->
<div class="modal fade" id="add-edit-inventory-Modal" role="dialog" aria-labelledby="add-edit-inventory-ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-edit-inventory-ModalLabel">Add / Edit Inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('agent/store-inventory') ?>" method="post" id="modal-inventory-form">
          <input type="hidden" name="id" value="0" class="id">
          <input type="hidden" name="product_id" value="0" class="product_id">
          <input type="hidden" name="builder_id" value="0" class="builder_id">
          <!-- Form View -->
          <div class="set_property_form w-100"></div>
          <!-- Form View -->

          <div class="row">
            <div class="container">
              <!-- Layout Upload -->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Layout Upload</label>
                  <input type="file" name="property_layout" value="" class="form-control p-1">
                  <input type="hidden" name="old_property_layout" class="old_property_layout" value="">
                  <a href="#" class="nav-link property-layout-anchor text-primary d-none px-0" target="_blank">View</a>
                </div>
              </div>
              <!-- End Layout Upload -->

              <!-- Submit Button -->
              <div class="col-md-12">
                <div class="text-center mb-2">
                  <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </div>
              </div>
              <!-- End Submit Button -->
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--**********************************
                    End Form
                ***********************************-->


 <!-- upload excel invetory  -->
      <div class="modal fade" id="add-edit-inventory-Modal-excel" role="dialog" aria-labelledby="add-edit-inventory-ModalLabel-excel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="add-edit-inventory-ModalLabel-excel">Upload Inventory</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ base_url('agent/store-inventory-excel') }}" method="post" id="modal-inventory-form">
                <input type="hidden" name="id" value="0" class="id">
                <input type="hidden" name="product_id" value="0" class="product_id">
                <input type="hidden" name="builder_id" value="0" class="builder_id">
               


                <div class="row">
                  <div class="container">
                    <!-- Layout Upload -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Excel Upload</label>
                          <input type="file" name="property_layout" value="" class="form-control p-1">
                          <input type="hidden" name="old_property_layout" class="old_property_layout" value="">
                          <a href="#" class="nav-link property-layout-anchor text-primary d-none px-0" target="_blank">View</a>
                        </div>
                      </div>
                    <!-- End Layout Upload -->

                    <!-- Submit Button -->
                    <div class="col-md-12">
                      <div class="text-center mb-2">
                        <button type="submit" class="btn btn-primary submit-btn">Uplaod</button>
                      </div>
                    </div>
                    <!-- End Submit Button -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>               
 
 <!-- end uplaod excel invetory -->



<?php include('include/footer.php'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
  //$(".loader_progress").hide();
  function getProjects() {
    var builder_id = $("#builder_id").val();
    $("#product_id").html("<option value=''>Select Project</option>");
    $(".project_inventory").html("");
    $("#product_id").prop("disabled", true);
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . 'api/get_project_by_builder') ?>",
      data: {
        builder_id: builder_id
      },
      beforeSend: function(data) {
        $(".loader_progress").show();
      },
      success: function(response) {
        $(".loader_progress").hide();
        var obj;
        try {
          obj = JSON.parse(response);
          if (obj.status == 'success') {
            var product_list = obj.product_list;

            var row = "<option value=''>Select Project</option>";
            for (var i = 0; i < product_list.length; i++) {
              row += "<option data-property-type-id='" + product_list[i].property_type_id + "' value='" + product_list[i].product_id + "'>" + product_list[i].project_name + "</option>";
            }
            $("#product_id").html(row);

            $("#product_id").prop("disabled", false);
            get_project_inventory()
          } else {
            $("#product_id").html("<option value=''>Select Project</option>");
          }
        } catch (err) {
          alert('Some error occurred, please try again.');
        }
      },
      error: function() {
        $(".loader_progress").hide();
        alert('Some error occurred, please try again.');
      }

    });
  }

 

  function alertMessage(type, message) {
    if (type == 'error') {
      type = 'danger';
    }

    return "<div class='alert alert-" + type + " alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> " + message + " </div>";
  }

  $("#inventory-form").validate({
    rules: {
      product_id: {
        required: true
      }
    },
    messages: {
      product_id: 'Please select project'
    },
    submitHandler: function(form) {
      var myform = document.getElementById("inventory-form");
      var fd = new FormData(myform);

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . '/api/project_inventory_update') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function(data) {
          $(".inventory-error-msg").html('');
          $(".inventory-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled', true);
          $(".loader_progress").show();
        },
        success: function(response) {

          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              $(".inventory-btn").html("Update").prop('disabled', false);
              $(".loader_progress").hide();

              if (obj.status == 'success') {
                get_project_inventory();
                $(".inventory-error-msg").html(alertMessage('success', obj.message));
              } else {
                $(".inventory-error-msg").html(alertMessage('error', obj.message));
              }
            } catch (err) {
              $(".inventory-btn").html("Update").prop('disabled', false);
              $(".inventory-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
              $(".loader_progress").hide();
            }
          }, 100);
        },
        error: function() {
          $(".inventory-btn").html("Save & Next").prop('disabled', false);
          $(".inventory-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
          $(".loader_progress").hide();

        }

      });

    }
  });

  // add-edit-inventory
  $(document).on('click', '.add-edit-inventory', function() {
    var id = $(this).data('id');
    var builder_id = $('#builder_id').val();
    var property_id = $('#product_id').val();
    var property_type_id = $('#product_id option:selected').data('property-type-id');

    $('#add-edit-inventory-Modal').modal('show')
    getPropertyForm(id, property_type_id, property_id, 0, 0, 'inventory');

    setTimeout(function() {
      $('#modal-inventory-form .product_id').val(property_id)
      $('#modal-inventory-form .builder_id').val(builder_id)
      $('#modal-inventory-form .id').val(id)
    }, 100)
    /*  Lead Unit Form */
    $('#modal-inventory-form').validate({
      rules: {},
      messages: {},
      submitHandler: function(form) {
        var myform = document.getElementById("modal-inventory-form");
        var fd = new FormData(myform);

        $.ajax({
          type: "POST",
          url: "<?= base_url('agent_api/store_inventory') ?>",
          data: fd,
          dataType: 'json',
          cache: false,
          processData: false,
          contentType: false,
          beforeSend: function(data) {
            $(".error-msg").html('');
            $(".submit-btn").html("Please wait...").prop('disabled', true);
          },
          success: function(res) {
            if (res.status) {
              $('#modal-inventory-form')[0].reset()
              $('#add-edit-inventory-Modal').modal('hide')
              get_project_inventory()
              // $('.ajax-msg').html(`<div class="alert alert-success">${res.message}</div>`)

              showToast('success', res.message)
            } else {
              // $('.ajax-msg').html(`<div class="alert alert-danger">${res.message}</div>`)
              showToast('danger', res.message)
            }
            $(".submit-btn").html("Submit").prop('disabled', false);
          },
          error: function() {

          }

        });

      }
    });
    /*  End Lead Unit Form */
  })
  // End add-edit-inventory


   // upload excle-inventory
   $(document).on('click', '.uplaod-excel-file-invetory', function() {
    var id = $(this).data('id');
    var builder_id = $('#builder_id').val();
    var property_id = $('#product_id').val();
    var property_type_id = $('#product_id option:selected').data('property-type-id');

    $('#add-edit-inventory-Modal-excel').modal('show')
    getPropertyForm(id, property_type_id, property_id, 0, 0, 'inventory');

    setTimeout(function() {
      $('#modal-inventory-form .product_id').val(property_id)
      $('#modal-inventory-form .builder_id').val(builder_id)
      $('#modal-inventory-form .id').val(id)
    }, 100)

    /*  Lead Unit Form */
    $('#modal-inventory-form').validate({
      rules: {},
      messages: {},
      submitHandler: function(form) {
        var myform = document.getElementById("modal-inventory-form");
        var fd = new FormData(myform);

        $.ajax({
          type: "POST",
          url: "<?= base_url('agent_api/store_inventory') ?>",
          data: fd,
          dataType: 'json',
          cache: false,
          processData: false,
          contentType: false,
          beforeSend: function(data) {
            $(".error-msg").html('');
            $(".submit-btn").html("Please wait...").prop('disabled', true);
          },
          success: function(res) {
            if (res.status) {
              $('#modal-inventory-form')[0].reset()
              $('#add-edit-inventory-Modal-excel').modal('hide')
              get_project_inventory()
              // $('.ajax-msg').html(`<div class="alert alert-success">${res.message}</div>`)

              showToast('success', res.message)
            } else {
              // $('.ajax-msg').html(`<div class="alert alert-danger">${res.message}</div>`)
              showToast('danger', res.message)
            }
            $(".submit-btn").html("Submit").prop('disabled', false);
          },
          error: function() {

          }

        });

      }
    });
    /*  End Lead Unit Form */
  })
  // End add-edit-inventory




  $(document).on('click', '.edit-inventory-record', function() {
    var id = $(this).data('id')
    // alert(id)
  })

  $(document).on('click', '.delete-inventory-record', function() {
    var id = $(this).data('id')
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        delete_inventory_details(id)

      }
    });

  })

  

  /** Delete Inventory Details */
  function delete_inventory_details(id) {
    // Fetch Data
    $.ajax({
      type: "POST",
      url: "<?= base_url(AGENT_URL . '/api/delete_inventory_details') ?>",
      data: {
        id: id
      },
      dataType: 'json',
      success: function(res) {
        if (res.status) {
          get_project_inventory()
        }

        Swal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success"
        });
        // showToast(res.message);
      },
      error: function() {
        showToast('Some error occured');
      }
    });
    // End Fetch Data
  }
  /** End Delete Inventory Details */

  // download sample file 

  function downloadSample(){

    var id = $(this).data('id');
    var builder_id = $('#builder_id').val();
    var property_id = $('#product_id').val();
    var property_type_id = $('#product_id option:selected').data('property-type-id');
   
    window.location.href = "<?= base_url('helper/get_invetory_sample_file') ?>" +'?property_id='+property_id;
    
  }

  // end download sample file 

</script>