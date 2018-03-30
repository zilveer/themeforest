/**
 * Frontend controller.
 *
 * This file is entitled to manage all the interactions in the frontend.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Assets\Frontend\JS
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

jQuery.thb.items_loading = false;

/**
 * Boot
 * -----------------------------------------------------------------------------
 */
(function($) {
	window.thb_boot_frontend = function( root ) {
		if( !root ) {
			root = $("body");
		}

		// Galleries
		root.find('.thb-gallery').thb_gallery();

		// Media embeds
		if( root.find('video.thb_video_selfhosted, .thb-audio').length ) {
			// root.thb_fitVids();
			root.find('video.thb_video_selfhosted').each(function() {
				$(this).mediaelementplayer({
					pluginPath: thb_system.frontend_js_url + '/',
					loop: $(this).attr('loop') == '1'
				});
			});

			var features = [];

			if( $('body').width() < 1024 && $('body').width() >= 768 ) { // Tablet
				if( !$('body').hasClass('thb-mobile') ) { // Tablet desktop
					features = ['playpause','current','duration', 'volume'];
				}
				else {
					features = ['playpause','progress','current','duration'];
				}
			}
			else if( $('body').width() < 768 ) {
				features = ['playpause','progress','current','duration'];
			}
			else {
				features = ['playpause','progress','current','duration', 'volume'];
			}

			root.find('audio.thb-audio').each(function() {
				$(this).mediaelementplayer({
					pluginPath: thb_system.frontend_js_url + '/',
					'features': features
				});
			});
		}

		root.thb_fitVids();
	};
})(jQuery);

/**
 * Gallery
 * -----------------------------------------------------------------------------
 */
jQuery.thb.config.set('gallery', jQuery.thb.config.defaultKeyName, {
	animation: 'fade',
	animationSpeed: 500,
	slideshowSpeed: 4000,
	smoothHeight: false,
	controlNav: false,
	directionNav: true,
	keyboard: false
});

(function($) {
	/**
	 * Run a gallery.
	 *
	 * @return void
	 */
	$.fn.thb_gallery = function() {

		if( !$(this).flexslider ) {
			return;
		}

		return this.each(function() {
			var el = $(this),
				useConfig = true,
				config = {};

			if( useConfig ) {
				config = $.thb.config.get('gallery', el.attr('data-id'));
			}
			else {
				config = $.thb.config.get('gallery', $.thb.config.defaultKeyName);
			}

			el.flexslider( config );
		});

	};
})(jQuery);

/**
* Google maps
* ------------------------------------------------------------------------------
*/
(function($) {
	$.thb.googleMaps = function() {
		$('.map').googleMap();
	};

	$.fn.googleMap = function() {

		return this.each(function() {
			var data = {},
				atts = ['title', 'height', 'width', 'latlong', 'zoom', 'marker', 'type'];

			for( var key in atts ) {
				data[atts[key]] = $(this).data(atts[key]);
			}

			var latlng = data.latlong.split(',');
			var coord = new google.maps.LatLng( $.trim(latlng[0]), $.trim(latlng[1]) );
			var zoom = data.zoom !== '' ? data.zoom : 10;

			var options = {
				zoom: zoom,
				center: coord,
				mapTypeControl: true,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
				navigationControl: true,
				navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL}
			};

			switch( data.type ) {
				case 'HYBRID':
					options.mapTypeId = google.maps.MapTypeId.HYBRID;
					break;
				case 'SATELLITE':
					options.mapTypeId = google.maps.MapTypeId.SATELLITE;
					break;
				case 'TERRAIN':
					options.mapTypeId = google.maps.MapTypeId.TERRAIN;
					break;
				case 'ROADMAP':
				default:
					options.mapTypeId = google.maps.MapTypeId.ROADMAP;
					break;
			}

			var map = new google.maps.Map( this, options );

			// Marker
			var marker = new google.maps.Marker({
				position: coord,
				map: map,
				title: ''
			});

			if( data.marker !== '' ) {
				// Infowindow
				var infoWindow = new google.maps.InfoWindow({
					content: '<div class="infowindow">' + data.marker + '</div>'
				});

				google.maps.event.addListener(marker, 'click', function() {
					infoWindow.open(map, marker);
				});
			}

			$(this).css({
				width: data.width && data.width !== '' ? data.width : '100%',
				height: data.height
			});

			if ( ! window.thb_google_maps_dont_recenter ) {
				google.maps.event.addListener( map, 'bounds_changed', function() {
					map.setCenter(coord);
				} );
			}

			google.maps.event.trigger(map, 'resize');
			map.setCenter(coord);
		});

	};
})(jQuery);

