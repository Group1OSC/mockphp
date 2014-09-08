<!-- hungtp: form for user to input data  -->

<script>
	function autoSubmit(){
		document.forms["brand_form"].submit();
	}
	function autoSubmit2(){
		document.forms["brand_form_page"].submit();
	}
</script>
<div class="col-lg-6">

	<?php if($results == ''): ?>
		<p>There is no data yet.</p>
	<?php else: ?>
	<div class="col-lg-12">
		<div class="col-lg-4">
			<form id='brand_form' action='' method='post'>
				<div class="form-group">
					<label>Sort type</label>
					<select class="form-control" name='brand_sort' onchange='autoSubmit()'>
						<option value='' disabled > Choose one...</option>
						<option value='asc' <?php if($get_sort == 'asc') echo 'selected'; ?>>ASC</option>
						<option value='desc' <?php if($get_sort == 'desc') echo 'selected'; ?>>DESC</option>
					</select>
				</div>
			</form>
		</div>
		<div class="col-lg-4">
			<form id='brand_form_page' action='' method='post'>
				<div class="form-group">
					<label>Records per page</label>
					<select class="form-control" name='brand_num_page' onchange='autoSubmit2()'>
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
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				
				<?php foreach($results as $value): ?>
					<tr>
						<td width='10px' class='text-center'><?php echo $num; ?></td>
						<td><?php echo $value['brand_name']; ?></td>
						<td width='30px' class='text-center'>
							<a href="<?php echo base_url().'admin/brand/update/'.$value['brand_id'] ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
							<a href="<?php echo base_url().'admin/brand/delete/'.$value['brand_id'] ?>" title="Delete"><i class="fa fa-fw fa-minus-square"></i></a>
						</td>
					</tr>
				<?php $num++; endforeach;  ?>
				</tbody>
			</table>
			<?php echo $links; ?>
		</div>
	<?php endif; ?>
	</div>
</div>
<!-- hungtp: end form  -->