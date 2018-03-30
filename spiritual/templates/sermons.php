<?php
/*
Template Name: Sermons Page
*/

get_header(); 

if (function_exists('rwmb_meta')) {

	/* Get sermons page options */
	$swm_sermons_items_per_page	= -1;
	$swm_exclude_sermons_categories	= rwmb_meta('swm_exclude_sermons_categories');
	$swm_onoff_sermons_readmore		= rwmb_meta('swm_onoff_sermons_readmore');
	$swm_sermons_pagination_style 	= rwmb_meta('swm_sermons_pagination_style');
	$swm_sermons_items_pagination 	= rwmb_meta('swm_sermons_items_pagination');

	/* Exclude sermons Categories */

	$swm_terms_sermons_exclude_cats = rwmb_meta( 'swm_exclude_sermons_categories', 'type=taxonomy&taxonomy=sermons-categories' );

	$swm_sermons_cats  = array();
	$swm_excluce_sermons_cats  = array();

	foreach ( $swm_terms_sermons_exclude_cats as $term ){
	   $swm_sermons_cats[] .= sprintf( $term->slug);
	}		
	               
	foreach ( $swm_sermons_cats  as $cat ) {                     
		$swm_sermons_exclude_catid = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE slug='$cat'");
		$swm_excluce_sermons_cats[] = $swm_sermons_exclude_catid;
	}

	$swm_excluce_sermons_cat_tabs = join(',', $swm_excluce_sermons_cats);
	?>

	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>" >
		<div class="swm_column swm_custom_two_third">	
			
			<?php

			// Sermons Navigation
			
			if (rwmb_meta('swm_onoff_sermons_sortable_menu') == 1) {	
				?>			
				<div class="swm_portfolio_menu filter_menu">
					<ul>
						<li><a href="#" class="active" data-filter="*"><?php _e('All','swmtranslate'); ?></a></li>
						<?php if ($swm_excluce_sermons_cat_tabs):
								wp_list_categories(array('title_li' => '', 'taxonomy' => 'sermons-categories', 'hierarchical' => false, 'exclude' => $swm_excluce_sermons_cat_tabs, 'order' => 'asc', 'walker' => new Portfolio_Walker())); 
							else:
								wp_list_categories(array('title_li' => '', 'taxonomy' => 'sermons-categories',  'order' => 'asc', 'walker' => new Portfolio_Walker())); 
						endif; ?>
					</ul>
					<div class="clear"></div>
				</div>
			<?php 
			}

			?><div class="clear"></div>

			<?php

			// sermons Posts Query
			$args = array(
				'post_type' => 'sermons',
				'order'     => 'DESC',
				'posts_per_page' => $swm_sermons_items_pagination,
				'paged' => $paged,
				'type' => get_query_var('type'),
				'tax_query' => array(
					array(
						'taxonomy' => 'sermons-categories',
						'field' => 'id',
						'terms' => $swm_excluce_sermons_cats,
						'operator' => 'NOT IN',
						)
				) // end of tax_query
			);

			$wp_query = new WP_Query( $args );			
			?>	
						
			<div class="swm_sermons_sort swm_sermons" id="swm-item-entries">
				<?php
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					$postid = get_the_id();
					$terms = get_the_terms( get_the_ID(), 'sermons-categories' );	
					$permalink = get_permalink( $postid  );
					$title = get_the_title( $postid  );
					$swm_sermons_video = rwmb_meta('swm_sermons_video');
					$swm_sermons_audio = rwmb_meta('swm_sermons_audio');
					$swm_sermons_pdf = rwmb_meta('swm_sermons_pdf');
					$swm_sermons_text = rwmb_meta('swm_sermons_text');
					$swm_sermons_img = get_the_post_thumbnail($postid,'medium');
				?>

						<div class="swm-infinite-item-selector <?php  if ( !empty( $terms ) ) { foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } } ?> swm_sermons_box swm_sermons_isotope swm_sermons_item <?php  if ( $swm_sermons_img == '' ) { echo 'no-sermons-img'; } ?>">
						
							<div class="swm_sermons_top">
								
								<div class="swm_sermons_date_meta">
									<div class="swm_sermons_date">
										<span class="sermon_date"><?php echo get_the_date('d'); ?></span>
										<span class="sermon_day"><?php echo get_the_date('M'); ?></span>					
									</div>
									<div class="swm_sermons_meta">
										<ul>
											<?php 
											if ( $swm_sermons_video ) {
												echo '<li><a href="'.$permalink.'#getVideo" class="tipUp" title="'. apply_filters( 'swm_sermons_video_text', __( 'Video', 'swmtranslate' ) ) . '"><i class="fa fa-video-camera"></i></a></li>';
											}

											if ( $swm_sermons_audio ) {
												echo '<li><a href="'.$permalink.'#getAudio" class="tipUp" title="'. apply_filters( 'swm_sermons_audio_text', __( 'Audio', 'swmtranslate' ) ) . '"><i class="fa fa-headphones"></i></a></li>';
											}

											if ( $swm_sermons_pdf ) {
												echo '<li><a href="'.$swm_sermons_pdf.'" class="tipUp" title="'. apply_filters( 'swm_sermons_pdf_text', __( 'PDF', 'swmtranslate' ) ) . '" target="_blank"><i class="fa fa-download"></i></a></li>';
											}

											if ( $swm_sermons_text ) {
												echo '<li><a href="'.$swm_sermons_text.'" class="tipUp" title="'. apply_filters( 'swm_sermons_more_details_text', __( 'More Details', 'swmtranslate' ) ) . '" target="_blank"><i class="fa fa-book"></i></a></li>';
											}
											?>
										</ul>						
									</div>
								</div>

								<?php
								
								if ( $swm_sermons_img != '' ) { ?>

									<div class="swm_sermons_img">
										<a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>">
											<?php echo $swm_sermons_img; ?>						
										</a>
									</div>

								<?php } ?>

							</div>
							<div class="swm_sermons_content">
								<div class="swm_sermons_title">
									<h2><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h2>
									<div class="swm_sermons_text">
										<?php the_excerpt(); 
											echo swm_sermons_read_more();
										?>
									</div>														
								</div>
							</div>
									
						</div> <!-- swm_sermons_box -->
				<?php endwhile; 
					?>

			<div class="clear"></div>

			</div> <!-- .swm_sermons -->	
			
			<div>
			<?php
			/* sermons pagination  */				
				swm_pagination($swm_sermons_pagination_style); 
				wp_reset_query();
			?>
			</div>

			<?php 
				/* display page content below sermons items */
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