var $j = jQuery.noConflict();
var scroll = 0;

$j(document).ready(function() {
	"use strict";
	
	dropDownMenu();

	dropDownMenu2();
	
	setDropDownMenuPosition();

	selectMenu();

	placeholderReplace();

	addPlaceholderSearchWidget();

	initCounter();

	initToCounter();

	prettyPhoto();

	initFlexSlider();
	
	loadMore();
	
	fitVideo();

	initMessages();

	initAccordion();
	
	initNiceScroll();

	initElements();

	initListAnimation();

	initDoughnutProgressBar();

	initDoughnutProgressBar2();

	initProgressBars();

	initProgressBarsVertical();
	
	backButtonInterval();
	
	backToTop();
	
	initParallax(parallax_speed);
	
	languageMenu();
	
	initServiceAnimation();
	
	checkIfBrowserIsSafariMac();
});

$j(window).load(function(){
	"use strict";

	magicPanes();
	$j('.touch .main_menu li:has(div.second)').doubleTapToGo(); // load script to close menu on youch devices
	logo_height = $j('.logo img').height();
	setLogoHeightOnLoad();
	checkLogOnSmallestSize();
	$j('.logo a').css('visibility','visible');

	scroll = $j(window).scrollTop();
	if($j(window).width() > 768){
		headerSize(scroll);
	}

	initProjects();
	initBlog();
	initSetPortfolioOverlayHightAndWidth();
	initPortfolioHover();
	initPortfolioGalleryHover();
	initPortfolioSingleInfo();
	initImageWithTextOver();
	initTabs();
	setSidebarBackgroundColor();
});

$j(window).scroll(function() {
	"use strict";

	scroll = $j(window).scrollTop();
	if($j(window).width() > 768 && $j('.no_fixed').length === 0){
		headerSize(scroll);
	}
});

$j(window).resize(function() {
	"use strict";

	magicPanes();
	setDropDownMenuPosition();
	checkLogOnSmallestSize();
	initSetPortfolioOverlayHightAndWidth();
	setSidebarBackgroundColor();
	initImageWithTextOver();
	initPortfolioHover();
	initPortfolioGalleryHover();
});

function dropDownMenu(){
	"use strict";
	
	var menu_items = $j('.no-touch .drop_down > ul > li');

	menu_items.each( function(i) {

		if ($j(menu_items[i]).find('.second').length > 0) {
		
			$j(menu_items[i]).data('original_height', $j(menu_items[i]).find('.second').height() + 'px');
			$j(menu_items[i]).find('.second').hide();
			
			$j(menu_items[i]).mouseenter(function(){
				$j(menu_items[i]).find('.second').css({'visibility': 'visible','height': '0px', 'opacity': '0', 'display': 'block'});
				$j(menu_items[i]).find('.second').stop().animate({'height': $j(menu_items[i]).data('original_height'),opacity:1}, 500, function() {
					$j(menu_items[i]).find('.second').css('overflow', 'visible');
					
				});

				dropDownMenuThirdLevel();
			}).mouseleave( function(){
				$j(menu_items[i]).find('.second').stop().animate({'height': '0px'},0, function() {
					$j(menu_items[i]).find('.second').css({'overflow': 'hidden', 'visivility': 'hidden', 'display': 'none'});				
				});
			});
		}
	});
}

function dropDownMenuThirdLevel(){
	"use strict";

	var menu_items2 = $j('.no-touch .drop_down ul li > .second > .inner > .inner2 > ul > li');
	menu_items2.each( function(i) {
		if ($j(menu_items2[i]).find('ul').length > 0) {
			var sum=0;
			$j(menu_items2[i]).find('ul li').each( function(){ sum+=$j(this).height();});
			
			$j(menu_items2[i]).data('original_height', sum + 'px');
			
			var size2 = $j(menu_items2[i]).find('ul > li').size()*10 + 100;
			$j(menu_items2[i]).mouseenter(function(){
				$j(menu_items2[i]).find('ul').css({'visibility': 'visible','height': '0px', 'opacity':'0', 'display': 'block', 'padding': '10px 0'});
				$j(menu_items2[i]).find('ul').stop().animate({'height': $j(menu_items2[i]).data('original_height'),opacity:1}, size2, function() {
					$j(menu_items2[i]).find('ul').css('overflow', 'visible');
				});
			}).mouseleave(function(){
				$j(menu_items2[i]).find('ul').stop().animate({'height': '0px'},0, function() {
					$j(menu_items2[i]).find('ul').css({'overflow': 'hidden', 'padding': '0'});
					$j(menu_items2[i]).find('.second').css('visivility', 'hidden');
				});
			});
		}
	});
}

