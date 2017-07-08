<?php
	$editurl = base_url()."admin/product/editedproduct";		
	$createurl = base_url()."admin/product/createproduct";		
	if(isset($redirect))
	{
		$editurl = base_url()."admin/product/editedproduct".$redirect;
		$createurl = base_url()."admin/product/createproduct".$redirect;		
	}
	
	
?>
<div>
	<a href = "" class = "btn btn-large btn-info addproduct" onclick="$('#productmodal').show('slow');$(this).hide('slow');return false;">Create Product</a>
</div>
<div class="" style = "display: none;" id="productmodal">
	<!--<form action = "" method = "POST" class="form-horizontal" onsubmit="">-->
	<?php 
		$attr = array
		(
			"method"=>"POST",
			"class"=>"form-horizontal",
			"onsubmit"=>"validate(this,event);"
		);
		echo form_open_multipart("",$attr);
	?>
		<input type ="hidden" name = "product_func" value = "" class = "product_func"/>
		<input type ="hidden" name = "product_count" value = "" class = "product_count"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&mdash; hide</button>
				<h3></h3>
			</div>
			<div class="">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content productmodal-body">
							<fieldset>
							
							</fieldset>
				<span class = "addrembtns">
					<span class = "btn btn-success addmorebtn">Add more</span>
					<span class = "btn btn-danger removemorebtn">Remove</span>
				</span>
				</div>				
			</div>
			<div class="modal-footer">
				<a href="#" class="btn closebtn" data-dismiss="modal">Close</a>
				<input type = "submit" value = "Save changes" class="btn btn-primary" />
			</div>
	</form>
</div>
<style>
#productmodal
{
	-webkit-transition: opacity .3s linear, top .3s ease-out;
	-moz-transition: opacity .3s linear, top .3s ease-out;
	-ms-transition: opacity .3s linear, top .3s ease-out;
	-o-transition: opacity .3s linear, top .3s ease-out;
	transition: opacity .3s linear, top .3s ease-out;
}
#selectError1_chzn
{
	width: 220px !important;
}
.btn-setting
{
	display: none !important;
}
</style>
<script>

