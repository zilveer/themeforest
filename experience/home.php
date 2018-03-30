<?php
/**
 * The latest post page template file
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

get_header(); ?>

<!-- BEGIN .section-wrapper -->
<section class="section-wrapper">
	
	<?php $parallax = $parallax_speed = $parallax_image = $video_bg_url = $flexbox_before = $flexbox_after = '';
	$wrapper_attributes = array();
	$css_classes = array();
	
	if ( $experience_theme_array['blog-header-parallax'] == "1" ) {
		
		$parallax = 'content-moving';
		$parallax_speed = '1.5'; // Maybe an option to toggle
		
		if ( 
			isset( $experience_theme_array['blog-header-parallax-speed'] ) 
			&& $experience_theme_array['blog-header-parallax-speed'] != ''
		) {
			$parallax_speed = $experience_theme_array['blog-header-parallax-speed'];
		}
		
		if ( 
			isset( $experience_theme_array['blog-header-background-image'] ) 
			&& $experience_theme_array['blog-header-background-image']['url'] != ''
		) {
			$parallax_image = $experience_theme_array['blog-header-background-image']['url'];
		}
		
		if ( 
			isset( $experience_theme_array['blog-header-background-video'] ) 
			&& $experience_theme_array['blog-header-background-video'] != ''
		) {
			$video_bg_url = $experience_theme_array['blog-header-background-video'];
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
	if ( isset( $experience_theme_array['blog-header-color-scheme'] )
		&& $experience_theme_array['blog-header-color-scheme'] != "" 
	) {		
		$css_classes[] = 'color-scheme-'. $experience_theme_array['blog-header-color-scheme'];
	} else {
		$css_classes[] = 'color-scheme-3';	
	}

	// Set section header size
	if ( $experience_theme_array['blog-header-type'] == 'fill' ) {
		$flexbox_before = '<div class="exp_ie-flexbox-fixer"><div class="exp-full-height exp-flexbox exp-content-middle"><div class="exp-flexbox-inner">';
		$flexbox_after = '</div></div></div>';
	} 
	?>
	
	<!-- BEGIN .section-header -->
	<div class="section-header <?php echo esc_attr( implode( ' ', $css_classes ) ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
		
		<?php if (
			isset( $experience_theme_array['blog-header-background-image']['url'] )
			&& ( !function_exists( 'vc_asset_url' ) || $experience_theme_array['blog-header-parallax'] != "1" )
		) {
			experience_get_background( $experience_theme_array['blog-header-background-image']['url'] );
		} ?>
		
		<?php echo $flexbox_before; ?>
		
			<!-- BEGIN .section-header-content -->
			<div class="section-header-content padding-h site-width">
				
				<?php if ( is_front_page() ) { ?>
				
					<h1 class="heading-title"><?php bloginfo( 'name' ); ?></h1>
					
					<?php if ( get_bloginfo( 'description' ) != '' ) { ?>
						<p class="heading-subtitle"><?php bloginfo( 'description' ); ?></p>
					<?php } ?>
					
				<?php } else { ?>
				
					<?php $save_post = $post;
					$post = get_post( get_option( 'page_for_posts' ) ); 
					$page_label = get_post_meta( $post->ID, 'experience_page_label', true );
					$page_intro = get_post_meta( $post->ID, 'experience_page_intro', true ); ?>
					
					<?php if ( $page_label != '' ) { ?>
						<span class="heading-label"><?php echo wp_kses( $page_label, array( 'img' => array( 'src' => array(), 'height' => array(), 'width' => array(), 'alt' => array() ) ) ); ?></span>
					<?php } ?>
					
					<h1 class="heading-title"><?php echo experience_resize_text( experience_the_title( false ) ); ?></h1>
					
					<?php if ( $page_intro != '' ) { ?>
						<p class="heading-subtitle"><?php echo wp_kses_post( $page_intro ); ?></p>
					<?php } ?>
					
					<?php $post = $save_post; ?>
				
				<?php } ?>
				
			</div>
			<!-- END .section-header-content -->
			
			<?php if (
				isset( $experience_theme_array['blog-header-scroll-link'] )
				&& $experience_theme_array['blog-header-scroll-link'] == '1'
			) { ?>
				<span class="section-scroll-link">
					<span class="funky-icon-arrow-down"></span>
				</span>
			<?php } ?>
	
		<?php echo $flexbox_after; ?>
		
	</div>
	<!-- END .section-header -->
	
	<?php if (
		isset( $experience_theme_array['post-archive-color-scheme'] )
		&& $experience_theme_array['post-archive-color-scheme'] != ""
	) {		
		$color_scheme = 'color-scheme-'. $experience_theme_array['post-archive-color-scheme'];
	} else {
		$color_scheme = 'color-scheme-4';
	} ?>
	
	<!-- BEGIN .section-content-wrapper -->
	<div class="section-content-wrapper <?php echo esc_attr( $color_scheme ); ?>">
	
		<?php get_template_part( 'templates/loop', 'grid' ); ?>

		<?php experience_pagination_links(); ?>
		
	</div>
	<!-- END .section-content-wrapper -->

</section>
<!-- END .section-wrapper -->

<?php get_footer(); ?>