
/*! waitForImages jQuery Plugin - v1.5.0 - 2013-07-20
 * https://github.com/alexanderdickson/waitForImages
 * Copyright (c) 2013 Alex Dickson; Licensed MIT */
(function ($) {
	var o = 'waitForImages';
	$.waitForImages = {
		hasImageProperties: ['backgroundImage', 'listStyleImage', 'borderImage', 'borderCornerImage', 'cursor']
	};
	$.expr[':'].uncached = function (a) {
		if (!$(a).is('img[src!=""]')) {
			return false
		}
		var b = new Image();
		b.src = a.src;
		return !b.complete
	};
	$.fn.waitForImages = function (j, k, l) {
		var m = 0;
		var n = 0;
		if ($.isPlainObject(arguments[0])) {
			l = arguments[0].waitForAll;
			k = arguments[0].each;
			j = arguments[0].finished
		}
		j = j || $.noop;
		k = k || $.noop;
		l = !! l;
		if (!$.isFunction(j) || !$.isFunction(k)) {
			throw new TypeError('An invalid callback was supplied.');
		}
		return this.each(function () {
			var e = $(this);
			var f = [];
			var g = $.waitForImages.hasImageProperties || [];
			var h = /url\(\s*(['"]?)(.*?)\1\s*\)/g;
			if (l) {
				e.find('*').addBack().each(function () {
					var d = $(this);
					if (d.is('img:uncached')) {
						f.push({
							src: d.attr('src'),
							element: d[0]
						})
					}
					$.each(g, function (i, a) {
						var b = d.css(a);
						var c;
						if (!b) {
							return true
						}
						while (c = h.exec(b)) {
							f.push({
								src: c[2],
								element: d[0]
							})
						}
					})
				})
			} else {
				e.find('img:uncached').each(function () {
					f.push({
						src: this.src,
						element: this
					})
				})
			}
			m = f.length;
			n = 0;
			if (m === 0) {
				j.call(e[0])
			}
			$.each(f, function (i, b) {
				var c = new Image();
				$(c).on('load.' + o + ' error.' + o, function (a) {
					n++;
					k.call(b.element, n, m, a.type == 'load');
					if (n == m) {
						j.call(e[0]);
						return false
					}
				});
				c.src = b.src
			})
		})
	}
}(jQuery));


/**
 * Ajax Portfolio
 */
(function ($, window, document, undefined) {
	"use strict";

	var pluginName = "ajaxPortfolio",
		defaults = {
			propertyName: "value",
			extraOffset: 100
		};

	function Plugin(element, options) {
		this.element = $(element);
		this.settings = $.extend({}, defaults, options);
		this.init();

	}
	Plugin.prototype = {
		init: function () {
			var obj = this;

			this.cacheElements();

			this.grid.waitForImages(function () {
				obj.bind_handler();
			});

			MK.utils.eventManager.subscribe('post-addition', obj.cacheElements.bind(this));
		},

		cacheElements: function() {
			var obj = this;

			this.grid = this.element.find('.mk-portfolio-container'), 
			this.items = this.grid.children();

			if (this.items.length < 1) return false; //If no items was found then exit

			this.ajaxDiv = this.element.find('div.ajax-container'), 
			this.filter = this.element.find('#mk-filter-portfolio'), 
			this.loader = this.element.find('.portfolio-loader'), 
			this.triggers = this.items.find('.project-load'), 
			this.closeBtn = this.ajaxDiv.find('.close-ajax'), 
			this.nextBtn = this.ajaxDiv.find('.next-ajax'), 
			this.prevBtn = this.ajaxDiv.find('.prev-ajax'), 
			this.api = {}, 
			this.id = null, 
			this.win = $(window), 
            this.loading = false,
			this.breakpointT = 989, 
			this.breakpointP = 767, 
			this.columns = this.grid.data('columns'), 
			this.real_col = this.columns;
			if (this.items.length == 1) {
				this.nextBtn.hide();
				this.prevBtn.hide();
			} else {
                this.nextBtn.show();
                this.prevBtn.show();
            }

            this.element.data('current', null);

			this.grid.waitForImages(function () {
				obj.bind_handler();
			});
		},

		bind_handler: function () {
			var obj = this; // Temp instance of this object


            obj.triggers.off().on('click', trigger);
			obj.nextBtn.off().on('click', next);
			obj.prevBtn.off().on('click', prev);
			obj.closeBtn.off().on('click', close);

            MK.utils.eventManager.subscribe('filter', obj.close_project.bind(obj));

			function trigger() {
				if(obj.loading) return false;

				$('html:not(:animated),body:not(:animated)').animate({
					scrollTop: obj.ajaxDiv.offset().top -160 -obj.settings.extraOffset
				}, 700);
				
				var clicked = $(this),
					clickedParent = clicked.parents('.mk-portfolio-item');

                if(clicked.hasClass('active')) return false;

				obj.element.data('current', clickedParent.index());
 
				obj.close_project();

				obj.triggers.removeClass('active');
				clicked.addClass('active');
				obj.grid.addClass('grid-open');

				obj.id = clicked.data('post-id');

				MK.ui.loader.add($(this).parents('.featured-image'));
				obj.load_project();

                obj.loading = true;
				return false;

			}

			function next() {
				if(obj.loading) return false;

				if (obj.element.data('current') === obj.triggers.length) {
					obj.triggers.eq(0).trigger('click');
				} else {
					obj.triggers.eq(obj.element.data('current')).trigger('click');
				}

                obj.loading = true;
                return false;

			}


			function prev() {
				if(obj.loading) return false;

				if (obj.element.data('current') === 0) {
					obj.triggers.eq(obj.triggers.length - 1).trigger('click');
				} else {
					obj.triggers.eq(obj.element.data('current') - 2).trigger('click');
				}

                obj.loading = true;
                return false;

			}


			function close() {
				obj.close_project();
				obj.triggers.removeClass('active');
				obj.grid.removeClass('grid-open');
				return false;
			}



		},
		// Function to close the ajax container div
		close_project: function () {
			var obj = this,
				// Temp instance of this object
				project = obj.ajaxDiv.find('.ajax_project'),
				newH = project.outerHeight();

			obj.ajaxDiv.find('iframe').attr('src', '');


			if (obj.ajaxDiv.height() > 0) {
				obj.ajaxDiv.css('height', newH + 'px').animate({
					height: 0,
					opacity: 0
				}, 600);
			} else {
				obj.ajaxDiv.animate({
					height: 0,
					opacity: 0
				}, 600);
			}
            obj.loading = false;
		},
		load_project: function () {
			var obj = this;
			$.ajax({
				url: ajaxurl,
				data: {
					action: 'mk_ajax_portfolio',
					id: obj.id
				},
				success: function (response) {
					obj.ajaxDiv.find('.ajax_project').remove();
					obj.ajaxDiv.append(response);
					obj.project_factory();
				}       
			});
		},
		project_factory: function () {
			var obj = this,
				project = this.ajaxDiv.find('.ajax_project');



			project.waitForImages(function () {
				window.ajaxInit();
				setTimeout(window.ajaxDelayedInit, 1000);
				MK.core.initAll( project );

				// obj.loader.fadeOut();

				setTimeout(function () { 
					var newH = project.outerHeight();
					obj.ajaxDiv.animate({
						opacity: 1,
						height: newH + 60,
						marginBottom: 20 
					}, 400, function() {
						obj.ajaxDiv.css('height', 'auto');
					});
					MK.ui.loader.remove('.featured-image');
					MK.utils.eventManager.publish('ajax-preview');
					obj.loading = false;
				}, 300);

			});
		},

	};
	$.fn[pluginName] = function (options) {
		return this.each(function () {
			//if (!$.data(this, "plugin_" + pluginName)) {
				$.data(this, "plugin_" + pluginName);
					
					new Plugin(this, options);
			//}
		});
	};
})(jQuery, window, document);