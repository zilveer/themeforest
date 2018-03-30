/*
	Easy plugin to get element index position
	Author: Peerapong Pulpipatnan
	http://themeforest.net/user/peerapong
*/

var $j = jQuery.noConflict();

$j.fn.getIndex = function(){
	var $jp=$j(this).parent().children();
    return $jp.index(this);
}

this.imagePreview = function(){	
	/* CONFIG */
		
		xOffset = 0;
		yOffset = 0;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$j("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$j("#option_wrapper").append("<p id='preview'><img src='"+ this.name +"' alt='Image preview' style='z-index:999999' />"+ c +"</p>");								 
		$j("#preview")
			.css("top",(e.pageY - 50) + "px")
			.css("left",(e.pageX - 20) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$j("#preview").remove()
    });		
    
    $j("a.preview").mousemove(function(e){
		$j("#preview")
			.css("top",(e.pageY - 50) + "px")
			.css("left",(e.pageX - 20) + "px");
	});	
};

$j.fn.setNav = function(){
	$j('#main_menu li ul').css({display: 'none'});

	$j('#main_menu li').each(function()
	{	
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	
			position = $j(this).position();
			
			if($j(this).parents().attr('class') == 'sub-menu')
			{	
				$jsublist.css({top: position.top-10+'px', paddingTop: '10px', paddingBottom: '5px'});
				$jsublist.stop().css({height:'auto', display:'none'}).show();
			}
			else
			{
				$jsublist.stop().css({overflow: 'visible', height:'auto', display:'none'}).show();
				
				if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
 				{
 					hackMargin = -$j(this).width()-2;
					$jsublist.css({marginLeft: hackMargin+'px'});
				}
			}
		},
		function()
		{	
			$jsublist.stop().css({height:'auto', display:'none'}).slideUp(200);	
		});

	});
	
	$j('#main_menu li').each(function()
	{
		
		$j(this).hover(function()
		{	
			$j(this).find('a:first').addClass('hover');
		},
		function()
		{	
			$j(this).find('a:first').removeClass('hover');
		});	
		
	});
	
	$j('#menu_wrapper .nav ul li ul').css({display: 'none'});

	$j('#menu_wrapper .nav ul li').each(function()
	{
		
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	
			if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
 			{
 				$jsublist.css({top: position.top-10+'px', paddingTop: '10px', paddingBottom: '5px'});		
 			}
 			else
 			{
 				$jsublist.css({top: position.top-10+'px', paddingTop: '10px', paddingBottom: '5px'});
 			}
		
			$jsublist.stop().css({height:'auto', display:'none'}).show();	
		},
		function()
		{	
			$jsublist.stop().css({height:'auto', display:'none'}).slideUp(200);	
		});		
		
	});
	
	$j('#menu_wrapper .nav ul li').each(function()
	{
		
		$j(this).hover(function()
		{	
			$j(this).find('a:first').addClass('hover');
		},
		function()
		{	
			$j(this).find('a:first').removeClass('hover');
		});	
		
	});
}

$j(document).ready(function(){ 

	$j(document).setNav();
	
	$j('.img_frame').fancybox({ 
		padding: 10,
		overlayColor: '#000',
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('.flickr li a').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
	{
		var zIndexNumber = 1000;
		$j('div').each(function() {
			$j(this).css('zIndex', zIndexNumber);
			zIndexNumber -= 10;
		});

		$j('#thumbNav').css('zIndex', 1000);
		$j('#thumbLeftNav').css('zIndex', 1000);
		$j('#thumbRightNav').css('zIndex', 1000);
		$j('#fancybox-wrap').css('zIndex', 1001);
		$j('#fancybox-overlay').css('zIndex', 1000);
	}
	
	$j(".accordion").accordion({ collapsible: true });
	
	$j(".accordion_close").find('.ui-accordion-header a').click();
	
	$j(".tabs").tabs();
	
	$j('.thumb li a').tipsy({fade: true});
	
	$j('.social_media ul li a').tipsy({fade: true});
	
	$j('#nivo_slider').nivoSlider({ pauseTime: parseInt($j('#slider_timer').val() * 1000), pauseOnHover: true, effect: $j('#pp_homepage_slider_trans').val(), controlNav: true, captionOpacity: 1, directionNavHide: false, controlNavThumbs:true, controlNavThumbsFromRel:true });
	
	var footerLi = 0;
	jQuery('#footer .sidebar_widget li.widget').each(function()
	{
		footerLi++;
		
		if(footerLi%4 == 0)
		{ 
			$j(this).addClass('widget-four');
		}
	});
	
	$j('input#s').attr('title', 'to search type and hit enter');
	
	$j('input[title!=""]').hint();
	
	$j('textarea[title!=""]').hint();
	
	$j('#main_menu.main_nav, .main_nav > ul').not('.sub-menu').append('<li><a>&nbsp;</a></li>');
	
	$j('#slider_wrapper div').css('visibility', 'visible');
	
	$j('#option_btn').click(
    	function() {
    		if($j('#option_wrapper').css('left') != '0px')
    		{
 				$j('#option_wrapper').animate({"left": "0px"}, { duration: 300 });
	 			$j(this).animate({"left": "240px"}, { duration: 300 });
	 		}
	 		else
	 		{
	 			$j('#option_wrapper').animate({"left": "-245px"}, { duration: 300 });
    			$j('#option_btn').animate({"left": "0px"}, { duration: 300 });
	 		}
    	}
    );
    
    $j('#pp_skin_preview').ColorPicker({
		color: $j('#pp_skin').val(),
		onShow: function (colpkr) {
			$j(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) { 
			$j.ajax({
  				type: 'GET',
  				url: $j('#form_option').attr('action'),
  				data: 'pp_skin='+$j('#pp_skin_preview').css('backgroundColor')
			});
			
			$j(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$j('#header_wrapper, #nivo_caption_wrapper .caption_cat, #content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, .post_img .caption_cat, .pagination span.current, .pagination a:hover, table tr th, .sidebar_content h2.widgettitle').css('backgroundColor', '#' + hex);
			$j('#footer h2.widgettitle').css('color', '#' + hex);
			$j('.pagination span.current, .pagination a:hover').css('borderColor', '#' + hex);
			$j('#pp_skin_preview').css('backgroundColor', '#' + hex);
		}
	});
    
    imagePreview();
    
    // Create the dropdown base
	$j("<select />").appendTo("#menu_border_wrapper");
	
	// Create default option "Go to..."
	$j("<option />", {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : "- Main Menu -"
	}).appendTo("#menu_border_wrapper select");
    
    $j(".main_nav li").each(function() {
		var current_item = $j(this).hasClass('current-menu-item'); 
		var el = $j(this).children('a');
		var menu_text = el.text();
		
		if($j(this).parent('ul.sub-menu').length > 0)
		{
			menu_text = "- "+menu_text;
		}
		 
		if($j(this).parent('ul.sub-menu').parent('li').parent('ul.sub-menu').length > 0)
		{
		 	menu_text = el.text();
		 	menu_text = "- - "+menu_text;
		}
		 
		if(menu_text.length > 0)
		{
			if(current_item)
			{
			 	$j("<option />", {
			 		 "selected": "selected",
			    	 "value"   : el.attr("href"),
			    	 "text"    : menu_text
				 }).appendTo("#menu_border_wrapper select");
			}
			else
			{
			 	$j("<option />", {
			     	"value"   : el.attr("href"),
			     	"text"    : menu_text
			 	}).appendTo("#menu_border_wrapper select");
			}
		}
	});
	
	$j("#menu_border_wrapper select").change(function() {
  		window.location = $j(this).find("option:selected").val();
	});

});