/**
* Stretcher
*
* E.g.
* $('#container').thb_stretcher();
* -----------------------------------------------------------------------------
*/
(function($) {
	$.fn.thb_stretcher = function( params ) {

		params = $.extend({
			adapt			: true,
			cropFrom		: 'center',
			onSlideLoaded	: function() {},
			onSlidesLoaded	: function() {},
			slides			: '> *'
		}, params);

		return this.each(function() {

			/**
			 * Utilities
			 */
			function calcDim(calc, obj_dimensions, correction) {
				var dim = 'height';
				if( calc == 'height' ) { dim = 'width'; }

				instance.obj[dim] = instance.container[dim];
				instance.obj[calc] = (instance.container[dim] / obj_dimensions[dim]) * obj_dimensions[calc];

				if( correction ) {
					if( instance.obj[calc] >= instance.container[calc] ) {
						instance.obj[calc] = instance.container[calc];
						instance.obj[dim] = (instance.container[calc] / obj_dimensions[calc]) * obj_dimensions[dim];
					}
				}
			}

			function calcContainerDim() {
				instance.container.width = container.width();
				instance.container.height = container.height();
				instance.container.ratio = instance.container.width / instance.container.height;
			}

			/**
			 * Instance
			 * -----------------------------------------------------------------
			 */
			var instance = {
				container: {
					width: 0,
					height: 0,
					ratio: 0
				},

				obj: {
					width: 0,
					height: 0,
					offsetTop: 0,
					offsetLeft: 0
				},

				loadedSlides: 0
			};

			var container = $(this);
			container.data("params", params);

			var slides = container.find( container.data("params").slides );

			calcContainerDim();

			/**
			 * Slide
			 */
			slides.each(function() {
				var type = $(this).attr('data-type') && $(this).attr('data-type') !== '' ? $(this).attr('data-type') : 'image',
					obj = {};

				this.details = {
					'type': type
				};

				if( !container.data("loaded") ) {
					$(this).bind('thb_stretcher.render', function(e, firstLoad) {
						if( this.details.type == 'video' ) {
							obj = $(this).find('iframe');
						}
						else if( this.details.type == 'video-selfhosted' ) {
							obj = $(this).find('div.thb_slideshow_video');
						}
						else {
							if( $(this).is('img') ) {
								obj = $(this);
							}
							else {
								obj = $(this).find('> img');
							}
						}

						var obj_dimensions = {
							height: obj.data('height'),
							width: obj.data('width'),
							ratio: obj.data('width') / obj.data('height')
						};

						var obj_style = {};

						if( this.details.type == 'video' ) {
							// if( container.data("params").adapt ) {
								if( instance.container.ratio < obj_dimensions.ratio ) {
									instance.obj.width = instance.container.width;
									instance.obj.height = instance.obj.width * (1 / obj_dimensions.ratio);

									obj_style['margin-top'] = (instance.container.height - instance.obj.height) / 2;
									obj_style['margin-left'] = 0;
								}
								else {
									instance.obj.height = instance.container.height;
									instance.obj.width = instance.obj.height * (obj_dimensions.ratio);

									obj_style['margin-left'] = (instance.container.width - instance.obj.width) / 2;
									obj_style['margin-top'] = 0;
								}
							// }
							// else {
							// 	obj_style['margin-left'] = 0;
							// 	obj_style['margin-top'] = 0;

							// 	instance.obj.height = instance.container.height;
							// 	instance.obj.width = instance.container.width;
							// }
						}
						else if( this.details.type == 'video-selfhosted' ) {
							// instance.obj.height = instance.obj.width = '100%';
						}
						else {
							if( container.data("params").adapt ) {
								if( obj_dimensions.ratio > 1 ) { // Landscape
									calcDim('width', obj_dimensions, true);
								}
								else if( obj_dimensions.ratio < 1 ) {	// Portrait
									calcDim('height', obj_dimensions, true);
								}
								else { // Square
									if( instance.container.ratio >= 1 ) {
										instance.obj.height = instance.obj.width = instance.container.height;
									}
									else {
										instance.obj.height = instance.obj.width = instance.container.width;
									}
								}
							}
							else {
								if( instance.container.ratio < obj_dimensions.ratio ) {
									calcDim('width', obj_dimensions, false);
								}
								else {
									calcDim('height', obj_dimensions, false);
								}
							}
						}

						if( this.details.type == 'image' ) {
							var offsets = container.data("params").cropFrom.split(' ');

							// Vertical offsets
							if( $.inArray('top', offsets) != -1 ) {
								instance.obj.offsetTop = 0;
							}
							else if( $.inArray('bottom', offsets) != -1 ) {
								instance.obj.offsetTop = instance.container.height - instance.obj.height;
							}
							else {
								instance.obj.offsetTop = ( instance.obj.height - instance.container.height ) / -2;
							}

							// Horizontal offsets
							if( $.inArray('left', offsets) != -1 ) {
								instance.obj.offsetLeft = 0;
							}
							else if( $.inArray('right', offsets) != -1 ) {
								instance.obj.offsetLeft = instance.container.width - instance.obj.width;
							}
							else {
								instance.obj.offsetLeft = ( instance.obj.width - instance.container.width ) / -2;
							}

							obj_style['left'] = instance.obj.offsetLeft;
							obj_style['top'] = instance.obj.offsetTop;
						}

						obj_style['width'] = instance.obj.width;
						obj_style['height'] = instance.obj.height;
						obj_style['position'] = 'relative';
						obj_style['visibility'] = 'visible';

						obj.css(obj_style);

						if( firstLoad ) {
							instance.loadedSlides++;
							container.data("params").onSlideLoaded( obj );

							setTimeout(function() {
								obj.addClass("thb-stretcher-obj-loaded");
							}, 20);

							if( instance.loadedSlides == slides.length ) {
								container.data("params").onSlidesLoaded( slides );
							}
						}
					});
				}
			});

			/**
			 * Loader
			 */
			if( !container.data("loaded") ) {
				container.bind('thb_stretcher.load', function() {
					calcContainerDim();

					slides.each(function(i, slide) {
						var img = {};

						if( slide.details.type == 'image' ) {
							if( $(this).is('img') ) {
								img = $(this);
							}
							else {
								img = $(this).find('> img');
							}

							var src = img.attr('src');

							$.thb.loadImage(img, {
								imageLoaded: function( image, cloned ) {
									image.attr('data-height', cloned.height);
									image.attr('data-width', cloned.width);

									$(slide).trigger('thb_stretcher.render', true);
								}
							});

							img.on('mousedown', function() {
								return false;
							});
						}

						if( slide.details.type == 'video-selfhosted' ) {
							if( !$(slide).data('loadedmetadata') ) {
								$(this).find('video').on("loadedmetadata", function() {
									$("div.thb_video_selfhosted")
										.attr('data-height', this.videoHeight)
										.attr('data-width', this.videoWidth);

									$(slide)
										.data('loadedmetadata', true)
										.trigger('thb_stretcher.render', true);
								});
							}
							else {
								$(slide).trigger('thb_stretcher.render', true);
							}
						}

						if( slide.details.type == 'video' ) {
							if( $(this).find('iframe').length ) {
								var iframe = $(this).find('iframe'),
									iframe_width = iframe.data('ratio').split('/')[0],
									iframe_height = iframe.data('ratio').split('/')[1];

								iframe.attr('data-width', instance.container.width);
								iframe.attr('data-height', instance.container.width / iframe_width * iframe_height );
							}

							$(slide).trigger('thb_stretcher.render', true);
						}
					});
				});
			}

			/**
			 * Resize
			 */
			if( !container.data("loaded") ) {
				container.bind('thb_stretcher.resize', function() {
					calcContainerDim();

					setTimeout(function() {
						slides.each(function(i, slide) {
							$(slide).trigger('thb_stretcher.render');
						});
					}, 10);
				});
			}

			/**
			 * Bindings
			 */
			if( !container.data("loaded") ) {
				$(window).resize(function() {
					container.trigger('thb_stretcher.resize');
				});
				window.onorientationchange = function() {
					container.trigger('thb_stretcher.resize');
				};
			}

			/**
			 * Load
			 */
			container.trigger('thb_stretcher.load');
			container.data("loaded", true);

		});

	};
})(jQuery);

