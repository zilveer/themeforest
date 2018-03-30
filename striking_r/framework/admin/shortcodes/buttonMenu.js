(function ($) {
	$.buttonMenu = function (trigger, options) {
		var self = this;

		self.settings = {};

		var $trigger = $(trigger),
			trigger = trigger,
			$menu, shown = false;

		$.extend(self, {
			/**
			 * Initialize the plugin
			 */
			init: function () { /* Extends options */
				self.settings = $.extend({}, $.buttonMenu.defaults, options);
				$menu = $(self.settings.layout).addClass(self.settings.classes.menu).appendTo(document.body).hide();
				built();
				$trigger.bind('click', function (e) {
					if (self.isShown()) {
						self.hide();
					} else {
						self.show();
					}
					return false;
				});
			},

			show: function () {
				if (self.isShown()) {
					return self;
				}
				self.settings.beforeShow.call(this);
				var pos = getPosition();
				shown = true;
				$menu.css({
					position: 'absolute',
					top: pos.top,
					left: pos.left
				}).show();
				self.settings.afterShow.call(this);
				return self;
			},

			hide: function () {
				if (!$menu || !self.isShown()) {
					return self;
				}
				self.settings.beforeHide.call(this);
				$menu.hide();
				shown = false;
				self.settings.afterHide.call(this);
				return self;
			},

			getMenu: function () {
				return $menu;
			},

			getTrigger: function () {
				return $trigger;
			},

			isShown: function () {
				return shown;
			}
		});

		var built = function () {
				if ($.isArray(self.settings.data)) {
					var $menu_wrap = $('<ul/>').appendTo($menu);
					$.each(self.settings.data, function () {
						builtItem(this).appendTo($menu_wrap);
					});

				}
			};

		var builtItem = function (item) {
				item = $.extend({}, self.settings.item, item);
				if (typeof (item.sub) !== 'undefined') {
					var $sub = $('<ul/>');
					$.each(item.sub, function () {
						builtItem(this).appendTo($sub);
					});

					return $("<li/>", {
						"class": self.settings.classes.hasSub
					}).append($("<a/>", {
						"class": item["class"],
						text: item.text,
						click: function (event) {
							item.click.call(this, item, event);
						}
					})).append($sub);
				} else {
					if(typeof(item.type) !== 'undefined' && item.type == 'separator'){
						return $("<li/>").addClass(self.settings.classes.separator);
					}else{
						return $("<li/>").append($("<a/>", {
							"class": item["class"],
							text: item.text,
							click: function (event) {
								item.click.call(this, item, event);
							}
						}));
					}
				}
			};



		var getPosition = function () {
				// get origin top/left position 
				var top = $trigger.offset().top,
					left = $trigger.offset().left;

				top += $trigger.outerHeight() + self.settings.offset[0];
				left += self.settings.offset[1];

				// iPad position fix
				if (/iPad/i.test(navigator.userAgent)) {
					top -= $(window).scrollTop();
				}

				return {
					top: top,
					left: left
				};
			};

		/* Run the plugin */
		self.init();

		$(document.body).bind("click", function (e) {
			if (e.target != trigger) {
				self.hide();
			}
		});
	};

	$.buttonMenu.defaults = {
		offset: [0, 0],
		layout: '<div/>',
		classes: {
			menu: 'theme-button-menu',
			subMenu: 'theme-button-sub-menu',
			hasSub: 'theme-has-sub',
			separator:'theme-button-menu-separator'
		},
		data: null,
		item: {
			text: '',
			"class": '',
			click: function () {}
		},
		beforeShow: function () {},
		afterShow: function () {},
		beforeHide: function () {},
		afterHide: function () {}
	};

	$.fn.buttonMenu = function (options) {
		return this.each(function () {
			var $this = $(this);
			if ($this.data('buttonMenu') === undefined) {
				var buttonMenu = new $.buttonMenu(this, options);

				/* Attach the plugin instance to the element */
				$this.data('buttonMenu', buttonMenu);
			}

		});
	};
})(jQuery);