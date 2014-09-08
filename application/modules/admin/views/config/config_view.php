        
        <div class="col-sm-4">
			<form action="" method="post">
				<label>Number Product of page</label>
				<input type="text" class="form-control" name="config_page" value="<?php echo $config_page['config_page']; ?>"/>
				<?php echo form_error("config_page"); ?>  
				<br/>
				<label>&nbsp;</label>
				<input type="submit" name="update" class="btn btn-primary" value="Update"/>
				<input type="submit" name="cancel" class="btn btn-default" value="Cancel" />
			</form>
        </div>    
