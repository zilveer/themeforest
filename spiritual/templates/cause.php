<?php
/*
Template Name: Cause Page
*/

get_header(); 

if (function_exists('rwmb_meta')) {

	/* Get cause page options */
	$swm_cause_items_per_page	= -1;

	$swm_cause_display_style 		= rwmb_meta('swm_cause_display_style');
	$swm_exclude_cause_categories	= rwmb_meta('swm_exclude_cause_categories');
	$swm_onoff_cause_readmore		= rwmb_meta('swm_onoff_cause_readmore');
	$swm_cause_pagination_style 	= rwmb_meta('swm_cause_pagination_style');
	$swm_cause_items_pagination 	= rwmb_meta('swm_cause_items_pagination');

	/* Exclude Cause Categories */

	$swm_terms_cause_exclude_cats = rwmb_meta( 'swm_exclude_cause_categories', 'type=taxonomy&taxonomy=cause-categories' );

	$swm_cause_cats  = array();
	$swm_excluce_cause_cats  = array();

	foreach ( $swm_terms_cause_exclude_cats as $term ){
	   $swm_cause_cats[] .= sprintf( $term->slug);
	}		
	               
	foreach ( $swm_cause_cats  as $cat ) {                     
		$swm_cause_exclude_catid = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE slug='$cat'");
		$swm_excluce_cause_cats[] = $swm_cause_exclude_catid;
	}

	$swm_excluce_cause_cat_tabs = join(',', $swm_excluce_cause_cats);
	?>

	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>" >
		<div class="swm_column swm_custom_two_third">	
			
			<?php

			// Cause Navigation
			
			if (rwmb_meta('swm_onoff_cause_sortable_menu') == 1) {	
				?>			
				<div class="swm_portfolio_menu filter_menu">
					<ul>
						<li><a href="#" class="active" data-filter="*"><?php _e('All','swmtranslate'); ?></a></li>
						<?php if ($swm_excluce_cause_cat_tabs):
								wp_list_categories(array('title_li' => '', 'taxonomy' => 'cause-categories', 'hierarchical' => false, 'exclude' => $swm_excluce_cause_cat_tabs, 'order' => 'asc', 'walker' => new Portfolio_Walker())); 
							else:
								wp_list_categories(array('title_li' => '', 'taxonomy' => 'cause-categories',  'order' => 'asc', 'walker' => new Portfolio_Walker())); 
						endif; ?>
					</ul>
					<div class="clear"></div>
				</div>
			<?php 
			}

			?><div class="clear"></div>

			<?php

			// Cause Posts Query
			$args = array(
				'post_type' => 'cause',
				'orderby'=>'menu_order',
				'order'     => 'ASC',
				'posts_per_page' => $swm_cause_items_pagination,
				'paged' => $paged,
				'type' => get_query_var('type'),
				'tax_query' => array(
					array(
						'taxonomy' => 'cause-categories',
						'field' => 'id',
						'terms' => $swm_excluce_cause_cats,
						'operator' => 'NOT IN',
						)
				) // end of tax_query
			);

			$wp_query = new WP_Query( $args );			
			?>	
						
			<section class="swm_cause_sort swm_causes <?php echo $swm_cause_display_style; ?>" id="swm-item-entries">
				<?php
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					$postid = get_the_id();
					$terms = get_the_terms( get_the_ID(), 'cause-categories' );	
					$permalink = get_permalink( $postid  );
					$title = get_the_title( $postid  );
					$swm_cause_raised = rwmb_meta('swm_cause_raised_amount');
					$swm_cause_goal = rwmb_meta('swm_cause_goal_amount');
					$swm_cause_donors = rwmb_meta('swm_cause_total_donors');
					$swm_cause_img = get_the_post_thumbnail($postid,'thumbnail');
					$swm_cause_raised_text = __( 'Raised', 'swmtranslate' );
					$swm_cause_goal_text = __( 'Goal', 'swmtranslate' );
					$swm_cause_donors_text = __( 'Donors', 'swmtranslate' );
				?>

						<article class="swm-infinite-item-selector <?php  if ( !empty( $terms ) ) { foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } } ?> swm_cause_box swm_cause_isotope swm_cause_item <?php  if ( $swm_cause_img == '' ) { echo 'no-cause-img'; } ?>">
						
							<div class="swm_cause_top">
								
								<?php								
								if ( $swm_cause_img != '' ) { ?>

									<div class="swm_cause_img">
										<a href="<?php $permalink; ?>" title="<?php echo $title; ?>">
										<?php echo $swm_cause_img; ?>										
										</a>
									</div>

								<?php } ?>

								<div class="swm_cause_meta">
									<ul>
										<li>
											<div class="swm_cause_bar">									
												<div class="swm_cause_bar_block">
													<span class="swm_cause_bar_out swm_dark_gradient" style="width:<?php echo swm_get_percentage($swm_cause_raised,$swm_cause_goal) ?>%">
														<span class="swm_cause_bar_in"></span>
													</span>
												</div>
												<div class="clear"></div>
											</div>
										</li>
										<li><span class="cause_meta_label"><?php echo apply_filters( 'swm_cause_raised_text',__( 'Raised', 'swmtranslate' ) );  ?></span><?php echo $swm_cause_raised; ?></li>
										<li><span class="cause_meta_label"><?php echo apply_filters( 'swm_cause_goal_text',__( 'Goal', 'swmtranslate' ) );  ?></span><?php echo $swm_cause_goal; ?></li>
										<li><span class="cause_meta_label"><?php echo apply_filters( 'swm_cause_donors_text',__( 'Donors', 'swmtranslate' ) );  ?></span><?php echo $swm_cause_donors; ?></li>
									</ul>							
								</div>
							</div>
							<div class="swm_cause_content">
								<div class="swm_cause_title">
									<h2><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h2>
									<div class="swm_cause_text">
										<?php the_excerpt(); 
											echo swm_cause_read_more();
										?>
									</div>														
								</div>
							</div>
									
						</article> <!-- swm_cause_box -->
				<?php endwhile; 
					?>

			<div class="clear"></div>

			</section> <!-- .swm_cause -->	
			
			<div>
			<?php
			/* cause pagination  */				
				swm_pagination($swm_cause_pagination_style); 
				wp_reset_query();
			?>
			</div>

			<?php 
				/* display page content below cause items */
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