
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize, 
		Fonts = _youxiCustomizeGoogleFonts || {};

	if( api ) {

		api.Youxi = api.Youxi || {};

		api.Youxi.GoogleFontControl = api.Control.extend({

			createOption: function( variant ) {
				return $( '<option />' ).attr( 'value', variant ).text( variant );
			}, 

			createCheckbox: function( subset ) {
				return $( '<label />' ).html( '<input type="checkbox" value="' + subset + '">' + subset + '<br>' );
			}, 

			getValue: function() {

				var control = this, 
					value = [], 
					family = control.family.val(), 
					variant = control.variant.val(), 
					subsets = control.subsets.find( ':checkbox:checked' ).map(function() {
						return this.value;
					}).get();

				if( family ) {

					value.push( family );
					if( variant ) {
						value.push( variant );
					}

					subsets = subsets.length ? '&subset=' + subsets.join( ',' ) : '';

					return value.join( ':' ) + subsets;
				}

				return '';
			}, 

			updateVariants: function( family ) {

				var control = this, t;

				control.variant.children().first().nextAll().remove();

				if( t = !! ( family && Fonts[ family ] ) ) {
					control.variant.append( _.map( Fonts[ family ].variants || [], control.createOption ) );
				}
				control.variant.prop( 'disabled', ! t ).toggle( t );
			}, 

			updateSubsets: function( family ) {

				var control = this, t;

				control.subsets.empty();

				if( t = !! ( family && Fonts[ family ] ) ) {
					control.subsets.html( _.map( Fonts[ family ].subsets || [], control.createCheckbox ) );
				}
				control.subsets.toggle( t );
			}, 

			ready: function() {

				var control = this;

				control.family  = control.container.find( '.youxi-google-font-family' );
				control.variant = control.container.find( '.youxi-google-font-variant' );
				control.subsets = control.container.find( '.youxi-google-font-subsets' );

				control.dropdowns = control.family.add( control.variant );

				control.family.on( 'change', function() {
					if( control.currentFamily != this.value ) {
						control.currentFamily = this.value;
						control.updateVariants( this.value );
						control.updateSubsets( this.value );
					}
				});

				control.dropdowns.on( 'change', function() {
					control.setting.set( control.getValue() );
				});

				control.subsets.on( 'change', ':checkbox', function() {
					control.setting.set( control.getValue() );
				});
			}

		}, { Fonts: Fonts } );

		$.extend( api.controlConstructor, { youxi_google_font: api.Youxi.GoogleFontControl });
	}

})( window.wp, jQuery );