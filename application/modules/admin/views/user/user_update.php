<!-- hungtp: form for user to input data  -->

<div class="col-lg-6">
<?php //echo validation_errors(); ?>
	<?php if($msg != '')://display success message ?>
		<script>
			alert('<?php echo $msg; ?>');
			document.location.href = location.pathname; 
		</script>
	<?php endif; ?>
	
	<form role="form" action="" method="post">
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" name="name" value="<?php echo $user_data['user_name']; ?>" placeholder="Username" readonly>
		</div>
		
		<div class="form-group <?php if(form_error('pass') != '') echo 'has-error'; ?>">
			<label>Password</label>
			<label class="control-label" for="inputError"><?php echo form_error('pass'); ?></label>
			<input class="form-control" name="pass" type="password" value="" placeholder="Password">
		</div>
		
		<div class="form-group <?php if(form_error('passconf') != '') echo 'has-error'; ?>">
			<label>Password confirmation</label>
			<label class="control-label" for="inputError"><?php echo form_error('passconf'); ?></label>
			<input class="form-control" name="passconf" type="password" value="" placeholder="Password confirmation">
		</div>
		
		<div class="form-group <?php if(form_error('address') != '') echo 'has-error'; ?>">
			<label>Address</label>
			<label class="control-label" for="inputError"><?php echo form_error('address'); ?></label>
			<input class="form-control" name="address" value="<?php echo $user_data['user_address']; ?>" placeholder="Address">
		</div>
		
		<div class="form-group <?php if(form_error('phone') != '') echo 'has-error'; ?>">
			<label>Phone</label>
			<label class="control-label" for="inputError"><?php echo form_error('phone'); ?></label>
			<input class="form-control" name="phone" value="<?php  echo $user_data['user_phone']; ?>" placeholder="Phone - range from 10 to 11 digits">
		</div>
		
		<div class="form-group <?php if(form_error('email') != '') echo 'has-error'; ?>">
			<label>Email</label>
			<label class="control-label" for="inputError"><?php echo form_error('email'); ?></label>
			<input class="form-control" name="email" value="<?php  echo $user_data['user_email']; ?>" placeholder="Email">
		</div>
		<label>Gender</label>
		<div class="radio">
			<label>
				<input type="radio" name="gender" id="male" value="1" <?php if($user_data['user_gender'] == 1 ) echo 'checked';?>>Male
			</label>
			<label>
				<input type="radio" name="gender" id="female" value="2" <?php if($user_data['user_gender'] == 2) echo 'checked';?>>Female
			</label>
		</div>
		<label>Level</label>
		<div class="radio">
			<label>
				<input type="radio" name="level" id="admin" value="1" <?php if($user_data['user_level'] == 1) echo 'checked';?>>Admin
			</label>
			<label>
				<input type="radio" name="level" id="member" value="2" <?php if($user_data['user_level'] == 2) echo 'checked';?>>Member
			</label>
		</div>
		<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
		<button type="reset" class="btn btn-default">Clear</button>
		
	</form>
</div>
<!-- hungtp: end form  -->