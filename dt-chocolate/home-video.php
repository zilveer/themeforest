<?php
/* Template Name: Homepage - Video */
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php
	global $post;
	$jwplayer_flag = dt_jwplayer_exists();
	$box_name = 'homevideo';
	$homepage_data = get_post_meta( $post->ID, 'dt_'. $box_name. '_options', true );
	if ( $homepage_data ) {
		$vid_repeat = $homepage_data['dt_vid_loop'];
		$vid_auto = $homepage_data['dt_vid_autoplay'];
		$video = $homepage_data['dt_video'];
		$hide_desc = $homepage_data['dt_hide_desc'];
		$link = $homepage_data['dt_link'];
		$hide_masc = isset($homepage_data['dt_hide_over_mask']) ? $homepage_data['dt_hide_over_mask'] : false;
	} else {
		$video = $hide_desc = $hide_masc = $vid_repeat = $vid_auto = $vid_control = $link = false;
	}
	
	if ( has_post_thumbnail() ) {
		$poster = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
		$poster = $poster[0];
	} else
		$poster = '';
?>

<script type="text/javascript">
		jQuery( function($){
			$(window).resize(function(){
				window.w_height = $(window).height();
				window.w_width = $(window).width();
				window.deviceAgent = navigator.userAgent.toLowerCase();
				window.agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
				
				if(agentID){
						$('.jp-controls').css({
							width:w_width -80
						});
						$('.jp-progress').css({
							width: w_width - $('.jp-play').width() - $('.jp-pause').width() - $('.jp-stop').width() - 160
						})
					}
					else{
						$('.jp-controls').css({
							width:w_width -80
						});
						$('.jp-progress').css({
							width: w_width - $('.jp-play').width() - $('.jp-pause').width() - $('.jp-stop').width() - $('.jp-mute').width() - $('.jp-unmute').width() - $('.jp-volume-bar').width() - $('.jp-volume-max').width() - 180
						})
					}
				
			}).trigger('resize');
		
		<?php if ( $jwplayer_flag ): ?>
			window.ua = navigator.userAgent.toLowerCase();
			window.isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
			window.deviceAgent = navigator.userAgent.toLowerCase();
			window.agentID = deviceAgent.match(/(ipad)/);
			function isiPhone(){
				return (
					(navigator.platform.indexOf("iPhone") != -1) ||
					(navigator.platform.indexOf("iPod") != -1)
				);
			}
			if(agentID || isAndroid){
			
				$('.video').removeClass('jw-video');
				$('#big-mask').css('display', 'none');
				jwplayer("JPlayer").setup({
					flashplayer: "<?php echo get_template_directory_uri(); ?>/js/jwplayer/player.swf",
					file: "<?php echo $video; ?>",
					'image': "<?php echo $poster ?>",
					autostart: <?php echo $vid_auto?'true':'false' ?>,
					bufferlength: 5,
					repeat: "<?php echo $vid_repeat?'always':'none'; ?>",
					height: w_height - 30,
					width: w_width,
					
					'skin': "<?php echo get_template_directory_uri(); ?>/js/jwplayer-skin/glows.zip" 
				});
			}
			else if(isiPhone()){
							
				$('.video').addClass('jw-video');
				$('#big-mask').css('display', 'none');
				jwplayer("JPlayer").setup({
					flashplayer: "<?php echo get_template_directory_uri(); ?>/js/jwplayer/player.swf",
					file: "<?php echo $video; ?>",
					'image': "<?php echo $poster ?>",
					autostart: <?php echo $vid_auto?'true':'false' ?>,
					bufferlength: 5,
					repeat: "<?php echo $vid_repeat?'always':'none'; ?>",
					height: w_height + 130,
					width: w_width,
					stretching: 'fill',
					
					'skin': "<?php echo get_template_directory_uri(); ?>/js/jwplayer-skin/glows.zip" 
				});
				
				
				if(ResizeTurnOff){
				}else{
					$(".video").on("click", function(e) {
						$("video").trigger("play");
					});
					 
					$(document).on('touchmove', function(e) { if ($(window).width() < 1000) e.preventDefault(); });
					if ($.browser.SafariMobile){
				
						$(window).on("orientationchange",  function() {
							
							if(window.orientation == 90 || window.orientation == -90) {
							  jwplayer("JPlayer").resize(w_width, w_height+130);
								
							} else {
							  jwplayer("JPlayer").resize(w_width, w_height+130);
											
							}
						
							setTimeout(scrollTo, 0, 0, 1);
							$(window).trigger("resize");
						
						}).trigger("orientationchange");
						
						setInterval( function() {
							$(window).trigger("orientationchange");						
							window.onresize = function(){
							  jwplayer("JPlayer").resize(w_width, w_height+130);
							};
						}, 1000);
						
					}	
				}
			}else{
				$('.video').removeClass('jw-video');
				if(isiPhone()){
					$('.video').addClass('jp-video-iphone');
				}else{
					$('.video').removeClass('jp-video-iphone');
				}
				jwplayer("JPlayer").setup({
					flashplayer: "<?php echo get_template_directory_uri(); ?>/js/jwplayer/player.swf",
					file: "<?php echo $video; ?>",
					'image': "<?php echo $poster ?>",
					autostart: <?php echo $vid_auto?'true':'false' ?>,
					bufferlength: 5,
					repeat: "<?php echo $vid_repeat?'always':'none'; ?>",
					controlbar: {position: 'bottom'},
					height: w_height,
					width: w_width,
					stretching: 'fill',
					
					'skin': "<?php echo get_template_directory_uri(); ?>/js/jwplayer-skin/glows.zip" ,
					players: [
					   {type: "flash", src: "<?php echo get_template_directory_uri(); ?>/js/jwplayer/player.swf"}
					]
				});
			}
			window.onresize = function(){
			  jwplayer("JPlayer").resize(w_width, w_height);
			};
		<?php else:
//			$video = str_replace( get_site_url(), '', $video );
			preg_match_all( '/.*\.(.*)$/', $video, $mathes );
			switch ( current($mathes[1]) ) {
				case 'flv':
					$video = 'flv: "'. $video. "\",\n";
					break;
				case ('mp4' || 'mpg4'):
					$video = 'm4v: "'. $video. "\",\n";
					break;
				default: $video = '';
			}
			
			$poster = $poster?"poster: \"". $poster. "\",\n":$poster;
			//$poster = str_replace( get_site_url(), '', $poster );
			
			$vid_repeat = $vid_repeat?'ended: function() {$(this).jPlayer("play");},'."\n":'';
			$vid_auto = $vid_auto?'$(this).jPlayer("play");'."\n":'';
		?>
			$(window).resize(function(){
				function isiPhone(){
					return (
						(navigator.platform.indexOf("iPhone") != -1) ||
						(navigator.platform.indexOf("iPod") != -1)
					);
				}
				if(isiPhone()){
					$('.video').addClass('jp-video-iphone');
					
				}else{
					$('.video').removeClass('jp-video-iphone');
				}
						$("#JPlayer").jPlayer( {
							swfPath: "<?php echo get_template_directory_uri() ?>/js/jplayer/",
							cssSelectorAncestor: "#jplayer_controlls",
							size: {
								width: w_width,
								height: w_height
							},
							ready: function() { // The $.jPlayer.event.ready event
								$(this).jPlayer("setMedia", { // Set the media
									<?php echo $video ?>
									preload: "auto"
								});
								<?php echo $vid_auto ?>// Attempt to auto play the media
							},
							click: function( event ) {
								if( event.jPlayer.status.paused || event.jPlayer.status.waitForPlay ) {
									$(this).jPlayer("play");
								} else {
									$(this).jPlayer("pause");
								}
							},
							<?php echo $vid_repeat ?>
							solution: 'flash, html',
							supplied: 'flv, m4v',
							wmode: "opaque"
						});
		
				}).trigger('resize')
		<?php endif ?>
		if(ResizeTurnOff){
		}else{
		 window.hideHeader = function() {
			if ($(window).width() < 740) {
				$("#header-mobile").stop().animate({
					"top" : -$("#header-mobile").outerHeight() - 60
				}, 700);
			}
		}
		
		window.showHeader = function() {
			if ($(window).width() < 740) {
				$("#header-mobile").stop().animate({
					"top" : 0
				}, 700);
			}
		}
		$(document).on('touchmove', function(e) { if ($(window).width() < 1000) e.preventDefault(); });
			$(document).wipetouch({
				preventDefault: false,
				wipeLeft: function(result) {
					hideHeader();
				},
				wipeRight: function(result) {
					hideHeader();
				},
				wipeUp: function(result) {
					hideHeader();
				},
				wipeDown: function(result) { 
					showHeader();
					
				}
			});
		
		}
		});
		
</script>

<div class="pg_content video">
	<?php if ( !$hide_desc ): ?>
		<div id="pg_desc2" class="pg_description">
		<?php if( !empty($post->post_content) ): ?>
			<div style="display:block;">
				<h2>
					<?php the_title(); ?>
				</h2>
				<p>
					<?php echo wp_kses_post( $post->post_content ); ?>
				</p>
				<?php if( !empty($link) ): ?>
				<p>
					<a class="go_more" href="<?php echo esc_url($link); ?>">
						<span>
							<i></i>
							<?php _e('Details', LANGUAGE_ZONE); ?>
						</span>
					</a>
				</p>
				<?php endif ?>
			</div>
			<div class="desc-b"></div>
		<?php endif ?>
		</div>
	<?php endif ?>
		
	<div id="JPlayer"></div>

</div><!-- .pg_content end-->


<?php get_footer(); ?>