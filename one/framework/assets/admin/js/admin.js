/**
 * Admin controller.
 *
 * This file is entitled to manage all the interactions in the admin interface.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Assets\Admin\JS
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

// -----------------------------------------------------------------------------
// $Backbone templates
// -----------------------------------------------------------------------------

var THB_Template = function( template_string, data ) {
	var version = parseFloat( thb.wp_version ),
		settings = {
			evaluate:    /<#([\s\S]+?)#>/g,
			interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
			escape:      /\{\{([^\}]+?)\}\}(?!\})/g
		};

	if ( version < 4.5 ) {
		return _.template(
			template_string,
			data,
			settings
		);
	}

	var template_function = _.template( template_string, settings );

	return function( data ) {
		return template_function( data );
	};
}

// -----------------------------------------------------------------------------
// $Admin models
// -----------------------------------------------------------------------------

/**
* Media
*/
var THB_Media = Backbone.Model.extend({
	open: function( options ) {
		var self = this,
			defaults = {
				id:         'library',
				multiple:   false, // false, 'add', 'reset'
				describe:   false,
				toolbar:    'select',
				sidebar:    'settings',
				content:    'upload',
				router:     'browse',
				menu:       'default',
				searchable: true,
				filterable: false,
				sortable:   true,
				ids: [],
				// title:      '',

				// Uses a user setting to override the content mode.
				contentUserSetting: false,

				// Sync the selection from the last state when 'multiple' matches.
				syncSelection: false
			};

		defaults = jQuery.extend(defaults, options);

		if( options.ids && options.ids.length > 0 ) {
			defaults.content = 'browse';
		}

		// wp.media.controller.THBUploadController = wp.media.controller.Library.extend({
		// 	'defaults': defaults
		// });

		var media_popup = wp.media({
			// states: [ new wp.media.controller.THBUploadController() ],
			multiple: defaults.multiple,
			title: defaults.title,
			library: {
				type: 'image'
			}
		});

		media_popup.states.models[0].on('select', function() {
			self.close( this );
		});

		media_popup.on('open', function() {
			var selection = media_popup.state().get('selection');

			if( options.ids ) {
				jQuery.each(options.ids, function(id) {
					attachment = wp.media.attachment(options.ids[id]);
					attachment.fetch();
					selection.add( attachment ? [attachment] : [] );
				});
			}
		});

		media_popup.open();
	},

	close: function( frame ) {
		var selection = frame.get('selection'),
			images = [];

		jQuery.each( selection.models, function() {
			images.push({
				url: this.attributes.url,
				id: this.attributes.id
			});
		} );

		if( images.length > 0 ) {
			this.valorize(images);
		}
	},

	valorize: function( images ) {
		// console.log(images);
	}
});

// -----------------------------------------------------------------------------
// $Admin views
// -----------------------------------------------------------------------------

/**
 * Duplicable container
 */
