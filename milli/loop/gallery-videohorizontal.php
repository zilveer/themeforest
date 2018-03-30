<?php 
	/**
	 * If attachments exist, decalare post and get ready to process attachments
	 */
	global $post;
	
	$videos = get_post_meta( $post->ID, '_ebor_video_gallery_url', true);
	$titles = get_post_meta( $post->ID, '_ebor_video_gallery_title', true);
	$descriptions = get_post_meta( $post->ID, '_ebor_video_gallery_description', true);
	
	$item_margin = get_post_meta( $post->ID, '_ebor_item_margin', true );
	
	if(!( $item_margin ) || !( is_numeric( $item_margin ) ) || $item_margin == '' )
		$item_margin = 0;
		
	( get_option('menu_style','side') == 'side' ) ? $crop_width = 1000 : $crop_width = 1240;
?>

<style type="text/css">
	.gallery-image {
		margin-right: 30px;
		max-width: <?php echo $crop_width; ?>px;
	}
</style>

<div class="wrap">
	<div class="frame" id="cycleitems" style="overflow: hidden;">
		<ul class="clearfix">
	
			<?php
				foreach( $videos as $key => $video ) {
					
					echo '<li class="gallery-image">';
					
					$video = esc_url( $video );
					echo apply_filters('the_content', $video);
					
					echo '<div class="sliding-details">';
					
					if( isset($titles[$key]) )
						echo '<h2 class="article-title">'. strip_tags( $titles[$key] ) .'</h2>';
					
					if( isset($descriptions[$key]) )
						echo wpautop( $descriptions[$key] );
						
					echo '</div></li>';
					
				}
			?>		

		</ul>
	</div>
	
	<div class="scrollbar">
		<div class="handle">
			<div class="mousearea"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#cycleitems .gallery-image').css('width', $('.wrap').width() );
		
		var $frame = $('#cycleitems');
		var $wrap  = $frame.parent();
	
		// Call Sly on frame
		var sly = new Sly($frame, {
			horizontal: 1,
			itemNav: 'basic',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 0,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 0,
			speed: 300,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,
			pauseOnHover: 1,
			keyboardNavBy: 'pages'
		}).init();
		
		jQuery(window).resize(function(){
			$('#cycleitems .gallery-image').css('width', $('.wrap').width() );
			sly.reload();
		});
		
	});
	jQuery(window).load(function(){
		jQuery(window).trigger('resize');
		jQuery('.wrap').animate({'opacity' : '1'});
	});
</script>