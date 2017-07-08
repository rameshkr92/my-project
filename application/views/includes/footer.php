<?php
	$theme_url = base_url()."theme/";
?>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<?php 
					$querystring = "";
					if(isset($_SERVER["QUERY_STRING"]))$querystring = $_SERVER["QUERY_STRING"];
				 	if($obj->isloggedin)
					{
				?>
				<a href="<?php echo base_url().'register/useredit/'.$obj->userData["id"]; ?>">YOUR ACCOUNT</a>
				<a href="<?php echo base_url().'order/orderhistory'; ?>">ORDER HISTORY</a>
				<?php 
					}
					else
					{
						?>
						<a href="#login" role="button" data-toggle="modal" >LOGIN</a>				 
						<a href="<?php echo base_url().'register'; ?>">REGISTER</a>  						
						<?php 
					}
				?>				
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="<?php echo base_url(); ?>contactus">CONTACT</a>  
				<a href="<?php echo base_url(); ?>register">REGISTRATION</a>  
				<a href="<?php echo base_url(); ?>aboutus">ABOUT US</a>  
				<a href="<?php echo base_url(); ?>tac">TERMS AND CONDITIONS</a> 
				<a href="<?php echo base_url(); ?>faq">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<a href="<?php echo base_url()."product/viewLatestProducts"; ?>">NEW PRODUCTS</a> 
				<a href="<?php echo base_url()."product/viewFeaturedProducts"; ?>">FEATURED PRODUCTS</a>  
				<a href="<?php echo base_url()."product/viewDiscountProducts"; ?>">SPECIAL OFFERS</a>
			 </div>
			 <?php if($this->areas){ ?>
			<div class="span12">
				<h5 id = "areas_covered_bar" style = "cursor:pointer">AREAS COVERED BY US</h5>
				<div id = "areas_covered">
				<?php 
					$arrAreas = array();
					$i = 0;
					foreach($this->areas as $area)
					{						
						if(!(isset($arrAreas[$i])))$arrAreas[$i] = "";
						$arrAreas[$i] .= "<a href='#'>".$area["area_name"]."</a>";
						$i++;
						if($i == 5)$i = 0;
					}										
					for($i = 0; $i<5; $i++)
					{
						echo "<div class = 'span2'  >".strtoupper($arrAreas[$i])."</div>";
					}					
				?>	
				</div>
			 </div> 
			 <?php } ?>
			 
			<!--<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="<?php echo $theme_url; ?>#"><img width="60" height="60" src="<?php echo $theme_url; ?>themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="<?php echo $theme_url; ?>#"><img width="60" height="60" src="<?php echo $theme_url; ?>themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="<?php echo $theme_url; ?>#"><img width="60" height="60" src="<?php echo $theme_url; ?>themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>--> 
		<p class="pull-left span12"  style="margin-left:0px!important;">
			<h5>	
				Site Designed and Developed By : <br />
				
					<a style="text-decoration: none!important;" href="http://www.mywebadmin.in/"><img alt="My Web Admin.In" src="http://www.mywebadmin.in/images/mywebadminlogo.png" style="height: 40px;"></a>
				
			</h5>
			Mobile&nbsp;:&nbsp;(+91)8975330266 &nbsp; 
			Email&nbsp;:&nbsp;<a href ="mailto:contact@mywebadmin.in" style="display: initial;">contact@mywebadmin.in</a>			
		</p>		
		<center><p style="clear:both;">&copy; <?php echo COMPANYNAME; ?></p></center>
		
	</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->	
	<script src="<?php echo $theme_url; ?>themes/js/bootstrap.min.js?allowall=allow" type="text/javascript"></script>
	<script src="<?php echo $theme_url; ?>themes/js/google-code-prettify/prettify.js?allowall=allow"></script>
		<!-- autocomplete library -->
	<script src="<?php echo base_url()."theme_back/"; ?>js/bootstrap-typeahead.js?allowall=allow"></script>
	
	<script src="<?php echo $theme_url; ?>themes/js/bootshop.js?allowall=allow"></script>
    <script src="<?php echo $theme_url; ?>themes/js/jquery.lightbox-0.5.js?allowall=allow"></script>
	<script src="<?php echo base_url(); ?>/js/myscripts.js?allowall=allow"></script>
</div>
<div style="position : fixed;bottom : 50px;right : 50px;display: none;" id = "gototop">
	<span class = "btn btn-alert"><i class = "icon-arrow-up"></i> Go To Top</span>
</div>
<style>
	@media (max-width: 600px) {
		#show-cart-dropdown
		{display:none !important;}
	}
	
</style>
<!--<span id="themesBtn"></span>-->
</body>
</html>
