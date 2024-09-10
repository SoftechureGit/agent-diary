<!-- Static Card -->
<div class="card p-4 record-data clone-template" data-clone-template-id="1">
    <div class="row item-row w-100">
        <!-- Project Components -->
        <div class="col">
            <div class="form-group">
                <label for="project_component_id">Components</label>

                <select name="project_component[1][id]" id="" class="project_component_id form-control set_propety_components">
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
            <select class="form-control calculate_on_size_unit" id="" name="project_components[calculate_on_size_unit]" onchange="calculatePCTotalAmount(this)">
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