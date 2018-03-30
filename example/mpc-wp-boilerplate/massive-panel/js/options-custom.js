/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);

	// Color Picker
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
			color: initialColor,
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$(Othis).children('div').css('backgroundColor', '#' + hex);
				$(Othis).next('input').attr('value','#' + hex);
			}
		});
	}); //end color picker

	// Switches option sections
	$('.group').hide();

	var activetab 	= '',
		accor 		= '',
		settings 	= [],
		setting 	= '';


	if (typeof(localStorage) != 'undefined') {
		activetab = localStorage.getItem("activetab");
		accor = localStorage.getItem("activeaccordion");

		$('.mpcth-meta-box').each(function(){
			var $this = $(this);

			settings[$this.attr('id')] = localStorage.getItem($this.attr('id'));
		});

	}

	for(setting in settings) {
		if(settings[setting] != '' && settings[setting] != null) {
			$('#' + setting).find('.mpcth-of .mpcth-of-accordion-heading').removeClass('mpcth-of-ac-open');
			$('#' + setting).find('.mpcth-of .mpcth-of-accordion-heading').eq(settings[setting]/2).addClass('mpcth-of-ac-open');
			$('#' + setting).find('.mpcth-of .mpcth-of-accordion-content').hide().removeClass('mpcth-of-ac-open');
			$('#' + setting).find('.mpcth-of .mpcth-of-accordion-content').eq(settings[setting]/2).show().addClass('mpcth-of-ac-open');
		}
	}

	if (activetab != '' && $(activetab).length ) {
		$(activetab).fadeIn();

		if(accor != '') {
			// close accordions
			$(activetab).find('.mpcth-of-accordion-heading').removeClass('mpcth-of-ac-open');
			$(activetab).find('.mpcth-of-accordion-heading').eq(accor/2).addClass('mpcth-of-ac-open');
			$(activetab).find('.mpcth-of-accordion-content').hide().removeClass('mpcth-of-ac-open');
			$(activetab).find('.mpcth-of-accordion-content').eq(accor/2).show().addClass('mpcth-of-ac-open');

		}
	} else {
		$('.group:first').fadeIn();
	}
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

	if (activetab != '' && $(activetab + '-tab').length ) {
		$(activetab + '-tab').addClass('nav-tab-active');
	} else {
		$('.mpcth-of-nav-tab-wrapper a:first').addClass('nav-tab-active');
	}

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

	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	// slider
	$('.mpcth-of-slider').slider({
		max: 100,
		min: 0,
		step: 1,
		slide: function( event, ui ) {
			$(this).siblings('input').val(ui.value+"px");
			$(this).siblings('label').text(ui.value+"px");
		},
		create: function( event, ui ) {
			$(this).slider('option', 'max', $(this).data('max'));
			$(this).slider('option', 'min', $(this).data('min'));
			$(this).slider('value', parseInt($(this).siblings('input').val()));
		}
	});

	// sidebar
	$('.mpcth-of-section-sidebar .mpcth-of-controls > div').on('click', function() {
		$(this).prev().click()
	});

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

		if (typeof(localStorage) != 'undefined' && $(activetab).length) {
			localStorage.setItem("activeaccordion", $this.index());
		} else {
			localStorage.setItem($this.parents('.mpcth-meta-box').attr('id'), $this.index());
		}

		e.preventDefault();
	});

	$('.mpcth-of-accordion-heading:not(.mpcth-of-ac-open)').next().hide();

	// select
	$('select.of-input[data-hide=hide]').change(function() {
		var $this = $(this),
			show_class = $this.children(':checked').attr('class'),
			select_parent = $this.parents('.mpcth-of-section');

		select_parent.siblings('.mpcth-of-section').slideUp();
		select_parent.siblings('.' + show_class).slideDown();
	});

	$('select.of-input[data-hide=hide]').trigger('change');

	// checkbox
	$('input.of-input[data-hide=hide]').change(function() {
		var $this = $(this),
			show_class = $this.data('class');

		if($this.attr('checked') == 'checked') {
			$this.parents('.mpcth-of-section').siblings('.' + show_class).slideDown();
		} else {
			$this.parents('.mpcth-of-section').siblings('.' + show_class).slideUp();
		}

	});

	$('input.of-input[data-hide=hide]').trigger('change');

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
				}

				$.post(ajaxurl, {
					action: 'cache_google_webfonts',
					google_webfonts: encodeURI(JSON.stringify(googleFontsData))
				}, function(response) {

				});

				addGoogleFonts(data);
			}

			fontSelectInit();
		})
	} else {
		addGoogleFonts(JSON.parse(decodeURI(mpcthLocalize.googleFonts)));

		fontSelectInit();
	}

	function addGoogleFonts(data) {
		if(data.items != undefined) {
			var fontsCount = data.items.length;
			googleFontsList = data.items;

			googleFonts = '<optgroup label="Google Webfonts">';
			for(var i = 0; i < fontsCount; i++) {
				var family = googleFontsList[i].family;

				googleFonts += '<option class="mpcth-option-google" data-index="' + i + '" value="' + family + '">' + family + '</option>';
			}
			googleFonts += '</optgroup>';
		}
	}

	function fontSelectInit(argument) {
		$('.of-input-font').each(function() {
			var $this = $(this);

			$this
				.data('fontType', $this.siblings('.of-input-font-type'))
				.data('fontWeight', $this.siblings('.of-input-font-weight'))
				.data('fontStyle', $this.siblings('.of-input-font-style'))
				.data('fontSource', $this.siblings('.of-input-font-source'))
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
			$fontSource = $this.data('fontSource'),
			$radioContainer = $this.data('radioContainer'),
			section = $this.data('section');

		if($selected.hasClass('mpcth-option-default')) {
			$fontType.val('default');

			$radioContainer.fadeOut(function() {
				fontStyles = createFontStyles(fontStyles, section, variants[0]);

				updateFontStyles($this, fontStyles);
			})

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

		} else if($selected.hasClass('mpcth-option-cufon')) {
			$fontType.val('cufon');
			$fontSource.val($selected.data('source'));

			$radioContainer.fadeOut(function() {
				fontStyles = createFontStyles(fontStyles, section, variants[0]);

				$.ajax($selected.data('source'), {
					complete: function() {
						var script = document.createElement( 'script' );
						script.type = 'text/javascript';
						script.src = $selected.data('source');

						updateFontStyles($this, fontStyles, script, defaultStyle);

						Cufon.replace('#section-' + section + ' .mpcth-of-variants-preview');
					}
				})
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
/* Text Logo Switch
/* ---------------------------------------------------------------- */

	var $textLogoSwitch = $('#mpcth_use_text_logo'),
		$uploadLogo = $('#section-mpcth_logo'),
		$textLogo = $('#section-mpcth_text_logo');

	$textLogoSwitch.on('change', toggleTextLogo);
	toggleTextLogo();

	function toggleTextLogo() {
		if($textLogoSwitch.is(':checked')) {
			$uploadLogo.stop(true, true).slideUp();
			$textLogo.stop(true, true).slideDown();
		} else {
			$uploadLogo.slideDown();
			$textLogo.slideUp();
		}
	}

/* ---------------------------------------------------------------- */
/* Background Select First Pattern
/* ---------------------------------------------------------------- */

var $backgroundType = $('#mpcth_background_type'),
	$pattern = $('#section-mpcth_background_pattern .of-radio-img-img').first();

$backgroundType.on('change', selectFirstPattern);

function selectFirstPattern() {
	if($backgroundType.filter(':checked').val() != 'pattern_background')
		$pattern.click();
}

});