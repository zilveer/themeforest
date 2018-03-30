<?php
/*
Template Name: Testimonials Page
*/
?>

<?php 

get_header(); 

if (function_exists('rwmb_meta')) {			
			
	$swm_testimonials_count 			= 1;
	$swm_testimonials_items_per_page	= -1;
	$swm_testimonials_items_per_page	= rwmb_meta('swm_testimonials_pagination');
	$swm_testimonials_display_column	= rwmb_meta('swm_testimonial_column');	
	$swm_testimonials_pagination_style 	= rwmb_meta('swm_testimonials_pagination_style');
	$swm_enable_testimonials_h_menu 	= rwmb_meta('swm_enable_testimonials_h_menu');
	$pageid 							= get_the_ID();	

	/* Exclude Categories */

	$swm_terms_testimonials_exclude_cats = rwmb_meta( 'swm_exclude_testimonials_categories', 'type=taxonomy&taxonomy=testimonials-categories' );

	$swm_testimonials_cats  = array();
	$swm_excluce_testimonials_cats  = array();

	foreach ( $swm_terms_testimonials_exclude_cats as $term ){
	   $swm_testimonials_cats[] .= sprintf( $term->slug);
	}		
	               
	foreach ( $swm_testimonials_cats  as $cat ) {                     
		$catid = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE slug='$cat'");
		$swm_excluce_testimonials_cats[] = $catid;
	}

	$swm_excluce_testimonials_cat_tabs = join(',', $swm_excluce_testimonials_cats);

	?>

	<div class="swm_container <?php echo swm_page_post_layout_type(); ?> swm_testimonials_page_main" >	
		<div class="swm_column swm_custom_two_third">
			
			<?php if ( $swm_enable_testimonials_h_menu ) { ?>

				<div class="swm_portfolio_menu filter_menu">
						<ul>
							<li><a href="#" class="active" data-filter="*"><?php _e('All','swmtranslate'); ?></a></li>
							<?php if ($swm_excluce_testimonials_cat_tabs):
									wp_list_categories(array('title_li' => '', 'taxonomy' => 'testimonials-categories', 'hierarchical' => false, 'exclude' => $swm_excluce_testimonials_cat_tabs, 'order' => 'asc', 'walker' => new Portfolio_Walker())); 
								else:
									wp_list_categories(array('title_li' => '', 'taxonomy' => 'testimonials-categories',  'order' => 'asc', 'walker' => new Portfolio_Walker())); 
							endif; ?>
						</ul>
						<div class="clear"></div>
					</div>	
				<div class="clear"></div>	

			<?php } ?>

			<?php			

			$args = array(
				'post_type' => 'testimonials',				
				'orderby'=>'menu_order',
				'order'     => 'ASC',
				'posts_per_page' => $swm_testimonials_items_per_page,			
				'paged' => $paged,
				'type' => get_query_var('type'),
				'tax_query' => array(
					array(
						'taxonomy' => 'testimonials-categories',
						'field' => 'id',
						'terms' => $swm_excluce_testimonials_cats,
						'operator' => 'NOT IN',
						)
				) // end of tax_query				      	 	
			);

			$wp_query = new WP_Query( $args );
			?>	

			<div class="swm_row testimonials_wrapper testimonials_sort" id="swm-item-entries">	

				<?php
				while ($wp_query->have_posts()) : $wp_query->the_post(); 					
								
					$post_id = get_the_ID();
					$client_name = get_the_title();
					$swm_website_url = get_post_meta($post_id, 'swm_website_url', TRUE); 
					$swm_featured_image = wp_get_attachment_url(get_post_thumbnail_id($post_id));
					$swm_client_details = get_post_meta($post_id, 'swm_client_details', TRUE); 	
					$hide_client_image = '';
					$terms = get_the_terms( get_the_ID(), 'testimonials-categories' );	

					echo '<div class="swm-infinite-item-selector swm_column'. $swm_testimonials_display_column.'  '; 

					if ( !empty( $terms ) ) { foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } }

					echo ' testimonials_isotope swm_testimonials_block ">';
					echo '<div class="swm_column_gap">';
					echo '<div class="testimonial_box">';
					echo the_content();		
				
					echo '</div>';
					echo '</div>';	
					
					echo '<div class="client_details">';				

					if ( $swm_featured_image && $hide_client_image == 0 ) {
				
						echo '<div class="client_img_link">';
						echo '<span class="client_image">'.get_the_post_thumbnail($post_id, 'recent-post-tiny').'</span>';

						if ($swm_website_url) {				
							echo '<span class="icon_url"><a href="'.$swm_website_url.'" title=""><i class="fa fa-link"></i></a></span>';
						}

						echo '</div>';

					}				

					echo '<div class="client_name_position">';
					echo '<h5>'.$client_name.'</h5>';

					if ($swm_client_details) {
						echo '<span>'.$swm_client_details.'</span>'; 
					}

					echo '</div>';					
					echo '<div class="clear"></div>';

					echo '</div>';
					echo '</div>';	
					
					$swm_testimonials_count++; 
					
				endwhile; ?>	
				
			</div>	

			
			<div class="clear"></div>
			<?php
			/* pagination  */				
				swm_pagination($swm_testimonials_pagination_style); 
				wp_reset_query();
			?>
			

			<?php 
			/* display page content below items */
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