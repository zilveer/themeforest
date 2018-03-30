<?php
/**
 * Home Header
 */
$header_type = wolf_get_theme_option( 'home_header_type' );
$hero        = stripslashes( wolf_get_theme_option( 'home_header_content' ) );
$video_mp4   = esc_url( wolf_get_theme_option( 'video_header_bg_mp4' ) );
$video_bg_type   = wolf_get_theme_option( 'video_header_bg_type' );
$video_youtube_url   = esc_url( wolf_get_theme_option( 'video_header_bg_youtube_url' ) );
$font_class =  'content-' . wolf_get_theme_option( 'header_bg_font_color' ) . '-font';

// Featured Post Slider
if ( 'featured-slider' == $header_type ) {
	if ( 0 < wolf_get_slide_loop()->post_count ) {
		get_template_part( 'partials/slider', 'home' );
	}
}

// Standard
elseif ( 'standard' == $header_type ) {

	if ( ( wolf_get_theme_option( 'header_bg_img' ) || wolf_get_theme_option( 'header_bg_color' ) ) && ! wolf_is_slider_in_home_header() ) {
		$img_url = wolf_get_url_from_attachment_id( wolf_get_theme_option( 'header_bg_img' ), 'extra-large' );
		echo '<div class="header-inner">';

		if ( 'parallax' == wolf_get_theme_option( 'hero_effect' ) )
			echo '<div class="parallax-inner">';
		else
			echo '<div class="hero-inner">';

			if ( 'zoom' == wolf_get_theme_option( 'hero_effect' )  )
				echo '<div class="bg"><img src="' . esc_url( $img_url ) . '"></div>';

		echo '</div>'; // end parallax or hero inner
		if ( $hero && ! wolf_is_slider_in_home_header() ) {
		?>
			<div id="hero">
				<div id="hero-content" class="<?php echo esc_attr( $font_class ); ?>">
					<div class="wrap">
						<?php echo wolf_format_custom_content_output( $hero ); ?>
					</div>
				</div>
			</div>
		<?php
		} elseif ( $hero && wolf_is_slider_in_home_header() ) {
			?>
			<div class="wolf-the-slider-container"><?php echo wolf_format_custom_content_output( $hero ); ?></div>
			<?php
		}
		echo '</div>';
	}
}

elseif ( 'video' == $header_type ) {

	if ( ( $video_mp4 || $video_youtube_url )  && ! wolf_is_slider_in_home_header() ) {

		$video_webm  = esc_url( wolf_get_theme_option( 'video_header_bg_webm' ) );
		$video_ogv  = esc_url( wolf_get_theme_option( 'video_header_bg_ogv' ) );
		$video_img = esc_url( wolf_get_url_from_attachment_id( wolf_get_theme_option( 'video_header_bg_img' ), 'extra-large' ) );
		$video_opacity = 100;
		$video_header_bg_color_style = ( wolf_get_theme_option( 'video_header_bg_color' ) ) ? ' style="background-color:' . wolf_get_theme_option( 'video_header_bg_color' ) . '"' : '';
		?>
		<div class="header-inner">
			<div class="parallax-inner">
				<div class="video-container"<?php echo esc_attr( $video_header_bg_color_style ); ?>>
					<?php
					if ( $video_mp4 && 'selfhosted' == $video_bg_type ) {
						echo wolf_video_bg( $video_mp4, $video_webm, $video_ogv, $video_img );
					}
					
					elseif( $video_youtube_url && 'youtube' == $video_bg_type ) {
						// debug(  $video_img );
						echo wolf_youtube_video_bg( $video_youtube_url, $video_img );
					}
					?>
				</div>
			</div><!-- .parallax-inner -->
			<?php
			if (
				$hero
				&& ! wolf_is_slider_in_home_header()
				&& 'featured-slider' != $header_type && 'none' != $header_type
			) {
			?>
				<div id="hero">
					<div id="hero-content" class="<?php echo esc_attr( $font_class ); ?>">
						<div class="wrap">
							<?php echo wolf_format_custom_content_output( $hero ); ?>
						</div>
					</div>
				</div>
			<?php 	}
		echo '</div>';
	}

} elseif ( 'wolf-slider' ==  $header_type ) {

	if ( wolf_get_theme_option( 'header_wolf_slider' ) )
		if ( function_exists( 'wolf_slider' ) )
			wolf_slider( esc_attr( wolf_get_theme_option( 'header_wolf_slider' ) ) );

} elseif ( 'revslider' ==  $header_type ) {

	if ( wolf_get_theme_option( 'header_revslider' ) ) : ?>
		<div class="wolf-revslider-container">
			<?php
				if ( function_exists( 'putRevSlider' ) )
					putRevSlider( esc_attr( wolf_get_theme_option( 'header_revslider' ) ) ); 
			?>
		</div>
	<?php endif;
}