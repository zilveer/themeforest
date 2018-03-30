<?php 
/*
	Template Name: Events
*/

get_header(); 

// Get Options
$layout = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );
$posts_per_page = get_post_meta( get_the_ID(), $dd_sn . 'posts_per_page', true );
$post_width = get_post_meta( get_the_ID(), $dd_sn . 'post_width', true );

// Set vars
$dd_count = 0;
$dd_max_count = 4;

// Set vars (with sidebar)
if ( $layout == 'cs' ) {

	// In page vars
	$content_class = 'two-thirds column ';
	$events_class = 'events-listing-style-2';
	$has_sidebar = true;

	// Template vars (globals)
	$dd_post_class = '';
	$dd_thumb_size = 'dd-one-fourth';
	$dd_style = '2';

// Set vars (without sidebar)
} else {

	// In page vars
	$content_class = '';
	$events_class = 'masonry';
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

// What to show - Default
$what_to_show = 'all';

// What to show
if ( isset( $_GET['dd_get'] ) ) {
	$what_to_show = $_GET['dd_get'];
}

// Filter to call (changes the query)
if ( $what_to_show == 'all' ) {
	$filter_to_call = 'dd_query_events_upcoming';
} elseif ( $what_to_show == 'past' ) {
	$filter_to_call = 'dd_query_events_past';
} elseif ( $what_to_show == 'upcoming' ) {
	$filter_to_call = 'dd_query_events_upcoming';
}

// Are we on a specific month
if ( isset( $_GET['dd_month'] ) ) {
	$month = $_GET['dd_month'];
} else {
	$month = false;
}

// Are we on a specific year
if ( isset( $_GET['dd_year'] ) ) {
	$year = $_GET['dd_year'];
} else {
	$year = false;
}

?>

	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>

			<div class="events events-listing <?php echo $events_class; ?> clearfix">

				<?php					

					if(is_front_page()){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }else{ $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; }

					if ( $what_to_show == 'past' ) {

						$args = array(
							'paged' => $paged, 
							'post_type' => 'dd_events',
							'posts_per_page' => $posts_per_page,
							'post_status' => array( 'publish' ),
							'order' => 'DESC',
						);

					} else if ( $month ) {

						$args = array(
							'paged' => $paged, 
							'post_type' => 'dd_events',
							'posts_per_page' => $posts_per_page,
							'post_status' => array( 'future', 'publish' ),
							'order' => 'ASC',
							'monthnum' => $month
						);

					} else if ( $year ) {

						$args = array(
							'paged' => $paged, 
							'post_type' => 'dd_events',
							'posts_per_page' => $posts_per_page,
							'post_status' => array( 'future', 'publish' ),
							'order' => 'ASC',
							'year' => $year
						);

					} else {

						$args = array(
							'paged' => $paged, 
							'post_type' => 'dd_events',
							'posts_per_page' => $posts_per_page,
							'post_status' => array( 'future', 'publish' ),
							'order' => 'ASC'
						);

					}
					
					// Add Filter
					if ( $filter_to_call ) { add_filter( 'posts_where', $filter_to_call ); }
					
					// Do the Query
					$dd_query = new WP_Query($args);

					// Remove Filter
					if ( $filter_to_call ) { remove_filter( 'posts_where', $filter_to_call ); }

					// Loop

					if ($dd_query->have_posts()) : while ($dd_query->have_posts()) : $dd_query->the_post(); $dd_count++;
						
							get_template_part( 'templates/events', '' );

					endwhile; else:

						?><div class="align-center"><?php _e( 'There are no events that match the criteria', 'dd_string' ); ?></div><?php

					endif;

				?>

			</div><!-- .events -->

			<?php
				$num_pages = $dd_query->max_num_pages;
				dd_theme_pagination( $num_pages ); 
				wp_reset_postdata(); 
			?>

		</div><!-- #content -->

		<?php if ( $has_sidebar ) { get_sidebar( 'events' ); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>