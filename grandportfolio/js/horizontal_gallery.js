jQuery(document).ready(function(){ 
	"use strict";
	
	jQuery('#horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper').children('.horizontal_gallery_img').each(function(index, value)
	{
	   	var calScreenWidth = jQuery(window).width();
	   	var calScreenHeight = parseInt(jQuery(window).height()*0.55);
	   	
	   	jQuery(this).css('height', calScreenHeight+'px');
	    jQuery(this).parent().addClass('visible');
	});
	
	jQuery('.horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper').children('.horizontal_gallery_img').each(function(index, value)
	{
	   	var calScreenWidth = jQuery(window).width();
	   	var calScreenHeight = parseInt(jQuery(window).height()*0.55);
	   	
	   	jQuery(this).css('height', calScreenHeight+'px');
	    jQuery(this).parent().addClass('visible');
	});
	
	jQuery('#horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper .gallery_img_slides li').children('.static').each(function(index, value)
	{
	   	var calScreenWidth = jQuery(window).width();
	   	var calScreenHeight = parseInt(jQuery(window).height()*0.55);
	   	
	   	jQuery(this).css('height', calScreenHeight+'px');
	    jQuery(this).parent().addClass('visible');
	});
	
	var calScreenWidth = jQuery(window).width();
	
	jQuery('#horizontal_gallery').imagesLoaded(function(){
		if(calScreenWidth >= 480)
		{
			jQuery(this).addClass('visible');
		}
	});
	
	jQuery('.horizontal_gallery').imagesLoaded(function(){
		if(calScreenWidth >= 480)
		{
			jQuery(this).addClass('visible');
		}
	});
	
	jQuery(window).resize(function() {
		jQuery('#horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper').children('.horizontal_gallery_img').each(function(index, value)
		{
		   	var calScreenWidth = jQuery(window).width();
		   	var calScreenHeight = parseInt(jQuery(window).height()*0.55);
		   	
		   	jQuery(this).css('height', calScreenHeight+'px');
		    jQuery(this).parent().addClass('visible');
		});
		
		jQuery('.horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper').children('.horizontal_gallery_img').each(function(index, value)
		{
		   	var calScreenWidth = jQuery(window).width();
		   	var calScreenHeight = parseInt(jQuery(window).height()*0.55);
		   	
		   	jQuery(this).css('height', calScreenHeight+'px');
		    jQuery(this).parent().addClass('visible');
		});
		
		jQuery('#horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper .gallery_img_slides li').children('.static').each(function(index, value)
	{
	   	var calScreenWidth = jQuery(window).width();
	   	var calScreenHeight = parseInt(jQuery(window).height()*0.55);
	   	
	   	jQuery(this).css('height', calScreenHeight+'px');
	    jQuery(this).parent().addClass('visible');
	});
	});
	
});

/*var isIE11 = !!navigator.userAgent.match(/Trident.*rv[ :]*11\./)

jQuery("#horizontal_gallery, .horizontal_gallery").mousewheel(function(event) {
    if(navigator.userAgent.search("MSIE") >= 0 || isIE11)
    {
    	this.scrollLeft -= (event.deltaY * 40);
    }
    else
    {
    	this.scrollLeft -= (event.deltaY * 3);
    }
    event.preventDefault();
});*/