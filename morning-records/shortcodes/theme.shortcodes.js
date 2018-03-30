// Init actions
function morning_records_sc_init_actions() {
	"use strict";
	setTimeout(function() {
		morning_records_sc_animation();
	}, 600);
	
	// MenuItems - init once
	jQuery('body')
		.on('click', '.show_popup_menuitem', function(e) {
			"use strict";
			morning_records_menuitems_show_popup(jQuery(this));
			e.preventDefault();
			return false;
		})
		.on('click', '.close_menuitem, .popup_menuitem', function(e) {
			"use strict";
			var target = jQuery(e.target);
			if (target.hasClass('popup_menuitem') || target.hasClass('close_menuitem') || target.parent().hasClass('close_menuitem')) {
				morning_records_menuitems_hide_popup();
				e.preventDefault();
				return false;
			}
		});

	// Init sc in container
	morning_records_sc_init(jQuery('body').eq(0));
}


// Resize actions
function morning_records_sc_resize_actions() {
	"use strict";
	morning_records_sc_sliders_resize();
}


// Scroll actions
function morning_records_sc_scroll_actions() {
	"use strict";
	morning_records_sc_animation();
}


// Animation
function morning_records_sc_animation() {
	jQuery('[data-animation^="animated"]:not(.animated)').each(function() {
		"use strict";
		if (jQuery(this).offset().top < jQuery(window).scrollTop() + jQuery(window).height())
			jQuery(this).addClass(jQuery(this).data('animation'));
	});
}


