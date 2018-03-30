/**
 * UpSolution Widget: w-search
 */
!function ($) {
	"use strict";

	$.fn.wSearch = function () {

		return this.each(function(){
			var $container = $(this),
				$form = $container.find('.w-search-form'),
				$btnOpen = $container.find('.w-search-open'),
				$btnClose = $container.find('.w-search-close'),
				$input = $form.find('[name="s"]'),
				$overlay = $container.find('.w-search-background'),
				$window = $(window),
				searchOverlayInitRadius = 25,
				showHideTimer = null,
				isFullScreen = $container.hasClass('layout_fullscreen'),
				searchHide = function(){
					$container.removeClass('active');
					$input.blur();
					if (isFullScreen) {
						$form.css({
							'-webkit-transition': 'opacity 0.4s',
							transition: 'opacity 0.4s'
						});
						window.setTimeout(function(){
							$overlay
								.removeClass('overlay-on')
								.addClass('overlay-out')
								.css({
									'-webkit-transform': 'scale(0.1)',
									'transform': 'scale(0.1)'
								});
							$form.css('opacity', 0);
							clearTimeout(showHideTimer);
							showHideTimer = window.setTimeout(function(){
								$form.css('display', 'none');
								$overlay.css('display', 'none');
							}, 700);
						}, 25);
					}
				};

			// Handling virtual keyboards at touch devices
			if (isFullScreen && jQuery.isMobile){
				$input
					.on('focus', function(){
						// Transforming hex to rgba
						var originalColor = $overlay.css('background-color'),
							overlayOpacity = $overlay.css('opacity'),
							matches;
						// RGB Format
						if (matches = /^rgb\((\d+), (\d+), (\d+)\)$/.exec(originalColor)){
							$form.css('background-color', "rgba("+parseInt(matches[1])+","+parseInt(matches[2])+","+parseInt(matches[3])+", "+overlayOpacity+")");
						}
						// Hex format
						else if (matches = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/.exec(originalColor)){
							$form.css('background-color', "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+", "+overlayOpacity+")");
						}
						// Fault tolerance
						else {
							$form.css('background-color', originalColor);
						}
						$overlay.addClass('mobilefocus');
					})
					.on('blur', function(){
						$overlay.removeClass('mobilefocus');
						$form.css('background-color', 'transparent');
					});
			}

			$btnOpen.click(function(){

				$container.addClass('active');

				if (isFullScreen) {
					var searchPos = $btnOpen.offset(),
						searchWidth = $btnOpen.width(),
						searchHeight = $btnOpen.height();
					// Preserving scroll position
					searchPos.top -= $window.scrollTop();
					searchPos.left -= $window.scrollLeft();
					var overlayX = searchPos.left+searchWidth/2,
						overlayY = searchPos.top+searchHeight/2,
						winWidth = $us.canvas.winWidth,
						winHeight = $us.canvas.winHeight,
					// Counting distance to the nearest screen corner
						overlayRadius = Math.sqrt(Math.pow(Math.max(winWidth - overlayX, overlayX), 2) + Math.pow(Math.max(winHeight - overlayY, overlayY), 2)),
						overlayScale = (overlayRadius+15)/searchOverlayInitRadius;

					$overlay.css({
						width: searchOverlayInitRadius*2,
						height: searchOverlayInitRadius*2,
						left: overlayX,
						top: overlayY,
						"margin-left": -searchOverlayInitRadius,
						"margin-top": -searchOverlayInitRadius
					});
					$overlay
						.removeClass('overlay-out')
						.show();
					$form.css({
						opacity: 0,
						display: 'block',
						'-webkit-transition': 'opacity 0.4s 0.3s',
						transition: 'opacity 0.4s 0.3s'
					});
					window.setTimeout(function(){
						$overlay
							.addClass('overlay-on')
							.css({
								"-webkit-transform": "scale(" + overlayScale + ")",
								"transform": "scale(" + overlayScale + ")"
							});
						$form.css('opacity', 1);
						clearInterval(showHideTimer);
						showHideTimer = window.setTimeout(function() {
							$input.focus();
						}, 700);
					}, 25);
				} else {
					showHideTimer = window.setTimeout(function() {
						$input.focus();
					}, 700);
				}

			});

			$input.keyup(function(e) {
				if (e.keyCode == 27) searchHide();
			});

			$btnClose.on('click touchstart', searchHide);
		});
	};

	$(function(){
		jQuery('.l-header .w-search').wSearch();
	});
}(jQuery);


