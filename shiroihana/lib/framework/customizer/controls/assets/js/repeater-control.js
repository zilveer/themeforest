
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize;
	if( api ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.RepeaterControl = api.Control.extend({

			add: function() {
				var control = this, 
					template, params;

				if ( 0 !== $( '#tmpl-' + control.templateSelector ).length ) {
					template = wp.template( control.templateSelector );
					if ( template && control.list ) {
						params = _.extend( {}, control.params, {
							index: control.index++, 
							title_template: control.titleTemplate
						});
						control.list.append( template( params ) );
					}
				}

				control.updateItems();
				control.toggle( control.items.last() );
				control.update();
			}, 

			remove: function( item ) {
				var control = this;

				item.remove();

				control.updateItems();
				control.update();
			}, 

			update: function() {
				var control = this, 
					settings = [], 
					order = control.list.sortable( 'toArray', { attribute: 'data-index' } ), 
					data = control.list.find( ':input' ).serializeJSON();

				if( data && data[ control.params.item_key ] ) {

					data = data[ control.params.item_key ];
					_.each( order, function( index ) {
						if( data[ index ] ) {
							settings.push( data[ index ] );
						} else {
							settings.push( control.params.item_defaults );
						}
					});
				}

				control.setting.set( settings );
			}, 

			updateTitle: function( item ) {
				var control = this, 
					index = $( item ).data( 'index' ), 
					data  = $( item ).find( ':input' ).serializeJSON();

				if( ( data = data[ control.params.item_key ] ) && ( data = data[ index ] ) ) {
					$( item ).find( '.youxi-repeater-control-item-title h4' ).html( control.titleTemplate( data ) );
				}
			}, 

			updateItems: function() {
				var control = this;
				control.list.sortable( 'refresh' );
				control.items = control.list.find( '.youxi-repeater-control-item' );
			}, 

			toggle: function( item ) {

				var control = this;
				var $inside = $( item ).find( '.youxi-repeater-control-item-inside' );

				if( $inside.is( ':visible' ) ) {
					control.collapseItem( item );
				} else {
					control.collapseItem( control.items.not( item ) );
					control.expandItem( item );
				}

			}, 

			collapseItem: function( item ) {
				$( item ).find( '.youxi-repeater-control-item-inside' )
					.slideUp( 'fast' );
			}, 

			expandItem: function( item ) {
				$( item ).find( '.youxi-repeater-control-item-inside' )
					.slideDown( 'fast' );
			}, 

			getItem: function( item ) {
				return $( item ).closest( '.youxi-repeater-control-item' );
			}, 

			renderContent: $.noop, 

			ready: function() {

				if( ! $.fn.serializeJSON || ! $.fn.sortable ) {
					return;
				}

				var control = this;

				_.bindAll( control, 'update', 'add', 'remove', 'toggle', 'updateTitle' );

				/* Cache elements */
				control.list   = control.container.find( '.youxi-repeater-control-list' );
				control.items  = control.list.find( '.youxi-repeater-control-item' );
				control.index  = control.items.length;

				/* Create title template */
				control.titleTemplate = _.template( control.params.item_title, null, {
					evaluate:    /<#([\s\S]+?)#>/g,
					interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
					escape:      /\{\{([^\}]+?)\}\}(?!\})/g,
					variable:    'data'
				});
				
				/* Initialize sortable */
				control.list.sortable({
					axis: 'y', 
					items: '.youxi-repeater-control-item', 
					update: control.update
				});

				/* Update title for existing items */
				_.each( control.items, control.updateTitle );

				/* Bind events */
				control.container.on( 'change', ':input', function() {
					control.updateTitle( control.getItem( this ) );
					control.update();
				});
				control.container.on( 'click', '.youxi-repeater-control-add-item', function(e) {
					control.add();
					e.preventDefault();
				});
				control.container.on( 'click', '.youxi-repeater-control-remove-item', function(e) {
					control.remove( control.getItem( this ) );
					e.preventDefault();
				});
				control.container.on( 'click', '.youxi-repeater-control-item-top', function(e) {
					control.toggle( control.getItem( this ) );
					e.preventDefault();
				});

			}

		});

		$.extend( api.controlConstructor, { youxi_repeater: api.Youxi.RepeaterControl });
	}

})( window.wp, jQuery );