var tinymce, tinyMCE, tb_show, tb_remove;

(function() {

		tinymce.create( 'tinymce.plugins.ebShortcode', {
			init : function( ed, url ) {
				ed.addButton('ebShortcode', {
				title : "Create shortcode",
				onclick : function() {
					tb_show( 'Shortcode Helper', '#TB_inline?inlineId=eb-shortcode-helper' );
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Elderberry Shortcode Helper",
				author : 'Elderberry'
			};
		}
	});

	tinymce.PluginManager.add( 'ebShortcode', tinymce.plugins.ebShortcode );

})();

jQuery( document ).ready( function(){
	jQuery( '.eb-shortcode-helper' ).submit( function( e ){
		e.preventDefault();
		var display_content = '';
		var shortcode = jQuery( '#shortcode-field' ).val();
		var example = jQuery( '.eb-shortcode-helper .shortcode-list li[data-shortcode="'+shortcode+'"] .shortcode-example' ).html();

		if( typeof example === 'undefined' || example === '' || example === null || jQuery( '.eb-shortcode-helper .shortcode-list li[data-shortcode="'+shortcode+'"] .shortcode-example' ).length === 0  ) {

			var parameter_fields = jQuery( '.eb-shortcode-helper .eb-shortcode-parameters-' + shortcode + ' input' );
			var parameters = '';

			jQuery.each( parameter_fields, function() {
				parameters = parameters + ' ' + jQuery( this ).attr( 'name' ) + '="' + jQuery(this).val() + '"';
			});

			display_content = shortcode + ' ' + parameters;


			if ( '' === tinyMCE.activeEditor.selection.getContent() ){
				tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[' + display_content + ']' );

			}
			else {
				tinyMCE.activeEditor.execCommand( 'mceReplaceContent', false, ' [' + display_content + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + shortcode + '] ' );
			}


		}
		else {

			display_content = example;

			if ( '' === tinyMCE.activeEditor.selection.getContent() ){
				tinyMCE.activeEditor.execCommand( 'mceInsertContent', false,  display_content  );

			}
			else {
				tinyMCE.activeEditor.execCommand( 'mceReplaceContent', false,
					display_content);
			}

		}




		jQuery( '.eb-shortcode-helper .eb-shortcode-parameters' ).hide();

		jQuery.each( jQuery( '.eb-shortcode-helper .eb-shortcode-parameters input' ), function() {
			jQuery( this ).val( jQuery( this ).attr( 'data-value' ) );
			jQuery( '.eb-shortcode-helper .eb-shortcode-parameters' ).hide();
		});
		jQuery( '#shortcode-field').val( '' );
		tb_remove();
	});

	jQuery( '.eb-shortcode-helper .shortcode-list li' ).click (function(){
		var shortcode_name = jQuery(this).find('.shortcode-name').text();
		jQuery( '#shortcode-field' ).val( shortcode_name );
		jQuery( '.eb-shortcode-helper .eb-shortcode-parameters' ).hide();
		jQuery.each( jQuery( '.eb-shortcode-helper .eb-shortcode-parameters input' ), function() {
			jQuery( this ).val( jQuery( this ).attr( 'data-value' ) );
		});
		jQuery( '.eb-shortcode-helper .eb-shortcode-parameters-' + shortcode_name ).show();
	});
});
