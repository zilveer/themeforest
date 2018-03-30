<?php
/**
 * @package berg-wp
 */
?>
<?php 

global $slideCount; 
$videoUrl = get_post_meta( $post->ID, 'section_restaurant_video_link', true );

$post_meta = get_post_meta(get_the_id());
$backgroundStyle = $color = '';
$color = $post_meta['section_restaurant_color'][0];
if (isset($post_meta['section_restaurant_color'][0])) {
	$backgroundStyle = 'style="background:'.$color.'; position: absolute; top: 0; left: 0; width: 100%; height: 100%; "';
} else {
	$backgroundStyle = '';
}
$backgroundStyle = 'style="background-color:'.$color.';"';

?>
<div class="item section">
	<div <?php echo $backgroundStyle; ?> class="hidden-xs"></div>
	<div class="video-wrapper video-wrapper-<?php echo get_the_id();?>" style="position:absolute; width: 100%; height: 100%; left:0; top: 0; z-index: 2;">
		<div class="video-mobile hidden-md hidden-lg">
		<?php 
			global $wp_embed;
			echo '<div class="embed-responsive embed-responsive-16by9">';
			if($videoUrl != '') {
				$url = $videoUrl;
			} else {
				$url = 'http://youtu.be/dSpQ5zdR4dE';
			}
			echo $wp_embed->run_shortcode('[embed]'.$url.'[/embed]');	
			echo '</div>';
		;?>
		</div>
	</div>
	<div id="P1-<?php echo get_the_id();?>" class="player" style="display:block; margin: auto; background: rgba(0,0,0,0.5);" data-property="{videoURL:'<?php echo ($videoUrl != '') ? $videoUrl : 'http://youtu.be/dSpQ5zdR4dE'?>',containment:'.video-wrapper-<?php echo get_the_id();?>',startAt:0,mute:true,<?php if($slideCount > 0) : ?>autoPlay:false,<?php endif;?>loop:true,opacity:1, showControls: false}"></div>
	
	<div class="video-mask hidden-xs" <?php echo $backgroundStyle; ?>></div>
	<div class="video-controls hidden-xs hidden-sm">
		<div class="pause">
			<i class="icon-control-pause"></i>
		</div>
		<div class="play hidden">
			<i class="icon-control-play"></i>
		</div>
		<div class="fullscreen">
			<i class="icon-size-fullscreen"></i>
		</div>
	</div>
	<div class="container restaurant-content pre-content">
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 item__description">
				<?php the_title( sprintf( '<h1 class="entry-title">', esc_url( get_permalink() ) ), '</h1>' ); ?>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
