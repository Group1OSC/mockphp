<!-- hungtp: form for user to input data  -->


<div class="col-lg-6">
<?php //print_r($error); ?>
<?php //print_r($img_data);  ?>
	<?php if($msg != '')://display success message ?>
		<script>
			alert('<?php echo $msg; ?>');
			document.location.href = location.pathname; 
		</script>
	<?php endif; ?>
	
	<form role="form" action="" method="post" enctype="multipart/form-data">
		<div class="form-group <?php if(form_error('name') != '') echo 'has-error'; ?>">
			<label>Name</label>
			<label class="control-label" for="inputError"><?php echo form_error('name'); ?></label>
			<input class="form-control" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name">
		</div>
		
		<div class="form-group <?php if(form_error('country') != '') echo 'has-error'; ?>">
			<label>Country</label>
			<label class="control-label" for="inputError"><?php echo form_error('country'); ?></label>
			<input class="form-control" name="country" value="<?php echo set_value('country'); ?>" placeholder="Country">
		</div>
		
		<div class="form-group <?php if(form_error('brand') != '') echo 'has-error'; ?>">
			<label>Brand</label>
			<label class="control-label" for="inputError"><?php echo form_error('brand'); ?></label>
			<select class="form-control" name="brand">
				<?php foreach($brands as $brand): ?>
				<option value="<?php echo $brand['brand_id']; ?>" <?php if((set_value('brand') != '') && (set_value('brand') == $brand['brand_id'])) echo 'selected'; ?>><?php echo $brand['brand_name'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
			
		<div class="form-group <?php if(form_error('category[]') != '') echo 'has-error'; ?>">
			<label>Category <span id="add_cate" style="padding:1px;background-color:lightgray;border-radius:3px;"><i class="fa fa-fw fa-plus"></i></span></label>
			<label class="control-label" for="inputError"><?php echo form_error('category[]'); ?></label>
			<?php if(!isset($cate_datas)): ?>
				<div id="ini_cate">
					<select class="form-control" name="category[]">
						<?php foreach($cates as $cate): ?>
						<option value="<?php echo $cate['cate_id']; ?>"><?php echo $cate['cate_name'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			<?php else: ?>
				<?php $count = 1; foreach($cate_datas as $value): ?>
					<?php if($count == 1): ?>
					<div id="ini_cate">
						<select class="form-control" name="category[]">
							<?php foreach($cates as $cate): ?>
							<option value="<?php echo $cate['cate_id']; ?>" <?php if($value == $cate['cate_id']) echo 'selected'; ?>>
							<?php echo $cate['cate_name']; ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<?php else: ?>
						<br/>
						<select class="form-control" name="category[]">
							<?php foreach($cates as $cate): ?>
							<option value="<?php echo $cate['cate_id']; ?>" <?php if($value == $cate['cate_id']) echo 'selected'; ?>>
							<?php echo $cate['cate_name'] ?>
							</option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>
				<?php $count++; endforeach; ?>
			<?php endif; ?>
			
		</div>
		
		<div class="form-group <?php if(form_error('list_price') != '') echo 'has-error'; ?>">
			<label>Price</label>
			<label class="control-label" for="inputError"><?php echo form_error('list_price'); ?></label>
			<div class="form-group input-group">
				<span class="input-group-addon">$</span>
				<input type="text" name="list_price" value="<?php echo set_value('list_price'); ?>" class="form-control">
				<span class="input-group-addon">.00</span>
			</div>
		</div>
		
		<div class="form-group <?php if(form_error('sale_price') != '') echo 'has-error'; ?>">
			<label>Sale price</label>
			<label class="control-label" for="inputError"><?php echo form_error('sale_price'); ?></label>
			<div class="form-group input-group">
				<span class="input-group-addon">$</span>
				<input type="text" name="sale_price" value="<?php echo set_value('sale_price'); ?>" class="form-control">
				<span class="input-group-addon">.00</span>
			</div>
		</div>
		<div class="form-group <?php if(form_error('desc') != '') echo 'has-error'; ?>">
			<label>Description</label>
			<label class="control-label" for="inputError"><?php echo form_error('desc'); ?></label>
			<textarea class="form-control" name="desc" rows="3"><?php echo set_value('desc'); ?></textarea>
		</div>
		
		<div class="form-group <?php if(form_error('main_img') != '') echo 'has-error'; ?>">
			<label>Main image</label>
			<label class="control-label" for="inputError"><?php echo form_error('main_img'); ?></label>
			<input name="main_img" type="file"  accept="image/*">
		</div>
		<div class="form-group <?php if(form_error('alt_img[]') != '') echo 'has-error'; ?>">
			<label>Alternative images (Max: 10 images)</label>
			<label class="control-label" for="inputError"><?php echo form_error('alt_img[]'); ?></label>
			<input name="alt_img[]" multiple type="file" accept="image/*">
		</div>
		<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
		<button type="reset" class="btn btn-default">Clear</button>
		
	</form>
</div>
<!-- hungtp: end form  -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
	
	   $('#add_cate').click(function(){//hungtp:add more category select fields to form
			$('#ini_cate').after('<br/>'+$('#ini_cate').html());
	   });

	});

</script>