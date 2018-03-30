jQuery(document).ready(function() {	
	/*  Initialize Help Mode */
	if ( jQuery.fn.modal ) {
		jQuery( '.help-mode' ).each( function() {
			var $this = jQuery( this );
			
			$this.find( '.help-mode-content, .help-mode-notice' ).hide();
			$this.find( '.help-mode-title' ).live( 'click', function() {
				var content = $this.clone( false );
				content.find( '.help-mode-content, .help-mode-notice' ).show();
				content.modal();
			});
		});
	}	
});