/**
 * UpSolution Widget: w-tabs
 */
!function( $ ){

	// Extending some of the methods for material design animations
	$us.WTabs.prototype._init = $us.WTabs.prototype.init;
	$us.WTabs.prototype.init = function(container, options){
		this.$tabsBar = $();
		this.curTabWidth = 0;
		this.tabHeights = [];
		this.tabTops = [];
		this._init(container, options);
	};
	$us.WTabs.prototype._cleanUpLayout = $us.WTabs.prototype.cleanUpLayout;
	$us.WTabs.prototype.cleanUpLayout = function(from){
		this._cleanUpLayout(from);
		if (from == 'default' || from == 'ver'){
			this.$tabsBar.remove();
		}
	};
	$us.WTabs.prototype._prepareLayout = $us.WTabs.prototype.prepareLayout;
	$us.WTabs.prototype.prepareLayout = function(to){
		this._prepareLayout(to);
		if (to == 'default' || to == 'ver'){
			this.$tabsBar = $('<div class="w-tabs-list-bar"></div>').appendTo(this.$tabsList);
		}
	};
	$us.WTabs.prototype._measure = $us.WTabs.prototype.measure;
	$us.WTabs.prototype.measure = function(){
		this._measure();
		if (this.basicLayout == 'default'){
			this.minWidth = Math.max.apply(this, this.tabWidths) * this.count;
			this.curTabWidth = this.tabs[0].outerWidth(true);
		}
		else if (this.basicLayout == 'ver'){
			this.tabHeights = [];
			for (var index = 0; index < this.tabs.length; index++){
				this.tabHeights.push(this.tabs[index].outerHeight(true));
				this.tabTops.push(index ? (this.tabTops[index-1] + this.tabHeights[index-1]) : 0);
			}
		}
	};
	// Counts bar position for certain element index and current layout
	$us.WTabs.prototype.barPosition = function(index){
		if (this.curLayout == 'default'){
			var barStartOffset = this.curTabWidth * index,
				barEndOffset = this.curTabWidth * (this.count - index - 1);
			return {
				left: this.isRtl ? barEndOffset : barStartOffset,
				right: this.isRtl ? barStartOffset : barEndOffset
			};
		}
		else if (this.curLayout == 'ver'){
			return {
				top: this.tabTops[index],
				height: this.tabHeights[index]
			};
		}
		else {
			return {};
		}
	};
	$us.WTabs.prototype._openSection = $us.WTabs.prototype.openSection;
	$us.WTabs.prototype.openSection = function(index){
		this._openSection(index);
		if (this.curLayout == 'default' || this.curLayout == 'ver' || this.curLayout == 'modern' || this.curLayout == 'trendy'){
			this.$tabsBar.performCSSTransition(this.barPosition(index), this.options.duration, null, this.options.easing);
		}
	};
	$us.WTabs.prototype._resize = $us.WTabs.prototype.resize;
	$us.WTabs.prototype.resize = function(){
		this._resize();
		if (this.curLayout == 'default' || this.curLayout == 'ver' || this.curLayout == 'modern' || this.curLayout == 'trendy'){
			this.$tabsBar.css(this.barPosition(this.active[0]), this.options.duration, null, this.options.easing);
		}
	};

	jQuery('.w-tabs').wTabs();

}(jQuery);

/**
 * UpSolution Widget: w-blog
 */
!function( $ ){
	// TODO Make proper reveal grid animation for "load more"
	$us.WBlog.prototype.beforeAppendItems = function($items){
		//this.$list.addClass('animate_revealgrid');
		//$items.addClass('animate_reveal');
	};
	$us.WBlog.prototype.afterAppendItems = function($items){
		//$items.revealGridMD();
	};
	$(function(){
		$('.w-blog').wBlog();
	});
}(jQuery);

/**
 * UpSolution Widget: w-portfolio
 */