function setDropDownMenuPosition(){
	"use strict";

	var menu_items = $j('.drop_down > ul > li');

	menu_items.each( function(i) {

		var browser_width = $j(window).width();
		var menu_item_position = $j(menu_items[i]).offset().left;
			var sub_menu_width = $j('.drop_down .second .inner2 ul').width();
			var u = browser_width - menu_item_position + 30;
			var m;
			
			if($j(menu_items[i]).find('li.sub').length > 0){
				m = browser_width - menu_item_position - sub_menu_width + 30;
			}

			if(u < sub_menu_width || m < sub_menu_width){
				$j(menu_items[i]).find('.second').addClass('right');
				$j(menu_items[i]).find('.second .inner .inner2 ul').addClass('right');
			}
	});
}

function dropDownMenu2(){
	"use strict";
	
	var widget_width = $j('.header_right_widget').width();
	var margin = -1000 - widget_width;

	$j('.drop_down2 .second').css({'margin-left': margin, 'margin-right': margin});

	$j('.no-touch .drop_down2 > ul > li').each(function(){
		
		var height = $j(this).find('.second').height();	

		$j(this).mouseenter(function(){
			$j(this).find('.second').height(0);
			$j(this).find('.second').css({'visibility': 'visible', 'z-index': '100'});
			$j(this).find('.second').stop().animate({height:height+20},400);
		}).mouseleave(function(){
			$j(this).find('.second').css('z-index','90');
			$j(this).find('.second').stop().animate({height:0},400,function(){
				$j(this).css('visibility','hidden');
				$j(this).height(0);
			});
		});	
	});
}