// Shortcodes init
function morning_records_sc_init(container) {

	// Call theme specific action (if exists)
	if (window.morning_records_theme_sc_init) morning_records_theme_sc_init(container);

	// Accordion
	if (container.find('.sc_accordion:not(.inited)').length > 0) {
		container.find(".sc_accordion:not(.inited)").each(function () {
			"use strict";
			var init = jQuery(this).data('active');
			if (isNaN(init)) init = 0;
			else init = Math.max(0, init);
			jQuery(this)
				.addClass('inited')
				.accordion({
					active: init,
					heightStyle: "content",
					header: "> .sc_accordion_item > .sc_accordion_title",
					create: function (event, ui) {
						"use strict";
						morning_records_sc_init(ui.panel);
						if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(ui.panel);
						ui.header.each(function () {
							"use strict";
							jQuery(this).parent().addClass('sc_active');
						});
					},
					activate: function (event, ui) {
						"use strict";
						morning_records_sc_init(ui.newPanel);
						if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(ui.newPanel);
						ui.newHeader.each(function () {
							"use strict";
							jQuery(this).parent().addClass('sc_active');
						});
						ui.oldHeader.each(function () {
							"use strict";
							jQuery(this).parent().removeClass('sc_active');
						});
					}
				});
		});
	}

	// Blogger: style Polaroid
	if (container.find('.sc_blogger.layout_polaroid .photostack:not(.inited)').length > 0) {
		container.find(".sc_blogger.layout_polaroid .photostack:not(.inited)").each(function () {
			"use strict";
			var obj = jQuery(this);
			var id = obj.attr('id');
			if (id == undefined) {
				id = 'photostack_'+Math.random();
				id = id.replace('.', '');
				obj.attr('id', id);
			}
			setTimeout(function() {
				"use strict";
				obj.addClass('inited').parent().height("auto");
				new Photostack( obj.get(0), {
					callback: function( item ) {
					}
				} );
			}, 10);
		});
	}

	// Blogger: Scroll horizontal
	if (container.find('.sc_blogger .sc_scroll_horizontal .sc_scroll_wrapper:not(.inited)').length > 0) {
		container.find(".sc_blogger .sc_scroll_horizontal .sc_scroll_wrapper:not(.inited)").each(function () {
			"use strict";
			var obj = jQuery(this);
			var width = 0;
			obj.find('.isotope_item').each(function(){
				"use strict";
				width += jQuery(this).outerWidth();
			});
			obj.addClass('inited').width(width);
		});
	}

	// Form
	if (container.find('.sc_form:not(.inited) form').length > 0) {
		container.find(".sc_form:not(.inited) form").each(function() {
			"use strict";
			jQuery(this).addClass('inited');
			jQuery(this).submit(function(e) {
				"use strict";
				morning_records_sc_form_validate(jQuery(this));
				e.preventDefault();
				return false;
			});
			if (jQuery(this).find('.js__datepicker').length > 0) {
				jQuery(this).find('.js__datepicker').pickadate({
					// Work-around for some mobile browsers clipping off the picker.
					onOpen: function() {
						"use strict";
						jQuery('pre').css('overflow', 'hidden');
						},
					onClose: function() {
						"use strict";
						jQuery('pre').css('overflow', '');
					},
					monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec' ],
					showMonthsShort: true,
					format: 'dd.mm.yyyy',
					formatSubmit: 'yyyy-mm-dd',
					min: true
				});
			}
			if (jQuery(this).find('.js__timepicker').length > 0) {
				jQuery(this).find('.js__timepicker').pickatime();
			}
		});
	}

	//Countdown
	if (container.find('.sc_countdown:not(.inited)').length > 0) {
		container.find('.sc_countdown:not(.inited)')
			.each(function () {
				"use strict";
				jQuery(this).addClass('inited');
				var id = jQuery(this).attr('id');
				var curDate = new Date(); 
				var curDateTimeStr = curDate.getFullYear()+'-'+(curDate.getMonth()<9 ? '0' : '')+(curDate.getMonth()+1)+'-'+(curDate.getDate()<10 ? '0' : '')+curDate.getDate()
					+' '+(curDate.getHours()<10 ? '0' : '')+curDate.getHours()+':'+(curDate.getMinutes()<10 ? '0' : '')+curDate.getMinutes()+':'+(curDate.getSeconds()<10 ? '0' : '')+curDate.getSeconds(); 
				var interval = 1;	//jQuery(this).data('interval');
				var endDateStr = jQuery(this).data('date');
				var endDateParts = endDateStr.split('-');
				var endTimeStr = jQuery(this).data('time');
				var endTimeParts = endTimeStr.split(':');
				if (endTimeParts.length < 3) endTimeParts[2] = '00';
				var endDateTimeStr = endDateStr+' '+endTimeStr;
				if (curDateTimeStr < endDateTimeStr) {
					jQuery(this).find('.sc_countdown_placeholder').countdown({
						until: new Date(endDateParts[0], endDateParts[1]-1, endDateParts[2], endTimeParts[0], endTimeParts[1], endTimeParts[2]), 
						tickInterval: interval,
						onTick: morning_records_countdown
					}); 
				} else {
					jQuery(this).find('.sc_countdown_placeholder').countdown({
						since: new Date(endDateParts[0], endDateParts[1]-1, endDateParts[2], endTimeParts[0], endTimeParts[1], endTimeParts[2]), 
						tickInterval: interval,
						onTick: morning_records_countdown
					}); 
				}
			});
	}

	// Emailer form
	if (container.find('.sc_emailer:not(.inited)').length > 0) {
		container.find(".sc_emailer:not(.inited)")
			.addClass('inited')
			.on('click', '.sc_emailer_button', function(e) {
				"use strict";
				var form = jQuery(this).parents('form');
				var parent = jQuery(this).parents('.sc_emailer');
				if (parent.hasClass('sc_emailer_opened')) {
					if (form.length>0 && form.find('input').val()!='') {
						var group = jQuery(this).data('group');
						var email = form.find('input').val();
						var regexp = new RegExp(MORNING_RECORDS_STORAGE['email_mask']);
						if (!regexp.test(email)) {
							form.find('input').get(0).focus();
							morning_records_message_warning(MORNING_RECORDS_STORAGE['strings']['email_not_valid']);
						} else {
							jQuery.post(MORNING_RECORDS_STORAGE['ajax_url'], {
								action: 'emailer_submit',
								nonce: MORNING_RECORDS_STORAGE['ajax_nonce'],
								group: group,
								email: email
							}).done(function(response) {
								"use strict";
								var rez = {};
								try {
									rez = JSON.parse(response);
								} catch (e) {
									rez = { error: MORNING_RECORDS_STORAGE['ajax_error'] };
									console.log(response);
								}
								if (rez.error === '') {
									morning_records_message_info(MORNING_RECORDS_STORAGE['strings']['email_confirm'].replace('%s', email));
									form.find('input').val('');
								} else {
									morning_records_message_warning(rez.error);
								}
							});
						}
					} else
						form.get(0).submit();
				} else {
					parent.addClass('sc_emailer_opened');
				}
				e.preventDefault();
				return false;
			});
	}
	
	// Googlemap init
	if (container.find('.sc_googlemap:not(.inited)').length > 0) {
		container.find('.sc_googlemap:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden,article:hidden').length > 0) return;
				var map = jQuery(this).addClass('inited');
				var map_id		= map.attr('id');
				var map_zoom	= map.data('zoom');
				var map_style	= map.data('style');
				var map_markers = [];
				map.find('.sc_googlemap_marker').each(function() {
					"use strict";
					var marker = jQuery(this);
					map_markers.push({
						point:			marker.data('point'),
						address:		marker.data('address'),
						latlng:			marker.data('latlng'),
						description:	marker.data('description'),
						title:			marker.data('title')
					});
				});
				morning_records_googlemap_init( jQuery('#'+map_id).get(0), {style: map_style, zoom: map_zoom, markers: map_markers});
			});
	}

	// Infoboxes
	if (container.find('.sc_infobox.sc_infobox_closeable:not(.inited)').length > 0) {
		container.find('.sc_infobox.sc_infobox_closeable:not(.inited)')
			.addClass('inited')
			.on('click', function (e) {
				"use strict";
				jQuery(this).slideUp();
				e.preventDefault();
				return false;
			});
	}

	// Matches
	if (container.find('.sc_matches:not(.inited)').length > 0) {
		container.find('.sc_matches:not(.inited)')
			.each(function () {
				"use strict";
				jQuery(this).find('.sc_matches_next .sc_matches_list .sc_match').on('click', function () {
					"use strict";
					jQuery(this).parents('.sc_matches').find('.sc_matches_current .sc_match').hide();
					var item = jQuery(this).data('item');
					jQuery(item).fadeIn();
				});
			});
	}

	// Matches & Players: Sort players by points
	if (container.find('.sc_players_table:not(.inited)').length > 0) {
		container.find('.sc_players_table:not(.inited)')
			.addClass('inited')
			.on('click', '.sort', function (e) {
				"use strict";
				var table = jQuery(this).parents('.sc_players_table');
				var id = jQuery(table).attr('id')
				var sort = jQuery(table).data('sort') == 'asc' ? 'desc' : 'asc';
				jQuery.post(MORNING_RECORDS_STORAGE['ajax_url'], {
					action: 'sort_by_points',
					nonce: MORNING_RECORDS_STORAGE['ajax_nonce'],
					sort: sort,
					table: MORNING_RECORDS_STORAGE['ajax_' + id]
				}).done(function(response) {
					var rez = {};
					try {
						rez = JSON.parse(response);
					} catch (e) {
						rez = { error: MORNING_RECORDS_STORAGE['ajax_error'] };
						console.log(response);
					}
					if (rez.error === '') { 
						jQuery(table).find('.sc_table').remove();
						jQuery(table).find('script').after(rez.data);
						jQuery(table).data('sort', sort);
						morning_records_select_players_category(jQuery(table).find('.sc_players_table_category select'));		
					}
				});
				e.preventDefault();
				return false;
			});
	}
	
	// Matches & Players: Select category in the points table
	if (container.find('.sc_players_table_category:not(.inited)').length > 0) {
		container.find('.sc_players_table_category:not(.inited)')
			.addClass('inited')
			.on('change', function () {
				"use strict";
				morning_records_select_players_category(jQuery(this));		
			});
	}

	// Popup links
	if (container.find('.sc_popup_link:not(.inited)').length > 0) {
		container.find('.sc_popup_link:not(.inited)').each(function() {
			var popup_id = jQuery(this).attr('href');
			jQuery(this)
				.addClass('inited')
				.magnificPopup({
					type: 'inline',
					removalDelay: 500,
					midClick: true,
					callbacks: {
						beforeOpen: function () {
							this.st.mainClass = 'mfp-zoom-in';
						},
						open: function() {
							"use strict";
							morning_records_sc_init(jQuery(popup_id));
							morning_records_resize_actions();
							if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(jQuery(popup_id));
						},
						close: function() {}
					}
				});
		});
	}

	// Recent news widget and sc
	if (container.find('.sc_recent_news_header_category_item_more:not(.inited)').length > 0) {
		container.find('.sc_recent_news_header_category_item_more:not(.inited)').each(function() {
			"use strict";
			jQuery(this)
				.addClass('inited')
				.on('click', function(e) {
					"use strict";
					jQuery(this).toggleClass('opened').find('.sc_recent_news_header_more_categories').slideToggle();
					e.preventDefault();
					return false;
				});
		});
	}

	// Search form
	if (container.find('.search_wrap:not(.inited)').length > 0) {
		container.find('.search_wrap:not(.inited)').each(function() {
			"use strict";
			jQuery(this)
				.addClass('inited')
				.on('click', '.search_submit', function(e) {
					"use strict";
					var search_wrap = jQuery(this).parents('.search_wrap');
					if (!search_wrap.hasClass('search_state_fixed')) {
						if (search_wrap.hasClass('search_state_opened')) {
							if (search_wrap.find('.search_field').val() != '')
								search_wrap.find('form').get(0).submit();
							else
								search_wrap.removeClass('search_state_opened').addClass('search_state_closed').find('.search_results').fadeOut();
						} else
							search_wrap.removeClass('search_state_closed').addClass('search_state_opened').find('.search_field').get(0).focus();
					} else {
						if (search_wrap.find('.search_field').val() != '')
							search_wrap.find('form').get(0).submit();
						else {
							search_wrap.find('.search_field').val('');
							search_wrap.find('.search_results').fadeOut();
						}
					}
					e.preventDefault();
					return false;
				})
				.on('click', '.search_results_close', function(e) {
					"use strict";
					jQuery(this).parent().fadeOut();
					e.preventDefault();
					return false;
				})
				.on('click', '.search_more', function(e) {
					"use strict";
					if (jQuery(this).parents('.search_wrap').find('.search_field').val() != '')
						jQuery(this).parents('.search_wrap').find('form').get(0).submit();
					e.preventDefault();
					return false;
				});
			if (jQuery(this).hasClass('search_ajax')) {
				var ajax_timer = null;
				jQuery(this).find('.search_field').keyup(function(e) {
					"use strict";
					var search_field = jQuery(this);
					var s = search_field.val();
					if (ajax_timer) {
						clearTimeout(ajax_timer);
						ajax_timer = null;
					}
					if (s.length >= MORNING_RECORDS_STORAGE['ajax_search_min_length']) {
						ajax_timer = setTimeout(function() {
							"use strict";
							jQuery.post(MORNING_RECORDS_STORAGE['ajax_url'], {
								action: 'ajax_search',
								nonce: MORNING_RECORDS_STORAGE['ajax_nonce'],
								text: s
							}).done(function(response) {
								"use strict";
								clearTimeout(ajax_timer);
								ajax_timer = null;
								var rez = {};
								try {
									rez = JSON.parse(response);
								} catch (e) {
									rez = { error: MORNING_RECORDS_STORAGE['ajax_error'] };
									console.log(response);
								}
								if (rez.error === '') {
									search_field.parents('.search_ajax').find('.search_results_content').empty().append(rez.data);
									search_field.parents('.search_ajax').find('.search_results').fadeIn();
								} else {
									morning_records_message_warning(MORNING_RECORDS_STORAGE['strings']['search_error']);
								}
							});
						}, MORNING_RECORDS_STORAGE['ajax_search_delay']);
					}
				});
			}
		});
	}

	
	// Section Pan init
	if (container.find('.sc_pan:not(.inited_pan)').length > 0) {
		container.find('.sc_pan:not(.inited_pan)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden,article:hidden').length > 0) return;
				var pan = jQuery(this).addClass('inited_pan');
				var cont = pan.parent();
				cont.mousemove(function(e) {
					"use strict";
					var anim = {};
					var tm = 0;
					var pw = pan.width(), ph = pan.height();
					var cw = cont.width(), ch = cont.height();
					var coff = cont.offset();
					if (pan.hasClass('sc_pan_vertical'))
						pan.css('top', -Math.floor((e.pageY - coff.top) / ch * (ph-ch)));
					if (pan.hasClass('sc_pan_horizontal'))
						pan.css('left', -Math.floor((e.pageX - coff.left) / cw * (pw-cw)));
				});
				cont.mouseout(function(e) {
					"use strict";
					pan.css({'left': 0, 'top': 0});
				});
			});
	}

	// Scroll
	if (container.find('.sc_scroll:not(.inited)').length > 0) {
		container.find('.sc_scroll:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden,article:hidden').length > 0) return;
				MORNING_RECORDS_STORAGE['scroll_init_counter'] = 0;
				morning_records_sc_init_scroll_area(jQuery(this));
			});
	}


	// Swiper Slider
	if (container.find('.sc_slider_swiper:not(.inited)').length > 0) {
		container.find('.sc_slider_swiper:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden,article:hidden').length > 0) return;
				//if (jQuery(this).parents('.isotope_wrap:not(.inited)').length > 0) return;
				jQuery(this).addClass('inited');
				morning_records_sc_slider_autoheight(jQuery(this));
				if (jQuery(this).parents('.sc_slider_pagination_area').length > 0) {
					jQuery(this).parents('.sc_slider_pagination_area').find('.sc_slider_pagination .post_item').eq(0).addClass('active');
				}
				var id = jQuery(this).attr('id');
				if (id == undefined) {
					id = 'swiper_'+Math.random();
					id = id.replace('.', '');
					jQuery(this).attr('id', id);
				}
				jQuery(this).addClass(id);
				jQuery(this).find('.slides .swiper-slide').css('position', 'relative');
				var width = jQuery(this).width();
				if (width == 0) width = jQuery(this).parent().width();
				var spv = jQuery(this).data('slides-per-view');
				if (spv == undefined) spv = 1;
				var min_width = jQuery(this).data('slides-min-width');
				if (min_width == undefined) min_width = 50;
				if (width / spv < min_width) spv = Math.max(1, Math.floor(width / min_width));
				var space = jQuery(this).data('slides-space');
				if (space == undefined) space = 0;
				if (MORNING_RECORDS_STORAGE['swipers'] === undefined) MORNING_RECORDS_STORAGE['swipers'] = {};
				MORNING_RECORDS_STORAGE['swipers'][id] = new Swiper('.'+id, {
					calculateHeight: !jQuery(this).hasClass('sc_slider_height_fixed'),
					resizeReInit: true,
					autoResize: true,
					loop: true,
					grabCursor: true,
			        nextButton: jQuery(this).hasClass('sc_slider_controls') ? '#'+id+' .sc_slider_next' : false,
			        prevButton: jQuery(this).hasClass('sc_slider_controls') ? '#'+id+' .sc_slider_prev' : false,
					pagination: jQuery(this).hasClass('sc_slider_pagination') ? '#'+id+' .sc_slider_pagination_wrap' : false,
				    paginationClickable: true,
					autoplay: jQuery(this).hasClass('sc_slider_noautoplay') ? false : (isNaN(jQuery(this).data('interval')) ? 7000 : jQuery(this).data('interval')),
					autoplayDisableOnInteraction: false,
					initialSlide: 0,
					slidesPerView: spv,
					loopedSlides: spv,
					spaceBetween: space,
					speed: 600,
					// Autoheight on start
					onFirstInit: function (slider){
						"use strict";
						var cont = jQuery(slider.container);
						if (!cont.hasClass('sc_slider_height_auto')) return;
						var li = cont.find('.swiper-slide').eq(1);
						var h = li.data('height_auto');
						if (h > 0) {
							var pt = parseInt(li.css('paddingTop')), pb = parseInt(li.css('paddingBottom'));
							li.height(h);
							cont.height(h + (isNaN(pt) ? 0 : pt) + (isNaN(pb) ? 0 : pb));
							cont.find('.swiper-wrapper').height(h + (isNaN(pt) ? 0 : pt) + (isNaN(pb) ? 0 : pb));
						}
					},
					// Autoheight on slide change
					onSlideChangeStart: function (slider){
						"use strict";
						var cont = jQuery(slider.container);
						if (!cont.hasClass('sc_slider_height_auto')) return;
						var idx = slider.activeIndex;
						var li = cont.find('.swiper-slide').eq(idx);
						var h = li.data('height_auto');
						if (h > 0) {
							var pt = parseInt(li.css('paddingTop')), pb = parseInt(li.css('paddingBottom'));
							li.height(h);
							cont.height(h + (isNaN(pt) ? 0 : pt) + (isNaN(pb) ? 0 : pb));
							cont.find('.swiper-wrapper').height(h + (isNaN(pt) ? 0 : pt) + (isNaN(pb) ? 0 : pb));
						}
					},
					// Change current item in 'full' or 'over' pagination wrap
					onSlideChangeEnd: function (slider, dir) {
						"use strict";
						var cont = jQuery(slider.container);
						if (cont.parents('.sc_slider_pagination_area').length > 0) {
							var li = cont.parents('.sc_slider_pagination_area').find('.sc_slider_pagination .post_item');
							var idx = slider.activeIndex > li.length ? 0 : slider.activeIndex-1;
							morning_records_sc_change_active_pagination_in_slider(cont, idx);
						}
					}
				});
				
				jQuery(this).data('settings', {mode: 'horizontal'});		// VC hook
				
				var curSlide = jQuery(this).find('.slides').data('current-slide');
				if (curSlide > 0)
					MORNING_RECORDS_STORAGE['swipers'][id].slideTo(curSlide-1);

				morning_records_sc_prepare_slider_navi(jQuery(this));

			});
			
		// Check slides per view
		morning_records_sc_sliders_resize();
	}

	//Skills init
	if (container.find('.sc_skills_item:not(.inited)').length > 0) {
		morning_records_sc_init_skills(container);
		jQuery(window).scroll(function () { morning_records_sc_init_skills(container); });
	}
	//Skills type='arc' init
	if (container.find('.sc_skills_arc:not(.inited)').length > 0) {
		morning_records_sc_init_skills_arc(container);
		jQuery(window).scroll(function () { morning_records_sc_init_skills_arc(container); });
	}

	// Tabs
	if (container.find('.sc_tabs:not(.inited):not(.no_jquery_ui),.tabs_area:not(.inited)').length > 0) {
		container.find('.sc_tabs:not(.inited):not(.no_jquery_ui),.tabs_area:not(.inited)').each(function () {
			"use strict";
			var init = jQuery(this).data('active');
			if (isNaN(init)) init = 0;
			else init = Math.max(0, init);
			jQuery(this)
				.addClass('inited')
				.tabs({
					active: init,
					show: {
						effect: 'fadeIn',
						duration: 300
					},
					hide: {
						effect: 'fadeOut',
						duration: 300
					},
					create: function (event, ui) {
						"use strict";
						morning_records_sc_init(ui.panel);
						if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(ui.panel);
					},
					activate: function (event, ui) {
						"use strict";
						morning_records_sc_init(ui.newPanel);
						if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(ui.newPanel);
					}
				});
		});
	}
	if (container.find('.sc_tabs.no_jquery_ui:not(.inited)').length > 0) {
		container.find('.sc_tabs.no_jquery_ui:not(.inited)').each(function () {
			"use strict";
			jQuery(this)
				.addClass('inited')
				.on('click', '.sc_tabs_titles li a', function(e) {
					"use strict";
					if (!jQuery(this).parent().hasClass('sc_tabs_active')) {
						var id_act = jQuery(this).parent().siblings('.sc_tabs_active').find('a').attr('href');
						var id = jQuery(this).attr('href');
						jQuery(this).parent().addClass('sc_tabs_active').siblings().removeClass('sc_tabs_active');
						jQuery(id_act).fadeOut(function() {
							"use strict";
							jQuery(id).fadeIn(function() {
								"use strict";
								morning_records_sc_init(jQuery(this));
								if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(jQuery(this));
							});
						});
					}
					e.preventDefault();
					return false;
				});
			jQuery(this).find('.sc_tabs_titles li').eq(0).addClass('sc_tabs_active');
			jQuery(this).find('.sc_tabs_content').eq(0).fadeIn(function() {
				"use strict";
				morning_records_sc_init(jQuery(this));
				if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(jQuery(this));
			});
		});
	}

	// Toggles
	if (container.find('.sc_toggles .sc_toggles_title:not(.inited)').length > 0) {
		container.find('.sc_toggles .sc_toggles_title:not(.inited)')
			.addClass('inited')
			.on('click', function () {
				"use strict";
				jQuery(this).toggleClass('ui-state-active').parent().toggleClass('sc_active');
				jQuery(this).parent().find('.sc_toggles_content').slideToggle(300, function () { 
					"use strict";
					morning_records_sc_init(jQuery(this).parent().find('.sc_toggles_content')); 
					if (window.morning_records_init_hidden_elements) morning_records_init_hidden_elements(jQuery(this).parent().find('.sc_toggles_content'));
				});
			});
	}

	//Zoom
	if (container.find('.sc_zoom:not(.inited)').length > 0) {
		container.find('.sc_zoom:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden,article:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				jQuery(this).find('img').elevateZoom({
					zoomType: "lens",
					lensShape: "round",
					lensSize: 200,
					lensBorderSize: 4,
					lensBorderColour: '#ccc'
				});
			});
	}

}



