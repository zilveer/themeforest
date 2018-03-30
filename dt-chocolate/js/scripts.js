
//jQuery.noConflict();



jQuery.extend(jQuery.browser,
	{SafariMobile : navigator.userAgent.toLowerCase().match(/iP(hone|od|ad)/i) }
);

jQuery(function ($){

	if ( typeof dt_ajax.home_static_data != 'undefined' ) {

		setTimeout( function() {
			$.supersized({
				slides : dt_ajax.home_static_data.slides
			});
		}, 500 );
	} else if ( typeof dt_ajax.home_slider_data != 'undefined' ) {

		$.supersized({

			// Functionality
			slideshow               :   1,			// Slideshow on/off
			autoplay				:	dt_ajax.home_slider_data.dt_autoplay,			// Slideshow starts playing automatically
			start_slide             :   1,			// Start slide (0 is random)
			stop_loop				:	0,			// Pauses slideshow on last slide
			random					: 	0,			// Randomize slide order (Ignores start slide)
			slide_interval          :   dt_ajax.home_slider_data.dt_interval,		// Length between transitions
			transition              :   dt_ajax.home_slider_data.dt_transition, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed		:	700,		// Speed of transition
			new_window				:	1,			// Image links open in new window/tab
			pause_hover             :   0,			// Pause slideshow on hover
			keyboard_nav            :   1,			// Keyboard navigation on/off
			performance				:	0,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
			image_protect			:	1,			// Disables image dragging and right click with Javascript
													   
			// Size & Position						   
			min_width		        :   0,			// Min width allowed (in pixels)
			min_height		        :   0,			// Min height allowed (in pixels)
			vertical_center         :   1,			// Vertically center background
			horizontal_center       :   1,			// Horizontally center background
			fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
			fit_portrait         	:   dt_ajax.home_slider_data.portrait,			// Portrait images will not exceed browser height
			fit_landscape			:   dt_ajax.home_slider_data.landscape,			// Landscape images will not exceed browser width
													   
			// Components							
			thumb_links				:	1,			// Individual thumb links for each slide
			thumbnail_navigation    :   0,			// Thumbnail navigation
													   
			// Components							
			slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
			slides 					:  	dt_ajax.home_slider_data.slides
		});

		Cufon('#slidecounter > span', {
			color: '-linear-gradient(#4a443c, #7a6d5c)', textShadow: '1px 1px #000'
		});
		Cufon('#slidecaption', {
			color: '-linear-gradient(#bfbcb7, #f5f2eb)', textShadow: '1px 1px #000'
		});

	} else if ( typeof dt_ajax.home_slider3d_data != 'undefined' ) {

		window.slides3D = dt_ajax.home_slider3d_data.slides;
	}

/* masonry: begin */

	if(jQuery.support.transition) {
		window.masonryAnimated = false;
	} else {
		window.masonryAnimated = true;
	}

	var fix_masonry = true, // "true" required for masonry adequate work in mobile layouts
		$multicol = $('#multicol');

	if (fix_masonry == true) {
		$multicol.imagesLoaded( function(){
			masonry_apply();
		});
	} else {
		masonry_apply();
	}

	function masonry_apply(){

		if (($('.article_box', $multicol).length > 0) && ($('.folio_box').length <= 0)) {
			$multicol.masonry({
				columnWidth: 240, 
				itemSelector: '.article_box',
				isAnimated: masonryAnimated, 
				animationOptions: {
					duration: 500,
					easing: 'linear'
				}
			});
		} else if (($('.folio_box').not('.article .folio_box').length > 0) && ($('.article_box', $multicol).length <= 0)){
			$multicol.masonry({
				columnWidth: 240, 
				itemSelector: '.folio_box',
				isAnimated: masonryAnimated,
				animationOptions: {
					duration: 500,
					easing: 'linear'
				}
			});
		} else if (($('.folio_box').not('.article .folio_box').length > 0) && ($('.article_box', $multicol).length > 0)) {
			$multicol.masonry({
				columnWidth: 240, 
				itemSelector: '.folio_box, .article_box',
				isAnimated: masonryAnimated,
				animationOptions: {
					duration: 500,
					easing: 'linear'
				}
			});
		}

	}
/* masonry: end */
});

jQuery(function ($) {
	hs.graphicsDir = dt_ajax.hs_graphicsDir;

   $(".hs_me").each(function () {
	  this.onclick = function () {
		 return hs.expand(this, config1);
	  };
   });
});

