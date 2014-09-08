<meta charset="utf-8" />
<title>Update Products</title>
<style>
    .notification{
        color: red;
    }
</style>
<script>
	function checkDelete(){
        press = confirm("Are you sure delete?");
        if(press == true)
            return true;
        else return false;
    }
    function checksetMainImage(){
        press = confirm("Are you sure set this thumb to Main Image?");
        if(press == true)
            return true;
        else return false;
    }
</script>
<div class="container-fluid">
    <div class="row">
    <!--    <div class="input-group"> -->
        <div class="col-lg-12">
            <div class="col-lg-4">
                <form action="" method="post" class="" enctype= "multipart/form-data" >
            	   <label><b>Product Name</b></label>
	               <input type="text" name="pro_name" class="form-control" value="<?php echo $inforProduct['pro_name']; ?>" /><br />
                   <span class="error"><i><?php echo form_error("pro_name"); ?></i></span>
	               <br/>
    
	               <label><b>Product Price</b></label>
                   <input type="text" class="form-control" name="pro_list_price" value="<?php echo $inforProduct['pro_list_price']; ?>" /><br />
                   <span class="error"><i><?php echo form_error("pro_list_price"); ?></i></span>
                   <br/>
    
                   <label><b>Price sale</b></label>
                   <input type="text" class="form-control" name="pro_sale_price" value="<?php echo $inforProduct['pro_sale_price']; ?>"/><br />
                   <span class="error"><i><?php echo form_error("pro_sale_price"); ?></i></span>
                   <br />

                    <label><b>Category</b></label>
                    <div class="category_list">
                        <?php 
                            $stt = 1;
                            foreach($listCategory as $key=>$val){
                                if(in_array($val['cate_id'],$listCateId)){
                                    $checked = "checked='checked'";
                                }else{
                                    $checked = "";
                                }
           		                $name=array();
                                $name = '<input '.$checked.' type="checkbox" name="category[]" value="'.$val['cate_id'].'" id="input_cate"/>'.$val['cate_name'];
                                echo "<br />";
                                echo $name;
                            }

                        ?>   
                    </div>
          
                    <label><b>Product description</b></label><br />
                    <textarea name="pro_desc" id="input-short" class="form-control" ><?php echo $inforProduct['pro_desc']; ?></textarea>
                    <br/>

                    <label><b>Product Country</b></label>
                    <input type="text" name="pro_country" class="form-control" value="<?php echo $inforProduct['pro_country'];?>" />
                    <br/>
    
                    <div id="brand">
                        <label><b>Brand</b></label>
                        <select name="brand_id" class="form-control">
                        <option value="">Select brand</option>
                            <?php 
                                if(isset($brand) && $brand != null) {
                                    foreach($brand as $listBrand) {
                                        if($inforProduct['pro_brand'] == $listBrand['brand_id']) {
                                        $selected = "selected='selected'";
                                        }else{
                                        $selected = "";
                                    }
                                    echo "<option $selected value='".$listBrand['brand_id']."'>".$listBrand['brand_name']."</option>";    
                                    }
                                } 
                            ?>
                        </select>
                    </div><!--end div brand -->
                    <br/><br />
            </div><!--end div left-->
              
<!-- -----------------------update images------------------------------- -->

            <div class="col-lg-8">
                <div id="MainImage">
                    <h3>Image</h3>        
                    <hr />
                        <?php
                            if($inforProduct['pro_image'] != null){
                                echo "<img src='".base_url().$inforProduct['pro_image']."' width='200' /><br />";
                            }
                        ?>
                    <label><b>Product Main Image</b></label>
                    <input type="file" name="images" value="" />    
                </div>
                
                <div id="thumbs" >
                    <br />
                    <span class="notification">
                    <label><b>You can up load only less than <?php echo  10-count($listThumb); ?> Thumbs Image</b></label><br />
                    </span>
                    <label><b> List Thumbs Images </b></label><br />
                    <table id="table_Thumb" border='1' >
                    <?php
                        if($listThumb != null ) {
                                                       
                            foreach($listThumb as $val) {
                                echo "<tr>";
                                echo "<img src='".base_url().$val['img_link']."' width='100' />";
                                echo "</tr>";
                                echo "<a href='http://localhost/mockphp/admin/product/deleteThumb/".$val['img_id']."/".$this->uri->segment(4)." ' onclick='if(checkDelete() == false) return false;' ><i class='fa fa-fw fa-minus-square'></i></a>";
                                echo "<a href='http://localhost/mockphp/admin/product/setMainImage/".$val['img_id']."/".$this->uri->segment(4)." ' onclick='if(checksetMainImage() == false) return false;' ><i class='fa fa-check'></i></a>";

                            }
                        }
                          echo "<br/><input type='file' name='thumb[]' multiple ='10' enctype= 'multipart/form-data' />";
                 
                    ?>
	                </table><br />
                    <span class="error"><i><?php echo isset($errorUpload)? $errorUpload: ""; ?></i></span>
	              
                </div>
                

			
            </div><!--end div right -->
    
        </div> 
    </div>

        <div class="col-sm-6" style="margin-top: 10px;">
            <input type="submit" name="update" value="Update" class="btn btn-primary" />&nbsp;
            <input type="submit" name="cancel" value="Cancel" class="btn btn-default" />
        </div>
        </form>
        
















