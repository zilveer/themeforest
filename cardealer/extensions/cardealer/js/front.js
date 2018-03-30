(function ($) {

	$(function () {

		/* Car video editing*/
		$("#add_car_video").on('click', function () {
			var video_list = $('#cars_videos'),
				template = video_list.find("li:first-child").html();

			video_list.append('<li>' + template + '</li>')
					  .find("li:last-child input[type=text]").val('');

			return false;
		});

		$(".remove_car_video").life('click', function () {
			if ($('#cars_videos').find('li').length > 1) {
				$(this).parents('li').hide(200, function () {
					$(this).remove();
				});
			}

			return false;
		});

		/* Car listing sorting */
		$(".js_order_cars_by").on('click', function () {
			var current_url = window.location.href,
				orderby = $(this).attr('data-orderby'),
				order = $(this).attr('data-order');

			current_url = tmm_add_query_arg(current_url, 'orderby', orderby);
			current_url = tmm_add_query_arg(current_url, 'order', order);

			window.location.href = current_url;
			return false;
		});

		/* Car listing items per page */
		$('#items_per_page').on('change', function () {
			var current_url = window.location.href,
				per_page = $(this).val();

			current_url = tmm_add_query_arg(current_url, 'per_page', per_page);

			window.location.href = current_url;
			return false;
		});

		/* Single car slider */
		if ($('#car_slider').length) {

			var totalSlides = $('#sliderControls>li').length,
				slideCount = 3;

			var mainSlider = $('.slider #car_slider').sudoSlider({
				speed: 500,
				continuous: true,
				touch: true,
				initCallback: function(){
					$('.car-slider-wrapper').removeClass('loader');
				},
				beforeAnimation: function (t) {
					// Thumbnails fade to which is current.
					var allSlides = controlsSlider.children().children();
					var currentThumbnail = controlsSlider.getSlide(t).add(controlsSlider.getSlide(t + totalSlides)).add(controlsSlider.getSlide(t + 2 * totalSlides));
					allSlides.not(currentThumbnail).fadeTo(400, 0.55);
					currentThumbnail.fadeTo(400, 1);

					if ( totalSlides > slideCount ) {
						var dir = (t - 1) + totalSlides;
						var currentSlide = controlsSlider.getValue("currentSlide");
						var diff = -currentSlide + dir;
						var targetSlide = dir;

						var newDiff = -currentSlide + dir + totalSlides;
						if (Math.abs(newDiff) < Math.abs(diff)) {
							targetSlide = dir + totalSlides;
							diff = newDiff;
						}

						newDiff = -currentSlide + dir - totalSlides;
						if (Math.abs(newDiff) < Math.abs(diff)) {
							targetSlide = dir - totalSlides;
						}

						controlsSlider.goToSlide(targetSlide);
					}

				}
			});

			var controlsSlider = $("#sliderControls").sudoSlider({
				speed: 800,
				touch: true,
				prevNext: false,
				slideCount: slideCount,
				moveCount: 1,
				startSlide: totalSlides,
				continuous: true,
				customLink: ".slider-thumb-controls a",
				initCallback: function(){
					controlsSlider.getSlide(1).fadeTo(400, 1);
				}
			});

			$("#sliderControls").on("click", "li", function () {
				var slide = $(this).attr("data-slide");
				mainSlider.goToSlide(Number(slide) % totalSlides);
			});

			if ( totalSlides > slideCount ) {
				$('.slider-thumb-controls').show();
			}

		}

		/* Other */
		var app_cardealer_app_front = new THEMEMAKERS_APP_CARDEALER_FRONT();
		app_cardealer_app_front.init();

	});


	var THEMEMAKERS_APP_CARDEALER_FRONT = function () {

		var self = {
			init: function () {
				jQuery("#set_dealer_loan_rate").click(function () {
					var rate_input = jQuery(this).prev('input'),
						data = {
							'action': "app_cardealer_set_dealer_loan_rate",
							'rate': rate_input.val()
						};

					jQuery.post(ajaxurl, data, function (response) {
						if(response == 0){
							response = '';
						}
						rate_input.val(response);
						show_info_popup(tmm_l10n.loan_rate_updated);
					});
					return false;
				});

				jQuery(".js_delete_user_car").click(function () {
					if (confirm(tmm_l10n.delete_car_notice)) {
						var post_id = jQuery(this).data('post-id');
						var data = {
							'action': "app_cardealer_delete_car",
							'post_id': post_id
						};
						jQuery.post(ajaxurl, data, function (response) {
							response = jQuery.parseJSON(response);
							if (response != null) {
								alert(response.error);
							} else {
								jQuery('#post-' + post_id).hide(200, function () {
									jQuery(this).remove();
								});
							}
						});
					}

					return false;
				});

				jQuery(".js_sold_user_car").life('click', function () {
					var post_id = jQuery(this).data('post-id');
					var sold = 0;
					if (jQuery(this).is(':checked')) {
						sold = 1;
					}

					var self_obj = this;
					jQuery(self_obj).val(Math.abs(sold));

					var data = {
						'action': "app_cardealer_sold_car",
						'post_id': post_id,
						'car_is_sold': Math.abs(sold)
					};
					jQuery.post(ajaxurl, data, function (response) {
						response = jQuery.parseJSON(response);
						if (response && response.error && response.error != '') {
							alert(response.error);
							return false;
						}

						if (Math.abs(sold) != 1) {
							jQuery('#post-' + post_id + ' a.single-image').removeClass('car_is_sold');
							jQuery('#post-' + post_id + ' .sold-ribbon-wrapper').hide();
							jQuery('#post-' + post_id + ' .js_feature_user_car').removeAttr('disabled');
						} else {
							jQuery('#post-' + post_id + ' a.single-image').addClass('car_is_sold');
							jQuery('#post-' + post_id + ' .sold-ribbon-wrapper').show();
							jQuery('#post-' + post_id + ' .ribbon-wrapper').hide();
							jQuery('#post-' + post_id + ' .js_feature_user_car').removeAttr('checked').attr('disabled', 'disabled');
						}

					});

					return true;
				});

				jQuery(".js_draft_user_car").life('click', function () {
					var post_id = jQuery(this).data('post-id');
					var draft = 0;
					if (jQuery(this).is(':checked')) {
						draft = 1;
						jQuery('#post-' + post_id).addClass('status-draft');
					} else {
						jQuery('#post-' + post_id).removeClass('status-draft');
					}

					var self_obj = this;
					jQuery(self_obj).val(Math.abs(draft));

					var data = {
						'action': "app_cardealer_draft_car",
						'post_id': post_id,
						'car_is_draft': Math.abs(draft)
					};
					jQuery.post(ajaxurl, data, function (response) {
						response = jQuery.parseJSON(response);
						if (response != null) {
							jQuery(self_obj).prop('checked', 'checked');
							alert(response.error);
							return false;
						}
					});


					return true;
				});

				//set car as featured
				jQuery(".js_feature_user_car").life('click', function () {
					var is_checked = jQuery(this).is(':checked'),
						can_set_featured = jQuery(this).data('can-set-featured');

					if (!can_set_featured) {
						jQuery("a#featured_user_car_message_show").fancybox({
							'hideOnContentClick': true
						}).trigger('click');
						return false;
					}

					if (is_checked) {
						var c = confirm(tmm_l10n.featured_confirm);
						if (!c) {
							return false;
						}
					}

					var post_id = jQuery(this).data('post-id');
					var _this = this;
					var data = {
						action: "app_cardealer_set_user_car_as_featured",
						value: (is_checked ? 1 : 0),
						post_id: post_id
					};
					jQuery.post(ajaxurl, data, function (response) {
						response = response;

						if (!tmm_l10n.current_user_can_delete) {
							jQuery(_this).attr('disabled', 'disabled');
						}

						if (response == '1') {
							jQuery('#post-' + post_id + ' a.single-image').addClass('car_is_featured');
							jQuery('#post-' + post_id + ' .ribbon-wrapper').show();
							jQuery(_this).prop('disabled', true);
							show_info_popup(tmm_l10n.car_is_featured);
						} else if (response == '0') {
							jQuery('#post-' + post_id + ' a.single-image').removeClass('car_is_featured');
							jQuery('#post-' + post_id + ' .ribbon-wrapper').hide();
							show_info_popup(tmm_l10n.car_is_unfeatured);
							return false;
						} else if (response == '-1') {
							jQuery('#post-' + post_id + ' a.single-image').removeClass('car_is_featured');
							jQuery('#post-' + post_id + ' .ribbon-wrapper').hide();
							jQuery(_this).prop('checked', false);
							jQuery("a#inline").fancybox({
								'hideOnContentClick': true
							}).trigger('click');
							return false;
						}

					});
				});

				function get_filtered_cars(params, page) {
					var user_id = jQuery('#current_user_id').data('id');
					var dealer_page = jQuery('#current_user_id').data('dealer');
					var template_user = jQuery('#current_user_id').data('template');
					var posts_per_page = jQuery('#current_user_id').data('posts-per-page');
					var data = {
						action: "app_cardealer_filtered_cars",
						user: user_id,
						params: params,
						page: page,
						dealer_page: dealer_page,
						template_user: template_user,
						posts_per_page : posts_per_page
					};
					jQuery.post(ajaxurl, data, function (response) {
						response = jQuery.parseJSON(response);
						var change_items = jQuery('#change-items');
						var pagenavi = jQuery('.wp-pagenavi');
						pagenavi.empty();
						change_items.empty();
						if (response) {
							if (response.items) {
								change_items.append(response.items);
								add_image_icons();
							} else {
								var notice = jQuery('<p class="notice">There\'s no cars by this filter</p>');
								change_items.append(notice);
							}
							if (response.pagination) {
								pagenavi.append(response.pagination);
								var page_numbers = jQuery('.wp-pagenavi .page-numbers');
								page_numbers.addClass('js-page-numbers');
								page_numbers.each(function () {
									var $this = jQuery(this);
									var href = $this.attr('href');
									if (href != undefined) {
										href = href.split('paged=');
										$this.attr('data-paged', href[1]);
									}
								});
							}
						}
						else {
							var notice = jQuery('<p class="notice">Please set one or more car features for filtering</p>');
							change_items.append(notice);
						}
					});
				}

				function add_image_icons(){
					jQuery('.single-image, .image-post-slider-cars-listing').each(function (idx, val) {
						if (jQuery(val).hasClass('picture')) {
							jQuery(this).append('<span class="picture-icon"></span>');
						}
						if (jQuery(val).hasClass('video')) {
							jQuery(this).append('<span class="video-icon"></span>');
						}
					});
				}

				add_image_icons();


				/* Filter user cars */
				jQuery('.js_filt_cars').click(function () {
					var is_checked_items = jQuery('.js_filt_cars');
					var params = [];
					var $this = jQuery(this);

					if ($this.attr('id') == 'filt_all_cars') {
						is_checked_items.each(function () {
							var $this = jQuery(this);
							$this.val(0);
							$this.prop('checked', false);
						});
						$this.prop('checked', true);
						$this.val(1);
					}
					else {
						jQuery('#filt_all_cars').prop('checked', false).val(0);
					}

					is_checked_items.each(function () {
						var $this = jQuery(this);
						if ($this.is(':checked')) {
							params.push($this.attr('id'));
						}
					});

					get_filtered_cars(params, 1);

				});


				jQuery('.convert').life('click', function () {
					var $this = jQuery(this);
					var converter_item = jQuery('.converter');

					if (parseFloat($this.data('convert')) === 0) {
						return false;
					}

					if (converter_item.length) {
						converter_item.remove();
					}

					if ($this.attr('class').indexOf('active') != -1) {
						$this.removeClass('active');
						jQuery('body').off('click.convert');
					} else {
						jQuery('body').on('click.convert', function (e) {
							var target = jQuery(e.target);
							if(!target.hasClass('convert') && !target.hasClass('converter') && !target.parents().hasClass('converter')){
								$this.removeClass('active');
								jQuery('.converter').remove();
								jQuery('body').off('click.convert');
							}
						});
						$this.addClass('active');

						var loading = jQuery('<div class="converter"><div id="ballsWaveG"><div id="ballsWaveG_1" class="ballsWaveG"></div><div id="ballsWaveG_2" class="ballsWaveG"></div><div id="ballsWaveG_3" class="ballsWaveG"></div><div id="ballsWaveG_4" class="ballsWaveG"></div><div id="ballsWaveG_5" class="ballsWaveG"></div><div id="ballsWaveG_6" class="ballsWaveG"></div><div id="ballsWaveG_7" class="ballsWaveG"></div><div id="ballsWaveG_8" class="ballsWaveG"></div></div></div>');
						loading.hide();
						$this.parent().append(loading);
						loading.fadeIn(300);
						var from = $this.data('convert');
						var output = '';
						var buttons = '';
						var serving_quota = '';
						var data = {
							action: "app_cardealer_convert_curency",
							from: from
						};
						jQuery.post(ajaxurl, data, function (response) {
							response = jQuery.parseJSON(response);

							jQuery(response).each(function (i, val) {
								jQuery.each(val, function (k, v) {
									output += v + '' + k.toUpperCase() + '; ';
									var cur = '',
										ph = '',
										icon_class = k;

									switch (k) {
										case 'usd':
											cur = '&#36';
											break;
										case 'eur':
											cur = '&#8364';
											break;
										case 'gbp':
											cur = '&#163';
											break;
										case 'chf':
											cur = '&#67;&#72;&#70;';
											break;
										case 'aud':
											cur = '&#36';
											break;
										case 'cad':
											cur = '&#36';
											break;
										case 'sek':
											cur = '&#107;&#114';
											break;
										case 'czk':
											cur = '&#75;&#269';
											break;
										case 'nok':
											cur = '&#107;&#114';
											break;
										case 'rub':
											cur = '&#1088;&#1091;&#1073';
											break;
										case 'jpy':
											cur = '&#165;';
											break;
										default:
											ph = k;
											icon_class = 'no_icon'
											break;
									}
									if (v == 'This application is temporarily over its serving quota') {
										serving_quota = v;
									}
									buttons += '<li data-currency="' + v + '"><span class="' + icon_class + '">' + ph + '</span><div>' + cur + '</div></li>'
								});
							});
							if (serving_quota) {
								var converter_value = jQuery('<h6>'+tmm_l10n.currency_converter+'</h6><p>' + serving_quota + '</p>');
							}
							else {
								var converter_value = jQuery('<h6>'+tmm_l10n.currency_converter+'</h6><input class="value_holder" value="" type="text" readonly><ul>' + buttons + '</ul>');
							}

							var converter_div = jQuery('.converter');
							converter_div.empty();
							converter_value.hide();
							$this.parent().find('.converter').append(converter_value);
							converter_value.fadeIn(500);
							jQuery('.converter li:first-child').addClass('active');
							var val = converter_value.find('li').first().data('currency');
							var value_holder = jQuery('.value_holder');
							value_holder.val(val);

						});
					}

				});

				jQuery('.converter li').life('click', function () {
					var $this = jQuery(this);
					var val = $this.data('currency');
					var converter = $this.parent().parent();
					converter.find('input').val(val);
					converter.find('li').removeClass('active');
					$this.addClass('active');
				});

				jQuery('.js-page-numbers').life('click', function () {
					var $this = jQuery(this);
					var params = [];
					var is_checked_items = jQuery('.js_filt_cars');
					var page = $this.data('paged');
					is_checked_items.each(function () {
						var $this = jQuery(this);
						if ($this.is(':checked')) {
							params.push($this.attr('id'));
						}
					});
					get_filtered_cars(params, page);
					return false;
				});

				jQuery(".js_car_compare").life('click', function () {
					var post_id = jQuery(this).data('post-id');
					if (jQuery(this).is(':checked')) {
						show_info_popup(tmm_l10n.added_to_compare);
						self.operate_compare_list(post_id, true, 'car_compare_list');
					} else {
						show_info_popup(tmm_l10n.removed_from_compare);
						self.operate_compare_list(post_id, false, 'car_compare_list');
					}

				});

				jQuery(".js_car_watch_list").life('click', function () {
					if (tmm_l10n.allow_watch_list == 0) {
						show_info_popup(tmm_l10n.add_to_watch_notice);
						jQuery(this).removeAttr('checked');
						return;
					}

					var post_id = jQuery(this).data('post-id');
					if (jQuery(this).is(':checked')) {
						show_info_popup(tmm_l10n.added_to_watch);
						self.operate_compare_list(post_id, true, 'car_watch_list');
					} else {
						show_info_popup(tmm_l10n.removed_from_watch);
						self.operate_compare_list(post_id, false, 'car_watch_list');
						try {
							if (is_watch_list == true) {
								jQuery(this).parents('article').animate({
									opacity: 0
								}, 300, function () {
									jQuery(this).animate({
										width: 'hide',
										height: 'hide',
										padding: 'hide',
										marginRight: 0
									}, 300, function () {
										jQuery(this).remove();
									});
								});
							}
						} catch (e) {

						}
					}

				});

				//***

				jQuery('.js_remove_car_from_compare_list').click(function () {
					var post_id = jQuery(this).data('post-id');
//				jQuery("#car_col_" + post_id).fadeOut(200, function() {
//					jQuery(this).remove();
//					self.operate_compare_list(post_id, false, 'car_compare_list');
//				});
					self.operate_compare_list(post_id, false, 'car_compare_list');
				});


			},
			operate_compare_list: function (post_id, add_to_list, list_name) {
				//add_to_list - true=>add, false=>remove
				//list_name - car_compare_list,car_watch_list
				var compare_list = jQuery.cars_cookie(list_name);

				if (compare_list == undefined) {
					compare_list = [];
				}
				//***

				var tmp_array = [];
				if (compare_list.length > 0) {
					tmp_array = compare_list.split(',');
					tmp_array = jQuery.grep(tmp_array, function (value) {
						return parseInt(value, 10);
					});
					tmp_array = self.removeDuplicates(tmp_array);
				}

				//***

				if (add_to_list) {
					tmp_array.push(post_id);
				} else {
					tmp_array = self.removeByValue(tmp_array, post_id);
				}

				//***

				compare_list = self.removeDuplicates(tmp_array);
				if (compare_list.length == 0) {
					compare_list = "";
				}
				jQuery.cars_cookie(list_name, compare_list, {
					expires: 365,
					path: "/"
				});
			},
			removeDuplicates: function (inputArray) {
				var outputArray = [];

				if (inputArray.length > 0) {
					jQuery.each(inputArray, function (index, value) {
						if (jQuery.inArray(value, outputArray) == -1) {
							outputArray.push(value);
						}
					});
				}
				return outputArray;
			},
			removeByValue: function (inputArray, value_to_remove) {
				var outputArray = [];
				if (inputArray.length > 0) {
					jQuery.each(inputArray, function (index, value) {
						if (value != value_to_remove) {
							outputArray.push(value);
						}
					});
				}
				return outputArray;
			}

		};

		return self;
	};

})(jQuery);