/**
* Video fitter
*
* E.g.
* $('#container').thb_fitVids();
* -----------------------------------------------------------------------------
*/
(function($) {
	$.fn.thb_fitVids = function() {

		return this.each(function() {
			var videos = $(this).find('iframe.thb_video:not(.thb-noFit)');

			videos.each(function() {
				var ratio = $(this).attr('width') / $(this).attr('height'),
					height = 100 * (1 / ratio),
					classes = $(this).data('class');

				if( $(this).data('fixed_height') != '' && $(this).data('fixed_width') != '' ) {
					height = $(this).data('fixed_height') * 100 / $(this).data('fixed_width');
				}

				$(this)
					.wrap('<div class="thb-video-wrapper"></div>')
					.parent()
					.css({
						'position': 'relative',
						'width': "100%",
						'padding-top': height+"%"
					})
					.addClass(classes);

				$(this).css({
					'position': 'absolute',
					'top': 0,
					'left': 0,
					'bottom': 0,
					'right': 0,
					'width': "100%",
					'height': "100%"
				});
			});
		});

	}
})(jQuery);

/**
 * Isotope
 *
 * E.g.
 * $.thb.isotope({
 * 		filter: '#filter',
 * 		itemsContainer: '#worklist',
 * 		itemsClass: '.item',
 * 		pagContainer: '.portfolio-nav',
 * 		useAJAX: true
 * });
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.isotope = function(params, ipar) {

		$.thb.items_loading = false;

		// Isotope elements
		var elements = {
			filter: '#thb-isotope-filter',
			itemsContainer: '#thb-isotope-container',
			itemsClass: '.item',
			pagContainer: '#thb-isotope-pagination',
			useAJAX: false
		};

		$.extend(elements, params);

		var isotopeFilter = $(elements.filter),
			itemsContainer = $(elements.itemsContainer),
			items = $(elements.itemsClass),
			pagContainer = $(elements.pagContainer),
			useFilter = isotopeFilter.length > 0,
			useNav = pagContainer.length > 0;

		// Isotope params
		var isotopeParams = {
			itemSelector: elements.itemsClass,
			animationOptions: {
				duration: 250,
				easing: 'linear',
				queue: false
			},

			onLayout: function() {
				jQuery(window).trigger('resize.isotope');
			}
		};

		$.extend(isotopeParams, ipar);

		// Loading Isotope
		var instance = {

			init: function() {
				itemsContainer.imagesLoaded(function() {
					setTimeout(function() {
						itemsContainer.isotope(isotopeParams, function() {
							$(window).resize(function() {
								itemsContainer.isotope('reLayout');
							});
						});

						if( useFilter ) {
							instance.filterDisplay();
						}

						if( useNav ) {
							instance.attachNavigationEvents();
						}
					}, 10);

					if( items.preload ) {
						items.preload();
					}
				});
			},

			attachFilterEvents: function() {
				var isotopeFilterSelector = isotopeFilter.selector + ' a';

				$(document)
					.on('dblclick', isotopeFilterSelector, function( event ) {
						$(this).trigger('click');

						return false;
					})
					.on('click', isotopeFilterSelector, function( event ) {

						if( !itemsContainer.hasClass("filtering") ) {
							itemsContainer.addClass("filtering");
						}

						isotopeFilter.find(".current").removeClass("current");
						$(this).parent("li").addClass("current");

						if( elements.useAJAX ) {
							if( !jQuery.thb.items_loading ) {
								jQuery.thb.items_loading = true;
								var href = $(this).attr("href");
								instance.refreshPage(href);
							}
						}
						else {
							var href = $(this).attr('data-term-slug');
							var options = {};

							if( href != 'all' )
								options.filter = "."+href;
							else
								options.filter = elements.itemsClass;

							var vis = items.not('.isotope-hidden').length,
								fil = items.filter(options.filter).length;

							if( vis == fil ) {
								itemsContainer.removeClass("filtering");
							}

							itemsContainer.isotope(options, function() {
								itemsContainer.removeClass("filtering");
							});
						}

						return false;
					});
			},

			attachNavigationEvents: function() {
				var pagContainerSelector = pagContainer.selector + ' a';

				$(document)
					.on('dblclick', pagContainerSelector, function( event ) {
						$(this).trigger('click');

						return false;
					})
					.on('click', pagContainerSelector, function( event ) {
						if( elements.useAJAX && !jQuery.thb.items_loading) {
							jQuery.thb.items_loading = true;

							if( !itemsContainer.hasClass("filtering") ) {
								itemsContainer.addClass("filtering");
							}

							var href = $(this).attr("href");

							pagContainer.find(".current").removeClass("current");
							$(this).parent().addClass("current");

							instance.refreshPage(href);

							return false;
						}

						return true;
					});
			},

			filterDisplay: function() {
				if( !elements.useAJAX ) {
					isotopeFilter.find('a').each(function() {
						var href = $(this).attr('data-term-slug');
						if( href != 'all' && $(elements.itemsClass + "." + href).length == 0 ) {
							$(this).parent().remove();
						}
					});
				}

				instance.attachFilterEvents();

				isotopeFilter
					.css({ opacity: 0, visibility: 'visible' })
					.delay(250)
					.animate({ opacity: 1 }, 250);
			},

			loadItems: function(href) {
				if( isotopeFilter != null ) {
					isotopeFilter.find(".loader").addClass("loading");
				}

				$.get(href, function(data) {
					data = "<div>" + data + "</div>";

					var html = $( $(data).find(elements.itemsContainer).html() );
					html = html.filter(function() { return this.nodeType == 1; });

					html.imagesLoaded(function() {
						setTimeout(function() {

							if( useNav ) {
								var navigation = $(data).find(elements.pagContainer).html();

								if( !navigation ) {
									navigation = '';
								}

								pagContainer.html(navigation);
							}

							itemsContainer.isotope( 'insert', html, function() {
								itemsContainer.removeClass("filtering");
							} );

							if( $('.gallery').length ) {
								$('.gallery').imagesLoaded(function() {
									$('.gallery').thb_gallery();
								});
							}

							items = itemsContainer.find(elements.itemsClass);

							if( items.preload ) {
								items.preload();
							}

							if( useFilter ) {
								isotopeFilter.find(".loader").removeClass("loading");
							}

							jQuery.thb.items_loading = false;

						}, 10);
					});

				});
			},

			refreshPage: function(href) {
				items = itemsContainer.find(elements.itemsClass);
				itemsContainer.isotope( 'remove', items );
				setTimeout(function() {
					instance.loadItems(href);
				}, 150);
			}

		}

		// Firing up Isotope
		instance.init();

	}
})(jQuery);

/**
 * Video shortcodes
 * -----------------------------------------------------------------------------
 */
