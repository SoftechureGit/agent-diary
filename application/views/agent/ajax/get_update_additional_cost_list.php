<div class="table-responsive" style="margin-top: 20px;">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th rowspan="2" class="text-center">Cost Details</th>
          <th></th>
          <th colspan="3" class="text-center">Current Cost</th>
          <th colspan="3" class="text-center">New cost</th>
        </tr>
        <tr>
          <th></th>
          <th class="text-center">Amount/ Rate</th>
          <th class="text-center">Calculate On</th>
          <th class="text-center">GST</th>
          <th class="text-center">Amount/ Rate</th>
          <th class="text-center">Calculate On</th>
          <th class="text-center">GST</th>
        </tr>
      </thead>
      <tbody>
      	<?php $parking_array  = array(); 
      	if ($product_unit_detail_data->parking_open) {
      		$parking_array[]  = $product_unit_detail_data->parking_open;
      	}
      	if ($product_unit_detail_data->parking_stilt) {
      		$parking_array[]  = $product_unit_detail_data->parking_stilt;
      	}
      	if ($product_unit_detail_data->parking_basment) {
      		$parking_array[]  = $product_unit_detail_data->parking_basment;
      	}

      	$show = 0;
      	?>
      	<?php if($product_unit_detail_data->parking_open) {  ?>
        <tr>
          <?php if(!$show) { ?>
          <td rowspan="<?= count($parking_array) ?>" class="text-center">Parking</td>
      	  <?php } ?>
          <td>Open</td>
          <td class="text-center"><?= ($product_unit_detail_data->additional_parking_cost_id)?$product_unit_detail_data->add_o_price:$product_unit_detail_data->o_price ?></td>
          <td></td>
          <td></td>
          <td><input type="text" class="form-control" placeholder="" name="add_o_price"></td>
          <td></td>
          <td></td>
        </tr>
        <?php $show = 1; } ?>

        <?php if($product_unit_detail_data->parking_stilt) { ?>
        <tr>
          <?php if(!$show) { ?>
          <td rowspan="<?= count($parking_array) ?>" class="text-center">Parking</td>
      	  <?php } ?>
          <td>Stilt</td>
          <td class="text-center"><?= ($product_unit_detail_data->additional_parking_cost_id)?$product_unit_detail_data->add_s_price:$product_unit_detail_data->s_price ?></td>
          <td></td>
          <td></td>
          <td><input type="text" class="form-control" placeholder="" name="add_s_price"></td>
          <td></td>
          <td></td>
        </tr>
        <?php $show = 1; } ?>

        <?php if($product_unit_detail_data->parking_basment) { ?>
        <tr>
          <?php if(!$show) { ?>
          <td rowspan="<?= count($parking_array) ?>" class="text-center">Parking</td>
      	  <?php } ?>
          <td>Basment</td>
          <td class="text-center"><?= ($product_unit_detail_data->additional_parking_cost_id)?$product_unit_detail_data->add_b_price:$product_unit_detail_data->b_price ?></td>
          <td></td>
          <td></td>
          <td><input type="text" class="form-control" placeholder="" name="add_b_price"></td>
          <td></td>
          <td></td>
        </tr>
        <?php $show = 1; } ?>

        <?php $i=0; foreach ($additional_details as $item) { ?>
        <tr>
          <?php if($i==0){?>
          <td rowspan="<?= count($additional_details) ?>" class="text-center">Additional</td>
          <?php } ?>
          <td><?= ($item->price_component_name)?$item->price_component_name:'' ?></td>
          <td class="text-center"><?php if($item->additional_cost_id){ echo ($item->current_rate)?$item->current_rate:''; } else { echo ($item->price)?$item->price:''; } ?></td>
          <td class="text-center"><?php if($item->additional_cost_id){ echo ($item->current_rate_unit_name)?$item->current_rate_unit_name:''; } else { echo ($item->unit_name)?$item->unit_name:''; } ?></td>
          <td class="text-center"><?php if($item->additional_cost_id){ echo ($item->current_rate_gst)?$item->current_rate_gst.'%':''; } else { echo ($item->gst)?$item->gst.'%':''; } ?></td>

          <td><input type="text" class="form-control" placeholder="" name="additional[<?= $item->product_additional_detail_id ?>][current_rate]"></td>
          <td>
          	<select class="form-control"  name="additional[<?= $item->product_additional_detail_id ?>][current_rate_unit]" style="width: 120px;">
          		<option value="">Select Unit</option>
          		<?php foreach ($unit_list as $unit_item) { ?>
          			<option value="<?= $unit_item->unit_id ?>"><?= $unit_item->unit_name ?></option>
          		<?php } ?>
          	</select>
          </td>
          <td><input type="text" class="form-control" placeholder="" name="additional[<?= $item->product_additional_detail_id ?>][current_rate_gst]"></td>
        </tr>
    	<?php $i++; } ?>

        <?php $i=0; foreach ($plc_details as $item) { ?>
          <tr>
          <?php if($i==0){?>
          <td rowspan="<?= count($plc_details) ?>" class="text-center">PLC</td>
          <?php } ?>
          <td><?= ($item->price_component_name)?$item->price_component_name:'' ?></td>
          <td class="text-center"><?php if($item->additional_plc_cost_id){ echo ($item->current_rate)?$item->current_rate:''; } else { echo ($item->price)?$item->price:''; } ?></td>
          <td class="text-center"><?php if($item->additional_plc_cost_id){ echo ($item->current_rate_unit_name)?$item->current_rate_unit_name:''; } else { echo ($item->unit_name)?$item->unit_name:''; } ?></td>
          <td class="text-center"><?php if($item->additional_plc_cost_id){ echo ($item->current_rate_gst)?$item->current_rate_gst.'%':''; } else { echo ($item->gst)?$item->gst.'%':''; } ?></td>

          <td><input type="text" class="form-control" placeholder="" name="plc[<?= $item->product_plc_detail_id ?>][current_rate]"></td>
          <td>
          	<select class="form-control"  name="plc[<?= $item->product_plc_detail_id ?>][current_rate_unit]" style="width: 120px;">
          		<option value="">Select Unit</option>
          		<?php foreach ($unit_list as $unit_item) { ?>
          			<option value="<?= $unit_item->unit_id ?>"><?= $unit_item->unit_name ?></option>
          		<?php } ?>
          	</select>
          </td>
          <td><input type="text" class="form-control" placeholder="" name="plc[<?= $item->product_plc_detail_id ?>][current_rate_gst]"></td>
        </tr>
        <?php $i++; } ?>
      </tbody>
    </table>
  </div>
  <div align="right" style="margin-top: 15px;">
    <button type="submit" class="btn btn-dark btn-lg inventory-btn" >Update</button>
  </div>