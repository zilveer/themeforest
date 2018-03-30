jQuery(document).ready(function($){ 

	$('body').removeClass('no_js').addClass('yes_js'); 
	
	$('a.no-link').click(function(){return false;});
    
    $('#nav li, ul.sub-menu, ul.children').each(function(){
        n = $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).length;
        
        if(n) $(this).addClass('parent');
    });

    var show_dropdown = function()
    {
        var options;

        containerWidth = $('#header').width();
        marginRight = $('#nav ul.level-1 > li').css('margin-right');
        submenuWidth = $(this).find('ul.sub-menu').outerWidth();
        offsetMenuRight = $(this).position().left + submenuWidth;
        leftPos = -18;

        if ( offsetMenuRight > containerWidth )
            options = { left:leftPos - ( offsetMenuRight - containerWidth ) };
        else
            options = {};

        $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).css(options).stop(true, true).fadeIn(300);
    }

    var hide_dropdown = function()
    {
        $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).fadeOut(300);
    }

    $('#nav ul > li').hover( show_dropdown, hide_dropdown );

    $('#nav ul > li').each(function(){
        if( $('ul', this).length > 0 )
            $(this).children('a').append('<span class="sf-sub-indicator"> &raquo;</span>').css({ paddingRight:parseInt($(this).children('a').css('padding-right'))+16 });
    });

    $('#nav li:not(.megamenu) ul.sub-menu li, #nav li:not(.megamenu) ul.children li').hover(
        function()
        {
            if ( $(this).closest('.megamenu').length > 0 )
                return;

            var options;

            containerWidth = $('#header').width();
            containerOffsetRight = $('#header').offset().left + containerWidth;
            submenuWidth = $('ul.sub-menu, ul.children', this).parent().width();
            offsetMenuRight = $(this).offset().left + submenuWidth * 2;
            leftPos = -10;

            if ( offsetMenuRight > containerOffsetRight )
                $(this).addClass('left');

            $( this ).children( 'ul.sub-menu, ul.children' ).stop(true, true).fadeIn(300);
        },

        function()
        {
            if ( $(this).closest('.megamenu').length > 0 )
                return;

            $( this ).children( 'ul.sub-menu, ul.children' ).fadeOut(300);
        }
    );

    /* megamenu check position */
    $('#nav .megamenu').mouseover(function(){

        var main_container_width = $('.inner').width();
        var main_container_offset = $('.inner').offset();
        var parent = $(this);
        var megamenu = $(this).children('ul.sub-menu');
        var width_megamenu = megamenu.outerWidth();
        var position_megamenu = megamenu.offset();
        var position_parent = parent.position();

        var position_right_megamenu = position_parent.left + width_megamenu;

        // adjust if the right position of megamenu is out of container
        if ( position_right_megamenu > main_container_width ) {
            megamenu.offset( { top:position_megamenu.top, left:main_container_offset.left + ( main_container_width - width_megamenu ) } );
        }

        //alert( 'width_megamenu = ' + width_megamenu + '; position_parent = top:' + position_parent.top + ', left:' + position_parent.left );
        //alert( 'width_megamenu = ' + width_megamenu + '; left = ' + main_container_offset.left + ( main_container_width - width_megamenu ) );

    });

    if ( $('body').hasClass('isMobile') && ! $('body').hasClass('iphone') && ! $('body').hasClass('ipad') )
        $('.sf-sub-indicator').parent().click(function(){   
            $(this).paretn().toggle( show_dropdown, function(){ document.location = $(this).children('a').attr('href') } )
        });
    
    if ( $('body').hasClass('responsive') ) {
        var is_creative = $('#nav').hasClass('creative');
        var change_nav = function() {
            if ( ! is_creative ) return;
            if ( $(window).width() <= 800 )
                $('#nav.creative').removeClass('creative').addClass('elegant');
            else                              
                $('#nav.elegant').removeClass('elegant').addClass('creative');
        }
        change_nav();
        $(window).resize(change_nav);

        // menu in responsive, with select
        if( $('body').hasClass('responsive-menu') ) {
            $('#nav').parent().after('<div class="menu-select"></div>');
            $('#nav').clone().appendTo('.menu-select');
            $('.menu-select #nav').attr('id', 'nav-select').after('<div class="arrow-icon"></div>');

            $( '#nav-select' ).hide().mobileMenu({
                subMenuDash : '-'
            });
        }
    }

	function yiw_lightbox()
	{   
	    $('a.thumb').hover(
	                            
	        function()
	        {
	            $('<a class="zoom">zoom</a>').appendTo(this).css({
					dispay:'block', 
					opacity:0, 
					height:$(this).children('img').height(), 
					width:$(this).children('img').width(),
					'top':$(this).css('padding-top'),
					'left':$(this).css('padding-left'),
					padding:0}).animate({opacity:0.4}, 500);
	        },
	        
	        function()
	        {           
	            $('.zoom').fadeOut(500, function(){$(this).remove()});
	        }
	    );

        if(jQuery.fn.prettyPhoto) {
		    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
                slideshow:5000,
                autoplay_slideshow:false,
                show_title:false,
                deeplinking: true
            });
        }
	}
	
	yiw_lightbox();
	
	// slider
	if( typeof(yiw_slider_type) != 'undefined' ) {
	   if( yiw_slider_type == 'elegant' ) {
    		$("#slider ul").cycle({                                                    
    			easing 	: yiw_slider_elegant_easing,
    	    	fx 		: yiw_slider_elegant_fx,
    			speed 	: yiw_slider_elegant_speed,
    			timeout : yiw_slider_elegant_timeout,
    			before	: function(currSlideElement, nextSlideElement, options, forwardFlag) {
    				var width = parseInt( $('.slider-caption', currSlideElement).outerWidth() );
    				var height = parseInt( $('.slider-caption', currSlideElement).outerHeight() );
    				
    				$('.caption-top', currSlideElement).animate({top:height*-1}, yiw_slider_elegant_caption_speed);
    				$('.caption-bottom', currSlideElement).animate({bottom:height*-1}, yiw_slider_elegant_caption_speed);
    				$('.caption-left', currSlideElement).animate({left:width*-1}, yiw_slider_elegant_caption_speed);
    				$('.caption-right', currSlideElement).animate({right:width*-1}, yiw_slider_elegant_caption_speed);
    			},
    			after	: function(currSlideElement, nextSlideElement, options, forwardFlag) {
    				$('.caption-top', nextSlideElement).animate({top:0}, yiw_slider_elegant_caption_speed);
    				$('.caption-bottom', nextSlideElement).animate({bottom:0}, yiw_slider_elegant_caption_speed);
    				$('.caption-left', nextSlideElement).animate({left:0}, yiw_slider_elegant_caption_speed);
    				$('.caption-right', nextSlideElement).animate({right:0}, yiw_slider_elegant_caption_speed);
    			}
    	    });        
        }
    	else if ( yiw_slider_type == 'thumbnails' ) {
    		$("#slider .showcase").awShowcase(
    	    {
    	        content_width: 			yiw_slider_thumbnails_width,
    	        content_height: 		yiw_slider_thumbnails_height,		
    			show_caption:			'onhover', /* onload/onhover/show */    
			    continuous:				true,
    			buttons:				false,
    			auto:                   true,
    			thumbnails:				true,           
    			transition:				yiw_slider_thumbnails_fx, /* hslide / vslide / fade */
    			interval:        		yiw_slider_thumbnails_timeout,
    			transition_speed:		yiw_slider_thumbnails_speed,
    			thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
    			thumbnails_direction:	'horizontal', /* vertical/horizontal */
    			thumbnails_slidex:		1 /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
    	    });
    	} else if( yiw_slider_type == 'cycle') {
            $('#slider .images').cycle({
                fx      : yiw_slider_cycle_fx,
                speed   : yiw_slider_cycle_speed,
                timeout : yiw_slider_cycle_timeout,
                easing  : yiw_slider_cycle_easing,
                pager   : '.pagination',
                cleartype: true
            });                   
        
            $('#slider-pause').show();
                            
            $('#slider-pause').click(function(){
                $('#slider .images').cycle('pause');
                $(this).hide();
                $('#slider-play').show();
                return false;
            });
                            
            $('#slider-play').click(function(){
                $('#slider .images').cycle('resume');
                $(this).hide();
                $('#slider-pause').show();    
                return false;
            });
        } else if( yiw_slider_type == 'nivo' ) {
            $('#slider .sliderWrapper').nivoSlider({
                effect           : yiw_slider_nivo_fx,
                animSpeed        : yiw_slider_nivo_speed,
                pauseTime        : yiw_slider_nivo_timeout,
                directionNav     : yiw_slider_nivo_directionNav,
                directionNavHide : yiw_slider_nivo_directionNavHide,
                controlNav       : yiw_slider_nivo_controlNav
            });
        }
    }
	
	// searchform on header    // autoclean labels
	$elements = $('#header #s, .autoclear');
    
	$elements.each(function(){
        if( $(this).val() != '' )	
			$(this).prev().css('display', 'none');
    }); 
    $elements.focus(function(){
        if( $(this).val() == '' )	
			$(this).prev().css('display', 'none');
    }); 
    $elements.blur(function(){ 
        if( $(this).val() == '' )	
        	$(this).prev().css('display', 'block');
    }); 

    $('a.socials, a.socials-small').tipsy({fade:true, gravity:'s'});
    
    $('.toggle-content:not(.opened), .content-tab:not(.opened)').hide(); 
    $('.tab-index a').click(function(){           
        $(this).parent().next().slideToggle(300, 'easeOutExpo');
        $(this).parent().toggleClass('tab-opened tab-closed');
        $(this).attr('title', ($(this).attr('title') == 'Close') ? 'Open' : 'Close');
        return false;
    });   
    
    // tabs
	$('#product-tabs').yiw_tabs({
        tabNav  : 'ul.tabs',
        tabDivs : '.containers',
        currentClass : 'active'
    });
	$('.tabs-container').yiw_tabs({
        tabNav  : 'ul.tabs',
        tabDivs : '.border-box'
    });
    $('.quick-contact-box').yiw_tabs({
        tabNav  : 'ul.nav-box',
        tabDivs : '.box-info',
        currentClass : 'active'
    });
    
    $('#slideshow images img').show();
    
    $('.shipping-calculator-form').show();

    $(".isMobile li.menu-item-has-children > a").click(function( event ){
        event.preventDefault();
    });

});

