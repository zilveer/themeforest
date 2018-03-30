<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<ul id="forums-list-<?php bbp_forum_id(); ?>" class="bbp-forums">

	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-forum-info"><i class="fa fa-forumbee"></i><?php esc_html_e( 'Forum', 'veda' ); ?></li>
			<li class="bbp-forum-topic-count"><i class="fa fa-comment-o"></i><?php esc_html_e( 'Topics', 'veda' ); ?></li>
			<li class="bbp-forum-reply-count"><i class="fa fa-pencil"></i><?php bbp_show_lead_topic() ? esc_html_e( 'Replies', 'veda' ) : esc_html_e( 'Posts', 'veda' ); ?></li>
			<li class="bbp-forum-freshness"><i class="fa fa-refresh"></i><?php esc_html_e( 'Freshness', 'veda' ); ?></li>
		</ul>

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->

	<li class="bbp-footer">

		<div class="tr">
			<p class="td colspan4">&nbsp;</p>
		</div><!-- .tr -->

	</li><!-- .bbp-footer -->

</ul><!-- .forums-directory -->

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
