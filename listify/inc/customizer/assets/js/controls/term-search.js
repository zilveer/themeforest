/* global wp, jQuery */
(function(exports, $){
	var api = wp.customize;

	/**
	 * Create a setting and control dynamically
	 *
	 * @since 1.5.0
	 * @param {object} args
	 */
	var createControl = function( args ) {
		var defaults = {
			base: api.Control,
			term: {}, 
			fresh: true,
		}

		var args = _.defaults( args, defaults );

		var term = args.term;
		var type = args.base.params.type;
		var section = api.section( args.base.section() );

		/**
		 * If no setting exists, create one.
		 *
		 * If the data is not fresh, set the value here, otherwise allow it to be set later.
		 */
		if ( ! api.has( term.key ) ) {
			var setting = api.create( term.key, term.key, ( ! args.fresh ? term.value : '' ), {
				previewer: api.previewer,
				transport: false,
				dirty: false
			} );
		} 

		/**
		 * If no control exist, create one.
		 */
		if ( ! api.control.has( term.key ) ) {
			// we have to add our own container
			var controlContainer = section.container.append( 
				$( '<li/>' )
					.addClass( 'customize-control' )
					.addClass( 'customize-control-edit-term-' + type )
					.attr( 'id', 'customize-control-' + term.key )
			);

			// currently supported edit control types
			var typeConstructor = {
				'TermColors': 'EditColorControl',
				'TermIcons': 'EditIconControl'
			}

			var constructor = api[ typeConstructor[ type ] ];

			// create a control 
			var control = new constructor( term.key, {
				params: {
					section: section.id,
					type: 'edit-term-' + type,
					priority: 99,
					settings: {
						'default': term.key
					},

					key: term.key,
					value: term.value,
					label: term.label
				},
				previewer: api.previewer
			} );

			// add to the api
			api.control.add( term.key, control );
		}

		// set the value. If previously set it will not change and be marked dirty
		api( term.key ).set( term.value );
	}

	/**
	 * Edit Term Control
	 *
	 * Generic control for editing a term that contains associated information.
	 * Automatically binds a removal method, but handling additional instantiation
	 * on addition of a control should be be added in an extending Control.
	 *
	 * @since 1.5.0
	 */
	api.EditTermControl = api.Control.extend({
		/**
		 * When the control has been embedded in to the section.
		 *
		 * @since 1.5.0
		 * @param {int} id
		 * @param {Array} options
		 */
		ready: function( id, options ) {
			var control = this;

			_.bindAll( control, 'removeControl' );

			control.container.on( 'click', '.js-listify-remove-term', control.removeControl );
		},

		/**
		 * Remove the control.
		 *
		 * WordPress can't completely remove a theme mod once it has been set.
		 * So the setting just needs to be set to any empty string.
		 */
		removeControl: function() {
			var control = this;

			control.setting.set( '' );
			api.control.remove( control.id );
			control.container.remove();
		}

	});

	/**
	 * Edit Color Control
	 *
	 * @since 1.5.0
	 */
	api.EditColorControl = api.EditTermControl.extend({
		/**
		 * When the control has been embedded in to the section.
		 *
		 * @since 1.5.0
		 * @param {int} id
		 * @param {Array} options
		 */
		ready: function( id, options ) {
			api.EditTermControl.prototype.ready.apply( this, id, options );

			var control = this;

			// create the color picker control
			api.ColorControl.prototype.ready.apply( this, id, options );
		} 
	});

	/**
	 * Edit Icon Control
	 *
	 * @since 1.5.0
	 */
	api.EditIconControl = api.EditTermControl.extend({
		ready: function( id, options ) {
			api.EditTermControl.prototype.ready.apply( this, id, options );

			var control = this;

			// create the BigChoice control
			control.$iconSearch = control.container.find( '.search-icons' );
			api.BigChoices.setupChoices( control.$iconSearch, 'icons', control.setting() );

			control.$iconSearch.on( 'select2:select', function() {
				control.setting.set( control.$iconSearch.val() );
			} );

			this.setting.bind( function( value ) {
				control.$iconSearch.val( value ).trigger( 'change' );
			});
		}
	});

	/**
	 * Search for terms and associate data with them
	 *
	 * This control does not do anything by itself and should
	 * only be used as a base to associate different information with a term.
	 *
	 * @since 1.5.0
	 */
	api.TermSearchControl = api.Control.extend({
		/**
		 * When the control has been embedded in to the section.
		 *
		 * @since 1.5.0
		 * @param {int} id
		 * @param {Array} options
		 */
		ready: function( id, options ) {
			api.Control.prototype.ready.apply( this, id, options );

			var control = this;

			// move some parameters to the root object
			control.$search = control.container.find( '.search-terms' );
			control.placeholder = control.params.placeholder;
			control.taxonomy = control.params.taxonomy;
			control.options = control.params.options;

			// add each of the existing terms
			_.each( control.params.existing_terms, function( term, index ) {
				createControl({
					term: term, 
					base: control,
					fresh: false 
				});
			});

			// add a way to search terms
			control.addSearch();

			_.bindAll( control, 'addControl' );
			control.container.on( 'click', '.js-listify-add-term', control.addControl );
		},

		/**
		 * AJAX term searching.
		 *
		 * Using select2 create a searchable select box that returns relevant results.
		 *
		 * @since 1.5.0
		 */
		addSearch: function() {
			var control = this;

			// this only looks nasty...
			control.$search.select2({
				placeholder: control.placeholder,
				width: '100%',
				allowClear: true,
				delay: 250,
				ajax: {
					cache: true,
					url: ajaxurl,
					dataType: 'json',
					type: 'POST',
					data: function( term ) {
						return {
							q: term,
							action: 'listify_search_terms',
							taxonomy: control.taxonomy,
							options: control.options
						};
					},
					processResults: function (data) {
						var terms = data.data;

						return {
							results: terms
						};
					}
				}
			});
		},
	});

	/**
	 * Icon Search
	 * 
	 * @see api.TermSearchControl
	 * @sine 1.5.0
	 */
	api.controlConstructor.TermIcons = api.TermSearchControl.extend({
		/**
		 * When the control has been embedded in to the section.
		 *
		 * @since 1.5.0
		 * @param {int} id
		 * @param {Array} options
		 */
		ready: function( id, options ) {
			api.TermSearchControl.prototype.ready.apply( this, id, options );

			var control = this;

			control.addIconSelection();
		},

		/**
		 * Icon selection.
		 *
		 * The value of this field is used as the associated data with the term.
		 *
		 * @see api.BigChoices
		 * @since 1.5.0
		 */
		addIconSelection: function() {
			var control = this;

			control.$iconSearch = control.container.find( '.search-icons-' + control.taxonomy );

			// add choices to input
			api.BigChoices.setupChoices( control.$iconSearch, 'icons', 'information-circled' );
		},

		/**
		 * Add a control based on selections.
		 *
		 * @since 1.5.0
		 */
		addControl: function() {
			var control = this;

			var icon = control.$iconSearch.val();
			var terms = $( control.$search ).find( 'option:selected' );

			$.each(terms, function() {
				var term = {
					key: 'listings-' + control.taxonomy + '-' + $(this).val() + '-icon',
					value: icon,
					label: $(this).text()
				}

				createControl({
					base: control,
					term: term, 
					fresh: true
				});
			});
		}
	});

	/**
	 * Color Search
	 * 
	 * @see api.TermSearchControl
	 * @sine 1.5.0
	 */
	api.controlConstructor.TermColors = api.TermSearchControl.extend({
		/**
		 * When the control has been embedded in to the section.
		 *
		 * @since 1.5.0
		 * @param {int} id
		 * @param {Array} options
		 */
		ready: function( id, options ) {
			api.TermSearchControl.prototype.ready.apply( this, id, options );

			var control = this;

			control.addSearch();
			control.addColorPicker();
		},

		/**
		 * Color selection.
		 *
		 * The value of this field is used as the associated data with the term.
		 *
		 * @see api.BigChoices
		 * @since 1.5.0
		 */
		addColorPicker: function() {
			var control = this;

			control.picker = control.container.find( '.color-picker-hex' );
			control.picker.wpColorPicker();
		},

		/**
		 * Add a control based on selections.
		 *
		 * @since 1.5.0
		 */
		addControl: function() {
			var control = this;

			var color = control.picker.wpColorPicker( 'color' );
			var terms = $( control.$search ).find( 'option:selected' );

			$.each(terms, function() {
				var term = {
					key: 'marker-color-' + $(this).val(),
					value: color,
					label: $(this).text()
				}

				createControl({
					base: control,
					term: term,
					fresh: true
				});
			});
		}
	});

})(wp, jQuery);
