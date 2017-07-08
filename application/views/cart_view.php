<?php
if(empty($cartData))
redirect(base_url(),"refresh");
?>

    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small><span class = "prodcnt"><?php echo count($cartData["productData"]); ?></span> Item(s) </small>]<a href="<?php echo base_url()."product"; ?>" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
<!--	<table class="table table-bordered">
		<tr>
			<th style="text-align: center;"> <span>I AM ALREADY REGISTERED  </span></th>
		</tr>	
		<tr>
			<td style="text-align: center;">
					<a href="#login" role="button" data-toggle="modal" class="btn">Sign in</a><br /> OR <br /><a href="<?php echo base_url(); ?>register" class="btn">Register Now!</a>
		  </td>
		</tr>
	</table>-->		
	<?php 
//		echo "<pre>";print_r($cartData);die;
	?>		
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Product Name</th>
				  <th>Rate</th>
                  <th>Discount Price</th>
                  <th>Quantity/Update</th>
                  <th>Total</th>
				</tr>
              </thead>
              <tbody>
			  	<?php
					foreach($cartData["productData"] as $products)
					{
						echo ' <tr prod = "'.$products["row_id"].'" style = "position:relative;">
				                  <td> <img width="60" src="'.$products['product_image'].'" alt=""/></td>
				                  <td>'.$products['product_name'].'</td>
								  <td class = "prod_price">'.$products['product_price'].'</td>
				                  <td  class = "disc_price">';
						echo ($products['discount_status'] == "1")? $products['discount_price'] : "&ndash;";					
						echo	  '</td>
				                  <td>
									<center>
									<div class="input-append"><input class="span1 prod_qty" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value = "'.$products['quantity'].'">
										<button class="btn minusqty" type="button"><i class="icon-minus"></i></button>
										<button class="btn plusqty" type="button"><i class="icon-plus"></i></button>
										<button class="btn btn-info savechg show-tooltip" title = "Save Changes"  data-rel="tooltip" type="button"><i class="icon-ok"></i></button>
										<button class="btn btn-danger remove_prod show-tooltip" title = "Remove Product"  data-rel="tooltip" type="button"  link = "'.base_url().'checkout/removeItem/'.$products['row_id'].'"><i class="icon-remove icon-white"></i></button>				</div>
										
									</center>
								  </td> ';
						
						echo	  '<td class = "prod_tot_price">'.$products['totalprice'].'</td>
				                </tr>';
					}
				?>
                <tr>
                  <td colspan="5" style="text-align:right">Total Price:	</td>
                  <td class = "tot_price"> <?php echo $cartData["totalprice"]; ?></td>
                </tr>
				 <tr>
                  <td colspan="5" style="text-align:right">Total Discount:	</td>
                  <td class = "tot_disc_price"> <?php echo $cartData["totaldiscount"]; ?></td>
                </tr>
				 <tr>
                  <td colspan="5" style="text-align:right"><strong>TOTAL (<span  class = "tot_price"><?php echo $cartData["totalprice"]; ?></span> - <span class = "tot_disc_price"><?php echo $cartData["totaldiscount"]; ?></span>) =</strong></td>
                  <td class="label label-important" style="display:block"> <strong  class = "gross_price" style="font-size: 20px;">  <?php echo $cartData["grossprice"]; ?></strong></td>
                </tr>
				</tbody>
            </table>
		
		
            <!--<table class="table table-bordered">
			<tbody>
				 <tr>
                  <td> 
				<form class="form-horizontal">
				<div class="control-group">
				<label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
				<div class="controls">
				<input type="text" class="input-medium" placeholder="CODE">
				<button type="submit" class="btn"> ADD </button>
				</div>
				</div>
				</form>
				</td>
                </tr>
				
			</tbody>
			</table>-->
			
			<!--<table class="table table-bordered">
			 <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
			 <tr> 
			 <td>
				<form class="form-horizontal">
				  <div class="control-group">
					<label class="control-label" for="inputCountry">Country </label>
					<div class="controls">
					  <input type="text" id="inputCountry" placeholder="Country">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label" for="inputPost">Post Code/ Zipcode </label>
					<div class="controls">
					  <input type="text" id="inputPost" placeholder="Postcode">
					</div>
				  </div>
				  <div class="control-group">
					<div class="controls">
					  <button type="submit" class="btn">ESTIMATE </button>
					</div>
				  </div>
				</form>				  
			  </td>
			  </tr>-->
            </table>		
	<a href="<?php echo base_url()."product"; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="<?php echo base_url()."order"; ?>" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	<div id = "product-save">
		<center>
			<div id = "prod-save-text">
				<img src = "<?php echo base_url().'images/preloader.gif'; ?>" />
				<span>Please wait, while we save your changes.</span>
			</div>
		</center>
	</div>
	<style>
	.table.table-bordered * 
	{
		text-align: center;
	}
		#product-save
		{
			position : fixed;
			top : 0px;
			left : 0px;
			width : 100%;
			height : 100%;
			background-color : rgba(121, 121, 121, 0.53);			
			display: none;
			z-index: 100000;
			padding : 15px;
		}
		#prod-save-text
		{
			background-color : white;
			font-weight: bold;
			font-size:14px;	
			width : 30%;
			padding: 20px;
			border-radius: 15px;
			-webkit-box-shadow:0px 2px 18px rgba(70, 73, 87, 1);
			-moz-box-shadow:0px 2px 18px rgba(70, 73, 87, 1);
			box-shadow:0px 2px 18px rgba(70, 73, 87, 1);			
		}
	</style>