function selectMenu(){
	"use strict";

	var $menu_select = $j("<div class='select'><ul></ul></div>");
	$menu_select.appendTo(".selectnav");
	
	if($j(".main_menu").hasClass('drop_down')){
		$j(".main_menu ul li a").each(function(){
			var menu_url = $j(this).attr("href");
			var menu_text = $j(this).text();
			if ($j(this).parents("li").length === 2) { menu_text = "&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length === 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length > 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }
			
			var li = $j("<li />");
			var link = $j("<a />", {"href": menu_url, "html": menu_text});
			link.appendTo(li);
			li.appendTo($menu_select.find('ul'));
		});
	} else if($j(".main_menu").hasClass('drop_down2')){
		$j(".main_menu ul li a").each(function(){
			var menu_url = $j(this).attr("href");
			var menu_text = $j(this).text();
			if ($j(this).parents("div.mc").length === 1) { menu_text = "&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).hasClass('sub')) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }
			
			var li = $j("<li />");
			var link = $j("<a />", {"href": menu_url, "html": menu_text});
			link.appendTo(li);
			li.appendTo($menu_select.find('ul'));
		});
	}
	
	$j(".selectnav_button span").click(function () {
		if ($j(".select ul").is(":visible")){
			$j(".select ul").slideUp();
		} else {
			$j(".select ul").slideDown();
		}
	});
	
	$j(".selectnav ul li a").click(function () {
		$j(".select ul").slideUp();
	});
}

function languageMenu(){
	"use strict";
	
	var lang_item = $j('.header_right_widget #lang_sel > ul > li');
	
		if ($j(lang_item).find('ul').length > 0) {
			
			$j(lang_item).data('original_height', $j(lang_item).find('ul').height() + 'px');
			$j(lang_item).find('ul').hide();
			
			$j(lang_item).mouseenter(function(){
				$j(lang_item).find('ul').css({'visibility': 'visible','height': '0px', 'opacity': '0', 'display': 'block'});
				$j(lang_item).find('ul').stop().animate({'height': $j(lang_item).data('original_height'),opacity:1}, 400, function() {
					$j(lang_item).find('.second').css('overflow', 'visible');
					
				});
			}).mouseleave( function(){
				$j(lang_item).find('ul').stop().animate({'height': '0px'},0, function() {
					$j(lang_item).find('ul').css({'overflow': 'hidden', 'visivility': 'hidden', 'display': 'none'});				
				});
			});
		}
	
}

function checkLogOnSmallestSize(){
	"use strict";
	
	if($j(window).width() < 768){
		if(logo_height >= 80){
			$j('.logo a').height(70);
			$j('.logo').css('padding','5px 0px 5px 0px');
			
		}else{
			var padding = (80-logo_height)/2;
			$j('.logo').css('padding',padding+'px 0px');
		}
	}else{
		$j('.logo').css('padding','0px');
	}
}

function placeholderReplace(){
	"use strict";

	$j('[placeholder]').focus(function() {
		var input = $j(this);
		if (input.val() === input.attr('placeholder')) {
			if (this.originalType) {
				this.type = this.originalType;
				delete this.originalType;
			}
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = $j(this);
		if (input.val() === '') {
			if (this.type === 'password') {
				this.originalType = this.type;
				this.type = 'text';
			}
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();

	$j('[placeholder]').parents('form').submit(function () {
		$j(this).find('[placeholder]').each(function () {
			var input = $j(this);
			if (input.val() === input.attr('placeholder')) {
				input.val('');
			}
		});
	});
}

function addPlaceholderSearchWidget(){
	"use strict";
	
	$j('.header_right_widget #searchform input:text').each(
		function(i,el) {
			if (!el.value || el.value === '') {
				el.placeholder = 'Search';
			}
	});
}

function initCounter(){
	"use strict";
	
	if($j('.counter.type2').length){
		$j('.counter.type2').each(function() {
			$j(this).appear(function() {
				$j(this).parent().css('opacity', '1');
				$j(this).absoluteCounter({
					speed: 2000,
					fadeInDelay: 1000
				});
			},{accX: 0, accY: -200});
		});
	}
}

(function($) {
	"use strict";

	$.fn.countTo = function(options) {
		// merge the default plugin settings with the custom options
		options = $.extend({}, $.fn.countTo.defaults, options || {});

		// how many times to update the value, and how much to increment the value on each update
		var loops = Math.ceil(options.speed / options.refreshInterval),
		increment = (options.to - options.from) / loops;

		return $(this).each(function() {
			var _this = this,
			loopCount = 0,
			value = options.from,
			interval = setInterval(updateTimer, options.refreshInterval);

			function updateTimer() {
				value += increment;
				loopCount++;
				$(_this).html(value.toFixed(options.decimals));

				if (typeof(options.onUpdate) === 'function') {
					options.onUpdate.call(_this, value);
				}

				if (loopCount >= loops) {
					clearInterval(interval);
					value = options.to;

					if (typeof(options.onComplete) === 'function') {
						options.onComplete.call(_this, value);
					}
				}
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,  // the number the element should start at
		to: 100,  // the number the element should end at
		speed: 1000,  // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,  // the number of decimal places to show
		onUpdate: null,  // callback method for every time the element is updated,
		onComplete: null,  // callback method for when the element finishes updating
	};
})(jQuery);

function initToCounter(){
	"use strict";
	
	if($j('.counter.type1').length){
		$j('.counter.type1').each(function() {
			$j(this).appear(function() {
				$j(this).parent().css('opacity', '1');
				var $max = parseFloat($j(this).text());
				$j(this).countTo({
					from: 0,
					to: $max,
					speed: 1500,
					refreshInterval: 50
				});
			},{accX: 0, accY: -200});
		});
	}
}

function magicPanes(){
	"use strict";

	var $magicLine = $j("#magic");
	var $menulinks = $j(".main_menu > ul > li");
	if($j(".main_menu .active").length > 0){
		
		$j('body').removeClass('menuHoverOn');
		
		$magicLine.width($j(".active").outerWidth(true)).css("left", $j(".active").position().left);
		$magicLine.width($j(".active").outerWidth(true) - 30).css("left", $j(".active").position().left + 15).data("origLeft", $magicLine.position().left).data("origWidth", $magicLine.width());
		
		var $el;
		var $leftPos;
		var $newWidth;
		$menulinks.mouseenter(function() {
			$el = $j(this);
			$leftPos = $el.position().left;
			$newWidth = $el.outerWidth(true);
			
			return $magicLine.stop().animate({
				left: $leftPos,
				width: $newWidth
			},300);
			
		}).mouseleave(function() {
			
			return $magicLine.stop().animate({
				left: $magicLine.data("origLeft"),
				width: $magicLine.data("origWidth")
			}, 300);
		});
		
		$j('nav > ul > li a').each(function() {
			$j(this).click(function(){
				if($j(this).attr('href') !== "http://#" && $j(this).attr('href') !== "#"){
				
					$j('a').parent().removeClass('active');
					if($j(this).closest('.second').length === 0){
						$j(this).parent().addClass('active');
					}else{
						$j(this).closest('.second').parent().addClass('active');
					}
	
					$magicLine.data("origLeft", $leftPos + 15).data("origWidth", $newWidth - 30);
					$magicLine.stop().animate({
						left: $magicLine.data("origLeft"),
						width: $magicLine.data("origWidth")
					});
					
				}else{
					return false;
				}
			});
		});
	}else{
		$j('body').addClass('menuHoverOn');
	}
}

function initProjects(){
	"use strict";

	$j('.filter_holder').each(function(){
		var filter_height = 0;
		$j(this).find('li.filter').each(function(){
			filter_height += $j(this).height();
		});
		
		$j(this).on('click',function(data){
			var $drop = $j(this),
			$bro = $drop.siblings('.hidden');
			
			if(!$drop.hasClass('expanded')){
				$drop.find('ul').css('z-index','100');
				$drop.find('ul').height(28); //28 is height of first default item
				$drop.addClass('expanded');
			} else {
				$drop.find('ul').height(28);
				$drop.removeClass('expanded');
				
				var $selected = $j(data.target),
				ndx = $selected.index();
				
				if($bro.length){
					$bro.find('option').removeAttr('selected').eq(ndx).attr('selected','selected').change();
				}
			}
		});
	});
	
	$j('.projects_holder').mixitup({
		showOnLoad: 'all',
		transitionSpeed: 600,
		minHeight: 150,
		onMixEnd: function(){
			initSetPortfolioOverlayHightAndWidth();
			initPortfolioHover();
		}
	});

}

function initBlog(){
	"use strict";

	$j('.blog_holder_list').mixitup({
		showOnLoad: 'all',
		transitionSpeed: 600,
		minHeight: 200
	});
}

function prettyPhoto(){
	"use strict";		

	$j('a[data-rel]').each(function() {
		$j(this).attr('rel', $j(this).data('rel'));
	});

	$j("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: false, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		deeplinking: false,
		social_tools: false
	});
}

function initSetPortfolioOverlayHightAndWidth(){
	"use strict";

	if($j('.projects_type2 article').length > 0){
		$j('.projects_type2 article').each(function(){
			var width = $j(this).find('.image').width();
			var height = $j(this).find('.image').height();
			$j(this).find('.image_border').css({'width': width - 28, 'height': height - 14});
		});
	} 
}

function initFlexSlider(){
	"use strict";
	
	$j('.flexslider').flexslider({
		animationLoop: true,
		controlNav: false,
		useCSS: false,
		pauseOnAction: true,
		pauseOnHover: true,
		slideshow: true,
		animation: 'slides',
		animationSpeed: 600,
		slideshowSpeed: 8000,
		start: function(){
			setTimeout(function(){$j(".flexslider").fitVids();},100);
		}
	});
	
	$j('.flex-direction-nav a').click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		e.stopPropagation();
	});
}

var $scrollHeight;
function initPortfolioSingleInfo(){
	"use strict";

	var $sidebar   = $j(".portfolio_single_follow");
	if($j(".portfolio_single_follow").length > 0){
	
		var offset = $sidebar.offset();
		$scrollHeight = $j(".portfolio_container").height();
		var $scrollOffset = $j(".portfolio_container").offset();
		var $window = $j(window);
		var $menuLineHeight = 0;

		if($j('header.centered_logo').length > 0){
			$menuLineHeight = parseInt($j('.main_menu > ul > li > a').css('line-height'), 10) + 65; // 65 is logo height (45px logo and 20px margin)
		} else {
			$menuLineHeight = parseInt($j('.main_menu > ul > li > a').css('line-height'), 10);
		}
		
		$window.scroll(function() {
			if($window.width() > 960){
				if ($window.scrollTop() + $menuLineHeight + 3 > offset.top) {
					if ($window.scrollTop() + $menuLineHeight + $sidebar.height() + 24 < $scrollOffset.top + $scrollHeight) {
						$sidebar.stop().animate({
							marginTop: $window.scrollTop() - offset.top + $menuLineHeight
						});
					} else {
						$sidebar.stop().animate({
							marginTop: $scrollHeight - $sidebar.height() - 24
						});
					}
				} else {
					$sidebar.stop().animate({
						marginTop: 0
					});
				}		
			}else{
				$sidebar.css('margin-top',0);
			}
			
		});
	}
}

function loadMore(){
	"use strict";
	
	var i = 1;
	
	$j('.load_more a').on('click', function(e)  {
		e.preventDefault();
		
		var link = $j(this).attr('href');
		var $content = '.projects_holder';
		var $anchor = '.portfolio_paging .load_more a';
		var $next_href = $j($anchor).attr('href'); // Get URL for the next set of posts
		var filler_num = $j('.projects_holder .filler').length;
		$j.get(link+'', function(data){
			$j('.projects_holder .filler').slice(-filler_num).remove();
			var $new_content = $j($content, data).wrapInner('').html(); // Grab just the content
			$next_href = $j($anchor, data).attr('href'); // Get the new href
			$j('article.mix:last').after($new_content); // Append the new content
			
			var min_height = $j('article.mix:first').height();
			$j('article.mix').css('min-height',min_height);
			
			$j('.projects_holder').mixitup('remix','all');
			prettyPhoto();
			if($j('.load_more').attr('rel') > i) {
				$j('.load_more a').attr('href', $next_href); // Change the next URL
			} else {
				$j('.load_more').remove(); 
			}
			$j('.projects_holder .portfolio_paging:last').remove(); // Remove the original navigation
			$j('article.mix').css('min-height',0);
			initSetPortfolioOverlayHightAndWidth();
			initPortfolioHover();
		});
		i++;
	});
}

function fitVideo(){	
	"use strict";
	
	$j(".portfolio_images").fitVids();
	$j(".video_holder").fitVids();
}

function initPortfolioHover(){
	"use strict";

	if($j('.projects_type3 article').length > 0){
		$j('.projects_type3 article').each(function(){
			var $this = $j(this);

			var bottom = $this.find('.image').height();
			$this.find('.image .image_hover').css('bottom', -bottom);

			var top = $this.find('span.text_inner').height();
			$this.find('.image .text_holder').css('top', -top-10);
			$this.find('a.preview').css('top', -$this.find('a.preview').height());

			$this.find('.image').mouseenter(function(){
				$this.find('.image .image_hover').stop().animate({'bottom': '0px'}, 200, function(){
					$this.find('a.preview').stop().animate({'top': '0px'}, 300);
					$this.find('span.text_holder').stop().animate({'top': bottom/2-top/2}, 300);
				});	
			}).mouseleave(function(){
				$this.find('.image .image_hover').stop().animate({'bottom': -bottom}, 200);
				$this.find('a.preview').stop().animate({'top': -$this.find('a.preview').height()}, 100);
				$this.find('span.text_holder').stop().animate({'top': -top-10}, 100);
			});
		});
	}

	if($j('.projects_type1 article').length > 0){
		$j('.projects_type1 article').each(function(){
			var $this = $j(this);

			var bottom = $this.find('.image').height();
			$this.find('.image .image_hover').css('bottom', -bottom-2);

			var top = $this.find('span.text_inner').height();
			$this.find('.image .text_holder').css('top', -top-10);
			$this.find('a.preview').css('top', -top);

			$this.find('.image').mouseenter(function(){
				$this.find('.image .image_hover').stop().animate({'bottom': '0px'}, 200, function(){
					$this.find('a.preview').stop().animate({'top': '0px'}, 300);
					$this.find('span.text_holder').stop().animate({'top': bottom/2-top/2}, 300);
				});	
			}).mouseleave(function(){
				$this.find('.image .image_hover').stop().animate({'bottom': -bottom}, 200);
				$this.find('a.preview').stop().animate({'top': -top}, 100);
				$this.find('span.text_holder').stop().animate({'top': -top-10}, 100);
			});
		});
	}
}

function initPortfolioGalleryHover(){
	"use strict";

	if($j('.portfolio_gallery > a').length > 0){
		$j('.portfolio_gallery > a > span').css('visibility','visible');
		$j('.portfolio_gallery > a').each(function(){
			var $this = $j(this);

			var bottom = $this.find('img').height();
			$this.find('.image_hover').css('bottom', -bottom);

			var top = $this.find('span.text_inner').height();
			$this.find('.text_holder').css('top', -top-10);

			$this.mouseenter(function(){
				$this.find('.image_hover').stop().animate({'bottom': '0px'}, 200, function(){
					$this.find('span.text_holder').stop().animate({'top': bottom/2-top/2}, 300);
				});	
			}).mouseleave(function(){
				$this.find('.image_hover').stop().animate({'bottom': -bottom}, 200);
				$this.find('span.text_holder').stop().animate({'top': -top-10}, 100);
			});
		});
	}
}

function initImageWithTextOver(){
	"use strict";

	if($j('.image_with_text_over').length > 0){
		$j('.image_with_text_over').each(function(){
			var $this = $j(this);
				
			var bottom = $this.find('img').height();
			$this.find('.image_hover').css('bottom', -bottom);

			var top = $this.find('span.text_inner').height();
			$this.find('.text_holder').css('top', -top-10);
			
			$this.find('.text_holder').css('visibility', 'visible');
			$this.find('.image_hover').css('visibility', 'visible');
			
			$this.mouseenter(function(){
				$this.find('.image_hover').stop().animate({'bottom': '0px'}, 200, function(){
					$this.find('span.text_holder').stop().animate({'top': bottom/2-top/2}, 300);
				});	
			}).mouseleave(function(){
				$this.find('.image_hover').stop().animate({'bottom': -bottom}, 200);
				$this.find('span.text_holder').stop().animate({'top': -top-10}, 100);
			});
		});
	}
}

function initMessages(){
	"use strict";

	$j('.message').each(function(){
		$j(this).find('.close').click(function(e){
			e.preventDefault();
			$j(this).parent().fadeOut(500);
		});
	});
}

function initAccordion(){
	"use strict";
	
	if($j('.accordion').length){
		$j(".accordion").each(function(){
			var $this = $j(this);
			$this.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset")
			.find("h5")
			.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom")
			.hover(function() { $j(this).toggleClass("ui-state-hover"); })
			.click(function() {

			$j(this).parent().siblings().find('.accordion_content').slideUp(300).removeClass("ui-accordion-content-active");
			$j(this).parent().siblings().find('h5').removeClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom");
			$j(this)
				.toggleClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom")
				.next().toggleClass("ui-accordion-content-active").slideToggle(200);
				return false;
			})
			.next()
			.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom")
			.hide();
		});
	}
	
	if($j('.toggle').length){
		$j(".toggle").addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset")
		.find("h5")
		.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom")
		.hover(function() { $j(this).toggleClass("ui-state-hover"); })
		.click(function() {
		$j(this)
			.toggleClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom")
			.next().toggleClass("ui-accordion-content-active").slideToggle(200);
			return false;
		})
		.next()
		.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom")
		.hide();
	}
}

function initTabs(){
	"use strict";

	var $tabsNav = $j('.tabs-nav');
	var $tabsNavLis = $tabsNav.children('li');
	$tabsNav.each(function() {
		var $this = $j(this);
		$this.next().children('.tab-content').stop(true,true).hide().first().show();
		$this.children('li').first().addClass('active').stop(true,true).show();
	});
	$tabsNavLis.on('click', function(e) {
		var $this = $j(this);
		$this.siblings().removeClass('active').end().addClass('active');
		$this.parent().next().children('.tab-content').stop(true,true).hide().siblings( $this.find('a').attr('href') ).fadeIn();
		e.preventDefault();
	}); 
}

function initNiceScroll(){
	"use strict";

	if($j('.smooth_scroll').length){	
		$j("html").niceScroll({ 
			scrollspeed: 60, 
			mousescrollstep: 35, 
			cursorwidth: 16, 
			cursorborder: 0, 
			cursorcolor: "#424242", 
			cursorborderradius: 0, 
			autohidemode: !1, horizrailenabled: !1 
		});
	}
}

function initElements(){
	"use strict";

	if($j(".element_from_fade").length){
		$j('.element_from_fade').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_fade_on');	
			},{accX: 0, accY: -200});
		});
	}
	
	if($j(".element_from_left").length){
		$j('.element_from_left').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_left_on');	
			},{accX: 0, accY: -200});		
		});
	}
	
	if($j(".element_from_right").length){
		$j('.element_from_right').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_right_on');	
			},{accX: 0, accY: -200});
		});
	}
	
	if($j(".element_from_top").length){
		$j('.element_from_top').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_top_on');	
			},{accX: 0, accY: -200});
		});
	}
	
	if($j(".element_from_bottom").length){
		$j('.element_from_bottom').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_bottom_on');	
			},{accX: 0, accY: -200});			
		});
	}
	
	if($j(".element_transform").length){
		$j('.element_transform').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_transform_on');	
			},{accX: 0, accY: -200});	
		});
	}	
}

