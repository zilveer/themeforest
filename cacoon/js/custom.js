jQuery(document).ready(function(){
    /**
     * Back To Top Button
     * @usedPlugins jquery
     * @usedAt      global
     */
    jQuery(window).scroll(function() {
        if(jQuery(this).scrollTop() > 150) {
            jQuery('#back-to-top').addClass('back-to-top-on').removeClass('back-to-top-off');
        } else {
            jQuery('#back-to-top').addClass('back-to-top-off').removeClass('back-to-top-on');
        }
    });

    jQuery('#back-to-top').click(function() {
        jQuery('body,html').animate({scrollTop:0},800);
    });

	/**
	 * LightBox
	 * @usedPlugins jquery, magnific-popup
	 * @usedAt      portfolio
	 */
	jQuery('[rel*="lb"]').each(function(){
		jQuery('[rel="'+jQuery(this).attr('rel')+'"]').magnificPopup({
			type: 'image',
			gallery:{
				enabled: true
			}
		});
	});

    jQuery('[rel*="mpv"]').each(function(){
        jQuery('[rel="'+jQuery(this).attr('rel')+'"]').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false
        });
    });

	/**
	 * DL Menu
	 * @usedPlugins jquery, dlmenu
	 * @usedAt      shortcode
	 */
	jQuery( '#dl-menu' ).dlmenu({
		animationClasses : { 'in' : 'dl-animate-in-3', 'out' : 'dl-animate-out-3' }
	});


	/**
	 * Blog List Iframe Sizing
	 * @usedPlugins jquery
	 * @usedAt      Blog List Page
	 */
	var iframeVideos = jQuery(".met_blog_video_iframe iframe"),
	iframeContainer = jQuery(".met_blog_video_iframe");

	iframeVideos.each(function() {
		jQuery(this).data('aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width');
	});

	jQuery(window).resize(function() {
		var newWidth = iframeContainer.width();

		iframeVideos.each(function() {
			var el = jQuery(this);
			el.width(newWidth).height(newWidth * el.data('aspectRatio'));
		});
	}).resize();

	/**
	 * Portfolio List Iframe Sizing
	 * @usedPlugins jquery
	 * @usedAt      Portfolio List Page
	 */
	var iframeVideos = jQuery(".met_portfolio_item_preview");

	if(jQuery(".met_portfolio_row .span6").length > 0){
		var iframeContainer = jQuery(".met_portfolio_row .span6");
	}else{
		var iframeContainer = jQuery(".met_portfolio_row .span4");
	}

	iframeVideos.each(function() {
		jQuery(this).data('aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width');
	});

	jQuery(window).resize(function() {
		var newWidth = iframeContainer.width();

		iframeVideos.each(function() {
			var el = jQuery(this);
			el.width(newWidth).height(newWidth * el.data('aspectRatio'));
		});
	}).resize();

	/**
	 * Contact Page Contact Form
	 * @usedPlugins jquery
	 * @usedAt      Contact Page
	 */
    if(jQuery('.met_contact_map_box').length > 0){
        contactFormPlacing();
        jQuery(window).resize(function(){contactFormPlacing()});
    }

    function contactFormPlacing(){
        jQuery('[id*="met_google_maps_"]').each(function(){
            var box = jQuery(this).parent().find('.met_contact_map_box');
            jQuery(this).parent().find('.met_contact_map_box').remove();
            if(jQuery(window).width() < 800){
                jQuery(this).after(box);
            }else{
                jQuery(this).append(box);
            }
        });
    }


	/**
	 * Responsive Navigation
	 * @usedPlugins jquery
	 * @usedAt      Every page that contains responsive navigation select elements
	 */
	jQuery('.met_responsive_nav').on('change',function(){
		window.location = jQuery(this).val();
	});

    if(jQuery('.met_main_nav').data('fixed') == '1'){
        sticky_header();
        jQuery(window).bind('scroll', sticky_header);
    }

    stickyHeaderSize();
    jQuery(window).bind('resize', stickyHeaderSize);

	/**
	 * Full Screen Background Image
	 * @usedPlugins jquery
	 * @usedAt      Boxed Layout Body Background Image
	 */
	if(jQuery('#met_fullScreenImg').length > 0){
		var FullscreenrOptions = {  width: window.innerWidth, height: window.innerHeight, bgID: '#met_fullScreenImg' };
		jQuery.fn.fullscreenr(FullscreenrOptions);
	}


    // Page Builder Class Overrides
    jQuery('.aq_row [class*="aq_span"]').each(function(){
        var elemClass = jQuery(this).attr('class');
        var newElemClass = elemClass.replace(/aq_span/g,"mtspn");
        jQuery(this).removeClass('aq_span2').removeClass('aq_span3').removeClass('aq_span4').removeClass('aq_span5').removeClass('aq_span6').removeClass('aq_span7').removeClass('aq_span8').removeClass('aq_span9').removeClass('aq_span10').removeClass('aq_span11').removeClass('aq_span12');
        jQuery(this).addClass(newElemClass);
        //jQuery('.row-fluid [class*="span"]').removeClass('aq_span6').addClass('row-fluid');
    });


	jQuery('.met_main_nav > ul').superfish({
		delay: 250
	});

	logo_vertical_middle();

	if (window.devicePixelRatio > 1) {
		jQuery('.met_logo img').attr('src', jQuery('.met_logo img').attr('data-retina'));
	}

    jQuery('.met_main_nav ul li ul li.active').each(function(){
        jQuery(this).parent().parent().addClass('active');
    });

    jQuery('.met_main_nav ul li ul li ul li.active').each(function(){
        jQuery(this).parent().parent().parent().addClass('active');
    })
});

