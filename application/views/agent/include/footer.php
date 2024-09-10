     <!--**********************************
                    Form
                ***********************************-->
     <!-- Modal -->
     <div class="modal fade" id="view-inventory-details-Modal" role="dialog" aria-labelledby="view-inventory-details-ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="view-inventory-details-ModalLabel">Inventory Details</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <div class="inventory-details-container"></div>
           </div>
         </div>
       </div>
     </div>
     <!--**********************************
                    End Form
                ***********************************-->

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
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
     <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>

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

         $('select').each(function() {

           //  if ($(this).hasClass('select2-hidden-accessible')) {
           //    $(this).select2('destroy');
           //  }

           //  if (!$(this).hasClass('select2-hidden-accessible')) {
           $(this).select2({
             placeholder: "Choose...",
             dropdownParent: $(this).parent(),
           });
           //  }
         });
       }

       convertToSelect2()

       /***********************************************************************
        * Add or Edit Lead Unit 
        ************************************************************************/

       $(document).on('click', '.add-edit-new-unit-btn', function() {

         id = $(this).data('id')
         lead_id = $(this).data('lead_id')

         $.ajax({
           method: 'GET',
           //  async       : false,
           url: "<?= base_url('agent/lead_unit_form_view'); ?>",
           data: {
             id: id,
             lead_id: lead_id
           },
           dataType: 'json',

           beforeSend: function(data) {
             /** Site Custom Loader */
             // $('.site-custom-loader').removeClass('d-none')
             /** End Site Custom Loader */
           },
           success: (res) => {
             /** Site Custom Loader */
             // $('.site-custom-loader').addClass('d-none')
             /** End Site Custom Loader */

             /** # **/
             if (res.status) {
               /** Form View */
               $('.lead-unit-form-view').html(res.view)
               /** End Form View */

               /** Convert To Select2 */
               convertToSelect2()
               /** End Convert To Select2 */

               /** Modal */
               $('#unitModal').modal('show')
               /** End Modal */

               /** Trigger : Project Type Id */
               if ($('#lead-unit-form [name="property_type_id"]').data('selected_id') != '') {
                 $('#lead-unit-form [name="project_type_id"]').trigger('change')
               }
               /** End Trigger : Project Type Id */

               /** Trigger : State Id */
               $('#lead-unit-form [name="state_id"]').trigger('change')
               /** End Trigger : State Id */

               /***********************************************************************
                * Lead Unit Form Validate
                ************************************************************************/
               lead_unit_form_validate()
               /***********************************************************************
                * End Lead Unit Form Validate
                ************************************************************************/
             }
             /** # **/
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
           //  async: false,
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
           //  async: false,
           url: "<?= base_url('helper/get_property_types'); ?>",
           data: {
             project_type_id: project_type_id,
             selected_id: selected_id
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_property_types').html(res.options_view)
               if (selected_id) {

                 $('[name="property_type_id"]').trigger('change')
                 //  $('#lead-unit-form .get_property_form').trigger('change')
               }
             }
           }
         })
       }
       /* End Get Property Types */


       /************************************************************************************
        * Get Property Form
        ************************************************************************************/
       $(document).on('change', '#lead-unit-form [name="property_type_id"], #lead-unit-form [name="project_id"]', function() {
         var property_type_id = $('#lead-unit-form .get_property_form').val();
         var project_id = $('#lead-unit-form [name="project_id"]').val();
         var property_id = project_id ? $('#lead-unit-form [name="property_id"]').val() : 0;
         var selected_id = $('#lead-unit-form .get_property_form').data('selected_id');
         var selected_property_id = $('#lead-unit-form [name="property_id"]').data('selected_id');

         if (property_type_id) {
           id = $('#lead-unit-form [name="id"]').val();
           getPropertyForm(id, property_type_id, project_id, selected_property_id, selected_id);
         }
       })

       /************************************************************************************
        * End Get Property Form
        ************************************************************************************/

       /************************************************************************************
        * Ajax : Get Property Form
        ************************************************************************************/
       function getPropertyForm(id, property_type_id, property_id, selected_property_id, selected_id) {

         form_request_for = $('[name="form_request_for"]').val();

         $.ajax({
           method: 'GET',
           url: "<?= base_url('helper/get_property_form'); ?>",
           dataType: 'json',
           data: {
             id: id,
             property_type_id: property_type_id,
             property_id: property_id,
             selected_property_id: selected_property_id,
             form_request_for: form_request_for,
           },
           success: (res) => {
             if (res.status) {
               $('.set_property_form').html(res.form_view)

               $('.property_footer_form').removeClass('d-none')
               setTimeout(function() {
                 $('.form-not-found').parents('form').find('.property_footer_form').addClass('d-none')
               }, 100);

               convertToSelect2()

               //  
               if (form_request_for == 'inventory') {
                 if (res.property_layout) {
                   $('.old_property_layout').val(res.property_layout).attr('data-saved-value', res.property_layout)
                   $('.property-layout-anchor').attr('href', res.property_layout_url).removeClass('d-none')
                   $('.property-layout-anchor').attr('href', res.property_layout_url).attr('data-saved-value', res.property_layout_url).removeClass('d-none')
                 } else {
                   $('.old_property_layout').val('')
                   $('.property-layout-anchor').attr('href', '#').addClass('d-none')
                 }
               }
               //  
             }
           }
         })
       }
       /************************************************************************************
        * End Ajax : Get Property Form
        ************************************************************************************/

       /*  Get Cities */
       $(document).on('change', '.get_cities', function() {
         var state_id = $(this).val();
         var selected_id = $('#lead-unit-form [name="city_id"]').data('selected_id');
         get_and_set_cities(state_id, selected_id);
       })

       /*  Ajax : Get Cities */
       function get_and_set_cities(state_id, selected_id) {
         $.ajax({
           method: 'GET',
           //  async: false,
           url: "<?= base_url('helper/get_cities'); ?>",
           data: {
             state_id: state_id,
             selected_id: selected_id
           },
           dataType: 'json',
           beforeSend: function(data) {
             /** Site Custom Loader */
             // $('.site-custom-loader').removeClass('d-none')
             /** End Site Custom Loader */
           },
           success: (res) => {
             /** Site Custom Loader */
             // $('.site-custom-loader').addClass('d-none')
             /** End Site Custom Loader */
             if (res.status) {
               $('.set_cities').html(res.options_view)
               $('#lead-unit-form [name="city_id"]').trigger('change')
             }
           }
         })
       }
       /* End Ajax : Get Cities */
       /*  End Get Cities */

       /*  Get Locations */
       $(document).on('change', '.get_locations', function() {
         var city_id = $(this).val();
         var selected_id = $('.set_locations').data('selected_id');
         get_and_set_locations(city_id, selected_id);
       })

       /*  Ajax : Get Locations */
       function get_and_set_locations(city_id, selected_id) {

         if (!city_id) return;

         $.ajax({
           method: 'GET',
           //  async: false,
           url: "<?= base_url('helper/get_locations'); ?>",
           data: {
             city_id: city_id,
             selected_id: selected_id
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_locations').html(res.view)
               $('[name="location_id"]').trigger('change')
             }
           }
         })
       }
       /*  End Ajax : Get Locations */

       /** Get Properties via location */

       $(document).on('change', '.get_properties_via_location', function() {
         var location_id = $(this).val();

         /** Ajax */
         if (!location_id) return;

         $.ajax({
           method: 'GET',
           //  async: false,
           url: "<?= base_url('helper/projects'); ?>",
           data: {
             location_id: location_id,
             view: true
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_properties_via_location').html(res.view)
             }
           }
         })
         /** Ajax */
       })
       /** End Get Properties via location  */

       /** Get Properties Components */

       $(document).on('change', '.get_propety_components', function() {
         var project_id = $('[name="booking_project_id"]').val();
         var unit_code_id = $('[name="booking_unit_code"]').val();

         /** Ajax */
         if (!project_id) return;

         $.ajax({
           method: 'GET',
           //  async: false,
           url: "<?= base_url('helper/property_components'); ?>",
           data: {
             project_id: project_id,
             unit_code_id: unit_code_id,
             view: true
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_propety_components').html(res.view)
             }
           }
         })
         /** Ajax */
       })
       /** End Get Properties Components  */

       /** Get property unit codes */

       $(document).on('change', '.get_property_unit_codes', function() {
         var property_id = $(this).val();

         /** Ajax */
         if (!property_id) return;

         $.ajax({
           method: 'GET',
           //  async: false,
           url: "<?= base_url('helper/unit_codes'); ?>",
           data: {
             property_id: property_id,
             view: true
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('.set_property_unit_codes').html(res.view)
             }
           }
         })
         /** Ajax */
       })
       /** End Get property unit codes */


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

       /** Costing Validation */
       //  $(document).on('change', '#lead-unit-form [name="looking_for"]', function() {
       //    if (this.value == 'no_action') {
       //      $('#lead-unit-form .costing-price-wrapper').find('span.text-danger').html('')
       //      $('#lead-unit-form .costing-price-wrapper').find('[name="costing_price"]').prop('required', false)
       //    } else {
       //      $('#lead-unit-form .costing-price-wrapper').find('span.text-danger').html('*')
       //      $('#lead-unit-form .costing-price-wrapper').find('[name="costing_price"]').prop('required', true)
       //    }
       //  });
       /** Costing Validation */

       /*  Projects */
       $(document).on('change', '#lead-unit-form [name="property_type_id"], #lead-unit-form [name="location_id"]', function() {
         project_type_id = $('#lead-unit-form [name="project_type_id"]').val();
         property_type_id = $('#lead-unit-form [name="property_type_id"]').val();
         state_id = $('#lead-unit-form [name="state_id"]').val();
         city_id = $('#lead-unit-form [name="city_id"]').val();
         location_id = $('#lead-unit-form [name="location_id"]').val();

         selected_id = $('#lead-unit-form [name="project_id"]').data('selected_id')

         if (project_type_id && property_type_id && state_id && city_id && location_id) {
           projects(project_type_id, property_type_id, state_id, city_id, location_id, selected_id)
         }
       })

       function projects(project_type_id = 0, property_type_id = 0, state_id = 0, city_id = 0, location_id = 0, selected_id = 0) {
         $.ajax({
           method: 'GET',
           //  async: false,
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

               if ($('#lead-unit-form [name="project_id"] > option').length > 1) {
                 $('#lead-unit-form .project_name_wrapper').addClass('d-none')
                 $('#lead-unit-form .project_list_wrapper').removeClass('d-none')
                 $('#lead-unit-form .project_properties').removeClass('d-none')

                 //  $('#lead-unit-form [name="property_details[unit_code]"]').prop('required', false).removeClass('d-none')
                 //  $('#lead-unit-form [name="property_details[unit_code]"] + .select2').removeClass('d-none')
                 //  $('#lead-unit-form [name="property_details[unit_code_name]"]').prop('required', false).addClass('d-none')

                 /** Lead Unit Property List : Trigger  */
                 if ($('#lead-unit-form [name="project_id"]').data('selected_id') != '') {
                   $('#lead-unit-form [name="project_id"]').trigger('change')
                 }
                 /** End Lead Unit Property List : Trigger  */
               } else {
                 $('#lead-unit-form .project_name_wrapper').removeClass('d-none')
                 $('#lead-unit-form .project_list_wrapper').addClass('d-none')
                 $('#lead-unit-form .project_properties').addClass('d-none')
                 $('#lead-unit-form .project_properties').addClass('d-none')

                 //  $('#lead-unit-form [name="property_details[unit_code]"]').html('')
                 //  $('#lead-unit-form [name="property_details[unit_code]"]').prop('required', true).addClass('d-none')
                 //  $('#lead-unit-form [name="property_details[unit_code]"] + .select2').addClass('d-none')
                 //  $('#lead-unit-form [name="property_details[unit_code_name]"]').prop('required', true).removeClass('d-none')

               }
               //  $('#lead-unit-form [name="project_id"]').trigger('change')

             }
           }
         })
       }
       /*  End Projects */

       /* Project Properties */
       $(document).on('change', '#lead-unit-form [name="project_id"]', function() {
         var project_id = $(this).val();

         selected_id = $('[name="property_details[unit_code]"]').data('selected_id');

         $.ajax({
           method: 'GET',
           //  async: false,
           url: "<?= base_url('helper/project_properties'); ?>",
           data: {
             project_id: project_id,
             selected_id: selected_id,
             view: true
           },
           dataType: 'json',
           success: (res) => {
             if (res.status) {
               $('#lead-unit-form [name="property_details[unit_code]"]').html(res.view)

               $('#lead-unit-form [name="property_details[unit_code]"]').trigger('change')
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
           //  async: false,
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

           case 'youtube-data':
             dublicate_clone_template.find('.youtube-title').attr('name', "youtube_data[" + clone_template_id + "][title]").val('');
             dublicate_clone_template.find('.link').attr('name', "youtube_data[" + clone_template_id + "][link]").val('');
             break;

           case 'booking-deal-amount':

             //
             let selectedValue = []; // Initialize the array for selected values

             // Collect all selected values
             $('.booking-deal-amount-container select.project_component_id').each(function() {
               let selectedOption = $(this).find('option:selected'); // Get the selected option
               if (selectedOption.length) {
                 // Store the value and data-type of the selected option
                 selectedValue.push({
                   value: selectedOption.val(),
                   type: selectedOption.data('type')
                 });
               }
             });


             // Remove already selected options from the new select element
             dublicate_clone_template.find('.project_component_id option').each(function() {
               let optionValue = $(this).val();
               let optionType = $(this).data('type');

               // Check if the option's value and type match any of the selected values
               let isSelected = selectedValue.some(function(item) {
                 return item.value === optionValue && item.type === optionType;
               });

               if (isSelected) {
                 $(this).prop('disabled', true); // Remove the option if it is already selected
               }
             });


             //
             dublicate_clone_template.find('.select2').remove();
             dublicate_clone_template.find('.project_component_id').attr('name', "project_components[" + clone_template_id + "][id]").val('').trigger('change');


             dublicate_clone_template.find('.rate').attr('name', "project_components[" + clone_template_id + "][rate]").val('');
             dublicate_clone_template.find('.total_amount').attr('name', "project_components[" + clone_template_id + "][total_amount]").val('');

             dublicate_clone_template.find('.component-measure-msg').text('');

             dublicate_clone_template.find('.project_component_id').select2()
             dublicate_clone_template.find('.calculate_on_size_unit').select2()
             break;

           case 'payment-terms':
             dublicate_clone_template.find('.payment_term_title').attr('name', "payment_terms[" + clone_template_id + "][title]").val('');
             dublicate_clone_template.find('.amount').attr('name', "payment_terms[" + clone_template_id + "][amount]").val('');
             dublicate_clone_template.find('.date').attr('name', "payment_terms[" + clone_template_id + "][date]").val('');
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
       $(document).on('click', '.delete-lead', function() {
         if (confirm('Are you sure!')) {
           id = $(this).data('id');

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

       // 
       $(document).on('click', '.view-inventory-record', function() {
         var id = $(this).data('id')
         // alert(id)

         get_inventory_details(id);

         $('#view-inventory-details-Modal').modal('show')
       })

       // 
       $(document).on('change', '.inventory_plot_or_unit_numbers', function() {
         var id = $(this).find('option:checked').data('inventory-id')

         get_inventory_details(id);

       })

       /** Get Inventory Details */
       function get_inventory_details(id) {
         if (!id) return

         // Fetch Data
         $.ajax({
           type: "GET",
           url: "<?= base_url(AGENT_URL . '/api/get_inventory_details') ?>",
           data: {
             id: id
           },
           dataType: 'json',
           beforeSend: function(data) {
             $(".loader_progress").show();
           },
           success: function(res) {
             if (res.status) {
               $('#view-inventory-details-Modal .inventory-details-container').html(res.detail_view)

               $('.plot-unit-number-measure-msg').text(res.data.property_detail.measure_msg)

               $('input.plot_or_unit_size').val(res.data.property_detail.plot_or_unit_size)
               $('.booking-deal-amount-container .rate').trigger('input')

             } else {
               showToast(res.message);
             }

             $(".loader_progress").hide();
           },
           error: function() {
             $(".loader_progress").hide();

           }

         });
         // End Fetch Data
       }
       /** End Get Inventory Details */

       /** Inventory Filter */
       $(document).on('click', '.inventory-filter-apply-btn', function() {
         $('#inventoryFilterModal').modal('hide');
         get_project_inventory();
       })
       /** End Inventory Filter */

       function get_project_inventory() {

         var product_id = $("#product_id").val();
         var property_unit_code_id = $("#property_unit_code_id").val();

         /** Filter */
         var inventory_filter_status = $('#inventory_filter_status').val()
         var inventory_filter_facing = $('#inventory_filter_facing').val()
         var inventory_filter_floor = $('#inventory_filter_floor').val()
         var inventory_filter_tower = $('#inventory_filter_tower').val()
         var inventory_filter_accomodation = $('#inventory_filter_accomodation').val()
         var inventory_filter_sa_size = $('#inventory_filter_sa_size').val()
         var inventory_filter_plot_size = $('#inventory_filter_plot_size').val()
         var inventory_filter_unit_size = $('#inventory_filter_unit_size').val()
         var inventory_filter_unit_type = $('#inventory_filter_unit_type').val()
         /** End Filter */

         if (product_id == "") {
           $(".project_inventory").html("");
           $('.inventory-list-container').html('')
           $('.add-inventory-container').addClass('d-none')
         } else {
           $('.add-inventory-container').removeClass('d-none')

           $.ajax({
             type: "POST",
             url: "<?= base_url(AGENT_URL . 'api/get_project_inventory') ?>",
             data: {
               product_id: product_id,
               property_unit_code_id: property_unit_code_id,
               inventory_filter_status: inventory_filter_status,
               inventory_filter_facing: inventory_filter_facing,
               inventory_filter_floor: inventory_filter_floor,
               inventory_filter_tower: inventory_filter_tower,
               inventory_filter_accomodation: inventory_filter_accomodation,
               inventory_filter_sa_size: inventory_filter_sa_size,
               inventory_filter_plot_size: inventory_filter_plot_size,
               inventory_filter_unit_size: inventory_filter_unit_size,
               inventory_filter_unit_type: inventory_filter_unit_type,
             },
             dataType: 'json',
             beforeSend: function(data) {
               // $(".project_inventory").html("<div style='padding:50px;' align='center'><img src='<?= base_url('public/front/ajax-loader.gif') ?>' style='height:60px;'></div>");
             },
             success: function(response) {
               setTimeout(function() {
                 // $(".project_inventory").html(response.data_view);
                 $(".inventory-list-container").html(response.table_view);
                 if (response.status) {
                   $(".inventory-list-container table").dataTable({
                     columnDefs: [{
                       "defaultContent": "-",
                       "targets": "_all"
                     }]
                   })
                 }
               }, 100);
             },
             error: function() {
               $(".project_inventory").html("<div class=' alert alert-danger'>Some error occurred, please try again.</div>");
             }
           });
         }
       }


       //  

       $(document).on('change', '[name="property_details[unit_code]"]', function() {

         /** */
         property_id = $('[name="project_id"]').val();
         unit_code = $('[name="property_details[unit_code]"]').val();
         /** */

         /** Get Inventory Details From Manage Inventory */
         var form_request_for = $('[name="form_request_for"]').val()

         if (form_request_for == 'unit-inventory') {

           result = get_set_inventory_plot_numbers({
             'property_id': property_id,
             'unit_code': unit_code
           })
           if (result) {
             return false;
           }

         }
         /** End Get Inventory Details From Manage Inventory */

         /************************************************************
          *  Saved Data set in fields
          *************************************************************/
         if (!set_saved_data_in_form_fields(this)) return false
         /************************************************************
          * End Saved Data set in fields
          *************************************************************/

         /** Commercial */
         var property_type_name = $(this).find('option:checked').data('property-type-name')

         if (property_type_name) {
           $('#property_type_name').val(property_type_name)
           $('.commercial-property-type').text(property_type_name)

           /** Property Type Name */

           $('.commercial-col').addClass('d-none')

           switch (property_type_name) {
             case 'Shop':

               break;

             case 'Office':
               $('.pentry-col').removeClass('d-none')
               $('.washroom-col').removeClass('d-none')
               break;
           }
           /** End Property Type Name */
         }
         /** End Commercial */


         var accomodation_id = $(this).find('option:checked').data('accomodation-id')
         var accomodation_name = $(this).find('option:checked').data('accomodation-name')

         $('#modal-inventory-form [name="property_details[accomodation_id]"]').val(accomodation_id)
         $('#modal-inventory-form input[name="property_details[unit_type]"]').val(accomodation_name)



         /**  Get Default Inventory Details  */
         getPropertyUnitDetails({
           'id': this.value
         })
         /**  End Get Default Inventory Details  */
       })

       function getPropertyUnitDetails({
         id = 0
       }) {
         $.ajax({
           post: 'GET',
           //  async: false,
           url: "<?= base_url('helper/get_property_unit_details'); ?>",
           data: {
             id: id
           },
           dataType: 'json',
           success: (res) => {

             if (res.status) {

               /** Parking */
               var parkings = [];

               if (res.data['parkings'].parking_open) {
                 parkings[0] = 'open';
               }

               if (res.data['parkings'].parking_stilt) {
                 parkings[1] = 'stilt';
               }

               if (res.data['parkings'].parking_basement) {
                 parkings[1] = 'basement';
               }

               $(`select[name="property_details[parking][]"]`).val('').trigger('change');
               $(`select[name="property_details[applicable_plc][]"]`).val('').trigger('change');

               /** End Parking */

               $.each(res.data, function(key, value) {
                 /** Size Unit */
                 if ((key == 'size_unit' || key == 'plot_unit') && (value != '' && value)) {
                   $(`select[name="property_details[size_unit]"]`).val(value).trigger('change.select2');
                   $(`select[name="property_details[sa_size_unit]"]`).val(value).trigger('change.select2');
                   $(`select[name="property_details[ba_size_unit]"]`).val(value).trigger('change.select2');
                   $(`select[name="property_details[ca_size_unit]"]`).val(value).trigger('change.select2');

                 } else if (key == 'facing') {
                   $(`select[name="property_details[facing_id]"]`).val(value).trigger('change.select2');
                 } else {
                   if (key != 'id') {
                     $(`input[name="property_details[${key}]"]`).val(value);
                   }
                 }
                 /** End Size Unit */

                 /** Property Layout */
                 if (key == 'image_url' && value) {
                   $('.property-layout-anchor').removeClass('d-none').attr('href', value)
                   $('.old_property_layout').val(value.split('/').pop())
                 } else if (key == 'image_url' && !value) {
                   $('.property-layout-anchor').addClass('d-none').attr('href', '#')
                   $('.old_property_layout').val('')
                 }
                 /** End Property Layout */
               })
             }
           },
           error: (res) => {
             console.log(res)

           }
         })
       }

       /** Followup Success Booking Form */
       $(document).on('change', '.get_inventory_plot_or_unit_numbers', function() {
         property_id = $('.booking_project_id').val()
         unit_code = this.value

         get_set_inventory_plot_numbers({
           'property_id': property_id,
           'unit_code': unit_code
         })
       })
       /** End Followup Success Booking Form */

       /** get_set_inventory_plot_numbers */
       function get_set_inventory_plot_numbers({
         property_id = 0,
         unit_code = 0
       }) {

         if (!unit_code || !property_id) {
           return false
         }

         selected_id = $('[name="property_details[plot_number]"]').data('selected_id')
         return new Promise((resolve, reject) => {

           /** Ajax - Fetch Plot Or Unit Numbers From Inventory */
           $.ajax({
             url: "<?= base_url('helper/inventory-plot-or-unit-numbers') ?>",
             method: 'GET',
             dataType: 'json',
             data: {
               property_id: property_id,
               unit_code: unit_code,
               selected_id: selected_id,
               view: true,
             },
             success: (res) => {
               if (res.status) {

                 $('[name="property_details[plot_number]"]').html(res.options_view)
                 $('[name="property_details[unit_no]"]').html(res.options_view)

                 $('.inventory_plot_or_unit_numbers').html(res.options_view)
                 $('.plot-unit-number-measure-msg').text('')
                 resolve(true);

               } else {
                 showToast('danger', res.message)
                 resolve(false);

               }
             },
             error: (res) => {
               showToast('danger', 'Some error occured')
               reject(false);

             }
           })
           /** End Ajax - Fetch Plot Or Unit Numbers From Inventory */
         });
       }
       /** End get_set_inventory_plot_numbers */

       function getInventory({
         id = 0,
         plot_or_unit_number = null
       }) {

         if (!plot_or_unit_number) {
           return false
         }

         $.ajax({
           post: 'GET',
           url: "<?= base_url('helper/get_inventory_details'); ?>",
           data: {
             id: id,
             plot_or_unit_number: plot_or_unit_number,
           },
           dataType: 'json',
           success: (res) => {

             if (res.status) {

               /** End Parking */
               $.each(res.data, function(key, value) {

                 if (key == 'remark' && value != '') {
                   $(`textarea[name="property_details[remark]"]`).text(value);
                 }

                 $(`input[name="property_details[${key}]"]`).val('');

                 if (key == 'applicable_plc' && value != '') {
                   $(`select[name="property_details[applicable_plc][]"]`).val(value).trigger('change');
                 }

                 if (key == 'parking' && value != '') {
                   $(`select[name="property_details[parking][]"]`).val(value).trigger('change');
                 }

                 /** Size Unit */
                 if ((key == 'size_unit' || key == 'plot_unit') && value != '') {
                   $(`select[name="property_details[size_unit]"]`).val(value).trigger('change');
                   $(`select[name="property_details[sa_size_unit]"]`).val(value).trigger('change');
                   $(`select[name="property_details[ba_size_unit]"]`).val(value).trigger('change');
                   $(`select[name="property_details[ca_size_unit]"]`).val(value).trigger('change');
                 } else if (key == 'facing_id' && value != '') {
                   $(`select[name="property_details[facing_id]"]`).val(value).trigger('change');
                 } else {
                   if (key != 'id') {
                     $(`input[name="property_details[${key}]"]`).val(value);
                   }
                 }
                 /** End Size Unit */

                 /** Property Layout */
                 if (key == 'image_url' && value != '') {
                   $('.property-layout-anchor').removeClass('d-none').attr('href', value)
                   $('.old_property_layout').val(value.split('/').pop())
                 } else if (key != 'image_url' && value == '') {
                   $('.property-layout-anchor').addClass('d-none').attr('href', '#')
                   $('.old_property_layout').val('')
                 }
                 /** End Property Layout */
               })
             }
           },
           error: (res) => {
             console.log(res)

           }
         })
       }
       //  

       /** Fetch Inventory Data Via Plot Number */
       $(document).on('change', '[name="property_details[plot_number]"], [name="property_details[unit_no]"]', function() {
         plot_or_unit_number = this.value;

         /************************************************************
          *  Saved Data set in fields
          *************************************************************/
         if (!set_saved_data_in_form_fields(this)) return false
         /************************************************************
          * End Saved Data set in fields
          ************************************************************/


         getInventory({
           plot_or_unit_number: plot_or_unit_number
         })
       })
       /** End Fetch Inventory Data Via Plot Number */

       /***********************************************************************
        * Lead Unit Form Validate
        ************************************************************************/

       function lead_unit_form_validate() {
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

             fd.append('inventory_id', $('[name="property_details[plot_number]"] option:selected').data('inventory-id'))

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
       }

       /***********************************************************************
        * End Lead Unit Form Validate
        ************************************************************************/

       /***********************************************************************
        * Set Saved Data In Form Fields
        ************************************************************************/
       function set_saved_data_in_form_fields(e) {
         current_value = e.value;
         saved_value = $(e).data('saved-value');

         if (current_value == saved_value) {

           fields = $(e).closest('form').find(':input')

           /*********************** Form Fields Loop  ***********************/
           $.each(fields, (key, field) => {

             saved_value = $(field).data('saved-value');

             if (saved_value) {

               if ($(field).is('select')) {
                 /** Size Unit */
                 if (field.name == 'property_details[size_unit]') {
                   $(field).val(saved_value).trigger('change');
                 }
                 /** End Size Unit */

                 /** Applicable PLC */
                 if (field.name == 'property_details[applicable_plc][]') {
                   $(field).val(saved_value).trigger('change');
                 }
                 /** End Applicable PLC */

                 /** Facing Id */
                 if (field.name == 'property_details[facing_id]') {
                   $(field).val(saved_value).trigger('change');
                 }
                 /** End Facing Id */

                 /** Parking */
                 if (field.name == 'property_details[parking][]') {
                   // console.log(field.name)
                   var str = saved_value;
                   var jsonStr = str.replace(/'/g, '"'); // Convert single quotes to double quotes
                   var saved_value = JSON.parse(jsonStr);

                   $(field).val(saved_value).trigger('change');
                 }
                 /** End Parking */
               } else {
                 $(field).val(saved_value);
               }

               /** Property Layout */
               if (field.name == 'old_property_layout') {
                 $('.property-layout-anchor').removeClass('d-none')

                 property_layout_url = $('.property-layout-anchor').data('saved-value')

                 $('.property-layout-anchor').attr('href', property_layout_url)
               }
               /** End Property Layout */
             }
           })
           /*********************** Form Fields Loop  ***********************/

           // $.each()
           return false;
         }
         return true;
       }
       /***********************************************************************
        * End Set Saved Data In Form Fields
        ************************************************************************/

       /***********************************************************************
        * Calculate Project Component Total Amount
        ************************************************************************/


       function calculatePCTotalAmount(e) {
         parent = $(e).parents('.clone-template');

         calculate_on_size_unit = parent.find('.calculate_on_size_unit')
         calculate_on_size_unit_id = calculate_on_size_unit.val()

         rate = parent.find('.rate').val()

         plot_or_unit_size = $('.plot_or_unit_size').val()

         total_amount = parseFloat(plot_or_unit_size) * parseFloat(rate);

         if (calculate_on_size_unit_id == 5) { // Unit Type : Fix 
           total_amount = parseFloat(rate).toFixed(2)
          } else if (calculate_on_size_unit_id == 6) { // Unit Type : % of BSP
            basic_selling_price         = $('[data-type="basic_component"]:checked').parents('.clone-template').find('.total_amount').val()
            default_basic_selling_price = $('[data-type="basic_component"]').data('price')

            if(default_basic_selling_price){
              default_basic_selling_price = default_basic_selling_price * plot_or_unit_size
            }

            basic_selling_price = basic_selling_price ? basic_selling_price : default_basic_selling_price

            if(basic_selling_price){
              total_amount      = ( basic_selling_price / 100 ) * rate;
            }else{

                if(!$('.inventory_plot_or_unit_numbers').val()){
                  showToast('danger', 'Please select plot number / unit number')
                }else{
                  showToast('danger', 'Please update Basic Cost price')
                }
            }
         }

          total_amount = parseFloat(total_amount).toFixed(2)


         parent.find('.total_amount').val(total_amount)

       }
       /***********************************************************************
        * End Calculate Project Component Total Amount
        ************************************************************************/
     </script>
     <!--  -->

     </body>

     </html>