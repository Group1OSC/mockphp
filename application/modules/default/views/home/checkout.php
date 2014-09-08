<style>
    .error{
        color:red;
    }
</style>
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->
        <form action="" method="POST">    
		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-6 col-offset-3">
					<div class="shopper-info">
						<p>Shopper Information</p>
						
							<input type="text" name="name"placeholder="Customer Name"/>
                            <span class="error" ><?php echo form_error("name") ?></span>
                            
							<input type="text" name="email" placeholder="Email"/>
                            <span class="error" ><?php echo form_error("email") ?></span>
                            
							<input type="text" name="phone" placeholder="Phone" />
                            <span class="error" ><?php echo form_error("phone") ?></span>
							
							<input type="text" name="address" placeholder="Address" />
                            <span class="error" ><?php echo form_error("address") ?></span><br />

					</div>
				</div>
				
			</div>
		</div>
		<div class="review-payment">
			<h2>Review & Payment</h2>
		</div>

		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
                    <!-- print item -->
                    <?php
                    $total_product = $this->cart->total_items();
			        $total_price=0;

                    foreach($products as $product){
                        

                    ?>    
						<tr> 
							<td class="cart_product">
                                <a href="">
							         <img src="<?php echo base_url() . $product['options']['pro_image']; ?>" height="50" width="50" alt=""/>
						        </a>
							</td>
                            
							<td class="cart_description">
								<h4><?php echo $product['name'] ?></h4>
							</td>
                            
							<td class="cart_price">
								<p><?php echo "$".$product['price']; ?></p>
							</td>
                            
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
                                       <input class="cart_quantity_input" type="text" name="quantity[]" value="<?php echo $product['qty'] ?>" size="2" />
                                  	<a class="cart_quantity_down" href=""> - </a>
     							</div>
							</td>
                            
							<td class="cart_total">
								<p class="cart_total_price"><?php echo "$".$product['subtotal'] ?></p>
							</td>
                            
                            <input type="hidden" name="idCart" value="<?php echo $product['rowid']?>" />
                            
                            
						</tr>
                     <?php
                        	$total_price+=$product['price']*$product['qty'];
                          
                     }
                     
                     
                     ?>   
                        <!--end print item -->    
					<tr>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								<tr>
									<td>Cart Sub Total</td>
									<td><span>$<?php echo $total_price ?></span></td>
								</tr>
								<tr>
									<td>Exo Tax(5%)</td>
									<td><span>$<?php  $tax = $total_price * 0.05; echo  $tax; ?></span></td>
								</tr>
								<tr class="shipping-cost">
									<td>Shipping Cost</td>
									<td><h4>Free</h4></td>										
								</tr>
								<tr>
									<td>Total</td>
									<td><span><span>$<?php  echo $total_price + $tax;  ?></span></span></td>
								</tr>
							</table>
						</td>
					</tr>
                    
				</tbody>
			</table>
		</div>
        
        <div class = "col-sm-12" >
		<div class="payment-options">  
            <div style="float: right;">
                <input type="submit" name="checkout" value="Checkout" class="btn btn-success" style="margin: 0px;" />
            </div>
    	</div>
        
         </div>
      </form>
</section> <!--/#cart_items-->