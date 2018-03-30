/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);

	// Color Picker
	$('.mpcth-of-section-color .of-color').wpColorPicker({
		palettes: false
	});

	// Switches option sections
	$('.group').hide();

	$('.group:first').fadeIn();

	$('.mpcth-of-accordion-heading').on('click', function(e) {
		var $this = $(this);

		$this.next().stop(true, true);

		if($this.hasClass('mpcth-of-ac-open')) {
			$this.removeClass('mpcth-of-ac-open');
			$this.next().slideUp();
		} else {
			$this.next().slideDown();
			$('.mpcth-of-accordion-heading.mpcth-of-ac-open')
				.next()
					.slideUp()
					.end()
				.removeClass('mpcth-of-ac-open');

			$this.addClass('mpcth-of-ac-open');
		}

		e.preventDefault();
	});

	$('.mpcth-of-accordion-heading:not(.mpcth-of-ac-open)').next().hide();

	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each(
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});

	$('.mpcth-of-nav-tab-wrapper a:first').addClass('nav-tab-active');

	$('.mpcth-of-nav-tab-wrapper a').click(function(evt) {
		var $this = $(this);

		$('.mpcth-of-nav-tab-wrapper a').removeClass('nav-tab-active');
		$this.addClass('nav-tab-active').blur();
		var clicked_group = $this.attr('href');


		if (typeof(localStorage) != 'undefined' )
			localStorage.setItem("activetab", $this.attr('href'));

		var $clicked_group = $(clicked_group);

		$('.group').hide();
		$clicked_group.find('.mpcth-of-accordion-heading').removeClass('mpcth-of-ac-open');
		$clicked_group.find('.mpcth-of-accordion-heading').first().addClass('mpcth-of-ac-open');
		$clicked_group.find('.mpcth-of-accordion-content').hide().removeClass('mpcth-of-ac-open');
		$clicked_group.find('.mpcth-of-accordion-content').first().show().addClass('mpcth-of-ac-open');

		if (typeof(localStorage) != 'undefined' )
			localStorage.setItem("activeaccordion", 0);

		$clicked_group.fadeIn();

		evt.preventDefault();

		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $this.find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});

	});

	$('.group .collapsed input:checkbox').click(unhideHidden);

	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each(
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;
					}
				$(this).addClass('hidden');
			});
		}
	}

	// images
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	// slider
	$('.mpcth-of-slider').slider({
		min: 0,
		max: 100,
		step: 1,
		slide: function( event, ui ) {
                        var suffix = $(this).data('suffix');
			$(this).siblings('input').val(ui.value + suffix);
			$(this).siblings('label').text(ui.value + suffix);
		},
		create: function( event, ui ) {
			$(this).slider('value', parseInt($(this).siblings('input').val()));
			$(this).slider('option', 'max', $(this).data('max'));
			$(this).slider('option', 'min', $(this).data('min'));
		}
	});

	// sidebar
	$('.mpcth-of-section-sidebar .mpcth-of-controls > div').on('click', function() {
		$(this).prev().click();
	});

	// select
	$('select.of-input[data-fun=hide]').change(function() {
		var $this = $(this),
			show_class = $this.children(':checked').attr('class'),
			select_parent = $this.parents('.mpcth-of-section:not(.show-anyway)');

		select_parent.siblings('.mpcth-of-section:not(.show-anyway)').slideUp();
		select_parent.siblings('.' + show_class).slideDown();
	});
	$('select.of-input[data-fun=hide]').trigger('change');

	// select
	$('select.of-input[data-fun=swap]').change(function() {
		var $this = $(this),
			show_class = '.' + $this.children(':checked').attr('class'),
			select_parent = $this.parents('.mpcth-of-section:not(.show-anyway)');

		var classes = '';
		$this.children().each(function(i) {
			classes += '.' + $(this).attr('class') + (i == 0 ? ', ' : '');
		});

		select_parent.siblings('.mpcth-of-section').filter(classes).not(show_class).slideUp();
		select_parent.siblings(show_class).slideDown();
	});
	$('select.of-input[data-fun=swap]').trigger('change');

	// checkbox
	$('input.of-input[data-fun=hide]').change(function() {
		var $this = $(this),
			show_class = $this.attr('data-hide-class');

		if($this.attr('checked') == 'checked') {
			$this.parents('.mpcth-of-section:not(.show-anyway)').siblings('.' + show_class).slideDown();
		} else {
			$this.parents('.mpcth-of-section:not(.show-anyway)').siblings('.' + show_class).slideUp();
		}
	});
	$('input.of-input[data-fun=hide]').trigger('change');

	$('input.of-input[data-fun=toggle]').change(function() {
		var $this = $(this),
			on_class = $this.attr('data-toggle-on'),
			off_class = $this.attr('data-toggle-off');

		if($this.attr('checked') == 'checked') {
			$this.parents('.mpcth-of-section:not(.show-anyway)').siblings('.' + on_class).slideDown();
			$this.parents('.mpcth-of-section:not(.show-anyway)').siblings('.' + off_class).slideUp();
		} else {
			$this.parents('.mpcth-of-section:not(.show-anyway)').siblings('.' + off_class).slideDown();
			$this.parents('.mpcth-of-section:not(.show-anyway)').siblings('.' + on_class).slideUp();
		}
	});
	$('input.of-input[data-fun=toggle]').trigger('change');

