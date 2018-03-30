(function( $ ){
	var methods = {
		init : function( ) {			
			return this.each(function(){
		        var $this = $(this);
		        var	data = $this.data('btpOptionViewFlexSlides');
		        var slider_id = parseInt( $( 'input[name=post_ID]' ).val() );
		        var option_id = $this.find( 'input[name$="\[option_id\]"]').val()
		        
		        /* If the plugin hasn't been initialized yet */
		        if ( ! data ) {		        	
		        	/* Store data */
		        	$(this).data('btpOptionViewFlexSlides', {
		        		target 		: $this,
		        		slider_id	: slider_id,
		        		option_id	: option_id	
		        	});
		        	
		        	$this.btpOptionViewFlexSlides( 'setup' );
		        }
			});
		},
		
		setup : function() {
			return this.each(function(){
				var $this = $(this);
				var	data = $this.data('btpOptionViewFlexSlides');
			
	        	/* Initializes sortable user interface */		
	    		$this.initSortableUI = function() {
	    			$this.find( '.btp-flex-slide-container' ).sortable({
	    				axis: 					'y',
	    				cursor: 				'move',
	    				handle:					'.btp-handle',
	    				items:					'> .btp-flex-slide',
	    				forcePlaceholderSize: 	true,
	    				placeholder: 			'btp-placeholder',
	    				update: 				function(event, ui) {
	    					$this.btpOptionViewFlexSlides( 'renumberMenuOrder' );
	    				}	
	    			});
	
	    			$this.btpOptionViewFlexSlides( 'renumberMenuOrder' );
	    		};
	    		
	    		$this.initSortableUI();	    		
	    		
	    		/* Bind moveUp method */
	    		$this.find( '.btp-flex-slide .btp-move-up' ).click( function( event ) {
	    			event.preventDefault();	    			
	    			
	    			var slide_id = parseInt( $( this ).closest( '.btp-flex-slide' ).attr( 'id' ).substring(15) );   				
	    			$this.btpOptionViewFlexSlides( 'moveUp', slide_id );
	    		});	
	    		
	    		/* Bind moveDown method */
	    		$this.find( '.btp-flex-slide .btp-move-down' ).click( function( event ) {
	    			event.preventDefault();
	    			
	    			var slide_id = parseInt( $( this ).closest( '.btp-flex-slide' ).attr( 'id' ).substring(15) );   	
	    			$this.btpOptionViewFlexSlides( 'moveDown', slide_id );
	    		});	    		
	        	    		
	    		/* Bind deleteSlide method */
	    		$this.find( '.btp-flex-slide .btp-delete-slide' ).click( function( event ) {
	    			event.preventDefault();
	    	
	    			/* Confirm delete action */		    					    			
	    			if ( confirm( "Are you sure you want to delete this slide?" ) ) {
	    				var slide_id = parseInt( $( this ).closest( '.btp-flex-slide' ).attr( 'id' ).substring(15) );
	    				$this.btpOptionViewFlexSlides( 'deleteSlide', slide_id );
	    			}
	    		} );	
			});
		},		       		        	
    	
		
		
		/**
		 * Move up a slide
		 */		
    	moveUp : function( slide_id ) {
			return this.each(function(){
				var $this = $(this);
				
				var $current = $this.find( '#btp-flex-slide-' + slide_id );					
				$current.prev().before( $current );					
				
				$this.btpOptionViewFlexSlides( 'renumberMenuOrder' );								
			});
		},	
				
		
		
		/**
		 * Move down a slide
		 */
		moveDown : function( slide_id ) {
			return this.each(function(){
				var $this = jQuery(this);
					
				var $current = $this.find( '#btp-flex-slide-' + slide_id );
				$current.next().after( $current );
				
				$this.btpOptionViewFlexSlides( 'renumberMenuOrder' );
			});
		},
		
	
		
		/**
		 * Sets proper values for all menu_order fields 
		 */
		renumberMenuOrder : function() {
			return this.each(function(){
				var $this = $(this);
				
				$this.find( '.btp-flex-slide' ).each( function( index ) {
					$('input[name$="\[menu_order\]"]', this).val( index );
				});
			});
		},	
		
		
		
		/**
		 * Deletes a slide
		 */
		deleteSlide : function( slide_id ) {
			return this.each(function(){
				var $this = $(this);
				var data = $this.data('btpOptionViewFlexSlides');
				
				var slide = $( '#btp-flex-slide-' + slide_id, this );

				var args = {
					action: 			'btp_delete_flex_slide',
					btp_slide_id: 		slide_id,
					btp_nonce:			slide.find( 'input[name$="\[delete_flex_slide_nonce\]"]').val()					
				};				
				
				/* AJAX request */
				$.post(ajaxurl, args, function(response) {					
					if ( response !== 0 && response !== -1 ) {
						var r = wpAjax.parseAjaxResponse( response, 'ajax-reponse' );

						$.each( r.responses, function() {
							if ( this.what == 'btp_delete_flex_slide') {
								/* On success */
								if ( !this.errors.length ) {									
									slide.remove();
								/* On error */
								} else {
									jQuery.each( this.errors, function() {
										alert( this.message );									
									} );								
								}	
							}
						});
					}	
				});
			} );
		},
		
		refresh : function( ) {
			return this.each(function(){
				var $this = $(this);
		        var data = $this.data('btpOptionViewFlexSlides');
		        
		        /* This is a simple read operation, so we don't need a nonce */ 
		        var args = {
		        	action: 			'btp_refresh_flex_slides',
					btp_slider_id: 		data.slider_id,
					btp_option_id: 		data.option_id,
		        };
				
				/* AJAX request */
				$.post(ajaxurl, args, function(response) {					
					if ( response !== 0 && response !== -1 ) {
						var r = wpAjax.parseAjaxResponse( response, 'ajax-reponse' );
						
						$.each( r.responses, function() {
							if ( this.what == 'btp_refresh_flex_slides') {
								/* On success */
								if ( !this.errors.length ) {
									//alert( r.data );
									$this.find( '.btp-flex-slide-container' ).replaceWith( this.data );
									$this.btpOptionViewFlexSlides( 'setup' );
								/* On error */
								} else {
									jQuery.each( this.errors, function() {
										alert( this.message );									
									} );								
								}	
							}
						});
					}	
				});
			});			
		},	
		
		
		
		/**
		 * Destroyer
		 */
	    destroy : function( ) {			
			return this.each(function(){
		         var $this = $(this);
		         var data = $this.data('btpOptionViewFlexSlides');

		         /* Namespacing FTW */
		         $(window).unbind('.btpOptionViewFlexSlides');
		         data.btpOptionViewFlexSlides.remove();
		         $this.removeData('btpOptionViewFlexSlides');

			});
		}
	};
	
	
	/**
	 * Method calling logic
	 */
	$.fn.btpOptionViewFlexSlides = function( method ) {
	    if ( methods[method] ) {
	      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } else if ( typeof method === 'object' || ! method ) {
	      return methods.init.apply( this, arguments );
	    } else {
	      $.error( 'Method ' +  method + ' does not exist on jQuery.btpOptionViewFlexSlides' );
	    }
	  };
})( jQuery );




function BTPAddFlexSlide( id ){	
	var win = window.dialogArguments || opener || parent || top;
	
	win.tb_remove();
	win.BTPRefreshFlexSlides();
	
}



/**
 * Refreshes the container with Flex Slides 
 */
function BTPRefreshFlexSlides() {
	jQuery( '.btp-option-view-flex-slides' ).btpOptionViewFlexSlides( 'refresh' );
}



/* Init Flex Slides */
jQuery(document).ready(function($) {
	jQuery( '.btp-option-view-flex-slides' ).btpOptionViewFlexSlides();
} );