jQuery(function($){
	// TODO Make proper reveal grid animation for "load more"
	$us.WPortfolio.prototype.itemLoaded = function(itemID){
		if (this.$container.hasClass('animate_revealgrid')) {
			this.items[itemID].usMod('animate', false).css('opacity', 0);
		}
	};
	$us.WPortfolio.prototype.itemsLoaded = function($items){
		if (this.$container.hasClass('animate_revealgrid')) {
			$items.revealGridMD();
		}
	};

	$('.w-portfolio').wPortfolio();
});

// Fixing contact form 7 semantics, when requested
jQuery('.wpcf7').each(function(){
	var $form = jQuery(this);

	// Removing wrong newlines
	$form.find('br').remove();

	// Fixing quiz layout
	$form.find('.w-form-row .wpcf7-quiz').each(function(){
		var $input = jQuery(this),
			$row = $input.closest('.w-form-row'),
			$field = $row.find('.w-form-row-field:first'),
			$label = $row.find('.wpcf7-quiz-label');
		$label.insertBefore($field).attr('class', 'w-form-row-label');
		$input.unwrap();
	});

	// Removing excess wrappers
	$form.find('.w-form-row-field > .wpcf7-form-control-wrap > .wpcf7-form-control').each(function(){
		var $input = jQuery(this);
		if (($input.attr('type')||'').match(/^(text|email|url|tel|number|date|quiz|captcha)$/) || $input.is('textarea')){
			// Moving wrapper classes to .w-form-field, and removing the span wrapper
			var wrapperClasses = $input.parent().get(0).className;
			$input.unwrap();
			$input.parent().get(0).className += ' '+wrapperClasses;
		}
	});

	// Transforming submit button
	$form.find('.w-form-row-field > .wpcf7-submit').each(function(){
		var $input = jQuery(this),
			classes = $input.attr('class').split(' '),
			value = $input.attr('value') || '';
		$input.siblings('p').remove();
		if (jQuery.inArray('w-btn', classes) == -1){
			classes.push('w-btn');
		}
		var buttonHtml = '<button id="message_send" class="'+classes.join(' ')+'">' +
			'<div class="g-preloader"></div>' +
			'<span class="w-btn-label">'+value+'</span>' +
			'<span class="ripple-container"></span>' +
			'</button>';
		$input.replaceWith(buttonHtml);
	});

	// Adjusting proper wrapper for select controller
	$form.find('.wpcf7-form-control-wrap > select').each(function(){
		var $select = jQuery(this);
		if ( ! $select.attr('multiple')) $select.parent().addClass('type_select');
	});

	jQuery('<span class="w-form-row-field-bar"></span>').appendTo($form.find('.wpcf7-form-control-wrap'));

	$form.on('mailsent.wpcf7', function(){
		$form.find('.w-form-row.not-empty').removeClass('not-empty');
	});
});


