<?php get_header(); ?>

<?php

	$canon_options_post = get_option('canon_options_post'); 

	$layout = $canon_options_post['404_layout'];

	// to make pagination work on page if used as static homepage
	if (get_query_var('paged')) {
		$paged = get_query_var('paged'); 
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page'); 
	} else {
		$paged = 1; 
	}

	$args = array (
		'post_type'			=> 'post',
		'post_status'       => 'publish',
		'orderby'           => 'date',
		'paged'             => $paged,
	);

	// $temp = $wp_query;
	if (!class_exists('Tribe__Events__Main')) { $wp_query = null; }
	$original_wp_query = $wp_query;
	$wp_query = new WP_Query($args); 

?>


	
    	<!-- Start Outter Wrapper -->
    	<div class="outter-wrapper body-wrapper">		
    		<div class="wrapper clearfix">

				<!-- Main Column -->
				<div class="<?php if ($layout == "sidebar") { echo "col-3-4"; } else { echo "col-1-1"; } ?>">
				
    				<!-- HEADER -->
    				<div class="page-heading">
    					<i class="fa fa-ban"></i> <?php _e("404 Error", "loc_canon"); ?>
    				</div>
    				
    				<!-- TITLE, MSG, SEARCHFORM -->
    				<h1><?php echo esc_attr($canon_options_post['404_title']); ?></h1>
    				<p><?php echo wp_kses_post($canon_options_post['404_msg']); ?></p>
    				
    				<?php get_search_form(); ?>


					<!-- ARCHIVES -->
					<h2><?php _e("Try the Archives", "loc_canon"); ?></h2>


					<!-- POSTS -->
					<ul class="thumb-list archive">

						<!-- BEGIN LOOP -->
						<?php while ( have_posts() ) : the_post(); ?>

							<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php 

									// FEATURED IMAGE
									if (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 

			                            $cmb_post_show_ratings = get_post_meta(get_the_ID(), 'cmb_post_show_ratings', true);
			                            $cmb_post_ratings_overall_score = get_post_meta(get_the_ID(), 'cmb_post_ratings_overall_score', true);

										$post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'small_square_thumb');
										$img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
										$img_post = get_post(get_post_thumbnail_id(get_the_ID()));

										echo '<div class="rate-container">';
                                        if ( $cmb_post_show_ratings == "checked" && !empty($cmb_post_ratings_overall_score) ) { printf('<div class="rate-tab rate-small feat-block-1"><strong>%s</strong></div>', esc_attr($cmb_post_ratings_overall_score)); }
										printf('<a href="%s"><img src="%s" alt="%s" /></a>', get_the_permalink(), esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
										echo '</div>';

									}


									// META DATE
                                    $archive_year  = get_the_time('Y'); 
                                    $archive_month = get_the_time('m'); 
                                    $archive_day   = get_the_time('d');                             

                                    if ($canon_options_post['show_meta_date'] == "checked") { printf('<h6 class="meta right"><a class="date" href="%s">%s</a></h6>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(mb_localize_datetime(get_the_time(get_option('date_format'))))); } 

									// CATEGORIES
									$cat_string = mb_get_cat_string(get_the_ID(), " | ");

									printf('<div class="meta feat-1"><h6>%s</h6></div>', wp_kses_post($cat_string));

									// TITLE
									printf('<a href="%s" class="title"><h3 class="title">%s</h3></a>', esc_url(get_the_permalink()), esc_attr(get_the_title()));
								?>

							</li>
							
						<?php endwhile; ?>
						<!-- END LOOP -->
						
					</ul>
					
    				
                    <!-- PAGINATION -->
                    <?php get_template_part("inc/templates/template_paginate_links"); ?>
			
				
				</div>
				<!-- End Main Column -->    
				
				
				<!-- SIDEBAR -->
				<?php if ($layout == 'sidebar') { get_sidebar("404"); } ?>
                

    		</div>
    	</div>
		

<?php wp_reset_query(); // needs to be reset for breadcrumbs in footer to correctly identify 404 page ?>

<?php get_footer(); ?>