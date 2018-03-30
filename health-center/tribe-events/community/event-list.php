<?php
/**
 * My Events List Template
 * The template for a list of a users events.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/event-list.php
 *
 * @package TribeCommunityEvents
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

$icons = array(
	'publish' => 'checkmark',
	'draft'     => 'file',
	'pending'   => 'clock',
);

	// List "Add New" Button
	do_action( 'tribe_ce_before_event_list_top_buttons' ); ?>

	<div id="add-new"><a href="<?php echo tribe_community_events_add_event_link(); ?>" class="vamtam-button button button-border accent-2 hover-accent-2"><span class="btext"><?php echo apply_filters( 'tribe_ce_add_event_button_text', __( 'Add New','tribe-events-community' ) ); ?></span></a></div>

	<div class="table-menu-wrapper">

		<?php if ( $events->have_posts() ) { ?>
		<a href="#" class="table-menu-btn vamtam-button button button-border accent-2 hover-accent-2"><span class="btext"><?php echo apply_filters( 'tribe_ce_event_list_display_button_text', __( 'Display', 'tribe-events-community' ) ); ?></span></a><!-- table-menu-btn -->
		<?php } ?>

		<?php do_action( 'tribe_ce_after_event_list_top_buttons' ); ?>

		<div class="table-menu table-menu-hidden">
			<ul></ul>
		</div><!-- .table-menu -->

	</div><!-- .table-menu-wrapper -->


	<?php // list admin link
	$current_user = wp_get_current_user(); ?>
	<div id="not-user">
		<?php _e( 'Not','tribe-events-community' ); ?>
		<i><?php echo $current_user->display_name; ?></i> ?
		<a href="<?php echo tribe_community_events_logout_url(); ?>">
			<?php _e( 'Log Out', 'tribe-events-community' ); ?>
		</a>
	</div>

	<div style="clear:both"></div>

	<?php // list pagination
	if ( !$events->have_posts() ) {
		$this->enqueueOutputMessage( __( 'There are no upcoming events in your queue.', 'tribe-events-community' ) );
	}
	echo tribe_community_events_get_messages();
	$tbody = '';
	echo $this->pagination( $events, '', $this->paginationRange );

	do_action( 'tribe_ce_before_event_list_table' );
	if ( $events->have_posts() ) :
	?>

	<div class="my-events-table-wrapper">

		<table class="events-community my-events" cellspacing="0" cellpadding="4">
			<thead id="my-events-display-headers">
				<tr>
					<th class="essential persist"><?php _e( 'Status','tribe-events-community' ); ?></th>
					<th class="essential persist"><?php _e( 'Title','tribe-events-community' ); ?></th>
					<th class="essential"><?php _e( 'Organizer','tribe-events-community' ); ?></th>
					<th class="essential"><?php _e( 'Venue','tribe-events-community' ); ?></th>
					<th class="optional1"><?php _e( 'Category','tribe-events-community' ); ?></th>
					<?php if(class_exists('TribeEventsPro'))
						echo '<th class="optional2">'. __( 'Recurring?','tribe-events-community' ) .'</th>'; ?>
					<th class="essential"><?php _e( 'Start Date','tribe-events-community' ); ?></th>
					<th class="essential"><?php _e( 'End Date','tribe-events-community' ); ?></th>
				</tr>
			</thead><!-- #my-events-display-headers -->

			<tbody id="the-list"><tr>
				<?php $rewriteSlugSingular = Tribe__Events__Main::getOption( 'singleEventSlug', 'event' );
				global $post;
				$old_post = $post;
				while ( $events->have_posts() ) {
					$e = $events->next_post();
					$post = $e; ?>

					<tr>

						<td><?php
							if ( isset( $icons[$post->post_status] ) ) {
								echo wpv_shortcode_icon(
									array(
										'name' => $icons[$post->post_status],
										'size' => 16,
									)
								);
							} else {
								echo TribeCommunityEvents::instance()->getEventStatusIcon( $post->post_status );
							}
						?></td>
						<td>
						<?php
						$canEdit = current_user_can( 'edit_post', $post->ID );
						$canDelete = current_user_can( 'delete_post', $post->ID );
						if ( $canEdit ) { ?>
							<span class="title">
								<a href="<?php echo tribe_community_events_edit_event_link( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
							</span>
						<?php } else {
							echo $post->post_title;
						} ?>
						<div class="row-actions">
							<span class="view">
								<a href="<?php echo tribe_get_event_link( $post ); ?>"><?php _e( 'View','tribe-events-community' ); ?></a>
							</span>
							<?php if ( $canEdit ) {
								echo TribeCommunityEvents::instance()->getEditButton( $post, 'Edit', '<span class="edit wp-admin events-cal"> |', '</span> ' );
							}
							if ( $canDelete ) {
								echo TribeCommunityEvents::instance()->getDeleteButton( $post );
							} ?>
						</div><!-- .row-actions -->
						</td>

						<td>
						<?php if ( tribe_has_organizer( $post->ID ) ) {
							$organizer_id = tribe_get_organizer_id( $post->ID );
							if ( current_user_can( 'edit_post', $organizer_id ) ) {
								echo '<a href="'. TribeCommunityEvents::instance()->getUrl( 'edit', $organizer_id, null, Tribe__Events__Main::ORGANIZER_POST_TYPE ) .'">'. tribe_get_organizer( $post->ID ) .'</a>';
							} else {
								echo tribe_get_organizer( $post->ID );
							}
						} ?>
						</td>

						<td>
						<?php if ( tribe_has_venue( $post->ID ) ) {
							$venue_id = tribe_get_venue_id( $post->ID );
							if ( current_user_can( 'edit_post', $venue_id ) ) {
								echo '<a href="' . TribeCommunityEvents::instance()->getUrl( 'edit', $venue_id, null, Tribe__Events__Main::VENUE_POST_TYPE ) . '">'. tribe_get_venue( $post->ID ) .'</a>';
							} else {
								echo tribe_get_venue( $post->ID );
							}
						} ?>
						</td>

						<td><?php echo TribeEventsAdminList::custom_columns( 'events-cats', $post->ID, false ); ?></td>

						<?php if ( function_exists('tribe_is_recurring_event') ) { ?>
							<td>
							<?php if ( tribe_is_recurring_event( $post->ID ) ) {
								_e('Yes','tribe-events-community' );
							} else {
								_e('No','tribe-events-community' );
							} ?>
							</td>
						<?php } ?>

						<td>
						<?php $start_date = strtotime( $post->EventStartDate );
						echo tribe_event_format_date( $start_date, false, TribeCommunityEvents::instance()->eventListDateFormat ); ?>
						</td>

						<td>
						<?php $end_date = strtotime( $post->EventEndDate );
						echo tribe_event_format_date( $end_date, false, TribeCommunityEvents::instance()->eventListDateFormat ); ?>
						</td>

					</tr>

				<?php } // end list loop
				$post = $old_post; ?>

			</tbody><!-- #the-list -->

			<?php do_action( 'tribe_ce_after_event_list_table' ); ?>

		</table><!-- .events-community -->

	</div><!-- .my-events-table-wrapper -->

	<?php // list pagination
	echo $this->pagination( $events, '', $this->paginationRange );

	endif; // if ( $events->have_posts() )
