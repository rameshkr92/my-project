<?php
//echo $url;
?>
<h4> Please enter your Email ID and click submit. </h4>	
<hr class="soft"/>
<form class="form-horizontal" id = "register_form" onsubmit = "validateuser(this,event)" action="<?php echo base_url()."home/password/"; ?>" method = "POST">
	<input type="hidden" name = "redirect" value = "<?php echo $url; ?>" />
 <div class="control-group">	
	<div class="controls">
	  	<input type="text" class = "input-xlarge" id="email" name = "email" value="" placeholder="Your Email Address">  
		&nbsp;&nbsp;
		<input class="btn btn-success" type="submit" value="Submit" />
	</div>
  </div>
</form>