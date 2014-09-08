<section>
<div class="col-sm-3">
	<div class="left-sidebar">
		<!--/category-products<h2>Category</h2>
		<div class="panel-group category-products" id="accordian">
			<?php //if(empty($get_treeview)):?>
				<p>There is no category yet.</p>
			<?php //else: ?>
				<?php //echo $get_treeview; ?>
			<?php //endif; ?>
		</div>-->
		
		<!--FORM FOR FILTER ACTION -->
		<form action="" method="post">
		
		<input type="hidden" name="category" value="<?php echo $this->uri->segment(4); ?>" />
		<div class="brands_products"><!--brands_products-->
			<h2>Brands</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
				<?php if(empty($brand_data)):?>
					<li>There is no brand yet.</li>
				<?php else: ?>
					<?php foreach($brand_data as $value): ?>
						<li class="filter-text">
						<input class="pull-left" type="checkbox" name="brands[]" value="<?php echo $value['brand_id']; ?>" <?php if(!empty($filter['brands']) && in_array($value['brand_id'],$filter['brands'])) echo 'checked'; ?> style="margin-right:10px"/>
						<?php echo $value['brand_name']; ?>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
				</ul>
			</div>
		</div><!--/brands_products-->
		
		<div class="price-range"><!--price-range-->
			<h2>Price Range</h2>
			<div class="well text-center">
				 <input type="text" class="span2" name="price_range" value="<?php if(!empty($filter['price_range'])) echo $filter['price_range'][0].','.$filter['price_range'][1]; else echo '0,'.$max_price; ?>" data-slider-min="0" data-slider-max="<?php echo $max_price; ?>" data-slider-step="5" data-slider-value="[<?php if(!empty($filter['price_range'])) echo $filter['price_range'][0].','.$filter['price_range'][1]; else echo '0,'.$max_price; ?>]" id="sl2" ><br />
				 <b class="pull-left">$ 0</b> <b class="pull-right">$ <?php echo $max_price; ?></b>
			</div>
		</div><!--/price-range-->
		
		<div class=" text-center">
			<input class="btn btn-primary" type="submit" name="" value="Filter"/>
		</div>
		</form>
		<!--END FORM -->
	
	</div>
</div>
</section>