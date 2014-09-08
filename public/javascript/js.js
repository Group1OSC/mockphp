/**
 * 
 */

$(function(){
	$("#catetree").nestable({
		group:1
	})
	.on("change",function(){
		var data = $('#catetree').nestable("serialize");
		var $json = createOut(data,0,0);
		$json = JSON.parse("{" + $json.slice(0,$json.length - 1) + "}"); 
		$.ajax({
			type:"POST",
			url:"move_process",
			data:{data: $json}
		});
	});

	function createOut(data,parent,level){
		var out ="";
		var i;
		if (!parent){
			parent = 0;
		}
		if (!level){
			level = 0;
		}
		for (i=0; i<data.length; i++){
			out += '"' + data[i]['id'] + 'a":"' + parent + '",';
			if ((typeof data[i]['children']) == "object"){
				out += createOut(data[i]['children'],data[i]['id'],level=1);
			}
		}
		return out;
	}





});