<?php get_header();  

	// Get the portfolio category
	$term  = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

	?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<header class="archive-header">
				<h1 class="archive-title"><?php echo $term->name; ?></h1>
			</header><!-- .archive-header -->

			<?php

			// Setup the query 
			$args = array(
				'post_type' => 'portfolio',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				// 'posts_per_page' => -1,
				'paged' => $paged,
				'portfolio-category' => $term->slug
			);
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) : ?>

				<div class="row-fluid">

				<?php
				$item_count = 0;

				// Loop through the items
				while ( $the_query->have_posts() ) : $the_query->the_post();  
					
					// Get associated categories
					$terms =  get_the_terms( $post->ID, 'portfolio-category' ); 
					$term_list = '';
					if( is_array($terms) ) {
						foreach( $terms as $term ) {
							$term_list .= urldecode($term->slug) . ' ';
						}
					}

					// Details page link
					$link_to_details  = get_permalink();

					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item '. $term_list); ?>>
						<div class="row-fluid">

							<header class="post-header span5">
								<?php 

								// Post formats that use the featured image (standard, image, audio)
								// --------------------------------------------------------------------
								$no_thumbnail = array('gallery', 'video');
								$media = get_the_post_thumbnail($post->ID, 'portfolio-thumb');
								if ( $media && !in_array(get_post_format(), $no_thumbnail) ) : 
									// A few items we need to create the media items
									$link_class       = 'styled-image '. get_post_format();
									$link_title       = sprintf( __( 'Permalink to %s', 'framework' ), the_title_attribute( 'echo=0' ) );
									$link_to_lightbox = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full-width-thumb' );
									?>
									<div class="featured-image">
										<a href="<?php echo $link_to_details ?>" class="<?php echo $link_class ?>" title="<?php echo $link_title ?>" rel="bookmark"><?php echo $media ?><div class="inner-overlay"></div></a>
									</div>
									<?php 
								endif;

								// Media selected by post format
								switch( get_post_format() ) {

									case "audio" :
										// Audio Player
										theme_audio_player($post->ID);
										break;
									case "gallery" :
										// Gallery slide show (rotator)
										$size  = get_post_image_size( 'full-thumb' );
										// Check for specific width and height settings
										$max_w = '';
										$max_h = '';
										$style = '';
										if (is_array($size)) {
											if ($size[0] != 0) $max_w = 'max-width: '.$size[0].'px;';
											if ($size[1] != 0) $max_h = 'max-height: '.$size[0].'px;';
											$style = 'style="'.$max_w.' '.$max_h.'"';
											$size = $size[0].'x'.$size[1];
										}
										$rotatorParams = array(
											'columns'      => 1, 
											'type'         => 'post-gallery',
											'image_size'   => $size,
											'transition'   => 'fade', 
											'slide_paging' => 'true', 
											'autoplay'     => 'true',
											'interval'     => '3500',
											'class'        => 'slideshow'
										);
										?>
										<div class="featured-image" <?php echo $style ?>>
											<div class="styled-image <?php echo get_post_format() ?>"><?php echo theme_content_rotator( $rotatorParams ); ?></div>
										</div>
										<?php
										break;
									case "video" :
										// Video Player or Embed
										theme_video_player($post->ID);
										break;
								} ?>
							</header>

							<div class="span7">

								<?php theme_post_title( $post->ID, 'h2'); ?>

								<div class="entry-summary">
									<?php the_excerpt(); ?>
								</div><!-- .entry-summary -->

								<div class="entry-meta portfolio-details">
									<?php 
										// Portfolio meta details
										if( $item_client = get_post_meta($post->ID, 'theme_portfolio_client', true) ) {
											echo '<span class="item-detail"><h6>' . __('Client:', 'framework') .'</h6> '. $item_client .'</span>';
										}
										if( $item_date = get_post_meta($post->ID, 'theme_portfolio_date', true) ) {
											echo '<span class="item-detail"><h6>' . __('Date:', 'framework') .'</h6> '. $item_date .'</span>';
										}
										
										echo '<span class="item-detail details-button"><a href="'. $link_to_details .'" class="btn small">'. __('Details', 'framework') .'</a></span>';
										
										if( $item_url = get_post_meta($post->ID, 'theme_portfolio_url', true) ) {
											echo '<span class="item-detail details-button"><a href="'. $item_url .'" class="btn small" target="_blank">'. __('View Project', 'framework') .'</a></span>';
										}
									?>
								</div>

								<footer class="entry-footer entry-meta">
									<span class="entry-portfolio-category"><?php the_terms($post->ID, 'portfolio-category', '', ', ', ''); ?></span>
								</footer><!-- .entry-meta -->

							</div><!-- .span6 -->

						</div><!-- .row-fluid -->

					</article><!-- #post -->

					<?php 

					$item_count++;

				endwhile;

				// Show paging
				get_pagination($the_query); 

			endif; // end have_posts() check
			?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>