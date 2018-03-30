<?php

/**
 * BuddyPress - Activity Stream Comment
 *
 * This template is used by bp_activity_comments() functions to show
 * each activity.
 */

?>

<?php do_action( 'bp_before_activity_comment' ); ?>

<li id="acomment-<?php bp_activity_comment_id(); ?>">
	<div class="acomment-avatar">
		<a href="<?php bp_activity_comment_user_link(); ?>">
			<?php bp_activity_avatar( array(
				'type'    => 'thumb',
				'user_id' => bp_get_activity_comment_user_id()
			) ); ?>
		</a>
	</div>

	<div class="acomment-meta">
		<a href="<?php echo bp_get_activity_comment_user_link(); ?>"><?php echo bp_get_activity_comment_name(); ?></a>
	</div>

	<div class="acomment-content"><?php bp_activity_comment_content(); ?></div>

	<div class="acomment-options">

		<?php if ( is_user_logged_in() && bp_activity_can_comment_reply( bp_activity_current_comment() ) ) : ?>

			<a href="#acomment-<?php bp_activity_comment_id(); ?>" class="acomment-reply bp-primary-action" id="acomment-reply-<?php bp_activity_id(); ?>-from-<?php bp_activity_comment_id(); ?>"><?php _e( 'Reply', 'buddypress' ); ?></a>

		<?php endif; ?>

		<?php if ( bp_activity_user_can_delete() ) : ?>

			<a href="<?php bp_activity_comment_delete_link(); ?>" class="delete acomment-delete confirm bp-secondary-action" rel="nofollow"><?php _e( 'Delete', 'buddypress' ); ?></a>

		<?php endif; ?>

		<?php do_action( 'bp_activity_comment_options' ); ?>

	</div>

	<span class="dd-bp-comment-time-since"><?php echo bp_get_activity_comment_date_recorded(); ?></span>

	<div class="clear"></div>

	<?php bp_activity_recurse_comments( bp_activity_current_comment() ); ?>

</li>

<?php do_action( 'bp_after_activity_comment' ); ?>
