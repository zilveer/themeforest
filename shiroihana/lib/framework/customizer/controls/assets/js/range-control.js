
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize;
	if( api ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.RangeControl = api.Control.extend({
			ready: function() {
				var control = this, 
					params = $.extend( true, {}, control.params.ui || {}, {
						value: control.setting(), 
						change: function( event, ui ) {
							control.setting.set( ui.value );
						}, 
						slide: function( event, ui ) {
							control.setting.set( ui.value );
						}
					});

				if( $.fn.slider ) {
					$( '.youxi-range-control', this.container )
						.slider( params );
				}
			}
		});

		$.extend( api.controlConstructor, { youxi_range: api.Youxi.RangeControl });
	}

})( window.wp, jQuery );