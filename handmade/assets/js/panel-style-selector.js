(function ($) {
	"use strict";
	var G5PlusPanelStyleSelector = {
		htmlTag: {
			wrapper: '#panel-style-selector'
		},
		vars: {
			isLoading: false
		},
		initialize: function () {
			if (!$('body').hasClass('woocommerce-compare-page')) {
				G5PlusPanelStyleSelector.build();
			}
		},
		build: function () {
			$.ajax({
				type: 'POST',
				data: 'action=panel_selector',
				url: g5plus_framework_ajax_url,
				success: function (html) {
					$('body').append(html);
					G5PlusPanelStyleSelector.events();
				},
				error: function (html) {

				}
			});
		},
		events: function () {
			$('.panel-selector-open', G5PlusPanelStyleSelector.htmlTag.wrapper).click(function () {
				$('.panel-wrapper', G5PlusPanelStyleSelector.htmlTag.wrapper).toggleClass('in');
			});
			$('.panel-selector-open', G5PlusPanelStyleSelector.htmlTag.wrapper).hover(function () {
				$('i', this).addClass('fa-spin');
			}, function () {
				$('i', this).removeClass('fa-spin');
			});

			G5PlusPanelStyleSelector.layout();
			G5PlusPanelStyleSelector.background();
			G5PlusPanelStyleSelector.reset();
			G5PlusPanelStyleSelector.rtl();
			G5PlusPanelStyleSelector.primary_color();

		},
		layout: function () {

			if ($('body').hasClass('boxed')) {
				$('a[data-value="boxed"]', G5PlusPanelStyleSelector.htmlTag.wrapper).addClass('active');
			} else {
				$('a[data-value="wide"]', G5PlusPanelStyleSelector.htmlTag.wrapper).addClass('active');
			}

			$('a[data-type="layout"]', G5PlusPanelStyleSelector.htmlTag.wrapper).click(function (event) {
				event.preventDefault();

				$('a[data-type="layout"]', G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('active');
				$(this).addClass('active');

				var layout = $(this).attr('data-value');
				if (layout == 'boxed') {
					$('body').addClass('boxed');
				} else {
					$('body').removeClass('boxed');
				}
				$('#wrapper-content').trigger(jQuery.Event('resize'));
			})

		},
		background: function () {
			$('.panel-primary-background li', G5PlusPanelStyleSelector.htmlTag.wrapper).click(function (event) {
				event.preventDefault();
				var name = $(this).data('name');
				var type = $(this).data('type');

				$('body').css({
					'background-image': 'url(' + g5plus_framework_theme_url + 'assets/images/theme-options/' + name + ')',
					'background-repeat': 'repeat',
					'background-position': 'center center',
					'background-attachment': 'scroll',
					'background-size': 'auto'
				});

				$('ul.panel-primary-background li', G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('active');
				$(this).addClass('active');

			})
		},
		primary_color: function () {
			$('ul.panel-primary-color li', G5PlusPanelStyleSelector.htmlTag.wrapper).click(function (event) {
				event.preventDefault();
				var $this = $(this);
				if (G5PlusPanelStyleSelector.vars.isLoading) return;
				G5PlusPanelStyleSelector.vars.isLoading = true;
				var color = $(this).data('color');
				$('.panel-selector-open i', G5PlusPanelStyleSelector.htmlTag.wrapper).addClass('fa-spin');
				$.ajax({
					url: g5plus_framework_ajax_url,
					data: {
						action: 'custom_css_selector',
						primary_color: color
					},
					success: function (response) {
						G5PlusPanelStyleSelector.vars.isLoading = false;

						$('ul.panel-primary-color li', G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('active');
						$this.addClass('active');

						if ($('style#color_ss').length == 0) {
							$('head').append('<style type="text/css" id="color_ss"></style>');
						}

						$('style#color_ss').html(response);
						$('.panel-selector-open i', G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('fa-spin');
					},
					error: function () {
						G5PlusPanelStyleSelector.vars.isLoading = false;
						$('.panel-selector-open i', G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('fa-spin');
					}
				});

			});
		},
		reset: function () {
			$('#panel-selector-reset', G5PlusPanelStyleSelector.htmlTag.wrapper).click(function (event) {
				event.preventDefault();
				document.location.reload(true);
			})
		},
		rtl : function() {
			$('#panel-selector-rtl', G5PlusPanelStyleSelector.htmlTag.wrapper).click(function (event) {
				event.preventDefault();
				if (G5PlusPanelStyleSelector.vars.isLoading) return;
				G5PlusPanelStyleSelector.vars.isLoading = true;
				$('.panel-selector-open i', G5PlusPanelStyleSelector.htmlTag.wrapper).addClass('fa-spin');

				var mode = $(this).data('mode');
				if (mode == 'on') {
					$('#rtl-css').remove();
					$(this).data('mode','off');
					$(this).text('RTL On')
				} else {
					$('body').append("<link rel='stylesheet' id='rtl-css'  href='"+g5plus_framework_theme_url+"assets/css/rtl.min.css' type='text/css' media='all' />");
					$(this).data('mode','on');
					$(this).text('RTL Off')
				}

				G5PlusPanelStyleSelector.vars.isLoading = false;
				$('.panel-selector-open i', G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('fa-spin');
			})
		}
	};

	$(document).ready(function () {
		G5PlusPanelStyleSelector.initialize();
	});
})(jQuery);