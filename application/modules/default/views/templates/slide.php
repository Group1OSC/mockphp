<?php if(!empty($slide_data)): ?>
<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">featured products</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
		<?php $total = count($slide_data)-1; $count = 1; foreach($slide_data as $key=>$value): ?>
			<?php $check = $key%3; if($check == 0): ?>
			<div class="item <?php if($key == 0){ echo 'active';} ?>">
			<?php $count = 1; endif; ?>		
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<a href="<?php echo base_url() . 'default/home/detail/' . $value['pro_id']; ?>">
								<img src="<?php echo base_url(); ?><?php echo $value['pro_image']; ?>" alt="" />
								</a>
								<h4 class="<?php echo $value['pro_list_price'] > $value['pro_sale_price'] ? "list-price-off" : "list-price" ?>">
								$<?php echo $value['pro_list_price']?>
							</h4>
								<h2>$<?php echo $value['pro_sale_price']; ?></h2>
								<a href="<?php echo base_url() . 'default/home/detail/' . $value['pro_id']; ?>">
								<p><h3></a><?php echo $value['pro_name']; ?></h3></p>
								</a>
							</div>
							
						</div>
					</div>
				</div>
			<?php if($count == 3 || $key == $total): ?>
			</div>
			<?php endif; ?>	
		<?php $count++; endforeach; ?>
		</div>
		 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		  </a>
		  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		  </a>			
	</div>
</div><!--/recommended_items-->
<?php endif; ?>