<?php
/**
 * The template for displaying a single event
 *
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */
 ?>

 <?php get_header(); ?>

 <?php get_template_part( 'partials/primary-nav' ); ?>

 <section class="container">

 	<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

 		<?php if ( has_post_thumbnail() ) : // the current post has a thumbnail

 			//Get the Thumbnail URL
 			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slides', false, '' ); ?>

 			<div class="row-fluid">
 				<div class="span12 header" style="background-image:url(<?php echo $src[0] ?>); ">
 					<div class="diamond" style="background-color: <?php echo eo_get_event_color( $post->ID ); ?>">
						<?php spritz_event_posted_on($post->StartDate); ?>
					</div>
 				</div>
 			</div>

 		<?php else: ?>
 			<div class="row-fluid"><div class="span12"></div></div>
		<?php endif; ?>

 		<div class="row-fluid">
 			<div class="offset2 span8 entry">

 				<!-- Article -->
 				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_content' ); ?>>

 					<?php echo bootstrapwp_breadcrumbs(); ?>
 					<hr class="sexy_line">

 					<!-- Post Title -->
 					<h1 class="post-title"><?php the_title(); ?></h1>
 					<!-- /Post Title -->

					<!--<p class="lead"><?php echo get_the_excerpt() ?></p>-->

					<p class="lead center" style="color: <?php echo eo_get_event_color( $post->ID ); ?>; ">

						<!-- Choose a different date format depending on whether we want to include time -->
						<?php if(eo_is_all_day()): ?>
							<!-- Event is all day -->
							<?php $date_format = get_option('date_format'); ?>
						<?php else: ?>
							<!-- Event is not all day - include time in format -->
							<?php $date_format = get_option('date_format').' '.get_option('time_format'); ?>
						<?php endif; ?>

						<?php if(eo_reoccurs()):?>
							<!-- Event reoccurs - is there a next occurrence? -->
							<?php $next = eo_get_next_occurrence( $date_format );?>
							<?php if( $next ): ?>
								<!-- If the event is occurring again in the future, display the date -->
								<?php printf( __('This event is running from <strong>%1$s</strong> until <strong>%2$s</strong>. It is next occurring at <strong>%3$s</strong>','eventorganiser' ), eo_get_schedule_start( get_option('date_format') ), eo_get_schedule_last( get_option('date_format') ), $next );?>

							<?php else: ?>
								<!-- Otherwise the event has finished (no more occurrences) -->
								<?php printf( __('This event finished on <strong>%s</strong>', 'eventorganiser' ), eo_get_schedule_last( get_option('date_format'), '' ) );?>
						<?php endif; ?>

						<?php else: ?>
							<!-- Event is a single event -->
                            <?php
                                $date  = eo_get_the_end('Ymd');  // event end date
                                $today = current_time('Ymd');// getm today's date
                                if ( $date <= $today ) {
							         printf( __('This event was on <strong>%s</strong>', 'eventorganiser' ), eo_get_the_start($date_format ) );
                                } else {
							         printf( __('This event is on <strong>%s</strong>', 'eventorganiser' ), eo_get_the_start($date_format ) );
                                }
                            ?>

						<?php endif; ?>
					</p><!-- .entry-meta -->

					<div class="tags"><?php echo get_the_term_list( get_the_ID(), 'event-tag', '', ', ', '' ); ?></div>

					<div class="entry-content">

						<?php if ( ot_get_option( 'author_event_box', true ) ) : ?>

							<div class="author-box">

								<hr class="sexy_line"/>

								<?php $popover = esc_attr( sprintf('<h2 class="vcard">%s<small>%s</small></h2>', get_the_author_meta( 'display_name' ), __( 'the organizer', 'spritz' ) ) ); ?>

								<a class="author-avatar " rel="author" href="<?php echo get_the_author_meta( 'user_url' ) ? get_the_author_meta( 'user_url' ) : '#' ?>"  data-placement="top" data-html="true" data-content="<?php echo $popover; ?>" data-trigger="hover"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?></a>

							</div>

						<?php else: ?>

							<hr class="sexy_line" />

						<?php endif; ?>

						<!-- The content or the description of the event-->
						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'eventorganiser' ) . '</span>', 'after' => '</div>' ) ); ?>


					</div>

					<?php if ( eo_get_venue() ) : ?>

	 					<hr class="sexy_line"/>

						<h4 class="post-title"><?php echo eo_get_venue_name() ?></h4>

						<div class="img-polaroid"><?php echo eo_get_venue_map(); ?></div>

						<div class="subscribe"><?php echo do_shortcode( '[eo_subscribe title="Subscribe with Google" type="google" class="btn btn-large"]<i class="icon-calendar"> Subscribe to this event</i>[/eo_subscribe]' ); ?></div>

					<?php endif;?>

 					<?php comments_template( '', true ); // Remove if you don't want comments ?>

 				</article><!-- /Article -->

 			</div>

 		</div>

 	<?php endwhile;  else: ?>

 		<div class="row-fluid">
 			<div class="offset2 span8 entry">

 				<!-- Article -->
 				<article>
 					<h1><?php _e( 'Sorry, nothing to display.', 'spritz' ); ?></h1>
 					<p><?php _e( 'You are looking for an empty page. We are sorry for the inconvenience.', 'spritz' ); ?></p>
 					<p><a href="/"><?php _e( 'Return to home', 'spritz' ); ?></a></p>
 				</article>
 				<!-- /Article -->

 			</div>

 		</div>

 	<?php endif; ?>

 </section>

 <?php get_footer(); ?>