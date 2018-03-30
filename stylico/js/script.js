jQuery(document).ready(function() {
	
	//Header Navigation
	jQuery('#header-nav ul').superfish({
		    delay:       500,                            
            animation:   {opacity:'show',height:'show'}, 
            speed:       'fast',                          
            autoArrows:  false,                            
            dropShadows: false,
            disableHI: true,
			onBeforeShow: addTopArrow,
			onHide: removeTopArrow
		});
	
	function addTopArrow() {
		if(this.parent().parent().parent().attr('id') == 'header-nav') {
			jQuery(this).parent().append('<div class="header-nav-top-arrow"></div>');
		}
	}
	
	function removeTopArrow() {
		if(this.length != 0) {
			this.parent().find('.header-nav-top-arrow').remove();	
		}
	}
	
	
	//set height of all widgets to one
	var highestHomeWidget = 0,
	    homeWidgets = jQuery('#home-widget-areas').children('div');
	homeWidgets.each(function() {
		$this = jQuery(this);
		//this will remove all widgets except the first one
		$this.children('div:not(:first)').remove();
		var itemHeight = $this.height();
		if(itemHeight > highestHomeWidget) {
			highestHomeWidget = itemHeight;
		}
	});
	homeWidgets.children('.widget').css('height', highestHomeWidget);
	
	
	//animat body to top
	jQuery('#footer-go-top').click(function() {
		jQuery('html, body').animate({scrollTop : 0}, 500);
		return false;
	});
	
	
	//set prettyphoto
	jQuery("a[rel^='prettyPhoto'], .open-in-prettyphoto a").prettyPhoto({deeplinking: false, social_tools: ''});
	 
	 
	//add magnifier to post teasers and framed image                      
	jQuery("a.post-teaser, a.framed-image").css({'position': 'relative', 'display': 'block'})
							  .append('<div class="image-magnifier" style=""></div>')
							  .hover(function() {
								  jQuery(this).children('img').stop(true, true).fadeTo(500, 0.8).parent().children('.image-magnifier').stop(true, true).show(500); 
							  },
							  function() {
								  jQuery(this).children('img').stop(true, true).fadeTo(400, 1).parent().children('.image-magnifier').stop(true, true).hide(400); 
							  });
	
	
	//fade effect for thumbnails
	jQuery("img.record-image").hover(function() {
		jQuery(this).stop(true, true).fadeTo(500, 0.8); 
	},
	function() {
		jQuery(this).stop(true, true).fadeTo(400, 1); 
	});
	
	                        
	//add tabs to tabbed widget and remove padding
	jQuery(".tabbed-widget").tabs(".tabbed-widget-content", {tabs: '.tabbed-widget-nav li a', effect: 'fade', current: 'tabbed-widget-current', fadeInSpeed: 500}).parent().addClass('no-padding');
	
	
	//create tag cloud
	jQuery('#content .tagcloud').not(':has(a)').addClass('clearfix').wrapInner("<div class='tag-left'></div>").append("<div class='tag-right'></div>").addClass('clearfix');
	jQuery('#content .tagcloud').addClass('clearfix').find('a').wrapInner("<span class='tag-left'></span>").append("<span class='tag-right'></span>").addClass('clearfix');
	
	
	//create tables
	jQuery('#main .zebra-table table tbody tr:odd').addClass('odd');
	
});