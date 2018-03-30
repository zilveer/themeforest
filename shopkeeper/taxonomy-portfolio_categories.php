<?php get_header(); ?>

<?php $term = $wp_query->queried_object; ?>

<div id="primary" class="content-area">
       
    <div id="content" class="site-content" role="main">
    
        <header class="entry-header">
            
            <div class="row">
                <div class="large-10 large-centered columns without-sidebar">
                          
                    <h1 class="page-title"><?php echo esc_html($term->name); ?></h1>
                    
                </div>
            </div>
    
        </header><!-- .entry-header -->
        
        <?php
		
		$grid = 'default';
		
		$args = array(					
			'post_status' 			=> 'publish',
			'post_type' 			=> 'portfolio',
			'posts_per_page' 		=> 9999,
			'portfolio_categories' 	=> $term->slug,
			'orderby' 				=> 'date',
			'order' 				=> 'desc'
		);
		
		$portfolioItems = new WP_Query( $args );
		
		while ( $portfolioItems->have_posts() ) : $portfolioItems->the_post();
			
			$terms = get_the_terms( get_the_ID(), 'portfolio_categories' ); // get an array of all the terms as objects.
			
			if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
				foreach($terms as $term) {
					$portfolio_categories_queried[$term->slug] = $term->name;
				}
			}
			
		endwhile;
		
		//$portfolio_categories_queried = array_unique($portfolio_categories_queried);
		$portfolio_categories_queried = $portfolio_categories_queried ? array_unique($portfolio_categories_queried) : $portfolio_categories_queried;
		
		?>
		
		<div class="portfolio-isotope-container">
	
			<div class="portfolio-isotope">
				
				<div class="portfolio-grid-sizer"></div>
					
					<?php
					
					$post_counter = 0;
									
					while ( $portfolioItems->have_posts() ) : $portfolioItems->the_post();
						
						$post_counter++;
						
						$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );
						
						$terms_slug = get_the_terms( get_the_ID(), 'portfolio_categories' ); // get an array of all the terms as objects.
	
						$term_slug_class = "";
						
						if ( !empty( $terms_slug ) && !is_wp_error( $terms_slug ) ){
							foreach ( $terms_slug as $term_slug ) {
								$term_slug_class .=  $term_slug->slug . " ";
							}
						}
						
						if (get_post_meta( $post->ID, 'portfolio_color_meta_box', true )) {
							$portfolio_color_option = get_post_meta( $post->ID, 'portfolio_color_meta_box', true );
						} else {
							$portfolio_color_option = "none";
						}
						
						$portfolio_item_width = "";
						$portfolio_item_height = "";
						
						switch ($grid) {
							
							case "grid1":							
								
								switch ($post_counter) {
									case (($post_counter == 1)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "height2";
										break;
									case (($post_counter == 2)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									case (($post_counter == 7)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									case (($post_counter == 8)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "height2";
										break;
									default :
										$portfolio_item_width = "";
										$portfolio_item_height = "";
								}							
								break;
								
							case "grid2":
								
								switch ($post_counter) {
									case (($post_counter == 3)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "height2";
										break;
									case (($post_counter == 8)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									case (($post_counter == 13)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									default :
										$portfolio_item_width = "";
										$portfolio_item_height = "";
								}							
								break;
								
							case "grid3":
							
								switch ($post_counter) {
									case (($post_counter == 3)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									case (($post_counter == 8)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									case (($post_counter == 11)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									case (($post_counter == 14)) :
										$portfolio_item_width = "width2";
										$portfolio_item_height = "";
										break;
									default :
										$portfolio_item_width = "";
										$portfolio_item_height = "";
								}							
								break;
								
							default:
								
								$portfolio_item_width = "";
								$portfolio_item_height = "";
								
						}
						
					?>
	
						<div class="portfolio-box hidden <?php echo $portfolio_item_width; ?> <?php echo $portfolio_item_height; ?> <?php echo $term_slug_class; ?>">
							
							<a href="<?php echo get_permalink(get_the_ID()); ?>" class="portfolio-box-inner hover-effect-link">
								
								<span class="portfolio-content-wrapper hover-effect-content" style="background-color:<?php echo esc_html($portfolio_color_option); ?>">
									
									<?php if ($related_thumb[0] != "") : ?>
										<span class="portfolio-thumb hover-effect-thumb" style="background-image: url(<?php echo esc_url($related_thumb[0]); ?>)"></span>
									<?php endif; ?>
									
									<h2 class="portfolio-title hover-effect-title"><?php the_title(); ?></h2>
									
									<p class="portfolio-categories hover-effect-text"><?php echo strip_tags (get_the_term_list(get_the_ID(), 'portfolio_categories', "", ", "));?></p>
									 
								</span>
								
							</a>
							
						</div>
					
					<?php endwhile; // end of the loop. ?>
	
			</div><!--portfolio-isotope-->
		
		</div><!--portfolio-isotope-container-->
    
    </div><!-- #content -->           
    
</div><!-- #primary -->

<?php get_footer(); ?>