function initListAnimation(){
	"use strict";
	
	$j('.animate_list').each(function(){
		$j(this).appear(function() {
			$j(this).find("li").each(function (l) {
				var k = $j(this);
				setTimeout(function () {
					k.animate({
						opacity: 1,
						top: 0
					}, 1500);
				}, 100*l);
			});
		},{accX: 0, accY: -200});
	});
}

function initDoughnutProgressBar(){
	"use strict";
 
	if($j('.normal .percentage').length){
		$j('.normal .percentage').each(function() {

			var $barColor = '#69b200';

			if($j(this).data('active') !== ""){
				$barColor = $j(this).data('active');
			}

			var $trackColor = '#ededed';

			if($j(this).data('noactive') !== ""){
				$trackColor = $j(this).data('noactive');
			}

			var $line_width = 10;

			if($j(this).data('linewidth') !== ""){
				$line_width = $j(this).data('linewidth');
			}
			
			var $size = 133;

			$j(this).appear(function() {
				initToCounterPicChart($j(this));
				$j(this).parent().css('opacity', '1');
				
				$j(this).easyPieChart({
					barColor: $barColor,
					trackColor: $trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: $line_width,
					animate: 1500,
					size: $size
				}); 
			},{accX: 0, accY: -200});
		});
	}
}

