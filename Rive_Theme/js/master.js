// On window load. This waits until images have loaded which is essential
/*global jQuery:false, my_ajax:false, on_resize:false, sub: true */
jQuery(window).load(function() {
	"use strict";

	// Wrap Contact form 7 with <p> tags
	//jQuery('.wpcf7-submit').wrap('<p class="form-submit" />');

	// Add 'thickbox' class to linked images
	jQuery(".content a:not(.no_thickbox) img").parent("a").addClass("thickbox");

	// Remove 'thickbox' class from blog iamges
	jQuery("#lang_sel_list img, .languageselector img, .content .entry-image a img").parent("a").removeClass("thickbox");

	jQuery(".content .our-partners li a img, .featured-slide-img a img").parent("a").removeClass("thickbox");

	jQuery("#commentform .comment-form-comment #comment").addClass('span12');

	jQuery("#commentform #submit").addClass('btn btn-primary strong');

	/******************************/

	// Fade in images so there isn't a color "pop" document load and then on window load
	jQuery(".gray-gallery-item a img").fadeIn(500);

	// clone image
	jQuery('.gray-gallery-item a img').each(function() {
		var el = jQuery(this);
		el.css({
			"position":"absolute"
		}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({
			"position":"absolute",
			"z-index":"50",
			"opacity":"0"
		}).insertBefore(el).queue(function() {
			var el = jQuery(this);
			el.parent().css({
				"width":this.width,
				"height":this.height
				});
			el.dequeue();
		});
		this.src = grayscale(this.src);
	});

	// Fade image
	jQuery('.gray-gallery-item a img').mouseover(function() {
		jQuery(this).parent().find('img:first').stop().animate({
			opacity:1
		}, 500);
	});
	jQuery('.img_grayscale').mouseout(function() {
		jQuery(this).stop().animate({
			opacity:0
		}, 500);
	});

});

// debulked onresize handler
function on_resize(c,t){onresize=function(){clearTimeout(t);t=setTimeout(c,100);};return c;}

jQuery(window).load(function () {
	"use strict";

	if ( jQuery('.sidebar-right').is('*') ) {
		if ( jQuery('.white-bg').height() > jQuery('.sidebar-right').height() && jQuery(window).width() > 767 ) {
			jQuery('.sidebar-right').css('height', jQuery('.white-bg').height() + 20);
		}

		jQuery(window).resize(function() {
			if ( jQuery('.white-bg').height() > jQuery('.sidebar-right').height() && jQuery(window).width() > 767 ) {
				jQuery('.sidebar-right').css('height', jQuery('.white-bg').height() + 20);
			} else if ( jQuery(window).width() < 767 ) {
				jQuery('.sidebar-right').css('height', 'auto');
			}
		});
	}

	if ( jQuery('.sidebar-left').is('*') ) {
		if ( jQuery('.white-bg').height() > jQuery('.sidebar-left').height() && jQuery(window).width() > 767 ) {
			jQuery('.sidebar-left').css('height', jQuery('.white-bg').height() + 20);
		}

		jQuery(window).resize(function() {
			if ( jQuery('.white-bg').height() > jQuery('.sidebar-left').height() && jQuery(window).width() > 767 ) {
				jQuery('.sidebar-left').css('height', jQuery('.white-bg').height() + 20);
			} else if ( jQuery(window).width() < 767 ) {
				jQuery('.sidebar-left').css('height', 'auto');
			}
		});
	}
});

jQuery(document).ready(function() {
	"use strict";

	if ( jQuery('#buy-now-ribbon').length && window.self === window.top ) {
		jQuery('#buy-now-ribbon').show();
	};

	jQuery('ul.main-menu').superfish({
		autoArrows: false,
		speed: 'fast'
	});

	jQuery(".right-slide-text").dotdotdot({
		watch: true,
		height: 40
	});
	jQuery(".right-slide-title").dotdotdot({
		watch: true,
		height: 39
	});
	jQuery(".staff-content").dotdotdot({
		watch: true,
		height: 240
	});
	jQuery(".cause-text").dotdotdot({
		watch: true,
		height: 70
	});
	jQuery(".page-sidebar-right .cause-text, .page-sidebar-left .cause-text").dotdotdot({
		watch: true,
		height: 150
	});

	/* Content slider */
	//caching
	//next and prev buttons
	var $cn_next    = jQuery('.slider-next');
	var $cn_prev    = jQuery('.slider-prev');
	//wrapper of the left items
	var $cn_list    = jQuery('.slides');
	var $pages      = $cn_list.find('.slider-page');
	//how many pages
	var cnt_pages   = $pages.length;
	//the default page is the first one
	var page        = 1;
	//list of news (left items)
	var $items      = $cn_list.find('.right-slide-content');
	//the current item being viewed (right side)
	var $cn_preview = jQuery('.featured-slides');
	//index of the item being viewed.
	//the default is the first one
	var current     = 1;

	$cn_next.on('click',function(e) {
		var $this = jQuery(this);
		$cn_prev.removeClass('disabled');
		++page;
		if(page === cnt_pages) {
			$this.addClass('disabled');
		}

		if(page > cnt_pages) {
			page = cnt_pages;
			return;
		}
		$pages.hide();
		$cn_list.find('.slider-page:nth-child('+page+')').fadeIn(250);
		e.preventDefault();
	});

	$cn_prev.bind('click',function(e) {
		var $this = jQuery(this);
		$cn_next.removeClass('disabled');
		--page;
		if(page === 1) {
			$this.addClass('disabled');
		}

		if(page < 1) {
			page = 1;
			return;
		}
		$pages.hide();
		$cn_list.find('.slider-page:nth-child('+page+')').fadeIn(250);
		e.preventDefault();
	});

	$items.each(function(i) {
		var $item = jQuery(this);
		$item.data('idx', i+1);

		$item.bind('click',function() {
			var $this = jQuery(this);
			$cn_list.find('.active').removeClass('active');
			$this.addClass('active');
			var idx      = jQuery(this).data('idx');
			var $current = $cn_preview.find('.featured-slide:nth-child('+current+')');
			var $next    = $cn_preview.find('.featured-slide:nth-child('+idx+')');

			if(idx > current) {
				$current.stop().animate({
					'top':'-405px'
				},600,'easeOutBack',function() {
					jQuery(this).css({'top':'405px'});
				});
				$next.css({
					'top':'405px'
				}).stop().animate({
					'top':'0px'
				}, 600, 'easeOutBack');
			} else if(idx < current) {
				$current.stop().animate({
					'top':'405px'
				},600,'easeOutBack',function() {
					jQuery(this).css({'top':'405px'});
				});
				$next.css({
					'top':'-405px'
				}).stop().animate({
					'top':'0px'
				}, 600, 'easeOutBack');
			}
			current = idx;
		});
	});

	/* Merge gallery */
	jQuery('.merge-gallery div').mouseenter(function() {
		jQuery(this).find('.gallery-caption').animate({
			bottom: jQuery(this).find('img').height()
		},250);
	}).mouseleave(function() {
		jQuery(this).find('.gallery-caption').animate({
			bottom: jQuery(this).find('img').height() + 150
		},250);
	});

	jQuery( '.responsiveMenuSelect' ).change(function() {
		window.location = jQuery(this).find( 'option:selected' ).val();
	});

	// Social icons hover effect
	jQuery(".social_links li a, .social a img").mouseenter(function() {
		var social = this;
		jQuery(social).animate({ opacity: "0.5" }, 250, function() {
			jQuery(social).animate({ opacity: "1.0" }, 100);
		});
	});

	// Footer contact form - send
	jQuery("#contact_form").submit(function() {
		jQuery("#contact_form").parent().find("#error, #success").hide();
		var str = jQuery(this).serialize();
		jQuery.ajax({
			type: "POST",
			url: my_ajax.ajaxurl,
			data: 'action=contact_form&' + str,
			success: function(msg) {
				if(msg === 'sent') {
					jQuery("#contact_form").parent().find("#success").fadeIn("slow");
				} else {
					jQuery("#contact_form").parent().find("#error").fadeIn("slow");
				}
			}
		});
		return false;
	});

	jQuery('.image_overlay_effect').hover(function() {
		jQuery(this).stop().animate({"opacity": 0.9});
	},function() {
		jQuery(this).stop().animate({"opacity": 0});
	});
});

// Grayscale w canvas method
function grayscale(src) {
	"use strict";

	var canvas = document.createElement('canvas');
	var ctx = canvas.getContext('2d');
	var imgObj = new Image();
	imgObj.src = src;
	canvas.width = imgObj.width;
	canvas.height = imgObj.height;
	ctx.drawImage(imgObj, 0, 0);
	var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
	for(var y = 0; y < imgPixels.height; y++){
		for(var x = 0; x < imgPixels.width; x++){
			var i = (y * 4) * imgPixels.width + x * 4;
			var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
			imgPixels.data[i] = avg;
			imgPixels.data[i + 1] = avg;
			imgPixels.data[i + 2] = avg;
		}
	}
	ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	return canvas.toDataURL();
}


function ch_carousel_initCallback(carousel) {
	"use strict";
	jQuery('.jcarousel-next-horizontal').bind('click', function() {
		carousel.next();
		return false;
	});

	jQuery('.jcarousel-prev-horizontal').bind('click', function() {
		carousel.prev();
		return false;
	});
}

function clearInput (input, inputValue) {
	"use strict";

	if (input.value === inputValue) {
		input.value = '';
	}
}

(function($) {
	"use strict";

    // backgroundPosition[X,Y] get hooks
    var $div = $('<div style="background-position: 3px 5px">');
    $.support.backgroundPosition   = $div.css('backgroundPosition')  === "3px 5px" ? true : false;
    $.support.backgroundPositionXY = $div.css('backgroundPositionX') === "3px" ? true : false;
    $div = null;

    var xy = ["X","Y"];

    // helper function to parse out the X and Y values from backgroundPosition
    function parseBgPos(bgPos) {
        var parts  = bgPos.split(/\s/),
            values = {
                "X": parts[0],
                "Y": parts[1]
            };
        return values;
    }

    if (!$.support.backgroundPosition && $.support.backgroundPositionXY) {
        $.cssHooks.backgroundPosition = {
            get: function( elem, computed, extra ) {
                return $.map(xy, function( l, i ) {
                    return $.css(elem, "backgroundPosition" + l);
                }).join(" ");
            },
            set: function( elem, value ) {
                $.each(xy, function( i, l ) {
                    var values = parseBgPos(value);
                    elem.style[ "backgroundPosition" + l ] = values[ l ];
                });
            }
        };
    }

    if ($.support.backgroundPosition && !$.support.backgroundPositionXY) {
        $.each(xy, function( i, l ) {
            $.cssHooks[ "backgroundPosition" + l ] = {
                get: function( elem, computed, extra ) {
                    var values = parseBgPos( $.css(elem, "backgroundPosition") );
                    return values[ l ];
                },
                set: function( elem, value ) {
                    var values = parseBgPos( $.css(elem, "backgroundPosition") ),
                        isX = l === "X";
                    elem.style.backgroundPosition = (isX ? value : values[ "{X}" ]) + " " +
                                                    (isX ? values[ "{Y}" ] : value);
                }
            };
            $.fx.step[ "backgroundPosition" + l ] = function( fx ) {
                $.cssHooks[ "backgroundPosition" + l ].set( fx.elem, fx.now + fx.unit );
            };
        });
    }
})(jQuery);