<?php 

/* 
Template Name: Homepage 
*/ 

?>

<?php 
	// Fetch options stored in $qns_data
	global $qns_data; 
?>

<?php get_header(); ?>

	<?php // Display Slideshow 
		if ( $qns_data['slideshow_display'] ) : 

			query_posts( "post_type=slideshow&posts_per_page=9999" );
				if( have_posts() ) : ?>
					
					<!-- BEGIN .slider -->
					<div class="slider clearfix">
						<ul class="slides">
							
							<?php while( have_posts() ) : the_post(); ?>

							<?php	
								// Get slideshow date
								$slideshow_image = get_post_meta($post->ID, $prefix.'slideshow_image', true);
								$slideshow_link = get_post_meta($post->ID, $prefix.'slideshow_link', true);
								$slideshow_caption = get_post_meta($post->ID, $prefix.'slideshow_caption', true);
								$slideshow_vimeo = get_post_meta($post->ID, $prefix.'slideshow_vimeo', true);			
							?>
						
							<li>			
							
							<?php
								
								if ( $slideshow_vimeo != '' ) {
									echo '<iframe id="player_1" src="http://player.vimeo.com/video/' . $slideshow_vimeo . '?api=1&amp;player_id=player_1" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
								}
								
								else {
									
									// If link is set
									if ( $slideshow_link != '' ) {
										echo '<a href="' . $slideshow_link . '">';
									}

									// If featured image is set use this 
									if( has_post_thumbnail() ) {
										$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slideshow-big' );
										echo '<img src="' . $src[0] . '" alt="" />';
									}

									// Else if image url is set use this 
									elseif ( $slideshow_image != '' ) { ?>
										<img src="<?php echo $slideshow_image; ?>" alt="" />
									<?php }

									// If link is set
									if ( $slideshow_link != '' ) {
										echo '</a>';
									}

									// Display caption if it is set
									if ( $slideshow_caption != '' ) { ?>
										<div class="flex-caption"><?php echo $slideshow_caption; ?></div>
									<?php } 
									
								}
								
								?>
							
							</li>

							<?php endwhile; ?>
						
						</ul>
					<!-- END .slider -->
					</div>
						
				<?php endif; ?>
			<?php endif; ?> 
	
			<?php // Announcement Message
				if ($qns_data['homepage_announcement'] ) : ?>
					<!-- BEGIN .section -->
					<div class="section section-intro">
						<h2 class="site-intro">
							<?php _e($qns_data['homepage_announcement'],'qns'); ?>
						</h2>
					<!-- END .section -->
					</div>	
				<?php endif; ?>

				<?php if(is_plugin_active('woocommerce/woocommerce.php')) { ?>
		
			<?php // Display Shop Featured Product
				if ( $qns_data['featured_products_display'] ) {
			?>
		
			<!-- BEGIN .section-mini2 -->
			<div class="section-mini2">
	
				<div class="tag-title-wrap clearfix">
					<h4 class="tag-title"><?php _e('Featured Products','qns'); ?></h4>
				</div>
				
				<?php // Set Number of Shop Featured Products
					if ( $qns_data['featured_products_display_number'] ) {
						$featured_products_display_number = $qns_data['featured_products_display_number'];
					}
					else {
						$featured_products_display_number = '4';
					}
				?>
			
				<?php _e(do_shortcode('[featured_products per_page="' . $featured_products_display_number . '" columns="4"]'),'qns'); ?>
		
			<!-- END .section-mini2 -->
			</div>
	
			<?php } ?>
		<?php } ?>

	<?php if ($qns_data['homepage_testimonial_ids'] != '') : ?>
	
	<!-- BEGIN .section -->
	<div class="section">
			
		<div class="tag-title-wrap clearfix">
			<h4 class="tag-title"><?php _e('Testimonials','qns'); ?></h4>
		</div>
		
		<?php
			
			$count = 0;
			$testimonial_posts = $qns_data['homepage_testimonial_ids'];
			$post_in = explode(',', $testimonial_posts);
			
			$args = array(
				'post_type'		=> 'testimonial',
				'post__in'		=> $post_in,
				'numberposts'   => 9999
			);
	
			query_posts($args);
    		if( have_posts() ) :
			?>
			
			<ul class="columns-2 clearfix">
			
			<?php

			while( have_posts() ) : the_post(); ?>

				<?php
					// Get testimonial date
					$testimonial_author = get_post_meta($post->ID, $prefix.'testimonial_author', true);
					$testimonial_product = get_post_meta($post->ID, $prefix.'testimonial_product', true);
				?>

					<li class="col2">

					<div class="testimonial-wrapper clearfix">
						
						<div class="testimonial-author-image">
						<?php
							if(has_post_thumbnail()) {
								$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-thumb' );
								echo '<img src="' . $src[0] . '" alt="" />';
							}
							else {
								echo '<img src="' . get_template_directory_uri() .'/images/author.png" alt="" />';
							}
						?>
						</div>

						<div class="testimonial-text"><?php the_content(); ?></div>
						<div class="testimonial-speech"></div>
						
					</div>

					<p class="testimonial-author"><?php echo $testimonial_author; ?> - <span><?php echo $testimonial_product ?></span></p>
				
				
				</li>
				
			<?php endwhile; endif; ?>
		
		</ul>
		
	<!-- END .section -->
	</div>
	
	<?php endif; ?>
	
	<?php if ( $qns_data['homepage_text_block'] ) { ?>
		<!-- BEGIN .section -->
		<div class="section">
			<?php echo do_shortcode($qns_data['homepage_text_block']); ?>
		</div>
	<?php } ?>
	
<?php get_footer(); ?>