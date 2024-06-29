
<div class="row" style="margin-bottom: 15px;margin-top: 5px;">
	<div class="col-md-6">
	</div>
	<div class="col-md-6">
		<div align="right">
			<a target="_blank" href="<?= base_url(AGENT_URL.'download_inventory?pid='.$product_id) ?>" class='btn btn-dark'>Download Inventory</a>
			<button type="button" class='btn btn-info' style="margin-left: 10px;color:#fff;" onclick="modalUploadInventory()">Upload</button>
		</div>
	</div>
</div>
<div class="table-responsive" style="overflow-x:auto;width: 100%;">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" style='width:10px !important;'></th>
				<th class="text-center" style='width:133px;'>Unit Code </th>
				<th class="text-center" style='width:133px;'>Reference</th>
				<th style='width:100px;'>Unit No</th>
				<th class="text-center" style='width:133px;'>Block/Tower</th>
				<th class="text-center" style='width:133px;'>Floor</th>
				<th class="text-center" style='width:100px;'>Basic Cost</th>
				<th class="text-center" style='width:100px;display: none;'>Club Cost</th>
				<th class="text-center" style='width:100px;'>Parking</th>
				<?php foreach ($columns as $record) { ?><th class="text-center" style='width:100px;'><?= $record['name'] ?></th><?php } ?>
			</tr>
		</thead>
		<tbody class="comm_detail">
			<?php $i=0; foreach($records as $record) { 
				$extra_entry_array = array();

				$data_inv_add = $this->Action_model->detail_result('tbl_inventory_additional',"inventory_id='".$record->inventory_id."'");
				foreach ($data_inv_add as $itemIA) {
					$extra_entry_array['additional_'.$itemIA->product_additional_detail_id] = $itemIA->is_active;
				}

				$data_inv_add = $this->Action_model->detail_result('tbl_inventory_plc',"inventory_id='".$record->inventory_id."'");
				foreach ($data_inv_add as $itemIA) {
					$extra_entry_array['plc_'.$itemIA->product_plc_detail_id] = $itemIA->is_active;
				}

				//if ($record->extra_entry) {
				//	$extra_entry_array = json_decode($record->extra_entry,true);
				//	print_r($extra_entry_array);
				//}
			?>
				<tr> 
					<td class="text-center"><input class='form-control' type='hidden' name='comm_unit[<?= $record->inventory_id ?>][id]' value='<?= $record->inventory_id ?>'> <div class='row_<?= $record->inventory_id ?>'><i class='fa fa-plus-circle cp' <?php if($i!=count($records)-1) { echo "style='display:none;'"; } ?> aria-hidden='true' onclick="addRow('','row_<?= $record->inventory_id ?>')"></i> <i class='fa fa-minus-circle text-danger cp rr' <?php if($i==count($records)-1) { echo "style='display:none;'"; } ?> aria-hidden='true' onclick="removeRow('row_<?= $record->inventory_id ?>')"></i></div> </td> 
					<td>
						<select style='width:133px; !important;' class="form-control" name="comm_unit[<?= $record->inventory_id ?>][unit_code]">
						      <?php foreach ($unit_code_list as $unit_code) { ?>
						        <option value="<?= $unit_code['unit_code_id'] ?>" <?php if($unit_code['unit_code_id']==$record->unit_code) { echo 'selected'; } ?> ><?= $unit_code['unit_code'] ?></option>
						      <?php } ?>
						</select>
					</td> 
					<td><textarea style='width:100px; !important;' class='form-control' type='text' name='comm_unit[<?= $record->inventory_id ?>][reference]' rows='1'><?= $record->reference ?></textarea></td> 
					<td><input style='width:100px; !important;' class='form-control' type='text' name='comm_unit[<?= $record->inventory_id ?>][unit_no]' value="<?= $record->unit_no ?>"></td> 
					<td>
						<select style='width:133px; !important;' class="form-control" name="comm_unit[<?= $record->inventory_id ?>][block_id]">
							<option value="">Select Block/Tower</option>
						      <?php foreach ($block_list as $item) { ?>
						        <option value="<?= $item['block_id'] ?>" <?php if($item['block_id']==$record->block_id) { echo 'selected'; } ?> ><?= $item['block_name'] ?></option>
						      <?php } ?>
						</select>
					</td> 
					<td>
						<select style='width:133px; !important;' class="form-control" name="comm_unit[<?= $record->inventory_id ?>][floor_id]">
						      <?php foreach ($floor_list as $floor) { ?>
						        <option value="<?= $floor->floor_id ?>" <?php if($floor->floor_id==$record->floor_id) { echo 'selected'; } ?> ><?= $floor->floor_name ?></option>
						      <?php } ?>
						</select>
					</td>
					<td><select style='width:80px; !important;' class='form-control' name='comm_unit[<?= $record->inventory_id ?>][basic_cost] ?>]'><option value='0'>No</option><option value='1' <?php if($record->basic_cost) { echo 'selected'; } ?> >Yes</option></select></td> 
					<td style="display: none;"><select style='width:80px; !important;' class='form-control' name='comm_unit[<?= $record->inventory_id ?>][club_cost] ?>]'><option value='0'>No</option><option value='1' <?php if($record->club_cost) { echo 'selected'; } ?> >Yes</option></select></td>

					<td><select style='width:80px; !important;' class='form-control' name='comm_unit[<?= $record->inventory_id ?>][parking] ?>]'><option value='0'>No</option><option value='1' <?php if($record->parking) { echo 'selected'; } ?> >Yes</option></select></td>

					<?php foreach ($columns as $column) { $selected = false; if($extra_entry_array && array_key_exists($column['code'], $extra_entry_array) && $extra_entry_array[$column['code']]==1){ $selected = true; } ?><td><select style='width:80px; !important;' class='form-control' name='comm_unit[<?= $record->inventory_id ?>][extra_entry][<?= $column['code'] ?>]'><option value='0'>No</option><option value='1' <?php if($selected) { echo 'selected'; } ?> >Yes</option></select></td><?php } ?>
				</tr>
			<?php $i++; } ?>
		</tbody>
	</table>
