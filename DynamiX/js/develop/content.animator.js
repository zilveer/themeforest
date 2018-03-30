
/* :: 	Content Animator							      
--------------------------------------------- */

	function animate_obj( caID ) {
	
			var caID = jQuery( caID ),
				effect = caID.attr("data-animator-effect"),
				direction = caID.attr("data-animator-direction"),
				delay = caID.attr("data-animator-delay"),
				speed = caID.attr("data-animator-speed"),
				easing = caID.attr("data-animator-easing");
				
			//
			if( !caID.hasClass('played') ) {
					
				caID.css('display','none');
	
				caID.addClass('played');
					
				if( !caID.hasClass('loaded') ) { // add class so galleries can replay animation
					caID.addClass('loaded');
				}				
					
				clearTimeout( jQuery.data( caID , 'timer') );
					 
				jQuery.data( caID , 'timer', setTimeout( function() {
					 
					caID.stop(true,true).show( effect, { direction: direction, duration: parseInt(speed), easing: easing } ,function(){
									
						if(caID.find('img').hasClass('reflect')) { // add reflection to image if required		
							caID.find('img.reflect').each(function() {
								jQuery(this).reflect({ height:0.12,opacity:0.2 });	
							});
						}			
					});
					
					 
				}, delay));
					 
			}	
	}

	function content_animator(element) {
		
		jQuery('.animator-wrap').each(function(index) {
			
			var caID = '#' + jQuery(this).attr('id');
			animate_obj( caID );
		
		});
	}

	jQuery(window).load(
		function() {
			content_animator();
		}
	);