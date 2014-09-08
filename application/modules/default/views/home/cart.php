<meta charset="utf-8"/>
<script>
    function check(){
        alert("Your Cart is empty, you can't check out");
        return false;
    }
</script>
	<section id="cart_items">
		<div class="container">
        
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url()."default/home/index"; ?>">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
            
         <form action="" method="POST">
			<div class="table-responsive cart_info">
            
            	<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Product Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
                            <td class="delete">Delete</td></td>
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
                            
							<td class="cart_delete">
								<a class="cart_quantity_delete" href='<?php echo base_url()."default/home/delete/".$product['id']?>'><i class="fa fa-times"></i></a>
							</td>
                            
						</tr>
                     <?php
                        	$total_price+=$product['price']*$product['qty'];
                          
                     }
                     
                     
                     ?>   
                        <!--end print item -->    
					</tbody>
                    
				</table>
                
             </div>
             <?php
                if($total_product==0) echo "<center><h3>You had n't bought a product, please shopping now! </h3></center>";
                     
             ?>
                <div class="col-sm-6" style="float:right; display:inline-block; ">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$<?php echo $total_price ?></span></li>
							<li>Eco Tax(5%) <span>$<?php  $tax = $total_price * 0.05; echo  $tax; ?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$<?php  echo $total_price + $tax;  ?></span></li>
						</ul>
                    </div>
                    
                    <div class="col-sm-6 pull-right">
                        <div class="col-sm-12">
                        
                            <div class="col-sm-5">
               	                <input type="submit" name="update-cart" value="Update" class="btn btn-default update" />
                            </div>
                            
                            <div class="col-sm-2">
                            </div>
                                <div class="col-sm-5">   
    			                     <a class="btn btn-default check_out" <?php if($total_product==0) echo "onclick ='if(check() == false) return false' " ?> href="<?php echo base_url()."default/home/checkout" ?> ">Check Out</a>
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <a class="btn btn default update" href="<?php echo base_url()."default/home/deleteall"; ?>" >Clear Cart</a>
                            </div>
				       </div>
            </form>
	</div>
</div>
        
        
		