var THB_Video;

(function($) {
	THB_Video = function( id ) {
		var self = this;

		this.id = id;
		this.obj = $("#"+id);
		this.type = this.obj.data("type");

		/**
		 * State
		 */
		this.state = function( code ) {
			var state = "";

			switch( code ) {
				case 0:
					state = "finished";
					break;
				case 1:
					state = "playing";
					break;
				default:
					state = "paused";
					break;
			}

			return state;
		};

		/**
		 * Init
		 */
		this.init = function() {
			switch( this.type ) {
				case "youtube":
					this.api = new YT.Player(this.id, {
						events: {
							onStateChange: function(state) {
								self.obj.trigger("change", [self.state(state.data)]);
							}
						}
					});

					this.play = function() { this.api.playVideo(); };
					this.pause = function() { this.api.pauseVideo(); };
					this.stop = function() { this.api.stopVideo(); };

					break;
				case "vimeo":
					this.api = Froogaloop(this.obj.get(0));

					this.api.addEvent("ready", function(player_id) {
						self.api.addEvent("play", function() {
							self.obj.trigger("change", [self.state(1)]);
						});
						self.api.addEvent("pause", function() {
							self.obj.trigger("change", [self.state(2)]);
						});
						self.api.addEvent("finish", function() {
							self.obj.trigger("change", [self.state(0)]);
						});
					});

					this.play = function() { this.api.api("play"); };
					this.pause = function() { this.api.api("pause"); };
					this.stop = function() { this.api.api("pause"); };

					break;
				default:
					this.api = this.obj.get(0);

					this.api.addEventListener("loadedmetadata", function() {
						self.obj .data('width', self.obj.get(0).videoWidth);
						self.obj.data('height', self.obj.get(0).videoHeight);

						if( self.obj.attr("autoplay") ) {
							self.play();
						}
					}, false);
					this.api.addEventListener("play", function() {
						self.obj.trigger("change", [self.state(1)]);
					}, false);
					this.api.addEventListener("pause", function() {
						self.obj.trigger("change", [self.state(2)]);
					}, false);
					this.api.addEventListener("ended", function() {
						self.obj.trigger("change", [self.state(0)]);
					}, false);

					this.play = function() { this.api.play(); };
					this.pause = function() { this.api.pause(); };
					this.stop = function() { this.api.pause(); };

					break;
			}
		};

		/**
		 * Change
		 */
		this.change = function(state) {};

		this.init();
	};

	$(document).ready(function() {
		if( $(".thb_video[data-type='youtube']").length ) {
			var tag = document.createElement("script");
			tag.src = "http://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		}

		$(".thb_video[data-type='vimeo']").each(function() {
			var id = $(this).attr("id");
			$(this).data( "player", new THB_Video(id) );
		});

		$("video.thb_video_selfhosted").each(function() {
			var id = $(this).attr("id");
			$(this).data( "player", new THB_Video(id) );
		});
	});
})(jQuery);

function onYouTubeIframeAPIReady() {
	jQuery(".thb_video[data-type='youtube']").each(function() {
		var id = jQuery(this).attr("id");
		jQuery(this).data( "player", new THB_Video(id) );
	});
}

/**
 * Form validation
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.fn.thb_validate = function() {
		return this.each(function() {
			$(this).validate({
				rules: {
					contact_name: {
						required: true,
						minlength: 2
					},
					contact_email: {
						required: true,
						email: true
					},
					contact_message: {
						required: true,
						minlength: 10
					}
				},
				submitHandler: function(form) {
					$(form).ajaxSubmit({
						resetForm: false,
						success: function(data) {
							$('#thb-contact-form-result').html('<div class="thb-text message ' + data.type + '">' + data.message + '</div>');
						},
						error: function(request, errordata, errorObject) {
							$('#thb-contact-form-result').html('<div class="thb-text message error">' + errorObject.toString() + '</div>');
						}
					});
				}
			});
		});
	}
})(jQuery);

/**
 * Overlay
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.overlay = function( params ) {

		params = $.extend({
			speed: 180,
			easing: 'easeOutQuad',
			thumbs: '.item-thumb',
			overlay: '.thb-overlay',
			loadingClass: 'loading',
			transparency: 0.6
		}, params);

		if( ! $(params.overlay).length ) {
			return;
		}
		var overlay_opacity = 1;

		var overlay_color = $(params.overlay).css('background-color');

			overlay_color = overlay_color.replace('rgb', 'rgba');
			overlay_color = overlay_color.replace(')', ', ' + params.transparency + ')');

		$(params.overlay)
			.css('background-color', overlay_color );

		$(document)
			// .on('click dblclick', params.overlay, function() {
			// 	return false;
			// })
			.on('mouseenter', params.thumbs, function() {
				var overlay = $(this).find(params.overlay);
				overlay
					.stop()
					.css('visibility', 'visible')
					.animate({
						'opacity': overlay_opacity
					}, params.speed, params.easing);
			})
			.on('mouseleave', params.thumbs, function() {
				var overlay = $(this).find(params.overlay);

				if( overlay.hasClass(params.loadingClass) ) {
					return;
				}

				overlay
					.stop()
					.animate({
						'opacity': 0
					}, params.speed, params.easing, function() {
						$(this).css('visibility', 'hidden');
					});
			});
	};

	$(document).ready(function() {
		$.thb.overlay();
	});
})(jQuery);

/**
 * Remove empty paragraphs
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.removeEmptyParagraphs = function() {
		$('p')
			.filter(function() {
				return $.trim($(this).html()) === '';
			})
			.remove();
	};
})(jQuery);

/**
 * Toggle
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_toggle = function( parameters ) {
		var parameters = jQuery.extend({
			speed: 350,
			easing: 'swing',
			trigger: '.thb-toggle-trigger',
			content: '.thb-toggle-content',
			openClass: 'open',
			before: function() {},
			after: function() {}
		}, parameters);

		return this.each(function() {
			var container = $(this),
				trigger = container.find(parameters.trigger),
				content = container.find(parameters.content);

			/**
			 * Toggle data
			 */
			this.toggle_speed = parameters.speed,
			this.toggle_easing = parameters.easing;
			container.toggle_open = container.hasClass(parameters.openClass);

			/**
			 * Open the toggle
			 */
			container.bind('thb_toggle.open', function() {
				container.addClass(parameters.openClass);
				content.slideDown(this.toggle_speed, this.toggle_easing, function() {
					setTimeout( function() {
						$( window ).trigger( "resize" );

						if ( google && google.maps ) {
							var map = $( ".map" );

							if ( map.length ) {
								map.each( function() {
									google.maps.event.trigger(this, 'resize');
								} );
							}
						}
					}, 10 );
				});
				container.toggle_open = true;
			});

			/**
			 * Close the toggle
			 */
			container.bind('thb_toggle.close', function() {
				container.removeClass(parameters.openClass);
				content.slideUp(this.toggle_speed, this.toggle_easing);
				container.toggle_open = false;
			});

			/**
			 * Before
			 */
			container.bind('thb_toggle.before', parameters.before);

			/**
			 * After
			 */
			container.bind('thb_toggle.after', parameters.after);

			/**
			 * Events
			 */
			trigger.click(function() {
				container.trigger('thb_toggle.before');
				container.trigger( container.toggle_open ? 'thb_toggle.close' : 'thb_toggle.open' );
				container.trigger('thb_toggle.after');

				return false;
			});

			/**
			 * Init
			 */
			if( container.toggle_open ) {
				content.show();
			}
		});
	}

	$(document).ready(function() {
		$('.thb-toggle').thb_toggle();
	});

})(jQuery);

