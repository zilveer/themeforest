<?php

/*
Template Name: Archives Page
*/ 

get_header();
	
	$swm_blog_style = get_theme_mod( 'swm_blog_all_style', 'large-image' );
	$swm_loop_type = ( $swm_blog_style == 'blog-style-grid' ) ? 'standard-grid' : 'standard';
	$swm_infinite_pagination_style = ( $swm_blog_style == 'blog-style-grid' ) ? 'swm_infinite_scroll_style' : '';
	?>				
		<div class="swm_container <?php echo swm_page_post_layout_type(); ?> <?php echo $swm_infinite_pagination_style; ?>" >	
			<div class="swm_column swm_custom_two_third">
				<div class="swm_archives_page">

					<?php

					$page_id = swm_get_id();
					$swm_archives_pagination 		= get_post_meta($page_id, 'swm_archives_pagination', true);
					$swm_onoff_archives_month 		= get_post_meta($page_id, 'swm_onoff_archives_month', true);
					$swm_onoff_archives_categories 	= get_post_meta($page_id, 'swm_onoff_archives_categories', true);
				
					/* ----------------------------------------------------------------------------------
						Query
					---------------------------------------------------------------------------------- */

					$swm_exclude_archives_cat = explode(',',get_post_meta('swm_archives_exclude_categories'));					
					
					$args = array(
						'category__not_in' => $swm_exclude_archives_cat,									
						'posts_per_page' => $swm_archives_pagination,
						'paged' => get_query_var( 'paged' )
					);
					$wp_query = new WP_Query($args); 
					
					/* ----------------------------------------------------------------------------------
						Posts List
					---------------------------------------------------------------------------------- */
					?>
					<div class="archives-table archives-table-link">
						<ul>
						
							<li class="tbl-heading">						
								<span class="date">Date</span>
								<span class="post">Post</span>						
							</li> <?php
							
							if (have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>				
							
							<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								<span class="date"><?php the_time('Y.m.d') ?></span>
								<span class="post">
									<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" rel="bookmark"><?php the_title() ?></a>
								</span>					
							</li>			
							
							<?php endwhile; ?>
							<?php endif; 
								
							?>	
						
						</ul>
						<div class="clear"></div>
					</div>				
					
					<?php 
					
					/* ----------------------------------------------------------------------------------
						Pagination
					---------------------------------------------------------------------------------- */				
					
					swm_pagination($swm_archives_pagination); 

					wp_reset_query();
					
					echo do_shortcode('[line]');

					/* ----------------------------------------------------------------------------------
						Archives by Month and Categories
					---------------------------------------------------------------------------------- */					

					if ($swm_onoff_archives_month) {

					?>						
					
						<div class="swm_column swm_one_half first archives-link">
						<h4><?php _e('Archives by Month:', 'swmtranslate')?></h4>
						<ul>
							<?php wp_get_archives('type=monthly'); ?>
						</ul>
						</div>
						<?php
					}
					
					if ($swm_onoff_archives_categories) {

					?>
					
						<div class="swm_column swm_one_half archives-link">
						<h4><?php _e('Archives by Categories:', 'swmtranslate')?></h4>
						<ul>
							 <?php wp_list_categories('title_li='); ?>
						</ul>
						</div>
						<?php
					}

					?>	



					<div class="clear"></div>
				</div>
				<div class="clear"></div>

				<?php 
				/* display page content below portfolio items */
				if (have_posts()) :
				while (have_posts()) : the_post();
				?>
				<div class="raw">
					<?php
						the_content('');
					?>
				</div>
				<?php
				endwhile;
				endif; ?>

				<div class="clear"></div>

			</div>		
		
		<?php get_sidebar(); 	?>

		</div>	<?php	
 
get_footer(); 

?>
		
		
		