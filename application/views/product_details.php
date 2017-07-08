<ul class="breadcrumb">
	<!--<li><a href="index.html">Home</a> <span class="divider">/</span></li>
	<li class="active">Products Name</li>-->
	<?php 
		$breadCrumb = $obj->getBreadCrumb();
		foreach($breadCrumb as $breadcrumbs)
		{
			echo '<li>
					<a href="'.$breadcrumbs["link"].'">'.$breadcrumbs["name"].'</a><span class="divider">/</span>
				</li>';
		}
	?>
</ul>	
	<div class="row">	  
			<div id="gallery" class="span3">
            <a href="<?php echo $obj->product["product_image"]."&width=500&height=500"; ?>" title="<?php echo $obj->product["product_name"]; ?>">
				<img id = "prod-img" src="<?php echo $obj->product["product_image"]."&width=270&height=270"; ?>" style="width:100%" alt="<?php echo $obj->product["product_name"]; ?>"/>
            </a>
			<!--
			<div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                   <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                  </div>
                  <div class="item">
                   <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                  </div>
                </div>              
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
			  
              </div>-->
			  
			<!-- <div class="btn-toolbar">
			  <div class="btn-group">
				<span class="btn"><i class="icon-envelope"></i></span>
				<span class="btn" ><i class="icon-print"></i></span>
				<span class="btn" ><i class="icon-zoom-in"></i></span>
				<span class="btn" ><i class="icon-star"></i></span>
				<span class="btn" ><i class=" icon-thumbs-up"></i></span>
				<span class="btn" ><i class="icon-thumbs-down"></i></span>
			  </div>
			</div>-->
			</div>
			<div class="span6">
				<h3><?php echo $obj->product["product_name"]; ?></h3>
				<!--<small>- (14MP, 18x Optical Zoom) 3-inch LCD</small>-->
				<hr class="soft"/>
				<form class="form-horizontal qtyFrm" onsubmit = "addtocartwithquantity($(this).attr('action')+'/'+$('#qty').val(),this,event);" action = "<?php echo  base_url().'cart/addtocart/'.$obj->product['product_id'];?>">
				  <div class="control-group">
					<label class="control-label">
						<?php 
							if($obj->product["discount_status"] == "1")
							{
								echo '
									<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "text-decoration:line-through;color : red;">Rs.'.$obj->product["product_price"].'/-</span><br />
									<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "">Rs.'.$obj->product["discount_price"].'/- </span>
								';
							}
							else
							{
								echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">Rs.'.$obj->product["product_price"].'/-</span>';
							}
						?>
					</label>
					<div class="controls" style="clear: both;margin-left: 0px;">
						<input type="number" id = "qty" class="span1 num_inc" placeholder="Qty."/>
					  <button type="submit" class="btn btn-large btn-success pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
					</div>
					
				  </div>
				</form>
				
				<!--<hr class="soft"/>
				<h4>100 items in stock</h4>
				<form class="form-horizontal qtyFrm pull-right">
				  <div class="control-group">
					<label class="control-label"><span>Color</span></label>
					<div class="controls">
					  <select class="span2">
						  <option>Black</option>
						  <option>Red</option>
						  <option>Blue</option>
						  <option>Brown</option>
						</select>
					</div>
				  </div>
				</form>-->
				<hr class="soft clr"/>
				<?php 
					if($obj->product["product_features"])
					{
						echo '<p style=" max-height: 100px;overflow: hidden;">'.$obj->product["product_features"].'</p>';
					}
				?>
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>
			<hr class="soft"/>
			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
			  <?php 
			  	if($this->product["related_Products"])
				{
					echo '<li><a href="#profile" data-toggle="tab">Related Products</a></li>';
				}
			  ?>              
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Product Name: </td><td class="techSpecTD2"><?php echo $obj->productname; ?></td></tr>
				<?php 
					if($obj->product['brand_details'])
					{
						echo '<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">
							<a href = "'.base_url()."product/SearchResults?brands_search=".$obj->product['brand_details']['brand_id'].'">';
							//<div class = "span1"><center>
					/*	if($this->product['brand_details']['brand_image'])
						{
							echo '<img src ="'.$obj->product['brand_details']['brand_image'].'" style = "width : 30px;"/><br />';
						}	*/
						echo ''.$obj->product['brand_details']['brand_name'];
						//</center></div>
							
						echo	'
							</a>
							</td></tr>';
					}
					
					if($this->product['categories'])
					{
						echo '<tr class="techSpecRow"><td class="techSpecTD1">Categorised as: </td><td class="techSpecTD2">';
						foreach($this->product['categories'] as $category)
						{
							echo "<a href = '".base_url()."categories/".$category['category_id']."'>".$category['category_name']."</a><br />";
						}						
						echo '</td></tr>';
					}
					
					if($this->product['sub_categories'])
					{
						echo '<tr class="techSpecRow"><td class="techSpecTD1">Subcategorised as: </td><td class="techSpecTD2">';
						foreach($this->product['sub_categories'] as $subcategory)
						{
							echo "<a href = '".base_url()."subcategories/".$subcategory['parent_category_id']."/".$subcategory['category_id']."'>".$subcategory['category_name']."</a><br />";
						}						
						echo '</td></tr>';
					}
				?>	
				</tbody>
				</table>
				<?php 
					if($obj->product["product_features"]!="" && $obj->product["product_features"] != ".")
					{
						echo "<h3>Features</h3>				
							".$obj->product["product_features"]."
							<hr class='soft'/>
						";
					}
					if($obj->product["product_ingredients"]!="" && $obj->product["product_ingredients"]!= ".")
					{
						echo "<h3>Product Ingredients</h3>				
							".$obj->product["product_ingredients"]."
							<hr class='soft'/>
						";
					}
					if($obj->product['brand_details']['brand_description'])
					{
						echo "
								<h4><u>About ".$obj->product['brand_details']['brand_name']."</u></h4>
								<br /><br />";
						if($obj->product['brand_details']['brand_image'])
						{							
							echo		"
									<div class = 'span2'>
										<img src = '".$obj->product['brand_details']['brand_image']."' />
									</div>
									<div class = 'span6'>
										".$obj->product['brand_details']['brand_description']."
									</div>
							";						
						}
						else
						{
							echo "<div class = 'span8'>
										".$obj->product['brand_details']['brand_description']."
									</div>";
						}
						echo "<hr class='soft'/>";
					}
				?>
				
              </div>
		<?php 
			if($this->product["related_Products"])
			{
		?>
		<div class="tab-pane fade" id="profile">
		<div id="myTab" class="pull-right">
		 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
		 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
		</div>
		<br class="clr"/>
		<hr class="soft"/>
		<div class="tab-content">
			<div class="tab-pane" id="listView">
				<?php
					foreach($this->product["related_Products"] as $products)
					{
						echo '<div class="row">	  
								<div class="span2">
									<img src="'.$products['product_image'].'" alt=""/>
								</div>
								<div class="span4">
								<h3>'.$products['product_name'].'</h3>
								<hr class="soft"/>';
						if($products['discount_status'] == '1')			  
						{
							echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "text-decoration:line-through;color : red;">Rs.'.$products['product_price'].'/-</span><br />
								<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "">Rs.'.$products['discount_price'].'/- </span>';
						}
						else
						{
							echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">Rs.'.$products['product_price'].'/-</span>';
						}					
						echo '<br class="clr"/>
								</div>
								<div class="span3 alignR">';
						if($products['is_new'] == '1')
						{
							echo '<center><i class="tag" style="position:relative;"></i></center>';
						}		
						echo '<br/>
								 <a href="'.base_url().'cart/addtocart/'.$products['product_id'].'" class="btn btn-large btn-success"> Add to <i class=" icon-shopping-cart"></i></a>
								 &nbsp;&nbsp;&nbsp;
								 <a href="'.base_url().'product/'.urlencode(addunderscores($products["product_name"])).'" class="btn btn-warning btn-large"><i class="icon-zoom-in"></i></a>
								</div>
								</div>
								<hr class="soft"/>';
					}
				?>	
			</div>
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
					<?php 
						foreach($this->product["related_Products"] as $products)
						{
							echo '
								<li class="span3">
									 <div class="thumbnail">
									<a  href="'.base_url().'product/'.urlencode(addunderscores($products["product_name"])).'">
							';
							if($products['is_new'] == '1')
							{
								echo '<i class="tag"></i>';
							}
							if($products['product_image'])	
							{
								echo '<img src="'.$products['product_image'].'&width=260&height=160" alt=""/>';	
							}
							echo '</a>
									<div class="caption">
									<h5>'.$products['product_name'].'</h5>
									<h4 style="text-align:center">
									<a class="btn btn-warning" href="'.base_url().'product/'.urlencode(addunderscores($products["product_name"])).'">
										<i class="icon-zoom-in"></i>
										</a>
										&nbsp;&nbsp;&nbsp;
										<a class="btn btn-success addtocart" href="'.base_url().'cart/addtocart/'.$products['product_id'].'">Add to <i class="icon-shopping-cart"></i>
										</a>  </h4>
										<div class = "price-dp">';
							if($products['discount_status'] == '1')			  
							{
								echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "text-decoration:line-through;color : red;">Rs.'.$products['product_price'].'/-</span>
									<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "">Rs.'.$products['discount_price'].'/- </span>';
							}
							else
							{
								echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">Rs.'.$products['product_price'].'/-</span>';		  
							}
							echo '				</div>	
											</div>
										</div>
									</li>';
						}
					?>			
				  </ul>
			<hr class="soft"/>
			</div>
		</div>
				<br class="clr">
		</div>		
		<?php
			}
		?>
		</div>
          </div>

	</div>
<script>
	$(document).ready
	(
		function()
		{
			setInterval(function(){if(parseInt($(".num_inc").val()) < 1)$(".num_inc").val(1);})			
		}
	);
</script>