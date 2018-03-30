<?php 

/* 
Template Name: Testimonials
*/ 

// Fetch options stored in $qns_data
global $qns_data;

?>

<?php get_header(); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
	
	<!-- BEGIN .section -->
	<div class="section">
		
		<ul class="columns-content page-content testimonial-full clearfix">
			
			<!-- BEGIN .col-main -->
			<li class="<?php echo sidebar_position('primary-content'); ?>">
			
				<h2 class="page-title"><?php the_title(); ?></h2>
			
				<?php the_content(); ?>
				
				<?php
					if( $qns_data['items_per_page'] ) { 
						$testimonial_perpage = $qns_data['items_per_page'];
					}
					else {
						$testimonial_perpage = '10';
					}
				
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
					query_posts( "post_type=testimonial&posts_per_page=$testimonial_perpage&paged=$paged" );

			    	if( have_posts() ) :
					while( have_posts() ) : the_post(); ?>

						<?php	
							// Get testimonial date
							$testimonial_author = get_post_meta($post->ID, $prefix.'testimonial_author', true);
							$testimonial_product = get_post_meta($post->ID, $prefix.'testimonial_product', true);			
						?>

						<div class="testimonial-wrapper clearfix">
								
							<?php				
								if(has_post_thumbnail()) {
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-thumb' );
									echo '<img src="' . $src[0] . '" alt="" class="testimonial-author-image" />';
								}
								else {
									echo '<img src="' . get_template_directory_uri() .'/images/author.png" alt="" class="testimonial-author-image" />';
								}			
							?>

							<div class="testimonial-text"><?php the_content(); ?></div>
							<div class="testimonial-speech"></div>
						</div>

						<p class="testimonial-author"><?php echo $testimonial_author; ?> - <span><?php echo $testimonial_product ?></span></p>
							
					<?php endwhile; else : ?>

						<p><?php _e('No testimonials have been added yet','qns'); ?></p>
					
					<?php endif; ?>

				<?php // Include Pagination feature
					load_template( get_template_directory() . '/includes/pagination.php' );
				?>	
							
			<!-- END .col-main -->
			</li>

			<?php get_sidebar(); ?>
		
		</ul>
		
	<!-- END .section -->
	</div>

<?php get_footer(); ?>