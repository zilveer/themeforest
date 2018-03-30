<?php do_action( 'bp_before_member_messages_loop' ); ?>

<?php if ( bp_has_message_threads( bp_ajax_querystring( 'messages' ) ) ) : ?>

	<?php do_action( 'bp_before_member_messages_threads'   ); ?>

	<table id="message-threads" class="messages-notices">

		<tr>
			<th class="thread-from"><?php ( 'sentbox' != bp_current_action() ) ? _e( 'From', '__x__' ): _e( 'To', '__x__' ); ?></th>
			<th class="thread-info"><?php _e( 'Message', '__x__' ); ?></th>
			<th class="thread-options"><?php _e( 'Action', '__x__' ); ?></th>
		</tr>

		<?php while ( bp_message_threads() ) : bp_message_thread(); ?>

			<tr id="m-<?php bp_message_thread_id(); ?>" class="<?php bp_message_css_class(); ?><?php if ( bp_message_thread_has_unread() ) : ?> unread<?php else: ?> read<?php endif; ?>">
				<?php if ( 'sentbox' != bp_current_action() ) : ?>
					<td class="thread-from">
						<?php bp_message_thread_from(); ?><br />
						<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
						<?php if ( bp_get_message_thread_unread_count() != 0 ) : ?>
							<span class="x-bp-count"><?php bp_message_thread_unread_count(); ?></span>
						<?php endif; ?>
					</td>
				<?php else: ?>
					<td class="thread-from">
						<?php bp_message_thread_to(); ?><br />
						<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
						<?php if ( bp_get_message_thread_unread_count() != 0 ) : ?>
							<span class="x-bp-count"><?php bp_message_thread_unread_count(); ?></span>
						<?php endif; ?>
					</td>
				<?php endif; ?>

				<td class="thread-info">
					<a href="<?php bp_message_thread_view_link(); ?>" title="<?php esc_attr_e( "View Message", "__x__" ); ?>"><?php bp_message_thread_subject(); ?></a><br />
					<span class="thread-excerpt"><?php bp_message_thread_excerpt(); ?></span>
				</td>

				<?php do_action( 'bp_messages_inbox_list_item' ); ?>

				<td class="thread-options">
					<input type="checkbox" name="message_ids[]" value="<?php bp_message_thread_id(); ?>" />
					<a class="confirm" href="<?php bp_message_thread_delete_link(); ?>" title="<?php esc_attr_e( "Delete Message", "__x__" ); ?>"><?php _e( 'Delete', '__x__' ); ?></a>
				</td>
			</tr>

		<?php endwhile; ?>
	</table><!-- #message-threads -->

	<div class="messages-options-nav">
		<?php bp_messages_options(); ?>
	</div><!-- .messages-options-nav -->

	<?php do_action( 'bp_after_member_messages_threads' ); ?>

	<?php do_action( 'bp_after_member_messages_options' ); ?>

	<div class="x-pagination pagination no-ajax" id="user-pag">

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php do_action( 'bp_after_member_messages_pagination' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, no messages were found.', '__x__' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_member_messages_loop' ); ?>
