<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>


<div class="topic-header clearfix">

<h1 class="topic-title"><?php the_title(); ?></h1>

<div class="topic-actions">

			<?php 
			
			$args = array (
			'subscribe'   => __( 'Subscribe',   'bbpress' ),
			'unsubscribe' => __( 'Unsubscribe', 'bbpress' ),
			'user_id'     => 0,
			'topic_id'    => 0,
			'before'      => '',
			'after'       => ''
			);
			bbp_user_subscribe_link( $args ); ?>

			<?php bbp_user_favorites_link(); ?>

</div><!-- ."topic-actions -->
</div>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">


	<li class="bbp-body">

		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

			<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
