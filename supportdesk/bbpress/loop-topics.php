<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>


<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics">

<?php if (!is_search()) { ?>
	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-topic-title"><?php the_title(); ?></li>
		</ul>

	</li>
<?php } ?>
	<li class="bbp-body">

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>