<?php
/**
 * Template Name: Events
 *
 * @package spectra
 * @since 1.0.0
 */

get_header(); ?>

<?php 
   global $spectra_opts, $wp_query, $post;

    // Copy query
    $temp_post = $post;
    $query_temp = $wp_query;

    // Featured events number
    $featured_events = 3;

    // Variables
    $events_count = 0;
    $count = 1;

    // Event Type
   	$event_type = get_post_meta( $wp_query->post->ID, '_event_type', true );

    // Events Layout
    $events_layout = get_post_meta( $wp_query->post->ID, '_events_layout', true );
    $events_heading = get_post_meta( $wp_query->post->ID, '_events_heading', true );

    // Pagination Limit
    $limit = (int)get_post_meta( $wp_query->post->ID, '_limit', true );
    $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;

    // Date format
   	$date_format = 'd/m';
   	if ( $spectra_opts->get_option( 'event_date' ) ) {
   		$date_format = $spectra_opts->get_option( 'event_date' );
        $event_time = $spectra_opts->get_option( 'event_time' );
        if ( $event_time && $event_time != '' ) {
            $date_format = $date_format . ' ' . $event_time;
        }

   }

?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ EVENTS ############ -->
<div id="page" class="no-margin">
		
	<?php

        /* Set order */
        $order = $event_type == 'future-events' ? $order = 'ASC' : $order = 'DSC';

        // Event type taxonomy
        $tax = array(
            array(
               'taxonomy' => 'spectra_event_type',
               'field' => 'slug',
               'terms' => $event_type
              )
        );

		// Begin Loop
        $args = array(
            'post_type'        => 'spectra_events',
            'showposts'        => $limit,
            'paged'            => $paged,
            'tax_query'        => $tax,
            'orderby'          => 'meta_value',
            'meta_key'         => '_event_date_start',
            'order'            => $order,
            'suppress_filters' => 0 // WPML FIX
		);
		$wp_query = new WP_Query();
		$wp_query->query( $args );

        $events_count = get_posts( $args );
        $events_count = count( $events_count );

        if ( $events_layout === 'mixed' && $paged > 0 ) {
            $events_layout = 'bricks';
        }

        if ( $events_layout === 'mixed' && $events_count <= $featured_events ) {
            $events_layout = 'list';
        }
       
    ?>
	
	<?php if ( have_posts() ) : ?>
    <?php if ( $events_layout === 'list' || $events_layout === 'mixed' ) : ?>
    <!-- ############ Events list ############ -->
    <ul id="events-list-anim">
    <?php else : ?>
    <!-- ############ Masonry events ############ -->
    <div class="masonry-events">
    <?php endif; ?>   
    <?php while ( have_posts() ) : the_post(); ?>
        <?php

            // Custom link 
            $ticket_link = get_post_meta( $wp_query->post->ID, '_ticket_url', true );

            // Link target attribute 
            $target = get_post_meta( $wp_query->post->ID, '_ticket_target', true );
            $target = isset( $target ) && $target == 'on' ? $target = '_blank' : $target = '';

            /* Event Date */
            $event_time_start = get_post_meta( $wp_query->post->ID, '_event_time_start', true );
            $event_date_start = get_post_meta( $wp_query->post->ID, '_event_date_start', true );
            $event_date_start = $event_date_start . ' ' . $event_time_start;
            $event_date_start = strtotime( $event_date_start );

            $event_date_end = strtotime( get_post_meta( $wp_query->post->ID, '_event_date_end', true ) );

            /* Location */
            $event_location = get_post_meta( $wp_query->post->ID, '_event_address', true );

             // Get Event Image
            $event_image = get_post_meta( $wp_query->post->ID, '_event_image', true );
            $event_image_crop = get_post_meta( $wp_query->post->ID, '_event_image_crop', true );
            $event_ID = $wp_query->post->ID;
            if ( $event_image ) {
                $custom_css = 'background-image: url(' . esc_url( $spectra_opts->get_image( $event_image ) ) . ');';
            } else {
                $custom_css = '';
            }
            
            ?>
        <?php if ( $events_layout === 'list' || $events_layout === 'mixed' ) : ?>
        <!-- event -->
        <li id="event_<?php esc_attr( the_id() ) ?>" style="<?php echo esc_attr( $custom_css ) ?>">
            <div class="inner">
                <span class="event-date"><?php echo date_i18n( $date_format, $event_date_start ); ?></span>
                <h2><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2>
                <span class="event-location"><?php echo esc_html( $event_location ); ?></span>
            </div>
        </li>
        <!-- /event -->
        <?php else :  ?> 

        <!-- event brick -->
        <a href="<?php esc_url( the_permalink() ); ?>" class="event-brick">
            <span class="event-date"><?php echo date_i18n( $date_format, $event_date_start ); ?></span>
            <span class="event-title"><?php the_title(); ?></span>
            <span class="event-location"><?php echo esc_html( $event_location ); ?></span>
        </a>
        <!-- /event brick -->

        <?php endif; ?>

    <?php 
        // Only for mixed layout
        if ( $events_layout === 'mixed' && $count === $featured_events ) :
            $events_layout = 'bricks';
            echo '</ul>';
            if ( $events_count > $featured_events ) : ?>
                <?php if ( $events_heading === 'on' ) : ?>
                <div class="events-separator">
                    <h6 class="heading-xl"><?php _e( 'More events', SPECTRA_THEME ); ?></h6>
                </div>
                <!-- /more events -->
                <?php endif; ?>
                <div class="masonry-events">
            <?php endif; ?>
        <?php endif; ?>
       <?php $count++; ?>
	<?php endwhile; // End Loop ?>

	 <?php if ( $events_layout === 'list' ) : ?>
    </ul>
    <?php else : ?>
    </div>
    <!-- /events -->
    <?php endif; ?>   
    <div class="clear"></div>
    <?php spectra_paging_nav(); ?>
    <?php endif; ?>
			
</div>
<!-- /page -->
<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>
<?php get_footer(); ?>