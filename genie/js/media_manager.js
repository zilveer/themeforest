(function($) {
 
	wp.media.BTMediaManager = {
		 
		init: function() {

			this.frame = wp.media.frames.BTMediaManager = wp.media({
				library: {
					type: 'image'
				}
			});
			
			this.frame.on( 'select', function() {

				var attachment = wp.media.BTMediaManager.frame.state().get( 'selection' ).first();
				var controllerName = wp.media.BTMediaManager.$el.data( 'controller' );
				
				controller = wp.customize.control.instance( controllerName );
				controller.thumbnailSrc( attachment.attributes.url );
				controller.setting.set( attachment.attributes.url );
				
			});
			 
			$( '.choose-from-library-link' ).click( function( event ) {
				wp.media.BTMediaManager.$el = $( this );
				
				event.preventDefault();
	 
				wp.media.BTMediaManager.frame.open();
			});
			 
		}
	};
	 
	wp.media.BTMediaManager.init();
 
}(jQuery));