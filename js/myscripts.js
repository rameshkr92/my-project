var gototop = setInterval
(
	function()
	{
		if(getScrollTop() >= 300)
		{
			$("#gototop").fadeIn(500);
		}
		else
		{
			$("#gototop").fadeOut(500);
		}
	},1000
);
var g_cur = 0;
	$(document).ready(function()
	{/*
		$("*").each(function()
		{
			if($(this).css("background").indexOf(".png") != -1 && $(this).css("background").indexOf(".png?allowall") == -1 ){$(this).css("background",$(this).css("background").replace(".png",".png?allowall=allow"))}
			
			if($(this).css("background").indexOf(".jpg") != -1  && $(this).css("background").indexOf(".jpg?allowall") == -1){$(this).css("background",$(this).css("background").replace(".jpg",".jpg?allowall=allow"))}
			
			if($(this).css("background").indexOf(".gif") != -1  && $(this).css("background").indexOf(".gif?allowall") == -1){$(this).css("background",$(this).css("background").replace(".gif",".gif?allowall=allow"))}
			
			if($(this).css("background-image").indexOf(".jpg") != -1  && $(this).css("background-image").indexOf(".png?allowall") == -1){$(this).css("background-image",$(this).css("background-image").replace(".jpg",".jpg?allowall=allow"))}
			
			if($(this).css("background-image").indexOf(".png") != -1  && $(this).css("background-image").indexOf(".png?allowall") == -1){$(this).css("background-image",$(this).css("background-image").replace(".png",".png?allowall=allow"))}
			
			if($(this).css("background-image").indexOf(".gif") != -1  && $(this).css("background-image").indexOf(".gif?allowall") == -1){$(this).css("background-image",$(this).css("background-image").replace(".gif",".gif?allowall=allow"))}
			
		
			if(($(this).attr("href") != undefined && $(this).attr("href").toString() != "") && $(this).attr("href").toString().indexOf("?") == -1 && $(this).attr("href").toString().indexOf("#") == -1)
			{
				$(this).attr("href",$(this).attr("href").toString()+"?allowall=allow");
			}
			
			if($(this).attr("src") != undefined && $(this).attr("src").toString().indexOf("?") == -1 && $(this).attr("src").toString().indexOf("#") == -1)
			{
				$(this).attr("src",$(this).attr("src")+"?allowall=allow");
			}
			
			if($(this).attr("action") != undefined && $(this).attr("action").toString().indexOf("?") == -1 && $(this).attr("action").toString().indexOf("#") == -1)
			{
				$(this).attr("action",$(this).attr("action")+"?allowall=allow");
			}
			
		});*/
		$(".show-top-tooltip").tooltip({placement:"bottom"});
		$(".show-tooltip").tooltip({placement:"top"});
		$("#gototop").bind
		(
			"click",
			function()
			{
				$("html,body").animate({scrollTop:0},500);				
			}
		);
		$("#srchFld").typeahead({source:g_product_names});
		bindaddcart();
		$("#srchFld").bind
		(
			"keyup",
			function(e)
			{
				if(e.keyCode == 13)
				{
					/*
					getMoreProducts(true,"product_name_typeahead="+$(this).val());
					stopProductAutoLoading();*/
				}
				else
				{						
					g_product_names[0] = $(this).val().replace(/</g,"").replace(/>/g,"");	
					//This adds just typed data to the array					
				}
			}
		);	
		
		$("#showcartbtn").bind
		(
			"click",
			function()
			{
				$("#cartloader").show();				
				$.ajax
				(
					{
						url : base_url()+"cart/getcurrentcart?allowall=allow",
						success : function(data)
						{//debugger;
							try
							{
								var response = JSON.parse(data);
							}
							catch(e)
							{
								$("#cartloader").trigger("click");								
								displayalertblock("<strong>There are no items in your cart.</strong>");
								return false;
							}
							$("li #cartloader").hide();
							$("#productList-cart table tbody").html("");
							if(response.status == "success")
							{
								for(i in response.productData)
								{
									displayProducts(response.productData[i]);
								}
								var strHtml = "";
								strHtml += '<tr><th>Total Price - </th><td style = "">'+response.totalprice+'</td></tr>'
										+'<tr><th>Discount - </th><td style = "color : green;">'+response.totaldiscount+'</td></tr>'
										+'<tr><th>Gross Price - </th><td style = "text-decoration:underline;">'+response.grossprice+'</td></tr>';
								$("#cart-info table").html(strHtml);
								$(".item-cart-count").html(response.productData.length);
								$(".cart-price").html(response.grossprice);
							}
						},
						fail : function(data)
						{
							$("#cartloader").trigger("click");
							displayalertblock("<strong>Cart cannot be loaded.</strong>");
						}
					}					
				);		
			}
		);
		
		$(".dropdown-menu *").live
		(
			"click",
			function(e)
			{return;
				ss = $(this);
				ss.parent().addClass("open");				
				
			}
		);
		$(".breadcrumb").find("li").last().removeClass(".breadcrumb a").addClass("active");
		$(".breadcrumb a").last().bind("click",function(e){e.preventDefault();});
	});
	var ss;