var g_count = 0;
function getproductHtml(count,isedit)
{
var strHtml = '<span class = "product-addData"><div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused product_name" id="focusedInput" name="product_name_'+count+'" type="text" value="" placeholder="Enter Product name">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Image</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="prodImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused product_image" id="focusedInput" name="product_image_'+count+'" type="file" >'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">New</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "is_new" name = "is_new_'+count+'" checked value = "1"/>Product is New</label>'
			+'<label><input type = "radio" class = "is_new" name = "is_new_'+count+'" value = "0"/>Regular</label>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Featured</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "is_featured" name = "is_featured_'+count+'" checked value = "1"/>Product is Featured</label>'
			+'<label><input type = "radio" class = "is_featured" name = "is_featured_'+count+'" value = "0"/>Regular</label>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Features</label>'
			+'<div class="controls">'
   		    +' <textarea class="cleditor input-large focused product_features" id="focusedInput" name="product_features_'+count+'" type="text" value="" placeholder="Enter Product Features"></textarea>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Ingredients</label>'
			+'<div class="controls">'
   		    +' <textarea class="cleditor input-large focused product_ingredients" id="focusedInput" name="product_ingredients_'+count+'" type="text" value="" placeholder="Enter Product Ingredients"></textarea>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Price</label>'
			+'<div class="controls">'
   		    +' <input class="input-medium focused product_price" id="focusedInput" name="product_price_'+count+'" type="text" value="" placeholder="Enter Product Price">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Discount Price</label>'
			+'<div class="controls">'
   		    +' <input class="input-medium focused discount_price" id="focusedInput" name="discount_price_'+count+'" type="text" value="" placeholder="Enter Discount Price">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Discount Percentage</label>'
			+'<div class="controls">'
   		    +' <input class="input-medium focused discount_percent" id="focusedInput" name="discount_percent_'+count+'" type="text" value="" placeholder="Enter Discount Percentage">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Discount Status</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "discount_status" name = "discount_status_'+count+'" checked value = "1"/>Enable</label>'
			+'<label><input type = "radio" class = "discount_status" name = "discount_status_'+count+'" value = "0"/>Disable</label>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Display Status</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" checked value = "1"/>Enable</label>'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" value = "0"/>Disable</label>'
			+'</div>'
			+'</div>';
			
			
	strHtml += '<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Categories</label>'
			+'<div class="controls">';			
	<?php 
		if($oObj->categorydata)
		{
	?>
	strHtml += '<select name = "category_id_'+count+'[]" multiple class = "category_id">';
	<?php
			foreach($oObj->categorydata as $parent)
			{
				echo "strHtml += \"<option value = '".$parent['category_id']."'>".$parent['category_name']."</option>\";";
			}
	?>
	strHtml	+='</select>';
	<?php
		}
		else
		{
			echo  'strHtml += "<span style = \'color:red;\'>No Category found.</span>Please <a href = \''.base_url().'admin/categories\'>Add Category</a>";';
		}
	?>
	strHtml +='</div>'
			+'</div>';
	
	
			
			
			
	strHtml += '<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Sub-Categories</label>'
			+'<div class="controls">';			
	<?php 
		if($oObj->subCategoryData)
		{
	?>
	strHtml += '<select name = "subcategory_id_'+count+'[]" multiple class = "subcategory_id">';
	<?php
			foreach($oObj->subCategoryData as $parent)
			{
				echo "strHtml += \"<option value = '".$parent['category_id']."' pcat = '".$parent['parent_category_id']."'>".$parent['category_name']."</option>\";";
			}
	?>
	strHtml	+='</select>';
	<?php
		}
		else
		{
			echo  'strHtml += "<span style = \'color:red;\'>No Sub-Category found.</span>Please <a href = \''.base_url().'admin/subcategories\'>Add Sub-Category</a>";';
		}
	?>
	strHtml +='</div>'
			+'</div>';


			
	strHtml += '<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Brands</label>'
			+'<div class="controls">';			
	<?php 
		if($oObj->brandsData)
		{
	?>
	strHtml += '<select name = "brands_id_'+count+'[]" class = "brands_id">';
	<?php
			foreach($oObj->brandsData as $parent)
			{
				echo "strHtml += \"<option value = '".$parent['brand_id']."'>".$parent['brand_name']."</option>\";";
			}
	?>
	strHtml	+='</select>';
	<?php
		}
		else
		{
			echo  'strHtml += "<span style = \'color:red;\'>No Brands found.</span>Please <a href = \''.base_url().'admin/brands\'>Add Brands</a>";';
		}
	?>
	strHtml +='</div>'
			+'</div>';		
		
			
	strHtml += '<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Vendors</label>'
			+'<div class="controls">';			
	<?php 
		if($oObj->vendorsData)
		{
	?>
	strHtml += '<select name = "vendor_ids_'+count+'[]" multiple class = "vendor_ids">';
	<?php
			foreach($oObj->vendorsData as $parent)
			{
				echo "strHtml += \"<option value = '".$parent['vendor_id']."'>".$parent['vendor_name']."</option>\";";
			}
	?>
	strHtml	+='</select>';
	<?php
		}
		else
		{
			echo  'strHtml += "<span style = \'color:red;\'>No Brands found.</span>Please <a href = \''.base_url().'admin/vendors\'>Add Vendors</a>";';
		}
	?>
	strHtml +='</div>'
			+'</div>';
	
	
	
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "product_id_'+count+'" class = "product_id"/>';
	}			
	
	strHtml += "<center style = 'width : 100%'>"
				+"<div style = 'width: 90%;border-top: 1px solid #B3B3B3;padding-bottom: 20px;padding-top: 20px;'></div></center>";
	strHtml += "</span>";
	return strHtml;
}//product_name  product_image display_status



function validate(oDiv,event)
{
	var check = false;//,[type=file]
	$(oDiv).find("[type=text],[type=radio]").each
	(
		function()
		{
			if(check == false && ($(this).val() == "" || $(this).val().trim() == ""))
			{
				check = true;
				alert("All fields are compulsory");
				event.preventDefault();
				$(this).focus();				
			}			
		}
	);
	$(".product_count").val(g_count);
	
}

function addField(isEdit)
{
	g_count++;
	$(".productmodal-body fieldset").append(getproductHtml(g_count,isEdit));				
	if(isEdit == undefined)
	{
		$(".product-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();	
		setTimeout(function(){$(".cleditor").cleditor();},300);
	}
	assignSubCategoryEvent();
}

$(document).ready
(
	function()
	{
		$.cleditor.defaultOptions.width = 300;
		$.cleditor.defaultOptions.height = 300;
		$(".close,.closebtn").bind("click",function(){$("#productmodal").hide("slow");$(".addproduct").show("slow");})
		$(".discount_price, .discount_percent,.product_price").live
		(
			"keyup",function()
			{
				var oParent = $(this).closest(".product-addData");
				var prod_price = (isNaN(oParent.find(".product_price").val())) ? 0 : oParent.find(".product_price").val();
				if(prod_price == 0)
				{
					alert("Please Enter Product Price first.");
					oParent.find(".product_price").focus();
					return false;
				}
				var disc_price = (isNaN(oParent.find(".discount_price").val())) ? 0 : oParent.find(".discount_price").val();
				var disc_per = (isNaN(oParent.find(".discount_percent").val())) ? 0 :oParent.find(".discount_percent").val();			
				if($(this).hasClass("discount_price"))
				{
					oParent.find(".discount_percent").val(100-((disc_price/prod_price)*100));
				}
				else if($(this).hasClass("discount_percent"))
				{
					oParent.find(".discount_price").val(prod_price-((disc_per/100)*prod_price));
				}
				else
				{
					if(disc_per != 0)
					{
						oParent.find(".discount_price").val(prod_price-((disc_per/100)*prod_price));
					}									
				}
			}
		)
		
		
		
		$(".addmorebtn").bind
		(
			"click",
			function()
			{
				addField();				
				//docReady();
			}
		);
		
		$(".removemorebtn").bind
		(
			"click",
			function()
			{
				if($(".product-addData").length > 1)
				{
					$(".product-addData").last().remove();
					g_count--;					
				}				
			}
		);
		
		$(".addproduct").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#productmodal form").attr("action","<?php echo $createurl; ?>");
				$(".product_func").val("create");
				$(".modal-header h3").html("Add new Product");		
				$(".productmodal-body fieldset").html("");
				addField();
				$(".modal-loader").hide();
				$(".productmodal-body").show();
				return false;
			}
		);
		var chk = setInterval(function(){$(".editbtn").attr("onclick","window.scrollTo(0,0);$('.addproduct').show('slow');$('#productmodal').show('slow');return false;");},1000);
	}
);		

