/*
 * CS Hero
 *
 */
 /*same height*/
function sameHeight(){
	"use strict";
	var biggestHeight = 0;
    jQuery('.sameheight article').each(function(){
        if(jQuery(this).height() > biggestHeight){
            biggestHeight = jQuery(this).height();
        }
    });
    jQuery('.sameheight article').height(biggestHeight);
}
(function($) { "use strict";
/*color box*/
jQuery(function(){
	if(jQuery(".colorbox").length>0){
		jQuery(".colorbox").colorbox();
	}
	if(jQuery(".cs-colorbox-post-video").length>0){
		jQuery(".cs-colorbox-post-video").colorbox({
			iframe:true,
			innerWidth:640,
			innerHeight:390
		});
	}
	if(jQuery(".cs-colorbox-post-gallery").length>0){
		var pid=jQuery(".cs-colorbox-post-gallery").data('sid');
		jQuery(".cs-colorbox-post-gallery").colorbox({
			html: "<div id='cs-gallery-popup"+pid+"' class='carousel slide' data-ride='carousel'>"+jQuery("#"+jQuery(".cs-colorbox-post-gallery").data('selement')).html()+"</div>"
		});
	}

if(jQuery(".cs-masonry-layout").length>0){
	jQuery(".cs-masonry-layout").imagesLoaded(function(){
		jQuery(".cs-masonry-layout").isotope({
			itemSelector: '.cs-masonry-layout-item'
		});
	});
}


});
function wheel(event) {
	if (event.wheelDelta) delta = event.wheelDelta / 120;
	else if (event.detail) delta = -event.detail / 3;
	handle(270,300,delta);
	if (event.preventDefault){event.preventDefault()};
	event.returnValue = false;
}
function handle(distance,time,delta) {
	jQuery('html, body').stop().animate({
		scrollTop: jQuery(window).scrollTop() - (distance * delta)
	}, time);
}
function fullWidth(){
    var windowWidth = jQuery(window).width();
    jQuery('.stripe').each(function(){
        var $bgobj = jQuery(this);
        var width = $bgobj.width();
        var v = (windowWidth - width)/2;
        $bgobj.css({
            marginLeft:-v,
            paddingLeft:v,
            paddingRight:v
        });
    })
}
function boxed(){
    var windowWidth = jQuery(window).width();
    jQuery('.stripe').each(function(){
        jQuery(this).css({
            marginLeft:0,
            paddingLeft:0,
            paddingRight:0
        });
    })
}
jQuery(document).ready(function($){
	/* Menu */
	var depth = 0;
	var el = null;
	var w_width = jQuery(window).width();
	jQuery('li.menu-item').hover(function(){
		el = jQuery('.sub-menu:first',this);
		if(el.length > 0){
			var el_width = el.outerWidth();
			var el_left = el.offset().left;
			if(w_width < (el_left+el_width)){
				el.addClass('autodrop_left');
			}else if(el_left<=0){
				el.addClass('autodrop_right');
			}
		}
	},function(){
		if(el){
			el.removeClass('autodrop_left');
			el.removeClass('autodrop_right');
			el = null;
		}
	})
	/* End Menu */
	$('.widget_widget_cart_search').removeAttr('id');
	$('.smooth2pager').click(function(){
		var selector = $(this).data('el-selector');
		var top = $(selector).offset().top;
		$("html,body").animate({scrollTop: top }, 500);
	})
	var $mainmenu = $('.main-menu-content .cshero-dropdown');
	var $stickymenu = $('.sticky-menu .cshero-mobile > ul');
    var $mobilemenu = $mainmenu.clone().removeClass('main-menu right left').addClass('cshero-mobile-menu');
    $mobilemenu.find('li').each(function(){
        var $this = $(this);
        if($this.find('ul').length > 0){
            var $menutoggle = $('<span class="cs-menu-toggle"></span>');
            $menutoggle.bind('click',function(){$this.toggleClass('open')});
            $this.append($menutoggle);
        }
    });
	$mobilemenu.appendTo('#cshero-main-menu-mobile');
    var $mobilesticky = $mobilemenu.clone(true);
    $mobilesticky.find('li').each(function(){
        var $this = $(this);
        if($this.find('ul').length > 0){
            var $menutoggle = $('<span class="cs-menu-toggle"></span>');
            $menutoggle.bind('click',function(){$this.toggleClass('open')});
            $this.append($menutoggle);
        }
    });
    $mobilesticky.appendTo('#cshero-sticky-menu-mobile');

    /* Show Tooltip */
    jQuery('[data-rel="tooltip"]').tooltip();

    /* Back to top */
    var window_height = $(window).height();
    var back_to_top = $('#back_to_top');
    var mainmenu = $('.cs-header-custom').find('div').first();
    var menu_top = $('#cs-header-custom-bottom');
    if(menu_top.length > 0){
    	menu_top.addClass('menu-up');
    }
    $(window).scroll(function() {
    	/* fixed menu */
    	var scroll_top = $(window).scrollTop();
    	if(menu_top.length > 0){

    		if(scroll_top >= menu_top.outerHeight(true)){
    			menu_top.removeClass('menu-up');
    		} else{
				menu_top.addClass('menu-up');
			}

	    	if(scroll_top >= (mainmenu.outerHeight(true) - menu_top.outerHeight(true))){
	    		menu_top.addClass('fixed-top');
	    		if(scroll_top >= (mainmenu.outerHeight(true) + menu_top.outerHeight(true) / 2)){
	    			menu_top.removeClass('fullsize').addClass('resize');
	    		}
	    	} else{
	    		menu_top.removeClass('fixed-top');
	    		if(scroll_top <= (mainmenu.outerHeight(true) + menu_top.outerHeight(true))){
	    			menu_top.removeClass('resize').addClass('fullsize');
	    		}
	    	}
    	}
    	/* back to top */
    	if(scroll_top < window_height){
    		back_to_top.addClass('off').removeClass('on');
    	} else {
    		back_to_top.removeClass('off').addClass('on');
    	}
    });
    back_to_top.click(function() {
    	$("html, body").animate({scrollTop: 0}, 1500);
	});
    /* Fix Column Height */
    jQuery('.feature-box').each(function(){
		var subs = $(this).find('> .column_container');
		if(subs.length < 2) return;
		var maxHeight = Math.max.apply(null, $(this).find("> .column_container").map(function(){
			return $(this).height();
		}).get());
		$(this).find("> .column_container").height(maxHeight-3);
	});
    /* Parallax Section */
    var windowHeight = jQuery(window).height();
    fullWidth();
    // Same Height
    jQuery('.wpb_row').each(function(){
        if(jQuery(this).hasClass('ww-same-height')){
            var height = jQuery(this).height();
            jQuery(this).children(":first").children().each(function(){
                jQuery(this).css('min-height', height);
            });
        }

    });
    //Fade out Title Bar on Scroll
    var item_height = $(".cs-page-title").outerHeight(true);
    var position = $(".cs-page-title").position();
    var title_animate = $("#title-animate");
    $(window).scroll(function() {
    	if(position){
	        var scroll = $(window).scrollTop();
	        var max = position.top + item_height;
	        if(scroll <= max){
	            var opacity = scroll/item_height;
	            title_animate.css("opacity",1 - opacity);
	        } else {
	        	title_animate.css("opacity",opacity);
	        }
    	}
    });
    //Woo
    //$('body').on('click', 'input.minus',function(){
    	//$(this).parent().find('input[type="number"]').get(0).stepDown();
    //});
    //$('body').on('click', 'input.plus',function(){
    	//$(this).parent().find('input[type="number"]').get(0).stepUp();
    //});
    
    // Woo if IE
    $('body').on('click', 'input.minus',function(){
    	var curent_number = $(this).parent().find('input[type="number"]');
    	var curent_minus = curent_number.val();
    	
    	curent_minus = parseInt(curent_minus);
    	
    	if(curent_minus > 1){
    		
    		curent_minus--;
    		
    		curent_number.val(curent_minus);
    	}
    	
    });
    
    $('body').on('click', 'input.plus',function(){
    	var curent_number = $(this).parent().find('input[type="number"]');
    	var curent_plus = curent_number.val();
    	
    	if(curent_plus){
    		
    		curent_plus = parseInt(curent_plus);
    		
    		curent_plus++;
    		
    		curent_number.val(curent_plus);
    	}
    });
    
    /* row navigator. */
    $('body').on('click', ".scroll-slider" , function () {
    	
		var row_id = $(this).attr('data-id');
		if(row_id != undefined && row_id != ''){
			$("html, body").animate({
                scrollTop: $(row_id).offset().top
            }, 1000);
		}
	});

    /* Add arrow woo categories */
    $('.product-categories li.cat-parent').append('<span class="cs-menu-toggle"><i class="fa fa-angle-right"></i></span>');
    $('.product-categories .cs-menu-toggle').click(function(){
        $(this).prev().toggleClass('submenu-open');
    });
});
})(jQuery);
