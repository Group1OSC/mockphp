<!-- hungtp: form for user to input data  -->

<script>
	function checkDelete(){
		if(confirm('Do you want to delete this item?')){
			return true;
		}else{
			return false;
		}
	}
</script>
<div class="col-lg-12">

<div class="dd" id="nestable">
	<?php if($count_data == 0): ?>
		<p>There is no data yet.</p>
	<?php else: ?>
	<ol class="dd-list">
		<?php 
			echo $get_treeview;
		?>	
	</ol>
	<?php endif; ?>
</div>
</div>
<!-- hungtp: end form  -->