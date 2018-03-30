/* jshint multistr:true */
(function($, undefined) {
	"use strict";

	// see https://github.com/spencertipping/jquery.fix.clone
	$.fn.fixedClone = function() {
		var result = $.fn.clone.apply(this, arguments),
			my_textareas = this.find('textarea').add(this.filter('textarea')),
			result_textareas = result.find('textarea').add(result.filter('textarea')),
			my_selects = this.find('select').add(this.filter('select')),
			result_selects = result.find('select').add(result.filter('select'));

		var i, l;
		for (i = 0, l = my_textareas.length; i < l; ++i) $(result_textareas[i]).val($(my_textareas[i]).val());
		for (i = 0, l = my_selects.length; i < l; ++i) result_selects[i].selectedIndex = my_selects[i].selectedIndex;

		return result;
	};

	$(function() {
		ED.container = $('#wpv_visual_editor');
		ED.savingBlocked = true;

		if (ED.container.length === 1) {
			var editor_button = $('<a class="wpv-editor-toggle wp-switch-editor">Vamtam</a>');

			$('#content-html').before(editor_button);

			var postdivrich = $('#wp-content-editor-container, #post-status-info, #wp-content-media-buttons');

			var wp_ed_state = '';
			var wp_content_wrap = $("#wp-content-wrap");

			ED.container.html(ED.container.find('> .inside').html()).insertAfter('#wp-content-editor-container');

			ED.content = $('#visual_editor_content');
			ED.content.find('a').click(function(e) {
				e.preventDefault();
			});

			ED.isVisible = false;
			editor_button.click(function() {
				if (wp_content_wrap.is('.html-active')) switchEditors.go('content', 'tmce');

				switchEditors.go('content', 'html');

				wp_ed_state = wp_content_wrap[0].className.replace(/wp-editor-wrap\s*/, '');
				wp_content_wrap.removeClass(wp_ed_state);

				postdivrich.hide();

				ED.get_editor_html();

				ED.container.show();
				ED.content.show();
				$('#wpv_ed_js_status').val("true");
				editor_button.addClass('active');

				ED.isVisible = true;
			});

			$('#content-html, #content-tmce').click(function(e) {
				if (!ED.isVisible) return;

				ED.isVisible = false;
				ED.saveHTML();
				postdivrich.show();
				ED.container.hide();
				$('#wpv_ed_js_status').val("false");
				editor_button.removeClass('active');
				if (e.target.id.replace('content-', '') === 'html') wp_content_wrap.addClass('html-active');
			});

			if ($('#wpv_ed_js_status').val() === 'true') editor_button.click();

			ED.init();

			$('#post').bind('submit.vamtameditor', function() {
				if(ED.isVisible && !ED.saved) {
					ED.allow_autosave = false;
					ED.saveHTML();
					ED.saved = true;
					$(this).submit();
				}
			});
		}
	});

	var ED = {
		init: function() {
			ED.controls();
			ED.dragdrop.init();
			ED.elementButtons();

			ED.toolbox = $('#wpv-editor-toolbox');
			ED.form = $('#visual_editor_edit_form');

			ED.dragdrop.refresh();

			ED.shortcodes.init();
		},

		controls: function() {
			$('body').on('click', '.column-remove', function(e) {
				e.preventDefault();
				if (confirm("Are you sure you want to delete this section?")) {
					$(this).closest(".column").remove();
					ED.dragdrop.empty_notice();
					ED.saveHTML();
				}
			});

			$('body').on('click', '.column-edit', function(e) {
				ED.edit_form.show($(this).closest('.column'));
				e.preventDefault();
			});

			$('body').on('click', '.column-clone', function(e) {
				var c = $(this).closest('.column'),
					cloned = c.fixedClone();

				cloned
					.attr('id', cloned.attr('id') + (new Date().getTime()))
					.removeClass('ui-draggable')
					.insertAfter(c);

				ED.dragdrop.empty_notice();
				ED.dragdrop.refresh();

				e.preventDefault();
			});

			$('body').on('click', '.column-decrease, .column-increase', function(e) {
				var column = $(this).closest(".column"),
					size = ED.getColumnSize(column),
					new_size = size[$(e.target).hasClass('column-decrease') ? 'smaller' : 'larger'];

				if (new_size) {
					column.removeClass(size.size).addClass(new_size);

					$(column).find(".column-size:first").html(ED.getColumnSize(column).size_str);
					ED.saveHTML();
				}

				e.preventDefault();
			});

			$('body').on('click', '.wpv-save-element', function(e) {
				ED.edit_form.save();
				e.preventDefault();
			});

			$('body').on('click', '.wpv-cancel-element', function(e) {
				ED.edit_form.cancel();
				e.preventDefault();
			});

			ED.container.on('click', '.handlediv', function(e) {
				var c = $(this).closest('.column').toggleClass('expanded');

				if (c.hasClass('expanded')) {
					var s = c.find('.inner-sortable');
					if ($(this).is('.inner-sortable')) s.add($(this));

					s.each(function() {
						if ($(this).data('sortable')) $(this).sortable("option", "disabled", false);
					});
				}

				e.preventDefault();
			});
		},

		get_editor_html: function(refresh) {
			ED.savingBlocked = true;

			var expanded = [];
			if(refresh) {
				ED.content.find('.column.expandable').each(function() {
					expanded.push($(this).hasClass('expanded'));
				});
			}

			ED.content.html('').addClass('spinner');

			var content = switchEditors._wp_Nop($('#content').html());

			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					action: 'wpv_editor_init_html',
					content: content
				},
				success: function(data) {
					ED.content.html(data).removeClass('spinner').find('.column').each(function() {
						ED.do_action($(this), 'init');
					});

					ED.dragdrop.refresh();
					ED.shortcodes.accordion.reload();
					ED.shortcodes.tabs.reload();

					if(refresh) {
						ED.content.find('.column.expandable').each(function(i) {
							if(expanded[i])
								$(this).addClass('expanded');
						});
					}

					ED.savingBlocked = false;

					ED.container.find(".wpv-editor-error").on("selectstart mousedown mousemove", function(e) {
						e.stopPropagation();
						return true;
					});
					ED.container.find(".wpv-ed-param-holder.html-content").bind("mousedown", function(e) {
						e.stopPropagation();
					});
				}
			});
		},

		dragdrop: {
			init: function() {
				$('.droppable_source', ED.container).draggable({
					revert: "invalid",
					zIndex: 300,
					cursorAt: {
						left: 10,
						top: 10
					},
					cursor: "move",
					helper: 'clone',
					start: function(event) {
						$(event.target).css({opacity:0.4});
						$('.wpv-dd-active').removeClass('wpv-dd-active');

						event.stopPropagation();
					},
					stop: function(event) {
						$(event.target).css({opacity:1});
						$('.wpv-dd-active').removeClass('wpv-dd-active');
					}
				});

				this.refresh();
			},
			refresh: function() {
				ED.rowClasses($(".wpv_main_sortable"));

				try {
					$('.wpv_sortable.ui-draggable', ED.container).draggable('destroy');
					$('.inner-sortable.ui-droppable', ED.container).droppable('destroy');
				} catch(e) {}

				$('.wpv_sortable', ED.container).draggable({
					appendTo: ED.content,
					handle: '> .controls',
					scroll: true,
					zIndex: 1000,
					cursorAt: { left: 20 },
					cursor: 'move',
					helper: 'clone',
					start: function(event) {
						$(event.target).css({opacity:0.4});
						$('.wpv-dd-active').removeClass('wpv-dd-active');

						event.stopPropagation();
					},
					stop: function(event) {
						$(event.target).css({opacity:1});
						$('.wpv-dd-active').removeClass('wpv-dd-active');
					}
				});

				ED.dragdrop.empty_notice();
				$('.inner-sortable', ED.container).droppable({
					tolerance: 'pointer',
					greedy: true,
					accept: '.wpv_sortable, .droppable_source',
					hoverClass: "ui-state-active",
					over: function() {
						$(this).addClass('wpv-dd-active');
					},
					out: function() {
						$(this).removeClass('wpv-dd-active');
					},
					drop: function(event, ui) {
						ED.dragdrop.empty_notice();
						var self = $(this);

						if(ui.draggable.hasClass('droppable_source')) {
							ED.createElement(event.target, ui.draggable, "ED.rowClasses", function(data) {
								ED.content.removeClass('spinner');
								ED.dragdrop.insert(data, self, ui.offset);
							});
						} else {
							ED.dragdrop.insert(ui.draggable, self, ui.offset);
						}
					}
				}).disableSelection();

				ED.saveHTML();
			},

			insert: function(draggable, droppable, d_offset) {
				var elements = droppable.find('>.wpv_sortable'),
					method = 'after',
					toEl = false,
					offsets = [],
					max_offset_top = 0;

				if(droppable.hasClass('expandable'))
					droppable.addClass('expanded');

				if(elements.length > 0) {
					elements.each(function(i, e) {
						var offset = $(e).offset();

						if(offset.top >= d_offset.top)
							return false;

						var row = Math.round(offset.top);

						if(!offsets[row])
							offsets[row] = [];

						offsets[row].push({
							left: offset.left,
							index: i
						});

						max_offset_top = Math.max(max_offset_top, row);
					});

					if(offsets.length === 0) {
						toEl = droppable.find('.wpv_sortable:first');
						method = 'before';
					} else {
						$(offsets[max_offset_top]).each(function(i, e) {
							if(e.left >= d_offset.left)
								return false;

							toEl = elements.eq(e.index);
						});

						if(toEl === false) {
							toEl = elements.eq(offsets[max_offset_top][0].index);
							method = 'before';
						}
					}
				} else {
					toEl = droppable;
					method = 'append';
				}

				toEl[method](draggable.css({left: 0, top: 0, opacity: 1}));

				ED.dragdrop.refresh();
			},

			empty_notice: function() {
				var span_class = 'inner-sortable-empty-notice',
					sortables = $('.inner-sortable', ED.container);

				sortables.find('.'+span_class).remove();
				sortables.append('<span class="'+span_class+'">'+WPVED_LANG.empty_notice+'</span>');

				sortables.filter(':has(> .column)').find('>.'+span_class).remove();
			}
		},

		elementButtons: function() {
			$('.clickable_action', ED.container).click(function(e) {
				var self = $(this);

				if(self.hasClass('added')) return false;

				if(!ED.creteTarget)
					ED.createTarget = $(".wpv_main_sortable", ED.container);

				ED.createElement(ED.createTarget, self, "ED.dragdrop.refresh", function() {
					ED.content.removeClass('spinner');
				});

				self.addClass('added a-icon-checkmark');
				setTimeout(function() {
					self.removeClass('added a-icon-checkmark');
				}, 800);

				e.preventDefault();
			});
		},

		parseColumn: function(column) {
			var data = column[0].className.match(/column-(\d)-(\d)/);

			if (data) return data;

			return ['column-1-1', 1, 1];
		},

		getColumnSize: function(column) {
			var size = ED.parseColumn(column);

			var sizes = ['1-1', '1-6', '1-5', '1-4', '1-3', '2-5', '1-2', '3-5', '2-3', '3-4', '4-5', '5-6', '1-1', '1-6'];
			var index = sizes.indexOf(size[1] + '-' + size[2], size[2] === "1" ? 1 : 0);

			for(var i in sizes) {
				if (sizes[i]) sizes[i] = 'column-' + sizes[i];
			}

			return {
				size: size[0],
				larger: sizes[index + 1],
				smaller: sizes[index - 1],
				size_str: size[1] + '/' + size[2]
			};
		},

		/**
		 * Fills in TinyMCE's content with the updated shortcode settings
		 */
		saveHTML: function(callback) {
			if (ED.savingBlocked) {
				console.log('ED.saveHTML is blocked');
				return;
			}

			ED.rowClasses(ED.content);

			if ($(".wpv_main_sortable").html().indexOf('<!-- wpv editor error -->') > -1) {
				console.log("ED.saveHTML can't save - there's a parser error");
				return;
			}

			var shortcodes = ED.generate_shortcodes($(".wpv_main_sortable"));

			if (tinyMCE.get('content')) {
				tinyMCE.get('content').setContent(
				switchEditors.wpautop(shortcodes), {
					format: 'raw'
				});
			}

			$('#content').val(shortcodes);

			if (ED.allow_autosave) {
				autosave();
			} else {
				ED.allow_autosave = true;
			}

			if(callback)
				callback();
		},

		/**
		 * Since we can't use .row wrappers, this function adds .first and .last classes
		 * to the first and last element in each visible row
		 */
		rowClasses: function(base_el) {
			base_el = $(base_el);

			var fill = 0,
				width = 0,
				level_1 = $(base_el).children(".column");

			if (!level_1) return;

			level_1.removeClass("first last");
			level_1.filter(":first").addClass("first");
			level_1.filter(":last").addClass("last");

			level_1.each(function() {
				$(this).removeClass('narrow-column very-narrow');
				if ($(this).width() < 200) $(this).addClass('narrow-column');

				if ($(this).width() < 100) $(this).addClass('very-narrow');

				var cur_el = $(this);
				var column_data = ED.parseColumn(cur_el);

				width = column_data[1] / column_data[2];
				fill += width;

				if (fill >= 0.98 && fill <= 1) {
					cur_el.addClass("last").next('.column').addClass("first");
					fill = 0;
				} else if (fill > 1) {
					cur_el.addClass("first").prev(".column").addClass("last");
					fill = width;
				}

				ED.rowClasses(cur_el);
			});
		},

		createElement: function(target, element, action, callback) {
			var result = void 0;

			ED.content.addClass('spinner');

			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					action: 'wpv_editor_markup',
					element: element.attr('id').replace(/^shortcode-/, '')
				},
				dataType: 'html',
				success: function(data) {
					$(target).append(data);

					data = $($($.parseHTML(data))).filter('div');

					data = $(target).find('#'+data.attr('id'));

					ED.apply_holders(data);
					ED.do_action(data, 'init');

					if (action === 'ED.dragdrop.refresh') ED.dragdrop.refresh();

					data.find(".wpv-ed-param-holder.html-content").bind("mousedown", function(e) {
						e.stopPropagation();
					});

					if(data.hasClass('expandable'))
						data.addClass('expanded');

					ED.dragdrop.refresh();

					ED.saveHTML();

					// ED.edit_form.show(data);

					result = data;

					if(typeof callback === 'function')
						callback(data);

					if(data.offset().top > $(window).scrollTop() + $(window).height()) {
						$('body').animate({
							scrollTop: data.offset().top - 150
						}, 400);
					}
				}
			});

			return result;
		},


		tinymce: {
			init: function(element) {
				var id = element.attr("id"),
					wrap = element.closest('.wpv-config-row').find('.wp-editor-wrap'),
					original_id = 'content';

				try {
					var qtinit = tinymce.extend( {}, tinyMCEPreInit.qtInit[ original_id ], { id: id } );
					quicktags( qtinit );
				} catch(e) { }

				try {
					tinymce.execCommand( 'mceRemoveEditor', true, id );
					var init = tinymce.extend( {}, tinyMCEPreInit.mceInit[ original_id ], { selector: '#' + id } );
					tinymce.init( init );

					wrap.removeClass('html-active').addClass('tmce-active');
					wrap.find('.wp-switch-editor.switch-tmce').click();

					wrap.find('.wp-switch-editor.switch-tmce').click(function() {
						tinymce.activeEditor.setContent( switchEditors._wp_Autop( element.val() ) );
					});

					wpActiveEditor = id;

					wrap.bind('click.wpv-active-editor', function() {
						setTimeout(function() {
							wpActiveEditor = id;
						}, 100);
					});
				} catch(e) { }
			},

			destroy: function(element) {
				var id = element.attr("id");

				tinymce.execCommand('mceRemoveEditor', true, id);
			},

			get_html: function(element) {
				var mce_id = element.attr('id'),
					wrap = element.closest('.wpv-config-row').find('.wp-editor-wrap');

				if (wrap.hasClass('html-active')) return element.val();

				var html = tinyMCE.get(mce_id).getContent();
				tinyMCE.execCommand('mceRemoveControl', false, mce_id);

				return switchEditors._wp_Nop(html);
			}
		},

		callbacks: {},

		add_callback: function(key, callback) {
			ED.callbacks[key] = callback;
		},

		do_action: function(element, action) {
			var callback_data = JSON.parse(element.attr('data-callbacks') || '{}');

			if (callback_data[action]) ED.callbacks[callback_data[action]].call(element, action);
		},

		has_filter: function( element, action ) {
			var callback_data = JSON.parse(element.attr('data-callbacks') || '{}');

			return !! callback_data[action];
		},

		apply_filters: function(element, action, data) {
			var callback_data = JSON.parse(element.attr('data-callbacks') || '{}');

			if (callback_data[action]) return ED.callbacks[callback_data[action]].call(element, action, data);

			return data;
		},

		edit_form: {
			show: function(element) {
				ED.content.addClass('spinner');

				$.ajax({
					type: "POST",
					url: ajaxurl,
					data: {
						action: 'wpv_editor_config',
						element: element.attr('data-basename')
					},
					success: function(response) {
						$("#save-post, #post-preview, #publish, #content-tmce, #content-html").hide();

						ED.container.addClass('element-edit-mode');
						ED.form.html(response).show();
						ED.content.removeClass('spinner');

						ED.form.addClass(ED.getColumnSize(element).size);

						if(element.parents('.inner-sortable').length > 1)
							ED.form.addClass('inner-column');

						// experimental field filter support
						// unreliable API, will be changed in later versions of the editor
						ED.form.data('field-filter-prefixes', []);
						ED.form.on('change select', '[data-field-filter]', function() {
							var prefix = $(this).attr('data-field-filter'),
								selected = $(':checked', this).val(),
								all_prefixes = _.uniq(ED.form.data('field-filter-prefixes').push(prefix));

							ED.form.data('field-filter-prefixes', all_prefixes);

							ED.form.attr('data-ff-'+prefix+'-state', selected);
						});

						$('body')
							.wpvColorPicker()
							.wpvIconsSelector()
							.wpvBackgroundOption();

						$(">.wpv-ed-param-holder", element).each(function() {
							var name = $(this).attr("name") || $(this).attr("data-name"),
								new_value = '',
								param = ED.form.find('[name="' + name + '"]');

							param.addClass('has-holder');

							// get the value from the holder
							if ($(this).is(".text, .textarea") && $(this).is('div, h1,h2,h3,h4,h5,h6, span, i, b, strong')) {
								new_value = switchEditors._wp_Nop($(this).html());
							} else if ($(this).is('img')) {
								new_value = $(this).attr('src');
							} else if ($(this).hasClass("editor")) {
								new_value = '';
								param.val( switchEditors._wp_Autop( $(this).is('textarea, input') ? $(this).val() : $(this).html() ) );
								param.addClass('tinymce-textarea');
								ED.tinymce.init(param);
							} else {
								new_value = $(this).val();
							}

							// insert the value in the editor ui
							if ($(this).hasClass('toggle') || $(this).hasClass('radio') || $(this).hasClass('icons')) {
								param.filter('[value="' + new_value + '"]').attr('checked', 'checked').change();
							} else if ($(this).hasClass('upload')) {
								param.val(new_value);
								$.WPV.upload.fill(param.attr('id'), new_value);
							} else if ($(this).hasClass('multiselect')) {
								param = ED.form.find('[name="' + name + '[]"]');
								param.val(new_value.split(','));
							} else {
								param.val(new_value).change();
							}
						});

						ED.do_action(element, 'edit');

						ED.form.find('[data-field-filter]').change();

						ED.container.data('editing-element', element);

						ED.form.find('.wpv-range-input').uirange();
					}
				});
			},

			save: function() {
				var element = this.before_save_cancel();

				var multicb = [];

				ED.form.find('[name]').filter('input, textarea, select').each(function() {
					var new_value = '',
						name = $(this).attr("name"),
						holder = element.find('> .wpv-ed-param-holder.' + name.replace('[]', ''));

					if ($(this).is(':checkbox') && name.match(/\[\]/)) {
						multicb.push(name);
						return true;
					}

					if ($(this).hasClass("tinymce-textarea")) {
						new_value = ED.tinymce.get_html($(this));
					} else if ($(this).is(':radio') && !$(this).is(':checked')) {
						return true;
					} else {
						new_value = $(this).val();

						if (new_value instanceof Array) new_value = new_value.join(',');
					}

					if (holder.is('div, h1,h2,h3,h4,h5,h6, span, i, b, strong')) {
						holder.html(switchEditors._wp_Autop(new_value));
					} else if (holder.is('img')) {
						holder.attr('src', new_value);
					} else {
						holder.val(new_value);
					}
				});

				$($.unique(multicb)).each(function() {
					var holder = element.find('.wpv-ed-param-holder.' + this.replace('[]', ''));
					var new_value = [];
					ED.form.find('[name="' + this + '"]').filter(':checked').each(function() {
						new_value.push($(this).val());
					});

					holder.val(new_value.join(','));
				});

				ED.apply_holders(element);

				ED.do_action(element, 'save');

				var title = $('<div></div>').html( ( ED.form.find('[name="column_title"]') || ED.form.find('[name="title"]') || ED.form.find('[name="name"]') ).val() ).text();
				var title_el = element.find('> .controls .column-name');

				if( !(/^\s*$/.test(title)) ) {
					title_el.text(title);
				} else {
					title_el.text(title_el.data('orig-title'));
				}

				this.after_save_cancel(element);
			},

			cancel: function() {
				var element = this.before_save_cancel();
				this.after_save_cancel(element);
			},

			before_save_cancel: function() {
				$("#save-post, #post-preview, #publish, #content-tmce, #content-html").show(); // show main publish button
				ED.container.removeClass('element-edit-mode');
				return ED.container.find('#'+ED.container.data('editing-element').attr('id'));
			},

			after_save_cancel: function(element) {
				setTimeout(ED.saveHTML, 50);

				ED.form.find('.tinymce-textarea').each(function() {
					ED.tinymce.destroy( $(this) );
				});

				ED.form.html('').hide();
				ED.form.removeClass('inner-column');
				ED.form.removeClass(ED.getColumnSize(element).size);

				_.each(ED.form.data('field-filter-prefixes'), function(prefix) {
					ED.form.attr('data-ff-'+prefix+'-state', '');
				});

				ED.form.data('field-filter-prefixes', []);
			}
		},

		generate_shortcodes: function(root, level) {
			var output = '';

			if (!level) level = 0;

			var columns = $('> div.column', root);

			if (columns.length === 0) {
				var content = root.find('.html-content');

				return content.length === 0 ? '' : (content.is('textarea,input') ? content.val() : content.html());
			}

			columns.each(function() {
				var element = $(this),
					sc_base = element.attr('data-basename'),
					sc_base_root = sc_base,
					params = [],
					column_output = '';

				if (sc_base === 'column' && level > 0) sc_base += '_' + level;

				element.children('.wpv-ed-param-holder:not(.html-content, .noattr)').each(function() {
					var param_name = $(this).attr("data-name"),
						param_value = '';

					if ($(this).is('p, div, h1,h2,h3,h4,h5,h6, span, i, b, strong') && $(this).is('.text, .textarea')) {
						param_value = switchEditors._wp_Nop($(this).html());
					} else {
						param_value = $(this).val();
					}

					if ($(this).hasClass('multiselect')) {
						param_name  = param_name.replace(/\[\]/, '');
						param_value = param_value.replace(/[\[\]]/g, '');
					}

					param_value = $.trim(param_value.replace('"', '&quot;'));

					if (!param_name.match(/^column_(title|title_type|divider|animation)$/) || sc_base_root === 'column') params.push(param_name + '="' + param_value + '"');
				});

				var wrap_before = '',
					wrap_after = '',
					column_title = element.find('> .wpv-ed-param-holder[data-name="column_title"]').val(),
					column_title_type = element.find('> .wpv-ed-param-holder[data-name="column_title_type"]').val(),
					column_divider = element.find('> .wpv-ed-param-holder[data-name="column_divider"]').val(),
					column_animation = element.find('> .wpv-ed-param-holder[data-name="column_animation"]').val();

				if (element.hasClass('wpv_ed_column')) {
					params.push('width="' + ED.getColumnSize(element).size_str + '"');
					params.push(element.hasClass("last") ? 'last="true"' : '');
				} else if (
				(element.find('> .controls > .column-size') && (ED.getColumnSize(element).size_str !== '1/1')) || (column_title && column_title.length > 1) || column_divider || (column_animation && column_animation !== 'none') ) {

					wrap_before = "\n[column" + (level > 0 ? '_' + level : '') +
						' width="' + ED.getColumnSize(element).size_str + '"' + (element.hasClass("last") ? ' last="true"' : '') +
						' title="' + column_title + '"' +
						' title_type="' + column_title_type + '"';

					if (column_divider) wrap_before += ' divider="' + column_divider + '"';
					if (column_animation) wrap_before += ' animation="' + column_animation + '"';

					wrap_before += ' implicit="true"]\n';
					wrap_after = "\n[/column" + (level > 0 ? '_' + level : '') + "]\n";
				} else if (column_title && column_title.length === 0) {
					params.push('column_title=""');
				}

				params = params.filter(String).join(' ');
				params = params.length > 0 ? ' ' + params : '';

				column_output += '\n';

				if (sc_base !== 'text') column_output += '\n[' + sc_base + params + ']';

				if ( ! ED.has_filter( element, 'generated-shortcode' ) ) {
					column_output += '\n' + ED.generate_shortcodes(element, level + 1) + '\n';
				}

				if (sc_base !== 'text') column_output += '[/' + sc_base + ']\n';

				output += ED.apply_filters(element, 'generated-shortcode', {
					shortcode: wrap_before + column_output + wrap_after,
					level: level
				}).shortcode;
			});

			return output;
		},

		apply_holders: function(element) {
			$('> .wpv-ed-param-holder', element).each(function() {
				var h = $(this);

				if (h.hasClass('add-to-container')) {
					element.attr(
						'data-' + h.attr('data-name'),
					h.is('input, textarea, select') ? h.val() : h.html());
				}

			});
		},

		shortcodes: {
			init: function() {
				this.tabs.init();
				this.accordion.init();
				this.services.init();

				$('body').on('keydown change paste blur', '#visual_editor_content .column .html-content', function(e) {
					setTimeout(ED.saveHTML, 50);
					e.stopPropagation();
				});
			},

			services: {
				init: function() {
					ED.add_callback('init-expandable-services', function() {
						var content = $(this).find('.inner-content');
						if (!content.length) content = $(this).find('.html-content');

						content = content.val().split('[split]');

						if (content.length === 1) content.push('');

						$(this).find('.wpv-ed-param-holder.closed').val(content[0]);
						$(this).find('.wpv-ed-param-holder.html-content').html(content[1]);
					});

					ED.add_callback('generate-expandable-services', function(action, data) {
						var container = $(this);

						return {
							shortcode: data.shortcode.replace(/(\[services_expandable[^\]]+\])/, function(a) {
								return a + container.find('.wpv-ed-param-holder.closed').val() + '\n[split]\n' + container.find('.wpv-ed-param-holder.html-content').val() + "\n";
							}),
							level: data.level
						};
					});
				}
			},

			tabs: {
				init: function() {
					ED.add_callback('init-tabs', function() {
						var fullinit = false;
						if ($(this).find('.tab-add').length === 0) {
							$(this).append(function() {
								return ('<div class="wpv_tabs">\
											<ul>\
												<li class="ui-state-default">\
													<a class="tab-add icon-plus"></a>\
												</li>\
											</ul>\
										</div>');
							});
							fullinit = true;
						}

						ED.shortcodes.tabs.reload();

						if(fullinit) {
							$('.tab-add', this).click().click();
						}
					});

					ED.add_callback('generate-tabs', function(action, data) {
						var container = $(this).find('.wpv_tabs');

						return {
							shortcode: data.shortcode.replace(/\s*(?=\[\/tabs\])/, function() {
								var content = '';
								container.find('> ul > li > .tab-title').each(function() {
									var t = $(this);
									ED.rowClasses($(t.attr('href')));
									content += '\n[tab icon="'+t.siblings('.tab-icon-selector').data('icon-name')+'" title="' + t.text() + '"]';
									content += ED.generate_shortcodes($(t.attr('href')), data.level+1);
									content += '[/tab]\n';
								});

								return content;
							}),
							level: data.level
						};
					});

					$('body').on('click', '.tab-add', function(e) {
						var li = $(this).parent();

						var count = li.siblings().length + 1;
						var suffix = Math.floor(Math.random() * 100000);

						li.before('<li>\
								<a href="#tabs-' + suffix + count + '" class="tab-title">Tab ' + count + '</a>\
								<a class="tab-remove icon-remove" title="Remove"></a>\
								<a class="tab-clone icon-copy" title="Clone"></a>\
								<a class="wpv-icon-selector-trigger tab-icon-selector vamtam-icon no-icon" title="Change Icon" data-icon-name="">&nbsp;</a>\
							</li>');

						li.closest('.wpv_tabs').append('<div id="tabs-' + suffix + count + '" class="clearfix inner-sortable"></div>').tabs('destroy').tabs();

						ED.saveHTML();

						e.preventDefault();
					});

					$('body').on('keypress blur paste', '.wpv_tabs textarea', function() {
						setTimeout(ED.saveHTML, 50);
					});

					$('body').on('click', '.tab-title', function() {
						$(".tab-title input").trigger("blur");
					});

					$('body').on('mousedown', '.ui-tabs-active > .tab-title', function(e) {
						var t = $(e.target);

						if (t.find('input').length === 0) {
							t.html(function() {
								return $('<input type="text" />')
									.val(t.text())
									.bind('blur keydown', function(e) {
										if ((e.keyCode >= 35 && e.keyCode <= 40) || e.keyCode === 32) {
											e.stopPropagation();
										} else if (e.type === 'blur' || (e.type === 'keydown' && e.keyCode === 13)) {
											if ($(this).val().length > 0) {
												t.text($(this).val());
												ED.saveHTML();
												return false;
											}
										}
									});
							}).find('input').focus();
						}

						e.preventDefault();
					});

					$('body').on('click', '.tab-remove', function(e) {
						var t = $(e.target).siblings().filter('.tab-title');
						$(t.attr('href')).remove();

						t.parent().addClass('to-remove');
						if (t.parent().hasClass('ui-state-active')) t.parent().parent().find('li:not(.to-remove):first .tab-title').click();

						t.parent().remove();

						ED.saveHTML();

						e.preventDefault();
					});

					$('body').on('click', '.tab-clone', function(e) {
						var tab = $(e.target).siblings().filter('.tab-title'),
							pane = $(tab.attr('href'));

						var new_id = pane.attr('id') + (new Date().getTime());

						var tab_copy = tab.parent().clone();
						tab_copy.find('a').attr('href', '#'+new_id);
						tab_copy.insertAfter(tab.parent());

						tab_copy.removeClass('ui-tabs-active ui-state-active');

						pane.clone()
							.attr('id', new_id)
							.insertAfter(pane)
							.hide();

						tab.closest('.ui-tabs').tabs('refresh');

						ED.saveHTML();

						e.preventDefault();
					});

					this.reload();
				},

				reload: function() {
					$('.wpv_tabs', ED.container).tabs();
					$('.wpv_tabs > ul', ED.container).sortable({
						forceHelperSize: true,
						update: ED.saveHTML,
						axit: 'x'
					});
				}
			},

			accordion: {
				init: function() {
					ED.add_callback('init-accordion', function() {
						if ($(this).find('.accordion-add').length === 0) {
							$(this).append(function() {
								return '<div class="wpv_accordion">'+
										'<div>\
											<h3 class="title-wrapper clearfix">\
												<a class="accordion-title">Pane 1</a>\
												<a class="accordion-remove icon-remove" title="Remove"></a>\
												<a class="accordion-clone icon-copy" title="Clone"></a>\
											</h3>\
											<div class="pane clearfix inner-sortable"></div>\
										</div>\
										<div>\
											<h3 class="title-wrapper clearfix">\
												<a class="accordion-title">Pane 2</a>\
												<a class="accordion-remove icon-remove" title="Remove"></a>\
												<a class="accordion-clone icon-copy" title="Clone"></a>\
											</h3>\
											<div class="pane clearfix inner-sortable"></div>\
										</div>\
										<div>\
											<h3><a class="accordion-add icon-plus"></a></h3>\
										</div>\
									</div>';
							});
						}

						ED.shortcodes.accordion.reload();
					});

					ED.add_callback('generate-accordion', function(action, data) {
						var container = $(this).find('.wpv_accordion');

						return {
							shortcode: data.shortcode.replace(/\s*(?=\[\/accordion\])/, function() {
								var content = '';
								container.find('> div > .title-wrapper > .accordion-title').each(function() {
									var t = $(this);

									var bgimage = t.siblings().filter('.accordion-background-selector').attr('data-background-image');
									if ( ! bgimage || bgimage === 'undefined' ) {
										bgimage = '';
									}

									ED.rowClasses(t.parent().siblings().filter('.pane'));
									content += '\n[pane title="' + t.text() + '" background_image="'+bgimage+'"]';
									content += ED.generate_shortcodes(t.parent().siblings().filter('.pane'), data.level+1);
									content += '[/pane]\n';
								});
								return content;
							}),
							level: data.level
						};
					});

					var file_frame;

					$('body').on('click', '.accordion-background-selector', function(e) {
						var self = $(this);

						file_frame = wp.media({
							multiple: false,
							library: {
								type: 'image'
							}
						});

						file_frame.on( 'select', function() {
							var attachment = file_frame.state().get('selection').first();
							self.attr('data-background-image', attachment.attributes.url);
						});

						file_frame.open();

						e.preventDefault();
					});

					$('body').on('keydown change paste blur', '.wpv_accordion textarea', function() {
						setTimeout(ED.saveHTML, 50);
					});

					$('body').on('click', '.accordion-add', function(e) {
						var block = $(this).closest('div');

						var count = block.siblings().length + 1;

						block.before('<div>\
									<h3 class="title-wrapper clearfix">\
										<a class="accordion-title">Pane ' + count + '</a>\
										<a class="accordion-remove icon-remove" title="Remove"></a>\
										<a class="accordion-clone icon-copy" title="Clone"></a>\
									</h3>\
									<div class="pane clearfix inner-sortable"></div>\
								</div>');

						block.closest('.wpv_accordion').accordion('destroy');

						ED.shortcodes.accordion.reload();

						ED.saveHTML();

						e.preventDefault();
					});

					$('body').on('click', '.accordion-title', function() {
						$(".accordion-title input").trigger("blur");
					});

					$('body').on('mousedown', '.ui-accordion-header-active .accordion-title', function(e) {
						var t = $(e.target);

						if (t.find('input').length === 0) {
							t.html(function() {
								return $('<input type="text" />')
									.val(t.text())
									.bind('blur keydown', function(e) {
										if ((e.keyCode >= 35 && e.keyCode <= 40) || e.keyCode === 32) {
											e.stopPropagation();
										} else if (e.type === 'blur' || (e.type === 'keydown' && e.keyCode === 13)) {
											if ($(this).val().length > 0) {
												t.text($(this).val());
												ED.saveHTML();
												return false;
											}
										}
									});
							}).find('input').focus();
						}

						e.preventDefault();
					});

					$('body').on('click', '.accordion-remove', function(e) {
						$(e.target).parent().parent().remove();
						ED.saveHTML();
						e.preventDefault();
					});

					$('body').on('click', '.accordion-clone', function(e) {
						var pane = $(e.target).parent().parent(),
							pane_copy = pane.clone().insertAfter(pane);

						pane_copy.find('.ui-state-active').removeClass('ui-accordion-header-active ui-state-active');

						pane.closest('.ui-accordion').accordion('refresh');
						ED.saveHTML();
						e.preventDefault();
					});

					this.reload();
				},

				reload: function() {
					$('.wpv_accordion', ED.container).accordion({
						header: "> div > .title-wrapper",
						heightStyle: 'content'
					}).sortable({
						axis: "y",
						handle: ".title-wrapper",
						update: ED.saveHTML,
						stop: function(event, ui) {
							// IE doesn't register the blur when sorting
							// so trigger focusout handlers to remove .ui-state-focus
							ui.item.children('.title-wrapper').triggerHandler("focusout");
						}
					});
				}
			}
		}

	};

	$.WPVED = ED;

})(jQuery);