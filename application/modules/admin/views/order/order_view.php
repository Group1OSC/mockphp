<!-- hungtp: form for user to input data  -->

<script>
	function autoSubmit(id){
		alert(id);
		document.getElementByID('check_sort').value = id;
		document.forms["order_form2"].submit();
	}
	function autoSubmit2(){
		document.forms["order_form_page"].submit();
	}
</script>
<div class="col-lg-12">

	<?php if($results == ''): ?>
		<p>There is no data yet.</p>
	<?php else: ?>
	<div class="col-lg-12">
		<!--<div class="col-lg-2">
			<form id='order_form' action='' method='post'>
				<div class="form-group">
					<label>Sort type</label>
					<select class="form-control" name='order_sort' onchange='autoSubmit()'>
						<option value='' disabled>Choose one...</option>
						<option value='asc' <?php if($get_sort == 'asc') echo 'selected'; ?>>ASC</option>
						<option value='desc' <?php if($get_sort == 'desc') echo 'selected'; ?>>DESC</option>
					</select>
				</div>
			</form>
		</div>-->
		<div class="col-lg-2">
			<form id='order_form_page' action='' method='post'>
				<div class="form-group">
					<label>Records per page</label>
					<select class="form-control" name='order_num_page' onchange='autoSubmit2()'>
						<option value='' disabled>Choose one...</option>
						<option value='5' <?php if($get_num == '5') echo 'selected'; ?>>5</option>
						<option value='10' <?php if($get_num == '10') echo 'selected'; ?>>10</option>
						<option value='15' <?php if($get_num == '15') echo 'selected'; ?>>15</option>
						<option value='20' <?php if($get_num == '20') echo 'selected'; ?>>20</option>
						<option value='25' <?php if($get_num == '25') echo 'selected'; ?>>25</option>
					</select>
				</div>
			</form>
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th id="order_name" >Name 
						</th>
						<th id="order_email"  >E-mail 
						</th>
						<th  >Address </th>
						<th  >Phone </th>
						<th  >Time </th>
						<th  >Status </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				
				<?php foreach($results as $value): ?>
					<tr>
						<td class='text-center'><?php echo $num; ?></td>
						<td><?php echo $value['order_name']; ?></td>
						<td><?php echo $value['order_email']; ?></td>
						<td><?php echo $value['order_address']; ?></td>
						<td><?php echo $value['order_phone']; ?></td>
						<td><?php echo $value['order_time']; ?></td>
						<td><?php
						 if($value['order_status'] == -1)
							echo 'Canceled';
						 if($value['order_status'] == 0)
							echo 'Not paid';
						 if($value['order_status'] == 1)
							echo 'Paid';
						?></td>
						<td class='text-center'>
							<?php if($value['order_status'] == 0): ?>
							<a href="<?php echo base_url().'admin/order/success/'.$value['order_id'] ?>" title="Order paid"><i class="fa fa-fw fa-check"></i></a>
							<a href="<?php echo base_url().'admin/order/cancel/'.$value['order_id'] ?>" title="Order canceled"><i class="fa fa-fw fa-times"></i></a>
							<?php endif;?>
							<a href="<?php echo base_url().'admin/order/detail/'.$value['order_id'] ?>" title="View details"><i class="fa fa-fw fa-eye"></i></a>
						</td>
					</tr>
				<?php $num++; endforeach;  ?>
				</tbody>
			</table>
			<div class="text-right"><?php echo $links; ?></div>
		</div>
	<?php endif; ?>
	</div>
</div>

<!-- hungtp: end form  -->