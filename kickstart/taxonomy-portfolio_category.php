<?php get_header(); ?>
<div id="container_bg">
	<div id="pf-content">
		<ul class="filterable-grid pf-two-columns">	
			<?php while (have_posts()) : the_post(); ?>
					<li>
						<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
							$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
							$large_image = $large_image[0]; 
						
							echo '<img src="'. aq_resize( $large_image, '460', '290', true ) .'" />';								
						} ?>	
						
				<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					<img src="<?php echo $portfolio_img; ?>" />				
				<?php endif; ?>	
				
				<?php {
					echo '<div class="mask">';
						if (get_post_meta($post->ID, 'portfolio_video_link', true)) {
							echo '<a href="', get_post_meta($post->ID, 'portfolio_video_link', true) .'" class="pf-zoom"><i class="moon-movie"></i></a>';
						} else {
							echo '<a href="', $large_image .'" class="pf-zoom"><i class="moon-camera-3"></i></a>';
						}
						echo '<a href="', the_permalink() .'" class="pf-info"><i class="moon-link-4"></i></a>
					</div><div class="pf-title">'. get_the_title() .'</div>';
				} ?>
					</li>
							
					<?php endwhile; ?>
			<div class="clear"></div>
		</ul>
				
		<div class="post-navigation">
			<?php 
				if ( function_exists('wp_pagenavi')) {
						wp_pagenavi();
				} 
			?>
		</div>
		
	<div class="clear"></div>
	</div><!-- #content-->
</div><!-- #container -->
<?php get_footer(); ?>
