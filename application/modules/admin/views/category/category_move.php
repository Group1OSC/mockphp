

<div class="col-lg-12">
<div class="dd" id="nestable">
	<ol class="dd-list">
		<?php 
			echo $get_treeview;
		?>	
	</ol>
</div>
</div>
<form id="form_tree">
<textarea name="data" id="nestable-output"></textarea>
</form>


<script>
//this is to handle event updating position of categories
	$(document).ready(function(){
	
	//alert("<?php echo base_url(); ?>admin/category/move");
		var updateOutput = function(e)
		{
			var list   = e.length ? e : $(e.target),
				output = list.data('output');
			if (window.JSON) {
				output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
				//alert(JSON.stringify(list.nestable('serialize')));
				
				var treeData = $("#form_tree").serializeArray();
				$.ajax({//send changed data to controller to update db
					type:"GET",
					url:"<?php echo base_url(); ?>admin/category/data",
					data:treeData,
					contentType: 'application/json',
					success:function(result){
						//alert(result);
					},
					error:function(xhr){
						alert(xhr);
					}
				});
			} else {
				output.val('JSON browser support required for this demo.');
			}
		};

		// activate Nestable for list 1
		$('#nestable').nestable({
			group: 1
		})
		.on('change', updateOutput);
		
		// output initial serialised data
		updateOutput($('#nestable').data('output', $('#nestable-output')));
		//alert($('#nestable-output').val());
	
	});
</script>