var g_add_cart_url= "";
function displayProducts(product)
{
//	debugger;
	var strHtml = "";
	strHtml += '<tr product = "'+product.product_id+'" row_id = "'+product.row_id+'">'
			+'<td><span class = "prod-cart-cnt">'+(parseInt($(".prod-cart-cnt").length)+1)+'</span></td>'			
			+'<td style = "width: 40px;"><img src = "'+product.product_image+'&width=50&height=50" /></td>'
			+'<td><a href = "'+base_url()+"product/"+encodeURIComponent(addunderscores(product.product_name))+'"><span>'+product.product_name+'</span></a></td>'
			+'<td><span>'+product.quantity+'</span></td>';
		//	+'<td><input type="number" style = "" class="span1 num_inc cart-qty" value = "'+product.quantity+'" placeholder="Qty."></td>';
			
	if(product.discount_status == "1"){strHtml += '<td><span>'+product.discount_price+'</span></td>';}
	else{strHtml += '<td>-</td>';}
	strHtml += '<td><span>'+product.product_price+'</span></td>';
	strHtml +='</tr><tr><td colspan = "100"><center><div style="width : 100%;border:1px solid #eee;"></div></center></td></tr>';	
	$("#productList-cart table tbody").append(strHtml);
}	
function flushCart()
{
	$("#showcartbtn").parent().removeClass("open");
	$.ajax
	(
		{
			url : base_url()+"cart/removeCart?allowall=allow",
			success : function(data)
			{//debugger;
				$("#showcartbtn").parent().removeClass("open");
				$(".item-cart-count").html(0);
				$(".cart-price").html(0);
				$("#productList-cart").find(".cart-table tbody").html("");
				$("#cart-info").find("table").html("");
			}
		}
	);
}
function bindaddcart()
{
	$(".addtocart").unbind("click").bind
		(
			"click",
			function(e)
			{
				e.preventDefault();
				var img_link = "";
				var oImg;
				g_add_cart_url = $(this).attr("href");				
				if($(this).closest(".thumbnail").length == 0)
				{
					oImg = $(this).closest(".row").find("img");
					img_link = oImg.attr("src");
				}
				else
				{
					oImg =$(this).closest(".thumbnail").find("img");
					img_link = oImg.attr("src");					 
				}
				$("#cartloader").show();
				$.ajax
				(
					{
						url : g_add_cart_url,
						success : function(data)
						{
							$("#showcartbtn").trigger("click");
							$("#showcartbtn").parent().addClass("open");								
						}	
					}						
				);
				$("body").append("<img id = 'img-mover"+g_count+"' src = '"+img_link+"' style = 'position : absolute;top :"+oImg.offset().top+"px; left : "+oImg.offset().left+"px; ' />");				
				$("#img-mover"+g_count).animate
				(
					{
						top : $("#showcartbtn").offset().top,
						left : $("#showcartbtn").offset().left,
					}					
				,1000,function()
				{
					$("#showcartbtn").parent().addClass("open");
					$(this).remove();										
				});	
				g_count++;			
			}
		);
}
var g_count = 1;
function addtocartwithquantity(url,oDiv,event)
{
	event.preventDefault();
	var img_link =  $("#prod-img").attr("src");
	var oImg = $("#prod-img");
	$("body").append("<img id = 'img-mover' src = '"+img_link+"' style = 'position : absolute;top :"+oImg.offset().top+"px; left : "+oImg.offset().left+"px; ' />");				
	$("#img-mover").animate
	(
		{
			top : $("#showcartbtn").offset().top,
			left : $("#showcartbtn").offset().left,
		}					
		,1000,function()
		{
			$(this).remove();
			$.ajax
				(
					{
						url : url,
						success : function(data)
						{//debugger;
							$("#showcartbtn").trigger("click");
							$("#showcartbtn").parent().addClass("open");
						}
					}
				);
		}
	)	
}
function getScrollTop()
{
	var topscroll = 0;
	if(topscroll == 0)topscroll = $("html,body").scrollTop();
	if(topscroll == 0)topscroll = window.scrollY;
	return topscroll;
}
function displayalertinfo(msg)
{
	var strHtml = '<div class="alert alert-info fade in">'
			+'<button type="button" class="close" data-dismiss="alert">&times;</button>'
			+'<span class = "alertmsg">'+msg+'</span>'
	 		+'</div>';
	$("#disp-alert").find(".alert-info").remove();
	$("#disp-alert").append(strHtml);
}
function displayalertsuccess(msg)
{
	var strHtml = '<div class="alert alert-success fade in">'
			+'	<button type="button" class="close" data-dismiss="alert">&times;</button>'
			+'	<span class = "alertmsg">'+msg+'</span>'
			+'</div>';	 
	$("#disp-alert").find(".alert-success").remove();
	$("#disp-alert").append(strHtml);
}
function displayalertblock(msg)
{
	var strHtml = '<div class="alert alert-block alert-error fade in">'
			+'	<button type="button" class="close" data-dismiss="alert">&times;</button>'
			+'	<span class = "alertmsg">'+msg+'</span>'
	 		+'</div>';
	$("#disp-alert").find(".alert-block").remove();
	$("#disp-alert").append(strHtml);
}
function addunderscores(str)
{
	return str.replace(/ /g,"_");
}