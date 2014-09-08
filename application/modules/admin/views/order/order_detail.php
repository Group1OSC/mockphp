<!-- hungtp: form for user to input data  -->

<script>
	function autoSubmit(){
		document.forms["order_form"].submit();
	}
	function autoSubmit2(){
		document.forms["order_form_page"].submit();
	}
</script>
<div class="col-lg-12">
	<div class="col-lg-12">
		<div class="col-lg-6">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
					</thead>
					<tbody>
						<tr>
							<th>Name</th>
							<td><?php echo $result['order_name']; ?></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><?php echo $result['order_email']; ?></td>
						</tr>
						<tr>
							<th>Address</th>
							<td><?php echo $result['order_address']; ?></td>
						</tr>
						<tr>
							<th>Phone</th>
							<td><?php echo $result['order_phone']; ?></td>
						</tr>
						<tr>
							<th>Time</th>
							<td><?php echo $result['order_time']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	
		<div class="col-lg-4">
		<?php if($result['order_status'] == 1): ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-check fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">Paid</div>
							<div>Status</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span class="pull-left">This order completed.</span>
					<span class="pull-right"><i class="fa fa-check-circle-o"></i></span>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php endif; ?>
		<?php if($result['order_status'] == 0): ?>
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-spinner fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">Not Paid</div>
							<div>Status</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span class="pull-left">Change the status</span>
					<span class="pull-right">
						<a href="<?php echo base_url().'admin/order/success/'.$result['order_id'].'/'.$detail_id; ?>" title="Paid"><i class="fa fa-fw fa-check"></i></a>
						<a href="<?php echo base_url().'admin/order/cancel/'.$result['order_id'].'/'.$detail_id; ?>" title="Canceled"><i class="fa fa-fw fa-times"></i></a>
					</span>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php endif; ?>
		<?php if($result['order_status'] == -1): ?>
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-times fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">Canceled</div>
							<div>Status</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span class="pull-left">This order cannot be changed anymore.</span>
					<span class="pull-right"><i class="fa fa-minus-circle"></i></span>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php endif; ?>
		</div>
	</div>
	
	
	<div class="col-lg-12">
		<label>Ordered products:</label>
		
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
				</thead>
				<tbody>
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					<?php $num = 1; foreach($results as $value): ?>
						<tr>
							<td><?php echo $num; ?></td>
							<td><?php echo $value['pro_name']; ?></td>
							<td><?php echo $value['pro_price']; ?><i class="fa fa-fw fa-usd"></i></td>
							<td><?php echo $value['quantity']; ?></td>
							<td><?php echo $value['total']; ?><i class="fa fa-fw fa-usd"></i></td>
						</tr>
					<?php $num++; endforeach; ?>
					</tbody>
				</tbody>
			</table>
		</div>
		<p class="text-right"><b>Order total:</b> <?php echo $sum_total; ?><i class="fa fa-fw fa-usd"></i></p>
	</div>
</div>
<!-- hungtp: end form  -->