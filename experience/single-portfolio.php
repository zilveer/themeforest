<?php
/**
 * The single portfolio template
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

get_header(); ?>

<!-- BEGIN .section-wrapper -->
<div class="section-wrapper">
	
	<?php while ( have_posts() ) : the_post();		
		
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
					$parallax_image = get_post_meta( $post->ID, 'experience_header_bg_image', true );
				}

				if ( get_post_meta( $post->ID, 'experience_header_bg_video', true ) != '' ) {
					$video_bg_url = get_post_meta( $post->ID, 'experience_header_bg_video', true );
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
					$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image ) . '"';
				}
				if ( ! $parallax && $has_video_bg ) {
					$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
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
			}
			?>
			
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
			
		<?php } ?>
		
		<?php if ( // Post Meta
			get_post_meta( $post->ID, 'experience_portfolio_item_client', true ) != ""
			|| get_post_meta( $post->ID, 'experience_portfolio_item_link', true )  != ""						
			|| (
				has_term( false, 'portfolio_tag', $post->ID )
				&& (
					!isset( $experience_theme_array['portfolio-item-meta-tags'] )
					|| $experience_theme_array['portfolio-item-meta-tags'] == "1"
				)
			)
		) { ?>
		
			<?php if (
				isset( $experience_theme_array['portfolio-meta-color-scheme'] )
				&& $experience_theme_array['portfolio-meta-color-scheme'] != ""
			) {		
				$meta_color_scheme = 'color-scheme-'. $experience_theme_array['portfolio-meta-color-scheme'];
			} else {
				$meta_color_scheme = 'color-scheme-2';
			} ?>
			
			<!-- BEGIN .portfolio-meta -->
			<div class="portfolio-meta <?php echo esc_attr( $meta_color_scheme ); ?>">
			
				<div class="site-width padding-h clearfix">
					
					<div class="col-padding">
					
						<?php if ( get_post_meta( $post->ID, 'experience_portfolio_item_client', true ) != "" ) { ?>
							
							<div class="third">
							
								<!-- Client -->
								<h5><?php esc_html_e( "Client: ", 'experience' ); ?></h5>
								<?php echo wp_kses( get_post_meta( $post->ID, 'experience_portfolio_item_client', true ), array( 'a' => array( 'href' => array(), 'target' => array(), 'title' => array() ) ) ); ?>
								
							</div>
							
						<?php } ?>
						
						<?php if ( 
							has_term( false, 'portfolio_tag', $post->ID )
							&& (
								!isset( $experience_theme_array['portfolio-item-meta-tags'] )
								|| $experience_theme_array['portfolio-item-meta-tags'] == "1"
							)
						){ ?>
						
							<div class="third">
							
								<!-- Tags -->
								<h5><?php esc_html_e( "Tags: ", 'experience' ); ?></h5>
								<?php echo get_the_term_list( $post->ID, 'portfolio_tag', "",", " ); ?>
						
							</div>
							
						<?php } ?>
						
						<?php if ( get_post_meta( $post->ID, 'experience_portfolio_item_link', true ) != "" ) { ?>
						
							<div class="third end">
							
								<!-- Link -->
								<a class="vc_btn3" href="<?php echo esc_url( get_post_meta( $post->ID, 'experience_portfolio_item_link', true ) ); ?>" target="_blank"><?php esc_html_e( "Link &rarr;", 'experience' ); ?></a>
							
							</div>
							
						<?php } ?>
				
					</div>
					
				</div>
				
			</div>
			<!-- END .portfolio-meta -->					
		
		<?php } ?>
	
		<!-- BEGIN .section-content-wrapper -->
		<div class="section-content-wrapper">			
		
			<?php // Set page content padding and width if not using VC
			$the_content = get_the_content();	
			
			if ( 
				!function_exists( 'vc_asset_url' )
				|| strpos( $the_content, '[vc_row' ) === false
			) {
				$content_before = '<div class="row-container padding-h padding-v site-width"><div class="col-padding-adjustment">';
				$content_after = '</div></div>';
			} else {
				$content_before = '';
				$content_after = '';				
			} ?>
			
			<!-- BEGIN .section-content -->
			<div class="section-content">
				
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
					
					<?php echo $content_before; ?>
					
					<?php the_content(); ?>
					
					<?php wp_link_pages( array(
						'before'		=> '<div class="wp-link-pages">',
						'after'			=> '</div>',
						'separator'     => '<span class="pagination-separator"></span>',
						'link_before'   => '<span class="pagination-button">',
						'link_after'    => '</span>',
					) ); ?>
					
					<?php echo $content_after; ?>
					
				</div>
				<!-- END .post-content -->
			
			</div>
			<!-- END .section-content -->
		
		</div>
		<!-- END .section-content-wrapper -->
		
		<!-- comments -->
		<?php comments_template(); ?>
		
		<?php // Related Posts
			if (
			isset( $experience_theme_array['portfolio-related-posts-grid-width'] )
			&& $experience_theme_array['portfolio-related-posts-grid-width'] != ''
			&& $experience_theme_array['portfolio-related-posts-grid-width'] != 'none'
		) {		
		
			$categories = wp_get_post_terms( $post->ID, 'portfolio_category' );
		
			if ( $categories ) {
				
				$cat_ids = array();
				
				foreach( $categories as $cat) {
					$cat_ids[] = $cat->term_id;				
				}
				
				if ( 
					isset( $experience_theme_array['portfolio-related-posts-grid-width'] )
					&& $experience_theme_array['portfolio-related-posts-grid-width'] == 'narrow-width'
				) {
					$grid_width = 'narrow-width';
					$num_posts = 2;
				} elseif (
					isset( $experience_theme_array['portfolio-related-posts-grid-width'] )
					&& $experience_theme_array['portfolio-related-posts-grid-width'] == 'fluid-width'
				) {
					$grid_width = '';
					$num_posts = 3;
				} else {				
					$grid_width = 'site-width';
					$num_posts = 2;
				}
				
				$args = array(
					'post_type'	=> 'portfolio',
					'tax_query' => array(
						'taxonomy'		=> 'portfolio_category',
						'field'			=> 'term_id',
						'terms'			=> $cat_ids
					),
					'post__not_in'			=> array( $post->ID ),
					'posts_per_page'		=> $num_posts,
					'ignore_sticky_posts'	=> 1
				);
			 
				$related_posts_query = new WP_query( $args );
				
				if ( $related_posts_query->have_posts() ) { ?>
					
					<?php if (
						isset( $experience_theme_array['portfolio-archive-color-scheme'] )
						&& $experience_theme_array['portfolio-archive-color-scheme'] != ""
					) {		
						$related_posts_color_scheme = 'color-scheme-'. $experience_theme_array['portfolio-archive-color-scheme'];
					} else {
						$related_posts_color_scheme = 'color-scheme-4';
					} ?>
					
					<!-- BEGIN .section-content-wrapper -->
					<div class="section-content-wrapper <?php echo esc_attr( $related_posts_color_scheme ); ?>">
						
						<div class="padding-v text-align-center">
							<h2 class="margin-v-none"><?php esc_html_e( 'Related', 'experience' ); ?></h2>
						</div>
						
						<!-- BEGIN .post-grid -->
						<div class="post-grid portfolio-grid post-container clearfix <?php echo esc_attr( $grid_width ); ?>">
						
							<?php while( $related_posts_query->have_posts() ) : $related_posts_query->the_post(); ?>
								
								<?php // Set colour scheme
								if ( get_post_meta( $post->ID, 'experience_portfolio_item_preview_color_scheme', true ) != "" ) {		
									$portfolio_item_color_scheme = 'color-scheme-'. get_post_meta( $post->ID, 'experience_portfolio_item_preview_color_scheme', true );
								} else {
									$portfolio_item_color_scheme = '';
								} ?>
			
								<!-- BEGIN .post-grid-item -->
								<article class="post-grid-item post-item <?php echo esc_attr( $portfolio_item_color_scheme ); ?>" ontouchstart="">
									
									<!-- BEGIN .post-grid-item-image -->
									<div class="post-grid-item-image">
									
										<?php // Background Image
										$background_image = false;
										if ( has_post_thumbnail() ) {
											$background_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-grid' );
											$background_image = $background_image[0];
										}			
										
										experience_get_background( $background_image ); ?>
									
									</div>
									<!-- END .post-grid-item-image -->
									
									<!-- BEGIN .post-grid-item-content -->
									<div class="post-grid-item-content">
					
										<span class="post-grid-item-content-bg"></span>
										
										<div class="holder">
										
											<div class="cont">
												
												<?php if ( $experience_theme_array['portfolio-grid-hide-title'] != '1' ) { ?>
													<h2><?php the_title(); ?></h2>
												<?php } ?>

											</div>							
										
										</div>					
										
										<div class="holder">
										
											<div class="cont">
												
												<?php if ( $experience_theme_array['portfolio-grid-link-type'] == 'title' ) { ?>
													<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
												<?php } else { ?>
													<a class="vc_btn3" href="<?php the_permalink(); ?>"><?php esc_html_e( "View", 'experience' ); ?></a>							
												<?php } ?>
												
											</div>							
										
										</div>
										
									</div>
									<!-- BEGIN .post-grid-item-content -->
									
								</article>
								<!-- BEGIN .post-grid-item -->
				 
							<?php endwhile; ?>
							
						</div>
						<!-- BEGIN .post-grid -->						
		
					</div>
					<!-- BEGIN .section-content-wrapper -->
				
				<?php }
				
				wp_reset_postdata();
			
			}
			
		} ?>

	<?php endwhile; ?>
	
</div>
<!-- END .section-wrapper -->

<?php get_footer(); ?>