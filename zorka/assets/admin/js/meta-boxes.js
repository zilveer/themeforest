/**
 * Created by Administrator on 9/3/14.
 */
jQuery(function($){
	g5plus_meta_boxes =  {
		htmlTag : {
		},
		vars : {
			prefix :'g5plus-'
		},
		init : function() {
			g5plus_meta_boxes.processPostFormat();
			g5plus_meta_boxes.checkboxToggle();
		},
		processPostFormat : function() {
			var $cbxPostFormats = $( 'input[name=post_format]' );
			var $meta_boxes = $('[id^="'+ g5plus_meta_boxes.vars.prefix +'meta-box-post-format-"]').hide();
			$cbxPostFormats.change(function(){
				$meta_boxes.hide();
				$('#' +  g5plus_meta_boxes.vars.prefix +  'meta-box-post-format-' + $( this ).val()).show();
			});

			$cbxPostFormats.filter( ':checked' ).trigger( 'change' );
		},
		checkboxToggle : function() {
			$( 'body' ).on( 'change', '.checkbox-toggle input', function()
			{
				var $this = $( this ),
					$toggle = $this.closest( '.checkbox-toggle' ),
					action;
				if ( !$toggle.hasClass( 'reverse' ) )
					action = $this.is( ':checked' ) ? 'slideDown' : 'slideUp';
				else
					action = $this.is( ':checked' ) ? 'slideUp' : 'slideDown';

				$toggle.next()[action]();
			} );
			$( '.checkbox-toggle input' ).trigger( 'change' );
		}
	};
	g5plus_meta_boxes.init();
});