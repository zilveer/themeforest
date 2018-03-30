
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize;
	if( api ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.SwitchControl = api.Control.extend({
			ready: function() {
				var control = this.container.find( ':checkbox' );
				if( control.length && typeof Switchery !== 'undefined' ) {
					new Switchery( control.get(0) );
				}
			}
		});

		$.extend( api.controlConstructor, { youxi_switch: api.Youxi.SwitchControl });
	}

})( window.wp, jQuery );