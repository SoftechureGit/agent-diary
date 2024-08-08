<div style="padding: 0px 15px 20px 15px;">
  <input type="hidden" id="product_id" value="<?= $record->product_id ?>">
  <input type="hidden" id="property_unit_code_id" value="<?= $record->product_unit_detail_id ?>">
  <div class="row" style="border: 1px solid #0000000f;padding: 20px 10px;margin-bottom: 10px;">
    <div class="col-md-12">
      <h3 class="text-center"><?= $record->project_name ?></h3>
      <div class="text-center" style="font-size: 11px;"><span><?= ($record->b_firm_name) ? 'By ' . $record->b_firm_name : '' ?></span></div>
      <div class="text-center" style="font-size: 13px;margin-top: 3px;"><span><i class="fa fa-map-marker"></i> <?= $record->location_name . ', ' . $record->city_name . ', ' . $record->state_name ?></span></div>
      <div class="row d-none" style="margin-top: 15px;">
        <div class="col-md-6 col-xs-6"><label>Size:</label> <strong><?= ($size) ? $size : '' ?></strong></div>
        <div class="col-md-6 col-xs-6" align="right"><label>Budget:</label> <strong><?= ($budget) ? $budget : '' ?></strong></div>
      </div>
    </div>
  </div>
  <div style="margin-top: 10px;">
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item"><a href="#navtabs-overview" class="nav-link active" data-toggle="tab" aria-expanded="false">Overview</a>
      </li>
      <li class="nav-item" onclick="getAmenitiesList(<?= $record->product_id ?>);"><a href="#navtabs-amenities" class="nav-link" data-toggle="tab" aria-expanded="false">Amenities</a>
      </li>
      <li class="nav-item" onclick="getSpecificationList(<?= $record->product_id ?>);"><a href="#navtabs-specification" class="nav-link" data-toggle="tab" aria-expanded="true">Specification</a>
      </li>
      <li class="nav-item" onclick="getInventoryList(<?= $record->product_id ?>,<?= $record->product_unit_detail_id ?>);"><a href="#navtabs-inventory" class="nav-link" data-toggle="tab" aria-expanded="true">Inventory</a>
      </li>
      <li class="nav-item"><a href="#navtabs-cost" class="nav-link" data-toggle="tab" aria-expanded="true">Cost</a>
      </li>
      <li class="nav-item"><a href="#navtabs-payment-plan" class="nav-link" data-toggle="tab" aria-expanded="true">Payment Plan</a>
      </li>
      <li class="nav-item" onclick="getSiteVisitList(<?= $record->product_id ?>);"><a href="#navtabs-site-visit" class="nav-link" data-toggle="tab" aria-expanded="true">Site Visit</a>
      </li>
    </ul>
    <div class="tab-content br-n pn">
      <div id="navtabs-overview" class="tab-pane active">
        <!-- Table View -->
        <div class="table-responsive">
          <table class="table table-bordered">
            <!-- About Project -->
            <tr>
              <th width="20%">About Project</th>
              <td class="text-justify" style="line-height: 20px;"><?= $record->description ?? '-' ?></td>
            </tr>
            <!-- End About Project -->

            <!-- Project Type -->
            <tr>
              <th width="20%">Project Type</th>
              <td><?= $record->product_type_name ?? '-' ?></td>
            </tr>
            <!-- End Project Type -->

            <!-- Property Type -->
            <tr>
              <th width="20%">Property Type</th>
              <td><?= $record->unit_type_name ?? '-' ?></td>
            </tr>
            <!-- End Property Type -->

            <!-- Unit Type -->
            <tr>
              <th width="20%">Unit Type</th>
              <td><?= $record->project_name ?? '-' ?></td>
            </tr>
            <!-- End Unit Type -->

          </table>
        </div>
        <!-- End Table View -->

        <div class="row d-none">
          <div class="col-md-6">
            <label>Accomodation:</label> <strong><?= $record->accomodation_name ?></strong>
          </div>
          <div class="col-md-6">
            <label>Bathroom:</label> <strong><?= $record->no_of_bathroom ?></strong>
          </div>
          <div class="col-md-12">
            <label>About Project:</label> <strong><?= $record->description ?></strong>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <label>Total Unit:</label> <strong><?= $record->no_of_unit ?></strong>
              </div>
              <div class="col-md-12">
                <label>Total Tower:</label> <strong><?= $record->no_of_tower ?></strong>
              </div>
              <div class="col-md-12">
                <label>CC Certificate :</label> <strong><?= ($record->cc_certificate) ? 'Yes' : 'No' ?></strong>
              </div>
              <div class="col-md-12">
                <label>OC Certificate:</label> <strong><?= ($record->oc_certificate) ? 'Yes' : 'No' ?></strong>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <label>C.A :</label> <strong><?= $record->ca ?></strong>
              </div>
              <div class="col-md-12">
                <label>B.A :</label> <strong><?= $record->ba ?></strong>
              </div>
              <div class="col-md-12">
                <label>S.A :</label> <strong><?= $record->sa ?></strong>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="navtabs-amenities" class="tab-pane">
        <div class="tab_amenities"></div>
      </div>
      <div id="navtabs-specification" class="tab-pane">
        <div id="accordion-two" class="accordion tab_specification">
        </div>
      </div>
      <div id="navtabs-inventory" class="tab-pane">

        <!-- Filter -->
        <div class="filter-wrapper mb-2">
          <!-- <details open>
          <summary> -->
          <!-- Filter -->
          <!-- </summary> -->
          <div class="row">
            <div class="col-md-12">
              <div class="text-right">
                <button class="btn btn-info btn-sm inventory-filter-modal-btn" data-property-type="<?= $record->property_type_id ?>">Filter</button>
              </div>
            </div>
          </div>
          <!-- </details> -->
        </div>
        <!-- End Filter -->

        <div class="inventory-list-container"></div>
        <div class="table-responsive d-none">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class='text-center'>S.No</th>
                <th class='text-center'>Unit No</th>
                <th class='text-center'>Accomodation</th>
                <th class='text-center'>Floor</th>
                <th class='text-center'>Tower</th>
                <th class='text-center'>Get. Qut.</th>
                <th class='text-center'>Status</th>
              </tr>
            </thead>
            <tbody class="tab_inventory">
              <!--<tr>
                <td>1</td>
                <td>505</td>
                <td>2 BHk</td>
                <td>5th Floor</td>
                <td>Wing -C</td>
                <td><button class="btn btn-warning"></button></td>
                <td><button class="btn btn-info"></button></td>
              </tr>-->
            </tbody>
          </table>
        </div>
      </div>
      <div id="navtabs-cost" class="tab-pane">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th colspan="2"></th>
                <th class="text-center">Amount/ Rate</th>
                <th class="text-center">Unit</th>
                <th class="text-center">GST</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Basic Cost</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Club Cost</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td rowspan="3" class="text-center">Parking</td>
                <td>Open</td>
                <td><?= ($record->parking_open) ? $record->o_price : '' ?></td>
                <td>fix</td>
                <td><?= ($record->parking_open && $record->parking_gst) ? $record->parking_gst . '%' : '' ?></td>
              </tr>
              <tr>
                <td>Stilt</td>
                <td><?= ($record->parking_stilt) ? $record->s_price : '' ?></td>
                <td>fix</td>
                <td><?= ($record->parking_stilt && $record->parking_gst) ? $record->parking_gst . '%' : '' ?></td>
              </tr>
              <tr>
                <td>Basment</td>
                <td><?= ($record->parking_basment) ? $record->b_price : '' ?></td>
                <td>fix</td>
                <td><?= ($record->parking_basment && $record->parking_gst) ? $record->parking_gst . '%' : '' ?></td>
              </tr>
              <tr>
                <td>Covered</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>

              <?php $i = 0;
              foreach ($additional_details as $item) { ?>
                <tr>
                  <?php if ($i == 0) { ?>
                    <td rowspan="<?= count($additional_details) ?>" class="text-center">Additional</td>
                  <?php } ?>
                  <td><?= ($item->price_component_name) ? $item->price_component_name : '' ?></td>
                  <td><?= ($item->price) ? $item->price : '' ?></td>
                  <td><?= ($item->unit_name) ? $item->unit_name : '' ?></td>
                  <td><?= ($item->gst) ? $item->gst . '%' : '' ?></td>
                </tr>
              <?php $i++;
              } ?>

              <?php $i = 0;
              foreach ($plc_details as $item) { ?>
                <tr>
                  <?php if ($i == 0) { ?>
                    <td rowspan="<?= count($plc_details) ?>" class="text-center">PLC</td>
                  <?php } ?>
                  <td><?= ($item->price_component_name) ? $item->price_component_name : '' ?></td>
                  <td><?= ($item->price) ? $item->price : '' ?></td>
                  <td><?= ($item->unit_name) ? $item->unit_name : '' ?></td>
                  <td><?= ($item->gst) ? $item->gst . '%' : '' ?></td>
                </tr>
              <?php $i++;
              } ?>

              <!--<tr>
                <td rowspan="2" class="text-center">Additional</td>
                <td>IFMS</td>
                <td>25</td>
                <td>Sq.ft</td>
                <td>18%</td>
              </tr>
              <tr>
                <td>Power Backup</td>
                <td>10000</td>
                <td>fix</td>
                <td>12%</td>
              </tr>-->
              <!--<tr>
                <td rowspan="3" class="text-center">PLC</td>
                <td>PLC-1</td>
                <td>5%</td>
                <td>of BSp</td>
                <td>12%</td>
              </tr>
              <tr>
                <td>PLC-2</td>
                <td>7%</td>
                <td>of BSp</td>
                <td>12%</td>
              </tr>
              <tr>
                <td>PLC-3</td>
                <td>10%</td>
                <td>of BSp</td>
                <td>12%</td>
              </tr>-->
            </tbody>
          </table>
        </div>
      </div>
      <div id="navtabs-payment-plan" class="tab-pane">
      </div>
      <div id="navtabs-site-visit" class="tab-pane">
        <div class="site_visit_list"></div>
      </div>
    </div>
  </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="inventoryFilterModal" role="dialog" aria-labelledby="inventoryFilterModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inventoryFilterModalLabel">Inventory Filters</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Status -->
          <div class="col-md-4 filter-col">
            <div class="form-group">
              <label for="status">Status</label>

              <select id="inventory_filter_status" class="form-control select2 filter-invetory">
                <option value="">All</option>
                <?php 
                $inventory_status_data   = (object) [
                  'property_id' => ($record->product_id ?? 0),
                  'unit_code'   => ($record->product_unit_detail_id ?? 0),
                ];
                foreach (inventory_filter_status($inventory_status_data) as $inventory_status) : ?>
                  <option value="<?= $inventory_status->id; ?>"><?= $inventory_status->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- Status -->

          <!-- Facing -->
          <div class="col-md-4 filter-col">
            <div class="form-group">
              <label for="">Facing</label>
              <select id="inventory_filter_facing" class="form-control select2 filter-invetory">
                <option value="">All</option>
                <?php
                foreach (facings() ?? [] as $facing_item) :
                  $selected         = $facing_item->facing_id == ($facing_id ?? 0) ? 'selected' : '';
                ?>
                  <option value="<?= $facing_item->facing_id ?>" <?= $selected ?>><?= $facing_item->title ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- End Facing -->

          <!-- Floor -->
          <div class="col-md-4 filter-col">
            <div class="form-group">
              <label for="status">Floor</label>

              <select id="inventory_filter_floor" class="form-control select2 filter-invetory">
                <option value="">All</option>
                <?php
                $inventory_floor_data   = (object) [
                  'property_id' => ($record->product_id ?? 0),
                  'unit_code'   => ($record->product_unit_detail_id ?? 0),
                ];

                foreach (inventory_floors($inventory_floor_data) ?? [] as $floor) :
                  $selected         = (($floor_id ?? 0) == $floor->id) ? 'selected' : '';
                ?>
                  <option value="<?= $floor->id ?>"><?= $floor->name ?? '' ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- End Floor -->

          <!-- Tower -->
          <div class="col-md-4 filter-col">
            <div class="form-group">
              <label for="status">Tower</label>

              <select id="inventory_filter_tower" class="form-control select2 filter-invetory">
                <option value="">All</option>
                <?php
                  $inventory_tower_data   = (object) [
                    'property_id' => ($record->product_id ?? 0),
                    'unit_code'   => ($record->product_unit_detail_id ?? 0),
                  ];
                foreach (inventory_tower($inventory_tower_data) ?? [] as $block_or_tower) :
                ?>
                  <option value="<?= $block_or_tower->id ?>"><?= $block_or_tower->name ?? '' ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- End Tower -->

          <!-- Accomodations -->
          <div class="col-md-4 filter-col">
            <div class="form-group">
              <label for="status">Accomodations</label>

              <select id="inventory_filter_accomodation" class="form-control select2 filter-invetory">
                <option value="">All</option>
                <?php
                $inventory_accomodation_data   = (object) [
                  'property_id' => ($record->product_id ?? 0),
                  'unit_code'   => ($record->product_unit_detail_id ?? 0),
                ];

                foreach (inventory_accomodations($inventory_accomodation_data) ?? [] as $accomodation) :
                ?>
                  <option value="<?= $accomodation->id ?>"><?= $accomodation->name ?? '' ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- End Accomodations -->

          <!-- Sa Size -->
          <div class="col-md-4 filter-col">
            <div class="form-group">
              <label for="sa_size">Size</label>
              <select id="inventory_filter_sa_size" class="form-control select2 filter-invetory">
                <option value="">All</option>
                <?php
                $inventory_sa_size_data   = (object) [
                  'property_id' => ($record->product_id ?? 0),
                  'unit_code'   => ($record->product_unit_detail_id ?? 0),
                ];

                foreach (inventory_sa_sizes($inventory_sa_size_data) ?? [] as $sa_size) :
                ?>
                  <option value="<?= $sa_size->sa_size ?> | <?= $sa_size->unit_id ?>"><?= $sa_size->sa_size ?? '' ?> <?= $sa_size->unit_name ?? '' ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- End Accomodations -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary inventory-filter-apply-btn">Apply</button>
      </div>
    </div>
  </div>
