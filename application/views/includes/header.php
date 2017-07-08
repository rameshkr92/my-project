<?php
	$theme_url = base_url()."theme/";
	//echo "<pre>";print_r($this->cart->contents());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<?php 
		if(!isset($title))
		{
			$title = COMPANYNAME;
		}
		echo '<title>'.$title.'</title>';		
		
	?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="author" content="Ibad Gore">
	<meta name="description" content="<?php echo $title; ?>" />
	<meta name="keywords" content="plumsberry,plums, kirana, grocery, <?php echo $title; ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="<?php echo $theme_url; ?>themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="<?php echo $theme_url; ?>themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="<?php echo $theme_url; ?>themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="<?php echo $theme_url; ?>themes/less/bootshop.less">
	<script src="<?php echo $theme_url; ?>themes/js/less.js?allowall=allow" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="<?php echo $theme_url; ?>themes/bootshop/bootstrap.min.css?allowall=allow" media="screen"/>
    <link href="<?php echo $theme_url; ?>themes/css/base.css?allowall=allow" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="<?php echo $theme_url; ?>themes/css/bootstrap-responsive.min.css?allowall=allow" rel="stylesheet"/>
	<link href="<?php echo $theme_url; ?>themes/css/font-awesome.css?allowall=allow" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="<?php echo $theme_url; ?>themes/js/google-code-prettify/prettify.css?allowall=allow" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url()."images/favicon.png"; ?>">
	<!--
	<link href="<?php echo base_url(); ?>theme_back/css/opa-icons.css?allowall=allow" rel="stylesheet">-->
	<style type="text/css" id="enject"></style>
	<script src="<?php echo $theme_url; ?>themes/js/jquery.js?allowall=allow" type="text/javascript"></script>
	<link href="<?php echo base_url(); ?>css/mystyles.css?allowall=allow" rel="stylesheet" type="text/css">
	<script>
		var base_url = "<?php echo base_url(); ?>";
	</script> 

<script>
function base_url()
{
	return "<?php echo base_url(); ?>";
}
$(document).ready(function()
	{ 
		<?php
			$alert = $this->session->flashdata("alert"); 						
			if(!empty($alert))
			{	
				$alert = (array)json_decode($alert);				
				echo 'displayalert'.$alert["type"].'("'.$alert["msg"].'");';
			}
			?>					
		
		$("#areas_covered_bar").bind("click",function() 
		{
			if($("#areas_covered").is(":visible"))
			{
				$("#areas_covered").hide("slow");
			}
			else
			{
				$("#areas_covered").show("slow");
			}			
		})
		$("#areas_covered").hide("slow");
	});

var g_product_names = new Array();
<?php 
	echo "g_product_names = '".addslashes(json_encode($obj->productsList))."';g_product_names = JSON.parse(g_product_names);";
?>
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js?allowall=allow','ga');

  ga('create', 'UA-54128745-1', 'auto');
  ga('send', 'pageview');

</script>

  </head>