//emulate jquery live to preserve jQuery.live() call
if( typeof jQuery.fn.live == 'undefined' ) {
    jQuery.fn.live = function( types, data, fn ) {
        jQuery( this.context ).on( types, this.selector, data, fn );
        return this;
    };
}

// tabs plugin
(function($) {
    $.fn.yiw_tabs = function(options) {
        // valori di default
        var config = {
            'tabNav': 'ul.tabs',
            'tabDivs': '.containers',
            'currentClass': 'current'
        };      
 
        if (options) $.extend(config, options);
    	
    	this.each(function() {   
        	var tabNav = $(config.tabNav, this);
        	var tabDivs = $(config.tabDivs, this);
        	var activeTab;
        	
            tabDivs.children('div').hide();

            if ( $('li.'+config.currentClass+' a', tabNav).length > 0 )
                activeTab = $('li.'+config.currentClass+' a', tabNav).attr('href');
        	else
        	   activeTab = $('li:first-child a', tabNav).attr('href');
                        
        	$(activeTab).show().addClass('showing');
            $('a[href="'+activeTab+'"]', tabNav).parent().addClass(config.currentClass);
        	
        	$('a', tabNav).click(function(){
        		var id = '#' + $(this).attr('href').split('#')[1];
        		var thisLink = $(this);
        		
        		$('li.'+config.currentClass, tabNav).removeClass(config.currentClass);
        		$(this).parent().addClass(config.currentClass);
        		
        		$('.showing', tabDivs).fadeOut(200, function(){
        			$(this).removeClass('showing');
        			$(id).fadeIn(200).addClass('showing');
        		});
        		
        		return false;
        	});   
        });
    }
})(jQuery);