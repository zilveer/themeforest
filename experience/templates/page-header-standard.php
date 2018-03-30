<?php
/**
 * Standard Page Header
 *
 * Standard page header template files.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

$parallax = $parallax_speed = $parallax_image = $video_bg_url = $flexbox_before = $flexbox_after = '';
$wrapper_attributes = array();
$css_classes = array();

$parallax = 'content-moving-fade';

if ( get_post_meta( $post->ID, 'experience_header_parallax_speed', true ) != '' ) {
	$parallax_speed = get_post_meta( $post->ID, 'experience_header_parallax_speed', true );
} else {
	$parallax_speed = '1.5';
}

if ( get_post_meta( $post->ID, 'experience_header_parallax', true ) == 'on' ) {

	if ( get_post_meta( $post->ID, 'experience_header_bg_image', true ) != '' ) {
		$parallax_image = esc_url( get_post_meta( $post->ID, 'experience_header_bg_image', true ) );
	}

	if ( get_post_meta( $post->ID, 'experience_header_bg_video', true ) != '' ) {
		$video_bg_url = esc_url( get_post_meta( $post->ID, 'experience_header_bg_video', true ) );
	}

	$has_video_bg = ( ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );
	
	if ( $has_video_bg ) {
		$parallax_image = $video_bg_url;
		$css_classes[] = ' vc_video-bg-container';	
	}

	if ( ! empty( $parallax ) ) {
		$wrapper_attributes[] = 'data-vc-parallax="'. esc_attr( $parallax_speed ) .'"';
		$css_classes[] = 'vc_general vc_parallax vc_parallax-'. $parallax;
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}

	if ( ! empty( $parallax_image ) ) {
		$wrapper_attributes[] = 'data-vc-parallax-image="'. esc_url( $parallax_image ) .'"';
	}
	if ( ! $parallax && $has_video_bg ) {
		$wrapper_attributes[] = 'data-vc-video-bg="'. esc_url( $video_bg_url ) .'"';
	}

}

// Set colour scheme
if ( get_post_meta( $post->ID, 'experience_header_color_scheme', true ) != "" ) {		
	$css_classes[] = 'color-scheme-'. get_post_meta( $post->ID, 'experience_header_color_scheme', true );
} else {
	$css_classes[] = 'color-scheme-3';
}

// Set section header size
if ( get_post_meta( $post->ID, 'experience_header_fill_screen', true ) == 'on' ) {
	$flexbox_before = '<div class="exp_ie-flexbox-fixer"><div class="exp-full-height exp-flexbox exp-content-middle"><div class="exp-flexbox-inner">';
	$flexbox_after = '</div></div></div>';
} ?>

<!-- BEGIN .section-header -->
<div class="section-header <?php echo esc_attr( implode( ' ', $css_classes ) ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	
	<?php if (	
		get_post_meta( $post->ID, 'experience_header_bg_image', true ) != ''
		&&(
			(
				!function_exists( 'vc_asset_url' )
				|| get_post_meta( $post->ID, 'experience_header_parallax', true ) != 'on' 
			)
			|| (
				function_exists( 'vc_asset_url' )
				&& get_post_meta( $post->ID, 'experience_header_parallax', true ) == 'on'
				&& get_post_meta( $post->ID, 'experience_header_bg_video', true ) != ''
			)
		)
	) {
		experience_get_background( get_post_meta( $post->ID, 'experience_header_bg_image', true ) );
	} ?>
	
	<?php echo $flexbox_before; ?>
		
		<!-- BEGIN .section-header-content -->
		<div class="section-header-content padding-h narrow-width">
			
			<?php $page_label = get_post_meta( $post->ID, 'experience_page_label', true );
			$page_subtitle = get_post_meta( $post->ID, 'experience_page_intro', true ); ?>
			
			<?php if ( $page_label != '' ) { ?>
				<span class="heading-label"><?php echo wp_kses( $page_label, array( 'img' => array( 'src' => array(), 'height' => array(), 'width' => array(), 'alt' => array() ) ) ); ?></span>
			<?php } ?>
			
			<h1 class="heading-title"><?php echo experience_resize_text( experience_get_the_title() ); ?></h1>
			
			<?php if ( $page_subtitle != '' ) { ?>
				<p class="heading-subtitle"><?php echo wp_kses_post( $page_subtitle ); ?></p>
			<?php } ?>
		
		</div>
		<!-- END .section-header-content -->
	
		<?php if ( get_post_meta( $post->ID, 'experience_header_scroll_link', true ) == 'on' ) { ?>
			<span class="section-scroll-link">
				<span class="funky-icon-arrow-down"></span>
			</span>
		<?php } ?>
	
	<?php echo $flexbox_after; ?>
	
</div>
<!-- END .section-header -->