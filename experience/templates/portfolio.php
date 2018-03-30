<?php
/**
 * Portfolio Category taxonomy template.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

get_header(); ?>
	
<?php if ( isset( $experience_theme_array['portfolio-layout'] ) ) {
	$post_class = esc_html( $experience_theme_array['portfolio-layout'] );
} else { 
	$post_class = 'grid';
} ?>

<!-- BEGIN .section-wrapper -->
<section <?php post_class( 'section-wrapper portfolio-'. $post_class ); ?>>
	
	<?php $parallax = $parallax_speed = $parallax_image = $video_bg_url = $flexbox_before = $flexbox_after = '';
	$wrapper_attributes = array();
	$css_classes = array();
	
	if ( $experience_theme_array['portfolio-header-parallax'] == "1" ) {
	
		$parallax = 'content-moving';
		$parallax_speed = '1.5';	
	
		if ( 
			isset( $experience_theme_array['portfolio-header-parallax-speed'] ) 
			&& $experience_theme_array['portfolio-header-parallax-speed'] != ''
		) {
			$parallax_speed = $experience_theme_array['portfolio-header-parallax-speed'];
		}
		
		if ( 
			isset( $experience_theme_array['portfolio-header-background-image'] ) 
			&& $experience_theme_array['portfolio-header-background-image']['url'] != ''
		) {
			$parallax_image = $experience_theme_array['portfolio-header-background-image']['url'];
		}
		
		if ( 
			isset( $experience_theme_array['portfolio-header-background-video'] ) 
			&& $experience_theme_array['portfolio-header-background-video'] != ''
		) {
			$video_bg_url = $experience_theme_array['portfolio-header-background-video'];
		}
		
		$has_video_bg = ( ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

		if ( $has_video_bg ) {
			$parallax_image = $video_bg_url;
			$css_classes[] = ' vc_video-bg-container';	
		}

		if ( ! empty( $parallax ) ) {
			$wrapper_attributes[] = 'data-vc-parallax="'. esc_attr( $parallax_speed ) .'"';
			$css_classes[] = 'vc_general vc_parallax vc_parallax-'. esc_attr( $parallax );
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
	if ( isset( $experience_theme_array['portfolio-header-color-scheme'] )
		&& $experience_theme_array['portfolio-header-color-scheme'] != "" 
	) {		
		$css_classes[] = 'color-scheme-'. $experience_theme_array['portfolio-header-color-scheme'];
	} else {
		$css_classes[] = 'color-scheme-3';
	}

	// Set section header size
	if ( $experience_theme_array['portfolio-header-type'] == 'fill' ) {
		$flexbox_before = '<div class="exp_ie-flexbox-fixer"><div class="exp-full-height exp-flexbox exp-content-middle"><div class="exp-flexbox-inner">';
		$flexbox_after = '</div></div></div>';
	} ?>
	
	<!-- BEGIN .section-header -->
	<div class="section-header <?php echo esc_attr( implode( ' ', $css_classes ) ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
		
		<?php if (
			isset( $experience_theme_array['portfolio-header-background-image']['url'] )
			&& ( !function_exists( 'vc_asset_url' ) || $experience_theme_array['portfolio-header-parallax'] != "1" )
		) {
			experience_get_background( $experience_theme_array['portfolio-header-background-image']['url'] );
		} ?>
		
		<?php echo $flexbox_before; ?>
		
			<div class="section-header-content padding-h site-width">				
				<h1 class="heading-title">
					<?php if ( is_post_type_archive() ) {
						echo experience_resize_text( post_type_archive_title( '', false ) );
					} else {
						echo experience_resize_text( single_cat_title( '', false ) );
					} ?>
				</h1>
				<?php the_archive_description( '<span class="heading-subtitle">', '</span>' ); ?>
			</div>		
			<!-- END .section-header-content -->
			
			<?php if (
				isset( $experience_theme_array['portfolio-header-scroll-link'] )
				&& $experience_theme_array['portfolio-header-scroll-link'] == '1'
			) { ?>
				<span class="section-scroll-link">
					<span class="funky-icon-arrow-down"></span>
				</span>
			<?php } ?>
		
		<?php echo $flexbox_after; ?>
		
	</div>
	<!-- END .section-header -->
	
	<?php if (
		isset( $experience_theme_array['portfolio-archive-color-scheme'] )
		&& $experience_theme_array['portfolio-archive-color-scheme'] != ""
	) {		
		$color_scheme = 'color-scheme-'. $experience_theme_array['portfolio-archive-color-scheme'];
	} else {
		$color_scheme = 'color-scheme-4';
	} ?>
	
	<!-- BEGIN .section-content-wrapper -->
	<div class="section-content-wrapper <?php echo esc_attr( $color_scheme ); ?>">		
		
		<?php // Portfolio
		if (
			isset( $experience_theme_array['portfolio-layout'] )
			&& $experience_theme_array['portfolio-layout'] == 'vertical' 
		) {
			get_template_part( 'templates/portfolio', 'vertical' );
		} else {
			get_template_part( 'templates/portfolio', 'grid' );
		} ?>
		
		<?php experience_pagination_links(); ?>
	
	</div>
	<!-- END .section-content-wrapper -->
	
</section>
<!-- END .section-wrapper -->

<?php get_footer(); ?>