var THB_DuplicableContainer = Backbone.View.extend({
	el: ".thb-fields-container.duplicable",

	initialize: function() {
		var self = this;
		this.$el.data("container", this);
		this.fields_container = this.$('.thb-container');
		this.fields_counter = this.$('.thb-field').length;
		this.static_counter = this.fields_counter;

		if( this.$el.hasClass('sortable') ) {
			var sortable_args = {
				distance: 10,
				helper : 'clone',
				stop: function() {
					self.reorderFields();
				}
			};

			if( this.$el.hasClass('withHandle') ) {
				sortable_args["handle"] = ".handle";
			}

			this.fields_container.sortable( sortable_args );
		}
	},

	events: {
		'click .thb-controls > a': 'fire',
		'click .thb-field .thb-remove': 'removeField'
	},

	fire: function( event ) {
		var control = jQuery(event.target),
			tpl = control.data("tpl");

		if( control.data("action") ) {
			var fn = window[control.data("action")];
			if( typeof fn === 'function' ) {
				fn( this, tpl, control );
			}
		}
		else {
			this.addField(tpl);
		}

		return false;
	},

	addField: function( tpl, insertAfter ) {
		var template = THB_Template(
			jQuery('script[data-tpl="' + tpl + '"]').html()
		);

		var html = template();
		html = html.replace( /#index#/gi, this.static_counter );

		html = jQuery( html );
		html.addClass("thb-new");

		if ( insertAfter !== undefined ) {
			html = html.insertAfter( insertAfter );
		}
		else {
			if( this.$el.hasClass("prependable") ) {
				html = html.prependTo(this.fields_container);
			}
			else {
				html = html.appendTo(this.fields_container);
			}
		}

		thb_boot_fields( html );

		setTimeout(function() {
			html.removeClass("thb-new");
		}, 250);

		this.fields_counter++;
		this.static_counter++;
		this.containerClass();

		return html;
	},

	removeField: function( event ) {
		var field = jQuery(event.target).parents('.thb-field');

		this._removeField( field );

		return false;
	},

	_removeField: function( field, dont_animate ) {
		var self = this;

		field.remove();
		self.fields_counter--;
		self.containerClass();

		jQuery( window ).trigger( "resize" );
	},

	removeAllFields: function() {
		var self = this,
			fields = this.$el.find( '.thb-field' );

		fields.each( function() {
			self._removeField( jQuery(this), true );
		} );

		this.fields_counter = 0;
		this.containerClass();
	},

	containerClass: function() {
		this.removeLoadingClass();

		if( this.fields_counter === 0 ) {
			this.$el.addClass("no-fields");
		}
		else {
			this.$el.removeClass("no-fields");
		}
	},

	addLoadingClass: function() {
		this.$el.addClass( "thb-loading" );
	},

	removeLoadingClass: function() {
		this.$el.removeClass( "thb-loading" );
	},

	reorderFields: function() {
		var container = this,
			key = this.$el.data("field-key"),
			reg = key + '\\[\\d+\\]',
			re = new RegExp( reg, 'g' ),
			fields = this.$el.find( '.thb-field' );

		fields.each( function() {
			var field = jQuery( this ),
				field_index = field.index(),
				field_html = field.outerHTML(),
				rep = key + '[' + field_index + ']';

			var inputs = jQuery( "[name]", field );

			inputs.each( function() {
				var name = jQuery( this ).attr( "name" );
				name = name.replace( re, rep );

				jQuery( this ).attr( "name", name );
			} );

			// field_html = field_html.replace( re, rep );

			// var new_field = jQuery( field_html );
			// thb_boot_fields( new_field );

			// field.replaceWith( new_field );

			container.fields_counter++;
			container.static_counter++;
		} );

		return false;
	}
});

/**
 * Form.
 */
var THB_Form = Backbone.View.extend({
	initialize: function() {
		this.action = this.$el.attr("action");
		this.button = this.$("input[type='submit']");
		this.button_val = this.button.val();
		this.form_data = '';
	},

	events: {
		'submit': 'submit'
	},

	submit: function() {
		var self = this;

		self.form_data = self.$el.serialize().replace(/%5B%5D/g, '[]');

		self.button
			.attr("disabled", "disabled")
			.val( jQuery.thb.translate("saving") );

		jQuery.post(self.action, self.form_data, function( response ) {
			jQuery.thb.flashdata(response.message);

			self.button
				.removeAttr("disabled")
				.val(self.button_val);
		}, 'json');

		return false;
	}
});

/**
 * Options tab.
 */
var THB_Tab = Backbone.View.extend({
	initialize: function() {
		var self = this;
		this.id = this.$el.attr("id");
		this.forms = [];

		this.$("form.thb-ajax").each(function() {
			self.forms.push( new THB_Form({ el: this }) );
		});
	},

	show: function() {
		this.$el.show();
	},

	hide: function() {
		this.$el.hide();
	}
});

/**
 * Tabs navigation.
 */
var THB_Nav = Backbone.View.extend({
	events: {
		"click > ul li a": "select"
	},

	initialize: function() {
		jQuery('.thb-page-tabs-container').css('min-height', this.$el.outerHeight());
		this.items = this.$el.find('ul li');
	},

	firstTab: function() {
		var href = this.items.first().find("a").attr('href');
		this.tab( href );
	},

	tab: function( href ) {
		href = href.replace("#", "");
		var tab = this.page.tab( href );

		this.items.removeClass('active');
		this.items.has("[data-href='" + href + "']").addClass('active');

		jQuery.each(this.page.tabs, function() {
			this.hide();
		});

		tab.show();

		setTimeout(function() {
			jQuery("textarea.code").trigger("refresh");
			jQuery( window ).trigger( "resize" );
		}, 5);
	},

	select: function( event ) {
		var href = jQuery(event.target).data('href');

		this.tab( href );

		return false;
	},

	run: function() {
		if ( ! this.items.length ) {
			return;
		}
	}
});

/**
 * Page.
 */
var THB_Page = Backbone.View.extend({
	el: '.thb-page',

	initialize: function() {
		var self = this;
		self.nav = new THB_Nav({ el: this.$(".thb-page-tabs-nav") });
		self.nav.page = this;
		self.tabs = [];

		thb_boot_fields();

		this.$(".thb-page-tab").each(function() {
			self.tabs.push( new THB_Tab({ el: this }) );
		});

		// jQuery('.widget').each(function() {
		// 	if(jQuery(this).attr('id') && jQuery(this).attr('id').indexOf('_thb_') != -1) {
		// 		jQuery(this).addClass('thb');
		// 	}
		// });

		self.nav.run();
	},

	tab: function( eid ) {
		var self = this,
			tab = null;

		jQuery.each(self.tabs, function() {
			if( this.id == String(eid) + "-id" ) {
				tab = this;
				return;
			}
		});

		return tab;
	}
});

/**
 * Post.
 */
var THB_Post = Backbone.View.extend({
	el: '#post',

	initialize: function() {
		var self = this;

		// Post formats
		this.metaboxes = this.$('#metabox_post_gallery, #metabox_post_quote, #metabox_post_video, #metabox_post_audio, #metabox_post_link');

		this.group = this.$('#post-formats-select input');
		this.groupChange();
	},

	events: {
		'change #post-formats-select input': 'groupChange'
	},

	groupChange: function() {
		var self = this;

		this.group.each(function() {
			if( jQuery(this).is(':checked') ) {
				self.metaboxes.hide();
				var val = jQuery(this).val();
				jQuery('#metabox_post_' + val).show();
				return;
			}
		});
	}
});

/**
 * Modal component.
 */
( function( $ ) {
	window.THB_Modal = function( slug, title, onClose, onHide ) {

		var self = this,
			template_master = $( "script[data-tpl='thb-modal']" );

		this.slug = slug;
		this.title = title;
		this.multipleModals = false;

		/**
		 * Open the modal.
		 */
		this.open = function( data ) {
			this.obj = THB_Template( template_master.html() );
			this.obj = $( this.obj( {
				'title': title,
				'content': ''
			} ) );

			this.obj.addClass( "thb-modal-" + slug );

			this.obj.data( "modal", this );

			$( "body" ).append( this.obj );

			this.obj.addClass( "thb-modal-loading" );

			if ( $( "body" ).hasClass( "thb-modal-open" ) ) {
				this.multipleModals = true;
			}
			else {
				$( "body" ).addClass( "thb-modal-open" );
			}

			this.obj.on( "click.thb_modal", function( e ) {
				if( $( e.target ).hasClass( "thb-modal" ) ) {
					self.hide();
					return false;
				}

				return true;
			} );

			// $(document).on("keydown.thb_modal", function( e ) {
			// 	if ( e.which === 27 ) {
			// 		self.hide();
			// 		return false;
			// 	}

			// 	return true;
			// });

			this.obj.find( ".thb-modal-close" ).on( "click", function() { self.hide(); return false; } );
			this.obj.find( "form" ).on( "submit", function() { return false; } );
			this.obj.find( ".thb-btn-save" ).on( "click", function() { self.close(); return false; } );

			this.obj.show();

			$.ajax( {
				'method': 'POST',
				'url': ajaxurl,
				'data': {
					'action': 'thb_modal_content',
					'data': data,
					'slug': slug
				},
				'success': function( html ) {
					self.obj.find( "form" ).html( html );
					self.obj.addClass( "thb-tabs-count-" + self.obj.find( ".thb-tab-content" ).length );

					if ( self.obj.find( ".thb-tab-content" ).length > 1 ) {
						self.obj.addClass( "thb-modal-has-tabs" );
					}

					setTimeout( function() {
						thb_boot_fields( self.obj );
						self.obj.removeClass( "thb-modal-loading" );
					}, 10 );
				}
			} );
		};

		/**
		 * Close the modal.
		 */
		this.hide = function() {
			if ( onHide !== undefined ) {
				var serialized = this.obj.find( "form" ).serializeObject();
				onHide( serialized, this );
			}

			this.obj.remove();

			if ( ! this.multipleModals ) {
				$( "body" ).removeClass( "thb-modal-open" );
			}
		};

		/**
		 * Save the modal.
		 */
		this.close = function() {
			var serialized = this.obj.find( "form" ).serializeObject();

			this.hide();
			onClose( serialized, this );
		};

	};
} )( jQuery );

(function($){
	$.fn.serializeObject = function(){

	    var self = this,
	        json = {},
	        push_counters = {},
	        patterns = {
	            "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
	            "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
	            "push":     /^$/,
	            "fixed":    /^\d+$/,
	            "named":    /^[a-zA-Z0-9_]+$/
	        };


	    this.build = function(base, key, value){
	        base[key] = value;
	        return base;
	    };

	    this.push_counter = function(key){
	        if(push_counters[key] === undefined){
	            push_counters[key] = 0;
	        }
	        return push_counters[key]++;
	    };

	    $.each($(this).serializeArray(), function(){

	        // skip invalid keys
	        if(!patterns.validate.test(this.name)){
	            return;
	        }

	        var k,
	            keys = this.name.match(patterns.key),
	            merge = this.value,
	            reverse_key = this.name;

	        while((k = keys.pop()) !== undefined){

	            // adjust reverse_key
	            reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

	            // push
	            if(k.match(patterns.push)){
	                merge = self.build([], self.push_counter(reverse_key), merge);
	            }

	            // fixed
	            else if(k.match(patterns.fixed)){
	                merge = self.build([], k, merge);
	            }

	            // named
	            else if(k.match(patterns.named)){
	                merge = self.build({}, k, merge);
	            }
	        }

	        json = $.extend(true, json, merge);
	    });

	    $.each( json, function( i, el ) {
	    	if ( json[i].push ) {
	    		json[i] = json[i].filter( function( e ) {
	    			return ( e===undefined||e===null )? false : ~e;
	    		} );
	    	}
	    } );

	    return json;
	};
})(jQuery);

// -----------------------------------------------------------------------------
// $Admin fields
// -----------------------------------------------------------------------------

/**
 * Boot
 */
(function($) {
	window.thb_boot_fields = function( root ) {
		if( !root ) {
			root = $('body');
		}

		// Tabs
		root.find( ".thb-tabs" ).thb_tabs();

		// Tooltips
		$( '.tt[title]', root ).tipTop();

		// Duplicable containers
		root.find(".thb-fields-container.duplicable").each(function() {
			var duplicable_container = new THB_DuplicableContainer({ el: this });
		});

		root.find(".thb-autoselect").on("click", function() {
			$(this).selectText();
		});

		root.find(".thb-selectize").thbSelectize();
		root.find(".thb-select").thbSelect();
		root.find(".thb-iconpicker").thbIconPicker();

		root.find(".thb-colorpicker").each(function() {
			$( this ).minicolors();
			// jQuery(this).wpColorPicker();
		});

		root.find('input.thb-number').stepper({
			customClass: "thb-field-number-control"
		});

		root.find('input.thb-number[min]').on('input', function() {
			var min = parseInt( $( this ).attr( 'min' ), 10 ),
				val = parseInt( $( this ).val(), 10 );

			if ( val < min ) {
				$( this ).val( min );
			}
		});

		root.find('input.thb-checkbox').thbCheckbox();

		root.find(".thb-view-upload").each(function() {
			var upl = $( this );

			if ( upl.data( 'THB_Upload' ) === undefined ) {
				upl.data( 'THB_Upload', new THB_Upload({ el: upl }) );
			}

			// var el = jQuery(this);

			// if( !fields.containsKey(el) ) {
			// 	fields.put( this, new THB_Upload({ el: el }) );
			// }
		});

		root.find(".thb-view-gallery").each(function() {
			var gallery = new THB_Gallery({ el: jQuery(this) });

			// var el = jQuery(this);

			// if( !fields.containsKey(el) ) {
			// 	fields.put( this, new THB_Gallery({ el: el }) );
			// }
		});

		root.find(".date").each(function() {
			var format = jQuery(this).data('date-format'),
				options = {
					dateFormat: format,
					dayNames: thb.strings.dayNames,
					dayNamesShort: thb.strings.dayNamesShort,
					monthNames: thb.strings.monthNames,
					monthNamesShort: thb.strings.monthNamesShort,
					prevText: '<',
					nextText: '>'
				};

			jQuery(this).datepicker(options);
		});

		root.find("textarea.code").each(function() {
			var language = jQuery( this ).data( "language" ),
				node = jQuery(this).get(0),
				editor = CodeMirror.fromTextArea(node, {
					mode: language,
					indentWithTabs: true,
					indentUnit: 4,
					lineNumbers: true
				});

			editor.on("change", function(instance, changeObj) {
				jQuery(node).text(editor.getValue());
			});

			jQuery(this).bind('refresh', function() {
				editor.refresh();
			});
		});

		var graphic_radio_groups = [];
		root.find(".thb-radio-options :radio").each(function() {
			if( ! graphic_radio_groups[this.name] ) {
				graphic_radio_groups.push(this.name);
			}
		});

		jQuery.each(graphic_radio_groups, function() {
			var radios = jQuery("[data='thb-radio-option-" + this + "'] img");

			radios.on("click", function() {
				var parent = jQuery(this).parents(".thb-radio-option");

				parent.find("input[type='radio']").trigger("click");

				radios.removeClass("thb-checked");

				if( parent.find("input[type='radio']").is(":checked") ) {
					jQuery(this).addClass("thb-checked");
				}
			});

			if( ! radios.filter(".thb-checked").length ) {
				radios.first().trigger("click");
			}
		});

		if ( root.is(".thb-field-tab") )
			root.thbTabField();
		else
			root.find(".thb-field-tab").each(function() { $(this).thbTabField(); });

		if ( root.is(".thb-field-pricingtable") )
			root.thbPricingTableField();
		else
			root.find(".thb-field-pricingtable").each(function() { $(this).thbPricingTableField(); });

		if ( root.is(".thb-field-blockslist") )
			root.thbBlocksListField();
		else
			root.find(".thb-field-blockslist").each(function() { $(this).thbBlocksListField(); });

		if ( root.is(".thb-field") )
			root.thbSlide();
		else
			root.find(".thb-field").each(function() { $(this).thbSlide(); });

		if ( root.is(".thb-field-section") )
			root.thbSection();
		else
			root.find(".thb-field-section").each(function() { $(this).thbSection(); });

		if ( root.is(".thb-field-background") ) {
			var bg = new THB_FieldBackground( $( this ) );
		}
		else {
			root.find(".thb-field-background").each(function() { var bg = new THB_FieldBackground( $( this ) ); });
		}

		$( window ).trigger( "thb_boot_fields", [ root ] );
	};
})(jQuery);

/**
 * Blocks list field.
 *
 * @return {jQuery}
 */
( function( $ ) {
	$.fn.thbBlocksListField = function() {
		if ( ! $( this ).parents( ".thb-modal" ).length ) {
			return;
		}

		var modal = $( this ).parents( ".thb-modal" ).data( "modal" ),
			type = $( this ).find( "tr" ),
			input = $( this ).find( "input" );

		type.on( "click", function() {
			input.val( $( this ).data( "type" ) );

			modal.close();

			return false;
		} );
	};
} )( jQuery );

/**
 * Background field.
 */
( function( $ ) {
	window.THB_FieldBackground = function( field ) {
		var overlay_display = field.find( "[name*='[overlay_display]']" ),
			overlay_color = field.find( ".thb-overlay-color" ),
			overlay_opacity = field.find( ".thb-overlay-opacity" ),
			overlay = field.find( ".thb-overlay" );

		overlay_color.minicolors({
			change: function( hex ) {
				overlay.css( "background-color", hex );
			}
		});

		overlay_opacity.on( "change", function() {
			overlay.css( "opacity", overlay_opacity.val() );
		} );

		overlay_display.on( "change", function() {
			var checked = $( this ).attr( "value" );

			if ( checked == '1' ) {
				overlay.show();
			}
			else {
				overlay.hide();
			}
		} );

		overlay.css( "background-color", overlay_color.val() );
		overlay.css( "opacity", overlay_opacity.val() );
		overlay.css( "display", overlay_display.val() == '1' ? 'block' : 'none' );
	};
} )( jQuery );

/**
 * Tab field.
 *
 * @return {jQuery}
 */
( function( $ ) {
	$.fn.thbTabField = function() {
		var placeholder = $( this ).find( ".tab-item-placeholder" ),
			item = $( this ).find( ".tab-item" );

		placeholder.on( "click", function() {
			item.toggle();
			$(this).parent().toggleClass('open');

			return false;
		} );
	};
} )( jQuery );

/**
 * Pricing table field.
 *
 * @return {jQuery}
 */
( function( $ ) {
	$.fn.thbPricingTableField = function() {
		var placeholder = $( this ).find( ".pricingtable-item-placeholder" ),
			item = $( this ).find( ".pricingtable-item" );

		placeholder.on( "click", function() {
			item.toggle();
			$(this).parent().toggleClass('open');

			return false;
		} );
	};
} )( jQuery );

/**
 * Section field.
 *
 * @return {jQuery}
 */
( function( $ ) {
	window.thb_builder_add_section = function( container, tpl, control ) {
		if ( control.hasClass( "thb-section-add-section" ) ) {
			var field = container.addField( tpl, control.parents( ".thb-field-section" ) );
		}
		else {
			var field = container.addField( tpl );
		}

		var section = field.data( "thb-field-section" ),
			field_position = field.offset().top - $('body').offset().top - 20;

		$.scrollTo( field_position, 500, {
			easing: "easeInOutQuint"
		} );

		section.addRow();

		return false;
	};

	window.thb_builder_block_placeholder = function( type, title, data ) {
		var placeholder = "";

		switch ( type ) {
			default:
				if ( data.title && data.title != "" ) {
					placeholder += data.title;
				}

				break;
		}

		return placeholder;
	};

	var THB_Section = function( field ) {

		var self = this,
			columnTemplate = THB_Template( $( 'script[data-tpl="column_create"]' ).html() ),
			rowTemplate = THB_Template( $( 'script[data-tpl="row_create"]' ).html() ),
			blockTemplate = THB_Template( $( 'script[data-tpl="block_create"]' ).html() ),
			rowsContainer = field.find( ".thb-rows-container" );

		var sizes = [
			'one-fifth',
			'one-fourth',
			'one-third',
			'two-fifths',
			'one-half',
			'three-fifths',
			'two-thirds',
			'three-fourths',
			'four-fifths',
			'full'
		];

		var n_sizes = [
			'1/5',
			'1/4',
			'1/3',
			'2/5',
			'1/2',
			'3/5',
			'2/3',
			'3/4',
			'4/5',
			thb.strings.full
		];

		var p_sizes = [
			0.2,
			0.25,
			0.333,
			0.4,
			0.5,
			0.6,
			0.666,
			0.75,
			0.8,
			1
		];

		// Row -----------------------------------------------------------------

		/**
		 * Add a row to the section.
		 *
		 * @return {boolean}
		 */
		this.addRow = function( animate ) {
			var row = $( rowTemplate() );

			rowsContainer.append( row );
			self.bindRow( field, row );
			thb_boot_fields( row );

			if ( animate ) {
				row_position = row.offset().top - $('body').offset().top - 20;
				$.scrollTo( row_position, 500 );
			}

			self.updateData();

			return false;
		};

		/**
		 * Remove a row.
		 *
		 * @param  {jQuery} row
		 * @return {boolean}
		 */
		this.removeRow = function( row ) {
			row.remove();

			self.updateData();

			return false;
		}

		/**
		 * Clone a row.
		 *
		 * @param  {jQuery} row
		 * @return {boolean}
		 */
		this.cloneRow = function( row ) {
			var cloned_row = row.clone();
			thb_boot_fields( cloned_row );
			row.after( cloned_row );
			this.bindRow( row.parents(".thb-section"), cloned_row );

			self.updateData();

			return false;
		};

		// Column --------------------------------------------------------------

		/**
		 * Add a column to a row.
		 *
		 * @param {jQuery} row
		 * @param {string} size
		 * @return {boolean}
		 */
		this.addColumn = function( row, size ) {
			var currentSizeIndex = _.indexOf( sizes, size );

			var column = $( columnTemplate({
					size: size,
					fraction: n_sizes[currentSizeIndex]
				}) ),
				columnsContainer = row.find( ".thb-columns-container" ),
				count = this.countColumnDimensions( row ),
				newSize = count + p_sizes[currentSizeIndex];

			if ( newSize > 1 ) {
				return false;
			}

			columnsContainer.append( column );
			self.toggleRowDimensionClass( row );
			self.toggleColumnControlClass( row );

			self.bindColumn( row, column );
			thb_boot_fields( column );

			self.updateData();

			return false;
		};

		/**
		 * Count the dimension of the row's columns.
		 *
		 * @param  {jQuery} row
		 * @return {integer}
		 */
		this.countColumnDimensions = function( row ) {
			var columns = row.find( ".thb-column" ),
				sum = 0;

			columns.each( function() {
				var currentSize = $( this ).attr( "data-size" ),
					currentSizeIndex = _.indexOf( sizes, currentSize );

				sum += Math.round( p_sizes[currentSizeIndex] * 1000 ) / 1000;
			} );

			return Math.round( sum * 1000 ) / 1000;
		};

		/**
		 * Toggle a 'complete' class upon addition or removal of a row column.
		 *
		 * @param  {jQuery} row
		 */
		this.toggleRowDimensionClass = function( row ) {
			var count = this.countColumnDimensions( row );

			row.removeClass( 'complete empty' );

			if ( count === 0 ) {
				row.addClass( 'empty' );
			}
			else if ( count > 0.8 ) {
				row.addClass( 'complete' );
			}
		};

		this.toggleColumnControlClass = function( row ) {
			var columns = row.find( ".thb-column" ),
				count = this.countColumnDimensions( row ),
				left = Math.round( ( 1 - count ) * 1000 ) / 1000;

			row.find( ".thb-row-add-column" ).each( function() {
				var cS = $( this ).attr( "data-size" ),
					cSI = _.indexOf( sizes, cS );

				if ( p_sizes[cSI] > left ) {
					$( this ).hide();
				}
				else {
					$( this ).show().css( "display", "inline-block");
				}
			} );

			columns.each( function() {
				var column = $( this ),
					currentSize = column.attr( "data-size" ),
					currentSizeIndex = _.indexOf( sizes, currentSize );

				column.find( ".thb-column-increase-size" ).show();
				column.find( ".thb-column-decrease-size" ).show();
				column.find( ".thb-column-clone" ).show();

				if ( p_sizes[currentSizeIndex + 1] !== undefined ) {
					if ( left < p_sizes[currentSizeIndex + 1] - p_sizes[currentSizeIndex] ) {
						column.find( ".thb-column-increase-size" ).hide();
					}
				}
				else {
					column.find( ".thb-column-increase-size" ).hide();
				}

				if ( p_sizes[currentSizeIndex - 1] === undefined ) {
					column.find( ".thb-column-decrease-size" ).hide();
				}

				if ( left < p_sizes[currentSizeIndex] ) {
					column.find( ".thb-column-clone" ).hide();
				}
			} );
		};

		/**
		 * Expand the column width.
		 *
		 * @param  {jQuery} column
		 * @return {boolean}
		 */
		this.expandColumn = function( column ) {
			var currentSize = column.attr( "data-size" ),
				currentSizeIndex = _.indexOf( sizes, currentSize );

			if ( currentSizeIndex < sizes.length - 1 ) {
				var row = column.parents( ".thb-row" )
					count = this.countColumnDimensions( row ),
					newSize = count - p_sizes[currentSizeIndex] + p_sizes[currentSizeIndex + 1];

				if ( newSize > 1 ) {
					return false;
				}

				column.attr( "data-size", sizes[currentSizeIndex + 1] );

				self.toggleRowDimensionClass( row );
				self.toggleColumnControlClass( row );

				column.find( ".thb-column-size" ).html( n_sizes[currentSizeIndex + 1] );
				self.updateData();
			}

			return false;
		};

		/**
		 * Clone a column.
		 *
		 * @param  {jQuery} column
		 * @return {boolean}
		 */
		this.cloneColumn = function( column ) {
			var currentSize = column.attr( "data-size" ),
				currentSizeIndex = _.indexOf( sizes, currentSize ),
				row = column.parents( ".thb-row" ),
				count = this.countColumnDimensions( row ),
				newSize = count + p_sizes[currentSizeIndex];

			if ( newSize > 1 ) {
				return false;
			}

			var cloned_column = column.clone();
			thb_boot_fields( cloned_column );
			column.after( cloned_column );

			self.toggleRowDimensionClass( row );
			self.toggleColumnControlClass( row );

			self.bindColumn( field, cloned_column );
			self.updateData();

			return false;
		};

		/**
		 * Reduce the column width.
		 *
		 * @param  {jQuery} column
		 * @return {boolean}
		 */
		this.reduceColumn = function( column ) {
			var currentSize = column.attr( "data-size" ),
				currentSizeIndex = _.indexOf( sizes, currentSize ),
				row = column.parents( ".thb-row" );

			if ( currentSizeIndex > 0 ) {
				column.attr( "data-size", sizes[currentSizeIndex - 1] );

				self.toggleRowDimensionClass( row );
				self.toggleColumnControlClass( row );

				column.find( ".thb-column-size" ).html( n_sizes[currentSizeIndex - 1] );
				self.updateData();
			}

			return false;
		};

		/**
		 * Remove a column.
		 *
		 * @param  {jQuery} column
		 * @return {boolean}
		 */
		this.removeColumn = function( column ) {
			var row = column.parents( ".thb-row" );

			column.remove();
			self.toggleRowDimensionClass( row );
			self.toggleColumnControlClass( row );
			self.updateData();

			return false;
		};

		// Block ---------------------------------------------------------------

		/**
		 * Add a block to a column.
		 *
		 * @param {jQuery} column
		 * @param {string} type
		 * @param {string} title
		 * @return {boolean}
		 */
		this.addBlock = function( column, type ) {
			var title = thb_builder.blocks[type],
				container = column.find( ".thb-blocks-container" ),
				wrapper = column.find( ".thb-column-block-description-select-wrapper" );

			if ( type == '' ) {
				return false;
			}

			var modal = new THB_Modal( type, title, function( data, modal ) {
				var t = thb_builder_block_placeholder( type, modal.title, data );

				var blockTemplate = THB_Template( $( 'script[data-tpl="block_create"]' ).html() ),
					block = $( blockTemplate({
						'data': JSON.stringify( data ),
						'title': t == "" ? modal.title : t,
						'nicetype': t != "" ? modal.title : "",
						'type': type
					}) );

				column.removeClass( "empty" );
				block.addClass( "new" );
				container.append( block );

				thb_boot_fields( block );

				setTimeout( function() {
					block.removeClass( "new" );
				}, 1000 );

				wrapper.hide();

				self.bindBlock( column, block );
				self.updateData();
			} );

			modal.open( {} );

			return false;
		};

		/**
		 * Edit a block.
		 *
		 * @param {jQuery} column
		 * @return {boolean}
		 */
		this.editBlock = function( block ) {
			var field = block.parents( ".thb-field-section" ),
				title = thb_builder.blocks[block.attr('data-type')],
				column = block.parents( ".thb-column" ),
				row = column.parents( ".thb-row" );

			var modal = new THB_Modal( block.attr('data-type'), title, function( data, modal ) {
				var t = thb_builder_block_placeholder( block.attr('data-type'), modal.title, data );

				var blockNew = $( blockTemplate({
						'data': JSON.stringify( data ),
						'title': t == "" ? modal.title : t,
						'nicetype': t != "" ? modal.title : "",
						'type': block.attr('data-type')
					}) );

				blockNew.addClass( "new" );
				block.replaceWith( blockNew );

				thb_boot_fields( blockNew );

				setTimeout( function() {
					blockNew.removeClass( "new" );
				}, 1000 );

				self.bindBlock( column, blockNew );
				self.updateData();
			} );

			var $data = field.find( ".thb-section-data" ),
				data = $.deparam( $data.val() );

			var modal_data = data.rows[row.index()].columns[column.index()].blocks[block.index()].data;

			modal.open( modal_data );

			return false;
		};

		/**
		 * Remove a block.
		 *
		 * @param  {jQuery} block
		 * @return {boolean}
		 */
		this.removeBlock = function( block ) {
			var column = block.parents( ".thb-column" );

			block.remove();

			if ( ! column.find( ".thb-block" ).length ) {
				column.addClass( "empty" );
			}

			self.updateData();

			return false;
		};

		/**
		 * Clone a block.
		 *
		 * @param  {jQuery} block
		 * @return {boolean}
		 */
		this.cloneBlock = function( block ) {
			var cloned_block = block.clone();
			thb_boot_fields( cloned_block );
			block.after( cloned_block );
			this.bindBlock( block.parents(".thb-column"), cloned_block );

			self.updateData();

			return false;
		};

		this.arrangeSortables = function() {
			$( ".thb-rows-container" ).sortable( {
				distance: 10,
				tolerance: "pointer",
				// containment: "parent",
				// helper: 'clone',
				connectWith: ".thb-rows-container",
				stop: function() {
					self.updateData();
					// return false;
				}
			} );

			$( ".thb-columns-container" ).sortable( {
				distance: 10,
				tolerance: "pointer",
				containment: "parent",
				// helper: 'clone',
				stop: function() {
					self.updateData();
					// return false;
				}
			} );

			$( ".thb-blocks-container" ).sortable( {
				distance: 10,
				connectWith: ".thb-blocks-container",
				forceHelperSize: true,
				// helper: 'clone',
				stop: function( e, ui ) {
					var block = ui.item;

					self.bindBlock( block.parents(".thb-column"), block );
					self.updateData();

					$( ".thb-column" ).each( function() {
						$( this ).removeClass( "empty" );

						if ( ! $( this ).find( ".thb-block" ).length ) {
							$( this ).addClass( "empty" );
						}
					} );

					// return false;
				}
			} );
		}

		this.bindBlock = function( column, block ) {
			// block.off( ".thb_builder" );

			if ( block.data( "bound" ) === true ) {
				return;
			}

			block.data( "bound", true );

			// block.on( "click.thb_builder", function() { return self.editBlock( block ); } );
			block.find( ".thb-block-edit" ).on( "click.thb_builder", function() { return self.editBlock( block ); } );
			block.find( ".thb-block-clone" ).on( "click.thb_builder", function() { return self.cloneBlock( block ); } );
			block.find( ".thb-block-remove" ).on( "click.thb_builder", function() { return self.removeBlock( block ); } );

			self.arrangeSortables();
		};

		this.bindRow = function( section, row ) {
			// row.off( ".thb_builder" );

			if ( row.data( "bound" ) === true ) {
				return;
			}

			row.data( "bound", true );

			this.toggleColumnControlClass( row );

			row.find( ".thb-row-remove" ).on( "click.thb_builder", function() { return self.removeRow( row ); } );
			row.find( ".thb-row-clone" ).on( "click.thb_builder", function() { return self.cloneRow( row ); } );
			row.find( ".thb-row-add-column" ).on( "click.thb_builder", function() {
				return self.addColumn( row, $( this ).data( "size" ) );
			} );

			row.find( ".thb-column" ).each( function() {
				self.bindColumn( row, $( this ) );
			} );

			self.arrangeSortables();
		};

		this.openColumnAppearance = function( column, button ) {
			var title = button.data( "title" ),
				row = column.parents( ".thb-row" ),
				field = column.parents( ".thb-field-section" );

			var modal = new THB_Modal( 'column_appearance', title, function( data, modal ) {
				column.attr( "data-appearance", JSON.stringify( data ) );
				self.updateData();
			} );

			var data = $.deparam( field.find( ".thb-section-data" ).val() );
			var modal_data = {};

			if ( data && data.rows ) {
				modal_data = data.rows[row.index()].columns[column.index()];

				if ( modal_data.appearance ) {
					modal_data = modal_data.appearance;
				}
			}

			modal.open( modal_data );

			return false;
		};

		this.bindColumn = function( row, column ) {
			// column.off( ".thb_builder" );

			if ( column.data( "bound" ) === true ) {
				return;
			}

			column.data( "bound", true );

			column.find( ".thb-column-increase-size" ).on( "click.thb_builder", function() { return self.expandColumn( column ); } );
			column.find( ".thb-column-decrease-size" ).on( "click.thb_builder", function() { return self.reduceColumn( column ); } );
			column.find( ".thb-column-clone" ).on( "click.thb_builder", function() { return self.cloneColumn( column ); } );
			column.find( ".thb-column-appearance" ).on( "click.thb_builder", function() { return self.openColumnAppearance( column, $( this ) ); } );
			column.find( ".thb-column-remove" ).on( "click.thb_builder", function() { return self.removeColumn( column ); } );

			column.find( ".thb-column-select-block-type" ).on( "click.thb_builder", function() {
				var modal = new THB_Modal( 'block_selection', $( this ).data( "title" ), function( data, modal ) {
					self.addBlock( column, data.type );
				} );

				modal.open();

				return false;
			} );

			column.find( ".thb-block" ).each( function() {
				self.bindBlock( column, $( this ) );
			} );

			self.arrangeSortables();
		};

		this.bind = function() {
			field.find( ".thb-section-add-section" ).on( "click", function() {
				return window.thb_builder_add_section(
					field.parents( ".thb-fields-container.duplicable" ).data("container"),
					"section_new",
					$( this )
				);
			} );

			field.find( ".thb-section-add-row" ).on( "click", function() {
				return self.addRow();
			} );

			field.find( ".thb-section-appearance" ).on( "click", function() {
				var title = $( this ).text();

				var modal = new THB_Modal( 'section_appearance', title, function( data, modal ) {
					var $data = field.find( ".thb-section-data" );

					$data.attr( "data-appearance", JSON.stringify( data ) );
					self.updateData();
				} );

				var data = $.deparam( field.find( ".thb-section-data" ).val() );
				var modal_data = {};

				if ( data && data.appearance ) {
					modal_data = data.appearance;
				}

				modal.open( modal_data );

				return false;
			} );

			field.find( ".thb-row" ).each( function() {
				self.bindRow( field, $( this ) );
			} );
		};

		this.updateData = function() {
			var builder_container = $( "#thb-fields-container-thb_builder_rows" ),
				fields = builder_container.find( ".thb-field-section" );

			$.each( fields, function( i, field ) {
				field = $( field );

				var $data = field.find( ".thb-section-data" ),
					data = {
						'rows': [],
						'appearance': {
							'class': '',
							'width': ''
						}
					},
					rows = field.find( ".thb-row" );

				$.each( rows, function( k, row ) {
					var columns = $( row ).find( ".thb-column" ),
						row_data = {
							'columns': []
						};

					$.each( columns, function( i, column ) {
						var blocks = $( column ).find( ".thb-block" ),
							column_data = {
								'size': $( column ).attr( "data-size" ),
								'appearance': $.parseJSON( $( column ).attr( "data-appearance" ) ),
								'blocks': []
							};

						$.each( blocks, function( j, block ) {
							var block_data = $.parseJSON( $( block ).attr( "data-data" ) );

							if ( block_data.is_title !== undefined && block_data.is_title == '1' ) {
								$( block ).addClass( "title_block" );
							}

							column_data['blocks'].push( {
								'data' : block_data,
								'type' : $( block ).attr( "data-type" )
							} );
						} );

						row_data['columns'].push( column_data );
					} );

					data['rows'].push( row_data );
				} );

				var appearance = $.parseJSON( $data.attr( "data-appearance" ) );

				if ( appearance !== null ) {
					data['appearance'] = appearance;
				}

				var param = $.param( data );

				// param = encodeURIComponent( param );
				param = param.replace( /\+/g, '%20' );
				param = param.replace( /\'/g, '%27' );

				$data.val( param );
			} );
		};

		this.bind();

	};

	$.fn.thbSection = function() {
		return this.each(function() {
			$(this).data( "thb-field-section", new THB_Section( $(this) ) );
		});
	};
} )( jQuery );

/**
 * Slide field.
 *
 * @return {jQuery}
 */
(function($) {
	var THB_Slide = function( field ) {

		var self = this;

		/**
		 * Bind the events.
		 */
		this.bind = function() {

			field.find(".thb-btn-edit").on( "click", function( e ) {
				var subtype = $( this ).attr( "data-subtype" ),
					key = $( this ).attr( "data-key" ),
					title = $( this ).attr( "title" );

				self.edit( false, key, subtype, title );
				return false;
			} );

			field.find(".thb-btn-clone").on( "click", function() {
				self.clone_self();
				return false;
			} );

		};

		/**
		 * Clone the slide element.
		 *
		 * @return {boolean}
		 */
		this.clone_self = function() {
			var container = field.parents(".thb-fields-container.duplicable").first().data("container");

			var cloned_slide = field.clone();
			field.after( cloned_slide );

			thb_boot_fields( cloned_slide );

			container.reorderFields();

			return false;
		},

		/**
		 * Edit the slide and open the modal.
		 *
		 * @return {boolean}
		 */
		this.edit = function( new_slide, key, subtype, title ) {

			var modal_key = key + '_edit_slide_' + subtype;

			if ( subtype == "" ) {
				modal_key = key + '_edit';
			}

			var modal = new THB_Modal( modal_key, title, function( data ) {
				$.each( data, function( name, value ) {
					field.find("[data-name='" + name + "']").attr( "value", value );
				} );

				if ( subtype == "video" ) {

					var url = data.id;

					if ( new_slide && url === "" ) {
						field.remove();
						return false;
					}

					$.get(
						ajaxurl,
						{
							action: "thb_image_upload_get_size",
							id: url
						},
						function( prv ) {
							if( prv !== "" ) {
								field.find(".thb-video-preview").removeClass("video");
								field.find(".thb-preview").attr("src", prv);
							}
							else {
								field.find(".thb-video-preview").addClass("video");
							}
						}
					);
				}

			}, function( data ) {
				var url = data.id;

				if ( new_slide && url === "" ) {
					field.remove();
				}

				return false;
			} );

			var modal_data = {};

			field.find("[data-name]").each( function() {
				modal_data[$(this).attr("data-name")] = $(this).attr("value");
			} );

			modal.open( modal_data );

			return false;

		};

		this.bind();

	};

	$.fn.thbSlide = function() {
		return this.each(function() {
			$(this).data( "thb-field-slide", new THB_Slide( $(this) ) );
		});
	};
})(jQuery);

/**
 * Icon picker control.
 *
 * @return {jQuery}
 */
(function($) {
	$.fn.thbIconPicker = function() {
		return this.each(function() {
			$( this ).fontIconPicker({
				source: thb.icons,
				emptyIcon: true,
				hasSearch: true
			});
		});
	}
})( jQuery );

/**
 * Custom multi-selection select control.
 *
 * @return {jQuery}
 */
(function($) {
	$.fn.thbSelectize = function() {
		return this.each(function() {
			var el = $(this),
				template = el.data("template") !== undefined ? el.data("template") : "",
				options = {
					onChange: function( value ) {
						$( el.data("target") ).val( value );
					}
				},
				item_templates = {
					"taxonomy": function( item, escape ) {
						var keys = item.value.split(":"),
						taxonomy_name = keys[0],
						taxonomy = thb.taxonomies[taxonomy_name];

						return '<div class="' + taxonomy_name + '"><span>' + taxonomy.singular + '</span>' + item.text + '</div>';
					}
				};

			if( template ) {
				options["render"] = {
					"item": item_templates[template]
				};
			}

			el.selectize( options );
		});
	};
})(jQuery);

/**
 * Custom checkbox control.
 *
 * @return {jQuery}
 */
(function($) {
	$.fn.thbCheckbox = function() {
		return this.each(function() {

			var el = $(this),
				id = el.attr("id"),
				label = $("label[for='" + id + "']");

			if ( el.val() == "1" ) {
				label.addClass("checked");
			}
			else {
				label.removeClass("checked");
			}

			label
				.on("click", function() {
					if ( el.val() == "1" ) {
						el.val("0");
						label.removeClass("checked");
					}
					else {
						el.val("1");
						label.addClass("checked");
					}

					el.trigger("change");

					return false;
				});
		});
	};
})(jQuery);

/**
 * Custom select control.
 *
 * @return {jQuery}
 */
(function($) {
	$.fn.thbSelect = function() {
		return this.each( function() {
			$( this ).customSelect();

			var select = $( this ),
				custom = select.next( ".customSelect" );

			if ( select.data( "callback" ) != "" ) {
				select.on( "change.thb_select", function() {
					var fn = window[select.data( "callback" )];
					if( typeof fn === 'function' ) {
					    fn( select.val() );
					}
				} );
			}

			$( window ).on( "resize.thb_select", function() {
				select.css( "width", custom.outerWidth() );
				select.css( "height", custom.outerHeight() );
			} );

			setTimeout( function() {
				$( window ).trigger( "resize" );
			}, 10 );
		} );
	};
})(jQuery);

(function($) {
	$.fn.thb_serialize = function() {
		var elements = $(this).find(':input').get(),
			done = [],
			ret = [];

		$.each( elements, function() {
			if (this.name && !this.disabled && (this.checked || /select|textarea/i.test(this.nodeName) || /text|number|hidden|password/i.test(this.type))) {
				var val = $(this).val();

				if( $.inArray(this.name, done) < 0 ) {
					done.push( this.name );
					ret.push( { "name": this.name, "value": val } );
				}
			}
		} );

		return ret;
	};
})(jQuery);

/**
 * Slide
 */
function thb_remove_all_duplicable_items( container, tpl ) {
	container.removeAllFields();

	return false;
}

function thb_add_video_slide( container, tpl, control ) {
	var html = container.addField(tpl),
		key = control.data("key"),
		title = control.data("title");

	html.data( "thb-field-slide" ).edit( true, key, 'video', title );
}

function thb_add_multiple_slides( container, tpl ) {
	var media = new THB_Media();

	media.valorize = function( images ) {
		if( images.length > 0 ) {
			var temp = THB_Template( jQuery( "script[data-tpl='" + tpl + "']" ).html() ),
				template = temp(),
				view_upload = jQuery( template ).find( ".thb-view-upload" ),
				size = view_upload.data( "image-size" );

			container.addLoadingClass();

			jQuery.get(
				ajaxurl,
				{
					action: "thb_images_upload_get_sizes",
					id: _.pluck( images, 'id' ),
					size: size
				},
				function( srcs ) {
					jQuery.each( srcs, function( i ) {
						var html = container.addField(tpl),
							upload_view = html.find(".thb-view-upload"),
							img = this;

						// setTimeout( function() {
							if ( jQuery( upload_view ).data( 'THB_Upload' ) !== undefined ) {
								jQuery( upload_view ).data( 'THB_Upload' ).valorize( img, img.image );
							}
						// }, 100 * i );
					} );

					container.removeLoadingClass();
				}
			);

			// jQuery.each(images, function() {
			// 	var html = container.addField(tpl),
			// 		upload_view = html.find(".thb-view-upload");

			// 	if ( jQuery( upload_view ).data( 'THB_Upload' ) !== undefined ) {
			// 		jQuery( upload_view ).data( 'THB_Upload' ).valorize( this );
			// 	}

			// 	// if( fields.containsKey(el) ) {
			// 		upl = fields.get(el);
			// 		upl.valorize(this);
			// 	// }
			// });
		}
	};

	media.open({
		title: jQuery("[data-action='thb_add_multiple_slides']").data('title'),
		multiple: true
	});
}

/**
 * Gallery
 */
var THB_Gallery = Backbone.View.extend({
	events: {
		'click .thb-btn-upload': 'openMedia'
	},

	initialize: function() {
		this.field = this.$("input");
		this.ids = [];
	},

	openMedia: function( event ) {
		var media = new THB_Media(),
			self = this,
			title = this.$el.data('media-title');

		media.valorize = function( images ) {
			self.field.val('');
			self.ids = [];

			if( images.length > 0 ) {
				jQuery.each(images, function() {
					self.ids.push(this.id);
				});

				self.field.val('[gallery ids="' + self.ids.join() + '"]');
			}
		};

		this.ids = self.field.val().replace(/[A-Za-z= "\[\]]/g, "").split(",");

		if( this.ids.length == 1 && this.ids[0] === '' ) {
			this.ids = [];
		}

		media.open({
			title: title,
			multiple: 'add',
			ids: this.ids
		});

		return false;
	}
});

/**
 * Upload
 */
var THB_Upload = Backbone.View.extend({
	events: {
		'click .thb-upload': 'openMedia',
		'click .thb-upload-remove': 'removeImage'
	},

	initialize: function() {
		this.preview = this.$(".thb-preview");
		this.remove = this.$(".thb-upload-remove");

		if ( this.$el.data("target") == "" ) {
			this.id = this.$(".thb-id");
		}
		else {
			this.id = this.$el.parents(".thb-field").find( this.$el.data("target") );
		}

		if ( this.id.val() != "" && this.preview.attr("src") === "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" ) {
			this.valorize( {
				'id': this.id.val()
			} );
		}
	},

	valorize: function( image, src ) {
		var self = this;
		self.id.val(image.id);
		self.$el.addClass("thb-upload-loading");
		self.$el.removeClass("thb-upload-empty");
		self.remove.show();

		if ( src === undefined ) {
			jQuery.get(
				ajaxurl,
				{
					action: "thb_image_upload_get_size",
					id: image.id,
					size: this.$el.data("image-size")
				},
				function( prv ) {
					if ( self.preview.attr("src") != prv ) {
						self.preview.attr( 'src', prv );
					}

					jQuery.thb.loadImage( self.preview, {
						allLoaded: function() {
							self.$el.removeClass("thb-upload-loading");
						}
					} );
				}
			);
		}
		else {
			if ( self.preview.attr("src") != src ) {
				self.preview.attr( 'src', src );

				jQuery.thb.loadImage( self.preview, {
					allLoaded: function() {
						self.$el.removeClass("thb-upload-loading");
					}
				} );
			}
		}
	},

	removeImage: function( event ) {
		this.preview.attr("src", 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
		this.id.val("");
		this.$el.addClass("thb-upload-empty");

		this.remove.hide();

		return false;
	},

	openMedia: function( event ) {
		var media = new THB_Media(),
			self = this;

		media.valorize = function( images ) {
			if( images.length == 1 ) {
				if( images[0].id == self.id.val() ) {
					return;
				}

				self.removeImage();
				self.valorize(images[0]);
			}
			else {
				self.removeImage();
			}
		};

		media.open({
			title: self.$el.data("title"),
			ids: self.id.val() === '' ? [] : [ self.id.val() ]
		});

		return false;
	}
});

// -----------------------------------------------------------------------------
// $Admin
// -----------------------------------------------------------------------------

if( !jQuery.thb ) {
	jQuery.thb = {};
}

var page = null,
	post = null;
	// fields = new Hashtable();

(function($) {
	"use strict";

	$(document).ready(function() {
		page = new THB_Page();
		post = new THB_Post();

		$.thb.flashdata('');
		$(".thb-message").notices();
		$('.tt[title]').tipTop();
	});

	/**
	 * Notices
	 * -------------------------------------------------------------------------
	 */
	$.fn.notices = function() {
		return this.each(function() {
			var el = $(this),
				key = $(this).data("message-key"),
				nonce = $(this).data("nonce"),
				discard_btn = $(this).find(".thb-discard-message");

			discard_btn.on("click", function() {
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'thb_system_discard_message',
						THB_nonce: nonce,
						key: key
					}
				});

				el.remove();

				return false;
			});
		});
	};

	/**
	 * Flashdata messages
	 * -------------------------------------------------------------------------
	 */
	$.thb.flashdata = function( message, args ) {
		args = $.extend({
			'type': 'success',
			'delay': 1500,
			'transition': 150
		}, args);

		var msg = $('.thb-msg-container');

		if( msg.data('type') !== '' ) {
			args.type = msg.data('type');
		}

		if( msg.data('message') !== '' ) {
			message = msg.data('message');
		}

		if( message === '' ) {
			return;
		}

		msg
			.attr('data-type', args.type)
			.addClass('on')
			.html('<div class="thb-msg"><p>' + message + '</p></div>')
			.fadeIn(args.transition)
			.delay(args.delay)
			.fadeOut(args.transition, function() {
				msg
					.html('')
					.attr('data-type', '')
					.attr('data-message', '')
					.removeClass('on');
			});
	};

	/**
	 * Translations
	 * -------------------------------------------------------------------------
	 */
	$.thb.translate = function( key ) {
		if( thb.strings[key] ) {
			return thb.strings[key];
		}

		return key;
	};

})(jQuery);

/**
 * Tabs
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_tabs = function( parameters ) {
		parameters = jQuery.extend({
			nav: '.thb-tabs-nav',
			tabContents: '.thb-tabs-contents',
			contents: '.thb-tab-content',
			openClass: 'open',
			speed: 350,
			easing: 'swing'
		}, parameters);

		return this.each(function() {
			if ( $( this ).data( "thb-tabs" ) !== undefined ) {
				return;
			}

			$( this ).data( "thb-tabs", true );

			var container = $(this),
				nav = container.find(parameters.nav),
				triggers = nav.find('a'),
				tabContents = container.find(parameters.tabContents),
				contents = container.find(parameters.contents);

			container.bind('thb_tabs.goto', function(e, i) {
				triggers.parent().removeClass(parameters.openClass);
				triggers
					.eq(i)
					.parent()
					.addClass(parameters.openClass);

				contents
					.hide()
					.eq(i)
						.show();

				jQuery( window ).on( "resize", function() {
					tabContents.css('min-height', 0);
					if ( container.parents( ".thb-metabox" ).length ) {
						tabContents.css( 'min-height', container.parents( ".thb-metabox" ).outerHeight() );
					}
					else if ( container.parents( ".thb-modal-content-inner" ).length ) {
						tabContents.css( 'min-height', container.parents( ".thb-modal-content-inner" ).outerHeight() );
					}
					else {
						tabContents.css('min-height', nav.outerHeight());
					}
				} );

				setTimeout( function() {
					jQuery("textarea.code").trigger("refresh");
					jQuery( window ).trigger( "resize" );
				}, 5 );
			});

			triggers.each(function(i, el) {
				$(this).click(function() {
					container.trigger('thb_tabs.goto', [i]);
					return false;
				});
			});

			/**
			 * Init
			 */
			var idx = 0;

			if ( container.data('open') !== undefined ) {
				idx = parseInt( container.data('open'), 10 );
			}

			container.trigger('thb_tabs.goto', [idx]);
		});
	};

})(jQuery);

