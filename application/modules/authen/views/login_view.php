<html>
<head>
	<title>Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <style>
		body{
			margin-top: 100px;
			background-color: #333333;
			}

		.error{
			color: red;
			padding-bottom: 10px;
			text-align: center;
		}
    </style>
</head>
<body>
	<div class="container">
	    <div class="row">
			<div class="col-md-4 col-md-offset-4">
	    		<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Please sign in</h3>
				 	</div>
				  	<div class="panel-body">
				    	<form accept-charset="UTF-8" role="form" method="post">
	                    <fieldset>
				    	  	<div class="form-group">
				    		    <input type="text" class="form-control" placeholder="<?php echo form_error('username') != '' ? strip_tags(form_error('username')) : "Username"; ?>" name="username" value="<?php echo set_value('username'); ?>">
				    		</div>
				    		<div class="form-group">
				    			<input type="password" class="form-control" placeholder="<?php echo form_error('password') != '' ? strip_tags(form_error('password')) : "Password"; ?>" name="password" value="">
				    		</div>
							<div class='error' id="login-error">
							<?php 
								echo isset($login_failed) ? $login_failed : "";
							?>

							</div>
				    		<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Login">
				    	</fieldset>
				      	</form>
				    </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>