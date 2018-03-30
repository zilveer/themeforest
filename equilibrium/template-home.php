<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>	
 	
	<?php 
	$intro_text = of_get_option( 'intro_text' );
	$slider_disabled = intval( of_get_option( 'slider_disabled', '0' ) );
	$latest_articles_enabled = intval( of_get_option( 'latest_articles_enabled', '0' ) );
	$projects_per_row = intval( of_get_option( 'number_of_featured_projects_per_row', '3' ) ); //get the number of latest project to display on the home page
	$number_of_rows = intval( of_get_option( 'number_of_featured_project_rows', '3' ) );
	$image_width = 218;
	$image_height = 175;
	$quality = 90;
	$grid_class = 'grid_3';
	$items_count_class = 'four-items-per-row';
	$portfolio_page_id = intval( of_get_option( 'portfolio_link' ) );
	$portfolio_url = get_page_link( $portfolio_page_id );
	$has_posts_page = get_option('page_for_posts'); // Retrieves 0 if the page for posts isn't defined
	$blog_url = '';

	if($has_posts_page) {
		$blog_url = get_page_link(get_option('page_for_posts')); 
	}
			
	// Override the default settings if the number of projects per row is not four
	if ( $projects_per_row === 3 ) {
		$image_width = 300;
		$image_height = 210;
		$grid_class = 'grid_4';
		$items_count_class = 'three-items-per-row';
	}
	else if ( $projects_per_row === 2 ) {
		$image_width = 460;
		$image_height = 330;
		$grid_class = 'grid_6';
		$items_count_class = 'two-items-per-row';
	}		     
	?>
	
	<?php if( $intro_text ) { // display the introduction text if it's defined in the theme options panel ?>
		<!-- START #intro-section -->
	    <section id="intro-section">
	    	<h1 id="main-headline"><?php echo $intro_text; ?></h1>
	    </section>  
	    <!-- END #intro-section -->
    <?php } ?>
    
    <?php if( !( $slider_disabled ) ) { // If the slider is not disabled, embed it in the page ?>
    		
 		<?php get_template_part('slider'); ?>
 		
	<?php } ?>     
	
		<!-- START .latest-projects -->
		<section class="latest-projects group <?php echo $projects_class = ( $slider_disabled && !$intro_text ) ? 'no-slider-and-intro ' : 'with-slider-or-intro '; echo $items_count_class; ?>">
			
			<!-- START .section-title -->		
			<h2 class="section-title"><?php _e( 'Latest Projects', 'onioneye' ); ?> <a href="<?php echo $portfolio_url; ?>" title="<?php _e( 'Go to the portfolio page', 'onioneye'); ?>"><?php _e( 'View All', 'onioneye' ); ?> <span>&rarr;</span></a></h2>
			<!-- END .section-title -->
			
			<?php 
			$count = 0;
			$args = array( 'post_type' => 'portfolio', 'posts_per_page' => ( $projects_per_row * $number_of_rows ) );  
    	    $loop = new WP_Query( $args );
   	   		
			//output the latest projects from the 'my_portfolio' custom post type
	        while ($loop->have_posts()) : $loop->the_post();
				$count++;
				$preview_img_url = eq_get_the_preview_img_url();
			?>
			
				<!-- START .latest-project -->
				<div class="latest-project <?php echo $grid_class; if ( $count === 1 ) { echo " alpha"; } elseif ( $count === $projects_per_row ) { echo " omega"; $count = 0; } ?>">
					
					<?php if ($preview_img_url) { ?>
						
				    	<?php $large_image_url = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $preview_img_url ), 'full'); ?>
				    	
				    	<a class="project-link" href="<?php the_permalink(); ?>" title="<?php _e( 'Have a closer look at this portfolio item', 'onioneye' ); ?>">
				    		<img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $large_image_url[0]; ?>&amp;h=<?php echo $image_height; ?>&amp;w=<?php echo $image_width; ?>&amp;q=<?php echo $quality; ?>" alt="<?php _e( 'Portfolio Item', 'onioneye' ); ?>" /> 
				    		<span>view project</span>
				    	</a>
			    	
			    	<?php } ?>
			    	
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<!-- END .latest-project -->
			
			<?php endwhile; ?>
			
		</section>
		<!-- END .latest-projects -->
		
		
		<?php if( $latest_articles_enabled ) { ?>
			
			<!-- START .latest-articles -->
			<section class="latest-articles group">
				
				<!-- START .section-title -->		
				<h2 class="section-title"><?php _e( 'Latest Articles', 'onioneye' ); ?> <a href="<?php echo $blog_url; ?>" title="<?php _e( 'Visit the blog page', 'onioneye'); ?>"><?php _e( 'View All', 'onioneye' ); ?> <span>&rarr;</span></a></h2>
				<!-- END .section-title -->
				
				<!-- START #latest-articles-slider -->
				<div id="latest-articles-slider">
					<div>
						<!-- START .slides_container -->
						<div class="slides_container">
				
						<?php 
						$posts_count = 6;
					    query_posts( array( 'post__not_in' => get_option( 'sticky_posts' ), 'posts_per_page' => $posts_count )); 
							 
						if ( have_posts() ) : while ( have_posts() ) : the_post(); 
						?>
						
							<!-- START .latest-article -->
							<article class="latest-article grid_8 alpha">
								
								<?php if ( has_post_thumbnail() ) { ?>
							
									<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
						    		
						    		<a href="<?php the_permalink(); ?>" class="grid_4 alpha">
						    	   		<img width="300" height="210" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $large_image_url[0]; ?>&amp;h=210&amp;w=300&amp;q=90" alt="<?php _e( 'Post Thumbnail', 'onioneye' ); ?>" />
						    		</a>
									
								<?php } else { ?>
									
									<a href="<?php the_permalink(); ?>" class="grid_4 alpha">
						    	   		<img width="300" height="210" src="<?php echo get_template_directory_uri(); ?>/images/layout/no-thumb.gif" alt="<?php _e( 'Post Thumbnail', 'onioneye' ); ?>" />
						    		</a>
						    		
								<?php } ?>
								
									<!-- START .latest-article-content -->
									<div class="latest-article-content grid_4 omega">
										<h3 class="latest-article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php wpe_excerpt( 'wpe_excerptlength_teaser', 'new_excerpt_more' ); ?>
									</div>
									<!-- END .latest-article-content -->
								
							</article>
							<!-- END .latest-article -->
						
						<?php endwhile; endif; ?>
						<?php wp_reset_query(); ?>
			
						</div>
						<!-- END .slides_container -->
					</div>
						
					<!-- START .latest-articles-pagination -->
					<ul class="latest-articles-pagination grid_4 omega">
							
					<?php 
					query_posts( array( 'post__not_in' => get_option( 'sticky_posts' ), 'posts_per_page' => $posts_count )); 
					$image_width = 94;
					$image_height = 98;
					$quality = 90;
							 
					if ( have_posts() ) : while ( have_posts() ) : the_post(); 
					?>
						
						<li>
								
							<?php if ( has_post_thumbnail() ) { ?>
									
								<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
							    		
							   	<a href="#">
						    		<img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $large_image_url[0]; ?>&amp;h=<?php echo $image_height; ?>&amp;w=<?php echo $image_width; ?>&amp;q=<?php echo $quality; ?>" alt="<?php _e( 'Post Thumbnail', 'onioneye' ); ?>" />
								</a>
							   		
							<?php } else { ?>
									
								<a href="<?php the_permalink(); ?>" class="grid_4 alpha">
						    		<img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" src="<?php echo get_template_directory_uri() . '/images/layout/no-thumb-small.gif'; ?>" alt="<?php _e( 'Post Thumbnail', 'onioneye' ); ?>" />
					    		</a>
						    		
							<?php } ?>
							   	
						</li>
					
						
					<?php endwhile; endif; ?>
					<?php wp_reset_query(); ?>
						
					</ul>
					<!-- END .latest-articles-pagination -->
					
				</div>
				<!-- END #latest-articles-slider -->
				
			</section>
			<!-- END .latest-articles -->
			
		<?php } ?>
	
<?php get_footer(); ?>