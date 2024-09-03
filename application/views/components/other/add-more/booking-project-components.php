
    <!-- Static Card -->
    <div class="card p-4 record-data clone-template" data-clone-template-id="1">
        <div class="row item-row w-100">
            <!-- Project Components -->
            <div class="col">
                <div class="form-group">
                    <label for="project_component_id">Components</label>
                    
                    <select name="project_component[1][id]" id="" class="project_component_id form-control set_propety_components" >
                        <option value="">Choose...</option>
                    </select>

                    <input type="hidden" name="project_components[1][component_type]">
                </div>
            </div>
            <!-- End Project Components -->

            <!-- Project Components Amount -->
            <div class="col">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control amount" placeholder="Enter amount" name="project_components[1][amount]">
                </div>
            </div>
            <!-- End Project Components Amount -->

            <!-- Total Amount -->
            <div class="col">
                <div class="form-group">
                    <label for="total_amount">Total Amount</label>
                    <input type="text" class="form-control total_amount"  name="project_components[1][total_amount]" readonly>
                </div>
            </div>
            <!-- End Total Amount -->
        </div>
    </div>
    <!-- End Static Youtube Data Card -->
