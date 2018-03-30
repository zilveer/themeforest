<?php do_action( 'bp_before_member_friend_requests_content' ); ?>

<?php if ( bp_has_members( 'type=alphabetical&include=' . bp_get_friendship_requests() ) ) : ?>

	<ul id="friend-list" class="item-list" role="main">
		<?php while ( bp_members() ) : bp_the_member(); ?>

			<li id="friendship-<?php bp_friend_friendship_id(); ?>">

				<?php x_buddypress_members_list_item_header(); ?>

				<div class="item-content">

					<?php do_action( 'bp_friend_requests_item' ); ?>

				</div>

				<div class="x-list-item-meta activity-meta">
					<div class="x-list-item-meta-inner">
						<a class="accept" href="<?php bp_friend_accept_request_link(); ?>"><?php _e( 'Accept', '__x__' ); ?></a> &nbsp;
						<a class="reject" href="<?php bp_friend_reject_request_link(); ?>"><?php _e( 'Reject', '__x__' ); ?></a>

						<?php do_action( 'bp_friend_requests_item_action' ); ?>
					</div>
				</div>
			</li>

		<?php endwhile; ?>
	</ul>

	<?php do_action( 'bp_friend_requests_content' ); ?>

	<div id="pag-bottom" class="x-pagination pagination no-ajax">

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'You have no pending friendship requests.', '__x__' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_member_friend_requests_content' ); ?>