/**
 * Accordion
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_accordion = function( parameters ) {
		var parameters = jQuery.extend({
			toggle: '.thb-toggle',
			speed: 350,
			easing: 'swing'
		}, parameters);

		return this.each(function( i, el ) {
			var container = $(this),
				items = container.find(parameters.toggle);

			items.each(function() {
				$(this).bind('thb_toggle.before', function() {
					this.toggle_speed = parameters.speed;
					this.toggle_easing = parameters.easing;

					items.not( $(this) ).each(function() {
						$(this).trigger('thb_toggle.close');
					});
				});
			});
		});
	}

	$(document).ready(function() {
		$('.thb-accordion').thb_accordion();
	});

})(jQuery);

/**
 * Tabs
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_tabs = function( parameters ) {
		var parameters = jQuery.extend({
			nav: '.thb-tabs-nav',
			tabContents: '.thb-tabs-contents',
			contents: '.thb-tab-content',
			openClass: 'open',
			speed: 350,
			easing: 'swing'
		}, parameters);

		return this.each(function() {
			var container = $(this),
				nav = container.find(parameters.nav),
				triggers = nav.find('a'),
				tabContents = container.find(parameters.tabContents),
				contents = container.find(parameters.contents);

			container.bind('thb_tabs.goto', function(e, i) {
				triggers.parent().removeClass(parameters.openClass);
				triggers
					.eq(i)
					.parent()
					.addClass(parameters.openClass);

				contents
					.hide()
					.eq(i)
						.show();

				setTimeout( function() {
					$( window ).trigger( "resize" );

					if ( google && google.maps ) {
						var map = $( ".map" );

						if ( map.length ) {
							map.each( function() {
								google.maps.event.trigger(this, 'resize');
							} );
						}
					}
				}, 10 );
			});

			triggers.each(function(i, el) {
				$(this).click(function() {
					container.trigger('thb_tabs.goto', [i]);
					return false;
				});
			});

			/**
			 * Init
			 */
			var idx = 0;

			if ( window.location.hash != '' ) {
				triggers.each(function(i, el) {
					var href = $(el).attr("href");

					if ( href == window.location.hash ) {
						idx = i;
					};
				});
			}
			else {
				idx = container.data('open');
			}

			container.trigger('thb_tabs.goto', [idx]);

			tabContents.css('min-height', nav.height());
		});
	};

	$(document).ready(function() {
		$('.thb-tabs').thb_tabs();
	});

})(jQuery);

