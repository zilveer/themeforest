<?php do_action( 'bp_before_group_invites_content' ); ?>

<?php if ( bp_has_groups( 'type=invites&user_id=' . bp_loggedin_user_id() ) ) : ?>

	<ul id="group-list" class="invites item-list" role="main">

		<?php while ( bp_groups() ) : bp_the_group(); ?>

			<li>

				<?php x_buddypress_groups_list_item_header(); ?>

				<div class="item-content">
					<div class="item-desc"><?php bp_group_description_excerpt(); ?></div>

					<?php do_action( 'bp_group_invites_item' ); ?>

				</div>

				<div class="x-list-item-meta activity-meta">
					<div class="x-list-item-meta-inner">
						<a class="accept" href="<?php bp_group_accept_invite_link(); ?>"><?php _e( 'Accept', '__x__' ); ?></a> &nbsp;
						<a class="reject confirm" href="<?php bp_group_reject_invite_link(); ?>"><?php _e( 'Reject', '__x__' ); ?></a>

						<?php do_action( 'bp_group_invites_item_action' ); ?>

						<div class="meta">

							<?php bp_group_type(); ?> / <?php bp_group_member_count(); ?>

						</div>
					</div>
				</div>
			</li>

		<?php endwhile; ?>
	</ul>

<?php else: ?>

	<div id="message" class="info" role="main">
		<p><?php _e( 'You have no outstanding group invites.', '__x__' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_group_invites_content' ); ?>