<body>
<div id="header">
<div class="container-fluid"> 
<div id="welcomeLine" class="row">
	<?php 
		if($obj->isloggedin)
		{
			echo '<div class="span6">Welcome <strong><a class="show-top-tooltip" title="Click to Edit" data-rel="tooltip"  href = "'.base_url().'register/useredit/'.$obj->userData["id"].'">'.$obj->userData["firstname"].' '.$obj->userData["lastname"].'</a></strong></div>';
			echo '<div class="span6">';
		}
		else 
		{
			echo '<div class="span12">';				
		}
	?>	
	
	<div class="pull-right">
		<!--<a href="<?php echo $theme_url; ?>product_summary.html"><span class="">Fr</span></a>
		<a href="<?php echo $theme_url; ?>product_summary.html"><span class="">Es</span></a>
		<span class="btn btn-mini">En</span>
		<a href="<?php echo $theme_url; ?>product_summary.html"><span>&pound;</span></a>
		<span class="btn btn-mini">$155.00</span>
		<a href="<?php echo $theme_url; ?>product_summary.html"><span class="">$</span></a>-->
		<?php 
			if(!$obj->hidecartlist)
			{
		?>		
		<div class="pull-right btn-group span12" id = "bt-it">
		<a href="#" id = "showcartbtn" class="pull-right btn btn-mini btn-primary dropdown-toggle" style="position: relative;" data-toggle="dropdown"><span><i class="icon-shopping-cart icon-white"></i> [ <span class = "item-cart-count"><?php echo $obj->carttotalitems; ?></span> ] Item(s) in your cart </span> </a>		 
		  <ul class="dropdown-menu span6" id = "show-cart-dropdown" style="position: absolute;right:-20px; background-color: #ffffff;border: 2px solid #005580;padding: 1px;">
		  	<li>
				<center>
					<div style="width : 95%;white-space: normal;color: #005580;font-weight: bolder;font-size: 14px;padding-top: 10px;">
						<span>Below is the list of products in your cart. You can increase the quantity and delete products during checkout.</span>
					</div>
				</center>
			</li>
			<li>
				<center style="padding : 10px;"><div style="width : 95%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center>
			</li>
			<li id = "productList-cart">
				<center>
					<table class = "cart-table" border = "0">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th></th>
								<th>Product Name</th>
								<th>Qty</th>
								<th>Discount</th>
								<th>Price</th>
							</tr>
							<tr><th colspan="100"><center><div style="width : 100%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center></th></tr>
						</thead>
						<tbody></tbody>
					</table>
				</center>				
			</li>
			<li>
				<center style="padding : 10px;"><div style="width : 95%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center>
			</li>
		  	<li>
				<div id = "cartloader">
					<center>
						<img src = "<?php echo  base_url()."images/preloader.gif"; ?>" />
					</center>
				</div>
			</li>			
			<li id = "cart-info">
				<center>					
					<table cellspacing="0" cellpadding="0">
					</table>
				</center>
			</li>
			<li>
				<center style="padding : 10px;"><div style="width : 95%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center>
			</li>
			<li>
				<center>
					<span class = "btn btn-info" style="margin-right: 20px;" onclick='flushCart();'>Flush Cart</span>
					<a href="<?php echo base_url()."checkout"; ?>">						
						<span class = "btn btn-info">Check Out and Pay</span>
					</a>
				</center>
			</li>
			<li style="padding:10px;"></li>			
		    <!-- dropdown menu links -->
		  </ul>
</div>
	<?php
		}	
	?> 
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."images/logo.png"; ?>" alt="Bootsshop"/></a>
		<form class="form-inline navbar-search" method="get" action="<?php echo base_url()."product/SearchResults"; ?>" >
		<input id="srchFld" name = "product_search" placeholder="Type Product Name" class="srchTxt" type="text" autocomplete="off" />
		  <select class="srchTxt" name = "brands_search">
			<option value = "All">Select Brands</option>
			<?php 
				foreach($obj->brandsList as $brands)
				{
					echo "<option value = '".$brands['brand_id']."'>".$brands['brand_name']."</option>";
				}
			?>
		</select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form><!--
	<div class="span3">
		<span style="font-size: 15px; color : #006dcc; line-height: 28px; ">
			<center>
				Call Us : <br /> <b style="font-size: 25px; font-family: Tahoma, Geneva, sans-serif;">927-22-00-333 </b>
			</center>
		</span>
	</div>-->
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="<?php echo base_url(); ?>product/viewLatestProducts">New Products</a></li>
	 <li class=""><a href="<?php echo base_url(); ?>product/viewFeaturedProducts">Featured Products</a></li>
	 <li class=""><a href="<?php echo base_url()."product/viewDiscountProducts"; ?>">Specials Offer</a></li>
	 <li class=""><a href="<?php echo base_url(); ?>contactus">Contact</a></li>
	 <li class="">
	 <?php 
	 	$querystring = "";
		if(isset($_SERVER["QUERY_STRING"]))$querystring = $_SERVER["QUERY_STRING"];
	 	if($obj->isloggedin)
		{
			?>
				<a href="<?php echo base_url()."home/logout?redirectlink=".urlencode(current_url()."?".$querystring); ?>" role="button" style="padding-right:0"><input type = "submit" class="btn btn-large btn-danger" value = "Logout"/></a>
		</li>
			<?php
		}
		else{
	 ?>	 
	 <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
	<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Login</h3>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm" method = "POST" action = "<?php echo base_url()."home/login"; ?>" >
			  <div class="control-group">								
				<input type="text" id="inputEmail" name = "username" placeholder="Username or Email">
			  </div>
			  <div class="control-group">
				<input type="password" id="inputPassword" name = "password" placeholder="Password">
			  </div>
			  <input type = "hidden" name = "redirectlink" value="<?php echo urlencode(current_url()."?".$querystring); ?>"/>
			  <div class="control-group">
				<label class="checkbox">
				<input type="checkbox" name = "rememberme"><span> Remember me </span><br />
				<a href="<?php echo base_url()."home/forgotpassword?redirectlink=".urlencode(current_url()."?".$querystring); ?>">Forgot Password</a>
				</label>
			  </div>	
			<input type="submit" class="btn btn-success" value="Sign in" />
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>			
			</form>	
		  </div>
	</div>
	</li>
	<li id = "registerBtn">	
		<a href="<?php echo base_url().'register'; ?>" role="button" style="padding-right:0"><span class="btn btn-warning"><i class = "icon-share"></i>Register here</span></a>
	</li>
	<?php
	}
	?>
    </ul>
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->
<?php 
	if(TRUE)
	{
?>
<div id="mainBody">
	<div class="container">
		<div class="row">
<?php
	}
?>	
	 <div class = "span12" id = "disp-alert">
	 </div>