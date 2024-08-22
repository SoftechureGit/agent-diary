<form id="lead-unit-form" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- Form Name -->
    <div class="col-md-12">
      <div class="text-left">
        <h3 class="form-heading">Basic Details</h3>
        <hr>
      </div>
    </div>
    <!-- End Form Name -->

    <!-- User Id  -->
    <input type="hidden" name="id" value="<?= $record->id  ?? 0 ?>">
    <input type="hidden" name="lead_id" value="<?= $record->lead_id ?? $lead_id ?? 0 ?>">
    <!-- End User Id -->

    <!-- Looking For -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Looking For <span class="text-danger">*</span></label>
        <select name="looking_for" id="" class="form-control" required>
          <option value="" selected disabled>Choose..</option>
          <option value="sale" <?= ($record->looking_for ?? '') == 'sale' ? 'selected' : '' ?>>Sale</option>
          <option value="rent" <?= ($record->looking_for ?? '') == 'rent' ? 'selected' : '' ?>>Rent</option>
          <option value="no_action" <?= ($record->looking_for ?? '') == 'no_action' ? 'selected' : '' ?>>No Action</option>
        </select>
      </div>
    </div>
    <!-- End Looking For -->

    <!-- Date -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Booking Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control" name="booking_date" value="<?= $record->booking_date ?? date('Y-m-d') ?>" required>
      </div>
    </div>
    <!-- End Date -->

    <!-- Project Type -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Project Type <span class="text-danger">*</span></label>
        <select name="project_type_id" id="" class="form-control get_property_types" required>
          <option value="" selected disabled>Choose..</option>
          <?php
          foreach (project_types() as $project_type) :
            $selected         = ($record->project_type_id ?? 0) == $project_type->id ? 'selected' : '';
            echo "<option value='$project_type->id' $selected >$project_type->name</option>";
          endforeach;
          ?>
        </select>
      </div>
    </div>
    <!-- End Project Type -->

    <!-- Property Type -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Property Type <span class="text-danger">*</span></label>
        <select name="property_type_id" id="" class="form-control set_property_types get_property_form" data-selected_id="<?= $record->property_type_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End Property Type -->

    <!-- State -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">State <span class="text-danger">*</span></label>
        <select name="state_id" id="" class="form-control get_cities select2" data-selected_id="<?= $record->state_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
          <?php
          foreach (states() as $state) :
            $selected         = ($record->state_id ?? 0) == $state->id ? 'selected' : '';
            echo "<option value='$state->id' $selected>$state->name</option>";
          endforeach;
          ?>
        </select>
      </div>
    </div>
    <!-- End State -->

    <!-- City -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">City <span class="text-danger">*</span></label>
        <select name="city_id" id="" class="form-control set_cities get_locations" data-selected_id="<?= $record->city_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End City -->

    <!-- Location -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Location <span class="text-danger">*</span></label>
        <select name="location_id" id="" class="form-control set_locations" data-selected_id="<?= $record->location_id ?? 0 ?>" required>
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End Location -->

    <!-- List of Project -->
    <div class="col-md-4 project_list_wrapper">
      <div class="form-group">
        <label for="">List of Project</label>
        <select name="project_id" id="" class="form-control" data-selected_id="<?= $record->project_id ?? 0 ?>">
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End List of Project -->

    <!-- Project Name -->
    <div class="col-md-4 project_name_wrapper d-none">
      <div class="form-group">
        <label for="">Project Name <span class="text-danger">*</span></label>
        <input name="project_name" id="" class="form-control" placeholder="Enter project name" value="<?= $record->project_name ?? $record->lead_unit_project_name ?? '' ?>" required>
      </div>
    </div>
    <!-- End Project Name -->

    <!-- Layout Upload -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Layout Upload</label>
        <input type="file" name="property_layout" value="" class="form-control p-1">
        <input type="hidden" name="old_property_layout" value="<?= $record->property_layout ?? '' ?>">
        <?php if ($record->property_layout_url ?? 0) : ?>
          <a href="<?= $record->property_layout_url; ?>" class="nav-link property-layout-anchor text-primary" target="_blank">View</a>
        <?php endif; ?>
      </div>
    </div>
    <!-- End Layout Upload -->

    <!-- Costing price  -->
    <div class="col-md-4 costing-price-wrapper">
      <div class="form-group">
        <label for="">Costing price</label>
        <input type="number" class="form-control" name="costing_price" value="<?= $record->costing_price ?? '' ?>" placeholder="Enter Costing price" min="1">
      </div>
    </div>
    <!-- End Costing price -->

    <!-- Form View -->
    <div class="set_property_form w-100"></div>
    <!-- Form View -->

    <!-- Youtube Links -->
     <div class="col-md-12">
      <details <?= isset($record) ? 'open' : '' ?>>
        <summary>Youtube Links</summary>
        <div class="youtube-links-container p-4">
        <?php $this->view('components/other/add-more/youtube-data', [ 'youtube_data' => $record->youtube_data ?? [] ]) ?>

        <div class="text-right">
          <button type="button" class="btn btn-warning btn-sm text-white add-more-btn" onclick="add_more(this, 'youtube-data' ,'.youtube-links-container')">Add More</button>
        </div>
        </div>
        
      </details>
     </div>
    <!-- End Youtube Links -->

    <!-- Documents - Add More Functionality -->
     <div class="col-md-12 my-3">
      <details <?= isset($record) ? 'open' : '' ?>>
        <summary>Documents</summary>
        <div class="property-documents-container p-4">
        <?php $this->view('components/other/add-more/property-documents', [ 'property_documents' => $property_documents ?? [] ]) ?>
        <div class="text-right">
          <button type="button" class="btn btn-warning btn-sm text-white add-more-btn" onclick="add_more(this, 'property-documents' ,'.property-documents-container')">Add More</button>
        </div>
        </div>
        
      </details>
     </div>
    <!-- Documents - Add More Functionality -->

    <!-- Photo Gallery -->
     <div class="col-md-12">
      <details <?= isset($record) ? 'open' : '' ?>>
        <summary>Photo Gallery</summary>
        <div class="photo-gallery p-4">
          <?php $this->view('components/other/photo-gallery', [ 'gallery_images' => $gallery_images ?? null ]) ?>
        </div>
      </details>
     </div>
    <!-- Photo Gallery -->

    <!-- Submit Button -->
    <div class="col-md-12 mt-4">
      <div class="text-center">
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
      </div>
    </div>
    <!-- End Submit Button -->
  </div>
</form>