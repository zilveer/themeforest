<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 

			while ( have_posts() ) : the_post(); 

				$title_position = get_post_meta($post->ID, 'theme_portfolio_title', true);
				$title_position = ($title_position == 'above') ? 'above' : 'below';
				?>

				<?php if ($title_position == 'above') { ?>
					<nav class="nav-single">
						<h3 class="assistive-text"><?php _e( 'Portfolio navigation', 'framework' ); ?></h3>
						<span class="nav-previous"><?php theme_prev_portfolio_item( '<i class="fa fa-angle-left"></i>'); ?></span>
						<span class="nav-next"><?php theme_next_portfolio_item('<i class="fa fa-angle-right"></i>'); ?></span>
					</nav><!-- .nav-single -->

					<h1 class="page-title"><?php the_title(); ?></h1>				<?php } ?>

				<header class="post-header <?php echo 'title_'.$title_position; ?>">
					<?php 

					// Post formats that use the featured image (standard, image, audio)
					//................................................................
					$no_thumbnail = array('gallery', 'video');
					$media = get_the_post_thumbnail($post->ID, 'full-thumb');
					if ( $media && !in_array(get_post_format(), $no_thumbnail) ) : 
						?>
						<div class="featured-image">
							<div class="styled-image <?php echo get_post_format() ?>">
								<?php echo $media ?>
								<div class="inner-overlay"></div>
							</div>
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

				<?php if ($title_position == 'below') { ?>
					<nav class="nav-single">
						<h3 class="assistive-text"><?php _e( 'Portfolio navigation', 'framework' ); ?></h3>
						<span class="nav-previous"><?php theme_prev_portfolio_item( '<i class="fa fa-angle-left"></i>'); ?></span>
						<span class="nav-next"><?php theme_next_portfolio_item('<i class="fa fa-angle-right"></i>'); ?></span>
					</nav><!-- .nav-single -->

					<h1 class="page-title"><?php the_title(); ?></h1>
				<?php } ?>
				<div class="row-fluid">
					<div class="span8">

						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</div>
					<div class="span4">
						<div class="entry-meta portfolio-details">
							<?php 
								// Portfolio meta details
								if( $item_client = get_post_meta($post->ID, 'theme_portfolio_client', true) ) {
									echo '<h5>' . __('Client', 'framework') .'</h5><p>'. $item_client .'</p>';
								}
								if( $item_date = get_post_meta($post->ID, 'theme_portfolio_date', true) ) {
									echo '<h5>' . __('Date', 'framework') .'</h5><p>'. $item_date .'</p>';
								}
								if( $item_details = get_post_meta($post->ID, 'theme_portfolio_details', true) ) {
									echo '<div>'. stripslashes(htmlspecialchars_decode($item_details)) .'</div>';
								}
								if( $item_url = get_post_meta($post->ID, 'theme_portfolio_url', true) ) {
									echo '<h5 class="project-link"><a href="'. $item_url .'">'. __('View Project', 'framework') .' <i class="fa fa-angle-right"></i></a></h5><br>';
								}
							?>
						</div>

					</div>

					<footer class="entry-footer entry-meta">
						<span class="entry-portfolio-category"><?php the_terms($post->ID, 'portfolio-category', '', ', ', ''); ?></span>
					</footer><!-- .entry-meta -->

				</div>

				<?php 
			endwhile; // end of the loop. 

			edit_post_link( __( 'Edit', 'framework' ), '<span class="edit-link">', '</span>' ); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>