// Scrolled areas
function morning_records_sc_init_scroll_area(obj) {
	"use strict";

	// Wait for images loading
	if (!morning_records_check_images_complete(obj) && MORNING_RECORDS_STORAGE['scroll_init_counter']++ < 30) {
		setTimeout(function() { morning_records_sc_init_scroll_area(obj); }, 200);
		return;
	}

	// Start init scroll area
	obj.addClass('inited');

	var id = obj.attr('id');
	if (id == undefined) {
		id = 'scroll_'+Math.random();
		id = id.replace('.', '');
		obj.attr('id', id);
	}
	obj.addClass(id);

	var parent_obj = obj.parent();
	var parent_id  = parent_obj.attr('id');
	if (parent_id == undefined) {
		parent_id = 'scroll_wrap_'+Math.random();
		parent_id = parent_id.replace('.', '');
		parent_obj.attr('id', parent_id);
	}
	parent_obj.addClass(parent_id);

	var bar = obj.find('#'+id+'_bar');
	if (bar.length > 0 && !bar.hasClass(id+'_bar')) {
		bar.addClass(id+'_bar');
	}
	
	// Correct wrapper width (if scroll dir = horizontal)
	if (obj.hasClass('sc_scroll_horizontal')) {
		obj.find('.sc_scroll_wrapper > .sc_scroll_slide').css('width', 'auto');
		obj.find('.sc_scroll_wrapper').css('width', obj.find('.sc_scroll_wrapper > .sc_scroll_slide').width()+10);
		obj.find('.sc_scroll_wrapper > .sc_scroll_slide').css('width', '100%')
	}

	// Init Swiper with scroll plugin
	if (MORNING_RECORDS_STORAGE['swipers'] === undefined) MORNING_RECORDS_STORAGE['swipers'] = {};
	MORNING_RECORDS_STORAGE['swipers'][id] = new Swiper('.'+id, {
		calculateHeight: false,
		resizeReInit: true,
		autoResize: true,
		freeMode: true,
		freeModeFluid: true,
		grabCursor: true,
		mode: obj.hasClass('sc_scroll_vertical') ? 'vertical' : 'horizontal',
		direction: obj.hasClass('sc_scroll_vertical') ? 'vertical' : 'horizontal',
		slidesPerView: obj.hasClass('sc_scroll') ? 'auto' : 1,
        nextButton: parent_obj.hasClass('sc_scroll_controls') ? '#'+parent_id+' .sc_scroll_next' : false,
        prevButton: parent_obj.hasClass('sc_scroll_controls') ? '#'+parent_id+' .sc_scroll_prev' : false,
        scrollbar: '.'+id+'_bar',
        scrollbarHide: true,
	})
	
	// VC hook
	obj.data('settings', {mode: 'horizontal'});
}


