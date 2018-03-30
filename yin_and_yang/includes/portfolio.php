<?php
	$desired_width = 600;
	$desired_height = 520;
	$client_logos_page = get_theme_mod('oy_client_logos', '');
						
	if(is_tax()) { // is category page
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$args = array( 'post_type' => 'portfolio', 'portfolio_category' => $term -> slug, 'posts_per_page' => -1, 'orderby' => 'menu_order' ); 
	}
	else { // is main portfolio page
		$args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order' ); 
	}
	 
   	$loop = new WP_Query( $args );
?>

	<?php if($loop->have_posts()) { ?>
		
		<?php if(!is_singular('portfolio')) { ?>
			
			<!-- Portfolio item starts here -->
		    <div class="portfolio-item-wrapper group"></div>
		    <!-- Portfolio item ends here -->
		    
		<?php } ?>
	
		<div class="pf-gallery-container">	  
			<div class="pf-adjuster">
				
				<div class="portfolio-header group">  
					  
				    <h2><?php esc_html_e( 'Portfolio', 'onioneye' ); ?></h2>
					
					<?php get_template_part('includes/portfolio-filter'); ?> 
					
				</div><!-- /.portfolio-header -->	
					   	
				<div id="isotope-trigger" class="portfolio-gallery isotope-gallery group">
					
					<div class="onioneye-grid-sizer"></div>
					
					<?php
					//output the latest projects from the 'my_portfolio' custom post type
					while ($loop->have_posts()) : $loop->the_post();
						$preview_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$preview_img_url = $preview_img['0'];
						$image_full_width = $preview_img[1];
						$image_full_height = $preview_img[2];						
					?>
							
						<div data-id="id-<?php echo $post->ID; ?>" class="isotope-item portfolio-item portfolio-item-<?php the_ID(); ?> <?php $terms = get_the_terms( $post -> ID, 'portfolio_category' ); if ( !empty( $terms ) ) { foreach( $terms as $term ) { echo esc_attr($term -> slug . ' '); } } ?>">		
										
							<a class="project-link" href="<?php the_permalink(); ?>" data-post_id="<?php echo $post->ID; ?>">
										
								<?php if ($preview_img_url) { ?>
											
									<div class="thumb-container">
										
										<?php
											$thumb = onioneye_get_attachment_id_from_src( $preview_img_url );
											$image = onioneye_vt_resize( $thumb, '', $desired_width, $desired_height, true );
										?>	
										
										<?php // If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size ?>
										<?php if( $image_full_width > $desired_width || $image_full_height > $desired_height ) { ?>
											
											<img class="preview-img" src="<?php echo esc_url($image[url]); ?>" alt="<?php the_title_attribute(); ?>" />
															    				       		  								              
										<?php } else { ?>	
												
											<img class="preview-img" src="<?php echo esc_url($preview_img_url); ?>" alt="<?php the_title_attribute(); ?>" />	          	
																		              
										<?php } ?>
																				
										<div class="thumb-overlay">
											<div class="project-info-wrap">
												<h3 class="project-title"><?php the_title(); ?></h3>
												
												<div class="project-categories">
													<?php
													//Returns an Array of Term Names, which are assigned to the current portfolio item 
													$term_list = wp_get_post_terms($post->ID, 'portfolio_category', array("fields" => "names"));
													
													
													$string = rtrim(implode(', ', $term_list), ', ');
													echo esc_html($string);
													?>
												</div>										
											</div>
										</div><!-- /.thumb-overlay -->
																					
									</div><!-- /.thumb-container -->
											
								<?php } ?>
																										
							</a><!-- /.project-link -->
				
						</div><!-- /.portfolio-item -->
						
					<?php endwhile; ?>
					
				</div><!-- /#isotope-trigger -->
			</div><!-- /.pf-adjuster -->
		</div><!-- /.pf-gallery-container -->
	
	<?php } // end if ?>
	
	<?php if($client_logos_page) { // display the client logos if defined in the theme options panel ?>
		
		<div class="customer-showcase group">    
		    <h2><?php esc_html_e( 'Clients', 'onioneye' ); ?></h2>
		    
		    <div class="clients-content">
			    <?php
					$page_data = get_page($client_logos_page);
					$content = apply_filters('the_content', $page_data->post_content); // Get Content and retain Wordpress filters such as paragraph tags.
				
					echo $content;
				?>
			</div><!-- /.clients-content -->
		</div><!-- /.customer-showcase -->
		
    <?php } ?>	