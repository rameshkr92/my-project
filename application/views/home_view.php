<?php
	$theme_url = base_url()."theme/";
?>

			<div style = "clear: both;height : 30px;"></div>
			<?php  
			  	if($featuredproducts)
				{
			?>		
			<div class="well well-small" style = "clear: both;">
			<h4>
				Featured Products (<a href = "<?php echo base_url(),"product/viewFeaturedProducts" ?>">View All</a>)
				<small class="pull-right"><?php echo count($featuredproducts); ?> featured products</small>
				
			</h4>
			<div class="row-fluid">					
			<div id="featured" class="carousel slide">
			<div class="carousel-inner">
			<?php
			$prodcnt = 0;
			$cntfeatured = count($featuredproducts);			
			while($cntfeatured % 4 != 0)
			{
				--$cntfeatured;
			}
			foreach($featuredproducts as $products)
				{
					$cntfeatured--;
					$prd_name = $products['product_name'];
					$len = strlen($prd_name);
					if($len > 35)
					{$prd_name = substr($prd_name,0,35)."...";}
					if($prodcnt % 4 == 0)	
					{
						$class = "";
						if($prodcnt = 0)$class = "active";
						echo '<div class="item '.$class.'">
						  			<ul class="thumbnails">';
					}
					echo '
						<li class="span3">
						  <div class="thumbnail">
						  <i class="tag"></i>
							<a style = "width : 186px;height:160px;" href="'.base_url().'product/'.urlencode(addunderscores($products['product_name'])).'">';
					if($products['product_image'])
					echo '<img src="'.$products['product_image'].'&width=186&height=160" alt="">';
								
							
					echo '		</a>
							<div class="caption">
							  <h5>'.$prd_name.'</h5>
							  ';
				if($products['discount_status'] == '1')			  
				{
					echo '
					<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "text-decoration:line-through;color : red;">Rs.'.number_format($products['product_price']).'/-</span>
						<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "">Rs.'.number_format($products['discount_price']).'/- </span>	
					';		  
				}
				else
				{
					echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">Rs.'.number_format($products['product_price']).'/-</span>';		  
				}	  
							  
				echo 	  '<br /><br />
							<center>  
								<a class="btn btn-info" href="'.base_url().'product/'.urlencode(addunderscores($products['product_name'])).'">VIEW</a>
							</center>
							  </div>
						  </div>
						</li>	
					';
					if($prodcnt%4 == 3)	
					{
						echo '</ul>
							  </div>';	
					}	
					$prodcnt++;
					if($cntfeatured == 0)
					{
						break;
					}
				}
			  ?>	
			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>
		<?php
		}
		?>
		<?php   if($latestproducts)
			  {?>
			  <div style = "clear: both;"></div>
		<h4>Latest Products  (<a href = "<?php echo base_url(),"product/viewLatestProducts" ?>">View All</a>)</h4> 
			  <ul class="thumbnails">
			  <?php			
			 // 	echo "<pre>";print_r($latestproducts);die;
			  	foreach($latestproducts as $products)
				{					
					echo '
						<li class="span3">
						  <div class="thumbnail">
							<a  href="'.base_url().'product/'.urlencode(addunderscores($products['product_name'])).'">';
					if($products['is_new'] == '1')
					{
						echo '<i class="tag"></i>';
					}		
					if($products['product_image'])	
					echo '<img src="'.$products['product_image'].'&width=260&height=160" alt=""/>';
					
					echo '	</a>
							<div class="caption">
							  <h5>'.$products['product_name'].'</h5>
							  <h4 style="text-align:center"><a class="btn btn-warning" href="'.base_url().'product/'.urlencode(addunderscores($products['product_name'])).'"> <i class="icon-zoom-in"></i></a> <a class="btn btn-success addtocart" href="'.base_url().'cart/addtocart/'.urlencode(addunderscores($products['product_id'])).'">Add to <i class="icon-shopping-cart"></i></a>  </h4>
						<div class = "price-dp">';
					if($products['discount_status'] == '1')			  
					{
						echo '
						<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "text-decoration:line-through;color : red;">Rs.'.number_format($products['product_price']).'/-</span>
							<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "">Rs.'.number_format($products['discount_price']).'/- </span>	
						';		  
					}
					else
					{
						echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">Rs.'.number_format($products['product_price']).'/-</span>';		  
					}
					echo '		</div>	
							</div>
						  </div>
						</li>
					';
				}	  	
			  ?>
			  </ul>	
			  <?php }?>
		</div>
<style>
	.thumbnails>li
	{
		min-height: 350px;
	}
</style>	
<script>
	$(document).ready(function(){setTimeout(function(){arrangeThumbnails()},1000)});
	function arrangeThumbnails()
	{return;
		var maxheight = 0;
		$(".thumbnails li").css("height","auto");
		$(".thumbnails li").each(function(){maxheight = Math.max($(this).height(),maxheight)});
		$(".thumbnails li").css("height",maxheight+"px")
	}
</script>