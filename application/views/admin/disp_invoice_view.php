<?php 
//	echo "<pre>";print_r($products);die;
	$theme_link =  base_url()."theme_back/";	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($title)?$title: COMPANYNAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Ibad Gore">
	<link href="<?php echo $theme_link; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<script src="<?php echo $theme_link; ?>js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo $theme_link; ?>js/jquery-ui-1.8.21.custom.min.js"></script>
	<style>
		body
		{
			color: #424341;
		}
		.detTab th
		{
			font-size:16px;				
		}
		.detTab tr
		{
			text-align: left;
		}
		.detTab strong
		{
			color: #000000;
		}
		.prod_tab
		{
			border-color: #dfdfdf;
		}
		.prod_tab th
		{
			font-size: 18px;
		}
		.prod_tab td
		{
			text-align: center;
		}
		.btn
		{
			font-size: 16px;
			padding: 5px;
		}
	</style>
</head>
<body>
	<div style="background-color: #b3b7b5;float:left;width: 100%">	
		<img style="float:left;" src = "<?php echo base_url(); ?>theme/themes/images/logo.png" />			
		<center style="padding-top: 20px; padding-right: 150px;">
			<strong style="text-align: center;">
				<u style="font-size: 24px;">
					Sales Invoice
				</u>
			</strong>
		</center>
	</div>
	<hr style = "width : 100%;" />
	<center>
		<table style="width: 90%;" class="detTab">
			<tr style="vertical-align: top;">
				<td>			
					<table style="text-align:left;">
						<tr>
							<th>
								Customer's Name 
							</th>
							<th>:</th>
							<td>
								<?php 
									if($cust["middlename"] == "")
									{
										$name = $cust["firstname"]." ".$cust["lastname"];
									}
									else
									{
										$name = $cust["firstname"]." ".$cust["middlename"]." ".$cust["lastname"];
									}
									echo $name;
								?>
							</td>
						</tr>
						<tr>
							<th>
								Shipping Address
							</th>
							<th>:</th>
							<td>
								<?php 
									echo $inv["shipping_address"];
								?>
							</td>
						</tr>
						<tr>
							<th>
								Shipping Area
							</th>
							<th>:</th>
							<td>
								<?php 
									echo $inv["shipping_area"];
								?>
							</td>
						</tr>
						<tr>
							<th>
								Shipping PIN
							</th>
							<th>:</th>
							<td>
								<?php 
									echo $inv["shipping_pin"];
								?>
							</td>
						</tr>
						<tr>
							<th>
								Mobile 
							</th>
							<th>:</th>
							<td>
								<?php 
									if($cust["mobile"] != "")
									{
										echo $cust["mobile"];
									}
									else
									{
										echo "N/A";
									}
								?>
							</td>
						</tr>
						<tr>
							<th>
								Phone 
							</th>
							<th>:</th>
							<td>
								<?php 
									if($cust["telephone"] != "")
									{
										echo $cust["telephone"];
									}
									else
									{
										echo "N/A";
									}
								?>
							</td>
						</tr>
					</table>
				</td>
				<td style="width : 50%">
					<table>
						<tr>
							<th>
								Invoice Number
							</th>
							<th>:</th>
							<td>
								<?php 
									echo $inv["order_id"];
								?>
							</td>
						</tr>
						<tr>
							<th>
								Delivery Date
							</th>
							<th>:</th>
							<td>
								<?php 
									echo date("d-m-Y",strtotime($inv["order_date"]));
								?>
							</td>
						</tr>
						<tr>
							<th>
								Delivery Time
							</th>
							<th>:</th>
							<td>
								<?php 
									echo date("H:m A",strtotime($inv["order_date"]));
								?>
							</td>
						</tr>
						<tr>
							<th>
								Delivered By
							</th>
							<th>:</th>
							<td>
								<?php 
									echo $inv["delivery_name"];
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</center>
	<center>
		<table class="prod_tab" style="width:90%;" border="1" cellpadding="5" cellspacing="0">
			<tr>
				<th>
					Sr. No.
				</th>
				<th>
					Product Name
				</th>
				<th>
					Price
				</th>			
				<th>
					Quantity
				</th>
				<th>
					Total
				</th>
				<th>
					Discount
				</th>
				<th>
					You Pay
				</th>
			</tr>
			<?php
				$totalpay = 0;
				$totaldiscount = 0;
				for($count = 0; $count < count($products); $count++)
				{
					$price = ($products[$count]["discount_status"] == 1) ? $products[$count]["discount_price"] : $products[$count]["product_price"];
					$discount = ($products[$count]["discount_status"] == 1) ? ($products[$count]["product_price"] - $price) : 0;
					$totaleach = floatval(floatval($price)*floatval($quantities[$count]));
					$totalpay += $totaleach;
					$totaldiscount += $discount;
					echo "
						<tr>
							<td>
								".($count + 1)."
							</td>
							<td>
								".$products[$count]["product_name"]."
							</td>
							<td>
								".$products[$count]["product_price"]."					
							</td>
							<td>
								".$quantities[$count]."					
							</td>
							<td>
								".$quantities[$count]*floatval($products[$count]["product_price"])."					
							</td>
							<td>
								".$discount*$quantities[$count]."			
							</td>
							<td>
								".$totaleach."
							</td>
						</tr>
					";
				}
				echo "
						<tr>
							<td colspan = '5' style = 'text-align : right'>
								<strong style= 'font-size:20px;'>
									Total Discount
								</strong>
							</td>
							<td colspan = '2'>
								<strong style= 'font-size:22px;'>".number_format($totaldiscount)."</strong>								
							</td>
						</tr>
						<tr>
							<td colspan = '5' style = 'text-align : right'>
								<strong style= 'font-size:20px;'>
									Total (Net Payable Amount)
								</strong>
							</td>
							<td colspan = '2'>
								<strong style= 'font-size:22px;'>".number_format($totalpay)."/-</strong>
							</td>
						</tr>					
					";				
			?>		
		</table>	
	</center>
	<br /><br /><br /><br />
	<center>
		<!--<button class="btn btn-success"></button>-->
		<button class="btn" onclick = "$('.btn').hide();window.print();$('.btn').show();">Print</button>
	</center>
</body>
</html>