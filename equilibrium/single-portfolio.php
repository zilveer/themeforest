<?php get_header(); ?>

		<?php $grid_classes = 'grid_9 omega group'; ?>
		<?php $quality = 90; ?>
		<?php $desired_width = 680; ?>
		<?php $desired_height = 500; ?>
		<?php $portfolio_page_id = intval( of_get_option( 'portfolio_link' ) ); ?>
		<?php $portfolio_url = get_page_link( $portfolio_page_id ); ?>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
			<?php $video_embed_code = eq_get_the_portfolio_video_embed_code(); ?>
			<?php $portfolio_images = eq_get_the_portfolio_images(); ?>
			<?php $terms = get_the_terms( $post->ID , 'portfolio_categories', 'string' ); ?>
			
			<!-- START .section-title -->		
			<h1 class="project-title section-title"><?php the_title(); ?> <a href="<?php echo $portfolio_url; ?>" title="<?php _e( 'Go to the portfolio page', 'onioneye' ); ?>"><span>&larr;</span> <?php _e( 'Back to the portfolio', 'onioneye' ); ?></a></h1>
			<!-- END .section-title -->
				
			<section id="portfolio-item-meta" class="grid_3 alpha">
				
				<?php if ( $terms ) { ?>	
						
					<ul class="item-categories group">
					    	<li><?php _e('In &rarr;', 'onioneye'); ?> </li>
							<?php 
							foreach ( $terms as $term ) {
								echo '<li class="item-term">' . $term -> name . '</li>';
							}
							?>
					</ul>
					
				<?php } ?>
						
				<?php the_content(); ?>
			</section>
				
		<?php endwhile; ?>
		
		<section id="single-item" class="<?php echo $grid_classes; ?>">
			<?php 
			
			//display the video if present; otherwise, display the images
			if( $video_embed_code ) {
				
				echo stripslashes( htmlspecialchars_decode( $video_embed_code ) );	
					
			}
			else if( count( $portfolio_images ) === 1 ) {
				
				$portfolio_img_url = $portfolio_images[0];
				
				$image_details = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $portfolio_img_url ), 'full');
				$image_full_width = $image_details[1];
				$image_full_height = $image_details[2];
										
				/* find the "desired height" of the current thumbnail, relative to the desired width  */
  				$desired_height = floor( $image_full_height * ( $desired_width / $image_full_width ) );
								    
				// If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size
				if( $image_full_width > $desired_width ) { 
			?>
										       		  	
					<img class="single-img" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $image_details[0]; ?>&amp;h=<?php echo $desired_height; ?>&amp;w=<?php echo $desired_width; ?>&amp;q=90" alt="<?php the_title(); ?>" />
										              
			<?php 
				} else { 
			?>
										              	
					<img class="single-img" src="<?php echo $portfolio_img_url; ?>" alt="<?php the_title(); ?>" />
										              
			<?php 
				} 
			}
			else if ( count( $portfolio_images ) >= 1 ) {
				
			?>
				
				<!-- START .slider -->
				<section class="slider">
						
					<!-- START #slides -->
					<div id="slides">
						    	
				    	<!-- START .slides-container -->
						<div class="slides-container">
				
							<?php foreach ( $portfolio_images as $portfolio_img_url ) { ?>
										
						    	<!-- START .slide -->
							    <figure class="slide">
									    	
								    <?php 
								    	$image_details = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $portfolio_img_url ), 'full');
								    	$image_full_width = $image_details[1];
										$image_full_height = $image_details[2];
										
								    	/* find the "desired height" of the current thumbnail, relative to the desired width  */
  										$desired_height = floor( $image_full_height * ( $desired_width / $image_full_width ) );
								    
									    // If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size
										if( $image_full_width > $desired_width ) { 
									?>
										       		  	
									    	<img width="<?php echo $desired_width; ?>" height="<?php echo $desired_height; ?>" class="slider-img" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $image_details[0]; ?>&amp;h=<?php echo $desired_height; ?>&amp;w=<?php echo $desired_width; ?>&amp;q=90" alt="<?php the_title(); ?>" />
										              
									<?php } else { ?>
										              	
											<img width="<?php echo $image_full_width; ?>" height="<?php echo $image_full_height; ?>" class="slider-img" src="<?php echo $portfolio_img_url; ?>" alt="<?php the_title(); ?>" />
										              
									<?php } ?>
													  										   
								</figure>
								<!-- END .slide -->
																      
							<?php } // end foreach ?>
							        							    
						</div> 
					    <!-- END .slides_container -->
						    	
					    <!-- START #next-prev-links -->
					    <div id="next-prev-links">
					       	<a href="#" class="prev"><img src="<?php echo get_template_directory_uri() ?>/images/layout/arrow-left.png" width="41" height="41" alt="Previous" /></a>
	        				<a href="#" class="next"><img src="<?php echo get_template_directory_uri() ?>/images/layout/arrow-right.png" width="41" height="41" alt="Next" /></a>
					    </div>
					    <!-- END #next-prev-links -->
						    
					</div>
				    <!-- END #slides -->
					    
				</section>
				<!-- END .slider -->
		
			<?php } ?>
		
		</section><!-- END #single-item -->
		
		<?php
		global $post;
		$terms = get_the_terms( $post->ID , 'portfolio_categories', 'string' );
		$do_not_duplicate[] = $post->ID;
		$count = 0;
		$items_per_row = 4;
		$quality = 90;			   	   		
		$grid_class = 'grid_3';
		$image_width = 218;
		$image_height = 175;
		$related_project_html_exists = false;
			 
		// Display all the portfolio posts with the same term/terms as the current post 
		if( $terms ) {
		?>
			
		<?php			
			foreach ( $terms as $term ) {
					
				query_posts( array( 'portfolio_categories' => $term -> slug, 'post_type' => 'portfolio', 'showposts' => -1, 'caller_get_posts' => 1, 'post__not_in' => $do_not_duplicate ) );
					
			   	if ( have_posts()) {
		?>
					 
					<?php while ( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID; ?>
						
						<?php if( ! $related_project_html_exists ) { ?>
						
							<!-- START #related-posts -->
							<section id="related-posts" class="four-items-per-row grid_12 alpha omega group">
				
							<h2><?php _e( 'Related Projects', 'onioneye' ); ?></h2>
							<ul>
								
							<?php $related_project_html_exists = true; ?>	
								
						<?php } ?>
			        				          
		    			<?php $preview_img_url = eq_get_the_preview_img_url(); ?>
						<?php $count++; ?>
				
						<!-- START .portfolio-item -->
						<li id="post-<?php the_ID(); ?>" class="related-post <?php echo $grid_class; ?> <?php if($count === 1) { echo 'alpha'; } elseif($count === $items_per_row) { echo 'omega'; } ?>">
								
							<?php if ($preview_img_url) { ?>
									
								<?php $img_meta = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $preview_img_url ), 'full'); ?>
								    
							    <a class="project-link" href="<?php the_permalink(); ?>" title="<?php _e('Have a closer look at this portfolio item', 'onioneye'); ?>">
							    	<img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $img_meta[0]; ?>&amp;h=<?php echo $image_height; ?>&amp;w=<?php echo $image_width; ?>&amp;q=<?php echo $quality; ?>" alt="<?php _e('Portfolio Item', 'onioneye'); ?>" /> 
							    	<span>view project</span>
							    </a>
								
							<?php } ?>
								
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</li>  
						<!-- END .portfolio-item -->
						    
						<?php if($count === $items_per_row) { // if the current row is filled out with columns, reset the count variable ?>
								
							<?php $count = 0; ?>  
								
						<?php } ?>
							
						<?php $id_suffix++; ?>
										            
		        	<?php endwhile; wp_reset_query(); ?>
					
		<?php	
				} // end if
			} //end foreach
		?>
				
			<?php if( $related_project_html_exists ) { ?>
				
					</ul>
				</section>
				<!-- END #related-posts -->	
								
			<?php } ?>
								
		<?php } ?>
				
<?php get_footer(); ?>