(function( $ ) {
jQuery.fn.attachHs = function(is_gallery) {
   if ( 2 == is_gallery) {

		if ($(this).hasClass("hs_done")) {
		} else {
			var group_id = $(this).parents('.hidden').eq(1).attr("class").replace('hidden post_', 'gal_group_');
			var slideshow_options_new = {};
			$.extend(slideshow_options_new, slideshow_options);
			slideshow_options_new.slideshowGroup = group_id;
			hs.addSlideshow(slideshow_options_new);
		}


		$(this).each(function () {

			if ($(this).hasClass("hs_done")) {
				return;
			} else {
				$(this).addClass("hs_done");
			}

			var link = $(this);

			link[0].onclick = function () {
				return hs.expand(this, {slideshowGroup: group_id, transitions: ['expand', 'crossfade']});
			};

			$(this).click(function () {
				$(link).trigger("onclick");
				return false;
			});		 

		});
   }else if( is_gallery ) {
		$(this).each(function () {
		 if ($(this).hasClass("hs_done"))
			return;
		 $(this).addClass("hs_done");
		 
		 
		 /*var link = $(this).children("a")[0];
		 if ( $(link).length > 0 )
		 {
			console.log(this)
			this.onclick = function () {
			   $(link).trigger("click");
			};
			link.onclick = function () {
				return hs.expand(this, config1);
			};
		 }
		 else
		 {
			this.onclick = function () {
			   return hs.expand(this, config1);
			};
		 }*/
		 
		var link = $('> a', this);

		link[0].onclick = function () {
			return hs.expand(this, config1);
		};

		$(this).click(function () {
			$(link).trigger("onclick");
			return false;
		});
		 
	  });
   }
   else
   {
	  $(this).each(function () {
		 if ($(this).hasClass("hs_done"))
			return;
		 $(this).addClass("hs_done");
		 $(this).unbind('click');
		 this.onclick = function () {
			return hs.expand(this, {
			   src: $(this).attr("href")
			});
		 }
	  });
   }
};
})( jQuery );
// menu

jQuery(function ($) {

/*	$('#nav li ul').css({
		'display': 'block'
	});*/

	$("#big-image img").each(function () {
	   var rel = $(this).attr("alt");
	   rel = rel.split('|');
	   $(this).attr("width", rel[0]);
	   $(this).attr("height", rel[1]);
	   $(this).attr("w", rel[0]);
	   $(this).attr("h", rel[1]);
	});

	$(".with_href").each(function () {
	   $(this).attr("href", $(this).children("a").attr("href"));
	});
	
	$("#multicol > .hidden, .to_end").each(function () {
	   var e = $(this).detach();
	   e.appendTo( $("body") );
	});
	
	if (!menu_cl)
	{
	   $("#nav a").each(function () {
		  var parent = $(this).parent().parent().parent().parent().children("a");
		  if ( parent.not( $("#nav a") ).length ) return;
		  parent.css('cursor', 'default').click(function () {
			 return false;
		  });
	   });
	}
});


// menu
var menu_timeout_open = false;
var menu_timeout_close = false;

