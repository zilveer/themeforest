<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<div class="bbp-forum-header x-bbp-item-info-header">

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

			<h3 class="x-context-title">
				<?php _e( 'Forum: ', 'bbpress' ); ?>
				<a href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>
			</h3>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<div class="bbp-meta">

			<span class="x-item-info-date"><?php printf( __( 'Last updated %s', 'bbpress' ), bbp_get_forum_last_active_time() ); ?></span>

			<a href="<?php bbp_forum_permalink(); ?>" class="x-item-info-permalink">#<?php bbp_forum_id(); ?></a>

		</div><!-- .bbp-meta -->

	</div><!-- .bbp-forum-header -->

	<div class="bbp-forum-content">

		<?php do_action( 'bbp_theme_before_forum_content' ); ?>

		<?php bbp_forum_content(); ?>

		<?php do_action( 'bbp_theme_after_forum_content' ); ?>

	</div><!-- .bbp-forum-content -->

</div><!-- .forum -->