<script>
	var g_trParent="";var g_rem_tr
	$(document).ready
	(
		function()
		{
			$(".remove_prod").live
			(
				"click",
				function()
				{
					var rem_link = $(this).attr("link");
					g_rem_tr = $(this).closest("tr");
					$("#product-save").show();
					$.ajax
					(
						{
							url : rem_link,
							success:function(data)
							{
								try
								{
									var response = JSON.parse(data);
								}
								catch(e)
								{
									window.location.href = window.location.href;
								}
								if(response.status == "success")
								{
									if(response.productData.length == 0)
									{
										window.location.href = base_url();
									}
									g_rem_tr.remove();
									$(".tot_price").html(response.totalprice);
									$(".tot_disc_price").html(response.totaldiscount);
									$(".gross_price").html(response.grossprice);
									$(".prodcnt").html(response.productData.length);
									$("#product-save").hide();									
								}								
							}
						}
					);
				}
			);
			// 
			$(".minusqty,.plusqty,.prod_qty").live
			(
				"click keyup",
				function()
				{
					var oParent = $(this).closest("tr");
					var qty = oParent.find(".prod_qty").val();
					if($(this).hasClass("minusqty"))
					{
						qty--;
					}
					if($(this).hasClass("plusqty"))
					{
						qty++;
					}
					if(isNaN(qty) || qty <= 0 )qty = 1;
					oParent.find(".prod_qty").val(qty);					
				}
			);
			$(".savechg").live
			(
				"click",
				function()
				{
					g_trParent = $(this).closest("tr");	
					$("#product-save").show();
					var qty = g_trParent.find(".prod_qty").val();
					if(isNaN(qty))qty = 1;
					var update_url = base_url()+"cart/updateQuantity/"+g_trParent.attr("prod")+"/"+qty+"/1";
					$.ajax
					(
						{
							url : update_url,
							success : function(data)
							{
								try
								{
									var response = JSON.parse(data);
								}
								catch(e)
								{
									window.location.href = window.location.href;
								}
								var row = g_trParent.attr("prod");
								for (i in response.productData)
								{
									if(row == response.productData[i].row_id)
									{
										g_trParent.find(".product_price").html(response.productData[i].product_price);
										if(response.productData[i].discount_status == "1")
										{
											g_trParent.find(".disc_price").html(response.productData[i].discount_price);
										}
										else
										{
											g_trParent.find(".disc_price").html("&ndash;");
										}										
										g_trParent.find(".prod_tot_price").html(response.productData[i].totalprice);
									}
								}
								$(".tot_price").html(response.totalprice);
								$(".tot_disc_price").html(response.totaldiscount);
								$(".gross_price").html(response.grossprice);
								$("#product-save").hide();
							}
						}
					);
				}	
			);
		}
	);
</script>