jQuery(function ($) {

	/*var menu_speed_show = 300;
	var menu_show_timeout = 150;
	var menu_hide_timeout = 400;

	$("#nav li").each(function () {
		var sub_ul = $(this).children("div");

		var new_left = 162;
		var init_left = 182;

		sub_ul.css("display", "none");

		$(this).hover(function () {
			var $this = $(this);
			$this.addClass("hovered");
			console.log("li hovered")

			setTimeout(function () {
				if ($this.hasClass("hovered")) {
					if ($.browser.msie && $.browser.version < 9) {
						sub_ul.show();
					} else {
						if (!$this.hasClass("was-hovered")) {
							sub_ul.css({
								display: 'block',
								opacity: 0,
								left: init_left
							}).stop().animate({
								opacity: 1,
								left: new_left
							}, {
								duration: menu_speed_show,
								queue: false,
								complete: function () {
									if ($.browser.msie) this.style.removeAttribute('filter');
								}
							});
						}
					}
				}
			}, menu_show_timeout);
		}, function () {
			var $this = $(this);
			$this.removeClass("hovered").addClass("was-hovered");

			setTimeout( function() {
				if (!$this.hasClass("hovered")) {
					if ($.browser.msie && $.browser.version < 9) {
						sub_ul.hide();
					} else {
						sub_ul.stop().animate({
							opacity: 0
						}, {
							duration: menu_speed_show/1.5,
							queue: false,
							complete: function () {
								sub_ul.hide();
							}
						});
					}
					$this.removeClass("was-hovered")
				}
			}, menu_hide_timeout);
		});
	});

	$("#nav").hover(function () { },function () {
		//$("#nav div").hide();
		if (menu_timeout_open) clearTimeout(menu_timeout_open);
		if (menu_timeout_close) clearTimeout(menu_timeout_close);
	});*/

	/*$("#nav div").each(function () {
		var tout_hide = false;
		var d = $(this);
		d.hover(function () {
			if (tout_hide) clearTimeout(tout_hide);
		}, function () {
			tout_hide = setTimeout(function () {
				d.hide();
			}, 500);
		});
	});*/

	$("#nav li div").parent().each(function() {
		var $this = $(this);

		var menuTimeoutShow,
			menuTimeoutHide;
			var new_left = 162;
			var init_left = 182;

		$this.on("mouseenter tap", function(e) {
			if(e.type == "tap") e.stopPropagation();

			var $this = $(this);
			$this.addClass("dt-hovered");
			
			clearTimeout(menuTimeoutShow);
			clearTimeout(menuTimeoutHide);

			menuTimeoutShow = setTimeout(function() {
				if($this.hasClass("dt-hovered")){
					$this.children('div').stop()
					.css({
						visibility: 'visible',
						opacity: 0,
						left: init_left
					}).animate({
						"opacity": 1,
						left: new_left
					}, 200);
				}
			}, 150);
		});

		$this.on("mouseleave", function(e) {
			var $this = $(this);
			$this.removeClass("dt-hovered");

			clearTimeout(menuTimeoutShow);
			clearTimeout(menuTimeoutHide);

			menuTimeoutHide = setTimeout(function() {
				if(!$this.hasClass("dt-hovered")){
					$this.children("div").stop().animate({
						"opacity": 0
					}, 150, function() {
						$(this).css("visibility", "hidden");
					});
					
					setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							$this.children("div").removeClass("right-overflow");
						}
					}, 200);
				}
			}, 200);

			$this.find("> a").removeClass("dt-clicked");
		});

	});
	
	
//Android menu click
	$('#nav li').each(function(){
		if ($(this).find("div").length > 0) {
			$(this).addClass('children');
		}
		else{
			$(this).removeClass('children');
		}
	});
	var isiPhone = function (){
		return (
			(navigator.platform.indexOf("iPhone") != -1) ||
			(navigator.platform.indexOf("iPod") != -1)
		);
	};
	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
	
	var deviceAgent = navigator.userAgent.toLowerCase();
	var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
	if( isAndroid || isiPhone() || agentID ) {
		$('body').addClass('for-mob');
	// find the mobiles devices user-agent names

		// see whether device supports touch events (a bit simplistic, but...)
		var hasTouch = ("ontouchstart" in window);
		 
		// hook touch events for drop-down menus
		// NB: if has touch events, then has standards event handling too
		if (hasTouch && document.querySelectorAll) {
			var i, len, element,
				dropdowns = document.querySelectorAll("#nav li.children");
		 
			function menuTouch(event) {
				// toggle flag for preventing click for this link
				var i, len, noclick = !(this.dataNoclick);
		 
				// reset flag on all links
				for (i = 0, len = dropdowns.length; i < len; ++i) {
					dropdowns[i].dataNoclick = false;
				}		 
				// set new flag value and focus on dropdown menu
				this.dataNoclick = noclick;
				this.focus();
			}
		 
			function menuClick(event) {
				// if click isn't wanted, prevent it
				if (this.dataNoclick) {
					event.preventDefault();
				}
			}
		 
			for (i = 0, len = dropdowns.length; i < len; ++i) {
				element = dropdowns[i];
				element.dataNoclick = false;
				element.addEventListener("touchstart", menuTouch, false);
				element.addEventListener("click", menuClick, false);
			}
		}			
		
	}
	else{		
		$('body').removeClass('for-mob');
	}


});

// end menu


// flickr animations
jQuery(function ($) {
   $(".flickr").each(function () {
	  var ee = $(this);
	  ee.parent().hover(function () {
	  },
	  function () {
		 $("i", ee).animate({
			opacity: 0
		 }, {
			duration: 300,
			queue: false
		 });
	  });
	  $("i", ee).hover(function () {
		 $(this).animate({
			opacity: 0
		 }, {
			duration: 300,
			queue: false
		 });      
		 $("i", ee).not( $(this) ).animate({
			opacity: 0.4
		 }, {
			duration: 300,
			queue: false
		 });
	  }, function () {
		 
	  });
   });
});
// end flickr animations