// Slider navigation
function morning_records_sc_prepare_slider_navi(slider) {
	"use strict";
	var navi = null;
	
/*
	// Prev / Next
	navi = slider.find('> .sc_slider_controls_wrap, > .sc_scroll_controls_wrap');
	if (navi.length == 0) navi = slider.siblings('.sc_slider_controls_wrap,.sc_scroll_controls_wrap');
	if (navi.length > 0) {
		navi.on('click', '.sc_slider_prev,.sc_scroll_prev', function(e) {
			var swiper = jQuery(this).parents('.swiper-slider-container');
			if (swiper.length == 0) swiper = jQuery(this).parents('.sc_slider_controls_wrap,.sc_scroll_controls_wrap').siblings('.swiper-slider-container');
			var id = swiper.attr('id');
			MORNING_RECORDS_STORAGE['swipers'][id].slidePrev();
			e.preventDefault();
			return false;
		})
        .on('click', '.sc_slider_next,.sc_scroll_next', function(e){
			var swiper = jQuery(this).parents('.swiper-slider-container');
			if (swiper.length == 0) swiper = jQuery(this).parents('.sc_slider_controls_wrap,.sc_scroll_controls_wrap').siblings('.swiper-slider-container');
			var id = swiper.attr('id');
			MORNING_RECORDS_STORAGE['swipers'][id].slideNext();
			e.preventDefault();
			return false;
		});
	}
*/
	// Pagination with slide's title
	navi = slider.siblings('.sc_slider_pagination');
	if (navi.length > 0) {
		navi.on('click', '.post_item', function(e){
			var swiper = jQuery(this).parents('.sc_slider_pagination_area').find('.swiper-slider-container');
			var id = swiper.attr('id');
			MORNING_RECORDS_STORAGE['swipers'][id].slideTo(jQuery(this).index()+1);
			e.preventDefault();
			return false;
		});
	}
}

