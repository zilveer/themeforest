<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$event_id = get_the_ID();
?>
<div id="tribe-events-content" class="tribe-events-single vevent hentry">
<?php tribe_the_notices() ?>
<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>></div>
	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="col-md-8">
	<?php echo tribe_event_featured_image( $event_id, 'latestfromblog', false ); ?>
<div class="w-event-content">
	<?php the_title( '<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>' ); ?>
	<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
	<div class="tribe-events-single-event-description tribe-events-content entry-content description">
		<?php the_content(); ?>
	</div>
	<?php
		do_action( 'tribe_events_single_event_after_the_content' );
		do_action( 'tribe_events_single_event_after_the_meta' );
	 ?>
</div>
</div>
<div class="col-md-4">
<div class="w-event-meta">
			<?php
			tribe_get_template_part( 'modules/meta/details' );
			if ( tribe_get_venue_id() ) {
			$phone = tribe_get_phone();
			$website = tribe_get_venue_website_link();
			?>
			<div class="tribe-events-meta-group tribe-events-meta-group-venue">
				<h3 class="tribe-events-single-section-title te-location"> <?php esc_html_e( 'Location', 'webnus_framework' ) ?> </h3>
				<dl>
					<?php do_action( 'tribe_events_single_meta_venue_section_start' ) ?>
					<dd class="author fn org"> <?php echo tribe_get_venue() ?> </dd>
					<?php
					$address = tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : '';
					if ( ! empty( $address ) ) {
						echo '<dd class="location">' . "$address</dd>";
					}
					?>
					<?php if ( ! empty( $phone ) ): ?>
						<h3 class="te-phone"> <?php esc_html_e( 'Phone', 'webnus_framework' ) ?> </h3>
						<dd class="tel"> <?php echo $phone ?> </dd>
					<?php endif ?>
					<?php if ( ! empty( $website ) ): ?>
						<h3 class="te-web"> <?php esc_html_e( 'Website', 'webnus_framework' ) ?> </h3>
						<dd class="url"> <?php echo $website ?> </dd>
					<?php endif ?>
					<?php do_action( 'tribe_events_single_meta_venue_section_end' ) ?>
				</dl>
			</div>
			<?php
			}
			if ( tribe_has_organizer() ) {
				tribe_get_template_part( 'modules/meta/organizer' );
			}
			?>

			<div class="event-sharing">
				<h3 class="te-share"><?php esc_html_e('Share this Event','webnus_framework'); ?></h3>
				<ul class="event-social">
						<li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ;?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a></li>
						<li><a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink() ;?>" target="_blank"><i class="fa-google-plus"></i></a></li>
						<li><a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink() ;?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo $permalink ;?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a>
				</ul>
			</div>

			<?php
			$webnus_options = webnus_options();
			$webnus_options['webnus_booking_enable'] = isset( $webnus_options['webnus_booking_enable'] ) ? $webnus_options['webnus_booking_enable'] : '';
			if($webnus_options['webnus_booking_enable']){
				$webnus_options['webnus_booking_form'] = isset( $webnus_options['webnus_booking_form'] ) ? $webnus_options['webnus_booking_form'] : '';
				$form_id=$webnus_options['webnus_booking_form'];
				echo'<a class="booking-button inlinelb" href="#w-book" target="_self"><span class="media_label">'.esc_html__('REGISTER FOR THIS EVENT','webnus_framework').'</span></a><div style="display:none"><div class="w-modal modal-book" id="w-book"><h3 class="modal-title">'.esc_html__('Book for ','webnus_framework').get_the_title().'</h3><br>'.do_shortcode('[contact-form-7 id="'.$form_id.'" title="Booking"]').'</div></div>';
			}
			echo '</div>';
			echo '<div class="tribe-events-meta-group tribe-events-meta-group-gmap">';
			tribe_get_template_part( 'modules/meta/map' );
			echo '</div>';
			?>

</div>
</div>
	<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>
</div>