// go up arrow
jQuery(function ($) {
   $(".go_up").click(function () {
	  $("html:not(:animated)"+( ! $.browser.opera ? ",body:not(:animated)" : "")).animate({scrollTop: 0}, 500);
	  return false;
   });
});
// end go up arrow

// form validation
jQuery(function($) {
	window.update_form_validation = function() {

		$("[placeholder]").each(function () {
			$(this).val( $(this).val().replace( $(this).attr("placeholder"), '' ) );
			$(this).unbind().placeholder();
		});

		var $form = $( 'form.uniform' );

		$form.validationEngine('detach').validationEngine( {
			binded: false,
			promptPosition: 'topRight',
			scroll: false,
			autoHidePrompt: false,
			onValidationComplete: function( form, status ) {
				var $form = $(form);

				// If validation success
				if ( status ) {

					if ( !$form.hasClass('ajax') && !$form.hasClass('ajaxing') ) {
						return true;
					}

					$.post(
						dt_ajax.ajaxurl,
						{
							// action function
							action : 'dt_check_current_date',

							send_contacts: $('input[name="send_contacts"]', $form).val(),
							send_message: $('input[name="send_message"]', $form).val(),
							f_name: $('input[name="f_name"]', $form).val(),
							f_email: $('input[name="f_email"]', $form).val(),
							f_phone: $('input[name="f_phone"]', $form).val(),
							f_website: $('input[name="f_website"]', $form).val(),
							f_comment: $('textarea[name="f_comment"]', $form).val(),
							cptch_number: $('input[name="cptch_number"]', $form).val(),
							pid: $('input[name="p_id"]', $form).val(),
							nonce: $('input[name="dt_contact_form_nonce"]', $form).val()

						},
						function( response ){
							$('input[name="dt_contact_form_nonce"]', $form).val(response.nonce);
							// $.validationEngine.closePrompt(".formError",true);
							$('.dt_captcha', $form).html(response.captcha);

							if( 0 == $form.parent().find('div.ajaxSubmit').length ) {
								$form.before("<div class='ajaxSubmit'></div>");
							}

							$form.parent().find('div.ajaxSubmit').html(response.errors).show("slow");

							if( response.success ) {
								$form.find('input, textarea').not('input[type="hidden"]').each(function () {
									$(this).val("").unbind();
								});
							}
						}
					);

				}
			} // onValidationComplete
		} );

		$("form .go_button, form .do_add_comment").unbind().click(function () {

			$(this).parents("form").find("input, textarea").each(function () {
				$(this).val( $(this).val().replace( $(this).attr("placeholder"), '' ) ).unbind().placeholder();
			});

			$(".formError").remove();

			var e = $(this).parents("form");
			e.find("input, textarea").each(function () {
				$(this).unbind();
				$(this).val( $(this).val().replace( $(this).attr("placeholder"), "" ) );
			});

			e.attr("valed", "1");

			e.submit();

			e.find("input, textarea").each(function () {
				$(this).placeholder();
			});

			return false;
		});

		/*$("form .go_button, form .do_add_comment").unbind().click(function () {

			$(this).parents("form").find("input, textarea").each(function () {
				$(this).val( $(this).val().replace( $(this).attr("placeholder"), '' ) ).unbind().placeholder();
			});

			$(".formError").remove();

			var e=$(this).parents("form");
			e.find("input, textarea").each(function () {
				$(this).unbind();
				$(this).val( $(this).val().replace( $(this).attr("placeholder"), "" ) );
			});

			if (!e.attr("valed")) {
				if (!e.hasClass("ajax") && !e.hasClass("ajaxing")) {
					e.validationEngine();
				} else {
					e.validationEngine({
						ajaxSubmit: true,
						ajaxSubmitFile: e.attr("action")
					});
				}
			}

			e.attr("valed", "1");
			e.submit(); 
			e.find("input, textarea").each(function () {
				$(this).placeholder();
			});

			return false;
		});*/

		$("form .do_clear").unbind().click(function (e) {
			$(this).parents("form").find('input:not([type="hidden"]), textarea').each(function () {
				$(this).val("").unbind().placeholder();
			});
			$(".formError").remove();

			if ($(this).attr("remove") && !$(this).parents("#form_prev_holder").length) {
				move_form_to( $("#form_prev_holder") );
				$("#form_holder .do_clear").removeAttr('remove');
			}

			return false;
		});
	}
});