/* ---------------------------------------------------- */
/*	jQuery Cookie
 /* ---------------------------------------------------- */

//for color options history

jQuery.cars_cookie = function (name, value, options) {
	if (typeof value != 'undefined') {
		options = options || {};
		if (value === null) {
			value = '';
			options.expires = -1;
		}
		var expires = '';
		var date = new Date();
		date.setTime(date.getTime() + 24 * 60 * 60 * 30 * 1000);
		expires = '; expires=' + date.toUTCString();


		var path = options.path ? '; path=' + (options.path) : '';
		var domain = options.domain ? '; domain=' + (options.domain) : '';
		var secure = options.secure ? '; secure' : '';
		document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
	} else {
		var cookieValue = null;
		if (document.cookie && document.cookie != '') {
			var cookies = document.cookie.split(';');
			for (var i = 0; i < cookies.length; i++) {
				var cookie = jQuery.trim(cookies[i]);
				if (cookie.substring(0, name.length + 1) == (name + '=')) {
					cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
					break;
				}
			}
		}
		return cookieValue;
	}
};


function show_info_popup(text) {
    var popup = jQuery("#info_popup-wrapper");
    if(!popup.length){
        jQuery('body').prepend('<div id="info_popup-wrapper"><ul id="info_popup-wrapper-page"><li><div class="info_popup"></div></li></ul></div>');
    }
	jQuery(".info_popup").text(text);
	jQuery("#info_popup-wrapper").fadeIn(200);
	window.setTimeout(function () {
		jQuery("#info_popup-wrapper").fadeOut(400);
	}, 1000);
}
