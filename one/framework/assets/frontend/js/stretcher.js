/**
* Stretcher
*
* E.g.
* $('#container').thb_stretcher();
* -----------------------------------------------------------------------------
*/
(function($) {
	"use strict";

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