/**
 * Translations
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.translate = function( key ) {
		if( $.thb.translations[key] ) {
			return $.thb.translations[key];
		}

		return key;
	}
})(jQuery);

/**
 * ****************************************************************************
 * THB menu
 *
 * $("#menu-container").menu();
 * ****************************************************************************
 */
(function($) {

	$.fn.menu = function(params) {

		// Parameters
		// --------------------------------------------------------------------
		var settings = {
			speed: 350,
			display: 'block',
			easing: 'linear',
			openClass: 'current-menu-item',
			'showCallback': function() {},
			'hideCallback': function() {}
		};

		// Parameters
		$.extend(settings, params);

		// Menu instance
		// --------------------------------------------------------------------
		var instance = {

			showSubMenu: function(subMenu) {
				subMenu
					.stop(true, true)
					.css({
						opacity: 0,
						display: settings.display
					})
					.animate({
						opacity: 1
					}, settings.speed, settings.easing, function() {
						settings.showCallback();
					});
			},

			hideSubMenu: function(subMenu) {
				subMenu
					.stop(true, true)
					.animate({
						opacity: 0
					}, settings.speed / 2, settings.easing, function() {
						$(this).hide();
						settings.hideCallback();
					});
			}

		};

		return this.each(function() {
			var menuContainer = $(this),
				menu = menuContainer.find("> ul"),
				menuItems = menu.find("> li"),
				subMenuItems = menuItems.find('li').andSelf();

			menuItems.each(function() {
				var subMenu = $(this).find('> ul');

				if( subMenu.length ) {
					subMenu.css({
						display: 'none'
					});
				}
			});

			// Binding events
			subMenuItems.each(function() {
				var item = $(this),
					subMenu = item.find("> ul");

				if( subMenu.length ) {
					item
						.find('> a')
						.addClass('w-sub');

					item
						.mouseenter(function() {
							$(this).addClass(settings.openClass);
							instance.showSubMenu(subMenu);
						})
						.mouseleave(function() {
							$(this).removeClass(settings.openClass);
							instance.hideSubMenu(subMenu);
						});
				}
			});
		});

	};

})(jQuery);

