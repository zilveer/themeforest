jQuery(document).ready(function() {	
	/*  Initialize Help Mode */
	if ( jQuery.fn.modal ) {
		jQuery( '.g1-helpmode' ).each( function() {
			var $this = jQuery( this );
			
			$this.find( '.g1-helpmode-content, .g1-helpmode-notice' ).hide();
			$this.find( '.g1-helpmode-title' ).live( 'click', function() {
				var content = $this.clone( false );
				content.find( '.g1-helpmode-content, .g1-helpmode-notice' ).show();
				content.modal();
			});
		});
	}	
});