<?php
if(isset($cate_name)) {
	echo "<h2>" . $cate_name . "</h2>";
}
?>

<div class="col-sm-9 padding-right">
<?php
$count = 0;
if(isset($products) && count($products) > 0){
?>

	<form id="sortForm" action="" method="post">
		<input id="get_sort" type="hidden" value="<?php echo $sort['name']; ?>" name="get_sort" />
		<input id="get_order" type="hidden" value="<?php echo $sort['order']; ?>" name="get_order" />
	</form>
<!-- SORT PRODUCT -->
	<div class="btn-group pull-right">
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
				<span id="display_sort"><?php echo $sort['name']; ?></span>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><span  onClick="getSort(this.id)" id="Name" >Name</span></li>
				<li><span onClick="getSort(this.id)" id="Price" >Price</span></li>
				<li><span  onClick="getSort(this.id)" id="Date" >Date</span></li>
			</ul>
		</div>
		
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
				<span id="display_sort2"><?php echo $sort['order']; ?></span>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><span  onClick="submitSort(this.id)" id="ASC" >ASC</span></li>
				<li><span  onClick="submitSort(this.id)" id="DESC" >DESC</span></li>
			</ul>
		</div>
	</div>
	<br/>
	<br/>
	<br/>
<!-- END SORT PRODUCT -->
<?php
	foreach($products as $product){
		$count++;
		if($count % 4 == 1){
			echo '<div class="col-sm-12">';
		}
?>
		<div class="col-sm-3">
			<div class="product-image-wrapper">
				<div class="single-products">
					<div class="productinfo text-center">
						<a href="<?php echo base_url() . 'default/home/detail/' . $product['pro_id']; ?>">
							<img src="<?php echo base_url() . $product['pro_image']; ?>" alt=""/>
						</a>
						<div class="pro-info">
								
							<h4 class="<?php echo $product['pro_list_price'] > $product['pro_sale_price'] ? "list-price-off" : "list-price" ?>">
								$<?php echo $product['pro_list_price']?>
							</h4>
							<h2>$<?php echo $product['pro_sale_price']?></h2>
							<p ><a href="<?php echo base_url() . 'default/home/detail/' . $product['pro_id']; ?>"><?php echo $product['pro_name']; ?></a></p>
						</div>
						<div>
                            <form action="" method="POST" >
                                <input type="hidden" value="<?php echo $product['pro_id'] ?>"  name="pro_id"/>
                                <input type="hidden" value="1" name="qty" />
                                <input type="hidden" value="<?php if ($product['pro_list_price']!=$product['pro_sale_price']) echo $product['pro_list_price']; else echo  $product['pro_sale_price']?>" name="pro_price" />
                                <input type="hidden" value="<?php echo $product['pro_name']?>" name ="pro_name"/>
                                <input type="hidden" value="<?php echo $product['pro_image']?>" name="pro_image" />
								
								<button type="submit" class="btn btn-fefault cart" name="addCart" value="Add to Cart">
									<i class="fa fa-shopping-cart"></i>
									Add to cart
								</button>
					 									
                            <!--
                            <p>
                            <input type="submit" name="addCart" value="Add to Cart" class="btn btn-default cart " />
                            <i class="fa fa-shopping-cart"></i>
                            </p>
							-->
							
						    <!--
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            -->
                            
                            </form>
                        </div>	
					</div>

                    <?php
                        if($product['pro_list_price'] != $product['pro_sale_price']){
                           echo "<img src='".base_url()."public/default/images/home/sale.png' class = 'new' />";
                        }
                      
					?>

				</div>
			</div>
		</div>

<?php
		if($count % 4 == 0){
			echo '</div>';
		}
	}
	echo $pages;

} else {
	echo "No product in this category.";
}
?>
</div> <!--end div .col-sm-9 .padding-right-->

<script>
	function getSort(sort){
		//alert(sort);
		document.getElementById('get_sort').value = sort;
		document.getElementById('display_sort').innerHTML = sort;
		//alert(kaka);
	}
	function submitSort(sort){
		//alert(sort);
		document.getElementById('get_order').value = sort;
		document.getElementById('display_sort2').innerHTML = sort;
		//alert(kaka);
		document.forms['sortForm'].submit();
	}
</script>