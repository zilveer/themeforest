<table class="notifications">
	<thead>
		<tr>
			<th class="title"><?php _e( 'Notification', '__x__' ); ?></th>
			<th class="date"><?php _e( 'Date Received', '__x__' ); ?></th>
			<th class="actions"><?php _e( 'Actions', '__x__' ); ?></th>
		</tr>
	</thead>

	<tbody>

		<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>

			<tr>
				<td class="title"><?php bp_the_notification_description(); ?></td>
				<td class="date"><?php bp_the_notification_time_since(); ?></td>
				<td class="actions"><?php bp_the_notification_action_links(); ?></td>
			</tr>

		<?php endwhile; ?>

	</tbody>
</table>