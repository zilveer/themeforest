
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize;
	if( api ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.MulticheckControl = api.Control.extend({
			ready: function() {
				var control = this, 
					checkboxes = this.container.find( '.youxi-multicheck-checkboxes' ).show().find( ':checkbox' ), 
					select = this.container.find( 'select' ).hide();

				control.container.on( 'change', '.youxi-multicheck-checkboxes :checkbox', function() {
					var currentIndex = checkboxes.index( this ), val;

					select.children( 'option' ).eq( currentIndex )
						.prop( 'selected', this.checked );

					val = select.val();
					control.setting.set( _.isNull( val ) ? [] : val );
				});
			}
		});

		$.extend( api.controlConstructor, { youxi_multicheck: api.Youxi.MulticheckControl });
	}

})( window.wp, jQuery );