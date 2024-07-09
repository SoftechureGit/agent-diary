     <!--**********************************
            Footer start
        ***********************************-->
     <!--<div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="#">Softechure It Services</a> 2019</p>
            </div>
        </div>-->
     <!--**********************************
            Footer end
        ***********************************-->
     </div>
     <!--**********************************
        Main wrapper end
    ***********************************-->

     <!--**********************************
        Scripts
    ***********************************-->
     <script src="<?php echo base_url('public/admin/') ?>plugins/common/common.min.js"></script>
     <script src="<?php echo base_url('public/admin/') ?>js/custom.min.js"></script>
     <script src="<?php echo base_url('public/admin/') ?>js/settings.js"></script>
     <script src="<?php echo base_url('public/admin/') ?>js/gleek.js"></script>

     <script src="<?php echo base_url('public/admin/') ?>js/styleSwitcher.js"></script>




     <!-- Pignose Calender -->
     <script src="<?php echo base_url('public/admin/') ?>plugins/moment/moment.min.js"></script>
     <script src="<?php echo base_url('public/admin/') ?>plugins/pg-calendar/js/pignose.calendar.min.js"></script>
     <script src="<?php echo base_url('public/admin/') ?>plugins/toast/js/jquery.toast.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

     <!-- ChartistJS demo -->

     <script>
       setTimeout(function() {
         $(".nk-nav-scroll").css("overflow", "none");
         $(".nk-nav-scroll").css("overflow-y", "scroll");
       }, 100);
     </script>

     <!--  -->
     <script>
     
       function convertToSelect2() {
         $('select').select2();
       }
       convertToSelect2()
       // $('.select2').select2();
       /* Add or Edit Lead Unit */
       $(document).on('click', '.add-edit-new-unit-btn', function() {
         id = $(this).data('id')
         lead_id = $(this).data('lead_id')

         $.ajax({
           method: 'GET',
           url: "<?= base_url('agent/lead_unit_form_view'); ?>",
           data: {
             id: id,
             lead_id: lead_id
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.lead-unit-form-view').html(res.view)

               convertToSelect2()
               $('#unitModal').modal('show')

               $('#lead-unit-form [name="project_type_id"]').trigger('change')
               $('#lead-unit-form [name="state_id"]').trigger('change')

               setTimeout(function() {
                 $('#lead-unit-form [name="property_id"]').trigger('change')
               }, 500)


               // 
               /*  Lead Unit Form */
               $('#lead-unit-form').validate({
                 rules: {
                   looking_for: {
                     required: true
                   }
                 },
                 messages: {},
                 submitHandler: function(form) {
                   var myform = document.getElementById("lead-unit-form");
                   var fd = new FormData(myform);

                   $.ajax({
                     type: "POST",
                     url: "<?= base_url('agent/store_lead_unit') ?>",
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
                         // $('.ajax-msg').html(`<div class="alert alert-success">${res.message}</div>`)

                         showToast('success', res.message)

                         setTimeout(function() {
                           $('#unitModal').modal('hide')
                           $('#lead-unit-form')[0].reset()
                           $('.ajax-msg').html('')
                           $('.set_property_form').html('')

                           /* Refresh Lead Units */
                           lead_units($('[name="lead_id"]').val());
                           /* End Refresh Lead Units */

                         }, 1000)
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
               // 
             }
           }
         })
       })
       /* Add or Edit Lead Unit */

       /* Lead Unit Details */
       $(document).on('click', '.view-unit-details', function() {
         var id = $(this).data('id');
         if (!id) {
           alert('Invalid record')
           return false;
         }

         get_and_set_unit_details(id);
       })

       function get_and_set_unit_details(id) {
         $.ajax({
           method: 'GET',
           url: "<?= base_url('agent/lead_unit_details'); ?>",
           data: {
             id: id,
             view: true
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.lead-unit-details-container').html(res.details_view)
               $('#lead-unit-details-modal').modal('show')
             }
           }
         })
       }
       /* End Lead Unit Details */

       /* Get Property Types */
       $(document).on('change', '.get_property_types', function() {
         var project_type_id = $(this).val();
         var selected_id = $('#lead-unit-form [name="property_type_id"]').data('selected_id');

         get_and_set_property_types(project_type_id, selected_id);
       })

       function get_and_set_property_types(project_type_id, selected_id) {
         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/get_property_types'); ?>",
           data: {
             project_type_id: project_type_id,
             selected_id: selected_id
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_property_types').html(res.options_view).trigger('change')
               if (selected_id) {
                 $('#lead-unit-form .get_property_form').trigger('change')
               }
             }
           }
         })
       }
       /* End Get Property Types */

       /* End Get Property Form */
       $(document).on('change', '#lead-unit-form [name="property_type_id"], #lead-unit-form [name="project_id"], #lead-unit-form [name="property_id"]', function() {
         var property_type_id = $('#lead-unit-form .get_property_form').val();
         var project_id = $('#lead-unit-form [name="project_id"]').val();
         var property_id = project_id ? $('#lead-unit-form [name="property_id"]').val() : 0;
         var property_details = $('#lead-unit-form .get_property_form').data(property_details);

         var selected_id = $('#lead-unit-form .get_property_form').data('selected_id');
         var selected_property_id = $('#lead-unit-form [name="property_id"]').data('selected_id');

         getPropertyForm(property_type_id, property_id, selected_property_id, property_details, selected_id);
       })

       function getPropertyForm(property_type_id, property_id, selected_property_id, property_details, selected_id) {
         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/get_property_form'); ?>",
           data: {
             property_type_id: property_type_id,
             property_id: property_id,
             selected_property_id: selected_property_id,
             property_details: property_type_id == selected_id ? property_details : null
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_property_form').html(res.form_view)
               convertToSelect2()
             }
           }
         })
       }
       /* End Get Property Form */

       /*  Get Cities */
       $(document).on('change', '.get_cities', function() {
         var state_id = $(this).val();

         var selected_id = $('#lead-unit-form [name="city_id"]').data('selected_id');

         get_and_set_cities(state_id, selected_id);

       })

       function get_and_set_cities(state_id, selected_id) {
         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/get_cities'); ?>",
           data: {
             state_id: state_id,
             selected_id: selected_id
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_cities').html(res.options_view)
               $('#lead-unit-form [name="city_id"]').trigger('change')
             }
           }
         })
       }
       /*  End Get Cities */

       /*  Get Locations */
       $(document).on('change', '.get_locations', function() {
         var city_id = $(this).val();

         var selected_id = $('.set_locations').data('selected_id');

         get_and_set_locations(city_id, selected_id);

       })

       function get_and_set_locations(city_id, selected_id) {
         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/get_locations'); ?>",
           data: {
             city_id: city_id,
             selected_id: selected_id
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_locations').html(res.view)
               $('#lead-unit-form [name="location_id"]').trigger('change')
             }
           }
         })
       }
       /*  End Get Locations */



       /*  Lead Units */
       function lead_units(lead_id) {
         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/get_lead_units'); ?>",
           data: {
             lead_id: lead_id
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.lead-units-section').html(res.view)
             }
           }
         })
       }
       /*  End Lead Units */

       /*  Projects */
       $(document).on('change', '#lead-unit-form [name="location_id"]', function() {
         project_type_id = $('#lead-unit-form [name="project_type_id"]').val();
         property_type_id = $('#lead-unit-form [name="property_type_id"]').val();
         state_id = $('#lead-unit-form [name="state_id"]').val();
         city_id = $('#lead-unit-form [name="city_id"]').val();
         location_id = $('#lead-unit-form [name="location_id"]').val();

         selected_id = $('#lead-unit-form [name="project_id"]').data('selected_id')

         projects(project_type_id, property_type_id, state_id, city_id, location_id, selected_id)
       })

       function projects(project_type_id = 0, property_type_id = 0, state_id = 0, city_id = 0, location_id = 0, selected_id = 0) {
         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/projects'); ?>",
           data: {
             project_type_id: project_type_id,
             property_type_id: property_type_id,
             state_id: state_id,
             city_id: city_id,
             location_id: location_id,
             selected_id: selected_id,
             view: true
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('#lead-unit-form [name="project_id"]').html(res.view)
               if (!selected_id) {
                 $('#lead-unit-form .project_name_wrapper').removeClass('d-none')
               }
               $('#lead-unit-form [name="project_id"]').trigger('change')

             }
           }
         })
       }
       /*  End Projects */

       /* Project Properties */
       $(document).on('change', '#lead-unit-form [name="project_id"]', function() {
         var project_id = $(this).val();
         var selected_id = $('#lead-unit-form [name="property_id"]').data('selected_id');

         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/project_properties'); ?>",
           data: {
             project_id: project_id,
             selected_id: selected_id,
             view: true
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('#lead-unit-form [name="property_id"]').html(res.view)
             }
           }
         })
       })
       /*  End Project Properties */

       /* Project Property Details */
       $(document).on('change', '#lead-unit-form [name="property_id"]', function() {
         var property_type_id = $(this).val();
         var project_property_id = $(this).val();

         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/project_property_details'); ?>",
           data: {
             property_type_id: property_type_id,
             project_property_id: project_property_id
           },
           dataType: 'json',
           success: (res) => {

             if (res.status) {

             }
           }
         })
       })
       /*  End Project Property Details */

       /*  Selected Project */
       $(document).on('change', '#lead-unit-form [name="project_id"]', function() {
         if (this.value) {
           $('#lead-unit-form .project_name_wrapper').addClass('d-none')
           $('#lead-unit-form .project_properties').removeClass('d-none')
         } else {
           $('#lead-unit-form .project_name_wrapper').removeClass('d-none')
           $('#lead-unit-form .project_properties').addClass('d-none')
         }
       })
       /*  End Selected Project */



       // ########## Toast #########
       // $(document).ready(function() {
       function showToast(type, message) {
         const toast = $(`<div class="toast alert alert-${type}"></div>`).text(message);
         $('#toast-container').append(toast);

         setTimeout(() => {
           toast.css('opacity', '1');
         }, 100); // Small delay to ensure the transition effect

         setTimeout(() => {
           toast.css('opacity', '0');
           setTimeout(() => {
             toast.remove();
           }, 500); // Match the CSS transition duration
         }, 3000); // Duration the toast is visible
       }

       // });
       // ########## End Toast #########


       // Add More

       function removeCloneTemplateRow(el) {

         var id = $(el).data('id')
         var is_main = $(el).data('type') == 'main' ? true : false;


         if (id) {
           if (confirm('Are you sure to remove this file?')) {
             if (is_main) {
               $(el).parents('.clone-template').find('.view-property-document').remove();
               $(el).parents('.clone-template').find('.document_title').val('');
             }

             // Ajax - Remove Add More Record
             $.ajax({
               type: "post",
               url: "<?= base_url('helper/remove_add_more_record_file') ?>",
               dataType: 'json',
               data: {
                 id: id
               },
               success: (data) => {
                 if (data.status) {
                   if (is_main) {
                     $(el).parents('.clone-template').find('.remove-clone-template-row').remove();
                   } else {
                     $(el).parents('.clone-template').remove();
                   }
                   showToast('success', data.message)
                 } else {
                   showToast('danger', data.message)
                 }
               },
               error: function() {
                 showToast('danger', 'Some Error Occured.')
               }
             });
             // End Ajax - Remove Add More Record
           }
         } else {
           $(el).parents('.clone-template').remove();
         }

       }

       var remove_combo_btn_html = '';
       var clone_template_id = 0;

       function add_more(e, type, parent_class) {

         var clone_template = $(e).parents(parent_class).find('.clone-template');
         var last_clone_template_id = clone_template.last().attr('data-clone-template-id');
         var dublicate_clone_template = clone_template.first().clone();

         next_clone_template_id = parseInt(last_clone_template_id) + 1;
         html_remove_current_clone_template_btn = '<span class="remove-clone-template-row fa fa-trash" onclick="removeCloneTemplateRow(this)"></span>';

         modifyCloneTemplate(dublicate_clone_template, next_clone_template_id, type);

         dublicate_clone_template.append(html_remove_current_clone_template_btn);
         clone_template.last().after(dublicate_clone_template);
       }

       function modifyCloneTemplate(dublicate_clone_template, clone_template_id, type) {

         dublicate_clone_template.attr('data-clone-template-id', clone_template_id);
         dublicate_clone_template.find('input[name="product_id"]').remove();
         dublicate_clone_template.find('span.text-danger').html('');

         switch (type) {
           case 'property-documents':
             dublicate_clone_template.find('.document_title').attr('name', "property_documents[" + clone_template_id + "][title]").val('');
             dublicate_clone_template.find('.document_file').attr('name', "property_documents[" + clone_template_id + "][document_file]").val('');
             dublicate_clone_template.find('.old_document_file').remove();
             dublicate_clone_template.find('.view-property-document').remove();
             break;
         }

       }

       // End Add More
       // ##########
     </script>

     <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.1.0/build/js/intlTelInput.min.js"></script>

     <script>
       /** Primary Mobile Number With Dial Code */
       function primary_mobile_number_with_dial_code() {
         const primary_mobile_number = document.querySelector(".primary_mobile_number");

         const initialCountry = $('[name="primary_mobile_number_country_data"]').data('iso2') != 'undefined' ? $('[name="primary_mobile_number_country_data"]').data('iso2') : 'in';

         const primary_mobile_number_iti = window.intlTelInput(primary_mobile_number, {
           initialCountry: initialCountry,
           separateDialCode: true,
           autoPlaceholder: 'polite',
           customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
             return "Enter Mobile Number";
           },
           utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.1.0/build/js/utils.js",
         });

         primary_mobile_number.addEventListener("countrychange", function() {
           const country_data = primary_mobile_number_iti.getSelectedCountryData();
           document.querySelector('[name="primary_mobile_number_country_data"]').value = JSON.stringify(country_data);
         });

         primary_mobile_number.addEventListener('input', function() {
           // prevent changing the country automatically based on input
           const currentCountry = primary_mobile_number_iti.getSelectedCountryData().iso2;
           const currentNumber = primary_mobile_number_iti.getNumber();
           if (currentCountry !== primary_mobile_number_iti.getSelectedCountryData().iso2) {
             primary_mobile_number_iti.setCountry(currentCountry);
           }
         });
       }
       /** End Primary Mobile Number */

       /** Secondary Mobile Number */
       function secondary_mobile_number_with_dial_code() {
         const secondary_mobile_number = document.querySelector(".secondary_mobile_number");
         const initialCountry = $('[name="secondary_mobile_number_country_data"]').data('iso2') != 'undefined' ? $('[name="secondary_mobile_number_country_data"]').data('iso2') : 'in';

         const secondary_mobile_number_iti = window.intlTelInput(secondary_mobile_number, {
           initialCountry: initialCountry,
           separateDialCode: true,
           autoPlaceholder: 'polite',
           customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
             return "Enter Mobile Number";
           },
           utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.1.0/build/js/utils.js",
         });

         secondary_mobile_number.addEventListener("countrychange", function() {
           const country_data = secondary_mobile_number_iti.getSelectedCountryData();
           document.querySelector('[name="secondary_mobile_number_country_data"]').value = JSON.stringify(country_data);
         });

         secondary_mobile_number.addEventListener('input', function() {
           // prevent changing the country automatically based on input
           const currentCountry = secondary_mobile_number_iti.getSelectedCountryData().iso2;
           const currentNumber = secondary_mobile_number_iti.getNumber();
           if (currentCountry !== secondary_mobile_number_iti.getSelectedCountryData().iso2) {
             secondary_mobile_number_iti.setCountry(currentCountry);
           }
         });
       }
       /** End Primary Mobile Number */

      /** Delete Lead */
      $(document).on('click', '.delete-lead', function(){
        if(confirm('Are you sure!')){
          id           = $(this).data('id');
          
          // Ajax - Delete Lead
          $.ajax({
               type: "post",
               url: "<?= base_url('helper/delete_lead') ?>",
               dataType: 'json',
               data: {
                 id: id
               },
               success: (data) => {
                 if (data.status) {
                   showToast('success', data.message)
                 } else {
                   showToast('danger', data.message)
                 }
               },
               error: function() {
                 showToast('danger', 'Some Error Occured.')
               }
             });
             // End Ajax - Delete Lead
        }
      })
      /** End Delete Lead */
     </script>
     <!--  -->

     </body>

     </html>