jQuery(window).load(function(){

    var testimonialInterval;
    jQuery('.met_testimonial_photos > div').hover(function(){
        var e = jQuery(this);
        testimonialInterval = setInterval(function(){testimonialHoverOver(e)},100);
    },function(){
        var e = jQuery(this);
        testimonialInterval = clearInterval(testimonialInterval);
        testimonialHoverOut(e);
    });
    function testimonialHoverOver(i){
        var id = i.index() + 1;
        i.parents('.met_testimonial_photos').next().children('div:nth-child('+id+')').slideDown();
    }
    function testimonialHoverOut(e){
        var id = e.index() + 1;
        e.parents('.met_testimonial_photos').next().children('div:nth-child('+id+')').slideUp();
    }

    jQuery('.form-submit #submit').addClass('pull-right met_bgcolor');
    jQuery('.comments-area #respond #reply-title').addClass('met_leave_a_reply met_bold_one');

    /**
     * Masonry Portfolio
     * @usedPlugins jquery, isotope, masonry
     * @usedAt      Portfolio List 2 Pages
     */
    met_portfolio_2 = jQuery('.met_mason_portfolio');
    met_portfolio_2.isotope({
        resizable: true,
        //width: 300 * 4,
        masonry: { columnWidth: met_portfolio_2.width() / 4 }
    });

    // update columnWidth on window resize
    jQuery(window).smartresize(function(){
        met_portfolio_2.isotope({
            // update columnWidth to a percentage of container width
            masonry: { columnWidth: met_portfolio_2.width() / 4 }
        });
    });

    // filter items when filter link is clicked
    jQuery('.met_filters li a').click(function(){
        jQuery('.met_filters li a.met_color3').removeClass('met_color3');
        jQuery(this).addClass('met_color3');
        var selector = jQuery(this).attr('data-filter');
        met_portfolio_2.isotope({ filter: selector });
        return false;
    });

    /**
     * Portfolio Isotope Categorization
     * @usedPlugins jquery, isotope, masonry
     * @usedAt      Portfolio List Pages
     */
    var met_portfolio_list = jQuery('div[class*="met_portfolio_list"]');
    var met_portfolio_number=findTheNumber(met_portfolio_list.attr('class'));
    if(jQuery('body').width() <= 320){
        met_portfolio_number = 1;
    }else if(jQuery('body').width() <= 480){
        met_portfolio_number = 2;
    }else if(jQuery('body').width() < 780){
        met_portfolio_number = 3;
    }
    met_portfolio_list.isotope({
        resizable: true,
        fitRows: true,
        masonry: { columnWidth: met_portfolio_list.width() / met_portfolio_number }
    });

    // filter items when filter link is clicked
    jQuery('.met_filters li a').click(function(){
        jQuery('.met_filters li a.met_color3').removeClass('met_color3');
        jQuery(this).addClass('met_color3');
        var selector = jQuery(this).attr('data-filter');
        met_portfolio_list.isotope({ filter: selector });
        return false;
    });

    /**
     * Window Resize State
     * @usedAt      global
     */
    jQuery(window).resize(function(){

        /**
         * Portfolio Lists Ordering on Resize
         * @usedPlugins jquery, isotope/masonry
         * @usedAt      Portfolio List Pages
         */
        var met_portfolio_list = jQuery('div[class*="met_portfolio_list"]');
        var met_portfolio_number=findTheNumber(met_portfolio_list.attr('class'));
        if(jQuery('body').width() < 320){
            met_portfolio_number = 1;
        }else if(jQuery('body').width() < 480){
            met_portfolio_number = 2;
        }else if(jQuery('body').width() < 780){
            met_portfolio_number = 3;
        }
        met_portfolio_list.isotope({
            // update columnWidth to a percentage of container width
            masonry: { columnWidth: met_portfolio_list.width() / met_portfolio_number }
        });
    });
});

