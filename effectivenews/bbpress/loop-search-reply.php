<?php

/**
 * Search Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div class="base-box">


	<div class="bbp-reply-title">

		<h3><?php _e( 'In reply to: ', 'bbpress' ); ?>
		<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a></h3>

	</div><!-- .bbp-reply-title -->


<div <?php bbp_reply_class(); ?>>
	<div class="bbp-reply-author">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php bbp_reply_author_link( array( 'sep' => '', 'size' => 60 ) ); ?>

		<?php if ( bbp_is_user_keymaster() ) : ?>
		<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>
			<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>
		<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>
		<?php endif; ?>

		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">
		
		<?php bbp_reply_author_link( array( 'sep' => '', 'size' => 0 ) ); ?>
		<span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?> <a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a></span>


		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->
</div><!-- .reply -->

</div>