</div>
<!-- End Filter Modal -->

<script>
  //getRequirementList(<?= $record->lead_id ?? 0 ?>);

  $(document).on('click', '.inventory-filter-modal-btn', function() {
    var property_type = $(this).data('property-type');

    /** Property Form */

    $('#inventoryFilterModal .filter-col').addClass('d-none')

    switch (property_type) {
      case 1: // Multistory Apartment
        $('#inventoryFilterModal #inventory_filter_status').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_accomodation').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_floor').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_tower').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_sa_size').parents('.filter-col').removeClass('d-none')
        break;

      case 3: // Plot
        $('#inventoryFilterModal #inventory_filter_status').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_facing').parents('.filter-col').removeClass('d-none')
        break;

      case 7: // Builder Floor
        $('#inventoryFilterModal #inventory_filter_status').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_facing').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_floor').parents('.filter-col').removeClass('d-none')
        break;

      case 2: // Villa
        $('#inventoryFilterModal #inventory_filter_status').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_facing').parents('.filter-col').removeClass('d-none')
        break;

      case 4: // Shop
        $('#inventoryFilterModal #inventory_filter_status').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_floor').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_tower').parents('.filter-col').removeClass('d-none')
        break;

      case 5: // Office
        $('#inventoryFilterModal #inventory_filter_status').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_floor').parents('.filter-col').removeClass('d-none')
        $('#inventoryFilterModal #inventory_filter_tower').parents('.filter-col').removeClass('d-none')
        break;
    }
    /** End Property Form */

    $('#inventoryFilterModal').modal('show')

    convertToSelect2()
  })
</script>