/**
 * Sticky Header
 * @usedAt      global,window scroll, dom ready
 */
function sticky_header(){
    if(jQuery('body').width() > 800){
        if(jQuery('.met_main_nav').attr('data-fixed-width') == undefined) jQuery('.met_main_nav').attr('data-fixed-width', jQuery('.met_main_nav').width()+'px');
        if(jQuery('.met_main_nav').attr('data-fixed-left') == undefined) jQuery('.met_main_nav').attr('data-fixed-left', jQuery('.met_main_nav').offset().left+'px');

        if(jQuery(this).scrollTop() > 250 && jQuery('.met_fixed_nav').length != 1){

            jQuery('.met_main_nav').addClass('met_fixed_nav').css({
                'display' : 'none',
                'left' : jQuery('.met_main_nav').attr('data-fixed-left'),
                'width' : jQuery('.met_main_nav').attr('data-fixed-width')
            }).fadeIn('slow');

            if(jQuery('#wpadminbar').length > 0){
                jQuery('.met_main_nav.met_fixed_nav').css('top','28px');
            }

        }else if(jQuery(this).scrollTop() < 250 && jQuery('.met_fixed_nav').length > 0){

            jQuery('.met_fixed_nav').fadeOut('fast',function(){
                jQuery('.met_fixed_nav').css({
                    'left' : '0',
                    'width' : 'asd'
                });
                jQuery('.met_fixed_nav').removeClass('met_fixed_nav').fadeIn('fast');
            });

            if(jQuery('#wpadminbar').length > 0){
                jQuery('.met_main_nav.met_fixed_nav').css('top','0');
            }

        }
    }
}


/**
 * Sticky Header Resizing
 * @usedAt      global,window scroll, dom ready, window resize
 */
function stickyHeaderSize(){
    jQuery('.met_main_nav').attr('data-fixed-width', jQuery('.met_content').width()+'px');
    jQuery('.met_main_nav').attr('data-fixed-left', jQuery('.met_content').offset().left+'px');

    if(jQuery('.met_fixed_nav').length > 0){
        jQuery('.met_fixed_nav').css({
            'left' : jQuery('.met_main_nav').attr('data-fixed-left'),
            'width' : jQuery('.met_main_nav').attr('data-fixed-width')
        });
    }else{
        jQuery('.met_main_nav').css({
            'left' : 0,
            'width' : jQuery('.met_main_nav').attr('data-fixed-width')
        });
    }

}

/**
 * Logo Vertically Centering
 * @usedAt      global, dom ready, window resize
 */
function logo_vertical_middle(){
	var topSpace = Math.floor(Math.abs((150 - jQuery('.met_logo img').attr('height')) / 2));

	jQuery('.met_logo img').css({'margin-top': topSpace+'px'});

	jQuery('.met_logo').removeClass('met_logo_loading');
}

/**
 * Portfolio Social Share Vertically Centering
 * @usedAt      global, dom ready, window resize
 */
function portfolio_share_vertical_middle(){
	if(jQuery('.met_portfolio_item_share').length > 0){
		var container   = jQuery('.met_portfolio_item_share');
		var span        = container.children('span');
		var socials     = container.children('.met_portfolio_item_socials');

		var containerHeight = container.height();
		var spanHeight      = span.height();

		var topVal = (containerHeight - spanHeight) / 2;

		span.css('top', topVal+'px');
		socials.css('top', topVal+'px');
	}
}

jQuery(document).bind('ready', portfolio_share_vertical_middle);
jQuery(window).bind('resize', portfolio_share_vertical_middle);

/**
 * Number Finder
 * @usedAt global, portfolio isotope filtering
 */
function findTheNumber(s){
    var patt=/\d/g;
    return patt.exec(s);
}