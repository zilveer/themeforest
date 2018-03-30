<?php
/**
 * Short Event
 *
 * Used in loop-events.php and loop-search.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-short' ); ?>>

	<header>

		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		
		<div class="box event-header-meta">

			<div class="event-date-location">

				<?php							
				$start_date = get_post_meta( $post->ID , '_risen_event_start_date' , true );
				$end_date = get_post_meta( $post->ID , '_risen_event_end_date' , true );
				$date_format = get_option( 'date_format' );
				if ( $start_date ) :
				?>

				<span class="event-header-meta-date">
					<?php if ( $end_date != $start_date ) : // date range ?>
					<?php
					/* translators: START DATE - END DATE for events */
					printf( __( '%s &ndash; %s', 'risen' ),
						date_i18n( $date_format, strtotime( $start_date ) ),
						date_i18n( $date_format, strtotime( $end_date ) )
					);
					?>
					<?php else : // start date only ?>
					<?php echo date_i18n( $date_format, strtotime( $start_date ) ); ?>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				
				<?php							
				$time = get_post_meta( $post->ID , '_risen_event_time' , true );
				if ( $time ) :
				?>
				<span class="event-header-meta-time"><?php echo $time; ?></span>
				<?php endif; ?>
			
			</div>

			<ul class="event-header-meta-icons risen-icon-list">
				
				<?php if ( ( comments_open() || get_comments_number() > 0 ) && ! post_password_required() ) : // show X comments if some were posted, even if now new comments are off (unless password protected) ?>
				<li><?php comments_popup_link( __( '0', 'risen' ), __( '1', 'risen' ), '%', 'single-icon comment-icon', '' ); ?><?php comments_popup_link( __( '0', 'risen' ), __( '1', 'risen' ), '%', 'risen-icon-label', '' ); ?></li>
				<?php endif; ?>

			</ul>
			
			<div class="clear"></div>
			
		</div>
		
	</header>
	
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="image-frame event-short-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'risen-post', array( 'title' => '' ) ); ?></a></div>
	<?php endif; ?>
	
	<?php
	/*
	$latest_date = $end_date > $start_date ? $end_date : $start_date; // if start date is past but end date not yet past, it should not be marked as "in the past"
	if ( $latest_date && $latest_date < date_i18n( 'Y-m-d' ) ) : // there is a date and it is older than current localized date
	?>
	<div class="event-past-note"><?php _e( 'This event is over.', 'risen' ); ?></div>
	<?php
	endif;
	*/
	?>
	
	<?php
	$excerpt = trim( get_the_excerpt() );
	if ( ! empty( $excerpt ) ) :
	?>
	<div class="event-short-excerpt">
		<?php echo wpautop( $excerpt ); ?>
	</div>
	<?php endif; ?>
	
	<p>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="button button-small"><?php _ex( 'Event Details', 'event', 'risen' ); ?></a>				
	</p>

</article>
