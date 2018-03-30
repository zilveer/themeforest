<?php

global $theretailer_theme_options;

if ( isset($theretailer_theme_options['portfolio_items_per_row']) ) {
	$portfolio_items_per_row = $theretailer_theme_options['portfolio_items_per_row'];
} else {
	$portfolio_items_per_row = 3;
}

?>

<?php get_header(); ?>

<div class="global_content_wrapper listing_portfolio_no_sidebar">

<div class="container_12">

    <div class="grid_12">
    
    	<?php $term = $wp_query->queried_object; ?>
    
    	<h1 class="entry-title portfolio_title"><?php echo $term->name; ?></h1>
  
        <div class="content-area portfolio_section">
        	<div class="content_wrapper">				
				
                <div class="items_wrapper">
				
				<?php
				
				$number_of_portfolio_items = new WP_Query(array(
					'post_type' => 'portfolio',
					'portfolio_filter' => $term->slug,
					'posts_per_page' => 99999,
				));
				
				$portfolio_items = $number_of_portfolio_items->post_count;
				
				$temp = $wp_query;
				$wp_query = null;
				$post_counter = 0;
				
				if ((isset($theretailer_theme_options['portfolio_items_per_page'])) && ($theretailer_theme_options['portfolio_items_per_page'] != "0")) {
					$posts_per_page = $theretailer_theme_options['portfolio_items_per_page'];
				} else {
					$posts_per_page = 99999;
				}
				
				if (isset($theretailer_theme_options['portfolio_items_order_by'])) {
					if ($theretailer_theme_options['portfolio_items_order_by'] == "Alphabetical") {
						$orderby = 'title';
						$order = 'ASC';
					} else {
						$orderby = strtolower($theretailer_theme_options['portfolio_items_order_by']);
						$order = 'DESC';
					}
				} else {
					$orderby = 'date';
					$order = 'DESC';
				}
				
				$wp_query = new WP_Query(array(
					'post_type' => 'portfolio',
					'portfolio_filter' => $term->slug,
					'posts_per_page' => $posts_per_page,
					'orderby' => $orderby,
					'order' => $order,
					'paged' => $paged
				));
				
				// Detect page and page limit
				$max = $wp_query->max_num_pages;
				$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
				
				if ( ($posts_per_page > floor($portfolio_items/2)) && ($posts_per_page < $portfolio_items)  ) {
					$max = 2;
				}
				
				// Add parameters to load-more-portfolio-items.js
				wp_localize_script(
					'load-more-portfolio-items',
					'portfolio',
					array(
						'startPage' => $paged,
						'maxPages' => $max,
						'nextLink' => next_posts($max, false),
						'items_per_line' => $portfolio_items_per_row,
						'load_more_text' => __('Load More', 'theretailer'),
						'loading_text' => __('Loading...', 'theretailer'),
					)
				);
								
				while ($wp_query->have_posts()) : $wp_query->the_post();
					$post_counter++;
					$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
				?>

					<div class="portfolio_<?php echo $portfolio_items_per_row; ?>_col_item_wrapper mix <?php echo strtolower(strip_tags(get_the_term_list( get_the_ID(), 'portfolio_filter', ""," " ))); ?>">
                        <div class="portfolio_item">
                            <div class="portfolio_item_img_container">
								<a class="img_zoom_in" href="<?php echo get_permalink(get_the_ID()); ?>">
									<img src="<?php echo $related_thumb[0]; ?>" alt="" />
								</a>
							</div>
                            <a class="portfolio-title" href="<?php echo get_permalink(get_the_ID()); ?>"><h3><?php the_title(); ?></h3></a>
                            <div class="portfolio_sep"></div>
                            <div class="portfolio_item_cat">
    
                            <?php 
                            echo strip_tags (
                                get_the_term_list( get_the_ID(), 'portfolio_filter', "",", " )
                            );
                            ?>
                            
                            </div>
                        </div>
                    </div>
				
				<?php endwhile; // end of the loop. ?>
                
                </div>
            
				<?php 
				/*if (function_exists("emm_paginate")) {
                    emm_paginate();
                }*/
				?>
                
                <?php $wp_query = null; $wp_query = $temp;?>
                
                <div class="clr"></div>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
        
        <?php theretailer_content_nav( 'nav-below' ); ?>
        
	</div>

</div>

</div>

<!--Mobile trigger footer widgets-->
<?php global $theretailer_theme_options; ?>

<?php if ( 	(!$theretailer_theme_options['dark_footer_all_site']) ||
			($theretailer_theme_options['dark_footer_all_site'] == 0) ) : ?>
				<div class="trigger-footer-widget-area">
					<i class="getbowtied-icon-more-retailer"></i>
				</div>
<?php endif; ?>

<div class="gbtr_widgets_footer_wrapper">

<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>