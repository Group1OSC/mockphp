
    <script src="<?php echo base_url(); ?>public/default/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>public/default/js/jRating.jquery.js"></script>

<div class="col-sm-10 col-md-offset-1">
	<div class="product-details"><!--product-details-->
		<div class="col-sm-5">
			<div class="view-product">
				<img class="main-img" src="<?php echo base_url() . $product['pro_image']; ?>" alt="" />
			</div>

			<?php if(count($alt_images) > 1){ ?>

			<div id="similar-product" class="carousel slide" data-ride="carousel">
				
				  <!-- Wrapper for slides -->
					<div class="carousel-inner">

					<?php foreach($alt_images as $key => $img){

						if($key == 0) echo '<div class="item active">'."\n";
						if($key % 3 == 0 && $key != 0) echo '<div class="item">' ."\n";
						
						echo '<img class="alt-img" width="84" height="84" src="' . base_url() . $img . '" alt="">' . "\n";

						if($key % 3 == 2) echo '</div>' . "\n";
						}

						if(count($alt_images) % 3 != 0){
							echo "</div>"  . "\n";
						}
					?>

					</div>

				  <!-- Controls -->
				  <a class="left item-control" href="#similar-product" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				  </a>
				  <a class="right item-control" href="#similar-product" data-slide="next">
					<i class="fa fa-angle-right"></i>
				  </a>
			</div>
			<?php } ?>
		</div>
		<div class="col-sm-7">
			<div class="product-information"><!--/product-information-->
				<h2><?php echo $product['pro_name'] ?></h2>
				<div class="rate" data-average="<?php echo isset($avg_rate) ? $avg_rate : '0'; ?>"></div>
				<span>
					<form action="" method="post">
						<span>US $<?php echo $product['pro_sale_price']; ?></span>
						<label>Quantity:</label>
						<input type="text" name="qty" value="1" />
							
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
                	</form>
				</span>
				<p><b>Availability:</b> In Stock</p>
				<p><b>Condition:</b> New</p>
				<p><b>Brand:</b> <?php echo $product['brand_name']; ?></p>
				<p><b>Country:</b> <?php echo $product['pro_country']; ?></p>			
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->
	
	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li><a href="#details" data-toggle="tab">Details</a></li>
<!-- 				<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
				<li><a href="#tag" data-toggle="tab">Tag</a></li> -->
				<li class="active"><a href="#reviews" data-toggle="tab">Reviews <?php echo $num_of_feedback > 0 ? '(' . $num_of_feedback . ')' : "" ?></a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade" id="details" >
				<p>
					<?php echo nl2br($product['pro_desc']); ?>
				</p>
			</div>
			
			<div class="tab-pane fade active in" id="reviews" >
				<div class="col-sm-12">
				<?php 
				if(isset($feedbacks) and count($feedbacks) > 0){
					foreach($feedbacks as $feedback){
						$feedback_time = new DateTime($feedback['feedback_time']);
						$date = strtoupper($feedback_time->format('d M Y'));
						$time = $feedback_time->format('h:i:s A');
				?>
					<ul>
						<li><a><i class="fa fa-user"></i><?php echo $feedback['feedback_name'] ?></a></li>
						<li><a><i class="fa fa-clock-o"></i><?php echo $time ?></a></li>
						<li><a><i class="fa fa-calendar-o"></i><?php echo $date ?></a></li>
					</ul>
					<div class="rate" data-average="<?php echo $feedback['feedback_rate']; ?>"></div>
					<br>
					<p><?php echo $feedback['feedback_content'] ?></p>
					<hr>
				<?php
					}
					if(isset($pages)) echo $pages;
				}
				?>
					<br>
					<?php 
						if(isset($just_feedback)){
							echo "<p><i>Thank you for your feedback. Your review is waiting for admin to approved.</i></p>";
						} 
					?>
					<br>
					<p><b>Write Your Review</b></p>
					
					<form method="post">
						<span>
							<input type="text" name="name" placeholder="<?php echo form_error('name') != '' ? strip_tags(form_error('name')) : "Your Name"; ?>" value="<?php echo set_value('name');?>" />
							<input type="email" name="email" placeholder="<?php echo form_error('email') != '' ? strip_tags(form_error('email')) : "Email Address"; ?>" value="<?php echo set_value('email');?>"/>
						</span>
						<textarea name="content" placeholder="<?php echo form_error('content') != '' ? strip_tags(form_error('content')) : ""; ?>" ><?php echo isset($content) ? $content : ""; ?></textarea>
						<label for="star-rating"><b>Rating</b></label>
            			<span id="star-rating" data-average="<?php echo isset($rating) ? $rating : "5"; ?>" data-id="1"></span>
            			<input type="hidden" name="rating" id="rating" value="" />
            			<input type="submit" class="btn btn-default pull-right" name="btnFeedback" value="Submit">
					</form>
				</div>
			</div>
			
		</div>
	</div><!--/category-tab-->
	
</div>

<script>
	// display alternative product images
	$(document).ready(function(){

		$('.alt-img').click(function(){
			$('.main-img').attr('src', $(this).attr('src'));
		});

		$("#star-rating").jRating({
			rateMax : 5,
			decimalLength: 0.5,
			onClick : function(element, rate){
			    $('#rating').val(rate);
			}
		});
		   
		$(".rate").jRating({
			rateMax : 5,
			isDisabled : true
		});		
	})
</script>