jQuery(function($) {
	$(update_form_validation);
});
// end form validation

// comments form
jQuery(function($) {
	
window.move_form_to = function(ee)
{
	  var e = $("#form_holder").html();
	  var tt = $("#form_holder .header").text();
	  
	  var to_slide_up = ($(".comment_bg #form_holder").length ? $("#form_holder") : $(".share_com"));
	  
	  to_slide_up.slideUp(500, function () {
		 $("#form_holder").remove();
		 
		 ee.append('<div id="form_holder">'+e+'</div>');
		 $("#form_holder .header").html(tt);
		 $("#form_holder [valed]").removeAttr('valed');
		 $("#form_holder .do_clear").attr('remove', 1);
		 
		 if (Cufon) Cufon('#form_holder .header', {
			 fontWeight: 'bold',
			 color: '-linear-gradient(#f5f2eb, 0.5=#f5f2eb, 0.8=#acaaa4, #acaaa4)', textShadow: '-1px -1px #000'
		 });
		 
		 $(".formError").remove();
		 
		 $("#form_holder").hide();
		 
		 to_slide_up = ($(".comment_bg #form_holder").length ? $("#form_holder") : $(".share_com"));
		 if (to_slide_up.hasClass('share_com')) $("#form_holder").show();
		 
		 to_slide_up.slideDown(500);
		 
		 if (ee.attr("id") != "form_prev_holder")
		 {
			$("#comment_parent").val( ee.parent().attr("id").replace('comment-', '') );
		 }
		 else
		 {
			$("#comment_parent").val("0");
		 }
		 
		 update_form_validation();
	  });
}
});
jQuery(function ($) {
   $(".comment .comments").click(function () {
	  move_form_to( $(this).parent().parent() );
	  return false;
   });
});
// end comments form

// albums

var folio_caption_fade_speed = 300;
var folio_mask_fade_slidedown_speed = 300;
var folio_desc_fade_speed = 300;

var folio_photos_bg_fade_speed = 1000;
var folio_photos_gal_fade_speed = 500;


var albums_scroll	= 750;
var albums_fade		= 750;
var photos_fade		= 750;
var refresh_height	= 751;

var prev_scroll_top = 0;

jQuery(function($){

window.update_photos_events = function() {

	var $photos_holder	= $('.multipics', current_album),
		$gallery_holder	= $(".big_gallery", current_album);

	$gallery_holder.css({
		"display":"block",
		'visibility': 'visible',
		"opacity":0
	}).show();
	
	if(!$photos_holder.hasClass("masonry")) {
		$photos_holder.children("a").each(function() {
			var href = $(this).attr('href');
			var src = $(this).attr('data-src');
			var width = $(this).attr('data-width');
			var height = $(this).attr('data-height');
	//		var caption = $.trim($(this).text());
			var style = 'style="background: url(\''+src+'\')"';
			var new_html = '<a href="'+ href +'" class="go_pic size_s" '+style+' title=""><img src="'+ src +'" width="'+ width +'" height="'+ height +'" alt="" /><i></i></a>';
	//		new_html = new_html + '<div class="highslide-caption">'+ caption +'</div>';
			$(this).replaceWith(new_html);
		});

		$photos_holder.masonry({
			columnWidth: 240, 
			itemSelector: ".go_pic",
			isAnimated: masonryAnimated
		});		
	} else {
		$photos_holder.masonry("reload");
	}

	if (Cufon) Cufon('.big_gallery h1', {
		fontWeight: 'bold',
		color: '-linear-gradient(#f5f2eb, 0.3=#f5f2eb, #a6a39d)', textShadow: '0 -2px #000'
	});

	if (Cufon) Cufon('.go_back', {
		fontWeight: 'bold',
		color: '-linear-gradient(#473e2b, 0.4=#473e2b, #1c1a19)', textShadow: '0 1px #fff'
	});


	$(".go_back", $gallery_holder).unbind().click(function () {
		
		clearTimeout(window.galTimer);
		$(window).off(".inGal");

		if ($.browser.opera) $(document).unbind('mousewheel');

		$gallery_holder.fadeOut(photos_fade, function () {

			$(window).scrollTop(0);
			$("#bg").show();
			$('body').css({
				'height': 'auto'
			});
			
			$("#multicol").masonry("reload");
			$("#widget-container").masonry("reload");

			if ((prev_scroll_top/2) <= 300) {
				albums_scroll = 300;
			} else if ((prev_scroll_top/2) > 300 && (prev_scroll_top/2) <= 1500) {
				albums_scroll = prev_scroll_top/2;
			} else if ((prev_scroll_top/2) > 1500) {
				albums_scroll = 1500;
			}

			$(".big_gallery_bg", current_album).fadeOut(albums_fade, function () {
				$("html:not(:animated)"+( ! $.browser.opera ? ",body:not(:animated)" : ""))
				.animate({
					scrollTop: prev_scroll_top
				}, albums_scroll);
			});
		});

		return false;
	});


   if ($.browser.msie && $.browser.version < 9) {
	} else {
	  
	  $(".multipics a i").css({
		 display: 'block',
		 opacity: 0
	  });
	  
	  $(".multipics a, .galonelvel").hover(function () {
		 $("i", this).animate({
			opacity: 1
		 }, {
			duration: 500,
			queue: false
		 });
	  },
	  function () {
		 $("i", this).animate({
			opacity: 0
		 }, {
			duration: 500,
			queue: false
		 });
	  });
   }
	
   $(".go_pic", current_album).each(function () {
	  $(this).attr("rel", "gal[g]");//.attr("title",  "");
   });

   $("a[rel=gal\\[g\\]]", current_album).attachHs(2);
	
}

});

