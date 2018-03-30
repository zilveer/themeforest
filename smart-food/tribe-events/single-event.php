<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$event_id = get_the_ID();

$sidebar = tdp_option('events_single_page_layout');

?>

<?php if($sidebar == 'sidebar_left') : ?>

	<div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
	    <?php dynamic_sidebar( 'events_sidebar' ); ?>
	</div>

<?php endif; ?>

<section id="blog-posts" class="col-md-9 col-sm-12 col-xs-12 column">

	<p class="tribe-events-back">
		<a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar', 'smartfood' ) ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<?php the_title( '<h4 class="tribe-events-single-event-title summary entry-title">', '</h4>' ); ?>

	<div class="tribe-events-schedule updated published tribe-clearfix single-event-meta">
		<i class="fa fa-calendar"></i> <?php echo tribe_events_event_schedule_details( $event_id, '<h3>', '</h3>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span class="tribe-events-divider">|</span>
			<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
		<?php endif; ?>
	</div>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Navigation', 'tribe-events-calendar', 'smartfood' ) ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php if(has_post_thumbnail()) : ?>
		
				<?php 
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb, 'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				?>
				<figure class="post-img media">
					<div class="mediaholder <?php if(is_singular( )) : ?>lightbox<?php endif;?>">
						<?php if(is_singular( )) : ?>
							<a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" class="image-link" data-effect="">
						<?php else :?>	
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image-link" data-effect="">
						<?php endif; ?>
							<img src="<?php echo fImg::resize( $img_url, 780, 350, true ); ?>" alt="<?php the_title();?>"/>
							<div class="hovercover">
					            <div class="hovericon"><i class="fa fa-plus"></i></div>
					         </div>
						</a>
					</div>
				</figure>

			<?php endif; ?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>

			<?php
			/**
			 * The tribe_events_single_event_meta() function has been deprecated and has been
			 * left in place only to help customers with existing meta factory customizations
			 * to transition: if you are one of those users, please review the new meta templates
			 * and make the switch!
			 */
			if ( ! apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
				tribe_get_template_part( 'modules/meta' );
			} else {
				echo tribe_events_single_event_meta();
			}
			?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
			
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == TribeEvents::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

</section><!-- .entry -->

<?php if($sidebar == 'sidebar_right') : ?>

	<div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
	    <?php dynamic_sidebar( 'events_sidebar' ); ?>
	</div>

<?php endif; ?>