// Zephyr special Material Design animations
jQuery(function($){
	"use strict";

	/**
	 * Material Design Ripples
	 */
	var $body = document.body || document.documentElement,
		$bodyStyle = $body.style,
		isTransitionsSupported = $bodyStyle.transition !== undefined || $bodyStyle.WebkitTransition !== undefined;
	var removeRipple = function($ripple) {
		$ripple.off();
		if (isTransitionsSupported) {
			$ripple.addClass("ripple-out");
		} else {
			$ripple.animate({
				"opacity": 0
			}, 100, function() {
				$ripple.trigger("transitionend");
			});
		}
		$ripple.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
			$ripple.remove();
		});
	};

	$.fn.mdRipple = function(){
		return this.each(function(){
			var $element = $(this),
				$container, containerOffset,
				startTimer = null;

			if ( ! $element.find('.ripple-container').length){
				$element.append('<span class="ripple-container"></span>');
			}

			$container = $element.find(".ripple-container");

			// Storing last touch event for touchEnd coordinates
			var lastTouch = null;
			if ($.isMobile){
				$element.on('touchstart touchmove', function(e){
					e = e.originalEvent;
					if (e.touches.length === 1) {
						lastTouch = e.touches[0];
					}
				});
			}

			$element.on($.isMobile ? 'touchend' : 'mouseup', function(e){
				var offsetLeft, offsetTop, offsetRight,
					$ripple = $('<span class="ripple"></span>'),
					rippleSize = Math.max($element.outerWidth(), $element.outerHeight()) / Math.max(20, $ripple.outerWidth()) * 2.5;

				containerOffset = $container.offset();

				// get pointer position
				if ( ! $.isMobile){
					offsetLeft = e.pageX - containerOffset.left;
					offsetTop = e.pageY - containerOffset.top;
				} else if (lastTouch !== null) {
					offsetLeft = lastTouch.pageX - containerOffset.left;
					offsetTop = lastTouch.pageY - containerOffset.top;
					lastTouch = null;
				} else {
					return;
				}

				if ($('body').hasClass('rtl')) {
					offsetRight = $container.width() - offsetLeft;
					$ripple.css({right: offsetRight, top: offsetTop});
				}else{
					$ripple.css({left: offsetLeft, top: offsetTop});
				}

				(function() { return window.getComputedStyle($ripple[0]).opacity; })();
				$container.append($ripple);

				startTimer = setTimeout(function(){
					$ripple.css({
						"-webkit-transform": "scale(" + rippleSize + ")",
						"transform": "scale(" + rippleSize + ")"
					});
					$ripple.addClass('ripple-on');
					$ripple.data('animating', 'on');
					$ripple.data('mousedown', 'on');
				}, 25);

				setTimeout(function() {
					$ripple.data('animating', 'off');
					removeRipple($ripple);
				}, 700);

			});
		});
	};

	// Initialize MD Ripples
	jQuery('.w-btn, .w-nav-anchor, .w-portfolio-item-anchor, .w-tabs-item, .w-gallery-item, .g-filters-item, a > .w-blog-post-preview, .w-person.layout_card .w-person-image a, .w-iconbox.style_circle a .w-iconbox-icon, .cl-btn').mdRipple();

	/**
	 * Material Design Reveal Grid: Show grid items with hierarchical timing
	 * @param {Function} onFinish Function to call when the overall grid is revealed
	 */
	$.fn.revealGridMD = function(onFinish){
		var items = $(this),
			shown = false,
			isRTL = $('.l-body').hasClass('rtl');
		if (items.length == 0) return;
		var countSz = function(){
			// The vector between the first item and the opposite x/y
			var mx = isRTL ? 100000 : 0,
				my = 0;
			// Retrieving items positions
			var sz = items.map(function(){
				var $this = jQuery(this),
					pos = $this.position();
				pos.width = $this.width();
				pos.height = $this.height();
				// Center point
				pos.cx = pos.left + parseInt(pos.width / 2);
				pos.cy = pos.top + parseInt(pos.height / 2);
				mx = Math[isRTL?'min':'max'](mx, pos.cx);
				my = Math.max(my, pos.cy);
				return pos;
			});
			var wx = mx - sz[0].cx,
				wy = my - sz[0].cy,
				wlen = Math.abs(wx * wx + wy * wy);
			// Counting projection lengths
			for (var i = 0; i < sz.length; i++) {
				// Counting vector to this item
				var vx = sz[i].cx - sz[0].cx,
					vy = sz[i].cy - sz[0].cy;
				sz[i].delta = (vx * wx + vy * wy) / wlen;
			}
			return sz;
		};
		var sz = countSz();
		items.css('opacity', 0).each(function(i, item){
			var $item = $(item);
			$item.performCSSTransition({
				opacity: 1
			}, 400, function(){
				$item.removeClass('animate_reveal');
				if (onFinish && typeof onFinish == 'function' && i == items.length - 1) onFinish();
			}, null, 750 * sz[i].delta);
		});
	};

	$('.animate_revealgrid').each(function(){
		$us.scroll.addWaypoint($(this), '15%', function($elm){
			var $items = $elm.find('.animate_reveal');
			if ($us.$body.hasClass('disable_effects')) return $items.removeClass('animate_reveal');
			$items.revealGridMD(function(){
				// Compatibility with isotope
				if ( ! $.fn.isotope) return;
				var isotope = $items.parent().data('isotope');
				if (isotope){
					$.each(isotope.items, function(index, item){
						item.disableTransition();
					});
				}
			});
		});
	});
});

jQuery(function($){
	$('.w-tabs .rev_slider').each(function(){
		var $slider = $(this);
		$slider.bind("revolution.slide.onloaded",function (e) {
			$us.canvas.$container.on('contentChange', function(){
				$slider.revredraw();
			});
		});
	});
});
