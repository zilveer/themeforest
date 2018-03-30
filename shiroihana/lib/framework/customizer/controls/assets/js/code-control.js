
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize;
	if( api ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.CodeControl = api.Control.extend({
			ready: function() {

				var control = this, 
					editor  = control.container.find( 'textarea' ), 
					editorInstance;

				if( editor.length ) {
				
					editorInstance = CodeMirror.fromTextArea( editor[0], {
						mode: control.params.mode, 
						addModeClass: true, 
						lineNumbers: true
					});

					editorInstance.setSize( null, 150 );

					editorInstance.on( 'change', function( instance, changeObj ) {
						control.setting.set( editorInstance.getValue() );
					});

					api.section( control.section(), function( section ) {
						section.container.on( 'expanded', function() {
							editorInstance.refresh();
						});
					});
				}
			}
		});

		$.extend( api.controlConstructor, { youxi_code: api.Youxi.CodeControl });
	}

})( window.wp, jQuery );