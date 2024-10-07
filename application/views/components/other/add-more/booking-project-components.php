<?php if(count($records ?? [] )): ?>

    <?php 
        foreach($records ?? [] as $record_key => $record): 
            $record_key   = ++$record_key;
        ?>
        <!-- Dynamic Card -->
        <div class="card p-4 record-data clone-template" data-clone-template-id="<?= $record_key ?>">
            <div class="row item-row w-100">
                <!-- Project Components -->
                <div class="col">
                    <div class="form-group">
                        <label for="project_component_id">Components</label>

                        <select name="project_components[<?= $record_key ?>][id]" id="" class="project_component_id form-control set_propety_components" data-value="<?= $record->component_id ?>">
                            <option value="">Choose...</option>
                        </select>

                        <input type="hidden" name="project_components[<?= $record_key ?>][type]" class="type">
                        <small><span class="component-measure-msg text-muted font-italic"></span></small>
                    </div>
                </div>
                <!-- End Project Components -->

                <!-- Project Components Amount -->
                <div class="col">
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control rate" placeholder="Enter rate" name="project_components[<?= $record_key ?>][rate]" oninput="calculatePCTotalAmount(this)" value="<?= $record->rate ?>">
                    </div>
                </div>
                <!-- End Project Components Amount -->

                <div class="col">
                    <label for="">Calculate on</label>
                    <select class="form-control calculate_on_size_unit" id="" name="project_components[<?= $record_key ?>][calculate_on_size_unit]" onchange="calculatePCTotalAmount(this)">
                        <option value="" disabled selected>Choose...</option>
                        <?php foreach (sizeUnits() ?? []  as $item) : ?>
                            <option value="<?= $item->unit_id ?>" <?= ($record->calculate_on_size_unit_id == $item->unit_id) ? 'selected' : '' ?>><?= $item->unit_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Total Amount -->
                <div class="col">
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="text" class="form-control total_amount" name="project_components[<?= $record_key ?>][total_amount]" value="<?= $record->total_amount ?>" readonly>
                    </div>
                </div>
                <!-- End Total Amount -->
            </div>
        </div>
        <!-- End Dynamic Card -->
    <?php endforeach; ?>

<?php else: ?>

<!-- Static Card -->
<div class="card p-4 record-data clone-template" data-clone-template-id="1">
    <div class="row item-row w-100">
        <!-- Project Components -->
        <div class="col">
            <div class="form-group">
                <label for="project_component_id">Components</label>

                <select name="project_components[1][id]" id="" class="project_component_id form-control set_propety_components">
                    <option value="">Choose...</option>
                </select>

                <input type="hidden" name="project_components[1][type]" class="type">
                <small><span class="component-measure-msg text-muted font-italic"></span></small>
            </div>
        </div>
        <!-- End Project Components -->

        <!-- Project Components Amount -->
        <div class="col">
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="text" class="form-control rate" placeholder="Enter rate" name="project_components[1][rate]" oninput="calculatePCTotalAmount(this)">
            </div>
        </div>
        <!-- End Project Components Amount -->

        <div class="col">
            <label for="">Calculate on</label>
            <select class="form-control calculate_on_size_unit" id="" name="project_components[1][calculate_on_size_unit]" onchange="calculatePCTotalAmount(this)">
                <option value="" disabled selected>Choose...</option>
                <?php foreach (sizeUnits() ?? []  as $item) : ?>
                    <option value="<?= $item->unit_id ?>"><?= $item->unit_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Total Amount -->
        <div class="col">
            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="text" class="form-control total_amount" name="project_components[1][total_amount]" readonly>
            </div>
        </div>
        <!-- End Total Amount -->
    </div>
</div>
<!-- End Static Youtube Data Card -->
 
<?php endif; ?>