// Sliders: Pagination
function morning_records_sc_change_active_pagination_in_slider(slider, idx) {
	"use strict";
	var pg = slider.parents('.sc_slider_pagination_area').find('.sc_slider_pagination');
	if (pg.length==0) return;
	pg.find('.post_item').removeClass('active').eq(idx).addClass('active');
	var h = pg.height();
	var off = pg.find('.active').offset().top - pg.offset().top;
	var off2 = pg.find('.sc_scroll_wrapper').offset().top - pg.offset().top;
	var h2  = pg.find('.active').height();
	if (off < 0) {
		pg.find('.sc_scroll_wrapper').css({'transform': 'translate3d(0px, 0px, 0px)', 'transition-duration': '0.3s'});
	} else if (h <= off+h2) {
		pg.find('.sc_scroll_wrapper').css({'transform': 'translate3d(0px, -'+(Math.abs(off2)+off-h/4)+'px, 0px)', 'transition-duration': '0.3s'});
	}
}

// Sliders: Autoheight
function morning_records_sc_slider_autoheight(slider) {
	"use strict";
	if (slider.hasClass('.sc_slider_height_auto')) {
		slider.find('.swiper-slide').each(function() {
			"use strict";
			if (jQuery(this).data('height_auto') == undefined) {
				jQuery(this).attr('data-height_auto', jQuery(this).height());
			}
		});
	}
}

