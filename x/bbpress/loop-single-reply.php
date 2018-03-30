<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-header x-bbp-item-info-header">

		<?php if ( bbp_is_single_user_replies() || bbp_is_search() ) : ?>

			<h3 class="x-context-title">
				<?php _e( 'In reply to: ', 'bbpress' ); ?>
				<a href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
			</h3>

		<?php endif; ?>

		<div class="bbp-meta">

			<span class="x-item-info-date"><?php bbp_reply_post_date(); ?></span>

			<a href="<?php bbp_reply_url(); ?>" class="x-item-info-permalink">#<?php bbp_reply_id(); ?></a>

		</div><!-- .bbp-meta -->

		<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

		<?php bbp_reply_admin_links(); ?>

		<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

	</div>

	<div class="x-bbp-item-info-content">

		<div class="bbp-reply-author x-bbp-item-info-author">

			<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

			<?php bbp_reply_author_link( array( 'sep' => '', 'show_role' => true ) ); ?>

			<?php if ( bbp_is_user_keymaster() ) : ?>

				<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

				<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

				<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

			<?php endif; ?>

			<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

		</div><!-- .bbp-reply-author.x-bbp-item-info-content -->

		<div class="bbp-reply-content x-bbp-item-info-the-content">

			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

			<?php bbp_reply_content(); ?>

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>

		</div><!-- .bbp-reply-content.x-bbp-item-info-the-content -->

	</div><!-- .x-bbp-item-info-content -->

</div><!-- .reply -->