function initDoughnutProgressBar2(){
	"use strict";
 
	if($j('.transparent .percentage').length){
		$j('.transparent .percentage').each(function() {

			var $barColor = '#69b200';

			if($j(this).data('active') !== ""){
				$barColor = $j(this).data('active');
			}

			var $trackColor = 'transparent';

			var $line_width = 10;

			if($j(this).data('linewidth') !== ""){
				$line_width = $j(this).data('linewidth');
			}

			var $size = 133;

			$j(this).appear(function() {
				initToCounterPicChartTransparent($j(this));
				$j(this).parent().css('opacity', '1');
				
				$j(this).easyPieChart({
					barColor: $barColor,
					trackColor: $trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: $line_width,
					animate: 1500,
					size: $size
				}); 
			},{accX: 0, accY: -200});
		});
	}
}

function initToCounterPicChart($this){
	"use strict";

		$j($this).css('opacity', '1');
		var $max = parseFloat($j($this).find('.tocounter').text());
		$j($this).find('.tocounter').countTo({
			from: 0,
			to: $max,
			speed: 1500,
			refreshInterval: 50
		});
		
	
}

function initToCounterPicChartTransparent($this){
	"use strict";
	
	$j($this).css('opacity', '1');
	var $max = parseFloat($j($this).find('.tocounter').text());
	$j($this).find('.tocounter').countTo({
		from: 0,
		to: $max,
		speed: 1500,
		refreshInterval: 50
	});
}

