(function( $ ) {
	"use strict";

	/**
	 * An object which inits the Spotlights widget
	 * @type {{init}}
	 */
	var GroupPanelWidget = (function() {
		
		function init() {
			if ( typeof wp.customize !== 'undefined' ) {
				$( document ).on( 'widget-added', function (ev) {
					make_widget_sortable( true );
				} );
			} else {
				make_widget_sortable( false );
			}

			$( document ).on( 'click', '.add_spotlights', function( event ) {
				var $parent = $( this ).parents( '.group_panel_widget_wrapper' ),
					tmpl = $( '#spotlight_template' ).html(),
					$list = $( this ).siblings( '.group_panel_widget_list' );

				// get the current number of widgets
				var number_of_spotlights = $parent.find( '.group_panel_widget_list > .group_panel_widget_spotlight' ).length;

				tmpl = tmpl.replace( /\{\{\{counter\}\}\}/g, number_of_spotlights );

				$list.append( tmpl );
			} );

			$( document ).on( 'input', '.group_panel_widget_list input, .group_panel_widget_list textarea', function() {
				var $this_container = $( this ).parents( '.group_panel_widget_wrapper' ),
					$spotlights_list = $( this ).parents( '.group_panel_widget_list' ),
					values = get_fields_values( $spotlights_list ),
					jsoned = JSON.stringify( values ),
					$values_holder = $this_container.find( '.spotlight_values' );

				$values_holder.val( jsoned );
			});

			init_image_uploader();
		}

		var make_widget_sortable = function( customizer ){
			// first, add our classes to our widgets
			$('.group_panel_widget_wrapper').parents('.widget').addClass('group_panel_widget');

			var sortable_args = {
				connectWith: ".group_panel_widget_spotlight",
				handle: ".drag_here",
				cancel: ".portlet-toggle",
				placeholder: "portlet-placeholder"
			};

			// notify the customizer api about this change
			if ( customizer ) {
				sortable_args.update = function(ev, ui) {

					$( ev.currentTarget ).sortable( "refreshPositions" );

					var $this_container = $( ev.currentTarget ).parents( '.group_panel_widget_wrapper' ),
						values = get_fields_values( $(ev.currentTarget) ),
						jsoned = JSON.stringify( values ),
						$values_holder = $this_container.find( '.spotlight_values' );

					$values_holder.val( jsoned );

					$('.spotlight_values').trigger('input');
					wp.customize.previewer.refresh();
				};
			}

			$(".group_panel_widget_list")
				.sortable( sortable_args )
				.on('sortupdate',function(){
					//console.log('update called');
				});
		};

		var get_fields_values = function( $el ) {
			var values = {},
				$fields = $el.find( '.group_panel_widget_spotlight' );

			if ( $fields.length > 0 ) {
				$fields.each( function( i, field ) {

					var count = $(this).data('count' ),
						$inputs = $( field ).find( 'input, textarea' );

					count = parseInt( count );

					var data = {};

					$inputs.each(function( j, input){
						var field_name = $( input ).data( 'field' );
						data[ field_name ] = $( input ).val();
					});

					values[i] = data;
				} );
			}

			return values;
		};

		var init_image_uploader = function () {

			var ListableSpotlightsWidget = typeof window.ListableSpotlightsWidget === 'undefined' ? {} : window.ListableSpotlightsWidget,
				Attachment = wp.media.model.Attachment,
				frames = [],
				imageControl, l10n;

			// Link any localized strings.
			l10n = ListableSpotlightsWidget.l10n = typeof ListableSpotlightsWidget.l10n === 'undefined' ? {} : ListableSpotlightsWidget.l10n;

			/**
			 * imageControl module object.
			 */
			imageControl = function( el, options ) {
				var defaults, settings;

				this.$el = $( el );

				// Search within the context of the control.
				this.$target = this.$el.find( "." + this.$el.attr( 'data-target' ) );

				defaults = {
					frame: {
						id: 'listable-spotlights-widget',
						title: l10n.frameTitle,
						updateText: l10n.frameUpdateText,
						multiple: false
					},
					mediaType: 'image',
					returnProperty: 'id'
				};

				options = options || {};
				options.frame = options.frame || {};
				this.settings = _.extend( {}, defaults, options );
				this.settings.frame = _.extend( {}, defaults.frame, options.frame );

				/**
				 * Initialize a media frame.
				 *
				 * @returns {wp.media.view.MediaFrame.Select}
				 */
				this.frame = function() {
					var frame = frames[ this.settings.frame.id ];

					if ( frame ) {
						frame.control = this;
						return frame;
					}

					frame = wp.media({
						title: this.settings.frame.title,
						library: {
							type: this.settings.mediaType
						},
						button: {
							text: this.settings.frame.updateText
						},
						multiple: this.settings.frame.multiple
					});

					frame.control = this;
					frames[ this.settings.frame.id ] = frame;

					// Update the selected image in the media library based on the image in the control.
					frame.on( 'open', function() {
						var selection = this.get( 'library' ).get( 'selection' ),
							attachment, ids;

						if ( frame.control.$target.length ) {
							ids = frame.control.$target.val();
							if ( ids && '' !== ids && -1 !== ids && '0' !== ids ) {
								attachment = Attachment.get( ids );
								attachment.fetch();
							}
						}

						selection.reset( attachment ? [ attachment ] : [] );
					});

					// Update the control when an image is selected from the media library.
					frame.state( 'library' ).on( 'select', function() {
						var selection = this.get( 'selection' );
						frame.control.setAttachments( selection );
						frame.control.$el.trigger( 'selectionChange.listablespotlightswidget', [ selection ] );
					});

					return frame;
				};

				/**
				 * Set the control's attachments.
				 *
				 * @param {Array} attachments An array of wp.media.model.Attachment objects.
				 */
				this.setAttachments = function( attachments ) {
					// Insert the selected attachment id into the target element.
					if ( this.$target.length ) {
						this.$target.val( attachments.pluck( 'id' ) ).trigger( 'input' );
					}
				};
			};

			_.extend( ListableSpotlightsWidget, {
				/**
				 * Retrieve a media selection control object.
				 *
				 * @param {Object} el HTML element.
				 *
				 * @returns {Control}
				 */
				getControl: function( el ) {
					var control, $control;

					$control = $( el ).closest( '.listable-spotlights-widget-image-control' );
					control = $control.data( 'media-control' );

					if ( ! control ) {
						control = new imageControl( $control );
						$control.data( 'media-control', control );
					}

					return control;
				}
			});

			$(function(){
				var $container = $( '.widgets-holder-wrap, .editwidget, .wp-core-ui' );

				// Open the media library frame when the button or image are clicked.
				$container.on( 'click', '.listable-spotlights-widget-image-control__choose, .listable-spotlights-widget-form img', function( e ) {
					e.preventDefault();
					ListableSpotlightsWidget.getControl( this ).frame().open();
				});

				// Update the image preview in the widget when an image is selected.
				$container.on( 'selectionChange.listablespotlightswidget', function( e, selection ) {
					var $control = $( e.target ),
						model = selection.first(),
						sizes = model.get( 'sizes' ),
						size, image;

					if ( sizes ) {
						size = sizes.medium || sizes.thumbnail; //default to thumbnail if medium is not available
					}

					size = size || model.toJSON();
					image = $( '<img />', { src: size.url });

					$control.find( 'img' ).remove().end()
						.prepend( image )
						.addClass( 'has-image' );
				});
			});
		};

		return {
			init: init
		}
	})();

	$( document ).ready( function() {
		GroupPanelWidget.init();
	} );

})( jQuery );