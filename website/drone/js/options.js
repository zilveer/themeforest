/**
 * @package    WordPress
 * @subpackage Drone
 * @since      2.0
 */

// -----------------------------------------------------------------------------

RegExp.escape = function(s) {
	return String(s).replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
};

// -----------------------------------------------------------------------------

var droneOptions;

// -----------------------------------------------------------------------------

(function($) {
	
	'use strict';
	
	// Drone Options
	droneOptions = {
			
		// ---------------------------------------------------------------------
			
		fontWebSafeOptions:        '',
		fontGoogleFontsOptions:    '',
		fontCustomFontfaceOptions: '',
		
		// ---------------------------------------------------------------------

		guid: function() {		
			return (
				Math.round(Math.random()*899+100).toString() +
				Math.round(new Date().getTime() / 100).toString()
			) % 2147483648;
		},

		// ---------------------------------------------------------------------
		
		clone: function(prototype, name) {
			var option = prototype.clone();
			var attrs = ['name', 'id', 'for', 'data-drone-owner'];
			for (var i in attrs) {
				$('['+attrs[i]+'*="__n__"]', option).attr(attrs[i], function(index, attr) {
					return attr.replace('__n__', name);
				});
			}
			$('.drone-owner-ready, .drone-ready', option).removeClass('drone-owner-ready').removeClass('drone-ready');
			this.attach(option);
			return option;
		},
			
		// ---------------------------------------------------------------------
			
		init: function() {
			
			// Font option
			if (typeof web_safe != 'undefined') {
				for (var font in web_safe) {
					this.fontWebSafeOptions += '<option value="'+font+'">'+web_safe[font]+'</option>';
				}
			}
			if (typeof google_fonts != 'undefined') {
				for (var font in google_fonts) {
					this.fontGoogleFontsOptions += '<option value="'+google_fonts[font]+'">'+google_fonts[font]+'</option>';
				}
			}
			if (typeof custom_fontface != 'undefined') {
				for (var font in custom_fontface) {
					this.fontCustomFontfaceOptions += '<option value="'+font+'">'+custom_fontface[font]+'</option>';
				}
			}

			// Submit button
			var submit = $('.drone-theme-options .submit');
			if (submit.length > 0) {
				var on_scroll = function() {
					var scroll_top = $(this).scrollTop();
					if (scroll_top === null) scroll_top = 0;
					submit.toggleClass('fixed', submit.offset().top+submit.height()+20 > scroll_top+$(this).height());
				};
				$(window).scroll(on_scroll).resize(on_scroll).load(on_scroll);
				$('#submit', submit).prop('disabled', false);
			}
	
			return this;
			
		},
			
		// ---------------------------------------------------------------------
			
		attach: function(options) {
			
			// todo: zasadniczo mozna cale divy opcji oznaczac jako .ready
				
			// Option owner
			$('[data-drone-owner]:not(.drone-owner-ready)', options).addClass('drone-owner-ready').each(function() {

				var _this = this;

				$('[id][name="'+$(this).data('drone-owner')+'"]', options)
					.change(function() {
						var val;
						if ($(this).is('[type="checkbox"]')) {
							val = $(this).prop('checked');
						} else if ($(this).is('[type="radio"]')) {
							val = $(this).filter(':checked').val();
						} else {
							val = $(this).val();
						}
						if (typeof val != 'undefined') {
							$(_this).closest('.drone-row').toggleClass('drone-hidden',
								$(this).closest('.drone-row').hasClass('drone-hidden') || $(_this).data('drone-owner-value').indexOf(val) == -1
							);
							$('[id][name]', _this).change(); // todo: spr czy potrzeba?
						}
					})
					.change();
				
				$('[id][name="'+$(this).data('drone-owner')+'[]"]', options)
					.change(function() {
						var val = $(this).closest('fieldset').find('[name="'+$(this).attr('name')+'"]:checked').map(function() {
							return this.value;
						}).get();
						$(_this).closest('.drone-row').toggleClass('drone-hidden',
							$(this).closest('.drone-row').hasClass('drone-hidden') || $(_this).data('drone-owner-value').filter(function(n) { return val.indexOf(n) != -1; }).length == 0
						);
						$('[id][name]', _this).change();
					})
					.change();

			});
			
			// Code option
			$('.drone-option-code:not(.drone-ready)', options).addClass('drone-ready').keydown(function(e) {
				
				var key = e.keyCode || e.which;
			
				if (key == 9) {
					e.preventDefault();
					var textarea = $(this).get(0);
					var start = textarea.selectionStart;
					var end   = textarea.selectionEnd;
					$(this).val($(this).val().substring(0, start) + '\t' + $(this).val().substring(end));
					textarea.selectionStart = textarea.selectionEnd = start + 1;
				}

				return true;
				
			});
		
			// Group option
			$('.drone-option-group.drone-option-group-sortable:not(.drone-ready)', options).addClass('drone-ready').sortable({
				items:                '> label',
				placeholder:          'drone-option-group-placeholder',
				forcePlaceholderSize: true
			});
			
			// Image option
			// https://gist.github.com/mauryaratan/4461148
			$('.drone-option-image:not(.drone-ready)', options).addClass('drone-ready').each(function() {

				var _this = this;
				
				$('.button.select', this).click(function() {
					wp.media.frames.drone_image =
						wp.media({
							 title:    $(_this).data('title'),
							 library:  {type: 'image'},
							 multiple: false
						 })
						 .on('select', function() {
							var attachment = wp.media.frames.drone_image.state().get('selection').first().toJSON();
							$('input', _this).val(attachment.url);
						 })
						 .open();
				});
				
				$('.button.clear', this).click(function() {
					$('input', _this).val('');
				});

			});
			
			// Attachment option
			$('.drone-option-attachment:not(.drone-ready)', options).addClass('drone-ready').each(function() {
				
				var _this = this;
				
				$('.button.select', this).click(function() {
					wp.media.frames.drone_attachment = wp.media({
						title:    $(_this).data('title'),
						library:  {type: $(_this).data('type')},
						multiple: false
					});
					wp.media.frames.drone_attachment
						.on('select', function() {
							var attachment = wp.media.frames.drone_attachment.state().get('selection').first().toJSON();
							$('input', _this).val(attachment.id);
							$('span', _this).html('<code>'+attachment.mime+'</code> '+attachment.title);
						})
						.on('open', function() {
							if ($('input', _this).val() == '0') {
								return;
							}
							var selection = wp.media.frames.drone_attachment.state().get('selection');
							var attachment = wp.media.attachment(parseInt($('input', _this).val()));
							attachment.fetch();
							selection.add(attachment ? [attachment] : []);
						})
						.open();
				});
				
				$('.button.clear', this).click(function() {
					$('input', _this).val('0');
					$('span', _this).html('&nbsp;');
				});

			});
			
			// Image Select option
			$('.drone-option-image-select:not(.drone-ready)', options).addClass('drone-ready').each(function() {
				
				var _options = options;
				var _this    = this;
				
				var input   = $('input', this);
				var current = $('.current', this);
				var options = $('.options', this);
				
				function setValue($value) {
					if (typeof $value != 'undefined') {
						input.val($value);
					}
					current
						.attr('data-value', input.val())
						.html(options.find('[data-value="'+input.val()+'"]').html());
				}

				setValue();
					
				current.click(function(e) {
					$('.drone-option-image-select', _options).filter(function() { return this != _this; }).each(function() {
						$('.current', this).removeClass('focus');
						$('.options', this).hide();
					});
					var a = $('a[data-value="'+input.val()+'"]', options).addClass('selected');
					a.siblings().removeClass('selected');
					$(this).addClass('focus');
					options.toggle();
					if (options.is(':visible')) {
						options.scrollTop(options.scrollTop() + a.position().top - 4);
					}	
					e.stopPropagation();
					return false;
				});
				
				options
					.click(function(e) { e.stopPropagation(); })
					.mousemove(function(e) { e.stopPropagation(); })		
					.find('a')
						.click(function() {
							setValue($(this).attr('data-value'));
							options.hide();
							return false;
						});
			
				$(document).click(function() {
					current.removeClass('focus');
					options.hide();
				});
				
			});
			
			// Post option
			$('.drone-option-post:not(.drone-ready)', options).addClass('drone-ready').each(function() {
				
				var a = $('a', this);
				
				$('select', this).change(function() {
					var val = $(this).val();
					a.attr('href', val > 0 ? a.data('admin-url').replace('%id%', val) : '');
				});
				
			});
			
			// Color option
			$('.drone-option-color:not(.drone-ready)', options).addClass('drone-ready').each(function() {
				new jscolor.color($(this).get(0), $(this).data('settings'));
			});

			// Collection option
			$('.drone-option-collection:not(.drone-ready)', options).addClass('drone-ready').each(function() {
				
				var _this = this;
				
				if ($(this).is('[data-sortable="true"]')) {
					$('> ol', this).sortable({
						axis:        'y',
						placeholder: 'placeholder',
						start:        function(event, ui) {
							ui.placeholder.css('height', ui.item.innerHeight());
						}
					});
				}
				
				$('> .controls .add', this).click(function() {
					var name;
					do {
						name = $(_this).data('index-prefix')+droneOptions.guid();
					} while ($('> .items > li > div [name*="['+name+']"]', _this).length > 0);
					var option = droneOptions.clone($('> .prototype', _this), name).children();
					$('<li />').append(option).appendTo($('> .items', _this));
				});

				$('> .items', this).on('click', '> li > .delete', function() {
					$(this).parent().remove();
				});
				
			});
			
			// Conditional tags option
			$('.drone-option-conditional-tags:not(.drone-ready)', options).addClass('drone-ready').each(function() {

				var _this = this;

				$('> .conditions', this).on('click', '> li > label', function() {
					if (!$(this).is(':has(span:visible)')) {
						return;
					}
					$('span', this).hide().next('select').show();
					$(this).parent().find('> .delete').hide();
				});
				
				$('> .conditions', this).on('blur', '> li > label select', function() {
					if (!$(this).is(':visible:has(:selected[value!=""])')) {
						return;
					}
					var val = $(this).val();
					var reg = new RegExp(RegExp.escape($(_this).data('name'))+'\\[[^\\]]*\\]');
					var selected = $(':selected', this);
					$(this).parent().parent().find('> div [name]').attr('name', function() {
						return $(this).attr('name').replace(reg, $(_this).data('name')+'['+val+']');
					});
					$(this).hide().prev('span').text(selected.text()).attr('title', selected.parent().attr('label')).show();
					$(this).parent().parent().find('> .delete').show();
				});
				
				$('> .conditions', this).on('click', '> li > .delete', function() {
					$(this).parent().remove();
				});
				
				$('> .controls .customize', this).click(function() {
					var option = droneOptions.clone($('> .prototype', _this), '__'+droneOptions.guid()).children();
					$('<li />').append(option).appendTo($('> .conditions', _this));
				});
				
			});
			
			// Font option
			$('.drone-option-font:not(.drone-ready)', options).addClass('drone-ready').each(function() {
				$('[name$="[family]"]', this).each(function() {
					$('optgroup[data-type="web_safe"]', this).html(droneOptions.fontWebSafeOptions);
					$('optgroup[data-type="google_fonts"]', this).html(droneOptions.fontGoogleFontsOptions);
					$('optgroup[data-type="custom_fontface"]', this).html(droneOptions.fontCustomFontfaceOptions);
					$(this).val($(this).data('value'));
				});
			});
			
			// Event
			$('body').trigger('drone_options_attach', [options]);

			return this;
			
		}
			
	};
	
	// jQuery
	$(document).ready(function($) {
		
		droneOptions.init();
		droneOptions.attach($('.drone-theme-options, .drone-post-options, #widgets-right .drone-widget-options'));
		
		var widgets_attach = function() { droneOptions.attach($('#widgets-right .drone-widget-options')); };
		$(document).ajaxComplete(widgets_attach);
		$('#widget-list').children('.widget').on('dragstop', widgets_attach);

	});
	
})(jQuery);