// Sliders: Resize
function morning_records_sc_sliders_resize() {
	"use strict";
	var slider = arguments[0]!==undefined ? arguments[0] : '.sc_slider_swiper.inited';
	var resize = arguments[1]!==undefined ? arguments[1] : true;

	jQuery(slider).each(function() {
		"use strict";
		var id = jQuery(this).attr('id');
		var width = jQuery(this).width();
		var last_width = jQuery(this).data('last-width');
		if (isNaN(last_width)) last_width = 0;
		
		// Change slides_per_view
		if (last_width==0 || last_width!=width) {
			var spv = jQuery(this).data('slides-per-view');
			if (spv == undefined) spv = 1;
			var min_width = jQuery(this).data('slides-min-width');
			if (min_width == undefined) min_width = 50;
			if (width / spv < min_width) spv = Math.max(1, Math.floor(width / min_width));
			jQuery(this).data('last-width', width);
			if (MORNING_RECORDS_STORAGE['swipers'][id].params.slidesPerView != spv) {
				MORNING_RECORDS_STORAGE['swipers'][id].params.slidesPerView = spv;
				MORNING_RECORDS_STORAGE['swipers'][id].params.loopedSlides = spv;
				//MORNING_RECORDS_STORAGE['swipers'][id].reInit();
			}
		}
		
		// Resize slider
		if ( resize && !jQuery(this).hasClass('sc_slider_height_fixed') ) {
			var h = 0;
			if ( jQuery(this).find('.swiper-slide > img').length > 0 ) {
				jQuery(this).find('.swiper-slide > img').each(function() {
					"use strict";
					if (jQuery(this).height() > h) h = jQuery(this).height();
				});
				jQuery(this).height(h);
			} else if ( jQuery(this).find('.swiper-slide').css('backgroundImage')!='none' ) {
				h = Math.floor(width/16*9);
				jQuery(this).height(h).find('.swiper-slide').height(h);
			}
		}
	});
	
	// Resize slider pagination area
	jQuery('.sc_slider_pagination_area').each(function() {
		"use strict";
		var h = jQuery(this).find('.sc_slider').height();
		if (h) {
			jQuery(this).height(h);
			jQuery(this).find('.sc_slider_pagination').height(h);
			jQuery(this).find('.sc_slider_pagination .sc_scroll_vertical').height(h);
		}
	});
}


// Skills init
function morning_records_sc_init_skills(container) {
	"use strict";
	if (arguments.length==0) var container = jQuery('body');
	var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();

	container.find('.sc_skills_item:not(.inited)').each(function () {
		"use strict";
		var skillsItem = jQuery(this);
		var scrollSkills = skillsItem.offset().top;
		if (scrollPosition > scrollSkills) {
			skillsItem.addClass('inited');
			var skills = skillsItem.parents('.sc_skills').eq(0);
			var type = skills.data('type');
			var total = (type=='pie' && skills.hasClass('sc_skills_compact_on')) ? skillsItem.find('.sc_skills_data .pie') : skillsItem.find('.sc_skills_total').eq(0);
			var start = parseInt(total.data('start'));
			var stop = parseInt(total.data('stop'));
			var maximum = parseInt(total.data('max'));
			var startPercent = Math.round(start/maximum*100);
			var stopPercent = Math.round(stop/maximum*100);
			var ed = total.data('ed');
			var duration = parseInt(total.data('duration'));
			var speed = parseInt(total.data('speed'));
			var step = parseInt(total.data('step'));
			if (type == 'bar') {
				var dir = skills.data('dir');
				var count = skillsItem.find('.sc_skills_count').eq(0);
				if (dir=='horizontal')
					count.css('width', startPercent + '%').animate({ width: stopPercent + '%' }, duration);
				else if (dir=='vertical')
					count.css('height', startPercent + '%').animate({ height: stopPercent + '%' }, duration);
				morning_records_sc_animate_skills_counter(start, stop, speed-(dir!='unknown' ? 5 : 0), step, ed, total);
			} else if (type == 'counter') {
				morning_records_sc_animate_skills_counter(start, stop, speed - 5, step, ed, total);
			} else if (type == 'pie') {
				var steps = parseInt(total.data('steps'));
				var bg_color = total.data('bg_color');
				var border_color = total.data('border_color');
				var cutout = parseInt(total.data('cutout'));
				var easing = total.data('easing');
				var options = {
					segmentShowStroke: false,
					segmentStrokeColor: border_color,
					segmentStrokeWidth: 1,
					percentageInnerCutout : cutout,
					animationSteps: steps,
					animationEasing: easing,
					animateRotate: true,
					animateScale: false,
				};
				var pieData = [];
				total.each(function() {
					"use strict";
					var color = jQuery(this).data('color');
					var stop = parseInt(jQuery(this).data('stop'));
					var stopPercent = Math.round(stop/maximum*100);
					pieData.push({
						value: stopPercent,
						color: color
					});
				});
				if (total.length == 1) {
					morning_records_sc_animate_skills_counter(start, stop, Math.round(1500/steps), step, ed, total);
					pieData.push({
						value: 100-stopPercent,
						color: bg_color
					});
				}
				var canvas = skillsItem.find('canvas');
				canvas.attr({width: skillsItem.width(), height: skillsItem.width()}).css({width: skillsItem.width(), height: skillsItem.height()});
				new Chart(canvas.get(0).getContext("2d")).Doughnut(pieData, options);
			}
		}
	});
}