/* ---------------------------------------------------------------- */
/* Socials
/* ---------------------------------------------------------------- */
	var $socialsGrid = $('#section-mpcth_socials');

	$socialsGrid.siblings(':not(.mpcth_no_hide)').hide();
	$socialsGrid.find('input').each(toggleSocial);
	$socialsGrid.on('change', 'input', toggleSocial);

	function toggleSocial() {
		var $this = $(this);

		if($this.is(':checked'))
			$('#section-mpcth_social_' + $(this).attr('data-target')).stop(true, true).slideDown();
		else
			$('#section-mpcth_social_' + $(this).attr('data-target')).slideUp();
	}

/* ---------------------------------------------------------------- */
/* Google Webfonts
/* ---------------------------------------------------------------- */
	var googleFonts = '',
	googleFontsList = [];

	if(mpcthLocalize.googleFonts == false) {
		$.getJSON('https://www.googleapis.com/webfonts/v1/webfonts?callback=?&key=' + mpcthLocalize.googleAPIKey, function(data) {
			if(data.error != undefined) {
				$('#mpcth_menu_font').after('<div class="mpcth-of-error">' + mpcthLocalize.googleAPIErrorMsg + '</div>');
			} else {
				var googleFontsData = { items: [] };

				for(var i = 0; i < data.items.length; i++) {
					googleFontsData.items[i] = {};
					googleFontsData.items[i].family = data.items[i].family;
					googleFontsData.items[i].variants = data.items[i].variants;
					// googleFontsData.items[i].subsets = data.items[i].subsets;
				}

				// $.post(ajaxurl, {
				// 	action: 'mpcth_cache_google_webfonts',
				// 	google_webfonts: encodeURI(JSON.stringify(googleFontsData))
				// }, function(response) {
				// 	console.log(response, "response");
				// });

				jQuery.ajax({
					type: 'POST',
					url: ajaxurl,
					action: 'mpcth_cache_google_webfonts',
					google_webfonts: JSON.stringify(googleFontsData),
					dataType: 'json'
				});

				addGoogleFonts(data);
			}

			fontSelectInit();
		})
	} else {
		addGoogleFonts(JSON.parse(mpcthLocalize.googleFonts));

		fontSelectInit();
	}

	function addGoogleFonts(data) {
		if(data.items != undefined) {
			var fontsCount = data.items.length;
			googleFontsList = data.items;

			googleFonts = '';
			for(var i = 0; i < fontsCount; i++) {
				var family = googleFontsList[i].family;

				googleFonts += '<option class="mpcth-option-google" data-index="' + i + '" value="' + family + '">' + family + '</option>';
			}
		}
	}

	function fontSelectInit(argument) {
		$('.of-input-font').each(function() {
			var $this = $(this);

			$this
				.data('fontType', $this.siblings('.of-input-font-type'))
				.data('fontWeight', $this.siblings('.of-input-font-weight'))
				.data('fontStyle', $this.siblings('.of-input-font-style'))
				.data('radioContainer', $this.siblings('.of-variants'))
				.data('section', $this.data('radioContainer').parents('.mpcth-of-section').attr('id').replace('section-', ''))
				.append(googleFonts)
				.on('change', fontSelectChange);

			$this.siblings('.of-variants').on('click', 'input', fontRadioChange);

			var $selectedFont = $this.siblings('.mpcth-of-selected-font'),
				type = $selectedFont.data('type');

			if(type != 'default') {
				var $finded = $this.find('option[value="' + $selectedFont.data('family') + '"]');

				if($finded.length != 0) {
					$finded.attr('selected', true);
					$this.trigger('change', [$selectedFont.data('style')]);
				}
			}
		})
	}

	function fontRadioChange(e) {
		var $this = $(this),
			$select = $this.parents('.of-variants').siblings('.of-input-font'),
			$fontType = $select.data('fontType'),
			$fontWeight = $select.data('fontWeight'),
			$fontStyle = $select.data('fontStyle'),
			variant = $this.val();

		if($fontType.val() == 'google') {
			if(variant == 'italic' || variant.indexOf('italic') != -1) {
				variant = variant.replace('italic', '');
				$fontStyle.val('italic');
			} else {
				$fontStyle.val('');
			}

			if(variant != '')
				weight = 'font-weight: ' + variant + '; ';

			$fontWeight.val(variant);
		} else {
			$fontStyle.val('');
			$fontWeight.val('');
		}
	}

	function fontSelectChange(e, defaultStyle) {
		defaultStyle = typeof defaultStyle !== 'undefined' ? defaultStyle : 'regular';

		var $this = $(this),
			$selected = $this.find(':selected'),
			index = $selected.data('index'),
			variants = googleFontsList[index] != undefined ? googleFontsList[index].variants : ['default'],
			fontStyles = '';

		var $fontType = $this.data('fontType'),
			$fontWeight = $this.data('fontWeight'),
			$fontStyle = $this.data('fontStyle'),
			$radioContainer = $this.data('radioContainer'),
			section = $this.data('section');

		if($selected.hasClass('mpcth-option-default')) {
			$fontType.val('default');

			$radioContainer.fadeOut(function() {
				fontStyles = createFontStyles(fontStyles, section, variants[0]);

				updateFontStyles($this, fontStyles);
			});

		} else if($selected.hasClass('mpcth-option-google')) {
			$fontType.val('google');

			$radioContainer.fadeOut(function() {
				for(var i = 0; i < variants.length; i++) {
					var variant = variants[i],
						style = '',
						weight = '',
						styleMarkup = '';

					if(variant == 'italic' || variant.indexOf('italic') != -1) {
						style = 'font-style: italic; ';
						variant = variant.replace('italic', '');
					}

					if(variant != '')
						weight = 'font-weight: ' + variant + '; ';

					styleMarkup += '<style type="text/css">';
						styleMarkup += '#section-' + section + ' .mpcth-of-variants-preview-' + i + ' { ';
						styleMarkup += 'font-family: "' + $selected.val() + '" !important; ';
						styleMarkup += style;
						styleMarkup += weight;
						styleMarkup += ' }';
					styleMarkup += '</style>';

					fontStyles = createFontStyles(fontStyles, section, variants[i], i, styleMarkup);
				}

				var source = $selected.val() + ":" + variants.join();

				WebFont.load({
					google: {
						families: [source]
					},
					active: function() {
						updateFontStyles($this, fontStyles, '', defaultStyle);
					}
				});
			})
		}
	}

	function createFontStyles(fontStyles, section, variant, index, style) {
		index = typeof index !== 'undefined' ? index : 0;
		style = typeof style !== 'undefined' ? style : '';

		fontStyles += '<div>';
			fontStyles += style;
			fontStyles += '<label class="mpcth-of-variant-label" for="' + mpcthLocalize.optionsName + '-' + section + '-' + variant + '">' + variant + '</label>';
			fontStyles += '<input class="of-input of-radio" type="radio" name="' + mpcthLocalize.optionsName + '[' + section + '][style]" id="' + mpcthLocalize.optionsName + '-' + section + '-' + variant + '" value="' + variant + '">';
			fontStyles += '<label for="' + mpcthLocalize.optionsName + '-' + section + '-' + variant + '"></label>';
			fontStyles += '<label class="mpcth-of-variants-preview mpcth-of-variants-preview-' + index + '" for="' + mpcthLocalize.optionsName + '-' + section + '-' + variant + '">' + mpcthLocalize.sampleText + '</label>';
			fontStyles += '<div class="mpcth-of-variants-clear"></div>';
		fontStyles += '</div>';

		return fontStyles;
	}

	function updateFontStyles($this, markup, script, style) {
		script = typeof script !== 'undefined' ? script : '';

		var $radioContainer = $this.data('radioContainer');

		$radioContainer
			.html('')
			.append(script, markup)
			.stop(true, true)
			.fadeIn();

		var $def = $radioContainer.find('.of-radio[value=' + style + ']');
		$def = $def.length != 0 ? $def : $radioContainer.find('.of-radio').first();
		$def.click();
	}