/**
 * Toggle
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_toggle = function( parameters ) {
		parameters = jQuery.extend({
			speed: 350,
			easing: 'swing',
			trigger: '.thb-toggle-trigger',
			content: '.thb-toggle-content',
			openClass: 'open',
			before: function() {},
			after: function() {}
		}, parameters);

		return this.each(function() {
			var container = $(this),
				trigger = container.find(parameters.trigger),
				content = container.find(parameters.content);

			/**
			 * Toggle data
			 */
			this.toggle_speed = parameters.speed;
			this.toggle_easing = parameters.easing;
			container.toggle_open = container.hasClass(parameters.openClass);

			/**
			 * Open the toggle
			 */
			container.bind('thb_toggle.open', function() {
				container.addClass(parameters.openClass);
				content.slideDown(this.toggle_speed, this.toggle_easing);
				container.toggle_open = true;
			});

			/**
			 * Close the toggle
			 */
			container.bind('thb_toggle.close', function() {
				container.removeClass(parameters.openClass);
				content.slideUp(this.toggle_speed, this.toggle_easing);
				container.toggle_open = false;
			});

			/**
			 * Before
			 */
			container.bind('thb_toggle.before', parameters.before);

			/**
			 * After
			 */
			container.bind('thb_toggle.after', parameters.after);

			/**
			 * Events
			 */
			trigger.click(function() {
				container.trigger('thb_toggle.before');
				container.trigger( container.toggle_open ? 'thb_toggle.close' : 'thb_toggle.open' );
				container.trigger('thb_toggle.after');

				return false;
			});

			/**
			 * Init
			 */
			if( container.toggle_open ) {
				content.show();
			}
		});
	};

	$(document).ready(function() {
		$('.thb-toggle').thb_toggle();
	});

})(jQuery);

/**
 * Accordion
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_accordion = function( parameters ) {
		parameters = jQuery.extend({
			toggle: '.thb-toggle',
			speed: 350,
			easing: 'swing'
		}, parameters);

		return this.each(function( i, el ) {
			var container = $(this),
				items = container.find(parameters.toggle);

			items.each(function() {
				$(this).bind('thb_toggle.before', function() {
					this.toggle_speed = parameters.speed;
					this.toggle_easing = parameters.easing;

					items.not( $(this) ).each(function() {
						$(this).trigger('thb_toggle.close');
					});
				});
			});
		});
	};

	$(document).ready(function() {
		$('.thb-accordion').thb_accordion();
	});

})(jQuery);

/**
 * Autoselect
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.fn.selectText = function() {
		var doc = document,
			element = this[0],
			range,
			selection;

		if ( doc.body.createTextRange ) {
			range = document.body.createTextRange();
			range.moveToElementText(element);
			range.select();
		}
		else if ( window.getSelection ) {
			selection = window.getSelection();
			range = document.createRange();
			range.selectNodeContents(element);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	};
})(jQuery);