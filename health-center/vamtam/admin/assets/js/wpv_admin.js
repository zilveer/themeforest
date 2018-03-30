(function($, undefined) {
	"use strict";

	$.WPV = $.WPV || {};

	$(function() {
		$('body').wpvColorPicker().wpvIconsSelector().wpvBackgroundOption();
		$('.wpv-range-input').uirange();

		skin_management.init();
		$.WPV.horizontal_blocks.init();
		$.WPV.upload.init();

		$(document).on('change select', '[data-field-filter]', function() {
			var prefix = $(this).attr('data-field-filter');
			var selected = $(':checked', this).val();

			var others = $(this).closest('.wpv-config-group').find('.' + prefix).filter(':not(.hidden)');
			others.show().filter(':not(.' + prefix + '-' + selected + ')').hide();
		});

		$('[data-field-filter]').change();

		$('body').on('click', '.vamtam-check-license', function(e) {
			var self = $(this);

			if ( self.hasClass('disabled' ) ) return;

			self.siblings().remove();

			self.css('display', 'inline-block').addClass('disabled');
			self.after('<span class="spinner" style="display:inline-block;float:none" />');

			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'wpv-check-license',
					'license-key': $('#envato-license-key').val(),
					nonce: $(this).attr('data-nonce')
				},
				success: function(data) {
					self.removeClass('disabled').siblings().remove();
					self.after( $('<p />').addClass('vamtam-check-license-help').append('<hr />').append( self.data('full-info') ) );
					self.after( $('<p />').addClass('vamtam-check-license-response').append('<hr />').append(data) );
				}
			});

			e.preventDefault();
		});

		$('body').on('click', '.wpv-icon-selector-trigger', function(e) {
			var selector = $('#wpwrap > .wpv-config-icons-selector'),
				self = $(this);

			$.magnificPopup.open({
				type: 'inline',
				items: {
					src: selector
				},
				closeOnBgClick: false,
				callbacks: {
					open: function() {
						selector.show();
					},
					close: function() {
						selector.hide();
					}
				}
			});

			selector.find('[value="'+$(this).data('icon-name')+'"]').prop('checked', true).change();

			selector.parent().wpvIconsSelector('scroll');

			selector.find(':radio').bind('change.wpv-icons-selector', function() {
				var checked = selector.find(':checked'),
					checked_icon = checked.val();

				$.magnificPopup.close();

				self.data('icon-name', checked_icon);

				var container = self.find('+ input');
				if(container) {
					container.val(checked_icon);
				}

				self.html(checked.next().find('span').html());

				self.removeClass('theme no-icon');

				if(checked_icon.match(/^theme-/)) {
					self.addClass('theme');
				} else if (checked_icon.match(/^\s*$/)) {
					self.addClass('no-icon').html('');
				}

				selector.find(':radio').unbind('change.wpv-icons-selector');

				try {
					$.WPVED.saveHTML();
				} catch(e) {}
			});


			e.preventDefault();
		});

		$(document).on('change', '.social_icon_select_sites', function() {
			var wrap = $(this).closest('p').siblings('.social_icon_wrap');
			wrap.children('p').hide();
			$('option:selected', this).each(function() {
				wrap.find('.social_icon_' + $(this).val()).show();
			});
		});

		$(document).on('change', '.num_shown', function() {
			var wrap = $(this).closest('p').siblings('.hidden_wrap');
			wrap.children('div').hide();
			$('.hidden_el:lt(' + $(this).val() + ')', wrap).show();
		});

		$('.metabox').each(function() {
			var meta_tabs = $('<ul>').addClass('wpv-meta-tabs');

			$('.config-separator:first', this).before(meta_tabs);
			$('.config-separator', this).each(function() {
				var id = $(this).text().replace(/[\s\n]+/g, '').toLowerCase();
				$(this).nextUntil('.config-separator').wrapAll('<div class="wpv-meta-part" id="tab-' + id + '"></div>');
				$(this).css('cursor', 'pointer');
				if ($(this).next().is('.wpv-meta-part')) {
					meta_tabs.append('<li class="wpv-meta-tab '+$(this).attr('data-tab-class')+'"><a href="#tab-' + id + '" title="">' + $(this).text() + '</a></li>');
				}
				$(this).remove();
			});

			if(meta_tabs.children().length > 1) {
				meta_tabs.closest('.metabox').tabs();
			} else {
				meta_tabs.hide();
			}
		});

		$('#wpv-config').tabs({
			activate: function(event, ui) {
				var hash = ui.newTab.context.hash;
				var element = $(hash);
				element.attr('id', '');
				window.location.hash = hash;
				element.attr('id', hash.replace('#', ''));

				$('.save-wpv-config').show();
				if (ui.newTab.hasClass('nosave')) $('.save-wpv-config').hide();
			},
			create: function(event, ui) {
				if (ui.tab.hasClass('nosave')) $('.save-wpv-config').hide();
			}
		});

		$('body').on('click', '.info-wrapper > a', function(e) {
			var other = $(this).attr('data-other');
			$(this).attr('data-other', $(this).text()).text(other);
			$(this).siblings('.desc').slideToggle(200);
			e.preventDefault();
		});

		$('body').on('click', '.wpv-autofill', function() {
			$(this).addClass('selected').siblings().removeClass('selected');

			var fields = $.parseJSON($(this).attr('data-fields'));
			var group = $(this).closest('.wpv-config-group');

			for(var i in fields) {
				var field = group.find('[name="' + i + '"]');

				if (field.is(':checkbox')) {
					if (fields[i] === 1) {
						field.attr('checked', 'checked');
					} else {
						field.attr('checked', false);
					}
				} else {
					field.val(fields[i]);
					if (field.is('.image-upload')) {
						$.WPV.upload.fill(field.attr('id'), fields[i]);
					}
				}

				field.change();
			}

			return false;
		});

		function autofill_test(autofill) {
			var fields = $.parseJSON($(autofill).attr('data-fields'));

			var selected = true;

			for(var i in fields) {
				var field = $('[name="' + i + '"]');

				if (field.is(':checkbox')) {
					var new_val = !!(fields[i]),
						curr_val = field.is(':checked');
					if(new_val !== curr_val) {
						selected = false;
						break;
					}
				} else if ( !(field.val()) || !(fields[i]) || field.val().toString() !== fields[i].toString()) {
					selected = false;
					break;
				}
			}

			if (selected) {
				$(autofill).addClass('selected');
			}
		}

		$('.wpv-autofill').each(function() {
			autofill_test(this);
			var autofill = this;

			var fields = $.parseJSON($(autofill).attr('data-fields'));

			var doAutofill = function() {
				$(autofill).removeClass('selected');
				autofill_test(autofill);
			};

			for(var i in fields) {
				$('#' + i).change(doAutofill);
			}
		});

		$('.wpv-config-row.body-layout label').click(function() {
			$(this).addClass('selected');
			$(this).parent().siblings().find('label').removeClass('selected');
		});
		$('.wpv-config-row.body-layout input').change(function() {
			if ($(this).is(':checked')) {
				$('label[for="' + $(this).attr('id') + '"]').click();
			}
		});

		// images in label ie fix
		$(document).on('click', 'label img', function() {
			$('#' + $(this).parents('label').attr('for')).click();
		});

		function updateFontProps(input) {
			var container = $(input).closest(".wpv-config-row.font");
			var preview = container.find('.font-preview');

			var loadFont = function() {
				var link = document.createElement('LINK');
				link.rel = "stylesheet";
				link.type = "text/css";
				container.find('.font-styles').html("")[0].appendChild(link);
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'wpv-font-preview',
						face: container.find('.face').val(),
						weight: container.find('.weight').val()
					},
					//async : false,
					success: function(data) {
						link.href = data;
						preview.css({
							'font': font,
							'color': container.find('.wpv-color-input').val()
						});
					}
				});
			};

			if ($(input).is('.wpv-color-input')) {
				preview.css('color', container.find('.wpv-color-input').val());
			} else {
				var font = container.find('.weight').val() + ' ' + container.find('.size').val() + 'px/' + container.find('.lheight').val() + 'px ' + '"' + container.find('.face').val() + '"';

				if( $(input).hasClass('face') ) {
					var weight = container.find('.weight');
					var prevWeight = weight.val();

					weight.empty();
					$(WPV_ADMIN.fonts[$(input).val()].weights).each(function(i, opt) {
						weight.append('<option>'+opt+'</option>');
					});

					weight.val(prevWeight);

					loadFont();
				} else if( $(input).hasClass('weight') ) {
					loadFont();
				} else {
					preview.css({
						'font': font,
						'color': container.find('.wpv-color-input').val()
					});
				}
			}
		}

		$('.wpv-config-row.font input, .wpv-config-row.font select').bind("change", function() {
			updateFontProps(this);
		});

		setTimeout(function() {
			$(".wpv-config-row.font").each(function() {
				updateFontProps($(".face", this)[0]);
			});
		}, 0);

		$('#wpv-ajax-overlay, #wpv-ajax-content').remove();

		$('.wpv-config-page form').submit(function() {

			$('body').append('<div id="wpv-ajax-overlay"></div><div id="wpv-ajax-content">Saving</div>');

			$.post(ajaxurl, $(this).serialize(), function(data) {
				$('#wpv-ajax-content').html(data);

				setTimeout(function() {
					$('#wpv-ajax-overlay, #wpv-ajax-content').fadeOut(300, function() {
						$('#wpv-ajax-overlay, #wpv-ajax-content').remove();
					});
				}, 1000);
			});

			return false;
		});
	});

	var wpv_fill_settings = function(data) {
		for(var i in data) {
			var fixbr = ((typeof data[i]) === 'object') ? '[]' : ''; // if a the data is a object, we probably have to deal with an array
			var el = $('[name="' + i + fixbr + '"]');

			if (!(el.is('.static'))) {
				if (el.is(':radio')) {
					el.filter('[value="' + data[i] + '"]').attr('checked', true).change();
				} else if (el.is(':checkbox')) {
					if (data[i] === 1) {
						el.attr('checked', true);
					} else {
						el.attr('checked', false);
					}
				} else {
					el.val(data[i]).change();

					if (el.is('[type=color]')) {
						el.trigger('keyup');
					}
				}

				if (el.is('.image-upload')) {
					$.WPV.upload.fill(el.attr('id'), data[i]);
				}
			}
		}
	};

	var skin_management = {
		init: function() {
			$('#export-config').click(function() {
				var name = $('#export-config-name').val().replace(/^\s+/, '').replace(/\s+$/, '');

				if (name.length) skin_management.save($('#export-config-prefix').val() + '_' + name);
			}).parent().append('<span class="result"></span>');

			$('#import-config').click(function() {
				if (window.confirm("Are you sure you want to import a skin? You will lose any changes you've made since you last exported a skin.")) skin_management.load($('#import-config-available').val());
			}).parent().append('<span class="result"></span>');

			$('#delete-config').click(function() {
				if (!$('#import-config-available').val().match(/^\s+$/) && window.confirm("Are you sure you want to delete this? It's permanent")) {
					skin_management.del($('#export-config-prefix').val() + '_' + $('#import-config-available :selected').text());
				}
			});

			this.get_available();
		},

		save: function(name) {
			if (!name.match(/^\s*$/)) {
				var spinner = $('#export-config').closest('.wpv-config-row').find('.spinner').css({
					display: 'inline-block'
				});

				$.post(ajaxurl, {
					action: 'wpv-save-skin',
					file: name
				}, function(result) {
					skin_management.get_available();

					spinner.hide();
					$('#export-config').parent().find('.result').html(result);
					setTimeout(function() {
						$('#export-config').parent().find('.result').fadeOut('fast', function() {
							$(this).html('').show();
						});
					}, 5000);
				});
			}
		},

		get_available: function() {
			$.post(ajaxurl, {
				action: 'wpv-available-skins',
				prefix: $('#export-config-prefix').val()
			}, function(data) {
				$('#import-config-available').html(data);
			});
		},

		del: function(name) {
			var spinner = $('#import-config').closest('.wpv-config-row').find('.spinner').css({
				display: 'inline-block'
			});

			$.post(ajaxurl, {
				action: 'wpv-delete-skin',
				file: name
			}, function(result) {
				skin_management.get_available();

				spinner.hide();
				$('#import-config').parent().find('.result').html(result);
				setTimeout(function() {
					$('#import-config').parent().find('.result').fadeOut('fast', function() {
						$(this).html('').show();
					});
				}, 3000);
			});
		},

		load: function(file) {
			var spinner = $('#import-config').closest('.wpv-config-row').find('.spinner').css({
				display: 'inline-block'
			});

			$.post(ajaxurl, {
				action: 'wpv-load-skin',
				file: file,
				name: $('#import-config-available :selected').text()
			}, function(result) {
				wpv_fill_settings(result.data);

				spinner.hide();
				$('#import-config').parent().find('.result').html(result.text);
				setTimeout(function() {
					$('#import-config').parent().find('.result').fadeOut('fast', function() {
						$(this).html('').show();
					});
				}, 3000);
			}, 'json');
		}
	};
})(jQuery);