/* ---------------------------------------------------------------- */
/* Theme skin colors
/* ---------------------------------------------------------------- */
	var $theme_skin = $('#mpcth_theme_skin'),
		$theme_color = $('#mpcth_color_main');

	var colors = {
			'default': '#b363a0',
			'skin_gray': '#41b58e',
			'skin_gold': '#b59564',
			'skin_dark': '#e55555'
		};

	$theme_skin.on('change', function() {
		if (colors[$theme_skin.val()] != 'undefined')
			$theme_color.iris('color', colors[$theme_skin.val()]);
	});

/* ---------------------------------------------------------------- */
/* AJAX Save
/* ---------------------------------------------------------------- */
	var $themePanel = $('#mpcth_theme_panel'),
		$updateMessage = $('#mpcth_update_msg'),
		$submitButton = $themePanel.find('input.button-primary'),
		$resetButton = $themePanel.find('input.button-secondary'),
		$ajaxIndicator = $themePanel.find('.ajax-indicator'),
		$ajaxMessage = $themePanel.find('.ajax-message');

	$themePanel.on('click', function (e) {
		$themePanel.data('submit-target', $(e.target));
	});

	$themePanel.on('submit', function(e) {
		$submitButton.attr('disabled', 'disabled');
		$resetButton.attr('disabled', 'disabled');
		$ajaxIndicator.stop(true, true).fadeIn(250);

		if ($themePanel.data('submit-target')[0] == $submitButton[0]) {
			$.post(ajaxurl, {
					data: $themePanel.serialize(),
					action: 'mpcth_save_panel_options'
				}, function(response) {
					$submitButton.removeAttr('disabled');
					$resetButton.removeAttr('disabled');
					$ajaxIndicator.fadeOut(250);

					$ajaxMessage.children('.ajax-label').hide();

					if(response == 1)
						$ajaxMessage.children('.ajax-options').show();
					else if (response == 2)
						$ajaxMessage.children('.ajax-styles').show();
					else if (response == 3) {
						$ajaxMessage.children('.ajax-saved').show();

						$updateMessage.slideUp();
					} else
						$ajaxMessage.children('.ajax-error').show();

					$ajaxMessage.delay(250).fadeIn().delay(2000).fadeOut();
				}
			);

			e.preventDefault();
		} else {
			$themePanel.prepend('<input type="hidden" name="reset" value="true" />');
		}
	});

/* ---------------------------------------------------------------- */
/* AJAX Export
/* ---------------------------------------------------------------- */
	var $exportButton = $('#export_settings_button');

	$exportButton.on('click', function(e) {
		var urlAjaxExport = ajaxurl + '?action=mpcth_export_settings';
		location.href = urlAjaxExport;

		e.preventDefault();
	});

/* ---------------------------------------------------------------- */
/* AJAX Import
/* ---------------------------------------------------------------- */
	$('#mpcth_panel_url').val(location.href);

	var $importButton = $('#import_settings_button'),
		$importFile = $('#import_settings_file');

	$importFile.on('change', function() {
		if ($importFile.val() != '')
			$importButton.removeAttr('disabled');
		else
			$importButton.attr('disabled', 'disabled');
	});
});
