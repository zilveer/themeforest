<?php
/**
 * 404 Page
 *
 * The 404 template used when the page can not be found.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/
 
// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

get_header(); ?>

<!-- BEGIN .section-wrapper -->
<div id="404-page" <?php post_class( 'section-wrapper' );?>>
	
	<?php $parallax = $parallax_speed = $parallax_image = $video_bg_url = $header_text_align = '';
	$wrapper_attributes = array();
	$css_classes = array();
	
	$parallax = 'content-moving';
	$parallax_speed = '1.5';
	
	if ( $experience_theme_array['404-parallax'] == "1" ) {
	
		if ( 
			isset( $experience_theme_array['404-background-image'] ) 
			&& $experience_theme_array['404-background-image']['url'] != ''
		) {
			$parallax_image = $experience_theme_array['404-background-image']['url'];
		}
		
		if ( 
			isset( $experience_theme_array['404-background-video'] ) 
			&& $experience_theme_array['404-background-video'] != ''
		) {
			$video_bg_url = $experience_theme_array['404-background-video'];
		}
		
		$has_video_bg = ( ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

		if ( $has_video_bg ) {
			$parallax_image = $video_bg_url;
			$css_classes[] = ' vc_video-bg-container';	
		}

		if ( ! empty( $parallax ) ) {
			$wrapper_attributes[] = 'data-vc-parallax="'. esc_attr( $parallax_speed ) .'"';
			$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
			$css_classes[] = 'js-vc_parallax-o-fixed';
		}

		if ( ! empty( $parallax_image ) ) {
			$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image ) . '"';
		}
		if ( ! $parallax && $has_video_bg ) {
			$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
		}
	
	}
	
	// Set colour scheme
	if ( isset( $experience_theme_array['404-color-scheme'] )
		&& $experience_theme_array['404-color-scheme'] != "" 
	) {		
		$css_classes[] = 'color-scheme-'. $experience_theme_array['404-color-scheme'];
	}
	
	// Set header text alignment
	if ( isset( $experience_theme_array['404-text-alignment'] ) ) {	
		if ( $experience_theme_array['404-text-alignment'] == 'right' ) {
			$header_text_align = 'text-align-right';
		} else if ( $experience_theme_array['404-text-alignment'] == 'left' ) {
			$header_text_align = 'text-align-left';
		}		
	} ?>
	
	<!-- BEGIN .section-header -->
	<div class="section-header <?php echo esc_attr( implode( ' ', $css_classes ) ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
		
		<?php if ( 
			( !function_exists( 'vc_asset_url' ) && isset( $experience_theme_array['404-background-image']['url'] ) )
			|| $experience_theme_array['404-parallax'] != "1"
		) {
			experience_get_background( $experience_theme_array['404-background-image']['url'] );
		} ?>
		
		<div class="exp_ie-flexbox-fixer">
		
			<div class="exp-full-height exp-flexbox exp-content-middle">
				
				<div class="exp-flexbox-inner">
		
					<!-- BEGIN .section-header-content -->
					<div class="section-header-content padding-h narrow-width <?php echo esc_attr( $header_text_align ); ?>">
						
						<h1 class="heading-title">
							<?php if (
								isset( $experience_theme_array['404-title'] ) 
								&& $experience_theme_array['404-title'] != ''
							) { ?>
								<?php echo esc_html( $experience_theme_array['404-title'] ); ?>
							<?php } else {
								esc_html_e( 'Oops!', 'experience' );
							} ?>
						</h1>
						
						<p class="heading-subtitle">
							<?php if ( 
								isset( $experience_theme_array['404-content'] ) 
								&& $experience_theme_array['404-content'] != ''
							) { ?>
								<?php echo wp_kses_post( $experience_theme_array['404-content'] ); ?>
							<?php } else {
								echo wp_kses_post( __( 'The content you are looking for could not be found. It might have been moved or deleted.' , 'experience' ) );
							} ?>
						</p>
						
					</div>
					<!-- END .section-header-content -->
		
				</div>
				
			</div>
			
		</div>
		
	</div>
	<!-- END .section-header -->
	
</div>
<!-- END .section-wrapper -->

<?php get_footer(); ?>