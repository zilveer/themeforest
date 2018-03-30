/*--------------------------------------------------------------------------------------------------

 File: znscript.js

 Description: This is the main javascript file for this theme
 Please be careful when editing this file

 --------------------------------------------------------------------------------------------------*/
(function ($) {
	$.ZnThemeJs = function () {
		this.scope = $(document);
		this.zinit();
	};

	$.ZnThemeJs.prototype = {
		zinit : function() {
			var fw = this;

			fw.addactions();
			// EVENTS THAT CAN BE REFRESHED
			fw.refresh_events( $(document) );
			// $('.main-menu').ZnMegaMenu();
			fw.enable_responsive_menu();
			// Enable follow menu
			fw.enable_follow_menu();
			// Init animations
			fw.init_animations();

		},

		refresh_events : function( content ) {

			var fw = this;

			// FITVIDS
			fw.enable_fitvids( content );

			// Enable the logo in menu for style 11
			fw.enable_logoinmenu( content );

			// Enable menu offset - Prevents the submenus from existing the viewport
			fw.enable_menu_offset();

			// Enable magnificpopup lightbox
			fw.enable_magnificpopup( content );
			// Enable blog isotope
			fw.enable_blog_isotope( content );

			// enable woocommerce lazy images
			fw.enable_woo_lazyload( content );
			// Enable header sparckles
			fw.enable_header_sparkles( content );
			// Enable partners logo carousel
			fw.enable_partners_logo_carousel( content );
			// Enable recent works carousel
			fw.enable_recent_work_carousel( content );
			// ENABLE CONTACT FORMS
			fw.enable_contact_forms(content);
			// Enable circular carousel
			fw.enable_circular_carousel( content );
			// Enable GENERAL slider
			fw.enable_general_carousel( content );
			fw.smart_carousel_editmode( content );
			// Enable flickr feed
			fw.enable_flickr_feed( content );
			// Enable iCarousel
			fw.enable_icarousel( content );
			// Enable Ios Slider
			fw.enable_ios_slider( content );
			// Enable Portfolio Slider
			fw.enable_portfolio_slider( content );
			// Enable laptop slider
			fw.enable_laptop_slider( content );
			// Enable latest posts css accordion
			fw.enable_latest_posts_accordion( content );
			// Enable portfolio sortable
			fw.enable_portfolio_sortable( content );
			// Enable Grid photo gallery
			fw.enable_gridphotogallery( content );
			// Enable nivo slider
			fw.enable_nivo_slider( content );
			// Enable recent works 2
			fw.enable_recent_works2( content );
			// Enable recent works 3
			fw.enable_recent_works3( content );
			// Enable Latest Posts Carousel
			fw.enableLatestPostsCarousel(content);
			// Enable ScreenShoot box
			fw.enable_screenshoot_box( content );
			// Enable WOW slider
			fw.enable_wow_slider( content );
			// Enable mailchimp subscribe
			fw.enable_mailchimp_subscribe( content );
			// Enable testimonial fader
			fw.enable_testimonial_fader( content );
			// Enable testimonial slider
			fw.enable_testimonial_slider( content );
			// Enable shop limited offers
			fw.enable_shop_limited_offers( content );
			// Enable Static content - showroom carousel
			fw.enable_sc_showroomcarousel( content );
			// Enable Static content - Weather
			fw.enable_static_weather( content );
			// Enable Partners Testimonials Carousel
			fw.enable_testimonials_partners( content );
			// Enable IconBox
			fw.enable_iconbox( content );
			// Enable Appeared Elements
			fw.enable_appeared( content );
			// Enable SearchBox
			fw.enable_searchbox( content );
			// Enable video elements
			fw.enable_bg_video( content );
			// Enable toggle class
			fw.enable_toggle_class( content );
			// Enable diagram
			fw.enable_diagram(content);
			// Enable services
			fw.enable_services(content);
			// Enable twitter fader
			fw.enable_twitter_fader( content );

			fw.enable_shoplatest_presentation(content);
			// enable scrollspy
			fw.enable_scrollspy(content);
			// enable bootstrap tooltips
			fw.enable_tooltips(content);

			fw.enable_customMenuDropdown(content);
			fw.enable_portfolio_readmore(content);

			// General woocommerce stuff
			fw.general_wc_stuff(content);

			// Init skillbars
			fw.init_skill_bars( content );

			// Enable photo gallery content
			fw.ph_gallery_slideshow( content );

			// General stuff
			fw.general_stuff(content);

		},

		RefreshOnWidthChange : function(content) {
		},

		addactions : function() {
			var fw = this;

			// Refresh events on new content
			fw.scope.on('ZnWidthChanged',function(e){
				fw.RefreshOnWidthChange(e.content);
				$(window).trigger('resize');
			});

			// Refresh events on new content
			fw.scope.on('ZnNewContent',function(e){
				fw.refresh_events( e.content );
			});

			// Refresh events on new content
			fw.scope.on('ZnBeforePlaceholderReplace ZnBeforeElementRemove',function(e){
				fw.unbind_events( e.content );
			});
		},

		unbind_events : function( scope ){
			// Remove iosSlider
			var iosSliders = scope.find( '.iosSlider' );
			if( iosSliders.length > 0 ){
				iosSliders.each(function(){
					$(this).iosSlider('destroy');
				});
			}
		},

		enable_logoinmenu  : function (scope){

			var header = $(scope).find('.site-header.kl-center-menu');

			if(header.length > 0){

				var logo = header.find('.main-menu-wrapper + .logo-container');
				var countMenuParents = $(".main-nav > ul > li").length;

				if (countMenuParents !== 0) {
					var centerChild;
					if (countMenuParents>1) {
						var $val = countMenuParents / 2;
						centerChild = header.hasClass('center-logo-ceil') ? Math.ceil($val) : Math.floor($val);
					} else {
						centerChild = 1;
					}

					if ( logo.length ) {
						$( "#logo-container" ).clone().insertAfter('.main-nav > ul > li:nth-child('+centerChild+')');
						$( "#logo-container" ).wrap( '<li class="logo-menu-wrapper"></li>' );
						setTimeout(function(){ $('#main-menu .logo-menu-wrapper').addClass('loaded'); }, 400);
					}
				}
			}

		},

		enable_woo_lazyload : function (scope){
			// Lazyload Woo Images
			var elements = scope.find( 'img[data-src]' );
			elements.each(function(index, el) {
				var $el = $(el);
				$el.attr('src', $el.attr('data-src') );
				$el.imagesLoaded( function() {
					$el.removeAttr('data-src');
				});
			});
		},

		enable_portfolio_readmore : function( scope ){
			var element = scope.find('.znprt_load_more_button');
			if (element.length === 0) { return; }

			var fw = this;

			element.on( 'click', function(e){

				e.preventDefault();

				var $this = $(this),
					page = $this.data('page'),
					ppp = $this.data('ppp'),
					container = $this.parent().find( '#thumbs' ),
					categories = $this.data('categories');

				if( $this.hasClass( 'zn_loadmore_disabled' ) ){
					return false;
				}

				$this.addClass( 'kl-ptfsortable-loadmore--loading' );

				$.post( ZnThemeAjax.ajaxurl, {
					action:'zn_loadmore',
					offset: page + 1,
					ppp: ppp,
					categories : categories,
					show_item_title : $this.data('show_item_title'),
					show_item_desc : $this.data('show_item_desc')
				}).success(function( data ){
					$this.removeClass( 'kl-ptfsortable-loadmore--loading' );

					$this.data('page', page + 1);
					if( data.length ){
						var newItems = $(data).css('opacity',0).appendTo(container);
						container.imagesLoaded( function() {
							fw.refresh_events( newItems );
							container.isotope( 'updateSortData', newItems ).isotope('appended', newItems );
						});
					}
					else{
						$this.addClass( 'zn_loadmore_disabled' );
					}
				});
			});

		},

		/**
		 * Fixes submenus exiting the page on smaller screens
		 */
		enable_menu_offset : function(){

			$('#main-menu').find('ul li').on({
				"mouseenter.zn": function () {
					var $submenu = $(this).children('.sub-menu').first();
					if ( $submenu.length > 0 ) {
						var left_offset = $submenu.offset().left;
						var width = $submenu.width();
						var pagewidth;

						if( $('body').has('.boxed') ){
							pagewidth = $('#page_wrapper').width();
						}
						else{
							pagewidth = $(window).width();
						}


						if ((left_offset + width) > pagewidth) {
							$submenu.addClass('zn_menu_on_left');
						}
					}
				},
				"mouseleave.zn": function () {
					var $submenu = $(this).children('ul').first();
					$submenu.removeClass('zn_menu_on_left');
				}
			});
		},

		enable_fitvids : function ( scope ) {

			var element = scope.find('.zn_iframe_wrap, .zn_pb_wrapper, .fitvids-resize-wrapper');
			if (element.length === 0) { return; }

			element.fitVids({ ignore: '.no-adjust, .kl-blog-post-body'});

		},

		enable_contact_forms : function ( scope )
		{
			var fw = this,
			element = (scope) ? scope.find('.zn_contact_form_container > form') : $('.zn_contact_form_container > form');

			element.each(function(index, el) {

				var $el = $(el),
					time_picker = $el.find('.zn_fr_time_picker'),
					date_picker = $el.find('.zn_fr_date_picker'),
					datepicker_lang = date_picker.is('[data-datepickerlang]') ? date_picker.attr('data-datepickerlang') : '',
					timeformat = time_picker.is('[data-timeformat]') ? time_picker.attr('data-timeformat') : 'h:i A';

				if(time_picker.length > 0){
					time_picker.timepicker({
						'timeFormat': timeformat,
						'className': 'cf-elm-tp'
					});
				}
				if(date_picker.length > 0){
					date_picker.datepicker({
						dateFormat: "yy-mm-dd",
						showOtherMonths: true
					}).datepicker('widget').wrap('<div class="ll-skin-melon"/>');

					if(datepicker_lang !== ''){
						$.datepicker.setDefaults( $.datepicker.regional[ datepicker_lang ] );
					}

				}


				// SUBMIT
				$el.on( 'submit', function(e){

					e.preventDefault();

					if ( fw.form_submitting === true ) { return false; }

					fw.form_submitting = true;

					var form = $(this),
						response_container = form.find('.zn_contact_ajax_response:eq(0)'),
						has_error   = false,
						inputs =
						{
							fields : form.find('textarea, select, input[type="text"], input[type="checkbox"], input[type="hidden"]')
						},
						form_id = response_container.attr('id'),
						submit_button = form.find('.zn_contact_submit');

					// Some IE Fix
					if((isIE11 || isIE10 || isIE9) && form.is('[action="#"]') ){
						form.attr('action','');
					}

					// FADE THE BUTTON
					submit_button.addClass('zn_form_loading');

					// PERFORM A CHECK ON ELEMENTS :
					inputs.fields.each(function()
					{
						var field       = $(this),
							p_container = field.parent();

						// Set the proper value for checkboxes
						 if(field.is(':checkbox'))
						 {
							 if(field.is(':checked')) { field.val(true); } else { field.val(''); }
						 }

						p_container.removeClass('zn_field_not_valid');

						// Check fields that needs to be filled
						if ( field.hasClass('zn_validate_not_empty') ) {
							if( field.is(':checkbox') ){
								if( ! field.is(':checked') ){
									p_container.addClass('zn_field_not_valid');
									has_error = true;
								}
							}
							else {
								if ( field.val() === '' ){
									p_container.addClass('zn_field_not_valid');
									has_error = true;
								}
							}
						}
						else if ( field.hasClass('zn_validate_is_email') ) {
							if ( !field.val().match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) )
							{
								p_container.addClass('zn_field_not_valid');
								has_error = true;
							}
						}
					});

					if ( has_error )
					{
						submit_button.removeClass('zn_form_loading');
						fw.form_submitting = false;
						return false;
					}

					response_container.load( form.attr('action')+' #'+form_id +' > .zn_cf_response' , inputs.fields , function()
					{
						// DO SOMETHING
						fw.form_submitting = false;
						submit_button.removeClass('zn_form_loading');

						// Perform the redirect if the form was valid
						var response = $('#'+form_id +' > .zn_cf_response'),
							redirect_uri = form.data( 'redirect' );

						// If the form was successfull
						if( response.hasClass('alert-success') ){
							inputs.fields.val('');
							if( redirect_uri ){
								window.location.replace(redirect_uri);
							}
						}


					});

					return false;

				});
			});

		},

		/* Button to toggle a class
		* example: class="js-toggle-class" data-target=".kl-contentmaps__panel" data-target-class="is-closed"
		*/
		enable_toggle_class : function( scope ){
			var elements = scope.find( '.js-toggle-class' );
			elements.each(function(index, el) {
				var $el = $(el);
				$el.on('click',function (e) {
					e.preventDefault();

					$el.toggleClass('is-toggled');

					if(!$el.is('[data-multiple-targets]')){
						var target = $el.is('[data-target]') ? $el.attr('data-target') : '',
							target_class = $el.is('[data-target-class]') ? $el.attr('data-target-class') : '';
						if(target && target.length && target_class && target_class.length){
							$(target).toggleClass(target_class);
						}
					}
					else {
						var targets = $el.is('[data-targets]') ? $el.attr('data-targets') : '',
							target_classes = $el.is('[data-target-classes]') ? $el.attr('data-target-classes') : '';
						if(targets && targets.length && target_classes && target_classes.length){
							var split_targets = targets.split(','),
								split_target_classes = target_classes.split(',');
							if(split_targets.length > 0){
								$(split_targets).each(function(i, target) {
									$(target).toggleClass(split_target_classes[i]);
								});
							}
						}
					}

					$(window).trigger('resize');

				});
			});
		},

		enable_blog_isotope : function( scope ){
			var elements = scope.find( '.zn_blog_columns:not(.kl-cols-1)' );

			if( elements.length === 0) { return; }
			elements.imagesLoaded( function() {
				elements.isotope({
					itemSelector: ".blog-isotope-item",
					animationEngine: "jquery",
					animationOptions: {
						duration: 250,
						easing: "easeOutExpo",
						queue: false
					},
					filter: '',
					sortAscending: true,
					sortBy: ''
				});
				$(window).on('debouncedresize zn_tabs_refresh zn_slide_refresh', function(event) {
					elements.isotope('layout');
				});
			});
		},

		/**
		 * Easy Video Background
		 * Based on easy background video plugin
		 * Example data setup attribute:
		 * @since  4.0
		 * data-setup='{ "position": absolute, "loop": true , "autoplay": true, "muted": true, "mp4":"", "webm":"", "ogg":""  }'
		 */
		enable_bg_video : function( scope ){
			var fw = this,
			elements = scope.find('.kl-video:not(.kl-bg-source__iframe)');

			if(!elements.length) return;

			elements.each(function(index, el) {
				var $video = $(el),
					$options = $video.is("[data-setup]") && IsJsonString( $video.attr("data-setup") ) ? JSON.parse( $video.attr("data-setup") ) : {};

				if($video.closest('.iosslider__item').length) return;

				if($options.height_container === true)
					$video.closest('.kl-video-container').css('height', $video.height());

				if(typeof video_background != 'undefined') {
					var Video_back = new video_background( $video, $options);
				}
			});

		},

		enable_follow_menu : function(){
			var header = $('header#header'),
				chaser = $('#main-menu > ul'),
				forch = 120,
				_chaser;

			if( ! header.hasClass( 'header--follow' ) || window.matchMedia( "(max-width: 1024px)" ).matches ){
				return;
			}

			if(chaser && chaser.length > 0) {

				chaser.clone()
					.appendTo(document.body)
					.wrap('<div class="chaser" id="site-chaser"><div class="container"><div class="row"><div class="col-md-12"></div></div></div></div>')
					.addClass('chaser-main-menu');

				_chaser = $('#site-chaser')[0];

				// if(header && header.length > 0 ) {
				// 	forch = header.offset().top + header.outerHeight(true);
				// }

				if(is_undefined(scrollMagicController)) return;

				var scene = new ScrollMagic.Scene({
						offset: forch,
						reverse: true
					})
					// .setClassToggle(_chaser, 'visible')
					.setTween(_chaser, 0.15, {y:0, autoAlpha:1, ease:Power0.easeOut})
					.addTo(scrollMagicController);

			}
		},

		enable_responsive_menu : function(){

			var fw = this,
				main_menu = $('#main-menu > ul'),
				page_wrapper = $('#page_wrapper'),
				responsive_trigger = $('.zn-res-trigger'),
				menu_activated = false,
				back_text = '<li class="zn_res_menu_go_back"><span class="zn_res_back_icon glyphicon glyphicon-chevron-left"></span><a href="#">'+ZnThemeAjax.zn_back_text+'</a></li>',
				cloned_menu = main_menu.clone().attr({id:"zn-res-menu", "class":"zn-res-menu-nav"});

			var start_responsive_menu = function()
			{

				var responsive_menu = cloned_menu.prependTo(page_wrapper);

				// BIND OPEN MENU TRIGGER
				responsive_trigger.click(function(e){
					e.preventDefault();
					responsive_menu.addClass('zn-menu-visible');
					set_height();
				});

				// Close the menu when a link is clicked
				responsive_menu.find( 'a:not([rel*="mfp-"])' ).on('click',function(e){
					$( '.zn_res_back_icon+a' ).first().trigger( 'click' );
				});

				// ADD ARROWS TO SUBMENUS TRIGGERS
				responsive_menu
					.find('li:has(> ul.sub-menu), li:has(> div.zn_mega_container)')
					.addClass('zn_res_has_submenu')
					.prepend('<span class="zn_res_submenu_trigger glyphicon glyphicon-chevron-right"></span>');
				// ADD BACK BUTTONS
				responsive_menu
					.find('.zn_res_has_submenu > ul.sub-menu, .zn_res_has_submenu > div.zn_mega_container')
					.addBack()
					.prepend(back_text);

				// REMOVE BACK BUTTON LINK
				//@since v4.1
				//@wpk
				// Changed selectors to allow customization from child theme, if a close button is desired
				$( '.zn_res_back_icon, .zn_res_back_icon+a' ).click(function(e){
					e.preventDefault();
					var active_menu = $(this).closest('.zn-menu-visible');
					active_menu.removeClass('zn-menu-visible');
					set_height();
					if( active_menu.is('#zn-res-menu') ) {
						page_wrapper.css({'height':'auto'});
					}
				});

				// OPEN SUBMENU'S ON CLICK
				$('.zn_res_submenu_trigger').on('click',function(e){
					e.preventDefault();
					$(this).siblings('ul,.zn_mega_container').addClass('zn-menu-visible');
					set_height();
				});
			};

			var set_height = function(){
				var _menu = $('.zn-menu-visible').last(),
					height = _menu.css({height:'auto'}).outerHeight(true),
					window_height  = $(window).height(),
					adminbar_height = 0,
					admin_bar = $('#wpadminbar');

				// CHECK IF WE HAVE THE ADMIN BAR VISIBLE
				if(height < window_height) {
					height = window_height;
					if ( admin_bar.length > 0 ) {
						adminbar_height = admin_bar.outerHeight(true);
						height = height - adminbar_height;
					}
				}
				_menu.attr('style','');
				page_wrapper.css({'height':height});
			};

			if(main_menu.length > 0){
				// MAIN TRIGGER FOR ACTIVATING THE RESPONSIVE MENU
				$( window ).on( 'debouncedresize' , function(){
					if ( $(window).width() < ZnThemeAjax.res_menu_trigger ) {
						if ( !menu_activated ){
							start_responsive_menu();
							menu_activated = true;
							fw.refresh_events( cloned_menu );
						}
						page_wrapper.addClass('zn_res_menu_visible');
					}
					else{
						// WE SHOULD HIDE THE MENU
						$('.zn-menu-visible').removeClass('zn-menu-visible');
						page_wrapper.css({'height':'auto'}).removeClass('zn_res_menu_visible');
					}
				// Fix for triggering the responsive menu
				}).trigger('debouncedresize');
			}
		},

		enable_header_sparkles : function( content ){

			var sparkles = content.find('.th-sparkles:visible');
			if( sparkles.length === 0 ){ return false; }

			sparkles.each(function(){
				if ($.browser.msie && $.browser.version < 9) {
					return;
				}
				var a = 40,
					i = 0;
				for (i; i < a; i++) {
					new Spark( $(this) );
				}

			});

		},

		enable_magnificpopup : function( content )
		{
			if(typeof($.fn.magnificPopup) != 'undefined')
			{

				$('a.kl-login-box').magnificPopup({
					type: 'inline',
					closeBtnInside:true,
					showCloseBtn: true,
					mainClass: 'mfp-fade mfp-bg-lighter'
				});

				var gal_config = {
					delegate: 'a[data-type="image"]',
					type: 'image',
					gallery: {enabled:true},
					tLoading: '',
					mainClass: 'mfp-fade'
				};

				$('a[data-lightbox="image"]:not([data-type="video"]), .mfp-image').each(function(i,el){
					var $el = $(el);
					//single image popup
					if ($el.parents('.gallery').length === 0) {
						$el.magnificPopup({
							type:'image',
							tLoading: '',
							mainClass: 'mfp-fade'
						});
					}
					else {
						$el.parents('.gallery').magnificPopup(gal_config);
					}
				});

				$('.zn-modal-img-gallery').each(function(i,el) {
					$(el).magnificPopup(gal_config);
				});


				 $('.mfp-gallery.mfp-gallery--images').each(function(i,el) {
					$(el).magnificPopup({
						delegate: 'a',
						type: 'image',
						gallery: {enabled:true},
						tLoading: '',
						mainClass: 'mfp-fade'
					});
				});
				// Notice the .misc class, this is a gallery which contains a variatey of sources
				// links in gallery need data-mfp attributes eg: data-mfp="image"
				$('.mfp-gallery.mfp-gallery--misc').each(function(i, el){
					$(el).magnificPopup({
						mainClass: 'mfp-fade',
						delegate: 'a[data-lightbox="mfp"]',
						type: 'image',
						gallery: {enabled:true},
						tLoading: '',
						callbacks: {
							elementParse: function(item) {
								item.type = $(item.el).attr('data-mfp');
							}
						}
					});
				});

				// Link post images
				var post_img_config = {
					delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"]',
					type: 'image',
					gallery: {enabled:true},
					tLoading: '',
					mainClass: 'mfp-fade'
				};
				// Full content's archive images
				$('.kl-blog-content-full .kl-blog-item-content a[href$=".jpg"], .kl-blog-content-full .kl-blog-item-content a[href$=".jpeg"], .kl-blog-content-full .kl-blog-item-content a[href$=".png"]').each(function(i,el){
					$(el).parents('.kl-blog-item-content').magnificPopup(post_img_config);
				});
				// Single post content's images
				$('.kl-blog-link-images .kl-blog-post-body a[href$=".jpg"], .kl-blog-link-images .kl-blog-post-body a[href$=".jpeg"], .kl-blog-link-images .kl-blog-post-body a[href$=".png"]').each(function(i,el){
					$(el).parents('.kl-blog-post-body').magnificPopup(post_img_config);
				});

				$('a[data-lightbox="iframe"], a[rel="mfp-iframe"]').magnificPopup({type: 'iframe', mainClass: 'mfp-fade', tLoading: ''});
				$('a[data-lightbox="inline"], a[rel="mfp-inline"]').magnificPopup({type: 'inline', mainClass: 'mfp-fade', tLoading: ''});
				$('a[data-lightbox="ajax"], a[rel="mfp-ajax"]').magnificPopup({type: 'ajax', mainClass: 'mfp-fade', tLoading: ''});
				$('a[data-lightbox="youtube"], a[data-lightbox="vimeo"], a[data-lightbox="gmaps"], a[data-type="video"], a[rel="mfp-media"]').magnificPopup({
					disableOn: 700,
					type: 'iframe',
					removalDelay: 160,
					preloader: true,
					fixedContentPos: false,
					mainClass: 'mfp-fade',
					tLoading: ''
				});

				// Dynamic inline modal
				// Will pass the title attribute to a dynamic field in a form
				var dynModalWin = $('a[data-lightbox="inline-dyn"]');
				dynModalWin.each(function(index, el) {
					$(el).magnificPopup({
						type: 'inline',
						mainClass: 'mfp-fade',
						callbacks: {
							open: function() {
								var inst = $.magnificPopup.instance,
									form = $(inst.content).find('form'),
									itemTitle = $(el).attr('title');

								if($(form).length > 0 && itemTitle !== ''){
									var dynamicField = form.first().find('.zn-field-dynamic');
									if($(dynamicField).length > 0){
										$(dynamicField).first().val(itemTitle).attr('readonly', 'readonly');
									}
								}

							},
						}
					});
				});


				var getExpired = function(e){
					if(e == 'halfhour'){
						return 1/48;
					}
					else if(e == 'hour'){
						return 1/24;
					}
					else if(e == 'day'){
						return 1;
					}
					else if(e == 'week'){
						return 7;
					}
				};

				// Auto-Popup Modal Window - Immediately
				// Options located in Section element > Advanced
				$('body:not(.zn_pb_editor_enabled) .zn_section--auto-immediately').each(function(index, el) {

					var $el = $(el),
						window_id = $el.attr('id'),
						thecookie = 'automodal'+window_id,
						CookiesKl = Cookies.noConflict();

					if(typeof CookiesKl.get(thecookie) != 'undefined' && CookiesKl.get(thecookie) == 'true'){
						return;
					}

					$.magnificPopup.open({
						items: {
							src: $el,
							type: 'inline'
						},
						mainClass: 'mfp-fade',
						callbacks: {
							open: function() {
								// Check if force cookie is added
								if( $el.is('[data-autoprevent]') ){
									// Assign cookie
									CookiesKl.set(thecookie, 'true', { expires: getExpired( $el.attr('data-autoprevent') ) });
								}
							}
						}
					});
				});

				// Auto-Popup Modal Window - On Scroll
				// Options located in Section element > Advanced
				$('body:not(.zn_pb_editor_enabled) .zn_section--auto-scroll').each(function(index, el) {

					var $el = $(el),
						window_id = $el.attr('id'),
						thecookie = 'automodal'+window_id,
						isAppeared = false,
						CookiesKl = Cookies.noConflict();

					if(typeof CookiesKl.get(thecookie) != 'undefined' && CookiesKl.get(thecookie) == 'true'){
						return;
					}

					$(window).on('scroll', debounce(function() {
						if( $(window).scrollTop() > ($(document).outerHeight()/2) && isAppeared === false){
							$.magnificPopup.open({
								items: {
									src: $el,
									type: 'inline'
								},
								mainClass: 'mfp-fade',
								callbacks: {
									open: function() {
										// Check if force cookie is added
										if( $el.is('[data-autoprevent]') ){
											// Assign cookie
											CookiesKl.set(thecookie, 'true', { expires: getExpired( $el.attr('data-autoprevent') ) });
										}
									}
								}
							});
							isAppeared = true;
						}
					}, 300));
				});

				// Auto-Popup Modal Window - On X seconds Delay
				// Options located in Section element > Advanced
				$('body:not(.zn_pb_editor_enabled) .zn_section--auto-delay').each(function(index, el) {

					var $el = $(el),
						window_id = $el.attr('id'),
						thecookie = 'automodal'+window_id,
						isAppeared = false,
						delay = $el.is("[data-auto-delay]") ? parseInt( $el.attr("data-auto-delay") ) : 5,
						CookiesKl = Cookies.noConflict();

					if(typeof CookiesKl.get(thecookie) != 'undefined' && CookiesKl.get(thecookie) == 'true'){
						return;
					}

					setTimeout(function(){
						$.magnificPopup.open({
							items: {
								src: $el,
								type: 'inline'
							},
							mainClass: 'mfp-fade',
							callbacks: {
								open: function() {
									// Check if force cookie is added
									if( $el.is('[data-autoprevent]') ){
										// Assign cookie
										CookiesKl.set(thecookie, 'true', { expires: getExpired( $el.attr('data-autoprevent') ) });
									}
								}
							}
						});
						isAppeared = true;
					}, delay*1000);
				});

			}
		},

		enable_partners_logo_carousel : function( content ){
			var elements = content.find('.partners_carousel_trigger');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.imagesLoaded( function() {
							self.carouFredSel({
								responsive: true,
								auto: self.data('autoplay'),
								items: {
									width: 250,
									visible: { min: 3, max: 10 }
								},
								scroll: {
									items           : 1,
									easing          : "easeInOutExpo",
									duration		: 1000,
									pauseOnHover    : true,
									timeoutDuration	: parseInt( self.attr('data-timeout') )
								},
								prev	: {
									button	: function(){return self.parents('.partners_carousel').find('.prev');},
									key		: "left"
								},
								next	: {
									button	: function(){return self.parents('.partners_carousel').find('.next');},
									key		: "right"
								},
								swipe: {
									onTouch: true,
									onMouse: true
								}
							});
							$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
								self.trigger('updateSizes');
							});
						});
					}
				});
			}
		},

		enable_recent_work_carousel : function( content ){
			var elements = content.find('.recent_works1');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {

						var autoplay = self.attr('data-autoplay') ? parseInt(self.data('autoplay')) : 0,
								timeout = self.attr('data-timeout') ? parseInt(self.data('timeout')) : 5000;

						var options = {
							responsive: true,
							scroll: 1,
							auto: false,
							items: {
								width: 300,
								visible: { min: 1, max: 3 }
							},
							prev	: {
								button	: function(){return self.closest('.recentwork_carousel').find('.prev');},
								key		: "left"
							},
							next	: {
								button	: function(){return self.closest('.recentwork_carousel').find('.next');},
								key		: "right"
							},
							swipe: {
								onTouch: true,
								onMouse: false
							}
						};
						if(autoplay > 0  && timeout >= 100){
							options.auto = true;
							options.timeoutDuration = timeout;
						}

						self.carouFredSel(options);

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});
					}
				});
			}
		},

		enable_circular_carousel : function( content )
		{
			var cirContentContainer = content.find('.ca-container'),
				elements = cirContentContainer.children('.ca-wrapper');

			// do the carousel
			if(elements && elements.length > 0 ) {
				$.each(elements, function(i, e){
					var self = $(e),
						autoplay = (self.attr('data-autoplay') == '1'),
						start_width = 1170,
						max = self.is('[data-max]') ? self.attr('data-max') : '3',
						start_height = self.is('[data-height]') ? self.attr('data-height') : '450';

					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive: true,
							width: parseFloat( start_width ),
							height: parseFloat( start_height ),
							direction : "left",
							items: {
								width: parseFloat( (start_width / max) + 50 ),
								visible: {
									min: 1,
									max: parseFloat( max )
								}
							},
							auto: {
								play: autoplay
							},
							scroll 				: {
								items           : 1,
								easing          : "easeInOutExpo",
								duration		: 1000,
								pauseOnHover    : true,
								timeoutDuration	: parseFloat( self.attr('data-timout') )
							},
							prev : {
								button  : self.closest('.ca-container').find('.ca-nav-prev'),
								key     : "left"
							},
							next : {
								button  : self.closest('.ca-container').find('.ca-nav-next'),
								key     : "right"
							},
							swipe: {
								onTouch: true,
								onMouse: true
							}
						});

						$( window ).on( 'debouncedresize' , function(){
							if( window.matchMedia( "(max-width: 767px)" ).matches ){
								self.trigger("configuration", ["items.visible.max", 1]);
							} else {
								self.trigger("configuration", ["items.visible.max", parseFloat( max ) ]);
							}
							self.trigger('updateSizes');
						}).trigger('debouncedresize');

					}
					// Open wrapper panel
					var opened = false;
					self.find('.js-ca-more').on('click', function(e){
						e.preventDefault();
						var th = $(this).closest('.ca-item'),
							thpos = th.position().left;

						if(!opened){
							self.trigger('stop');
							self.closest('.ca-container').addClass('ca--is-rolling');
							th.addClass('ca--opened');
							th.css({
								"-webkit-transform":"translateX(-"+ thpos +"px)",
								"-ms-transform":"translateX(-"+ thpos +"px)",
								"transform":"translateX(-"+ thpos +"px)"
							});
							opened = true;

						} else if(opened){

							if($(this).hasClass('js-ca-more-close')){

								self.trigger('play', true);
								self.closest('.ca-container').removeClass('ca--is-rolling');
								th.removeClass('ca--opened');
								th.css({
									"-webkit-transform":"translateX(0)",
									"-ms-transform":"translateX(0)",
									"transform":"translateX(0)"
								});
								opened = false;
							}
						}
					});
					// Close wrapper panel
					self.find('.js-ca-close').on('click', function(e){
						e.preventDefault();
						var th = $(this).closest('.ca-item');
						if(opened){
							self.trigger('play', true);
							self.closest('.ca-container').removeClass('ca--is-rolling');
							th.removeClass('ca--opened');
							th.css({
								"-webkit-transform":"translateX(0)",
								"-ms-transform":"translateX(0)",
								"transform":"translateX(0)"
							});
						}
						opened = false;
					});
				});

			}
		},

		enable_general_carousel : function( content ){

			var elements = content.find('.zn_general_carousel, .znSmartCarouselMode--view .znSmartCarousel-holder'),
				fw = this;

			if(elements && elements.length)
			{
			   if(typeof($.fn.carouFredSel) != 'undefined') {
					$.each(elements, function(i, e){

						var $el = $(e);

						var highlight = function(data) {

							$(window).trigger('resize');

							var item = $el.triggerHandler('currentVisible');
							$el.children('.cfs--item').removeClass('cfs--active-item');
							item.addClass('cfs--active-item');
						};
						var unhighlight = function(data) {
							$el.children('.cfs--item').removeClass('cfs--active-item');
						};

						var add_imgloaded_class = function(data) {
							if($el.is("[data-carousel-uid]")){
								$el.closest( $el.attr('data-carousel-uid') ).addClass('zn-images-loaded-parent');
							}
							$el.addClass('zn-images-loaded');
						};


						// Set the carousel defaults
						var defaults = {
							fancy: false ,
							transition : 'fade',
							direction : 'left',
							responsive: true,
							height: 'variable',
							auto: true ,
							items: {
								visible:1,
								height: 'variable'
							},
							scroll: {
								fx: 'fade',
								timeoutDuration : 9000,
								easing: 'swing',
								onBefore : unhighlight,
								onAfter: highlight
							},
							swipe: {
								onTouch: true,
								onMouse: true
							},
							pagination: {
								container: $el.parent().find('.cfs--pagination'),
								anchorBuilder: function(nr, item) {
									var thumb = '';
									if( $el.is("[data-thumbs]") && $el.data('thumbs') == 'zn_has_thumbs' ){
										var items = $el.children('li');
										thumb = 'style="background-image:url('+ items.eq(nr-1).attr('data-thumb') + ');"';
									}
									return '<a href="#'+nr+'" '+ thumb +'></a>';
								}
							},
							next : {
								button: $el.parent().find('.cfs--next'),
								key: 'right'
							},
							prev : {
								button: $el.parent().find('.cfs--prev'),
								key: 'left'
							},
							onCreate : function(){
								add_imgloaded_class();
								highlight();
							},
							onBefore : function(){
								$(window).trigger('zn_slide_refresh');
							}
						};


						if( $el.is("[data-fancy]") ){
							defaults.fancy = $el.data('fancy');
						}

						// Get the custom carousel settings from data attributes
						var customSettings = {
							scroll: {
								fx : $el.is("[data-transition]") ? $el.data('transition') : defaults.transition,
								timeoutDuration	: $el.is("[data-timout]") ? parseFloat( $el.data('timout') ) : defaults.scroll.timeoutDuration,
								easing: $el.is("[data-easing]") ? $el.data('easing') : defaults.scroll.easing,
								onBefore : unhighlight ,
								onAfter: highlight
							},
							auto: {
								play: $el.is('[data-autoplay]') && $el.attr('data-autoplay') == '1' ? defaults.auto : false
							},
							swipe: {
								onTouch: $el.is('[data-swipe-touch]') && $el.attr('data-swipe-touch') == '1' ? true : defaults.swipe.onTouch,
								onMouse: $el.is('[data-swipe-mouse]') && $el.attr('data-swipe-mouse') == '1' ? true : defaults.swipe.onMouse
							}
						};

						if( $el.is('[data-continuous]') ){
							var dataCont = parseInt( $el.attr('data-continuous') ),
								continuousSpeed = dataCont !== '' && dataCont !== 0 ? dataCont : 4000;
							// console.log(typeof dataCont, dataCont !== '', dataCont !== 0);
							customSettings = {
								scroll: {
									items: 1,
									duration: continuousSpeed,
									timeoutDuration: 0,
									easing: 'linear',
									pauseOnHover: 'immediate'
								}
							};
						}

						// Special case/callback for the fancy slider
						if ( defaults.fancy ) {
							// var callback = window['slideCompleteFancy']();
							$.extend(customSettings.scroll, {
								onBefore : function(e){ slideCompleteFancy(e, $el); },
								onAfter : function(e){ slideCompleteFancy(e, $el); },
							});

							customSettings.onCreate = function(e){
								add_imgloaded_class();
								slideCompleteFancy(e, $el);
							};
						}

						// Callback function for fancy slider
						function slideCompleteFancy(args, slider) {
							var _arg = $(slider),
								slideshow =  $(slider).closest('.kl-slideshow'),
								color = $(args.items.visible).attr('data-color') || $(args.items[0]).attr('data-color');

							// slideshow.animate({backgroundColor: color}, 400);
							slideshow.css({backgroundColor: color});
						}

						// Start the carousel already :)
						$el.imagesLoaded( function() {
							$el.carouFredSel($.extend({}, defaults, customSettings));
						});

						$(window).on('debouncedresize zn_tabs_refresh zn_slide_refresh', function(event) {
							$el.trigger('updateSizes');
						});

					});
				}

				return false;

			}
		},

		smart_carousel_editmode : function (content) {

			var $editCarousel = content.find('.znSmartCarousel.znSmartCarouselMode--edit'),
				$elements = $editCarousel.find('.znSmartCarousel-holder'),
				$arrNav = $editCarousel.find('.znSmartCarousel-arr');

			if($elements && $elements.length) {
				$.each($elements, function(i, e){
					var $el = $(e),
						$item = $el.find('.znSmartCarousel-item');

					// hide all but first
					$item.slice(1).hide();
					// disable prev nav
					$arrNav.filter( '.znSmartCarousel-prev' ).addClass('is-disabled');

					$arrNav.on('click', function(event) {
						event.preventDefault();
						$arrNav.removeClass('is-disabled');
						var $this = $(this);

						if( $this.hasClass('znSmartCarousel-next')){
							$item.filter(":visible").next().show();
							$item.filter(":visible").prevAll().hide();
							if($item.filter(":visible").is('.znSmartCarousel-item:last')){
								$this.addClass('is-disabled');
							}
						}

						if( $this.hasClass('znSmartCarousel-prev')){
							$item.filter(":visible").prev().show();
							$item.filter(":visible").nextAll().hide();
							if($item.filter(":visible").is('.znSmartCarousel-item:first')){
								$this.addClass('is-disabled');
							}
						}
					});
				});
			}

		},

		enable_flickr_feed : function( content ){
			var elements = content.find('.flickr_feeds');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e),
						ff_limit = (self.attr('data-limit') ? self.attr('data-limit') : 6),
						fid = self.attr('data-fid');
					if(typeof($.fn.jflickrfeed) != 'undefined') {
						self.jflickrfeed({
							limit: ff_limit,
							qstrings: { id: fid },
							itemTemplate: '<li class="flickrfeed-item"><a href="{{image_b}}" class="flickrfeed-link hoverBorder" data-lightbox="image"><img src="{{image_s}}" alt="{{title}}" class="flickrfeed-img" /></a></li>'
						},
						function(data) {
							self.find(" a[data-lightbox='image']").magnificPopup({type:'image', tLoading: ''});
							self.parent().removeClass('loading');
						});
					}
				});
			}
		},


		enable_icarousel : function( content ){
			var elements = content.find('.th-icarousel');
			if(elements && elements.length){
				$.each(elements, function(i, e){

					var element = $(e),
						carouselSettings = {
							easing: 'easeInOutQuint',
							pauseOnHover: true,
							timerPadding: 0,
							timerStroke: 4,
							timerBarStroke: 0,
							animationSpeed: 700,
							nextLabel: "",
							previousLabel: "",
							autoPlay: element.is("[data-autoplay]") ? element.data('autoplay') : true,
							slides: element.is("[data-slides]") ? element.data('slides') : 7,
							pauseTime: element.is("[data-timeout]") ? element.data('timeout') : 5000,
							perspective: element.is("[data-perspective]") ? element.data('perspective') : 75,
							slidesSpace: element.is("[data-slidespaces]") ? element.data('slidespaces') : 300,
							direction: element.is("[data-direction]") ? element.data('direction') : "ltr",
							timer: element.is("[data-timer]") ? element.data('timer') : "Bar",
							timerOpacity: element.is("[data-timeropc]") ? element.data('timeropc') : 0.4,
							timerDiameter: element.is("[data-timerdim]") ? element.data('timerdim') : 220,
							keyboardNav: element.is("[data-keyboard]") ? element.data('keyboard') : true,
							mouseWheel: element.is("[data-mousewheel]") ? element.data('mousewheel') : true,
							timerColor: element.is("[data-timercolor]") ? element.data('timercolor') : "#FFF",
							timerPosition: element.is("[data-timerpos]") ? element.data('timerpos') : "bottom-center",
							timerX: element.is("[data-timeroffx]") ? element.data('timeroffx') : 0,
							timerY: element.is("[data-timeroffy]") ? element.data('timeroffy') : -20
						};

					// Start the carousel already :)
					if(typeof($.fn.iCarousel) != 'undefined') {
						element.imagesLoaded( function() {
							element.iCarousel(carouselSettings);
						});
					}
				});
			}
		},

		enable_ios_slider : function( content ){

			var elements = content.find('.iosSlider');

			if( !elements.length ) return;

			var Video_back = [];
			var videoAutoplay = [];

			function slideChange(args) {
				var theSlider = $(args.sliderObject),
					activeSlide = args.currentSlideNumber - 1,
					currentSlideObj = theSlider.find('.iosslider__item:eq(' + activeSlide + ')'),
					prevSlideObj = theSlider.find('.iosslider__item:eq(' + args.prevSlideNumber + ')'),
					sliderContainer = theSlider.closest('.iosslider-slideshow');

				// add active to bullets
				sliderContainer.find('.kl-ios-selectors-block .iosslider__bull-item').removeClass('selected');
				sliderContainer.find('.kl-ios-selectors-block .iosslider__bull-item:eq(' + activeSlide + ')').addClass('selected');
				// add active class
				theSlider.find('.iosslider__item').removeClass('kl-iosslider-active');
				currentSlideObj.addClass('kl-iosslider-active');

				// find & load videos
				var $vid = currentSlideObj.find('.kl-video');
				var isLoaded = $vid.hasClass('video-loaded');
				var $vidParams = $vid.is("[data-setup]") && IsJsonString( $vid.attr("data-setup") ) ? JSON.parse( $vid.attr("data-setup") ) : {};

				// Load video
				if( !isLoaded && $vid.length ){

					if(typeof video_background !== 'undefined' && !$.isEmptyObject($vidParams) ){
						Video_back[ args.currentSlideNumber ] = new video_background( $vid, $vidParams);
						$vid.addClass('video-loaded');
					}

					// check if autoplay is enabled and undefined
					videoAutoplay[ args.currentSlideNumber ] = $vidParams.autoplay === true;

				}

				if( Video_back[ args.prevSlideNumber ] ){
					if( Video_back[ args.prevSlideNumber ].isPlaying() ){
						// Pause the previous video
						Video_back[ args.prevSlideNumber ].pause();
						// if video was played and had autoplay disabled, force enable it
						videoAutoplay[ args.prevSlideNumber ] = true;
					}
				}

				if(Video_back[ args.currentSlideNumber ] ){
					// check if video's autoplay enabled
					if( ! videoAutoplay[ args.currentSlideNumber ] ) return;
					// play the current video
					Video_back[ args.currentSlideNumber ].play();
				}
			}

			function sliderLoaded(args, otherSettings) {
				var theSlider = $(args.sliderObject);
				if (otherSettings.hideControls) theSlider.addClass('hideControls');
				if (otherSettings.hideCaptions) theSlider.addClass('hideCaptions');

				if(typeof( args.currentSlideNumber ) != 'undefined') {
					slideChange(args);
				}
				theSlider.closest('.iosslider-slideshow').addClass('kl-slider-loaded');
			}

			$.each( elements , function(i, e){
				var self = $(e),
					selfContainer = self.closest('.kl-slideshow');

				if(typeof($.fn.iosSlider) != 'undefined') {
					self.iosSlider({
						snapToChildren: true,
						desktopClickDrag: self.data('clickdrag') == '1' ? true : false,
						keyboardControls: true,
						autoSlide: self.data('autoplay') == '1' ? true : false,
						autoSlideTimer: self.data('trans'),
						navNextSelector: selfContainer.find('.kl-iosslider-next'),
						navPrevSelector: selfContainer.find('.kl-iosslider-prev'),
						navSlideSelector: selfContainer.find('.kl-ios-selectors-block .item'),
						scrollbar: true,
						scrollbarContainer: selfContainer.find('.scrollbarContainer'),
						scrollbarMargin: '0',
						scrollbarBorderRadius: '4px',
						onSliderLoaded: function(args){
							var otherSettings = {
								hideControls : true,
								hideCaptions : false
							};
							sliderLoaded(args, otherSettings);
						},
						onSlideChange: slideChange,
						infiniteSlider: self.data('infinite')
					});
				}

				$( window ).on( 'debouncedresize' , function(){
					if(typeof($.fn.iosSlider) != 'undefined') {
						self.iosSlider('update');
					}
				});

			});
		},

		enable_portfolio_slider : function( content ){

			var elements = content.find('.psl-carousel__container');

			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					var highlight = function(data) {
						var item = self.triggerHandler('currentVisible');
						self.children('.psl-carousel__item').removeClass('psl--active-item');
						item.addClass('psl--active-item');
					};
					var unhighlight = function(data) {
						self.children('.psl-carousel__item').removeClass('psl--active-item');
					};
					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive: true,
							width: 1140,
							scroll   : {
								fx: 'fade',
								duration     : 1000,
								timeoutDuration  : 3000,
								onBefore : unhighlight,
								onAfter : highlight
							},
							auto : false,
							next : {
								button: self.closest('.psl-carousel__wrapper').find('.psl__next'),
								key: 'right'
							},
							prev : {
								button: self.closest('.psl-carousel__wrapper').find('.psl__prev'),
								key: 'left'
							},
							swipe: {
								onTouch: true,
								onMouse: true
							},
							onCreate : highlight
						});
					}
				});
			}
		},

		enable_testimonials_partners : function( content ){

			var elements = content.find('.ts-pt-partners__carousel');

			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					var highlight = function(data) {
						var item = self.triggerHandler('currentVisible');
						self.children('.ts-pt-partners__carousel-item').removeClass('ts-pt--active-item');
						item.addClass('ts-pt--active-item');
					};
					var unhighlight = function(data) {
						self.children('.ts-pt-partners__carousel-item').removeClass('ts-pt--active-item');
					};
					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive: true,
							items: {
								visible: {
									min: 1,
									max: 5
								}
							},
							scroll   : {
								fx: 'fade',
								duration     : 1000,
								timeoutDuration  : 3000,
								onBefore : unhighlight,
								onAfter : highlight
							},
							auto : true,
							onCreate : highlight,
							swipe: {
								onTouch: true,
								onMouse: false
							}
						});
						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});
					}
				});
			}
		},

		enable_appeared : function( content ){

			// Iconboxes with appearance effect
			var el = content.find('.el--appear');
			if(el && el.length){
				$.each(el, function(i, e){
					var self = $(e),
						loaded = false;
					// Appear faded
					if(!loaded) {
						if(self.is( ':in-viewport' )){
							self.addClass('el--appeared');
							loaded = true;
						}
						$(window).on('scroll', debounce(function() {
							if(self.is( ':in-viewport' )){
								self.addClass('el--appeared');
								loaded = true;
							}
						}, 100));
					}
				});
			}
		},

		enable_iconbox : function( content ){

			// Iconboxes with appearance effect
			var el_stage = content.find('.kl-iconbox[data-stageid]');
			if(el_stage && el_stage.length){
				$.each(el_stage, function(i, e){
					var self = $(e),
						stageid = self.attr('data-stageid'),
						title = self.is('[data-pointtitle]') ? 'data-title="'+self.attr('data-pointtitle')+'"' : '',
						nr = self.is('[data-point-number]') ? 'data-nr="'+self.attr('data-point-number')+'"' : '',
						px = self.attr('data-pointx'),
						py = self.attr('data-pointy'),
						theStage = $('.'+stageid);

					if(stageid && px && py){
						var span = $('<span style="top:'+py+'px; left: '+px+'px;" class="stage-ibx__point" '+title+' '+ nr +'></span>');

						theStage.find('.stage-ibx__stage').append( span );
						setTimeout(function(){
							span.css('opacity',1);
						}, 300*i);
						self.on('mouseover', span ,function(){
							span.addClass('is-hover');
						});
						self.on('mouseout', span ,function(){
							span.removeClass('is-hover');
						});
					}
				});
			}
		},

		enable_searchbox : function( content ){

			// Iconboxes with appearance effect
			var el = content.find('.elm-searchbox--eff-typing');
			if(el && el.length){
				$.each(el, function(i, e){

					$(e).find('.elm-searchbox__input')
						.on('focus', function(ev){
							$(this).addClass('is-focused');
						})
						.on('keyup', function(ev){
							if( $(this).val() !== '' ){
								$(this).addClass('is-focused');
							}
						})
						.on('blur', function(ev){
							if( $(this).val() === '' ){
								$(this).removeClass('is-focused');
							}
						});

				});
			}

		},

		enable_laptop_slider : function( content ){

			function slideChange(args) {
				var iosSlider = args.sliderContainerObject,
					detailsBlock = iosSlider.attr('data-details');

				// Details blocks
				if(typeof detailsBlock != 'undefined'){
					$(detailsBlock).find('.ls_slide_item-details').removeClass('selected');
					$(detailsBlock).find('.ls_slide_item-details:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');
				}
				// bullets
				$(iosSlider).closest('.ls__laptop-mask').find('.ls__nav .ls__nav-item').removeClass('selected');
				$(iosSlider).closest('.ls__laptop-mask').find('.ls__nav .ls__nav-item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

				// Item active class
				$(iosSlider).find('.ls__slider-item').removeClass('item--active');
				$(iosSlider).find('.ls__slider-item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('item--active');
			}

			function sliderLoaded(args) {
				slideChange(args);
				args.sliderContainerObject.closest('.kl-slideshow').addClass('kl-slider-loaded');
			}

			var elements = content.find('.zn_laptop_slider');

			if(elements && elements.length && elements.find('.ls__slider-item').length){
				$.each( elements , function(i, e){
					var self = $(e);
					if(typeof($.fn.iosSlider) != 'undefined') {
						self.iosSlider({
							snapToChildren: true,
							desktopClickDrag: true,
							keyboardControls: true,
							autoSlideTimer: parseInt( self.attr('data-trans') ),
							navNextSelector: self.closest('.ls__laptop-mask').find('.ls__arrow-right'),
							navPrevSelector: self.closest('.ls__laptop-mask').find('.ls__arrow-left'),
							navSlideSelector: self.closest('.ls__laptop-mask').find('.ls__nav .ls__nav-item'),
							scrollbar: false,
							onSliderLoaded: sliderLoaded,
							onSlideChange: slideChange,
							infiniteSlider: true,
							autoSlide: self.attr('data-autoplay')
						});
					}
					$( window ).on( 'debouncedresize' , function(){
						if(typeof($.fn.iosSlider) != 'undefined') {
							self.iosSlider('update');
						}
					}).trigger('debouncedresize');
				});
			}

			// Prevent default for bullet navigation
			$( content ).find('.ls__nav-item').click(function(e){ return false; });
		},

		enable_latest_posts_accordion : function( content ){
			var elements = content.find('.css3accordion');
			if(elements && elements.length > 0){
				elements.each(function(i,el){
					$(el).find('.inner-acc').css('width', $(el).width() /2 );
					$(window).on('resize zn_tabs_refresh zn_slide_refresh', function(event) {
						$(el).find('.inner-acc').css('width', $(el).width() /2 );
					});
				});
			}
		},

		enable_portfolio_sortable : function( content ) {

			var wpkznSelector = $(content).find("ul#thumbs");
			if( wpkznSelector.length === 0) { return; }

			function getHashFilter() {
				var hash = location.hash;
				if(hash){
					return decodeURIComponent( hash );
				}
				return false;
			}

			var kl_ptf_sortable = $(wpkznSelector).closest('.kl-ptfsortable'),
				sortbyList = kl_ptf_sortable.find('#sortBy'),
				sortBy = kl_ptf_sortable.is('[data-sortby]') ? kl_ptf_sortable.attr('data-sortby') : 'date',
				sortDirList = kl_ptf_sortable.find('#sort-direction'),
				sortAscending = kl_ptf_sortable.is('[data-sortdir]') && kl_ptf_sortable.attr('data-sortdir') == 'asc' ? true : false,
				layoutMode = wpkznSelector.is('[data-layout-mode]') ? wpkznSelector.attr('data-layout-mode') : 'masonry';

			var theFilter;
			var hashFilter = getHashFilter();
			var $ptNav = $(content).find('#portfolio-nav');

			if( !hashFilter ){
				theFilter = $ptNav.find('li.current a').attr('data-filter');
			}
			// if hash found
			else {
				var hashItem = $ptNav.find('a[href="'+ hashFilter +'"]');
				theFilter = hashItem.attr('data-filter');
				hashItem.parent().siblings('li').removeClass('current');
				hashItem.parent().addClass('current');
			}

			wpkznSelector.imagesLoaded( function() {
				wpkznSelector.isotope({
					itemSelector: ".item",
					animationEngine: "jquery",
					animationOptions: {
						duration: 250,
						easing: "easeOutExpo",
						queue: false
					},
					layoutMode: layoutMode,
					filter: theFilter,
					sortBy: sortBy,
					sortAscending: sortAscending,
					getSortData: {
						name: '.name',
						date: '[data-date] parseInt'
					}
				});
				// End isotope

				$(window).on('debouncedresize zn_tabs_refresh zn_slide_refresh', function(event) {
					wpkznSelector.isotope('layout');
				});

			});

			//#1 Filtering
			$ptNav.on( 'click', '.kl-ptfsortable-nav-link', function(e) {
				var $t = $(this);

				if( $t.attr('href') === '#' ){ e.preventDefault();}

				$ptNav.children('li').removeClass('current');
				$t.parent().addClass('current');
				wpkznSelector.isotope({filter: $t.data('filter')});
				wpkznSelector.isotope('updateSortData').isotope();
			});

			//#! Sorting (name | date)
			var b_elements = sortbyList.find('li a');
			if(b_elements && b_elements.length > 0){
				b_elements.removeClass('selected');
				$.each(b_elements, function(index, element) {
					var t = $(element),
						csb = t.data('optionValue');
					if(csb == sortBy){
						t.addClass('selected');
					}
				});

				b_elements.on('click', function(e){
					e.preventDefault();
					b_elements.removeClass('selected');
					$(this).addClass('selected');
					sortBy = $(this).data('optionValue');
					wpkznSelector.isotope({sortBy: $(this).data('optionValue')});
					wpkznSelector.isotope('updateSortData').isotope();
				});

			}

			//#! Sorting Direction (asc | desc)
			var c_elements = sortDirList.find('li a');
			if(c_elements && c_elements.length > 0) {
				c_elements.removeClass('selected');
				$.each(c_elements,function(index, element) {
					var t = $(element),
						csv = t.data('option-value');

					if(csv == sortAscending){
						t.addClass('selected');
					}

				});

				c_elements.on('click', function(e){
					e.preventDefault();
					c_elements.removeClass('selected');
					$(this).addClass('selected');
					wpkznSelector.isotope({sortAscending: $(this).data('option-value'), sortBy: sortBy});
					wpkznSelector.isotope('updateSortData').isotope();
				});

			}

		},

		enable_gridphotogallery : function( content ){
			var gridPhotoGallery = content.find('.gridPhotoGallery:not(.stop-isotope)');
			if(typeof($.fn.isotope) != 'undefined') {
				$.each(gridPhotoGallery, function(i, el) {
					var $el = $(el),
						itemWidth = Math.floor( $(el).width() / $el.attr('data-cols') ),
						layoutType = $el.is('[data-layout]') ? $el.attr('data-layout') : 'masonry';

					// Find better fix when JS files can be loaded dynamically
					// in the future updates
					if($('body').hasClass('zn_pb_editor_enabled')){
						if(layoutType == 'packery') {
							layoutType = 'masonry';
						}
					}

					var doIsotope = $el.isotope({
						layoutMode: layoutType,
						itemSelector : '.gridPhotoGallery__item',
						layoutType: {
							columnWidth: '.gridPhotoGallery__item--sizer',
							gutter:0
						}
					});
					$el.imagesLoaded(function(){
						doIsotope.isotope('layout');

						$(window).on('debouncedresize zn_tabs_refresh zn_slide_refresh', function(event) {
							$el.isotope('layout');
						});
					});
				});
			}
		},

		enable_nivo_slider : function( content ){
			var elements = $('.nivoslider .nivoSlider');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var slider = $(e),
						transition = slider.attr('data-transition'),
						autoslide = slider.attr('data-autoslide') != '1' ? true : false,
						pausetime = slider.attr('data-pausetime');
					if(typeof($.fn.nivoSlider) != 'undefined') {
						slider.nivoSlider({
							effect:transition,
							boxCols: 8,
							boxRows: 4,
							slices:15,
							animSpeed:500,
							pauseTime: pausetime,
							startSlide:0,
							directionNav:1,
							controlNav:1,
							controlNavThumbs:0,
							pauseOnHover:1,
							manualAdvance: autoslide,
							afterLoad: function(){
								/* slideFirst() */
								setTimeout(function(){
									slider.find('.nivo-caption').animate({left:20, opacity:1}, 500, 'easeOutQuint');
								}, 1000);
							},
							beforeChange: function(){
								/* slideOut() */
								slider.find('.nivo-caption').animate({left:120, opacity:0}, 500, 'easeOutQuint');
							},
							afterChange: function(){
								/* slideIn() */
								slider.find('.nivo-caption').animate({left:20, opacity:1}, 500, 'easeOutQuint');
							}
						});
					}
				});
			}
		},

		enable_recent_works2 : function( content ){
			var elements = content.find('.recent_works2');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {

						var autoplay = self.attr('data-autoplay') ? parseInt(self.data('autoplay')) : 0,
								timeout = self.attr('data-timeout') ? parseInt(self.data('timeout')) : 5000;

						var options = {
							responsive: true,
							scroll: 1,
							auto: false,
							items: {
								width: 350,
								visible: {
									min: 1,
									max: 4
								}
							},
							prev : {
								button	: function(){return self.closest('.recentwork_carousel').find('.prev');},
								key		: "left"
							},
							next : {
								button	: function(){return self.closest('.recentwork_carousel').find('.next');},
								key		: "right"
							},
							swipe: {
								onTouch: true,
								onMouse: false
							}
						};
						if(autoplay > 0  && timeout >= 100){
							options.auto = true;
							options.timeoutDuration = timeout;
						}

						self.carouFredSel(options);

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});
					}
				});
			}
		},

		enable_recent_works3 : function( content ){
			var elements = content.find('.recent_works3');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {
						var autoplay = self.attr('data-autoplay') ? parseInt(self.data('autoplay')) : 0,
								timeout = self.attr('data-timeout') ? parseInt(self.data('timeout')) : 5000;

						var options = {
							responsive: true,
							scroll: 1,
							auto: false,
							items: {
								width: 350,
								visible: {
									min: 1,
									max: 5
								}
							},
							prev : {
								button	: function(){return self.closest('.recentwork_carousel').find('.prev');},
								key		: "left"
							},
							next : {
								button	: function(){return self.closest('.recentwork_carousel').find('.next');},
								key		: "right"
							},
							swipe: {
								onTouch: true,
								onMouse: false
							}
						};
						if(autoplay > 0  && timeout >= 100){
							options.auto = true;
							options.timeoutDuration = timeout;
						}

						self.carouFredSel(options);

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});
					}
				});
			}
		},

		enableLatestPostsCarousel : function( content ){
			var elements = content.find('.lp_carousel');
			if(elements && elements.length && (typeof($.fn.carouFredSel) != 'undefined')){
				$.each(elements, function(i, e){
					var self = $(e);
					self.imagesLoaded( function() {
						self.carouFredSel({
							responsive: true,
							scroll: 1,
							auto: false,
							items: {
								width: 350,
								visible: {
									min: 1,
									max: 3
								}
							},
							prev : {
								button	: function(){return self.closest('.latest-posts-carousel').find('.prev');},
								key		: "left"
							},
							next : {
								button	: function(){return self.closest('.latest-posts-carousel').find('.next');},
								key		: "right"
							},
							swipe: {
								onTouch: true,
								onMouse: false
							}
						});

					});

					$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
						self.trigger('updateSizes');
					});

				});
			}
		},

		enable_screenshoot_box : function( content ){
			var elements = content.find('.zn_screenshot-carousel');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e),
						_pDataAttr = self.attr('data-carousel-pagination'),
						countItems = self.children('li').length;

					if(countItems > 1){
						var options = {
							responsive: true,
							scroll: { fx: "crossfade", duration: "1500" },
							auto: true,
							prev : {
								button	: function(){return self.closest('.thescreenshot').find('.prev');},
								key		: "left"
							},
							next : {
								button	: function(){return self.closest('.thescreenshot').find('.next');},
								key		: "right"
							},
							swipe: {
								onTouch: true,
								onMouse: true
							}
						};

						if(typeof(_pDataAttr) != 'undefined'){
							options.pagination = _pDataAttr;
						}

						if(typeof($.fn.carouFredSel) != 'undefined') {
							self.imagesLoaded( function() {
								self.carouFredSel(options);
							});

							$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
								self.trigger('updateSizes');
							});
						}
					}
				});
			}
		},

		enable_wow_slider : function( content ){
			var elements = content.find('.th-wowslider');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.wowSlider) != 'undefined') {
						self.wowSlider({
							effect: self.attr('data-transition'),
							duration:900,
							delay: self.is('[data-timeout]') ? self.attr('data-timeout') : 3000,
							width:1170,
							height:470,
							cols:6,
							autoPlay: self.attr('data-autoplay'),
							stopOnHover:true,
							loop:true,
							bullets:true,
							caption:true,
							controls:true,
							captionEffect:"slide",
							logo:"image/loading_light.gif",
							images:0,
							onStep: function(){
								self.addClass('transitioning');
								setTimeout(function(){
									self.removeClass('transitioning');
								}, 1400);

							}
						});
					}
				});
			}
		},

		enable_mailchimp_subscribe : function( content ){
			var element = content.find('.nl-submit');
			if(element && element.length){
				element.each(function(index, el) {
					$(el).on('click', function(e) {
						e.preventDefault();
						var self = $(this),
							ajax_url = self.parent().attr('data-url'),
							email_field = self.parent().find('.nl-email').val(),
							result_placeholder = self.parent().next('.zn_mailchimp_result');

						if(email_field === ''){
							self.parent().addClass('has-error');
							return;
						}

						$.post( ZnThemeAjax.ajaxurl, {
							action:'zn_mailchimp_register',
							zn_mc_email: email_field,
							zn_mailchimp_list: self.parent().find('.nl-lid').val(),
						}).success(function( data ){
							result_placeholder.html(data);
						}).error(function() {
							result_placeholder.html('ERROR.').css('color', 'red');
					   });

					});
				});
			}
		},

		enable_sc_showroomcarousel : function( content ){
			var elements = content.find(".sc__showroom-carousel");
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var $this = $(e),
						$speed = $this.attr("data-speed"),
						$pagination = $('<div class="shcar__pagination"></div>');

					if( $this.attr("data-pag") && $this.attr("data-pag") == "1" )
						$this.parent().find('.shcar__nav_pag').prepend($pagination);
					if(typeof($.fn.carouFredSel) != 'undefined') {
						$this.imagesLoaded( function() {
							$this.carouFredSel({
								responsive:true,
								scroll: { pauseOnHover: true },
								auto: { timeoutDuration: parseInt($speed) },
								items: {
									width: 280,
									visible: { min: 1, max: 3 }
								},
								pagination: {
									container: $this.parent().find('.shcar__pagination'),
									anchorBuilder: function(nr, item) {
										return '<a href="#'+nr+'"></a>';
									}
								},
								prev : {
									button	: function(){return $this.closest('.sc__shcar-wrapper').find('.shcar__nav-prev');},
									key		: "left"
								},
								next : {
									button	: function(){return $this.closest('.sc__shcar-wrapper').find('.shcar__nav-next');},
									key		: "right"
								},
								swipe: {
									onTouch: true,
									onMouse: true
								}
							});
						});
					}
				});
			}
		},

		enable_testimonial_fader : function( content ){
			var elements = content.find(".testimonials_fader_trigger");
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive:true,
							auto:  self.is('[data-autoplay]') && self.attr('data-autoplay') == '1' ? true : false,
							scroll: {
								timeoutDuration : self.is('[data-speed]') ? parseInt(self.attr('data-speed')) : '2500',
								fx: "fade",
								duration: 1500
							},
							prev	: {
								button	: function(){return self.closest('.elm-testimonial-fader').find('.prev');},
								key		: "left"
							},
							next	: {
								button	: function(){return self.closest('.elm-testimonial-fader').find('.next');},
								key		: "right"
							},
							swipe: {
								onTouch: true,
								onMouse: false
							}
						});

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});
					}
				});
			}
		},

		enable_twitter_fader : function( content ){
			var elements = content.find(".twitterFeed");
			if(elements && elements.length && (typeof($.fn.carouFredSel) != 'undefined')){
				$.each(elements, function(i, e){
					var speed = 5000;
					var self = $(e);
					if(typeof(self.data('entries')) != 'undefined') {
						self.carouFredSel({
							responsive:true,
							auto: {timeoutDuration: speed},
							scroll: {
								fx: "fade",
								duration: 1500
							},
							items: {
								visible: {
									min: 1,
									max: 1
								}
							},
							swipe: {
								onTouch: true,
								onMouse: false
							}
						});

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});
					}
				});
			}
		},

		enable_testimonial_slider : function( content ){
			var elements = content.find('.zn_testimonials_carousel');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive: true,
							items: { width: 300 },
							auto:  self.is('[data-autoplay]') && self.attr('data-autoplay') == '1' ? true : false,
							scroll: {
								timeoutDuration : self.is('[data-speed]') ? parseInt(self.attr('data-speed')) : '2500'
							},
							prev	: {
								button	: function(){return self.closest('.testimonials-carousel').find('.prev');},
								key		: "left"
							},
							next	: {
								button	: function(){return self.closest('.testimonials-carousel').find('.next');},
								key		: "right"
							},
							swipe: {
								onTouch: true,
								onMouse: false
							}
						});

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});

					}
				});
			}
		},

		enable_shop_limited_offers : function( content ){
			var elements = content.find('.zn_limited_offers');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					// var speed = $(e).data("speed");
					if(typeof($.fn.carouFredSel) != 'undefined') {

						var autoplay = self.attr('data-autoplay') == '1' ? true : false;

						self.imagesLoaded(function(){
							self.carouFredSel({
								responsive: true,
								width: '92%',
								scroll: {
									items           : 1,
									easing          : "easeInOutExpo",
									duration		: 1000,
									pauseOnHover    : true,
									timeoutDuration: self.is("[data-timeout]") ? parseFloat( self.data('timeout') ) : 6000
								},
								auto: autoplay,
								items: {width:190, visible: { min: 2, max: 4 } },
								prev	: {
									button	: function(){return self.closest('.limited-offers-carousel').find('.prev');},
									key		: "left"
								},
								next	: {
									button	: function(){return self.closest('.limited-offers-carousel').find('.next');},
									key		: "right"
								},
								swipe: {
									onTouch: true,
									onMouse: false
								}
							});
						});

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							self.trigger('updateSizes');
						});
					}
				});
			}
		},

		enable_static_weather : function( content ){

			var elements = content.find('.sc__weather');

			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e),
						loc = self.attr('data-location') ? self.attr('data-location') : '';

					if( typeof($.simpleWeather) != 'undefined') {

						$.simpleWeather({
							woeid: self.attr('data-woeid'),
							location: loc,
							unit: self.attr('data-unit'),
							success: function(weather) {

								html = '<ul class="scw_list clearfix">';

								var frc_len = weather.forecast.length > 5 ? 5 : weather.forecast.length;

								for(var i=0;i<frc_len;i++) {
									html += '<li><i class="wt-icon wt-icon-'+weather.code+'"></i>';
									html += '<div class="scw__degs">';
									html += '<span class="scw__high">'+weather.forecast[i].high+'&deg;<span class="uppercase">'+weather.units.temp+'</span></span>';
									html += '<span class="scw__low">'+weather.forecast[i].low+'</span>';
									html += '</div>';
									html += '<span class="scw__day">' + znLocalizeDay(weather.forecast[i].day)+'</span>';
									html += '<span class="scw__alt">' + weather.forecast[i].alt.high+'&deg;<span class="uppercase">'+ weather.alt.unit +'</span></span>';
									html += '</li>';
								}
								html += '</ul>';

								jQuery(self).html(html);
							},
							error: function(error) {
								jQuery(self).html('<p>'+error+'</p>');
								console.warn('Some problems: '+ error);
							}
						});
					}
				});
			}
		},

		enable_diagram: function(content){

			var diagram_el = content.find('.kl-skills-diagram');

			if(diagram_el && diagram_el.length){
				diagram_el.each(function(index, el) {
					if(typeof diagramElement != 'undefined'){
						diagramElement.init( el );
					}
				});
			}

		},

		enable_services: function(content){

			var elements = content.find('.services_box--boxed');

			if(elements && elements.length){
				elements.each(function(index, el) {
					// see how tall the box is and add an extra 30px
					$(el).find('.services_box__list').css('padding-top', $(el).height() + 30 );
					$(el).hover(
						function() {
							$(el).css("z-index", '3' );
						}, function() {
							$( this ).removeAttr( 'style' );
						}
					);
				});

				$(window).on('debouncedresize zn_tabs_refresh zn_slide_refresh', function(){
					elements.each(function(index, el) {
						// see how tall the box is and add an extra 30px
						$(el).find('.services_box__list').css('padding-top', $(el).height() + 30 );
					});
				});
			}
		},

		enable_shoplatest_presentation: function(content){

			var lists = content.find('.shop-latest-carousel.spp-carousel--enabled > ul');
			if(lists && lists.length > 0) {
				lists.each(function (index, element) {
					var $el = $(element),
						visible = ( $el.is('[data-visible]') ? parseInt( $el.attr('data-visible') ) : 4 );

					if(typeof($.fn.carouFredSel) != 'undefined') {
						$el.imagesLoaded( function() {
							$el.carouFredSel({
								responsive: true,
								auto:  $el.is('[data-autoplay]') && $el.attr('data-autoplay') == 'yes' ? true : false,
								scroll: {
									items: 1,
									timeoutDuration : $el.is('[data-timeout]') ? parseInt($el.attr('data-timeout')) : '5000'
								},
								// height: 475,
								items: {
									// width: items_width,
									height: 'variable',
									visible: {min: 1, max: visible}
								},
								prev: {button: $el.closest('.shop-latest-carousel').find('a.prev'), key: 'left'},
								next: {button: $el.closest('.shop-latest-carousel').find('a.next'), key: 'right'},
								swipe: {
									onTouch: true,
									onMouse: false
								}
							});

						});

						$( window ).on( 'zn_tabs_refresh zn_slide_refresh' , function(){
							$el.trigger('updateSizes');
						});
					}
				});
			}
		},

		enable_scrollspy: function(content){

			var url = location.href.replace(/#.*/,''),
				isOnePageMenu = true;

			$(window).on('scroll', debounce(function() {

				// TODO: Try http://stackoverflow.com/a/15591162/1134145

				if(isOnePageMenu) {

					var fromTop = $(this).scrollTop(),
						lastId = false,
						the_offset = -3,
						topMenu = $('#main-menu, .chaser, .elm-custommenu, #zn-res-menu'),
						menuItems = topMenu.find("a"),

						scrollItems = menuItems.map(function () {
							var href = $(this).is('[href]') ? $(this).attr('href').replace(url,'') : '';
							var item = $($(this.hash.replace(/([ ;?%&,.+*~\':"!^$[\]()=>|\/@])/g,'\\$1')));
							if (item.length) {
								return item;
							}
						});

					if(!scrollItems.length) {
						isOnePageMenu = false;
						return;
					}

					// CALCULATE EXTRA PADDING IN CASE WE HAVE WPADMINBAR AND MENU STYLE 1
					the_offset = getTopOffset(the_offset);

					// Get id of current scroll item
					var elements = [];
					var last_offset = 0;
					var cur = scrollItems.map(function (i, val){
						// If the current offset < current scroll
						var current_offset = $(this).offset().top + the_offset;
						if ( current_offset <= fromTop  ) {
							elements[i] = this;

						}
					});

					// Get the id of the current element
					cur = elements[elements.length - 1];
					var id = cur && cur.length ? cur[0].id : "zn_invalid_id";

					if (lastId !== id) {
						lastId = id;

						// Check if the menu has such an item
						if( topMenu.find('a[href*="#' + id + '"]').length > 0 && id != 'zn_invalid_id' ) {

							topMenu.find("li").removeClass("current_page_item current-menu-item active");
							$('a[href*="#' + id + '"]').parent().addClass("current_page_item current-menu-item active");
						}

					}
				}

			},100)).trigger('scroll');

		},

		enable_tooltips: function(content){
			// activate tooltips
			var tooltips = content.find('[data-toggle="tooltip"], [data-rel="tooltip"]');
			if(tooltips && tooltips.length > 0) {
				tooltips.tooltip();
			}
		},

		enable_customMenuDropdown: function(content){

			var ddmenu = content.find('.elm-custommenu--dd');
			if(ddmenu.length){
				var $ddmenu_pick = ddmenu.find('.elm-custommenu-pick');
				$ddmenu_pick.on('click', function(event) {
					ddmenu.toggleClass('is-opened');
				});
				// Close on click outside
				$(document).on('click', function(e){
					if(ddmenu.hasClass('is-opened')){
						ddmenu.removeClass('is-opened');
					}
				});
				ddmenu.on('click', function(event) {
					event.stopPropagation();
				});
			}
		},

		general_wc_stuff: function(content) {

			// Toggle review form in WC product page (tabs)
			content.find('.prodpage-style2 #reviews .comment-respond .comment-reply-title, .prodpage-style3 #reviews .comment-respond .comment-reply-title').each(function(index, el) {
				$(el).on('click', function(){
					$(el).toggleClass('opened-form');
					$(el).next('.comment-form').toggleClass('show-form');
				});
			});
		},

		init_animations : function(){
			if(typeof WOW != 'undefined'){
				var args = {
					boxClass: 'wow:not(.no_animation)'
				};
				new WOW(args).init();
			}
		},

		init_skill_bars: function(scope){

			var skillBarContainers = $(scope).find('.skills_wgt');
			// Set transitions for main containers
			var liElements = $('li', skillBarContainers);
			if(liElements && liElements.length > 0)
			{

				// Skill bars
				var cssRules = '';

				$.each(skillBarContainers, function (i, e) {
					var container = $(e),
						loaded = false;

					var doBars = function(){

						 var start = 0.2;
						var skillBars = $('.skill-bar', container);

						$.each(skillBars, function (j, v) {
							var element = $(v);
							var percentage = element.data('loaded'),
								$i = $('.skill-bar-inner', element);

							$(container).addClass('started');

							/* increment transition step */
							start += 0.1;
							$i.css('-webkit-transition-delay', start+'s');
							$i.css(' transition-delay: '+start+'s');
							$i.css('width', percentage+'%'); // Set the width
						});
					};

					  if(!loaded) {
						if(container.is( ':in-viewport' )){
							doBars();
							loaded = true;
						}
						$(window).on('scroll', debounce(function() {
							if(container.is( ':in-viewport' )){
								doBars();
								loaded = true;
							}
						}, 500));
					}
				});
			}
		},

		ph_gallery_slideshow: function(scope){

			var gal = $(scope).find('.elm-phg--sld');

			if(gal.length > 0){

				gal.each(function(index, el) {

					var $el = $(el),
						$carousel = $el.find('.elm-phg-slideshow'),
						$pager = $el.find('.elm-phg-slideshow-pager'),
						$arrows = $el.find('.elm-phg-slideshow-arrows');

					if(typeof($.fn.carouFredSel) != 'undefined') {

						var getCenterThumb = function() {
							var $visible = $pager.triggerHandler( 'currentVisible' ),
								center = Math.floor($visible.length / 2);
							return center;
						};

						$el.imagesLoaded( function() {

							// defaults
							var autoplay = $carousel.is('[data-autoplay]') ? true : false,
								timeoutDuration = $carousel.is('[data-timeoutduration]') && $carousel.attr('data-timeoutduration') ? $carousel.attr('data-timeoutduration') : 6000;

							var carouselOptions = {
								responsive: true,
								auto: {
									play: autoplay
								},
								items: {
									visible: 1,
									height: 'variable'
								},
								scroll: {
									fx: 'crossfade',
									timeoutDuration: parseFloat(timeoutDuration)
								},
								prev : {},
								next : {},
								swipe: {
									onTouch: true,
									onMouse: true
								}
							};

							if($pager.length > 0){
								carouselOptions.scroll.onBefore = function( data ) {
									var eq = data.items.visible.first().attr( 'data-eq' );
									$pager.trigger( 'slideTo', [ 'li[data-eq="'+ eq +'"]', -getCenterThumb() ] );
									$pager.find( 'li' ).removeClass( 'selected' );
								};
								carouselOptions.scroll.onAfter = function() {
									$pager.find( 'li' ).eq( getCenterThumb() ).addClass( 'selected' );
								};
							}

							if($arrows.length > 0){
								carouselOptions.prev.button = function(){ return $el.find('.elm-phg-slideshow-prev'); };
								carouselOptions.prev.key = "left";
								carouselOptions.next.button = function(){ return $el.find('.elm-phg-slideshow-next'); };
								carouselOptions.next.key = "right";
							}

							$carousel.carouFredSel(carouselOptions);

							// Pager
							if($pager.length > 0){

								$pager.carouFredSel({
									width: '100%',
									auto: false,
									height: 80,
									items: {
										visible: 'odd'
									},
									onCreate: function(data) {

										var center = getCenterThumb();
										$pager.trigger( 'slideTo', [ -center, { duration: 0 } ] );
										$pager.find( 'li' ).eq( center ).addClass( 'selected' );

										$(window).trigger('resize zn_tabs_refresh zn_slide_refresh');
									}
								});

								$pager.find( 'li' ).on('click', function() {
									var eq = $(this).attr( 'data-eq' );
									$carousel.trigger( 'slideTo', [ 'li[data-eq="'+ eq +'"]' ] );
								});
							}

							$(window).on('debouncedresize zn_tabs_refresh zn_slide_refresh', function(event) {
								$carousel.trigger('updateSizes');
								if($pager.length > 0){
									$pager.trigger('updateSizes');
								}
							});

						}).done( function( instance ) {
							$el.find('.fake-loading').fadeOut('slow');
						});
					}
				});
			}


		},

		general_stuff: function(content) {

			// Fallback for IE's missing object-fit
			if (typeof Modernizr == 'object') {
				if ( ! Modernizr.objectfit ) {
					$(['cover', 'contain']).each(function(index, el) {
						$('.'+el+'-fit-img').each(function () {
							var $container = $(this),
								imgUrl = $container.prop('src'),
								imgClasses = $container.prop('class');
							if (imgUrl) {
								$container.wrap('<div class="' + imgClasses + ' '+el+'-fit-img-fallback" style="background-image:url(' + imgUrl + ');"></div>');
							}
						});
					});
				}
			}

			// Mobile logo
			var logo_img = content.find('.site-logo-img');
			if( logo_img.length > 0 && logo_img.is('[data-mobile-logo]') ){
				var initial_src = logo_img.attr('src');
				$( window ).on( 'debouncedresize' , function(){
					if( window.matchMedia( "(max-width: 767px)" ).matches ){
						logo_img.attr('src', logo_img.attr('data-mobile-logo'));
					} else {
						logo_img.attr('src', initial_src);
					}
				}).trigger('debouncedresize');
			}

			// Enable Hidden panel through menu
			content.find('.show-top-hidden-panel > .main-menu-link').on('click', function(event) {
				event.preventDefault();
				$('#sliding_panel').addClass('is-opened');
			});



		}

	};

	// Helper Functions
	function IsJsonString(a) {
		try {
			JSON.parse(a);
		} catch (e) {
			return false;
		}
		return true;
	}
	function is_null(a) {
		return (a === null);
	}
	function is_undefined(a) {
		return (typeof a == 'undefined' || a === null || a === '' || a === 'undefined');
	}
	function is_number(a) {
		return ((a instanceof Number || typeof a == 'number') && !isNaN(a));
	}
	function is_true(a) {
		return (a === true || a === 'true');
	}
	function is_false(a) {
		return (a === false || a === 'false');
	}

	var getTopOffset = function(offset){

		var theOffset = offset || 0;

		if( $('#wpadminbar').length > 0 ){
			theOffset -= $('#wpadminbar').outerHeight();
		}
		if( $('.chaser').length > 0 ){
			theOffset -= $('.chaser').outerHeight();
		}
		if( $('#header.header--sticky').length > 0 ){
			theOffset -= $('.header--is-sticked #header').outerHeight();
		}
		return theOffset;

	};

	var dnow = Date.now || function() {
		return new Date().getTime();
	};

	var throttle = function(func, wait, options) {
		var timeout, context, args, result;
		var previous = 0;
		if (!options) options = {};

		var later = function() {
			previous = options.leading === false ? 0 : dnow();
			timeout = null;
			result = func.apply(context, args);
			if (!timeout) context = args = null;
		};

		var throttled = function() {
			var now = dnow();
			if (!previous && options.leading === false) previous = now;
			var remaining = wait - (now - previous);
			context = this;
			args = arguments;
			if (remaining <= 0 || remaining > wait) {
				if (timeout) {
					clearTimeout(timeout);
					timeout = null;
				}
				previous = now;
				result = func.apply(context, args);
				if (!timeout) context = args = null;
			} else if (!timeout && options.trailing !== false) {
				timeout = setTimeout(later, remaining);
			}
			return result;
		};

		throttled.cancel = function() {
			clearTimeout(timeout);
			previous = 0;
			timeout = context = args = null;
		};

		return throttled;
	};

	// Returns a function, that, as long as it continues to be invoked, will not
	// be triggered. The function will be called after it stops being called for
	// N milliseconds. If `immediate` is passed, trigger the function on the
	// leading edge, instead of the trailing.
	var debounce = function(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

	// Helper vars
	var $w = $(window),
		$body = $('body'),
		hasTouch = (typeof Modernizr == 'object' && Modernizr.touchevents) || false,
		hasTouchMobile = hasTouch && window.matchMedia( "(max-width: 1024px)" ).matches,
		ua = navigator.userAgent,
		isMac = /^Mac/.test(navigator.platform),
		is_mobile_ie = -1 !== ua.indexOf("IEMobile"),
		is_firefox = -1 !== ua.indexOf("Firefox"),
		is_safari = /^((?!chrome|android).)*safari/i.test(ua),
		isAtLeastIE11 = !!(ua.match(/Trident/) && !ua.match(/MSIE/)),
		isIE11 = !!(ua.match(/Trident/) && ua.match(/rv[ :]11/)),
		isIE10 = navigator.userAgent.match("MSIE 10"),
		isIE9 = navigator.userAgent.match("MSIE 9"),
		is_EDGE = /Edge\/12./i.test(ua),
		is_pb = !is_undefined($.ZnPbFactory);

	if (is_EDGE) {
		$body.addClass('is-edge');
	}
	if(isIE11){
		$body.addClass('is-ie11');
	}
	if(is_safari){
		$body.addClass('is-safari');
	}

	// Init ScrollMagic controller
	var scrollMagicController = typeof ScrollMagic !== 'undefined' ? new ScrollMagic.Controller() : undefined;

	// Change behavior of controller
	// to animate scroll instead of jump
	// @used by anchors to trigger scroll
	scrollMagicController.scrollTo(function(target) {
		TweenLite.to(window, 0.5, {
			scrollTo : {
				y : target, // scroll position of the target along y axis
				autoKill : true // allows user to kill scroll action smoothly
			},
			ease : Cubic.easeInOut
		});
	});

	//////  WINDOW LOAD   //////
	$(window).on('load',function () {
		// REMOVE PRELOADER

		var preloader = $('#page-loading');
		if ( preloader.length > 0 ) {
			preloader.fadeOut( "slow", function() {
				preloader.remove();
			});
		}

		// Ref #1562 - Firefox only
		if(is_firefox && window.location.hash.length > 0) {
			var hashOffset = $(window.location.hash).offset();
			if(typeof hashOffset != 'undefined' && !is_undefined(scrollMagicController) ){
				scrollMagicController.scrollTo( getTopOffset( hashOffset.top ) );
			}
		}

	});
	////// END WINDOW LOAD

	$(document).ready(function () {

		// Call this on document ready
		$.themejs = new $.ZnThemeJs();

		// prevent clicking on cart button
		// for touch screens
		if (hasTouchMobile) {
			$('a[href="#"]').on('click', function(e){
				e.preventDefault();
			});
		}

		$('body').bind('added_to_cart',function (evt,ret) {

			// console.log( evt );
			if( ret.zn_added_to_cart.length > 0 ){
				var modal = $( ret.zn_added_to_cart );
				$('body').append(modal);

				// FadeOut and Close the modal after 5 seconds
				 setTimeout(function () {
					$(modal).fadeOut('fast', 'easeInOutExpo',function() {
						$(this).remove();
					});
				 }, 3000);

				$(modal).fadeIn('slow', 'easeInOutExpo',function() {
					modal.find( '.kl-addedtocart-close' ).click(function(e){
						e.preventDefault();
						$(modal).fadeOut('fast', 'easeInOutExpo',function() {
							$(this).remove();
						});
					});
				});
			}
		});


		// Check if Top Sliding panel is opened and close it on scroll
		$(window).on('scroll', debounce(function() {
			// Close Sliding panel when scrolling the page (in sticky header mode)
			var sliding_panel = $('.kl-sticky-header #sliding_panel');
			if(sliding_panel.hasClass('is-opened')){
				sliding_panel.removeClass('is-opened');
				$('#open_sliding_panel').removeClass('is-toggled');
			}
		}, 1000));

		// LOGIN FORM
		var zn_form_login = $('.zn_form_login');
		zn_form_login.each(function(index, el) {
			$(el).on('submit', function(event){
				event.preventDefault();

				var form = $(this),
					warning = false,
					button = $('.zn_sub_button', this),
					values = form.serialize();

				button.addClass('zn_blocked');

				$('input', form).each(function(i, el){
					var $el = $(el);
					if ( !$el.val() ){
						warning = true;
						$el.parent('.form-group').addClass('fg-input-invalid');
					} else {
						$el.parent('.form-group').removeClass('fg-input-invalid');
					}
				});

				if (warning) {
					button.removeClass('zn_blocked');
					return false;
				}

				// if (button.hasClass('zn_blocked')) {
				// 	return false;
				// }

				// button.addClass('zn_blocked');
				//
				$.post(zn_do_login.ajaxurl, values, function (resp)
				{
					var data = $(document.createElement('div')).html(resp);

					if ( $('#login_error', data).length ) {
						var result_block = $('.zn_form_login-result', form);
						result_block.html(data);
						if( result_block.find('.kl-login-box').length ){
							result_block.find('.kl-login-box').magnificPopup({type: 'inline', closeBtnInside:true, showCloseBtn: true, mainClass: 'mfp-fade mfp-bg-lighter'});
						}
						button.removeClass('zn_blocked');
					}
					else {
						if ($('.zn_login_redirect', form).length > 0) {
							$.magnificPopup.close();
							window.location = $('.zn_login_redirect', form).val();
						}
					}
					button.removeClass('zn_blocked');
				});
			});
		});


		// LOST PASSWORD
		var zn_form_lost_pass = $('.zn_form_lost_pass');
		zn_form_lost_pass.on('submit', function(){
			event.preventDefault();

			var form = $(this),
				warning = false,
				button = $('.zn_sub_button', this),
				values = form.serialize() + '&ajax_login=true';

			button.addClass('zn_blocked');

			$('input', form).each(function(i, el){
				var $el = $(el);
				if ( !$el.val() ){
					warning = true;
					$el.parent('.form-group').addClass('fg-input-invalid');
				} else {
					$el.parent('.form-group').removeClass('fg-input-invalid');
				}
			});

			if (warning) {
				button.removeClass('zn_blocked');
				return false;
			}

			// if (button.hasClass('zn_blocked')) {
			// 	return;
			// }
			// button.addClass('zn_blocked');

			$.ajax({
				url: form.attr('action'), data: values, type: 'POST', cache: false, success: function (resp)
				{
					var data = $(document.createElement('div')).html(resp);
					var message;
					if ($('#login_error', data).length) {
						// We have an error
						var error = $('#login_error', data);
						$('.zn_form_login-result', form).html(error);
					}
					else if ($('.message', data).length) {
						message = $('.message', data);
						$('.zn_form_login-result', form).html(message);
					}
					else if( $('.woocommerce-message', data).length ){
						message = $('.woocommerce-message', data);
						$('.zn_form_login-result', form).html(message);
						// console.log('woocommerce message');
					}
					else if( $('.woocommerce-error', data).length ){
						message = $('.woocommerce-error', data);
						$('.zn_form_login-result', form).html(message);
						// console.log('woocommerce message');
					}
					else {
						jQuery.magnificPopup.close();
						window.location = $('.zn_login_redirect', form).val();
					}
					button.removeClass('zn_blocked');
				}, error: function (jqXHR, textStatus, errorThrown){
					$('.zn_form_login-result', form).html(errorThrown);
				}
			});
		});


		/**
		 * WooCommerce Images and Thumbnails
		 */
		if ( typeof ZnWooCommerce != 'undefined' ){

			var doWCThumbsMfp = function(){
				if(typeof($.fn.magnificPopup) != 'undefined')
				{
					// Enable WooCommerce lightbox
					return $('a[data-shop-mfp="image"]').magnificPopup({
						mainClass: 'mfp-fade',
						type: 'image',
						gallery: {enabled:true},
						tLoading: '',
					});
				}
			};

			// Made the shop image to change on HOVER over thumbnails
			if ( ZnWooCommerce.thumbs_behavior == 'yes' ){
				var znwoo_main_imgage = $( 'a.woocommerce-main-image' ).attr( 'href' );

				$('.single_product_main_image, .summary').hover(function(){

					$('.thumbnails',this).find('a').hover(function(el){

						var width  = $('.woocommerce-main-image').width();
						var height = $('.woocommerce-main-image').height();

						var photo_fullsize = $( this ).attr( 'href' );
						$( '.woocommerce-main-image img' ).attr( 'src', photo_fullsize ).attr( 'srcset', photo_fullsize );
						$( '.product:not(.prodpage-style3) .woocommerce-main-image' ).css({'min-width': width,'min-height': height});
					}) ;

				});

				doWCThumbsMfp();

			}
			else if ( ZnWooCommerce.thumbs_behavior == 'click' ){

				var main_img = $( 'a.woocommerce-main-image' );

				$('.single_product_main_image .thumbnails a, .summary.entry-summary .thumbnails a').on('click', function(e){

					e.preventDefault();

					var photo_fullsize = $( this ).attr( 'href' );
					main_img.find( 'img' ).attr( 'src', photo_fullsize ).attr( 'srcset', photo_fullsize );
					main_img.attr( 'href', photo_fullsize );

				});

				main_img.on('click', function(e){
					e.preventDefault();

					var whichOne,
						items = [];

					$('a[data-shop-mfp="image"]:not(.woocommerce-main-image)').each(function(i, el) {
						items.push({
							src: $(el).attr('href'),
							type: 'image'
						});
						if(main_img.attr('href') == $(el).attr('href')){
							whichOne = i;
						}
					});

					if(typeof($.fn.magnificPopup) != 'undefined' && items.length) {

						$.magnificPopup.open({
							gallery:{
								enabled:true
							},
							items: items,
							mainClass: 'mfp-fade',
							tLoading: ''
						}, whichOne );
					}
					else if(main_img.length > 0){
						doWCThumbsMfp().magnificPopup('open');
					}
				});

			}
			else if(ZnWooCommerce.thumbs_behavior == 'zn_dummy_value') {
				doWCThumbsMfp();
			}
			else if(ZnWooCommerce.thumbs_behavior == 'disabled') {
				// nothing
			}
		}


		// --- search panel
		var searchBtn = $('#search .searchBtn'),
			searchPanel = searchBtn.next(),
			searchP = searchBtn.parent();
		if( searchBtn && searchBtn.length > 0 ){
			searchBtn.on('click', function(e){
				e.preventDefault();
				var self = $(this);
				var target = $('span:first-child', self);
				if (!self.hasClass('active')) {
					self.addClass('active');
					target.toggleClass('glyphicon-remove');
					searchPanel.addClass('panel-opened');
				}
				else {
					self.removeClass('active');
					target.toggleClass('glyphicon-remove');
					searchPanel.removeClass('panel-opened');
				}
			});
			if(searchP.hasClass('headsearch--def')){
				$(document).click(function(e){
					var searchBtn = $('#search .searchBtn');
					searchBtn.removeClass('active');
					searchBtn.next().removeClass('panel-opened');
					$('span:first-child', searchBtn).removeClass('glyphicon-remove').addClass('glyphicon-search');
				});
			}
			searchP.click(function (event){
				event.stopPropagation();
			});
		}

		// --- end search panel

		/* scroll to top */
		var toTop = $("#totop");
		if(toTop && toTop.length > 0){
			toTop.on('click',function (e){
				e.preventDefault();
				if( !is_undefined(scrollMagicController) && !hasTouchMobile ){
					scrollMagicController.scrollTo(0);
				}
				else {
					// fallback to JQ
					$('body,html').animate({scrollTop: 0}, 800, 'easeOutExpo');
				}
			});
		}
		// --- end scroll to top

		/* Tonext button - Scrolls to next block (used for fullscreen slider) */
		$(".js-tonext-btn").on('click',function (e) {

			if(hasTouchMobile) return;

			e.preventDefault();
			var endof = $(this).attr('data-endof') ? $(this).attr('data-endof') : false,
				dest = 0;

			if ( endof )
				dest = $(endof).height() + $(endof).offset().top;

			//go to destination
			if(!is_undefined(scrollMagicController) && !hasTouchMobile){
				scrollMagicController.scrollTo( getTopOffset(dest) );
			}
			else {
				// fallback to JQ
				$('html,body').animate({scrollTop: getTopOffset(dest)}, 1000, 'easeOutExpo');
			}
		});

		/* Smooth scroll to id */
		$("a[data-target='smoothscroll'][href*='#']:not([href='#']), .main-menu a[href*='#']:not([href='#']), .elm-custommenu-smooth a[href*='#']:not([href='#'])").on('click',function (e) {

			if(hasTouchMobile) return;

			var url = $(this).attr('href'),
				href = url.substring(url.indexOf('#'));

			if( typeof href !== 'undefined' && href.indexOf("#") != -1 && $(href).length > 0 ) {

				e.preventDefault();

				var offset = getTopOffset( $(href).offset().top );

				//go to destination
				if( $(href).length ){

					if(!is_undefined(scrollMagicController) && !hasTouchMobile){
						scrollMagicController.scrollTo(offset);
					}
					else{
						// fallback to JQ
						$('html,body').animate({scrollTop: offset}, 1000, 'easeOutExpo');
					}

					// if supported by the browser we can even update the URL.
					if (window.history && window.history.pushState) {
						history.pushState("", document.title, href);
					}
				}
			} else {
				console.log('Not a valid link');
			}
		});

		/**
		 * Smoothscroll options
		 */
		if ( typeof ZnSmoothScroll != 'undefined' ){

			if (!hasTouchMobile && !is_mobile_ie && !is_pb) {

				var smOptions = {
						step: 75,
						speed: parseFloat( ZnSmoothScroll.type == 'yes' ? '0.5' : ZnSmoothScroll.type ),
						osx: ZnSmoothScroll.osx || 'no',
						ease: Power2.easeOut,
						target: $('body'),
						container: $(window),
						debug: false // Show some values in the console
					},
					smContainer = smOptions.container,
					smTop = smContainer.scrollTop(),
					smViewport = smContainer.height(),
					smWheel = false;

				if( isMac && smOptions.osx == 'yes' ) return;

				var smTarget = (smOptions.target.selector == 'body') ? ((navigator.userAgent.indexOf('AppleWebKit') !== -1) ? smOptions.target : $('html')) : smContainer;
				// events
				smOptions.target.mousewheel(function (event, delta) {
					smWheel = true;

					if (delta < 0) // down
						smTop = (smTop+smViewport) >= smOptions.target.outerHeight(true) ? smTop : smTop+=smOptions.step;
					else // up
						smTop = smTop <= 0 ? 0 : smTop-=smOptions.step;

					TweenLite.to(smTarget, smOptions.speed, {
						scrollTo : {
							y: smTop,
							autoKill:true
						},
						ease: smOptions.ease,
						overwrite: true,
						onComplete: function(){
							smWheel = false;
						}
					});

					if(smOptions.debug){
						console.log({
							"Delta": delta,
							"Final To": smTop,
							"Speed": smOptions.speed,
							"Step Size": smOptions.step,
							"Easing": smOptions.ease
						});
					}

					return false;
				});

				smContainer
					.on('resize', function (e) {
						smViewport = smContainer.height();
					})
					.on('scroll', function (e) {
						if (!smWheel)
							smTop = smContainer.scrollTop();
					});
			}
		}


		/**
		 * Add a modifier class to an element, upon user defined scrolling target element or number
		 * @forch 					Is the point where, upon scrolling, the class modifier is added. Default is "1".
		 * @targetElementForClass	Target element which will have the modifier class. Default is "body".
		 * @classForVisibleState	Modifier class name. Default is "is--visible".
		 * usage: <tag class="js-scroll-event" data-forch="100" or data-forch="#some_id" data-target="#header" data-visibleclass="is--scrolling" data-hiddenclass="not--scrolling"></tag>
		 */
		$(".js-scroll-event").each(function(index, el) {

			var $el = $(el),
				targetElementForClass = $el.is('[data-target]') ? $el.attr("data-target") : $el,
				classForVisibleState =  $el.is('[data-visibleclass]') ?  $el.attr("data-visibleclass") : 'is--visible',
				classForHiddenState =  $el.is('[data-hiddenclass]') ?  $el.attr("data-hiddenclass") : '';

			var forch = function() {
				var f = 1,
					dataForch = $el.is('[data-forch]') ? $el.attr('data-forch') : '';
				// check if data-forch attribute is added
				if( typeof dataForch !== 'undefined' && dataForch !== ''){
					if( !isNaN(parseFloat(dataForch)) && isFinite(dataForch) ){
						f = parseInt(dataForch);
					}
					else {
						var specifiedElement = $(dataForch).first();
						if(specifiedElement && specifiedElement.length > 0) {
							f = specifiedElement.offset().top;
						}
					}
				}
				return f;
			};

			if(is_undefined(scrollMagicController)) return;

			var scene = new ScrollMagic.Scene({
					offset: forch()
				})
				.setClassToggle($(targetElementForClass)[0], classForVisibleState)
				.addTo(scrollMagicController);

			if(classForHiddenState){
				$(targetElementForClass).addClass(classForHiddenState);
				var outscene = new ScrollMagic.Scene({
						offset: 0,
						duration: forch()
					})
					.setClassToggle($(targetElementForClass)[0], classForHiddenState)
					.addTo(scrollMagicController);
			}
		});


		if (!hasTouchMobile && !is_mobile_ie && !is_pb && !is_undefined(scrollMagicController)) {

			$(".znParallax-background").each(function(index, el) {

				var $el = $(el),
					$bg_el = $el.find('.kl-bg-source__parallaxWrapper');

				if( ! $bg_el.length ) return;

				var $bg_el_img = $bg_el.find('.kl-bg-source__bgimage, .kl-bg-source__video, .kl-bg-source__iframe-wrapper');

				// TODO: make a fallback for firefox / safari with Smooth Scroll disabled
				var is_fallback = Boolean(typeof ZnSmoothScroll == 'undefined' && (is_firefox || is_safari));

				$el.imagesLoaded(function(){

					if($bg_el.length > 0 && !is_fallback){

						// TODO: Improve code & performance

						var ob = {},
							setStuff = function() {
								ob.element_height = $el.outerHeight();
								ob.element_width = $el.outerWidth();
								ob.img_height = $bg_el_img.height();
								ob.img_width = $bg_el_img.width();
								ob.img_ratio = (ob.img_height / ob.img_width);
							},
							getStuff = function() {
								ob.element_height = parseInt(ob.element_height);
								ob.element_width = parseInt(ob.element_width);
								ob.img_height = parseInt(ob.img_height);
								ob.img_width = parseInt(ob.img_width);
								ob.img_ratio = ob.img_ratio;
								return ob;
							},
							update_css = function(){
								var get = getStuff();

								if ((get.element_height/get.element_width) > (get.img_height/get.img_width)){
									$bg_el_img.addClass('wh').removeClass('ww');
								} else {
									$bg_el_img.addClass('ww').removeClass('wh');
								}
							};

						setStuff();
						update_css();

						var bgTween = function(){
							return TweenLite.to( $bg_el[0], 1, {
								y: getStuff().element_height,
								ease: Linear.easeNone,
							});
						};

						var duration = Math.ceil( 100 + (( getStuff().element_height / $w.height() ) * 100 ) ) +'%';
						var parallaxScene = new ScrollMagic.Scene({triggerElement: $el[0], triggerHook: "onEnter", duration: duration})
							.setTween( bgTween() )
							.addTo(scrollMagicController);

						$(window).on('resize', debounce(function(){

							setStuff();
							update_css();

							parallaxScene.removeTween(true);
							parallaxScene.setTween( bgTween() );
						}, 100) );
					}
					else if (is_fallback) {
						$el.addClass('has-parallax-fallback');
					}
				});
			});
		}

		/**
		 * Object Parallax
		 * Recommended for overall elements, but can be used on backgrounds too
		 */

		if (!hasTouchMobile && !is_mobile_ie && !is_pb) {

			var znParallaxObjectController = typeof ScrollMagic !== 'undefined' ? new ScrollMagic.Controller() : undefined;

			if (!is_undefined(znParallaxObjectController) ) {

				$(".znParallax-object").each(function(index, el) {

					var $el = $(el),
						$el0 = $el[0],
						sceneParams = {},
						cssTweenParams = {};

					var params = $el.is("[data-zn-parallax-obj]") && IsJsonString( $el.attr("data-zn-parallax-obj") ) ? JSON.parse( $el.attr("data-zn-parallax-obj") ) : {};

					if($.isEmptyObject(params)) return;

					// Scene Params
					sceneParams.triggerElement = !is_undefined(params.scene.triggerElement) && params.scene.triggerElement !== '' ? $el.closest( params.scene.triggerElement )[0] : $el0;
					sceneParams.triggerHook = !is_undefined(params.scene.triggerHook) && params.scene.triggerHook !== '' ? params.scene.triggerHook : "onEnter";
					sceneParams.offset = !is_undefined(params.scene.offset) && params.scene.offset !== '' ? params.scene.offset : 0;

					sceneParams.duration = "100%";
					if( !is_undefined(params.scene.duration) && params.scene.duration == 'height' ){
						sceneParams.duration = $(params.scene.triggerElement).outerHeight();
					}
					if( !is_undefined(params.scene.duration) && params.scene.duration == 'force_full' ){
						sceneParams.duration = Math.ceil( parseInt(sceneParams.duration) + (( $(params.scene.triggerElement).outerHeight() / $(window).height() ) * 100 ) ) +'%';
					}

					var _reverseTween = !is_undefined(params.tween.reverse) && is_true(params.tween.reverse) ? true : false;
					var _tweenSpeed = !is_undefined(params.tween.speed) && params.tween.speed !== '' ? params.tween.speed : 1;
					var _tweenEasing = !is_undefined(params.tween.easing) && params.tween.easing !== '' ? params.tween.easing : 'Power1.easeOut';
					var is_background = !is_undefined(params.scene.is_background) && is_true(params.scene.is_background) ? true : false;

					var _cssOpacity = {};
					if( ! is_undefined( params.tween.css.opacity ) ) {
						_cssOpacity.from = !is_undefined(params.tween.css.opacity.from) ? parseFloat(params.tween.css.opacity.from) : 0;
						_cssOpacity.to = !is_undefined(params.tween.css.opacity.to) ? parseFloat(params.tween.css.opacity.to) : 1;
					}

					var _cssScale = {};
					if( ! is_undefined( params.tween.css.scale ) ) {
						_cssScale.from = !is_undefined(params.tween.css.scale.from) ? parseFloat(params.tween.css.scale.from) : 0;
						_cssScale.to = !is_undefined(params.tween.css.scale.to) ? parseFloat(params.tween.css.scale.to) : 1;
					}

					var _cssTransformY = {};
					if( ! is_undefined( params.tween.css.y ) ) {
						_cssTransformY.from = !is_undefined(params.tween.css.y.from) ? parseFloat(params.tween.css.y.from) : 0;
						_cssTransformY.to = !is_undefined(params.tween.css.y.to) ? parseFloat(params.tween.css.y.to) : 100;
					}

					// build scene
					$scene = new ScrollMagic.Scene(sceneParams);

					if(!is_background) {

						var distanceProgress = 0,
							getCssProgress = function(from, to, progress){
								if(_reverseTween){
									progress = 1 - progress;
								}
								distanceProgress = from + ( progress * ( to - from ) );
								return distanceProgress;
							},
							doTween = function(e){

								var getProgress = e.progress,
									nTransformY, nScale;

								cssTweenParams.transform = '';

								if(! $.isEmptyObject(_cssOpacity)){
									cssTweenParams.opacity = getCssProgress( _cssOpacity.from, _cssOpacity.to, getProgress );
								}

								if(! $.isEmptyObject(_cssTransformY)){
									nTransformY = getCssProgress( _cssTransformY.from, _cssTransformY.to, getProgress );
									cssTweenParams.transform = "translate3d(0, " + nTransformY + "px, 0)";
								}

								if(! $.isEmptyObject(_cssScale)){
									nScale = getCssProgress( _cssScale.from, _cssScale.to, getProgress );
									cssTweenParams.transform += " scale3d("+ nScale + ", "+ nScale + ", 0)";
								}

								TweenLite.to( $el0, _tweenSpeed, {
									css: cssTweenParams,
									ease: _tweenEasing,
									force3D:true,
									lazy: true
								});
							};

						// Play tween on progress
						$scene.on('progress', throttle(doTween, 100 ));
					}
					else {

						// Just use built-in setTween if background
						$scene.setTween($el0, {
							y: _cssTransformY.to,
							ease: Linear.easeNone,
							lazy: true
						});

					}

					// Uncomment if "is-parallaxing" class is needed
					// $scene.on("enter", function (event) {
					// 	$el.addClass('is-parallaxing');
					// })
					// $scene.on("leave", function (event) {
					// 	$el.removeClass('is-parallaxing');
					// })
					// $scene.addIndicators();
					$scene.addTo( znParallaxObjectController );
				});
			}
		}


		$('.zn_pb_editor_enabled .toggle-header').on('click', function(e){
			e.preventDefault();
			$(this).toggleClass('site-header--hide');
		});

		// Check portfolio content
		$.each( $('.portfolio-item-desc-inner-compacted') , function(i, el){
			var $el = $(el),
				collapseAt = $el.is('[data-collapse-at]') && $el.attr('data-collapse-at') ? $el.attr('data-collapse-at') : 150;
			if( $el.outerHeight() < parseInt(collapseAt) ){
				$el.parent('.portfolio-item-desc').addClass('no-toggle');
			}
		});

		if( window.matchMedia( "(min-width: 992px)" ).matches ){

			// Check portfolio content
			$.each( $('.portfolio-item-content.affixcontent') , function(i, el){

				var $el = $(el);
				var portfolio_page = $el.closest('.hg-portfolio-item');

				portfolio_page.imagesLoaded( function() {

					if(is_undefined(scrollMagicController)  ) return;

					var duration = portfolio_page.outerHeight() - $el.outerHeight();
					var $scene = new ScrollMagic.Scene({triggerElement: portfolio_page[0], triggerHook: "onLeave", duration: duration, offset: getTopOffset( '-30' ) });
					$scene.setPin( $el[0] );
					$scene.addTo(scrollMagicController);

					$(window).on('debouncedresize', function(){
						if( window.matchMedia( "(max-width: 991px)" ).matches ){
							$scene.removePin(true).enabled(false);
						} else {
							if( ! $scene.enabled() ){
								$scene.setPin( $el[0] ).enabled(true);
							}
						}
					});
				});
			});
		}


	});

	// Keep the last tab active
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		// save the latest tab; use cookies if you like 'em better:
		localStorage.setItem('znkl_lastTab', $(this).attr('href'));
		// trigger a window resize
		$(window).trigger('zn_tabs_refresh');
	});

	// go to the latest tab, if it exists:
	var lastTab = localStorage.getItem('znkl_lastTab');
	if (lastTab) {
		$('[href="' + lastTab + '"]').tab('show').addClass('active');
	}

	// trigger debounced resize on accordions
	$(document).on("shown.bs.collapse hidden.bs.collapse", ".collapse", function (event) {
		$(window).trigger('zn_tabs_refresh');
		event.stopPropagation();
	});


/*--------------------------------------------------------------------------------------------------
 Sparkles
 --------------------------------------------------------------------------------------------------*/
	var Spark = function(sparkles_container){
		this.sparkles_container = $(sparkles_container);
		this.s = ["shiny-spark1", "shiny-spark2", "shiny-spark3", "shiny-spark4", "shiny-spark5", "shiny-spark6"];
		this.i = this.s[this.random(this.s.length)];
		this.n = document.createElement("span");
		this.newSpeed().newPoint().display().newPoint().fly();
	};
	Spark.prototype.display = function ()
	{
		$(this.n).attr("class", this.i).css("z-index", this.random(3)).css("top", this.pointY).css("left", this.pointX);
		this.sparkles_container.append(this.n);
		return this;
	};
	Spark.prototype.fly = function ()
	{
		var a = this;
		$(this.n).animate({top: this.pointY, left: this.pointX}, this.speed, "linear", function ()
		{
			a.newSpeed().newPoint().fly();
		});
	};
	Spark.prototype.newSpeed = function ()
	{
		this.speed = (this.random(10) + 5) * 1100;
		return this;
	};
	Spark.prototype.newPoint = function ()
	{
		var parentPos = this.sparkles_container,
			parentSlideshow = parentPos.closest('.kl-slideshow'),
			parentPh = parentPos.closest('.page-subheader');
		if(parentSlideshow.length > 0) {
			parentPos = parentSlideshow;
		} else if(parentPh.length > 0) {
			parentPos = parentPh;
		}
		this.pointX = this.random( parentPos.width() );
		this.pointY = this.random( parentPos.height() );
		return this;
	};
	Spark.prototype.random = function (a)
	{
		return Math.ceil(Math.random() * a) - 1;
	};

})(jQuery);


var onloadCallback = function() {
	jQuery('.zn-recaptcha').each(function(){
		grecaptcha.render( jQuery(this).attr('id'), {
			'sitekey' : jQuery(this).data('sitekey'),
			'theme' : jQuery(this).data('colorscheme')
		});
	});
};

if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
	var msViewportStyle = document.createElement("style");
	msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}"));
	document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
}