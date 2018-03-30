<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Dante
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">

	<li class="bbp-header">

		<div class="bbp-single-topic-meta clearfix">
			
			<div class="back-to">
				<a href="<?php echo bbp_get_forum_permalink() ?>"><i class="ss-navigateleft"></i><?php _e("Back to forum", "swiftframework"); ?></a>
			</div>
				
			<div class="posted-in"><?php _e("Posted in:", "swiftframework"); ?> <?php echo '<a href="' . bbp_get_forum_permalink() . '" class="parent-forum">' . bbp_get_forum_title() . '</a>'; ?></div>
			
		</div>

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php if ( bbp_thread_replies() ) : ?>

			<?php bbp_list_replies(); ?>

		<?php else : ?>

			<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

				<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</li><!-- .bbp-body -->

	<li class="bbp-footer">
	
		<div class="bbp-topic-action">
			<?php bbp_user_subscribe_link( array('before' => '') ); ?> 
			<?php bbp_user_favorites_link(); ?>
		</div>

	</li>

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