var current_album = false;

jQuery(function ($) {
	if ( !$(".folio").length ) return;

	$(".folio").each(function () {
		if ($(this).parent().hasClass('galonelvel')) return;
		
		var box = $(this);
		
		box.click(function (e) {
			if( $(e.target).parents('form', box).is('form') ) return true;

			var p_href = $(this).parent().attr("href");

			if (p_href && $(this).parent().hasClass("portfolio")) {
				if( p_href != '#' )	window.location.href = p_href;
				return false;
			}

			var cl = box.parent().attr("class").replace(/^.*for_(post_[0-9]+).*$/, '$1');
			current_album = $("." + cl);
			
			if (!current_album.length) {
				alert("Album not found (."+cl+")");
				return false;
			}

			prev_scroll_top = $(window).scrollTop();

			$(".big_gallery", current_album).hide();

			$(".big_gallery_bg", current_album)
			.hide()
			.fadeIn(albums_fade, function () {

				$(window).scrollTop(0);
				//$("html:not(:animated)"+( ! $.browser.opera ? ",body:not(:animated)" : "")).animate({scrollTop: 0}, 500, function() {
					$("#bg").hide();
				//});
				update_photos_events();

				galListener = function() {
					clearTimeout(window.galTimer);
					window.galTimer = false;
					window.galTimer = setTimeout(function() {
						var hh =  $(".big_gallery", current_album).outerHeight();
						if ( hh < $(window).height() ) {
							hh = $(window).height();
						}
						$("body").css({
							"height": hh+"px"
						});
					}, refresh_height);
				};

				$(".big_gallery", current_album).animate({"opacity":1}, photos_fade, function(){
					$(window).on("resize.inGal", galListener).trigger("resize");
				});
			});
			return false;
		});


	  box.hover(function () {
		 if ($.browser.msie && $.browser.version < 9)
		 {
			$(".folio_just_caption", box).css({
			   visibility: 'hidden'
			});
			$(".folio_mask", box).css({
			   display: 'block',
			   height: '100%'
			});
			console.log('ie8')
		 }
		 else
		 {
			$(".folio_just_caption", box).transition({
			   opacity: 0
			}, folio_caption_fade_speed);
			var to_height = $(".folio_mask", box).css('height', '100%').height();
			$(".folio_mask .folio_desc", box).hide();
			$(".folio_mask", box).css({
			   display: 'block',
			   height: 0,
			   opacity: 0
			}).transition({
			   height: to_height,
			   opacity: 1
			}, folio_mask_fade_slidedown_speed, function () {
				  $(".folio_desc", box).css({
					 display: 'block',
					 opacity: 0
				  }).transition({
					 opacity: 1
				  }, folio_desc_fade_speed,function () {
						if ($.browser.msie && $.browser.version < 9) this.style.removeAttribute('filter');
					 }
				  );
			});
		 }
	  }, function () {
		 if ($.browser.msie && $.browser.version < 9)
		 {
			$(".folio_just_caption", box).css({
			   visibility: 'visible'
			});
			$(".folio_mask", box).css({
			   display: 'none',
			   height: '100%'
			});
		 }
		 else
		 {
			$(".folio_mask", box).transition({
			   height: 0,
			   opacity: 0
			}, folio_mask_fade_slidedown_speed);
			$(".folio_just_caption", box).transition({
			   opacity: 1
			}, folio_caption_fade_speed);
		 }
	  });
   });
});
// end albums


