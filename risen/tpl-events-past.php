<?php
/* Template Name: Events - Past */

// Get events that ended before today
risen_events_prepare_data(); // make sure event data is ready for current theme version
$events_query = new WP_Query( array(
	'post_type'			=> 'risen_event',
	'posts_per_page'	=> risen_option( 'events_per_page' ) ? risen_option( 'events_per_page' ) : risen_option_default( 'events_per_page' ),
	'paged'				=> risen_page_num(), // returns/corrects $paged so pagination works on static front page
	'meta_query' => array(
		array(
			'key' => '_risen_event_end_date', // the latest date that the event goes to (could be start date)
			'value' => date_i18n( 'Y-m-d' ), // today's date, localized
			'compare' => '<', // all events with start AND end date BEFORE today
			'type' => 'DATE'
		),
	),
	'meta_key' 			=> '_risen_event_end_date', // want finish date first
	'orderby'			=> 'meta_value',
	'order'				=> 'DESC' // sort from most recently past to oldest
) );

// Header
get_template_part( 'header', 'page' ); // this makes $content_title available

?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'events' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>
		
			<?php if ( $content_title ) : // this comes from header-page.php; empty if no title should show at top of content ?>	
			<header class="title-with-right">
				<h1 class="page-title"><?php echo $content_title; ?></h1>
				<div class="page-title-right"><?php risen_post_count_message( $events_query ); ?></div>
				<div class="clear"></div>
			</header>
			<?php endif; ?>
			
			<?php if ( trim( strip_tags( $post->post_content ) ) ) : // has content ?>
				<div class="post-content"> <!-- confines heading font to this content -->
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
			
			<?php get_template_part( 'loop', 'events' ); // loop and show each, if any ?>

			<?php risen_posts_nav( $events_query, __( '<span>&larr;</span> Recent Events', 'risen' ), __( 'Older Events <span>&rarr;</span>', 'risen' ) ); ?>
			
			<?php if ( ! $events_query->have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, there are no events to show.', 'risen' ); ?></p>
			<?php endif; ?>
			
		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'events' ); ?>
			
<?php endwhile; ?>

<?php get_footer(); ?>