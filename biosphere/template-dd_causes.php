<?php 
/*
	Template Name: Causes
*/

get_header(); 

// Get Options
$layout = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );
$post_width = get_post_meta( get_the_ID(), $dd_sn . 'post_width', true );
$posts_per_page = get_post_meta( get_the_ID(), $dd_sn . 'posts_per_page', true );

// Set vars
$dd_count = 0;
$dd_max_count = 4;

// Set vars (with sidebar)
if ( $layout == 'cs' ) {

	// In page vars
	$content_class = 'two-thirds column ';
	$causes_class = 'causes-listing-style-2';
	$has_sidebar = true;

	// Template vars (globals)
	$dd_post_class = '';
	$dd_thumb_size = 'dd-one-fourth';
	$dd_style = '2';

// Set vars (without sidebar)
} else {

	// In page vars
	$content_class = '';
	$causes_class = 'masonry';
	$has_sidebar = false;

	// Template vars (globals)
	
	if ( $post_width == 'one_half' ) {
		$dd_post_class = 'eight columns ';
		$dd_thumb_size = 'dd-one-half';
		$dd_max_count = 2;
	} elseif ( $post_width == 'one_third' ) {
		$dd_post_class = 'one-third column ';
		$dd_thumb_size = 'dd-one-third';
		$dd_max_count = 3;
	} elseif ( $post_width == 'one_fourth' ) {
		$dd_post_class = 'four columns ';
		$dd_thumb_size = 'dd-one-fourth';
		$dd_max_count = 4;
	} else {
		$dd_post_class = 'four columns ';
		$dd_thumb_size = 'dd-one-fourth';
	}

	$dd_style = '1';

}

// What to show
if ( isset ( $_GET['show'] ) ) {
	$what_to_show = $_GET['show'];
} else {
	$what_to_show = 'all';
}

// Should funded be shown in regular listing
$show_funded = ot_get_option( $dd_sn . 'cause_funded_show', 'enabled' );
if ( $show_funded == 'enabled' ) {
	$show_funded = true;
} else {
	$show_funded = false;
}


?>

	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
			
			<div class="causes causes-listing <?php echo $causes_class; ?> clearfix">

				<?php

					if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }

					if ( $what_to_show == 'all' ) {
						
						if ( $show_funded ) {

							$args = array(
								'paged' => $paged, 
								'post_type' => 'dd_causes',
								'posts_per_page' => $posts_per_page
							);

						} else {

							$args = array(
								'paged' => $paged, 
								'post_type' => 'dd_causes',
								'posts_per_page' => $posts_per_page,
								'meta_key' => '_dd_cause_percentage',
								'order_by' => 'meta_value_num',
								'order' => 'DESC',
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key' => '_dd_cause_status',
										'value' => 'funded',
										'compare' => '!=',
									)
								)
							);

						}

					} else if ( $what_to_show == 'finished' ) {

						$args = array(
							'paged' => $paged, 
							'post_type' => 'dd_causes',
							'posts_per_page' => $posts_per_page,
							'meta_key' => '_dd_cause_percentage',
							'order_by' => 'meta_value_num',
							'order' => 'DESC',
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key' => '_dd_cause_status',
									'value' => 'funded',
									'compare' => '=',
								)
							)
						);

					} else if ( $what_to_show == 'lastmiles' ) {

						$args = array(
							'paged' => $paged, 
							'post_type' => 'dd_causes',
							'posts_per_page' => $posts_per_page,
							'meta_key' => '_dd_cause_percentage',
							'order_by' => 'meta_value_num',
							'order' => 'DESC',
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key' => '_dd_cause_status',
									'value' => 'lastmiles',
									'compare' => '=',
								)
							)
						);

					} else if ( $what_to_show == 'featured' ) {

						if ( $show_funded ) {

							$args = array(
								'paged' => $paged, 
								'post_type' => 'dd_causes',
								'posts_per_page' => $posts_per_page,
								'meta_query' => array(
									array(
										'key' => $dd_sn . 'cause_featured',
										'value' => 'yes',
										'compare' => '=',
									)
								)
							);

						} else {

							$args = array(
								'paged' => $paged, 
								'post_type' => 'dd_causes',
								'posts_per_page' => $posts_per_page,
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key' => $dd_sn . 'cause_featured',
										'value' => 'yes',
										'compare' => '=',
									),
									array(
										'key' => '_dd_cause_status',
										'value' => 'funded',
										'compare' => '!=',
									)
								)
							);
							
						}

					}
					
					// Do the Query
					$dd_query = new WP_Query($args);

					/* Loop */

					if ($dd_query->have_posts()) : while ($dd_query->have_posts()) : $dd_query->the_post(); $dd_count++;
						
							get_template_part( 'templates/causes', '' );

					endwhile; else:

						?><div class="align-center"><?php _e( 'No causes found.', 'dd_string' ); ?></div><?php

					endif;

				?>

			</div><!-- .blog-posts -->

			<?php
				$num_pages = $dd_query->max_num_pages;
				dd_theme_pagination( $num_pages ); 
				wp_reset_postdata(); 
			?>

		</div><!-- #content -->

		<?php if ( $has_sidebar ) { get_sidebar( 'causes' ); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>