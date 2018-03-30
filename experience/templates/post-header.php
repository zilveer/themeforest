<?php
/**
 * Post Header
 *
 * Post header content for most single.php template file.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/

global $experience_theme_settings; 

if ( get_post_meta( $post->ID, 'experience_header_bg_type', true ) != 'none' ) {
	
	$parallax = $parallax_speed = $parallax_image = $video_bg_url = $flexbox_before = $flexbox_after = '';
	$wrapper_attributes = array();
	$css_classes = array();

	$parallax = 'content-moving';
	
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
			$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
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
	if ( get_post_meta( $post->ID, 'experience_header_bg_type', true ) == 'fill' ) {
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
			
				<h1 class="heading-title"><?php the_title(); ?></h1>			
				
				<?php if (
					(
						!isset( $experience_theme_settings['post-meta-date'] )
						|| $experience_theme_settings['post-meta-date'] == "1"
					)
					|| (
						!isset( $experience_theme_settings['post-meta-author'] )
						|| $experience_theme_settings['post-meta-author'] == "1"
					)
					|| (
						!isset( $experience_theme_settings['post-meta-category'] )
						|| $experience_theme_settings['post-meta-category'] == "1"
					)
				) { ?>
				
					<!-- BEGIN .post-meta -->
					<div class="post-meta">
				
						<?php if (
							!isset( $experience_theme_settings['post-meta-author'] )
							|| $experience_theme_settings['post-meta-author'] == "1"
						) { ?>
							<span class="post-author">
								<?php printf( esc_html__( 'By %1$s', 'experience' ), get_the_author_meta( 'display_name' ) ); ?>
							</span>
						<?php } ?>
						
						<?php if (
							!isset( $experience_theme_settings['post-meta-date'] )
							|| $experience_theme_settings['post-meta-date'] == "1"					
						) { ?>
							<span class="post-date">
								
								<time class="published" datetime="<?php the_time( 'c' ); ?>">
								
									<?php if (
										!isset( $experience_theme_settings['post-meta-author'] )
										|| $experience_theme_settings['post-meta-author'] == "1"					
									) {
										printf( esc_html__( 'on %1$s', 'experience' ), get_the_time( get_option( 'date_format' ) ) );
									} else { 
										echo ucfirst( sprintf( esc_html__( 'on %1$s', 'experience' ), get_the_time( get_option( 'date_format' ) ) ) );
									} ?>
								
								</time>
								
								<time class="updated" datetime="<?php the_modified_date( 'c' ); ?>"><?php the_modified_date( get_option( 'date_format' ) ); ?></time>
								
							</span>
						<?php } ?>							
						
						<?php if (
							!isset( $experience_theme_settings['post-meta-category'] )
							|| $experience_theme_settings['post-meta-category'] == "1"					
						) { ?>
							<span class="post-category">
								
								<?php if (
									(
										!isset( $experience_theme_settings['post-meta-author'] )
										|| $experience_theme_settings['post-meta-author'] == "1"
									)
									|| (
										!isset( $experience_theme_settings['post-meta-date'] )
										|| $experience_theme_settings['post-meta-date'] == "1"
									)
								) {
									printf( esc_html__( 'in %1$s' ,'experience' ), get_the_category_list( ", " ) );
								} else {
									echo ucfirst( sprintf( esc_html__( 'in %1$s' ,'experience' ), get_the_category_list( ", " ) ) );
								} ?>
								
							</span>
						<?php } ?>					

					</div>
					<!-- END .post-meta -->
					
				<?php } ?>
			
			</div>
			<!-- END .section-header-content -->
			
		<?php echo $flexbox_after; ?>
		
		<?php // Scroll to section link
		if ( get_post_meta( $post->ID, 'experience_header_scroll_link', true ) == 'on' ) { ?>
			
			<span class="section-scroll-link">
				<span class="funky-icon-arrow-down"></span>
			</span>
			
		<?php } ?>
		
	</div>
	<!-- END .section-header -->
	
<?php } ?>