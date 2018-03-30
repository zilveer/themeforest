<?php
global $wp_embed;
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );


if ( $link == '' ) { return null; }

?>

<div class="wpb_video_widget <?php echo get_viewport_animation_class($animation).$el_class; ?>">
	<div class="wpb_wrapper">

		<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $title]); ?>

		<div class="video-container" <?php echo get_schema_markup('video'); ?>>
		<?php echo $wp_embed->run_shortcode( '[embed width="1140" height="641"]'.$link.'[/embed]' ); ?>
		</div>
		
	</div>
</div>
