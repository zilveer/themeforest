(function($, undefined) {
	"use strict";

	var picker, selected, fbt;

	var init = function() {

		picker = $('<div id="wpv-colorpicker"></div>').hide();

		$('body').append(picker);
		fbt = $.farbtastic('#wpv-colorpicker');

		picker.append(function() {
			return $('<a class="transparent">transparent</a>').click(function() {
				if (selected) {
					$(selected).val('transparent').css({
						background: 'white'
					});
					picker.fadeOut();
				}
			});
		});
	};

	$.fn.wpvColorPicker = function() {
		var self = this;

		if(!picker)
			init();

		$('[type=color], .wpv-color-input', self).not('.wpv-colorpicker').each(function() {
			$(this).prop('type', 'text').addClass('wpv-colorpicker');
			fbt.linkTo(this);
		}).on('focus', null, function() {
			if (selected) $(selected).removeClass('colorwell-selected');

			var self = this;
			fbt.linkTo(function(color) {
				$(self).val(color).change();
			});

			picker.css({
				position: 'absolute',
				left: $(this).offset().left + $(this).outerWidth(),
				top: $(this).offset().top
			}).fadeIn();
			$(selected = this).addClass('colorwell-selected');
		}).on('blur', null, function() {
			picker.fadeOut();
		}).on('change keyup', null, function() {
			$(this).css({
				'background-color': $(this).val()
			});
		});

		return this;
	};
})(jQuery);
(function($, undefined) {
	"use strict";

	$.ajax({
		type: 'POST',
		url: ajaxurl,
		data: {
			action: 'wpv-get-icon-list'
		},
		success: function(icons) {
			window.VamtamIconsCache = icons;

			$(document).trigger('vamtam-icons-loaded');
		}
	});

	$.fn.wpvIconsSelector = function(atts) {
		var all_icons = $('.wpv-config-icons-selector', this);

		(function() {
			var browser = /MSIE (\d+)/.exec(navigator.userAgent);
			if(browser && browser[1] !== 8) return;

			var refresh = function() {
				all_icons.find(':radio.checked').removeClass('checked');
				all_icons.find(':checked').addClass('checked');
			};

			all_icons.find(':radio').unbind('change.wpvicons').bind('change.wpvicons', refresh);
			refresh();
		})();

		(function() {
			var init = function(self, icons) {
				var initial = self.find(':checked'),
					checked = initial.val(),
					id = initial.prop('name') || (new Date().getTime()).toString(16),
					wrapper = self.find('.icons-wrapper');

				initial.remove();

				var single_icon = function(key, icon) {
					var radio = $('<input type="radio" />').attr('name', id).attr('id', id+key).val(key),
						label = $('<label class="single-icon" />').attr('for', id+key).html(icon);

					if(key === checked)
						radio.attr('checked', 'checked');

					return radio.add(label);
				};

				for(var key in icons) {
					wrapper.append(single_icon(key, icons[key]));
				}

				wrapper.removeClass('spinner');

				self.addClass('icons-loaded')
					.find('.icons-filter').bind('change paste keydown keyup search', function() {
					var search = $(this).val().toLowerCase();
					self.find('label:has(span[title])').show().each(function() {
						if(!$(this).find('span').attr('title').toLowerCase().match(search))
							$(this).hide();
					});
				});

				setTimeout(function() {
					scrollIcons(self);
				}, 100);
			};

			var scrollIcons = function(self) {
				self.each(function() {
					$(this).find('.icons-wrapper').scrollTop(0); // reset the inital position
					$(this).find('.icons-wrapper').scrollTop($(this).find(':checked + label').offset().top - $(this).find('.icons-wrapper').offset().top);
				});
			};

			all_icons.filter(':not(.icons-loaded)').each(function() {
				var self = $(this);

				if(window.VamtamIconsCache) {
					init(self, window.VamtamIconsCache);
				} else {
					$(document).one('vamtam-icons-loaded', function() {
						init(self, window.VamtamIconsCache);
					});
				}
			});

			all_icons.filter('.icons-loaded').each(function() {
				var self = $(this);

				if(typeof atts === 'string') {
					switch(atts) {
						case 'scroll':
							scrollIcons(self);
						break;
					}
				}
			});
		})();

		return this;
	};
})(jQuery);
(function($, undefined) {
	"use strict";
	
	$.fn.wpvBackgroundOption = function() {
		$(this).find('.wpv-config-row.background:not(.wpvbg-loaded)').each(function() {
			var row = $(this).addClass('wpvbg-loaded'),
				size = row.find('.bg-block.bg-size'),
				repeat = row.find('.bg-block.bg-repeat'),
				position = row.find('.bg-block.bg-position');

			size.find('input').bind('change', function() {
				repeat.add(position).show();

				if($(':checked', size).val() === 'cover')
					repeat.add(position).hide();
			}).change();

		});
		return this;
	};
})(jQuery);
(function($, undefined) {
	"use strict";
	
	$(function() {
		var widget_areas = $('.widget-liquid-right');
		widget_areas.append($('#wpv-add-sidebar-ui').html());
		widget_areas.find('.sidebar-vamtam-custom').append(function() {
			return $('<span class="wpv-delete-sidebar"></span>').click(function() {
				if(!confirm('Are you sure you want to delete this widget area?')) return;

				var wrap = $(this).parent(),
					id = wrap.find('.widgets-sortables').attr('id').replace(/-(right|left)$/, '').replace(/^wpv_sidebar-/, ''),
					title = wrap.find('.sidebar-name h3'),
					name = $.trim(title.text()).replace(/ \([^\)]+\)$/, ''),
					spinner = title.find('.spinner');

				spinner.addClass('wpv-active-spinner');

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'wpv-delete-widget-area',
						name: name,
						_wpnonce: widget_areas.find('input[name="wpv-sidebars-nonce"]').val()
					},
					success: function() {
						wrap.parent().find('.sidebar-vamtam-custom:has(#wpv_sidebar-'+id+'-right), .sidebar-vamtam-custom:has(#wpv_sidebar-'+id+'-left)').slideUp();
					}
				});
			});
		});
	});
})(jQuery);
(function($, undefined) {
	'use strict';

	$.WPV = $.WPV || {};

	$.WPV.upload = {
		init: function() {
			var file_frame;

			$(document).on('click', '.wpv-upload-button', function(e) {
				var field_id = $(this).attr('data-target');

				file_frame = wp.media.frames.file_frame = wp.media({
					multiple: false,
					library: {
						type: $(this).hasClass('wpv-video-upload') ? 'video' : 'image'
					}
				});

				file_frame.on( 'select', function() {
					var attachment = file_frame.state().get('selection').first();
					$.WPV.upload.fill(field_id, attachment.attributes.url);
				});

				file_frame.open();
				e.preventDefault();
			});

			$(document).on('click', '.wpv-upload-clear', function(e) {
				$.WPV.upload.remove($(this).attr('data-target'));
				e.preventDefault();
			});

			$(document).on('click', '.wpv-upload-undo', function(e) {
				$.WPV.upload.undo($(this).attr('data-target'));
				e.preventDefault();
			});
		},

		fill: function(id, str) {
			if (/^\s*$/.test(str)) {
				$.WPV.upload.remove(id);
				return;
			}

			var target = $('#' + id);
			target.data('undo', target.val());
			target.val(str);
			target.siblings('.wpv-upload-clear, .wpv-upload-undo').css({
				display: 'inline-block'
			});
			$.WPV.upload.preview(id, str);
		},

		preview: function(id, str) {
			$('#' + id + '_preview').parents('.upload-basic-wrapper').addClass('active');
			$('#' + id + '_preview').find('img').attr('src', str).css({
				display: 'inline-block'
			});
		},

		remove: function(id) {
			var inp = $('#' + id);
			$('#' + id + '_preview').find('img').attr('src', '').hide();
			$('#' + id + '_preview').parents('.upload-basic-wrapper').removeClass('active');
			inp.data('undo', inp.val()).val('')
				.siblings('.wpv-upload-undo').css({
				display: 'inline-block'
			})
				.siblings('.wpv-upload-clear').hide();
		},
		undo: function(id) {
			var inp = $('#' + id);
			this.preview(id, inp.data('undo'));
			inp.val(inp.data('undo'));
			inp.data('undo', '').siblings('.wpv-upload-undo').hide();
			var remove = inp.siblings('.wpv-upload-clear');
			if (inp.val().length === 0 && remove.is(':visible')) {
				remove.hide();
			} else if (inp.val().length > 0 && remove.is(':hidden')) {
				remove.css({
					display: 'inline-block'
				});
			}
		}
	};
})(jQuery);
(function($, undefined) {
	'use strict';

	$.WPV = $.WPV || {};

	$.WPV.icon_manager = {
		init: function() {
			var file_frame,
				selected_zip;

			$(document).on('click', '.vamtam-upload-icon-font', function( e ) {
				file_frame = wp.media.frames.file_frame = wp.media({
					multiple: false,
					library: {
						type: 'application/zip'
					}
				});

				file_frame.on( 'select', function() {
					var attachment = file_frame.state().get('selection').first();
					selected_zip = attachment.id;


					$( '.vamtam-icon-font-setup .step-1 .step-in-progress' ).text( attachment.attributes.filename ).show();
					$( '.vamtam-icon-font-setup .postbox-container.step-2' ).removeClass( 'inactive' );
				});

				file_frame.open();
				e.preventDefault();
			});

			$(document).on('click', '.vamtam-process-icon-font', function( e ) {
				e.preventDefault();

				var self = $(this);

				self.siblings( '.step-in-progress' ).show();

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'wpv-process-icon-font',
						selected: selected_zip,
						_ajax_nonce: $(this).data('nonce')
					},
					dataType: 'json',
					success: function(data) {
						self.siblings( '.step-in-progress' ).hide();

						var result = '';

						if ( 'error' in data ) {
							result = data.error;
						} else {
							for ( var name in data ) {
								result += 'custom-' + name + ': <svg width="32" height="32" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">';

								for( var i = 0; i < data[name].length; i++ ) {
									result += '<path d="' + data[name][i] + '" fill="#666"/>';
								}

								result += '</svg><br>';
							}
						}

						// $( '.vamtam-icon-font-setup .postbox-container' ).addClass( 'inactive' );
						$( '.vamtam-icon-font-setup .postbox-container.step-3' ).removeClass( 'inactive' ).find( '.result-generated' ).html( result ).parent().show();
					}
				});
			});
		},
	};

	$.WPV.icon_manager.init();

})(jQuery);
(function($, undefined) {
	'use strict';

	$.WPV = $.WPV || {};

	$.WPV.horizontal_blocks = {
		init: function() {
			$('.horizontal_blocks .wpv-range-input').change(function() {
				$.WPV.horizontal_blocks.set_active($(this).val(), $(this).attr('id'));
			});

			$('.horizontal_blocks select').change(function() {
				$.WPV.horizontal_blocks.resize($(this).parents('.block').parent(), $(this).val());
			});

			$('.horizontal_blocks [name*="last"]').change(function() {
				var block = $(this).parents('.block').parent();

				if (block.is('.last') !== $(this).is(':checked')) {
					$.WPV.horizontal_blocks.toggle_last(block);
				}
			});
		},
		set_active: function(number, group) {
			$('[rel="' + group + '"]').removeClass('active');
			$('[rel="' + group + '"]:lt(' + number + ')').addClass('active');
		},
		resize: function(block, new_width) {
			block.removeClass(block.attr('data-width')).addClass(new_width).attr('data-width', new_width);
			if (new_width === 'full') {
				block.find('label').hide();
			} else {
				block.find('label').show();
			}
		},
		toggle_last: function(block) {
			if (block.is('.last')) {
				block.removeClass('last').next().remove();
			} else {
				block.addClass('last').after('<div class="clearboth"></div>');
			}
		}
	};
})(jQuery);
(function($, undefined) {
	'use strict';

	if($('#wpv-tmpl-social-link').length === 0) return;

	$.WPV = $.WPV || {};
	$.WPV.Views = $.WPV.Views || {};
	$.WPV.Models = $.WPV.Models || {};
	$.WPV.Collections = $.WPV.Collections || {};

	$.WPV.Models.SocialLink = Backbone.Model.extend({
		defaults: {
			'icon-name': '',
			'icon-text': '',
			'icon-link': ''
		}
	});

	$.WPV.Collections.SocialLinks = Backbone.Collection.extend({
		model: $.WPV.Models.SocialLink
	});

	$.WPV.Views.SocialLinkView = Backbone.View.extend({
		tagName: 'tr',
		template: _.template( $('#wpv-tmpl-social-link').html() ),
		events: {
			'change select': 'save',
			'change input': 'save',
			'keydown input': 'save',
			'click .icon-change': 'changeIcon'
		},
		save: function() {
			var newatts = {};

			for(var i in this.model.attributes) {
				var inp = this.$el.find('[name="'+i+'"]');

				if(inp.length)
					newatts[i] = inp.val();
			}

			this.model.set(newatts);

			this.options.parent.$el.next('textarea.data').val(JSON.stringify(this.model.collection));

			this.render();
		},
		render: function() {
			this.$el.html(this.template( this.model.attributes ));
			for(var i in this.model.attributes) {
				var att = this.model.attributes[i];
				this.$el.find('[name="'+i+'"]').val(att);
			}

			this.$el.find('.icon-preview').html(window.VamtamIconsCache[this.model.attributes['icon-name']]);

			return this;
		},
		changeIcon: function(e) {
			e.preventDefault();

			var table = this.options.parent.$el.addClass('hidden');
			var icons = table.prev('.wpv-config-icons-selector').removeClass('hidden');

			var self = this;

			icons.find('[value="'+this.model.attributes['icon-name']+'"]').prop('checked', true).change();

			icons.parent().wpvIconsSelector('scroll');

			icons.find(':radio').bind('change.wpv-social-links', function() {
				table.removeClass('hidden');
				icons.addClass('hidden');

				self.$el.find('[name="icon-name"]').val(icons.find(':checked').val()).change();

				icons.find(':radio').unbind('change.wpv-social-links');
			});
		}
	});

	$.WPV.Views.SocialLinksView = Backbone.View.extend({
		template: _.template( $('#wpv-tmpl-social-links').html() ),
		events: {
			'click .add-new-icon': 'addNew'
		},
		initialize: function() {
			this.listenTo(this.collection, 'reset', this.render);
			this.listenTo(this.collection, 'add', this.render);
			this.render();
		},
		render: function() {
			this.$el.html(this.template());

			var current = this.$el.find('.current-icons');

			this.collection.each(function(link) {
				var view = new $.WPV.Views.SocialLinkView({
					model: link,
					parent: this
				});
				current.append(view.render().$el);
			}, this);

			return this;
		},
		addNew: function(e) {
			e.preventDefault();
			this.collection.add(new this.collection.model());
		}
	});

	$(document).one('vamtam-icons-loaded', function() {
		$('.wpv-config-row.social-links').each(function() {
			var data = $.parseJSON($('textarea.data', this).val());
			var self = $(this);

			new $.WPV.Views.SocialLinksView({
				el: $('.social-links-builder', self),
				collection: new $.WPV.Collections.SocialLinks(data)
			});
		});
	});

})(jQuery);
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
(function($, undefined) {
	"use strict";
	
	$(function() {
		var groups = [{
			options: '#vamtam-post-format-options',
			select: '#post-formats-select'
		}, {
			options: '#vamtam-portfolio-format-options',
			select: '#vamtam-portfolio-formats-select'
		}];

		_.each(groups, function(group) {
			var post_formats = $(group.options);
			if(post_formats.length) {
				var pf_tabs = post_formats.find('.wpv-meta-tabs').hide(),
					pf_select = $(group.select);

				pf_select.find(':radio').change(function() {
					var checked = pf_select.find(':checked'),
						format_name = checked.prop('id') || 'post-format-'+checked.val(),
						tab = pf_tabs.find('li.wpv-'+ format_name + ' a');

					tab.click();

					pf_tabs.parent().find('.wpv-config-row.wpv-all-formats').appendTo($(tab.attr('href')));
				}).change();

				post_formats.insertBefore($('#postdivrich')).addClass( 'wpv-repositioned' );
			}
		});
	});
})(jQuery);