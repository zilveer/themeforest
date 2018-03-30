

	(function( $ ) {
		
		var init_jwplayer = function() {
			
			$(window).load(function() {

				$('.jwplayer-container').each(function(index, value) { 	
						
					var player 		= '#'+ $(this).attr('id'),
						player_id 	= $(this).attr('id'),
						mediaurl	= $( player ).attr("data-jw-mediaurl"),
						media 		= $( player ).attr("data-jw-media"),
						width 		= $( player ).attr("data-jw-width"),
						height 		= $( player ).attr("data-jw-height"),
						autoplay	= $( player ).attr("data-jw-autoplay"),
						loop 		= $( player ).attr("data-jw-loop"),
						icons 		= $( player ).attr("data-jw-icons"),
						skin 		= $( player ).attr("data-jw-skin"),
						image		= $( player ).attr("data-jw-image"),
						swfsrc		= $( player ).attr("data-jw-swfsrc"),
						controlbar	= $( player ).attr("data-jw-controlbar");
	
					
					if( parseInt(loop) == 1 ) {
						var repeat = 'always',
							shuffle = 'true';
					} else 
					{
						var repeat = 'false',
							shuffle = 'false';
					}

					jwplayer( player_id ).setup(
					{
						'id': 'player_' + player_id,
						'file': mediaurl,
						'width': width,
						'height': height,
						'skin': skin,							
						'controlbar.position': controlbar,
						'repeat': repeat,
						'shuffle': shuffle,	
						'icons': icons,
						'stretching': 'fill',
						'controlbar.idlehide':'true',
						'wmode': 'transparent',
						'image': image,
					});
	
					// only apply the following if video type	
					if( media != 'audio' ) 
					{ 	
						$( player + ',' + player + '_wrapper').addClass('jwplayer'); 
						$( player ).addClass('id' + player_id );
						$( player + '_video_wrapper').addClass('jw_video_wrapper'); 
						$( player + '_displayarea').addClass('jw_displayarea'); 
						$( player + '_jwplayer_display').addClass('jw_display'); 
						$( player + '_jwplayer_display_image').addClass('jw_display_image'); 
						$( player + '_jwplayer_display_iconBackground').addClass('jw_iconBackground'); 
					 }
						
						
					$('.mediawrap.audio .jwplayer-wrapper div:first-child').css('width','100%');
					
					if('1' == autoplay ) {
						$( player ).addClass('autostart');
						$( player ).parent('.jwplayer-wrapper').addClass('autostart');
					}
						
							
					if( $( player ).hasClass('autostart') ) {
						jwplayer( player_id ).onReady(function() {
							currentState = jwplayer( player_id ).getState(); 
							if(currentState=="IDLE") {
								jwplayer( player_id ).play();
							}
						});
					}
				});
			});				
		}
		
		init_jwplayer();
		
	})(jQuery);			