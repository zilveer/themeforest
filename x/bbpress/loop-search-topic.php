<?php

/**
 * Search Loop - Single Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<div class="bbp-topic-header x-bbp-item-info-header">

		<?php do_action( 'bbp_theme_before_topic_title' ); ?>

		<h3 class="x-context-title">
			<?php _e( 'Topic: ', 'bbpress' ); ?>
			<a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>
		</h3>

		<?php do_action( 'bbp_theme_after_topic_title' ); ?>

		<div class="bbp-meta">

			<span class="x-item-info-date"><?php bbp_topic_post_date( bbp_get_topic_id() ); ?></span>

			<a href="<?php bbp_topic_permalink(); ?>" class="x-item-info-permalink">#<?php bbp_topic_id(); ?></a>

		</div><!-- .bbp-meta -->

	</div><!-- .bbp-topic-header -->

	<div class="x-bbp-item-info-content">

		<div class="bbp-topic-author x-bbp-item-info-author">

			<?php do_action( 'bbp_theme_before_topic_author_details' ); ?>

			<?php bbp_topic_author_link( array( 'sep' => '', 'show_role' => true ) ); ?>

			<?php if ( bbp_is_user_keymaster() ) : ?>

				<?php do_action( 'bbp_theme_before_topic_author_admin_details' ); ?>

				<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_topic_id() ); ?></div>

				<?php do_action( 'bbp_theme_after_topic_author_admin_details' ); ?>

			<?php endif; ?>

			<?php do_action( 'bbp_theme_after_topic_author_details' ); ?>

		</div><!-- .bbp-topic-author.x-bbp-item-info-author -->

		<div class="bbp-topic-content x-bbp-item-info-the-content">

			<?php do_action( 'bbp_theme_before_topic_content' ); ?>

			<?php bbp_topic_content(); ?>

			<?php do_action( 'bbp_theme_after_topic_content' ); ?>

		</div><!-- .bbp-topic-content.x-bbp-item-info-the-content -->

	</div><!-- .x-bbp-item-info-content -->

</div><!-- .topic -->
