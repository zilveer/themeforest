<?php 
	
	// Globals
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;
	global $dd_count;
	global $dd_max_count;
	global $dd_style;
	global $more; $more = 0; // Make the more tag work

	// Default - Post Class
	if ( ! isset( $dd_post_class ) ) {
		$dd_post_class = 'one-third column ';
	}

	// Default - Thumb Size
	if ( ! isset( $dd_thumb_size ) ) {
		$dd_thumb_size = 'dd-one-third';	
	}

	// Default - Post Style
	if ( ! isset( $dd_style ) ) {
		$dd_style = 1;
	}

	// Post Class - Append - Thumbnail
	if ( has_post_thumbnail() ) {
		$dd_post_class_append = 'has-thumb ';
	} else {
		$dd_post_class_append = '';
	}

	// Post Class - Last (column)
	if ( $dd_count == $dd_max_count ) {
		$last_class = 'last';
		$dd_count = 0;
	} else {
		$last_class = '';
	}

	if ( $dd_count == 1 ) {
		$last_class = 'clear';
	}

	// Facebook link of event
	$fb_link = get_post_meta( get_the_ID(), $dd_sn . 'event_facebook_link', true );

	// Date of event
	$event_date = get_post_meta( get_the_ID(), $dd_sn . 'event_date', true );
	if ( ! $event_date )
		$event_date = get_the_time( get_option( 'date_format' ) );

?>

<?php if ( is_single() ) : ?>
		
	

<?php else : ?>

	<div <?php post_class( 'event clearfix ' . $dd_post_class . $dd_post_class_append . $last_class ); ?>>

		<?php if ( $dd_style == '1' ) : ?>

			<div class="event-inner">

				<div class="event-thumb">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $dd_thumb_size ); ?></a>

					<div class="event-date"><span class="icon-calendar"></span><?php ; ?></div>

				</div><!-- .event-thumb -->

				<div class="event-main">

					<h2 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
					<div class="event-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .event-excerpt -->

				</div><!-- .event-main -->

				<div class="event-info">
					
					<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
					
					<?php if ( $fb_link != '' ) : ?>
						<em><?php _e( 'or', 'dd_string' ); ?></em>
						<a href="<?php echo $fb_link; ?>" target="_blank" class="dd-button small blue-light"><?php _e( 'FACEBOOK PAGE', 'dd_string' ); ?></a>
					<?php endif; ?>

				</div><!-- event-info -->

			</div><!-- .event-inner -->

		<?php elseif ( $dd_style == '2' ) : ?>

			<div class="event-inner">

				<div class="event-thumb four columns">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-home-events' ); ?></a>

				</div><!-- .event-thumb -->

				<div class="event-main">

					<div class="event-date"><span class="icon-calendar"></span><?php echo $event_date; ?></div>

					<h2 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
					<div class="event-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .event-excerpt -->

					<div class="event-info">
					
						<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
						
						<?php if ( $fb_link != '' ) : ?>
							<em><?php __( 'or', 'dd_string' ); ?></em>
							<a href="<?php echo $fb_link; ?>" target="_blank" class="dd-button small blue-light"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?></a>
						<?php endif; ?>

					</div><!-- event-info -->

				</div><!-- .event-main -->

			</div><!-- .event-inner -->

		<?php endif; ?>

	</div><!-- .event -->

<?php endif; ?>