/**
 * ****************************************************************************
 * THB image scale
 *
 * $("img").thb_image('scale');
 * ****************************************************************************
 */
(function($) {
	var THB_Image = function( image ) {
		var self = this;
		this.src = image.src;
		this.obj = $(image);
		this.mode = "landscape";
		this.container = this.obj.parent();
		this.container.addClass("thb-container");

		// Load
		this.load = function( callback ) {
			$("<img />")
				.one("load", function() {
					callback();
				})
				.attr("src", self.src);
		};

		// Calc
		this.calc = function( width, height ) {
			this.height = $(image).outerHeight();
			this.width = $(image).outerWidth();
			this.ratio = this.width / this.height;

			var projected_height = width / this.ratio,
				projected_width = height * this.ratio;

			if( width > height ) {
				if( projected_width > width ) {
					return this.calcPortrait( height, projected_height );
				}
				else {
					return this.calcLandscape();
				}
			}
			else {
				if( projected_height > height ) {
					return this.calcLandscape();
				}
				else {
					return this.calcPortrait( height, projected_height );
				}
			}
		};

		// Calc portrait
		this.calcPortrait = function( height, projected_height ) {
			this.mode = "portrait";
			var margin_top = Math.round((height - projected_height) / 2);
			return {
				'margin-top': margin_top
			}
		};

		// Calc landscape
		this.calcLandscape = function() {
			this.mode = "landscape";
			return {
				'margin-top': '0'
			};
		};

		// Scale
		this.scale = function() {
			var properties = this.calc( this.container.width(), this.container.height() );

			if( this.mode === "portrait" ) {
				this.container.removeClass("thb-landscape").addClass("thb-portrait");
			}
			else {
				this.container.removeClass("thb-portrait").addClass("thb-landscape");
			}

			$(image).css(properties);
		};
	};

	var methods = {
		calc: function( width, height ) {
			var image = new THB_Image(this);
			return {
				properties: image.calc( width, height ),
				mode: image.mode
			}
		},

		scale: function( params ) {
			params = $.extend( {}, {
				resize: true,
				onImageLoad: function( image ) {
					image.scale();
				}
			}, params);

			return this.each(function() {
				var image = new THB_Image(this);
				image.load(function() {
					params.onImageLoad(image);

					if( params.resize ) {
						$(window).on("resize", function() {
							image.scale();
						});
					}
				});
			});
		}
	};

	$.fn.thb_image = function( method ) {
		if( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		}
	};
})(jQuery);

