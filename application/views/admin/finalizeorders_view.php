<?php

//echo "<pre>";print_r($orderData);die;
//echo "<pre>";print_r($vendors);die;
?>
<form id = "final_order" action = "<?php echo base_url()."admin/sales/finalizedOrder" ?>" method="POST" >
<input type="hidden" name = "orderid" value = "<?php echo $orderData["order_id"]; ?>" />
<input type="hidden" name = "custid" value = "<?php echo $orderData["customer_id"]; ?>" />
<table class="table table-bordered">
	<tbody>
		<tr>
			<th>
				Customer Name 
			</th>
			<td>
				<input type = "text"  disabled = "disabled" value = "<?php echo $orderData["firstname"]." ".$orderData["lastname"]; ?>" /> 
			</td>
		</tr>
		<tr>	
			<th>
				Order Date
			</th>
			<td>
				<input type = "text" disabled = "disabled" name = "order_date" value = "<?php echo $orderData["order_date_time"]; ?>" />
			</td>
		</tr>
		<tr>
			<th>
				Shipping Address
			</th>
			<td>
				<textarea name = "shippingaddress" id = "shippingaddress" style="width : 60%; height : 80px;">
					<?php echo $orderData["shippingaddress"]; ?>
				</textarea>
			</td>
		</tr>
		<tr>
			<th>
				Shipping Area
			</th>
			<td>
				<select name = "area" onchange = "$(this).find('option').each(function(){if($(this).is(':selected'))$('#shppin').val($(this).attr('pin'))})">
					<?php 
						if($areas)
						{
							foreach($areas as $area)
							{
								if($area["area_name"] == $orderData["shipping_area"])
								echo "<option selected value = '".$area["area_name"]."' pin = '".$area["area_pin"]."'>".$area["area_name"]."</option>";
								echo "<option value = '".$area["area_name"]."' pin = '".$area["area_pin"]."'>".$area["area_name"]."</option>";
							}							
						}
						
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				Shipping PIN
			</th>
			<td>
				<input type="text" name = "shippingpin"  disabled = "disabled" id = "shppin" value = "" />
			</td>
		</tr>
		<tr>
			<th>
				Orders
				<br /><br /><br /><br />
				<center>
					<a href="#" onclick="$('#addproductmodal').modal('show');return false;" class="btn btn-info btn-setting">Add Product</a>
				</center>
			</th>
			<td>
				<table class="table table-bordered">
					<tbody>
						<tr class = 'prod_head'>
							<th>
								Product Name
							</th>
							<th>
								Price
							</th>
							<th>
								Quantity/Remove Product
							</th>
							<th>
								Total
							</th>
						</tr>
						<?php 
							$total = 0;
							foreach($orderData["cart_data"] as $order)
							{
								echo "
								<tr>
									<input type = 'hidden' name = 'prod_id[]' value = '".$order['id']."' />
									<td>".$order["name"]."</td>
									<td class = 'pri'>".$order["price"]."</td>
									<td>";
								echo '
										<div class="input-append">
											<input class="span1 prod_qty" name= "quantity[]" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value="'.$order["qty"].'">
											<button class="btn minusqty" type="button"><i class="icon-minus"></i></button>
											<button class="btn plusqty" type="button"><i class="icon-plus"></i></button>
											<button class="btn btn-danger remove_prod show-tooltip" data-rel="tooltip" type="button"  data-original-title="Remove Product" onclick = "removeProduct(this)" ><i class="icon-remove icon-white"></i></button>				
										</div>
										';	
								echo "
									
										<!--
										<input class = 'input-small qty' style='width: 25px;margin: 0;' type = 'text' value = '".$order["qty"]."' />
										<span class = 'btn btn-success'><i class='icon-plus'></i></span>
										<span class = 'btn btn-danger'><i class='icon-minus'></i></span>
										-->
									</td>
									<td class = 'total'>".$order["subtotal"]."</td>									
								</tr>
								";
								$total += $order["subtotal"];	
							}
							echo "
								<tr>
									<td colspan = '3' style = 'font-weight : bold; font-size : 20px;'> Total </td>
									<td class = 'sumtotal' colspan = '2' style = 'font-weight : bold; font-size : 20px;'>".$total."</td>
								</tr>
							";
						?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<th>
				Delivered By
			</th>			
			<td>
				<select name = "delvby" id = "delvby">
					<option value = "">Select Delivery Boy</option>
					<?php 
						if($deliveryusers)
						{
							foreach($deliveryusers as $users)
							{
								echo "<option value = '".$users["admin_id"]."'>".$users["admin_name"]."</option>";
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				Vendors
			</th>			
			<td>
				<select name = "vendors[]" id = "vendors" multiple="multiple">					
					<?php 
						if($vendors)
						{
							foreach($vendors as $vendor)
							{
								echo "<option value = '".$vendor["vendor_id"]."'>".$vendor["vendor_name"]."</option>";
							}
						}
					?>
				</select>
				<p class="help-block">Press Ctrl to select multiple</p>
			</td>
		</tr>
	</tbody>
</table>
</form>
<center>
	<span class = 'btn btn-large btn-success' onclick = "submitOrder()" >Finalize Order</span>
	<br /><br /><br />
	<span class = 'btn btn-danger' onclick = "if(confirm('Are you sure you want to close this window? All your changes will be lost.'))window.close();">Close Window</span>
</center>

<div class="modal hide fade in" id="addproductmodal" style="display: none;">
	<!--<form action = "" method = "POST" class="form-horizontal" onsubmit="">-->	
		<input type="hidden" name="brands_count" value="" class="brands_count">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Add Product</h3>
			</div>
			<div class="modal-body form-horizontal">
				<div class="control-group">
							  <label class="control-label" for="typeahead">Product Name </label>
							  <div class="controls">
								<input type="text" class="typeahead input-large" id="product_name"  autocomplete="off" placeholder="Type Product Name" >
								<span class="btn btn-info" onclick = "viewprdDet()" >View Details</span>
							  </div>							  
				</div>								
				<div class="control-group">
					 <label class="control-label" for="typeahead">Quantity </label>
					  <div class="controls">
						<input type="text" class="input-small" style="width:20px;" id="quantity"  autocomplete="off" value = "1" >
					  </div>
				</div>
				<div class="control-group">
					<table class="table table-bordered" id = "prdfnd" style="display: none;">
						<tbody>
							<tr>
								<td colspan="2"><center><img id = "prdimg" src = "" /></center></td>
							</tr>
							<tr>								
								<th>
									Product Name
								</th>
								<td id = "prdnam">								
								</td>								
							</tr>
							<tr>
								<th>
									Product Price
								</th>
								<td id = "prdpri">								
								</td>
							</tr>
							<tr>
								<th>
									Discount Price
								</th>
								<td id = "discpri">								
								</td>
							</tr>
						</tbody>
					</table>
					<span id = "prdnfnd" style="color : red; text-align: center;display: none;">Product Not Found.</span>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<input type="button" id = "addtolist" value="Add to List" class="btn btn-primary">
			</div>
	</form>
</div>

<script>
	window.onclose = function(e)
	{
		alert("All your changes will be lost");
	}
	var g_products = new Array();
	var g_product_names = new Array();
	<?php 
		echo "g_products = '".addslashes(json_encode($product_list))."';g_products = JSON.parse(g_products);";
	?>	
	$(document).ready(function()
	{
		$("select").trigger("change");
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
					oParent.find(".total").html(parseInt(qty) * parseFloat(oParent.find('.pri').html()));
					calcTotal();
				}
			);
			for(i=0; i<g_products.length; i++)
			{
				g_product_names[i] = g_products[i].product_name;
			}
			$("#product_name").typeahead({source:g_product_names});	
			$("#addtolist").live("click",function(){additemtolist();})
					
	})
	
	function additemtolist()
	{
		var product_name = $("#product_name").val();
		var quantity = $("#quantity").val();
		if(product_name == "")
		{
			alert("Please enter Product Name");
			$("#product_name").focus();
			return false;
		}
		if(isNaN(quantity) || quantity < 1)
		{
			alert("Please enter correct Quantity");
			$("#quantity").val("1");
			$("#quantity").focus();
			return false;
		}
		var found = false;		
		for(i=0; i<g_products.length; i++)
		{
			if(g_products[i].product_name == product_name)
			{
				found = true;
				var price = (g_products[i].discount_status == "1") ? g_products[i].discount_price : g_products[i].product_price;
				var strHtml = '<tr>'
   							+'		<input type="hidden" name="prod_id[]" value="'+g_products[i].product_id+'">'
							+'		<td>'+g_products[i].product_name+'</td>'
							+'		<td class="pri">'+price+'</td>'
							+'		<td>'
							+'			<div class="input-append">'
							+'				<input class="span1 prod_qty" name = quantity[] style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value="'+quantity+'">'
							+'				<button class="btn minusqty" type="button"><i class="icon-minus"></i></button>'
							+'				<button class="btn plusqty" type="button"><i class="icon-plus"></i></button>'
							+'				<button class="btn btn-danger remove_prod show-tooltip" data-rel="tooltip" type="button" data-original-title="Remove Product" onclick="removeProduct(this)"><i class="icon-remove icon-white"></i></button>'
							+'			</div>'
							+'		</td>'
							+'		<td class="total">'+(quantity*parseFloat(price))+'</td>'
							+'	</tr>';
				$(".prod_head").after(strHtml);
				$("#addproductmodal").modal("hide");
				calcTotal();				
			}
		}
		if(found == false)
		{
			alert("Product Not Found");
			$("#product_name").val("");
			$("#product_name").focus();
			return false;
		}
	}
	
	
	function viewprdDet()
	{
	//	debugger;
		$("#prdnfnd").hide();
		$("#prdfnd").hide();		
		var name = $("#product_name").val();
		var fnd = false;
		for(i=0; i< g_products.length;i++)
		{
			if(g_products[i].product_name == name)
			{
				fnd = true;
				$("#prdfnd").show();				
				$("#prdimg").attr("src",g_products[i].product_image);
				$("#prdnam").html(g_products[i].product_name);
				$("#prdpri").html(g_products[i].product_price);
				if(g_products[i].discount_status == "1")
				{
					$("#discpri").html(g_products[i].discount_price);
				}
				else
				{
					$("#discpri").html("N/A");
				}
			}
		}
		if(fnd == false)
		{
			$("#prdnfnd").show();
		}
	}
	
	function submitOrder()
	{
		if($("#delvby").val() == "" || $("#shippingaddress").val() == "")
		{
			return false;
		}
		else
		{
			$("input").removeAttr("disabled");
			$("#final_order").submit();
		}				
	}
	
	function calcTotal()
	{
		var sum = 0;
		$(".total").each(function(){sum += parseInt($(this).html())});
		$(".sumtotal").html(sum);
	}
	
	function removeProduct(oDiv)
	{
		$(".tooltip").remove();
		$(oDiv).closest("tr").remove();
		calcTotal();
	}
</script>