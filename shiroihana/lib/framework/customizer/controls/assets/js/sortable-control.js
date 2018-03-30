
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize;
	if( api ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.SortableControl = api.Control.extend({

			update: function() {
				var control = this, 
					checkbox, 
					setting = {};

				setting.order = control.items.sortable( 'toArray', { attribute: 'data-value' } );
				setting.values = $.map( setting.order || [], function( value ) {
					checkbox = control.checkboxes && control.checkboxes[ value ];
					if( ! control.params.togglable || ! checkbox || checkbox.checked ) {
						return value;
					}
				});

				control.setting.set( setting );
			}, 

			ready: function() {

				var control = this, v;
				control.items = control.container.find( '.youxi-sortable-container' );

				if( control.items.length && $.fn.sortable ) {

					if( control.params.togglable ) {
						control.checkboxes = {};
						control.items.find( '.youxi-sortable-item :checkbox' ).each(function() {
							v = $( this ).closest( '.youxi-sortable-item' ).data( 'value' );
							v && ( control.checkboxes[ v ] = this );
						});
						control.container.on( 'change', '.youxi-sortable-item :checkbox', _.bind( control.update, this ) );
					}

					control.items.sortable({
						axis: 'y', 
						items: '.youxi-sortable-item', 
						update: _.bind( control.update, this )
					});
				}
			}
		});

		$.extend( api.controlConstructor, { youxi_sortable: api.Youxi.SortableControl });
	}

})( window.wp, jQuery );