function initProgressBars(){
	"use strict";

	if($j('.progress_bars').length){
		$j('.progress_bars').each(function() {
			$j(this).appear(function() {
				initToCounterHorizontalProgressBar();
				$j(this).find('.progress_bar').each(function() {
					var percentage = $j(this).find('.progress_content').data('percentage');
					var percent_width = $j(this).find('.progress_number').width();
					$j(this).find('.progress_content').css('width', '0%');
					$j(this).find('.progress_content').animate({'width': percentage+'%'}, 2000);
					$j(this).find('.progress_number').css('width', percent_width+'px');
				});
			},{accX: 0, accY: -200});
		});
	}
}

function initToCounterHorizontalProgressBar(){
	"use strict";

	if($j('.progress_bars .progress_number span').length){
		$j('.progress_bars .progress_number span').each(function() {
			$j(this).parent().css('opacity', '1');
			var $max = parseFloat($j(this).text());
			$j(this).countTo({
				from: 0,
				to: $max,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

function totop_button(a) {
	"use strict";

	var b = $j("#back_to_top");
	b.removeClass("off on");
	if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
}

function backButtonInterval(){
	"use strict";

	window.setInterval(function () {
		var b = $j(this).scrollTop();
		var c = $j(this).height();
		var d;
		if (b > 0) { d = b + c / 2; } else { d = 1; }
		if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
	}, 300);
}

function backToTop(){
	"use strict";
	
	$j(document).on('click','#back_to_top',function(e){
		e.preventDefault();
		
		$j('body,html').animate({scrollTop: 0}, $j(window).scrollTop()/3, 'swing');
	});
}

function setSidebarBackgroundColor(){
	"use strict";
	
	var column_height1 = $j('.two_columns_66_33.background_color_sidebar > .column1').height();
	$j('.two_columns_66_33.background_color_sidebar > .column2').css('min-height', column_height1);

	var column_height2 = $j('.two_columns_75_25.background_color_sidebar > .column1').height();
	$j('.two_columns_75_25.background_color_sidebar > .column2').css('min-height', column_height2);
	
	var column_height3 = $j('.two_columns_33_66.background_color_sidebar > .column2').height();
	$j('.two_columns_33_66.background_color_sidebar > .column1').css('min-height', column_height3);
	
	var column_height4 = $j('.two_columns_25_75.background_color_sidebar > .column2').height();
	$j('.two_columns_25_75.background_color_sidebar > .column1').css('min-height', column_height4);
}

function initProgressBarsVertical(){
	"use strict";

	if($j('.progress_bars_vertical_holder').length){
		$j('.progress_bars_vertical_holder').each(function() {

			var progress_bar_number = 0;

			$j(this).find('.progress_bars_vertical').each(function(){
				progress_bar_number ++; 
			});

			$j(this).find('.progress_bars_vertical').css('width', 100/progress_bar_number-0.3 + '%');		

			$j(this).appear(function() {
				initToCounterVerticalProgressBar();
				$j(this).find('.progress_bars_vertical').each(function() {
					var percentage = $j(this).find('.progress_content').data('percentage');
					$j(this).find('.progress_content').css('height', '0%');
					$j(this).find('.progress_content').animate({
						height: percentage+'%'
					}, 1500);
				});
			},{accX: 0, accY: -200});
		});
	}
}

function initToCounterVerticalProgressBar(){
	"use strict";

	if($j('.progress_bars_vertical .progress_number span').length){
		$j('.progress_bars_vertical .progress_number span').each(function() {
			var $max = parseFloat($j(this).text());
			$j(this).countTo({
				from: 0,
				to: $max,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

function initParallax(speed){
	"use strict";
	
	if($j('.parallax section').length){
		if($j('html').hasClass('touch')){
			$j('.parallax section').each(function() {
				var $self = $j(this);
				var section_height = $self.data('height');
				$self.height(section_height);
				var rate = 0.5;
				
				var bpos = (- $j(this).offset().top) * rate;
				$self.css({'background-position': 'center ' + bpos  + 'px' });
				
				$j(window).bind('scroll', function() {
					var bpos = (- $self.offset().top + $j(window).scrollTop()) * rate;
					$self.css({'background-position': 'center ' + bpos  + 'px' });
				});
			});
		}else{
			$j('.parallax section').each(function() {
				var $self = $j(this);
				var section_height = $self.data('height');
				$self.height(section_height);
				var rate = (section_height / $j(document).height()) * speed;
				
				var distance = $j.elementoffset($self);
				var bpos = - (distance * rate);
				$self.css({'background-position': 'center ' + bpos  + 'px' });
				
				$j(window).bind('scroll', function() {
					var distance = $j.elementoffset($self);
					var bpos = - (distance * rate);
					$self.css({'background-position': 'center ' + bpos  + 'px' });
				});
			});
		}
		return this;
	}
	
}

$j.elementoffset = function($element) {
	"use strict";
	
	var fold = $j(window).scrollTop();
	return (fold) - $element.offset().top +104;
};

function initServiceAnimation(){
	"use strict";
	
	if($j(".fade_in_circle_holder").length){
		$j('.fade_in_circle_holder').each(function(){
			$j(this).appear(function(){
				$j(this).find('.fade_in_circle').addClass('animate_circle');
				$j(this).find('.fade_in_content').addClass('animate_content');
			},{accX: 0, accY: -200});
		});
	}
}

function checkIfBrowserIsSafariMac(){
	"use strict";
	
	if (navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Mac') !== -1 && navigator.userAgent.indexOf('Chrome') === -1) {	
		$j('html').addClass('safari-mac');
	}
}