// Skills counter animation
function morning_records_sc_animate_skills_counter(start, stop, speed, step, ed, total) {
	"use strict";
	start = Math.min(stop, start + step);
	total.text(start+ed);
	if (start < stop) {
		setTimeout(function () {
			morning_records_sc_animate_skills_counter(start, stop, speed, step, ed, total);
		}, speed);
	}
}

// Skills arc init
function morning_records_sc_init_skills_arc(container) {
	"use strict";
	if (arguments.length==0) var container = jQuery('body');
	container.find('.sc_skills_arc:not(.inited)').each(function () {
		var arc = jQuery(this);
		arc.addClass('inited');
		var items = arc.find('.sc_skills_data .arc');
		var canvas = arc.find('.sc_skills_arc_canvas').eq(0);
		var legend = arc.find('.sc_skills_legend').eq(0);
		var w = Math.round(arc.width() - legend.width());
		var c = Math.floor(w/2);
		var o = {
			random: function(l, u){
				"use strict";
				return Math.floor((Math.random()*(u-l+1))+l);
			},
			diagram: function(){
				"use strict";
				var r = Raphael(canvas.attr('id'), w, w),
					hover = Math.round(w/2/items.length),
					rad = hover,
					step = Math.round(((w-20)/2-rad)/items.length),
					stroke = Math.round(w/9/items.length),
					speed = 400;
				
				
				r.circle(c, c, Math.round(w/2)).attr({ stroke: 'none', fill: MORNING_RECORDS_STORAGE['theme_skin_bg_color'] ? MORNING_RECORDS_STORAGE['theme_skin_bg_color'] : '#ffffff' });
				
				var title = r.text(c, c, arc.data('caption')).attr({
					font: Math.round(rad*0.75)+'px "'+MORNING_RECORDS_STORAGE['theme_font']+'"',
					fill: MORNING_RECORDS_STORAGE['theme_skin_color'] ? MORNING_RECORDS_STORAGE['theme_skin_color'] : '#909090'
				}).toFront();
				
				rad -= Math.round(step/2);

				r.customAttributes.arc = function(value, color, rad){
					"use strict";
					var v = 3.6 * value,
						alpha = v == 360 ? 359.99 : v,
						rand = o.random(91, 240),
						a = (rand-alpha) * Math.PI/180,
						b = rand * Math.PI/180,
						sx = c + rad * Math.cos(b),
						sy = c - rad * Math.sin(b),
						x = c + rad * Math.cos(a),
						y = c - rad * Math.sin(a),
						path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
					return { path: path, stroke: color }
				}
				
				items.each(function(i){
					"use strict";
					var t = jQuery(this), 
						color = t.find('.color').val(),
						value = t.find('.percent').val(),
						text = t.find('.text').text();
					
					rad += step;
					var z = r.path().attr({ arc: [value, color, rad], 'stroke-width': stroke });
					
					z.mouseover(function(){
						"use strict";
						this.animate({ 'stroke-width': hover, opacity: .75 }, 1000, 'elastic');
						if (Raphael.type != 'VML') //solves IE problem
							this.toFront();
						title.stop().animate({ opacity: 0 }, speed, '>', function(){
							this.attr({ text: (text ? text + '\n' : '') + value + '%' }).animate({ opacity: 1 }, speed, '<');
						});
					}).mouseout(function(){
						"use strict";
						this.stop().animate({ 'stroke-width': stroke, opacity: 1 }, speed*4, 'elastic');
						title.stop().animate({ opacity: 0 }, speed, '>', function(){
							title.attr({ text: arc.data('caption') }).animate({ opacity: 1 }, speed, '<');
						});	
					});
					
				});
				
			}
		}
		o.diagram();
	});
}


// Countdown update
function morning_records_countdown(dt) {
	"use strict";
	var counter = jQuery(this).parent();
	for (var i=3; i<dt.length; i++) {
		var v = (dt[i]<10 ? '0' : '') + dt[i];
		counter.find('.sc_countdown_item').eq(i-3).find('.sc_countdown_digits span').addClass('hide');
		for (var ch=v.length-1; ch>=0; ch--) {
			counter.find('.sc_countdown_item').eq(i-3).find('.sc_countdown_digits span').eq(ch+(i==3 && v.length<3 ? 1 : 0)).removeClass('hide').text(v.substr(ch, 1));
		}
	}
}


// Contact form handlers
function morning_records_sc_form_validate(form){
	"use strict";
	var url = form.attr('action');
	if (url == '') return false;
	form.find('input').removeClass('error_fields_class');
	var error = false;
	var form_custom = form.data('formtype')=='form_custom';
	if (!form_custom) {
		error = morning_records_form_validate(form, {
			error_message_show: true,
			error_message_time: 4000,
			error_message_class: "sc_infobox sc_infobox_style_error",
			error_fields_class: "error_fields_class",
			exit_after_first_error: false,
			rules: [
				{
					field: "username",
					min_length: { value: 1,	 message: MORNING_RECORDS_STORAGE['strings']['name_empty'] },
					max_length: { value: 60, message: MORNING_RECORDS_STORAGE['strings']['name_long'] }
				},
				{
					field: "email",
					min_length: { value: 7,	 message: MORNING_RECORDS_STORAGE['strings']['email_empty'] },
					max_length: { value: 60, message: MORNING_RECORDS_STORAGE['strings']['email_long'] },
					mask: { value: MORNING_RECORDS_STORAGE['email_mask'], message: MORNING_RECORDS_STORAGE['strings']['email_not_valid'] }
				},
				{
					field: "subject",
					min_length: { value: 1,	 message: MORNING_RECORDS_STORAGE['strings']['subject_empty'] },
					max_length: { value: 100, message: MORNING_RECORDS_STORAGE['strings']['subject_long'] }
				},
				{
					field: "message",
					min_length: { value: 1,  message: MORNING_RECORDS_STORAGE['strings']['text_empty'] },
					max_length: { value: MORNING_RECORDS_STORAGE['contacts_maxlength'], message: MORNING_RECORDS_STORAGE['strings']['text_long'] }
				}
			]
		});
	}
	if (!error && url!='#') {
		jQuery.post(url, {
			action: "send_form",
			nonce: MORNING_RECORDS_STORAGE['ajax_nonce'],
			type: form.data('formtype'),
			data: form.serialize()
		}).done(function(response) {
			"use strict";
			var rez = {};
			try {
				rez = JSON.parse(response);
			} catch (e) {
				rez = { error: MORNING_RECORDS_STORAGE['ajax_error'] };
				console.log(response);
			}
			var result = form.find(".result").toggleClass("sc_infobox_style_error", false).toggleClass("sc_infobox_style_success", false);
			if (rez.error === '') {
				form.get(0).reset();
				result.addClass("sc_infobox_style_success").html(MORNING_RECORDS_STORAGE['strings']['send_complete']);
				var return_url = form.find('input[name="return_url"]');
				if (return_url.length > 0 && return_url.val()!='') {
					setTimeout(function() {
						"use strict";
						window.location.href = return_url.val();
					}, 3300);
				}
			} else {
				result.addClass("sc_infobox_style_error").html(MORNING_RECORDS_STORAGE['strings']['send_error'] + ' ' + rez.error);
			}
			result.fadeIn().delay(3000).fadeOut();
		});
	}
	return !error;
}



