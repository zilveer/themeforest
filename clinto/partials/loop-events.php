<div class="row" id="masonry">

	<?php $count = 0;  while ( have_posts() ) : the_post(); ?>

		<div class="span4 entry-event" style="border-bottom: 6px solid #999; border-color: <?php echo eo_get_event_color( $post->ID ); ?>">

			<?php if ( has_post_thumbnail() ) : // the current post has a thumbnail

				//Get the Thumbnail URL
				$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'box_slides', false, '' ); ?>

				<div class="box-header">
					<a href="<?php echo get_permalink( $post->ID ); ?>" class=""><img src="<?php echo $src[0]; ?>" class="media-object" alt="<?php echo esc_attr( get_post_field( 'post_title', $post->ID ) ) ?>" width="<?php echo $src[1]; ?>" height="<?php echo $src[2]; ?>"/></a>
					<div class="diamond" style="background-color: <?php echo eo_get_event_color( $post->ID ); ?>"><?php spritz_event_posted_on( $post->StartDate ); ?></div>
				</div>

			<?php else: ?>
				<div class="box-header"></div>
			<?php endif; ?>

			<div class="row-fluid">
				<div class="offset1 span10 entry masonry">

					<!-- Article -->
					<article id="post-<?php the_ID(); ?>-<?php echo rand(0,1000); ?>" <?php post_class( 'post_content' ); ?>>

						<!-- Post Title -->
						<h2><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>
						<!-- /Post Title -->

						<?php if ( eo_get_venue() ) :?>
							<div class="venues"><a href="<?php echo eo_get_venue_link(); ?>" title="<?php echo esc_attr( eo_get_venue_name() ) ?>"><i class="icon-map-marker"></i> <?php echo eo_get_venue_name(); ?></a></div>
						<?php endif; ?>
						<hr class="sexy_line"/>
						<div class="entry-meta">
							<i class="icon-calendar"></i>

							<!-- Choose a different date format depending on whether we want to include time -->
							<?php $date_format = ( eo_is_all_day() ) ? 'j F Y' : 'j F Y g:ia'; ?>

							<?php if( eo_reoccurs() ) :?>
								<!-- Event reoccurs - is there a next occurrence? -->
								<?php $next = eo_get_next_occurrence( $date_format ); ?>
								<?php if( $next ) : ?>
									<!-- If the event is occurring again in the future, display the date -->
									<?php printf( __('This event is running from %1$s until %2$s. It is next occurring at %3$s', 'eventorganiser' ), eo_get_schedule_start( 'd F Y' ), eo_get_schedule_last( 'd F Y' ), $next );?>
								<?php else : ?>
									<!-- Otherwise the event has finished (no more occurrences) -->
									<?php printf( __('This event finished on %s','eventorganiser'), eo_get_schedule_last( 'd F Y','' ) );?>
							<?php endif; ?>

							<?php else: ?>
								<!-- Event is a single event -->
								<?php printf( __( 'This event is on %s', 'eventorganiser' ), eo_get_the_start( $date_format ) );?>
							<?php endif; ?>
						</div><!-- .entry-meta -->

					</article>
					<!-- /Article -->

				</div>
			</div>
		</div>

	<?php endwhile; ?>
</div>