/*--------------------------------------------------------------------
 * JQuery Plugin: "EqualHeights" & "EqualWidths"
 * by:	Scott Jehl, Todd Parker, Maggie Costello Wachs (http://www.filamentgroup.com)
 *
 * Copyright (c) 2007 Filament Group
 * Licensed under GPL (http://www.opensource.org/licenses/gpl-license.php)
 *
 * Description: Compares the heights or widths of the top-level children of a provided element
 		and sets their min-height to the tallest height (or width to widest width). Sets in em units
 		by default if pxToEm() method is available.
 * Dependencies: jQuery library, pxToEm method	(article: http://www.filamentgroup.com/lab/retaining_scalable_interfaces_with_pixel_to_em_conversion/)
 * Usage Example: $(element).equalHeights();
   						      Optional: to set min-height in px, pass a true argument: $(element).equalHeights(true);
 * Version: 2.0, 07.24.2008
 * Changelog:
 *  08.02.2007 initial Version 1.0
 *  07.24.2008 v 2.0 - added support for widths
--------------------------------------------------------------------*/

(function($) {
	$.fn.equalHeights = function(px) {
		var self = $(this),
			to = null;
		to = setTimeout(function() {
			clearTimeout(to);
			self.children().css('min-height', 'auto');

			self.each(function() {
				var currentTallest = 0;
				$(this).children().each(function(){
					if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
				});

				if (!px && Number.prototype.pxToEm) {
					currentTallest = currentTallest.pxToEm(); //use ems unless px is specified
				}

				$(this).children().css({'min-height': currentTallest});
			});
		}, 150);
	};
})(jQuery);

/**
 * ****************************************************************************
 * Frontend boot
 * ****************************************************************************
 */
jQuery(document).ready(function($) {
	$.thb.googleMaps();
	$.thb.removeEmptyParagraphs();

	thb_boot_frontend();
});