//Bootsshop-----------------------//
$(document).ready(function(){
	/* carousel of home page animation */
	$('#myCarousel').carousel({
	  interval: 2500
	})
	 $('#featured').carousel({
	  interval: 1500
	})
	$(function() {
		$('#gallery a').lightBox();
	});
	
	$(".subMenu").hover
	(
		function()
		{//debugger;
			var subMenu = $(this).find('ul');
			var li = $(this);
			var subMenus = $('#sidebar li.subMenu ul');
			var subMenus_parents = $('#sidebar li.subMenu');
			if(li.hasClass('open'))
			{
				if(($(window).width() > 768) || ($(window).width() < 479)) {
					subMenu.slideUp();
				} else {
					subMenu.fadeOut(250);
				}
				li.removeClass('open');
			} else 
			{
				if(($(window).width() > 768) || ($(window).width() < 479)) {
					subMenus.slideUp();			
					subMenu.slideDown();
				} else {
					subMenus.fadeOut(250);			
					subMenu.fadeIn(250);
				}
				subMenus_parents.removeClass('open');		
				li.addClass('open');	
			}
		},
		function()
		{
			$(this).removeClass('open');
			$(this).find("ul").slideUp();
		}
	);
	/*
	$('.subMenu > a').click(function(e)
	{
		e.preventDefault();
		var subMenu = $(this).siblings('ul');
		var li = $(this).parents('li');
		var subMenus = $('#sidebar li.subMenu ul');
		var subMenus_parents = $('#sidebar li.subMenu');
		if(li.hasClass('open'))
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				subMenu.slideUp();
			} else {
				subMenu.fadeOut(250);
			}
			li.removeClass('open');
		} else 
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				subMenus.slideUp();			
				subMenu.slideDown();
			} else {
				subMenus.fadeOut(250);			
				subMenu.fadeIn(250);
			}
			subMenus_parents.removeClass('open');		
			li.addClass('open');	
		}
	});
	var ul = $('#sidebar > ul');
	$('#sidebar > a').click(function(e)
	{
		e.preventDefault();
		var sidebar = $('#sidebar');
		if(sidebar.hasClass('open'))
		{
			sidebar.removeClass('open');
			ul.slideUp(250);
		} else 
		{
			sidebar.addClass('open');
			ul.slideDown(250);
		}
	});*/

});