jQuery(function ($) {
/*    $('.folio, .folio_mask, .folio_caption, .folio_just_caption').each(function() {
		if ($.browser.msie) PIE.attach(this);
	});
*/    
	$(".galonelvel").unbind().attr("rel", "gal\\[b\\]").addClass('prettyPhoto').attachHs(1);
   
   $(".wp-post-image").parent().addClass('prettyPhoto');
	
   $(".prettyPhoto").attachHs();
   
   if ($.browser.msie && $.browser.version < 9) {
   } else {
	  
	  $(".galonelvel i").css({
		 display: 'block',
		 opacity: 0
	  });
	  
	  $(".galonelvel").hover(function () {
		 $("i", this).animate({
			opacity: 1
		 }, {
			duration: 500,
			queue: false
		 });
	  },
	  function () {
		 $("i", this).animate({
			opacity: 0
		 }, {
			duration: 500,
			queue: false
		 });
	  });
   }
   
   $("#slider ul li i").css({
	  display: 'block',
	  opacity: 0.2
   });
   
   $("#slider ul li a").hover(function () {
	  $("i", this).animate({
		 opacity: 0
	  }, {
		 duration: 500,
		 queue: false
	  });
   },
   function () {
	  $("i", this).animate({
		 opacity: 0.2
	  }, {
		 duration: 500,
		 queue: false
	  });
   });
});

// for test
jQuery(function ($) {
   //$(".folio:first").click();
});


jQuery(function($) {
	$(".toggle a.question").click(function (event) {
		event.preventDefault(); 
		$(this).toggleClass("act");
		$(this).next("div.answer").slideToggle("fast");
	});
});

jQuery(function($) {
	window.simple_tooltip = function(target_items, name){
	 $(target_items).each(function(i){
			$("body").append("<div class='"+name+"' id='"+name+i+"'>"+$(this).find('span.tooltip_c').html()+"</div>");
			var my_tooltip = $("#"+name+i);
	
			$(this).removeAttr("title").mouseover(function(){
						my_tooltip.css({opacity:1, display:"none"}).fadeIn(400);
			}).mousemove(function(kmouse){
					var border_top = $(window).scrollTop();
					var border_right = $(window).width();
					var left_pos;
					var top_pos;
					var offset = 15;
					if(border_right - (offset *2) >= my_tooltip.width() + kmouse.pageX){
						left_pos = kmouse.pageX+offset;
						} else{
						left_pos = border_right-my_tooltip.width()-offset;
						}
	
					if(border_top + (offset *2)>= kmouse.pageY - my_tooltip.height()){
						top_pos = border_top +offset;
						} else{
						top_pos = kmouse.pageY-my_tooltip.height()-2.2*offset;
						}
	
					my_tooltip.css({left:left_pos, top:top_pos});
			}).mouseout(function(){
					my_tooltip.css({left:"-9999px"});
			});
		});
	}
});


jQuery(function($){
	 simple_tooltip(".tooltip","tooltip_cont");
	 $(".cont_butt").click(function ()
	 {
		//$("#order_form").submit();
		return false;
	 });
	  if ($.validationEngine) {
		 $(".valForm, .uniform").each(function () {
			return;
			if ( $(this).attr("valed") ) return;
			$(this).attr("valed", "1").validationEngine({
			   ajaxSubmit: true,
			   ajaxSubmitFile: window.location.href
			});
		 });
	  }
});

jQuery(function($){
	$('div.framed').wrapInner( '<div />');
});

/*jQuery(function ($){
	var win_w = $(window).width()-350;
	$('.jp-progress').css({width:win_w});
});*/

//jQuery('#JPlayer').find('display').css('zIndex', '999');


jQuery(function ($){
	Cufon.CSS.ready(function() {
		var right_s = $('.static #pg_desc2 div, .video #pg_desc2 div').width() - $('.static #pg_desc1 div, .video #pg_desc1 div').width() + 20;
		var b = 70 +  $('.static #pg_desc2 div, .video #pg_desc2 div').height();

		$('.static #pg_desc1 div').css( {'right' : right_s , 'bottom' : b} );
		$('.static #pg_desc2 div').css( {'right' : 20, 'bottom' : 60 } );

		$('.video #pg_desc1 div').css( {'right' : right_s , 'bottom' : b} );
		$('.video #pg_desc2 div').css( {'right' : 20 , 'bottom' : 60} );

		Cufon('#pg_desc2 div h2', {
			color: '-linear-gradient(#1c1a19, #473e2b)', textShadow: '1px 1px #ffffff'
		});
	});
}); 


