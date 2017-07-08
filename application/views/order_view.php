<link href="<?php echo base_url()."theme_back/"; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
<script src="<?php echo base_url()."theme_back/"; ?>js/jquery-ui-1.8.21.custom.min.js"></script>
<ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Place Order</li>
    </ul>
	<?php 
	if(!$obj->isloggedin)
	{
		$querystring = "";
		if(isset($_SERVER["QUERY_STRING"]))$querystring = $_SERVER["QUERY_STRING"];
	?>
	<h3> Login</h3>	
	<hr class="soft"/>
	
	<div class="row">
		<div class="span9">
			<h4>
				We would really appreciate if you Login / Register your account and place your Order.
			</h4>
		</div>
		<br />		
		<div class="span4">
			<div class="well">
			<h5>CREATE YOUR ACCOUNT</h5><br/>
			 <a href = "<?php echo base_url()."register?redirect=".urlencode(current_url()."?".$querystring); ?>" class="btn block">Create Your Account</a>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
				<h5>IF ALREADY REGISTERED ?</h5><br/>
				<a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn">Login</span></a>
			  </div>
			</form>
		</div>
		</div>
	<?php } 
			else
			{				
			//	echo "<pre>";print_r($cartData);//grossprice
		//	echo "<pre>";print_r($userdata);
		//	echo "</pre>";
		$formData = $userdata;
	 	if(isset($formData))
		{
			$formData = array
			(
				"shippingaddress"=>(set_value('shippingaddress')) ? set_value('shippingaddress') : $formData["shippingaddress"],
				"shipping_area"=>(set_value('shipping_area')) ? set_value('shipping_area') : $formData["shipping_area"],
				"shipping_PIN"=>(set_value('shipping_PIN')) ? set_value('shipping_PIN') : $formData["shipping_PIN"],				
			);					
		}
	?>	
	<script src="<?php echo base_url()."theme_back/"; ?>js/jquery.autogrow-textarea.js"></script>			
		<span class = "top-conf">
			Please confirm your details.					
			<br /><br />
		</span>
		<form class="form-horizontal span5" action = "<?php echo base_url()."order/placeOrder" ?>" method = "POST" onsubmit = "validateuser(this,event)">
			<?php
				echo '<input type="hidden" name="customer_id" value="'.$userdata['id'].'">';
			?>
			<div class="control-group">
				<label class="control-label" for="shippingaddress">Shipping Address<sup class = "compulsory">*</sup></label>
				<div class="controls">
				  <textarea name="shippingaddress" id="shippingaddress" class = "input-large autogrow" placeholder="Enter Your Address"><?php echo $formData["shippingaddress"]; ?></textarea>
				  <br />
				  <span class = "errormsg"><?php echo form_error('shippingaddress'); ?></span>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="shipping_area">Shipping Area <sup class = "compulsory">*</sup></label>
				<div class="controls">
				  <select name = "shipping_area" id = "shipping_area" onchange="$('#shipping_PIN').val($(this).find('option:selected').attr('data'));">
				  		<option value = "">Select Area</option>
						<?php 						
							foreach($areas as $area)
							{
								if($formData["shipping_area"] == $area["area_name"])
								{
									echo '<option data = "'.$area["area_pin"].'" value = "'.$area["area_name"].'" selected>'.$area["area_name"].'</option>';
								}
								else
								echo '<option data = "'.$area["area_pin"].'" value = "'.$area["area_name"].'">'.$area["area_name"].'</option>';							
							}
						?>
				  </select>
				  <br />
				  <span class = "errormsg"><?php echo form_error('shipping_area'); ?></span>
				</div>
			</div>		
			<div class="control-group">
				<label class="control-label" for="shipping_PIN">Shipping Zip / Postal Code <sup class="compulsory">*</sup></label>
				<div class="controls">
				  <input type="text" id="shipping_PIN" name = "shipping_PIN" value="<?php echo $formData["shipping_PIN"]; ?>" placeholder="Zip / Postal Code"/> <br />
				  <span class = "errormsg"><?php echo form_error('shipping_PIN'); ?></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="shipping_PIN">Recieving Time <sup class="compulsory">*</sup></label>
				<div class="controls">
				  <select name = "recieving_time">
				  	<option value = "10">10 AM</option>
					<option value = "11">11 AM</option>
					<option value = "12">12 PM</option>
					<option value = "1">1 PM</option>
					<option value = "2">2 PM</option>
					<option value = "3">3 PM</option>
					<option value = "4">4 PM</option>
					<option value = "5">5 PM</option>
					<option value = "6">6 PM</option>
					<option value = "7">7 PM</option>
					<option value = "8">8 PM</option>
					<option value = "9">9 PM</option>					
				  </select>				  
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="recieving_date">Recieving Date<sup class="compulsory">*</sup></label>
				<div class="controls">
				  <input type="text" id="recieving_date" class = "datepickerele" name = "recieving_date" value="<?php echo date("d/m/Y"); ?>" placeholder="Recieving Date"/> <br />
				  <span class = "errormsg"><?php echo form_error('recieving_date'); ?></span>
				</div>
			</div>
			<center>
				<input type = "submit" class = "btn btn-large btn-success" value = "Place Order"/>			
			</center>
		</form>
		<div class="well span3">
		<h5>Personal Details</h5>
		<table class="table table-bordered span3" style="margin-left: 0px;">
			<tbody>
				<tr>
					<th>Name</th>
					<td><?php echo "<span>".$userdata["firstname"]." ".$userdata["lastname"]."</span>"; ?></td>
				</tr>
				<tr>
					<th>Gender</th>
					<td><?php echo "<span>".$userdata["gender"]."</span>"; ?></td>
				</tr>
				<tr>
					<th>Date Of Birth</th>
					<td><?php echo "<span>".date("D, d-M-Y",strtotime($userdata["dob"]))."</span>"; ?></td>
				</tr>
				<tr>
					<th>Mobile Number</th>
					<td><?php echo "<span>".$userdata["mobile"]."</span>"; ?></td>
				</tr>
				<tr>
					<th>Address</th>
					<td><?php echo "<span>".$userdata["address"]."</span>"; ?></td>
				</tr>										
			</tbody>
		</table>
		</div>	
		<hr class="soft" style="clear: both;"/>			
		<script>
			$(document).ready
			(
				function()
				{
					displayalertinfo("<strong style = 'font-size : 20px;'>Currently, We support offline orders only.</strong>");
					$('textarea.autogrow').autogrow();
					$(".datepickerele").datepicker({ dateFormat: "dd/mm/yy" });
				}
			);
			
			function validateuser(oForm,event)
			{
				oForm = $(oForm);
				$(".compulsory").closest(".control-group").find("input:text,input:checkbox,checkbox,textarea,select").each
				(
					function()
					{			
						if($(this).val() == "")
						{
							displayError(this,$(this).closest(".control-group").find("label").text().replace("*","")+" is compulsory.")				
							event.preventDefault();
							displayalertblock("Fields marked <strong>*</strong> are compulsory.");
						}
						else
						{
							displaySuccess(this);
						}
					}
				);
			}
			function displayError(oEle, msg)
			{	
				oEle = $(oEle);
				oEle.closest(".control-group")
							.removeClass("success")
							.addClass("error")
							.find(".errormsg")
											.show()
											.html(msg);
			}
			function displaySuccess(oEle)
			{
				oEle = $(oEle);
				oEle.closest(".control-group")
							.addClass("success")
							.find(".errormsg")
											.hide()
											.html("");
			}
		</script>
		<style>
			.control-label
			{
				font-weight: bold;
				font-size: 15px;
			}
			.compulsory
			{
				color : red;
			}
			.errormsg
			{
				color : red;
			}
			.top-conf
			{
				font-size: 15px;
				color :#5f665e;
				font-weight: bold;
			}
			.bot-conf
			{
				
			}
		</style>
		
	<?php 
		}
	?>
	