</div>

<div class="form-group col-md-12 " align="right" style="margin-top: 20px;">
    <button type="submit" type="button" class="btn btn-dark inventory-btn">Update</button>
</div>


<!-- modal form -->
<div class="modal fade" id="formModalAction" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" budget="document">
        <div class="modal-content">

            <form id="action-form-modal" method="post" action="<?= base_url(AGENT_URL.'upload_inventory') ?>" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="product_id" value="<?= $product_id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="action-error-msg"></div>

                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Upload File:</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".csv" required="" />
                    </div>
                          
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success action-form-btn wd-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end -->

<script>
function addRow(record='',cl='') {
	if (cl!="") {
		$("."+cl+" .fa-plus-circle").hide();
		$("."+cl+" .fa-minus-circle").show();
	}
	var html = "";
	var timestamp = Math.floor(Date.now() / 1000);
	html = "<tr> <td class='text-center'><input class='form-control' type='hidden' name='comm_unit["+timestamp+"][id]' value=''> <div class='row_"+timestamp+"'><i class='fa fa-plus-circle cp' aria-hidden='true' onclick='addRow(&quot;&quot;,&quot;row_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp rr' style='display:none;' aria-hidden='true' onclick='removeRow(&quot;row_"+timestamp+"&quot;)'></i></div> </td> <td><select style='width:133px; !important;' class='form-control' class='form-control' name='comm_unit["+timestamp+"][unit_code]'><?php foreach ($unit_code_list as $unit_code) { ?> <option value='<?= $unit_code['unit_code_id'] ?>' ><?= $unit_code['unit_code'] ?></option> <?php } ?></select></td> <td><textarea style='width:100px; !important;' class='form-control' rows='1' name='comm_unit["+timestamp+"][reference]'></textarea></td><td><input style='width:100px; !important;' class='form-control' type='text' name='comm_unit["+timestamp+"][unit_no]' value=''></td><td><select style='width:133px; !important;' class='form-control' class='form-control' name='comm_unit["+timestamp+"][block_id]'><option value=''>Select Block/Tower</option><?php foreach ($block_list as $item) { ?> <option value='<?= $item['block_id'] ?>' ><?= $item['block_name'] ?></option> <?php } ?></select></td><td><select style='width:133px; !important;' class='form-control' class='form-control' name='comm_unit["+timestamp+"][floor_id]'><?php foreach ($floor_list as $floor) { ?> <option value='<?= $floor->floor_id ?>' ><?= $floor->floor_name ?></option> <?php } ?></select></td><td><select style='width:80px; !important;' class='form-control' name='comm_unit["+timestamp+"][basic_cost]'><option value='0' selected>No</option><option value='1'>Yes</option></select></td> <td style='display: none;'><select style='width:80px; !important;' class='form-control' name='comm_unit["+timestamp+"][club_cost]'><option value='0' selected>No</option><option value='1'>Yes</option></select></td> <td><select style='width:80px; !important;' class='form-control' name='comm_unit["+timestamp+"][parking]'><option value='0' selected>No</option><option value='1'>Yes</option></select></td> <?php foreach ($columns as $column) { ?><td><select style='width:80px; !important;' class='form-control' name='comm_unit["+timestamp+"][extra_entry][<?= $column['code'] ?>]'><option value='0' selected>No</option><option value='1'>Yes</option></select></td><?php } ?> </tr>";
	$(".comm_detail").append(html);
}
function removeRow(id) {
	$("."+id).parent().parent().remove();
}
<?php if(!$records) { ?>
addRow("","");
<?php } ?>

function modalUploadInventory() {
	$("#formModalAction").modal('show');
}
</script>