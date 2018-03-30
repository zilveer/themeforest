(function($){
	"use strict";

	/**
	 * Set 'retina' cookie if on a retina device.
	 */
	if( document.cookie.indexOf('retina') === -1 && 'devicePixelRatio' in window && window.devicePixelRatio === 2 ){
		document.cookie = 'retina=' + window.devicePixelRatio + ';';
	}

	$(document).ready(function(){

		/**
		 * Main menu search bar expand/collpase.
		 */
		$('#menu-item-search').find('label').on('click', function(){
			$(this).find('.search-field').css('width', '200px');
			$(this).find('.search-field').css('padding', '21px 20px 21px 10px');
		});
		$('#menu-item-search').find('.search-field').on('blur, mouseout', function(){
			$(this).css('width', '0px');
			$(this).css('padding', '21px 0px');
		});

		stag_responsive_nav();
		static_content_backgrounds();

		var $section = $(".global-static-content");

		$section.each(function(){
			var $this = $(this),
				bgImage = $this.data('background-image'),
				bgColor = $this.data('background-color'),
				textColor = $this.data('text-color'),
				linkColor = $this.data('link-color'),
				bgOpacity = $this.data('opacity');

			$this.prepend('<div class="static-content-cover" />');
			$this.find('.static-content-cover').css({ 'background-image' : 'url('+bgImage+')', 'opacity' : bgOpacity/100, '-ms-filter': '"alpha(opacity='+bgOpacity+')"' });

			$section.css({
				"background-color": bgColor,
				"color": textColor
			});
			$section.find('a').css('color', linkColor);
			$section.find('h1, h2, h3, h4, h5, h6').css('color', textColor);
		});

		if( $('body').hasClass('wc-2-1') ) {
			$('.show_review_form').on('click', function(e){
				e.preventDefault();

				var tabs = $('.woocommerce-tabs');
				tabs.find('li').removeClass('active');
				tabs.find('.reviews_tab').addClass('active');

				tabs.find('.panel').hide();
				tabs.find('#tab-reviews').show();

				var offset = tabs.find('#tab-reviews').offset().top;

				$('html,body').animate({
					scrollTop: offset - 100
				});
			});
		}
	});

	function static_content_backgrounds() {
		$('.page-template').find('.widget-static-content').each(function(){
			var _this = $(this),
				bgColor = _this.find('.hentry').data('bg-color'),
				bgImage = _this.find('.hentry').data('bg-image'),
				bgOpacity = parseInt(_this.find('.hentry').data('bg-opacity'), 10),
				textColor = _this.find('.hentry').data('text-color'),
				linkColor = _this.find('.hentry').data('link-color');

			_this.prepend('<div class="static-content-cover" />');
			_this.find('.static-content-cover').css({ 'background-image' : 'url('+bgImage+')', 'opacity' : bgOpacity/100, '-ms-filter': '"alpha(opacity='+bgOpacity+')"' });

			_this.css({ 'background-color': bgColor, 'color' : textColor });
			_this.find('a').css('color', linkColor);
			_this.find('h1, h2, h3, h4, h5, h6').css('color', textColor);
		});
	}

	function stag_responsive_nav(){
		var win = $(window),
			header = $('#masthead'),
			page = $('#page');

		if( !header.find('#site-navigation').length) return;

		var menu = header.find('#primary-menu'),
			firstLevelItems = menu.find('> li:not(#menu-item-search)').length,
			switchWidth = 1024;

		var container = $('#page'),
			wrapper = $('#mobile-wrapper'),
			showMenu = $('#advanced_menu_toggle'),
			hideMenu = $('#advanced_menu_hide'),
			subheaderAdvanced = $('#subheader-menu').clone().attr({ id: 'subheader-advanced', 'class': 'subheader-menu' }),
			mobileAdvanced = menu.clone().attr({ id: 'mobile-advanced' }),
			menuAdded = false,
			metaAdded = false,
			metaNav = header.find('.user-meta-wrap');

		showMenu.on('click', function(){
			if ( container.is('.show-mobile-menu') ) {
				container.removeClass('show-mobile-menu');
				container.css('height', 'auto');
			} else {
				container.addClass('show-mobile-menu');
				setHeight();
			}
			return false;
		});

		hideMenu.on('click', function(){
			container.removeClass('show-mobile-menu');
			container.css('height', 'auto');
			return false;
		});

		// Mobile Search box
		var mobileSearch = $('#menu-item-search form').clone().attr('class', 'search-form--mobile');
		mobileSearch.appendTo(wrapper);

		var setVisibility = function(){
			if( win.width() > switchWidth ){
				header.removeClass('mobile-active');
				container.removeClass('show-mobile-menu');
				container.css('height', 'auto');
			}else{
				header.addClass('mobile-active');
				if( !menuAdded ) {
					var afterMenu = header.find('.site-branding');
					showMenu.appendTo(afterMenu.find('.header--right'));
					mobileAdvanced.appendTo(wrapper);
					subheaderAdvanced.appendTo(wrapper);
					hideMenu.appendTo(wrapper);
					menuAdded = true;
				}

				if(container.is('.show-mobile-menu')){
					setHeight();
				}
			}

			if( win.width() < 768 ){
				metaNav.hide();
				if( !metaAdded ) {
					var metaNavClone = metaNav.clone().attr({"id": "user-navigation", "class": "user-mobile-navigation"}).css('display', 'block');
					metaNavClone.insertAfter(mobileAdvanced);
					metaAdded = true;
				}
			} else{
				metaNav.css('display', 'inline-block');
			}

		},

		setHeight = function(){
			var height = wrapper.css('position', 'relative').outerHeight(true),
				win_h = win.height();

			if( height < win_h ) height = win_h;
			wrapper.css('position', 'absolute');
			container.css('height', height);
		};

		win.on('resize', setVisibility);
		setVisibility();
	}

}(jQuery));