function assignSubCategoryEvent()
{
	$(".subcategory_id").unbind("change").bind
		(
			"change",
			function()
			{
			//	$(this).closest(".product-addData").find(".category_id").find("option").removeAttr("selected");
				var allVals = $(this).val();
				if(allVals == null)return "";
				$(this).find("option").each
				(
					function()
					{
					
						if(allVals.indexOf($(this).attr("value"))!=-1)
						{
							var categorySel = $(this).closest(".product-addData").find(".category_id");
							var arrPcats = $(this).attr("pcat").split(",");
							categorySel.find("option").each
							(
								function()
								{
									if(arrPcats.indexOf($(this).attr("value")) != -1)
									{
										$(this).attr("selected","selected");
									}
								}
							);
						}
					}
				);
			}
		);
}

function customTableEvent()
{	
	$(".editbtn").live("click",function()
	{
		g_count = 0;
		$("#productmodal form").attr("action","<?php echo $editurl; ?>");
		$(".productmodal-body fieldset").html("");
		addField(true);
		$(".addrembtns").hide();
		$(".productmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$(".product_func").val("edit");
		$.ajax
		(
			{
				url : $(this).attr("href"),
				success : function(data)
				{	
					try
					{
						var response = JSON.parse(data);
					}
					catch(e)
					{
						alert("REQUEST FAILED!!! Reloading this page...");
						window.location.href = window.location.href;
					}	
					if(response.status == "success")
					{
						var ob_data = response.data[0];
						$(".modal-header h3").html(ob_data.product_name);
						//product_name  product_image display_status
						$(".product_name").val(ob_data.product_name);
						$(".prodImg").attr("src",ob_data.product_image);
						
						$(".product_features").val(ob_data.product_features);
						$(".product_ingredients").val(ob_data.product_ingredients);
						$(".product_price").val(ob_data.product_price);
						$(".discount_price").val(ob_data.discount_price);
						$(".discount_percent").val(ob_data.discount_percent);
						
						$(".category_id").find("option").removeAttr("selected");
						$(".subcategory_id").find("option").removeAttr("selected");
						$(".brands_id").find("option").removeAttr("selected");
						$(".vendor_ids").find("option").removeAttr("selected");
						var arrCategory = ob_data.category_id.split(",");
						$(".category_id").find("option").each
						(
							function()
							{
								if(arrCategory.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						
						var arrSubcat = ob_data.subcategory_id.split(",");
						$(".subcategory_id").find("option").each
						(
							function()
							{
								if(arrSubcat.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						
						
						var arrBrands = ob_data.brands_id.split(",");
						$(".brands_id").find("option").each
						(
							function()
							{
								if(arrBrands.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						
						var arrVendors = ob_data.vendor_ids.split(",");
						$(".vendor_ids").find("option").each
						(
							function()
							{
								if(arrVendors.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						$(".display_status").each
						(
							function()
							{
								if($(this).val() == ob_data.display_status)
								{
									$(".display_status").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);
												
						$(".discount_status").each
						(
							function()
							{
								if($(this).val() == ob_data.discount_status)
								{
									$(".discount_status").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);
						$(".is_new").each
						(
							function()
							{
								if($(this).val() == ob_data.is_new)
								{
									$(".is_new").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);
						
						$(".is_featured").each
						(
							function()
							{
								if($(this).val() == ob_data.is_featured)
								{
									$(".is_featured").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);
						
						$(".product_id").val(ob_data.product_id);
						$(".modal-loader").hide();
						$(".productmodal-body").show();
						$(".product-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
						assignSubCategoryEvent();
						setTimeout(function(){$(".cleditor").cleditor();},300);
					}
				},
				fail : function()
				{
					alert("There is some problem with your request...");
					window.location.href = window.location.href;
				}
			}
		);				
	});
}
</script>