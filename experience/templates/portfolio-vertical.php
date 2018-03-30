<?php
/**
 * Portfolio archive vertical layou
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

if ( have_posts() ) : ?>

	<!-- BEGIN .post-container -->
	<div class="post-container">
	
		<?php while ( have_posts() ) : the_post();
			
			$parallax = $parallax_speed = $parallax_image = $video_bg_url = $flexbox_before = $flexbox_after = '';
			$wrapper_attributes = array();
			$css_classes = array();
			
			if ( has_post_thumbnail() ) {
				$background_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$background_image = $background_image[0];
				$parallax_image = esc_attr( $background_image );
			}
	
			if ( $experience_theme_array['portfolio-parallax'] == "1" ) {
			
				$parallax = 'content-moving';
				$parallax_speed = '1.5';
				
				if ( 
					isset( $experience_theme_array['portfolio-parallax-speed'] ) 
					&& $experience_theme_array['portfolio-parallax-speed'] != ''
				) {
					$parallax_speed = $experience_theme_array['portfolio-parallax-speed'];
				}

				if ( get_post_meta( $post->ID, 'experience_portfolio_item_background_video', true ) != '' ) {
					$video_bg_url = esc_attr( get_post_meta( $post->ID, 'experience_portfolio_item_background_video', true ) );
				}

				$has_video_bg = ( ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

				if ( $has_video_bg ) {
					$parallax_image = $video_bg_url;
					$css_classes[] = 'vc_video-bg-container';	
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
			if ( get_post_meta( $post->ID, 'experience_portfolio_item_preview_color_scheme', true ) != "" ) {		
				$css_classes[] = 'color-scheme-'. get_post_meta( $post->ID, 'experience_portfolio_item_preview_color_scheme', true );
			}
			
			if ( $experience_theme_array['portfolio-fill-screen'] == '1' ) {
				$flexbox_before = '<div class="exp_ie-flexbox-fixer"><div class="exp-full-height exp-flexbox exp-content-middle"><div class="exp-flexbox-inner">';
				$flexbox_after = '</div></div></div>';
			} ?>
			
			<!-- BEGIN .section-header -->
			<div class="section-header ajax-item <?php echo esc_attr( implode( ' ', $css_classes ) ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
				
				<?php if (
					!empty( $background_image )
					&& ( !function_exists( 'vc_asset_url' ) || $experience_theme_array['portfolio-parallax'] != "1" )
				) {
					experience_get_background( $background_image );
				} ?>
				
				<?php echo $flexbox_before; ?>
				
					<!-- BEGIN .section-header-content -->
					<div class="section-header-content padding-h narrow-width">
						
						<?php $page_label = get_post_meta( $post->ID, 'experience_page_label', true );
						if ( $page_label != "" ) { ?>
							<span class="heading-label"><?php echo wp_kses( $page_label, array( 'img' => array( 'src' => array(), 'height' => array(), 'width' => array(), 'alt' => array() ) ) ); ?></span>
						<?php } ?>
						
						<h2 class="heading-title"><?php echo experience_resize_text( get_the_title() ); ?></h2>
						
						<a class="vc_btn3" href="<?php the_permalink(); ?>"><?php esc_html_e( "See More", 'experience' ); ?></a>
				
					</div>
					<!-- END .section-header-content -->
				
				<?php echo $flexbox_after; ?>
				
			</div>
			<!-- END .section-header -->
			
		<?php endwhile; ?>
		
	</div>
	<!-- END .post-container -->
	
<?php else :

	echo '<p>'. esc_html__( "There are no posts to display.", 'experience' ).'</p>';

endif;