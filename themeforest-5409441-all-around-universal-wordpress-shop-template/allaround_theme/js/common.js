(function($){
"use strict";



/*			Image Hover			*/


$(document).ready(function(){

		$('.image_wrapper').append('<div class="image_shader"></div>');
		$('.image_wrapper').hover(function(){
			var padd = 10, wid = 21;
			if($(this).find('.image_more_info.small').length > 0) {
				padd = 8; wid = 16;
			}
			$(this).find('.image_more_info a img').stop(true).animate({padding:padd+'px', width:(wid)+'px'}, 200, function(){
				$(this).animate({width:wid+'px'}, 200);
				});
			$(this).find('.image_shader').stop(true).animate({opacity: 0.6}, 200);
			$(this).find('.image_socials a').each(function(index){
				var del = index*100;
				$(this).find('span').delay(del).animate({top : 0}, 200);
			});
			$(this).find('.image_read_more_wrapper').animate({opacity : 1}, 400);
		}, function(){
			$(this).find('.image_more_info a img').stop(true).animate({padding:'0px', width:'0px'}, 100);
			$(this).find('.image_shader').stop(true).animate({opacity: 0}, 200);
			$(this).find('.image_socials a span').stop(true).animate({top : '40px'}, 200);
			$(this).find('.image_read_more_wrapper').stop(true).animate({opacity: 0}, 200);
		});

});


/*		Image Hover - products		*/
$(document).ready(function(){
	$('.products_sidebar a').each(function(index){
			$(this).hover(function(){
			$('.image_wrapper.prod').eq(index).trigger('mouseenter');

		}, function(){
			$('.image_wrapper.prod').eq(index).trigger('mouseleave');

		});
	});
});


/*					Add 'has_children' class to menus					*/
$(document).ready(function(){
    $.each($('.menu-item').has('ul.sub-menu'), function() {
        $(this).addClass('has_children');
    });
});

/*					Header Menu					*/

$(document).ready(function(){
	$('.header_menu li').hover(function(){
		/*if ($.support.opacity === true){
			$(this).find('.header_submenu_arrow').css('display','block').stop(true, true).animate({opacity : '0.8', top : '+=30'}, 200);
			} else {
			$(this).find('.header_submenu_arrow').css('display','block').stop(true, true).animate({opacity : '1', top : '+=30'}, 200);
			}*/

		$(this).data('hoverOn','true');
		if($(this).children('ul').length !== 0) {
			$(this).children('a').addClass('hover');
		} else {
			$(this).children('a').addClass('hover_single');
		}
		$(this).children('ul').css('display','block').stop(true, true).animate({opacity : '1' , top : '+=26'}, 200);



	}, function() {
		/*$(this).find('.header_submenu_arrow').css('display','none').stop(true, true).animate({opacity : '0', top : '-=30'}, 200);*/

		$(this).data('hoverOn','false');
		if($(this).children('ul').length !== 0) {

			$(this).children('ul').css('display','none').stop(true, true).animate({opacity : '0', top : '-=26'}, 200, function(){
				if($(this).data('hoverOn') === 'false') { $(this).children('a').removeClass('hover'); }
			});
		} else {
				if($(this).children('ul').length !== 0) {
					$(this).children('a').removeClass('hover');
			} else {
				$(this).children('a').removeClass('hover_single');
				}
		}


	});

	if (!lessThenIe8) {
		$('.header_menu li a').hover(function(){
			$(this).stop(true).animate({backgroundColor : AllAround.color},300);
			},function(){
			$(this).stop(true).animate({backgroundColor : 'transparent'},300, null, function() { this.style.backgroundColor='transparent'; });
		});
	}
	else {
		$('.header_menu li a').hover(function(){
			$(this).stop(true).animate({backgroundColor : AllAround.color},0);
			},function(){
			$(this).stop(true).animate({backgroundColor : 'transparent'},0, null, function() { this.style.backgroundColor='transparent'; });
		});
	}



});


	var responsive_menu = false;
	$(document).ready(function(){
		var window_width = $(window).width();
		if (window_width < 752) {
			responsive_menu = true;
		}
		else {
			responsive_menu = false;
		}
	});
	$(window).resize(function(){
		var window_width = $(window).width();
		if (window_width < 752) {
			responsive_menu = true;
			if($('.header_wrap').hasClass('sticky')){
				$('.header_wrap').removeClass('sticky');
			}
		}
		else {
			responsive_menu = false;
		}
	});
	$(window).scroll(function(){
		if(!responsive_menu){
			var wind_scr = $(window).scrollTop();
			if(wind_scr < 200){
				if($('.header_wrap').data('sticky') === true){
					$('.header_wrap').data('sticky', false);
					$('.header_wrap').stop(true).animate({opacity : 0}, 150, function(){
						$(this).removeClass('sticky');
						$('.header_wrap').stop(true).animate({opacity : 1}, 300);
					});
				}
			}
			else {
				if($('.header_wrap').data('sticky') === false || typeof $('.header_wrap').data('sticky') === 'undefined'){
					$('.header_wrap').data('sticky', true);
					$('.header_wrap').stop(true).animate({opacity : 0},150,function(){
						$(this).addClass('sticky');
						$('.header_wrap.sticky').stop(true).animate({opacity : 1}, 300);
					});
				}
			}
		}
	});







/*		Header Responsive Menu		*/

$(document).ready(function(){
	$('.responsive_menu select').change(function(){
		var href = $(this).val();
		window.location = href;

	});

});






/*						Bubbles						*/

$(document).ready(function(){

	if (!lessThenIe8)
	{

		$('.pop_up_bubble').delay(1000).each(function(index) {
			var btop = parseInt($(this).attr('data-top'), 10);
			var bleft = parseInt($(this).attr('data-left'), 10);
			var b2radius = parseInt($(this).attr('data-radius'), 10);
			var seq = index*50;

			$(this).css({'top':(btop+b2radius/2)+'px', 'left':(bleft+b2radius/2)+'px'});


			$(this).delay(seq).animate({top:(btop-3)+'px', left:(bleft-3)+'px', width:(b2radius+6)+'px', height:(b2radius+6)+'px'}, 200, function(){
				$(this).animate({top:btop+'px', left:bleft+'px', width:b2radius+'px', height:b2radius+'px'}, 200);
			});

			$(this).hover(function(){
				if($(this).hasClass('black')) {
					$(this).removeClass('black').addClass('red');
				} else {
					$(this).removeClass('red').addClass('black');
				}

				$(this).stop(true).animate({top:(btop-3)+'px', left:(bleft-3)+'px', width:(b2radius+6)+'px', height:(b2radius+6)+'px'}, 200);
			}, function(){

			$(this).animate({top:btop+'px', left:bleft+'px', width:b2radius+'px', height:b2radius+'px'}, 200);

			});


		});

	}
});


/*					Product Page Statistics				*/



$(document).ready(function(){


   $('.statistics_bar').delay(800).each(function(index) {
		var ppwidth = parseInt($(this).attr('data-width'), 10), seq = index*150;
		$(this).delay(seq).animate({width:(ppwidth)+'%'}, 800);

	});




});

/*				Product Page Order Boxes				*/

$(document).ready(function(){
	$('.product_select, .woocommerce-ordering select.orderby, #calc_shipping_country.country_to_state, select#cat, select[name=archive-dropdown], .widget_product_categories select').each(function(){
		var $this = $(this);
		$this.hide();
		var selected = $this.find('option[value='+$this.val()+']').html();
		var html = '<div class="select_menu" data-name="'+$this.attr('name')+'">'+
					'<span>'+selected+'</span>'+
					'<a href="" class="drop_button"></a>'+
					'<ul style="display:none">';
					$this.find('option').each(function(){
						html += '<li><a href="#" data-value="'+$(this).attr('value')+'">'+$(this).html()+'</a></li>';
					});
		html +=
						'</ul>'+
					'<div class="clear"></div><!-- clear -->'+
					'</div><!-- select_menu -->';
		$(html).insertAfter($this);
	});

	$('.select_menu').hover(function(){
		$(this).data('hover',true);
	}, function(){
		$(this).data('hover', false);
	});


	$('.drop_button').click(function(e){
		e.preventDefault();
		var $parent = $(this).parent();
		if(!$parent.hasClass('active')) {
			$parent.addClass('active').find('ul').show();
		}
		else {
			$parent.removeClass('active').find('ul').hide();
		}
	});

	$('.select_menu ul a').click(function(e){
		e.preventDefault();
		var $parent = $(this).parent().parent().parent();
		var $select = $('select[name='+$parent.attr('data-name')+']');
		$select.val($(this).attr('data-value')).change();
		$parent.find('span').html($(this).html());
		$parent.removeClass('active').find('ul').hide();
	});

	$('body').click(function(){
		$('.select_menu.active').each(function(){
			if(!$(this).data('hover')) {
				$(this).removeClass('active').find('ul').hide();
			}
		});
	});



});

/*				Product Page Zoom Module			*/

$(document).ready(function(){

$(document).on('change', 'table.variations td.value select', function() {

	var content_image = $(document).find('.zoom_wrap.images .content_image');
	var zoom_image = $(document).find('.zoom_wrap.images .zoomImg');
	if ( zoom_image.attr('src') != content_image.attr('src') ) {
		zoom_image.attr('src',  content_image.attr('src'));
	}
});

$(this).find('.small_image .image_wrapper img.attachment-products-500').addClass('content_image');
$('.image_more_info.small a').click(function(e){
	e.preventDefault();
	var imghtml = $(this).parent().parent().find('.content_image').clone();
	var imgsrc = $(this).parent().parent().find('.content_image').attr('src');
	var $parent	= $(this).parent().parent().parent().parent().parent();


	if ($parent.find('.zoom_wrap img.content_image').length > 1){
		$parent.find('.zoom_wrap img.content_image:first').stop(true);
		$parent.find('.zoom_wrap img.content_image:last').remove();
	}


	$parent.find('.zoom_wrap').append(imghtml).find('img.content_image:last').animate({opacity:1}, 370, function(){
		$(this).wrap('<span style="display:inline-block"></span>').css('display', 'block').parent().zoom();
		});
	$parent.find('.zoom_wrap img.content_image:first').animate({opacity:0}, 370, function(){
		$(this).parent().remove();
		});

	$parent.find('.image_more_info.big a').attr('href', imgsrc);



	});



});

 /*				Accordion				*/
 $(window).load(function(){

 if ($('.acc-content').length > 0)  {

	var $container = $('.acc-content'), $trigger = $('.acc-trigger');

	$container.hide();
	$trigger.prepend('<span class="acc-arrow"></span>').first().addClass('active').next().show();

	var fullWidth = $container.outerWidth(true);
	$trigger.css('width', fullWidth-75);
	$container.css('width', fullWidth-75);

	$trigger.click(function(e) {
		if( $(this).next().is(':hidden') ) {
			$(this).parent().find('.acc-trigger').removeClass('active').next().slideUp(300);
			$(this).toggleClass('active').next().slideDown(300);
		}
		e.preventDefault();

		});
	}

});

/*						Tabs						*/
$(window).load(function(){
	$(".tabs .tabs-nav a").click(function(e){
		e.preventDefault();
		if(!$(this).hasClass('active')) {
			$(this).parent().parent().find('a').removeClass("active");
			$(this).addClass('active');

			var $containter = $(this).parent().parent().parent().find('.tabs-container'), tabId = $(this).attr('href');

			$containter.children('.tab-content').stop(true, true).hide();
			$containter.find(tabId).fadeIn();
		}
  });
	$(".tabs").find("a:first").trigger("click");

});


/*				Input focus				*/

$(document).ready(function(){
$('input.input_field').each(function() {
	var temp;
	$(this).focus(function(){
		temp = $(this).attr('value');
		$(this).attr('value', '');
	});
	$(this).focusout(function(){
		if ($(this).attr('value') === '') {
			$(this).attr('value', temp);
		}

	});
});


});

/*				Textarea focus				*/

$(document).ready(function(){
$('textarea.textarea_field').each(function() {
	var tmp;
	$(this).focus(function(){
		tmp = $(this).html();
		$(this).html('');
	});
	$(this).focusout(function(){
		if ($(this).html() === '') {
			$(this).html(tmp);
		}

	});
});


});

//			Button Color Animate			

$(document).ready(function(){
	$('.button_hover_effect, input[type=submit], .woocommerce .edit, .woocommerce .button, #place-order, .add_to_cart_button.button.product_type_simple').hover(function(){
			var hoverClr = AllAround.lightercolor;
			$(this).stop(true).animate({'background-color': hoverClr}, 300);

		}, function(){
			var bgClr = AllAround.color;
			$(this).stop(true).animate({'background-color': bgClr}, 300);
		});


	$('.static_banner_item_button_hover_effect').hover(function(){
			var hoverClr = AllAround.lightercolor;
			var bgClr = AllAround.color;
			$(this).stop(true).animate({'background-color': '#FFFFFF', 'color': bgClr}, 300);

		}, function(){
			var hoverClr = AllAround.lightercolor;
			var bgClr = AllAround.color;
			$(this).stop(true).animate({'background-color': bgClr, 'color': '#FFFFFF'}, 300);
		});


});

//			Button Color Animate - Socials			

$(document).ready(function(){
	$('.footer_socials').each(function(){


		$(this).hover(function(){
			$(this).stop(true).animate({backgroundColor: '#e84c3d'}, 300);

		}, function(){
			$(this).stop(true).animate({backgroundColor: '#243030'}, 300);
		});

	});

});

//			Header Socials hover

$(document).ready(function(){
	$('.supheader_wrap ul li').find('a').hover(function(){
		$(this).stop(true).animate({opacity : 1}, 200);
	}, function(){
		$(this).animate({opacity:0.7}, 200);
	});
});

//			Footer Twitter

$(document).ready(function(){
	var twitter = $('#footer-twitter').find('.twitter');
	twitter.find('.inner_wrap:first-child').fadeIn(1000, function() {
		$(this).addClass('selected');
		function changeTweets() {
			var current = twitter.find('.selected');
			function next() {
				if ( current.next().is('.inner_wrap') ) {
					current.next().fadeIn(1000).addClass('selected');
				}
				else {
					current.parent().children(':first-child').fadeIn(1000).addClass('selected');
				}
			}
			current.fadeOut(1000, next).removeClass('selected');
		}
		var timer = setInterval( changeTweets, 5000);
		twitter.click( changeTweets );
		twitter.hover(function(){
			$(this).css('cursor', 'pointer');
			clearInterval(timer);
		}, function(){
			$(this).css('cursor', 'default');
			timer = setInterval( changeTweets, 5000);
		});
	});
});

$(document).ready(function(){
	if ( $('body .content_wrapper').css("padding-top") === "1px" ){
		$('body .content_wrapper').addClass('no-sidebar');
	}
});

$(window).resize(function(){
	if ( $('body .content_wrapper').css("padding-top") === "1px" ){
		$('body .content_wrapper').addClass('no-sidebar');
	}
});

})(jQuery);

	// Ajax Load
	function allaround_ajaxload(currentItem) {
		"use strict";
		var oldItem = currentItem.parent().parent().parent();
		oldItem.css('opacity', '0.33');
		var string = oldItem.attr('data-string');
		var stringClass = oldItem.attr('class');
		var stringClassType = '';
		var actionSend = '';
		if ( stringClass.indexOf('blog_content') >= 0 ) { stringClassType = stringClass.replace('blog_content ', ''); actionSend = 'allaround_ajaxload_send'; }
		else { stringClassType = stringClass.replace('products_wrapper ', ''); actionSend = 'allaround_ajaxload_products_send'; }
		var ajaxPage = currentItem.text();
		var data = {
			action: actionSend,
			page: ajaxPage,
			type: stringClassType,
			data: string,
			ajax: 'yes'
		};
		jQuery.post(AllAround.ajaxurl, data, function(response) {
			if (response) {
				oldItem.after(response);
				var newItem = oldItem.next();
				newItem.css('display', 'none');
				oldItem.fadeOut(function() {
					newItem.fadeIn();
					oldItem.remove();
				});
				newItem.find("a[rel^='prettyPhoto']").prettyPhoto();
				newItem.find('.image_wrapper').append('<div class="image_shader"></div>');
				newItem.find('.image_wrapper').hover(function(){
					var padd = 10, wid = 21;
					if(jQuery(this).find('.image_more_info.small').length > 0) {
						padd = 8; wid = 16;
					}
					jQuery(this).find('.image_more_info a img').stop(true).animate({padding:padd+'px', width:(wid)+'px'}, 200, function(){
						jQuery(this).animate({width:wid+'px'}, 200);
						});
					jQuery(this).find('.image_shader').stop(true).animate({opacity: 0.6}, 200);
					jQuery(this).find('.image_socials a').each(function(index){
						var del = index*100;
						jQuery(this).find('span').delay(del).animate({top : 0}, 200);
					});
					jQuery(this).find('.image_read_more_wrapper').animate({opacity : 1}, 400);
				}, function(){
					jQuery(this).find('.image_more_info a img').stop(true).animate({padding:'0px', width:'0px'}, 100);
					jQuery(this).find('.image_shader').stop(true).animate({opacity: 0}, 200);
					jQuery(this).find('.image_socials a span').stop(true).animate({top : '40px'}, 200);
					jQuery(this).find('.image_read_more_wrapper').stop(true).animate({opacity: 0}, 200);
				});
				newItem.find('.products_sidebar a').each(function(index){
						jQuery(this).hover(function(){
						jQuery('.image_wrapper.prod').eq(index).trigger('mouseenter');

					}, function(){
						jQuery('.image_wrapper.prod').eq(index).trigger('mouseleave');

					});

				});

				newItem.find('.button_hover_effect, .button').hover(function(){
					var hoverClr = AllAround.lightercolor;
					jQuery(this).stop(true).animate({'background-color': hoverClr}, 300);

				}, function(){
					var bgClr = AllAround.color;
					jQuery(this).stop(true).animate({'background-color': bgClr}, 300);
				});

			} else {
				alert('fail');
			}
		});
	}