// Get players by category
function morning_records_select_players_category(sel) {
	var value = sel.find(':selected').data('cat');
	var table = sel.parents('.sc_players_table');
	if (value == 'all') 
		jQuery(table).find('.sc_table tr:nth-child(n+2)').show();
	else {
		jQuery(table).find('.sc_table tr:nth-child(n+2)').hide();
		jQuery(table).find('.sc_table tr').each(function() { 
			var cat = jQuery(this).data('cat'); 
			if (cat != null && cat.indexOf(value)!=-1)
			   jQuery(this).show();
		});
	}
}



// Display menuitem in the popup
function morning_records_menuitems_show_popup(obj) {
	"use strict";
	
	// First init vars
	if (typeof MORNING_RECORDS_STORAGE['menuitem_load'] == 'undefined') {
		MORNING_RECORDS_STORAGE['menuitem_load'] = false;
		MORNING_RECORDS_STORAGE['menuitems_list'] = [];

	// If busy - return
	} else if ( MORNING_RECORDS_STORAGE['menuitem_load'] ) {
		return;
	}
	
	// Show preloader
	jQuery('#page_preloader').data('bg-color', jQuery('#page_preloader').css('background-color')).css({display: 'block', opacity: 0, backgroundColor: 'transparent'}).animate({opacity:0.8}, 300);

	// Get items list on first click
	if (MORNING_RECORDS_STORAGE['menuitems_list'].length == 0) {
		var menuitems_list_id = obj.parents('.sc_menuitems').attr("id");
		MORNING_RECORDS_STORAGE['menuitems_list'] = MORNING_RECORDS_STORAGE['menuitems'][menuitems_list_id].split(",");
	}
	
	var menuitem_id = obj.attr('rel');
	
	MORNING_RECORDS_STORAGE['menuitem_load'] = true;
	
	jQuery.post(MORNING_RECORDS_STORAGE['ajax_url'], {
		action: 'ajax_menuitem',
		nonce: MORNING_RECORDS_STORAGE['ajax_nonce'],
		text: menuitem_id
	}).done(function(response) {
		"use strict";
		MORNING_RECORDS_STORAGE['menuitem_load'] = false;
		var rez = {};
		try {
			rez = JSON.parse(response);
		} catch (e) {
			rez = { error: MORNING_RECORDS_STORAGE['ajax_error'] + '<br>' + response };
		}
		jQuery('#page_preloader').animate({opacity:0}, 500, function() { jQuery(this).css({display: 'none', backgroundColor: jQuery(this).data('bg-color')}); });
		if (rez.error === '') {
			var delay = 0;
			// Create popup
			if (jQuery('.popup_menuitem').length == 0) {
				jQuery('body').append('<div id="overlay"></div><div class="popup_menuitem"></div>');
				jQuery('#overlay').fadeIn(500);
			} else {
				delay = 500;
				jQuery('.popup_menuitem').fadeOut(delay);
			}
			// Add new content in the popup
			setTimeout(function() {
				jQuery('.popup_menuitem').html(rez.data);
				jQuery('.popup_menuitem .sc_menuitems_wrap').append("<a class='close_menuitem' href='#'><span class='icon-cancel'></span></a>");
				if ( MORNING_RECORDS_STORAGE['menuitems_list'].length > 1 ) {
					var idx = 0;
					for (var i=0; i<MORNING_RECORDS_STORAGE['menuitems_list'].length; i++ ) {
						if ( MORNING_RECORDS_STORAGE['menuitems_list'][i] === menuitem_id ) {
							idx = i;
							break;
						}
					}
					var prev = (idx - 1 + MORNING_RECORDS_STORAGE['menuitems_list'].length) % MORNING_RECORDS_STORAGE['menuitems_list'].length;
					var next = (idx + 1) % MORNING_RECORDS_STORAGE['menuitems_list'].length;
					jQuery('.popup_menuitem .sc_menuitems_wrap .sc_menuitem_content').append(
						  "<a class='prev_menuitem prevnext_menuitem show_popup_menuitem' rel='"+MORNING_RECORDS_STORAGE['menuitems_list'][prev]+"'  href='#'><span class='icon-left'></span></a>"
						+ "<a class='next_menuitem prevnext_menuitem show_popup_menuitem' rel='"+MORNING_RECORDS_STORAGE['menuitems_list'][next]+"'  href='#'><span class='icon-right'></span></a>"
					);
				}
				jQuery('.popup_menuitem').fadeIn(500);
			}, delay);
		} else {
			morning_records_message_warning(MORNING_RECORDS_STORAGE['strings']['search_error']);
		}
	});	
}

// Hide popup with menuitem
function morning_records_menuitems_hide_popup() {
	"use strict";
	jQuery('#overlay').fadeOut();
	jQuery('.popup_menuitem').fadeOut(function() {
		MORNING_RECORDS_STORAGE['menuitem_load'] = false;
		MORNING_RECORDS_STORAGE['menuitems_list'] = [];
		jQuery('#overlay').remove();
		jQuery(this).remove();
	});
}