jQuery(function ($) {
	function resize_mask_on_video(){
		var w_h = $(window).height();
		
		var w_w = $(window).width();
		
		var n_h = $(window).height()-39;
		
	
	/*	$(".video #JPlayer_wrapper").css({
			height: w_h,
			width: w_w
		});*/
		$(".video.jw #big-mask").css({
			"min-height": 0,
			height: n_h
		});
	/*	$(".video #JPlayer, .video #JPlayer *").css({
			height: w_h,
			width: w_w
		});*/
	}
	
	resize_mask_on_video();
	$(window).resize(function () {
		resize_mask_on_video();
	});

	if ($.browser.SafariMobile){
		$("td.sound").css({
			"display" : "none"
		});
	}

});
// window.ResizeTurnOff = true;
jQuery(function($){
	if(ResizeTurnOff){
		$('body').addClass('notResponsive');
	}else{
		$('body').removeClass('notResponsive');
		
		if (moveWidgets === true) {
			$(window).resize(function(){
				var winW = $(window).width();
	
				if (winW < 964) {
					
					//alert(winW)
	
					$("html").removeClass("full-layout").addClass("mobile-layout");
					
					var $widgetsContainer	= $("#aside_c > #widget-container"),
						$widgets			= $("> .widget", $widgetsContainer),
						$contentArea		= $("#content");
		
					if ($widgets.length > 0 && $contentArea.length > 0) {
		
						$widgetsContainer.detach().appendTo($contentArea);
		
						$('#widget-container:not(.masonry)').masonry({
							columnWidth: 240, 
							itemSelector: '.widget',
							isAnimated: masonryAnimated, 
							animationOptions: {
								duration: 500,
								easing: 'linear'
							}
						});
					}
				} else {
					//alert(winW)
					$("html").removeClass("mobile-layout").addClass("full-layout");
		
					var $widgetsContainer	= $("#content > #widget-container"),
						$widgets			= $("> .widget", $widgetsContainer);
		
					if ($widgets.length > 0) {				
						$widgetsContainer.detach().appendTo("#aside_c");
					}
				}
			}).trigger("resize");
		}
	
		$("#header-mobile option").each(function(){
			var $this	= $(this),
				text	= $this.text(),
				prefix	= "";
	
			switch ( parseInt($this.attr("data-level"))) {
				case 1:
					prefix = "";
				break;
				case 2:
					prefix = "— ";
				break;
				case 3:
					prefix = "—— ";
				break;
				case 4:
					prefix = "——— ";
				break;
				case 5:
					prefix = "———— ";
				break;
			}
			
			$this.text(prefix+text);
	
		});
	
		$("#header-mobile select").change(function() {
			window.location.href = $(this).val();
		});
		
		 if($('#bg').length){}
		 else{
			 window.hideHeader = function() {
				if ($(window).width() < 740) {
					$("#header-mobile").stop().animate({
						"top" : -$("#header-mobile").outerHeight() - 60
					}, 700);
				}
			}
			
			window.showHeader = function() {
				if ($(window).width() < 740) {
					$("#header-mobile").stop().animate({
						"top" : 0
					}, 700);
				}
			}
			
			$(document).on('touchmove', function(e) { if ($(window).width() < 1000) e.preventDefault(); });
			if ($.browser.SafariMobile){
		
				$(window).on("orientationchange",  function() {
				
					if(window.orientation == 90 || window.orientation == -90) {
						$("html, body, #holder, .pg_content, #pg_preview").not('.page-template-home-video-php').css({
							"min-height" : "315px"
						});
						
					} else {
						$("html, body, #holder, #pg_preview, .pg_content.video").not('.page-template-home-video-php').css({
							"min-height" : "490px"
						});			
					}
				
					setTimeout(scrollTo, 0, 0, 1);
					$(window).trigger("resize");
				
				}).trigger("orientationchange");
		
				setInterval( function() {$(window).trigger("orientationchange");}, 3000);	
			}
			//hide show header on iphone
			$(document).wipetouch({
				preventDefault: false,
				wipeLeft: function(result) {
					hideHeader();
				},
				wipeRight: function(result) {
					hideHeader();
				},
				wipeUp: function(result) {
					hideHeader();
				},
				wipeDown: function(result) { 
					showHeader();
				}
			});
		 }
	}

});