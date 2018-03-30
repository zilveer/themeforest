<?php
/*
Template Name: Portfolio Page
*/

get_header(); 

if (function_exists('rwmb_meta')) {

	/* Get portfolio page options */
	$swm_pf_items_per_page	= -1;

	$page_id = get_the_id();

	$swm_pf_display_type 				= rwmb_meta('swm_portfolio_page_type');
	$swm_pf_display_column				= rwmb_meta('swm_pf_display_column');
	$swm_pf_items_per_page				= rwmb_meta('swm_pf_items_pagination');
	$swm_pf_items_link_text 			= rwmb_meta('swm_pf_items_link_text');
	$swm_pf_item_title_link 			= rwmb_meta('swm_pf_item_title_link');
	$swm_onoff_pf_prettyphoto 			= rwmb_meta('swm_onoff_pf_prettyphoto');	
	$swm_onoff_pf_readmore 				= rwmb_meta('swm_onoff_pf_readmore');	
	$swm_pf_display_excerpt_category	= rwmb_meta('swm_pf_display_excerpt_category');	
	$swm_pf_title_font_size 			= rwmb_meta('swm_pf_title_font_size');
	$swm_pf_excerpt_font_size 			= rwmb_meta('swm_pf_excerpt_font_size');
	$swm_page_pagination_style 			= rwmb_meta('swm_pf_pagination_style');

	/* Exclude Portfolio Categories */

	$swm_terms_pf_exclude_cats = rwmb_meta( 'swm_exclude_pf_categories', 'type=taxonomy&taxonomy=portfolio-categories' );

	$swm_pf_cats  = array();
	$swm_excluce_pf_cats  = array();

	foreach ( $swm_terms_pf_exclude_cats as $term ){
	   $swm_pf_cats[] .= sprintf( $term->slug);
	}		
	               
	foreach ( $swm_pf_cats  as $cat ) {                     
		$swm_pf_exclude_catid = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE slug='$cat'");
		$swm_excluce_pf_cats[] = $swm_pf_exclude_catid;
	}

	$swm_excluce_pf_cat_tabs = join(',', $swm_excluce_pf_cats);
	?>

	<div class="swm_container <?php echo swm_page_post_layout_type(); ?> swm_portfolio_page_main" >	
		<div class="swm_column swm_custom_two_third">		
			
			<?php

			// Portfolio Navigation
			swm_display_portfolio_menu();	
			?><div class="clear"></div>

			<?php 
			/* get portfolio column to display */

			// Portfolio Posts Query

			$args = array(
				'post_type' => 'portfolio',
				'orderby'=>'menu_order',
				'order'     => 'ASC',
				'posts_per_page' => $swm_pf_items_per_page,
				'paged' => $paged,
				'type' => get_query_var('type'),
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio-categories',
						'field' => 'id',
						'terms' => $swm_excluce_pf_cats,
						'operator' => 'NOT IN',
						)
				) // end of tax_query
			);

			$wp_query = new WP_Query( $args );			
			?>	
						
			<section class="swm_row swm_portfolio_sort swm_portfolio" id="swm-item-entries">
				<?php
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					$page_id = get_the_id();
					$terms = get_the_terms( get_the_ID(), 'portfolio-categories' );		
				?>

						<article class="swm-infinite-item-selector <?php  if ( !empty( $terms ) ) { foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } } ?>  swm_column<?php echo $swm_pf_display_column; ?> swm_portfolio_box swm_portfolio_isotope">
							<div class="swm_column_gap">				
							
							<?php swm_portfolio_thumb_title(); ?>

							<div class="clear"></div>	
							</div>
									
						</article> <!-- swm_portfolio_box -->
				<?php endwhile; 
					?>

			<div class="clear"></div>

			</section> <!-- .swm_portfolio -->	
			
			<div>
			<?php
			/* portfolio pagination  */				
				swm_pagination($swm_page_pagination_style); 
				wp_reset_query();
			?>
			</div>

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
	</div> <!-- end .swm_container -->
	<?php

}

get_footer();