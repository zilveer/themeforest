
function save_options(type) {
	var data = {
		type: type,
		action: "change_options",
		values: jQuery("#theme_options").serialize()
	};
	//send data to server
	jQuery.post(ajaxurl, data, function(response) {
		show_info_popup(response);
		if (type == 'reset') {
			window.location.href = tmm_l10n.tmm_theme_options_url;
		}
	});
}

jQuery(function() {

      jQuery('.admin-nav li a').on('click',function(){

        var activeTab = jQuery(this).attr('href');

	  	var date = new Date();
		var minutes = 10;
			date.setTime(date.getTime() + (minutes * 60 * 1000));

	  	Cookies.set('selectedTab_diplomat', activeTab, {expires: date});


      })

});

(function($) {

	//options reseting
	try {
		if (getURLParameter('tmm_action') === 'save_options') {
			save_options("save");
		}
	} catch (e) {
	}

	/* ---------------------------------------------------------------------- */
	/*	Init
	 /* ---------------------------------------------------------------------- */

	$(function() {

		show_info_popup(tmm_l10n.loading);

		$("#theme_options").show(999);

		$('.admin-container').AdminNavigation();

		if ($('.showhide').length) {
			$('.showhide').showHide();
		}

		$('.thumb-pattern').multiChoice('body_pattern');
		$('.admin-choice-sidebar').multiChoice('sidebar_position');


		$(".option_checkbox").life('click', function() {
			if (jQuery(this).is(":checked")) {
				jQuery(this).parents(".checker").prev("input[type=hidden]").val(1);
				jQuery(this).parents(".checker").next("input[type=hidden]").val(1);
			} else {
				jQuery(this).parents(".checker").prev("input[type=hidden]").val(0);
				jQuery(this).parents(".checker").next("input[type=hidden]").val(0);
			}
		});

		$('.button_save_options').life('click', function() {
			save_color_pickers_states();
			var loading = jQuery('<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">S</div>' +
			'<div id="fountainTextG_2" class="fountainTextG">a</div><div id="fountainTextG_3" class="fountainTextG">v</div>' +
			'<div id="fountainTextG_4" class="fountainTextG">i</div><div id="fountainTextG_5" class="fountainTextG">n</div>' +
			'<div id="fountainTextG_6" class="fountainTextG">g</div><div id="fountainTextG_7" class="fountainTextG">.</div>' +
			'<div id="fountainTextG_8" class="fountainTextG">.</div><div id="fountainTextG_9" class="fountainTextG">.</div></div>');
			show_static_info_popup(loading);
			save_options("save");
			return false;
		});


		$(".js_picker_val_ahead").life('click', function() {
			var input = jQuery(this).parent().find(".bg_hex_color").eq(0);
			var button = jQuery(this).parent().find(".bgpicker").eq(0);
			var index = parseInt(jQuery(input).attr('value-index'), 10);

			if (index >= 20) {
				index = 0;
			}

			var val = get_color_picker_value(input, index);
			if (val !== false) {
				jQuery(input).val(val);
				jQuery(button).css('background-color', val);

				if (index != parseInt(jQuery(input).attr('value-index'), 10)) {
					jQuery(input).attr('value-index', parseInt(jQuery(input).attr('value-index'), 10) + 1);
				} else {
					jQuery(input).attr('value-index', index + 1);
				}
			}
		});


		$(".js_picker_val_back").life('click', function() {
			var input = jQuery(this).parent().find(".bg_hex_color").eq(0);
			var button = jQuery(this).parent().find(".bgpicker").eq(0);
			var index = parseInt(jQuery(input).attr('value-index'), 10);

			var val = get_color_picker_value(input, index);

			if (val !== false) {
				jQuery(input).val(val);
				jQuery(button).css('background-color', val);

				if (index != parseInt(jQuery(input).attr('value-index'), 10)) {
					jQuery(input).attr('value-index', parseInt(jQuery(input).attr('value-index'), 10) - 1);
				} else {
					jQuery(input).attr('value-index', index - 1);
				}
			}
		});


		$(".js_picker_val_reset").life('click', function() {
			var input = jQuery(this).parent().find(".bg_hex_color").eq(0);
			var button = jQuery(this).parent().find(".bgpicker").eq(0);
			var def_val = jQuery(input).data('default-value');
			jQuery(input).val(def_val);
			jQuery(button).css('background-color', def_val);
		});


		$('.button_reset_options').life('click', function()
		{
			if (confirm(tmm_l10n.sure)) {
				$.each(tmm_options_reset_array, function(key, value) {
					var elem = jQuery("[name=" + value + "]");
					jQuery(elem).val(jQuery(elem).data('default-value'));
				});

				var loading = jQuery('<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">R</div>' +
				'<div id="fountainTextG_2" class="fountainTextG">e</div><div id="fountainTextG_3" class="fountainTextG">s</div>' +
				'<div id="fountainTextG_4" class="fountainTextG">e</div><div id="fountainTextG_5" class="fountainTextG">t</div>' +
				'<div id="fountainTextG_6" class="fountainTextG">t</div><div id="fountainTextG_7" class="fountainTextG">i</div>' +
				'<div id="fountainTextG_8" class="fountainTextG">n</div><div id="fountainTextG_9" class="fountainTextG">g</div></div>');
				show_static_info_popup(loading);

				save_options("reset");
			}

			return false;
		});

		$("[name=favicon_img]").change(function() {
			jQuery("#favicon_preview_image").show();
			jQuery("#favicon_preview_image").attr("src", jQuery(this).val());
		});

		$(".delegate_click").life('click', function() {
			var id = jQuery(this).data('id');
			jQuery("[href=#" + id + "]").trigger('click');
			return false;
		});


		//ACCORDION

		if ($(".acc-trigger").length) {

			var $container = $('.acc-container'),
					$trigger = $('.acc-trigger');

			$container.hide();
			$trigger.first().addClass('active').next().show();

			$trigger.on('click', function(e) {
				var $this = jQuery(this);

				if ($this.attr('data-mode') === 'toggle') {
					$this.toggleClass('active').next().stop(true, true).slideToggle(300);
				} else if ($this.next().is(':hidden')) {
					$trigger.removeClass('active').next().slideUp(300);
					$this.toggleClass('active').next().slideDown(300);
				}
				e.preventDefault();
			});

		}

	});

	/* ---------------------------------------------------------------------- */
	/*	Admin Navigation Plugin
	 /* ---------------------------------------------------------------------- */

	$.AdminNavigation = function(el, options) {
		this.el = $(el);
		this.init(options);
	};

	$.AdminNavigation.defaults = {
		slideSpeed: 555
	};

	$.AdminNavigation.prototype = {
		init: function(options) {
			this.o = $.extend({}, $.AdminNavigation.defaults, options);
			this.refreshElements();
			this.slideNav(this);
		},
		slideNav: function(self) {

			var activeTab = Cookies.get('selectedTab_diplomat');

			if (activeTab){
				var $navLi = this.adminNav.children('li'),
				sectionTab = this.sectionTab;
				jQuery('ul.admin-nav li:has(a[href="' + activeTab + '"])').first().addClass('current-shortcut');
				jQuery('ul.admin-nav li:has(a[href="' + activeTab + '"])').last().addClass('sub-current');

				if (jQuery('.current-shortcut > ul li').hasClass('current-shortcut') && jQuery('.current-shortcut > ul li').hasClass('sub-current')){
					jQuery('.sub-current').removeClass('current-shortcut');
				}
				jQuery('.current-shortcut > ul').addClass('curr-ul');
				jQuery('.curr-ul').slideDown(this.slideSpeed);

				sectionTab.hide();
				jQuery(activeTab).show();

			}

			else{
				var $navLi = this.adminNav.children('li'),
					sectionTab = this.sectionTab;
			sectionTab.hide().first().show();

			$navLi.eq(0).addClass('current-shortcut');
			}

			this.adminNav.on('click', 'a', function(e) {
				$navLi.find('li').removeClass('sub-current');
				var $target = $(e.target).parent('li'),
						$targetUl = $target.children('ul').stop(true, true);
				$targetUl.children('li:first').addClass('sub-current');

				self.tabs(sectionTab, $target);

				if ($target.parent('.admin-nav').length) {
					$navLi.removeClass('current-shortcut');
					$target.addClass('current-shortcut');
					self.adminNav.find('li > ul').stop(true, true).slideUp(this.slideSpeed);
				} else {
					$target.addClass('sub-current');
				}

				$target.children('ul:hidden').length ? $targetUl.slideDown(this.slideSpeed) : $targetUl.slideUp(this.slideSpeed);
				e.preventDefault();
			});
		},
		tabs: function(sectionTab, target) {
			sectionTab.hide();
			var href = target.children('a').attr('href');
			$(href).fadeIn();
		},
		elements: {
			'.admin-nav': 'adminNav',
			'.section-tab': 'sectionTab'
		},
		$: function(selector) {
			return $(selector, this.el);
		},
		refreshElements: function() {
			for (var key in this.elements) {
				this[this.elements[key]] = this.$(key);
			}
		}
	};

	$.fn.AdminNavigation = function(options) {
		return $.data(this, 'AdminNavigation', new $.AdminNavigation(this, options));
	};

	/* ---------------------------------------------------------------------- */
	/*	Custom Events
	 /* ---------------------------------------------------------------------- */

	(function() {

		$.fn.showHide = function() {

			return this.each(function(idx, val) {
				var target = $(val),
						checkTagName = function() {
							var check = false, tagName = target.prop('tagName').toLowerCase();
							switch (tagName) {
								case 'input':
									check = true;
									break;
								case 'select':
									check = false;
									break;
							}
							return check;
						}, eventtype = checkTagName() ? 'click' : 'change',
						methods = {
							init: function() {
								this.eventsListener();
							},
							eventsListener: function() {
								target.on(eventtype, function() {
									var tagName = $(this).prop('tagName').toLowerCase(), el;
									switch (tagName) {
										case 'input':
											el = $(this);
											target.closest('.section').find('.show-hide-items > li').stop(true, true).animate({height: 'hide', opacity: 0}, 300);
											$('.' + el.data('show-hide')).stop(true, true).animate({height: 'show', opacity: 1}, 300);
											break;
										case 'select':
											el = $(this).children(':selected');
											var list = target.closest('.section').find('.show-hide-items > li');
											list.stop(true, true).animate({height: 'hide', opacity: 0}, 300).eq(el.val()).stop(true, true).animate({height: 'show', opacity: 1}, 300);
											break;
									}

								});
							}
						}
				return methods.init();
			});
		}

		$.fn.multiChoice = function(name) {
			return this.each(function() {
				$(this).on('click', 'a', function() {
					var $this = $(this), $parent = $this.parent();
					$parent.siblings('li').removeClass('current').end().addClass('current');
					if (name) {
						$("[name = " + name + "]").val($this.attr('href'));
					}
					return false;
				});
			});
		};

	}());

	/* ---------------------------------------------------------------------- */
	/*	Optional Functions
	 /* ---------------------------------------------------------------------- */

	$('#options-framework').css('min-height', $(window).outerHeight(true) -
			-$('#title-bar').outerHeight(true)
			- $('.set-holder').outerHeight(true) - 370);





	//*****

	function save_color_pickers_states() {
		var pickers = $(".bg_hex_color");

		$.each(pickers, function(index, picker) {
			var name = $(picker).attr('name');
			var color = $(picker).val();
			var pickers_saved_values = $.cookie(name);

			if (pickers_saved_values === null) {
				pickers_saved_values = [];
			} else {
				pickers_saved_values = pickers_saved_values.split('+');
			}

			if (pickers_saved_values.length > 20) {
				pickers_saved_values.pop();
			}

			var already_in_array = false;

			for (var i = 0; i < pickers_saved_values.length; i++) {
				if (color == pickers_saved_values[i]) {
					already_in_array = true;
					break;
				}
			}
			//do not save equaly colors
			if (!already_in_array) {
				pickers_saved_values.unshift(color);
			}

			//to string again
			pickers_saved_values = pickers_saved_values.join('+');
			$.cookie(name, pickers_saved_values);
		});

	}

	function get_color_picker_value(input, index) {
		index = parseInt(index, 10);
		var name = $(input).attr('name');

		var pickers_saved_values = $.cookie(name);

		if (pickers_saved_values === null) {
			return false;
		}

		if (pickers_saved_values.length === 0) {
			return false;
		}

		//to array
		pickers_saved_values = pickers_saved_values.split('+');
		pickers_saved_values.pop();
		//***

		if (index < 0) {
			index = pickers_saved_values.length - 1;
			$(input).attr('value-index', index);
		}


		if (pickers_saved_values[index] == undefined && index == 0) {
			return false;
		}

		if (pickers_saved_values[index] == undefined || pickers_saved_values[index].length == 0) {
			jQuery(input).attr('value-index', 0);
			index = 0;
		}


		if (index >= pickers_saved_values.length) {
			index = 0;
			jQuery(input).attr('value-index', 0);
		}


		return pickers_saved_values[index];
	}


	/* ---------------------------------------------------- */
	/*	jQuery Cookie
	 /* ---------------------------------------------------- */

	//for color options history
	jQuery.cookie = function(name, value, options) {
		if (typeof value != 'undefined') {
			options = options || {};
			if (value === null) {
				value = '';
				options.expires = -1;
			}
			var expires = '';
			var date = new Date();
			date.setTime(date.getTime() + 24 * 60 * 60 * 30 * 1000);
			expires = date.toUTCString();


			var path = options.path ? options.path : '';
			var domain = options.domain ? options.domain : '';
			var secure = options.secure ? 'true' : 'false';
			//document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
			Cookies.set(name, encodeURIComponent(value), expires, path, domain, secure);


		} else {
			var cookieValue = null;
			if (Cookies.get() && Cookies.get() != '') {
				var cookies = Cookies.get();

				for (var key in cookies) {
				  if (cookies.hasOwnProperty(key)) {
				    	if (key == name){
				    		cookieValue = decodeURIComponent(cookies[key]);
				    		break;
				    	}
				  }
				}
			}
			return cookieValue;
		}
	};


})(jQuery);
